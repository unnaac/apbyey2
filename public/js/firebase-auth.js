import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-app.js";
import {
    getAuth,
    signInWithEmailAndPassword,
} from "https://www.gstatic.com/firebasejs/10.12.0/firebase-auth.js";
import {
    getDatabase,
    ref,
    get,
    child,
} from "https://www.gstatic.com/firebasejs/10.12.0/firebase-database.js";

// ✅ Konfigurasi Firebase
const firebaseConfig = {
    apiKey: "AIzaSyDPVuM2YqOaHY9BptnE2SaQUDRHkbQqOrA",
    authDomain: "ngetest-df385.firebaseapp.com",
    projectId: "ngetest-df385",
    databaseURL:
        "https://ngetest-df385-default-rtdb.asia-southeast1.firebasedatabase.app",
    storageBucket: "ngetest-df385.firebasestorage.app",
    appId: "1:285737156524:android:6056c437a0dee8a84d8409",
};

firebase.initializeApp(firebaseConfig);

function handleLogin(event) {
    event.preventDefault();

    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    firebase
        .auth()
        .signInWithEmailAndPassword(email, password)
        .then((userCredential) => {
            const user = userCredential.user;
            // Simpan UID di sessionStorage
            sessionStorage.setItem("uid", user.uid);
            // Redirect ke halaman dashboard.html
            window.location.href = "/dashboard.html";
        })
        .catch((error) => {
            alert("Login gagal: " + error.message);
        });
}

window.handleLogin = handleLogin;
