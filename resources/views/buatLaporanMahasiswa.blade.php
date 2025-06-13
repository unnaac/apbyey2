<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>TeluSafe - Buat Laporan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <script src="https://www.gstatic.com/firebasejs/9.22.0/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.22.0/firebase-auth-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.22.0/firebase-database-compat.js"></script>
    <script src="{{ asset('js/configurasi-firebase.js') }}"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'telusafe': {
                            50: '#FEF2F2', 100: '#FEE2E2', 200: '#FECACA', 300: '#FCA5A5',
                            400: '#F87171', 500: '#EF4444', 600: '#DC2626', 700: '#B91C1C',
                            800: '#991B1B', 900: '#7F1D1D', 950: '#450A0A'
                        },
                        'telusafe-red': '#C43B3B',
                        'telusafe-light-red': '#F44343',
                        'telusafe-pink': '#FEEAEA',
                        'telusafe-dark-red': '#A63333',
                        'neutral': {
                            25: '#FCFCFD', 50: '#F9FAFB', 100: '#F3F4F6', 200: '#E5E7EB',
                            300: '#D1D5DB', 400: '#9CA3AF', 500: '#6B7280', 600: '#4B5563',
                            700: '#374151', 800: '#1F2937', 900: '#111827', 950: '#030712'
                        }
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                        'display': ['Plus Jakarta Sans', 'Inter', 'system-ui', 'sans-serif']
                    },
                    borderRadius: { '4xl': '2rem', '5xl': '2.5rem' },
                    boxShadow: {
                        'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04)',
                        'medium': '0 4px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 30px -5px rgba(0, 0, 0, 0.05)',
                        'strong': '0 10px 40px -10px rgba(0, 0, 0, 0.15), 0 20px 25px -5px rgba(0, 0, 0, 0.1)',
                        'glow': '0 0 20px rgba(239, 68, 68, 0.15)',
                        'glow-strong': '0 0 30px rgba(239, 68, 68, 0.25)'
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.8s ease-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'slide-down': 'slideDown 0.6s ease-out',
                        'slide-left': 'slideLeft 0.6s ease-out',
                        'slide-right': 'slideRight 0.6s ease-out',
                        'scale-in': 'scaleIn 0.5s ease-out',
                        'bounce-gentle': 'bounceGentle 2s infinite',
                        'float': 'float 3s ease-in-out infinite',
                        'pulse-soft': 'pulseSoft 2s infinite',
                        'wiggle': 'wiggle 1s ease-in-out infinite',
                        'gradient-shift': 'gradientShift 3s ease-in-out infinite',
                        'notification-bounce': 'notificationBounce 2s infinite'
                    },
                    keyframes: {
                        fadeIn: { 
                            '0%': { opacity: '0', transform: 'translateY(20px)' }, 
                            '100%': { opacity: '1', transform: 'translateY(0)' } 
                        },
                        slideUp: { 
                            '0%': { transform: 'translateY(30px)', opacity: '0' }, 
                            '100%': { transform: 'translateY(0)', opacity: '1' } 
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
                            '0%': { transform: 'translateX(-30px)', opacity: '0' }, 
                            '100%': { transform: 'translateX(0)', opacity: '1' } 
                        },
                        scaleIn: { 
                            '0%': { transform: 'scale(0.9)', opacity: '0' }, 
                            '100%': { transform: 'scale(1)', opacity: '1' } 
                        },
                        bounceGentle: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-8px)' }
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
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { 
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }
        
        .sidebar-active {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.25) 0%, rgba(255, 255, 255, 0.15) 100%);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .nav-item {
            transition: all 0.3s ease;
            position: relative;
        }
        
        .nav-item:hover {
            transform: translateX(5px);
        }
        
        .hover-lift {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .hover-lift:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.15);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .stat-card {
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(239, 68, 68, 0.1) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .stat-card:hover::after {
            opacity: 1;
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
        }
        
        .calendar-day.selected {
            background: linear-gradient(135deg, #EF4444, #F87171);
            color: white;
            transform: scale(1.1);
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }
        
        .calendar-day.selected::after {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(135deg, #EF4444, #F87171);
            border-radius: 10px;
            z-index: -1;
            opacity: 0.5;
            animation: pulse-soft 2s infinite;
        }
        
        .file-upload-area {
            border: 2px dashed #E5E7EB;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .file-upload-area:hover,
        .file-upload-area.dragover {
            border-color: #EF4444;
            background: linear-gradient(135deg, #FEF2F2, #FEE2E2);
            transform: scale(1.02);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.15);
        }
        
        .file-upload-area::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(239, 68, 68, 0.1), transparent);
            transition: left 0.5s;
        }
        
        .file-upload-area:hover::before {
            left: 100%;
        }
        
        .form-input {
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            transform: scale(1.02);
            border-color: #EF4444;
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
        }
        
        .time-input {
            transition: all 0.3s ease;
        }
        
        .time-input:focus {
            transform: scale(1.05);
            border-color: #EF4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }
        
        .time-input.invalid {
            border-color: #EF4444;
            background-color: #FEF2F2;
            animation: shake 0.5s ease-in-out;
        }
        
        .time-input.valid {
            border-color: #10B981;
            background-color: #F0FDF4;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #EF4444, #F87171);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.3);
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-primary:hover::before {
            left: 100%;
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
            background: linear-gradient(135deg, #DC2626, #EF4444, #F87171);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradientShift 3s ease-in-out infinite;
        }
        
        .notification-pulse {
            animation: notificationBounce 2s infinite;
        }
        
        .loading-shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }
        
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-neutral-50 to-neutral-100 min-h-screen text-neutral-900 font-sans">
    <div class="flex min-h-screen max-w-[1600px] mx-auto bg-white/60 backdrop-blur-sm rounded-none lg:rounded-4xl lg:m-4 shadow-strong overflow-hidden border border-white/20 animate-scale-in">
        <!-- Sidebar -->
        <aside class="bg-gradient-to-b from-telusafe-red to-telusafe-dark-red w-56 flex flex-col p-6 space-y-8 text-white select-none animate-slide-right">
            <div class="flex items-center space-x-3 group">
                <img src="../assets/webStudent/Logo.png" alt="TeluSafe Logo" class="w-8 h-8 object-contain group-hover:rotate-12 transition-transform duration-300"/>
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
                        <a class="flex items-center space-x-2 hover:underline nav-item p-1 rounded sidebar-active" href="#" onclick="createReport()">
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
            <header class="glass-effect p-6 border-b border-neutral-200/50 animate-slide-down">
                <div class="flex flex-col md:flex-row md:items-center md:justify-end space-y-4 md:space-y-0">
                    
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2 glass-effect rounded-full p-2 hover-lift cursor-pointer" onclick="showProfile()">
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
                <!-- Dashboard content grid -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <!-- Left and center content -->
                    <div class="lg:col-span-9 space-y-6">
                        
                        <!-- Buat Laporan Form -->
                        <section class="animate-slide-up">
                            <div class="flex items-center space-x-3 mb-6">
                                <div class="w-12 h-12 bg-gradient-to-br from-telusafe-500 to-telusafe-600 rounded-xl flex items-center justify-center animate-float">
                                    <i class="fas fa-plus text-white text-xl"></i>
                                </div>
                                <h2 class="text-[24px] font-bold font-display bg-gradient-to-r from-telusafe-500 to-telusafe-600 bg-clip-text text-transparent">
                                    Buat Laporan Baru
                                </h2>
                            </div>
                            
                            <div class="glass-effect rounded-2xl p-8 shadow-soft border border-white/50">
                                <form class="space-y-8" id="reportForm">
                                    <!-- Anonymous Checkbox and Location -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 stagger-animation">
                                        <div class="flex items-center space-x-3 p-4 glass-effect rounded-xl hover-lift">
                                            <input type="checkbox" id="anonymous" class="w-5 h-5 text-telusafe-500 border-2 border-neutral-300 rounded focus:ring-telusafe-400 focus:ring-2 transition-all">
                                            <label for="anonymous" class="text-sm font-medium text-neutral-700 cursor-pointer">Buat sebagai anonim</label>
                                            <i class="fas fa-user-secret text-telusafe-500 ml-auto animate-pulse-soft"></i>
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-medium text-neutral-700 mb-2 flex items-center">
                                                <i class="fas fa-map-marker-alt text-telusafe-500 mr-2"></i>
                                                Lokasi
                                            </label>
                                            <input type="text" id="lokasiKejadian" class="w-full px-4 py-3 border border-neutral-200 rounded-2xl focus:border-telusafe-400 focus:ring-4 focus:ring-telusafe-100 transition-all duration-300 outline-none form-input" placeholder="Masukkan lokasi kejadian">
                                        </div>
                                    </div>

                                    <!-- Report As Dropdown -->
                                    <div class="animate-fade-in">
                                        <label class="block text-sm font-medium text-neutral-700 mb-2 flex items-center">
                                            <i class="fas fa-user-tag text-telusafe-500 mr-2"></i>
                                            Lapor sebagai
                                        </label>
                                        <select id="peranPelapor" class="w-full md:w-64 px-4 py-3 border border-neutral-200 rounded-2xl focus:border-telusafe-400 focus:ring-4 focus:ring-telusafe-100 transition-all duration-300 outline-none bg-white text-neutral-700 form-input">
                                            <option value="">Pilih peran Anda</option>
                                            <option value="Korban">Korban</option>
                                            <option value="Saksi">Saksi</option>
                                        </select>
                                    </div>

                                    <!-- Date and Time Section -->
                                    <div class="animate-fade-in">
                                        <label class="block text-sm font-medium text-neutral-700 mb-4 flex items-center">
                                            <i class="fas fa-calendar-alt text-telusafe-500 mr-2 animate-wiggle"></i>
                                            Tanggal dan Waktu Kejadian
                                        </label>
                                        
                                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                            <!-- Calendar -->
                                            <div class="glass-effect rounded-2xl p-6 border border-neutral-200 hover-lift">
                                                <div class="flex items-center justify-between mb-4">
                                                    <button type="button" id="prevMonth" class="p-2 hover:bg-telusafe-100 rounded-xl transition-all duration-300 hover:scale-110">
                                                        <i class="fas fa-chevron-left text-telusafe-600"></i>
                                                    </button>
                                                    <h3 id="monthYear" class="font-semibold text-neutral-800 text-lg">Desember 2023</h3>
                                                    <button type="button" id="nextMonth" class="p-2 hover:bg-telusafe-100 rounded-xl transition-all duration-300 hover:scale-110">
                                                        <i class="fas fa-chevron-right text-telusafe-600"></i>
                                                    </button>
                                                </div>
                                                
                                                <!-- Calendar Grid -->
                                                <div class="grid grid-cols-7 gap-1 mb-2">
                                                    <div class="text-xs font-medium text-neutral-500 text-center py-2">Sen</div>
                                                    <div class="text-xs font-medium text-neutral-500 text-center py-2">Sel</div>
                                                    <div class="text-xs font-medium text-neutral-500 text-center py-2">Rab</div>
                                                    <div class="text-xs font-medium text-neutral-500 text-center py-2">Kam</div>
                                                    <div class="text-xs font-medium text-neutral-500 text-center py-2">Jum</div>
                                                    <div class="text-xs font-medium text-neutral-500 text-center py-2">Sab</div>
                                                    <div class="text-xs font-medium text-neutral-500 text-center py-2">Min</div>
                                                </div>
                                                
                                                <div id="calendarGrid" class="grid grid-cols-7 gap-1 mb-4">
                                                    <!-- Calendar days will be generated by JavaScript -->
                                                </div>
                                                
                                                <!-- Time Selection -->
                                                <div class="space-y-3">
                                                    <div>
                                                        <label class="block text-xs font-medium text-neutral-600 mb-2">Waktu</label>
                                                        <div class="flex items-center space-x-2">
                                                            <input type="number" id="hourInput" min="0" max="23" value="12" class="w-16 px-3 py-2 border border-neutral-200 rounded-xl text-sm focus:border-telusafe-400 focus:ring-2 focus:ring-telusafe-100 outline-none bg-white time-input text-center font-medium" placeholder="12">
                                                            <span class="text-sm text-neutral-500 font-bold">:</span>
                                                            <input type="number" id="minuteInput" min="0" max="59" value="00" class="w-16 px-3 py-2 border border-neutral-200 rounded-xl text-sm focus:border-telusafe-400 focus:ring-2 focus:ring-telusafe-100 outline-none bg-white time-input text-center font-medium" placeholder="00">
                                                            <span class="text-sm text-neutral-600 ml-2 font-medium">WIB</span>
                                                        </div>
                                                        <p class="text-xs text-neutral-500 mt-1">Format: HH:MM (24 jam)</p>
                                                    </div>
                                                </div>
                                                
                                                <!-- Selected Date Display -->
                                                <div class="mt-4 flex items-center justify-between glass-effect rounded-xl p-3 border border-neutral-200">
                                                    <div class="flex items-center space-x-2">
                                                        <i class="fas fa-calendar text-telusafe-500"></i>
                                                        <span id="selectedDate" class="text-sm text-neutral-600 font-medium">18/12/2023</span>
                                                    </div>
                                                    <div class="flex items-center space-x-2">
                                                        <i class="fas fa-clock text-telusafe-500"></i>
                                                        <span id="selectedTime" class="text-sm text-neutral-600 font-medium">12:00 WIB</span>
                                                    </div>
                                                </div>
                                                
                                                <button type="button" id="confirmDateTime" class="w-full mt-4 btn-primary text-white py-3 px-4 rounded-xl font-medium">
                                                    <i class="fas fa-check mr-2"></i>
                                                    Konfirmasi Waktu
                                                </button>
                                            </div>
                                            
                                            <!-- Description Field -->
                                            <div class="space-y-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-neutral-700 mb-2 flex items-center">
                                                        <i class="fas fa-file-alt text-telusafe-500 mr-2"></i>
                                                        Deskripsi Kejadian
                                                    </label>
                                                    <textarea rows="8" id="deskripsiKejadian" class="w-full px-4 py-3 border border-neutral-200 rounded-2xl focus:border-telusafe-400 focus:ring-4 focus:ring-telusafe-100 transition-all duration-300 outline-none resize-none form-input" placeholder="Ceritakan secara detail apa yang terjadi..."></textarea>
                                                </div>
                                                
                                                <div>
                                                    <label class="block text-sm font-medium text-neutral-700 mb-2 flex items-center">
                                                        <i class="fas fa-paperclip text-telusafe-500 mr-2"></i>
                                                        Bukti Pendukung
                                                    </label>
                                                    <div class="file-upload-area rounded-2xl p-12 text-center cursor-pointer" onclick="triggerFileUpload()">
                                                        <div class="space-y-4">
                                                            <div class="w-16 h-16 bg-telusafe-100 rounded-2xl flex items-center justify-center mx-auto animate-bounce-gentle">
                                                                <i class="fas fa-cloud-upload-alt text-telusafe-600 text-2xl"></i>
                                                            </div>
                                                            <div>
                                                                <p class="text-sm font-medium text-neutral-700">Klik untuk upload file atau drag & drop</p>
                                                                <p class="text-xs text-neutral-500 mt-1">PNG, JPG, PDF (Max. 10MB per file)</p>
                                                            </div>
                                                        </div>
                                                        <input type="file" id="fileInput" multiple accept=".png,.jpg,.jpeg,.pdf" style="display: none;">
                                                    </div>
                                                    <div id="fileList" class="mt-3 space-y-2"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="flex justify-end pt-6 border-t border-neutral-200">
                                        <button type="submit" class="btn-primary text-white py-4 px-8 rounded-2xl font-medium text-lg">
                                            <i class="fas fa-paper-plane mr-2"></i>
                                            Kirim Laporan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>

                    <!-- Right sidebar -->
                    <aside class="lg:col-span-3 space-y-6 animate-slide-left">
                        <div>
                            <h3 class="font-bold text-base mb-3 flex items-center">
                                <i class="fas fa-newspaper text-telusafe-500 mr-2"></i>
                                Berita Telkom University
                            </h3>
                            <div class="glass-effect rounded-2xl shadow-soft hover-lift border border-white/50 overflow-hidden cursor-pointer" onclick="readNews()">
                                <div class="h-40 bg-gradient-to-br from-telusafe-500 to-telusafe-600 flex items-center justify-center animate-gradient-shift">
                                    <img src="../assets/webStudent/BK.jpg" alt="Alur Konseling BK" class="max-h-full max-w-full object-contain">
                                </div>
                                <div class="p-4">
                                    <h4 class="text-sm font-semibold leading-tight mb-2">Begini Cara Menggunakan Layanan BK</h4>
                                    <p class="text-xs text-neutral-600">Panduan lengkap untuk mengakses layanan bimbingan konseling</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Quick Help -->
                        <div class="glass-effect rounded-2xl p-4 shadow-soft border border-white/50">
                            <h3 class="font-bold text-base mb-4 flex items-center">
                                <i class="fas fa-question-circle text-telusafe-500 mr-2"></i>
                                Bantuan Cepat
                            </h3>
                            <div class="space-y-3">
                                <div class="p-3 bg-telusafe-50 rounded-xl hover-lift cursor-pointer" onclick="showTip('anonymous')">
                                    <div class="flex items-center space-x-2">
                                        <i class="fas fa-user-secret text-telusafe-500"></i>
                                        <span class="text-sm font-medium">Laporan Anonim</span>
                                    </div>
                                    <p class="text-xs text-neutral-600 mt-1">Lindungi identitas Anda saat melaporkan</p>
                                </div>
                                <div class="p-3 bg-blue-50 rounded-xl hover-lift cursor-pointer" onclick="showTip('evidence')">
                                    <div class="flex items-center space-x-2">
                                        <i class="fas fa-camera text-blue-500"></i>
                                        <span class="text-sm font-medium">Bukti yang Valid</span>
                                    </div>
                                    <p class="text-xs text-neutral-600 mt-1">Tips mengumpulkan bukti yang kuat</p>
                                </div>
                                <div class="p-3 bg-green-50 rounded-xl hover-lift cursor-pointer" onclick="showTip('support')">
                                    <div class="flex items-center space-x-2">
                                        <i class="fas fa-hands-helping text-green-500"></i>
                                        <span class="text-sm font-medium">Dukungan 24/7</span>
                                    </div>
                                    <p class="text-xs text-neutral-600 mt-1">Hubungi konselor kapan saja</p>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </main>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="fixed top-4 right-4 glass-effect border-l-4 border-telusafe-500 rounded-lg shadow-strong p-4 transform translate-x-full transition-all duration-500 z-50 max-w-sm">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-3 animate-bounce-gentle" id="toast-icon"></i>
            <div>
                <p class="font-semibold text-sm" id="toast-title">Success!</p>
                <p class="text-xs text-neutral-600" id="toast-message">Action completed successfully!</p>
            </div>
        </div>
    </div>

    <script>
        // Calendar functionality
        let calendarInstance;
        class Calendar {
            constructor() {
                this.currentDate = new Date();
                this.selectedDate = new Date(2023, 11, 18); // Default to Dec 18, 2023
                this.months = [
                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                ];
                this.init();
            }

            init() {
                // Pastikan elemen ada sebelum render dan bind
                if (!document.getElementById('monthYear') || !document.getElementById('calendarGrid')) {
                    console.error("Elemen kalender inti tidak ditemukan!");
                    return;
                }
                this.renderCalendar();
                // Set default time setelah elemen ada
                const hourInput = document.getElementById('hourInput');
                const minuteInput = document.getElementById('minuteInput');
                if (hourInput) hourInput.value = '12';
                if (minuteInput) minuteInput.value = '00';

                this.updateDisplay();
                this.bindEvents();
            }

            bindEvents() {
                const prevMonthButton = document.getElementById('prevMonth');
                const nextMonthButton = document.getElementById('nextMonth');
                const hourInput = document.getElementById('hourInput');
                const minuteInput = document.getElementById('minuteInput');
                const confirmDateTimeButton = document.getElementById('confirmDateTime');

                if (prevMonthButton) {
                    prevMonthButton.addEventListener('click', () => {
                        this.currentDate.setMonth(this.currentDate.getMonth() - 1);
                        this.renderCalendar();
                        this.createSparkles(prevMonthButton); // Opsional
                    });
                }

                if (nextMonthButton) {
                    nextMonthButton.addEventListener('click', () => {
                        this.currentDate.setMonth(this.currentDate.getMonth() + 1);
                        this.renderCalendar();
                        this.createSparkles(nextMonthButton); // Opsional
                    });
                }

                const formatTimeInput = (inputElem, maxVal) => {
                    if (!inputElem) return;
                    let valueStr = inputElem.value;
                    inputElem.classList.remove('valid', 'invalid');

                    // Hanya proses jika ada angka
                    if (!/^\d*$/.test(valueStr)) { // Jika mengandung non-digit
                        inputElem.value = valueStr.replace(/[^\d]/g, ''); // Hapus non-digit
                        valueStr = inputElem.value;
                    }
                    
                    let value = parseInt(valueStr);

                    if (valueStr === '' || isNaN(value)) { // Jika kosong atau jadi NaN setelah parse
                        // Jangan langsung set '00', biarkan pengguna mengetik atau blur akan handle
                        if (inputElem.matches(':focus')) { // Jika masih fokus, jangan ubah
                             // Mungkin tambahkan class invalid jika kosong tapi tidak NaN
                        } else { // Jika blur dan kosong/NaN
                            inputElem.value = '00';
                        }
                    } else if (value < 0) {
                        inputElem.value = '00';
                        inputElem.classList.add('invalid');
                    } else if (value > maxVal) {
                        inputElem.value = maxVal.toString();
                        inputElem.classList.add('invalid');
                    } else {
                         // Untuk padding '0' saat blur atau saat input valid
                        if (!inputElem.matches(':focus') || (valueStr.length === 1 && value < 10) || (valueStr.length === 2 && value >=0)) {
                           inputElem.value = value.toString().padStart(2, '0');
                        }
                        inputElem.classList.add('valid');
                    }
                    this.updateDisplay(); // Update tampilan live
                };
                
                if (hourInput) {
                    hourInput.addEventListener('input', () => formatTimeInput(hourInput, 23));
                    hourInput.addEventListener('blur', () => {
                        if(hourInput.value === '') hourInput.value = '12'; // Default jika kosong saat blur
                        formatTimeInput(hourInput, 23);
                        // Pastikan nilai akhir adalah 2 digit
                        if(hourInput.value.length === 1) hourInput.value = '0' + hourInput.value;
                    });
                }
                if (minuteInput) {
                    minuteInput.addEventListener('input', () => formatTimeInput(minuteInput, 59));
                    minuteInput.addEventListener('blur', () => {
                        if(minuteInput.value === '') minuteInput.value = '00'; // Default jika kosong saat blur
                        formatTimeInput(minuteInput, 59);
                        // Pastikan nilai akhir adalah 2 digit
                        if(minuteInput.value.length === 1) minuteInput.value = '0' + minuteInput.value;
                    });
                }

                if (confirmDateTimeButton) {
                    confirmDateTimeButton.addEventListener('click', () => {
                        // Pastikan format akhir benar sebelum konfirmasi
                        if(hourInput && hourInput.value.length === 1) hourInput.value = '0' + hourInput.value;
                        if(minuteInput && minuteInput.value.length === 1) minuteInput.value = '0' + minuteInput.value;
                        
                        const hour = hourInput ? hourInput.value : '12';
                        const minute = minuteInput ? minuteInput.value : '00';
                        this.createCelebration(confirmDateTimeButton); // Opsional
                        showToast('Waktu Dikonfirmasi!', `${this.formatDateFull(this.selectedDate)} ${hour}:${minute} WIB`, 'success');
                    });
                }
            }

            renderCalendar() {
                const monthYearEl = document.getElementById('monthYear');
                const calendarGridEl = document.getElementById('calendarGrid');

                if (!monthYearEl || !calendarGridEl) {
                    // console.error("Elemen #monthYear atau #calendarGrid tidak ditemukan saat renderCalendar.");
                    return; // Jangan lanjutkan jika elemen tidak ada
                }

                monthYearEl.textContent = `${this.months[this.currentDate.getMonth()]} ${this.currentDate.getFullYear()}`;
                calendarGridEl.innerHTML = ''; // Kosongkan grid sebelum mengisi

                const firstDayOfMonth = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth(), 1);
                const daysInMonth = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() + 1, 0).getDate();
                let startingDayOfWeek = firstDayOfMonth.getDay(); // 0 (Minggu) - 6 (Sabtu)
                startingDayOfWeek = startingDayOfWeek === 0 ? 6 : startingDayOfWeek - 1; // Konversi ke 0 (Senin) - 6 (Minggu)

                for (let i = 0; i < startingDayOfWeek; i++) {
                    const emptyCell = document.createElement('div');
                    emptyCell.className = 'calendar-day text-sm'; // pastikan class ini ada di CSS Anda
                    calendarGridEl.appendChild(emptyCell);
                }

                for (let day = 1; day <= daysInMonth; day++) {
                    const dayCell = document.createElement('div');
                    dayCell.className = 'calendar-day text-sm font-medium';
                    dayCell.textContent = day;
                    dayCell.setAttribute('data-day', day.toString());

                    if (this.selectedDate &&
                        this.selectedDate.getDate() === day &&
                        this.selectedDate.getMonth() === this.currentDate.getMonth() &&
                        this.selectedDate.getFullYear() === this.currentDate.getFullYear()) {
                        dayCell.classList.add('selected');
                    }

                    dayCell.addEventListener('click', () => {
                        this.selectDate(day);
                    });
                    calendarGridEl.appendChild(dayCell);
                }
            }

            selectDate(day) {
                const previouslySelected = document.querySelector('.calendar-day.selected');
                if (previouslySelected) {
                    previouslySelected.classList.remove('selected');
                }
                // Temukan elemen hari yang diklik di dalam #calendarGrid saat ini
                const dayElement = document.querySelector(`#calendarGrid [data-day="${day}"]`);
                if (dayElement) {
                    dayElement.classList.add('selected');
                    // this.createCelebration(dayElement); // Opsional
                }
                this.selectedDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth(), day);
                this.updateDisplay();
            }

            updateDisplay() {
                const selectedDateEl = document.getElementById('selectedDate');
                const selectedTimeEl = document.getElementById('selectedTime');
                const hourInput = document.getElementById('hourInput');
                const minuteInput = document.getElementById('minuteInput');

                if (selectedDateEl && this.selectedDate) {
                    selectedDateEl.textContent = this.formatDate(this.selectedDate);
                }
                if (selectedTimeEl && hourInput && minuteInput) {
                    const hour = hourInput.value.padStart(2, '0');
                    const minute = minuteInput.value.padStart(2, '0');
                    selectedTimeEl.textContent = `${hour}:${minute} WIB`;
                }
            }

            formatDate(date) {
                const day = date.getDate().toString().padStart(2, '0');
                const month = (date.getMonth() + 1).toString().padStart(2, '0'); // Bulan +1 karena Januari = 0
                const year = date.getFullYear();
                return `${day}/${month}/${year}`;
            }
            formatDateFull(date) {
                const day = date.getDate();
                const monthName = this.months[date.getMonth()];
                const year = date.getFullYear();
                return `${day} ${monthName} ${year}`;
            }

            createCelebration(element) {
                const rect = element.getBoundingClientRect();
                const centerX = rect.left + rect.width / 2;
                const centerY = rect.top + rect.height / 2;
                
                for (let i = 0; i < 8; i++) {
                    const particle = document.createElement('div');
                    particle.className = 'fixed w-2 h-2 bg-telusafe-500 rounded-full pointer-events-none z-50';
                    particle.style.left = centerX + 'px';
                    particle.style.top = centerY + 'px';
                    
                    const angle = (i * 45) * Math.PI / 180;
                    const distance = 50;
                    const endX = centerX + Math.cos(angle) * distance;
                    const endY = centerY + Math.sin(angle) * distance;
                    
                    document.body.appendChild(particle);
                    
                    particle.animate([
                        { transform: 'translate(0, 0) scale(1)', opacity: 1 },
                        { transform: `translate(${endX - centerX}px, ${endY - centerY}px) scale(0)`, opacity: 0 }
                    ], {
                        duration: 800,
                        easing: 'ease-out'
                    }).onfinish = () => {
                        document.body.removeChild(particle);
                    };
                }
            }

            createSparkles(element) {
                for (let i = 0; i < 3; i++) {
                    const sparkle = document.createElement('div');
                    sparkle.innerHTML = '✨';
                    sparkle.className = 'fixed pointer-events-none z-50 text-sm';
                    
                    const rect = element.getBoundingClientRect();
                    sparkle.style.left = (rect.left + Math.random() * rect.width) + 'px';
                    sparkle.style.top = (rect.top + Math.random() * rect.height) + 'px';
                    
                    document.body.appendChild(sparkle);
                    
                    sparkle.animate([
                        { transform: 'translateY(0) scale(1)', opacity: 1 },
                        { transform: 'translateY(-30px) scale(0)', opacity: 0 }
                    ], {
                        duration: 1000,
                        easing: 'ease-out'
                    }).onfinish = () => {
                        document.body.removeChild(sparkle);
                    };
                }
            }
        }

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            calendarInstance = new Calendar();
            if (typeof calendarInstance.init === 'function') {
                 calendarInstance.init(); // Panggil init di sini
            } else {
                console.error("calendarInstance.init bukan fungsi!");
            }
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
            
            // Form validation and submission
            const form = document.getElementById('reportForm');
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const submitButton = form.querySelector('button[type="submit"]');
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';
                submitButton.disabled = true;

                const isAnonymous = document.getElementById('anonymous').checked;
                const lokasiKejadianValue = document.getElementById('lokasiKejadian').value.trim();
                const peranPelaporValue = document.getElementById('peranPelapor').value;
                const deskripsiKejadianValue = document.getElementById('deskripsiKejadian').value.trim();
                const fileInputElement = document.getElementById('fileInput');

                if (!lokasiKejadianValue || !peranPelaporValue || !deskripsiKejadianValue) {
                    showToast('Form Tidak Lengkap', 'Mohon lengkapi lokasi, peran, dan deskripsi.', 'warning');
                    submitButton.innerHTML = '<i class="fas fa-paper-plane mr-2"></i>Kirim Laporan';
                    submitButton.disabled = false;
                    return;
                }

                const hourValue = document.getElementById('hourInput').value;
                const minuteValue = document.getElementById('minuteInput').value;

                let userId = 'anonim_uid';
                let usernamePelapor = 'Anonim';

                if (!isAnonymous && currentGlobalUser && currentGlobalUser.uid) {
                    userId = currentGlobalUser.uid;
                    usernamePelapor = currentGlobalUser.username || 'Pengguna Terdaftar';
                } else if (!isAnonymous && (!currentGlobalUser || !currentGlobalUser.uid)) {
                    showToast('Autentikasi Gagal', 'Verifikasi pengguna gagal. Coba login ulang atau lapor anonim.', 'error');
                    submitButton.innerHTML = '<i class="fas fa-paper-plane mr-2"></i>Kirim Laporan';
                    submitButton.disabled = false;
                    return;
                }

                const tanggalKejadianFullValue = calendarInstance.formatDateFull(calendarInstance.selectedDate);
                const waktuKejadianValue = `${hourValue}:${minuteValue} WIB`;

                const now = new Date();
                const reportTimestamp = `${now.getDate()} ${calendarInstance.months[now.getMonth()]} ${now.getFullYear()} ${now.getHours().toString().padStart(2, '0')}:${now.getMinutes().toString().padStart(2, '0')}`;

                let uploadedFileValue = "Tidak ada file diupload";
                if (fileInputElement.files.length > 0) {
                    uploadedFileValue = fileInputElement.files[0].name; // Simpan nama file pertama
                }

                const laporanData = {
                    userId: userId,
                    usernamePelapor: usernamePelapor,
                    apakahAnonim: isAnonymous,
                    lokasiKejadian: lokasiKejadianValue,
                    peranPelapor: peranPelaporValue,
                    tanggalKejadianFull: tanggalKejadianFullValue,
                    waktuKejadian: waktuKejadianValue,
                    deskripsiKejadian: deskripsiKejadianValue,
                    uploaded_file: uploadedFileValue, // Nama file atau placeholder
                    statusProsesLaporan: "Dilaporkan",
                    timestamp: reportTimestamp
                };

                database.ref('laporan').push().set(laporanData)
                    .then(() => {
                        showToast('Laporan Terkirim!', 'Laporan Anda berhasil dikirim.', 'success');
                        // createFormCelebration(); // Opsional
                        form.reset();
                        document.getElementById('fileList').innerHTML = '';
                        currentFilesForDisplay = []; // Kosongkan array file global
                        fileInputElement.value = ''; // Reset input file secara eksplisit untuk browser tertentu

                        calendarInstance.selectedDate = new Date();
                        calendarInstance.currentDate = new Date();
                        calendarInstance.renderCalendar();
                        document.getElementById('hourInput').value = '12';
                        document.getElementById('minuteInput').value = '00';
                        calendarInstance.updateDisplay();

                        submitButton.innerHTML = '<i class="fas fa-check mr-2"></i>Terkirim!';
                        submitButton.classList.remove('btn-primary');
                        submitButton.classList.add('bg-green-500');

                        setTimeout(() => {
                            submitButton.innerHTML = '<i class="fas fa-paper-plane mr-2"></i>Kirim Laporan';
                            submitButton.classList.add('btn-primary');
                            submitButton.classList.remove('bg-green-500');
                            submitButton.disabled = false;
                        }, 3000);
                    })
                    .catch((error) => {
                        console.error("Error submitting report to Firebase:", error);
                        showToast('Pengiriman Gagal', 'Terjadi kesalahan. Mohon coba lagi.', 'error');
                        submitButton.innerHTML = '<i class="fas fa-paper-plane mr-2"></i>Kirim Laporan';
                        submitButton.disabled = false;
                    });
            });
            const auth = firebase.auth();
            const database = firebase.database();
            let currentGlobalUser = null;
            auth.onAuthStateChanged(function(user) {
                const profileUsernameElement = document.getElementById('profileUsername');
                const profileStatusElement = document.getElementById('profileStatus');

                if (user) {
                    currentGlobalUser = { uid: user.uid, email: user.email, username: "Memuat..." }; // Inisialisasi
                    if (profileUsernameElement) profileUsernameElement.textContent = "Memuat...";
                    if (profileStatusElement) profileStatusElement.textContent = "Memuat...";

                    database.ref('users/' + user.uid).once('value')
                        .then(function(snapshot) {
                            if (snapshot.exists()) {
                                const userData = snapshot.val();
                                currentGlobalUser.username = userData.username || user.email || 'Pengguna'; // Fallback
                                if (profileUsernameElement) profileUsernameElement.textContent = currentGlobalUser.username;
                                if (profileStatusElement) {
                                    const status = userData.status || 'Mahasiswa'; // Default status
                                    profileStatusElement.textContent = status.charAt(0).toUpperCase() + status.slice(1);
                                }
                            } else {
                                console.warn(`Data pengguna untuk UID: ${user.uid} tidak ditemukan di /users.`);
                                currentGlobalUser.username = user.email || 'Pengguna';
                                if (profileUsernameElement) profileUsernameElement.textContent = currentGlobalUser.username;
                                if (profileStatusElement) profileStatusElement.textContent = 'Mahasiswa';
                            }
                        })
                        .catch(function(error) {
                            console.error('Gagal mengambil data profil dari DB:', error);
                            currentGlobalUser.username = user.email || 'Error'; // Fallback jika error
                            if (profileUsernameElement) profileUsernameElement.textContent = 'Error';
                            if (profileStatusElement) profileStatusElement.textContent = 'Error';
                        });
                } else {
                    currentGlobalUser = null;
                    if (profileUsernameElement) profileUsernameElement.textContent = 'Guest';
                    if (profileStatusElement) profileStatusElement.textContent = '-';
                }
            });
            // Inisialisasi event listener untuk file setelah DOM utama siap
            initializeFileHandlers();
        });
        
        let currentFilesForDisplay = [];
        // File upload functionality
        function triggerFileUpload() {
            document.getElementById('fileInput').click();
        }
        function initializeFileHandlers() {
            const fileInput = document.getElementById('fileInput');
            const uploadArea = document.querySelector('.file-upload-area');

            if (fileInput && uploadArea) {
                fileInput.addEventListener('change', (e) => {
                    currentFilesForDisplay = Array.from(e.target.files);
                    handleFilesDisplay(currentFilesForDisplay);
                });

                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                    uploadArea.addEventListener(eventName, preventDefaults, false);
                });

                function preventDefaults(e) { e.preventDefault(); e.stopPropagation(); }

                ['dragenter', 'dragover'].forEach(eventName => {
                    uploadArea.addEventListener(eventName, () => uploadArea.classList.add('dragover'), false);
                });
                ['dragleave', 'drop'].forEach(eventName => {
                    uploadArea.addEventListener(eventName, () => uploadArea.classList.remove('dragover'), false);
                });

                uploadArea.addEventListener('drop', (e) => {
                    const droppedFiles = Array.from(e.dataTransfer.files);
                    const dataTransfer = new DataTransfer();
                    droppedFiles.forEach(file => dataTransfer.items.add(file));
                    fileInput.files = dataTransfer.files;
                    currentFilesForDisplay = droppedFiles;
                    handleFilesDisplay(currentFilesForDisplay);
                }, false);
            } else {
                console.warn("Elemen file input atau upload area tidak ditemukan untuk inisialisasi handler.");
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('fileInput');
            const uploadArea = document.querySelector('.file-upload-area');
            //const fileList = document.getElementById('fileList');
            
            if (fileInput && uploadArea) { // Cek elemen ada
                fileInput.addEventListener('change', (e) => {
                    currentFilesForDisplay = Array.from(e.target.files);
                    handleFilesDisplay(currentFilesForDisplay);
                });

                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                    uploadArea.addEventListener(eventName, preventDefaults, false);
                });

                function preventDefaults(e) { e.preventDefault(); e.stopPropagation(); }

                ['dragenter', 'dragover'].forEach(eventName => {
                    uploadArea.addEventListener(eventName, () => uploadArea.classList.add('dragover'), false);
                });
                ['dragleave', 'drop'].forEach(eventName => {
                    uploadArea.addEventListener(eventName, () => uploadArea.classList.remove('dragover'), false);
                });

                uploadArea.addEventListener('drop', (e) => {
                    const droppedFiles = Array.from(e.dataTransfer.files);
                    const dataTransfer = new DataTransfer();
                    droppedFiles.forEach(file => dataTransfer.items.add(file));
                    fileInput.files = dataTransfer.files; // Update file input
                    currentFilesForDisplay = droppedFiles;
                    handleFilesDisplay(currentFilesForDisplay);
                }, false);
            }
        });

        function handleFilesDisplay(files) {
            const fileListContainer = document.getElementById('fileList');
            if (!fileListContainer) return;
            fileListContainer.innerHTML = '';
            
            files.forEach((file, index) => {
                const fileItem = document.createElement('div');
                fileItem.className = 'flex items-center justify-between p-3 glass-effect rounded-xl border border-neutral-200 animate-slide-up';
                fileItem.style.animationDelay = `${index * 0.1}s`;
                fileItem.setAttribute('data-file-name', file.name);
                const safeFileName = file.name.replace(/'/g, "\\'").replace(/"/g, "&quot;");
                fileItem.innerHTML = `
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-telusafe-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-${getFileIcon(file.type)} text-telusafe-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-neutral-700 truncate max-w-[150px] sm:max-w-[200px] md:max-w-xs" title="${file.name}">${file.name}</p>
                            <p class="text-xs text-neutral-500">${formatFileSize(file.size)}</p>
                        </div>
                    </div>
                    <button type="button" class="text-red-500 hover:text-red-700 transition-colors p-1" onclick="removeFileFromDisplayList(this, '${safeFileName}')">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                fileListContainer.appendChild(fileItem);
            });
        }
        //window.handleFilesDisplay = handleFilesDisplay;

        function getFileIcon(mimeType) {
            if (mimeType.includes('image')) return 'image';
            if (mimeType.includes('pdf')) return 'file-pdf';
            return 'file';
        }
        
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        function removeFileFromDisplayList(buttonElement, fileNameToRemove) {
            const fileInput = document.getElementById('fileInput');
            const fileItemElement = buttonElement.closest('[data-file-name]');

            if (fileItemElement && fileItemElement.parentNode) { // Pastikan elemen dan parent ada
                fileItemElement.style.animation = 'fadeOut 0.3s ease-out forwards';
                setTimeout(() => {
                    if (fileItemElement.parentNode) { // Cek lagi sebelum remove
                         fileItemElement.remove();
                    }
                }, 300);
            }

            if (fileInput) {
                const dt = new DataTransfer();
                // Filter dari currentFilesForDisplay karena fileInput.files mungkin tidak update cepat
                currentFilesForDisplay = currentFilesForDisplay.filter(file => file.name !== fileNameToRemove);
                currentFilesForDisplay.forEach(file => dt.items.add(file));
                fileInput.files = dt.files; // Update fileInput
            }

            showToast('File Dihapus', `${fileNameToRemove} telah dihapus.`, 'info');
        }
        window.removeFileFromDisplayList = removeFileFromDisplayList;

        // Interactive functions
        function navigateTo(page) {
            showToast('Navigation', `Navigating to ${page}...`, 'info');
            if (page === 'home') {
                window.location.href = 'dashboard';
            }
        }

        function createReport() {
            showToast('Report Creation', 'You are already on the report creation page!', 'info');
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

        function showDetails(type) {
            showToast('Details', `Showing details for ${type} reports...`, 'info');
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
            setTimeout(function() {
            window.open('https://studentaffairs.telkomuniversity.ac.id/layanan-konseling-telkom-university/', '_self'); 
            }, 500);    
        }

        function showTip(topic) {
            const tips = {
                'anonymous': {
                    title: 'Laporan Anonim',
                    message: 'Identitas Anda akan dilindungi sepenuhnya saat membuat laporan anonim.'
                },
                'evidence': {
                    title: 'Bukti yang Valid',
                    message: 'Upload foto, video, atau dokumen yang mendukung laporan Anda.'
                },
                'support': {
                    title: 'Dukungan 24/7',
                    message: 'Tim konselor kami siap membantu Anda kapan saja.'
                }
            };
            
            const tip = tips[topic];
            showToast(tip.title, tip.message, 'info');
        }

        function logout() {
            showToast('Logout', 'Logging out...', 'warning');
            setTimeout(() => {
                showToast('Goodbye', 'Stay safe and take care!', 'success');
                window.location.href = 'login';
            }, 1000);
        }

        function createFormCelebration() {
            const form = document.getElementById('reportForm');
            const rect = form.getBoundingClientRect();
            
            for (let i = 0; i < 20; i++) {
                const confetti = document.createElement('div');
                confetti.innerHTML = ['🎉', '✨', '🎊', '⭐'][Math.floor(Math.random() * 4)];
                confetti.className = 'fixed pointer-events-none z-50 text-2xl';
                confetti.style.left = (rect.left + Math.random() * rect.width) + 'px';
                confetti.style.top = (rect.top + Math.random() * rect.height) + 'px';
                
                document.body.appendChild(confetti);
                
                confetti.animate([
                    { transform: 'translateY(0) rotate(0deg) scale(1)', opacity: 1 },
                    { transform: `translateY(-${Math.random() * 100 + 50}px) rotate(${Math.random() * 360}deg) scale(0)`, opacity: 0 }
                ], {
                    duration: 2000,
                    easing: 'ease-out'
                }).onfinish = () => {
                    document.body.removeChild(confetti);
                };
            }
        }

        function showToast(title, message, type = 'success') {
            const toast = document.getElementById('toast');
            const toastTitle = document.getElementById('toast-title');
            const toastMessage = document.getElementById('toast-message');
            const toastIcon = document.getElementById('toast-icon');
            
            // Reset classes
            toastIcon.className = 'fas mr-3 animate-bounce-gentle';
            toast.className = 'fixed top-4 right-4 glass-effect rounded-lg shadow-strong p-4 transform transition-all duration-500 z-50 max-w-sm';
            
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

        // Add CSS for fadeOut animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeOut {
                from { opacity: 1; transform: scale(1); }
                to { opacity: 0; transform: scale(0.8); }
            }
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        // Add ripple effect to clickable elements
        document.addEventListener('click', function(e) {
            if (e.target.matches('.hover-lift, .nav-item, .stat-card, .calendar-day, button')) {
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
                
                const target = e.target.closest('.hover-lift, .nav-item, .stat-card, .calendar-day, button');
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