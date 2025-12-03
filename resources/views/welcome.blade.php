<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <title>MyUang — Safe Your Money</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            darkMode: 'class', // Mengaktifkan dark mode manual
            theme: {
                fontFamily: {
                    sans: ['Inter', 'sans-serif'],
                },
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#8b5cf6', // violet-500 (sedikit lebih terang agar pop di dark mode)
                            soft: '#ede9fe',    // violet-100
                            strong: '#6d28d9',  // violet-700
                            dark: '#4c1d95',    // violet-900
                        },
                        dark: {
                            bg: '#0f172a',      // slate-900
                            card: '#1e293b',    // slate-800
                            border: '#334155',  // slate-700
                        }
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 5px;
        }
        .dark ::-webkit-scrollbar-thumb {
            background: #475569;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #8b5cf6;
        }

        /* Navbar Glass Effect & Dark Mode Handling */
        .nav {
            transition: all 0.3s ease;
        }
        .nav.scrolled {
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }
        /* Dark mode scrolled state handled via JS toggling classes or specificity below */
        html.dark .nav.scrolled {
            background-color: rgba(15, 23, 42, 0.9); /* Slate-900 with opacity */
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.4);
            border-bottom: 1px solid rgba(51, 65, 85, 0.5);
        }

        /* Mobile Menu */
        .nav-links-mobile {
            display: none;
            transform-origin: top;
            animation: slideDown 0.3s ease-out forwards;
        }
        .nav-links-mobile.open {
            display: flex;
        }
        @keyframes slideDown {
            from { opacity: 0; transform: scaleY(0.9); }
            to { opacity: 1; transform: scaleY(1); }
        }

        /* Scroll Dot Animation */
        @keyframes scrollDot {
            0% { top: -4px; opacity: 0; }
            40% { opacity: 1; }
            100% { top: 8px; opacity: 0; }
        }
        .animate-scroll-dot::after {
            content: "";
            position: absolute;
            top: -4px;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 4px;
            border-radius: 999px;
            background: #8b5cf6;
            animation: scrollDot 1.2s infinite;
        }

        /* Reveal Animation */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s cubic-bezier(0.5, 0, 0, 1), transform 0.8s cubic-bezier(0.5, 0, 0, 1);
        }
        .reveal.in-view {
            opacity: 1;
            transform: translateY(0);
        }

        /* Scroll Top Button */
        .scroll-top {
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s ease;
        }
        .scroll-top.visible {
            opacity: 1;
            pointer-events: auto;
            transform: translateY(0);
        }

        /* Custom Range Input */
        input[type=range] {
            accent-color: #8b5cf6;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 dark:bg-dark-bg dark:text-gray-100 antialiased selection:bg-primary selection:text-white transition-colors duration-300">

    <header id="nav" class="nav fixed top-0 inset-x-0 z-50 bg-white/80 dark:bg-dark-bg/80 backdrop-blur-md border-b border-gray-200 dark:border-dark-border transition-colors duration-300">
        <div class="max-w-[1100px] mx-auto px-6 py-3.5 flex items-center justify-between gap-4">
            
            <a href="#" class="flex items-center gap-3 font-bold tracking-wider uppercase text-xs text-primary-strong dark:text-primary-soft group">
                <div class="w-[40px] h-[40px] rounded-xl bg-gradient-to-tr from-primary to-fuchsia-500 flex items-center justify-center text-white shadow-lg shadow-primary/30 group-hover:shadow-primary/50 transition-all duration-300">
                    <i class="fa-solid fa-wallet text-lg"></i>
                </div>
                <span class="group-hover:text-primary transition-colors text-sm">MyUang</span>
            </a>

            <nav class="hidden md:flex gap-8 text-sm font-medium text-gray-500 dark:text-gray-400">
                <a href="#hero" class="relative hover:text-primary dark:hover:text-primary-soft transition-colors group py-2">
                    Beranda
                    <span class="absolute left-0 bottom-0 w-0 h-[2px] bg-primary rounded-full transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="#why" class="relative hover:text-primary dark:hover:text-primary-soft transition-colors group py-2">
                    Fitur
                    <span class="absolute left-0 bottom-0 w-0 h-[2px] bg-primary rounded-full transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="#steps" class="relative hover:text-primary dark:hover:text-primary-soft transition-colors group py-2">
                    Alur
                    <span class="absolute left-0 bottom-0 w-0 h-[2px] bg-primary rounded-full transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="#simulator" class="relative hover:text-primary dark:hover:text-primary-soft transition-colors group py-2">
                    Simulator
                    <span class="absolute left-0 bottom-0 w-0 h-[2px] bg-primary rounded-full transition-all duration-300 group-hover:w-full"></span>
                </a>
            </nav>

            <div class="flex items-center gap-3">
                <button id="themeToggle" class="w-9 h-9 rounded-full bg-gray-100 dark:bg-slate-800 text-gray-500 dark:text-yellow-400 flex items-center justify-center hover:bg-gray-200 dark:hover:bg-slate-700 transition-colors focus:outline-none focus:ring-2 focus:ring-primary">
                    <i class="fa-solid fa-sun hidden dark:block"></i>
                    <i class="fa-solid fa-moon dark:hidden"></i>
                </button>

                <a href="/login" class="hidden md:flex items-center rounded-full px-5 py-2 bg-primary text-white text-xs font-bold hover:bg-primary-strong transition-all shadow-lg shadow-primary/20 hover:shadow-primary/40">
                    Login <i class="fa-solid fa-arrow-right-to-bracket ml-2"></i>
                </a>

                <button id="navBurger" aria-label="Menu" class="md:hidden flex flex-col gap-[5px] bg-transparent border-none cursor-pointer p-1 group">
                    <span class="w-6 h-[2px] rounded-full bg-gray-600 dark:bg-gray-300 group-hover:bg-primary transition-colors"></span>
                    <span class="w-6 h-[2px] rounded-full bg-gray-600 dark:bg-gray-300 group-hover:bg-primary transition-colors"></span>
                    <span class="w-6 h-[2px] rounded-full bg-gray-600 dark:bg-gray-300 group-hover:bg-primary transition-colors"></span>
                </button>
            </div>
        </div>

        <div id="navMobile" class="nav-links-mobile flex-col gap-1 px-4 pb-4 border-b border-gray-200 dark:border-dark-border bg-white dark:bg-dark-card md:hidden shadow-lg">
            <a href="#hero" class="text-sm font-medium hover:bg-primary-soft dark:hover:bg-slate-700/50 hover:text-primary dark:hover:text-primary-soft py-3 px-4 rounded-lg transition-colors"><i class="fa-solid fa-house mr-3 w-5 text-center"></i> Beranda</a>
            <a href="#why" class="text-sm font-medium hover:bg-primary-soft dark:hover:bg-slate-700/50 hover:text-primary dark:hover:text-primary-soft py-3 px-4 rounded-lg transition-colors"><i class="fa-solid fa-star mr-3 w-5 text-center"></i> Fitur</a>
            <a href="#steps" class="text-sm font-medium hover:bg-primary-soft dark:hover:bg-slate-700/50 hover:text-primary dark:hover:text-primary-soft py-3 px-4 rounded-lg transition-colors"><i class="fa-solid fa-list-ol mr-3 w-5 text-center"></i> Alur</a>
            <a href="#simulator" class="text-sm font-medium hover:bg-primary-soft dark:hover:bg-slate-700/50 hover:text-primary dark:hover:text-primary-soft py-3 px-4 rounded-lg transition-colors"><i class="fa-solid fa-calculator mr-3 w-5 text-center"></i> Simulator</a>
            <div class="h-px bg-gray-100 dark:bg-slate-700 my-1"></div>
            <a href="index.html" class="text-sm font-bold text-primary dark:text-primary-soft py-3 px-4"><i class="fa-solid fa-right-to-bracket mr-3 w-5 text-center"></i> Login</a>
        </div>
    </header>

    <main>
        <section id="hero" class="pt-[7rem] pb-16 relative overflow-hidden">
            <div class="absolute top-0 left-[-10%] w-[500px] h-[500px] bg-primary/20 dark:bg-primary/10 rounded-full blur-[100px] pointer-events-none"></div>
            <div class="absolute bottom-0 right-[-10%] w-[400px] h-[400px] bg-fuchsia-400/20 dark:bg-fuchsia-600/10 rounded-full blur-[80px] pointer-events-none"></div>

            <div class="max-w-[1100px] mx-auto px-6 grid grid-cols-1 md:grid-cols-[1.5fr_1.3fr] gap-12 items-center relative z-10">
                
                <div class="reveal">
           

                    <h1 class="text-4xl md:text-5xl lg:text-[3.5rem] font-extrabold text-gray-900 dark:text-white mb-6 leading-[1.15]">
                        Atur Keuangan, <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-purple-500 to-fuchsia-500">Wujudkan Impian.</span>
                    </h1>
                    
                    <p class="text-lg text-gray-500 dark:text-gray-400 mb-8 max-w-lg leading-relaxed">
                        Platform manajemen finansial personal yang simpel, estetik, dan cerdas. Catat wishlist, hitung target, dan capai *financial goals*-mu.
                    </p>

                    <div class="flex flex-wrap gap-4 mb-10">
                        <a href="index.html" class="group relative rounded-full px-8 py-3.5 bg-primary text-white font-semibold text-sm tracking-wide shadow-lg shadow-primary/30 hover:bg-primary-strong hover:-translate-y-1 hover:shadow-primary/50 transition-all duration-200 overflow-hidden">
                            <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                            <span class="relative"><i class="fa-solid fa-rocket mr-2"></i> Mulai Sekarang</span>
                        </a>
                        <button id="scrollToWhy" class="rounded-full px-8 py-3.5 border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-gray-700 dark:text-gray-200 text-sm font-medium hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
                            Pelajari Dulu
                        </button>
                    </div>

      
                </div>

                <div class="flex justify-center md:justify-end reveal relative">
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[300px] h-[300px] bg-gradient-to-r from-primary to-fuchsia-600 rounded-full blur-[60px] opacity-20 dark:opacity-40 animate-pulse"></div>

                    <div class="w-full max-w-[380px] rounded-[24px] bg-white/70 dark:bg-slate-900/60 backdrop-blur-xl border border-white/50 dark:border-slate-700 shadow-2xl shadow-primary/10 dark:shadow-black/50 overflow-hidden transform rotate-[-2deg] hover:rotate-0 transition-transform duration-500 animate-float">
                        <div class="px-6 py-4 border-b border-gray-100 dark:border-slate-800 flex justify-between items-center">
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full bg-red-400"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                                <div class="w-3 h-3 rounded-full bg-green-400"></div>
                            </div>
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Dashboard</span>
                        </div>

                        <div class="p-6">
                            <div class="p-5 rounded-2xl bg-gradient-to-br from-primary to-violet-600 text-white mb-5 shadow-lg shadow-primary/30 relative overflow-hidden group">
                                <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full blur-xl transform translate-x-8 -translate-y-8 group-hover:scale-150 transition-transform duration-700"></div>
                                <div class="text-xs text-violet-200 mb-1 font-medium">Total Tabungan</div>
                                <div class="text-2xl font-bold tracking-tight">Rp 12.500.000</div>
                                <div class="mt-4 flex items-center gap-2 text-xs font-medium text-violet-100 bg-white/20 w-fit px-2 py-1 rounded-lg">
                                    <i class="fa-solid fa-arrow-trend-up"></i> +15% bulan ini
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-3 mb-5">
                                <div class="p-4 rounded-xl bg-indigo-50 dark:bg-slate-800 border border-indigo-100 dark:border-slate-700 transition-colors">
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-1 font-bold">Wishlist</div>
                                    <div class="text-lg font-bold text-gray-800 dark:text-white flex items-center gap-2">
                                        3 <span class="text-[10px] text-gray-400 font-normal">Items</span>
                                    </div>
                                </div>
                                <div class="p-4 rounded-xl bg-pink-50 dark:bg-slate-800 border border-pink-100 dark:border-slate-700 transition-colors">
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-1 font-bold">Terbeli</div>
                                    <div class="text-lg font-bold text-gray-800 dark:text-white flex items-center gap-2">
                                        5 <span class="text-[10px] text-gray-400 font-normal">Items</span>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <div class="flex justify-between text-xs font-bold text-gray-600 dark:text-gray-300">
                                    <span>Macbook Air M2</span>
                                    <span>75%</span>
                                </div>
                                <div class="w-full h-2 rounded-full bg-gray-100 dark:bg-slate-800 overflow-hidden">
                                    <div class="h-full w-[75%] rounded-full bg-gradient-to-r from-fuchsia-500 to-primary shadow-[0_0_10px_rgba(139,92,246,0.5)]"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div id="statsStrip" class="reveal mt-12 border-y border-gray-100 dark:border-slate-800 bg-white/50 dark:bg-dark-bg/50 backdrop-blur-sm relative z-10">
                <div class="max-w-[1100px] mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-8 divide-y md:divide-y-0 md:divide-x divide-gray-200 dark:divide-slate-700">
                    <div class="text-center py-2 md:py-0">
                        <div class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-br from-primary to-primary-dark stat-number" data-target="10">0</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-2 font-medium">Slot Wishlist Gratis</div>
                    </div>
                    <div class="text-center py-2 md:py-0">
                        <div class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-br from-primary to-primary-dark stat-number" data-target="100">0</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-2 font-medium">Aman & Terenkripsi</div>
                    </div>
                    <div class="text-center py-2 md:py-0">
                        <div class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-br from-primary to-primary-dark stat-number" data-target="24">0</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-2 font-medium">Jam Akses Cloud</div>
                    </div>
                </div>
            </div>
        </section>

        <section id="why" class="py-20 px-6 bg-gray-50 dark:bg-dark-bg transition-colors duration-300">
            <div class="max-w-[1100px] mx-auto mb-12 text-center reveal">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-3">Kenapa MyUang?</h2>
                <p class="text-gray-500 dark:text-gray-400">Fitur lengkap untuk mengatur cashflow anak muda.</p>
            </div>

            <div class="max-w-[1100px] mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <article class="bg-white dark:bg-dark-card rounded-2xl p-8 border border-gray-100 dark:border-slate-700 hover:-translate-y-2 hover:shadow-xl hover:shadow-primary/10 hover:border-primary/30 dark:hover:border-primary/30 transition-all duration-300 reveal group">
                    <div class="w-14 h-14 rounded-2xl bg-pink-50 dark:bg-pink-500/10 border border-pink-100 dark:border-pink-500/20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-heart text-2xl text-pink-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Smart Wishlist</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                        Prioritaskan barang impianmu. Sistem kami membantu mengurutkan mana yang harus dibeli duluan berdasarkan budget.
                    </p>
                </article>

                <article class="bg-white dark:bg-dark-card rounded-2xl p-8 border border-gray-100 dark:border-slate-700 hover:-translate-y-2 hover:shadow-xl hover:shadow-primary/10 hover:border-primary/30 dark:hover:border-primary/30 transition-all duration-300 reveal group">
                    <div class="w-14 h-14 rounded-2xl bg-primary-soft dark:bg-primary/10 border border-primary-soft dark:border-primary/20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-wand-magic-sparkles text-2xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Estimasi Otomatis</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                        Tidak perlu hitung manual. Masukkan harga dan tabungan per bulan, kami beri tahu tanggal pasti impianmu tercapai.
                    </p>
                </article>

                <article class="bg-white dark:bg-dark-card rounded-2xl p-8 border border-gray-100 dark:border-slate-700 hover:-translate-y-2 hover:shadow-xl hover:shadow-primary/10 hover:border-primary/30 dark:hover:border-primary/30 transition-all duration-300 reveal group">
                    <div class="w-14 h-14 rounded-2xl bg-orange-50 dark:bg-orange-500/10 border border-orange-100 dark:border-orange-500/20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-shield-halved text-2xl text-orange-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Anti Bocor</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                        Catat setiap pengeluaran kecil. Deteksi "Latte Factor" yang sering menghabiskan uangmu tanpa sadar.
                    </p>
                </article>
            </div>
        </section>

        <section id="steps" class="py-20 px-6 bg-white dark:bg-slate-900 relative border-t border-b border-gray-100 dark:border-slate-800 transition-colors duration-300">
            <div class="absolute inset-0 bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] dark:bg-[radial-gradient(#334155_1px,transparent_1px)] [background-size:16px_16px] opacity-40 pointer-events-none"></div>
            
            <div class="max-w-[1100px] mx-auto mb-12 text-center reveal relative z-10">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-3">Cara Kerja</h2>
                <p class="text-gray-500 dark:text-gray-400">3 Langkah mudah menuju kebebasan finansial.</p>
            </div>

            <div class="max-w-[1100px] mx-auto grid grid-cols-1 sm:grid-cols-3 gap-8 relative z-10">
                
                <div class="bg-gray-50 dark:bg-dark-card rounded-2xl p-6 border border-gray-100 dark:border-slate-700 relative hover:border-primary/50 transition-all duration-300 reveal group text-center">
                    <div class="w-12 h-12 mx-auto rounded-full bg-primary text-white text-lg font-bold flex items-center justify-center mb-4 shadow-lg shadow-primary/30 group-hover:scale-110 transition-transform">1</div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Buat Akun</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Daftar gratis dalam 1 menit. Data tersimpan aman di cloud.</p>
                </div>

                <div class="bg-gray-50 dark:bg-dark-card rounded-2xl p-6 border border-gray-100 dark:border-slate-700 relative hover:border-primary/50 transition-all duration-300 reveal group text-center">
                    <div class="w-12 h-12 mx-auto rounded-full bg-white dark:bg-slate-700 text-primary dark:text-white text-lg font-bold border-2 border-primary flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">2</div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Input Target</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Masukkan barang wishlist dan harga pasarnya saat ini.</p>
                </div>

                <div class="bg-gray-50 dark:bg-dark-card rounded-2xl p-6 border border-gray-100 dark:border-slate-700 relative hover:border-primary/50 transition-all duration-300 reveal group text-center">
                    <div class="w-12 h-12 mx-auto rounded-full bg-white dark:bg-slate-700 text-primary dark:text-white text-lg font-bold border-2 border-primary flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">3</div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Nabung & Pantau</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Isi celengan virtualmu dan lihat progress bar bergerak penuh!</p>
                </div>

            </div>
        </section>

        <section id="simulator" class="py-20 px-6 bg-gray-50 dark:bg-dark-bg transition-colors duration-300">
            <div class="max-w-[1100px] mx-auto mb-12 text-center reveal">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-3">Simulator Tabungan</h2>
                <p class="text-gray-500 dark:text-gray-400">Coba hitung, butuh berapa lama?</p>
            </div>

            <div class="max-w-[1100px] mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div class="bg-white dark:bg-dark-card rounded-3xl p-8 border border-gray-200 dark:border-slate-700 shadow-sm hover:shadow-lg transition-all duration-300 reveal">
                    <div class="mb-8">
                        <label class="flex justify-between items-end mb-4">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest"><i class="fa-solid fa-tag mr-2 text-primary"></i> Harga Barang</span>
                            <span class="text-xl font-bold text-primary" id="simPriceLabel">Rp 1.500.000</span>
                        </label>
                        <input type="range" id="simPrice" min="500000" max="20000000" step="100000" value="1500000" class="w-full h-2 bg-gray-100 dark:bg-slate-700 rounded-lg appearance-none cursor-pointer" />
                        <div class="flex justify-between mt-2 text-[10px] text-gray-400 font-mono">
                            <span>500K</span>
                            <span>20JT</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="flex justify-between items-end mb-4">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest"><i class="fa-solid fa-piggy-bank mr-2 text-primary"></i> Nabung / Bulan</span>
                            <span class="text-xl font-bold text-primary" id="simIncomeLabel">Rp 500.000</span>
                        </label>
                        <input type="range" id="simIncome" min="100000" max="10000000" step="50000" value="500000" class="w-full h-2 bg-gray-100 dark:bg-slate-700 rounded-lg appearance-none cursor-pointer" />
                        <div class="flex justify-between mt-2 text-[10px] text-gray-400 font-mono">
                            <span>100K</span>
                            <span>10JT</span>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-slate-900 to-slate-800 dark:from-primary-dark dark:to-slate-900 rounded-3xl p-8 text-white relative overflow-hidden flex flex-col justify-between hover:scale-[1.02] transition-transform duration-300 reveal shadow-2xl shadow-primary/20">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-primary rounded-full blur-[100px] opacity-20 pointer-events-none"></div>

                    <div class="relative z-10">
                        <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-2 flex items-center">
                            <i class="fa-solid fa-flag-checkered mr-2 text-primary"></i> Hasil Estimasi
                        </h3>
                        <p id="simMonthsText" class="text-lg text-gray-200 mb-8 leading-relaxed">
                            Butuh waktu sekitar <br>
                            <span class="text-4xl md:text-5xl font-extrabold text-white tracking-tight">3 Bulan</span>.
                        </p>

                        <div class="mb-2">
                            <div class="w-full h-4 rounded-full bg-black/30 overflow-hidden backdrop-blur-sm border border-white/10">
                                <div id="simProgressFill" class="h-full w-0 bg-gradient-to-r from-primary to-fuchsia-400 transition-all duration-500 relative">
                                    <div class="absolute inset-0 bg-white/20 animate-pulse"></div>
                                </div>
                            </div>
                            <div class="flex justify-between mt-3 text-xs text-gray-400 font-medium uppercase tracking-wide">
                                <span>Tingkat Kesulitan</span>
                                <span id="simProgressPercent" class="text-white">Mudah</span>
                            </div>
                        </div>
                    </div>

                    <div class="relative z-10 mt-6">
                        <button onclick="window.location.href='/dashboard'" class="w-full rounded-xl px-7 py-3.5 bg-white text-slate-900 font-bold text-sm hover:bg-gray-100 transition-colors shadow-lg flex items-center justify-center gap-2 group">
                            Buat Rencana Ini <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <footer class="bg-slate-900 text-gray-300 border-t border-slate-800">
            <div class="max-w-[1100px] mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-[1.5fr_2fr] gap-12 border-b border-slate-800/60">
                
                <div>
                    <h4 class="text-xl font-bold mb-6 flex items-center gap-2 text-white">
                        <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center text-white text-sm"><i class="fa-solid fa-wallet"></i></div>
                        MyUang
                    </h4>
                    <p class="text-sm text-slate-400 leading-relaxed mb-6">
                        Platform finansial sahabat Gen-Z. Kami percaya menabung itu harus menyenangkan, bukan menyiksa. Mulai atur wishlistmu hari ini.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-slate-400 hover:bg-primary hover:text-white hover:border-primary transition-all"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-slate-400 hover:bg-primary hover:text-white hover:border-primary transition-all"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center text-slate-400 hover:bg-primary hover:text-white hover:border-primary transition-all"><i class="fa-brands fa-github"></i></a>
                    </div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-8 pt-2">
                    <div class="flex flex-col gap-4">
                        <h5 class="text-xs font-bold text-white uppercase tracking-widest">Menu</h5>
                        <a href="#hero" class="text-sm text-slate-400 hover:text-primary transition-colors">Beranda</a>
                        <a href="#why" class="text-sm text-slate-400 hover:text-primary transition-colors">Fitur</a>
                        <a href="#steps" class="text-sm text-slate-400 hover:text-primary transition-colors">Alur</a>
                    </div>
                    <div class="flex flex-col gap-4">
                        <h5 class="text-xs font-bold text-white uppercase tracking-widest">Produk</h5>
                        <a href="#simulator" class="text-sm text-slate-400 hover:text-primary transition-colors">Simulator</a>
                        <a href="#" class="text-sm text-slate-400 hover:text-primary transition-colors">Aplikasi Mobile</a>
                        <a href="#" class="text-sm text-slate-400 hover:text-primary transition-colors">API Docs</a>
                    </div>
                    <div class="flex flex-col gap-4">
                        <h5 class="text-xs font-bold text-white uppercase tracking-widest">Legal</h5>
                        <a href="#" class="text-sm text-slate-400 hover:text-primary transition-colors">Privacy</a>
                        <a href="#" class="text-sm text-slate-400 hover:text-primary transition-colors">Terms</a>
                        <a href="#" class="text-sm text-slate-400 hover:text-primary transition-colors">Cookies</a>
                    </div>
                </div>
            </div>

            <div class="max-w-[1100px] mx-auto px-6 py-8 flex flex-col sm:flex-row justify-between items-center text-xs text-slate-500 gap-2">
                <span>&copy; 2025 MyUang. Crafted with <i class="fa-solid fa-heart text-pink-500 animate-pulse mx-1"></i> & Purple Passion.</span>
            </div>
        </footer>
    </main>

    <button id="scrollTopBtn" aria-label="Kembali ke atas" class="scroll-top fixed right-6 bottom-6 w-12 h-12 rounded-full bg-primary text-white flex items-center justify-center shadow-lg hover:-translate-y-1 hover:bg-primary-strong transition-all duration-200 z-40 group">
        <i class="fa-solid fa-arrow-up group-hover:animate-bounce"></i>
    </button>

    <script>
        // --- DARK MODE LOGIC ---
        const themeToggleBtn = document.getElementById('themeToggle');
        const html = document.documentElement;

        // Check Local Storage & System Preference
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            html.classList.add('dark');
        } else {
            html.classList.remove('dark');
        }

        // Toggle Function
        themeToggleBtn.addEventListener('click', () => {
            html.classList.toggle('dark');
            if (html.classList.contains('dark')) {
                localStorage.theme = 'dark';
            } else {
                localStorage.theme = 'light';
            }
        });

        // --- SCROLL EFFECTS ---
        document.addEventListener("scroll", () => {
            const nav = document.getElementById("nav");
            const scrollTopBtn = document.getElementById("scrollTopBtn");
            const y = window.scrollY;

            if (nav) {
                if (y > 10) nav.classList.add("scrolled");
                else nav.classList.remove("scrolled");
            }

            if (scrollTopBtn) {
                if (y > 300) scrollTopBtn.classList.add("visible");
                else scrollTopBtn.classList.remove("visible");
            }
        });

        // --- MOBILE MENU ---
        const burger = document.getElementById("navBurger");
        const mobile = document.getElementById("navMobile");

        if (burger && mobile) {
            burger.addEventListener("click", () => {
                mobile.classList.toggle("open");
            });

            mobile.querySelectorAll("a").forEach((link) => {
                link.addEventListener("click", () => {
                    mobile.classList.remove("open");
                });
            });
        }

        // --- SMOOTH SCROLL TO SECTION ---
        const scrollBtn = document.getElementById("scrollToWhy");
        const whySection = document.getElementById("why");
        if (scrollBtn && whySection) {
            scrollBtn.addEventListener("click", () => {
                whySection.scrollIntoView({ behavior: "smooth" });
            });
        }

        const scrollTopBtn = document.getElementById("scrollTopBtn");
        if (scrollTopBtn) {
            scrollTopBtn.addEventListener("click", () => {
                window.scrollTo({ top: 0, behavior: "smooth" });
            });
        }

        // --- REVEAL ANIMATION ---
        const reveals = document.querySelectorAll(".reveal");
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("in-view");
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });

        reveals.forEach((el) => revealObserver.observe(el));

        // --- SIMULATOR LOGIC ---
        const priceInput = document.getElementById("simPrice");
        const incomeInput = document.getElementById("simIncome");
        const priceLabel = document.getElementById("simPriceLabel");
        const incomeLabel = document.getElementById("simIncomeLabel");
        const monthsText = document.getElementById("simMonthsText");
        const progressFill = document.getElementById("simProgressFill");
        const progressPercent = document.getElementById("simProgressPercent");

        function formatRupiah(n) {
            return "Rp " + Number(n).toLocaleString("id-ID");
        }

        function updateSim() {
            const price = Number(priceInput.value);
            const income = Number(incomeInput.value);

            priceLabel.textContent = formatRupiah(price);
            incomeLabel.textContent = formatRupiah(income);

            if (income <= 0) return;

            const months = Math.ceil(price / income);
            let monthString = months + " Bulan";
            if (months > 24) monthString = (months/12).toFixed(1) + " Tahun";

            monthsText.innerHTML = `Butuh waktu sekitar <br><span class="text-4xl md:text-5xl font-extrabold text-white tracking-tight">${monthString}</span>.`;

            // Logic Bar
            // Asumsi "Sulit" jika butuh waktu > 12 bulan (rasio kecil)
            // Asumsi "Mudah" jika butuh waktu < 3 bulan (rasio besar)
            // Kita visualisasikan bar sebagai "Kelayakan / Kemudahan"
            
            let difficultyScore = 0;
            if (months <= 3) difficultyScore = 95;
            else if (months <= 6) difficultyScore = 80;
            else if (months <= 12) difficultyScore = 60;
            else if (months <= 24) difficultyScore = 40;
            else difficultyScore = 20;

            progressFill.style.width = `${difficultyScore}%`;
            
            let label = "";
            let colorClass = "";
            
            if (difficultyScore >= 80) {
                label = "Sangat Mudah";
                colorClass = "from-emerald-400 to-green-500";
            } else if (difficultyScore >= 60) {
                label = "Realistis";
                colorClass = "from-primary to-fuchsia-400"; // Purple theme default
            } else if (difficultyScore >= 40) {
                label = "Menantang";
                colorClass = "from-yellow-400 to-orange-500";
            } else {
                label = "Butuh Effort Lebih";
                colorClass = "from-red-500 to-pink-600";
            }

            progressPercent.textContent = label;
            progressFill.className = `h-full w-0 bg-gradient-to-r ${colorClass} transition-all duration-500 relative shadow-[0_0_15px_rgba(255,255,255,0.3)]`;
        }

        if (priceInput && incomeInput) {
            priceInput.addEventListener("input", updateSim);
            incomeInput.addEventListener("input", updateSim);
            updateSim();
        }

        // --- NUMBER COUNT UP ---
        const statsStrip = document.getElementById("statsStrip");
        const statNumbers = document.querySelectorAll(".stat-number");
        let statsAnimated = false;

        function animateStats() {
            if (statsAnimated) return;
            statsAnimated = true;

            statNumbers.forEach((el) => {
                const target = Number(el.getAttribute("data-target") || "0");
                let current = 0;
                const duration = 1500;
                const start = performance.now();

                function step(now) {
                    const progress = Math.min((now - start) / duration, 1);
                    const ease = 1 - Math.pow(1 - progress, 4); // Ease out quart
                    current = Math.floor(ease * target);
                    
                    let suffix = "+";
                    if(target === 100) suffix = "%";
                    if(target === 24) suffix = "/7";

                    el.textContent = current + suffix;
                    if (progress < 1) requestAnimationFrame(step);
                }
                requestAnimationFrame(step);
            });
        }

        if (statsStrip) {
            const statsObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        animateStats();
                        statsObserver.disconnect();
                    }
                });
            }, { threshold: 0.5 });
            statsObserver.observe(statsStrip);
        }

    </script>
</body>
</html>