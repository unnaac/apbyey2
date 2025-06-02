<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>TeluSafe - Bimbingan Konseling Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'telusafe-red': '#C43B3B',
                        'telusafe-light-red': '#F44343',
                        'telusafe-pink': '#FEEAEA',
                        'telusafe-dark-red': '#A63333'
                    },
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                        'poppins': ['Poppins', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        body { 
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
        }
        
        .sidebar-active {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
        }
        
        .hover-effect:hover {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            transform: translateX(4px);
            transition: all 0.2s ease;
        }
        
        .card-clean {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }
        
        .stat-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
        }
        
        .table-row:hover {
            background: #f8fafc;
        }
        
        .counter {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen text-gray-900 font-inter">
    <div class="flex max-w-7xl mx-auto bg-white shadow-sm border border-gray-200">
        <!-- Sidebar -->
        <aside class="bg-gradient-to-b from-telusafe-red to-telusafe-dark-red w-64 flex flex-col p-6 space-y-6 text-white">
            <div class="flex items-center space-x-3 mb-4">
                <img src="/assets/webadmin/Logo.png" alt="TeluSafe Logo" class="w-10 h-10 object-contain"/>
                <span class="font-semibold text-xl">TeluSafe</span>
            </div>
            
            <nav class="flex flex-col space-y-2 text-sm font-medium">
                <a class="flex items-center space-x-3 text-white p-3 hover-effect transition-all duration-200" href="#" onclick="navigateTo('home')">
                    <i class="fas fa-th-large w-5"></i>
                    <span>Beranda</span>
                </a>
                
                <a class="flex items-center space-x-3 text-white p-3 hover-effect transition-all duration-200" href="#" onclick="navigateTo('ppks')">
                    <i class="fas fa-shield-alt w-5"></i>
                    <span>PPKS</span>
                </a>
                
                <div class="flex items-center space-x-3 text-white p-3 sidebar-active">
                    <i class="fas fa-user-friends w-5"></i>
                    <span>Bimbingan Konseling</span>
                </div>
                
                <a class="flex items-center space-x-3 text-white p-3 hover-effect transition-all duration-200" href="#" onclick="navigateTo('emosi')">
                    <i class="fas fa-heart w-5"></i>
                    <span>Emosi Mahasiswa</span>
                </a>
                
                <a class="flex items-center space-x-3 text-white p-3 hover-effect transition-all duration-200" href="#" onclick="navigateTo('artikel')">
                    <i class="fas fa-newspaper w-5"></i>
                    <span>Artikel</span>
                </a>
            </nav>
            
            <button class="mt-auto flex items-center space-x-3 text-white text-sm opacity-80 hover:opacity-100 p-3 hover-effect transition-all duration-200" onclick="logout()">
                <i class="fas fa-sign-out-alt w-5"></i>
                <span>Logout</span>
            </button>
        </aside>

        <!-- Main content -->
        <main class="flex-1 p-8 space-y-8 bg-gray-50">
            <!-- Header -->
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-telusafe-red rounded-lg flex items-center justify-center">
                        <i class="fas fa-user-friends text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Bimbingan Konseling Admin</h1>
                        <p class="text-gray-600 text-sm">Manajemen Layanan Konseling & Psikolog</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <!-- <div class="relative">
                        <input class="w-80 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-telusafe-red focus:border-transparent" placeholder="🔍 Cari psikolog..." type="search" id="searchInput"/>
                    </div> -->
                    
                    <!-- <div class="flex items-center space-x-3 bg-white rounded-lg p-2 border border-gray-200">
                        <div class="w-10 h-10 rounded-lg bg-telusafe-red flex items-center justify-center text-white font-bold">
                            MQ
                        </div>
                        <div>
                            <p class="text-sm font-semibold">Musfiq</p>
                            <p class="text-xs text-gray-500">BK Admin</p>
                        </div>
                    </div>
                    
                    <button class="relative p-3 bg-white border border-gray-200 rounded-lg hover:bg-gray-50">
                        <i class="fas fa-bell text-gray-600"></i>
                        <div class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full"></div>
                    </button> -->
                </div>
            </div>

            <!-- Statistics -->
            <div class="grid grid-cols-4 gap-6">
                <div class="card-clean p-6 stat-hover cursor-pointer" onclick="hitungStatistikKonseling()">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user-graduate text-telusafe-red text-xl"></i>
                        </div>
                    </div>
                    <div id="counseling-students">
                        <p class="text-2xl font-bold text-gray-900 counter" data-count="100">0</p>
                        <p class="text-sm font-medium text-gray-600">Mahasiswa Konseling</p>
                        <p class="text-xs text-gray-500 mt-1">Aktif saat ini</p>
                    </div>
                </div>
                
                <div class="card-clean p-6 stat-hover cursor-pointer" onclick="loadFirstPage()">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user-md text-yellow-600 text-xl"></i>
                        </div>
                    </div>
                    <div id="psychologists-count">
                        <p class="text-2xl font-bold text-gray-900 counter" data-count="10">0</p>
                        <p class="text-sm font-medium text-gray-600">Psikolog Tersedia</p>
                        <p class="text-xs text-gray-500 mt-1">Siap melayani</p>
                    </div>
                </div>
                
                <div class="card-clean p-6 stat-hover cursor-pointer" onclick="fetchDataAndRenderChart();">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-plus-circle text-green-600 text-xl"></i>
                        </div>
                    </div>
                    <div id="new-counseling-count">
                        <p class="text-2xl font-bold text-gray-900 counter" data-count="5">0</p>
                        <p class="text-sm font-medium text-gray-600">Konseling Baru</p>
                        <p class="text-xs text-gray-500 mt-1">Minggu ini</p>
                    </div>
                </div>
                
                <div class="card-clean p-6 stat-hover cursor-pointer" onclick="showDetails('follow-up')">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-redo text-purple-600 text-xl"></i>
                        </div>
                    </div>
                    <div id="follow-up-counseling-count">
                        <p class="text-2xl font-bold text-gray-900 counter" data-count="8">0</p>
                        <p class="text-sm font-medium text-gray-600">Konseling Lanjutan</p>
                        <p class="text-xs text-gray-500 mt-1">Dalam proses</p>
                    </div>
                </div>
            </div>

            <!-- Chart Section - Made Bigger -->
            <div class="card-clean p-8">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Tren Mahasiswa Konseling</h3>
                        <p class="text-gray-600 text-sm mt-1">Perkembangan jumlah mahasiswa yang mengikuti konseling</p>
                    </div>
                    <!-- <button class="flex items-center space-x-2 text-gray-600 border border-gray-300 rounded-lg px-4 py-2 hover:bg-gray-50" onclick="exportData()">
                        <i class="fas fa-download"></i>
                        <span>Export</span>
                    </button> -->
                </div>
                
                <!-- Bigger Chart -->
                <div class="w-full h-96">
                    <svg class="w-full h-full" viewBox="0 0 800 400" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Grid lines -->
                        <line stroke="#E5E7EB" stroke-width="1" x1="80" x2="720" y1="80" y2="80"/>
                        <line stroke="#E5E7EB" stroke-width="1" x1="80" x2="720" y1="140" y2="140"/>
                        <line stroke="#E5E7EB" stroke-width="1" x1="80" x2="720" y1="200" y2="200"/>
                        <line stroke="#E5E7EB" stroke-width="1" x1="80" x2="720" y1="260" y2="260"/>
                        <line stroke="#E5E7EB" stroke-width="1" x1="80" x2="720" y1="320" y2="320"/>
                        
                        <!-- Gradient fill -->
                        <defs>
                            <linearGradient id="chartGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" style="stop-color:#C43B3B;stop-opacity:0.3"/>
                                <stop offset="100%" style="stop-color:#C43B3B;stop-opacity:0"/>
                            </linearGradient>
                        </defs>
                        
                        <!-- Area fill -->
                        <path id="areaFill d="M80 300C160 290 240 280 320 250C400 220 480 210 560 220C640 230 720 210 720 210 L720 320 L80 320 Z" 
                              fill="url(#chartGradient)"/>
                        
                        <!-- Main trend line -->
                        <path id="trendLine" d="M80 300C160 290 240 280 320 250C400 220 480 210 560 220C640 230 720 210 720 210" 
                              stroke="#C43B3B" stroke-width="4" fill="none"/>
                        
                        <!-- Data points -->
                        <circle cx="320" cy="250" fill="#C43B3B" r="6" stroke="white" stroke-width="3"/>
                        <circle cx="480" cy="210" fill="#C43B3B" r="6" stroke="white" stroke-width="3"/>
                        <circle cx="560" cy="220" fill="#C43B3B" r="6" stroke="white" stroke-width="3"/>
                        <circle cx="720" cy="210" fill="#C43B3B" r="8" stroke="white" stroke-width="3"/>
                        
                        <!-- Month labels -->
                        <text fill="#6B7280" font-family="Inter, sans-serif" font-size="14" text-anchor="middle" x="120" y="360">Jan</text>
                        <text fill="#6B7280" font-family="Inter, sans-serif" font-size="14" text-anchor="middle" x="200" y="360">Feb</text>
                        <text fill="#6B7280" font-family="Inter, sans-serif" font-size="14" text-anchor="middle" x="280" y="360">Mar</text>
                        <text fill="#6B7280" font-family="Inter, sans-serif" font-size="14" text-anchor="middle" x="360" y="360">Apr</text>
                        <text fill="#6B7280" font-family="Inter, sans-serif" font-size="14" text-anchor="middle" x="440" y="360">Mei</text>
                        <text fill="#6B7280" font-family="Inter, sans-serif" font-size="14" text-anchor="middle" x="520" y="360">Jun</text>
                        <text fill="#6B7280" font-family="Inter, sans-serif" font-size="14" text-anchor="middle" x="600" y="360">Jul</text>
                        <text fill="#6B7280" font-family="Inter, sans-serif" font-size="14" text-anchor="middle" x="680" y="360">Agu</text>
                        
                        <!-- Y-axis labels -->
                        <text fill="#6B7280" font-family="Inter, sans-serif" font-size="12" text-anchor="end" x="70" y="85">120</text>
                        <text fill="#6B7280" font-family="Inter, sans-serif" font-size="12" text-anchor="end" x="70" y="145">90</text>
                        <text fill="#6B7280" font-family="Inter, sans-serif" font-size="12" text-anchor="end" x="70" y="205">60</text>
                        <text fill="#6B7280" font-family="Inter, sans-serif" font-size="12" text-anchor="end" x="70" y="265">30</text>
                        <text fill="#6B7280" font-family="Inter, sans-serif" font-size="12" text-anchor="end" x="70" y="325">0</text>
                    </svg>
                </div>
                
                <!-- <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200">
                    <div class="flex items-center space-x-3">
                        <div class="w-4 h-4 bg-telusafe-red rounded-full"></div>
                        <span class="text-sm font-medium text-gray-700">Jumlah Mahasiswa Konseling</span>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-bold text-telusafe-red">95</div>
                        <div class="text-sm text-gray-600">Mahasiswa bulan ini</div>
                        <div class="text-sm text-green-600 mt-1">
                            <i class="fas fa-arrow-up mr-1"></i>+12% dari bulan lalu
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- Add Psychologist Form -->
            <div class="card-clean p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Edit Psikolog</h3>
                
                <form class="space-y-6" onsubmit="savePsychologist(event)">
                    <div class="grid grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">ID Psikolog</label>
                            <input class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-telusafe-red focus:border-transparent" id="idPsikolog" type="text" placeholder="PSY001"/>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-telusafe-red focus:border-transparent" id="nama" type="text" placeholder="Dr. Jane Smith, M.Psi"/>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                            <input class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-telusafe-red focus:border-transparent" id="nomorTelepon" type="text" placeholder="08123456789"/>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Spesialisasi</label>
                        <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-telusafe-red focus:border-transparent resize-none" id="spesialisasi" rows="3" placeholder="Psikologi Klinis, Terapi Kognitif Perilaku"></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Jadwal Tersedia</label>
                        <div class="flex space-x-3">
                            <button class="px-4 py-2 text-sm border border-telusafe-red text-telusafe-red rounded-lg hover:bg-telusafe-red hover:text-white transition-all day-selector" type="button" onclick="toggleDay(this, 'senin')">Senin</button>
                            <button class="px-4 py-2 text-sm border border-telusafe-red text-telusafe-red rounded-lg hover:bg-telusafe-red hover:text-white transition-all day-selector" type="button" onclick="toggleDay(this, 'selasa')">Selasa</button>
                            <button class="px-4 py-2 text-sm border border-telusafe-red text-telusafe-red rounded-lg hover:bg-telusafe-red hover:text-white transition-all day-selector" type="button" onclick="toggleDay(this, 'rabu')">Rabu</button>
                            <button class="px-4 py-2 text-sm border border-telusafe-red text-telusafe-red rounded-lg hover:bg-telusafe-red hover:text-white transition-all day-selector" type="button" onclick="toggleDay(this, 'kamis')">Kamis</button>
                            <button class="px-4 py-2 text-sm border border-telusafe-red text-telusafe-red rounded-lg hover:bg-telusafe-red hover:text-white transition-all day-selector" type="button" onclick="toggleDay(this, 'jumat')">Jumat</button>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button class="px-6 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50" type="reset" onclick="resetForm()">Reset</button>
                        <button class="px-6 py-2 bg-telusafe-red text-white rounded-lg hover:bg-telusafe-dark-red" type="submit">Simpan</button>
                    </div>
                </form>
            </div>

            <!-- Psychologist List -->
            <div class="card-clean p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Daftar Psikolog</h3>
                        <p class="text-gray-600 text-sm">Manajemen data psikolog dalam sistem</p>
                    </div>
                    <div class="flex space-x-3">
                        <!-- <button class="flex items-center space-x-2 bg-telusafe-red text-white px-4 py-2 rounded-lg hover:bg-telusafe-dark-red" onclick="bulkAction()">
                            <i class="fas fa-tasks"></i>
                            <span>Bulk Action</span>
                        </button> -->
                        <button class="flex items-center space-x-2 border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50" onclick="refreshTable()">
                            <i class="fas fa-sync-alt"></i>
                            <span>Refresh</span>
                        </button>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200 text-left">
                                <th class="pb-3 text-sm font-semibold text-gray-700">
                                    <input type="checkbox" class="rounded" onchange="selectAll(this)">
                                </th>
                                <th class="pb-3 text-sm font-semibold text-gray-700">Nama</th>
                                <th class="pb-3 text-sm font-semibold text-gray-700">Spesialisasi</th>
                                <th class="pb-3 text-sm font-semibold text-gray-700">Jadwal</th>
                                <th class="pb-3 text-sm font-semibold text-gray-700">Telepon</th>
                                <th class="pb-3 text-sm font-semibold text-gray-700">Status</th>
                                <th class="pb-3 text-sm font-semibold text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <tr class="border-b border-gray-100 table-row">
                                <td class="py-4">
                                    <input type="checkbox" class="rounded">
                                </td>
                                <td class="py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                                            JS
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900">Dr. Jane Smith, M.Psi</div>
                                            <div class="text-sm text-gray-500">Psikolog Senior</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-3 py-1 rounded-full">
                                        Psikologi Klinis
                                    </span>
                                </td>
                                <td class="py-4 text-sm text-gray-600">Senin, Selasa, Rabu</td>
                                <td class="py-4 text-sm text-gray-600">08123456789</td>
                                <td class="py-4">
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-3 py-1 rounded-full flex items-center w-fit">
                                        <i class="fas fa-circle mr-1 text-xs"></i>Aktif
                                    </span>
                                </td>
                                <td class="py-4">
                                    <div class="flex space-x-2">
                                        <button class="text-blue-600 hover:text-blue-800 p-2" onclick="viewPsychologist('PSY001')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-yellow-600 hover:text-yellow-800 p-2" onclick="editPsychologist('PSY001')">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-green-600 hover:text-green-800 p-2" onclick="manageSchedule('PSY001')">
                                            <i class="fas fa-calendar-alt"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-800 p-2" onclick="deletePsychologist('PSY001')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr class="border-b border-gray-100 table-row">
                                <td class="py-4">
                                    <input type="checkbox" class="rounded">
                                </td>
                                <td class="py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                                            AB
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900">Dr. Ahmad Budi, S.Psi</div>
                                            <div class="text-sm text-gray-500">Konselor Remaja</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <span class="bg-purple-100 text-purple-800 text-xs font-medium px-3 py-1 rounded-full">
                                        Konseling Remaja
                                    </span>
                                </td>
                                <td class="py-4 text-sm text-gray-600">Kamis, Jumat</td>
                                <td class="py-4 text-sm text-gray-600">08987654321</td>
                                <td class="py-4">
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-3 py-1 rounded-full flex items-center w-fit">
                                        <i class="fas fa-circle mr-1 text-xs"></i>Aktif
                                    </span>
                                </td>
                                <td class="py-4">
                                    <div class="flex space-x-2">
                                        <button class="text-blue-600 hover:text-blue-800 p-2" onclick="viewPsychologist('PSY002')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-yellow-600 hover:text-yellow-800 p-2" onclick="editPsychologist('PSY002')">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-green-600 hover:text-green-800 p-2" onclick="manageSchedule('PSY002')">
                                            <i class="fas fa-calendar-alt"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-800 p-2" onclick="deletePsychologist('PSY002')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr class="border-b border-gray-100 table-row">
                                <td class="py-4">
                                    <input type="checkbox" class="rounded">
                                </td>
                                <td class="py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                                            SR
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-700">Dr. Sari Rahayu, M.Psi</div>
                                            <div class="text-sm text-gray-500">Terapis Trauma</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <span class="bg-red-100 text-red-800 text-xs font-medium px-3 py-1 rounded-full">
                                        Terapi Trauma
                                    </span>
                                </td>
                                <td class="py-4 text-sm text-gray-600">Senin, Rabu, Jumat</td>
                                <td class="py-4 text-sm text-gray-600">08555123456</td>
                                <td class="py-4">
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-3 py-1 rounded-full flex items-center w-fit">
                                        <i class="fas fa-pause mr-1 text-xs"></i>Cuti
                                    </span>
                                </td>
                                <td class="py-4">
                                    <div class="flex space-x-2">
                                        <button class="text-blue-600 hover:text-blue-800 p-2" onclick="viewPsychologist('PSY003')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-gray-400 cursor-not-allowed p-2" disabled>
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-gray-400 cursor-not-allowed p-2" disabled>
                                            <i class="fas fa-calendar-alt"></i>
                                        </button>
                                        <button class="text-green-600 hover:text-green-800 p-2" onclick="activatePsychologist('PSY003')">
                                            <i class="fas fa-play"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="flex items-center justify-between mt-6">
                    <div class="text-sm text-gray-600">
                        Menampilkan 1-3 dari 10 psikolog  
                    </div>
                    <div class="flex space-x-2">
    <button id="prevBtn" class="px-3 py-1 border border-gray-300 rounded text-sm hover:bg-gray-50" onclick="loadPrevPage()">Previous</button>
    <button class="px-3 py-1 bg-telusafe-red text-white rounded text-sm">1</button>
    <button id="nextBtn" class="px-3 py-1 border border-gray-300 rounded text-sm hover:bg-gray-50" onclick="loadNextPage()">Next</button>
</div>

                </div>
            </div>
        </main>
    </div>

    <!-- Toast -->
    <div id="toast" class="fixed top-4 right-4 bg-white border-l-4 border-telusafe-red rounded-lg shadow-lg p-4 transform translate-x-full transition-transform duration-300 z-50">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-3"></i>
            <span id="toast-message">Action completed successfully!</span>
        </div>
    </div>
    <!-- Modal -->
<div id="viewModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden z-50">
  <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md relative">
    <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-lg">&times;</button>
    <h2 class="text-xl font-semibold mb-4">Detail Psikolog</h2>
    <div id="modalContent">
      <!-- Konten akan diisi lewat JS -->
    </div>
  </div>
</div>

    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-app-compat.js"></script>    
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-auth-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-database-compat.js"></script>
    <script src="js/configurasi-firebase.js"></script>
    <script>
    const db = firebase.database();
    let editingKey = null; // null jika tambah, isi dengan key jika mode edit

    // Ambil data jadwal_konseling
    

        let selectedDays = [];

        document.addEventListener('DOMContentLoaded', function() {
            // Counter animation
            const counters = document.querySelectorAll('.counter');
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-count'));
                let current = 0;
                const increment = target / 30;
                
                const updateCounter = () => {
                    current += increment;
                    if (current < target) {
                        counter.textContent = Math.floor(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target;
                    }
                };
                
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            updateCounter();
                            observer.unobserve(entry.target);
                        }
                    });
                });
                
                observer.observe(counter);
            });
        });

        function navigateTo(section) { showToast(`Navigating to ${section}...`, 'info'); 
            if (section === 'ppks') {
                window.location.href = '/ppksadmin';
            } else if (section === 'artikel') {
                window.location.href = '/artikeladmin';
            } else if (section === 'emosi') {
                window.location.href = '/emosikuadmin';
            } else if (section === 'home') {
                window.location.href = '/beranda';
            }
        }
        function exportData() { showToast('Exporting data...', 'info'); }
        function showDetails(type) { showToast(`Showing ${type} details...`, 'info'); }
        function logout() {
            showToast('Logging out admin session...', 'warning');

    // Logout dari Firebase
            firebase.auth().signOut()
            .then(() => {
        // Hapus sessionStorage atau localStorage yang digunakan
                sessionStorage.clear(); // atau sessionStorage.removeItem('uid') jika hanya satu

                setTimeout(() => {
                    showToast('Admin session ended. Goodbye!', 'success');
            // Redirect ke halaman login atau homepage
                    window.location.href = '/login';
                }, 1000);
            })
            .catch((error) => {
                console.error('Logout gagal:', error);
                showToast('Logout Gagal', 'Terjadi kesalahan saat logout.', 'error');
            });
        }


