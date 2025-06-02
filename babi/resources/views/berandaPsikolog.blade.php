<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TeluSafe Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
      margin: 0;
      padding: 0;
    }
    body {
      background: #F9FAFB;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .page-header {
      background: #FFFFFF;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 1px 3px rgba(0,0,0,0.05);
      position: sticky;
      top: 0;
      z-index: 1000;
    }
    .telusafe-main-logo {
      height: 40px;
    }
    .profile {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .profile img {
      border-radius: 50%;
      width: 40px;
      height: 40px;
      object-fit: cover;
    }
    .profile-info strong {
      font-size: 14px;
      color: #1F2937;
    }
    .profile-info small {
      font-size: 12px;
      color: #6B7280;
    }

    .page-content {
      display: flex;
      flex: 1;
    }

    .sidebar {
      background: #B40000;
      color: white;
      width: 240px;
      padding: 25px 20px;
      display: flex;
      flex-direction: column;
      gap: 30px; 
      height: calc(100vh - 70px); 
      position: sticky;
      top: 70px; 
    }

    .sidebar nav a {
      color: white;
      text-decoration: none;
      display: flex;
      align-items: center;
      font-size: 15px;
      padding: 10px 15px;
      margin-bottom: 10px;
      border-radius: 8px;
      transition: background-color 0.2s ease;
      width: 100%;
    }

    .sidebar nav a .menu-icon {
      width: 20px;
      height: 20px;
      flex-shrink: 0; 
    }
    
    .sidebar nav > a { 
        gap: 12px;
    }

    .sidebar nav .menu-item.has-submenu > .menu-link { 
      justify-content: space-between;
      cursor: pointer;
    }

    .menu-link-main-content { 
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .sidebar nav .menu-link .arrow {
      font-size: 12px;
      transition: transform 0.3s ease;
      margin-left: 5px; 
    }

    .sidebar nav .submenu .submenu-item { 
      font-size: 14px;
      padding: 8px 15px 8px 10px;
      gap: 12px; 
    }

    .sidebar nav .submenu {
      display: none;
      padding-left: 20px; 
      margin-top: 5px; 
    }

    .sidebar nav .menu-item.submenu-open .submenu {
      display: block;
    }
    .sidebar nav .menu-item.submenu-open .menu-link .arrow {
      transform: rotate(180deg);
    }

    .sidebar nav a:hover {
      background-color: rgba(255, 255, 255, 0.1);
    }

    .sidebar nav a.active {
      background-color: rgba(255, 255, 255, 0.15);
      font-weight: 600;
    }
    
    .sidebar nav .menu-item.submenu-open .menu-link.parent-active {
      background-color: rgba(255,255,255,0.1); 
      font-weight: 500; 
    }
    .logout {
      margin-top: auto;
      color: white;
      background: transparent;
      border: none;
      font-size: 15px;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 15px;
      border-radius: 8px;
      transition: background-color 0.2s ease;
    }
    .logout:hover {
      background-color: rgba(255, 255, 255, 0.1);
    }
    .logout img { /* Ikon logout juga bisa pakai class .menu-icon jika ingin konsisten */
      width: 20px;
      height: 20px;
    }

    /* Wrapper untuk main content dan news */
    .main-area-wrapper {
      flex: 1;
      display: flex;
      padding: 25px;
      gap: 25px;
      overflow-y: auto;
    }

    .main {
      flex: 3;
      display: flex;
      flex-direction: column;
      gap: 25px;
    }
    .main-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .search {
      width: 100%;
      padding: 12px 20px;
      border-radius: 25px;
      border: 1px solid #E5E7EB;
      font-size: 14px;
      background-color: #FFFFFF;
    }
    .search:focus {
      outline: none;
      border-color: #B40000;
      box-shadow: 0 0 0 2px rgba(180, 0, 0, 0.2);
    }

    .card {
      background: white;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.07);
    }
    .greeting {
      background: #D11919;
      color: white;
      border-radius: 12px;
      padding: 25px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .greeting-text h2 {
      font-size: 24px;
      font-weight: 600;
      margin-bottom: 4px;
    }
    .greeting-text p {
      font-size: 14px;
      opacity: 0.9;
    }
    .greeting-text small {
      display: block;
      margin-bottom: 12px;
      font-size: 13px;
      opacity: 0.8;
    }
    .greeting img.avatar {
      width: 110px;
      height: auto;
    }

    .status-konseling {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
      gap: 20px;
    }
    .status-card {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      gap: 8px;
    }
    .status-card img {
      width: 36px;
      height: 36px;
      margin-bottom: 8px;
    }
    .status-card h3 {
      font-size: 28px;
      font-weight: 700;
      color: #B40000;
    }
    .status-card p {
      font-size: 14px;
      color: #4B5563;
    }
    .status-card.jadwal p:first-of-type {
      font-size: 14px;
      color: #1F2937;
      font-weight: 600;
      margin-bottom: 4px;
    }
    .status-card.jadwal h3 {
      font-size: 16px;
      color: #1F2937;
      font-weight: 600;
    }

    .bottom-section {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
    }

    .news {
      background: white;
      border-radius: 12px;
      padding: 20px;
      display: flex;
      flex-direction: column;
      gap: 12px;
      width: 280px;
      height: fit-content;
      box-shadow: 0 4px 12px rgba(0,0,0,0.07);
    }
    .news h4 {
      font-size: 16px;
      font-weight: 600;
      color: #1F2937;
      margin-bottom: 5px;
    }
    .news img.berita-thumbnail {
      border-radius: 8px;
      width: 100%;
      height: auto;
      object-fit: cover;
    }
    .news p strong {
      font-size: 14px;
      color: #1F2937;
      display: block;
      margin-bottom: 2px;
    }
    .news p {
      font-size: 12px;
      color: #6B7280;
    }

    @media (max-width: 1024px) {
      .main-area-wrapper {
        flex-direction: column;
      }
      .news {
        width: 100%;
      }
      .status-konseling, .bottom-section {
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
      }
    }
    @media (max-width: 768px) {
      .page-header {
        padding: 15px;
      }
      .telusafe-main-logo {
        height: 30px;
      }
      .profile-info strong {
        display: none;
      }
      .page-content {
        flex-direction: column;
      }
      .sidebar {
        width: 100%;
        height: auto;
        position: static;
        flex-direction: row;
        overflow-x: auto;  
        align-items: center;
        padding: 10px;     
        gap: 10px;         
      }
      .sidebar nav {
        display: flex;     
        gap: 5px;         
        flex-shrink: 0;   
      }
      .sidebar nav .menu-item, .sidebar nav > a {
        margin-bottom: 0; 
      }
      .sidebar nav a { 
         padding: 8px 10px;
         font-size: 13px;
         margin-bottom: 0; 
      }
       .sidebar nav a .menu-icon {
         width: 18px; 
         height: 18px;
      }
      .sidebar nav .submenu {
          position: absolute; 
          background-color: #B40000;
          box-shadow: 0 2px 5px rgba(0,0,0,0.2);
          border-radius: 0 0 8px 8px;
          z-index: 100;
          margin-top: 0;
          padding-left: 0;
          min-width: 150px;
      }
       .sidebar nav .submenu .submenu-item {
          padding: 10px 15px; 
      }

      .sidebar .logout {
        margin-top: 0;
        margin-left: auto; 
        padding: 8px 10px; 
      }
      .main-area-wrapper {
        padding: 15px;
        gap: 15px;
      }
      .greeting {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
      }
      .greeting img.avatar {
        width: 80px;
        align-self: center;
      }
    }
  </style>
</head>
<body>
  <header class="page-header">
    <img src="assets/webpsikolog/Logo.png" alt="TeluSafe Logo" class="telusafe-main-logo">
    <div class="profile">
      <img src="assets/webpsikolog/profil.png" alt="Profile">
      <div class="profile-info">
        <strong id="nama-header">John Doe</strong><br>
        <small id="staus-header">3rd year</small>
      </div>
    </div>
  </header>

  <div class="page-content">
    <aside class="sidebar">
      <nav>
        <a href="#" class="active"><img src="assets/webpsikolog/Beranda.png" alt="Beranda Icon" class="menu-icon"> Beranda</a>

        <div class="menu-item has-submenu">
          <a href="/konseling" class="menu-link bk-link">
            <span class="menu-link-main-content">
              <img src="assets/webpsikolog/BK.png" alt="BK Icon" class="menu-icon"> BK
            </span>
            <span class="arrow">&#9662;</span>
          </a>
          <div class="submenu">
            <a href="/caripasien" class="submenu-item"> <img src="assets/webpsikolog/cariPasien.png" alt="Cari Pasien Icon" class="menu-icon"> Cari Pasien
            </a>
          </div>
        </div>

        <a href="/jadwalpsikolog"><img src="assets/webpsikolog/Jadwal.png" alt="Jadwal Icon" class="menu-icon"> Jadwal</a>
      </nav>
      <button class="logout"><img src="assets/webpsikolog/logout.png" alt="Logout Icon" onclick="logout()"> Logout</button>
    </aside>

    <div class="main-area-wrapper">
      <main class="main">

        <div class="greeting card">
  <div class="greeting-text">
    <small id="today-date">...</small>
    <h2 id="nama-user">Halo Psikolog!</h2>
    <p>Always stay updated in your student portal</p>
  </div>
  <img src="assets/webpsikolog/avatar.png" alt="Avatar" class="avatar">
</div>


        <div class="status-konseling">
  <div class="card status-card">
    <img src="assets/webpsikolog/baru.png" alt="Baru">
    <h3 id="jumlahBaru">0</h3>
    <p>Baru</p>
  </div>
  <div class="card status-card">
    <img src="assets/webpsikolog/lanjutan.png" alt="Lanjutan">
    <h3 id="jumlahLanjut">0</h3>
    <p>Lanjutan</p>
  </div>
  <div class="card status-card">
    <img src="assets/webpsikolog/selesai.png" alt="Selesai">
    <h3 id="jumlahSelesai">0</h3>
    <p>Selesai</p>
  </div>
</div>

<div class="bottom-section">
  <div class="card status-card">
    <img src="assets/webpsikolog/ikonpasien.png" alt="Jumlah Pasien">
    <h3 id="jumlahPasien">0</h3>
    <p>Jumlah Mahasiswa</p>
  </div>
  <div class="card status-card jadwal">
    <img src="assets/webpsikolog/jadwalTerdekat.png" alt="Jadwal Terdekat">
    <p>Jadwal Konseling Terdekat</p>
    <h3 id="jadwalTerdekat">-</h3>
  </div>
</div>

      </main>

        <a href="https://studentaffairs.telkomuniversity.ac.id/konseling-gratis-untuk-mahasiswa-telkom-university/" target="_blank" style="text-decoration: none; color: inherit;">
            <aside class="news">
                <h4>Berita Telkom University</h4>
                <img src="assets/webpsikolog/berita.png" alt="Berita Thumbnail" class="berita-thumbnail">
                <p><strong>Begini Cara Menggunakan Layanan BK</strong></p>
                <p>(Whatsapp Only)</p>
            </aside>
        </a>

    </div>
  </div>
  <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-app-compat.js"></script>    
  <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-auth-compat.js"></script>
  <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-database-compat.js"></script>
  <script src="{{ asset('js/configurasi-firebase.js') }}"></script>
  <script> 
  let userid = null;

  // Menunggu user login
  firebase.auth().onAuthStateChanged((user) => {
    if (user) {
      userid = user.uid;
      ambilNamaLengkap(userid);
    }
  });

  function ambilNamaLengkap(uid) {
    const userRef = firebase.database().ref('users/' + uid);

    userRef.once('value')
      .then(snapshot => {
        const data = snapshot.val();
        const namaLengkap = data?.nama_lengkap || "Dokter";
        const status = data?.status || "Mahasiswa";
        hitungStatusKonseling(namaLengkap);

        // Update ke elemen HTML
        document.getElementById('nama-user').innerText = "Halo Psikolog, " + namaLengkap + "!";
        document.getElementById('nama-header').innerText = namaLengkap;
        document.getElementById('staus-header').innerText = status;
      })
      .catch(error => {
        console.error("Gagal mengambil data user:", error);
      });
  }

  // Tambahan opsional: tampilkan tanggal hari ini
  const today = new Date();
  const options = { year: 'numeric', month: 'long', day: 'numeric' };
  document.getElementById('today-date').innerText = today.toLocaleDateString('id-ID', options);

    document.querySelectorAll('.menu-item.has-submenu > .menu-link').forEach(link => {
        link.addEventListener('click', function() {
        const parentItem = this.parentElement;
        parentItem.classList.toggle('submenu-open');
        });

    });

    function hitungStatusKonseling(namaPsikolog) {
    const ref = firebase.database().ref('jadwal_konseling');
    
    ref.once('value', (snapshot) => {
      const data = snapshot.val();
      if (!data) return;

      let baru = 0, lanjut = 0, selesai = 0;
      const pasienSet = new Set();
      let tanggalTerdekat = null;

      Object.values(data).forEach(item => {
        if (item.psikolog === namaPsikolog) {
          // Hitung jenis kunjungan
          if (item.jenis_kunjungan === "baru") baru++;
          else if (item.jenis_kunjungan === "lanjut") lanjut++;
          else if (item.jenis_kunjungan === "selesai") selesai++;

          // Tambahkan userId ke Set
          if (item.userId) {
            pasienSet.add(item.userId);
          }

          // Cek untuk jadwal terdekat
          if (item.tanggal) {
  // Format dd-mm-yyyy
  const [day, month, year] = item.tanggal.split('-').map(Number);
  const tgl = new Date(year, month - 1, day);
  const now = new Date();
  
  if (tgl >= now && (!tanggalTerdekat || tgl < tanggalTerdekat)) {
    tanggalTerdekat = tgl;
  }
}
        }
      });

      // Tampilkan hasil di elemen HTML
      document.getElementById("jumlahBaru").innerText = baru;
      document.getElementById("jumlahLanjut").innerText = lanjut;
      document.getElementById("jumlahSelesai").innerText = selesai;
      document.getElementById("jumlahPasien").innerText = pasienSet.size;
      document.getElementById("jadwalTerdekat").innerText = tanggalTerdekat
        ? tanggalTerdekat.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' })
        : "-";
    });
  }
  function logout(){
    firebase.auth().signOut()
            .then(() => {
        // Hapus sessionStorage atau localStorage yang digunakan
                sessionStorage.clear(); // atau sessionStorage.removeItem('uid') jika hanya satu
            // Redirect ke halaman login atau homepage
                    window.location.href = '/login';
            })
            .catch((error) => {
                console.error('Logout gagal:', error);
            });
  }
  </script>

</body>
</html>