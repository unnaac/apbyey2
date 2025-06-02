<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>TeluSafe - Beranda Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"/>
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
                        'notification-pulse': 'notificationPulse 2s infinite'
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
        
        .stat-card {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }
        
        .stat-card:hover::before {
            left: 100%;
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
        
        .notification-dot {
            animation: notificationPulse 2s infinite;
        }
        
        .floating-animation {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .stagger-animation > * {
            opacity: 0;
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        .stagger-animation > *:nth-child(1) { animation-delay: 0.1s; }
        .stagger-animation > *:nth-child(2) { animation-delay: 0.2s; }
        .stagger-animation > *:nth-child(3) { animation-delay: 0.3s; }
        .stagger-animation > *:nth-child(4) { animation-delay: 0.4s; }
        .stagger-animation > *:nth-child(5) { animation-delay: 0.5s; }
        .stagger-animation > *:nth-child(6) { animation-delay: 0.6s; }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 to-slate-200 min-h-screen text-gray-900 font-inter">
    <div class="flex max-w-[1440px] mx-auto rounded-3xl shadow-[0_0_40px_rgba(0,0,0,0.12)] overflow-hidden border border-gray-200 bg-white animate-scale-in">
        <!-- Sidebar -->
        <aside class="bg-gradient-to-b from-telusafe-red to-telusafe-dark-red w-56 flex flex-col p-6 space-y-8 text-white select-none animate-slide-right">
            <div class="flex items-center space-x-3 group">
                <img src="../assets/Logo.png" alt="TeluSafe Logo" class="w-8 h-8 object-contain group-hover:rotate-12 transition-transform duration-300"/>
                <span class="font-semibold text-lg leading-none select-text">TeluSafe</span>
            </div>
            
            <nav class="flex flex-col space-y-6 text-sm font-semibold stagger-animation">
                <div class="flex items-center space-x-3 text-white font-semibold sidebar-active p-2">
                    <i class="fas fa-th-large text-white text-lg"></i>
                    <span>Beranda</span>
                </div>
                
                <div class="space-y-2">
                    <a class="flex items-center space-x-2 font-semibold text-white nav-item rounded-lg p-2 transition-all duration-300 hover:bg-white hover:bg-opacity-20" href="#" onclick="navigateTo('ppks')">
                        <i class="fas fa-shield-alt text-white text-base"></i>
                        <span>PPKS</span>
                    </a>
                </div>
                
                <div class="space-y-2">
                    <a class="flex items-center space-x-2 font-semibold text-white nav-item rounded-lg p-2 transition-all duration-300 hover:bg-white hover:bg-opacity-20" href="#" onclick="navigateTo('bk')">
                        <i class="fas fa-user-friends text-white text-base"></i>
                        <span>Bimbingan Konseling</span>
                    </a>
                </div>
                
                <div class="space-y-2">
                    <a class="flex items-center space-x-2 font-semibold text-white nav-item rounded-lg p-2 transition-all duration-300 hover:bg-white hover:bg-opacity-20" href="#" onclick="navigateTo('emosi')">
                        <i class="fas fa-heart text-white text-base"></i>
                        <span>Emosi Mahasiswa</span>
                    </a>
                </div>
                
                <div class="space-y-2">
                    <a class="flex items-center space-x-2 font-semibold text-white nav-item rounded-lg p-2 transition-all duration-300 hover:bg-white hover:bg-opacity-20" href="#" onclick="navigateTo('artikel')">
                        <i class="fas fa-newspaper text-white text-base"></i>
                        <span>Artikel</span>
                    </a>
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
                    <input class="w-full rounded-full border border-gray-200 px-6 py-3 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-telusafe-red search-focus glass-effect" placeholder="🔍 Search reports, data, or analytics..." type="search" id="searchInput" oninput="handleSearch(this.value)"/>
                    <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <kbd class="px-2 py-1 text-xs bg-gray-100 rounded">Ctrl+K</kbd>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-3 glass-effect rounded-full p-2 card-hover cursor-pointer" onclick="showProfile()">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-telusafe-red to-telusafe-light-red flex items-center justify-center text-white font-bold">
                            MQ
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-semibold leading-none">Musfiq</p>
                            <p class="text-xs text-gray-500 leading-none">Admin</p>
                        </div>
                    </div>
                    <button aria-label="Notifications" class="relative text-xl glass-effect p-3 rounded-full card-hover" onclick="showNotifications()">
                        <i class="fas fa-bell text-gray-600"></i>
                        <div class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full notification-dot"></div>
                    </button>
                </div>
            </div>

            <!-- Dashboard content grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <!-- Left and center content -->
                <div class="lg:col-span-9 space-y-6">
                    <!-- Dashboard Header -->
                    <section class="animate-slide-up">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-12 h-12 bg-gradient-to-br from-telusafe-red to-telusafe-light-red rounded-xl flex items-center justify-center floating-animation">
                                <i class="fas fa-tachometer-alt text-white text-xl"></i>
                            </div>
                            <h1 class="text-[28px] font-bold font-poppins bg-gradient-to-r from-telusafe-red to-telusafe-light-red bg-clip-text text-transparent">
                                Admin Dashboard - TeluSafe
                            </h1>
                        </div>
                    </section>

                    <!-- PPKS Statistics -->
                    <section class="animate-slide-up">
                        <h2 class="text-[20px] font-semibold font-poppins mb-6 flex items-center">
                            <i class="fas fa-shield-alt text-telusafe-red mr-3"></i>
                            PPKS Telkom University
                            <button class="ml-auto flex items-center space-x-2 text-[#0B1340] text-xs border border-gray-200 rounded-md px-3 py-1 hover:bg-gray-50 transition card-hover" onclick="exportData('ppks')">
                                <i class="fas fa-download text-xs"></i>
                                <span>Export</span>
                            </button>
                        </h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 stagger-animation">
                            <div class="glass-effect rounded-xl p-6 shadow-[0_4px_20px_rgba(0,0,0,0.08)] stat-card card-hover cursor-pointer" onclick="showDetails('total-reports')">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="bg-gradient-to-br from-red-100 to-red-200 p-3 rounded-xl">
                                        <i class="fas fa-chart-bar text-telusafe-red text-xl"></i>
                                    </div>
                                    <div class="text-blue-500 text-sm font-medium">
                                        <i class="fas fa-arrow-up"></i> +8%
                                    </div>
                                </div>
                                <div class="text-left">
                                    <p class="text-[32px] font-bold font-poppins text-gray-800 counter" data-count="1000">0</p>
                                    <p class="text-[14px] font-medium font-poppins text-gray-700">Jumlah Laporan</p>
                                    <p class="text-xs text-blue-500 mt-1">+8% from yesterday</p>
                                </div>
                            </div>
                            
                            <div class="glass-effect rounded-xl p-6 shadow-[0_4px_20px_rgba(0,0,0,0.08)] stat-card card-hover cursor-pointer" onclick="showDetails('created-reports')">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="bg-gradient-to-br from-yellow-100 to-yellow-200 p-3 rounded-xl">
                                        <i class="fas fa-file-alt text-yellow-600 text-xl"></i>
                                    </div>
                                    <div class="text-blue-500 text-sm font-medium">
                                        <i class="fas fa-arrow-up"></i> +5%
                                    </div>
                                </div>
                                <div class="text-left">
                                    <p class="text-[32px] font-bold font-poppins text-gray-800 counter" data-count="300">0</p>
                                    <p class="text-[14px] font-medium font-poppins text-gray-700">Laporan Dibuat</p>
                                    <p class="text-xs text-blue-500 mt-1">+5% from yesterday</p>
                                </div>
                            </div>
                            
                            <div class="glass-effect rounded-xl p-6 shadow-[0_4px_20px_rgba(0,0,0,0.08)] stat-card card-hover cursor-pointer" onclick="showDetails('processing-reports')">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="bg-gradient-to-br from-green-100 to-green-200 p-3 rounded-xl">
                                        <i class="fas fa-cog text-green-600 text-xl"></i>
                                    </div>
                                    <div class="text-blue-500 text-sm font-medium">
                                        <i class="fas fa-arrow-up"></i> +1.2%
                                    </div>
                                </div>
                                <div class="text-left">
                                    <p class="text-[32px] font-bold font-poppins text-gray-800 counter" data-count="5">0</p>
                                    <p class="text-[14px] font-medium font-poppins text-gray-700">Laporan Diproses</p>
                                    <p class="text-xs text-blue-500 mt-1">+1.2% from yesterday</p>
                                </div>
                            </div>
                            
                            <div class="glass-effect rounded-xl p-6 shadow-[0_4px_20px_rgba(0,0,0,0.08)] stat-card card-hover cursor-pointer" onclick="showDetails('completed-reports')">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="bg-gradient-to-br from-purple-100 to-purple-200 p-3 rounded-xl">
                                        <i class="fas fa-check-circle text-purple-600 text-xl"></i>
                                    </div>
                                    <div class="text-blue-500 text-sm font-medium">
                                        <i class="fas fa-arrow-up"></i> +0.5%
                                    </div>
                                </div>
                                <div class="text-left">
                                    <p class="text-[32px] font-bold font-poppins text-gray-800 counter" data-count="8">0</p>
                                    <p class="text-[14px] font-medium font-poppins text-gray-700">Laporan Selesai</p>
                                    <p class="text-xs text-blue-500 mt-1">+0.5% from yesterday</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Bimbingan Konseling Statistics -->
                    <section class="animate-slide-up">
                        <h2 class="text-[20px] font-semibold font-poppins mb-6 flex items-center">
                            <i class="fas fa-user-friends text-telusafe-red mr-3"></i>
                            Bimbingan Konseling
                            <button class="ml-auto flex items-center space-x-2 text-[#0B1340] text-xs border border-gray-200 rounded-md px-3 py-1 hover:bg-gray-50 transition card-hover" onclick="exportData('bk')">
                                <i class="fas fa-download text-xs"></i>
                                <span>Export</span>
                            </button>
                        </h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 stagger-animation">
                            <div class="glass-effect rounded-xl p-6 shadow-[0_4px_20px_rgba(0,0,0,0.08)] stat-card card-hover cursor-pointer" onclick="showDetails('counseling-students')">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="bg-gradient-to-br from-red-100 to-red-200 p-3 rounded-xl">
                                        <i class="fas fa-users text-telusafe-red text-xl"></i>
                                    </div>
                                </div>
                                <div class="text-left">
                                    <p class="text-[32px] font-bold font-poppins text-gray-800 counter" data-count="100">0</p>
                                    <p class="text-[14px] font-medium font-poppins text-gray-700">Mahasiswa Konseling</p>
                                </div>
                            </div>
                            
                            <div class="glass-effect rounded-xl p-6 shadow-[0_4px_20px_rgba(0,0,0,0.08)] stat-card card-hover cursor-pointer" onclick="showDetails('psychologists')">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="bg-gradient-to-br from-yellow-100 to-yellow-200 p-3 rounded-xl">
                                        <i class="fas fa-user-md text-yellow-600 text-xl"></i>
                                    </div>
                                </div>
                                <div class="text-left">
                                    <p class="text-[32px] font-bold font-poppins text-gray-800 counter" data-count="10">0</p>
                                    <p class="text-[14px] font-medium font-poppins text-gray-700">Psikolog</p>
                                </div>
                            </div>
                            
                            <div class="glass-effect rounded-xl p-6 shadow-[0_4px_20px_rgba(0,0,0,0.08)] stat-card card-hover cursor-pointer" onclick="showDetails('new-counseling')">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="bg-gradient-to-br from-green-100 to-green-200 p-3 rounded-xl">
                                        <i class="fas fa-plus-circle text-green-600 text-xl"></i>
                                    </div>
                                </div>
                                <div class="text-left">
                                    <p class="text-[32px] font-bold font-poppins text-gray-800 counter" data-count="5">0</p>
                                    <p class="text-[14px] font-medium font-poppins text-gray-700">Konseling Baru</p>
                                </div>
                            </div>
                            
                            <div class="glass-effect rounded-xl p-6 shadow-[0_4px_20px_rgba(0,0,0,0.08)] stat-card card-hover cursor-pointer" onclick="showDetails('follow-up-counseling')">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="bg-gradient-to-br from-purple-100 to-purple-200 p-3 rounded-xl">
                                        <i class="fas fa-redo text-purple-600 text-xl"></i>
                                    </div>
                                </div>
                                <div class="text-left">
                                    <p class="text-[32px] font-bold font-poppins text-gray-800 counter" data-count="8">0</p>
                                    <p class="text-[14px] font-medium font-poppins text-gray-700">Konseling Lanjutan</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Emosi Mahasiswa Statistics -->
                    <section class="animate-slide-up">
                        <h2 class="text-[20px] font-semibold font-poppins mb-6 flex items-center">
                            <i class="fas fa-heart text-telusafe-red mr-3"></i>
                            Emosi Mahasiswa
                            <button class="ml-auto flex items-center space-x-2 text-[#0B1340] text-xs border border-gray-200 rounded-md px-3 py-1 hover:bg-gray-50 transition card-hover" onclick="exportData('emosi')">
                                <i class="fas fa-download text-xs"></i>
                                <span>Export</span>
                            </button>
                        </h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 stagger-animation">
                            <div class="glass-effect rounded-xl p-6 shadow-[0_4px_20px_rgba(0,0,0,0.08)] stat-card card-hover cursor-pointer" onclick="showDetails('total-students')">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="bg-gradient-to-br from-red-100 to-red-200 p-3 rounded-xl">
                                        <i class="fas fa-graduation-cap text-telusafe-red text-xl"></i>
                                    </div>
                                </div>
                                <div class="text-left">
                                    <p class="text-[32px] font-bold font-poppins text-gray-800 counter" data-count="1000">0</p>
                                    <p class="text-[14px] font-medium font-poppins text-gray-700">Jumlah Mahasiswa</p>
                                </div>
                            </div>
                            
                            <div class="glass-effect rounded-xl p-6 shadow-[0_4px_20px_rgba(0,0,0,0.08)] stat-card card-hover cursor-pointer" onclick="showDetails('special-attention')">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="bg-gradient-to-br from-yellow-100 to-yellow-200 p-3 rounded-xl">
                                        <i class="fas fa-exclamation-triangle text-yellow-600 text-xl"></i>
                                    </div>
                                </div>
                                <div class="text-left">
                                    <p class="text-[32px] font-bold font-poppins text-gray-800 counter" data-count="300">0</p>
                                    <p class="text-[14px] font-medium font-poppins text-gray-700">Butuh Perhatian Khusus</p>
                                </div>
                            </div>
                            
                            <div class="glass-effect rounded-xl p-6 shadow-[0_4px_20px_rgba(0,0,0,0.08)] stat-card card-hover cursor-pointer" onclick="showDetails('help-sent')">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="bg-gradient-to-br from-green-100 to-green-200 p-3 rounded-xl">
                                        <i class="fas fa-hands-helping text-green-600 text-xl"></i>
                                    </div>
                                </div>
                                <div class="text-left">
                                    <p class="text-[32px] font-bold font-poppins text-gray-800 counter" data-count="5">0</p>
                                    <p class="text-[14px] font-medium font-poppins text-gray-700">Bantuan Terkirim</p>
                                </div>
                            </div>
                            
                            <div class="glass-effect rounded-xl p-6 shadow-[0_4px_20px_rgba(0,0,0,0.08)] stat-card card-hover cursor-pointer" onclick="showDetails('emotion-trends')">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="bg-gradient-to-br from-purple-100 to-purple-200 p-3 rounded-xl">
                                        <i class="fas fa-chart-line text-purple-600 text-xl"></i>
                                    </div>
                                </div>
                                <div class="text-left">
                                    <p class="text-[32px] font-bold font-poppins text-gray-800 counter" data-count="8">0</p>
                                    <p class="text-[14px] font-medium font-poppins text-gray-700">Tren Emosi Mahasiswa</p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Right sidebar -->
                <aside class="lg:col-span-3 space-y-6 animate-slide-up">
                    <div class="glass-effect rounded-xl p-4 shadow-[0_4px_20px_rgba(0,0,0,0.08)]">
                        <h3 class="font-bold text-base mb-4 flex items-center">
                            <i class="fas fa-newspaper text-telusafe-red mr-2"></i>
                            Berita Telkom University
                        </h3>
                        <div class="bg-white rounded-xl shadow-[0_4px_15px_rgba(0,0,0,0.08)] overflow-hidden card-hover cursor-pointer" onclick="readNews()">
                            <div class="h-40 bg-gradient-to-br from-telusafe-red to-telusafe-light-red flex items-center justify-center">
                                <i class="fas fa-user-friends text-white text-4xl"></i>
                            </div>
                            <div class="p-4">
                                <h4 class="text-sm font-semibold leading-tight mb-2">Begini Cara Menggunakan Layanan BK</h4>
                                <p class="text-xs text-gray-600">Panduan lengkap untuk mengakses layanan bimbingan konseling di Telkom University</p>
                                <div class="flex items-center justify-between mt-3">
                                    <span class="text-xs text-gray-500">2 jam yang lalu</span>
                                    <i class="fas fa-arrow-right text-telusafe-red"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Actions for Admin -->
                    <div class="glass-effect rounded-xl p-4 shadow-[0_4px_20px_rgba(0,0,0,0.08)]">
                        <h3 class="font-bold text-base mb-4 flex items-center">
                            <i class="fas fa-bolt text-telusafe-red mr-2"></i>
                            Admin Actions
                        </h3>
                        <div class="space-y-3">
                            <button class="w-full text-left p-3 rounded-lg bg-gradient-to-r from-telusafe-red to-telusafe-light-red text-white card-hover text-sm font-medium" onclick="manageReports()">
                                <i class="fas fa-tasks mr-2"></i>
                                Manage Reports
                            </button>
                            <button class="w-full text-left p-3 rounded-lg border border-gray-200 hover:border-telusafe-red card-hover text-sm font-medium" onclick="viewAnalytics()">
                                <i class="fas fa-chart-bar mr-2 text-telusafe-red"></i>
                                View Analytics
                            </button>
                            <button class="w-full text-left p-3 rounded-lg border border-gray-200 hover:border-telusafe-red card-hover text-sm font-medium" onclick="generateReport()">
                                <i class="fas fa-file-export mr-2 text-telusafe-red"></i>
                                Generate Report
                            </button>
                            <button class="w-full text-left p-3 rounded-lg border border-gray-200 hover:border-telusafe-red card-hover text-sm font-medium" onclick="systemSettings()">
                                <i class="fas fa-cog mr-2 text-telusafe-red"></i>
                                System Settings
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
            <i class="fas fa-check-circle text-green-500 mr-3"></i>
            <span id="toast-message">Action completed successfully!</span>
        </div>
    </div>

    <script>
        // Initialize animations and interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Counter animation
            const counters = document.querySelectorAll('.counter');
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-count'));
                let current = 0;
                const increment = target / 30;
                
                const updateCounter = () => {
                    current += increment;
                    if (current < target) {
                        counter.textContent = Math.floor(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target;
                    }
                };
                
                // Trigger animation when element is in view
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            updateCounter();
                            observer.unobserve(entry.target);
                        }
                    });
                });
                
                observer.observe(counter);
            });

            // Search keyboard shortcut
            document.addEventListener('keydown', (e) => {
                if (e.ctrlKey && e.key === 'k') {
                    e.preventDefault();
                    document.getElementById('searchInput').focus();
                }
            });
        });

        // Interactive functions
        function navigateTo(section) {
            showToast(`Navigating to ${section} section...`, 'info');
        }

        function exportData(section) {
            showToast(`Exporting ${section} data...`, 'info');
        }

        function showDetails(type) {
            showToast(`Showing detailed view for ${type}...`, 'info');
        }

        function showProfile() {
            showToast('Opening admin profile...', 'info');
        }

        function showNotifications() {
            showToast('Loading admin notifications...', 'info');
        }

        function readNews() {
            showToast('Opening news article...', 'info');
        }

        function manageReports() {
            showToast('Opening report management interface...', 'info');
        }

        function viewAnalytics() {
            showToast('Loading analytics dashboard...', 'info');
        }

        function generateReport() {
            showToast('Generating comprehensive report...', 'warning');
        }

        function systemSettings() {
            showToast('Opening system settings...', 'info');
        }

        function handleSearch(query) {
            if (query.length > 2) {
                showToast(`Searching admin data for: ${query}`, 'info');
            }
        }

        function logout() {
            showToast('Logging out admin session...', 'warning');
            setTimeout(() => {
                showToast('Admin session ended. Goodbye!', 'success');
            }, 1000);
        }

        function showToast(message, type = 'success') {
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toast-message');
            const icon = toast.querySelector('i');
            
            // Reset classes
            icon.className = 'fas mr-3';
            toast.className = 'fixed top-4 right-4 bg-white rounded-lg shadow-lg p-4 transform transition-transform duration-300 z-50';
            
            // Set icon and border color based on type
            switch(type) {
                case 'success':
                    icon.className += ' fa-check-circle text-green-500';
                    toast.className += ' border-l-4 border-green-500';
                    break;
                case 'warning':
                    icon.className += ' fa-exclamation-triangle text-yellow-500';
                    toast.className += ' border-l-4 border-yellow-500';
                    break;
                case 'info':
                    icon.className += ' fa-info-circle text-blue-500';
                    toast.className += ' border-l-4 border-blue-500';
                    break;
                case 'error':
                    icon.className += ' fa-times-circle text-red-500';
                    toast.className += ' border-l-4 border-red-500';
                    break;
            }
            
            toastMessage.textContent = message;
            
            // Show toast
            toast.style.transform = 'translateX(0)';
            
            // Hide after 3 seconds
            setTimeout(() => {
                toast.style.transform = 'translateX(100%)';
            }, 3000);
        }

        // Add ripple effect to buttons
        document.addEventListener('click', function(e) {
            if (e.target.matches('button, .card-hover')) {
                const ripple = document.createElement('span');
                const rect = e.target.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');
                
                e.target.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            }
        });
    </script>
</body>
</html>