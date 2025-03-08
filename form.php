<?php
session_start();

// Validasi sesi pengguna
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Simpan data ke session
    $_SESSION['nama'] = $_POST['nama'];
    $_SESSION['ttl'] = $_POST['ttl'];
    $_SESSION['pendidikan'] = $_POST['pendidikan'];
    $_SESSION['pengalaman'] = $_POST['pengalaman'];
    $_SESSION['hard_skill'] = $_POST['hard_skill'];
    $_SESSION['soft_skill'] = $_POST['soft_skill'];
    $_SESSION['prestasi'] = $_POST['prestasi'];
    $_SESSION['project'] = $_POST['project'];
    $_SESSION['foto'] = $_FILES['foto']['name']; // Simpan nama file foto
    $_SESSION['quotes'] = $_POST['quotes']; // Simpan quotes
    $_SESSION['telepon'] = $_POST['telepon']; // Simpan nomor telepon
    $_SESSION['lokasi'] = $_POST['lokasi']; // Simpan lokasi
    $_SESSION['email'] = $_POST['email']; // Simpan email

    // Simpan file foto ke folder uploads
    move_uploaded_file($_FILES['foto']['tmp_name'], 'uploads/' . $_FILES['foto']['name']);

    // Redirect ke halaman CV
    header("Location: cv.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form CV</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-2xl w-full max-w-md transform transition-all duration-300 hover:scale-105 mt-8 mb-8">
        <h1 class="text-3xl font-bold text-center mb-6 text-gray-800">Buat CV Anda</h1>
        <form method="POST" action="" enctype="multipart/form-data" class="space-y-6">
            <!-- Foto Profil -->
            <div>
                <label for="foto" class="block text-sm font-medium text-gray-700">Foto Profil:</label>
                <div class="mt-1">
                    <input
                        type="file"
                        id="foto"
                        name="foto"
                        required
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                    >
                </div>
            </div>

            <!-- Nama Lengkap -->
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap:</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        required
                        class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Masukkan nama lengkap"
                    >
                </div>
            </div>

            <!-- Tempat, Tanggal Lahir -->
            <div>
                <label for="ttl" class="block text-sm font-medium text-gray-700">Tempat, Tanggal Lahir:</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-calendar-alt text-gray-400"></i>
                    </div>
                    <input
                        type="text"
                        id="ttl"
                        name="ttl"
                        required
                        class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Contoh: Jakarta, 1 Januari 1990"
                    >
                </div>
            </div>

            <!-- Quotes -->
            <div>
                <label for="quotes" class="block text-sm font-medium text-gray-700">Quotes:</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 pt-3 flex items-start pointer-events-none">
                        <i class="fas fa-quote-left text-gray-400"></i>
                    </div>
                    <textarea
                        id="quotes"
                        name="quotes"
                        rows="2"
                        class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Contoh: Berkembang setiap hari, melampaui batas, dan menciptakan dampak."
                    ></textarea>
                </div>
            </div>

            <!-- Nomor Telepon -->
            <div>
                <label for="telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon:</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-phone text-gray-400"></i>
                    </div>
                    <input
                        type="text"
                        id="telepon"
                        name="telepon"
                        required
                        class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Contoh: +62 813 4877 4066"
                    >
                </div>
            </div>

            <!-- Lokasi -->
            <div>
                <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi:</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-map-marker-alt text-gray-400"></i>
                    </div>
                    <input
                        type="text"
                        id="lokasi"
                        name="lokasi"
                        required
                        class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Contoh: Balikpapan, Indonesia"
                    >
                </div>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </div>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        required
                        class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Contoh: aryawardhana1@student.ub.ac.id"
                    >
                </div>
            </div>

            <!-- Riwayat Pendidikan -->
            <div>
                <label for="pendidikan" class="block text-sm font-medium text-gray-700">Riwayat Pendidikan:</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 pt-3 flex items-start pointer-events-none">
                        <i class="fas fa-graduation-cap text-gray-400"></i>
                    </div>
                    <textarea
                        id="pendidikan"
                        name="pendidikan"
                        rows="4"
                        required
                        class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Contoh: S1 Teknik Informatika, Universitas Contoh"
                    ></textarea>
                </div>
            </div>

            <!-- Pengalaman Kerja -->
            <div>
                <label for="pengalaman" class="block text-sm font-medium text-gray-700">Pengalaman Kerja:</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 pt-3 flex items-start pointer-events-none">
                        <i class="fas fa-briefcase text-gray-400"></i>
                    </div>
                    <textarea
                        id="pengalaman"
                        name="pengalaman"
                        rows="4"
                        required
                        class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Contoh: Software Engineer di PT. Contoh (2020 - Sekarang)"
                    ></textarea>
                </div>
            </div>

            <!-- Hard Skill -->
            <div>
                <label for="hard_skill" class="block text-sm font-medium text-gray-700">Hard Skill:</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 pt-3 flex items-start pointer-events-none">
                        <i class="fas fa-tools text-gray-400"></i>
                    </div>
                    <textarea
                        id="hard_skill"
                        name="hard_skill"
                        rows="2"
                        required
                        class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Contoh: JavaScript, React, PHP, MySQL"
                    ></textarea>
                </div>
            </div>

            <!-- Proyek -->
            <div>
                <label for="project" class="block text-sm font-medium text-gray-700">Proyek:</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 pt-3 flex items-start pointer-events-none">
                        <i class="fas fa-project-diagram text-gray-400"></i>
                    </div>
                    <textarea
                        id="project"
                        name="project"
                        rows="4"
                        class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Contoh: 
BATARAFEST Website
Website untuk mendukung kegiatan duta budaya dengan fitur informasi event dan registrasi peserta.
SMILEKIDS Website
Website untuk daycare dengan fitur pemantauan anak dan komunikasi orang tua.
TanyaKakak Website
Sistem mentorship bagi mahasiswa yang ingin berkembang di bidang akademik dan karir."
                    ></textarea>
                </div>
            </div>

            <!-- Soft Skill -->
            <div>
                <label for="soft_skill" class="block text-sm font-medium text-gray-700">Soft Skill:</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 pt-3 flex items-start pointer-events-none">
                        <i class="fas fa-comments text-gray-400"></i>
                    </div>
                    <textarea
                        id="soft_skill"
                        name="soft_skill"
                        rows="2"
                        required
                        class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Contoh: Komunikasi, Kerja Tim, Manajemen Waktu"
                    ></textarea>
                </div>
            </div>

            <!-- Prestasi -->
            <div>
                <label for="prestasi" class="block text-sm font-medium text-gray-700">Prestasi:</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 pt-3 flex items-start pointer-events-none">
                        <i class="fas fa-trophy text-gray-400"></i>
                    </div>
                    <textarea
                        id="prestasi"
                        name="prestasi"
                        rows="4"
                        required
                        class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Contoh: Juara 1 Lomba Coding Nasional 2022"
                    ></textarea>
                </div>
            </div>

            <!-- Tombol Submit -->
            <div>
                <button
                    type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 hover:shadow-lg"
                >
                    Buat CV
                </button>
            </div>
        </form>

        <!-- Tombol Logout -->
        <div class="mt-6 text-center">
            <a href="logout.php" class="text-sm text-indigo-600 hover:text-indigo-500">Logout</a>
        </div>
    </div>
</body>
</html>