function toggleDay(button, day) {
  const isSelected = button.dataset.selected === "true";

  if (isSelected) {
    // Batalkan pilihan
    button.classList.remove('bg-telusafe-red', 'text-white');
    button.classList.add('text-telusafe-red');
    button.dataset.selected = "false";
    selectedDays = selectedDays.filter(d => d !== day);
  } else {
    // Pilih
    button.classList.add('bg-telusafe-red', 'text-white');
    button.classList.remove('text-telusafe-red');
    button.dataset.selected = "true";
    if (!selectedDays.includes(day)) {
      selectedDays.push(day);
    }
  }

  console.log("Selected days:", selectedDays); // debug
}

        function resetForm() {
            selectedDays = [];
            document.querySelectorAll('.day-selector').forEach(btn => {
                btn.classList.remove('active', 'bg-telusafe-red', 'text-white');
                btn.classList.add('text-telusafe-red');
            });
            showToast('Form reset', 'info');
        }

        function savePsychologist(event) {
            event.preventDefault();
            const formData = {
                id: document.getElementById('idPsikolog').value,
                nama: document.getElementById('nama').value,
                spesialisasi: document.getElementById('spesialisasi').value,
                telepon: document.getElementById('nomorTelepon').value,
                jadwal: selectedDays
            };

            if (!formData.id || !formData.nama || !formData.spesialisasi || !formData.telepon || selectedDays.length === 0) {
                showToast('Please fill all fields', 'error');
                return;
            }

            showToast('Psikolog berhasil ditambahkan!', 'success');
            resetForm();
            document.querySelector('form').reset();
        }

        function deletePsychologist(key) {
            showToast(`Deleting ${key}...`, 'warning');
  if (!confirm("Apakah Anda yakin ingin menghapus psikolog ini?")) return;

  const db = firebase.database();
  const userRef = db.ref(`users/${key}`);

  // Ambil UID dari data user
  userRef.once('value')
    .then(snapshot => {
      const userData = snapshot.val();

      if (!userData) {
        alert("Data psikolog tidak ditemukan.");
        return;
      }

      const uid = userData.uid; // Pastikan kamu menyimpan UID auth di field ini saat registrasi
      if (!uid) {
        alert("UID pengguna tidak tersedia di database.");
        return;
      }

      // Hapus dari Realtime Database
      return userRef.remove()
        .then(() => {
          // Panggil Firebase Admin API melalui Cloud Function untuk hapus Auth user
          return fetch(`https://your-cloud-function-endpoint/deleteUser`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify({ uid })
          });
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            alert("Psikolog berhasil dihapus dari database dan autentikasi.");
            loadFirstPage(); // Refresh table
          } else {
            alert("Gagal menghapus pengguna dari Authentication.");
          }
        });
    })
    .catch(error => {
      console.error("Terjadi kesalahan:", error);
      alert("Gagal menghapus psikolog.");
    });
}


        function viewPsychologist(key) { showToast(`Viewing ${key}...`, 'info');   const psikologRef = firebase.database().ref('users/' + key);

  psikologRef.once('value', snapshot => {
    const data = snapshot.val();
    if (data) {
      const content = `
        <p><strong>Nama:</strong> ${data.nama_lengkap || 'Tidak diketahui'}</p>
        <p><strong>Spesialisasi:</strong> ${data.spesialisasi || 'Tidak diketahui'}</p>
        <p><strong>Hari Praktik:</strong> ${data.hari || 'Tidak diketahui'}</p>
        <p><strong>Kontak:</strong> ${data.phone || 'Tidak diketahui'}</p>
        <p><strong>Status:</strong> ${data.status || 'Tidak diketahui'}</p>
      `;
      document.getElementById('modalContent').innerHTML = content;
      document.getElementById('viewModal').classList.remove('hidden');
    } else {
      alert('Data tidak ditemukan');
    }
  });
}

