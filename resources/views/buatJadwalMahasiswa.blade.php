<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>TeluSafe - Buat Jadwal Konseling</title>
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
                    borderRadius: { '4xl': '2rem', '5xl': '2.5rem' },
                    boxShadow: {
                        'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04)',
                        'medium': '0 4px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 30px -5px rgba(0, 0, 0, 0.05)',
                        'strong': '0 10px 40px -10px rgba(0, 0, 0, 0.15), 0 20px 25px -5px rgba(0, 0, 0, 0.1)',
                        'glow': '0 0 20px rgba(196, 59, 59, 0.15)',
                        'glow-strong': '0 0 30px rgba(196, 59, 59, 0.25)'
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'slide-down': 'slideDown 0.6s ease-out',
                        'slide-left': 'slideLeft 0.6s ease-out',
                        'slide-right': 'slideRight 0.6s ease-out',
                        'scale-in': 'scaleIn 0.4s ease-out',
                        'bounce-gentle': 'bounceGentle 2s infinite',
                        'float': 'float 3s ease-in-out infinite',
                        'pulse-soft': 'pulseSoft 2s infinite',
                        'wiggle': 'wiggle 1s ease-in-out infinite',
                        'gradient-shift': 'gradientShift 3s ease-in-out infinite',
                        'notification-bounce': 'notificationBounce 2s infinite',
                        'notification-pulse': 'notificationPulse 2s infinite',
                        'calendar-pop': 'calendarPop 0.3s ease-out',
                        'form-slide': 'formSlide 0.5s ease-out'
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
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-15px)' }
                        },
                        pulseSoft: {
                            '0%, 100%': { transform: 'scale(1)', opacity: '1' },
                            '50%': { transform: 'scale(1.05)', opacity: '0.8' }
                        },
                        wiggle: {
                            '0%, 100%': { transform: 'rotate(-3deg)' },
                            '50%': { transform: 'rotate(3deg)' }
                        },
                        gradientShift: {
                            '0%, 100%': { 'background-position': '0% 50%' },
                            '50%': { 'background-position': '100% 50%' }
                        },
                        notificationBounce: {
                            '0%, 100%': { transform: 'scale(1)' },
                            '50%': { transform: 'scale(1.3)' }
                        },
                        notificationPulse: {
                            '0%, 100%': { transform: 'scale(1)', opacity: '1' },
                            '50%': { transform: 'scale(1.2)', opacity: '0.8' }
                        },
                        calendarPop: {
                            '0%': { transform: 'scale(0.8)', opacity: '0' },
                            '100%': { transform: 'scale(1)', opacity: '1' }
                        },
                        formSlide: {
                            '0%': { transform: 'translateX(-20px)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' }
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
    
        
        .calendar-day {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border-radius: 8px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }
        
        .calendar-day:hover {
            background-color: #f3f4f6;
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .calendar-day.selected {
            background-color: #C43B3B;
            color: white;
            transform: scale(1.15);
            box-shadow: 0 6px 20px rgba(196, 59, 59, 0.4);
            animation: calendarPop 0.3s ease-out;
        }
        
        .calendar-day.today {
            border: 2px solid #C43B3B;
            font-weight: 600;
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #A63333, #C43B3B, #F44343);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradientShift 3s ease-in-out infinite;
        }
        
        .form-stagger > div {
            opacity: 1; /* Adjusted for immediate visibility, animation handles fade-in */
            animation: formSlide 0.6s ease-out;
        }
        
        .form-stagger > div:nth-child(1) { animation-delay: 0.1s; }
        .form-stagger > div:nth-child(2) { animation-delay: 0.2s; }
        .form-stagger > div:nth-child(3) { animation-delay: 0.3s; }
        .form-stagger > div:nth-child(4) { animation-delay: 0.4s; }
        .form-stagger > div:nth-child(5) { animation-delay: 0.5s; }
        .form-stagger > div:nth-child(6) { animation-delay: 0.6s; }
        
        .form-element {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .form-element:focus {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(196, 59, 59, 0.15);
        }
        
        .form-element:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .card-glow {
            position: relative;
            overflow: hidden;
        }
        
        .card-glow::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(196, 59, 59, 0.1) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .card-glow:hover::after {
            opacity: 1;
        }
        
        .calendar-container {
            animation: slideLeft 0.6s ease-out;
        }
        
        .form-container {
            animation: slideRight 0.6s ease-out;
        }
        
        .notification-pulse {
            animation: notificationPulse 2s infinite;
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
                        <a class="flex items-center space-x-2 hover:underline nav-item p-1 rounded" href="#" onclick="scheduleConseling()">
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

        <main class="flex-1 flex flex-col min-h-screen animate-fade-in">
            <header class="glass-effect p-6 border-b border-gray-200/50 animate-slide-down">
                <div class="flex flex-col md:flex-row md:items-center md:justify-end space-y-4 md:space-y-0">
                    
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
                <section class="animate-slide-up">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-telusafe-red to-telusafe-light-red rounded-xl flex items-center justify-center floating-animation">
                            <i class="fas fa-calendar-plus text-white text-xl"></i>
                        </div>
                        <div>
                            <h1 class="text-[28px] font-bold font-poppins gradient-text">Buat Jadwal Konseling</h1>
                            <p class="text-gray-600">Atur jadwal konseling dengan mudah dan fleksibel</p>
                        </div>
                    </div>
                </section>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <div class="lg:col-span-9 space-y-6">
                        <section class="animate-slide-up">
                            <h2 class="text-[20px] font-poppins font-semibold mb-4 flex items-center">
                                <i class="fas fa-calendar-check text-telusafe-red mr-3 animate-wiggle"></i>
                                Jadwal Konseling Mendatang
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                                <div class="glass-effect rounded-2xl p-6 shadow-soft card-hover border border-white/50 card-glow animate-slide-up">
                                    <div class="flex items-start space-x-4">
                                        <div class="w-12 h-12 bg-telusafe-pink rounded-2xl flex items-center justify-center animate-pulse-soft">
                                            <i class="fas fa-calendar text-telusafe-red text-xl"></i>
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="text-[16px] font-semibold font-poppins text-telusafe-red mb-3">Konseling Rutin</h3>
                                            <div class="space-y-2 text-sm">
                                                <div class="flex items-center space-x-2">
                                                    <i class="fas fa-calendar-alt text-telusafe-red text-xs"></i>
                                                    <span class="text-gray-700">Senin, 14 April 2025</span>
                                                </div>
                                                <div class="flex items-center space-x-2">
                                                    <i class="fas fa-clock text-telusafe-red text-xs"></i>
                                                    <span class="text-gray-700">08.00 - 10.00 WIB</span>
                                                </div>
                                                <div class="flex items-center space-x-2">
                                                    <i class="fas fa-map-marker-alt text-telusafe-red text-xs"></i>
                                                    <span class="text-gray-700">Luring</span>
                                                </div>
                                                <div class="flex items-center space-x-2">
                                                    <i class="fas fa-user-md text-telusafe-red text-xs"></i>
                                                    <span class="text-gray-700">Rosi Hernawati, M.Psi., Psikolog</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="glass-effect rounded-2xl p-6 shadow-soft card-hover border border-white/50 card-glow animate-slide-up" style="animation-delay: 0.2s;">
                                    <div class="flex items-start space-x-4">
                                        <div class="w-12 h-12 bg-telusafe-pink rounded-2xl flex items-center justify-center animate-pulse-soft">
                                            <i class="fas fa-video text-telusafe-red text-xl"></i>
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="text-[16px] font-semibold font-poppins text-telusafe-red mb-3">Konseling Online</h3>
                                            <div class="space-y-2 text-sm">
                                                <div class="flex items-center space-x-2">
                                                    <i class="fas fa-calendar-alt text-telusafe-red text-xs"></i>
                                                    <span class="text-gray-700">Rabu, 16 April 2025</span>
                                                </div>
                                                <div class="flex items-center space-x-2">
                                                    <i class="fas fa-clock text-telusafe-red text-xs"></i>
                                                    <span class="text-gray-700">14.00 - 16.00 WIB</span>
                                                </div>
                                                <div class="flex items-center space-x-2">
                                                    <i class="fas fa-laptop text-telusafe-red text-xs"></i>
                                                    <span class="text-gray-700">Daring</span>
                                                </div>
                                                <div class="flex items-center space-x-2">
                                                    <i class="fas fa-user-md text-telusafe-red text-xs"></i>
                                                    <span class="text-gray-700">Shinta Putrinanda, M.Psi., Psikolog</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="animate-slide-up">
                            <div class="glass-effect rounded-4xl p-8 shadow-strong border border-white/50">
                                <h2 class="text-[24px] font-semibold font-poppins mb-6 gradient-text flex items-center">
                                    <i class="fas fa-plus-circle mr-3 animate-bounce-gentle"></i>
                                    Buat Jadwal Baru
                                </h2>
                                
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                    <div class="space-y-6 form-container">
                                        <div class="form-stagger">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                                    <i class="fas fa-clipboard-list text-telusafe-red mr-2"></i>
                                                    Jenis Kunjungan
                                                </label>
                                                <select id="jenisKunjungan" class="w-full px-4 py-3 border border-gray-200 rounded-2xl focus:border-telusafe-red focus:ring-4 focus:ring-telusafe-red/10 transition-all duration-300 outline-none bg-white text-gray-700 form-element">
                                                    <option value="">Pilih jenis kunjungan</option>
                                                    <option value="baru">Baru</option> <option value="konsultasi">Konsultasi</option>
                                                    <option value="terapi">Terapi</option>
                                                    <option value="asesmen">Asesmen</option>
                                                    <option value="follow-up">Follow Up</option>
                                                </select>
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                                    <i class="fas fa-desktop text-telusafe-red mr-2"></i>
                                                    Media Konseling
                                                </label>
                                                <select id="mediaKonseling" class="w-full px-4 py-3 border border-gray-200 rounded-2xl focus:border-telusafe-red focus:ring-4 focus:ring-telusafe-red/10 transition-all duration-300 outline-none bg-white text-gray-700 form-element">
                                                    <option value="">Pilih media konseling</option>
                                                    <option value="luring">Luring (Offline)</option> <option value="daring">Daring (Online)</option>
                                                    <option value="hybrid">Hybrid</option>
                                                </select>
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                                    <i class="fas fa-user-md text-telusafe-red mr-2"></i>
                                                    Psikolog
                                                </label>
                                                <select id="psikolog" class="w-full px-4 py-3 border border-gray-200 rounded-2xl focus:border-telusafe-red focus:ring-4 focus:ring-telusafe-red/10 transition-all duration-300 outline-none bg-white text-gray-700 form-element">
                                                    <option value="">Pilih psikolog</option>
                                                    <option value="Shinta Putrinanda, M.Psi., Psikolog">Shinta Putrinanda, M.Psi., Psikolog</option> 
                                                    <option value="Rosi Hernawati, M.Psi., Psikolog">Rosi Hernawati, M.Psi., Psikolog</option>
                                                </select>
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                                    <i class="fas fa-clock text-telusafe-red mr-2"></i>
                                                    Waktu Konseling
                                                </label>
                                                <select id="waktuKonseling" class="w-full px-4 py-3 border border-gray-200 rounded-2xl focus:border-telusafe-red focus:ring-4 focus:ring-telusafe-red/10 transition-all duration-300 outline-none bg-white text-gray-700 form-element">
                                                    <option value="">Pilih waktu</option>
                                                    <option value="08:00 - 10:00">08:00 - 10:00 WIB</option>
                                                    <option value="10.00 - 11.00">10:00 - 11:00 WIB</option> <option value="10:00 - 12:00">10:00 - 12:00 WIB</option>
                                                    <option value="13:00 - 15:00">13:00 - 15:00 WIB</option>
                                                    <option value="15:00 - 17:00">15:00 - 17:00 WIB</option>
                                                </select>
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                                    <i class="fas fa-sticky-note text-telusafe-red mr-2"></i>
                                                    Catatan (Opsional)
                                                </label>
                                                <textarea 
                                                    id="catatanKonseling"
                                                    class="w-full px-4 py-3 border border-gray-200 rounded-2xl focus:border-telusafe-red focus:ring-4 focus:ring-telusafe-red/10 transition-all duration-300 outline-none bg-white text-gray-700 form-element resize-none"
                                                    rows="3"
                                                    placeholder="Tuliskan catatan khusus atau keluhan yang ingin disampaikan..."
                                                ></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="calendar-container">
                                        <h3 class="text-sm font-medium text-gray-700 mb-4 flex items-center">
                                            <i class="fas fa-calendar-alt text-telusafe-red mr-2 animate-bounce-gentle"></i>
                                            Pilih Tanggal Konseling
                                        </h3>
                                        
                                        <div class="glass-effect rounded-2xl p-6 border border-white/50 shadow-soft">
                                            <div class="flex items-center justify-between mb-4">
                                                <button type="button" id="prevMonth" class="p-2 hover:bg-gray-200 rounded-2xl transition-all duration-300 hover:scale-110">
                                                    <i class="fas fa-chevron-left text-gray-600"></i>
                                                </button>
                                                <h3 id="monthYear" class="font-semibold text-gray-800 text-lg">Desember 2024</h3>
                                                <button type="button" id="nextMonth" class="p-2 hover:bg-gray-200 rounded-2xl transition-all duration-300 hover:scale-110">
                                                    <i class="fas fa-chevron-right text-gray-600"></i>
                                                </button>
                                            </div>
                                            
                                            <div class="grid grid-cols-7 gap-1 mb-2">
                                                <div class="text-xs font-medium text-gray-500 text-center py-2">Sen</div>
                                                <div class="text-xs font-medium text-gray-500 text-center py-2">Sel</div>
                                                <div class="text-xs font-medium text-gray-500 text-center py-2">Rab</div>
                                                <div class="text-xs font-medium text-gray-500 text-center py-2">Kam</div>
                                                <div class="text-xs font-medium text-gray-500 text-center py-2">Jum</div>
                                                <div class="text-xs font-medium text-gray-500 text-center py-2">Sab</div>
                                                <div class="text-xs font-medium text-gray-500 text-center py-2">Min</div>
                                            </div>
                                            
                                            <div id="calendarGrid" class="grid grid-cols-7 gap-1 mb-6">
                                                </div>
                                            
                                            <div class="glass-effect rounded-2xl p-4 mb-4 border border-gray-200/50">
                                                <div class="flex items-center justify-between">
                                                    <span class="text-sm text-gray-600">Tanggal dipilih:</span>
                                                    <span id="selectedDate" class="text-sm font-semibold text-telusafe-red">Belum dipilih</span>
                                                </div>
                                            </div>
                                            
                                            <button type="button" id="confirmDateTime" class="w-full bg-gradient-to-r from-telusafe-red to-telusafe-light-red hover:from-telusafe-dark-red hover:to-telusafe-red text-white py-3 px-4 rounded-2xl transition-all duration-300 hover:shadow-glow-strong font-medium hover:scale-105 transform">
                                                <i class="fas fa-check mr-2"></i>
                                                Konfirmasi Tanggal
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-end space-x-4 mt-8 animate-slide-up">
                                    <button type="button" class="bg-white border border-gray-300 text-gray-600 py-3 px-6 rounded-2xl hover:bg-gray-50 transition-all duration-300 font-medium hover:scale-105 transform" onclick="resetForm()">
                                        <i class="fas fa-times mr-2"></i>
                                        Batal
                                    </button>
                                    <button type="button" id="saveSchedule" class="bg-gradient-to-r from-telusafe-red to-telusafe-light-red hover:from-telusafe-dark-red hover:to-telusafe-red text-white py-3 px-6 rounded-2xl transition-all duration-300 hover:shadow-glow-strong font-medium hover:scale-105 transform">
                                        <i class="fas fa-save mr-2"></i>
                                        Simpan Jadwal
                                    </button>
                                </div>
                            </div>
                        </section>
                    </div>

                    <aside class="lg:col-span-3 space-y-6 animate-slide-left">
                        <div>
                            <h3 class="font-bold text-base mb-3 flex items-center">
                                <i class="fas fa-newspaper text-telusafe-500 mr-2 animate-bounce-gentle"></i>
                                Berita Telkom University
                            </h3>
                            <div class="glass-effect rounded-2xl shadow-soft hover-lift border border-white/50 overflow-hidden cursor-pointer" onclick="readNews()">
                                <div class="h-40 bg-gradient-to-br from-telusafe-500 to-telusafe-600 flex items-center justify-center animate-gradient-shift">
                                    <img src="../assets/webStudent/BK.jpg" alt="Alur Konseling BK" class="max-h-full max-w-full object-contain">
                                </div>
                                <div class="p-4">
                                    <h4 class="text-sm font-semibold leading-tight mb-2">Begini Cara Menggunakan Layanan BK</h4>
                                    <p class="text-xs text-neutral-600 mb-3">Panduan lengkap untuk mengakses layanan bimbingan konseling</p>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </main>
    </div>

    <div id="toast" class="fixed top-4 right-4 bg-white border-l-4 border-telusafe-red rounded-lg shadow-lg p-4 transform translate-x-full transition-transform duration-300 z-50">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-3 animate-bounce-gentle" id="toast-icon"></i>
            <div>
                <p class="font-semibold text-sm" id="toast-title">Success!</p>
                <p class="text-xs text-gray-600" id="toast-message">Action completed successfully!</p>
            </div>
        </div>
    </div>

    <script>
        // Global calendar instance
        let appCalendarInstance;

        // Enhanced Calendar functionality
        class Calendar {
            constructor() {
                this.currentDate = new Date();
                this.selectedDate = null;
                this.today = new Date();
                this.today.setHours(0,0,0,0); // Normalize today's date to midnight for comparison
                this.months = [
                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                ];
                this.init();
            }

            init() {
                this.renderCalendar();
                this.bindEvents();
                this.updateDisplay();
            }

            bindEvents() {
                document.getElementById('prevMonth').addEventListener('click', () => {
                    this.currentDate.setMonth(this.currentDate.getMonth() - 1);
                    this.renderCalendar();
                    this.addNavigationEffect('prev');
                });

                document.getElementById('nextMonth').addEventListener('click', () => {
                    this.currentDate.setMonth(this.currentDate.getMonth() + 1);
                    this.renderCalendar();
                    this.addNavigationEffect('next');
                });

                document.getElementById('confirmDateTime').addEventListener('click', () => {
                    if (this.selectedDate) {
                        this.updateDisplay();
                        this.createCelebration();
                        showToast('Tanggal Dipilih!', `Tanggal ${this.formatDate(this.selectedDate)} telah dipilih`, 'success');
                    } else {
                        showToast('Pilih Tanggal', 'Silakan pilih tanggal terlebih dahulu', 'warning');
                    }
                });
            }

            addNavigationEffect(direction) {
                const calendar = document.getElementById('calendarGrid');
                calendar.style.transform = direction === 'prev' ? 'translateX(-20px)' : 'translateX(20px)';
                calendar.style.opacity = '0.7';
                
                setTimeout(() => {
                    calendar.style.transform = 'translateX(0)';
                    calendar.style.opacity = '1';
                }, 150);
            }

            renderCalendar() {
                const monthYear = document.getElementById('monthYear');
                const calendarGrid = document.getElementById('calendarGrid');
                
                monthYear.style.transform = 'scale(0.9)';
                monthYear.style.opacity = '0.7';
                
                setTimeout(() => {
                    monthYear.textContent = `${this.months[this.currentDate.getMonth()]} ${this.currentDate.getFullYear()}`;
                    monthYear.style.transform = 'scale(1)';
                    monthYear.style.opacity = '1';
                }, 100);
                
                calendarGrid.innerHTML = '';
                
                const firstDay = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth(), 1);
                const lastDay = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() + 1, 0);
                const daysInMonth = lastDay.getDate();
                
                let firstDayOfWeek = firstDay.getDay();
                firstDayOfWeek = firstDayOfWeek === 0 ? 6 : firstDayOfWeek - 1; 
                
                for (let i = 0; i < firstDayOfWeek; i++) {
                    const emptyDay = document.createElement('div');
                    emptyDay.className = 'calendar-day text-sm';
                    calendarGrid.appendChild(emptyDay);
                }
                
                for (let day = 1; day <= daysInMonth; day++) {
                    const dayElement = document.createElement('div');
                    dayElement.className = 'calendar-day text-sm font-medium';
                    dayElement.textContent = day;
                    dayElement.setAttribute('data-day', day);
                    
                    const dayDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth(), day);
                    dayDate.setHours(0,0,0,0); // Normalize dayDate for comparison

                    if (this.isSameDay(dayDate, this.today)) {
                        dayElement.classList.add('today');
                    }
                    
                    if (this.selectedDate && this.isSameDay(dayDate, this.selectedDate)) {
                        dayElement.classList.add('selected');
                    }
                    
                    if (dayDate < this.today) {
                        dayElement.style.opacity = '0.4';
                        dayElement.style.cursor = 'not-allowed';
                    } else {
                        dayElement.addEventListener('click', () => {
                            this.selectDate(day);
                        });
                    }
                    
                    calendarGrid.appendChild(dayElement);
                }
            }

            selectDate(day) {
                const selectedDayDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth(), day);
                selectedDayDate.setHours(0,0,0,0); // Normalize for comparison

                if (selectedDayDate < this.today) {
                    showToast('Tanggal Tidak Valid', 'Tidak dapat memilih tanggal yang sudah lewat', 'error');
                    return;
                }

                document.querySelectorAll('.calendar-day').forEach(el => {
                    el.classList.remove('selected');
                });
                
                const clickedDay = document.querySelector(`#calendarGrid [data-day="${day}"]`);
                if (clickedDay) {
                    clickedDay.classList.add('selected');
                    this.addSelectionEffect(clickedDay);
                }
                
                this.selectedDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth(), day);
                this.updateDisplay();
            }

            addSelectionEffect(element) {
                const ripple = document.createElement('div');
                ripple.className = 'absolute inset-0 bg-telusafe-red rounded-full opacity-30';
                ripple.style.transform = 'scale(0)';
                ripple.style.animation = 'ripple 0.6s ease-out';
                
                element.style.position = 'relative'; // Ensure parent is positioned for absolute child
                element.appendChild(ripple);
                
                setTimeout(() => {
                    if (ripple.parentNode) {
                        ripple.parentNode.removeChild(ripple);
                    }
                }, 600);
            }

            createCelebration() {
                const confirmBtn = document.getElementById('confirmDateTime');
                const rect = confirmBtn.getBoundingClientRect();
                const centerX = rect.left + rect.width / 2;
                const centerY = rect.top + rect.height / 2;
                
                for (let i = 0; i < 8; i++) {
                    const particle = document.createElement('div');
                    particle.className = 'fixed w-2 h-2 bg-telusafe-red rounded-full pointer-events-none z-50';
                    particle.style.left = centerX + 'px';
                    particle.style.top = centerY + 'px';
                    
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
                        if (particle.parentNode) document.body.removeChild(particle);
                    };
                }
            }

            updateDisplay() {
                const selectedDateEl = document.getElementById('selectedDate');
                
                if (this.selectedDate) {
                    selectedDateEl.textContent = this.formatDate(this.selectedDate);
                    selectedDateEl.style.color = '#C43B3B';
                    selectedDateEl.style.fontWeight = '600';
                } else {
                    selectedDateEl.textContent = 'Belum dipilih';
                    selectedDateEl.style.color = '#6B7280';
                    selectedDateEl.style.fontWeight = '400';
                }
            }

            formatDate(date) {
                const options = { 
                    weekday: 'long', 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric' 
                };
                return date.toLocaleDateString('id-ID', options);
            }

            formatDateForFirebase(date) { // New method for DD-MM-YYYY format
                if (!date) return null;
                const d = date.getDate().toString().padStart(2, '0');
                const m = (date.getMonth() + 1).toString().padStart(2, '0'); // Month is 0-indexed
                const y = date.getFullYear();
                return `${d}-${m}-${y}`;
            }


            isSameDay(date1, date2) {
                return date1.getDate() === date2.getDate() &&
                       date1.getMonth() === date2.getMonth() &&
                       date1.getFullYear() === date2.getFullYear();
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            appCalendarInstance = new Calendar(); // Initialize and store the instance
            
            const auth = firebase.auth();
            const database = firebase.database();

            document.getElementById('saveSchedule').addEventListener('click', function() {
                const saveBtn = this; // Keep reference to the button
                const originalText = saveBtn.innerHTML;

                const jenisKunjunganEl = document.getElementById('jenisKunjungan');
                const mediaKonselingEl = document.getElementById('mediaKonseling');
                const psikologEl = document.getElementById('psikolog');
                const waktuKonselingEl = document.getElementById('waktuKonseling');
                // Catatan tidak ada di struktur firebase image_ab1bde.png, jadi tidak diambil untuk Firebase
                // const catatan = document.getElementById('catatanKonseling').value.trim();


                const jenis_kunjungan = jenisKunjunganEl.value;
                const media = mediaKonselingEl.value;
                const psikolog = psikologEl.value; // Ini akan mengambil teks dari option yang dipilih
                const waktu = waktuKonselingEl.value;
                
                let isValid = true;
                const formElementsToValidate = [
                    {el: jenisKunjunganEl, name: "Jenis Kunjungan"},
                    {el: mediaKonselingEl, name: "Media Konseling"},
                    {el: psikologEl, name: "Psikolog"},
                    {el: waktuKonselingEl, name: "Waktu Konseling"}
                ];

                formElementsToValidate.forEach(item => {
                    if (!item.el.value) {
                        item.el.style.borderColor = '#C43B3B';
                        item.el.style.boxShadow = '0 0 0 3px rgba(196, 59, 59, 0.1)';
                        isValid = false;
                        setTimeout(() => {
                            item.el.style.borderColor = '';
                            item.el.style.boxShadow = '';
                        }, 3000);
                    }
                });
                
                if (!appCalendarInstance.selectedDate) {
                    showToast('Tanggal Diperlukan', 'Silakan pilih tanggal konseling', 'warning');
                    // Highlight calendar or confirm button area
                    const confirmBtn = document.getElementById('confirmDateTime');
                    confirmBtn.style.borderColor = '#C43B3B';
                    confirmBtn.classList.add('animate-wiggle');
                    setTimeout(() => {
                        confirmBtn.style.borderColor = '';
                        confirmBtn.classList.remove('animate-wiggle');
                    }, 3000);
                    isValid = false;
                }
                
                if (!isValid) {
                    showToast('Form Tidak Lengkap', 'Mohon lengkapi semua field yang diperlukan', 'error');
                    return;
                }
                
                const currentUser = auth.currentUser;
                if (!currentUser) {
                    showToast('Autentikasi Gagal', 'Silakan login ulang untuk menyimpan jadwal.', 'error');
                    return;
                }

                saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
                saveBtn.disabled = true;

                // Prepare data for Firebase according to image_ab1bde.png structure
                const jadwalData = {
                    jenis_kunjungan: jenis_kunjungan,
                    media: media,
                    psikolog: psikolog, // Value dari select sudah nama lengkap
                    tanggal: appCalendarInstance.formatDateForFirebase(appCalendarInstance.selectedDate), // Format DD-MM-YYYY
                    timestamp: firebase.database.ServerValue.TIMESTAMP, // Server timestamp
                    userId: currentUser.uid,
                    waktu: waktu // Value dari select sudah format "HH.MM - HH.MM"
                };

                // console.log("Data to be saved to Firebase:", jadwalData); // For debugging

                const jadwalKonselingRef = database.ref('jadwal_konseling');
                jadwalKonselingRef.push(jadwalData)
                    .then(() => {
                        showToast('Jadwal Berhasil Dibuat!', 'Jadwal konseling Anda telah disimpan ke Firebase.', 'success');
                        createSuccessCelebration();
                        resetForm(); // Call resetForm which now also resets calendar
                    })
                    .catch((error) => {
                        console.error("Error saving schedule to Firebase: ", error);
                        showToast('Gagal Menyimpan', 'Terjadi kesalahan: ' + error.message, 'error');
                    })
                    .finally(() => {
                        saveBtn.innerHTML = originalText;
                        saveBtn.disabled = false;
                    });
            });
            
            // Enhanced form field interactions (add IDs to selects and textarea in HTML)
            const formElements = [
                document.getElementById('jenisKunjungan'),
                document.getElementById('mediaKonseling'),
                document.getElementById('psikolog'),
                document.getElementById('waktuKonseling'),
                document.getElementById('catatanKonseling')
            ];

            formElements.forEach(element => {
                if (element) { // Check if element exists
                    element.addEventListener('change', function() {
                        this.style.borderColor = '#10B981'; // Green for valid input
                        this.style.boxShadow = '0 0 0 3px rgba(16, 185, 129, 0.1)';
                        setTimeout(() => {
                            this.style.borderColor = '';
                            this.style.boxShadow = '';
                        }, 1000);
                    });
                    element.addEventListener('focus', function() {
                        // Parent element might not be the one to transform, or might not be desired.
                        // this.parentElement.style.transform = 'translateY(-2px)';
                    });
                    element.addEventListener('blur', function() {
                        // this.parentElement.style.transform = 'translateY(0)';
                    });
                }
            });

            auth.onAuthStateChanged(function(user) {
                const profileUsernameElement = document.getElementById('profileUsername');
                const profileStatusElement = document.getElementById('profileStatus');
                // const profileInitialElement = document.getElementById('profileInitial'); // Jika ada

                if (user) {
                    // console.log('User UID (buatJadwalMahasiswa - Profil):', user.uid);
                    database.ref('users/' + user.uid).once('value')
                        .then(function(snapshot) {
                            if (snapshot.exists()) {
                                const userData = snapshot.val();
                                const usernameUntukProfil = userData.username || 'Username';
                                const status = userData.status || 'Status tidak diketahui';

                                if (profileUsernameElement) profileUsernameElement.textContent = usernameUntukProfil;
                                if (profileStatusElement) {
                                    const formattedStatus = status.charAt(0).toUpperCase() + status.slice(1);
                                    profileStatusElement.textContent = formattedStatus;
                                }
                                // if (profileInitialElement && usernameUntukProfil !== 'Username' && usernameUntukProfil.length > 0) {
                                //     profileInitialElement.textContent = usernameUntukProfil.charAt(0).toUpperCase();
                                // } else if (profileInitialElement) {
                                //     profileInitialElement.textContent = 'U';
                                // }
                            } else {
                                console.warn('Data pengguna tidak ditemukan untuk UID:', user.uid, 'di buatJadwalMahasiswa');
                                if (profileUsernameElement) profileUsernameElement.textContent = 'User';
                                if (profileStatusElement) profileStatusElement.textContent = 'N/A';
                                // if (profileInitialElement) profileInitialElement.textContent = 'U';
                            }
                        })
                        .catch(function(error) {
                            console.error('Gagal mengambil data profil pengguna di buatJadwalMahasiswa:', error);
                            if (profileUsernameElement) profileUsernameElement.textContent = 'Error';
                            if (profileStatusElement) profileStatusElement.textContent = 'Error';
                            // if (profileInitialElement) profileInitialElement.textContent = 'E';
                        });
                } else {
                    console.log('Pengguna belum login di buatJadwalMahasiswa.');
                    if (profileUsernameElement) profileUsernameElement.textContent = 'Guest';
                    if (profileStatusElement) profileStatusElement.textContent = '-';
                    // if (profileInitialElement) profileInitialElement.textContent = 'G';
                    // Consider redirecting to login if this page requires login
                    // window.location.href = '{{ url('/login') }}'; 
                }
            });
        });

        function navigateTo(page) {
            showToast('Navigation', `Navigating to ${page}...`, 'info');
            if (page === 'home') {
                window.location.href = '{{ url('dashboard') }}';
            }
        }

        function createReport() {
            showToast('Report Creation', 'Opening report creation form...', 'info');
            setTimeout(() => { window.location.href = '{{ url('buatLaporanMahasiswa') }}'; }, 1000);
        }

        function viewHistory() {
            showToast('History', 'Loading report history...', 'info');
            setTimeout(() => { window.location.href = '{{ url('riwayatLaporanMahasiswa') }}'; }, 1000);
        }

        function scheduleConseling() {
            // Already on this page, or use this to reload/reset
            // showToast('Schedule', 'Already on schedule page', 'info');
             window.location.href = '{{ url('buatJadwalMahasiswa') }}';
        }

        function viewCounseling() {
            showToast('Counseling', 'Loading counseling history...', 'info');
            setTimeout(() => { window.location.href = '{{ url('riwayatKonselingMahasiswa') }}'; }, 1000);
        }

        function createNote() {
            showToast('Daily Note', 'Opening daily note creator...', 'info');
             setTimeout(() => { window.location.href = '{{ url('buatCatatanMahasiswa') }}'; }, 1000);
        }

        function viewNotes() {
            showToast('Notes', 'Loading your daily notes...', 'info');
            setTimeout(() => { window.location.href = '{{ url('riwayatCatatanMahasiswa') }}'; }, 1000);
        }
        function showProfile() {
            showToast('Profile', 'Opening user profile...', 'info');
            setTimeout(() => { window.location.href = '{{ url('profile') }}'; }, 1000);
        }

        function showNotifications() {
            showToast('Notifications', 'Loading notifications...', 'info');
            // Implement actual notification display logic here
        }

        function showTips() {
            showToast('Tips', 'Opening counseling tips...', 'info');
            // Implement actual tips display logic or navigation
        }

        function viewAvailableSlots() {
            showToast('Available Slots', 'Checking available time slots...', 'info');
            // Implement logic to show available slots
        }

        function viewCounselorProfiles() {
            showToast('Counselor Profiles', 'Loading counselor information...', 'info');
            // Implement navigation or display for counselor profiles
        }

        function viewCounselingHistory() { // Duplicate of viewCounseling, but called from right sidebar
            showToast('Counseling History', 'Loading counseling history...', 'info');
            setTimeout(() => { window.location.href = '{{ url('riwayatKonselingMahasiswa') }}'; }, 1000);
        }

        function logout() {
            firebase.auth().signOut().then(() => {
                showToast('Goodbye', 'Logout berhasil! Anda akan diarahkan ke halaman login.', 'success');
                setTimeout(() => {
                    window.location.href = '{{ url('login') }}';
                }, 2000);
            }).catch((error) => {
                console.error("Logout error:", error);
                showToast('Logout Failed', 'Terjadi kesalahan saat logout.', 'error');
            });
        }

        function createSuccessCelebration() {
            const colors = ['#C43B3B', '#F44343', '#FEEAEA']; 
            for (let i = 0; i < 15; i++) {
                setTimeout(() => {
                    const confetti = document.createElement('div');
                    confetti.className = 'fixed pointer-events-none z-50';
                    confetti.style.left = Math.random() * window.innerWidth + 'px';
                    confetti.style.top = '-10px';
                    confetti.style.width = '8px';
                    confetti.style.height = '8px';
                    confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                    confetti.style.borderRadius = '50%';
                    
                    document.body.appendChild(confetti);
                    
                    confetti.animate([
                        { transform: 'translateY(0) rotate(0deg)', opacity: 1 },
                        { transform: `translateY(${window.innerHeight + 100}px) rotate(720deg)`, opacity: 0 }
                    ], {
                        duration: 3000 + Math.random() * 2000,
                        easing: 'cubic-bezier(0.25, 0.46, 0.45, 0.94)'
                    }).onfinish = () => {
                        if (confetti.parentNode) document.body.removeChild(confetti);
                    };
                }, i * 100);
            }
        }

        function resetForm() {
            // Reset select elements by ID
            const jenisKunjunganEl = document.getElementById('jenisKunjungan');
            const mediaKonselingEl = document.getElementById('mediaKonseling');
            const psikologEl = document.getElementById('psikolog');
            const waktuKonselingEl = document.getElementById('waktuKonseling');
            const catatanKonselingEl = document.getElementById('catatanKonseling');

            if(jenisKunjunganEl) jenisKunjunganEl.selectedIndex = 0;
            if(mediaKonselingEl) mediaKonselingEl.selectedIndex = 0;
            if(psikologEl) psikologEl.selectedIndex = 0;
            if(waktuKonselingEl) waktuKonselingEl.selectedIndex = 0;
            if(catatanKonselingEl) catatanKonselingEl.value = '';

            // Reset calendar selection using the global instance
            if (appCalendarInstance) {
                appCalendarInstance.selectedDate = null;
                appCalendarInstance.renderCalendar(); // Re-render to clear selection visuals
                appCalendarInstance.updateDisplay();  // Update "Tanggal dipilih" text
            }

            // Optional: Add a visual cue for reset
            const formContainer = document.querySelector('.form-container'); // Or a more specific form element
            if (formContainer) {
                formContainer.style.transform = 'scale(0.98)';
                formContainer.style.opacity = '0.8';
                setTimeout(() => {
                    formContainer.style.transform = 'scale(1)';
                    formContainer.style.opacity = '1';
                }, 200);
            }
        }


        function showToast(title, message, type = 'success') {
            const toast = document.getElementById('toast');
            const toastTitle = document.getElementById('toast-title');
            const toastMessage = document.getElementById('toast-message');
            const toastIcon = document.getElementById('toast-icon');
            
            toastIcon.className = 'fas mr-3 animate-bounce-gentle'; // Reset icon classes
            toast.className = 'fixed top-4 right-4 bg-white rounded-lg shadow-lg p-4 transform transition-transform duration-300 z-50 translate-x-full'; // Reset toast classes and ensure it's hidden initially
            
            switch(type) {
                case 'success':
                    toastIcon.classList.add('fa-check-circle', 'text-green-500');
                    toast.classList.add('border-l-4', 'border-green-500');
                    break;
                case 'warning':
                    toastIcon.classList.add('fa-exclamation-triangle', 'text-yellow-500');
                    toast.classList.add('border-l-4', 'border-yellow-500');
                    break;
                case 'info':
                    toastIcon.classList.add('fa-info-circle', 'text-blue-500');
                    toast.classList.add('border-l-4', 'border-blue-500');
                    break;
                case 'error':
                    toastIcon.classList.add('fa-times-circle', 'text-red-500');
                    toast.classList.add('border-l-4', 'border-red-500');
                    break;
            }
            
            toastTitle.textContent = title;
            toastMessage.textContent = message;
            
            // Show toast
            setTimeout(() => { // Add a slight delay for the transform reset to take effect
              toast.style.transform = 'translateX(0)';
            }, 50);
            
            setTimeout(() => {
                toast.style.transform = 'translateX(100%)';
            }, 4000);
        }

        document.addEventListener('click', function(e) {
            // Check if the target or its parent has the ripple-effect class or specific element types
            const clickableTarget = e.target.closest('.card-hover, .nav-item, .card-glow, button, .calendar-day:not([style*="not-allowed"])');

            if (clickableTarget) {
                const ripple = document.createElement('span');
                const rect = clickableTarget.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.className = 'absolute rounded-full bg-white/30 pointer-events-none'; // Ensure ripple is visible on dark backgrounds
                ripple.style.transform = 'scale(0)';
                ripple.style.animation = 'ripple 0.6s linear';
                
                // Ensure parent has relative positioning if it doesn't already
                if (getComputedStyle(clickableTarget).position === 'static') {
                    clickableTarget.style.position = 'relative';
                }
                clickableTarget.appendChild(ripple);
                
                setTimeout(() => {
                    if (ripple.parentNode) {
                        ripple.parentNode.removeChild(ripple);
                    }
                }, 600);
            }
        });
    </script>
</body>
</html>