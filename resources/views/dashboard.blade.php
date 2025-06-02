<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TeluSafe Dashboard</title>
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
                        'typing': 'typing 3.5s steps(40, end), blink-caret 0.75s step-end infinite',
                        'gradient-shift': 'gradientShift 3s ease-in-out infinite',
                        'notification-bounce': 'notificationBounce 2s infinite',
                        'emoji-pop': 'emojiPop 0.6s ease-out',
                        'heart-beat': 'heartBeat 1.5s ease-in-out infinite'
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
                        typing: {
                            'from': { width: '0' },
                            'to': { width: '100%' }
                        },
                        'blink-caret': {
                            'from, to': { 'border-color': 'transparent' },
                            '50%': { 'border-color': '#EF4444' }
                        },
                        gradientShift: {
                            '0%, 100%': { 'background-position': '0% 50%' },
                            '50%': { 'background-position': '100% 50%' }
                        },
                        notificationBounce: {
                            '0%, 100%': { transform: 'scale(1)' },
                            '50%': { transform: 'scale(1.3)' }
                        },
                        emojiPop: {
                            '0%': { transform: 'scale(1)' },
                            '50%': { transform: 'scale(1.4) rotate(10deg)' },
                            '100%': { transform: 'scale(1.2) rotate(0deg)' }
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
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .hover-lift {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-lift:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.15);
        }

        .emoji-hover {
            filter: grayscale(100%) brightness(0.8);
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform: scale(1);
            position: relative;
            border-radius: 50%;
            padding: 8px;
            user-select: none;
            z-index: 10;
            display: inline-block;
        }

        .emoji-hover.selected, .emoji-hover:hover {
            filter: none;
            transform: scale(1.3) rotate(5deg);
            text-shadow: 0 0 20px rgba(239, 68, 68, 0.5);
            box-shadow: 0 0 20px rgba(239, 68, 68, 0.3);
        }

        .emoji-hover:active {
            transform: scale(1.4) rotate(-5deg);
        }

        .emoji-hover.selected {
            animation: emojiPop 0.6s ease-out;
            background: rgba(239, 68, 68, 0.1);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .nav-hover {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-hover:hover {
            transform: translateX(8px);
            background: rgba(255, 255, 255, 0.15);
        }

        .nav-hover::before {
            content: '';
            position: absolute;
            left: -100%;
            top: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .nav-hover:hover::before {
            left: 100%;
        }

        .sidebar-active {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
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

        .gradient-text {
            background: linear-gradient(135deg, #DC2626, #EF4444, #F87171);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradientShift 3s ease-in-out infinite;
        }

        .chat-bubble {
            animation: slideUp 0.5s ease-out;
            transform-origin: bottom left;
        }

        .chat-bubble:nth-child(even) {
            animation-delay: 0.1s;
        }

        .chat-bubble:nth-child(odd) {
            animation-delay: 0.2s;
        }

        .typing-indicator {
            animation: typing 3.5s steps(40, end) infinite;
            border-right: 2px solid #EF4444;
            white-space: nowrap;
            overflow: hidden;
        }

        .parallax-bg {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
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

        .loading-shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        .notification-pulse {
            animation: notificationBounce 2s infinite;
        }

        .welcome-banner {
            background: linear-gradient(135deg, #DC2626, #EF4444, #F87171);
            background-size: 400% 400%;
            animation: gradientShift 5s ease-in-out infinite;
        }

        .heart-icon {
            animation: heartBeat 1.5s ease-in-out infinite;
        }

        .celebration-particle {
            position: fixed;
            pointer-events: none;
            z-index: 1000;
        }

        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-neutral-50 to-neutral-100 min-h-screen text-neutral-900 font-sans">
    <div class="flex min-h-screen max-w-[1600px] mx-auto bg-white/60 backdrop-blur-sm rounded-none lg:rounded-4xl lg:m-4 shadow-strong overflow-hidden border border-white/20 animate-scale-in">
        <aside class="bg-gradient-to-b from-telusafe-700 to-telusafe-800 w-72 flex flex-col p-8 space-y-8 text-white relative overflow-hidden select-none animate-slide-right">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-16 translate-x-16 animate-float"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12 animate-bounce-gentle"></div>

            <div class="flex items-center space-x-4 relative z-10 group">
                <div class="w-10 h-10 bg-white/20 rounded-2xl flex items-center justify-center group-hover:rotate-12 transition-transform duration-300">
                    <img src="{{ asset('assets/webStudent/Logo.png') }}" alt="TeluSafe Logo" class="w-8 h-8 object-contain"/>
                </div>
                <span class="font-display font-bold text-xl select-text">TeluSafe</span>
            </div>

            <nav class="flex flex-col space-y-3 text-sm font-medium relative z-10 stagger-animation">
                <a class="flex items-center space-x-4 p-3 rounded-2xl nav-hover font-semibold sidebar-active" href="#" onclick="navigateTo('home')">
                    <i class="fas fa-th-large text-white text-lg"></i>
                    <span>Beranda</span>
                </a>

                <div class="space-y-2">
                    <div class="flex items-center space-x-4 p-3 rounded-2xl nav-hover font-semibold cursor-pointer" onclick="toggleSection('ppks')">
                        <i class="fas fa-cogs text-white text-base"></i>
                        <span>PPKS</span>
                        <i class="fas fa-chevron-down ml-auto transition-transform duration-300" id="ppks-arrow"></i>
                    </div>
                    <div class="flex flex-col pl-12 space-y-1 text-sm font-normal" id="ppks-menu" style="display: none;">
                        <a class="flex items-center space-x-2 p-2 rounded-2xl nav-hover" href="#" onclick="createReport()">
                            <div class="w-5 h-5 bg-white rounded flex items-center justify-center">
                                <i class="fas fa-plus text-telusafe-600 text-xs"></i>
                            </div>
                            <span>Buat Laporan</span>
                        </a>
                        <a class="flex items-center space-x-2 p-2 rounded-2xl nav-hover" href="#" onclick="viewHistory()">
                            <div class="w-5 h-5 bg-white rounded flex items-center justify-center">
                                <i class="fas fa-history text-telusafe-600 text-xs"></i>
                            </div>
                            <span>Riwayat Laporan</span>
                        </a>
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="flex items-center space-x-4 p-3 rounded-2xl nav-hover font-semibold cursor-pointer" onclick="toggleSection('bk')">
                        <i class="fas fa-user-friends text-white text-base"></i>
                        <span>BK</span>
                        <i class="fas fa-chevron-down ml-auto transition-transform duration-300" id="bk-arrow"></i>
                    </div>
                    <div class="flex flex-col pl-12 space-y-1 text-sm font-normal" id="bk-menu" style="display: none;">
                        <a class="flex items-center space-x-2 p-2 rounded-2xl nav-hover" href="#" onclick="createSchedule()">
                            <div class="w-5 h-5 bg-white rounded flex items-center justify-center">
                                <i class="fas fa-calendar text-telusafe-600 text-xs"></i>
                            </div>
                            <span>Buat Jadwal</span>
                        </a>
                        <a class="flex items-center space-x-2 p-2 rounded-2xl nav-hover" href="#" onclick="viewCounseling()">
                            <div class="w-5 h-5 bg-white rounded flex items-center justify-center">
                                <i class="fas fa-comments text-telusafe-600 text-xs"></i>
                            </div>
                            <span>Riwayat Konseling</span>
                        </a>
                    </div>
                </div>

                <div class="space-y-2">
                    <div class="flex items-center space-x-4 p-3 rounded-2xl nav-hover font-semibold cursor-pointer" onclick="toggleSection('emosi')">
                        <i class="fas fa-smile text-white text-base"></i>
                        <span>Emosiku</span>
                        <i class="fas fa-chevron-down ml-auto transition-transform duration-300" id="emosi-arrow"></i>
                    </div>
                    <div class="flex flex-col pl-12 space-y-1 text-sm font-normal" id="emosi-menu" style="display: none;">
                        <a class="flex items-center space-x-2 p-2 rounded-2xl nav-hover" href="#" onclick="createNote()">
                            <div class="w-5 h-5 bg-white rounded flex items-center justify-center">
                                <i class="fas fa-edit text-telusafe-600 text-xs"></i>
                            </div>
                            <span>Buat Catatan Harian</span>
                        </a>
                        <a class="flex items-center space-x-2 p-2 rounded-2xl nav-hover" href="#" onclick="viewNotes()">
                            <div class="w-5 h-5 bg-white rounded flex items-center justify-center">
                                <i class="fas fa-book text-telusafe-600 text-xs"></i>
                            </div>
                            <span>Catatan Harian</span>
                        </a>
                    </div>
                </div>
            </nav>

            <button aria-label="Logout" class="mt-auto flex items-center space-x-3 text-white/70 hover:text-white transition-all p-3 rounded-2xl nav-hover relative z-10" onclick="logout()">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
        </aside>

        <main class="flex-1 flex flex-col min-h-screen animate-fade-in">
            <header class="glass-effect p-6 border-b border-neutral-200/50 animate-slide-down">
                <div class="flex flex-col md:flex-row md:items-center md:justify-end space-y-4 md:space-y-0">

                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2 glass-effect rounded-full p-2 hover-lift cursor-pointer" onclick="showProfile()">
                            <img src="{{ asset('assets/webStudent/iconorang 1.png') }}" alt="User Profile" class="w-10 h-10 rounded-full object-cover"/>
                            <div class="text-right pr-2">
                                <p class="text-sm font-semibold leading-none" id="profileUsername">Loading...</p>
                                <p class="text-xs text-neutral-500 leading-none" id="profileStatus">Loading...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="flex-1 p-6 space-y-8 overflow-y-auto">
                <section class="relative welcome-banner rounded-4xl p-8 text-white overflow-hidden min-h-[180px] animate-slide-up">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-32 translate-x-32"></div>
                    <div class="relative z-10 max-w-xl">
                        <p class="text-sm text-white/80 mb-2 animate-fade-in" id="currentDate"></p>
                        <h1 class="text-white font-display font-bold text-4xl leading-tight mb-2 typing-indicator">Welcome back, <span id="userName">Loading...</span></h1>
                        <p class="text-white/90 text-lg animate-slide-up">Always stay updated in your TeluSafe portal</p>
                    </div>
                    <div class="absolute top-0 bottom-0 right-3 w-90 h-70">
                        <img src="{{ asset('assets/webStudent/HeaderDashboard.png') }}" alt="Header Garnish" class="object-contain w-full h-full"/>
                    </div>
                </section>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <div class="lg:col-span-9 space-y-6">
                        <section class="animate-slide-up">
                            <h2 class="text-[24px] font-display font-semibold mb-6 flex items-center">
                                <i class="fas fa-chart-bar text-telusafe-500 mr-3 animate-bounce-gentle"></i>
                                Laporan PPKS
                            </h2>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 stagger-animation">
                                <div class="glass-effect rounded-2xl p-6 shadow-soft hover-lift border border-white/50 stat-card cursor-pointer" onclick="viewHistory()">
                                    <div class="w-12 h-12 bg-gradient-to-br from-telusafe-100 to-telusafe-200 rounded-2xl flex items-center justify-center absolute top-6 left-6 animate-pulse-soft">
                                        <i class="fas fa-clipboard text-telusafe-600 text-xl"></i>
                                    </div>
                                    <p class="text-[45px] font-bold font-display pt-8 text-center gradient-text counter" id="dashboardTotalLaporanCounter" data-count="0">0</p>
                                    <p class="text-[20px] font-semibold font-display text-center">Dilaporkan</p>
                                </div>
                                <div class="glass-effect rounded-2xl p-6 shadow-soft hover-lift border border-white/50 stat-card cursor-pointer" onclick="viewHistory()">
                                    <div class="w-12 h-12 bg-gradient-to-br from-telusafe-100 to-telusafe-200 rounded-2xl flex items-center justify-center absolute top-6 left-6 animate-pulse-soft">
                                        <i class="fas fa-hourglass-half text-telusafe-600 text-xl"></i>
                                    </div>
                                    <p class="text-[45px] font-bold font-display pt-8 text-center gradient-text counter" id="dashboardInvestigasiCounter" data-count="0">0</p>
                                    <p class="text-[20px] font-semibold font-display text-center">Diproses</p>
                                    <p class="text-xs text-neutral-500 text-center mt-1">Dalam antrian</p>
                                </div>
                                <div class="glass-effect rounded-2xl p-6 shadow-soft hover-lift border border-white/50 stat-card cursor-pointer" onclick="viewHistory()">
                                    <div class="w-12 h-12 bg-gradient-to-br from-telusafe-100 to-telusafe-200 rounded-2xl flex items-center justify-center absolute top-6 left-6 animate-pulse-soft">
                                        <i class="fas fa-file-alt text-telusafe-600 text-xl"></i>
                                    </div>
                                    <p class="text-[45px] font-bold font-display pt-8 text-center gradient-text counter" id="dashboardSelesaiCounter" data-count="0">0</p> <p class="text-[20px] font-semibold font-display text-center">Riwayat Laporan</p>
                                    <p class="text-xs text-neutral-500 text-center mt-1">Total selesai</p>
                                </div>
                            </div>
                        </section>

                        <section class="space-y-4 animate-slide-up">
                            <h2 class="text-[24px] font-display font-semibold flex items-center">
                                <i class="fas fa-user-friends text-telusafe-500 mr-3 animate-wiggle"></i>
                                Bimbingan Konseling
                            </h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 stagger-animation">
                                <div class="glass-effect rounded-4xl p-8 shadow-soft hover-lift border border-white/50 flex flex-col items-center space-y-8 cursor-pointer" onclick="viewSchedule()">
                                    <h3 class="text-[20px] font-semibold font-display text-center">Jadwal Konseling Terdekat</h3>
                                    <div class="w-16 h-16 bg-gradient-to-br from-telusafe-100 to-telusafe-200 rounded-2xl flex items-center justify-center animate-bounce-gentle">
                                        <i class="fas fa-calendar-alt text-telusafe-600 text-2xl"></i>
                                    </div>
                                    <p class="text-[18px] font-medium font-display text-center">Selasa, 3 Juni 2025<br/><span class="text-sm text-neutral-600">14:00 WIB</span></p>
                                </div>
                                <div class="glass-effect rounded-4xl p-8 shadow-soft hover-lift border border-white/50 relative cursor-pointer" onclick="viewCounseling()">
                                    <div class="w-12 h-12 bg-gradient-to-br from-telusafe-100 to-telusafe-200 rounded-2xl flex items-center justify-center absolute top-8 left-8 animate-pulse-soft">
                                        <i class="fas fa-comments text-telusafe-600 text-xl"></i>
                                    </div>
                                    <div class="text-center mt-16">
                                        <p class="text-[45px] font-bold font-display mb-2 gradient-text counter" id="dashboardRiwayatKonselingCounter" data-count="0">0</p>
                                        <p class="text-[20px] font-semibold font-display">Riwayat Konseling</p>
                                        <p class="text-xs text-neutral-500 mt-1">Sesi selesai</p>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="animate-slide-up">
                            <h2 class="text-[24px] font-display font-semibold mb-6 flex items-center">
                                <i class="fas fa-smile text-telusafe-500 mr-3 animate-wiggle"></i>
                                Emosiku
                            </h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 stagger-animation">
                                <div class="glass-effect rounded-2xl p-6 shadow-soft hover-lift border border-white/50 flex flex-col space-y-3 relative select-none">
                                    <p class="text-[20px] font-semibold font-display text-center mb-6 pt-8 flex items-center justify-center">
                                        <i class="fas fa-heart text-telusafe-500 mr-2 heart-icon"></i>
                                        Emosiku
                                    </p>
                                    <div class="flex justify-center space-x-4 text-4xl relative z-20" id="emoji-container">
                                        <span aria-label="Angry face emoji" class="emoji-hover" role="button" tabindex="0" data-emo="angry" title="Marah">😠</span>
                                        <span aria-label="Sad face emoji" class="emoji-hover" role="button" tabindex="0" data-emo="sad" title="Sedih">😞</span>
                                        <span aria-label="Neutral face emoji" class="emoji-hover" role="button" tabindex="0" data-emo="neutral" title="Biasa saja">😐</span>
                                        <span aria-label="Happy face emoji" class="emoji-hover" role="button" tabindex="0" data-emo="happy" title="Senang">🙂</span>
                                        <span aria-label="Very happy face emoji" class="emoji-hover" role="button" tabindex="0" data-emo="very-happy" title="Sangat senang">😄</span>
                                    </div>
                                    <div class="text-center mt-4">
                                        <p class="text-sm text-neutral-500" id="mood-feedback">Bagaimana perasaanmu hari ini?</p>
                                    </div>
                                </div>
                                <div class="glass-effect rounded-4xl p-8 shadow-soft hover-lift border border-white/50 relative overflow-hidden h-[200px] cursor-pointer group" onclick="createNote()">
                                    <div class="flex items-start space-x-8">
                                        <div class="w-16 h-16 bg-gradient-to-br from-telusafe-100 to-telusafe-200 rounded-2xl flex items-center justify-center animate-float group-hover:rotate-12 transition-transform duration-300">
                                            <i class="fas fa-plus text-telusafe-600 text-2xl"></i>
                                        </div>
                                        <div class="pt-2">
                                            <h3 class="text-[20px] font-semibold mb-6 font-display">Catatan Harian</h3>
                                            <p class="text-[18px] font-medium font-display text-neutral-600">Bagaimana kabarmu<br/>hari ini?</p>
                                        </div>
                                    </div>
                                    <div class="absolute -bottom-4 -right-4 w-32 h-32 bg-gradient-to-tl from-telusafe-100 to-transparent rounded-full opacity-50 group-hover:scale-110 transition-transform duration-300"></div>
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
                                    <img src="{{ asset('assets/webStudent/BK.jpg') }}" alt="Alur Konseling BK" class="max-h-full max-w-full object-contain">
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
        // Initialize the application
        document.addEventListener('DOMContentLoaded', function() {
            initializeCounters();
            initializeEmotionSelector();
            initializeToastSystem();
            initializeRippleEffects();
            updateDate();
            const auth = firebase.auth();
            const database = firebase.database();
            // Add typing effect to welcome message
            setTimeout(() => {
                const welcomeText = document.querySelector('.typing-indicator');
                if (welcomeText) {
                    welcomeText.classList.remove('typing-indicator');
                }
            }, 3500); // Durasi sama dengan animasi CSS typing
            auth.onAuthStateChanged(function(user) {
                const userNameElement = document.getElementById('userName');
                const profileUsernameElement = document.getElementById('profileUsername');
                const profileStatusElement = document.getElementById('profileStatus');

                if (user) {
                    // Pengguna sudah login
                    console.log('User UID (dashboard):', user.uid);
                    database.ref('users/' + user.uid).once('value')
                        .then(function(snapshot) {
                            if (snapshot.exists()) {
                                const userData = snapshot.val();
                                const namaLengkapUntukWelcome = userData.nama_lengkap || 'Pengguna';
                                const usernameUntukProfil = userData.username || 'Username';
                                const status = userData.status || 'Status tidak diketahui';

                                if (userNameElement) {
                                    // Hapus class typing-indicator jika masih ada sebelum mengubah teks
                                    const welcomeTextH1 = document.querySelector('h1.typing-indicator');
                                    if (welcomeTextH1) welcomeTextH1.classList.remove('typing-indicator');
                                    userNameElement.textContent = namaLengkapUntukWelcome;
                                } else {
                                    console.error("Elemen #userName tidak ditemukan!");
                                }
                                if (profileUsernameElement) {
                                    profileUsernameElement.textContent = usernameUntukProfil;
                                } else {
                                    console.error("Elemen #profileUsername tidak ditemukan!");
                                }
                                if (profileStatusElement) {
                                    const formattedStatus = status.charAt(0).toUpperCase() + status.slice(1);
                                    profileStatusElement.textContent = formattedStatus;
                                } else {
                                    console.error("Elemen #profileStatus tidak ditemukan!");
                                }
                            } else {
                                console.warn('Data pengguna tidak ditemukan untuk UID:', user.uid);
                                if (userNameElement) userNameElement.textContent = 'User';
                                if (profileUsernameElement) profileUsernameElement.textContent = 'User';
                                if (profileStatusElement) profileStatusElement.textContent = 'N/A';
                            }
                        })
                        .catch(function(error) {
                            console.error('Gagal mengambil data pengguna:', error);
                            if (userNameElement) userNameElement.textContent = 'User';
                            if (profileUsernameElement) profileUsernameElement.textContent = 'Error';
                            if (profileStatusElement) profileStatusElement.textContent = 'Error';
                        });
                    loadDashboardReportStats(user.uid, database);
                    // loadDashboardCounselingStats(user.uid, database); // Jika ada fungsi ini
                } else {
                    // Pengguna tidak login
                    console.log('Pengguna belum login.');
                     const welcomeTextH1 = document.querySelector('h1.typing-indicator');
                    if (welcomeTextH1) welcomeTextH1.classList.remove('typing-indicator');
                    if (userNameElement) userNameElement.textContent = 'Guest';
                    if (profileUsernameElement) profileUsernameElement.textContent = 'Guest';
                    if (profileStatusElement) profileStatusElement.textContent = '-';
                    // Redirect ke halaman login jika diperlukan
                    // window.location.href = 'login';
                }
            });
        });

        // Counter animation
        function initializeCounters() {
            const counters = document.querySelectorAll('.counter');
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-count'));
                let current = 0;
                // Tentukan increment agar animasi selesai dalam waktu yang wajar (misal 1-2 detik)
                // Jika target 0, increment tidak perlu dihitung
                const animationDuration = 1500; // Durasi animasi dalam milidetik
                const framesPerSecond = 60;
                const totalFrames = (animationDuration / 1000) * framesPerSecond;
                const increment = target !== 0 ? target / totalFrames : 0;


                const updateCounter = () => {
                    if (target === 0) { // Langsung set jika target 0
                        counter.textContent = 0;
                        return;
                    }
                    current += increment;
                    if (current < target) {
                        counter.textContent = Math.ceil(current); // Gunakan Math.ceil agar tidak stuck di angka sebelum target
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target;
                    }
                };

                // Observer untuk memulai animasi saat elemen terlihat
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            current = 0; // Reset current saat elemen terlihat lagi (jika perlu)
                            counter.textContent = '0'; // Reset tampilan awal
                            updateCounter();
                            observer.unobserve(entry.target); // Hentikan observasi setelah animasi dimulai
                        }
                    });
                }, { threshold: 0.1 }); // threshold: 0.1 berarti animasi dimulai saat 10% elemen terlihat

                observer.observe(counter);
            });
        }


        // Enhanced Emoji selector functionality
        function initializeEmotionSelector() {
            const emojis = document.querySelectorAll('.emoji-hover');
            const moodFeedback = document.getElementById('mood-feedback');

            emojis.forEach((emoji, index) => {
                emoji.addEventListener('click', function(event) {
                    event.preventDefault();

                    emojis.forEach(e => {
                        e.classList.remove('selected');
                    });
                    this.classList.add('selected');
                    createCelebration(this);
                    const moodTitle = this.getAttribute('title');

                    if (moodFeedback) {
                        moodFeedback.textContent = `Kamu merasa ${moodTitle.toLowerCase()} hari ini`;
                    }
                    showToast('Mood Diperbarui!', `Kamu merasa ${moodTitle} hari ini.`, 'success');
                });
                emoji.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        this.click();
                    }
                });
            });
        }

        function createCelebration(element) {
            const rect = element.getBoundingClientRect();
            const centerX = rect.left + rect.width / 2;
            const centerY = rect.top + rect.height / 2;

            for (let i = 0; i < 6; i++) {
                const particle = document.createElement('div');
                particle.className = 'celebration-particle';
                particle.innerHTML = '❤️';
                particle.style.left = centerX + 'px';
                particle.style.top = centerY + 'px';
                particle.style.fontSize = '16px';

                const angle = (i * 60) * Math.PI / 180;
                const distance = Math.random() * 30 + 40; // Jarak acak
                const endX = centerX + Math.cos(angle) * distance;
                const endY = centerY + Math.sin(angle) * distance;

                document.body.appendChild(particle);

                particle.animate([
                    { transform: `translate(${centerX - centerX}px, ${centerY - centerY}px) scale(1)`, opacity: 1, offset: 0 },
                    { transform: `translate(${endX - centerX}px, ${endY - centerY - 20}px) scale(0.5)`, opacity: 0.5, offset: 0.8 }, // melayang sedikit ke atas
                    { transform: `translate(${endX - centerX}px, ${endY - centerY}px) scale(0)`, opacity: 0, offset: 1 }
                ], {
                    duration: 800 + Math.random() * 200, // Durasi acak
                    easing: 'cubic-bezier(0.175, 0.885, 0.32, 1.275)' // Easing yang lebih 'bouncy'
                }).onfinish = () => {
                    if (particle.parentNode) {
                         document.body.removeChild(particle);
                    }
                };
            }
        }

        function initializeToastSystem() {
            window.showToast = function(title, message, type = 'success') {
                const toast = document.getElementById('toast');
                const toastTitle = document.getElementById('toast-title');
                const toastMessage = document.getElementById('toast-message');
                const toastIcon = document.getElementById('toast-icon');

                toastIcon.className = 'fas mr-3 animate-bounce-gentle'; // Reset ikon
                toast.className = 'fixed top-4 right-4 glass-effect rounded-lg shadow-strong p-4 transform transition-all duration-500 z-50 max-w-sm translate-x-full'; // Reset class dan pastikan tersembunyi

                switch(type) {
                    case 'success':
                        toastIcon.className += ' fa-check-circle text-green-500';
                        toast.classList.add('border-l-4', 'border-green-500');
                        break;
                    case 'warning':
                        toastIcon.className += ' fa-exclamation-triangle text-yellow-500';
                        toast.classList.add('border-l-4', 'border-yellow-500');
                        break;
                    case 'info':
                        toastIcon.className += ' fa-info-circle text-blue-500';
                        toast.classList.add('border-l-4', 'border-blue-500');
                        break;
                    case 'error':
                        toastIcon.className += ' fa-times-circle text-red-500';
                        toast.classList.add('border-l-4', 'border-red-500');
                        break;
                }

                toastTitle.textContent = title;
                toastMessage.textContent = message;

                toast.style.transform = 'translateX(0)';
                setTimeout(() => {
                    toast.style.transform = 'translateX(100%)';
                }, 4000);
            };
        }

        function initializeRippleEffects() {
            document.addEventListener('click', function(e) {
                const clickableElement = e.target.closest('.hover-lift, .nav-hover, .stat-card, .emoji-hover, button, a.nav-hover'); // Tambahkan a.nav-hover
                if (clickableElement) {
                    const ripple = document.createElement('span');
                    const rect = clickableElement.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;

                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.className = 'absolute rounded-full bg-white/30 pointer-events-none';
                    ripple.style.transform = 'scale(0)';
                    ripple.style.animation = 'ripple 0.6s linear';
                    ripple.style.zIndex = '0'; // Pastikan ripple di belakang konten elemen

                    // Pastikan elemen target memiliki position relative atau absolute
                    if (getComputedStyle(clickableElement).position === 'static') {
                        clickableElement.style.position = 'relative';
                    }
                    clickableElement.style.overflow = 'hidden'; // Penting agar ripple tidak keluar batas

                    clickableElement.appendChild(ripple);

                    setTimeout(() => {
                        if (ripple.parentNode) {
                            ripple.parentNode.removeChild(ripple);
                        }
                    }, 600);
                }
            });
        }


        function loadDashboardReportStats(userId, database) {
            const reportsRef = database.ref('laporan');
            reportsRef.orderByChild('userId').equalTo(userId).on('value', (snapshot) => {
                let semuaLaporanPengguna = [];
                if (snapshot.exists()) {
                    snapshot.forEach(childSnapshot => {
                        semuaLaporanPengguna.push(childSnapshot.val());
                    });
                }
                const totalLaporanCount = semuaLaporanPengguna.length;
                const investigasiCount = semuaLaporanPengguna.filter(r => r.statusProsesLaporan === 'Diproses').length;
                const selesaiCount = semuaLaporanPengguna.filter(r => r.statusProsesLaporan === 'Selesai').length;

                updateCounterElement('dashboardTotalLaporanCounter', totalLaporanCount);
                updateCounterElement('dashboardInvestigasiCounter', investigasiCount);
                updateCounterElement('dashboardSelesaiCounter', selesaiCount);

            }, (error) => {
                console.error("Error fetching report stats for dashboard: ", error);
                updateCounterElement('dashboardTotalLaporanCounter', 0);
                updateCounterElement('dashboardInvestigasiCounter', 0);
                updateCounterElement('dashboardSelesaiCounter', 0);
            });
        }

        // Fungsi helper untuk update counter dan re-trigger animasi
        function updateCounterElement(elementId, count) {
            const el = document.getElementById(elementId);
            if (el) {
                el.setAttribute('data-count', count);
                // Untuk re-trigger animasi, kita perlu sedikit 'mengakali' IntersectionObserver
                // Cara termudah adalah dengan mereset textContent dan memanggil initializeCounters() lagi
                // atau meng-unobserve dan observe lagi jika sudah dibuat global.
                // Untuk sekarang, kita panggil ulang initializeCounters() setelah semua data diupdate.
                // Ini kurang optimal, tapi untuk kasus ini mungkin cukup.
                // Solusi lebih baik: buat instance Observer per counter atau kelola state animasi.
                el.textContent = '0'; // Reset tampilan awal sebelum animasi
            }
        }
        // Panggil initializeCounters setelah data di-load dan di-set
        // Jika loadDashboardReportStats dipanggil saat DOMContentLoaded, maka initializeCounters() akan dijalankan setelahnya.


        // Interactive functions
        function navigateTo(page) {
            showToast('Navigation', `Navigating to ${page}...`, 'info');
            if (page === 'home') {
                window.location.href = 'dashboard';
            }
        }

        function toggleSection(section) {
            const menu = document.getElementById(`${section}-menu`);
            const arrow = document.getElementById(`${section}-arrow`);
            if (menu.style.display === 'none' || menu.style.display === '') {
                menu.style.display = 'block';
                menu.classList.remove('animate-slideUp'); // Hapus animasi jika ada
                void menu.offsetWidth; // Trigger reflow
                menu.classList.add('animate-slideUp'); // Tambah animasi slideUp
                arrow.style.transform = 'rotate(180deg)';
            } else {
                menu.style.display = 'none';
                arrow.style.transform = 'rotate(0deg)';
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
        function readNews() {
            showToast('Berita', 'Membuka artikel berita...', 'info');
            setTimeout(function() {
                window.open('https://studentaffairs.telkomuniversity.ac.id/layanan-konseling-telkom-university/', '_blank'); // Buka di tab baru
            }, 500);
        }

        // Variabel untuk menyimpan riwayat chat jika ingin dikirim ke backend
        let chatHistory = [
            { role: 'assistant', content: 'Hai! Saya MinTel, asisten virtual TeluSafe. Ada yang bisa saya bantu?' } // Pesan awal dari bot
        ];


        async function sendMessage(event) {
            event.preventDefault();
            const input = document.getElementById('chat-input');
            const userMessage = input.value.trim();

            if (userMessage) {
                addChatMessage(userMessage, 'user');
                chatHistory.push({ role: 'user', content: userMessage });
                input.value = '';
                input.disabled = true;
                const loadingBubbleId = 'bot-loading-' + Date.now(); // ID unik untuk bubble loading
                addChatMessage("<i>MinTel sedang berpikir...</i>", 'bot-loading', loadingBubbleId);

                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const response = await fetch("{{ route('chatbot.ask') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ message: userMessage }) // Kirim pesan saat ini
                    });

                    const loadingBubble = document.getElementById(loadingBubbleId);
                    if (loadingBubble) {
                        loadingBubble.remove();
                    }

                    if (!response.ok) {
                        let errorData;
                        try {
                            errorData = await response.json();
                        } catch (e) {
                            errorData = { error: `Terjadi kesalahan pada server (Status: ${response.status}). Silakan coba lagi.` };
                        }
                        console.error('Error dari backend:', errorData);
                        addChatMessage(errorData.error || `Maaf, terjadi kesalahan (Status: ${response.status}).`, 'bot-error');
                        return;
                    }

                    const data = await response.json();
                    if (data.reply) {
                        addChatMessage(data.reply, 'bot');
                        chatHistory.push({ role: 'assistant', content: data.reply });
                    } else if (data.error) {
                         addChatMessage(data.error, 'bot-error');
                    }else {
                        addChatMessage('Maaf, saya menerima respons yang tidak terduga.', 'bot-error');
                    }
                } catch (error) {
                    console.error('Error mengirim pesan ke backend:', error);
                    const loadingBubble = document.getElementById(loadingBubbleId);
                    if (loadingBubble) {
                        loadingBubble.remove();
                    }
                    addChatMessage('Maaf, tidak dapat terhubung ke MinTel saat ini. Periksa koneksi Anda.', 'bot-error');
                } finally {
                    input.disabled = false;
                    input.focus();

                    // Batasi panjang riwayat chat (opsional, untuk menghemat memori/token)
                    const MAX_HISTORY_MESSAGES = 20; // Misal 10 percakapan (user + bot)
                    if (chatHistory.length > MAX_HISTORY_MESSAGES) {
                        chatHistory = chatHistory.slice(chatHistory.length - MAX_HISTORY_MESSAGES);
                    }
                }
            }
        }

        function addChatMessage(message, sender, bubbleId = null) {
            const chatContainer = document.getElementById('chat-container');
            const messageDiv = document.createElement('div');
            messageDiv.className = `flex items-start space-x-2 chat-bubble ${sender === 'user' ? 'justify-end' : ''}`;
            if (bubbleId) {
                messageDiv.id = bubbleId;
            }

            let bubbleContent = '';
            const sanitizedMessage = message.replace(/</g, "&lt;").replace(/>/g, "&gt;"); // Sanitasi dasar untuk mencegah XSS

            if (sender === 'user') {
                bubbleContent = `
                    <div class="bg-white rounded-2xl p-2 max-w-[200px] border border-telusafe-200 shadow">
                        <p class="text-neutral-800">${sanitizedMessage.replace(/\n/g, '<br>')}</p>
                    </div>
                    <div class="bg-white p-1 rounded-full text-telusafe-500 shrink-0 border border-telusafe-200 shadow-sm">
                        <i class="fas fa-user text-xs"></i>
                    </div>
                `;
            } else if (sender === 'bot') {
                bubbleContent = `
                    <div class="bg-telusafe-600 p-1 rounded-full text-white shrink-0 shadow-sm">
                        <i class="fas fa-headset text-xs"></i>
                    </div>
                    <div class="bg-neutral-100 rounded-2xl p-2 max-w-[200px] shadow">
                        <p class="text-neutral-800">${sanitizedMessage.replace(/\n/g, '<br>')}</p>
                    </div>
                `;
            } else if (sender === 'bot-loading') {
                bubbleContent = `
                    <div class="bg-telusafe-600 p-1 rounded-full text-white shrink-0 shadow-sm">
                        <i class="fas fa-headset text-xs"></i>
                    </div>
                    <div class="bg-neutral-100 rounded-2xl p-2 max-w-[200px] shadow">
                        <p class="text-neutral-500 italic">${message}</p> </div>
                `;
            } else if (sender === 'bot-error') {
                 bubbleContent = `
                    <div class="bg-telusafe-600 p-1 rounded-full text-white shrink-0 shadow-sm">
                        <i class="fas fa-headset text-xs"></i>
                    </div>
                    <div class="bg-red-100 border border-red-300 text-red-700 rounded-2xl p-2 max-w-[200px] shadow">
                        <p>${sanitizedMessage.replace(/\n/g, '<br>')}</p>
                    </div>
                `;
            }

            messageDiv.innerHTML = bubbleContent;
            chatContainer.appendChild(messageDiv);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }


        function updateDate() {
            const dateElement = document.getElementById('currentDate');
            if (dateElement) {
                const options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
                const today = new Date();
                dateElement.textContent = today.toLocaleDateString('id-ID', options);
            }
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

        // Hapus duplikasi onAuthStateChanged untuk nama pengguna
        // firebase.auth().onAuthStateChanged(function(user) { ... }); // Ini sudah ada di awal DOMContentLoaded

    </script>
</body>     
</html>