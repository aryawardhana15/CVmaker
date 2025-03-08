<?php
session_start();


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
{
    header("Location: index.php");
    exit;
}


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
    'foto' => $_SESSION['foto'] ?? 'default.jpg',
    'quotes' => $_SESSION['quotes'] ?? 'Belum ada quotes', // Ambil quotes dari session
    'telepon' => $_SESSION['telepon'] ?? 'Belum ada nomor telepon', // Ambil nomor telepon dari session
    'lokasi' => $_SESSION['lokasi'] ?? 'Belum ada lokasi', // Ambil lokasi dari session
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV - <?php echo $user_data['nama']; ?></title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
        
        
        body {
            font-family: 'Poppins', sans-serif;
            background: #121212;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #ffffff;
        }

      
        .container {
            display: flex;
            flex-direction: column;
            max-width: 900px;
            background: #1e1e1e;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.7);
            overflow: hidden;
            width: 100%;
        }

  
        .sidebar {
            background: #181818;
            color: white;
            padding: 20px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .sidebar img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #444;
            margin-bottom: 10px;
        }

        .sidebar h1 {
            font-size: 22px;
            margin-bottom: 5px;
            color: #e67e22;
            animation: glow 2s infinite alternate;
        }

        .sidebar p {
            font-size: 14px;
            margin: 5px 0;
        }

        .sidebar .contact {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar .contact p {
            display: flex;
            align-items: center;
        }

        .sidebar .divider {
            width: 80%;
            height: 2px;
            background: linear-gradient(90deg, #ff9800, #e67e22, #ff9800);
            background-size: 200% 100%;
            margin: 15px 0;
            animation: gradientAnimation 3s linear infinite;
        }

        .sidebar .motto {
            font-size: 14px;
            font-style: italic;
            color: #ff9800;
            animation: pulse 2s infinite;
        }

        .sidebar .skills {
            margin-top: 15px;
            text-align: left;
            width: 100%;
        }

        .sidebar .skills h2 {
            font-size: 16px;
            color: #e67e22;
            border-bottom: 2px solid #e67e22;
            padding-bottom: 5px;
            margin-bottom: 10px;
            animation: glow 2s infinite alternate;
        }

        .sidebar .skill-list {
            font-size: 14px;
            line-height: 1.5;
        }

        /* Content */
        .content {
            width: 100%;
            padding: 20px;
        }

        .section {
            margin-bottom: 20px;
        }

        .section h2 {
            font-size: 18px;
            color: #e67e22;
            border-bottom: 2px solid #e67e22;
            padding-bottom: 5px;
            margin-bottom: 10px;
            animation: glow 2s infinite alternate;
        }

        .section ul {
            padding-left: 20px;
            list-style-type: square;
        }

        .section ul li {
            margin-bottom: 8px;
        }

        .contact-info p {
            margin: 8px 0;
            font-size: 12px;
        }

        .contact-info i {
            color: #f39c12;
            margin-right: 8px;
            transition: color 0.3s ease;
        }

        .contact-info i:hover {
            color: #e67e22;
        }

        .contact-info a {
            text-decoration: none;
            color: #ffffff;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .contact-info a:hover {
            color: #f39c12;
        }

        .sidebar .name {
            animation: electricGlow 2s infinite;
        }

        .section .judul {
            text-decoration: none;
            color: #f39c12;
            font-weight: bold;
            animation: lightMove 3s linear infinite;
            display: inline-block;
            background: linear-gradient(120deg, rgba(255, 165, 0, 0.2) 30%, rgba(255, 215, 0, 0.9) 50%, rgba(255, 165, 0, 0.2) 70%);
            background-size: 200% 100%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Animasi Glow yang Diperbaiki */
        @keyframes neonFlicker {
            0% {
                text-shadow: 0 0 5px rgba(230, 126, 34, 0.8), 0 0 10px rgba(230, 126, 34, 0.6), 0 0 20px rgba(230, 126, 34, 0.4);
                opacity: 1;
            }
            25% {
                text-shadow: 0 0 8px rgba(230, 126, 34, 0.9), 0 0 15px rgba(230, 126, 34, 0.7), 0 0 30px rgba(230, 126, 34, 0.5);
                opacity: 0.8;
            }
            50% {
                text-shadow: 0 0 3px rgba(230, 126, 34, 0.5), 0 0 7px rgba(230, 126, 34, 0.3), 0 0 15px rgba(230, 126, 34, 0.2);
                opacity: 0.6;
            }
            75% {
                text-shadow: 0 0 10px rgba(230, 126, 34, 1), 0 0 20px rgba(230, 126, 34, 0.9), 0 0 40px rgba(230, 126, 34, 0.7);
                opacity: 1;
            }
            100% {
                text-shadow: 0 0 4px rgba(230, 126, 34, 0.7), 0 0 8px rgba(230, 126, 34, 0.5), 0 0 15px rgba(230, 126, 34, 0.3);
                opacity: 0.9;
            }
        }

        .flicker-text {
            font-size: 22px;
            font-weight: bold;
            color: #e67e22;
            animation: neonFlicker 1.5s infinite alternate !important;
        }

        @keyframes electricGlow {
            0%, 100% {
                text-shadow: 0 0 8px rgba(255, 215, 0, 0.8), 0 0 15px rgba(255, 185, 0, 0.6);
            }
            10% {
                text-shadow: 0 0 12px rgba(255, 215, 0, 1), 0 0 20px rgba(255, 165, 0, 0.8);
            }
            20%, 80% {
                text-shadow: none;
            }
        }

        .electric-text {
            font-size: 36px;
            font-weight: bold;
            color: #ffcc00;
            animation: electricGlow 2s infinite;
        }

        @keyframes wave {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-5px);
            }
        }

        .wave-text {
            font-size: 18px;
            font-weight: bold;
            color: #e67e22;
            display: inline-block;
            animation: wave 2s infinite ease-in-out !important;
        }

        @keyframes lightMove {
            0% {
                background-position: 100%;
            }
            100% {
                background-position: 0%;
            }
        }

        .glow-text {
            font-size: 36px;
            font-weight: bold;
            color: white;
            text-transform: uppercase;
            position: relative;
            display: inline-block;
            background: linear-gradient(120deg, rgba(255, 255, 255, 0.1) 30%, rgba(255, 255, 255, 0.8) 50%, rgba(255, 255, 255, 0.1) 70%);
            background-size: 200% 100%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: lightMove 3s linear infinite;
        }

        /* Footer Aksi */
.footer-actions {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 20px;
    padding: 20px;
    background: #1e1e1e;
    border-top: 2px solid #444;
}

.footer-actions button,
.footer-actions a {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.3s ease;
    text-decoration: none;
}

.footer-actions button:hover,
.footer-actions a:hover {
    transform: translateY(-3px);
}

/* Tombol Cetak */
.btn-print {
    background: #4CAF50;
    color: white;
}

.btn-print:hover {
    background: #45a049;
}

/* Tombol Edit */
.btn-edit {
    background: #2196F3;
    color: white;
}

.btn-edit:hover {
    background: #1e88e5;
}

/* Tombol Logout */
.btn-logout {
    background: #f44336;
    color: white;
}

.btn-logout:hover {
    background: #e53935;
}

        /* Media Queries untuk Responsivitas */
        @media (min-width: 768px) {
            .container {
                flex-direction: row;
            }
            .sidebar {
                width: 35%;
            }
            .content {
                width: 65%;
            }
        }

        @media (max-width: 767px) {
            .sidebar {
                padding-right: 50px;
            }
            .container {
                flex-direction: column;
            }
            .sidebar, .content {
                width: 100%;
            }
            .sidebar img {
                width: 100px;
                height: 100px;
                margin-right: 50px;
            }
            .sidebar .name {
                margin-right: 50px;
            }
            .sidebar .contact-info {
                margin-right: 50px;
            }
            .sidebar h1 {
                font-size: 20px;
            }
            .section h2 {
                font-size: 16px;
            }
            .section ul li {
                font-size: 14px;
            }
            .sidebar .motto {
                font-size: small;
                margin-left: -40px;
            }
            .sidebar .divider {
                margin-left: -40px;
            }
            .section .description {
                font-size: 14px;
                margin-right: 40px;
            }
            #achievements-list {
                padding-right: 40px;
            }
            #deskripsi {
                padding-right: 40px;
            }
        }

        @media (max-width: 480px) {
            .sidebar {
                padding-right: 50px;
            }
            .container {
                flex-direction: column;
            }
            .sidebar, .content {
                width: 100%;
            }
            .sidebar img {
                width: 100px;
                height: 100px;
                margin-right: 50px;
            }
            .sidebar .name {
                margin-right: 50px;
            }
            .sidebar .contact-info {
                margin-right: 50px;
            }
            .sidebar h1 {
                font-size: 20px;
            }
            .section h2 {
                font-size: 16px;
            }
            .section ul li {
                font-size: 14px;
            }
            .sidebar .motto {
                font-size: small;
                padding: 30px;
            }
            .sidebar .divider {
                margin-left: -40px;
            }
            .section .description {
                font-size: 14px;
                margin-right: 40px;
            }
            #achievements-list {
                padding-right: 40px;
            }
            #deskripsi {
                padding-right: 40px;
            }
            .job-list {
                padding-right: 40px;
            }
        }
    </style>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <img src="uploads/<?php echo $user_data['foto']; ?>" alt="<?php echo $user_data['nama']; ?>">
            <h1 class="name"><?php echo $user_data['nama']; ?></h1>
            <div class="contact-info">
                <p><i class="fas fa-envelope"></i> <a href="mailto:<?php echo $user_data['email']; ?>"><?php echo $user_data['email']; ?></a></p>
                <p><i class="fas fa-phone"></i> <a href="tel:<?php echo $user_data['telepon']; ?>"><?php echo $user_data['telepon']; ?></a></p>
                <p><i class="fas fa-map-marker-alt"></i> <?php echo $user_data['lokasi']; ?></p>
            </div>
            <div class="divider"></div>

            <p class="motto"><?php echo $user_data['quotes']; ?></p>
            <div class="skills">
                <section>
                    <h2>Bahasa</h2>
                    <ul class="skill-list">
                        <li>Indonesia</li>
                        <li>English</li>
                    </ul>
                </section>

                <section>
                    <h2>Soft Skill</h2>
                    <ul class="skill-list">
                        <?php
                        $softSkillList = explode("\n", $user_data['soft_skill']);
                        foreach ($softSkillList as $item) {
                            echo "<li>" . htmlspecialchars(trim($item)) . "</li>";
                        }
                        ?>
                    </ul>
                </section>

                <section>
                    <h2>Hard Skill</h2>
                    <ul class="skill-list">
                        <?php
                        $hardSkillList = explode("\n", $user_data['hard_skill']);
                        foreach ($hardSkillList as $item) {
                            echo "<li>" . htmlspecialchars(trim($item)) . "</li>";
                        }
                        ?>
                    </ul>
                </section>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Ringkasan -->
            <div class="section">
                <h2 class="wave-text">Ringkasan</h2>
                <p class="description"><?php echo $user_data['nama']; ?> adalah seorang profesional di bidang Sistem Informasi dengan komitmen tinggi terhadap inovasi dan pengembangan. Berpengalaman dalam manajemen media sosial dan pengembangan proyek digital.</p>
            </div>

            <!-- Pendidikan -->
            <div class="section">
                <h2 class="wave-text">Pendidikan</h2>
                <ul style="list-style: none; padding: 0;">
                    <?php
                    $pendidikanList = explode("\n", $user_data['pendidikan']);
                    foreach ($pendidikanList as $item) {
                        echo "<li style='margin-bottom: 10px;'><strong>" . htmlspecialchars(trim($item)) . "</strong></li>";
                    }
                    ?>
                </ul>
            </div>
                    
            <!-- Pengalaman Kerja -->
            <div class="section">
                <h2 class="wave-text">Pengalaman Kerja</h2>
                <ul class="job-list">
                    <?php
                    $pengalamanList = explode("\n", $user_data['pengalaman']);
                    foreach ($pengalamanList as $item) {
                        echo "<li>" . htmlspecialchars(trim($item)) . "</li>";
                    }
                    ?>
                </ul>
            </div>

            <!-- Prestasi -->
            <div class="section">
                <h2 class="wave-text">Prestasi & Sertifikat</h2>
                <ul class="achievement-list" id="achievements-list">
                    <?php
                    $prestasiList = explode("\n", $user_data['prestasi']);
                    foreach ($prestasiList as $item) {
                        echo "<li><span class='medal'>" . htmlspecialchars(trim($item)) . "</span></li>";
                    }
                    ?>
                </ul>
            </div>

          
           <!-- Proyek -->
<div class="section">
    <h2 class="wave-text">Proyek</h2>
    <ul id="projects-list" style="list-style: none; padding: 0;">
        <?php
        // Ambil data proyek dari session
        $projectList = explode("\n", $user_data['project']);
        $projectCount = count($projectList);

        // Loop untuk menampilkan setiap proyek
        for ($i = 0; $i < $projectCount; $i += 2) {
            $namaProyek = trim($projectList[$i]);
            $deskripsiProyek = trim($projectList[$i + 1] ?? ''); // Pastikan deskripsi ada
            if (!empty($namaProyek)) {
                echo "<li id='deskripsi' style='margin-bottom: 20px;'>
                        <strong class='judul'>$namaProyek</strong>
                        <br>
                        <span style='font-size: small; color: #bbb;'>$deskripsiProyek</span>
                      </li>";
            }
        }
        ?>
    </ul>
    <div class="footer-actions">
    <button onclick="window.print()" class="btn-print">
        <i class="fas fa-print"></i> Cetak CV
    </button>
    <a href="form.php" class="btn-edit">
        <i class="fas fa-edit"></i> Edit CV
    </a>
    <a href="logout.php" class="btn-logout">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
</div>
</div>
        </div>
        
    </div>

    
</body>
</html>