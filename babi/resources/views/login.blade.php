<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>TeluSafe - Masuk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
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
        
        .input-focus {
            transition: all 0.3s ease;
        }
        
        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px -5px rgba(239, 68, 68, 0.2);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #DC2626, #EF4444, #F87171);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradientShift 3s ease-in-out infinite;
        }
        
        .welcome-banner {
            background: linear-gradient(135deg, #DC2626, #EF4444, #F87171);
            background-size: 400% 400%;
            animation: gradientShift 5s ease-in-out infinite;
        }
        
        .loading-spinner {
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
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
    </style>
</head>
<body class="bg-gradient-to-br from-neutral-50 via-white to-telusafe-50 min-h-screen flex items-center justify-center p-4">
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-telusafe-100 rounded-full opacity-20 animate-float"></div>
        <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-telusafe-200 rounded-full opacity-15 animate-bounce-gentle"></div>
        <div class="absolute top-1/2 right-1/6 w-64 h-64 bg-gradient-to-br from-telusafe-100 to-telusafe-200 rounded-full opacity-10 animate-pulse-soft"></div>
    </div>

    <div class="w-full max-w-md relative z-10 animate-scale-in">
        <div class="text-center mb-8 animate-slide-down">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-telusafe-500 to-telusafe-600 rounded-4xl mb-6 shadow-glow-strong animate-bounce-gentle">
                <img src="/assets/webadmin/Logo.png" alt="TeluSafe Logo" class="w-8 h-8 object-contain"/>
            </div>
            <h1 class="text-4xl font-display font-bold gradient-text mb-2">TeluSafe</h1>
            <p class="text-neutral-600 text-lg">Portal Keamanan Telkom University</p>
        </div>

        <div class="glass-effect rounded-4xl shadow-strong p-8 border-2 border-white/50 hover-lift">
            <div class="stagger-animation space-y-6" >
                <div class="text-center">
                    <h2 class="text-2xl font-display font-bold text-neutral-800 mb-2">Selamat Datang Kembali</h2>
                    <p class="text-neutral-600">Masuk ke akun TeluSafe Anda</p>
                </div>

                <form id="loginForm loginHidden" class="space-y-6" onsubmit="handleLogin(event)">
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-semibold text-neutral-700">
                            <i class="fas fa-envelope text-telusafe-500 mr-2"></i>
                            Email atau NIM
                        </label>
                        <input 
                            type="text" 
                            id="email" 
                            name="email" 
                            required
                            class="w-full px-4 py-3 bg-white/70 border border-neutral-200 rounded-2xl focus:bg-white focus:border-telusafe-400 focus:ring-4 focus:ring-telusafe-100 outline-none transition-all duration-300 input-focus placeholder-neutral-400 hover:shadow-glow"
                            placeholder="Masukkan email atau NIM Anda"
                        />
                    </div>

                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-semibold text-neutral-700">
                            <i class="fas fa-lock text-telusafe-500 mr-2"></i>
                            Kata Sandi
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                required
                                class="w-full px-4 py-3 bg-white/70 border border-neutral-200 rounded-2xl focus:bg-white focus:border-telusafe-400 focus:ring-4 focus:ring-telusafe-100 outline-none transition-all duration-300 input-focus placeholder-neutral-400 hover:shadow-glow pr-12"
                                placeholder="Masukkan kata sandi Anda"
                            />
                            <button 
                                type="button" 
                                onclick="togglePassword()" 
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-neutral-400 hover:text-telusafe-500 transition-colors duration-200"
                                aria-label="Toggle password visibility"
                            >
                                <i class="fas fa-eye text-sm" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center space-x-2 cursor-pointer group">
                            <input id="rememberMe" type="checkbox" class="w-4 h-4 text-telusafe-500 border border-neutral-300 rounded focus:ring-telusafe-100 focus:ring-2">
                            <span class="text-neutral-600 group-hover:text-telusafe-600 transition-colors">Ingat saya</span>
                        </label>
                        <a href="#" onclick="forgotPassword()" class="text-telusafe-500 hover:text-telusafe-600 font-medium transition-colors hover:underline">
                            Lupa kata sandi?
                        </a>
                    </div>

                    <button 
                        type="submit" 
                        class="w-full welcome-banner text-white font-semibold py-3 px-6 rounded-2xl shadow-medium hover:shadow-glow-strong transition-all duration-300 transform hover:scale-105 hover:shadow-strong flex items-center justify-center space-x-2"
                        id="loginBtn"
                    >
                        <span id="loginText">Masuk</span>
                        <i class="fas fa-arrow-right" id="loginIcon"></i>
                        <i class="fas fa-spinner loading-spinner hidden" id="loadingIcon"></i>
                    </button>
                </form>

                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-neutral-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white/80 text-neutral-500">atau</span>
                    </div>
                </div>

                <button type="button" onclick="loginWithGoogle()" 
                    class="w-full bg-white border border-neutral-200 text-neutral-700 font-medium py-3 px-6 rounded-2xl shadow-soft hover:shadow-medium transition-all duration-300 transform hover:scale-105 flex items-center justify-center space-x-3 hover-lift">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    <span>Masuk dengan Google</span>
                </button>

                <div class="text-center pt-4 border-t border-neutral-200">
                    <p class="text-neutral-600">
                        Belum punya akun? 
                        <a href="/signup" onclick="goToSignUp()" class="text-telusafe-500 hover:text-telusafe-600 font-semibold transition-colors hover:underline">
                            Daftar sekarang
                        </a>
                    </p>
                </div>

                <div id="forgotPasswordModal" class="fixed inset-0 bg-black bg-opacity-5 flex items-center justify-center hidden">
                <div class="bg-white rounded-lg p-6 w-80 max-w-full">
                    <h2 class="text-lg font-semibold mb-4">Reset Kata Sandi</h2>
                    <input 
                    type="email" 
                    id="resetEmail" 
                    placeholder="Masukkan email Anda" 
                    class="w-full border border-gray-300 rounded px-3 py-2 mb-4 focus:outline-none focus:ring-2 focus:ring-telusafe-500" 
                    required
                    />
                    <div class="flex justify-end space-x-3">
                        <button onclick="closeForgotPasswordModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                        <button onclick="submitForgotPassword()" class="px-4 py-2 bg-telusafe-500 text-white rounded hover:bg-telusafe-600">Kirim</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="text-center mt-8 text-sm text-neutral-500 animate-fade-in">
            <p>© 2025 TeluSafe - Telkom University. Semua hak dilindungi.</p>
            <div class="flex items-center justify-center space-x-4 mt-2">
                <a href="#" class="hover:text-telusafe-500 transition-colors">Bantuan</a>
                <span>•</span>
                <a href="#" class="hover:text-telusafe-500 transition-colors">Kebijakan Privasi</a>
                <span>•</span>
                <a href="#" class="hover:text-telusafe-500 transition-colors">Syarat & Ketentuan</a>
            </div>
        </div>
    </div>

    <div id="toast" class="fixed top-4 right-4 glass-effect border-l-4 border-telusafe-500 rounded-lg shadow-strong p-4 transform translate-x-full transition-all duration-500 z-50 max-w-sm">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-3 animate-bounce-gentle" id="toast-icon"></i>
            <div>
                <p class="font-semibold text-sm" id="toast-title">Berhasil!</p>
                <p class="text-xs text-neutral-600" id="toast-message">Tindakan berhasil dilakukan!</p>
            </div>
        </div>
    </div>
    
</div>
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-auth-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-database-compat.js"></script>
    <script src="js/configurasi-firebase.js"></script>
        
    <script>
        const database = firebase.database();
        document.addEventListener('DOMContentLoaded', function() {
            initializeToastSystem();
            addInputAnimations();
        });

        function loginWithGoogle() {
            showToast('Login Google', 'Membuka jendela login Google...', 'info');
            const provider = new firebase.auth.GoogleAuthProvider();

            const rememberMeChecked = document.getElementById('rememberMe').checked;
            const persistence = rememberMeChecked
            ? firebase.auth.Auth.Persistence.LOCAL    // Ingat user meskipun tutup browser
            : firebase.auth.Auth.Persistence.SESSION; // Hanya sesi saat browser/tab masih buka

            firebase.auth().setPersistence(persistence)
            .then(() => {
                return firebase.auth().signInWithPopup(provider);
            })
            .then((result) => {
                const user = result.user;
                console.log('User logged in:', user);

            // Cek apakah user sudah ada di database realtime (misal di path users/uid)
                const userRef = firebase.database().ref('users/' + user.uid);
                userRef.once('value', snapshot => {
                    if (snapshot.exists()) {
                    const userData = snapshot.val();
                    sessionStorage.setItem('uid', user.uid);
                    showToast('Anda sudah terdaftar!', `Selamat datang kembali, ${user.displayName || user.email}!`, 'success');

        // Redirect sesuai role
                    setTimeout(() => {
                    showToast('Mengalihkan...', 'Memproses halaman Anda...', 'info');

                    const role = userData.status || '';

                            if (role === 'psikolog') {
                                window.location.href = '/halaman';
                            } else if (role === 'karyawan/dosen') {
                                window.location.href = '/beranda';
                            } else if (role === 'mahasiswa') {
                                window.location.href = '/dashboard';
                            } else {
                // Default redirect kalau role tidak dikenal
                                window.location.href = '/dashboard';
                            }
                        }, 1500);
                    } else {
            // User belum ada, simpan data Google ke sessionStorage lalu ke signup
                        sessionStorage.setItem('googleUser', JSON.stringify({
                            uid: user.uid,
                            name: user.displayName,
                            email: user.email,
                        }));
                        showToast('Data kurang lengkap', 'Silakan lengkapi data Anda terlebih dahulu.', 'info');
                        setTimeout(() => {
                            window.location.href = `/signup`;
                        }, 1500);
                    }
                });
            })
            .catch((error) => {
                console.error('Login Google gagal:', error);
                let errorMessage = 'Terjadi kesalahan saat login.';
                if (error.code === 'auth/popup-closed-by-user') {
                    errorMessage = 'Jendela login ditutup.';
                } else if (error.code === 'auth/unauthorized-domain') {
                    errorMessage = 'Domain ini tidak diizinkan untuk operasi OAuth Anda. Mohon periksa konsol Firebase.';
                } else {
                    errorMessage = error.message;
                }
                showToast('Login Gagal', `Login Google gagal: ${errorMessage}`, 'error');
            });
        }

        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.className = 'fas fa-eye-slash text-sm';
            } else {
                passwordInput.type = 'password';
                toggleIcon.className = 'fas fa-eye text-sm';
            }
        }

        // Handle login form submission
        function handleLogin(event) {
            event.preventDefault();
    
            const loginBtn = document.getElementById('loginBtn');
            const loginText = document.getElementById('loginText');
            const loginIcon = document.getElementById('loginIcon');
            const loadingIcon = document.getElementById('loadingIcon');
    
    // Show loading state
            loginText.textContent = 'Memproses...';
            loginIcon.classList.add('hidden');
            loadingIcon.classList.remove('hidden');
            loginBtn.disabled = true;

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const rememberMeChecked = document.getElementById('rememberMe').checked;
            const persistence = rememberMeChecked
            ? firebase.auth.Auth.Persistence.LOCAL
            : firebase.auth.Auth.Persistence.SESSION;

            firebase.auth().setPersistence(persistence)
            .then(() => {
                return firebase.auth().signInWithEmailAndPassword(email, password);
            })
            .then((userCredential) => {
    const user = userCredential.user;
    sessionStorage.setItem('uid', user.uid);

    // Ambil referensi data pengguna dari database
    const userRef = firebase.database().ref('users/' + user.uid);
    userRef.once('value')
        .then(snapshot => {
            const userData = snapshot.val();
            
            const role = userData?.status || ''; // Ambil status/role

            // Reset button state
            loginText.textContent = 'Masuk';
            loginIcon.classList.remove('hidden');
            loadingIcon.classList.add('hidden');
            loginBtn.disabled = false;

            showToast('Berhasil Masuk!', 'Selamat datang di TeluSafe', 'success');

            // Delay sebelum redirect
            setTimeout(() => {
                showToast('Mengalihkan...', 'Membuka dashboard Anda...', 'info');

                // Redirect sesuai role
                if (role === 'psikolog') {
                    window.location.href = '/halaman';
                } else if (role === 'karyawan/dosen') {
                    window.location.href = '/beranda';
                } else if (role === 'mahasiswa') {
                    window.location.href = '/dashboard';
                } else {
                    window.location.href = '/dashboard'; // default fallback
                }
            }, 1500);
        })
        .catch(error => {
            console.error('Gagal mengambil data role:', error);
            showToast('Error', 'Gagal mengambil data pengguna dari database.', 'error');
        });
})

            .catch((error) => {
        // Reset button state
                loginText.textContent = 'Masuk';
                loginIcon.classList.remove('hidden');
                loadingIcon.classList.add('hidden');
                loginBtn.disabled = false;

                showToast('Login gagal', error.message, 'error');
            });
        }

        function closeForgotPasswordModal() {
        // Sembunyikan modal dan reset input
            document.getElementById('forgotPasswordModal').classList.add('hidden');
            document.getElementById('resetEmail').value = '';
            document.getElementById('loginHidden').classList.remove('hidden');
        }

        function submitForgotPassword() {
            const email = document.getElementById('resetEmail').value.trim();
            if (!email) {
                showToast('Error', 'Email harus diisi', 'error');
            return;
            }
            firebase.auth().sendPasswordResetEmail(email)
            .then(() => {
                showToast('Berhasil', 'Email reset password sudah dikirim.', 'success');
                closeForgotPasswordModal();
            })
        }

        // Forgot password placeholder
        function forgotPassword() {
            showToast('Lupa Kata Sandi', 'Membuka halaman reset kata sandi...', 'info');
            // Implement actual password reset logic here
            document.getElementById('forgotPasswordModal').classList.remove('hidden');
            document.getElementById('loginHidden').classList.add('hidden');
        }

        // Go to sign up page placeholder
        function goToSignUp() {
            showToast('Daftar Akun', 'Membuka halaman pendaftaran...', 'info');
            // Implement actual sign-up page navigation here
        }

        // Toast notification system (existing, kept for completeness)
        function initializeToastSystem() {
            window.showToast = function(title, message, type = 'success') {
                const toast = document.getElementById('toast');
                const toastTitle = document.getElementById('toast-title');
                const toastMessage = document.getElementById('toast-message');
                const toastIcon = document.getElementById('toast-icon');
                
                // Ensure toast is hidden before showing to reset animation
                toast.style.transform = 'translateX(100%)';
                clearTimeout(toast.hideTimeout); // Clear any existing hide timeout

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
                requestAnimationFrame(() => { // Use requestAnimationFrame to ensure reflow before transform
                    toast.style.transform = 'translateX(0)';
                });
                
                // Hide after 4 seconds
                toast.hideTimeout = setTimeout(() => {
                    toast.style.transform = 'translateX(100%)';
                }, 4000);
            };
        }

        // Add input animations
        function addInputAnimations() {
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });
        }
    </script>
</body>
</html>