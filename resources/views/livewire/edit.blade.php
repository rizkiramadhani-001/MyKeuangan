<div>
    <button 
        type="button"
        wire:click="$set('showModal', true)"
        class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all shadow-lg shadow-purple-500/30 flex items-center gap-2"
    >
        <i class="fa-solid fa-pen-nib"></i>
        <span>New Post</span>
    </button>

    <div 
        class="fixed inset-0 z-50 overflow-y-auto" 
        aria-labelledby="modal-title" 
        role="dialog" 
        aria-modal="true"
        wire:show="showModal"
    >
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            
            <div 
                wire:click="$set('showModal', false)"
                wire:transition.opacity.duration.300ms
                class="fixed inset-0 bg-slate-900/75 backdrop-blur-sm transition-opacity" 
                aria-hidden="true"
            ></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div 
                wire:transition.scale.origin.top.duration.300ms
                class="relative inline-block align-bottom bg-white dark:bg-slate-900 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-slate-200 dark:border-white/10"
            >
                
                <div class="absolute top-0 right-0 pt-4 pr-4">
                    <button 
                        wire:click="$set('showModal', false)" 
                        type="button" 
                        class="bg-white dark:bg-slate-900 rounded-lg text-slate-400 hover:text-slate-500 focus:outline-none focus:ring-2 focus:ring-purple-500"
                    >
                        <span class="sr-only">Close</span>
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                </div>

                <form wire:submit="save">
                    <div class="p-6">
                        <div class="flex items-center gap-4 mb-5">
                            <div class="h-12 w-12 rounded-full bg-purple-100 dark:bg-purple-500/10 flex items-center justify-center text-purple-600 dark:text-purple-400">
                                <i class="fa-solid fa-layer-group text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white" id="modal-title">Create New Post</h3>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Write your thoughts below.</p>
                            </div>
                        </div>

                        <div class="mt-2">
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2 uppercase tracking-wide">
                                Post Content
                            </label>
                            <textarea 
                                wire:model="content" 
                                rows="4" 
                                class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-white/10 rounded-xl px-4 py-3 text-sm text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500 transition-all resize-none"
                                placeholder="What's on your mind?..."
                            ></textarea>
                            @error('content') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="bg-slate-50 dark:bg-slate-950/50 px-6 py-4 flex flex-row-reverse gap-3 border-t border-slate-100 dark:border-white/5">
                        <button 
                            type="submit" 
                            class="w-full sm:w-auto inline-flex justify-center rounded-xl border border-transparent shadow-sm px-5 py-2.5 bg-purple-600 text-base font-medium text-white hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:text-sm transition-all"
                        >
                            <span wire:loading.remove wire:target="save">Save Post</span>
                            <span wire:loading wire:target="save"><i class="fa-solid fa-circle-notch fa-spin"></i> Saving...</span>
                        </button>
                        
                        <button 
                            type="button" 
                            wire:click="$set('showModal', false)"
                            class="w-full sm:w-auto inline-flex justify-center rounded-xl border border-slate-300 dark:border-white/10 shadow-sm px-5 py-2.5 bg-white dark:bg-slate-800 text-base font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:text-sm transition-all"
                        >
                            Cancel
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>