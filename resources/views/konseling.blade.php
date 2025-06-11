<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TeluSafe Dashboard - Daftar Konseling</title>
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

    /* Header Utama Halaman */
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

    /* Kontainer untuk Sidebar dan Area Utama */
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

    /* --- STYLING NAVIGASI SIDEBAR --- */
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
    /* --- AKHIR STYLING NAVIGASI SIDEBAR --- */

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
    .logout img {
      width: 20px;
      height: 20px;
    }

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
    }
    .greeting-text h2 { font-size: 24px; font-weight: 600; margin-bottom: 4px; }
    .greeting-text p { font-size: 14px; opacity: 0.9; }
    .greeting-text small { display: block; margin-bottom: 12px; font-size: 13px; opacity: 0.8; }
    .greeting .greeting-content { display: flex; justify-content: space-between; align-items: center; }
    .greeting img.avatar { width: 110px; height: auto; margin-left: 20px; }
    
    /* Bagian Daftar Konseling */
    .konseling-section { /* Tidak perlu margin-top spesifik jika .main sudah punya gap */ }
    .section-title {
      font-size: 20px;
      font-weight: 600;
      color: #1F2937;
      margin-bottom: 15px;
    }
    .konseling-list.card {
      padding: 0;
    }
    .patient-item {
      padding: 20px;
      border-bottom: 1px solid #E5E7EB;
    }
    .patient-item:last-child {
      border-bottom: none;
    }
    .patient-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 8px;
    }
    .patient-name {
      font-size: 16px;
      font-weight: 600;
      color: #111827;
    }

    .status-badge {
      display: inline-block;
      padding: 7px 18px;
      font-size: 12px;
      font-weight: 500;
      border-radius: 20px; 
      line-height: 1.2; 
      text-align: center;
      vertical-align: middle;
      color: white;
      border-width: 1px; 
      border-style: solid; 
    }
    .status-baru { 
      background-color: #3B82F6; 
      border-color: #3B82F6; 
    }
    .status-lanjut { 
      background-color: #F59E0B; 
      border-color: #F59E0B; 
    }
    .status-selesai { 
      background-color: #10B981; 
      border-color: #10B981; 
    }

    .patient-details-list {
      list-style-position: outside;
      padding-left: 18px;
      margin-top: 10px;
      margin-bottom: 16px;
      font-size: 13px;
      color: #6B7280;
    }
    .patient-details-list li {
      margin-bottom: 5px;
      line-height: 1.4;
    }
    .patient-details-placeholder {
        margin-top: 10px;
        margin-bottom: 16px;
        padding-left: 18px;
        font-size: 13px;
        color: #6B7280;
        line-height: 1.4;
        min-height: calc(13px * 1.4); 
    }

    .patient-actions {
      text-align: right;
      margin-top: 12px;
    }
    .btn-lihat-detail {
      display: inline-block;
      padding: 7px 18px;
      font-size: 12px;
      font-weight: 500;
      border-radius: 20px;
      line-height: 1.2;
      text-align: center;
      vertical-align: middle;
      
      color: #4B5563;
      background-color: #FFFFFF;
      border: 1px solid #D1D5DB;
      text-decoration: none;
      transition: all 0.2s ease;
      cursor: pointer;
    }
    .btn-lihat-detail:hover {
      background-color: #F3F4F6;
      border-color: #9CA3AF;
      color: #1F2937;
    }

    /* News Section */
    .news { background: white; border-radius: 12px; padding: 20px; display: flex; flex-direction: column; gap: 12px; width: 280px; height: fit-content; box-shadow: 0 4px 12px rgba(0,0,0,0.07); }
    .news h4 { font-size: 16px; font-weight: 600; color: #1F2937; margin-bottom: 5px; }
    .news img.berita-thumbnail { border-radius: 8px; width: 100%; height: auto; object-fit: cover; }
    .news p strong { font-size: 14px; color: #1F2937; display: block; margin-bottom: 2px; }
    .news p { font-size: 12px; color: #6B7280; }

    /* Responsive adjustments */
    @media (max-width: 1024px) {
      .main-area-wrapper { flex-direction: column; }
      .news { width: 100%; }
    }
    @media (max-width: 768px) {
      .page-header { padding: 15px; }
      .telusafe-main-logo { height: 30px; }
      .profile-info strong { display: none; }
      .page-content { flex-direction: column; }
      .sidebar { width: 100%; height: auto; position: static; flex-direction: row; overflow-x: auto; align-items: center; padding: 10px; gap: 10px; }
      .sidebar nav { display: flex; gap: 5px; flex-shrink: 0; }
      .sidebar nav .menu-item, .sidebar nav > a { margin-bottom: 0; }
      .sidebar nav a { padding: 8px 10px; font-size: 13px; margin-bottom: 0; }
      .sidebar nav a .menu-icon { width: 18px; height: 18px; }
      .sidebar nav .submenu { position: absolute; background-color: #B40000; box-shadow: 0 2px 5px rgba(0,0,0,0.2); border-radius: 0 0 8px 8px; z-index: 100; margin-top: 0; padding-left: 0; min-width: 150px; }
      .sidebar nav .submenu .submenu-item { padding: 10px 15px; }
      .sidebar .logout { margin-top: 0; margin-left: auto; padding: 8px 10px; }
      .main-area-wrapper { padding: 15px; gap: 15px; }
      .greeting .greeting-content { flex-direction: column; align-items: flex-start; gap:15px;}
      .greeting img.avatar { align-self: center; }
      .patient-header { flex-direction: column; align-items: flex-start; gap: 8px; }
      .status-badge { align-self: flex-start; margin-top: 4px; }
    }
  </style>
</head>
<body>
  <header class="page-header">
    <img src="assets/webpsikolog/Logo.png" alt="TeluSafe Logo" class="telusafe-main-logo">
    <div class="profile">
      <img src="assets/webpsikolog/profil.png" alt="Profile">
      <div class="profile-info">
        <strong id="nama-header">Shinta</strong>
        <small  id="staus-header">3rd year</small>
      </div>
    </div>
  </header>

  <div class="page-content">
    <aside class="sidebar">
      <nav>
        <a href="/halaman"><img src="assets/webpsikolog/Beranda.png" alt="Beranda Icon" class="menu-icon"> Beranda</a>
        <div class="menu-item has-submenu">
          <a href="#" class="menu-link bk-link active"> 
            <span class="menu-link-main-content">
              <img src="assets/webpsikolog/BK.png" alt="BK Icon" class="menu-icon"> BK
            </span>
            <span class="arrow">&#9662;</span>
          </a>
          <div class="submenu">
            <a href="/caripasien" class="submenu-item"> 
              <img src="assets/webpsikolog/cariPasien.png" alt="Cari Pasien Icon" class="menu-icon"> Cari Pasien
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
          <div class="greeting-content">
            <div class="greeting-text">
              <small id="today-date">...</small>
    <h2 id="nama-user">Halo Psikolog!</h2>
              <p>Always stay updated in your student portal</p>
            </div>
            <img src="assets/webpsikolog/avatar.png" alt="Avatar" class="avatar">
          </div>
        </div>

        <div class="konseling-section">
          <h2 class="section-title">Daftar Konseling</h2>
          <div class="konseling-list card">
            <div class="patient-item">
              <div class="patient-header">
                <h3 class="patient-name">Keana Ferdinan</h3>
                <span class="status-badge status-baru">Baru</span>
              </div>
              <div class="patient-details-placeholder">-</div>
              <div class="patient-actions">
                <a href="/detailkonseling" class="btn-lihat-detail">Lihat Detail</a>
              </div>
            </div>

            <div class="patient-item">
              <div class="patient-header">
                <h3 class="patient-name">Rifqi Sigwan</h3>
                <span class="status-badge status-lanjut">Lanjut</span>
              </div>
              <ul class="patient-details-list">
                <li>Tumbuh kembang anak & remaja</li>
                <li>Perlindungan & pencegahan kekerasan</li>
                <li>Pemilihan karir</li>
              </ul>
              <div class="patient-actions">
                <a href="detailkonseling.html" class="btn-lihat-detail">Lihat Detail</a>
              </div>
            </div>

            <div class="patient-item">
              <div class="patient-header">
                <h3 class="patient-name">Raul Mahmud</h3>
                <span class="status-badge status-selesai">Selesai</span>
              </div>
              <ul class="patient-details-list">
                  <li>Tumbuh kembang anak & remaja</li>
                  <li>Perlindungan & pencegahan kekerasan</li>
                  <li>Pemilihan karir</li>
              </ul>
              <div class="patient-actions">
                <a href="detailkonseling.html" class="btn-lihat-detail">Lihat Detail</a>
              </div>
            </div>
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
  <script src="js/configurasi-firebase.js"></script>
  <script>
    let userid = null;
    const today = new Date();
  const options = { year: 'numeric', month: 'long', day: 'numeric' };
  document.getElementById('today-date').innerText = today.toLocaleDateString('id-ID', options);
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
        tampilkanJadwalKonseling(namaLengkap);
        // Update ke elemen HTML
        document.getElementById('nama-user').innerText = "Halo Psikolog, " + namaLengkap + "!";
        document.getElementById('nama-header').innerText = namaLengkap;
        document.getElementById('staus-header').innerText = status;
      })
      .catch(error => {
        console.error("Gagal mengambil data user:", error);
      });
  } 

    document.addEventListener('DOMContentLoaded', function() {
      const submenuItems = document.querySelectorAll('.sidebar .menu-item.has-submenu');
      submenuItems.forEach(item => {
        const menuLink = item.querySelector('.menu-link');
        if (menuLink) {
          menuLink.addEventListener('click', function(event) {
            event.preventDefault(); 
            const parentItem = this.closest('.menu-item');
            parentItem.classList.toggle('submenu-open');
            const activeSubmenuItem = parentItem.querySelector('.submenu-item.active');
            if (parentItem.classList.contains('submenu-open') && activeSubmenuItem) {
              this.classList.add('parent-active');
            } else {
              this.classList.remove('parent-active');
            }
          });
        }
        const activeSubmenuItemOnLoad = item.querySelector('.submenu-item.active');
        if (activeSubmenuItemOnLoad) {
          item.classList.add('submenu-open');
          if (menuLink) {
            menuLink.classList.add('parent-active');
          }
        }
      });
    });

    function logout() {
  firebase.auth().signOut().then(() => {
    window.location.href = '/login'; // Ganti dengan URL halaman login Anda
  }).catch((error) => {
    console.error('Error signing out:', error);
  });
}

    function tampilkanJadwalKonseling(namalengkap) {
    // Reference to the jadwal_konseling node
    const dbRef = firebase.database().ref('jadwal_konseling');
    // Reference to the users node (for fetching patient names)
    const userRef = firebase.database().ref('users');
    const container = document.querySelector('.konseling-list');

    if (!container) return; // Ensure the container exists
    container.innerHTML = ''; // Clear previous content

    // Use orderByChild and equalTo to query only relevant data
    dbRef.orderByChild('psikolog').equalTo(namalengkap).once('value')
        .then(async (snapshot) => {
            let adaData = false;
            const promises = [];

            // Check if any data exists for the given psychologist
            if (snapshot.exists()) {
                adaData = true;
                snapshot.forEach((child) => {
                    const data = child.val();
                    const id = child.key; // Get the ID of the counseling session

                    const jenisKunjungan = (data.jenis_kunjungan || 'baru').toLowerCase();
                    // Ensure 'topik' is always an array; if it's a string, split it by comma
                    const topikList = Array.isArray(data.keluhan) ? data.keluhan : (typeof data.keluhan === 'string' ? data.keluhan.split(',').map(t => t.trim()).filter(t => t !== '') : []);
                  

                    // Push a promise to fetch user data for each session
                    const userPromise = userRef.child(data.userId).once('value').then((userSnap) => {
                        const userData = userSnap.val();
                        const namaPasien = userData?.username || 'Tidak diketahui';
                        if (data.psikolog === namalengkap) {
                            // If the session is for the logged-in psychologist, proceed to display it
                            let topikHTML = '<div class="patient-details-placeholder">-</div>';
                        // Only show topics if relevant types or if there are actual topics
                        if (topikList.length > 0) { // Removed unnecessary checks for 'lanjut' or 'selesai' to display topics always if available
                            topikHTML = `
                                <ul class="patient-details-list">
                                    ${topikList.map(t => `<li>${t}</li>`).join('')}
                                </ul>`;
                        }

                        // Build the HTML for each patient item
                        const itemHTML = `
                            <div class="patient-item">
                                <div class="patient-header">
                                    <h3 class="patient-name">${namaPasien}</h3>
                                    <span class="status-badge status-${jenisKunjungan}">
                                        ${jenisKunjungan.charAt(0).toUpperCase() + jenisKunjungan.slice(1)}
                                    </span>
                                </div>
                                ${topikHTML}
                                <div class="patient-actions">
                                    <a href="/detailkonseling?id=${id}" class="btn-lihat-detail">Lihat Detail</a>
                                </div>
                            </div>
                        `;

                        // Add the HTML to the container
                        container.insertAdjacentHTML('beforeend', itemHTML);
                        }
                        
                    });

                    promises.push(userPromise);
                });
            }

            // Wait for all user data fetches to complete
            await Promise.all(promises);

            // If no data found after the query
            if (!adaData) {
                container.innerHTML = `
                    <div class="patient-item">
                        <div class="patient-details-placeholder">Belum ada jadwal konseling.</div>
                    </div>`;
            }
        })
        .catch((error) => {
            // Handle any errors during data fetching
            container.innerHTML = `
                <div class="patient-item">
                    <div class="patient-details-placeholder">Gagal memuat data konseling.</div>
                </div>`;
            console.error('Failed to retrieve counseling schedule data:', error);
        });
}

    
  </script>
</body>
</html>