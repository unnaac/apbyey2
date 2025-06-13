<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>TeluSafe - Riwayat Konseling</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
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
                        // Pastikan warna solid untuk badge detail ada di sini atau standar Tailwind
                        // Misalnya: purple-600, yellow-500, green-600, blue-600, gray-400
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
                        'notification-pulse': 'notificationPulse 2s infinite',
                        'float': 'float 3s ease-in-out infinite'
                    },
                    keyframes: {
                        fadeIn: { '0%': { opacity: '0', transform: 'translateY(10px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
                        slideUp: { '0%': { opacity: '0', transform: 'translateY(30px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
                        slideRight: { '0%': { opacity: '0', transform: 'translateX(-30px)' }, '100%': { opacity: '1', transform: 'translateX(0)' } },
                        bounceGentle: { '0%, 100%': { transform: 'translateY(0)' }, '50%': { transform: 'translateY(-5px)' } },
                        pulseSoft: { '0%, 100%': { transform: 'scale(1)' }, '50%': { transform: 'scale(1.05)' } },
                        scaleIn: { '0%': { transform: 'scale(0.9)', opacity: '0' }, '100%': { transform: 'scale(1)', opacity: '1' } },
                        notificationPulse: { '0%, 100%': { transform: 'scale(1)', opacity: '1' }, '50%': { transform: 'scale(1.2)', opacity: '0.8' } },
                        float: { '0%, 100%': { transform: 'translateY(0px)' }, '50%': { transform: 'translateY(-10px)' } }
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); }
        .sidebar-active { background: linear-gradient(135deg, rgba(255, 255, 255, 0.25) 0%, rgba(255, 255, 255, 0.15) 100%); border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); }
        .glass-effect { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.2); }
        .card-hover { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .card-hover:hover { transform: translateY(-8px) scale(1.02); box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15); }
        .nav-item { transition: all 0.3s ease; position: relative; }
        .nav-item:hover { transform: translateX(5px); background: rgba(255, 255, 255, 0.1); border-radius: 8px; }
        .floating-animation { animation: float 3s ease-in-out infinite; }
        .gradient-text { background: linear-gradient(135deg, #A63333, #C43B3B, #F44343); background-size: 200% 200%; -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .table-row-hover { transition: all 0.2s ease-out; }
        .table-row-hover:hover { background-color: rgba(196, 59, 59, 0.05); /* transform: translateY(-2px); box-shadow: 0 4px 10px rgba(0,0,0,0.05); */ }
        .status-badge { transition: all 0.3s ease; }
        .status-badge:hover { transform: scale(1.05); }
        .action-button { transition: all 0.2s ease-out; }
        .action-button:hover { transform: scale(1.15); background-color: rgba(0,0,0,0.08); }
        .spinner { border: 4px solid rgba(0, 0, 0, 0.1); width: 36px; height: 36px; border-radius: 50%; border-left-color: #C43B3B; animation: spin 1s ease infinite; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        .loading-overlay { position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(255, 255, 255, 0.85); display: flex; justify-content: center; align-items: center; z-index: 10; border-radius: 0.75rem; /* rounded-xl */ }
        #latestCounselingCard { transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out; }
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
                            <div class="w-5 h-5 bg-white rounded flex items-center justify-center"><i class="fas fa-plus text-telusafe-red text-xs"></i></div>
                            <span>Buat Laporan</span>
                        </a>
                        <a class="flex items-center space-x-2 hover:underline nav-item p-1 rounded" href="#" onclick="viewHistory()">
                            <div class="w-5 h-5 bg-white rounded flex items-center justify-center"><i class="fas fa-history text-telusafe-red text-xs"></i></div>
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
                            <div class="w-5 h-5 bg-white rounded flex items-center justify-center"><i class="fas fa-calendar text-telusafe-red text-xs"></i></div>
                            <span>Buat Jadwal</span>
                        </a>
                        <a class="flex items-center space-x-2 hover:underline nav-item p-1 rounded" href="#" onclick="viewCounseling()">
                            <div class="w-5 h-5 bg-white rounded flex items-center justify-center"><i class="fas fa-comments text-telusafe-red text-xs"></i></div>
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
                            <div class="w-5 h-5 bg-white rounded flex items-center justify-center"><i class="fas fa-edit text-telusafe-red text-xs"></i></div>
                            <span>Buat Catatan Harian</span>
                        </a>
                        <a class="flex items-center space-x-2 hover:underline nav-item p-1 rounded" href="#" onclick="viewNotes()">
                            <div class="w-5 h-5 bg-white rounded flex items-center justify-center"><i class="fas fa-book text-telusafe-red text-xs"></i></div>
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

        <main class="flex-1 p-6 space-y-6 animate-fade-in">
            <div class="flex flex-col md:flex-row md:items-center md:justify-end space-y-4 md:space-y-0">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-3 glass-effect rounded-full p-2 card-hover cursor-pointer" onclick="showProfile()">
                        <img src="{{ asset('assets/webStudent/iconorang 1.png') }}" alt="User Profile" class="w-10 h-10 rounded-full object-cover"/>
                        <div class="text-right">
                            <p class="text-sm font-semibold leading-none" id="profileUsername">Loading...</p>
                            <p class="text-xs text-neutral-500 leading-none" id="profileStatus">Loading...</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <div class="lg:col-span-9 space-y-6">
                    <section class="animate-slide-up">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-12 h-12 bg-gradient-to-br from-telusafe-red to-telusafe-light-red rounded-xl flex items-center justify-center floating-animation">
                                <i class="fas fa-history text-white text-xl"></i>
                            </div>
                            <h1 class="text-[28px] font-bold font-poppins gradient-text">Riwayat Konseling</h1>
                        </div>
                    </section>

                    <section id="latestCounselingCard" class="glass-effect rounded-xl p-6 md:p-8 shadow-[0_4px_20px_rgba(0,0,0,0.08)] card-hover animate-slide-up" style="display: none;">
                        <div class="flex flex-col sm:flex-row items-start justify-between mb-6">
                            <div class="flex items-center space-x-4 mb-4 sm:mb-0">
                                <div class="w-12 h-12 md:w-16 md:h-16 bg-telusafe-pink rounded-2xl flex items-center justify-center animate-bounce-gentle">
                                    <i class="fas fa-calendar-check text-telusafe-red text-xl md:text-2xl"></i>
                                </div>
                                <div>
                                    <h2 class="text-lg md:text-xl font-semibold font-poppins text-gray-700">Detail Konseling</h2>
                                    <p id="detailCardDate" class="text-sm md:text-base text-gray-600">Memuat tanggal...</p>
                                </div>
                            </div>
                            <span id="detailCardJenisBadge" class="text-white px-3 py-1.5 md:px-4 md:py-2 rounded-full text-xs md:text-sm font-medium shadow-lg status-badge self-start sm:self-center">
                                Memuat jenis...
                            </span>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                            <div class="bg-white/60 rounded-2xl p-4 md:p-6 border border-gray-200/50">
                                <div class="flex items-center space-x-3 mb-3 md:mb-4">
                                    <div class="w-8 h-8 md:w-10 md:h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-user-md text-blue-600"></i>
                                    </div>
                                    <h3 class="text-md md:text-lg font-semibold font-poppins text-gray-800">Psikolog</h3>
                                </div>
                                <p id="detailCardPsikologName" class="text-gray-700 font-medium text-sm md:text-base">Memuat nama...</p>
                                <p id="detailCardPsikologTitle" class="text-xs md:text-sm text-gray-500 mt-1">Memuat gelar...</p>
                            </div>
                            <div class="bg-white/60 rounded-2xl p-4 md:p-6 border border-gray-200/50">
                                <div class="flex items-center space-x-3 mb-3 md:mb-4">
                                    <div class="w-8 h-8 md:w-10 md:h-10 bg-green-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-stethoscope text-green-600"></i>
                                    </div>
                                    <h3 class="text-md md:text-lg font-semibold font-poppins text-gray-800">Diagnosa</h3>
                                </div>
                                <p id="detailCardDiagnosaText" class="text-gray-700 text-sm md:text-base">Informasi diagnosa tidak tersedia dalam data jadwal.</p>
                                <div id="detailCardDiagnosaTags" class="flex items-center space-x-2 mt-3">
                                    </div>
                            </div>
                        </div>
                        <div class="mt-6 text-center">
                             <button onclick="closeDetailCard()" class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-6 rounded-lg text-sm font-medium transition-colors">Tutup</button>
                        </div>
                    </section>

                    <section class="glass-effect rounded-xl p-8 shadow-[0_4px_20px_rgba(0,0,0,0.08)] animate-slide-up relative">
                        <div id="loadingOverlayTable" class="loading-overlay" style="display: none;"><div class="spinner"></div></div>
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-semibold font-poppins flex items-center">
                                <i class="fas fa-list-ul text-telusafe-red mr-3"></i>Daftar Sesi Konseling
                            </h2>
                        </div>
                        <div class="overflow-x-auto rounded-2xl border border-gray-200">
                            <table class="w-full table-auto">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="text-left py-4 px-4 font-semibold text-sm text-gray-600">No</th>
                                        <th class="text-left py-4 px-4 font-semibold text-sm text-gray-600">Tanggal</th>
                                        <th class="text-left py-4 px-4 font-semibold text-sm text-gray-600">Jenis</th>
                                        <th class="text-left py-4 px-4 font-semibold text-sm text-gray-600">Media</th>
                                        <th class="text-left py-4 px-4 font-semibold text-sm text-gray-600">Psikolog</th>
                                        <th class="text-left py-4 px-4 font-semibold text-sm text-gray-600">Status</th>
                                        <th class="text-left py-4 px-4 font-semibold text-sm text-gray-600">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="history-table-body">
                                    </tbody>
                            </table>
                        </div>
                        <div class="flex items-center justify-between mt-6 pt-6 border-t border-gray-200">
                            <div class="text-sm text-gray-600" id="pagination-info">
                                Menampilkan <span class="font-semibold">0</span> dari <span class="font-semibold">0</span> konseling
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
        </main>
    </div>

    <div id="toast" class="fixed top-4 right-4 bg-white border-l-4 border-telusafe-red rounded-lg shadow-lg p-4 transform translate-x-full transition-transform duration-300 z-50">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-3" id="toast-icon"></i>
            <div><p class="font-semibold text-sm" id="toast-title">Success!</p><p class="text-xs text-gray-600" id="toast-message">Action completed.</p></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initializeToastSystem();
            const auth = firebase.auth();
            const database = firebase.database();

            auth.onAuthStateChanged(function(user) {
                const profileUsernameElement = document.getElementById('profileUsername');
                const profileStatusElement = document.getElementById('profileStatus');
                if (user) {
                    database.ref('users/' + user.uid).once('value')
                        .then(snapshot => {
                            if (snapshot.exists()) {
                                const ud = snapshot.val();
                                if (profileUsernameElement) profileUsernameElement.textContent = ud.username || 'Username';
                                if (profileStatusElement) profileStatusElement.textContent = (ud.status || 'N/A').charAt(0).toUpperCase() + (ud.status || 'N/A').slice(1);
                            } else { /* defaults */ }
                        }).catch(err => console.error('Profile fetch error:', err));
                    fetchCounselingHistory(user.uid, database);
                } else {
                    if (profileUsernameElement) profileUsernameElement.textContent = 'Guest';
                    if (profileStatusElement) profileStatusElement.textContent = '-';
                    const tableBody = document.getElementById('history-table-body');
                    tableBody.innerHTML = `<tr><td colspan="7" class="text-center py-10 text-gray-500">Silakan login untuk melihat riwayat.</td></tr>`;
                    updatePaginationInfo(0, 0);
                }
            });
        });

        function fetchCounselingHistory(userId, database) {
            const tableBody = document.getElementById('history-table-body');
            const loadingOverlay = document.getElementById('loadingOverlayTable');
            loadingOverlay.style.display = 'flex';
            tableBody.innerHTML = '';

            const historyRef = database.ref('jadwal_konseling').orderByChild('userId').equalTo(userId);
            historyRef.on('value', snapshot => {
                tableBody.innerHTML = '';
                const counselingData = [];
                snapshot.forEach(child => { counselingData.push({ key: child.key, ...child.val() }); });
                counselingData.sort((a, b) => (b.timestamp || 0) - (a.timestamp || 0)); // Sort by timestamp

                if (counselingData.length === 0) {
                    tableBody.innerHTML = `<tr><td colspan="7" class="text-center py-10 text-gray-500"><i class="fas fa-folder-open fa-3x mb-3"></i><p>Belum ada riwayat konseling.</p></td></tr>`;
                } else {
                    counselingData.forEach((item, index) => renderTableRow(item.key, item, index + 1, tableBody));
                }
                updatePaginationInfo(counselingData.length, counselingData.length);
                loadingOverlay.style.display = 'none';
            }, error => {
                console.error("Error fetching history: ", error);
                tableBody.innerHTML = `<tr><td colspan="7" class="text-center py-10 text-red-500">Gagal memuat riwayat.</td></tr>`;
                loadingOverlay.style.display = 'none';
            });
        }

        function parseDateDDMMYYYY(dateString) {
            if (!dateString || typeof dateString !== 'string') return null;
            const parts = dateString.split('-');
            if (parts.length !== 3) return null;
            return new Date(parseInt(parts[2]), parseInt(parts[1]) - 1, parseInt(parts[0]));
        }
        
        
        function formatDisplayDate(dateStringDDMMYYYY) {
            const dateObj = parseDateDDMMYYYY(dateStringDDMMYYYY);
            if (!dateObj || isNaN(dateObj.getTime())) return dateStringDDMMYYYY || "Tanggal Tidak Valid";
            const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            return `${dateObj.getDate()} ${monthNames[dateObj.getMonth()]} ${dateObj.getFullYear()}`;
        }

        function getSessionStatus(tanggalKonselingStr) {
            const today = new Date(); today.setHours(0, 0, 0, 0);
            const tanggalKonseling = parseDateDDMMYYYY(tanggalKonselingStr);
            if (!tanggalKonseling || isNaN(tanggalKonseling.getTime())) return { text: "Tidak Diketahui", class: "bg-gray-100 text-gray-600" };
            tanggalKonseling.setHours(0, 0, 0, 0);

            if (tanggalKonseling < today) return { text: "Selesai", class: "bg-blue-100 text-blue-600" };
            if (tanggalKonseling.getTime() === today.getTime()) return { text: "Hari Ini", class: "bg-yellow-100 text-yellow-600" };
            return { text: "Akan Datang", class: "bg-green-100 text-green-600" };
        }
        
        function getTableJenisBadgeClass(jenis) { // For lighter badges in table
            if (!jenis) return "bg-gray-100 text-gray-700";
            const j = jenis.toLowerCase();
            if (j.includes('baru') || j.includes('inisial')) return "bg-purple-100 text-purple-600";
            if (j.includes('konsultasi')) return "bg-yellow-100 text-yellow-600";
            if (j.includes('lanjut') || j.includes('follow')) return "bg-green-100 text-green-600";
            return "bg-gray-100 text-gray-700";
        }

        function getDetailCardJenisBadgeClass(jenis) { // For solid badges in detail card
            if (!jenis) return "bg-gray-400"; 
            const j = jenis.toLowerCase();
            if (j.includes('baru') || j.includes('inisial')) return "bg-purple-600";
            if (j.includes('konsultasi')) return "bg-yellow-500";
            if (j.includes('lanjut') || j.includes('follow')) return "bg-green-600";
            return "bg-telusafe-red"; // Default solid color
        }

        function renderTableRow(key, data, number, tableBody) {
            const row = tableBody.insertRow();
            row.className = "border-b border-gray-200 table-row-hover";
            const statusInfo = getSessionStatus(data.tanggal);
            const jenisBadgeClass = getTableJenisBadgeClass(data.jenis_kunjungan);
            let mediaIcon = "fas fa-question-circle text-gray-500";
            if (data.media) {
                if (data.media.toLowerCase() === 'luring') mediaIcon = "fas fa-users text-blue-500";
                else if (data.media.toLowerCase().includes('daring') || data.media.toLowerCase().includes('online')) mediaIcon = "fas fa-video text-green-500";
            }
            const psikologName = data.psikolog ? data.psikolog.split(',')[0] : 'N/A';
            const psikologTitle = data.psikolog ? data.psikolog.split(',').slice(1).join(',').trim() : '';

            row.innerHTML = `
                <td class="py-4 px-4 text-sm font-medium text-gray-800">${number}</td>
                <td class="py-4 px-4 text-sm text-gray-700"><div class="flex items-center space-x-2"><i class="fas fa-calendar text-telusafe-red"></i><span>${data.tanggal || 'N/A'}</span></div></td>
                <td class="py-4 px-4"><span class="${jenisBadgeClass} text-xs font-semibold px-3 py-1 rounded-full">${data.jenis_kunjungan ? data.jenis_kunjungan.charAt(0).toUpperCase() + data.jenis_kunjungan.slice(1) : 'N/A'}</span></td>
                <td class="py-4 px-4 text-sm text-gray-700"><div class="flex items-center space-x-2"><i class="${mediaIcon}"></i><span>${data.media ? data.media.charAt(0).toUpperCase() + data.media.slice(1) : 'N/A'}</span></div></td>
                <td class="py-4 px-4 text-sm text-gray-700"><div class="flex items-center space-x-3"><div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center"><i class="fas fa-user text-gray-600"></i></div><div><p class="font-medium">${psikologName}</p><p class="text-xs text-gray-500">${psikologTitle}</p></div></div></td>
                <td class="py-4 px-4"><span class="${statusInfo.class} text-xs font-semibold px-3 py-1 rounded-full status-badge">${statusInfo.text}</span></td>
                <td class="py-4 px-4"><div class="flex space-x-2">
                    <button class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 hover:bg-blue-100 action-button" title="View Detail" onclick="viewDetail('${key}', event)"><i class="fas fa-eye text-gray-500 hover:text-blue-500 text-sm"></i></button>
                    <button class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 hover:bg-red-100 action-button" title="Delete" onclick="confirmDelete('${key}', event)"><i class="fas fa-trash text-gray-500 hover:text-red-500 text-sm"></i></button>
                </div></td>`;
        }
        
        function viewDetail(key, event) {
            if (event) event.stopPropagation();
            showToast('Memuat Detail', `Mengambil detail sesi...`, 'info');
            const database = firebase.database();
            const detailRef = database.ref('jadwal_konseling/' + key);
            const latestCard = document.getElementById('latestCounselingCard');
            
            document.getElementById('detailCardDate').textContent = 'Memuat...';
            const jenisBadgeEl = document.getElementById('detailCardJenisBadge');
            jenisBadgeEl.textContent = 'Memuat...';
            jenisBadgeEl.className = 'bg-gray-400 text-white px-3 py-1.5 md:px-4 md:py-2 rounded-full text-xs md:text-sm font-medium shadow-lg status-badge self-start sm:self-center';
            document.getElementById('detailCardPsikologName').textContent = 'Memuat...';
            document.getElementById('detailCardPsikologTitle').textContent = 'Memuat...';
            document.getElementById('detailCardDiagnosaText').textContent = "Informasi diagnosa tidak tersedia dalam data jadwal.";
            document.getElementById('detailCardDiagnosaTags').innerHTML = '';

            latestCard.style.display = 'block';
            latestCard.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

            detailRef.once('value')
                .then(snapshot => {
                    if (snapshot.exists()) populateDetailCard(snapshot.val());
                    else {
                        showToast('Data Tidak Ditemukan', 'Detail sesi tidak ditemukan.', 'error');
                        document.getElementById('detailCardDate').textContent = 'Data tidak ditemukan';
                    }
                }).catch(error => {
                    console.error("Error fetching detail: ", error);
                    showToast('Gagal Memuat', 'Tidak dapat mengambil detail sesi.', 'error');
                    document.getElementById('detailCardDate').textContent = 'Gagal memuat data';
                });
        }

        function populateDetailCard(data) {
            document.getElementById('detailCardDate').textContent = formatDisplayDate(data.tanggal);
            const jenisKonseling = data.jenis_kunjungan ? data.jenis_kunjungan.charAt(0).toUpperCase() + data.jenis_kunjungan.slice(1) : "N/A";
            const jenisBadgeEl = document.getElementById('detailCardJenisBadge');
            jenisBadgeEl.textContent = jenisKonseling;
            // Apply solid badge class for detail card, ensure text-white for contrast
            jenisBadgeEl.className = `${getDetailCardJenisBadgeClass(data.jenis_kunjungan || "")} text-white px-3 py-1.5 md:px-4 md:py-2 rounded-full text-xs md:text-sm font-medium shadow-lg status-badge self-start sm:self-center`;
            
            const psikologParts = (data.psikolog || "N/A, N/A").split(',');
            document.getElementById('detailCardPsikologName').textContent = psikologParts[0].trim();
            document.getElementById('detailCardPsikologTitle').textContent = psikologParts.length > 1 ? psikologParts.slice(1).join(',').trim() : "Tidak ada gelar/spesialisasi";
            // Diagnosa remains placeholder as it's not in Firebase
        }
        
        function closeDetailCard() {
            const latestCard = document.getElementById('latestCounselingCard');
            latestCard.style.opacity = '0';
            latestCard.style.transform = 'scale(0.95)';
            setTimeout(() => { latestCard.style.display = 'none'; }, 300);
        }

        function confirmDelete(key, event) {
            if (event) event.stopPropagation();
            const row = event.target.closest('tr');
            const tanggal = row.cells[1].textContent.trim();
            if (confirm(`Apakah Anda yakin ingin menghapus jadwal konseling tanggal ${tanggal} ini?`)) {
                deleteFromFirebase(key, row);
            }
        }

        function deleteFromFirebase(key, rowElement) {
            const database = firebase.database();
            database.ref('jadwal_konseling/' + key).remove()
                .then(() => {
                    showToast('Hapus Berhasil', 'Jadwal konseling berhasil dihapus.', 'success');
                    if (rowElement) {
                        rowElement.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                        rowElement.style.opacity = '0';
                        rowElement.style.transform = 'translateX(-20px)';
                        setTimeout(() => {
                             rowElement.remove();
                             const currentTotal = document.querySelectorAll('#history-table-body tr:not([style*="display: none"])').length;
                             updatePaginationInfo(currentTotal, currentTotal);
                             if(currentTotal === 0) { // Check if table becomes empty
                                const tableBody = document.getElementById('history-table-body');
                                tableBody.innerHTML = `<tr><td colspan="7" class="text-center py-10 text-gray-500"><i class="fas fa-folder-open fa-3x mb-3"></i><p>Belum ada riwayat konseling.</p></td></tr>`;
                             }
                        }, 300);
                    }
                }).catch(error => {
                    console.error("Error deleting: ", error);
                    showToast('Gagal Menghapus', 'Terjadi kesalahan.', 'error');
                });
        }
        
        function updatePaginationInfo(current, total) {
            const el = document.getElementById('pagination-info');
            if (el) el.innerHTML = `Menampilkan <span class="font-semibold">${current}</span> dari <span class="font-semibold">${total}</span> konseling`;
        }

        function initializeToastSystem() {
            window.showToast = function(title, message, type = 'success') {
                const t = document.getElementById('toast'), tT = document.getElementById('toast-title'), tM = document.getElementById('toast-message'), tI = document.getElementById('toast-icon');
                tI.className = 'fas mr-3'; 
                t.className = 'fixed top-4 right-4 bg-white rounded-lg shadow-lg p-4 transform transition-transform duration-300 z-50 translate-x-full';
                let iconClass = '', borderClass = '';
                switch(type) {
                    case 'success': iconClass = 'fa-check-circle text-green-500'; borderClass = 'border-green-500'; break;
                    case 'warning': iconClass = 'fa-exclamation-triangle text-yellow-500'; borderClass = 'border-yellow-500'; break;
                    case 'info':    iconClass = 'fa-info-circle text-blue-500'; borderClass = 'border-blue-500'; break;
                    case 'error':   iconClass = 'fa-times-circle text-red-500'; borderClass = 'border-red-500'; break;
                }
                tI.classList.add(...iconClass.split(' ')); t.classList.add('border-l-4', borderClass);
                tT.textContent = title; tM.textContent = message;
                setTimeout(() => { t.style.transform = 'translateX(0)'; }, 50);
                setTimeout(() => { t.style.transform = 'translateX(100%)'; }, 4000);
            };
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
            showToast('Counseling', 'You are already viewing counseling page!', 'info');
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
                showToast('Logout Berhasil', 'Anda akan diarahkan ke halaman login.', 'success');
                setTimeout(() => { window.location.href = "{{ url('login') }}"; }, 1500);
            }).catch(error => showToast('Logout Gagal', error.message, 'error'));
        }
    </script>
</body>
</html>