function closeModal() {
  document.getElementById('viewModal').classList.add('hidden');
}
        function editPsychologist(key) { showToast(`Editing ${key}...`, 'warning');
        console.log(`Editing psychologist with key: ${key}`); 
            const ref = firebase.database().ref('users/' + key);
  ref.once('value', snapshot => {
    const data = snapshot.val();
    console.log("Fetched data:", data);
    if (data) {
      document.getElementById('idPsikolog').value = data.uid || '';
      document.getElementById('nama').value = data.nama_lengkap || '';
      document.getElementById('nomorTelepon').value = data.phone || '';
      document.getElementById('spesialisasi').value = data.spesialisasi || '';

      // Reset semua tombol hari
      const selectedDays = Array.from(document.querySelectorAll(".day-selector[data-selected='true']"))
    .map(btn => btn.getAttribute("onclick").match(/'(\w+)'/)[1]);

    console.log("Selected days before reset:", selectedDays);
      
      // Tandai hari yang tersedia
      if (data.hari) {
        console.log("Selected days:", data.hari);
        data.hari.forEach(day => {
          const btn = document.querySelector(`.day-selector[onclick*="'${day}'"]`);
          if (btn) {
            btn.classList.add('bg-telusafe-red', 'text-white');
            btn.classList.remove('text-telusafe-red');
            btn.dataset.selected = "true";
          }
        });
      }

      editingKey = key; // Set ke mode edit
    }
  });}
        function manageSchedule(id) { showToast(`Managing schedule ${id}...`, 'info'); }
        function setPsychologistOnLeave(key) {
            showToast(`Activating ${key}...`, 'info');
        const psikologRef = firebase.database().ref(`users/${key}`);
        psikologRef.update({
            cuti: "aktif"
        })
        .then(() => {
            loadFirstPage(); // Refresh tabel jika perlu
        })
        .catch(error => {
            console.error("Gagal mengubah status cuti psikolog:", error);
            alert("Terjadi kesalahan saat mengubah status cuti.");
        });
    }

        
        function activatePsychologist(key) { showToast(`Activating ${key}...`, 'success'); 
            const psikologRef = firebase.database().ref(`users/${key}`);
            psikologRef.update({
            cuti: "tidak"
            })
            .then(() => {
    
            loadFirstPage(); // atau fungsi lain untuk refresh tampilan
  })
  .catch(error => {
    console.error("Gagal mengaktifkan psikolog:", error);
    alert("Terjadi kesalahan saat mengaktifkan psikolog.");
  }); }
        function bulkAction() { showToast('Bulk action...', 'info'); }
        function refreshTable() { showToast('Refreshing...', 'info'); 
            loadFirstPage();
        }
        function selectAll(checkbox) { 
            document.querySelectorAll('tbody input[type="checkbox"]').forEach(cb => cb.checked = checkbox.checked);
            showToast(`${checkbox.checked ? 'Selected' : 'Deselected'} all`, 'info');
        }
        function previousPage() { showToast('Previous page...', 'info'); }
        function nextPage() { showToast('Next page...', 'info'); }

        function showToast(message, type = 'success') {
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toast-message');
            const icon = toast.querySelector('i');
            
            icon.className = 'fas mr-3';
            toast.className = 'fixed top-4 right-4 bg-white rounded-lg shadow-lg p-4 transform transition-transform duration-300 z-50';
            
            switch(type) {
                case 'success':
                    icon.className += ' fa-check-circle text-green-500';
                    toast.className += ' border-l-4 border-green-500';
                    break;
                case 'warning':
                    icon.className += ' fa-exclamation-triangle text-yellow-500';
                    toast.className += ' border-l-4 border-yellow-500';
                    break;
                case 'info':
                    icon.className += ' fa-info-circle text-blue-500';
                    toast.className += ' border-l-4 border-blue-500';
                    break;
                case 'error':
                    icon.className += ' fa-times-circle text-red-500';
                    toast.className += ' border-l-4 border-red-500';
                    break;
            }
            
            toastMessage.textContent = message;
            toast.style.transform = 'translateX(0)';
            setTimeout(() => toast.style.transform = 'translateX(100%)', 3000);
        }
        function hitungStatistikKonseling() {
    const konselingRef = firebase.database().ref('jadwal_konseling');

    konselingRef.once('value', (snapshot) => {
        const data = snapshot.val();
        if (!data) return;

        const mahasiswaSet = new Set();
        const psikologSet = new Set();
        let jumlahBaru = 0;
        let jumlahLanjut = 0;

        Object.values(data).forEach(item => {
            if (item.userId) {
                mahasiswaSet.add(item.userId); // Unik per mahasiswa
            }

            if (item.psikolog) {
                psikologSet.add(item.psikolog); // Unik berdasarkan nama psikolog
            }

            if (item.jenis_kunjungan === 'baru') {
                jumlahBaru++;
            } else if (item.jenis_kunjungan === 'lanjut') {
                jumlahLanjut++;
            }
        });
        console.log('Total Mahasiswa Konseling (Unik):', mahasiswaSet.size);
        console.log('Total Psikolog (Unik):', psikologSet.size);
        console.log('Total Kunjungan Baru:', jumlahBaru);
        console.log('Total Kunjungan Lanjut:', jumlahLanjut);

        const mahasiswaCounter = document.querySelector('#counseling-students .counter');
        if (mahasiswaCounter) {
        mahasiswaCounter.textContent = mahasiswaSet.size;
        mahasiswaCounter.setAttribute('data-count', mahasiswaSet.size);
        }

// Total Psikolog (Unik)
        

// Total Kunjungan Baru
        const baruCounter = document.querySelector('#new-counseling-count .counter');
        if (baruCounter) {
        baruCounter.textContent = jumlahBaru;
     baruCounter.setAttribute('data-count', jumlahBaru);
        }

// Total Kunjungan Lanjut
        const lanjutCounter = document.querySelector('#follow-up-counseling-count .counter');
        if (lanjutCounter) {
        lanjutCounter.textContent = jumlahLanjut;
        lanjutCounter.setAttribute('data-count', jumlahLanjut);
}


        // Update ke elemen HTML jika ada
        // document.getElementById('total-mahasiswa')?.innerText = mahasiswaSet.size;
        // document.getElementById('total-psikolog')?.innerText = psikologSet.size;
        // document.getElementById('kunjungan-baru')?.innerText = jumlahBaru;
        // document.getElementById('kunjungan-lanjut')?.innerText = jumlahLanjut;
    });
};

