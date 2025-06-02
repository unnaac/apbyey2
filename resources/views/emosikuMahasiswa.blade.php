<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>TeluSafe - Emosiku</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <script src="https://www.gstatic.com/firebasejs/9.22.0/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.22.0/firebase-auth-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.22.0/firebase-database-compat.js"></script>

    <script src="{{ asset('js/configurasi-firebase.js') }}"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'telusafe-red': '#C43B3B',
                        'telusafe-light-red': '#F44343',
                        'telusafe-pink': '#FEEAEA',
                        'telusafe-dark-red': '#A63333'
                    },
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                        'poppins': ['Poppins', 'sans-serif']
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'slide-right': 'slideRight 0.6s ease-out',
                        'bounce-gentle': 'bounceGentle 2s infinite',
                        'pulse-soft': 'pulseSoft 2s infinite',
                        'scale-in': 'scaleIn 0.4s ease-out',
                        'notification-pulse': 'notificationPulse 2s infinite',
                        'float': 'float 3s ease-in-out infinite',
                        'heart-beat': 'heartBeat 1.5s ease-in-out infinite'
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        slideRight: {
                            '0%': { opacity: '0', transform: 'translateX(-30px)' },
                            '100%': { opacity: '1', transform: 'translateX(0)' }
                        },
                        bounceGentle: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-5px)' }
                        },
                        pulseSoft: {
                            '0%, 100%': { transform: 'scale(1)' },
                            '50%': { transform: 'scale(1.05)' }
                        },
                        scaleIn: {
                            '0%': { transform: 'scale(0.9)', opacity: '0' },
                            '100%': { transform: 'scale(1)', opacity: '1' }
                        },
                        notificationPulse: {
                            '0%, 100%': { transform: 'scale(1)', opacity: '1' },
                            '50%': { transform: 'scale(1.2)', opacity: '0.8' }
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' }
                        },
                        heartBeat: {
                            '0%, 100%': { transform: 'scale(1)' },
                            '50%': { transform: 'scale(1.1)' }
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { 
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }
        
        .sidebar-active {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.25) 0%, rgba(255, 255, 255, 0.15) 100%);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        .nav-item {
            transition: all 0.3s ease;
            position: relative;
        }
        
        .nav-item:hover {
            transform: translateX(5px);
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
        }
        
        .search-focus {
            transition: all 0.3s ease;
        }
        
        .search-focus:focus {
            transform: scale(1.02);
            box-shadow: 0 8px 25px rgba(196, 59, 59, 0.15);
        }
        
        .floating-animation {
            animation: float 3s ease-in-out infinite;
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #A63333, #C43B3B, #F44343);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        /* FIXED EMOJI HOVER STYLES */
        .emoji-hover {
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform: scale(1);
            border-radius: 50%;
            padding: 8px;
            user-select: none;
            filter: grayscale(100%) opacity(0.6);
        }
        
        .emoji-hover:hover {
            transform: scale(1.2) rotate(5deg);
            text-shadow: 0 0 10px rgba(196, 59, 59, 0.5);
            filter: grayscale(50%) opacity(0.8);
        }
        
        .emoji-hover.selected {
            filter: grayscale(0%) opacity(1);
            transform: scale(1.1);
            background: rgba(196, 59, 59, 0.1);
            box-shadow: 0 0 15px rgba(196, 59, 59, 0.3);
            border: 2px solid rgba(196, 59, 59, 0.3);
        }
        
        .emoji-hover.selected:hover {
            transform: scale(1.3) rotate(5deg);
            filter: grayscale(0%) opacity(1);
            box-shadow: 0 0 20px rgba(196, 59, 59, 0.4);
        }
        
        .mood-feedback-active {
            color: #C43B3B !important;
            font-weight: 600 !important;
        }
        
        .gradient-border {
            position: relative;
            background: linear-gradient(135deg, #C43B3B, #F44343);
            border-radius: 24px;
            padding: 2px;
        }
        
        .gradient-border-inner {
            background: white;
            border-radius: 22px;
            padding: 1.5rem;
        }
        
        .celebration-particle {
            position: fixed;
            pointer-events: none;
            z-index: 1000;
        }
        
        @keyframes bounce {
            0%, 20%, 60%, 100% { transform: translateY(0) scale(1.1); }
            40% { transform: translateY(-10px) scale(1.2); }
            80% { transform: translateY(-5px) scale(1.15); }
        }
        
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 to-slate-200 min-h-screen text-gray-900 font-inter">
    <div class="flex max-w-[1440px] mx-auto rounded-3xl shadow-[0_0_40px_rgba(0,0,0,0.12)] overflow-hidden border border-gray-200 bg-white animate-scale-in">
        <!-- Sidebar -->
        <aside class="bg-gradient-to-b from-telusafe-red to-telusafe-dark-red w-56 flex flex-col p-6 space-y-8 text-white select-none animate-slide-right">
            <div class="flex items-center space-x-3 group">
                <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center group-hover:rotate-12 transition-transform duration-300">
                    <i class="fas fa-shield-alt text-telusafe-red text-lg"></i>
                </div>
                <span class="font-semibold text-lg leading-none select-text">TeluSafe</span>
            </div>
            
            <nav class="flex flex-col space-y-6 text-sm font-semibold">
                <a class="flex items-center space-x-3 text-white font-semibold nav-item rounded-lg p-2 transition-all duration-300 hover:bg-white hover:bg-opacity-20" href="#" onclick="navigateTo('home')">
                    <i class="fas fa-th-large text-white text-lg"></i>
                    <span>Beranda</span>
                </a>
                
                <div class="space-y-2">
                    <div class="flex items-center space-x-2 font-semibold text-white nav-item rounded-lg p-2 transition-all duration-300 hover:bg-white hover:bg-opacity-20">
                        <i class="fas fa-cogs text-white text-base"></i>
                        <span>PPKS</span>
                    </div>
                    <div class="flex flex-col pl-7 space-y-1 text-sm font-normal">
                        <a class="flex items-center space-x-2 hover:underline nav-item p-1 rounded" href="#" onclick="createReport()">
                            <div class="w-5 h-5 bg-white rounded flex items-center justify-center">
                                <i class="fas fa-plus text-telusafe-red text-xs"></i>
                            </div>
                            <span>Buat Laporan</span>
                        </a>
                        <a class="flex items-center space-x-2 hover:underline nav-item p-1 rounded" href="#" onclick="viewHistory()">
                            <div class="w-5 h-5 bg-white rounded flex items-center justify-center">
                                <i class="fas fa-history text-telusafe-red text-xs"></i>
                            </div>
                            <span>Riwayat Laporan</span>
                        </a>
                    </div>
                </div>
                
                <div class="space-y-2">
                    <div class="flex items-center space-x-2 font-semibold text-white nav-item rounded-lg p-2 transition-all duration-300 hover:bg-white hover:bg-opacity-20">
                        <i class="fas fa-user-friends text-white text-base"></i>
                        <span>BK</span>
                    </div>
                    <div class="flex flex-col pl-7 space-y-1 text-sm font-normal">
                        <a class="flex items-center space-x-2 hover:underline nav-item p-1 rounded" href="#" onclick="createSchedule()">
                            <div class="w-5 h-5 bg-white rounded flex items-center justify-center">
                                <i class="fas fa-calendar text-telusafe-red text-xs"></i>
                            </div>
                            <span>Buat Jadwal</span>
                        </a>
                        <a class="flex items-center space-x-2 hover:underline nav-item p-1 rounded" href="#" onclick="viewCounseling()">
                            <div class="w-5 h-5 bg-white rounded flex items-center justify-center">
                                <i class="fas fa-comments text-telusafe-red text-xs"></i>
                            </div>
                            <span>Riwayat Konseling</span>
                        </a>
                    </div>
                </div>
                
                <div class="space-y-2">
                    <div class="flex items-center space-x-2 font-semibold text-white sidebar-active p-2">
                        <i class="fas fa-smile text-white text-base"></i>
                        <span>Emosiku</span>
                    </div>
                    <div class="flex flex-col pl-7 space-y-1 text-sm font-normal">
                        <a class="flex items-center space-x-2 hover:underline nav-item p-1 rounded" href="#" onclick="createNote()">
                            <div class="w-5 h-5 bg-white rounded flex items-center justify-center">
                                <i class="fas fa-edit text-telusafe-red text-xs"></i>
                            </div>
                            <span>Buat Catatan Harian</span>
                        </a>
                        <a class="flex items-center space-x-2 hover:underline nav-item p-1 rounded" href="#" onclick="viewNotes()">
                            <div class="w-5 h-5 bg-white rounded flex items-center justify-center">
                                <i class="fas fa-book text-telusafe-red text-xs"></i>
                            </div>
                            <span>Catatan Harian</span>
                        </a>
                    </div>
                </div>
            </nav>
            
            <button aria-label="Logout" class="mt-auto flex items-center space-x-2 text-white text-sm opacity-70 hover:opacity-100 transition-all duration-300 nav-item p-2 hover:bg-red-700 rounded-lg" onclick="logout()">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
        </aside>

        <!-- Main content -->
        <main class="flex-1 p-6 space-y-6 animate-fade-in">
            <!-- Top bar -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                <div class="relative w-full md:max-w-3xl">
                    <input class="w-full rounded-full border border-gray-200 px-6 py-3 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-telusafe-red search-focus glass-effect" placeholder="🔍 Cari emosi, catatan, tanggal..." type="search" id="searchInput" oninput="handleSearch(this.value)"/>
                    <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <kbd class="px-2 py-1 text-xs bg-gray-100 rounded">Ctrl+K</kbd>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-3 glass-effect rounded-full p-2 card-hover cursor-pointer" onclick="showProfile()">
                        <img src="../assets/webStudent/iconorang 1.png" alt="User Profile" class="w-10 h-10 rounded-full object-cover"/>
                        <div class="text-right">
                            <p class="text-sm font-semibold leading-none" id="profileUsername">Loading...</p>
                            <p class="text-xs text-neutral-500 leading-none" id="profileStatus">Loading...</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard content grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <!-- Left and center content -->
                <div class="lg:col-span-9 space-y-6">
                    <!-- Emosiku Header -->
                    <section class="animate-slide-up">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-12 h-12 bg-gradient-to-br from-telusafe-red to-telusafe-light-red rounded-xl flex items-center justify-center floating-animation">
                                <i class="fas fa-heart text-white text-xl"></i>
                            </div>
                            <h1 class="text-[28px] font-bold font-poppins gradient-text">Emosiku</h1>
                        </div>
                        
                        <!-- Aksi Cepat Cards -->
                        <div class="mb-8">
                            <h2 class="text-[20px] font-semibold font-poppins mb-4 flex items-center">
                                <i class="fas fa-bolt text-telusafe-red mr-3"></i>
                                Aksi Cepat
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="gradient-border card-hover cursor-pointer" onclick="createNote()">
                                    <div class="bg-gradient-to-br from-telusafe-red via-telusafe-light-red to-telusafe-red rounded-2xl p-8 text-white flex items-center justify-center min-h-[200px] relative overflow-hidden">
                                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent transform -skew-x-12 translate-x-full group-hover:translate-x-[-200%] transition-transform duration-1000"></div>
                                        <div class="text-center z-10">
                                            <div class="mb-4 transform group-hover:scale-110 transition-transform duration-300">
                                                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-2 backdrop-blur-sm">
                                                    <i class="fas fa-edit text-white text-2xl"></i>
                                                </div>
                                            </div>
                                            <h3 class="text-[24px] font-semibold font-poppins">Catat Emosiku</h3>
                                            <p class="text-white/80 text-sm mt-2">Mulai mencatat perasaan hari ini</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="gradient-border card-hover cursor-pointer" onclick="viewNotes()">
                                    <div class="bg-gradient-to-br from-telusafe-dark-red via-telusafe-red to-telusafe-light-red rounded-2xl p-8 text-white flex items-center justify-center min-h-[200px] relative overflow-hidden">
                                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent transform -skew-x-12 translate-x-full group-hover:translate-x-[-200%] transition-transform duration-1000"></div>
                                        <div class="text-center z-10">
                                            <div class="mb-4 transform group-hover:scale-110 transition-transform duration-300">
                                                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-2 backdrop-blur-sm">
                                                    <i class="fas fa-book text-white text-2xl"></i>
                                                </div>
                                            </div>
                                            <h3 class="text-[24px] font-semibold font-poppins">Catatan Harian</h3>
                                            <p class="text-white/80 text-sm mt-2">Lihat dan kelola catatan harian</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Emotion Tracker -->
                    <section class="animate-slide-up">
                        <h2 class="text-[20px] font-semibold font-poppins mb-6 flex items-center">
                            <i class="fas fa-heart text-telusafe-red mr-3"></i>
                            Perasaan Hari Ini
                        </h2>
                        
                        <div class="glass-effect rounded-xl p-8 shadow-[0_4px_20px_rgba(0,0,0,0.08)] card-hover cursor-pointer">
                            <div class="flex items-center justify-center mb-6">
                                <div class="w-16 h-16 bg-gradient-to-br from-telusafe-pink to-red-100 rounded-2xl flex items-center justify-center">
                                    <i class="fas fa-heart text-telusafe-red text-2xl"></i>
                                </div>
                            </div>
                            
                            <h3 class="text-[20px] font-semibold font-poppins text-center mb-6 gradient-text">Bagaimana perasaanmu hari ini?</h3>
                            
                            <div class="flex justify-center space-x-4 text-4xl mb-6" id="emoji-container">
                                <span aria-label="Angry face emoji" class="emoji-hover" role="button" tabindex="0" data-emo="angry" title="Marah">😠</span>
                                <span aria-label="Sad face emoji" class="emoji-hover" role="button" tabindex="0" data-emo="sad" title="Sedih">😞</span>
                                <span aria-label="Neutral face emoji" class="emoji-hover" role="button" tabindex="0" data-emo="neutral" title="Biasa">😐</span>
                                <span aria-label="Happy face emoji" class="emoji-hover" role="button" tabindex="0" data-emo="happy" title="Senang">🙂</span>
                                <span aria-label="Very happy face emoji" class="emoji-hover" role="button" tabindex="0" data-emo="very-happy" title="Sangat Senang">😄</span>
                            </div>
                            
                            <div class="text-center">
                                <p class="text-sm text-gray-500 mb-4" id="mood-text">Pilih emoji yang sesuai dengan perasaanmu</p>
                                <button id="save-mood-btn" class="bg-gradient-to-r from-telusafe-red to-telusafe-light-red text-white px-6 py-3 rounded-2xl font-medium hover:shadow-lg transition-all duration-300 hover:scale-105 transform opacity-50 cursor-not-allowed" disabled>
                                    <i class="fas fa-save mr-2"></i>
                                    Simpan Perasaan
                                </button>
                            </div>
                        </div>
                    </section>

                    <!-- Recent Activity -->
                    <section class="animate-slide-up">
                        <h2 class="text-[20px] font-semibold font-poppins mb-6 flex items-center">
                            <i class="fas fa-history text-telusafe-red mr-3"></i>
                            Aktivitas Terbaru
                        </h2>
                        
                        <div class="glass-effect rounded-xl p-6 shadow-[0_4px_20px_rgba(0,0,0,0.08)]">
                            <div class="space-y-4" id="recent-activity">
                                <div class="flex items-center space-x-4 p-4 bg-white/50 rounded-2xl border border-white/30">
                                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                        <span class="text-2xl">😄</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-800">Perasaan sangat senang</p>
                                        <p class="text-sm text-gray-500">Hari ini, 14:30</p>
                                    </div>
                                    <i class="fas fa-chevron-right text-gray-400"></i>
                                </div>
                                
                                <div class="flex items-center space-x-4 p-4 bg-white/50 rounded-2xl border border-white/30">
                                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-book text-blue-600"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-800">Catatan harian dibuat</p>
                                        <p class="text-sm text-gray-500">Kemarin, 19:15</p>
                                    </div>
                                    <i class="fas fa-chevron-right text-gray-400"></i>
                                </div>
                                
                                <div class="flex items-center space-x-4 p-4 bg-white/50 rounded-2xl border border-white/30">
                                    <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                                        <span class="text-2xl">🙂</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-800">Perasaan senang</p>
                                        <p class="text-sm text-gray-500">2 hari yang lalu, 16:45</p>
                                    </div>
                                    <i class="fas fa-chevron-right text-gray-400"></i>
                                </div>
                            </div>
                            
                            <div class="text-center mt-6">
                                <button class="bg-white border border-telusafe-red text-telusafe-red px-6 py-3 rounded-2xl hover:bg-telusafe-pink transition-all duration-300 font-medium hover:scale-105 transform" onclick="viewAllActivity()">
                                    <i class="fas fa-eye mr-2"></i>
                                    Lihat Semua Aktivitas
                                </button>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Right sidebar -->
                <aside class="lg:col-span-3 space-y-6">
                    <div class="glass-effect rounded-xl p-4 shadow-[0_4px_20px_rgba(0,0,0,0.08)]">
                        <h3 class="font-bold text-base mb-4 flex items-center">
                            <i class="fas fa-newspaper text-telusafe-red mr-2"></i>
                            Tips Kesehatan Mental
                        </h3>
                        <div class="bg-white rounded-xl shadow-[0_4px_15px_rgba(0,0,0,0.08)] overflow-hidden card-hover cursor-pointer" onclick="showTips()">
                            <div class="h-40 bg-gradient-to-br from-telusafe-red to-telusafe-light-red flex items-center justify-center">
                                <i class="fas fa-brain text-white text-4xl"></i>
                            </div>
                            <div class="p-4">
                                <h4 class="text-sm font-semibold leading-tight mb-2">Tips Mengelola Emosi</h4>
                                <p class="text-xs text-gray-600">Pelajari cara sehat mengelola perasaan sehari-hari</p>
                                <div class="flex items-center justify-between mt-3">
                                    <span class="text-xs text-gray-500">Artikel terbaru</span>
                                    <i class="fas fa-arrow-right text-telusafe-red"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Mood Statistics -->
                    <div class="glass-effect rounded-xl p-4 shadow-[0_4px_20px_rgba(0,0,0,0.08)]">
                        <h4 class="font-semibold text-sm mb-4 flex items-center">
                            <i class="fas fa-chart-pie text-telusafe-red mr-2"></i>
                            Statistik Mood
                        </h4>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-2">
                                    <span class="text-lg">😄</span>
                                    <span class="text-xs text-gray-600">Sangat Senang</span>
                                </div>
                                <span class="font-semibold text-telusafe-red">40%</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-2">
                                    <span class="text-lg">🙂</span>
                                    <span class="text-xs text-gray-600">Senang</span>
                                </div>
                                <span class="font-semibold text-telusafe-red">35%</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-2">
                                    <span class="text-lg">😐</span>
                                    <span class="text-xs text-gray-600">Biasa</span>
                                </div>
                                <span class="font-semibold text-telusafe-red">20%</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-2">
                                    <span class="text-lg">😞</span>
                                    <span class="text-xs text-gray-600">Sedih</span>
                                </div>
                                <span class="font-semibold text-gray-600">5%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="glass-effect rounded-xl p-4 shadow-[0_4px_20px_rgba(0,0,0,0.08)]">
                        <h4 class="font-semibold text-sm mb-4 flex items-center">
                            <i class="fas fa-bolt text-telusafe-red mr-2"></i>
                            Aksi Cepat
                        </h4>
                        <div class="space-y-3">
                            <button class="w-full text-left p-3 rounded-lg bg-gradient-to-r from-telusafe-red to-telusafe-light-red text-white card-hover text-sm font-medium" onclick="createNote()">
                                <i class="fas fa-edit mr-2"></i>
                                Catat Emosi Hari Ini
                            </button>
                            <button class="w-full text-left p-3 rounded-lg border border-gray-200 hover:border-telusafe-red card-hover text-sm font-medium" onclick="viewNotes()">
                                <i class="fas fa-book mr-2 text-telusafe-red"></i>
                                Lihat Catatan Harian
                            </button>
                            <button class="w-full text-left p-3 rounded-lg border border-gray-200 hover:border-telusafe-red card-hover text-sm font-medium" onclick="viewAllActivity()">
                                <i class="fas fa-history mr-2 text-telusafe-red"></i>
                                Lihat Riwayat
                            </button>
                        </div>
                    </div>
                </aside>
            </div>
        </main>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="fixed top-4 right-4 bg-white border-l-4 border-telusafe-red rounded-lg shadow-lg p-4 transform translate-x-full transition-transform duration-300 z-50">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-3" id="toast-icon"></i>
            <div>
                <p class="font-semibold text-sm" id="toast-title">Success!</p>
                <p class="text-xs text-gray-600" id="toast-message">Action completed successfully!</p>
            </div>
        </div>
    </div>

    <script>
        // Initialize the application
        document.addEventListener('DOMContentLoaded', function() {
            initializeEmotionSelector();
            initializeToastSystem();
            console.log('Emosiku page loaded successfully');
            
            // Search keyboard shortcut
            document.addEventListener('keydown', (e) => {
                if (e.ctrlKey && e.key === 'k') {
                    e.preventDefault();
                    document.getElementById('searchInput').focus();
                }
            });
            const auth = firebase.auth();
            const database = firebase.database();

            auth.onAuthStateChanged(function(user) {
                const profileUsernameElement = document.getElementById('profileUsername');
                const profileStatusElement = document.getElementById('profileStatus');
                const profileInitialElement = document.getElementById('profileInitial'); // Untuk inisial

                if (user) {
                    console.log('User UID (buatJadwalMahasiswa - Profil):', user.uid);
                    database.ref('users/' + user.uid).once('value')
                        .then(function(snapshot) {
                            if (snapshot.exists()) {
                                const userData = snapshot.val();
                                const usernameUntukProfil = userData.username || 'Username';
                                const status = userData.status || 'Status tidak diketahui';

                                if (profileUsernameElement) {
                                    profileUsernameElement.textContent = usernameUntukProfil;
                                } else {
                                    console.error("Elemen #profileUsername tidak ditemukan di buatJadwalMahasiswa!");
                                }

                                if (profileStatusElement) {
                                    const formattedStatus = status.charAt(0).toUpperCase() + status.slice(1);
                                    profileStatusElement.textContent = formattedStatus;
                                } else {
                                    console.error("Elemen #profileStatus tidak ditemukan di buatJadwalMahasiswa!");
                                }
                                
                                // Update inisial jika ada
                                if (profileInitialElement && usernameUntukProfil !== 'Username' && usernameUntukProfil.length > 0) {
                                    profileInitialElement.textContent = usernameUntukProfil.charAt(0).toUpperCase();
                                } else if (profileInitialElement) {
                                    profileInitialElement.textContent = 'U'; // Default jika username tidak ada
                                }

                            } else {
                                console.warn('Data pengguna tidak ditemukan untuk UID:', user.uid, 'di buatJadwalMahasiswa');
                                if (profileUsernameElement) profileUsernameElement.textContent = 'User';
                                if (profileStatusElement) profileStatusElement.textContent = 'N/A';
                                if (profileInitialElement) profileInitialElement.textContent = 'U';
                            }
                        })
                        .catch(function(error) {
                            console.error('Gagal mengambil data profil pengguna di buatJadwalMahasiswa:', error);
                            if (profileUsernameElement) profileUsernameElement.textContent = 'Error';
                            if (profileStatusElement) profileStatusElement.textContent = 'Error';
                            if (profileInitialElement) profileInitialElement.textContent = 'E';
                        });
                } else {
                    console.log('Pengguna belum login di buatJadwalMahasiswa.');
                    if (profileUsernameElement) profileUsernameElement.textContent = 'Guest';
                    if (profileStatusElement) profileStatusElement.textContent = '-';
                    if (profileInitialElement) profileInitialElement.textContent = 'G';
                     // Pertimbangkan untuk mengarahkan ke halaman login jika halaman ini memerlukan login
                    // window.location.href = '{{ url('/login') }}';
                }
            });
        });

        // Emotion selector functionality
        function initializeEmotionSelector() {
            const emojis = document.querySelectorAll('.emoji-hover');
            const moodText = document.getElementById('mood-text');
            const saveBtn = document.getElementById('save-mood-btn');
            
            emojis.forEach(emoji => {
                emoji.addEventListener('click', () => {
                    // Remove selected class from all emojis
                    emojis.forEach(e => e.classList.remove('selected'));
                    
                    // Add selected class to clicked emoji
                    emoji.classList.add('selected');
                    
                    // Create celebration effect
                    createCelebration(emoji);
                    
                    // Update UI
                    const moodName = emoji.getAttribute('title');
                    moodText.textContent = `Kamu merasa ${moodName.toLowerCase()} hari ini`;
                    moodText.classList.add('mood-feedback-active');
                    
                    // Enable save button
                    saveBtn.disabled = false;
                    saveBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    saveBtn.classList.add('hover:scale-105');
                    
                    // Add bounce animation
                    emoji.style.animation = 'bounce 0.6s ease-out';
                    setTimeout(() => {
                        emoji.style.animation = '';
                    }, 600);
                    
                    // Show immediate feedback
                    showToast('Perasaan Dipilih!', `Kamu merasa ${moodName.toLowerCase()}`, 'success');
                });
                
                // Keyboard accessibility
                emoji.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        emoji.click();
                    }
                });
            });

            // Save mood button
            saveBtn.addEventListener('click', function() {
                const selectedEmoji = document.querySelector('.emoji-hover.selected');
                if (selectedEmoji) {
                    const moodName = selectedEmoji.getAttribute('title');
                    
                    // Simulate saving
                    this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
                    this.disabled = true;
                    
                    setTimeout(() => {
                        this.innerHTML = '<i class="fas fa-check mr-2"></i>Tersimpan!';
                        showToast('Berhasil!', `Perasaan ${moodName.toLowerCase()} telah disimpan`, 'success');
                        
                        // Add to recent activity
                        addToRecentActivity(selectedEmoji.textContent, moodName);
                        
                        // Reset after delay
                        setTimeout(() => {
                            this.innerHTML = '<i class="fas fa-save mr-2"></i>Simpan Perasaan';
                            this.disabled = false;
                            
                            // Reset selection
                            emojis.forEach(e => e.classList.remove('selected'));
                            moodText.textContent = 'Pilih emoji yang sesuai dengan perasaanmu';
                            moodText.classList.remove('mood-feedback-active');
                            this.disabled = true;
                            this.classList.add('opacity-50', 'cursor-not-allowed');
                            this.classList.remove('hover:scale-105');
                        }, 2000);
                    }, 1500);
                }
            });
        }

        // Toast notification system
        function initializeToastSystem() {
            window.showToast = function(title, message, type = 'success') {
                const toast = document.getElementById('toast');
                const toastTitle = document.getElementById('toast-title');
                const toastMessage = document.getElementById('toast-message');
                const toastIcon = document.getElementById('toast-icon');
                
                // Reset classes
                toastIcon.className = 'fas mr-3';
                toast.className = 'fixed top-4 right-4 bg-white rounded-lg shadow-lg p-4 transform transition-transform duration-300 z-50';
                
                // Set content and styling based on type
                switch(type) {
                    case 'success':
                        toastIcon.className += ' fa-check-circle text-green-500';
                        toast.className += ' border-l-4 border-green-500';
                        break;
                    case 'warning':
                        toastIcon.className += ' fa-exclamation-triangle text-yellow-500';
                        toast.className += ' border-l-4 border-yellow-500';
                        break;
                    case 'info':
                        toastIcon.className += ' fa-info-circle text-blue-500';
                        toast.className += ' border-l-4 border-blue-500';
                        break;
                    case 'error':
                        toastIcon.className += ' fa-times-circle text-red-500';
                        toast.className += ' border-l-4 border-red-500';
                        break;
                }
                
                toastTitle.textContent = title;
                toastMessage.textContent = message;
                
                // Show toast
                toast.style.transform = 'translateX(0)';
                
                // Hide after 4 seconds
                setTimeout(() => {
                    toast.style.transform = 'translateX(100%)';
                }, 4000);
            };
        }

        // Celebration effects
        function createCelebration(element) {
            const rect = element.getBoundingClientRect();
            const centerX = rect.left + rect.width / 2;
            const centerY = rect.top + rect.height / 2;
            
            // Create heart particles
            for (let i = 0; i < 8; i++) {
                const particle = document.createElement('div');
                particle.className = 'celebration-particle';
                particle.innerHTML = '❤️';
                particle.style.left = centerX + 'px';
                particle.style.top = centerY + 'px';
                particle.style.fontSize = '12px';
                
                const angle = (i * 45) * Math.PI / 180;
                const distance = 60;
                const endX = centerX + Math.cos(angle) * distance;
                const endY = centerY + Math.sin(angle) * distance;
                
                document.body.appendChild(particle);
                
                particle.animate([
                    { transform: 'translate(0, 0) scale(1)', opacity: 1 },
                    { transform: `translate(${endX - centerX}px, ${endY - centerY}px) scale(0)`, opacity: 0 }
                ], {
                    duration: 1000,
                    easing: 'ease-out'
                }).onfinish = () => {
                    document.body.removeChild(particle);
                };
            }
        }

        function addToRecentActivity(emoji, moodName) {
            const activityContainer = document.getElementById('recent-activity');
            const now = new Date();
            const timeString = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
            
            // Create new activity item
            const newActivity = document.createElement('div');
            newActivity.className = 'flex items-center space-x-4 p-4 bg-white/50 rounded-2xl border border-white/30';
            newActivity.innerHTML = `
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <span class="text-2xl">${emoji}</span>
                </div>
                <div class="flex-1">
                    <p class="font-medium text-gray-800">Perasaan ${moodName.toLowerCase()}</p>
                    <p class="text-sm text-gray-500">Hari ini, ${timeString}</p>
                </div>
                <i class="fas fa-chevron-right text-gray-400"></i>
            `;
            
            // Insert at the beginning
            activityContainer.insertBefore(newActivity, activityContainer.firstChild);
            
            // Keep only 3 items
            while (activityContainer.children.length > 3) {
                activityContainer.removeChild(activityContainer.lastChild);
            }
        }

        // Navigation functions
        function navigateTo(page) {
            showToast('Navigation', `Navigating to ${page}...`, 'info');
            if (page === 'home') {
                window.location.href = 'dashboard';
            }
        }

        function createReport() {
          showToast('Report Creation', 'Opening report creation form...', 'info');
          setTimeout(() => {
            window.location.href = 'buatLaporanMahasiswa';
          }, 1000);
        }

        function viewHistory() {
            showToast('History', 'Loading report history...', 'info');
            setTimeout(() => {
                window.location.href = 'riwayatLaporanMahasiswa';
            }, 1000);
        }

        function createSchedule() {
            showToast('Schedule', 'Opening schedule creation...', 'info');
            setTimeout(() => {
                window.location.href = 'buatJadwalMahasiswa';
            }, 1000);
        }

        function viewCounseling() {
            showToast('Counseling', 'Loading counseling history...', 'info');
            setTimeout(() => {
                window.location.href = 'riwayatKonselingMahasiswa';
            }, 1000);
        }

        function createNote() {
            showToast('Daily Note', 'Opening daily note creator...', 'info');
            setTimeout(() => {
                window.location.href = 'buatCatatanMahasiswa';
            }, 1000);
        }

        function viewNotes() {
            showToast('Notes', 'Loading your daily notes...', 'info');
            setTimeout(() => {
                window.location.href = 'riwayatCatatanMahasiswa';
            }, 1000);
        }

        function showProfile() {
            showToast('Profile', 'Opening user profile...', 'info');
            setTimeout(() => {
                window.location.href = 'profile';
            }, 1000);
        }

        function showNotifications() {
            showToast('Notifications', 'Loading notifications...', 'info');
        }

        function showTips() {
            showToast('Mental Health Tips', 'Opening mental health tips...', 'info');
        }

        function viewAllActivity() {
            showToast('Activity History', 'Loading all activities...', 'info');
        }

        function handleSearch(query) {
            if (query.length > 0) {
                showToast('Search', `Searching for: ${query}`, 'info');
            }
        }

        function logout() {
            if (confirm('Apakah Anda yakin ingin logout?')) {
                showToast('Logout', 'Logging out...', 'warning');
                setTimeout(() => {
                    showToast('Goodbye', 'Stay healthy and take care!', 'success');
                    window.location.href = 'login';
                }, 1000);
            }
        }
    </script>
</body>
</html>