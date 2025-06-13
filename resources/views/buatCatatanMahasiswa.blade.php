<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>TeluSafe - Buat Catatan Emosi</title>
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
                        'emoji-pop': 'emojiPop 0.6s ease-out',
                        'heart-beat': 'heartBeat 1.5s ease-in-out infinite',
                        'typing': 'typing 3.5s steps(40, end), blink-caret 0.75s step-end infinite',
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
                        emojiPop: {
                            '0%': { transform: 'scale(1)' },
                            '50%': { transform: 'scale(1.4) rotate(10deg)' },
                            '100%': { transform: 'scale(1.2) rotate(0deg)' }
                        },
                        heartBeat: {
                            '0%, 100%': { transform: 'scale(1)' },
                            '50%': { transform: 'scale(1.1)' }
                        },
                        typing: {
                            'from': { width: '0' },
                            'to': { width: '100%' }
                        },
                        'blink-caret': {
                            'from, to': { 'border-color': 'transparent' },
                            '50%': { 'border-color': '#C43B3B' }
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
        
        .hover-lift {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .hover-lift:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.15);
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
        
        .emoji-hover {
            filter: grayscale(100%) brightness(0.8);
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform: scale(1);
            position: relative;
            border-radius: 50%;
            padding: 8px;
            user-select: none;
            z-index: 10; /* Pastikan z-index lebih tinggi dari emotion-card::after */
            display: inline-block; /* Untuk memastikan padding dan border-radius bekerja baik */
        }
        
        .emoji-hover.selected, .emoji-hover:hover {
            filter: none;
            transform: scale(1.3) rotate(5deg);
            text-shadow: 0 0 20px rgba(196, 59, 59, 0.5);
            box-shadow: 0 0 20px rgba(196, 59, 59, 0.3); /* Box shadow untuk efek glow */
        }
        
        .emoji-hover:active {
            transform: scale(1.4) rotate(-5deg);
        }
        
        .emoji-hover.selected {
            animation: emojiPop 0.6s ease-out;
            background: rgba(196, 59, 59, 0.1); /* Warna latar saat terpilih */
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #A63333, #C43B3B, #F44343);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradientShift 3s ease-in-out infinite;
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
        
        .form-stagger > div {
            opacity: 1; /* Ubah opacity awal jadi 1 jika animasi formSlide sudah cukup */
            animation: formSlide 0.6s ease-out;
        }
        
        .form-stagger > div:nth-child(1) { animation-delay: 0.1s; }
        .form-stagger > div:nth-child(2) { animation-delay: 0.2s; }
        .form-stagger > div:nth-child(3) { animation-delay: 0.3s; }
        .form-stagger > div:nth-child(4) { animation-delay: 0.4s; }
        .form-stagger > div:nth-child(5) { animation-delay: 0.5s; }
        
        .emotion-card {
            position: relative;
            overflow: hidden;
        }
        
        .emotion-card::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(196, 59, 59, 0.1) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
            z-index: 1; /* Di bawah emoji */
        }
        
        .emotion-card:hover::after {
            opacity: 1;
        }
        
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
        
        .heart-icon {
            animation: heartBeat 1.5s ease-in-out infinite;
        }
        
        .notification-pulse {
            animation: notificationPulse 2s infinite;
        }
        
        .celebration-particle {
            position: fixed;
            pointer-events: none;
            z-index: 1000; /* Pastikan partikel di atas segalanya */
        }
        
        .typing-indicator {
            animation: typing 3.5s steps(40, end) infinite; /* Tambahkan infinite */
            border-right: 2px solid #C43B3B; /* Sesuaikan warna caret */
            white-space: nowrap;
            overflow: hidden;
        }
        
        .floating-animation {
            animation: float 3s ease-in-out infinite;
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
                    <div class="flex items-center space-x-2 font-semibold text-white nav-item rounded-lg p-2 transition-all duration-300 hover:bg-white hover:bg-opacity-20">
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
                            <i class="fas fa-feather-alt text-white text-xl"></i>
                        </div>
                        <div>
                            <h1 class="text-[28px] font-bold font-poppins gradient-text typing-indicator">Buat Catatan Emosi</h1>
                            <p class="text-gray-600">Ekspresikan perasaan dan pikiran Anda dalam catatan harian</p>
                        </div>
                    </div>
                </section>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <div class="lg:col-span-9 space-y-6">
                        <section class="animate-slide-up">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 stagger-animation">
                                <div class="glass-effect rounded-2xl p-6 shadow-soft card-hover border border-white/50 flex flex-col space-y-3 relative select-none emotion-card">
                                    <p class="text-[20px] font-semibold font-poppins text-center mb-6 pt-8 flex items-center justify-center">
                                        <i class="fas fa-heart text-telusafe-red mr-2 animate-pulse-soft heart-icon"></i>
                                        Emosiku
                                    </p>
                                    <div class="flex justify-center space-x-4 text-4xl relative z-20" id="emoji-container">
                                        <span aria-label="Angry face emoji" class="emoji-hover" role="button" tabindex="0" data-emo="angry" title="Marah" style="position: relative; z-index: 30;">😠</span>
                                        <span aria-label="Sad face emoji" class="emoji-hover" role="button" tabindex="0" data-emo="sad" title="Sedih" style="position: relative; z-index: 30;">😞</span>
                                        <span aria-label="Neutral face emoji" class="emoji-hover" role="button" tabindex="0" data-emo="neutral" title="Biasa saja" style="position: relative; z-index: 30;">😐</span>
                                        <span aria-label="Happy face emoji" class="emoji-hover" role="button" tabindex="0" data-emo="happy" title="Senang" style="position: relative; z-index: 30;">🙂</span>
                                        <span aria-label="Very happy face emoji" class="emoji-hover" role="button" tabindex="0" data-emo="very-happy" title="Sangat senang" style="position: relative; z-index: 30;">😄</span>
                                    </div>
                                    <div class="text-center mt-4">
                                        <p class="text-sm text-gray-500" id="mood-feedback">Bagaimana perasaanmu hari ini?</p>
                                    </div>
                                </div>
                                
                                <div class="glass-effect rounded-2xl p-6 shadow-soft card-hover border border-white/50 emotion-card">
                                    <div class="text-center">
                                        <div class="w-16 h-16 bg-gradient-to-br from-telusafe-pink to-red-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                            <i class="fas fa-chart-line text-telusafe-red text-2xl animate-bounce-gentle"></i>
                                        </div>
                                        <h3 class="text-[20px] font-semibold font-poppins mb-4 gradient-text">Lacak Emosimu</h3>
                                        <p class="text-sm text-gray-600 mb-4">Pilih emoji di samping untuk mulai mencatat perasaanmu hari ini</p>
                                        <div class="space-y-2" id="emotion-stats">
                                            <div class="flex justify-between items-center text-xs">
                                                <span class="text-gray-500">Mood hari ini:</span>
                                                <span class="font-medium text-telusafe-red" id="current-mood">Belum dipilih</span>
                                            </div>
                                            <div class="flex justify-between items-center text-xs">
                                                <span class="text-gray-500">Terakhir dicatat:</span>
                                                <span class="font-medium text-gray-600" id="last-recorded">Kemarin</span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="animate-slide-up">
                            <div class="glass-effect rounded-4xl p-8 shadow-strong border border-white/50">
                                <h2 class="text-[24px] font-semibold font-poppins mb-6 flex items-center">
                                    <i class="fas fa-edit text-telusafe-red mr-3 animate-wiggle"></i>
                                    Tulis Catatan Emosimu
                                </h2>
                                
                                <div class="form-stagger space-y-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                            <i class="fas fa-heading text-telusafe-red mr-2"></i>
                                            Judul Catatan
                                        </label>
                                        <input 
                                            type="text" 
                                            id="note-title" 
                                            class="w-full px-4 py-3 border border-gray-200 rounded-2xl focus:border-telusafe-red focus:ring-4 focus:ring-telusafe-red/10 transition-all duration-300 outline-none bg-white text-gray-700 form-element"
                                            placeholder="Beri judul untuk catatan harimu..."
                                        />
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                                <i class="fas fa-calendar text-telusafe-red mr-2"></i>
                                                Tanggal
                                            </label>
                                            <input 
                                                type="date" 
                                                id="note-date" 
                                                class="w-full px-4 py-3 border border-gray-200 rounded-2xl focus:border-telusafe-red focus:ring-4 focus:ring-telusafe-red/10 transition-all duration-300 outline-none bg-white text-gray-700 form-element"
                                            />
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                                <i class="fas fa-clock text-telusafe-red mr-2"></i>
                                                Waktu
                                            </label>
                                            <input 
                                                type="time" 
                                                id="note-time" 
                                                class="w-full px-4 py-3 border border-gray-200 rounded-2xl focus:border-telusafe-red focus:ring-4 focus:ring-telusafe-red/10 transition-all duration-300 outline-none bg-white text-gray-700 form-element"
                                            />
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                            <i class="fas fa-pen-fancy text-telusafe-red mr-2"></i>
                                            Ceritakan perasaanmu
                                        </label>
                                        <textarea 
                                            id="note-content" 
                                            rows="8" 
                                            class="w-full px-4 py-3 border border-gray-200 rounded-2xl focus:border-telusafe-red focus:ring-4 focus:ring-telusafe-red/10 transition-all duration-300 outline-none bg-white text-gray-700 form-element resize-none"
                                            placeholder="Tuliskan semua yang kamu rasakan hari ini... 

Contoh:
- Apa yang membuatmu senang hari ini?
- Apakah ada hal yang membuatmu khawatir?
- Bagaimana perasaanmu secara keseluruhan?
- Apa yang ingin kamu lakukan besok?"
                                        ></textarea>
                                        <div class="mt-2 flex items-center justify-between text-xs text-gray-500">
                                            <span>Ekspresikan dirimu dengan bebas dan jujur</span>
                                            <span id="char-count">0 karakter</span>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                            <i class="fas fa-tags text-telusafe-red mr-2"></i>
                                            Tag Perasaan (Opsional)
                                        </label>
                                        <div class="flex flex-wrap gap-2 mb-3" id="emotion-tags">
                                            <span class="tag-option px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs cursor-pointer hover:bg-blue-200 transition-colors" data-tag="grateful">Bersyukur</span>
                                            <span class="tag-option px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs cursor-pointer hover:bg-green-200 transition-colors" data-tag="excited">Bersemangat</span>
                                            <span class="tag-option px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs cursor-pointer hover:bg-yellow-200 transition-colors" data-tag="anxious">Cemas</span>
                                            <span class="tag-option px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs cursor-pointer hover:bg-purple-200 transition-colors" data-tag="peaceful">Tenang</span>
                                            <span class="tag-option px-3 py-1 bg-pink-100 text-pink-800 rounded-full text-xs cursor-pointer hover:bg-pink-200 transition-colors" data-tag="loved">Dicintai</span>
                                            <span class="tag-option px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs cursor-pointer hover:bg-red-200 transition-colors" data-tag="frustrated">Frustrasi</span>
                                        </div>
                                        </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                            <i class="fas fa-lock text-telusafe-red mr-2"></i>
                                            Pengaturan Privasi
                                        </label>
                                        <div class="space-y-2">
                                            <label class="flex items-center space-x-3 cursor-pointer">
                                                <input type="radio" name="privacy" value="private" class="text-telusafe-red focus:ring-telusafe-red" checked>
                                                <div class="flex items-center space-x-2">
                                                    <i class="fas fa-user-lock text-gray-600"></i>
                                                    <span class="text-sm">Hanya saya (Pribadi)</span>
                                                </div>
                                            </label>
                                            <label class="flex items-center space-x-3 cursor-pointer">
                                                <input type="radio" name="privacy" value="counselor" class="text-telusafe-red focus:ring-telusafe-red">
                                                <div class="flex items-center space-x-2">
                                                    <i class="fas fa-user-md text-gray-600"></i>
                                                    <span class="text-sm">Dapat dibaca konselor (untuk sesi konseling)</span>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-end space-x-4 mt-8">
                                    <button type="button" id="save-note" class="bg-gradient-to-r from-telusafe-red to-telusafe-light-red hover:from-telusafe-dark-red hover:to-telusafe-red text-white py-3 px-6 rounded-2xl transition-all duration-300 hover:shadow-glow-strong font-medium hover:scale-105 transform" onclick="">
                                        <i class="fas fa-heart mr-2"></i>
                                        Simpan Catatan
                                    </button>
                                </div>
                            </div>
                        </section>
                    </div>

                    <aside class="lg:col-span-3 space-y-6 animate-slide-left">
                        <div>
                            <h3 class="font-bold text-base mb-3 flex items-center">
                                <i class="fas fa-newspaper text-telusafe-red mr-2 animate-bounce-gentle"></i>Berita Telkom University
                            </h3>
                            <div class="glass-effect rounded-2xl shadow-soft card-hover border border-white/50 overflow-hidden cursor-pointer" onclick="readNews()">
                                <div class="h-40 bg-gradient-to-br from-telusafe-red to-telusafe-light-red flex items-center justify-center">
                                    <img src="{{ asset('assets/webStudent/BK.jpg') }}" alt="Alur Konseling BK" class="max-h-full max-w-full object-contain p-2">
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
        // Initialize the application
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM Content Loaded');
            initializeEmotionSelector();
            initializeForm(); // Pastikan ini dipanggil sebelum event listener saveBtn
            initializeToastSystem();
            initializeRippleEffects();
            setDefaultDateTime();
            fetchLastRecordedDate(); // Panggil fungsi untuk mengambil tanggal terakhir
            
            const auth = firebase.auth();
            const database = firebase.database();

            auth.onAuthStateChanged(function(user) {
                const profileUsernameElement = document.getElementById('profileUsername');
                const profileStatusElement = document.getElementById('profileStatus');
                // const profileInitialElement = document.getElementById('profileInitial'); // Untuk inisial, jika ada

                if (user) {
                    console.log('User UID (buatCatatanMahasiswa - Profil):', user.uid);
                    database.ref('users/' + user.uid).once('value')
                        .then(function(snapshot) {
                            if (snapshot.exists()) {
                                const userData = snapshot.val();
                                const usernameUntukProfil = userData.username || 'Username';
                                const status = userData.status || 'Status tidak diketahui';

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
                                
                                // if (profileInitialElement && usernameUntukProfil !== 'Username' && usernameUntukProfil.length > 0) {
                                //     profileInitialElement.textContent = usernameUntukProfil.charAt(0).toUpperCase();
                                // } else if (profileInitialElement) {
                                //     profileInitialElement.textContent = 'U'; 
                                // }

                            } else {
                                console.warn('Data pengguna tidak ditemukan untuk UID:', user.uid);
                                if (profileUsernameElement) profileUsernameElement.textContent = 'User';
                                if (profileStatusElement) profileStatusElement.textContent = 'N/A';
                                // if (profileInitialElement) profileInitialElement.textContent = 'U';
                            }
                        })
                        .catch(function(error) {
                            console.error('Gagal mengambil data profil pengguna:', error);
                            if (profileUsernameElement) profileUsernameElement.textContent = 'Error';
                            if (profileStatusElement) profileStatusElement.textContent = 'Error';
                            // if (profileInitialElement) profileInitialElement.textContent = 'E';
                        });
                } else {
                    console.log('Pengguna belum login.');
                    if (profileUsernameElement) profileUsernameElement.textContent = 'Guest';
                    if (profileStatusElement) profileStatusElement.textContent = '-';
                    // if (profileInitialElement) profileInitialElement.textContent = 'G';
                    // Pertimbangkan untuk mengarahkan ke halaman login
                    // window.location.href = '{{ url('/login') }}';
                }
            });
        });

        function setDefaultDateTime() {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            document.getElementById('note-date').value = `${year}-${month}-${day}`; // Format YYYY-MM-DD
            document.getElementById('note-time').value = now.toTimeString().slice(0, 5);
        }

        function fetchLastRecordedDate() {
            const auth = firebase.auth();
            auth.onAuthStateChanged(user => {
                if (user) {
                    const userId = user.uid;
                    const db = firebase.database();
                    const notesRef = db.ref(`emosiku/${userId}`).orderByChild('timestamp').limitToLast(1);

                    notesRef.once('value', snapshot => {
                        const lastRecordedEl = document.getElementById('last-recorded');
                        if (snapshot.exists()) {
                            snapshot.forEach(childSnapshot => { // Hanya akan ada satu child
                                const lastNote = childSnapshot.val();
                                if (lastNote.tanggal) {
                                    // Ubah format YYYY-MM-DD ke DD-MM-YYYY atau format yang diinginkan
                                    const parts = lastNote.tanggal.split('-');
                                    const formattedDate = `${parts[2]}/${parts[1]}/${parts[0]}`; // DD/MM/YYYY
                                    lastRecordedEl.textContent = formattedDate;
                                } else {
                                    lastRecordedEl.textContent = "Belum ada";
                                }
                            });
                        } else {
                            lastRecordedEl.textContent = "Belum ada catatan";
                        }
                    }).catch(error => {
                        console.error("Error fetching last recorded date:", error);
                        lastRecordedEl.textContent = "Error";
                    });
                }
            });
        }


        function initializeEmotionSelector() {
            const emojis = document.querySelectorAll('.emoji-hover');
            const moodFeedback = document.getElementById('mood-feedback');
            const currentMood = document.getElementById('current-mood');
            
            if (emojis.length === 0) {
                console.error('No emojis found with class .emoji-hover');
                return;
            }
            
            emojis.forEach(emoji => {
                emoji.addEventListener('click', function(event) {
                    event.preventDefault(); 
                    emojis.forEach(e => e.classList.remove('selected'));
                    this.classList.add('selected');
                    createCelebration(this);
                    
                    const moodTitle = this.getAttribute('title');
                    if (moodFeedback) moodFeedback.textContent = `Kamu merasa ${moodTitle.toLowerCase()} hari ini`;
                    if (currentMood) {
                        currentMood.textContent = moodTitle;
                        currentMood.classList.add('text-telusafe-red'); // Pastikan warna tetap
                    }
                    // showToast('Mood Updated!', `Kamu merasa ${moodTitle} hari ini`, 'success'); // Toast ini mungkin terlalu sering
                });
                emoji.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        this.click();
                    }
                });
            });
        }

        function initializeForm() {
            const noteContent = document.getElementById('note-content');
            const charCount = document.getElementById('char-count');
            const tagOptions = document.querySelectorAll('#emotion-tags .tag-option'); // Ambil dari #emotion-tags
            const saveBtn = document.getElementById('save-note');

            noteContent.addEventListener('input', function() {
                const count = this.value.length;
                charCount.textContent = `${count} karakter`;
                charCount.classList.remove('text-red-500', 'text-yellow-500');
                if (count > 1000) charCount.classList.add('text-red-500');
                else if (count > 800) charCount.classList.add('text-yellow-500');
            });

            tagOptions.forEach(tag => {
                tag.addEventListener('click', function() {
                    // Toggle selected state and appearance
                    this.classList.toggle('selected');
                    if (this.classList.contains('selected')) {
                        this.classList.remove('bg-blue-100', 'text-blue-800', 'bg-green-100', 'text-green-800', 'bg-yellow-100', 'text-yellow-800', 'bg-purple-100', 'text-purple-800', 'bg-pink-100', 'text-pink-800', 'bg-red-100', 'text-red-800');
                        this.classList.add('bg-telusafe-red', 'text-white');
                    } else {
                        // Kembalikan ke warna aslinya berdasarkan data-tag atau kelas awal
                        const originalBgColor = this.getAttribute('data-original-bg') || 'bg-gray-100'; // Fallback
                        const originalTextColor = this.getAttribute('data-original-text') || 'text-gray-800'; // Fallback
                        
                        // Contoh sederhana: reset ke warna default atau tentukan berdasarkan data-tag
                        // Ini perlu disesuaikan dengan struktur warna awal Anda
                        const tagType = this.dataset.tag;
                        this.classList.remove('bg-telusafe-red', 'text-white');
                        if (tagType === "grateful") this.classList.add('bg-blue-100', 'text-blue-800');
                        else if (tagType === "excited") this.classList.add('bg-green-100', 'text-green-800');
                        else if (tagType === "anxious") this.classList.add('bg-yellow-100', 'text-yellow-800');
                        else if (tagType === "peaceful") this.classList.add('bg-purple-100', 'text-purple-800');
                        else if (tagType === "loved") this.classList.add('bg-pink-100', 'text-pink-800');
                        else if (tagType === "frustrated") this.classList.add('bg-red-100', 'text-red-800');
                    }
                });
            });
            
            // --- MODIFIKASI BAGIAN INI ---
            saveBtn.addEventListener('click', function() {
                const user = firebase.auth().currentUser;
                if (!user) {
                    showToast('Login Diperlukan', 'Anda harus login untuk menyimpan catatan.', 'error');
                    return;
                }
                const userId = user.uid;

                const title = document.getElementById('note-title').value.trim();
                const content = document.getElementById('note-content').value.trim();
                const dateInput = document.getElementById('note-date').value; // YYYY-MM-DD
                const time = document.getElementById('note-time').value;
                
                const selectedEmotionEl = document.querySelector('.emoji-hover.selected');
                const mood = selectedEmotionEl ? selectedEmotionEl.getAttribute('data-emo') : null;
                // Mapping mood jika diperlukan, e.g., "very-happy" to "satisfied"
                const moodMap = { "angry": "angry", "sad": "sad", "neutral": "neutral", "happy": "happy", "very-happy": "satisfied" }; // Sesuaikan
                const finalMood = moodMap[mood] || mood;


                const selectedTagElements = document.querySelectorAll('#emotion-tags .tag-option.selected');
                const tagsArray = Array.from(selectedTagElements).map(tagEl => tagEl.textContent.trim()); // Ambil text content
                const faktor = tagsArray.join(', ');

                const privacy = document.querySelector('input[name="privacy"]:checked').value;
                const bantuan = (privacy === 'counselor') ? 'ya' : 'tidak'; // Sesuai contoh Firebase

                if (!title) {
                    showToast('Judul Diperlukan', 'Mohon isi judul catatan.', 'warning');
                    document.getElementById('note-title').focus();
                    return;
                }
                if (!content) {
                    showToast('Konten Diperlukan', 'Mohon tulis catatan emosi Anda.', 'warning');
                    document.getElementById('note-content').focus();
                    return;
                }
                if (!finalMood) {
                    showToast('Emosi Belum Dipilih', 'Mohon pilih emosi Anda hari ini.', 'warning');
                    return;
                }
                if (!dateInput || !time) {
                    showToast('Tanggal/Waktu Belum Lengkap', 'Mohon isi tanggal dan waktu catatan.', 'warning');
                    return;
                }

                // Format tanggal ke DD-MM-YYYY untuk timestamp jika diperlukan seperti contoh,
                // atau simpan YYYY-MM-DD dan format saat menampilkan
                const dateParts = dateInput.split('-'); // YYYY, MM, DD
                const formattedDateForTimestamp = `${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`; // DD-MM-YYYY

                const noteData = {
                    judul: title, // Tambahkan judul jika diinginkan
                    catatan: content,
                    mood: finalMood,
                    tanggal: dateInput,
                    waktu: time,
                    faktor: faktor || "Tidak ada", // Jika tidak ada tag
                    privasi: privacy,
                    bantuan: bantuan, // Sesuai contoh
                    timestamp: firebase.database.ServerValue.TIMESTAMP // Timestamp server Firebase
                };

                this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
                this.disabled = true;

                const db = firebase.database();
                const noteDateKey = dateInput.replace(/-/g, ''); // Membuat key dari tanggal, misal 20250602
                const newNoteRef = db.ref(`emosiku/${userId}`).push();


                newNoteRef.set(noteData)
                    .then(() => {
                        showToast('Berhasil!', 'Catatan emosi telah disimpan.', 'success');
                        createSuccessCelebration();
                        resetForm(); // Reset form setelah berhasil
                        fetchLastRecordedDate(); // Update tampilan tanggal terakhir
                    })
                    .finally(() => {
                        this.innerHTML = '<i class="fas fa-heart mr-2"></i>Simpan Catatan';
                        this.disabled = false;
                    });
            });
        }

        function removeTag(tagValue) { /* ... implementasi jika menggunakan selected-tags div ... */ }

        function initializeToastSystem() {
            window.showToast = function(title, message, type = 'success') {
                const toast = document.getElementById('toast');
                const toastTitle = document.getElementById('toast-title');
                const toastMessage = document.getElementById('toast-message');
                const toastIcon = document.getElementById('toast-icon');
                
                
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
                
                toast.style.transform = 'translateX(0)';
                setTimeout(() => {
                    toast.style.transform = 'translateX(100%)';
                }, 4000);
            };
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
                
                const angle = (i * 60) * Math.PI / 180; // Sudut partikel
                const distance = 50 + Math.random() * 20; // Jarak partikel bergerak
                const endX = centerX + Math.cos(angle) * distance;
                const endY = centerY + Math.sin(angle) * distance;
                
                document.body.appendChild(particle);
                
                particle.animate([
                    { transform: `translate(${centerX - centerX}px, ${centerY - centerY}px) scale(1)`, opacity: 1 },
                    { transform: `translate(${endX - centerX}px, ${endY - centerY}px) scale(0)`, opacity: 0 }
                ], {
                    duration: 600 + Math.random() * 200,
                    easing: 'cubic-bezier(0.25, 0.1, 0.25, 1.0)' // Ease out
                }).onfinish = () => {
                    if (document.body.contains(particle)) { // Cek jika partikel masih ada
                        document.body.removeChild(particle);
                    }
                };
            }
            
            // Efek pop pada emoji
            element.style.animation = 'none';
            element.offsetHeight; // Trigger reflow
            element.style.animation = 'emojiPop 0.6s ease-out';
        }

        function createSuccessCelebration() {
            const colors = ['#C43B3B', '#F44343', '#FEEAEA', '#A63333']; // Warna TeluSafe
            const confettiCount = 20; // Jumlah confetti
            
            for (let i = 0; i < confettiCount; i++) {
                setTimeout(() => {
                    const confetti = document.createElement('div');
                    confetti.className = 'fixed pointer-events-none z-50 celebration-particle'; // Tambah class
                    confetti.style.left = Math.random() * window.innerWidth + 'px';
                    confetti.style.top = '-20px'; // Mulai dari atas layar
                    confetti.style.width = (Math.random() * 8 + 4) + 'px'; // Ukuran random
                    confetti.style.height = (Math.random() * 8 + 4) + 'px';
                    confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                    confetti.style.borderRadius = Math.random() > 0.5 ? '50%' : '0'; // Bentuk random (bulat/kotak)
                    confetti.style.opacity = '0.9';
                    
                    document.body.appendChild(confetti);
                    
                    confetti.animate([
                        { transform: `translateY(0) rotate(0deg)`, opacity: 1 },
                        { transform: `translateY(${window.innerHeight + 50}px) rotate(${Math.random() * 720 - 360}deg)`, opacity: 0 }
                    ], {
                        duration: 2000 + Math.random() * 3000, // Durasi random
                        easing: 'cubic-bezier(0.1, 0.5, 0.5, 1)' // Variasi easing
                    }).onfinish = () => {
                        if (document.body.contains(confetti)) {
                             document.body.removeChild(confetti);
                        }
                    };
                }, i * (1000 / confettiCount)); // Sebarkan kemunculan confetti
            }
        }

        function initializeRippleEffects() {
            document.addEventListener('click', function(e) {
                const target = e.target.closest('.card-hover, .emotion-card, button, .emoji-hover, .tag-option');
                if (target) {
                    const ripple = document.createElement('span');
                    const rect = target.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.className = 'absolute rounded-full bg-white/30 pointer-events-none';
                    ripple.style.transform = 'scale(0)';
                    ripple.style.animation = 'ripple 0.6s linear';
                    
                    target.style.position = 'relative'; // Ensure target is positioned
                    target.style.overflow = 'hidden';  // Contain ripple
                    target.appendChild(ripple);
                    
                    setTimeout(() => {
                        if (ripple.parentNode) {
                            ripple.parentNode.removeChild(ripple);
                        }
                    }, 600);
                }
            });
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

        function scheduleConseling() {
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
            showToast('Create Note', 'Already on create note page', 'info');
        }

        function viewNotes() {
            showToast('Notes', 'Loading your notes...', 'info');
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
            setTimeout(function() {
            window.open('https://studentaffairs.telkomuniversity.ac.id/layanan-konseling-telkom-university/', '_self'); 
            }, 500);    
        }

        function logout() {
            if (confirm('Apakah Anda yakin ingin logout?')) {
                firebase.auth().signOut().then(() => {
                    showToast('Logout Berhasil', 'Anda telah logout.', 'success');
                    setTimeout(() => { window.location.href = 'login'; }, 1500); // Arahkan ke halaman login
                }).catch((error) => {
                    showToast('Logout Gagal', error.message, 'error');
                });
            }
        }
    </script>
</body>
</html>