const psikologRef = db.ref('users');
const PAGE_SIZE = 3;

let lastKey = null;
let firstKey = null;
let pageStack = [];

const nextBtn = document.getElementById('nextBtn');
const prevBtn = document.getElementById('prevBtn');

function loadFirstPage() {
  psikologRef.orderByChild('status').equalTo('psikolog').once('value', snapshot => {
    const data = snapshot.val();
    if (!data) return;

    const keys = Object.keys(data);
    const displayKeys = keys.slice(0, PAGE_SIZE);
    const displayData = {};
    displayKeys.forEach(k => displayData[k] = data[k]);

    // Update count
    const psikologCounter = document.querySelector('#psychologists-count .counter');
    if (psikologCounter) {
      psikologCounter.textContent = keys.length;
      psikologCounter.setAttribute('data-count', keys.length);
    }

    firstKey = displayKeys[0];
    lastKey = displayKeys[displayKeys.length - 1];
    pageStack = [firstKey];

    renderTable(displayData);

    nextBtn.disabled = (keys.length <= PAGE_SIZE);
    prevBtn.disabled = true;
  });
}

function loadNextPage() {
  if (!lastKey) return;

  psikologRef.orderByKey().startAfter(lastKey).limitToFirst(PAGE_SIZE + 5).once('value', snapshot => {
    const data = snapshot.val();
    if (!data) return;

    // Filter hanya yang status psikolog
    const filteredEntries = Object.entries(data).filter(([key, user]) => user.status === 'psikolog');

    if (filteredEntries.length === 0) return;

    const displayEntries = filteredEntries.slice(0, PAGE_SIZE);
    const displayData = {};
    displayEntries.forEach(([k, v]) => displayData[k] = v);

    firstKey = displayEntries[0][0];
    lastKey = displayEntries[displayEntries.length - 1][0];
    pageStack.push(firstKey);

    renderTable(displayData);

    prevBtn.disabled = false;
    nextBtn.disabled = (filteredEntries.length <= PAGE_SIZE);
  });
}

