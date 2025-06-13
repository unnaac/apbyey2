<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>TeluSafe - Riwayat Catatan Harian</title>
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
                        fadeIn: { '0%': { opacity: '0', transform: 'translateY(10px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
                        slideUp: { '0%': { opacity: '0', transform: 'translateY(30px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
                        slideDown: { '0%': { transform: 'translateY(-30px)', opacity: '0' }, '100%': { transform: 'translateY(0)', opacity: '1' } },
                        slideLeft: { '0%': { transform: 'translateX(30px)', opacity: '0' }, '100%': { transform: 'translateX(0)', opacity: '1' } },
                        slideRight: { '0%': { opacity: '0', transform: 'translateX(-30px)' }, '100%': { opacity: '1', transform: 'translateX(0)' } },
                        scaleIn: { '0%': { transform: 'scale(0.9)', opacity: '0' }, '100%': { transform: 'scale(1)', opacity: '1' } },
                        bounceGentle: { '0%, 100%': { transform: 'translateY(0)' }, '50%': { transform: 'translateY(-5px)' } },
                        pulseSoft: { '0%, 100%': { transform: 'scale(1)' }, '50%': { transform: 'scale(1.05)' } },
                        float: { '0%, 100%': { transform: 'translateY(0px)' }, '50%': { transform: 'translateY(-10px)' } },
                        notificationPulse: { '0%, 100%': { transform: 'scale(1)', opacity: '1' }, '50%': { transform: 'scale(1.2)', opacity: '0.8' } }
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
        .sidebar-active { background: linear-gradient(135deg, rgba(255, 255, 255, 0.25) 0%, rgba(255, 255, 255, 0.15) 100%); border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); }
        .card-hover { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .card-hover:hover { transform: translateY(-8px) scale(1.02); box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15); }
        .glass-effect { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.2); }
        .nav-item { transition: all 0.3s ease; position: relative; }
        .nav-item:hover { transform: translateX(5px); background: rgba(255, 255, 255, 0.1); border-radius: 8px; }
        .floating-animation { animation: float 3s ease-in-out infinite; }
        .gradient-text { background: linear-gradient(135deg, #A63333, #C43B3B, #F44343); background-size: 200% 200%; -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .journal-card { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.5); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
        .journal-card:hover { transform: translateY(-4px); box-shadow: 0 20px 40px -12px rgba(196, 59, 59, 0.15); border-color: rgba(196, 59, 59, 0.2); }
        .detail-button { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .detail-button:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(196, 59, 59, 0.25); }
        .stagger-animation > .journal-card { opacity: 0; animation: fadeIn 0.6s ease-out forwards; } /* Hanya target .journal-card untuk stagger */
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        @keyframes ripple { to { transform: scale(4); opacity: 0; } }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 to-slate-200 min-h-screen text-gray-900 font-inter">
    <div class="flex max-w-[1440px] mx-auto rounded-3xl shadow-[0_0_40px_rgba(0,0,0,0.12)] overflow-hidden border border-gray-200 bg-white animate-scale-in">
        <aside class="bg-gradient-to-b from-telusafe-red to-telusafe-dark-red w-56 flex flex-col p-6 space-y-8 text-white select-none animate-slide-right">
            <div class="flex items-center space-x-3 group">
                <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center group-hover:rotate-12 transition-transform duration-300">
                <img src="{{ asset('assets/webStudent/Logo.png') }}" alt="TeluSafe Logo" class="w-8 h-8 object-contain group-hover:rotate-12 transition-transform duration-300"/>
                </div>
                <span class="font-semibold text-lg leading-none select-text">TeluSafe</span>
            </div>
            <nav class="flex flex-col space-y-6 text-sm font-semibold">
                <a class="flex items-center space-x-3 text-white font-semibold nav-item rounded-lg p-2 transition-all duration-300 hover:bg-white hover:bg-opacity-20" href="#" onclick="navigateTo('home')"><i class="fas fa-th-large text-white text-lg"></i><span>Beranda</span></a>
                <div class="space-y-2">
                    <div class="flex items-center space-x-2 font-semibold text-white nav-item rounded-lg p-2 transition-all duration-300 hover:bg-white hover:bg-opacity-20"><i class="fas fa-cogs text-white text-base"></i><span>PPKS</span></div>
                    <div class="flex flex-col pl-7 space-y-1 text-sm font-normal">
                        <a class="flex items-center space-x-2 hover:underline nav-item p-1 rounded" href="#" onclick="createReport()"><div class="w-5 h-5 bg-white rounded flex items-center justify-center"><i class="fas fa-plus text-telusafe-red text-xs"></i></div><span>Buat Laporan</span></a>
                        <a class="flex items-center space-x-2 hover:underline nav-item p-1 rounded" href="#" onclick="viewHistory()"><div class="w-5 h-5 bg-white rounded flex items-center justify-center"><i class="fas fa-history text-telusafe-red text-xs"></i></div><span>Riwayat Laporan</span></a>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center space-x-2 font-semibold text-white nav-item rounded-lg p-2 transition-all duration-300 hover:bg-white hover:bg-opacity-20"><i class="fas fa-user-friends text-white text-base"></i><span>BK</span></div>
                    <div class="flex flex-col pl-7 space-y-1 text-sm font-normal">
                        <a class="flex items-center space-x-2 hover:underline nav-item p-1 rounded" href="#" onclick="createSchedule()"><div class="w-5 h-5 bg-white rounded flex items-center justify-center"><i class="fas fa-calendar text-telusafe-red text-xs"></i></div><span>Buat Jadwal</span></a>
                        <a class="flex items-center space-x-2 hover:underline nav-item p-1 rounded" href="#" onclick="viewCounseling()"><div class="w-5 h-5 bg-white rounded flex items-center justify-center"><i class="fas fa-comments text-telusafe-red text-xs"></i></div><span>Riwayat Konseling</span></a>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center space-x-2 font-semibold text-white sidebar-active p-2"><i class="fas fa-smile text-white text-base"></i><span>Emosiku</span></div>
                    <div class="flex flex-col pl-7 space-y-1 text-sm font-normal">
                        <a class="flex items-center space-x-2 hover:underline nav-item p-1 rounded" href="#" onclick="createNote()"><div class="w-5 h-5 bg-white rounded flex items-center justify-center"><i class="fas fa-edit text-telusafe-red text-xs"></i></div><span>Buat Catatan Harian</span></a>
                        <a class="flex items-center space-x-2 hover:underline nav-item p-1 rounded" href="#" onclick="viewNotes()"><div class="w-5 h-5 bg-white rounded flex items-center justify-center"><i class="fas fa-book text-telusafe-red text-xs"></i></div><span>Catatan Harian</span></a>
                    </div>
                </div>
            </nav>
            <button aria-label="Logout" class="mt-auto flex items-center space-x-2 text-white text-sm opacity-70 hover:opacity-100 transition-all duration-300 nav-item p-2 hover:bg-red-700 rounded-lg" onclick="logout()"><i class="fas fa-sign-out-alt"></i><span>Logout</span></button>
        </aside>

        <main class="flex-1 flex flex-col min-h-screen animate-fade-in">
            <header class="glass-effect p-6 border-b border-gray-200/50 animate-slide-down">
                <div class="flex flex-col md:flex-row md:items-center md:justify-end space-y-4 md:space-y-0">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-3 glass-effect rounded-full p-2 card-hover cursor-pointer" onclick="showProfile()">
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
                <section class="animate-slide-up">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-telusafe-red to-telusafe-light-red rounded-xl flex items-center justify-center floating-animation"><i class="fas fa-book text-white text-xl"></i></div>
                        <div>
                            <h1 class="text-[28px] font-bold font-poppins gradient-text">Riwayat Catatan Harian</h1>
                            <p class="text-gray-600">Lihat kembali perjalanan emosi dan perasaan Anda</p>
                        </div>
                    </div>
                </section>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    <div class="lg:col-span-9 space-y-8">
                        <section class="animate-slide-up">
                            <div class="flex justify-center"> 
                                <div class="glass-effect rounded-2xl p-6 shadow-soft card-hover border border-white/50 cursor-pointer w-full sm:w-auto" onclick="createNote()">
                                    <div class="flex items-center space-x-4 mb-4">
                                        <div class="w-12 h-12 bg-telusafe-pink rounded-xl flex items-center justify-center"><i class="fas fa-plus text-telusafe-red text-xl"></i></div>
                                        <h3 class="text-lg font-semibold font-poppins text-gray-800">Buat Catatan Baru</h3>
                                    </div>
                                    <p class="text-gray-600 mb-4">Ceritakan perasaan dan aktivitas hari ini</p>
                                    <div class="text-center">
                                        <button class="bg-telusafe-red hover:bg-telusafe-dark-red text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors"><i class="fas fa-edit mr-2"></i>Mulai Menulis</button>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="animate-slide-up">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-xl font-semibold font-poppins flex items-center"><i class="fas fa-history text-telusafe-red mr-3"></i>Catatan Harian</h2>
                                <div class="text-sm text-gray-600"><span id="entry-count">Memuat catatan...</span></div>
                            </div>
                            

                            <div id="no-entries" class="text-center py-12 hidden">
                                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4"><i class="fas fa-book-open text-gray-400 text-3xl"></i></div>
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Catatan</h3>
                                <p class="text-gray-500 mb-4">Mulai menulis catatan harian pertama Anda!</p>
                                <button onclick="createNote()" class="bg-telusafe-red hover:bg-telusafe-dark-red text-white px-6 py-2 rounded-lg font-medium transition-colors"><i class="fas fa-plus mr-2"></i>Buat Catatan Pertama</button>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 stagger-animation" id="journal-container">
                                </div>

                            <div class="text-center mt-8" id="load-more-section" style="display: none;">
                                <button id="load-more-btn" class="bg-gradient-to-r from-telusafe-red to-telusafe-light-red hover:from-telusafe-dark-red hover:to-telusafe-red text-white py-3 px-8 rounded-lg transition-all duration-300 font-medium hover:scale-105 transform" onclick="loadMoreEntries()"><i class="fas fa-chevron-down mr-2"></i>Muat Lebih Banyak</button>
                            </div>
                        </section>
                    </div>

                    <aside class="lg:col-span-3 space-y-6 animate-slide-left">
                        <div class="glass-effect rounded-2xl p-4 shadow-soft border border-white/50">
                            <h4 class="font-semibold text-sm mb-4 flex items-center"><i class="fas fa-chart-pie text-telusafe-red mr-2"></i>Statistik Emosi</h4>
                            <div class="space-y-3" id="mood-stats"><p class="text-xs text-gray-500 text-center">Memuat statistik...</p></div>
                        </div>
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

    <div id="toast" class="fixed top-4 right-4 bg-white border-l-4 border-telusafe-red rounded-lg shadow-lg p-4 transform translate-x-full transition-transform duration-300 z-[1000]">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-3" id="toast-icon"></i>
            <div><p class="font-semibold text-sm" id="toast-title">Success!</p><p class="text-xs text-gray-600" id="toast-message">Action completed successfully!</p></div>
        </div>
    </div>

    <script>
        let allDiaryEntries = [];
        let displayedEntries = [];
        let currentPage = 1;
        const entriesPerPage = 6;

        const moodMapping = {
            'very-happy': { emoji: '😄', text: 'Sangat Senang', color: 'bg-yellow-100 text-yellow-800', barColor: 'bg-yellow-400' },
            'happy':      { emoji: '😊', text: 'Senang', color: 'bg-green-100 text-green-800', barColor: 'bg-green-400' },
            'satisfied':  { emoji: '😄', text: 'Sangat Senang', color: 'bg-yellow-100 text-yellow-800', barColor: 'bg-yellow-400' },
            'neutral':    { emoji: '😐', text: 'Biasa Saja', color: 'bg-gray-100 text-gray-800', barColor: 'bg-gray-400' },
            'sad':        { emoji: '😞', text: 'Sedih', color: 'bg-blue-100 text-blue-800', barColor: 'bg-blue-400' },
            'angry':      { emoji: '😠', text: 'Marah', color: 'bg-red-100 text-red-800', barColor: 'bg-red-400' }
        };
        const defaultMoodDisplay = { emoji: '❓', text: 'Tidak Ada', color: 'bg-gray-200 text-gray-700', barColor: 'bg-gray-300' };

        document.addEventListener('DOMContentLoaded', function() {
            console.log("DOM Content Loaded. Initializing...");
            try {
                initializeToastSystem();
                
                const auth = firebase.auth(); // Pastikan firebase sudah terinisialisasi dari configurasi-firebase.js
                const database = firebase.database();

                auth.onAuthStateChanged(function(user) {
                    const profileUsernameElement = document.getElementById('profileUsername');
                    const profileStatusElement = document.getElementById('profileStatus');

                    if (user) {
                        console.log("User logged in:", user.uid);
                        database.ref('users/' + user.uid).once('value')
                            .then(snapshot => {
                                if (snapshot.exists()) {
                                    const userData = snapshot.val();
                                    if (profileUsernameElement) profileUsernameElement.textContent = userData.username || 'User';
                                    if (profileStatusElement) profileStatusElement.textContent = (userData.status || 'Mahasiswa').replace(/^\w/, c => c.toUpperCase());
                                } else {
                                     if (profileUsernameElement) profileUsernameElement.textContent = 'User Data Not Found';
                                }
                            }).catch(error => {
                                console.error("Error fetching profile:", error);
                                if (profileUsernameElement) profileUsernameElement.textContent = 'Error Profile';
                            });

                        fetchJournalEntries(user.uid, database);
                    } else {
                        console.log('User not logged in. Redirecting or showing message.');
                        if (profileUsernameElement) profileUsernameElement.textContent = 'Guest';
                        if (profileStatusElement) profileStatusElement.textContent = '-';
                        
                        const journalContainer = document.getElementById('journal-container');
                        const loadingIndicator = document.getElementById('loading-indicator');
                        const noEntriesMsg = document.getElementById('no-entries');
                        const entryCountEl = document.getElementById('entry-count');

                        if(journalContainer) journalContainer.innerHTML = '<p class="text-center col-span-full">Silakan login untuk melihat catatan Anda.</p>';
                        if(loadingIndicator) loadingIndicator.style.display = 'none';
                        if(noEntriesMsg) noEntriesMsg.classList.remove('hidden');
                        if(entryCountEl) entryCountEl.textContent = 'Login diperlukan';
                        // Kosongkan statistik dan kalender juga jika tidak login
                        const statsContainer = document.getElementById('mood-stats');
                        const calendarContainer = document.getElementById('mood-calendar');
                        if(statsContainer) statsContainer.innerHTML = '<p class="text-xs text-gray-500 text-center">Login untuk melihat statistik.</p>';
                        if(calendarContainer) calendarContainer.innerHTML = '<p class="col-span-7 text-xs text-gray-500 text-center">Login untuk melihat kalender.</p>';
                    }
                });
            } catch (e) {
                console.error("Error during DOMContentLoaded initialization:", e);
                // Tampilkan pesan error di UI jika perlu
                const body = document.querySelector('body');
                if (body) {
                    body.innerHTML = `<div class="flex items-center justify-center min-h-screen bg-red-100"><p class="text-red-700 font-bold text-xl">Terjadi kesalahan saat memuat halaman. Coba refresh. Error: ${e.message}</p></div>`;
                }
            }
        });

        function fetchJournalEntries(userId, database) {
            console.log("Fetching journal entries for user:", userId);
            const loadingIndicator = document.getElementById('loading-indicator');
            const noEntriesMsg = document.getElementById('no-entries');
            const journalContainer = document.getElementById('journal-container');
            const entryCountEl = document.getElementById('entry-count');

            if(loadingIndicator) loadingIndicator.style.display = 'flex';
            if(noEntriesMsg) noEntriesMsg.classList.add('hidden');
            if(journalContainer) journalContainer.innerHTML = ''; // Clear previous entries

            const notesRef = database.ref(`emosiku/${userId}`).orderByChild('timestamp');

            notesRef.on('value', snapshot => {
                console.log("Data received from Firebase:", snapshot.exists());
                allDiaryEntries = [];
                if (snapshot.exists()) {
                    snapshot.forEach(childSnapshot => {
                        allDiaryEntries.push({
                            id: childSnapshot.key, 
                            ...childSnapshot.val()
                        });
                    });
                    allDiaryEntries.reverse(); 
                    
                    displayedEntries = [...allDiaryEntries];
                    currentPage = 1; 
                    renderEntries(); // Panggil setelah data siap
                    updateStats();    // Panggil setelah data siap
                    updateMoodCalendar(); // Panggil setelah data siap
                    if(noEntriesMsg) noEntriesMsg.classList.add('hidden');
                } else {
                    console.log("No entries found for user.");
                    if(noEntriesMsg) noEntriesMsg.classList.remove('hidden');
                    if(entryCountEl) entryCountEl.textContent = 'Tidak ada catatan ditemukan';
                    const statsContainer = document.getElementById('mood-stats');
                    const calendarContainer = document.getElementById('mood-calendar');
                    if(statsContainer) statsContainer.innerHTML = '<p class="text-xs text-gray-500 text-center">Belum ada data emosi.</p>';
                    if(calendarContainer) calendarContainer.innerHTML = '<p class="col-span-7 text-xs text-gray-500 text-center">Belum ada data mood.</p>';
                    if(journalContainer) journalContainer.innerHTML = ''; // Pastikan kosong
                }
                if(loadingIndicator) loadingIndicator.style.display = 'none';
            }, errorObject => { // Penanganan error yang lebih baik untuk listener Firebase
                console.error("Firebase data fetch error: ", errorObject);
                if(loadingIndicator) loadingIndicator.style.display = 'none';
                if(journalContainer) journalContainer.innerHTML = `<p class="text-center col-span-full text-red-500">Gagal memuat catatan. Error: ${errorObject.message || 'Unknown error'}</p>`;
                if(entryCountEl) entryCountEl.textContent = 'Gagal memuat';
            });
        }

        function renderEntries() {
            const container = document.getElementById('journal-container');
            const noEntriesMsg = document.getElementById('no-entries');
            const loadMoreSection = document.getElementById('load-more-section');
            const entryCountEl = document.getElementById('entry-count');
            
            if (!container || !entryCountEl) { // Pastikan elemen ada
                console.error("Required DOM elements for rendering not found.");
                return;
            }
            container.innerHTML = ''; 

            if (displayedEntries.length === 0) {
                if (allDiaryEntries.length > 0) { // Ada data tapi filter tidak menghasilkan apa-apa
                     container.innerHTML = '<p class="text-center col-span-full text-gray-600">Tidak ada catatan yang cocok.</p>';
                } else { // Tidak ada data sama sekali
                    if(noEntriesMsg) noEntriesMsg.classList.remove('hidden');
                }
                if(loadMoreSection) loadMoreSection.style.display = 'none';
                entryCountEl.textContent = displayedEntries.length > 0 ? `${displayedEntries.length} catatan ditemukan` : (allDiaryEntries.length === 0 ? 'Belum ada catatan' : '0 catatan ditemukan');
                return;
            }
            
            if(noEntriesMsg) noEntriesMsg.classList.add('hidden');
            
            const entriesToShow = displayedEntries.slice(0, currentPage * entriesPerPage);
            
            entriesToShow.forEach((entry, index) => {
                const entryCard = createEntryCard(entry, index);
                if (entryCard) { // Pastikan card berhasil dibuat
                    // Tambahkan animasi stagger di sini jika mau, atau biarkan CSS yang handle
                    entryCard.style.animationDelay = `${index * 0.05}s`;
                    container.appendChild(entryCard);
                }
            });
            
            entryCountEl.textContent = `${displayedEntries.length} catatan ditemukan`;
            
            if (loadMoreSection) {
                if (entriesToShow.length < displayedEntries.length) {
                    loadMoreSection.style.display = 'block';
                } else {
                    loadMoreSection.style.display = 'none';
                }
            }
        }

        function createEntryCard(entry, index) {
            if (!entry) return null; // Safety check
            const card = document.createElement('div');
            card.className = 'journal-card rounded-2xl p-6 shadow-soft'; // Akan dianimasikan oleh CSS jika parentnya .stagger-animation
            
            const moodDisplay = moodMapping[entry.mood] || defaultMoodDisplay;
            const formattedDate = formatDate(entry.tanggal, entry.waktu); 
            const shortContent = entry.catatan && entry.catatan.length > 100 ? entry.catatan.substring(0, 100) + '...' : (entry.catatan || '');
            
            card.innerHTML = `
                <div class="flex items-start space-x-4">
                    <div class="text-4xl">${moodDisplay.emoji}</div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-sm font-semibold text-gray-800">${formattedDate}</p>
                            <span class="px-2 py-1 ${moodDisplay.color} rounded-full text-xs font-medium">${moodDisplay.text}</span>
                        </div>
                        <h3 class="text-base font-semibold text-gray-800 mb-2">${entry.judul || 'Tanpa Judul'}</h3>
                        <p class="text-sm text-gray-700 mb-4 min-h-[40px]">${shortContent || '<i>Tidak ada konten.</i>'}</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2 text-xs text-gray-500">
                                <i class="fas fa-tag"></i>
                                <span>${entry.faktor || 'Tidak ada tag'}</span>
                            </div>
                            <button class="detail-button bg-telusafe-pink hover:bg-telusafe-red hover:text-white text-telusafe-red border border-telusafe-red px-4 py-2 rounded-lg text-xs font-medium transition-all" onclick="showJournalDetail('${entry.id}')">
                                <i class="fas fa-eye mr-1"></i>
                                Lihat Detail
                            </button>
                        </div>
                    </div>
                </div>
            `;
            return card;
        }

        function formatDate(dateString, timeString = '') {
            if (!dateString) return "Tanggal tidak diketahui";
            const dateParts = dateString.split('-');
            if (dateParts.length !== 3) return "Format tanggal salah"; // Basic validation
            const dateObj = new Date(parseInt(dateParts[0]), parseInt(dateParts[1]) - 1, parseInt(dateParts[2]));
            
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            let formatted = dateObj.toLocaleDateString('id-ID', options);
            if (timeString) formatted += `, ${timeString}`;
            return formatted;
        }

        function showJournalDetail(entryId) {
            const entry = allDiaryEntries.find(e => e.id === entryId);
            if (!entry) { showToast('Error', 'Data catatan tidak ditemukan.', 'error'); return; }
            
            const moodDisplay = moodMapping[entry.mood] || defaultMoodDisplay;
            const fullDate = formatDate(entry.tanggal, entry.waktu);
            createDetailModal(fullDate, entry.judul || "Tanpa Judul", entry.catatan || "Tidak ada konten.", `${moodDisplay.emoji} ${moodDisplay.text}`, entry.faktor || "Tidak ada tag", entry.id);
        }

        function createDetailModal(date, title, content, moodText, tags, entryId) {
            const existingModal = document.getElementById('detail-modal');
            if (existingModal) existingModal.remove();
            const modal = document.createElement('div');
            modal.id = 'detail-modal';
            modal.className = 'fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-[1001] p-4 animate-fade-in'; // z-index lebih tinggi dari toast
            modal.innerHTML = `
                <div class="glass-effect rounded-2xl p-6 md:p-8 max-w-xl w-full max-h-[90vh] overflow-y-auto shadow-strong border border-white/50">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-3"><div class="w-12 h-12 bg-telusafe-pink rounded-lg flex items-center justify-center"><i class="fas fa-calendar-day text-telusafe-red text-xl"></i></div><div><h2 class="text-xl font-bold font-poppins text-gray-800">Detail Catatan</h2><p class="text-sm text-gray-500">${date}</p></div></div>
                        <button onclick="closeDetailModal()" class="p-2 hover:bg-gray-200 rounded-full transition-colors"><i class="fas fa-times text-gray-600"></i></button>
                    </div>
                    <div class="space-y-5">
                        <div class="glass-effect rounded-xl p-4 border border-white/30"><h3 class="text-md font-semibold text-gray-700 mb-1 flex items-center"><i class="fas fa-heading text-telusafe-red mr-2"></i>Judul</h3><p class="text-gray-800">${title}</p></div>
                        <div class="glass-effect rounded-xl p-4 border border-white/30"><h3 class="text-md font-semibold text-gray-700 mb-1 flex items-center"><i class="fas fa-smile text-telusafe-red mr-2"></i>Mood</h3><p class="text-gray-800">${moodText}</p></div>
                        <div class="glass-effect rounded-xl p-4 border border-white/30"><h3 class="text-md font-semibold text-gray-700 mb-1 flex items-center"><i class="fas fa-pen-alt text-telusafe-red mr-2"></i>Isi Catatan</h3><p class="text-gray-800 leading-relaxed whitespace-pre-line">${content}</p></div>
                        <div class="glass-effect rounded-xl p-4 border border-white/30"><h3 class="text-md font-semibold text-gray-700 mb-1 flex items-center"><i class="fas fa-tags text-telusafe-red mr-2"></i>Faktor/Tag</h3><p class="text-gray-800">${tags}</p></div>
                    </div>
                    <div class="flex justify-end space-x-3 mt-6 pt-4 border-t border-gray-200/50">
                        <button onclick="closeDetailModal()" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition-colors text-sm font-medium">Tutup</button>
                    </div>
                </div>`;
            document.body.appendChild(modal);
            modal.addEventListener('click', function(e) { if (e.target === modal) closeDetailModal(); });
        }
        function closeDetailModal() { const modal = document.getElementById('detail-modal'); if (modal) modal.remove(); }
        function loadMoreEntries() { currentPage++; renderEntries(); showToast('Loaded', 'Lebih banyak catatan dimuat!', 'success'); }

        function updateStats() {
            const statsContainer = document.getElementById('mood-stats');
            if (!allDiaryEntries || allDiaryEntries.length === 0) {
                if(statsContainer) statsContainer.innerHTML = '<p class="text-xs text-gray-500 text-center">Belum ada data emosi untuk statistik.</p>';
                return;
            }
            const moodCounts = {}; const total = allDiaryEntries.length;
            allDiaryEntries.forEach(entry => { moodCounts[entry.mood] = (moodCounts[entry.mood] || 0) + 1; });
            if(statsContainer) statsContainer.innerHTML = ''; 
            let statsGenerated = false;
            Object.keys(moodMapping).forEach(moodKey => {
                const moodInfo = moodMapping[moodKey]; const count = moodCounts[moodKey] || 0;
                if (count > 0) { 
                    statsGenerated = true;
                    const percentage = total > 0 ? Math.round((count / total) * 100) : 0;
                    const statItem = document.createElement('div');
                    statItem.innerHTML = `<div class="flex items-center justify-between mb-1"><div class="flex items-center space-x-2"><span class="text-lg">${moodInfo.emoji}</span><span class="text-xs">${moodInfo.text}</span></div><span class="text-xs font-medium text-telusafe-red">${percentage}%</span></div><div class="w-full bg-gray-200 rounded-full h-1.5"><div class="${moodInfo.barColor} h-1.5 rounded-full" style="width: ${percentage}%"></div></div>`;
                    if(statsContainer) statsContainer.appendChild(statItem);
                }
            });
            if (statsContainer && !statsGenerated) statsContainer.innerHTML = '<p class="text-xs text-gray-500 text-center">Data emosi belum cukup untuk statistik.</p>';
        }

        function updateMoodCalendar() {
            const calendarContainer = document.getElementById('mood-calendar');
            if (!calendarContainer) return;
            calendarContainer.innerHTML = ''; 
            if (!allDiaryEntries || allDiaryEntries.length === 0) {
                 calendarContainer.innerHTML = '<p class="col-span-7 text-xs text-gray-500 text-center">Belum ada data mood untuk kalender.</p>';
                return;
            }
            const today = new Date();
            for (let i = 6; i >= 0; i--) { 
                const date = new Date(today); date.setDate(today.getDate() - i);
                const dateString = date.toISOString().split('T')[0]; 
                const entriesForDate = allDiaryEntries.filter(e => e.tanggal === dateString);
                let moodForDay = defaultMoodDisplay; let entryForDay = null;
                if (entriesForDate.length > 0) {
                    entryForDay = entriesForDate.sort((a,b) => (b.timestamp || 0) - (a.timestamp || 0) )[0]; 
                    moodForDay = moodMapping[entryForDay.mood] || defaultMoodDisplay;
                }
                const dayDiv = document.createElement('div');
                dayDiv.className = 'p-1 text-lg hover:scale-125 transition-transform cursor-pointer flex items-center justify-center aspect-square rounded-full';
                dayDiv.textContent = moodForDay.emoji;
                dayDiv.title = entryForDay ? `${formatDate(dateString)}: ${moodForDay.text} - ${entryForDay.judul || 'Tanpa judul'}` : formatDate(dateString);
                if (entryForDay) {
                    const baseColorClass = moodForDay.color.split(' ')[0];
                    if (baseColorClass && baseColorClass.startsWith('bg-')) { dayDiv.classList.add(baseColorClass.replace('bg-', 'border-2 border-')); }
                     dayDiv.onclick = () => showJournalDetail(entryForDay.id);
                } else { dayDiv.classList.add('text-gray-300'); }
                calendarContainer.appendChild(dayDiv);
            }
        }
        
        function initializeToastSystem() {
            window.showToast = function(title, message, type = 'success') {
                const toast = document.getElementById('toast');
                if (!toast) { console.error("Toast element not found"); return; } // Tambah check
                const toastTitle = document.getElementById('toast-title');
                const toastMessage = document.getElementById('toast-message');
                const toastIcon = document.getElementById('toast-icon');
                
                toastIcon.className = 'fas mr-3';
                toast.className = 'fixed top-4 right-4 bg-white rounded-lg shadow-lg p-4 transform transition-transform duration-300 z-[1000]'; // z-index tinggi
                
                switch(type) {
                    case 'success': toastIcon.className += ' fa-check-circle text-green-500'; toast.className += ' border-l-4 border-green-500'; break;
                    case 'warning': toastIcon.className += ' fa-exclamation-triangle text-yellow-500'; toast.className += ' border-l-4 border-yellow-500'; break;
                    case 'info': toastIcon.className += ' fa-info-circle text-blue-500'; toast.className += ' border-l-4 border-blue-500'; break;
                    case 'error': toastIcon.className += ' fa-times-circle text-red-500'; toast.className += ' border-l-4 border-red-500'; break;
                }
                
                if (toastTitle) toastTitle.textContent = title;
                if (toastMessage) toastMessage.textContent = message;
                toast.style.transform = 'translateX(0)';
                setTimeout(() => { toast.style.transform = 'translateX(100%)'; }, 4000);
            };
        }

        // Navigasi (pastikan route Laravel Anda sudah benar)
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
            setTimeout(function() {
            window.open('https://studentaffairs.telkomuniversity.ac.id/layanan-konseling-telkom-university/', '_self'); 
            }, 500);    
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
    </script>
</body>
</html>