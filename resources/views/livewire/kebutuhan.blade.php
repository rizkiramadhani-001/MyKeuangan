<div class="w-full max-w-7xl mx-auto p-4 md:p-6">

    @if (session()->has('message'))
        <div class="mb-8 p-4 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 flex items-center gap-3 text-emerald-700 dark:text-emerald-400 shadow-sm animate-pulse">
            <i class="fa-solid fa-check-circle"></i>
            <span class="font-medium text-sm">{{ session('message') }}</span>
        </div>
    @endif
    
    @if (session()->has('error'))
        <div class="mb-8 p-4 rounded-xl bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 flex items-center gap-3 text-red-700 dark:text-red-400 shadow-sm">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <span class="font-medium text-sm">{{ session('error') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

        <div class="lg:col-span-2">
            <form wire:submit="dbSaveExpense" class="flex flex-col gap-8">

                <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-white/5 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-10 opacity-5 pointer-events-none">
                        <i class="fa-solid fa-wand-magic-sparkles text-9xl text-purple-600"></i>
                    </div>

                    <div class="mb-4 relative z-10">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <i class="fa-solid fa-sparkles text-purple-500"></i> AI Assistant
                        </h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Describe what you need, and I'll list the items for you.</p>
                    </div>

                    <div class="relative z-10">
                        <div class="flex items-center gap-2 p-1.5 rounded-xl border border-slate-200 dark:border-white/10 bg-slate-50 dark:bg-slate-950 focus-within:ring-2 focus-within:ring-purple-500/50 focus-within:border-purple-500 transition-all shadow-inner">
                            
                            <input 
                                type="text" 
                                wire:model="prompt"
                                wire:keydown.enter.prevent="generateSuggestions"
                                placeholder="e.g., 'Monthly groceries for 2 people' or 'Gaming PC specs'" 
                                class="flex-1 bg-transparent border-none outline-none focus:ring-0 text-slate-700 dark:text-slate-200 placeholder-slate-400 h-10 px-3"
                            >
                            
                            <button 
                                type="button"
                                wire:click="generateSuggestions"
                                wire:loading.attr="disabled"
                                class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm font-bold transition-all flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed shadow-md shadow-purple-500/20"
                            >
                                <span wire:loading.remove wire:target="generateSuggestions">
                                    Generate
                                </span>
                                <span wire:loading wire:target="generateSuggestions" class="flex items-center gap-2">
                                    <i class="fa-solid fa-circle-notch fa-spin"></i> Thinking
                                </span>
                            </button>
                        </div>
                        @error('prompt') <span class="text-xs text-red-500 mt-2 block pl-1">{{ $message }}</span> @enderror
                    </div>

  
                </div>

                <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-white/5">
                    <div class="mb-4 flex justify-between items-end">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white">Itemized Expenses</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Input manually or pick from AI suggestions</p>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3">
                        <div class="grid grid-cols-12 gap-3 text-[10px] uppercase font-bold tracking-wider text-slate-400 dark:text-slate-500 px-1">
                            <div class="col-span-7">Description</div>
                            <div class="col-span-4">Cost (IDR)</div>
                            <div class="col-span-1"></div>
                        </div>

                        @foreach($items as $index => $item)
                            <div class="grid grid-cols-12 gap-3 group animate-in fade-in slide-in-from-top-2 duration-300" wire:key="item-row-{{ $index }}">
                                <div class="col-span-7">
                                    <input type="text" wire:model.blur="items.{{ $index }}.name" placeholder="Item Name" 
                                        class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-white/10 rounded-xl px-4 py-2.5 text-sm text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500 transition-all">
                                    @error("items.{$index}.name") <span class="text-[10px] text-red-500 block mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-span-4 relative">
                                    <span class="absolute left-3 top-2.5 text-slate-400 dark:text-slate-600 text-sm">Rp</span>
                                    <input type="number" wire:model.live="items.{{ $index }}.price" placeholder="0" 
                                        class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-white/10 rounded-xl pl-9 pr-4 py-2.5 text-sm text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500 transition-all text-right">
                                </div>
                                <div class="col-span-1 flex items-center justify-center">
                                    <button type="button" wire:click="removeItem({{ $index }})" 
                                        class="h-9 w-9 rounded-lg flex items-center justify-center text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 transition-colors {{ count($items) === 1 ? 'opacity-0 pointer-events-none' : '' }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 flex items-center justify-between border-t border-slate-100 dark:border-white/5 pt-4">
                        <button type="button" wire:click="addItem" class="text-sm font-bold text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300 flex items-center gap-2 px-2 py-1 rounded-lg hover:bg-purple-50 dark:hover:bg-purple-500/10 transition-colors">
                            <i class="fa-solid fa-plus-circle"></i> Add Row
                        </button>
                        <div class="text-right">
                            <p class="text-xs text-slate-500 dark:text-slate-400">Total Estimate</p>
                            <p class="text-xl font-extrabold text-slate-900 dark:text-white">Rp {{ number_format($this->total) }}</p>
                        </div>
                    </div>
                </div>
    
                <div class="flex justify-end pt-4 pb-20 md:pb-0">
                    <button type="submit" wire:loading.attr="disabled" class="px-8 py-3 rounded-xl bg-purple-600 hover:bg-purple-700 text-white font-bold shadow-lg shadow-purple-500/30 hover:shadow-purple-500/50 hover:-translate-y-0.5 transition-all flex items-center gap-2 cursor-pointer active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span wire:loading.remove wire:target="dbSaveExpense"><i class="fa-solid fa-check mr-2"></i> Save Changes</span>
                        <span wire:loading wire:target="dbSaveExpense"><i class="fa-solid fa-spinner fa-spin mr-2"></i> Saving...</span>
                    </button>
                </div>

            </form>
        </div>

        <div class="lg:col-span-1">
            <div class="sticky top-6 flex flex-col gap-6">
                
                <div class="bg-gradient-to-br from-violet-600 via-purple-600 to-fuchsia-600 rounded-2xl p-6 shadow-xl shadow-purple-500/20 text-white relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform duration-700"><i class="fa-solid fa-robot text-6xl"></i></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                            </span>
                            <span class="text-xs font-bold uppercase tracking-widest text-purple-200">AI Analysis</span>
                        </div>
                        <h3 class="text-xl font-bold">Smart Suggestions</h3>
                        <p class="text-purple-100 text-xs mt-1 opacity-90">
                            @if(count($suggestions) > 2)
                                I've found some items for you! Click to add.
                            @else
                                Ask me to generate a list!
                            @endif
                        </p>
                    </div>
                </div>

                <div class="flex flex-col gap-4">
                    @foreach($suggestions as $group)
                        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-white/5 overflow-hidden animate-in fade-in slide-in-from-right duration-500">
                            
                            <div class="px-5 py-3 bg-slate-50 dark:bg-slate-950 border-b border-slate-100 dark:border-white/5 flex justify-between items-center">
                                <h4 class="font-bold text-slate-700 dark:text-slate-200 text-sm flex items-center gap-2">
                                    @php
                                        // Dynamic coloring support based on JSON return
                                        $color = $group['color'] ?? 'gray';
                                        $icon = $group['icon'] ?? 'circle';
                                    @endphp
                                    <div class="p-1.5 rounded-lg bg-{{ $color }}-100 dark:bg-{{ $color }}-500/10 text-{{ $color }}-600 dark:text-{{ $color }}-400">
                                        <i class="fa-solid fa-{{ $icon }} text-xs"></i>
                                    </div>
                                    {{ $group['category'] }}
                                </h4>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">{{ count($group['items']) }} Items</span>
                            </div>

                            <div class="p-3 grid grid-cols-2 gap-3">
                                @foreach($group['items'] as $suggestion)
                                    <button 
                                        type="button" 
                                        wire:click="useSuggestion('{{ $suggestion['name'] }}', {{ $suggestion['price'] }})"
                                        class="group flex flex-col items-start justify-between p-3 rounded-xl border border-slate-100 dark:border-white/5 bg-slate-50/50 dark:bg-slate-800/30 hover:border-purple-200 dark:hover:border-purple-500/30 hover:bg-purple-50 dark:hover:bg-purple-900/10 transition-all duration-200 text-left relative h-full cursor-pointer hover:-translate-y-0.5 shadow-sm hover:shadow-md"
                                    >
                                        <div class="w-full">
                                            <p class="text-[11px] font-bold text-slate-700 dark:text-slate-200 line-clamp-2 group-hover:text-purple-700 dark:group-hover:text-purple-300 transition-colors leading-tight">
                                                {{ $suggestion['name'] }}
                                            </p>
                                            <p class="text-[10px] text-slate-400 mt-1 font-mono">
                                                Rp {{ number_format($suggestion['price'] / 1000) }}k
                                            </p>
                                        </div>
                                        
                                        <div class="absolute bottom-2 right-2 opacity-0 group-hover:opacity-100 transition-all transform translate-y-2 group-hover:translate-y-0 duration-300">
                                            <div class="h-5 w-5 rounded-full bg-purple-600 text-white flex items-center justify-center shadow-lg">
                                                <i class="fa-solid fa-plus text-[8px]"></i>
                                            </div>
                                        </div>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

    </div>
</div>