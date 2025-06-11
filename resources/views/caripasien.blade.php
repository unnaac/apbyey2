<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TeluSafe Dashboard - Cari Pasien</title>
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
      background: #F9FAFB;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
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

    /* Kontainer untuk Sidebar dan Area Utama */
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
    .sidebar nav > a { gap: 12px; }
    .sidebar nav .menu-item.has-submenu > .menu-link { justify-content: space-between; cursor: pointer; }
    .menu-link-main-content { display: flex; align-items: center; gap: 12px; }
    .sidebar nav .menu-link .arrow { font-size: 12px; transition: transform 0.3s ease; margin-left: 5px; }
    .sidebar nav .submenu .submenu-item { font-size: 14px; padding: 8px 15px 8px 10px; gap: 12px; }
    .sidebar nav .submenu { display: none; padding-left: 20px; margin-top: 5px; }
    .sidebar nav .menu-item.submenu-open .submenu { display: block; }
    .sidebar nav .menu-item.submenu-open .menu-link .arrow { transform: rotate(180deg); }
    .sidebar nav a:hover { background-color: rgba(255, 255, 255, 0.1); }
    .sidebar nav a.active { background-color: rgba(255, 255, 255, 0.15); font-weight: 600; }
    .sidebar nav .menu-item.submenu-open .menu-link.parent-active { background-color: rgba(255,255,255,0.1); font-weight: 500; }
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
    
    /* Cari Pasien Page Specific Styles */
    .cari-pasien-section .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding: 0px; /* Card sudah punya padding */
    }
    .cari-pasien-section .section-title {
        font-size: 20px;
        font-weight: 600;
        color: #1F2937;
    }
    .table-search {
        padding: 8px 12px;
        font-size: 14px;
        border: 1px solid #D1D5DB;
        border-radius: 6px;
        min-width: 250px;
    }
    .table-responsive {
        overflow-x: auto;
    }
    .patient-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }
    .patient-table th, .patient-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #E5E7EB;
        white-space: nowrap; /* Mencegah teks wrap di sel tabel */
    }
    .patient-table th {
        background-color: #F9FAFB;
        font-weight: 600;
        color: #4B5563;
    }
    .patient-table tbody tr:hover {
        background-color: #F3F4F6;
        cursor: pointer;
    }
    .patient-table tbody tr.selected-row {
        background-color: #FEE2E2; /* Warna highlight merah muda */
    }

    .pasien-detail-preview-section {
        margin-top: 25px; /* Jarak dari tabel pasien */
        padding: 25px 30px;
    }
    .pasien-detail-preview-section .form-group { margin-bottom: 15px; }
    .pasien-detail-preview-section label {
        display: block; font-size: 13px; font-weight: 600;
        color: #374151; margin-bottom: 5px;
    }
    .pasien-detail-preview-section .readonly-text {
        font-size: 14px; color: #4B5563; padding: 8px 0; line-height: 1.5; display: block;
    }
    .pasien-detail-preview-section .form-control {
        width: 100%; padding: 8px 10px; font-size: 14px;
        border: 1px solid #D1D5DB; border-radius: 6px;
    }
    .pasien-detail-preview-section textarea.form-control { min-height: 60px; resize: vertical; }
    .form-actions {
      margin-top: 20px; display: flex; justify-content: flex-end; gap: 10px;
    }
    .btn {
      padding: 9px 18px; font-size: 13px; font-weight: 500; border-radius: 6px;
      cursor: pointer; border: none; transition: all 0.2s ease;
    }
    .btn-edit { background-color: #F3F4F6; color: #374151; border: 1px solid #D1D5DB; }
    .btn-edit:hover { background-color: #E5E7EB; }
    .btn-simpan { background-color: #B40000; color: white; }
    .btn-simpan:hover { background-color: #990000; }

    /* News Section */
    .news { background: white; border-radius: 12px; padding: 20px; display: flex; flex-direction: column; gap: 12px; width: 280px; height: fit-content; box-shadow: 0 4px 12px rgba(0,0,0,0.07); }
    .news h4 { font-size: 16px; font-weight: 600; color: #1F2937; margin-bottom: 5px; }
    .news img.berita-thumbnail { border-radius: 8px; width: 100%; height: auto; object-fit: cover; }
    .news p strong { font-size: 14px; color: #1F2937; display: block; margin-bottom: 2px; }
    .news p { font-size: 12px; color: #6B7280; }

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
      .cari-pasien-section .section-header { flex-direction: column; align-items: flex-start; gap: 10px; }
      .table-search { width: 100%; }
      .pasien-detail-preview-section .form-actions { flex-direction: column; gap:10px;}
      .pasien-detail-preview-section .form-actions .btn { width: 100%; }
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
        <small id="status-header">3rd year</small>
      </div>
    </div>
  </header>

  <div class="page-content">
    <aside class="sidebar">
      <nav>
        <a href="/halaman"><img src="assets/webpsikolog/Beranda.png" alt="Beranda Icon" class="menu-icon"> Beranda</a>
        <div class="menu-item has-submenu submenu-open"> <a href="/konseling" class="menu-link bk-link parent-active"> <span class="menu-link-main-content">
              <img src="assets/webpsikolog/BK.png" alt="BK Icon" class="menu-icon"> BK
            </span>
            <span class="arrow">&#9662;</span>
          </a>
          <div class="submenu" style="display: block;"> <a href="#" class="submenu-item active"> <img src="assets/webpsikolog/cariPasien.png" alt="Cari Pasien Icon" class="menu-icon"> Cari Pasien
            </a>
          </div>
        </div>
        <a href="/jadwalpsikolog"><img src="assets/webpsikolog/Jadwal.png" alt="Jadwal Icon" class="menu-icon"> Jadwal</a>
      </nav>
      <button class="logout"><img src="assets/webpsikolog/logout.png" alt="Logout Icon" onclick="logout()"> Logout</button>
    </aside>

    <div class="main-area-wrapper">
      <main class="main">
        <div class="cari-pasien-section card">
          <div class="section-header">
            <h2 class="section-title">Cari Pasien</h2>
            <input type="search" class="table-search" id="tableSearchInput" placeholder="Cari nama, tanggal, jenis, media, psikolog, atau diagnosa...">
          </div>
          <div class="table-responsive">
            <table class="patient-table">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Tanggal</th>
                  <th>Jenis</th>
                  <th>Media</th>
                  <th>Psikolog</th>
                  <th>Diagnosa</th>
                </tr>
              </thead>
              <tbody id="patientTableBody">
                              </tbody>
            </table>
          </div>
        </div>

        <div class="pasien-detail-preview-section card" id="pasienDetailPreview" style="display: none;">
          <h3 style="font-size:18px; margin-bottom:20px; color: #1F2937;">Detail Pasien</h3>
          <form id="previewForm">
            <div class="form-group">
                <label for="previewNamaInput">Nama</label>
                <p class="readonly-text" data-field-display="nama"></p>
                <input type="text" class="form-control" data-field-input="nama" id="previewNamaInput" style="display:none;">
            </div>
            <div class="form-group">
                <label for="previewTanggalInput">Hari & Tanggal</label>
                <p class="readonly-text" data-field-display="tanggal"></p>
                <input type="text" class="form-control" data-field-input="tanggal" id="previewTanggalInput" style="display:none;">
            </div>
            <div class="form-group">
                <label for="previewJenisMediaInput">Jenis Kunjungan & Media</label>
                <p class="readonly-text" data-field-display="jenisMedia"></p>
                <input type="text" class="form-control" data-field-input="jenisMedia" id="previewJenisMediaInput" style="display:none;">
            </div>
            <div class="form-group">
                <label for="previewPsikologInput">Psikolog</label>
                <p class="readonly-text" data-field-display="psikolog"></p>
                <input type="text" class="form-control" data-field-input="psikolog" id="previewPsikologInput" style="display:none;">
            </div>
            <div class="form-group">
                <label for="previewDiagnosaInput">Diagnosa</label>
                <p class="readonly-text" data-field-display="diagnosa"></p>
                <textarea class="form-control" data-field-input="diagnosa" id="previewDiagnosaInput" style="display:none;" rows="3"></textarea>
            </div>
            <div class="form-actions">
                <button type="button" class="btn btn-edit" id="previewEditBtn">Edit</button>
                <button type="submit" class="btn btn-simpan" id="previewSimpanBtn" style="display:none;">Simpan</button>
            </div>
          </form>
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

        // Update ke elemen HTML
        document.getElementById('nama-header').innerText = namaLengkap;
        document.getElementById('status-header').innerText = status;
      })
      .catch(error => {
        console.error("Gagal mengambil data user:", error);
      });
  }
    function logout() {
  firebase.auth().signOut().then(() => {
    window.location.href = '/login'; // Ganti dengan URL halaman login Anda
  }).catch((error) => {
    console.error('Error signing out:', error);
  });
}
    // TODO: Replace with your Firebase project configuration


    // Initialize Firebase
    const database = firebase.database();

    document.addEventListener('DOMContentLoaded', function() {
      const submenuToggleLinks = document.querySelectorAll('.sidebar .menu-item.has-submenu > .menu-link');
      submenuToggleLinks.forEach(link => {
        const parentItem = link.closest('.menu-item.has-submenu');
        if (parentItem && parentItem.querySelector('.submenu-item.active')) {
            parentItem.classList.add('submenu-open');
            link.classList.add('parent-active');
            const submenu = parentItem.querySelector('.submenu');
            if (submenu) submenu.style.display = 'block'; 
        }

        link.addEventListener('click', function(event) {
          event.preventDefault(); 
          if (parentItem) {
            parentItem.classList.toggle('submenu-open');
            const submenu = parentItem.querySelector('.submenu');
            if (submenu) {
                submenu.style.display = parentItem.classList.contains('submenu-open') ? 'block' : 'none';
            }
            // Parent active logic if needed
            if (parentItem.querySelector('.submenu-item.active') && parentItem.classList.contains('submenu-open')) {
                this.classList.add('parent-active');
            } else {
                this.classList.remove('parent-active');
            }
          }
        });
      });

      const patientTableBody = document.getElementById('patientTableBody');
      const detailPreviewSection = document.getElementById('pasienDetailPreview');
      const previewForm = document.getElementById('previewForm');
      const previewEditBtn = document.getElementById('previewEditBtn');
      const previewSimpanBtn = document.getElementById('previewSimpanBtn');
      const tableSearchInput = document.getElementById('tableSearchInput');
      
      let currentSelectedPatientId = null;
      const previewFields = [
          { display: detailPreviewSection.querySelector('p[data-field-display="nama"]'), input: document.getElementById('previewNamaInput'), key: 'nama'},
          { display: detailPreviewSection.querySelector('p[data-field-display="tanggal"]'), input: document.getElementById('previewTanggalInput'), key: 'tanggal'},
          { display: detailPreviewSection.querySelector('p[data-field-display="jenisMedia"]'), input: document.getElementById('previewJenisMediaInput'), key: 'jenisMedia'},
          { display: detailPreviewSection.querySelector('p[data-field-display="psikolog"]'), input: document.getElementById('previewPsikologInput'), key: 'psikolog'},
          { display: detailPreviewSection.querySelector('p[data-field-display="diagnosa"]'), input: document.getElementById('previewDiagnosaInput'), key: 'diagnosa'}
      ];

      // Function to format date from 'YYYY-MM-DD' to 'Hari, DD MMMM YYYY'
      function formatFirestoreTimestampToIndonesian(timestamp) {
        if (!timestamp || !timestamp.seconds) return '';
        const date = new Date(timestamp.seconds * 1000);
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        return date.toLocaleDateString('id-ID', options);
      }

      // Function to populate the table from Firebase
      async function fetchAndPopulatePatients() {
  const jadwalRef = database.ref('jadwal_konseling');
  jadwalRef.on('value', async (snapshot) => {
    patientTableBody.innerHTML = ''; // Clear existing rows
    const patients = [];

    const promises = []; // Simpan promise untuk menunggu semua ambil nama user

    snapshot.forEach((childSnapshot) => {
      const data = childSnapshot.val();
      const promise = ambilNamaUser(data.userId).then((namanya) => {
        patients.push({
          id: childSnapshot.key,
          nama: namanya,
          tanggal: data.tanggal || '',
          jenis: data.jenis_kunjungan || '',
          media: data.media || '',
          psikolog: data.psikolog || '',
          diagnosa: data.diagnosa || ''
        });
      });

      promises.push(promise);
    });

    // Tunggu semua nama user diambil
    await Promise.all(promises);

    // Tampilkan data setelah lengkap
    patients.forEach(patient => {
      const row = document.createElement('tr');
      row.dataset.patientId = patient.id;
      row.innerHTML = `
        <td>${patient.nama}</td>
        <td>${patient.tanggal}</td>
        <td>${patient.jenis}</td>
        <td>${patient.media}</td>
        <td>${patient.psikolog}</td>
        <td>${patient.diagnosa}</td>
      `;
      patientTableBody.appendChild(row);
    });

    attachRowClickListeners();
  });
}

      // Function to attach click listeners to table rows
      function attachRowClickListeners() {
        const patientTableRows = document.querySelectorAll('.patient-table tbody tr');
        patientTableRows.forEach(row => {
          row.removeEventListener('click', handleRowClick); // Remove old listener to prevent duplicates
          row.addEventListener('click', handleRowClick);
        });
      }

      // Handle row click to navigate to detail page
      function handleRowClick() {
        const patientId = this.dataset.patientId;
        if (patientId) {
          window.location.href = `/detailkonseling?id=${patientId}`;
        }
      }

      // Initial fetch and populate
      fetchAndPopulatePatients();

      // Search functionality (still applies to visible rows after filtering by Firebase)
      if (tableSearchInput) {
        tableSearchInput.addEventListener('keyup', function() {
          const searchTerm = this.value.toLowerCase();
          const rows = document.querySelectorAll('#patientTableBody tr');
          rows.forEach(row => {
            const rowText = row.textContent.toLowerCase();
            row.style.display = rowText.includes(searchTerm) ? '' : 'none';
          });
        });
      }

    });

    async function ambilNamaUser(uid) {
  try {
    const snapshot = await firebase.database().ref('users/' + uid).once('value');
    const userData = snapshot.val();
    return userData?.username || 'User';
  } catch (error) {
    console.error('Error fetching user data:', error);
    return 'User';
  }
}


  </script>
</body>
</html>