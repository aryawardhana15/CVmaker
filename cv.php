
<?php
session_start();

// Validasi sesi pengguna
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

// Ambil data dari session dengan sanitasi
$user_data = [
    'email' => htmlspecialchars($_SESSION['email'] ?? 'Email tidak tersedia'),
    'nama' => htmlspecialchars($_SESSION['nama'] ?? 'Nama Belum Diisi'),
    'ttl' => htmlspecialchars($_SESSION['ttl'] ?? 'Tanggal Lahir Belum Diisi'),
    'pendidikan' => $_SESSION['pendidikan'] ?? 'Belum ada riwayat pendidikan',
    'pengalaman' => $_SESSION['pengalaman'] ?? 'Belum ada pengalaman kerja',
    'hard_skill' => $_SESSION['hard_skill'] ?? 'Belum ada hard skill',
    'soft_skill' => $_SESSION['soft_skill'] ?? 'Belum ada soft skill',
    'prestasi' => $_SESSION['prestasi'] ?? 'Belum ada prestasi',
    'project' => $_SESSION['project'] ?? 'Belum ada proyek',
    'foto' => $_SESSION['foto'] ?? 'default.jpg'
];
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Profesional - <?php echo $user_data['nama']; ?></title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Alpine.js untuk interaktivitas -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f6f8f9 0%, #e5ebee 100%);
        }
        .section-card {
            transition: all 0.3s ease-in-out;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }
        .section-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-6xl">
        <!-- Kontainer Utama -->
        <div class="bg-white rounded-3xl overflow-hidden shadow-2xl border border-gray-100">
            <!-- Header Profil -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white p-6">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <!-- Foto Profil -->
                    <div class="flex items-center space-x-6">
                        <img 
                            src="uploads/<?php echo $user_data['foto']; ?>" 
                            alt="Foto Profil" 
                            class="w-36 h-36 rounded-full object-cover border-4 border-white shadow-lg"
                        >
                        <div>
                            <h1 class="text-4xl font-bold mb-2"><?php echo $user_data['nama']; ?></h1>
                            <p class="text-xl opacity-80"><?php echo $user_data['email']; ?></p>
                            <p class="text-lg opacity-70"><?php echo $user_data['ttl']; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Konten CV -->
            <div class="p-8">
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Pendidikan -->
                    <div class="section-card bg-blue-50 p-6 rounded-2xl">
                        <h2 class="text-2xl font-semibold text-blue-700 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l9 5-9 5-9-5 9-5z" />
                            </svg>
                            Riwayat Pendidikan
                        </h2>
                        <ul class="list-disc list-inside text-gray-700 space-y-2">
                            <?php
                            $pendidikanList = explode("\n", $user_data['pendidikan']);
                            foreach ($pendidikanList as $item) {
                                echo "<li>" . htmlspecialchars(trim($item)) . "</li>";
                            }
                            ?>
                        </ul>
                    </div>

                    <!-- Pengalaman Kerja -->
                    <div class="section-card bg-green-50 p-6 rounded-2xl">
                        <h2 class="text-2xl font-semibold text-green-700 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Pengalaman Kerja
                        </h2>
                        <ul class="list-disc list-inside text-gray-700 space-y-2">
                            <?php
                            $pengalamanList = explode("\n", $user_data['pengalaman']);
                            foreach ($pengalamanList as $item) {
                                echo "<li>" . htmlspecialchars(trim($item)) . "</li>";
                            }
                            ?>
                        </ul>
                    </div>

                                        <!-- Proyek -->
                                        <div class="section-card bg-indigo-50 p-6 rounded-2xl">
                        <h2 class="text-2xl font-semibold text-indigo-700 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                            </svg>
                            Proyek
                        </h2>
                        <ul class="list-disc list-inside text-gray-700 space-y-2">
                            <?php
                            $projectList = explode("\n", $user_data['project']);
                            foreach ($projectList as $item) {
                                echo "<li>" . htmlspecialchars(trim($item)) . "</li>";
                            }
                            ?>
                        </ul>
                    </div>

                    <!-- Hard Skill -->
                    <div class="section-card bg-purple-50 p-6 rounded-2xl">
                        <h2 class="text-2xl font-semibold text-purple-700 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                            </svg>
                            Hard Skill
                        </h2>
                        <ul class="list-disc list-inside text-gray-700 space-y-2">
                            <?php
                            $hardSkillList = explode(",", $user_data['hard_skill']);
                            foreach ($hardSkillList as $item) {
                                echo "<li>" . htmlspecialchars(trim($item)) . "</li>";
                            }
                            ?>
                        </ul>
                    </div>

                    <!-- Soft Skill dan Prestasi -->
                    <div class="space-y-8">
                        <!-- Soft Skill -->
                        <div class="section-card bg-yellow-50 p-6 rounded-2xl">
                            <h2 class="text-2xl font-semibold text-yellow-700 mb-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                                Soft Skill
                            </h2>
                            <ul class="list-disc list-inside text-gray-700 space-y-2">
                                <?php
                                $softSkillList = explode(",", $user_data['soft_skill']);
                                foreach ($softSkillList as $item) {
                                    echo "<li>" . htmlspecialchars(trim($item)) . "</li>";
                                }
                                ?>
                            </ul>
                        </div>

                        <!-- Prestasi -->
                        <div class="section-card bg-red-50 p-6 rounded-2xl">
                            <h2 class="text-2xl font-semibold text-red-700 mb-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                </svg>
                                Prestasi
                            </h2>
                            <ul class="list-disc list-inside text-gray-700 space-y-2">
                                <?php
                                $prestasiList = explode("\n", $user_data['prestasi']);
                                foreach ($prestasiList as $item) {
                                    echo "<li>" . htmlspecialchars(trim($item)) . "</li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Aksi -->
            <div class="bg-gray-100 p-6 flex justify-center space-x-4">
                <a href="form.php" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit CV
                </a>
                <a href="logout.php" class="px-6 py-3 bg-red-600 text-white rounded-lg hover-bg-red-700 transition flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Keluar
                </a>
                <button onclick="window.print()" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
</svg>
Cetak CV
</button>
</div>
</div>
</div>
</body>
</html>