function loadPrevPage() {
  if (pageStack.length <= 1) return;

  pageStack.pop(); // remove current
  const prevFirstKey = pageStack[pageStack.length - 1];

  psikologRef.orderByKey().endAt(prevFirstKey).limitToLast(PAGE_SIZE + 5).once('value', snapshot => {
    const data = snapshot.val();
    if (!data) return;

    // Filter hanya yang status psikolog
    const filteredEntries = Object.entries(data).filter(([key, user]) => user.status === 'psikolog');

    if (filteredEntries.length === 0) return;

    const displayEntries = filteredEntries.slice(0, PAGE_SIZE);
    const displayData = {};
    displayEntries.forEach(([k, v]) => displayData[k] = v);

    firstKey = displayEntries[0][0];
    lastKey = displayEntries[displayEntries.length - 1][0];

    renderTable(displayData);

    prevBtn.disabled = (pageStack.length <= 1);
    nextBtn.disabled = false;
  });
}


function renderTable(data) {
  const tbody = document.getElementById("table-body");
  tbody.innerHTML = "";

  Object.entries(data).forEach(([key, user]) => {
    console.log("Rendering user:", key, user);
    const name = user.nama_lengkap || "-";
    const role = user.status || "-";
    const bidang = user.spesialisasi || "Psikologi Umum";
    const jadwal = user.hari || "-";
    const telp = user.phone || "-";
    const cuti = user.cuti; // Asumsi semua psikolog aktif, bisa diubah sesuai data
    const initials = name.split(' ').map(w => w[0]).join('').substring(0, 2).toUpperCase();
    const statusClass = cuti === "tidak"
      ? "bg-green-100 text-green-800"
      : "bg-yellow-100 text-yellow-800";
    const statusIcon = cuti === "tidak"
      ? '<i class="fas fa-circle mr-1 text-xs"></i>Aktif'
      : '<i class="fas fa-pause mr-1 text-xs"></i>Cuti';

    const actionButtons = cuti === "tidak" ? `
      <button class="text-blue-600 hover:text-blue-800 p-2" onclick="viewPsychologist('${key}')">
          <i class="fas fa-eye"></i>
      </button>
      <button class="text-yellow-600 hover:text-yellow-800 p-2" onclick="editPsychologist('${key}')">
          <i class="fas fa-edit"></i>
      </button>
      <button class="text-yellow-600 hover:text-yellow-800 p-2" onclick="setPsychologistOnLeave('${key}')">
    <i class="fas fa-pause"></i>
</button>

    ` : `
      <button class="text-blue-600 hover:text-blue-800 p-2" onclick="viewPsychologist('${key}')">
          <i class="fas fa-eye"></i>
      </button>
      <button class="text-gray-400 cursor-not-allowed p-2" disabled>
          <i class="fas fa-edit"></i>
      </button>
      <button class="text-green-600 hover:text-green-800 p-2" onclick="activatePsychologist('${key}')">
          <i class="fas fa-play"></i>
      </button>

    `;

    const row = document.createElement("tr");
    row.className = "border-b border-gray-100 table-row";
    row.innerHTML = `
      <td class="py-4">
          <input type="checkbox" class="rounded">
      </td>
      <td class="py-4">
          <div class="flex items-center space-x-3">
              <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                  ${initials}
              </div>
              <div>
                  <div class="font-semibold text-gray-900">${name}</div>
                  <div class="text-sm text-gray-500">${role}</div>
              </div>
          </div>
      </td>
      <td class="py-4">
          <span class="bg-blue-100 text-blue-800 text-xs font-medium px-3 py-1 rounded-full">
              ${bidang}
          </span>
      </td>
      <td class="py-4 text-sm text-gray-600">${jadwal}</td>
      <td class="py-4 text-sm text-gray-600">${telp}</td>
      <td class="py-4">
          <span class="${statusClass} text-xs font-medium px-3 py-1 rounded-full flex items-center w-fit">
              ${statusIcon}
          </span>
      </td>
      <td class="py-4">
          <div class="flex space-x-2">
              ${actionButtons}
          </div>
      </td>
    `;

    tbody.appendChild(row);
  });
}
    function savePsychologist(event) {
  event.preventDefault();

  const idPsikolog = document.getElementById('idPsikolog').value.trim();
  const nama = document.getElementById('nama').value.trim();
  const nomorTelepon = document.getElementById('nomorTelepon').value.trim();
  const spesialisasi = document.getElementById('spesialisasi').value.trim();

  const hari = [];
  document.querySelectorAll('.day-selector').forEach(btn => {
    if (btn.dataset.selected === "true") {
      const onclickAttr = btn.getAttribute('onclick');
      const match = onclickAttr.match(/'([^']+)'/);
      if (match) hari.push(match[1]);
    }
  });
  console.log("Selected days:", hari);

  const data = {
    idPsikolog,
    nama,
    nomorTelepon,
    spesialisasi,
    hari,
    status: "psikolog"
  };

  const ref = firebase.database().ref('users');
  if (editingKey) {
    // Mode edit
    ref.child(editingKey).update(data)
      .then(() => {
        alert("Data berhasil diperbarui");
        resetForm();
      });
  } else {
    // Mode tambah
    ref.push(data)
      .then(() => {
        alert("Data berhasil ditambahkan");
        resetForm();
      });
  }
}
function resetForm() {
  document.querySelector('form').reset();
  editingKey = null;

  // Reset tombol hari
  document.querySelectorAll('.day-selector').forEach(btn => {
    btn.classList.remove('bg-telusafe-red', 'text-white');
    btn.classList.add('text-telusafe-red');
    btn.dataset.selected = "false";
  });
}
const jadwalRef = firebase.database().ref('jadwal_konseling');
const baseX = 80;
const stepX = 80;

