<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>TeluSafe - Bimbingan Konseling</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"/>
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
                    borderRadius: { '4xl': '2rem' },
                    boxShadow: {
                        'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04)',
                        'strong': '0 10px 40px -10px rgba(0, 0, 0, 0.15), 0 20px 25px -5px rgba(0, 0, 0, 0.1)',
                        'glow': '0 0 20px rgba(196, 59, 59, 0.15)'
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'slide-down': 'slideDown 0.6s ease-out',
                        'slide-left': 'slideLeft 0.6s ease-out',
                        'slide-right': 'slideRight 0.6s ease-out',
                        'scale-in': 'scaleIn 0.4s ease-out',
                        'bounce-gentle': 'bounceGentle 2s infinite',
                        'pulse-soft': 'pulseSoft 2s infinite',
                        'float': 'float 3s ease-in-out infinite',
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
                        slideDown: {
                            '0%': { transform: 'translateY(-30px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' }
                        },
                        slideLeft: {
                            '0%': { transform: 'translateX(30px)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' }
                        },
                        slideRight: {
                            '0%': { opacity: '0', transform: 'translateX(-30px)' },
                            '100%': { opacity: '1', transform: 'translateX(0)' }
                        },
                        scaleIn: {
                            '0%': { transform: 'scale(0.9)', opacity: '0' },
                            '100%': { transform: 'scale(1)', opacity: '1' }
                        },
                        bounceGentle: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-5px)' }
                        },
                        pulseSoft: {
                            '0%, 100%': { transform: 'scale(1)' },
                            '50%': { transform: 'scale(1.05)' }
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' }
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
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        .sidebar-active {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.25) 0%, rgba(255, 255, 255, 0.15) 100%);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
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
        
        .stagger-animation > * {
            opacity: 0;
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        .stagger-animation > *:nth-child(1) { animation-delay: 0.1s; }
        .stagger-animation > *:nth-child(2) { animation-delay: 0.2s; }
        .stagger-animation > *:nth-child(3) { animation-delay: 0.3s; }
        .stagger-animation > *:nth-child(4) { animation-delay: 0.4s; }
        .stagger-animation > *:nth-child(5) { animation-delay: 0.5s; }
        
        .gradient-text {
            background: linear-gradient(135deg, #A63333, #C43B3B, #F44343);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .action-card {
            background: linear-gradient(135deg, #C43B3B, #F44343);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }
        
        .action-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s;
        }
        
        .action-card:hover::before {
            left: 100%;
        }
        
        .action-card:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: 0 25px 50px -12px rgba(196, 59, 59, 0.3);
        }

        .table-row {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .table-row:hover {
            background: rgba(196, 59, 59, 0.05);
            transform: translateX(4px);
        }

        .table-row.selected {
            background: rgba(196, 59, 59, 0.1);
            border-left: 4px solid #C43B3B;
        }
        
        .form-input {
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            border-color: #C43B3B;
            box-shadow: 0 0 0 4px rgba(196, 59, 59, 0.1);
        }
        
        .appointment-button {
            background: linear-gradient(135deg, #C43B3B, #F44343);
            transition: all 0.3s ease;
        }
        
        .appointment-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(196, 59, 59, 0.3);
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
                <img src="../assets/webStudent/Logo.png" alt="TeluSafe Logo" class="w-8 h-8 object-contain group-hover:rotate-12 transition-transform duration-300"/>
                </div>
                <span class="font-semibold text-lg leading-none select-text">TeluSafe</span>
            </div>
            
            <nav class="flex flex-col space-y-6 text-sm font-semibold stagger-animation">
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
                    <div class="flex items-center space-x-2 font-semibold text-white sidebar-active p-2">
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
                    <div class="flex items-center space-x-2 font-semibold text-white nav-item rounded-lg p-2 transition-all duration-300 hover:bg-white hover:bg-opacity-20">
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
        <main class="flex-1 flex flex-col min-h-screen animate-fade-in">
            <!-- Top bar -->
            <header class="glass-effect p-6 border-b border-gray-200/50 animate-slide-down">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                    <div class="relative w-full md:max-w-3xl">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input 
                            class="w-full pl-12 pr-4 py-3 bg-white/50 border border-gray-200/50 rounded-full focus:bg-white focus:border-telusafe-red focus:ring-4 focus:ring-telusafe-red/10 transition-all duration-300 outline-none placeholder-gray-400 hover:shadow-glow form-input search-focus" 
                            placeholder="🔍 Search counselors, schedules..." 
                            type="search"
                            id="searchInput"
                            oninput="handleSearch(this.value)"
                        />
                        <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <kbd class="px-2 py-1 text-xs bg-gray-100 rounded">Ctrl+K</kbd>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-3 glass-effect rounded-full p-2 card-hover cursor-pointer" onclick="showProfile()">
                            <img src="../assets/webStudent/iconorang 1.png" alt="User Profile" class="w-10 h-10 rounded-full object-cover"/>
                            <div class="text-right pr-2">
                                <p class="text-sm font-semibold leading-none" id="profileUsername">Loading...</p>
                                <p class="text-xs text-neutral-500 leading-none" id="profileStatus">Loading...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="flex-1 p-6 space-y-8 overflow-y-auto">
                <!-- Page Header -->
                <section class="animate-slide-up">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-telusafe-red to-telusafe-light-red rounded-xl flex items-center justify-center floating-animation">
                            <i class="fas fa-user-md text-white text-xl"></i>
                        </div>
                        <div>
                            <h1 class="text-[28px] font-bold font-poppins gradient-text">Bimbingan Konseling</h1>
                            <p class="text-gray-600">Layanan konseling profesional untuk kesehatan mental Anda</p>
                        </div>
                    </div>
                </section>

                <!-- Dashboard content grid -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <!-- Left and center content -->
                    <div class="lg:col-span-9 space-y-8">
                        <!-- Quick Actions -->
                        <section class="animate-slide-up">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 stagger-animation">
                                <div class="action-card rounded-2xl p-8 text-white card-hover cursor-pointer" onclick="navigateToSchedule()">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                                            <i class="fas fa-calendar-plus text-white text-2xl"></i>
                                        </div>
                                        <div>
                                            <h3 class="text-xl font-semibold font-poppins mb-1">Buat Jadwal</h3>
                                            <p class="text-white/80 text-sm">Atur jadwal konseling baru</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="action-card rounded-2xl p-8 text-white card-hover cursor-pointer" onclick="navigateToHistory()">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                                            <i class="fas fa-history text-white text-2xl"></i>
                                        </div>
                                        <div>
                                            <h3 class="text-xl font-semibold font-poppins mb-1">Riwayat Konseling</h3>
                                            <p class="text-white/80 text-sm">Lihat hasil konseling Anda</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Statistics -->
                        <section class="animate-slide-up">
                            <h2 class="text-xl font-semibold font-poppins mb-4 flex items-center">
                                <i class="fas fa-chart-bar text-telusafe-red mr-3"></i>
                                Statistik Konseling
                            </h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 stagger-animation">
                                <div class="glass-effect rounded-2xl p-6 shadow-soft card-hover border border-white/50">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                            <i class="fas fa-calendar-check text-blue-600 text-xl"></i>
                                        </div>
                                        <span class="text-xs text-green-600 font-medium bg-green-100 px-2 py-1 rounded-full">Active</span>
                                    </div>
                                    <p class="text-3xl font-bold text-gray-800 mb-1">5</p>
                                    <p class="text-sm text-gray-600">Sesi Dijadwalkan</p>
                                </div>
                                
                                <div class="glass-effect rounded-2xl p-6 shadow-soft card-hover border border-white/50">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                                        </div>
                                        <span class="text-xs text-blue-600 font-medium bg-blue-100 px-2 py-1 rounded-full">Complete</span>
                                    </div>
                                    <p class="text-3xl font-bold text-gray-800 mb-1">12</p>
                                    <p class="text-sm text-gray-600">Sesi Selesai</p>
                                </div>
                                
                                <div class="glass-effect rounded-2xl p-6 shadow-soft card-hover border border-white/50">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                                            <i class="fas fa-star text-orange-600 text-xl"></i>
                                        </div>
                                        <span class="text-xs text-orange-600 font-medium bg-orange-100 px-2 py-1 rounded-full">Excellent</span>
                                    </div>
                                    <p class="text-3xl font-bold text-gray-800 mb-1">4.8</p>
                                    <p class="text-sm text-gray-600">Rating Rata-rata</p>
                                </div>
                            </div>
                        </section>

                        <!-- Upcoming Sessions -->
                        <section class="animate-slide-up">
                            <h2 class="text-xl font-semibold font-poppins mb-4 flex items-center">
                                <i class="fas fa-calendar-alt text-telusafe-red mr-3"></i>
                                Jadwal Terdekat
                            </h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 stagger-animation">
                                <!-- Session Card 1 -->
                                <div class="glass-effect rounded-2xl p-6 shadow-soft card-hover border border-white/50">
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-12 h-12 bg-telusafe-pink rounded-xl flex items-center justify-center">
                                                <i class="fas fa-calendar text-telusafe-red text-xl"></i>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-gray-800">Konseling Rutin</h3>
                                                <p class="text-sm text-gray-600">Shinda Putrinanda, M.Psi.</p>
                                            </div>
                                        </div>
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium">Confirmed</span>
                                    </div>
                                    
                                    <div class="space-y-2 text-sm text-gray-600 mb-4">
                                        <div class="flex items-center space-x-2">
                                            <i class="fas fa-calendar-alt text-telusafe-red w-4"></i>
                                            <span>Senin, 14 April 2025</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <i class="fas fa-clock text-telusafe-red w-4"></i>
                                            <span>08:00 - 10:00 WIB</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <i class="fas fa-map-marker-alt text-telusafe-red w-4"></i>
                                            <span>Ruang BK Lt. 2</span>
                                        </div>
                                    </div>
                                    
                                    <div class="flex space-x-2">
                                        <button class="appointment-button text-white px-4 py-2 rounded-lg text-sm font-medium flex-1" onclick="joinSession()">
                                            <i class="fas fa-video mr-2"></i>
                                            Join Session
                                        </button>
                                        <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm hover:bg-gray-50 transition-colors" onclick="rescheduleSession()">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Session Card 2 -->
                                <div class="glass-effect rounded-2xl p-6 shadow-soft card-hover border border-white/50">
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                                                <i class="fas fa-clock text-orange-600 text-xl"></i>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-gray-800">Konseling Online</h3>
                                                <p class="text-sm text-gray-600">Dr. Ahmad Syukri, M.Psi.</p>
                                            </div>
                                        </div>
                                        <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-xs font-medium">Pending</span>
                                    </div>
                                    
                                    <div class="space-y-2 text-sm text-gray-600 mb-4">
                                        <div class="flex items-center space-x-2">
                                            <i class="fas fa-calendar-alt text-orange-600 w-4"></i>
                                            <span>Rabu, 16 April 2025</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <i class="fas fa-clock text-orange-600 w-4"></i>
                                            <span>13:00 - 15:00 WIB</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <i class="fas fa-laptop text-orange-600 w-4"></i>
                                            <span>Zoom Meeting</span>
                                        </div>
                                    </div>
                                    
                                    <div class="flex space-x-2">
                                        <button class="px-4 py-2 bg-gray-300 text-gray-600 rounded-lg text-sm cursor-not-allowed flex-1" disabled>
                                            <i class="fas fa-hourglass-half mr-2"></i>
                                            Waiting
                                        </button>
                                        <button class="px-4 py-2 border border-red-300 text-red-600 rounded-lg text-sm hover:bg-red-50 transition-colors" onclick="cancelSession()">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Available Slots -->
                        <section class="animate-slide-up">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-xl font-semibold font-poppins flex items-center">
                                    <i class="fas fa-search text-telusafe-red mr-3"></i>
                                    Jadwal Tersedia
                                </h2>
                                <button class="appointment-button text-white px-4 py-2 rounded-lg text-sm font-medium" onclick="bookNewAppointment()">
                                    <i class="fas fa-plus mr-2"></i>
                                    Book New Session
                                </button>
                            </div>
                            
                            <!-- Filters -->
                            <div class="mb-6 flex flex-wrap gap-4">
                                <select class="px-4 py-2 border border-gray-200 rounded-lg focus:border-telusafe-red focus:ring-4 focus:ring-telusafe-red/10 transition-all duration-300 outline-none bg-white text-gray-700 form-input" onchange="filterSchedules(this.value)">
                                    <option value="">Pilih Hari</option>
                                    <option value="senin">Senin</option>
                                    <option value="selasa">Selasa</option>
                                    <option value="rabu">Rabu</option>
                                    <option value="kamis">Kamis</option>
                                    <option value="jumat">Jumat</option>
                                </select>
                                <select class="px-4 py-2 border border-gray-200 rounded-lg focus:border-telusafe-red focus:ring-4 focus:ring-telusafe-red/10 transition-all duration-300 outline-none bg-white text-gray-700 form-input" onchange="filterBySpecialty(this.value)">
                                    <option value="">Pilih Spesialis</option>
                                    <option value="remaja">Remaja</option>
                                    <option value="keluarga">Keluarga</option>
                                    <option value="trauma">Trauma</option>
                                    <option value="anxiety">Anxiety & Stress</option>
                                </select>
                            </div>
                            
                            <!-- Table -->
                            <div class="glass-effect rounded-2xl shadow-soft border border-white/50 overflow-hidden">
                                <div class="overflow-x-auto">
                                    <table class="w-full">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="text-left py-4 px-6 font-semibold text-sm text-gray-700">Tanggal</th>
                                                <th class="text-left py-4 px-6 font-semibold text-sm text-gray-700">Waktu</th>
                                                <th class="text-left py-4 px-6 font-semibold text-sm text-gray-700">Psikolog</th>
                                                <th class="text-left py-4 px-6 font-semibold text-sm text-gray-700">Spesialis</th>
                                                <th class="text-left py-4 px-6 font-semibold text-sm text-gray-700">Mode</th>
                                                <th class="text-left py-4 px-6 font-semibold text-sm text-gray-700">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="table-row border-b border-gray-100" data-psychologist="Shinda Putrinanda">
                                                <td class="py-4 px-6 text-sm font-medium text-gray-800">18 Maret 2025</td>
                                                <td class="py-4 px-6 text-sm text-gray-600">08:00 - 10:00</td>
                                                <td class="py-4 px-6">
                                                    <div class="flex items-center space-x-3">
                                                        <div class="w-8 h-8 bg-telusafe-pink rounded-full flex items-center justify-center">
                                                            <i class="fas fa-user-md text-telusafe-red text-xs"></i>
                                                        </div>
                                                        <div>
                                                            <p class="text-sm font-medium text-gray-800">Shinda Putrinanda</p>
                                                            <p class="text-xs text-gray-500">M.Psi., Psikolog</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-4 px-6">
                                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">Remaja</span>
                                                </td>
                                                <td class="py-4 px-6">
                                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">Luring</span>
                                                </td>
                                                <td class="py-4 px-6">
                                                    <button class="appointment-button text-white px-3 py-2 rounded-lg text-xs font-medium" onclick="bookAppointment(1)">
                                                        <i class="fas fa-calendar-plus mr-1"></i>
                                                        Book
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr class="table-row border-b border-gray-100" data-psychologist="Ahmad Syukri">
                                                <td class="py-4 px-6 text-sm font-medium text-gray-800">19 Maret 2025</td>
                                                <td class="py-4 px-6 text-sm text-gray-600">13:00 - 15:00</td>
                                                <td class="py-4 px-6">
                                                    <div class="flex items-center space-x-3">
                                                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                                            <i class="fas fa-user-md text-purple-600 text-xs"></i>
                                                        </div>
                                                        <div>
                                                            <p class="text-sm font-medium text-gray-800">Dr. Ahmad Syukri</p>
                                                            <p class="text-xs text-gray-500">M.Psi., Psikolog</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-4 px-6">
                                                    <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs">Trauma</span>
                                                </td>
                                                <td class="py-4 px-6">
                                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">Online</span>
                                                </td>
                                                <td class="py-4 px-6">
                                                    <button class="appointment-button text-white px-3 py-2 rounded-lg text-xs font-medium" onclick="bookAppointment(2)">
                                                        <i class="fas fa-calendar-plus mr-1"></i>
                                                        Book
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr class="table-row border-b border-gray-100" data-psychologist="Maria Sari">
                                                <td class="py-4 px-6 text-sm font-medium text-gray-800">20 Maret 2025</td>
                                                <td class="py-4 px-6 text-sm text-gray-600">10:00 - 12:00</td>
                                                <td class="py-4 px-6">
                                                    <div class="flex items-center space-x-3">
                                                        <div class="w-8 h-8 bg-pink-100 rounded-full flex items-center justify-center">
                                                            <i class="fas fa-user-md text-pink-600 text-xs"></i>
                                                        </div>
                                                        <div>
                                                            <p class="text-sm font-medium text-gray-800">Maria Sari</p>
                                                            <p class="text-xs text-gray-500">M.Psi., Psikolog</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-4 px-6">
                                                    <span class="bg-pink-100 text-pink-800 px-2 py-1 rounded-full text-xs">Stress</span>
                                                </td>
                                                <td class="py-4 px-6">
                                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">Luring</span>
                                                </td>
                                                <td class="py-4 px-6">
                                                    <button class="appointment-button text-white px-3 py-2 rounded-lg text-xs font-medium" onclick="bookAppointment(3)">
                                                        <i class="fas fa-calendar-plus mr-1"></i>
                                                        Book
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <!-- Pagination -->
                                <div class="flex items-center justify-between p-6 border-t border-gray-200 bg-gray-50">
                                    <p class="text-sm text-gray-600">Showing 1-3 of 15 available slots</p>
                                    <div class="flex space-x-2">
                                        <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm hover:bg-white transition-colors" onclick="previousPage()">
                                            <i class="fas fa-chevron-left mr-1"></i>
                                            Previous
                                        </button>
                                        <button class="px-3 py-2 bg-telusafe-red text-white rounded-lg text-sm">1</button>
                                        <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm hover:bg-white transition-colors">2</button>
                                        <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm hover:bg-white transition-colors" onclick="nextPage()">
                                            Next
                                            <i class="fas fa-chevron-right ml-1"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- Right sidebar -->
                    <aside class="lg:col-span-3 space-y-6 animate-slide-left">
                        <!-- News -->
                        <div class="glass-effect rounded-2xl shadow-soft card-hover border border-white/50 overflow-hidden cursor-pointer" onclick="readNews()">
                            <div class="h-32 bg-gradient-to-br from-telusafe-red to-telusafe-light-red flex items-center justify-center">
                                <i class="fas fa-graduation-cap text-white text-3xl"></i>
                            </div>
                            <div class="p-4">
                                <h4 class="font-semibold text-sm mb-2">Cara Menggunakan Layanan BK</h4>
                                <p class="text-xs text-gray-600 mb-3">Panduan lengkap layanan konseling</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-gray-500">2 jam lalu</span>
                                    <i class="fas fa-arrow-right text-telusafe-red"></i>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Tips -->
                        <div class="glass-effect rounded-2xl p-4 shadow-soft border border-white/50">
                            <h3 class="font-semibold text-sm mb-4 flex items-center">
                                <i class="fas fa-lightbulb text-telusafe-red mr-2"></i>
                                Tips Konseling
                            </h3>
                            <div class="space-y-3">
                                <div class="p-3 bg-blue-50 rounded-xl card-hover cursor-pointer" onclick="showTip('preparation')">
                                    <div class="flex items-center space-x-2 mb-1">
                                        <i class="fas fa-list-check text-blue-500"></i>
                                        <span class="text-sm font-medium">Persiapan Konseling</span>
                                    </div>
                                    <p class="text-xs text-gray-600">Tips mempersiapkan sesi</p>
                                </div>
                                <div class="p-3 bg-green-50 rounded-xl card-hover cursor-pointer" onclick="showTip('benefits')">
                                    <div class="flex items-center space-x-2 mb-1">
                                        <i class="fas fa-heart text-green-500"></i>
                                        <span class="text-sm font-medium">Manfaat Konseling</span>
                                    </div>
                                    <p class="text-xs text-gray-600">Keuntungan konseling rutin</p>
                                </div>
                                <div class="p-3 bg-purple-50 rounded-xl card-hover cursor-pointer" onclick="showTip('privacy')">
                                    <div class="flex items-center space-x-2 mb-1">
                                        <i class="fas fa-shield-alt text-purple-500"></i>
                                        <span class="text-sm font-medium">Privasi & Keamanan</span>
                                    </div>
                                    <p class="text-xs text-gray-600">Jaminan kerahasiaan data</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Emergency -->
                        <div class="glass-effect rounded-2xl p-4 shadow-soft border border-white/50 bg-gradient-to-br from-red-50 to-orange-50">
                            <h3 class="font-semibold text-sm mb-3 flex items-center text-red-600">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                Bantuan Darurat
                            </h3>
                            <p class="text-xs text-gray-600 mb-3">Jika membutuhkan bantuan segera:</p>
                            <button class="w-full bg-red-500 text-white py-2 px-4 rounded-lg text-sm font-medium hover:bg-red-600 transition-colors" onclick="emergencyContact()">
                                <i class="fas fa-phone mr-2"></i>
                                Crisis Hotline
                            </button>
                        </div>
                    </aside>
                </div>
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

    <!-- Booking Modal -->
    <div id="bookingModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300">
        <div class="glass-effect rounded-2xl p-6 max-w-md w-full mx-4 transform scale-90 transition-transform duration-300">
            <div class="text-center">
                <div class="w-16 h-16 bg-telusafe-pink rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-calendar-check text-telusafe-red text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold mb-2" id="booking-title">Konfirmasi Booking</h3>
                <p class="text-gray-600 mb-6" id="booking-message">Apakah Anda yakin ingin membuat jadwal konseling ini?</p>
                <div class="flex space-x-3">
                    <button class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-sm hover:bg-gray-50 transition-colors" onclick="closeBookingModal()">
                        Batal
                    </button>
                    <button class="flex-1 px-4 py-2 bg-telusafe-red text-white rounded-lg text-sm hover:bg-telusafe-dark-red transition-colors" onclick="confirmBooking()">
                        Konfirmasi
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedAppointment = null;

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            initializeTableHandlers();
            
            // Search keyboard shortcut
            document.addEventListener('keydown', (e) => {
                if (e.ctrlKey && e.key === 'k') {
                    e.preventDefault();
                    document.getElementById('searchInput').focus();
                }
            });
            
            showToast('Dashboard Ready', 'Layanan bimbingan konseling siap digunakan', 'success');
        });

        function initializeTableHandlers() {
            const tableRows = document.querySelectorAll('.table-row');
            tableRows.forEach(row => {
                row.addEventListener('click', function(e) {
                    if (!e.target.closest('button')) {
                        tableRows.forEach(r => r.classList.remove('selected'));
                        this.classList.add('selected');
                        
                        const psychologist = this.getAttribute('data-psychologist');
                        showToast('Schedule Selected', `Dipilih: ${psychologist}`, 'info');
                    }
                });
                
                row.addEventListener('dblclick', function() {
                    const rowId = this.children[0].textContent;
                    bookAppointment(parseInt(rowId));
                });
            });
        }

        // Navigation functions
        function navigateToSchedule() {
            showToast('Navigation', 'Membuka halaman buat jadwal konseling...', 'info');
        }

        function navigateToHistory() {
            showToast('Navigation', 'Membuka riwayat konseling...', 'info');
        }

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

        function readNews() {
            showToast('News', 'Opening news article...', 'info');
        }

        function logout() {
            showToast('Logout', 'Logging out...', 'warning');
            setTimeout(() => {
                showToast('Goodbye', 'Stay safe and take care!', 'success');
                window.location.href = 'login';
            }, 1000);
        }

        // Counseling functions
        function joinSession() {
            showToast('Joining Session', 'Bergabung ke sesi konseling...', 'success');
        }

        function rescheduleSession() {
            showToast('Reschedule', 'Membuka opsi reschedule...', 'info');
        }

        function cancelSession() {
            if (confirm('Apakah Anda yakin ingin membatalkan sesi konseling ini?')) {
                showToast('Session Canceled', 'Sesi konseling berhasil dibatalkan', 'warning');
            }
        }

        function bookNewAppointment() {
            showToast('New Appointment', 'Membuka form booking baru...', 'info');
        }

        function filterSchedules(day) {
            if (day) {
                showToast('Filter Applied', `Memfilter jadwal untuk hari: ${day}`, 'info');
            }
        }

        function filterBySpecialty(specialty) {
            if (specialty) {
                showToast('Filter Applied', `Memfilter berdasarkan spesialis: ${specialty}`, 'info');
            }
        }

        function bookAppointment(appointmentId) {
            selectedAppointment = appointmentId;
            const row = document.querySelector(`[data-psychologist]`);
            const psychologist = row ? row.getAttribute('data-psychologist') : 'Psikolog';
            
            showBookingModal('Konfirmasi Booking', `Apakah Anda yakin ingin membuat jadwal dengan ${psychologist}?`);
        }

        function showBookingModal(title, message) {
            const modal = document.getElementById('bookingModal');
            document.getElementById('booking-title').textContent = title;
            document.getElementById('booking-message').textContent = message;
            
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.querySelector('.glass-effect').classList.remove('scale-90');
            modal.querySelector('.glass-effect').classList.add('scale-100');
        }

        function closeBookingModal() {
            const modal = document.getElementById('bookingModal');
            modal.querySelector('.glass-effect').classList.remove('scale-100');
            modal.querySelector('.glass-effect').classList.add('scale-90');
            
            setTimeout(() => {
                modal.classList.add('opacity-0', 'pointer-events-none');
            }, 200);
            
            selectedAppointment = null;
        }

        function confirmBooking() {
            if (selectedAppointment) {
                showToast('Booking Confirmed', 'Jadwal konseling berhasil dibuat!', 'success');
                
                setTimeout(() => {
                    showToast('Notification Sent', 'Konfirmasi telah dikirim ke email Anda', 'info');
                }, 2000);
            }
            
            closeBookingModal();
        }

        function previousPage() {
            showToast('Navigation', 'Halaman sebelumnya', 'info');
        }

        function nextPage() {
            showToast('Navigation', 'Halaman selanjutnya', 'info');
        }

        function showTip(topic) {
            const tips = {
                'preparation': {
                    title: 'Persiapan Konseling',
                    message: 'Siapkan daftar topik yang ingin dibahas dan datang dengan pikiran terbuka.'
                },
                'benefits': {
                    title: 'Manfaat Konseling',
                    message: 'Konseling dapat membantu mengatasi stress, kecemasan, dan meningkatkan kesejahteraan mental.'
                },
                'privacy': {
                    title: 'Privasi & Keamanan',
                    message: 'Semua informasi yang dibagikan dalam sesi konseling dijamin kerahasiaannya.'
                }
            };
            
            const tip = tips[topic];
            showToast(tip.title, tip.message, 'info');
        }

        function emergencyContact() {
            showToast('Emergency Contact', 'Menghubungkan ke crisis hotline...', 'warning');
            setTimeout(() => {
                showToast('Connected', 'Bantuan darurat tersedia 24/7', 'info');
            }, 1500);
        }

        function handleSearch(query) {
            if (query.length > 2) {
                const tableRows = document.querySelectorAll('.table-row');
                tableRows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(query.toLowerCase())) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });
                
                showToast('Search Results', `Mencari: "${query}"`, 'info');
            } else {
                const tableRows = document.querySelectorAll('.table-row');
                tableRows.forEach(row => {
                    row.style.display = 'table-row';
                });
            }
        }

        function showToast(title, message, type = 'success') {
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
        }

        // Add ripple effect to clickable elements
        document.addEventListener('click', function(e) {
            if (e.target.matches('.card-hover, .nav-item, .action-card, .table-row, .appointment-button, button')) {
                const ripple = document.createElement('span');
                const rect = e.target.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.className = 'absolute rounded-full bg-white/30 pointer-events-none';
                ripple.style.transform = 'scale(0)';
                ripple.style.animation = 'ripple 0.6s linear';
                
                const target = e.target.closest('.card-hover, .nav-item, .action-card, .table-row, .appointment-button, button');
                if (target) {
                    target.style.position = 'relative';
                    target.appendChild(ripple);
                    
                    setTimeout(() => {
                        if (ripple.parentNode) {
                            ripple.parentNode.removeChild(ripple);
                        }
                    }, 600);
                }
            }
        });
    </script>
</body>
</html>