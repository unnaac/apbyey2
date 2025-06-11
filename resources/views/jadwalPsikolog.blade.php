<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TeluSafe Dashboard - Jadwal</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css">
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
      margin: 0;
      padding: 0;
    }
    body {
      background: #F9FAFB; display: flex; flex-direction: column; min-height: 100vh;
    }

    .page-header {
      background: #FFFFFF; padding: 15px 30px; display: flex;
      justify-content: space-between; align-items: center;
      box-shadow: 0 1px 3px rgba(0,0,0,0.05); position: sticky; top: 0; z-index: 1000;
    }
    .telusafe-main-logo { height: 40px; }
    .profile { display: flex; align-items: center; gap: 10px; }
    .profile img { border-radius: 50%; width: 40px; height: 40px; object-fit: cover; }
    .profile-info strong { font-size: 14px; color: #1F2937; }
    .profile-info small { font-size: 12px; color: #6B7280; }
    .page-content { display: flex; flex: 1; }
    .sidebar {
      background: #B40000; color: white; width: 240px; padding: 25px 20px;
      display: flex; flex-direction: column; gap: 30px; 
      height: calc(100vh - 70px); position: sticky; top: 70px;
    }
    .sidebar nav a {
      color: white; text-decoration: none; display: flex; align-items: center;
      font-size: 15px; padding: 10px 15px; margin-bottom: 10px;
      border-radius: 8px; transition: background-color 0.2s ease; width: 100%;
    }
    .sidebar nav a .menu-icon { width: 20px; height: 20px; flex-shrink: 0; }
    .sidebar nav > a:not(.menu-link) { gap: 12px; }
     .sidebar nav .menu-item > a.menu-link { gap: 0;} 

    .sidebar nav .menu-item.has-submenu > .menu-link { justify-content: space-between; cursor: pointer; }
    .menu-link-main-content { display: flex; align-items: center; gap: 12px; }
    .sidebar nav .menu-link .arrow { font-size: 12px; transition: transform 0.3s ease; margin-left: 5px; }
    .sidebar nav .submenu .submenu-item { font-size: 14px; padding: 8px 15px 8px 10px; gap: 12px; }
    .sidebar nav .submenu { display: none; padding-left: 20px; margin-top: 5px; }
    .sidebar nav .menu-item.submenu-open .submenu { display: block; }
    .sidebar nav .menu-item.submenu-open .menu-link .arrow { transform: rotate(180deg); }
    .sidebar nav a:hover { background-color: rgba(255, 255, 255, 0.1); }
    .sidebar nav a.active { background-color: rgba(255, 255, 255, 0.15); font-weight: 600; }
    .sidebar nav .menu-item.submenu-open .menu-link.parent-active { background-color: rgba(255,255,255,0.08);}
    .logout {
      margin-top: auto; color: white; background: transparent; border: none;
      font-size: 15px; cursor: pointer; display: flex; align-items: center;
      gap: 12px; padding: 10px 15px; border-radius: 8px; transition: background-color 0.2s ease;
    }
    .logout:hover { background-color: rgba(255, 255, 255, 0.1); }
    .logout img { width: 20px; height: 20px; }

    .main-area-wrapper { flex: 1; display: flex; padding: 25px; gap: 25px; overflow-y: auto; }
    .main { flex: 3; display: flex; flex-direction: column; gap: 25px; }
    .main-header { display: flex; justify-content: space-between; align-items: center; }
    .search {
      width: 100%; padding: 12px 20px; border-radius: 25px;
      border: 1px solid #E5E7EB; font-size: 14px; background-color: #FFFFFF;
    }
    .search:focus { outline: none; border-color: #B40000; box-shadow: 0 0 0 2px rgba(180, 0, 0, 0.2); }
    .card { background: white; border-radius: 12px; padding: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.07); }
    
    .greeting { background: #D11919; color: white; }
    .greeting .greeting-content { display: flex; justify-content: space-between; align-items: center; }
    .greeting-text h2 { font-size: 24px; font-weight: 600; margin-bottom: 4px; }
    .greeting-text p { font-size: 14px; opacity: 0.9; }
    .greeting-text small { display: block; margin-bottom: 12px; font-size: 13px; opacity: 0.8; }
    .greeting img.avatar { width: 110px; height: auto; margin-left: 20px; }

    /* Jadwal Page Specific Styles */
    .section-title { font-size: 18px; font-weight: 600; color: #1F2937; margin-bottom: 15px; }
    
    .jadwal-terdekat-section .appointment-cards-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); /* Responsif */
        gap: 20px;
    }
    .appointment-card { padding: 15px; }
    .appointment-card .patient-name { font-size: 16px; font-weight: 600; color: #111827; margin-bottom: 12px; }
    .appointment-detail { display: flex; align-items: center; gap: 8px; font-size: 13px; color: #4B5563; margin-bottom: 6px; }
    .appointment-detail .icon { font-size: 14px; color: #6B7280; width: 16px; text-align: center;}

    .cari-jadwal-section.card { padding: 25px; }
    .cari-jadwal-section .section-subtitle { font-size: 13px; color: #6B7280; margin-top: -10px; margin-bottom: 20px; }
    .cari-jadwal-content { display: flex; gap: 25px; align-items: flex-start; }
    .calendar-filter-area { flex: 0 0 280px; /* Lebar tetap untuk area kalender */ }
    
    .mini-calendar-container { background-color: #fff; border-radius: 8px; padding:15px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
    .calendar-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
    .calendar-header h4 { font-size: 15px; font-weight: 600; color: #374151; margin:0; }
    .calendar-nav-btn { background: none; border: none; color: #4B5563; padding: 5px; cursor: pointer; font-size: 18px; }
    .calendar-nav-btn:hover { color: #B40000; }
    .calendar-weekdays-grid, .calendar-dates-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 4px; text-align: center; }
    .calendar-weekdays-grid span { font-size: 11px; font-weight: 500; color: #6B7280; padding: 5px 0; }
    .calendar-date-cell {
        font-size: 12px; padding: 8px 0px; border-radius: 50%; cursor: pointer;
        transition: background-color 0.2s ease, color 0.2s ease; width: 30px; height: 30px;
        display:flex; align-items:center; justify-content:center; margin:auto;
    }
    .calendar-date-cell:hover:not(.other-month):not(.disabled) { background-color: #FEE2E2; color: #B40000; }
    .calendar-date-cell.other-month { color: #D1D5DB; cursor: default; }
    .calendar-date-cell.current-day { font-weight: bold; /*border: 1px solid #B40000; */}
    .calendar-date-cell.selected-day { background-color: #B40000; color: white; }
    
    .selected-datetime-display { margin-top: 15px; font-size: 13px; color: #4B5563; }
    .selected-datetime-display span { display: block; margin-bottom: 5px; }
    #miniCalSelectedTime { font-weight: 500; color: #1F2937; }
    
    .btn {
      padding: 9px 18px; font-size: 13px; font-weight: 500; border-radius: 6px;
      cursor: pointer; border: none; transition: all 0.2s ease; width: 100%; margin-top: 15px;
    }
    .btn-pilih { background-color: #B40000; color: white; }
    .btn-pilih:hover { background-color: #990000; }

    .schedule-table-area { flex: 1; }
    .table-responsive { overflow-x: auto; }
    .schedule-table { width: 100%; border-collapse: collapse; font-size: 13px; }
    .schedule-table th, .schedule-table td {
        padding: 10px 12px; text-align: left; border-bottom: 1px solid #E5E7EB; white-space: nowrap;
    }
    .schedule-table th { background-color: #F9FAFB; font-weight: 500; color: #6B7280; font-size:12px; text-transform: uppercase; }
    .schedule-table td:first-child { font-weight: 500; color: #374151;}

    /* News Section */
    .news { background: white; border-radius: 12px; padding: 20px; display: flex; flex-direction: column; gap: 12px; width: 280px; height: fit-content; box-shadow: 0 4px 12px rgba(0,0,0,0.07); }
    .news h4 { font-size: 16px; font-weight: 600; color: #1F2937; margin-bottom: 5px; }
    .news img.berita-thumbnail { border-radius: 8px; width: 100%; height: auto; object-fit: cover; }
    .news p strong { font-size: 14px; color: #1F2937; display: block; margin-bottom: 2px; }
    .news p { font-size: 12px; color: #6B7280; }

    @media (max-width: 1200px) { /* Adjust breakpoint if needed */
      .cari-jadwal-content { flex-direction: column; }
      .calendar-filter-area { flex: 0 0 auto; width: 100%; margin-bottom: 20px; }
    }
    @media (max-width: 1024px) {
      .main-area-wrapper { flex-direction: column; }
      .news { width: 100%; }
      .jadwal-terdekat-section .appointment-cards-container {grid-template-columns: 1fr;}
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
      .calendar-header h4 { font-size: 14px; }
      .calendar-date-cell { padding: 6px 0px; font-size: 11px; width: 26px; height: 26px;}
      .selected-datetime-display span {font-size: 12px;}
    }
  </style>
</head>
<body>
  <header class="page-header">
    <img src="assets/webPsikolog/Logo.png" alt="TeluSafe Logo" class="telusafe-main-logo">
    <div class="profile">
      <img src="assets/webPsikolog/profil.png" alt="Profile"> <div class="profile-info">
        <strong id="nama-header">John Doe</strong><br>
        <small id="staus-header">3rd year</small>
      </div>
    </div>
  </header>

  <div class="page-content">
    <aside class="sidebar">
      <nav>
        <a href="/halaman"><img src="assets/webPsikolog/Beranda.png" alt="Beranda Icon" class="menu-icon"> Beranda</a>
        <div class="menu-item has-submenu submenu-open"> <a href="#" class="menu-link bk-link parent-active"> <span class="menu-link-main-content">
              <img src="assets/webPsikolog/BK.png" alt="BK Icon" class="menu-icon"> BK
            </span>
            <span class="arrow">&#9662;</span>
          </a>
          <div class="submenu" style="display: block;"> <a href="/caripasien" class="submenu-item"> 
              <img src="assets/webPsikolog/cariPasien.png" alt="Cari Pasien Icon" class="menu-icon"> Cari Pasien
            </a>
            <a href="/jadwalpsikolog" class="submenu-item active"> <img src="assets/webPsikolog/Jadwal.png" alt="Jadwal Icon" class="menu-icon"> Jadwal
            </a>
          </div>
        </div>
        </nav>
      <button class="logout"><img src="assets/webPsikolog/logout.png" alt="Logout Icon" onclick="logout()"> Logout</button>
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
            <img src="assets/webPsikolog/avatar.png" alt="Avatar" class="avatar"> </div>
        </div>

        <div class="jadwal-terdekat-section">
            <h2 class="section-title">Jadwal Konseling Terdekat</h2>
            <div class="appointment-cards-container" id="appointmentCardsContainer">
                <div   class="appointment-card card">
                    <h3 class="patient-name">Keano Ferdinan</h3>
                    <div class="appointment-detail"><i class="icon icon-calendar"></i> Senin, 14 April 2025</div>
                    <div class="appointment-detail"><i class="icon icon-clock"></i> 08.00 - 10.00 WIB</div>
                    <div class="appointment-detail"><i class="icon icon-location-pin"></i> Luring</div>
                    <div class="appointment-detail"><i class="icon icon-tag"></i> Baru</div>
                </div>
                <div class="appointment-card card">
                    <h3 class="patient-name">Rafi Sigwan</h3>
                    <div class="appointment-detail"><i class="icon icon-calendar"></i> Kamis, 22 Mei 2025</div>
                    <div class="appointment-detail"><i class="icon icon-clock"></i> 08.00 - 10.00 WIB</div>
                    <div class="appointment-detail"><i class="icon icon-screen-desktop"></i> Daring</div> <div class="appointment-detail"><i class="icon icon-tag"></i> Lanjutan</div>
                </div>
            </div>
        </div>

        <div  class="cari-jadwal-section card">
            <h2 class="section-title">Cari Jadwal</h2>
            <p class="section-subtitle">Tanggal dan Waktu</p>
            <div class="cari-jadwal-content">
  <div class="calendar-filter-area">
    <div class="mini-calendar-container">
      <div class="calendar-header">
        <button id="miniPrevMonthBtn" class="calendar-nav-btn" aria-label="Bulan Sebelumnya">&lt;</button>
        <h4 id="miniCurrentMonthYearDisplay"></h4>
        <button id="miniNextMonthBtn" class="calendar-nav-btn" aria-label="Bulan Berikutnya">&gt;</button>
      </div>
      <div class="calendar-weekdays-grid">
        <span>Min</span><span>Sen</span><span>Sel</span><span>Rab</span><span>Kam</span><span>Jum</span><span>Sab</span>
      </div>
      <div class="calendar-dates-grid" id="miniCalendarDatesGrid"></div>
    </div>
    <div class="selected-datetime-display">
      <span id="miniCalSelectedDate"></span>
    </div>
  </div>

  <div class="schedule-table-area table-responsive">
    <table class="schedule-table">
      <thead>
        <tr>
          <th>No</th>
          <th>Tanggal</th>
          <th>Waktu</th>
          <th>Media</th>
          <th>Jenis</th>
          <th>Pasien</th>
        </tr>
      </thead>
      <tbody>
        <!-- Baris jadwal akan di-generate otomatis oleh JS -->
        <tr>
          <td colspan="6" style="text-align:center;">Memuat jadwal...</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

        </div>
      </main>
    <a href="https://studentaffairs.telkomuniversity.ac.id/konseling-gratis-untuk-mahasiswa-telkom-university/" target="_blank" style="text-decoration: none; color: inherit;">
    <aside class="news">
        <h4>Berita Telkom University</h4>
        <img src="assets/webPsikolog/berita.png" alt="Berita Thumbnail" class="berita-thumbnail">
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

  // Menunggu user login
  firebase.auth().onAuthStateChanged((user) => {
    if (user) {
      userid = user.uid;
      ambilNamaLengkap(userid);
    }
  });
let x = null;

function testing(){
  firebase.auth().onAuthStateChanged((user) => {
    if (user) {
      userid = user.uid;
      namalengkap(userid).then(nama => {
        x = nama; // <- ini asynchronous
        console.log("Nama lengkap:", x); // <- ini akan menampilkan nama dengan benar
        console.log(x); // <- ini akan menampilkan nama dengan benar
      });
    }
  });
}

window.onload = testing;


function namalengkap(uid){
  const userRef = firebase.database().ref('users/' + uid);
  return userRef.once('value')
    .then(snapshot => {
      const data = snapshot.val();
      const namaLengkap = data?.nama_lengkap || "Dokter";
      console.log("Nama Berhasil Balik")
      // Update ke elemen HTML
      return namaLengkap;
    })
    .catch(error => {
      console.error("Gagal mengambil data user:", error);
      return "Dokter";
    });
}
      function ambilNamaLengkap(uid) {
    const userRef = firebase.database().ref('users/' + uid);
    const today = new Date();
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    document.getElementById('today-date').innerText = today.toLocaleDateString('id-ID', options);
    userRef.once('value')
      .then(snapshot => {
        const data = snapshot.val();
        const namaLengkap = data?.nama_lengkap || "Dokter";
        const status = data?.status || "Mahasiswa";
        loadJadwalTerdekat(namaLengkap);

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
      // Sidebar Dropdown JS
      const submenuToggleLinks = document.querySelectorAll('.sidebar .menu-item.has-submenu > .menu-link');
      submenuToggleLinks.forEach(link => {
        const parentItem = link.closest('.menu-item.has-submenu');
        // Check for initial active state from HTML classes
        const isActiveParent = parentItem.classList.contains('submenu-open');
        const submenu = parentItem.querySelector('.submenu');
        if (isActiveParent && submenu) {
            submenu.style.display = 'block'; 
        }

        link.addEventListener('click', function(event) {
          event.preventDefault(); 
          if (parentItem) {
            parentItem.classList.toggle('submenu-open');
            if (submenu) {
                submenu.style.display = parentItem.classList.contains('submenu-open') ? 'block' : 'none';
            }
            const activeSubmenuItem = parentItem.querySelector('.submenu-item.active');
            if (parentItem.classList.contains('submenu-open') && activeSubmenuItem) {
                this.classList.add('parent-active');
            } else {
                this.classList.remove('parent-active');
            }
          }
        });
      });

      // Mini Calendar JS
// Ambil elemen-elemen yang dibutuhkan
const miniMonthYearDisplay = document.getElementById('miniCurrentMonthYearDisplay');
const miniDatesGrid = document.getElementById('miniCalendarDatesGrid');
const miniPrevMonthBtn = document.getElementById('miniPrevMonthBtn');
const miniNextMonthBtn = document.getElementById('miniNextMonthBtn');
const miniCalSelectedDateDisplay = document.getElementById('miniCalSelectedDate');
const scheduleTableBody = document.querySelector('.schedule-table tbody');
// const pilihJadwalBtn = document.getElementById('pilihJadwalBtn'); // Kalau belum pakai, bisa di-comment dulu

const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", 
                    "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

let miniCurrentCalDate = new Date();
let miniCurrentlySelectedDateStr = formatDate(miniCurrentCalDate); // format YYYY-MM-DD

// Ganti dengan psikolog yang sedang login
let currentUserId = null; // Ambil dari session atau auth state



function formatDate(date) {
  const y = date.getFullYear();
  const m = String(date.getMonth() + 1).padStart(2, '0');
  const d = String(date.getDate()).padStart(2, '0');
  return `${y}-${m}-${d}`;
}

function formatDateDisplay(date) {
  const d = date.getDate().toString().padStart(2, '0');
  const m = (date.getMonth() + 1).toString().padStart(2, '0');
  const y = date.getFullYear();
  return `${d}/${m}/${y}`;
}

function renderMiniCalendar(date) {
  miniDatesGrid.innerHTML = '';
  const year = date.getFullYear();
  const month = date.getMonth();

  miniMonthYearDisplay.textContent = `${monthNames[month]} ${year}`;

  const firstDayOfMonth = new Date(year, month, 1).getDay(); // Minggu=0, Sen=1 ...
  const daysInMonth = new Date(year, month + 1, 0).getDate();

  // Kosongkan tanggal sebelum hari pertama bulan berjalan (biar posisi tepat)
  for(let i=0; i<firstDayOfMonth; i++) {
    const emptyCell = document.createElement('div');
    emptyCell.classList.add('calendar-date-cell', 'other-month');
    miniDatesGrid.appendChild(emptyCell);
  }

  for(let day=1; day<=daysInMonth; day++) {
    const dateCell = document.createElement('div');
    dateCell.classList.add('calendar-date-cell');
    dateCell.textContent = day;
    const cellDate = new Date(year, month, day);
    const cellDateStr = formatDate(cellDate);
    dateCell.dataset.date = cellDateStr;

    // Tandai hari ini
    const today = new Date();
    if(year === today.getFullYear() && month === today.getMonth() && day === today.getDate()) {
      dateCell.classList.add('current-day');
    }

    // Tandai yang sudah dipilih
    if(cellDateStr === miniCurrentlySelectedDateStr) {
      dateCell.classList.add('selected-day');
    }

    dateCell.addEventListener('click', () => {
      miniDatesGrid.querySelectorAll('.calendar-date-cell.selected-day').forEach(el => el.classList.remove('selected-day'));
      dateCell.classList.add('selected-day');

      miniCurrentlySelectedDateStr = cellDateStr;
      miniCalSelectedDateDisplay.textContent = formatDateDisplay(cellDate);
console.log('Tanggal dipilih:', miniCurrentlySelectedDateStr);
    firebase.auth().onAuthStateChanged((user) => {
    if (user) {
      userid = user.uid;
      namalengkap(userid).then(nama => {
        x = nama; // <- ini asynchronous
        loadJadwalByDateAndPsikolog(miniCurrentlySelectedDateStr, x);
        console.log("Nama lengkap2:", x); // <- ini akan menampilkan nama dengan benar
      });
    }
  });
      
    });

    miniDatesGrid.appendChild(dateCell);
  }
}

function loadJadwalByDateAndPsikolog(selectedDateStr, psikologId) {
  if(!psikologId || !selectedDateStr) return;

  const db = firebase.database();
  const usersRef = db.ref("users");
  const jadwalRef = db.ref("jadwal_konseling");

  Promise.all([
    usersRef.once("value"),
    jadwalRef.once("value")
  ]).then(([usersSnap, jadwalSnap]) => {
    const usersData = usersSnap.val() || {};
    const jadwalData = jadwalSnap.val() || {};

    scheduleTableBody.innerHTML = ''; // Bersihkan tabel

    const filtered = Object.values(jadwalData).filter(item => {
      if(!item.psikolog || !item.tanggal) return false;
      // Konversi tanggal dari DD-MM-YYYY ke YYYY-MM-DD agar bisa dibandingkan
      const [d, m, y] = item.tanggal.split('-');
      const jadwalDateStr = `${y}-${m.padStart(2,'0')}-${d.padStart(2,'0')}`;
      console.log(item.psikolog, psikologId, jadwalDateStr, selectedDateStr);
      return item.psikolog === psikologId && jadwalDateStr === selectedDateStr;
    });

    if(filtered.length === 0) {
      scheduleTableBody.innerHTML = `<tr><td colspan="6" style="text-align:center;">Tidak ada jadwal pada tanggal ini.</td></tr>`;
      return;
    }

    filtered.forEach((item, i) => {
      // Cari nama pasien di users berdasarkan userId
      let pasienNama = "-";
      for(const uid in usersData) {
        if(usersData[uid].uid === item.userId) {
          pasienNama = usersData[uid].username || "-";
          break;
        }
      }

      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${i+1}</td>
        <td>${item.tanggal}</td>
        <td>${item.waktu || '-'}</td>
        <td>${item.media || '-'}</td>
        <td>${item.jenis_kunjungan || '-'}</td>
        <td>${pasienNama}</td>
      `;
      scheduleTableBody.appendChild(row);
    });
  }).catch(err => {
    console.error('Gagal load jadwal:', err);
    scheduleTableBody.innerHTML = `<tr><td colspan="6" style="text-align:center; color:red;">Gagal memuat jadwal.</td></tr>`;
  });
}

// Inisialisasi tampilan awal
miniCalSelectedDateDisplay.textContent = formatDateDisplay(miniCurrentCalDate);
renderMiniCalendar(miniCurrentCalDate);
firebase.auth().onAuthStateChanged((user) => {
    if (user) {
      userid = user.uid;
      namalengkap(userid).then(nama => {
        x = nama; // <- ini asynchronous
        loadJadwalByDateAndPsikolog(miniCurrentlySelectedDateStr, x);
        console.log("Nama lengkap3:", x); // <- ini akan menampilkan nama dengan benar
      });
    }
  });

// Tombol prev/next bulan
miniPrevMonthBtn.addEventListener('click', () => {
  miniCurrentCalDate.setMonth(miniCurrentCalDate.getMonth() - 1);
  renderMiniCalendar(miniCurrentCalDate);

  // Reset tanggal terpilih jika sudah tidak ada di bulan baru
  const year = miniCurrentCalDate.getFullYear();
  const month = miniCurrentCalDate.getMonth();
  const selectedDate = new Date(miniCurrentlySelectedDateStr);
  if (selectedDate.getFullYear() !== year || selectedDate.getMonth() !== month) {
    miniCurrentlySelectedDateStr = formatDate(new Date(year, month, 1));
    miniCalSelectedDateDisplay.textContent = formatDateDisplay(new Date(year, month, 1));
  }

  firebase.auth().onAuthStateChanged((user) => {
    if (user) {
      userid = user.uid;
      namalengkap(userid).then(nama => {
        x = nama; // <- ini asynchronous
        loadJadwalByDateAndPsikolog(miniCurrentlySelectedDateStr, x);
        console.log("Nama lengkap4:", x); // <- ini akan menampilkan nama dengan benar
      });
    }
  });
});

miniNextMonthBtn.addEventListener('click', () => {
  miniCurrentCalDate.setMonth(miniCurrentCalDate.getMonth() + 1);
  renderMiniCalendar(miniCurrentCalDate);

  const year = miniCurrentCalDate.getFullYear();
  const month = miniCurrentCalDate.getMonth();
  const selectedDate = new Date(miniCurrentlySelectedDateStr);
  if (selectedDate.getFullYear() !== year || selectedDate.getMonth() !== month) {
    miniCurrentlySelectedDateStr = formatDate(new Date(year, month, 1));
    miniCalSelectedDateDisplay.textContent = formatDateDisplay(new Date(year, month, 1));
  }
  
  firebase.auth().onAuthStateChanged((user) => {
    if (user) {
      userid = user.uid;
      namalengkap(userid).then(nama => {
        x = nama; // <- ini asynchronous
        loadJadwalByDateAndPsikolog(miniCurrentlySelectedDateStr, x);
        console.log("Nama lengkap1:", x); // <- ini akan menampilkan nama dengan benar
      });
    }
  });
});
// Tambahkan penutup untuk event DOMContentLoaded
});

function loadJadwalTerdekat(currentUserId) {
  const container = document.getElementById("appointmentCardsContainer");
  if (!container || !currentUserId) return;

  const db = firebase.database();
  const usersRef = db.ref("users");
  const jadwalRef = db.ref("jadwal_konseling");

  Promise.all([
    usersRef.once("value"),
    jadwalRef.once("value")
  ]).then(([usersSnap, jadwalSnap]) => {
    const usersData = usersSnap.val() || {};
    const jadwalData = jadwalSnap.val() || {};
    const now = new Date();

    const jadwalList = [];

    Object.values(jadwalData).forEach(item => {
      if (item.psikolog === currentUserId && item.tanggal) {
        const [day, month, year] = item.tanggal.split('-').map(Number);
        const tanggal = new Date(year, month - 1, day);

        if (tanggal >= now) {
          // Cari username berdasarkan item.userId
          let namaMahasiswa = "-";
          Object.values(usersData).forEach(user => {
            if (user.uid === item.userId) {
              namaMahasiswa = user.username || "-";
            }
          });

          jadwalList.push({
            nama: namaMahasiswa,
            tanggal,
            jam: item.waktu || "-",
            metode: item.media || "-",
            jenis: item.jenis_kunjungan || "-"
          });
        }
      }
    });

    // Urutkan berdasarkan tanggal naik dan ambil 2 terdekat
    jadwalList.sort((a, b) => a.tanggal - b.tanggal);
    const terdekat = jadwalList.slice(0, 2);

    container.innerHTML = ""; // Kosongkan dulu

    terdekat.forEach(j => {
      const hari = j.tanggal.toLocaleDateString('id-ID', {
        weekday: 'long', day: 'numeric', month: 'long', year: 'numeric'
      });

      const card = `
        <div class="appointment-card card">
          <h3 class="patient-name">${j.nama}</h3>
          <div class="appointment-detail"><i class="icon icon-calendar"></i> ${hari}</div>
          <div class="appointment-detail"><i class="icon icon-clock"></i> ${j.jam}</div>
          <div class="appointment-detail"><i class="icon ${j.metode === 'daring' ? 'icon-screen-desktop' : 'icon-location-pin'}"></i> ${j.metode}</div>
          <div class="appointment-detail"><i class="icon icon-tag"></i> ${j.jenis}</div>
        </div>
      `;
      container.innerHTML += card;
    });
  });
}

  function logout() {
    firebase.auth().signOut().then(() => {
        console.log("User signed out.");
        window.location.href = "/login"; // Ganti dengan URL halaman login Anda
    }).catch((error) => {
        console.error("Error signing out:", error);
    });
  }
  </script>
</body>
</html>