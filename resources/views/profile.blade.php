<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>TeluSafe - Profil</title>
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
                        'gradient-shift': 'gradientShift 3s ease-in-out infinite',
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
                        gradientShift: {
                            '0%, 100%': { 'background-position': '0% 50%' },
                            '50%': { 'background-position': '100% 50%' }
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
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .hover-lift {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .hover-lift:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.15);
        }
        
        .info-card {
            transition: all 0.3s ease;
        }
        
        .info-card:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 30px -5px rgba(239, 68, 68, 0.1);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #DC2626, #EF4444, #F87171);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradientShift 3s ease-in-out infinite;
        }
        
        .logout-button {
            background: linear-gradient(135deg, #DC2626, #EF4444, #F87171);
            background-size: 400% 400%;
            animation: gradientShift 5s ease-in-out infinite;
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
    </style>
</head>
<body class="bg-gradient-to-br from-neutral-50 via-white to-telusafe-50 min-h-screen flex items-center justify-center p-4">
    <!-- Background decorations -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-telusafe-100 rounded-full opacity-20 animate-float"></div>
        <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-telusafe-200 rounded-full opacity-15 animate-bounce-gentle"></div>
        <div class="absolute top-1/2 right-1/6 w-64 h-64 bg-gradient-to-br from-telusafe-100 to-telusafe-200 rounded-full opacity-10 animate-pulse-soft"></div>
    </div>

    <!-- Main Container -->
    <div class="w-full max-w-lg relative z-10 animate-scale-in">
        <!-- Logo and Header -->
        <div class="text-center mb-8 animate-slide-down">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-telusafe-500 to-telusafe-600 rounded-4xl mb-6 shadow-glow-strong animate-bounce-gentle">
                <img src="../assets/webStudent/Logo.png" alt="TeluSafe Logo" class="w-8 h-8 object-contain"/>
            </div>
            <h1 class="text-4xl font-display font-bold gradient-text mb-2">TeluSafe</h1>
            <p class="text-neutral-600 text-lg">Portal Keamanan Telkom University</p>
        </div>

        <!-- Profile Card -->
        <div class="glass-effect rounded-4xl shadow-strong p-8 border-2 border-white/50 hover-lift">
            <div class="stagger-animation space-y-6">
                <!-- Profile Header -->
                <div class="text-center border-b border-neutral-200 pb-6">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-telusafe-500 to-telusafe-600 rounded-full mb-4 shadow-glow animate-pulse-soft">
                        <i class="fas fa-user text-white text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-display font-bold text-neutral-800 mb-2">Profil Pengguna</h2>
                    <p class="text-neutral-600">Informasi Akun TeluSafe Anda</p>
                </div>

                <!-- Profile Information -->
                <div class="space-y-4">
                    <div class="info-card bg-white/50 rounded-2xl p-4 border border-neutral-100">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-telusafe-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-user text-telusafe-600 text-lg"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <label class="block text-sm font-semibold text-neutral-700 mb-1">Username</label>
                                <p class="text-lg font-medium text-neutral-800 truncate" id="profileUsername">Loading...</p>
                            </div>
                        </div>
                    </div>

                    <div class="info-card bg-white/50 rounded-2xl p-4 border border-neutral-100">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-user-tag text-orange-600 text-lg"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <label class="block text-sm font-semibold text-neutral-700 mb-1">Nama Lengkap</label>
                                <p class="text-lg font-medium text-neutral-800 truncate" id="profileNamaLengkap">Loading...</p>
                            </div>
                        </div>
                    </div>

                    <div class="info-card bg-white/50 rounded-2xl p-4 border border-neutral-100">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-id-card text-green-600 text-lg"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <label class="block text-sm font-semibold text-neutral-700 mb-1">NIK</label>
                                <p class="text-lg font-medium text-neutral-800" id="profileNik">Loading...</p>
                            </div>
                        </div>
                    </div>

                    <div class="info-card bg-white/50 rounded-2xl p-4 border border-neutral-100">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-phone text-purple-600 text-lg"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <label class="block text-sm font-semibold text-neutral-700 mb-1">Nomor Telepon</label>
                                <p class="text-lg font-medium text-neutral-800" id="profilePhone">Loading...</p>
                            </div>
                        </div>
                    </div>

                    <div class="info-card bg-white/50 rounded-2xl p-4 border border-neutral-100">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-envelope text-blue-600 text-lg"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <label class="block text-sm font-semibold text-neutral-700 mb-1">Email</label>
                                <p class="text-lg font-medium text-neutral-800 truncate" id="profileEmail">Loading...</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="info-card bg-white/50 rounded-2xl p-4 border border-neutral-100">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-info-circle text-teal-600 text-lg"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <label class="block text-sm font-semibold text-neutral-700 mb-1">Status</label>
                                <p class="text-lg font-medium text-neutral-800" id="profileUserStatus">Loading...</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-3 pt-6 border-t border-neutral-200">

                    <!-- Logout Button -->
                    <button 
                        type="button" 
                        onclick="logout()"
                        class="w-full logout-button text-white font-semibold py-3 px-6 rounded-2xl shadow-medium hover:shadow-glow-strong transition-all duration-300 transform hover:scale-105 hover:shadow-strong flex items-center justify-center space-x-3"
                    >
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Keluar</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8 text-sm text-neutral-500 animate-fade-in">
            <p>© 2025 TeluSafe - Telkom University. Semua hak dilindungi.</p>
            <div class="flex items-center justify-center space-x-4 mt-2">
                <a href="#" onclick="goToHelp()" class="hover:text-telusafe-500 transition-colors">Bantuan</a>
                <span>•</span>
                <a href="#" onclick="goToPrivacy()" class="hover:text-telusafe-500 transition-colors">Kebijakan Privasi</a>
                <span>•</span>
                <a href="#" onclick="goToTerms()" class="hover:text-telusafe-500 transition-colors">Syarat & Ketentuan</a>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="fixed top-4 right-4 glass-effect border-l-4 border-telusafe-500 rounded-lg shadow-strong p-4 transform translate-x-full transition-all duration-500 z-50 max-w-sm">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-3 animate-bounce-gentle" id="toast-icon"></i>
            <div>
                <p class="font-semibold text-sm" id="toast-title">Berhasil!</p>
                <p class="text-xs text-neutral-600" id="toast-message">Tindakan berhasil dilakukan!</p>
            </div>
        </div>
    </div>

    <script>
        // Initialize the application
        document.addEventListener('DOMContentLoaded', function() {
            initializeToastSystem();
            addHoverEffects();
            const auth = firebase.auth(); // Jika sudah global di config, ini bisa redundan
            const database = firebase.database();

            auth.onAuthStateChanged(function(user) {
                const profileUsernameElement = document.getElementById('profileUsername');
                const profileEmailElement = document.getElementById('profileEmail');
                const profileNikElement = document.getElementById('profileNik');
                const profilePhoneElement = document.getElementById('profilePhone');
                const profileNamaLengkapElement = document.getElementById('profileNamaLengkap');
                const profileUserStatusElement = document.getElementById('profileUserStatus');

                if (user) {
                    // Pengguna sudah login
                    console.log('User UID (profile page):', user.uid);
                    database.ref('users/' + user.uid).once('value')
                        .then(function(snapshot) {
                            if (snapshot.exists()) {
                                const userData = snapshot.val();
                                
                                if (profileUsernameElement) {
                                    profileUsernameElement.textContent = userData.username || 'Tidak tersedia';
                                }
                                if (profileEmailElement) {
                                    profileEmailElement.textContent = userData.email || 'Tidak tersedia';
                                }
                                if (profileNikElement) {
                                    profileNikElement.textContent = userData.nik || 'Tidak tersedia';
                                }
                                if (profilePhoneElement) {
                                    profilePhoneElement.textContent = userData.phone || 'Tidak tersedia';
                                }
                                if (profileNamaLengkapElement) {
                                    profileNamaLengkapElement.textContent = userData.nama_lengkap || 'Tidak tersedia';
                                }
                                if (profileUserStatusElement) {
                                    const status = userData.status || 'Tidak diketahui';
                                    profileUserStatusElement.textContent = status.charAt(0).toUpperCase() + status.slice(1);
                                }

                            } else {
                                console.warn('Data pengguna tidak ditemukan untuk UID:', user.uid, 'di profile.blade.php');
                                if (profileUsernameElement) profileUsernameElement.textContent = 'Data tidak ditemukan';
                                // Set elemen lain juga ke "Data tidak ditemukan" atau "-"
                            }
                        })
                        .catch(function(error) {
                            console.error('Gagal mengambil data pengguna di profile.blade.php:', error);
                            if (profileUsernameElement) profileUsernameElement.textContent = 'Gagal memuat';
                            // Set elemen lain juga ke "Gagal memuat"
                        });
                } else {
                    // Pengguna tidak login
                    console.log('Pengguna belum login (profile page).');
                    if (profileUsernameElement) profileUsernameElement.textContent = 'Guest';
                    // Set elemen lain ke "Guest" atau "-"
                    // Pertimbangkan redirect ke halaman login
                    // window.location.href = '{{ url('/login') }}';
                }
            });
        });

        // Edit profile function
        function editProfile() {
            showToast('Edit Profil', 'Membuka halaman edit profil...', 'info');
            // In a real application, navigate to edit profile page
        }

        // Logout function
        function logout() {
            showToast('Keluar', 'Sedang memproses logout...', 'info');
            
            // Simulate logout process
            setTimeout(() => {
                showToast('Berhasil Keluar', 'Anda telah berhasil keluar. Sampai jumpa!', 'success');
                
                // Redirect to login page after showing success message
                setTimeout(() => {
                    // In a real application, redirect to login page
                    showToast('Mengalihkan...', 'Kembali ke halaman login...', 'info');
                    window.location.href = 'login';
                }, 1500);
            }, 1000);
        }

        // Footer navigation functions
        function goToHelp() {
            showToast('Bantuan', 'Membuka pusat bantuan...', 'info');
        }

        function goToPrivacy() {
            showToast('Kebijakan Privasi', 'Membuka kebijakan privasi...', 'info');
        }

        function goToTerms() {
            showToast('Syarat & Ketentuan', 'Membuka syarat & ketentuan...', 'info');
        }

        // Toast notification system
        function initializeToastSystem() {
            window.showToast = function(title, message, type = 'success') {
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
            };
        }

        // Add hover effects
        function addHoverEffects() {
            const infoCards = document.querySelectorAll('.info-card');
            infoCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px) scale(1.01)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
        }
    </script>
</body>
</html>