jadwalRef.once('value').then(snapshot => {
  const data = snapshot.val();
  if (!data) return;

  // Buat objek untuk count per bulan
  // Index 0 = Jan, 1=Feb, dst.
  const counts = new Array(12).fill(0);

  Object.values(data).forEach(item => {
    const tanggal = item.tanggal; // "dd-mm-yyyy"
    if (!tanggal) return;

    // Parse tanggal
    const parts = tanggal.split('-');
    if (parts.length !== 3) return;

    const day = parseInt(parts[0]);
    const month = parseInt(parts[1]); // 1-12
    const year = parseInt(parts[2]);

    // Filter tahun 2025 misalnya
    if (year === 2025) {
      counts[month - 1] += 1; // jumlah untuk bulan tersebut bertambah
    }

  });

  updateChart(counts);
});
function updateChart(values) {
  const svg = document.querySelector('svg');
  
  // Build path string
  let pathD = `M${baseX} ${valueToY(values[0])}`;
  for (let i = 1; i < values.length; i++) {
    const x = baseX + stepX * i;
    const y = valueToY(values[i]);
    pathD += ` C${x - stepX / 2} ${valueToY(values[i - 1])} ${x - stepX / 2} ${y} ${x} ${y}`;
  }

  // Update main trend line path
  const trendLine = svg.querySelector('#trendLine');
  if (trendLine) trendLine.setAttribute('d', pathD);

  // Update area fill path (tambahkan tutup area ke bawah)
  const areaPath = svg.querySelector('#areaFill');
  if (areaPath) {
    areaPath.setAttribute('d', pathD + ` L${baseX + stepX * (values.length - 1)} 320 L${baseX} 320 Z`);
  }

  // Update circles posisi
  const circles = svg.querySelectorAll('circle');
  circles.forEach((circle, i) => {
    const cx = baseX + stepX * i;
    const cy = valueToY(values[i]);
    circle.setAttribute('cx', cx);
    circle.setAttribute('cy', cy);
  });

  // Update bulan labels (text)
  const labels = svg.querySelectorAll('text');
  const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu'];
  for (let i = 0; i < monthNames.length; i++) {
    if (labels[i]) {
      labels[i].setAttribute('x', baseX + stepX * i);
      labels[i].textContent = monthNames[i];
    }
  }
}
function valueToY(value) {
  const maxVal = 120;
  const minY = 320; // posisi y untuk 0
  const maxY = 80;  // posisi y untuk maxVal
  // linear scaling
  return minY - (value / maxVal) * (minY - maxY);
}



        // Hitung statistik konseling saat halaman dimuat
window.onload = hitungStatistikKonseling;
window.onload = loadFirstPage;
window.onload = fetchDataAndRenderChart;
    </script>
</body>
</html>