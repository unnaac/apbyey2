<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>TeluSafe - Riwayat Laporan</title>
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
                        'notification-bounce': 'notificationBounce 2s infinite',
                        'table-row-enter': 'tableRowEnter 0.5s ease-out',
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
                        },
                        tableRowEnter: {
                            '0%': { transform: 'translateX(-20px)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' }
                        },
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
        
        .table-row {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }
        
        .table-row:hover {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.05), rgba(248, 113, 113, 0.05));
            transform: translateX(4px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .table-row.selected {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(248, 113, 113, 0.1));
            border-left: 4px solid #EF4444;
            transform: translateX(8px);
        }
        
        .table-row::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0;
            background: linear-gradient(90deg, rgba(239, 68, 68, 0.1), transparent);
            transition: width 0.3s ease;
        }
        
        .table-row:hover::before {
            width: 100%;
        }
        
        .status-badge {
            position: relative;
            overflow: hidden;
        }
        
        .status-badge::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }
        
        .status-badge:hover::after {
            left: 100%;
        }
        
        .action-button {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .action-button:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .action-button.view:hover {
            background: linear-gradient(135deg, #EF4444, #F87171);
            border-color: #EF4444;
            color: white;
        }
        
        .action-button.delete:hover {
            background: linear-gradient(135deg, #EF4444, #DC2626);
            border-color: #EF4444;
            color: white;
        }
        
        .detail-card {
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }
        
        .detail-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(239, 68, 68, 0.1), transparent);
            transition: left 0.8s;
        }
        
        .detail-card:hover::before {
            left: 100%;
        }
        
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
        .stagger-animation > *:nth-child(7) { animation-delay: 0.7s; }
        .stagger-animation > *:nth-child(8) { animation-delay: 0.8s; }
        
        .evidence-placeholder {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            border: 2px dashed #cbd5e1;
            transition: all 0.3s ease;
        }
        
        .evidence-placeholder:hover {
            border-color: #EF4444;
            background: linear-gradient(135deg, #FEF2F2, #FEE2E2);
        }
        
        .form-input {
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            transform: scale(1.02);
            border-color: #EF4444;
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-neutral-50 to-neutral-100 min-h-screen text-neutral-900 font-sans">
    <div class="flex min-h-screen max-w-[1600px] mx-auto bg-white/60 backdrop-blur-sm rounded-none lg:rounded-4xl lg:m-4 shadow-strong overflow-hidden border border-white/20 animate-scale-in">
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
                        <a class="flex items-center space-x-2 hover:underline nav-item p-1 rounded" href="#" onclick="createReport()">
                            <div class="w-5 h-5 bg-white rounded flex items-center justify-center">
                                <i class="fas fa-plus text-telusafe-red text-xs"></i>
                            </div>
                            <span>Buat Laporan</span>
                        </a>
                        <a class="flex items-center space-x-2 hover:underline nav-item p-1 rounded sidebar-active" href="#" onclick="viewHistory()">
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

        <main class="flex-1 flex flex-col min-h-screen animate-fade-in">
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
                <div class="space-y-6">
                    <section class="animate-slide-up">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-12 h-12 bg-gradient-to-br from-telusafe-500 to-telusafe-600 rounded-xl flex items-center justify-center animate-float">
                                <i class="fas fa-history text-white text-xl"></i>
                            </div>
                            <div>
                                <h1 class="text-[28px] font-bold font-display bg-gradient-to-r from-telusafe-500 to-telusafe-600 bg-clip-text text-transparent">
                                    Riwayat Laporan PPKS
                                </h1>
                                <p class="text-neutral-600">Kelola dan pantau semua laporan Anda</p>
                            </div>
                        </div>
                    </section>

                    <section class="animate-slide-up">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8 stagger-animation">
                            <div class="glass-effect rounded-2xl p-6 shadow-soft hover-lift border border-white/50 cursor-pointer" onclick="filterReports('all')">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-file-alt text-blue-600"></i>
                                    </div>
                                </div>
                                <p class="text-2xl font-bold gradient-text" id="statTotalLaporan">0</p>
                                <p class="text-sm text-neutral-600">Total Laporan</p>
                            </div>
                            
                            <div class="glass-effect rounded-2xl p-6 shadow-soft hover-lift border border-white/50 cursor-pointer" onclick="filterReports('reported')">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-exclamation-circle text-yellow-600"></i>
                                    </div>
                                </div>
                                <p class="text-2xl font-bold gradient-text" id="statDilaporkan">0</p>
                                <p class="text-sm text-neutral-600">Dilaporkan</p>
                            </div>
                            
                            <div class="glass-effect rounded-2xl p-6 shadow-soft hover-lift border border-white/50 cursor-pointer" onclick="filterReports('investigating')">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-search text-orange-600"></i>
                                    </div>
                                </div>
                                <p class="text-2xl font-bold gradient-text" id="statInvestigasi">0</p>
                                <p class="text-sm text-neutral-600">Investigasi</p>
                            </div>
                            
                            <div class="glass-effect rounded-2xl p-6 shadow-soft hover-lift border border-white/50 cursor-pointer" onclick="filterReports('resolved')">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-check-circle text-green-600"></i>
                                    </div>
                                </div>
                                <p class="text-2xl font-bold gradient-text" id="statSelesai">0</p>
                                <p class="text-sm text-neutral-600">Selesai</p>
                            </div>
                        </div>
                    </section>

                    <section class="glass-effect rounded-2xl p-6 shadow-soft hover-lift border border-white/50 detail-card animate-slide-up" id="detailSection">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            <div class="lg:col-span-1 space-y-4">
                                <div class="flex items-center space-x-3 mb-4">
                                    <div class="w-8 h-8 bg-telusafe-100 rounded-lg flex items-center justify-center animate-pulse-soft">
                                        <i class="fas fa-file-text text-telusafe-600"></i>
                                    </div>
                                    <h2 class="text-[20px] font-semibold font-display">Detail Laporan</h2>
                                    <div class="ml-auto">
                                        <span class="status-badge bg-gradient-to-r from-neutral-500 to-neutral-600 text-white px-3 py-1 rounded-full text-xs font-medium" id="detailStatusBadge">
                                            N/A
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="space-y-4">
                                    <div class="p-4 bg-neutral-50 rounded-xl">
                                        <p class="text-xs font-medium text-neutral-500 mb-1">ID Laporan</p>
                                        <p class="text-lg font-bold text-telusafe-600" id="reportId">-</p>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-sm font-medium text-neutral-600 mb-1">Tanggal</p>
                                            <p class="text-sm text-neutral-800" id="reportDate">-</p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-neutral-600 mb-1">Waktu</p>
                                            <p class="text-sm text-neutral-800" id="reportTime">-</p>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <p class="text-sm font-medium text-neutral-600 mb-1">Jenis Laporan</p>
                                        <p class="text-sm text-neutral-800" id="reportType">-</p>
                                    </div>
                                    
                                    <div>
                                        <p class="text-sm font-medium text-neutral-600 mb-1">Lokasi</p>
                                        <p class="text-sm text-neutral-800" id="reportLocation">-</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="lg:col-span-1">
                                <div class="h-full">
                                    <div class="flex items-center space-x-2 mb-3">
                                        <i class="fas fa-align-left text-telusafe-500"></i>
                                        <p class="text-sm font-medium text-neutral-600">Deskripsi Kejadian</p>
                                    </div>
                                    <div class="text-sm text-neutral-700 leading-relaxed bg-neutral-50 rounded-xl p-4 h-[280px] overflow-y-auto" id="reportDescription">
                                        <p class="text-center text-neutral-400 py-10">Pilih laporan dari tabel untuk melihat detailnya.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="lg:col-span-1">
                                <div class="h-full">
                                    <div class="flex items-center space-x-2 mb-3">
                                        <i class="fas fa-paperclip text-telusafe-500"></i>
                                        <p class="text-sm font-medium text-neutral-600">Bukti Pendukung</p>
                                    </div>
                                    <div class="evidence-placeholder rounded-2xl p-6 h-[280px] flex flex-col items-center justify-center text-center" id="evidenceSection">
                                        <div class="w-16 h-16 bg-neutral-200 rounded-2xl flex items-center justify-center mb-4 animate-bounce-gentle">
                                            <i class="fas fa-folder-open text-neutral-400 text-2xl"></i>
                                        </div>
                                        <p class="text-sm text-neutral-500 font-medium">Tidak ada bukti</p>
                                        <p class="text-xs text-neutral-400 mt-1">Pilih laporan untuk melihat detail.</p>
                                         <button class="mt-4 px-4 py-2 bg-telusafe-500 text-white rounded-lg text-xs hover:bg-telusafe-600 transition-colors" onclick="uploadEvidence()" style="display:none;">
                                            <i class="fas fa-upload mr-2"></i> Upload Bukti
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="glass-effect rounded-2xl p-6 shadow-soft border border-white/50 animate-slide-up">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-table text-telusafe-500 text-xl animate-wiggle"></i>
                                <h2 class="text-[20px] font-semibold font-display">Daftar Laporan PPKS</h2>
                            </div>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full table-auto">
                                <thead>
                                    <tr class="border-b-2 border-neutral-200">
                                        <th class="text-left py-4 px-4 font-semibold text-sm text-neutral-700 w-12">No</th>
                                        <th class="text-left py-4 px-4 font-semibold text-sm text-neutral-700">Tanggal</th>
                                        <th class="text-left py-4 px-4 font-semibold text-sm text-neutral-700">Waktu</th>
                                        <th class="text-left py-4 px-4 font-semibold text-sm text-neutral-700">Jenis</th>
                                        <th class="text-left py-4 px-4 font-semibold text-sm text-neutral-700">Lokasi</th>
                                        <th class="text-left py-4 px-4 font-semibold text-sm text-neutral-700">Status</th>
                                        <th class="text-left py-4 px-4 font-semibold text-sm text-neutral-700">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="reportTableBody" class="stagger-animation">
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="flex items-center justify-between mt-6 pt-4 border-t border-neutral-200">
                            <p class="text-sm text-neutral-600" id="paginationInfo">Menampilkan 0 dari 0 laporan</p>
                        </div>
                    </section>
                </div>
            </div>
        </main>
    </div>

    <div id="toast" class="fixed top-4 right-4 glass-effect border-l-4 border-telusafe-500 rounded-lg shadow-strong p-4 transform translate-x-full transition-all duration-500 z-50 max-w-sm">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-3 animate-bounce-gentle" id="toast-icon"></i>
            <div>
                <p class="font-semibold text-sm" id="toast-title">Success!</p>
                <p class="text-xs text-neutral-600" id="toast-message">Action completed successfully!</p>
            </div>
        </div>
    </div>

    <div id="confirmModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300">
        <div class="glass-effect rounded-2xl p-6 max-w-md w-full mx-4 transform scale-90 transition-transform duration-300">
            <div class="text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold mb-2" id="modal-title">Konfirmasi Hapus</h3>
                <p class="text-neutral-600 mb-6" id="modal-message">Apakah Anda yakin ingin menghapus laporan ini?</p>
                <div class="flex space-x-3">
                    <button class="flex-1 px-4 py-2 border border-neutral-300 rounded-lg text-sm hover:bg-neutral-50 transition-colors" onclick="closeModal()">
                        Batal
                    </button>
                    <button class="flex-1 px-4 py-2 bg-red-500 text-white rounded-lg text-sm hover:bg-red-600 transition-colors" onclick="confirmAction()">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let pendingAction = null;
        let semuaLaporanPengguna = []; 
        let laporanYangDitampilkan = []; 
        let currentReportDetails = null; 

        // Fungsi-fungsi lama yang berbasis data sampel (reportData) telah dihapus.

        document.addEventListener('DOMContentLoaded', function() {
            initializeTableHandlers();
            clearDetailSection(); // Bersihkan detail saat halaman pertama kali dimuat
            
            const auth = firebase.auth();
            const database = firebase.database();

            auth.onAuthStateChanged(function(user) {
                const profileUsernameElement = document.getElementById('profileUsername');
                const profileStatusElement = document.getElementById('profileStatus');

                if (user) {
                    database.ref('users/' + user.uid).once('value')
                        .then(function(snapshot) {
                            if (snapshot.exists()) {
                                const userData = snapshot.val();
                                const usernameUntukProfil = userData.username || 'Username';
                                const status = userData.status || 'Status tidak diketahui';
                                if (profileUsernameElement) profileUsernameElement.textContent = usernameUntukProfil;
                                if (profileStatusElement) profileStatusElement.textContent = status.charAt(0).toUpperCase() + status.slice(1);
                            } else {
                                if (profileUsernameElement) profileUsernameElement.textContent = 'User';
                                if (profileStatusElement) profileStatusElement.textContent = 'N/A';
                            }
                        })
                        .catch(function(error) {
                            console.error('Gagal mengambil data profil pengguna:', error);
                            if (profileUsernameElement) profileUsernameElement.textContent = 'Error';
                            if (profileStatusElement) profileStatusElement.textContent = 'Error';
                        });
                    loadUserReports(user.uid, database);
                } else {
                    if (profileUsernameElement) profileUsernameElement.textContent = 'Guest';
                    if (profileStatusElement) profileStatusElement.textContent = '-';
                    const reportTableBody = document.getElementById('reportTableBody');
                    if(reportTableBody) reportTableBody.innerHTML = '<tr><td colspan="7" class="text-center py-10">Silakan login untuk melihat riwayat laporan Anda.</td></tr>';
                    updateStatisticsCards([]); 
                    clearDetailSection();
                    document.getElementById('paginationInfo').textContent = 'Menampilkan 0 dari 0 laporan';
                    document.getElementById('paginationControls').innerHTML = '';
                }
            });
        });

        function loadUserReports(userId, database) {
            const reportsRef = database.ref('laporan');
            const reportTableBody = document.getElementById('reportTableBody');
            if (!reportTableBody) return;

            reportTableBody.innerHTML = '<tr><td colspan="7" class="text-center py-10"><i class="fas fa-spinner fa-spin mr-2"></i>Memuat laporan...</td></tr>';

            reportsRef.orderByChild('userId').equalTo(userId).on('value', (snapshot) => {
                semuaLaporanPengguna = []; 
                if (snapshot.exists()) {
                    snapshot.forEach(childSnapshot => {
                        const report = childSnapshot.val();
                        report.firebaseKey = childSnapshot.key; 
                        semuaLaporanPengguna.push(report);
                    });
                    
                    semuaLaporanPengguna.reverse(); 
                    
                    laporanYangDitampilkan = [...semuaLaporanPengguna]; 
                    
                    renderReportTable(laporanYangDitampilkan);
                    updateStatisticsCards(semuaLaporanPengguna); 
                    updatePaginationInfo(laporanYangDitampilkan.length, laporanYangDitampilkan.length); // Asumsi semua ditampilkan dulu

                    if (laporanYangDitampilkan.length > 0) {
                        viewReportAndUpdateDOM(laporanYangDitampilkan[0].firebaseKey); 
                        const firstRow = reportTableBody.querySelector('.table-row');
                        if(firstRow) firstRow.classList.add('selected');
                    } else {
                        reportTableBody.innerHTML = '<tr><td colspan="7" class="text-center py-10">Anda belum membuat laporan.</td></tr>';
                        clearDetailSection();
                    }
                    showToast('Berhasil', 'Riwayat laporan berhasil dimuat.', 'success');
                } else {
                    reportTableBody.innerHTML = '<tr><td colspan="7" class="text-center py-10">Anda belum membuat laporan.</td></tr>';
                    updateStatisticsCards([]); 
                    clearDetailSection();
                    updatePaginationInfo(0,0);
                    showToast('Info', 'Anda belum memiliki riwayat laporan.', 'info');
                }
            }, (error) => {
                console.error("Error fetching reports: ", error);
                reportTableBody.innerHTML = '<tr><td colspan="7" class="text-center py-10 text-red-500">Gagal memuat laporan.</td></tr>';
                showToast('Error', 'Gagal memuat riwayat laporan.', 'error');
            });
        }

        function renderReportTable(reportsToRender) {
            const reportTableBody = document.getElementById('reportTableBody');
            if (!reportTableBody) return;
            reportTableBody.innerHTML = ''; 

            if (reportsToRender.length === 0) {
                reportTableBody.innerHTML = '<tr><td colspan="7" class="text-center py-10">Tidak ada laporan yang sesuai.</td></tr>';
                return;
            }

            reportsToRender.forEach((report, index) => {
                const row = document.createElement('tr');
                row.className = 'table-row border-b border-neutral-100';
                row.setAttribute('data-report-id', report.firebaseKey);

                let statusBadgeHtml = '';
                let statusText = report.statusProsesLaporan || 'N/A';
                let statusColorClasses = 'from-gray-100 to-gray-200 text-gray-800'; 
                
                if (statusText === 'Belum') { 
                    statusColorClasses = 'from-blue-100 to-blue-200 text-blue-800';
                } else if (statusText === 'Diproses') {
                    statusColorClasses = 'from-orange-100 to-orange-200 text-orange-800';
                } else if (statusText === 'Selesai') {
                    statusColorClasses = 'from-green-100 to-green-200 text-green-800';
                } 
                statusBadgeHtml = `<span class="status-badge bg-gradient-to-r ${statusColorClasses} px-3 py-1 rounded-full text-xs font-medium">${statusText}</span>`;
                
                const displayDate = report.tanggalKejadianFull || 'N/A';
                const displayTime = report.waktuKejadian ? report.waktuKejadian.replace(' WIB', '') : 'N/A';

                row.innerHTML = `
                    <td class="py-4 px-4 text-sm text-neutral-800 font-medium">${index + 1}</td>
                    <td class="py-4 px-4 text-sm text-neutral-800">${displayDate}</td>
                    <td class="py-4 px-4 text-sm text-neutral-600">${displayTime}</td>
                    <td class="py-4 px-4 text-sm text-neutral-800">${report.peranPelapor || 'N/A'}</td>
                    <td class="py-4 px-4 text-sm text-neutral-800 truncate max-w-[120px] sm:max-w-[150px] md:max-w-xs" title="${report.lokasiKejadian || ''}">${report.lokasiKejadian || 'N/A'}</td>
                    <td class="py-4 px-4">${statusBadgeHtml}</td>
                    <td class="py-4 px-4">
                        <div class="flex space-x-2">
                            <button class="action-button view w-9 h-9 flex items-center justify-center rounded-full border border-neutral-300 hover:bg-neutral-100 hover:border-neutral-400 transition-all" title="Lihat Detail" onclick="viewReportAndUpdateDOM('${report.firebaseKey}')">
                                <i class="fas fa-eye text-neutral-600 text-sm"></i>
                            </button>
                            <button class="action-button delete w-9 h-9 flex items-center justify-center rounded-full border border-neutral-300 hover:bg-red-50 hover:border-red-300 transition-all" title="Hapus Laporan" onclick="deleteReport('${report.firebaseKey}')">
                                <i class="fas fa-trash text-neutral-600 hover:text-red-600 text-sm"></i>
                            </button>
                        </div>
                    </td>
                `;
                reportTableBody.appendChild(row);
            });
        }

        function viewReportAndUpdateDOM(reportKey) { 
            console.log("Mencoba menampilkan detail untuk key:", reportKey);
            const reportToView = semuaLaporanPengguna.find(r => r.firebaseKey === reportKey);

            if (reportToView) {
                console.log("Laporan ditemukan:", reportToView);
                currentReportDetails = reportToView; 
                populateDetailSection(reportToView); 

                const tableRows = document.querySelectorAll('#reportTableBody .table-row');
                tableRows.forEach(r => {
                    r.classList.remove('selected');
                    if (r.getAttribute('data-report-id') === reportKey) {
                        r.classList.add('selected');
                        const detailSectionEl = document.getElementById('detailSection');
                        if (detailSectionEl && window.innerWidth < 768) { 
                            detailSectionEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }
                    }
                });
            } else {
                console.warn("Laporan dengan key:", reportKey, "tidak ditemukan.");
                clearDetailSection(); 
            }
        }
        
        function clearDetailSection() {
            document.getElementById('reportId').textContent = '-';
            document.getElementById('reportDate').textContent = '-';
            document.getElementById('reportTime').textContent = '-';
            document.getElementById('reportType').textContent = '-';
            document.getElementById('reportLocation').textContent = '-';
            document.getElementById('reportDescription').innerHTML = '<p class="text-center text-neutral-400 py-10">Pilih laporan dari tabel untuk melihat detailnya.</p>';
            
            const detailStatusBadge = document.getElementById('detailStatusBadge');
            if(detailStatusBadge) {
                detailStatusBadge.textContent = 'N/A';
                detailStatusBadge.className = 'status-badge bg-gradient-to-r from-neutral-500 to-neutral-600 text-white px-3 py-1 rounded-full text-xs font-medium';
            }

            const evidenceSection = document.getElementById('evidenceSection');
            if (evidenceSection) {
                evidenceSection.innerHTML = `
                    <div class="w-16 h-16 bg-neutral-200 rounded-2xl flex items-center justify-center mb-4 animate-bounce-gentle">
                        <i class="fas fa-folder-open text-neutral-400 text-2xl"></i>
                    </div>
                    <p class="text-sm text-neutral-500 font-medium">Tidak ada bukti</p>
                    <p class="text-xs text-neutral-400 mt-1">Pilih laporan untuk melihat detail.</p>
                    <button class="mt-4 px-4 py-2 bg-telusafe-500 text-white rounded-lg text-xs hover:bg-telusafe-600 transition-colors" onclick="uploadEvidence()" style="display:none;">
                        <i class="fas fa-upload mr-2"></i> Upload Bukti
                    </button>
                `;
            }
        }

        function populateDetailSection(report) {
            const detailSection = document.getElementById('detailSection');
            if (!detailSection) return;

            const reportIdEl = document.getElementById('reportId');
            const reportDateEl = document.getElementById('reportDate');
            const reportTimeEl = document.getElementById('reportTime');
            const reportTypeEl = document.getElementById('reportType');
            const reportLocationEl = document.getElementById('reportLocation');
            const reportDescriptionEl = document.getElementById('reportDescription');
            const detailStatusBadgeEl = document.getElementById('detailStatusBadge'); 
            const evidenceSectionEl = document.getElementById('evidenceSection'); 

            detailSection.style.opacity = '0.7'; 
            
            setTimeout(() => {
                if (reportIdEl) reportIdEl.textContent = report.firebaseKey ? report.firebaseKey.substring(0, 8).toUpperCase() + "..." : 'N/A';
                if (reportDateEl) reportDateEl.textContent = report.tanggalKejadianFull || 'N/A';
                if (reportTimeEl) reportTimeEl.textContent = report.waktuKejadian || 'N/A';
                if (reportTypeEl) reportTypeEl.textContent = report.peranPelapor || 'N/A';
                if (reportLocationEl) reportLocationEl.textContent = report.lokasiKejadian || 'N/A';
                if (reportDescriptionEl) {
                    reportDescriptionEl.innerHTML = `<p class="break-words">${report.deskripsiKejadian || 'Tidak ada deskripsi.'}</p>`;
                }
                
                if (detailStatusBadgeEl) {
                    let statusText = report.statusProsesLaporan || 'N/A';
                    let statusColorClasses = 'from-neutral-500 to-neutral-600'; 
                    if (statusText === 'Belum') statusColorClasses = 'from-blue-500 to-blue-600';
                    else if (statusText === 'Diproses') statusColorClasses = 'from-orange-500 to-orange-600';
                    else if (statusText === 'Selesai') statusColorClasses = 'from-green-500 to-green-600';
                    
                    detailStatusBadgeEl.className = `status-badge bg-gradient-to-r ${statusColorClasses} text-white px-3 py-1 rounded-full text-xs font-medium`;
                    detailStatusBadgeEl.textContent = statusText;
                }
                
                if (evidenceSectionEl) {
                    const uploadButtonHtml = `
                        <button class="mt-4 px-4 py-2 bg-telusafe-500 text-white rounded-lg text-xs hover:bg-telusafe-600 transition-colors" onclick="uploadEvidence()">
                            <i class="fas fa-upload mr-2"></i> Upload Bukti
                        </button>
                    `;
                    if (report.uploaded_file && report.uploaded_file !== "Tidak ada file diupload" && report.uploaded_file.trim() !== "") {
                        evidenceSectionEl.innerHTML = `
                            <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-4">
                                <i class="fas fa-file-alt text-green-600 text-2xl"></i>
                            </div>
                            <p class="text-sm text-neutral-700 font-medium">Bukti Terlampir:</p>
                            <p class="text-xs text-neutral-500 mt-1 break-all" title="${report.uploaded_file}">${report.uploaded_file}</p>
                            ${uploadButtonHtml.replace('Upload Bukti', 'Ganti Bukti')}
                        `;
                    } else {
                        evidenceSectionEl.innerHTML = `
                            <div class="w-16 h-16 bg-neutral-200 rounded-2xl flex items-center justify-center mb-4 animate-bounce-gentle">
                                <i class="fas fa-folder-open text-neutral-400 text-2xl"></i>
                            </div>
                            <p class="text-sm text-neutral-500 font-medium">Tidak ada bukti yang dilampirkan</p>
                            <p class="text-xs text-neutral-400 mt-1">File akan muncul di sini setelah diupload</p>
                            ${uploadButtonHtml}
                        `;
                    }
                }
                detailSection.style.opacity = '1';
            }, 150); 
        }

        function initializeTableHandlers() {
            const reportTableBody = document.getElementById('reportTableBody');
            if (!reportTableBody) return;

            reportTableBody.addEventListener('click', function(e) {
                const row = e.target.closest('.table-row');
                // Hanya proses jika klik BUKAN pada tombol di dalam baris
                if (row && !e.target.closest('button')) { 
                    const allRows = reportTableBody.querySelectorAll('.table-row');
                    allRows.forEach(r => r.classList.remove('selected'));
                    row.classList.add('selected');
                    
                    const reportKey = row.getAttribute('data-report-id');
                    if (reportKey) {
                        viewReportAndUpdateDOM(reportKey);
                    }
                }
            });
        }

        function updateStatisticsCards(allReportsArray) {
            const totalLaporanEl = document.getElementById('statTotalLaporan'); // Menggunakan ID
            const dilaporkanEl = document.getElementById('statDilaporkan');   // Menggunakan ID
            const investigasiEl = document.getElementById('statInvestigasi'); // Menggunakan ID
            const selesaiEl = document.getElementById('statSelesai');       // Menggunakan ID

            if (!totalLaporanEl || !dilaporkanEl || !investigasiEl || !selesaiEl) {
                console.warn("Satu atau lebih elemen statistik tidak ditemukan.");
                return;
            }

            if (!allReportsArray || allReportsArray.length === 0) {
                totalLaporanEl.textContent = '0';
                dilaporkanEl.textContent = '0';
                investigasiEl.textContent = '0';
                selesaiEl.textContent = '0';
                return;
            }

            totalLaporanEl.textContent = allReportsArray.length;
            dilaporkanEl.textContent = allReportsArray.filter(r => r.statusProsesLaporan === 'Belum').length;
            investigasiEl.textContent = allReportsArray.filter(r => r.statusProsesLaporan === 'Diproses').length;
            selesaiEl.textContent = allReportsArray.filter(r => r.statusProsesLaporan === 'Selesai').length;
        }
        
        function updatePaginationInfo(currentCount, totalCount) {
            const paginationInfoEl = document.getElementById('paginationInfo');
            if (paginationInfoEl) {
                 // Untuk sementara, kita tampilkan semua. Logika pagination sebenarnya lebih kompleks.
                paginationInfoEl.textContent = `Menampilkan ${currentCount} dari ${totalCount} laporan`;
            }
            // Logika untuk membuat tombol pagination bisa ditambahkan di sini jika diperlukan
        }

        function deleteReport(reportKey) {
            pendingAction = { type: 'delete', reportKey: reportKey };
            const reportToDelete = semuaLaporanPengguna.find(r => r.firebaseKey === reportKey);
            const displayId = reportToDelete ? (reportToDelete.firebaseKey.substring(0,8).toUpperCase()+"...") : (reportKey ? reportKey.substring(0,8).toUpperCase()+"..." : "Laporan ini");
            showModal('Konfirmasi Hapus', `Apakah Anda yakin ingin menghapus laporan ${displayId}?`);
        }

        function showModal(title, message) {
            const modal = document.getElementById('confirmModal');
            document.getElementById('modal-title').textContent = title;
            document.getElementById('modal-message').textContent = message;
            
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.querySelector('.glass-effect').classList.remove('scale-90');
            modal.querySelector('.glass-effect').classList.add('scale-100');
        }

        function closeModal() {
            const modal = document.getElementById('confirmModal');
            modal.querySelector('.glass-effect').classList.remove('scale-100');
            modal.querySelector('.glass-effect').classList.add('scale-90');
            
            setTimeout(() => {
                modal.classList.add('opacity-0', 'pointer-events-none');
            }, 200);
            
            pendingAction = null;
        }

        function confirmAction() {
            if (pendingAction && pendingAction.type === 'delete') {
                const reportKeyToDelete = pendingAction.reportKey;
                
                const database = firebase.database();
                database.ref('laporan/' + reportKeyToDelete).remove()
                    .then(() => {
                        showToast('Laporan Dihapus', `Laporan berhasil dihapus.`, 'success');
                        semuaLaporanPengguna = semuaLaporanPengguna.filter(r => r.firebaseKey !== reportKeyToDelete);
                        laporanYangDitampilkan = laporanYangDitampilkan.filter(r => r.firebaseKey !== reportKeyToDelete);
                        
                        renderReportTable(laporanYangDitampilkan);
                        updateStatisticsCards(semuaLaporanPengguna);
                        updatePaginationInfo(laporanYangDitampilkan.length, laporanYangDitampilkan.length);


                        if (currentReportDetails && currentReportDetails.firebaseKey === reportKeyToDelete) {
                            if (laporanYangDitampilkan.length > 0) {
                                viewReportAndUpdateDOM(laporanYangDitampilkan[0].firebaseKey);
                                const firstRow = document.querySelector('#reportTableBody .table-row');
                                if (firstRow) firstRow.classList.add('selected');
                            } else {
                                clearDetailSection();
                            }
                        } else if (laporanYangDitampilkan.length === 0) {
                             clearDetailSection();
                        }
                    })
                    .catch((error) => {
                        console.error("Error deleting report: ", error);
                        showToast('Gagal Hapus', 'Gagal menghapus laporan.', 'error');
                    });
            }
            closeModal();
            pendingAction = null;
        }

        function createSelectionEffect(element) {
            // ... (fungsi ini bisa dipertahankan jika masih relevan)
        }

        function filterReports(status) {
            // Implementasi filter berdasarkan status
            showToast('Filter Applied', `Filter: ${status}`, 'info');
            let filteredReports = [];
            if (status === 'all') {
                filteredReports = [...semuaLaporanPengguna];
            } else if (status === 'reported') {
                filteredReports = semuaLaporanPengguna.filter(r => r.statusProsesLaporan === 'Belum');
            } else if (status === 'investigating') {
                filteredReports = semuaLaporanPengguna.filter(r => r.statusProsesLaporan === 'Diproses');
            } else if (status === 'resolved') {
                filteredReports = semuaLaporanPengguna.filter(r => r.statusProsesLaporan === 'Selesai');
            }
            laporanYangDitampilkan = filteredReports;
            renderReportTable(laporanYangDitampilkan);
            updatePaginationInfo(laporanYangDitampilkan.length, semuaLaporanPengguna.length);
            if (laporanYangDitampilkan.length > 0) {
                viewReportAndUpdateDOM(laporanYangDitampilkan[0].firebaseKey);
                const firstRow = document.querySelector('#reportTableBody .table-row');
                if (firstRow) firstRow.classList.add('selected');
            } else {
                clearDetailSection();
            }
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
            showToast('History', 'You are already viewing report history!', 'info');
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

        function logout() {
            showToast('Logout', 'Logging out...', 'warning');
            setTimeout(() => {
                showToast('Goodbye', 'Stay safe and take care!', 'success');
                window.location.href = 'login';
            }, 1000);
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
        
        document.addEventListener('click', function(e) {
            if (e.target.matches('.hover-lift, .nav-item, .action-button, .table-row:not(button), button')) { // Modifikasi selector agar tidak double ripple
                const rippleTarget = e.target.closest('.hover-lift, .nav-item, .action-button, .table-row, button');
                if (rippleTarget && !rippleTarget.querySelector('.ripple-effect')) { // Cek jika ripple Diproses ada
                    const ripple = document.createElement('span');
                    const rect = rippleTarget.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.className = 'absolute rounded-full bg-white/30 pointer-events-none ripple-effect'; // Tambah class
                    ripple.style.transform = 'scale(0)';
                    ripple.style.animation = 'ripple 0.6s linear';
                    
                    rippleTarget.style.position = 'relative'; // Pastikan target punya position relative
                    rippleTarget.style.overflow = 'hidden'; // Untuk contain ripple
                    rippleTarget.appendChild(ripple);
                    
                    setTimeout(() => {
                        if (ripple.parentNode) {
                            ripple.parentNode.removeChild(ripple);
                        }
                    }, 600);
                }
            }
        });

        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

    </script>
</body>
</html>