<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>TeluSafe - PPKS Admin</title>
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
        
        .priority-high { 
            animation: pulse-soft 2s infinite;
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
                    <div class="flex items-center space-x-2 font-semibold text-white sidebar-active p-2">
                        <i class="fas fa-shield-alt text-white text-base"></i>
                        <span>PPKS</span>
                    </div>
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
        <main class="flex-1 p-6 space-y-6 animate-fade-in overflow-auto">
            <!-- Top bar -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                <!-- <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-telusafe-red to-telusafe-light-red rounded-xl flex items-center justify-center floating-animation">
                        <i class="fas fa-shield-alt text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-[28px] font-bold font-poppins bg-gradient-to-r from-telusafe-red to-telusafe-light-red bg-clip-text text-transparent">
                            PPKS Admin Dashboard
                        </h1>
                        <p class="text-sm text-gray-500">Pencegahan & Penanganan Kekerasan Seksual</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="relative w-full md:max-w-md">
                        <input class="w-full rounded-full border border-gray-200 px-6 py-3 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-telusafe-red search-focus glass-effect" placeholder="🔍 Cari laporan..." type="search" id="searchInput" oninput="handleSearch(this.value)"/>
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
                            <p class="text-xs text-gray-500 leading-none">PPKS Admin</p>
                        </div>
                    </div>
                    <button aria-label="Notifications" class="relative text-xl glass-effect p-3 rounded-full card-hover" onclick="showNotifications()">
                        <i class="fas fa-bell text-gray-600"></i>
                        <div class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full notification-dot"></div>
                    </button>
                </div> -->
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 animate-slide-up">
                <button class="glass-effect rounded-xl p-4 card-hover text-left" onclick="createNewReport()">
                    <div class="flex items-center space-x-3">
                        <div>
                            <h3 class="font-semibold text-gray-800">Selamat Datang</h3>
                            <p class="text-sm text-gray-500">Di Laporan PPKS</p>
                        </div>
                    </div>
                </button>
                
                <!-- <select class="glass-effect rounded-xl p-4 card-hover focus:outline-none focus:ring-2 focus:ring-telusafe-red" id="statusFilter" onchange="filterByStatus(this.value)">
                    <option value="">Semua Status</option>
                    <option value="dilaporkan">Dilaporkan</option>
                    <option value="diproses">Diproses</option>
                    <option value="selesai">Selesai</option>
                </select>
                
                <select class="glass-effect rounded-xl p-4 card-hover focus:outline-none focus:ring-2 focus:ring-telusafe-red" id="priorityFilter" onchange="filterByPriority(this.value)">
                    <option value="">Semua Prioritas</option>
                    <option value="tinggi">Prioritas Tinggi</option>
                    <option value="sedang">Prioritas Sedang</option>
                </select> -->
            </div>

            <!-- Dashboard content -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <!-- PPKS Statistics -->
                <div class="lg:col-span-8 space-y-6">
                    <section class="animate-slide-up">
                        <div class="glass-effect rounded-xl p-6 shadow-[0_4px_20px_rgba(0,0,0,0.08)]">
                            <div class="flex justify-between items-center mb-6">
                                <div>
                                    <h2 class="text-[20px] font-semibold font-poppins text-gray-800">Statistik PPKS</h2>
                                    <p class="text-sm text-gray-500 mt-1">Data Keseluruhan Laporan</p>
                                </div>

                            </div>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 stagger-animation">
                                <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-xl p-4 stat-card card-hover cursor-pointer" onclick="ambilStatistikLaporan()">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="bg-gradient-to-br from-telusafe-red to-telusafe-light-red p-2 rounded-full">
                                            <i class="fas fa-file-alt text-white text-sm"></i>
                                        </div>
                                    </div>
                                    <div class="text-left" id="total_laporan">
                                        <p class="text-[24px] font-bold font-poppins text-gray-800 counter" data-count="47">0</p>
                                        <p class="text-[12px] font-medium text-gray-600">Total Laporan</p>
                                        <p class="text-xs text-gray-500 mt-1">Seluruh Total Laporan</p>
                                    </div>
                                </div>
                                
                                <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl p-4 stat-card card-hover cursor-pointer" onclick="showDetails('pending-reports')">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 p-2 rounded-full">
                                            <i class="fas fa-clock text-white text-sm"></i>
                                        </div>
                                    </div>
                                    <div class="text-left" id="proses_belum">
                                        <p class="text-[24px] font-bold font-poppins text-gray-800 counter" data-count="15">0</p>
                                        <p class="text-[12px] font-medium text-gray-600">Menunggu Proses</p>
                                        <p class="text-xs text-gray-500 mt-1">Perlu tindakan</p>
                                    </div>
                                </div>
                                
                                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4 stat-card card-hover cursor-pointer" onclick="showDetails('processing-reports')">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-2 rounded-full">
                                            <i class="fas fa-cog text-white text-sm"></i>
                                        </div>
                                    </div>
                                    <div class="text-left" id="proses_udah">
                                        <p class="text-[24px] font-bold font-poppins text-gray-800 counter" data-count="23">0</p>
                                        <p class="text-[12px] font-medium text-gray-600">Sedang Diproses</p>
                                        <p class="text-xs text-gray-500 mt-1">Dalam investigasi</p>
                                    </div>
                                </div>
                                
                                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-4 stat-card card-hover cursor-pointer" onclick="showDetails('completed-reports')">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="bg-gradient-to-br from-green-500 to-green-600 p-2 rounded-full">
                                            <i class="fas fa-check-circle text-white text-sm"></i>
                                        </div>
                                    </div>
                                    <div class="text-left" id="proses_selesai">
                                        <p class="text-[24px] font-bold font-poppins text-gray-800 counter" data-count="32">0</p>
                                        <p class="text-[12px] font-medium text-gray-600">Kasus Selesai</p>
                                        <p class="text-xs text-gray-500 mt-1">Resolusi tercapai</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Report Types Distribution Chart -->
                <div class="lg:col-span-4 animate-slide-up">
                    <div class="glass-effect rounded-xl p-6 shadow-[0_4px_20px_rgba(0,0,0,0.08)] h-fit">
                        <h3 class="text-[18px] font-semibold font-poppins text-gray-800 mb-4">Distribusi Jenis Laporan</h3>
                        <div class="w-full">
                            <svg id="chart" class="w-full h-40" viewBox="0 0 400 160" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- Grid lines -->
                                <line stroke="#E2E8F0" stroke-width="1" x1="0" x2="400" y1="30" y2="30"/>
                                <line stroke="#E2E8F0" stroke-width="1" x1="0" x2="400" y1="60" y2="60"/>
                                <line stroke="#E2E8F0" stroke-width="1" x1="0" x2="400" y1="90" y2="90"/>
                                <line stroke="#E2E8F0" stroke-width="1" x1="0" x2="400" y1="120" y2="120"/>
                                
                                <!-- Chart lines for different report types -->
                                <!-- Korban (Victim) - Red line -->
                                <path d="M0 100C40 95 80 85 120 90C160 95 200 105 240 100C280 95 320 85 360 80C400 85" 
                                        stroke="#EF4444" stroke-width="3" fill="none"/>
                                <!-- Saksi (Witness) - Blue line -->
                                <path d="M0 110C40 105 80 100 120 95C160 100 200 110 240 105C280 100 320 95 360 90C400 95" 
                                        stroke="#3B82F6" stroke-width="3" fill="none"/>
                                
                                <!-- Active points -->
                                <circle cx="320" cy="85" fill="#EF4444" r="4"/>
                                <circle cx="320" cy="95" fill="#3B82F6" r="4"/>
                                
                                <!-- Vertical indicator line -->
                                <line stroke="#94A3B8" stroke-dasharray="2 2" x1="320" x2="320" y1="10" y2="140"/>
                                
                                <!-- Month labels -->
                                <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="20" y="155">Jan</text>
                                <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="60" y="155">Feb</text>
                                <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="100" y="155">Mar</text>
                                <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="140" y="155">Apr</text>
                                <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="180" y="155">Mei</text>
                                <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="220" y="155">Jun</text>
                                <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="260" y="155">Jul</text>
                                <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="300" y="155">Agu</text>
                                <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="340" y="155">Sep</text>
                                <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="380" y="155">Okt</text>
                                
                                <!-- Y-axis labels -->
                                <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="5" y="25">50</text>
                                <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="5" y="55">40</text>
                                <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="5" y="85">30</text>
                                <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="5" y="115">20</text>
                                <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="5" y="145">10</text>
                            </svg>
                        </div>
                        
                        <!-- Legend -->
                        <div class="flex flex-col gap-2 mt-4 text-xs font-medium">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-sm bg-red-500"></span>
                                <span class="text-red-600 flex-1">Korban</span>
                                <span id="jumlahKorban" class="font-bold text-gray-700">28</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-sm bg-blue-500"></span>
                                <span class="text-blue-600 flex-1">Saksi</span>
                                <span id="jumlahSaksi" class="font-bold text-gray-700">15</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reports Table -->
            <section class="animate-slide-up">
                <div class="glass-effect rounded-xl p-6 shadow-[0_4px_20px_rgba(0,0,0,0.08)] overflow-x-auto scrollbar-thin">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-[18px] font-semibold font-poppins text-gray-800">Manajemen Laporan PPKS</h3>
                        <div class="flex space-x-3">
                            <button class="border border-gray-200 text-gray-600 px-4 py-2 rounded-lg card-hover text-sm font-medium" onclick="loadFirstPage()">
                                <i class="fas fa-sync-alt mr-2"></i>
                                Refresh
                            </button>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <!-- <table class="w-full text-left text-sm text-gray-600 table-hover">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="font-semibold px-4 py-3 text-gray-800">
                                        <input type="checkbox" class="rounded border-gray-300" onchange="selectAll(this)">
                                    </th>
                                    <th class="font-semibold px-4 py-3 text-gray-800">ID</th>
                                    <th class="font-semibold px-4 py-3 text-gray-800">Tanggal</th>
                                    <th class="font-semibold px-4 py-3 text-gray-800">Jenis Laporan</th>
                                    <th class="font-semibold px-4 py-3 text-gray-800">Lokasi Kejadian</th>
                                    <th class="font-semibold px-4 py-3 text-gray-800">Prioritas</th>
                                    <th class="font-semibold px-4 py-3 text-gray-800">Status</th>
                                    <th class="font-semibold px-4 py-3 text-gray-800">Petugas</th>
                                    <th class="font-semibold px-4 py-3 text-gray-800">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="stagger-animation">
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition-all duration-300">
                                    <td class="px-4 py-4">
                                        <input type="checkbox" class="rounded border-gray-300">
                                    </td>
                                    <td class="px-4 py-4 font-mono text-xs">#PPKS001</td>
                                    <td class="px-4 py-4">29-05-2025</td>
                                    <td class="px-4 py-4">
                                        <span class="bg-red-100 text-red-800 text-xs font-medium px-2 py-1 rounded-full">
                                            <i class="fas fa-user-injured mr-1"></i>Korban
                                        </span>
                                    </td>
                                    <td class="px-4 py-4">Gedung Manterawu Lt.3</td>
                                    <td class="px-4 py-4">
                                        <span class="bg-red-100 text-red-800 text-xs font-medium px-2 py-1 rounded-full priority-high">
                                            <i class="fas fa-exclamation-triangle mr-1"></i>Tinggi
                                        </span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full">
                                            <i class="fas fa-clock mr-1"></i>Investigasi
                                        </span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center text-white text-xs">A</div>
                                            <span class="text-xs">Admin A</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex gap-2">
                                            <button class="text-blue-600 hover:text-blue-800 transition-colors card-hover p-1" onclick="viewReport('PPKS001')" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="text-yellow-600 hover:text-yellow-800 transition-colors card-hover p-1" onclick="assignReport('PPKS001')" title="Assign Petugas">
                                                <i class="fas fa-user-plus"></i>
                                            </button>
                                            <button class="text-green-600 hover:text-green-800 transition-colors card-hover p-1" onclick="updateStatus('PPKS001')" title="Update Status">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-600 hover:text-red-800 transition-colors card-hover p-1" onclick="flagReport('PPKS001')" title="Flag Report">
                                                <i class="fas fa-flag"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition-all duration-300">
                                    <td class="px-4 py-4">
                                        <input type="checkbox" class="rounded border-gray-300">
                                    </td>
                                    <td class="px-4 py-4 font-mono text-xs">#PPKS002</td>
                                    <td class="px-4 py-4">28-05-2025</td>
                                    <td class="px-4 py-4">
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full">
                                            <i class="fas fa-eye mr-1"></i>Saksi
                                        </span>
                                    </td>
                                    <td class="px-4 py-4">Asrama Putra Blok C</td>
                                    <td class="px-4 py-4">
                                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-1 rounded-full">
                                            <i class="fas fa-minus mr-1"></i>Sedang
                                        </span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="bg-orange-100 text-orange-800 text-xs font-medium px-2 py-1 rounded-full">
                                            <i class="fas fa-hourglass-half mr-1"></i>Diproses
                                        </span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center text-white text-xs">B</div>
                                            <span class="text-xs">Admin B</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex gap-2">
                                            <button class="text-blue-600 hover:text-blue-800 transition-colors card-hover p-1" onclick="viewReport('PPKS002')" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="text-yellow-600 hover:text-yellow-800 transition-colors card-hover p-1" onclick="assignReport('PPKS002')" title="Assign Petugas">
                                                <i class="fas fa-user-plus"></i>
                                            </button>
                                            <button class="text-green-600 hover:text-green-800 transition-colors card-hover p-1" onclick="updateStatus('PPKS002')" title="Update Status">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-600 hover:text-red-800 transition-colors card-hover p-1" onclick="flagReport('PPKS002')" title="Flag Report">
                                                <i class="fas fa-flag"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition-all duration-300">
                                    <td class="px-4 py-4">
                                        <input type="checkbox" class="rounded border-gray-300">
                                    </td>
                                    <td class="px-4 py-4 font-mono text-xs">#PPKS003</td>
                                    <td class="px-4 py-4">27-05-2025</td>
                                    <td class="px-4 py-4">
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded-full">
                                            <i class="fas fa-users mr-1"></i>Pihak Ketiga
                                        </span>
                                    </td>
                                    <td class="px-4 py-4">Kantin Pusat</td>
                                    <td class="px-4 py-4">
                                        <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2 py-1 rounded-full">
                                            <i class="fas fa-arrow-down mr-1"></i>Rendah
                                        </span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded-full">
                                            <i class="fas fa-check-circle mr-1"></i>Selesai
                                        </span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-6 h-6 bg-purple-500 rounded-full flex items-center justify-center text-white text-xs">C</div>
                                            <span class="text-xs">Admin C</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex gap-2">
                                            <button class="text-blue-600 hover:text-blue-800 transition-colors card-hover p-1" onclick="viewReport('PPKS003')" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="text-gray-400 cursor-not-allowed p-1" title="Assign Petugas" disabled>
                                                <i class="fas fa-user-plus"></i>
                                            </button>
                                            <button class="text-gray-400 cursor-not-allowed p-1" title="Update Status" disabled>
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-green-600 hover:text-green-800 transition-colors card-hover p-1" onclick="archiveReport('PPKS003')" title="Archive Report">
                                                <i class="fas fa-archive"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table> -->
                        <table>
  <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="font-semibold px-4 py-3 text-gray-800">
                                        <input type="checkbox" class="rounded border-gray-300" onchange="selectAll(this)">
                                    </th>
                                    <th class="font-semibold px-4 py-3 text-gray-800">ID</th>
                                    <th class="font-semibold px-4 py-3 text-gray-800">Tanggal</th>
                                    <th class="font-semibold px-4 py-3 text-gray-800">Jenis Laporan</th>
                                    <th class="font-semibold px-4 py-3 text-gray-800">Lokasi Kejadian</th>
                                    <th class="font-semibold px-4 py-3 text-gray-800">Prioritas</th>
                                    <th class="font-semibold px-4 py-3 text-gray-800">Status</th>
                                    <th class="font-semibold px-4 py-3 text-gray-800">Petugas</th>
                                    <th class="font-semibold px-4 py-3 text-gray-800">Aksi</th>
                                </tr>
                            </thead>
  <tbody id="laporanBody" class="stagger-animation"></tbody>
</table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="flex items-center justify-between mt-6">
                        <div class="text-sm text-gray-500">
                            Menampilkan 3 Laporan
                        </div>
                        <div class="flex space-x-2">
                            <button id="prevBtn" class="px-3 py-1 border border-gray-300 rounded text-sm hover:bg-gray-50 card-hover" onclick="loadPrevPage()">
                                <i class="fas fa-chevron-left mr-1"></i>Previous
                            </button>
                            <button class="px-3 py-1 bg-telusafe-red text-white rounded text-sm"></button>
                            <button id="nextBtn" class="px-3 py-1 border border-gray-300 rounded text-sm hover:bg-gray-50 card-hover" onclick="loadNextPage()">
                                Next<i class="fas fa-chevron-right ml-1"></i>
                            </button>
                        </div>
                    </div>
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

    <div id="modalOverlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
  <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
    <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
      <i class="fas fa-times"></i>
    </button>
    <h2 class="text-lg font-semibold mb-4">Detail Laporan</h2>
    <div id="modalContent" class="text-sm space-y-2">
      <!-- Konten akan diisi via JS -->
    </div>
  </div>
</div>

<!-- Modal Update Status -->
<div id="statusModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 hidden">
  <div class="bg-white rounded-lg shadow-lg p-6 w-96">
    <h2 class="text-lg font-semibold mb-4">Update Status Laporan</h2>
    <select id="statusSelect" class="w-full border border-gray-300 rounded px-3 py-2 mb-4">
      <option value="belum">Belum</option>
      <option value="sudah">Sudah</option>
      <option value="selesai">Selesai</option>
    </select>
    <div class="flex justify-end gap-2">
      <button onclick="closeStatusModal()" class="px-4 py-2 bg-gray-300 text-gray-800 rounded">Batal</button>
      <button onclick="saveStatus()" class="px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
    </div>
  </div>
</div>

<div id="prioritasModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 hidden">
  <div class="bg-white rounded-lg shadow-lg p-6 w-96">
    <h2 class="text-lg font-semibold mb-4">Update Prioritas Laporan</h2>
    <select id="prioritasSelect" class="w-full border border-gray-300 rounded px-3 py-2 mb-4">
      <option value="tinggi">Tinggi</option>
      <option value="sedang">Sedang</option>
      <option value="rendah">Rendah</option>
    </select>
    <div class="flex justify-end gap-2">
      <button onclick="closePrioritasModal()" class="px-4 py-2 bg-gray-300 text-gray-800 rounded">Batal</button>
      <button onclick="savePrioritas()" class="px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
    </div>
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
            if (section === 'artikel') {
                window.location.href = '/artikeladmin';
            } else if (section === 'bk') {
                window.location.href = '/bkadmin';
            } else if (section === 'emosi') {
                window.location.href = '/emosikuadmin';
            } else if (section === 'home') {
                window.location.href = '/beranda';
            }
        }

        function createNewReport() {
            showToast('Opening new report creation form...', 'info');
        }

        function filterByStatus(status) {
            showToast(`Filtering reports by status: ${status || 'All'}`, 'info');
        }

        function filterByPriority(priority) {
            showToast(`Filtering reports by priority: ${priority || 'All'}`, 'info');
        }

        function exportData() {
            showToast('Exporting PPKS data...', 'info');
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

        function viewReport(id) {
            showToast(`Opening detailed view for report ${id}...`, 'info');
            firebase.database().ref('laporan/' + id).once('value').then(snapshot => {
            console.log('Laporan data:', snapshot.val());
    const laporan = snapshot.val();
    if (!laporan) return;

    const modal = document.getElementById('modalOverlay');
    const content = document.getElementById('modalContent');

    content.innerHTML = `
      <p><strong>ID:</strong> ${id}</p>
      <p><strong>Status:</strong> ${laporan.status || '-'}</p>
    <p><strong>Status Proses:</strong> ${laporan.proses || '-'}</p>
      <p><strong>Tanggal:</strong> ${laporan.tanggal || '-'}</p>
      <p><strong>Lokasi:</strong> ${laporan.lokasi || '-'}</p>
      <p><strong>Deskripsi:</strong><br>${laporan.deskripsi || '-'}</p>
      <p><strong>Anonym:</strong> ${laporan.anonim || '-'}</p>
      <p><strong>UserID:</strong> ${laporan.userId || '-'}</p>
      <p><img src="${laporan.uploadedFile}" alt="Foto Tidak Ada"></p>
    `;

    modal.classList.remove('hidden');
  });
}

function closeModal() {
  document.getElementById('modalOverlay').classList.add('hidden');
}
        

        function assignReport(id) {
            showToast(`Assigning officer to report ${id}...`, 'warning');
        }

        function updateStatus(id) {
            showToast(`Updating status for report ${id}...`, 'warning');
            document.getElementById('statusModal').classList.remove('hidden');
            selectedKode = id;
        }

        function updatePrioritas(id) {
            showToast(`Updating prioritas for report ${id}...`, 'warning');
            document.getElementById('prioritasModal').classList.remove('hidden');
            selectedLaporanId = id;
        }
        function closeStatusModal() {
  selectedKode = null;
  document.getElementById('statusModal').classList.add('hidden');
}

function saveStatus() {
  const newStatus = document.getElementById('statusSelect').value;
  if (!selectedKode) return;
  const db = firebase.database();
  db.ref('laporan/' + selectedKode).update({
    proses: newStatus
  }).then(() => {
    closeStatusModal();
    loadFirstPage(); // refresh table
  }).catch((error) => {
    console.error('Gagal update status:', error);
    alert('Gagal update status.');
  });
}

        function flagReport(id) {
            showToast(`Flagging report ${id} for review...`, 'error');
        }

        function archiveReport(id) {
            showToast(`Archiving completed report ${id}...`, 'success');
        }

        function bulkAction() {
            showToast('Opening bulk action menu...', 'info');
        }

        function refreshTable() {
            showToast('Refreshing report data...', 'info');
        }

        function selectAll(checkbox) {
            const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');
            checkboxes.forEach(cb => cb.checked = checkbox.checked);
            showToast(`${checkbox.checked ? 'Selected' : 'Deselected'} all reports`, 'info');
        }

        function previousPage() {
            showToast('Loading previous page...', 'info');
        }

        function nextPage() {
            showToast('Loading next page...', 'info');
        }

        function handleSearch(query) {
            if (query.length > 2) {
                showToast(`Searching PPKS reports for: ${query}`, 'info');
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

        function ambilStatistikLaporan() {
            const laporanRef = firebase.database().ref('laporan');

            laporanRef.once('value')
                .then((snapshot) => {
                if (snapshot.exists()) {
                const dataLaporan = snapshot.val();

                let totalLaporan = 0;
                let laporanHariIni = 0;
                let prosesBelum = 0;
                let prosesUdah = 0;
                let prosesSelesai = 0;

                // Ambil tanggal hari ini dalam format dd-mm-yyyy
                const today = new Date();
                const todayFormatted = `${String(today.getDate()).padStart(2, '0')}-${String(today.getMonth() + 1).padStart(2, '0')}-${today.getFullYear()}`;

                Object.values(dataLaporan).forEach((laporan) => {
                    totalLaporan++;
                    console.log('Laporan:', laporan);
                    // Hitung laporan yang dibuat hari ini
                    if (laporan.tanggal && laporan.tanggal === todayFormatted) {
                        laporanHariIni++;
                    }

                    // Hitung berdasarkan status (tidak case-sensitive)
                    if (laporan.proses === 'belum') {
                        prosesBelum++;
                    } else if (laporan.proses === 'sudah') {
                        prosesUdah++;
                    } else if (laporan.proses === 'selesai') {
                        prosesSelesai++;
                    }
                });
                const counterE1 = document.querySelector('#total_laporan .counter');
                if (counterE1) {
                    counterE1.textContent = totalLaporan;
                    counterE1.setAttribute('data-count', totalLaporan);
                }
                const counterE2 = document.querySelector('#proses_belum .counter');
                if (counterE2) {
                    counterE2.textContent = prosesBelum;
                    counterE2.setAttribute('data-count', prosesBelum);
                }

                const counterE3 = document.querySelector('#proses_udah .counter');
                if (counterE3) {
                    counterE3.textContent = prosesUdah;
                    counterE3.setAttribute('data-count', prosesUdah);
                }
                const counterE4 = document.querySelector('#proses_selesai .counter');
                if (counterE4) {
                    counterE4.textContent = prosesSelesai;
                    counterE4.setAttribute('data-count', prosesSelesai);
                }
                console.log('Total laporan:', totalLaporan);
                console.log('Laporan hari ini:', laporanHariIni);
                console.log('Status belum:', prosesBelum);
                console.log('Status udah:', prosesUdah);
                console.log('Status selesai:', prosesSelesai);
            } else {
                console.log('Tidak ada data laporan ditemukan.');
            }
        })
        .catch((error) => {
            console.error('Gagal mengambil data laporan:', error);
        });
    }

    function initLaporanChart() {
    const db = firebase.database();
    let kor = 0;
    let sak = 0;
    db.ref("laporan").on("value", (snapshot) => {
        const data = snapshot.val();
        const monthly = {
            korban: Array(12).fill(0),
            saksi: Array(12).fill(0)
        };

        for (let key in data) {
            const laporan = data[key]; // <- pastikan ini ada
            const rawTanggal = laporan.tanggal || "";
            const dateParts = rawTanggal.split("-"); // format: dd-mm-yyyy

            if (dateParts.length === 3) {
                const day = parseInt(dateParts[0], 10);
                const month = parseInt(dateParts[1], 10) - 1; // 0-based month
                const year = parseInt(dateParts[2], 10);
                const date = new Date(year, month, day);
                const monthIndex = date.getMonth(); // 0-11

                const status = (laporan.status || "").toLowerCase();
                if (status === "korban") {
                    monthly.korban[monthIndex]++;
                    kor++;
                } else if (status === "saksi") {
                    monthly.saksi[monthIndex]++;
                    sak++;
                }
            }
        }

        drawSVGChart(monthly.korban, monthly.saksi);
        document.getElementById("jumlahKorban").textContent = kor;
document.getElementById("jumlahSaksi").textContent = sak;

    });
    
}

function drawPath(data, color) {
    const stepX = 40;
    const baseY = 140;
    const scaleY = 2;

    let d = `M0 ${baseY - data[0] * scaleY}`;
    for (let i = 1; i < data.length; i++) {
        const x = i * stepX;
        const y = baseY - data[i] * scaleY;
        d += ` C${x - 20} ${y}, ${x - 20} ${y}, ${x} ${y}`;
    }

    return `<path d="${d}" stroke="${color}" stroke-width="3" fill="none" />`;
}

function drawSVGChart(korban, saksi) {
    const svg = document.getElementById("chart");

    const pathKorban = drawPath(korban, "#EF4444");
    const pathSaksi = drawPath(saksi, "#3B82F6");

    svg.innerHTML = `
        <line stroke="#E2E8F0" stroke-width="1" x1="0" x2="400" y1="30" y2="30"/>
        <line stroke="#E2E8F0" stroke-width="1" x1="0" x2="400" y1="60" y2="60"/>
        <line stroke="#E2E8F0" stroke-width="1" x1="0" x2="400" y1="90" y2="90"/>
        <line stroke="#E2E8F0" stroke-width="1" x1="0" x2="400" y1="120" y2="120"/>
        ${pathKorban}
        ${pathSaksi}

        <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="20" y="155">Jan</text>
                                <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="60" y="155">Feb</text>
                                <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="100" y="155">Mar</text>
                                <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="140" y="155">Apr</text>
                                <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="180" y="155">Mei</text>
                                <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="220" y="155">Jun</text>
                                <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="260" y="155">Jul</text>
                                <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="300" y="155">Agu</text>
                                <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="340" y="155">Sep</text>
                                <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="380" y="155">Okt</text>
                                
                                <!-- Y-axis labels -->
                                <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="5" y="25">50</text>
                                <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="5" y="55">40</text>
                                <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="5" y="85">30</text>
                                <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="5" y="115">20</text>
                                <text fill="#94A3B8" font-family="Inter, sans-serif" font-size="9" x="5" y="145">10</text>
    `;
}

const db = firebase.database();
  const laporanRef = db.ref('laporan');
  const PAGE_SIZE = 3;

  let lastKey = null;
  let firstKey = null;
  let pageStack = []; // simpan key awal tiap halaman untuk prev
  

  const tbody = document.getElementById('laporanBody');
  const nextBtn = document.getElementById('nextBtn');
  const prevBtn = document.getElementById('prevBtn');

  function renderTable(data) {
    let prioritas = "Tinggi";
    tbody.innerHTML = '';
    if (!data) {
      tbody.innerHTML = '<tr><td colspan="9">Data laporan kosong</td></tr>';
      return;
    }

    Object.entries(data).forEach(([kode, laporan]) => {
        if (laporan.status === 'Korban'){
            prioritas = 'Tinggi';
        } else if (laporan.status === 'Saksi') {
            prioritas = 'Sedang';
        };
      const tr = document.createElement('tr');
      tr.innerHTML = ` 
  <td class="px-4 py-4"><input type="checkbox" class="rounded border-gray-300"></td>
  <td class="px-4 py-4 font-mono text-xs">#${kode}</td>
  <td class="px-4 py-4">${laporan.tanggal || ''}</td>
  <td class="px-4 py-4">
    <span class="bg-red-100 text-red-800 text-xs font-medium px-2 py-1 rounded-full">
      <i class="fas fa-user-injured mr-1"></i>${laporan.status || ''}
    </span>
  </td>
  <td class="px-4 py-4">${laporan.lokasi || ''}</td>
  <td class="px-4 py-4">
    <span class="bg-red-100 text-red-800 text-xs font-medium px-2 py-1 rounded-full priority-high">
      <i class="fas fa-exclamation-triangle mr-1"></i>${laporan.prioritas||prioritas || ''}
    </span>
  </td>
  <td class="px-4 py-4">
    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full">
      <i class="fas fa-clock mr-1"></i>${laporan.proses || 'belum'}
    </span>
  </td>
  <td class="px-4 py-4">
    <div class="flex items-center space-x-2">
      <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center text-white text-xs">A</div>
      <span class="text-xs">Admin A</span>
    </div>
  </td>
  <td class="px-4 py-4">
  <div class="flex gap-2">
                                            <button class="text-blue-600 hover:text-blue-800 transition-colors card-hover p-1" onclick="viewReport('${kode}')" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="text-green-600 hover:text-green-800 transition-colors card-hover p-1" onclick="updateStatus('${kode}')" title="Update Status">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-yellow-500 hover:text-yellow-700 transition-colors card-hover p-1" onclick="updatePrioritas('${kode}')" title="Update Prioritas">
    <i class="fas fa-edit"></i>
</button>

                                        </div>
  </td>
`;
      tbody.appendChild(tr);
    });
  }

  // Load first page
  function loadFirstPage() {
  laporanRef.orderByKey().limitToFirst(PAGE_SIZE + 1).once('value', snapshot => {
    const data = snapshot.val();
    if (data) {
      const keys = Object.keys(data);
      const displayKeys = keys.slice(0, PAGE_SIZE);
      const displayData = {};
      displayKeys.forEach(k => displayData[k] = data[k]);

      firstKey = displayKeys[0];
      lastKey = displayKeys[displayKeys.length - 1];
      pageStack = [firstKey];

      renderTable(displayData);
      nextBtn.disabled = (keys.length <= PAGE_SIZE); // disable next jika tidak ada halaman selanjutnya
      prevBtn.disabled = true; // halaman pertama
    }
  });
}

  // Load next page
  function loadNextPage() {
    console.log("FirstKey:", firstKey, "LastKey:", lastKey, "Stack:", pageStack);

  if (!lastKey) return;

  laporanRef.orderByKey().startAfter(lastKey).limitToFirst(PAGE_SIZE + 1).once('value', snapshot => {
    const data = snapshot.val();
    if (data) {
      const keys = Object.keys(data);
      if (keys.length === 0) return; // tidak ada halaman selanjutnya

      const displayKeys = keys.slice(0, PAGE_SIZE);
      const displayData = {};
      displayKeys.forEach(k => displayData[k] = data[k]);

      firstKey = displayKeys[0];
      lastKey = displayKeys[displayKeys.length - 1];
      pageStack.push(firstKey);

      renderTable(displayData);
      prevBtn.disabled = false;
      nextBtn.disabled = (keys.length <= PAGE_SIZE); // disable jika halaman terakhir
    }
  });
}


  // Load previous page
  function loadPrevPage() {
  if (pageStack.length <= 1) return;

  pageStack.pop(); // remove current
  const prevFirstKey = pageStack[pageStack.length - 1];

  laporanRef.orderByKey().endAt(prevFirstKey).limitToLast(PAGE_SIZE + 1).once('value', snapshot => {
    const data = snapshot.val();
    if (data) {
      const keys = Object.keys(data);
      const displayKeys = keys.slice(0, PAGE_SIZE);
      const displayData = {};
      displayKeys.forEach(k => displayData[k] = data[k]);

      firstKey = displayKeys[0];
      lastKey = displayKeys[displayKeys.length - 1];

      renderTable(displayData);
      prevBtn.disabled = (pageStack.length <= 1);
      nextBtn.disabled = false;
    }
  });
}
let selectedLaporanId = null;
function closePrioritasModal() {
    const modal = document.getElementById('prioritasModal');
    modal.classList.add('hidden');
}

function savePrioritas() {
    const prioritas = document.getElementById('prioritasSelect').value;

    if (!selectedLaporanId) {
        alert('ID laporan tidak ditemukan.');
        return;
    }

    const laporanRef = firebase.database().ref('laporan/' + selectedLaporanId);

    laporanRef.update({ prioritas: prioritas })
        .then(() => {
            alert('Prioritas berhasil diperbarui.');
            closePrioritasModal();

            // Opsional: Refresh tampilan atau data jika perlu
            // loadLaporan(); 
        })
        .catch((error) => {
            console.error('Gagal memperbarui prioritas:', error);
            alert('Terjadi kesalahan saat menyimpan prioritas.');
        });
}


  // load halaman pertama saat mulai
  loadFirstPage();

    document.addEventListener('DOMContentLoaded', function () {
        ambilStatistikLaporan();
        initLaporanChart();
    });
    </script>
</body>
</html>