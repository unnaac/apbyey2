<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>TeluSafe - Emosiku Admin</title>
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
        
        .table-hover tbody tr {
            transition: all 0.3s ease;
        }
        
        .table-hover tbody tr:hover {
            background: linear-gradient(135deg, rgba(196, 59, 59, 0.05) 0%, rgba(244, 67, 67, 0.05) 100%);
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }
        
        /* Custom scrollbar */
        .scrollbar-thin::-webkit-scrollbar {
            height: 6px;
            width: 6px;
        }
        .scrollbar-thin::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 10px;
        }
        .scrollbar-thin::-webkit-scrollbar-track {
            background-color: transparent;
        }
        
        .mood-critical { 
            animation: pulse-soft 2s infinite;
        }
        
        .emoji-large {
            font-size: 1.5rem;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 to-slate-200 min-h-screen text-gray-900 font-inter">
    <div class="flex max-w-[1440px] mx-auto rounded-3xl shadow-[0_0_40px_rgba(0,0,0,0.12)] overflow-hidden border border-gray-200 bg-white animate-scale-in">
        <!-- Sidebar -->
        <aside class="bg-gradient-to-b from-telusafe-red to-telusafe-dark-red w-56 flex flex-col p-6 space-y-8 text-white select-none animate-slide-right">
            <div class="flex items-center space-x-3 group">
                <img src="/assets/webadmin/Logo.png" alt="TeluSafe Logo" class="w-8 h-8 object-contain group-hover:rotate-12 transition-transform duration-300"/>
                <span class="font-semibold text-lg leading-none select-text">TeluSafe</span>
            </div>
            
            <nav class="flex flex-col space-y-6 text-sm font-semibold stagger-animation">
                <a class="flex items-center space-x-3 text-white font-semibold nav-item rounded-lg p-2 transition-all duration-300 hover:bg-white hover:bg-opacity-20" href="#" onclick="navigateTo('home')">
                    <i class="fas fa-th-large text-white text-lg"></i>
                    <span>Beranda</span>
                </a>
                
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
                    <div class="flex items-center space-x-2 font-semibold text-white sidebar-active p-2">
                        <i class="fas fa-heart text-white text-base"></i>
                        <span>Emosi Mahasiswa</span>
                    </div>
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
        <main class="flex-1 p-6 space-y-6 animate-fade-in overflow-auto">
            <!-- Top bar -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-telusafe-red to-telusafe-light-red rounded-xl flex items-center justify-center floating-animation">
                        <i class="fas fa-heart text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-[28px] font-bold font-poppins bg-gradient-to-r from-telusafe-red to-telusafe-light-red bg-clip-text text-transparent">
                            Emosiku Admin Dashboard
                        </h1>
                        <p class="text-sm text-gray-500">Monitoring Kesehatan Mental Mahasiswa</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <!-- <div class="relative w-full md:max-w-md">
                        <input class="w-full rounded-full border border-gray-200 px-6 py-3 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-telusafe-red search-focus glass-effect" placeholder="🔍 Cari mahasiswa..." type="search" id="searchInput" oninput="handleSearch(this.value)"/>
                        <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <kbd class="px-2 py-1 text-xs bg-gray-100 rounded">Ctrl+K</kbd>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-3 glass-effect rounded-full p-2 card-hover cursor-pointer" onclick="showProfile()">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-telusafe-red to-telusafe-light-red flex items-center justify-center text-white font-bold">
                            MQ
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-semibold leading-none">Musfiq</p>
                            <p class="text-xs text-gray-500 leading-none">Emosiku Admin</p>
                        </div>
                    </div> -->
                    <!-- <button aria-label="Notifications" class="relative text-xl glass-effect p-3 rounded-full card-hover" onclick="showNotifications()">
                        <i class="fas fa-bell text-gray-600"></i>
                        <div class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full notification-dot"></div>
                    </button> -->
                </div>
            </div>

            <!-- Quick Actions -->
            <!-- <div class="grid grid-cols-1 md:grid-cols-3 gap-4 animate-slide-up">
                <button class="glass-effect rounded-xl p-4 card-hover text-left" onclick="sendMoodAlert()">
                    <div class="flex items-center space-x-3">
                        <div class="bg-gradient-to-br from-telusafe-red to-telusafe-light-red p-3 rounded-xl">
                            <i class="fas fa-exclamation-triangle text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Kirim Peringatan Mood</h3>
                            <p class="text-sm text-gray-500">Alert untuk mahasiswa berisiko</p>
                        </div>
                    </div>
                </button>
                
                <select class="glass-effect rounded-xl p-4 card-hover focus:outline-none focus:ring-2 focus:ring-telusafe-red" id="moodFilter" onchange="filterByMood(this.value)">
                    <option value="">Semua Emosi</option>
                    <option value="angry">😠 Marah</option>
                    <option value="sad">😞 Sedih</option>
                    <option value="neutral">😐 Biasa</option>
                    <option value="happy">🙂 Senang</option>
                    <option value="very-happy">😄 Sangat Senang</option>
                </select>
                
                <select class="glass-effect rounded-xl p-4 card-hover focus:outline-none focus:ring-2 focus:ring-telusafe-red" id="riskFilter" onchange="filterByRisk(this.value)">
                    <option value="">Semua Kategori</option>
                    <option value="critical">Kritis</option>
                    <option value="attention">Perlu Perhatian</option>
                    <option value="stable">Stabil</option>
                    <option value="positive">Positif</option>
                </select>
            </div> -->

            <!-- Dashboard content -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <!-- Emotion Statistics -->
                <div class="lg:col-span-8 space-y-6">
                    <section class="animate-slide-up">
                        <div class="glass-effect rounded-xl p-6 shadow-[0_4px_20px_rgba(0,0,0,0.08)]">
                            <div class="flex justify-between items-center mb-6">
                                <div>
                                    <h2 class="text-[20px] font-semibold font-poppins text-gray-800">Statistik Emosi Mahasiswa</h2>
                                    <p class="text-sm text-gray-500 mt-1">Data Kesehatan Mental Keseluruhan</p>
                                </div>
                                <!-- <button class="flex items-center space-x-2 text-gray-600 text-sm border border-gray-200 rounded-md px-4 py-2 hover:bg-gray-50 transition card-hover" onclick="exportData()">
                                    <i class="fas fa-download text-sm"></i>
                                    <span>Export</span>
                                </button> -->
                            </div>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 stagger-animation">
                                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4 stat-card card-hover cursor-pointer" onclick="analisaEmosiku()">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-2 rounded-full">
                                            <i class="fas fa-users text-white text-sm"></i>
                                        </div>
                                        <!-- <div class="text-green-500 text-sm font-medium">
                                            <i class="fas fa-arrow-up"></i> +12%
                                        </div> -->
                                    </div>
                                    <div class="text-left" id="totalMood">
                                        <p class="text-[24px] font-bold font-poppins text-gray-800 counter" data-count="847">0</p>
                                        <p class="text-[12px] font-medium text-gray-600">Total Emosiku</p>
                                    </div>
                                </div>
                                
                                <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-xl p-4 stat-card card-hover cursor-pointer" onclick="showDetails('critical-mood')">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="bg-gradient-to-br from-telusafe-red to-telusafe-light-red p-2 rounded-full">
                                            <i class="fas fa-exclamation-triangle text-white text-sm"></i>
                                        </div>
                                        <!-- <div class="text-red-500 text-sm font-medium">
                                            <i class="fas fa-arrow-up"></i> +3%
                                        </div> -->
                                    </div>
                                    <div class="text-left" id="criticalMood">
                                        <p class="text-[24px] font-bold font-poppins text-gray-800 counter" data-count="23">0</p>
                                        <p class="text-[12px] font-medium text-gray-600">Perlu Perhatian</p>
                                        <p class="text-xs text-gray-500 mt-1">Mood kritis/negatif</p>
                                    </div>
                                </div>
                                
                                <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl p-4 stat-card card-hover cursor-pointer" onclick="showDetails('average-mood')">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 p-2 rounded-full">
                                            <i class="fas fa-chart-line text-white text-sm"></i>
                                        </div>
                                        <!-- <div class="text-green-500 text-sm font-medium">
                                            <i class="fas fa-arrow-up"></i> +0.4
                                        </div> -->
                                    </div>
                                    <div class="text-left" id="averageMood">
                                        <p class="text-[24px] font-bold font-poppins text-gray-800 counter" data-count="37">0</p>
                                        <p class="text-[12px] font-medium text-gray-600">Rata-rata Mood</p>
                                        <p class="text-xs text-gray-500 mt-1" id="rata-ratamood">3.7/5.0 (🙂 Senang)</p>
                                    </div>
                                </div>
                                
                                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-4 stat-card card-hover cursor-pointer" onclick="showDetails('positive-trend')">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="bg-gradient-to-br from-green-500 to-green-600 p-2 rounded-full">
                                            <i class="fas fa-smile text-white text-sm"></i>
                                        </div>
                                        <!-- <div class="text-green-500 text-sm font-medium">
                                            <i class="fas fa-arrow-up"></i> +42
                                        </div> -->
                                    </div>
                                    <div class="text-left" id="positiveMood">
                                        <p class="text-[24px] font-bold font-poppins text-gray-800 counter" data-count="431">0</p>
                                        <p class="text-[12px] font-medium text-gray-600">Mood Positif</p>
                                        <p class="text-xs text-gray-500 mt-1">Senang & sangat senang</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Emotion Trend Chart -->
                <!-- <div class="lg:col-span-4 animate-slide-up">
                    <div class="glass-effect rounded-xl p-6 shadow-[0_4px_20px_rgba(0,0,0,0.08)] h-fit">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-[18px] font-semibold font-poppins text-gray-800">Tren Emosi Mahasiswa</h3>
                            <div class="flex items-center space-x-2 text-xs">
                            </div>
                        </div>
                        <div class="w-full">
                            <svg class="w-full h-56" viewBox="0 0 400 220" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <linearGradient id="bgGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                        <stop offset="0%" style="stop-color:#f8fafc;stop-opacity:1"/>
                                        <stop offset="100%" style="stop-color:#f1f5f9;stop-opacity:1"/>
                                    </linearGradient>
                                    
                                    <linearGradient id="happyZone" x1="0%" y1="0%" x2="0%" y2="100%">
                                        <stop offset="0%" style="stop-color:#10b981;stop-opacity:0.1"/>
                                        <stop offset="100%" style="stop-color:#10b981;stop-opacity:0"/>
                                    </linearGradient>
                                    
                                    <linearGradient id="neutralZone" x1="0%" y1="0%" x2="0%" y2="100%">
                                        <stop offset="0%" style="stop-color:#f59e0b;stop-opacity:0.1"/>
                                        <stop offset="100%" style="stop-color:#f59e0b;stop-opacity:0"/>
                                    </linearGradient>
                                    
                                    <linearGradient id="sadZone" x1="0%" y1="0%" x2="0%" y2="100%">
                                        <stop offset="0%" style="stop-color:#ef4444;stop-opacity:0.1"/>
                                        <stop offset="100%" style="stop-color:#ef4444;stop-opacity:0"/>
                                    </linearGradient>
                                    
                                    <linearGradient id="emotionTrendGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                        <stop offset="0%" style="stop-color:#8b5cf6;stop-opacity:0.4"/>
                                        <stop offset="50%" style="stop-color:#f59e0b;stop-opacity:0.3"/>
                                        <stop offset="100%" style="stop-color:#ef4444;stop-opacity:0.2"/>
                                    </linearGradient>
                                </defs>
                                <rect width="400" height="220" fill="url(#bgGradient)" rx="8"/>
                                
                                <rect x="40" y="30" width="320" height="40" fill="url(#happyZone)" rx="2"/>
                                <rect x="40" y="80" width="320" height="30" fill="url(#neutralZone)" rx="2"/>
                                <rect x="40" y="130" width="320" height="50" fill="url(#sadZone)" rx="2"/>
                                
                                <line stroke="#e2e8f0" stroke-width="1" stroke-dasharray="2,2" x1="40" x2="360" y1="45" y2="45"/>
                                <line stroke="#e2e8f0" stroke-width="1" stroke-dasharray="2,2" x1="40" x2="360" y1="70" y2="70"/>
                                <line stroke="#e2e8f0" stroke-width="1" stroke-dasharray="2,2" x1="40" x2="360" y1="95" y2="95"/>
                                <line stroke="#e2e8f0" stroke-width="1" stroke-dasharray="2,2" x1="40" x2="360" y1="120" y2="120"/>
                                <line stroke="#e2e8f0" stroke-width="1" stroke-dasharray="2,2" x1="40" x2="360" y1="145" y2="145"/>
                                <line stroke="#e2e8f0" stroke-width="1" stroke-dasharray="2,2" x1="40" x2="360" y1="170" y2="170"/>
                                
                                <path d="M40 130 Q50 125 60 128 T80 135 Q90 140 100 138 T120 132 Q130 125 140 120 T160 115 Q170 108 180 105 T200 108 Q210 112 220 115 T240 118 Q250 115 260 110 T280 105 Q290 100 300 95 T320 88 Q330 83 340 80 T360 75 L360 180 L40 180 Z" 
                                      fill="url(#emotionTrendGradient)" opacity="0.6"/>
                                
                                <path d="M40 130 Q50 125 60 128 T80 135 Q90 140 100 138 T120 132 Q130 125 140 120 T160 115 Q170 108 180 105 T200 108 Q210 112 220 115 T240 118 Q250 115 260 110 T280 105 Q290 100 300 95 T320 88 Q330 83 340 80 T360 75" 
                                      stroke="#8b5cf6" stroke-width="3" fill="none" stroke-linecap="round"/>

                                <circle cx="80" cy="135" fill="#ef4444" r="4" stroke="white" stroke-width="2" opacity="0.8"/>
                                <circle cx="120" cy="132" fill="#f59e0b" r="4" stroke="white" stroke-width="2" opacity="0.8"/>
                                <circle cx="160" cy="115" fill="#f59e0b" r="4" stroke="white" stroke-width="2" opacity="0.8"/>
                                <circle cx="200" cy="108" fill="#10b981" r="4" stroke="white" stroke-width="2" opacity="0.8"/>
                                <circle cx="240" cy="118" fill="#f59e0b" r="4" stroke="white" stroke-width="2" opacity="0.8"/>
                                <circle cx="280" cy="105" fill="#10b981" r="4" stroke="white" stroke-width="2" opacity="0.8"/>
                                <circle cx="320" cy="88" fill="#10b981" r="5" stroke="white" stroke-width="2"/>
                                <circle cx="360" cy="75" fill="#8b5cf6" r="6" stroke="white" stroke-width="2" class="animate-pulse"/>
                                
                                <rect x="70" y="25" width="60" height="8" fill="#fecaca" rx="4" opacity="0.7"/>
                                <text fill="#dc2626" font-family="Inter, sans-serif" font-size="8" font-weight="bold" text-anchor="middle" x="100" y="20">Critical Period</text>

                                <rect x="270" y="25" width="80" height="8" fill="#bbf7d0" rx="4" opacity="0.7"/>
                                <text fill="#059669" font-family="Inter, sans-serif" font-size="8" font-weight="bold" text-anchor="middle" x="310" y="20">Improvement</text>
                                
                                <path d="M350 82 L358 78 L354 86 Z" fill="#8b5cf6" opacity="0.8"/>
                                <text fill="#8b5cf6" font-family="Inter, sans-serif" font-size="8" font-weight="bold" x="345" y="76">↗</text>
                                
                                <text fill="#6B7280" font-family="Inter, sans-serif" font-size="9" text-anchor="middle" x="60" y="200">W1</text>
                                <text fill="#6B7280" font-family="Inter, sans-serif" font-size="9" text-anchor="middle" x="100" y="200">W2</text>
                                <text fill="#6B7280" font-family="Inter, sans-serif" font-size="9" text-anchor="middle" x="140" y="200">W3</text>
                                <text fill="#6B7280" font-family="Inter, sans-serif" font-size="9" text-anchor="middle" x="180" y="200">W4</text>
                                <text fill="#6B7280" font-family="Inter, sans-serif" font-size="9" text-anchor="middle" x="220" y="200">W5</text>
                                <text fill="#6B7280" font-family="Inter, sans-serif" font-size="9" text-anchor="middle" x="260" y="200">W6</text>
                                <text fill="#6B7280" font-family="Inter, sans-serif" font-size="9" text-anchor="middle" x="300" y="200">W7</text>
                                <text fill="#6B7280" font-family="Inter, sans-serif" font-size="9" text-anchor="middle" x="340" y="200">W8</text>
                                
                                <line stroke="#cbd5e1" stroke-width="1" stroke-dasharray="4,2" x1="140" x2="140" y1="30" y2="180" opacity="0.5"/>
                                <line stroke="#cbd5e1" stroke-width="1" stroke-dasharray="4,2" x1="260" x2="260" y1="30" y2="180" opacity="0.5"/>
                                
                                <text fill="#374151" font-family="Inter, sans-serif" font-size="10" font-weight="600" text-anchor="middle" x="90" y="215">Juli</text>
                                <text fill="#374151" font-family="Inter, sans-serif" font-size="10" font-weight="600" text-anchor="middle" x="200" y="215">Agustus</text>
                                <text fill="#374151" font-family="Inter, sans-serif" font-size="10" font-weight="600" text-anchor="middle" x="310" y="215">September</text>
                                
                                <g transform="translate(25, 0)">
                                    <text fill="#10b981" font-family="Inter, sans-serif" font-size="12" text-anchor="middle" x="0" y="50">😄</text>
                                    <text fill="#6b7280" font-family="Inter, sans-serif" font-size="8" text-anchor="middle" x="0" y="60">5.0</text>
                                    
                                    <text fill="#22c55e" font-family="Inter, sans-serif" font-size="12" text-anchor="middle" x="0" y="75">🙂</text>
                                    <text fill="#6b7280" font-family="Inter, sans-serif" font-size="8" text-anchor="middle" x="0" y="85">4.0</text>
                                    
                                    <text fill="#f59e0b" font-family="Inter, sans-serif" font-size="12" text-anchor="middle" x="0" y="100">😐</text>
                                    <text fill="#6b7280" font-family="Inter, sans-serif" font-size="8" text-anchor="middle" x="0" y="110">3.0</text>
                                    
                                    <text fill="#f97316" font-family="Inter, sans-serif" font-size="12" text-anchor="middle" x="0" y="125">😞</text>
                                    <text fill="#6b7280" font-family="Inter, sans-serif" font-size="8" text-anchor="middle" x="0" y="135">2.0</text>
                                    
                                    <text fill="#ef4444" font-family="Inter, sans-serif" font-size="12" text-anchor="middle" x="0" y="150">😠</text>
                                    <text fill="#6b7280" font-family="Inter, sans-serif" font-size="8" text-anchor="middle" x="0" y="160">1.0</text>
                                </g>
                            </svg>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4 mt-6">
                            <div>
                                <h4 class="text-sm font-semibold text-gray-700 mb-3">Distribusi Minggu Ini</h4>
                                <div class="space-y-2 text-xs">
                                    <div class="flex items-center justify-between p-2 bg-green-50 rounded-lg">
                                        <div class="flex items-center gap-2">
                                            <span class="text-lg">😄</span>
                                            <span class="text-gray-700 font-medium">Sangat Senang</span>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-bold text-green-600">142</div>
                                            <div class="text-green-500 text-xs">↗ +18</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between p-2 bg-blue-50 rounded-lg">
                                        <div class="flex items-center gap-2">
                                            <span class="text-lg">🙂</span>
                                            <span class="text-gray-700 font-medium">Senang</span>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-bold text-blue-600">289</div>
                                            <div class="text-blue-500 text-xs">↗ +24</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between p-2 bg-yellow-50 rounded-lg">
                                        <div class="flex items-center gap-2">
                                            <span class="text-lg">😐</span>
                                            <span class="text-gray-700 font-medium">Biasa</span>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-bold text-gray-600">324</div>
                                            <div class="text-gray-500 text-xs">↘ -12</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between p-2 bg-orange-50 rounded-lg">
                                        <div class="flex items-center gap-2">
                                            <span class="text-lg">😞</span>
                                            <span class="text-gray-700 font-medium">Sedih</span>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-bold text-orange-600">76</div>
                                            <div class="text-red-500 text-xs">↘ -8</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between p-2 bg-red-50 rounded-lg">
                                        <div class="flex items-center gap-2">
                                            <span class="text-lg">😠</span>
                                            <span class="text-gray-700 font-medium">Marah</span>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-bold text-red-600">16</div>
                                            <div class="text-red-500 text-xs">↘ -3</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <h4 class="text-sm font-semibold text-gray-700 mb-3">Insight Tren</h4>
                                <div class="space-y-3 text-xs">
                                    <div class="p-3 bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg border-l-4 border-purple-500">
                                        <div class="font-semibold text-purple-800 mb-1">Rata-rata Saat Ini</div>
                                        <div class="text-2xl font-bold text-purple-600">3.7 / 5.0</div>
                                        <div class="text-purple-600 mt-1">
                                            <i class="fas fa-arrow-up mr-1"></i>+0.4 dari bulan lalu
                                        </div>
                                    </div>
                                    
                                    <div class="p-2 bg-green-50 rounded-lg">
                                        <div class="flex items-center text-green-700">
                                            <i class="fas fa-trending-up mr-2"></i>
                                            <span class="font-medium">Tren Positif</span>
                                        </div>
                                        <div class="text-green-600 mt-1">8 minggu berturut-turut meningkat</div>
                                    </div>
                                    
                                    <div class="p-2 bg-blue-50 rounded-lg">
                                        <div class="flex items-center text-blue-700">
                                            <i class="fas fa-calendar-week mr-2"></i>
                                            <span class="font-medium">Pola Mingguan</span>
                                        </div>
                                        <div class="text-blue-600 mt-1">Senin-Rabu: Rendah<br/>Kamis-Minggu: Tinggi</div>
                                    </div>
                                    
                                    <div class="p-2 bg-amber-50 rounded-lg border border-amber-200">
                                        <div class="flex items-center text-amber-700">
                                            <i class="fas fa-exclamation-circle mr-2"></i>
                                            <span class="font-medium">Perhatian</span>
                                        </div>
                                        <div class="text-amber-600 mt-1">23 mahasiswa butuh perhatian khusus</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>

            <section class="animate-slide-up">
                <div class="glass-effect rounded-xl p-6 shadow-[0_4px_20px_rgba(0,0,0,0.08)] overflow-x-auto scrollbar-thin">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-[18px] font-semibold font-poppins text-gray-800">Monitoring Emosi Mahasiswa</h3>
                        <div class="flex space-x-3">
                            <!-- <button class="bg-gradient-to-r from-telusafe-red to-telusafe-light-red text-white px-4 py-2 rounded-lg card-hover text-sm font-medium" onclick="bulkCounselingRecommendation()">
                                <i class="fas fa-heart mr-2"></i>
                                Rekomendasi Konseling
                            </button> -->
                            <button class="border border-gray-200 text-gray-600 px-4 py-2 rounded-lg card-hover text-sm font-medium" onclick="refreshTable()">
                                <i class="fas fa-sync-alt mr-2"></i>
                                Refresh
                            </button>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-gray-600 table-hover">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="font-semibold px-4 py-3 text-gray-800">
                                        <input type="checkbox" class="rounded border-gray-300" onchange="selectAll(this)">
                                    </th>
                                    <th class="font-semibold px-4 py-3 text-gray-800">Mahasiswa</th>
                                    <th class="font-semibold px-4 py-3 text-gray-800">Mood Saat Ini</th>
                                    <th class="font-semibold px-4 py-3 text-gray-800">Tren 7 Hari</th>
                                    <th class="font-semibold px-4 py-3 text-gray-800">Rata-rata</th>
                                    <th class="font-semibold px-4 py-3 text-gray-800">Terakhir Update</th>
                                    <th class="font-semibold px-4 py-3 text-gray-800">Status</th>
                                </tr>
                            </thead>
                            <tbody id="tabelEmosiku" class="stagger-animation">
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition-all duration-300">
                                    <td class="px-4 py-4">
                                        <input type="checkbox" class="rounded border-gray-300">
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                                A
                                            </div>
                                            <div>
                                                <div class="font-semibold text-gray-900">Ahmad Fauzi</div>
                                                <div class="text-xs text-gray-500">2021001234</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center space-x-2">
                                            <span class="text-2xl">😞</span>
                                            <span class="text-sm font-medium text-gray-700">Sedih</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex space-x-1">
                                            <span class="text-sm">😞</span>
                                            <span class="text-sm">😠</span>
                                            <span class="text-sm">😞</span>
                                            <span class="text-sm">😐</span>
                                            <span class="text-sm">😞</span>
                                            <span class="text-sm">😞</span>
                                            <span class="text-sm">😞</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="text-sm font-medium text-orange-600">2.1/5</span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="text-xs text-gray-500">2 jam lalu</span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="bg-red-100 text-red-800 text-xs font-medium px-2 py-1 rounded-full mood-critical">
                                            <i class="fas fa-exclamation-triangle mr-1"></i>Perlu Perhatian
                                        </span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex gap-2">
                                            <button class="text-blue-600 hover:text-blue-800 transition-colors card-hover p-1" onclick="viewMoodHistory('2021001234')" title="Lihat Riwayat">
                                                <i class="fas fa-chart-line"></i>
                                            </button>
                                            <button class="text-green-600 hover:text-green-800 transition-colors card-hover p-1" onclick="recommendCounseling('2021001234')" title="Rekomendasikan Konseling">
                                                <i class="fas fa-user-md"></i>
                                            </button>
                                            <button class="text-purple-600 hover:text-purple-800 transition-colors card-hover p-1" onclick="sendCareMessage('2021001234')" title="Kirim Pesan Peduli">
                                                <i class="fas fa-heart"></i>
                                            </button>
                                            <button class="text-orange-600 hover:text-orange-800 transition-colors card-hover p-1" onclick="flagForReview('2021001234')" title="Tandai untuk Review">
                                                <i class="fas fa-flag"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition-all duration-300">
                                    <td class="px-4 py-4">
                                        <input type="checkbox" class="rounded border-gray-300">
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                                S
                                            </div>
                                            <div>
                                                <div class="font-semibold text-gray-900">Siti Nurhaliza</div>
                                                <div class="text-xs text-gray-500">2021005678</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center space-x-2">
                                            <span class="text-2xl">😄</span>
                                            <span class="text-sm font-medium text-gray-700">Sangat Senang</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex space-x-1">
                                            <span class="text-sm">🙂</span>
                                            <span class="text-sm">😄</span>
                                            <span class="text-sm">🙂</span>
                                            <span class="text-sm">😄</span>
                                            <span class="text-sm">😄</span>
                                            <span class="text-sm">🙂</span>
                                            <span class="text-sm">😄</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="text-sm font-medium text-green-600">4.4/5</span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="text-xs text-gray-500">30 menit lalu</span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded-full">
                                            <i class="fas fa-smile mr-1"></i>Sangat Baik
                                        </span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex gap-2">
                                            <button class="text-blue-600 hover:text-blue-800 transition-colors card-hover p-1" onclick="viewMoodHistory('2021005678')" title="Lihat Riwayat">
                                                <i class="fas fa-chart-line"></i>
                                            </button>
                                            <button class="text-gray-400 cursor-not-allowed p-1" title="Tidak perlu konseling" disabled>
                                                <i class="fas fa-user-md"></i>
                                            </button>
                                            <button class="text-green-600 hover:text-green-800 transition-colors card-hover p-1" onclick="sendCongratulation('2021005678')" title="Kirim Apresiasi">
                                                <i class="fas fa-thumbs-up"></i>
                                            </button>
                                            <button class="text-gray-400 cursor-not-allowed p-1" title="Tidak perlu review" disabled>
                                                <i class="fas fa-flag"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition-all duration-300">
                                    <td class="px-4 py-4">
                                        <input type="checkbox" class="rounded border-gray-300">
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                                R
                                            </div>
                                            <div>
                                                <div class="font-semibold text-gray-900">Rudi Hartono</div>
                                                <div class="text-xs text-gray-500">2021009876</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center space-x-2">
                                            <span class="text-2xl">😐</span>
                                            <span class="text-sm font-medium text-gray-700">Biasa</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex space-x-1">
                                            <span class="text-sm">😐</span>
                                            <span class="text-sm">🙂</span>
                                            <span class="text-sm">😐</span>
                                            <span class="text-sm">😐</span>
                                            <span class="text-sm">😞</span>
                                            <span class="text-sm">😐</span>
                                            <span class="text-sm">😐</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="text-sm font-medium text-gray-600">2.9/5</span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="text-xs text-gray-500">1 jam lalu</span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-1 rounded-full">
                                            <i class="fas fa-eye mr-1"></i>Perlu Observasi
                                        </span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex gap-2">
                                            <button class="text-blue-600 hover:text-blue-800 transition-colors card-hover p-1" onclick="viewMoodHistory('2021009876')" title="Lihat Riwayat">
                                                <i class="fas fa-chart-line"></i>
                                            </button>
                                            <button class="text-yellow-600 hover:text-yellow-800 transition-colors card-hover p-1" onclick="scheduleMoodCheck('2021009876')" title="Jadwalkan Cek Mood">
                                                <i class="fas fa-calendar-check"></i>
                                            </button>
                                            <button class="text-blue-600 hover:text-blue-800 transition-colors card-hover p-1" onclick="sendEncouragement('2021009876')" title="Kirim Motivasi">
                                                <i class="fas fa-comment-alt"></i>
                                            </button>
                                            <button class="text-gray-400 cursor-not-allowed p-1" title="Belum perlu review" disabled>
                                                <i class="fas fa-flag"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <!-- <div class="flex items-center justify-between mt-6">
                        <div class="text-sm text-gray-500">
                            Menampilkan 1-3 dari 847 mahasiswa
                        </div>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 border border-gray-300 rounded text-sm hover:bg-gray-50 card-hover" onclick="previousPage()">
                                <i class="fas fa-chevron-left mr-1"></i>Previous
                            </button>
                            <button class="px-3 py-1 bg-telusafe-red text-white rounded text-sm">1</button>
                            <button class="px-3 py-1 border border-gray-300 rounded text-sm hover:bg-gray-50 card-hover" onclick="nextPage()">
                                Next<i class="fas fa-chevron-right ml-1"></i>
                            </button>
                        </div>
                    </div> -->
                </div>
            </section>
        </main>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="fixed top-4 right-4 bg-white border-l-4 border-telusafe-red rounded-lg shadow-lg p-4 transform translate-x-full transition-transform duration-300 z-50">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-3"></i>
            <span id="toast-message">Action completed successfully!</span>
        </div>
    </div>
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-app-compat.js"></script>    
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-auth-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-database-compat.js"></script>
    <script src="js/configurasi-firebase.js"></script>
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
            if (section === 'ppks') {
                window.location.href = '/ppksadmin';
            } else if (section === 'bk') {
                window.location.href = '/bkadmin';
            } else if (section === 'artikel') {
                window.location.href = '/artikeladmin';
            } else if (section === 'home') {
                window.location.href = '/beranda';
            }
        }

        function sendMoodAlert() {
            showToast('Mengirim peringatan kepada mahasiswa dengan mood kritis...', 'warning');
        }

        function filterByMood(mood) {
            const moodNames = {
                'angry': 'Marah 😠',
                'sad': 'Sedih 😞',
                'neutral': 'Biasa 😐',
                'happy': 'Senang 🙂',
                'very-happy': 'Sangat Senang 😄'
            };
            showToast(`Filtering by mood: ${moodNames[mood] || 'All'}`, 'info');
        }

        function filterByRisk(risk) {
            showToast(`Filtering by risk level: ${risk || 'All'}`, 'info');
        }

        function exportData() {
            showToast('Exporting emotion data...', 'info');
        }

        function showDetails(type) {
            showToast(`Showing detailed view for ${type}...`, 'info');
        }

        function showProfile() {
            showToast('Opening admin profile...', 'info');
        }

        function showNotifications() {
            showToast('Loading notifications...', 'info');
        }

        function viewMoodHistory(studentId) {
            showToast(`Opening mood history for student ${studentId}...`, 'info');
        }

        function recommendCounseling(studentId) {
            showToast(`Recommending counseling for student ${studentId}...`, 'warning');
        }

        function sendCareMessage(studentId) {
            showToast(`Sending care message to student ${studentId}...`, 'success');
        }

        function flagForReview(studentId) {
            showToast(`Flagging student ${studentId} for mental health review...`, 'error');
        }

        function sendCongratulation(studentId) {
            showToast(`Sending congratulation message to student ${studentId}...`, 'success');
        }

        function scheduleMoodCheck(studentId) {
            showToast(`Scheduling mood check reminder for student ${studentId}...`, 'info');
        }

        function sendEncouragement(studentId) {
            showToast(`Sending encouragement message to student ${studentId}...`, 'success');
        }

        function bulkCounselingRecommendation() {
            showToast('Processing bulk counseling recommendations...', 'info');
        }

        function refreshTable() {
            showToast('Refreshing student mood data...', 'info');
        }

        function selectAll(checkbox) {
            const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');
            checkboxes.forEach(cb => cb.checked = checkbox.checked);
            showToast(`${checkbox.checked ? 'Selected' : 'Deselected'} all students`, 'info');
        }

        function previousPage() {
            showToast('Loading previous page...', 'info');
        }

        function nextPage() {
            showToast('Loading next page...', 'info');
        }

        function handleSearch(query) {
            if (query.length > 2) {
                showToast(`Searching students for: ${query}`, 'info');
            }
        }

        function logout() {
            showToast('Logging out admin session...', 'warning');

    // Logout dari Firebase
            firebase.auth().signOut()
            .then(() => {
        // Hapus sessionStorage atau localStorage yang digunakan
                sessionStorage.clear(); // atau sessionStorage.removeItem('uid') jika hanya satu

                setTimeout(() => {
                    showToast('Admin session ended. Goodbye!', 'success');
            // Redirect ke halaman login atau homepage
                    window.location.href = '/login';
                }, 1000);
            })
            .catch((error) => {
                console.error('Logout gagal:', error);
                showToast('Logout Gagal', 'Terjadi kesalahan saat logout.', 'error');
            });
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

function getLast3Dates() {
  const dates = [];
  const today = new Date();

  for (let i = 0; i < 3; i++) {
    const d = new Date(today);
    d.setDate(d.getDate() - i);

    const day = String(d.getDate()).padStart(2, '0');
    const month = String(d.getMonth() + 1).padStart(2, '0');
    const year = d.getFullYear();

    dates.push(`${day}-${month}-${year}`);
  }

  return dates;
}

function analisaEmosiku() {
  const moodValues = {
    very_dissatisfied: 1,
    dissatisfied: 2,
    neutral: 3,
    satisfied: 4,
    very_satisfied: 5,
  };

  const last3Dates = getLast3Dates();
  console.log('3 tanggal terakhir dari hari ini:', last3Dates);

  firebase.database().ref('emosiku').once('value')
    .then(snapshot => {
      const data = snapshot.val();
      if (!data) {
        console.log('Tidak ada data emosiku ditemukan.');
        return;
      }

      let veryDissatisfiedCount = 0;
      let moodTotal = 0;
      let moodCount = 0;
      let mahasiswaPositif = 0;

      for (const userId in data) {
        const userEmosi = data[userId];

        // 1. Cek apakah user punya 3 hari very_dissatisfied berturut-turut
        const userLast3Moods = last3Dates.map(tgl => userEmosi[tgl]?.mood || null);
        if (userLast3Moods.every(m => m === 'very_dissatisfied')) {
          veryDissatisfiedCount++;
        }

        // 2. Hitung rata-rata semua mood
        for (const tanggal in userEmosi) {
          const mood = userEmosi[tanggal]?.mood;
          if (mood && moodValues[mood]) {
            moodTotal += moodValues[mood];
            moodCount++;
          }
        }

        // 3. Hitung user dengan emosi positif dalam 3 hari terakhir
        for (const tgl of last3Dates) {
          const mood = userEmosi[tgl]?.mood;
          if (mood === 'satisfied' || mood === 'very_satisfied') {
            mahasiswaPositif++;
            break; // hanya dihitung satu kali per user
          }
        }
      }

      const rataRataMood = moodCount ? (moodTotal / moodCount).toFixed(2) : 0;
        document.querySelector('#totalMood .counter').innerText = moodCount;
        document.querySelector('#criticalMood .counter').innerText = veryDissatisfiedCount;
        document.querySelector('#averageMood .counter').innerText = rataRataMood;
        document.getElementById('rata-ratamood').innerText = `${rataRataMood}/5.0`;
        document.querySelector('#positiveMood .counter').innerText = mahasiswaPositif;


      console.log('--- Hasil Analisa Emosiku ---');
      console.log('Jumlah user :', moodCount);
      console.log('Jumlah user dengan very_dissatisfied 3 hari berturut-turut:', veryDissatisfiedCount);
      console.log('Rata-rata mood semua data:', rataRataMood);
      console.log('Jumlah mahasiswa dengan emosi positif dalam 3 hari terakhir:', mahasiswaPositif);
    
    
    })
    .catch(error => {
      console.error('Gagal mengambil data emosiku:', error);
    });
}

function tampilkanDataEmosikuLengkap() {
  const emosikuRef = firebase.database().ref('emosiku');
  const usersRef = firebase.database().ref('users');

  emosikuRef.once('value')
    .then(snapshot => {
      const emosikuData = snapshot.val();
      if (!emosikuData) {
        console.log("Tidak ada data emosiku.");
        return;
      }

      const userIds = Object.keys(emosikuData);
      const promises = userIds.map(userId => {
        return usersRef.child(userId).once('value').then(userSnap => {
          const namaLengkap = userSnap.val()?.username || 'Tidak diketahui';
          const nik = userSnap.val()?.nik || 'Tidak diketahui';
          return { userId, namaLengkap, nik,  emosiku: emosikuData[userId] };
        });
      });

      Promise.all(promises).then(usersData => {
        usersData.forEach(user => {
          console.log(`📌 Nama: ${user.namaLengkap} (ID: ${user.userId}) (NIK: ${user.nik})`);
          for (const tanggal in user.emosiku) {
            const entry = user.emosiku[tanggal];
            console.log(`  📅 ${tanggal}: Mood = ${entry.mood}, Faktor = ${entry.faktor}, Catatan = ${entry.catatan}`);
          }
          console.log('----------------------');
        });
      });
    })
    .catch(error => {
      console.error("Gagal mengambil data:", error);
    });
}

function ambilDataEmosikuKeTabel() {
  const emosikuRef = firebase.database().ref('emosiku');
  const usersRef = firebase.database().ref('users');
  const tbody = document.getElementById('tabelEmosiku');

  emosikuRef.once('value')
    .then(snapshot => {
      const emosikuData = snapshot.val();
      if (!emosikuData) return;

      const userIds = Object.keys(emosikuData);
      const promises = userIds.map(userId => {
        return usersRef.child(userId).once('value').then(userSnap => {
          const user = userSnap.val();
          const nama = user?.username || 'Tidak diketahui';
          const nim = user?.nim || 'N/A';
          const inisial = nama.charAt(0).toUpperCase();
          const warna = getWarnaAvatar(inisial);
          const dataEmosiku = emosikuData[userId];

          // Ambil data terakhir (terbaru)
          const tanggalTerakhir = Object.keys(dataEmosiku).sort().reverse()[0];
          const dataTerbaru = dataEmosiku[tanggalTerakhir];

          // Asumsikan nilai akhir = skor rata-rata 7 hari (dummy)
          const skor = hitungSkorMood(dataEmosiku);
          const label = getLabelMood(skor);
          const warnaLabel = getWarnaLabel(skor);
          const emojiMingguan = getEmojiMingguan(dataEmosiku);

          return {
            userId, nama, nim, inisial, warna, dataTerbaru, skor, label, warnaLabel, emojiMingguan
          };
        });
      });

      Promise.all(promises).then(usersData => {
        tbody.innerHTML = ''; // Bersihkan dulu
        usersData.forEach(user => {
          const row = `
          <tr class="border-b border-gray-100 hover:bg-gray-50 transition-all duration-300">
            <td class="px-4 py-4">
              <input type="checkbox" class="rounded border-gray-300">
            </td>
            <td class="px-4 py-4">
              <div class="flex items-center space-x-3">
                <div class="w-8 h-8 ${user.warna} rounded-full flex items-center justify-center text-white text-xs font-bold">
                  ${user.inisial}
                </div>
                <div>
                  <div class="font-semibold text-gray-900">${user.nama}</div>
                  <div class="text-xs text-gray-500">${user.nim}</div>
                </div>
              </div>
            </td>
            <td class="px-4 py-4">
              <div class="flex items-center space-x-2">
                <span class="text-2xl">${getEmoji(user.dataTerbaru.mood)}</span>
                <span class="text-sm font-medium text-gray-700">${getLabelEmoji(user.dataTerbaru.mood)}</span>
              </div>
            </td>
            <td class="px-4 py-4">
              <div class="flex space-x-1">
                ${user.emojiMingguan.map(e => `<span class="text-sm">${e}</span>`).join('')}
              </div>
            </td>
            <td class="px-4 py-4">
              <span class="text-sm font-medium ${user.skor >= 3 ? 'text-green-600' : user.skor >= 2 ? 'text-orange-600' : 'text-red-600'}">${user.skor.toFixed(1)}/5</span>
            </td>
            <td class="px-4 py-4">
              <span class="text-xs text-gray-500">${getSelisihWaktu(user.dataTerbaru.timestamp)}</span>
            </td>
            <td class="px-4 py-4">
              <span class="text-xs font-medium px-2 py-1 rounded-full ${user.warnaLabel}">
                ${getIkonLabel(user.skor)}${user.label}
              </span>
            </td>
            <td class="px-4 py-4">
              <div class="flex gap-2">

                <!-- Tambahkan kondisi lain jika perlu -->
              </div>
            </td>
          </tr>
          `;
          tbody.innerHTML += row;
        });
      });
    });
}

function getWarnaAvatar(inisial) {
  const warna = {
    A: 'bg-blue-500',
    S: 'bg-green-500',
    R: 'bg-purple-500',
    default: 'bg-gray-500'
  };
  return warna[inisial] || warna.default;
}

function getEmoji(mood) {
  const map = {
    very_dissatisfied: '😞',
    dissatisfied: '😠',
    neutral: '😐',
    satisfied: '🙂',
    very_satisfied: '😄'
  };
  return map[mood] || '❓';
}

function getLabelEmoji(mood) {
  const map = {
    very_dissatisfied: 'Sangat Sedih',
    dissatisfied: 'Sedih',
    neutral: 'Biasa',
    satisfied: 'Senang',
    very_satisfied: 'Sangat Senang'
  };
  return map[mood] || 'Tidak Diketahui';
}

function hitungSkorMood(dataEmosiku) {
  const skorMap = {
    very_dissatisfied: 1,
    dissatisfied: 2,
    neutral: 3,
    satisfied: 4,
    very_satisfied: 5
  };
  const values = Object.values(dataEmosiku).slice(-7); // Ambil 7 terakhir
  const total = values.reduce((sum, v) => sum + (skorMap[v.mood] || 3), 0);
  return total / values.length;
}

function getLabelMood(skor) {
  if (skor < 2.5) return 'Perlu Perhatian';
  if (skor < 3.5) return 'Perlu Observasi';
  return 'Sangat Baik';
}

function getWarnaLabel(skor) {
  if (skor < 2.5) return 'bg-red-100 text-red-800';
  if (skor < 3.5) return 'bg-yellow-100 text-yellow-800';
  return 'bg-green-100 text-green-800';
}

function getIkonLabel(skor) {
  if (skor < 2.5) return '<i class="fas fa-exclamation-triangle mr-1"></i>';
  if (skor < 3.5) return '<i class="fas fa-eye mr-1"></i>';
  return '<i class="fas fa-smile mr-1"></i>';
}

function getEmojiMingguan(data) {
  const list = Object.entries(data).sort().slice(-7).map(([_, v]) => getEmoji(v.mood));
  while (list.length < 7) list.unshift('❓');
  return list;
}

function getSelisihWaktu(timestamp) {
  if (!timestamp) return 'Tidak diketahui';
  const now = new Date();
  const waktu = new Date(timestamp);
  const selisihMenit = Math.floor((now - waktu) / 60000);
  if (selisihMenit < 60) return `${selisihMenit} menit lalu`;
  if (selisihMenit < 1440) return `${Math.floor(selisihMenit / 60)} jam lalu`;
  return `${Math.floor(selisihMenit / 1440)} hari lalu`;
}


window.onload = analisaEmosiku;
window.onload = tampilkanDataEmosikuLengkap;
window.onload = ambilDataEmosikuKeTabel;
    </script>
</body>
</html>