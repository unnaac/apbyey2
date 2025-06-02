<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard</title>
  <!-- Firebase SDK -->
  <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-app-compat.js"></script>
  <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-auth-compat.js"></script>
  <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-database-compat.js"></script>
  <script src="js/configurasi-firebase.js"></script> <!-- konfigurasi firebase kamu -->
</head>
<body>
  <h1>Dashboard</h1>
  <p>Your UID is:</p>
  <pre id="uidDisplay"></pre>

  <h2>Data User dari Realtime Database:</h2>
  <pre id="userDataDisplay">Memuat data...</pre>

  <button id="logoutBtn">Logout</button>

  <script>
    const uid = sessionStorage.getItem('uid');
    if (!uid) {
      window.location.href = '/';
    } else {
      document.getElementById('uidDisplay').textContent = uid;

      // Ambil data user dari Realtime Database
      const db = firebase.database();
      const userRef = db.ref('users/' + uid);

      userRef.once('value')
        .then((snapshot) => {
          if (snapshot.exists()) {
            const data = snapshot.val();
            document.getElementById('userDataDisplay').textContent = JSON.stringify(data, null, 2);
          } else {
            document.getElementById('userDataDisplay').textContent = 'Data user tidak ditemukan.';
          }
        })
        .catch((error) => {
          document.getElementById('userDataDisplay').textContent = 'Error saat mengambil data: ' + error.message;
        });
    }

    // Logout function
    document.getElementById('logoutBtn').addEventListener('click', () => {
      firebase.auth().signOut()
      .then(() => {
        sessionStorage.removeItem('uid');
        window.location.href = '/';
      })
      .catch((error) => {
        alert('Logout gagal: ' + error.message);
      });
    });
  </script>
</body>
</html>
