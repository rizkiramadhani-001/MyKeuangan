<div>
    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .custom-scroll::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        .custom-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        /* Update: Purple Scrollbar Thumb */
        .custom-scroll::-webkit-scrollbar-thumb {
            background-color: rgba(168, 85, 247, 0.5);
            /* Purple-500 */
            border-radius: 20px;
        }

        /* Animation for the blobs */
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>

    <div
        class="w-full bg-slate-50 border border-purple-900 dark:bg-slate-950 font-sans text-slate-600 dark:text-slate-400 selection:bg-purple-500 selection:text-white overflow-hidden flex flex-col md:h-[calc(100vh-65px)] h-screen rounded-2xl">

        <div class="fixed inset-0 z-0 pointer-events-none overflow-hidden">
            <div
                class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-violet-200/40 dark:bg-violet-900/20 rounded-full blur-3xl mix-blend-multiply dark:mix-blend-screen animate-blob">
            </div>
            <div
                class="absolute top-[-10%] right-[-10%] w-96 h-96 bg-purple-200/40 dark:bg-purple-900/20 rounded-full blur-3xl mix-blend-multiply dark:mix-blend-screen animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute bottom-[-20%] left-[20%] w-96 h-96 bg-fuchsia-200/40 dark:bg-fuchsia-900/20 rounded-full blur-3xl mix-blend-multiply dark:mix-blend-screen animate-blob animation-delay-4000">
            </div>
        </div>

        <div class="relative z-10 flex-1 overflow-y-auto custom-scroll p-4 md:p-8 scroll-smooth">

            <div class="max-w-7xl mx-auto mb-10">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                            Overview

                        </h2>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="relative flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </span>
                            <p class="text-xs md:text-sm font-medium text-slate-500 dark:text-slate-500">System Updated:
                                Just now</p>
                        </div>
                    </div>
                    <div
                        class="h-10 w-10 rounded-full bg-purple-500/10 border border-purple-500/20 flex items-center justify-center">
                        <i class="fa-solid fa-user text-purple-500"></i>
                    </div>
                </div>

                <div
                    class="flex overflow-x-auto pb-4 gap-4 snap-x snap-mandatory md:grid md:grid-cols-3 md:overflow-visible md:pb-0 md:gap-6 no-scrollbar">

                    <div
                        class="min-w-[85%] sm:min-w-[320px] md:min-w-0 snap-center bg-white/60 dark:bg-slate-900/60 backdrop-blur-xl p-6 rounded-[2rem] shadow-sm border border-white/50 dark:border-white/5 relative overflow-hidden transition-all duration-300 group hover:-translate-y-1 hover:shadow-xl dark:hover:shadow-purple-500/10">
                        <div
                            class="absolute right-0 top-0 p-6 opacity-[0.03] dark:opacity-[0.05] text-purple-600 dark:text-purple-400 group-hover:scale-125 group-hover:rotate-12 transition-transform duration-700">
                            <i class="fa-solid fa-wallet text-8xl"></i>
                        </div>

                        <div class="relative z-10">
                            <div class="flex justify-between items-start mb-6">
                                <div
                                    class="p-3 bg-purple-50 dark:bg-purple-500/10 rounded-2xl text-purple-600 dark:text-purple-400">
                                    <i class="fa-solid fa-wallet text-xl"></i>
                                </div>
                                <span
                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 text-[10px] font-bold uppercase tracking-wide border border-emerald-100 dark:border-emerald-500/20">
                                    <i class="fa-solid fa-arrow-trend-up"></i> +12.5%
                                </span>
                            </div>

                            <p
                                class="text-xs text-slate-500 dark:text-slate-500 font-bold uppercase tracking-wider mb-1">
                                Dana Bebas</p>
                            <h3
                                class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight tabular-nums truncate">
                                {{ number_format($data->dana - $sum) }}
                            </h3>
                            <p class="text-xs text-slate-400 dark:text-slate-500 mt-2 font-medium">Safe to spend this
                                month</p>
                            <br>
                            <p
                                class="text-xs text-slate-500 dark:text-slate-500 font-bold uppercase tracking-wider mb-1">
                                Dana Asli Setelah Transaksi</p>
                            <h3
                                class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight tabular-nums truncate">
                                {{ number_format($data->dana - $sumf) }}
                            </h3>
                            <p class="text-xs text-slate-400 dark:text-slate-500 mt-2 font-medium">Safe to spend this
                                month</p>
                        </div>
                    </div>

                    <div
                        class="min-w-[85%] sm:min-w-[320px] md:min-w-0 snap-center bg-white/60 dark:bg-slate-900/60 backdrop-blur-xl p-6 rounded-[2rem] shadow-sm border border-white/50 dark:border-white/5 relative overflow-hidden transition-all duration-300 group hover:-translate-y-1 hover:shadow-xl dark:hover:shadow-orange-500/10">
                        <div
                            class="absolute right-0 top-0 p-6 opacity-[0.03] dark:opacity-[0.05] text-orange-600 dark:text-orange-400 group-hover:scale-125 group-hover:-rotate-12 transition-transform duration-700">
                            <i class="fa-solid fa-file-invoice text-8xl"></i>
                        </div>

                        <div class="relative z-10">
                            <div class="flex justify-between items-start mb-6">
                                <div
                                    class="p-3 bg-orange-50 dark:bg-orange-500/10 rounded-2xl text-orange-600 dark:text-orange-400">
                                    <i class="fa-solid fa-file-invoice-dollar text-xl"></i>
                                </div>
                                <span
                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 text-[10px] font-bold uppercase tracking-wide border border-slate-200 dark:border-slate-700">
                                    Fixed
                                </span>
                            </div>

                            <p
                                class="text-xs text-slate-500 dark:text-slate-500 font-bold uppercase tracking-wider mb-1">
                                Wajib (Needs)</p>
                            <h3
                                class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight tabular-nums truncate">
                                {{ number_format($sum) }}
                            </h3>
                            <p class="text-xs text-orange-500 dark:text-orange-400 mt-2 font-medium">Tagihan Wajib
                            </p>
                        </div>
                    </div>

                    <div
                        class="min-w-[85%] sm:min-w-[320px] md:min-w-0 snap-center bg-gradient-to-br from-violet-600 via-purple-600 to-fuchsia-600 p-6 rounded-[2rem] shadow-xl shadow-purple-500/20 text-white relative overflow-hidden group hover:-translate-y-1 hover:shadow-2xl hover:shadow-purple-500/40 transition-all duration-300">
                        <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 rounded-full bg-white/10 blur-2xl">
                        </div>
                        <div class="absolute bottom-0 left-0 -ml-8 -mb-8 w-32 h-32 rounded-full bg-black/10 blur-2xl">
                        </div>

                        <div
                            class="absolute -bottom-6 -right-6 p-4 opacity-10 group-hover:scale-110 group-hover:rotate-45 transition duration-700 ease-out">
                            <i class="fa-solid fa-bullseye text-9xl"></i>
                        </div>

                        <div class="relative z-10 h-full flex flex-col justify-between">
                            <div>
                                <div class="flex justify-between items-start">
                                    <p class="text-xs text-purple-100 font-bold uppercase tracking-wider opacity-90">
                                        Total Target</p>
                                    <div class="p-1.5 bg-white/20 backdrop-blur-sm rounded-lg border border-white/10">
                                        <i class="fa-solid fa-crosshairs text-white text-xs"></i>
                                    </div>
                                </div>
                                <h3
                                    class="text-3xl md:text-4xl font-extrabold mt-2 tracking-tight tabular-nums truncate">
                                    {{ number_format($sumw) }}
                                </h3>
                            </div>

                            <div class="mt-6">
                                <div class="flex justify-between text-xs font-bold mb-2 opacity-90">
                                    <span>Progress</span>
                                    <span>{{ $sumw > 0 ? round($sumf2/$sumw*100) : 0 }}%</span>
                                </div>
                                <div
                                    class="bg-black/20 rounded-full h-2 w-full overflow-hidden backdrop-blur-sm border border-white/10">
                                    <div class="bg-white h-full rounded-full shadow-[0_0_15px_rgba(255,255,255,0.8)] relative overflow-hidden"
                                        style="width: {{ $sumw > 0 ? round($sumf2 / $sumw * 100) : 0 }}%;">
                                        <div class="absolute inset-0 bg-white/30 w-full h-full animate-shimmer"
                                            style="background-image: linear-gradient(90deg, transparent, rgba(255,255,255,0.5), transparent); transform: skewX(-20deg);">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-12 mt-12">

                    <div>
                        <div class="flex items-center justify-between mb-6 px-1">
                            <div class="flex items-center gap-3">
                                <div class="h-8 w-1.5 rounded-full bg-orange-500"></div>
                                <div>
                                    <h2 class="text-xl font-bold text-slate-900 dark:text-white leading-tight">Needs
                                        Allocation</h2>
                                    <p class="text-xs text-slate-500 dark:text-slate-500 font-medium">Tagihan & Rutin
                                        Bulanan</p>
                                </div>
                            </div>
                            <button
                                class="text-xs font-bold text-slate-400 hover:text-orange-500 dark:hover:text-orange-400 transition-colors flex items-center gap-1">
                                See All <i class="fa-solid fa-chevron-right text-[10px]"></i>
                            </button>
                        </div>

                        <div
                            class="flex overflow-x-auto pb-8 gap-5 snap-x snap-mandatory md:grid md:grid-cols-2 lg:grid-cols-4 md:overflow-visible md:pb-0 no-scrollbar">
                            @foreach ($barang as $item)
                            <div
                                class="min-w-[260px] md:min-w-0 snap-center bg-white dark:bg-slate-900 rounded-[1.5rem] p-3 shadow-sm hover:shadow-xl dark:shadow-none border border-slate-100 dark:border-white/5 group hover:-translate-y-1 transition-all duration-300">
                                <div class="relative h-36 rounded-2xl overflow-hidden mb-3">
                                    <img src="{{ $item->img_url }}"
                                        class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-700">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent">
                                    </div>
                                    <div class="absolute bottom-3 left-3">
                                        <p class="text-white font-bold text-sm shadow-sm">{{ $item->nama }}</p>
                                        <p class="text-white/80 text-[10px] font-medium flex items-center gap-1">
                                            <span
                                                class="w-1.5 h-1.5 bg-red-500 rounded-full animate-pulse"></span>{{ $item->deskripsi }}
                                        </p>
                                    </div>
                                    <div
                                        class="absolute top-3 right-3 bg-white/20 backdrop-blur-md border border-white/20 text-white text-[10px] font-bold px-2 py-1 rounded-lg">
                                        BILL
                                    </div>
                                </div>
                                <div class="px-2 pb-1">
                                    <div class="flex items-center justify-between">
                                        <span
                                            class="text-lg font-extrabold text-slate-900 dark:text-white tabular-nums">Rp
                                            {{ number_format($item->harga) }}</span>
                                        <button wire:click="goToTokopedia({{ $item->id }})"
                                            class="h-8 w-8 rounded-full bg-slate-900 dark:bg-white text-white dark:text-slate-900 flex items-center justify-center hover:scale-110 transition-transform shadow-lg">
                                            <i class="fa-solid fa-arrow-right text-xs -rotate-45"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-6 px-1">
                            <div class="flex items-center gap-3">
                                <div class="h-8 w-1.5 rounded-full bg-pink-500"></div>
                                <div>
                                    <h2 class="text-xl font-bold text-slate-900 dark:text-white leading-tight">Wishlist
                                        Targets</h2>
                                    <p class="text-xs text-slate-500 dark:text-slate-500 font-medium">Impian & Tabungan
                                    </p>
                                </div>
                            </div>
                            <button
                                class="text-xs font-bold text-slate-400 hover:text-pink-500 transition-colors flex items-center gap-1">
                                See All <i class="fa-solid fa-chevron-right text-[10px]"></i>
                            </button>
                        </div>

                        <div
                            class="flex overflow-x-auto pb-8 gap-5 snap-x snap-mandatory md:grid md:grid-cols-2 lg:grid-cols-4 md:overflow-visible md:pb-0 no-scrollbar">
                            @foreach ($wishlist as $item)

                            <div
                                class="min-w-[260px] md:min-w-0 snap-center bg-white dark:bg-slate-900 rounded-[1.5rem] border border-slate-100 dark:border-white/5 shadow-sm hover:shadow-2xl dark:shadow-none hover:shadow-pink-500/10 overflow-hidden transition-all duration-300 group hover:-translate-y-1 relative flex flex-col">
                                <div class="h-40 overflow-hidden relative shrink-0">
                                    <img class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700"
                                        src="{{ $item->img_url }}" alt="Shoes">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent opacity-90">
                                    </div>

                                    <div class="absolute top-3 left-3">
                                        <span
                                            class="inline-block px-2 py-1 text-[10px] font-bold tracking-wider text-white uppercase bg-white/20 backdrop-blur-md rounded-lg border border-white/10">Wishlist</span>
                                    </div>
                                    <div class="absolute bottom-3 left-3 right-3">
                                        <h5 class="text-lg font-extrabold text-white truncate drop-shadow-md">
                                            {{ $item->nama }}</h5>
                                        <div class="flex justify-between items-end mt-1">
                                            <p class="text-pink-300 text-xs font-bold text-wrap h-4">{{ $item->deskripsi }}</p>
                                            <p class="text-white text-sm font-bold tabular-nums">
                                                {{ number_format($item->harga) }}</p>
                                        </div>
                                    </div>
                                </div>


                                <div class="p-4 bg-white dark:bg-slate-900 relative flex-1 flex flex-col justify-end">
                                    <div
                                        class="w-full bg-slate-100 dark:bg-slate-800 h-2 rounded-full overflow-hidden mb-4">
                                        <div class="bg-gradient-to-r from-pink-500 to-rose-500 h-full rounded-full shadow-[0_0_10px_rgba(236,72,153,0.5)]"
                                            style="width: {{ $item->harga > 0 ? ($item->transactions->sum('amount')/$item->harga*100) : 0 }}%;">
                                        </div>
                                    </div>
                                    <p class="text-green-500 m-4"> Terkumpul: Rp
                                        {{number_format($item->transactions->sum('amount'))}}</p>
                                    <button wire:click="openModal({{ $item->id }})"
                                        class="w-full py-2.5 text-xs font-bold text-slate-700 dark:text-slate-300 bg-slate-50 dark:bg-slate-800 rounded-xl hover:bg-pink-500 hover:text-white dark:hover:bg-pink-500 dark:hover:text-white transition-all shadow-sm ring-1 ring-inset ring-slate-100 dark:ring-white/5 hover:ring-0">
                                        Add Funds
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                <section id="table">

                    <div class="mt-12 md:mt-16">

                        <div class="flex flex-col md:flex-row md:items-end justify-between px-1 mb-6 gap-4">
                            <div>
                                <h2 class="text-xl font-bold text-slate-900 dark:text-white">Transactions</h2>
                                <p class="text-sm text-slate-500 dark:text-slate-500 font-medium">Recent activity
                                    history
                                </p>
                            </div>

                            <div class="flex gap-2 self-start md:self-auto">
                                <button wire:click="export"
                                    class="h-[38px] w-[38px] flex items-center justify-center rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-white/5 text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                                    <i class="fa-solid fa-download text-xs"></i>
                                </button>
                            </div>
                        </div>

                        <div
                            class="bg-white/70 dark:bg-slate-900/70 backdrop-blur-xl rounded-[2rem] shadow-sm border border-white/50 dark:border-white/5 overflow-hidden w-full">

                            <div class="overflow-x-auto custom-scroll">
                                <table class="w-full text-left border-collapse min-w-[600px]">
                                    <thead
                                        class="bg-slate-50/50 dark:bg-slate-950/30 border-b border-slate-200/50 dark:border-white/5">
                                        <tr>
                                            <th
                                                class="py-4 px-6 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 dark:text-slate-500 whitespace-nowrap">
                                                Transaction</th>
                                            <th
                                                class="py-4 px-6 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 dark:text-slate-500 whitespace-nowrap">
                                                Category</th>
                                            <th
                                                class="py-4 px-6 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 dark:text-slate-500 whitespace-nowrap">
                                                Date</th>
                                            <th
                                                class="py-4 px-6 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 dark:text-slate-500 text-right whitespace-nowrap">
                                                Amount</th>
                                            <th
                                                class="py-4 px-6 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 dark:text-slate-500 text-center whitespace-nowrap">
                                                Status</th>

                                            <th
                                                class="py-4 px-6 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 dark:text-slate-500 text-center whitespace-nowrap">
                                                Action</th>

                                        </tr>
                                    </thead>

                                    <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                                        @foreach ($transactions as $item)

                                        <tr
                                            class="group hover:bg-white dark:hover:bg-purple-500/5 transition-colors duration-200 cursor-pointer">
                                            <td class="py-4 px-6">
                                                <div class="flex items-center gap-4">
                                                    <div
                                                        class="h-10 w-10 shrink-0 rounded-2xl bg-orange-100 dark:bg-orange-500/10 flex items-center justify-center text-orange-600 dark:text-orange-500 group-hover:scale-110 transition-transform duration-300">
                                                        <i class="fa-solid fa-dollar-sign text-sm"></i>
                                                    </div>
                                                    <div>
                                                        <div
                                                            class="text-sm font-bold text-slate-900 dark:text-white whitespace-nowrap">
                                                            {{ $item->barang->nama }}
                                                        </div>

                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-4 px-6">
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400 border border-slate-200 dark:border-slate-700 whitespace-nowrap">
                                                    <span
                                                        class="w-1.5 h-1.5 rounded-full {{ ($item->barang->tipe == 'kebutuhan') ? 'bg-green-500' : 'bg-orange-500' }}"></span>
                                                    {{ $item->barang->tipe }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-6 whitespace-nowrap">
                                                <div class="text-xs font-bold text-slate-700 dark:text-slate-300">
                                                    {{ $item->created_at }}</div>
                                                <div
                                                    class="text-[10px] text-slate-400 dark:text-slate-600 font-medium">
                                                    {{ $item->created_at }}
                                                </div>
                                            </td>
                                            <td class="py-4 px-6 text-right whitespace-nowrap">
                                                <div
                                                    class="text-sm font-bold text-slate-900 dark:text-white tabular-nums ">
                                                    <span
                                                        class="{{ ($item->barang->tipe == "wishlist")? 'text-green-500': 'text-red-500' }}">
                                                        {{ ($item->barang->tipe == "wishlist")? '+': '-' }} Rp
                                                        {{ number_format($item->amount) }}</div>

                                                </span>
                                            </td>
                                            <td class="py-4 px-6 text-center whitespace-nowrap">
                                                <div
                                                    class="inline-flex items-center justify-center px-2 py-1 rounded-full bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-100 dark:border-emerald-500/20">
                                                    <i
                                                        class="fa-solid fa-check text-[10px] text-emerald-600 dark:text-emerald-400 mr-1"></i>
                                                    <span
                                                        class="text-[10px] font-bold text-emerald-600 dark:text-emerald-400">Paid</span>
                                                </div>
                                            </td>
                                            <td class="py-4 px-6 text-center whitespace-nowrap">
                                                <button type="button" wire:click="delete({{ $item->id }})"
                                                    onclick="return confirm('Are You Sure')"
                                                    class="h-[30px] w-[30px] flex items-center justify-center rounded-lg border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-800 text-slate-400 hover:border-red-200 hover:bg-red-50 hover:text-red-600 dark:hover:bg-red-500/10 dark:hover:text-red-400 dark:hover:border-red-500/20 transition-all shadow-sm">
                                                    <i class="fa-solid fa-trash-can text-xs"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach



                                    </tbody>
                                </table>
                            </div>

                            <div
                                class="p-4 border-t border-slate-100 dark:border-white/5 flex items-center justify-between">
                                {{ $transactions->links() }}
                            </div>

                        </div>
                    </div>
                </section>


                <section>
                    <div>
                        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
                            aria-modal="true" wire:show="fundModal">
                            <div
                                class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                                <div wire:click="$set('fundModal', false)" wire:transition.opacity.duration.300ms
                                    class="fixed inset-0 bg-slate-900/75 backdrop-blur-sm transition-opacity"
                                    aria-hidden="true"></div>

                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                                    aria-hidden="true">&#8203;</span>

                                <div wire:transition.scale.origin.top.duration.300ms
                                    class="relative inline-block align-bottom bg-white dark:bg-slate-900 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-slate-200 dark:border-white/10">

                                    <div class="absolute top-0 right-0 pt-4 pr-4">
                                        <button wire:click="$set('fundModal', false)" type="button"
                                            class="bg-white dark:bg-slate-900 rounded-lg text-slate-400 hover:text-slate-500 focus:outline-none focus:ring-2 focus:ring-purple-500">
                                            <span class="sr-only">Close</span>
                                            <i class="fa-solid fa-xmark text-lg"></i>
                                        </button>
                                    </div>

                                    <form wire:submit="saveSaving({{ $barangId }})">
                                        <div class="p-6">
                                            <div class="flex items-center gap-4 mb-5">
                                                <div
                                                    class="h-12 w-12 rounded-full bg-purple-100 dark:bg-purple-500/10 flex items-center justify-center text-purple-600 dark:text-purple-400">
                                                    <i class="fa-solid fa-layer-group text-xl"></i>
                                                </div>

                                                <div>
                                                    <h3 class="text-lg font-bold text-slate-900 dark:text-white"
                                                        id="modal-title">Tambah Tabungan</h3>
                                                    <p class="text-xs text-slate-500 dark:text-slate-400">Masukan Berapa
                                                        Banyak</p>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <label
                                                    class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2 uppercase tracking-wide">
                                                    Masukan Uang
                                                </label>

                                                <input type="number" wire:model="amount" max="{{ $data->dana - $sumf }}"
                                                    class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-white/10 rounded-xl px-4 py-3 text-sm text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500 transition-all resize-none">

                                                @error('nama_barang')
                                                <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mt-2">
                                                <label
                                                    class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-2 uppercase tracking-wide">
                                                    Masukan Uang (Bukan Dari Uang utama Contoh: Uang Kaget)
                                                </label>

                                                <input type="number" wire:model="amountSudden"
                                                    class="w-full bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-white/10 rounded-xl px-4 py-3 text-sm text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-500/50 focus:border-purple-500 transition-all resize-none">

                                                @error('nama_barang')
                                                <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                                                @enderror
                                            </div>


                                        </div>

                                        <div
                                            class="bg-slate-50 dark:bg-slate-950/50 px-6 py-4 flex flex-row-reverse gap-3 border-t border-slate-100 dark:border-white/5">
                                            <button type="submit"
                                                class="w-full sm:w-auto inline-flex justify-center rounded-xl border border-transparent shadow-sm px-5 py-2.5 bg-purple-600 text-base font-medium text-white hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:text-sm transition-all">
                                                <span wire:loading.remove wire:target="save">Save Post</span>
                                                <span wire:loading wire:target="save"><i
                                                        class="fa-solid fa-circle-notch fa-spin"></i> Saving...</span>
                                            </button>

                                            <button type="button" wire:click="$set('fundModal', false)"
                                                class="w-full sm:w-auto inline-flex justify-center rounded-xl border border-slate-300 dark:border-white/10 shadow-sm px-5 py-2.5 bg-white dark:bg-slate-800 text-base font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:text-sm transition-all">
                                                Cancel
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="h-20"></div>

            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('open-new-tab', ({
                url
            }) => {
                if (confirm("Apakah Benar Ingin Membeli / Membayar")) {
                    window.open(url, '_blank');
                }
            });

            Livewire.on('transaction', (msg) => {
                alert("Transaksi Berhasil Di Catat")
            })
        });
    </script>
</div>