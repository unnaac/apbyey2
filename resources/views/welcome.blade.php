<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tester Login Google Firebase</title>

    <script src="https://www.gstatic.com/firebasejs/9.22.1/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.22.1/firebase-auth-compat.js"></script>

    <style>
        body {
            font-family: 'Inter', Arial, sans-serif; /* Using Inter font */
            margin: 0;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f0f2f5; /* Light background */
            color: #333;
        }
        h2 {
            color: #2c3e50;
            margin-bottom: 30px;
        }
        button {
            background-color: #4285F4; /* Google Blue */
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px; /* Slightly more rounded */
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        button:hover {
            background-color: #357ae8;
            transform: translateY(-2px);
        }
        button:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        #user-info {
            margin-top: 20px;
            padding: 25px;
            border: 1px solid #e0e0e0;
            border-radius: 12px; /* More rounded corners */
            display: inline-block;
            text-align: left;
            width: clamp(280px, 80vw, 350px); /* Responsive width */
            word-break: break-word;
            background-color: #ffffff;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }
        #user-info h3 {
            color: #2c3e50;
            margin-top: 0;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        #user-info p {
            margin-bottom: 8px;
            line-height: 1.5;
        }
        #user-info strong {
            color: #555;
        }
        #photo {
            border-radius: 50%;
            border: 2px solid #4285F4;
            margin-top: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        #logoutBtn {
            background-color: #dc3545; /* Red for logout */
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 15px;
        }
        #logoutBtn:hover {
            background-color: #c82333;
        }

        /* Custom Message Box Styles */
        .message-box-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }
        .message-box-overlay.show {
            opacity: 1;
            visibility: visible;
        }
        .message-box {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 400px;
            width: 90%;
            transform: translateY(-20px);
            transition: transform 0.3s ease-out;
        }
        .message-box-overlay.show .message-box {
            transform: translateY(0);
        }
        .message-box h4 {
            color: #dc3545; /* Error red */
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 20px;
        }
        .message-box p {
            color: #555;
            margin-bottom: 25px;
            line-height: 1.6;
        }
        .message-box button {
            background-color: #007bff; /* Primary blue for OK */
            padding: 10px 20px;
            font-size: 15px;
            box-shadow: none; /* No shadow for modal button */
        }
        .message-box button:hover {
            background-color: #0056b3;
            transform: none; /* No transform on hover for modal button */
        }
    </style>
</head>
<body>

    <h2>Login dengan Google menggunakan Firebase</h2>
    <button id="loginBtn">Login dengan Google</button>

    <div id="user-info" style="display:none;">
        <h3>Informasi User</h3>
        <p><strong>UID:</strong> <span id="uid"></span></p>
        <p><strong>Nama:</strong> <span id="name"></span></p>
        <p><strong>Email:</strong> <span id="email"></span></p>
        <p><img id="photo" src="" alt="User Photo" width="80" style="border-radius:50%;"></p>
        <button id="logoutBtn">Logout</button>
    </div>

    <div id="messageBoxOverlay" class="message-box-overlay">
        <div class="message-box">
            <h4 id="messageBoxTitle"></h4>
            <p id="messageBoxContent"></p>
            <button id="messageBoxCloseBtn">OK</button>
        </div>
    </div>

    <script>
        // TODO: Ganti dengan konfigurasi Firebase project-mu
        const firebaseConfig = {
            apiKey: "AIzaSyDPVuM2YqOaHY9BptnE2SaQUDRHkbQqOrA",
            authDomain: "ngetest-df385.firebaseapp.com",
            databaseURL: "https://ngetest-df385-default-rtdb.asia-southeast1.firebasedatabase.app",
            projectId: "ngetest-df385",
            storageBucket: "ngetest-df385.appspot.com",
            messagingSenderId: "285737156524",
            appId: "1:285737156524:web:6056c437a0dee8a84d8409",
        };

        // Inisialisasi Firebase
        firebase.initializeApp(firebaseConfig);

        const auth = firebase.auth();
        const provider = new firebase.auth.GoogleAuthProvider();

        const loginBtn = document.getElementById('loginBtn');
        const logoutBtn = document.getElementById('logoutBtn');
        const userInfoDiv = document.getElementById('user-info');
        const uidSpan = document.getElementById('uid');
        const nameSpan = document.getElementById('name');
        const emailSpan = document.getElementById('email');
        const photoImg = document.getElementById('photo');

        // Message Box elements
        const messageBoxOverlay = document.getElementById('messageBoxOverlay');
        const messageBoxTitle = document.getElementById('messageBoxTitle');
        const messageBoxContent = document.getElementById('messageBoxContent');
        const messageBoxCloseBtn = document.getElementById('messageBoxCloseBtn');

        /**
         * Displays a custom message box with a title and content.
         * @param {string} title - The title of the message box.
         * @param {string} content - The content/message to display.
         */
        function showMessageBox(title, content) {
            messageBoxTitle.textContent = title;
            messageBoxContent.textContent = content;
            messageBoxOverlay.classList.add('show');
        }

        /**
         * Hides the custom message box.
         */
        function hideMessageBox() {
            messageBoxOverlay.classList.remove('show');
        }

        // Event listener for the message box close button
        messageBoxCloseBtn.addEventListener('click', hideMessageBox);
        // Also allow clicking outside the box to close it
        messageBoxOverlay.addEventListener('click', (event) => {
            if (event.target === messageBoxOverlay) {
                hideMessageBox();
            }
        });


        loginBtn.addEventListener('click', () => {
            auth.signInWithPopup(provider)
            .then((result) => {
                const user = result.user;
                showUserInfo(user);
            })
            .catch((error) => {
                // Use the custom message box instead of alert
                showMessageBox('Login Gagal', 'Terjadi kesalahan saat login: ' + error.message);
                console.error(error);
            });
        });

        logoutBtn.addEventListener('click', () => {
            auth.signOut().then(() => {
                userInfoDiv.style.display = 'none';
                loginBtn.style.display = 'inline-block';
            }).catch((error) => {
                showMessageBox('Logout Gagal', 'Terjadi kesalahan saat logout: ' + error.message);
                console.error(error);
            });
        });

        // Tampilkan info user setelah login
        function showUserInfo(user) {
            uidSpan.textContent = user.uid;
            nameSpan.textContent = user.displayName || '-';
            emailSpan.textContent = user.email || '-';
            photoImg.src = user.photoURL || 'https://placehold.co/80x80/cccccc/333333?text=No+Photo'; // Fallback image
            userInfoDiv.style.display = 'block';
            loginBtn.style.display = 'none';
        }

        // Cek status login saat halaman dimuat
        auth.onAuthStateChanged((user) => {
            if(user) {
                showUserInfo(user);
            } else {
                userInfoDiv.style.display = 'none';
                loginBtn.style.display = 'inline-block';
            }
        });
    </script>

</body>
</html>
