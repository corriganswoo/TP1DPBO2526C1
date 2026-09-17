<?php
require_once 'Film.php';
session_start();

// Reset Session Data
if (isset($_POST['reset_data'])) {
    session_unset();
    session_destroy();
    header("Location: Main.php");
    exit();
}

// Inisialisasi Session Array Film
if (!isset($_SESSION['daftarFilm'])) {
    $_SESSION['daftarFilm'] = [];
}

$message = '';
$message_type = '';

// Helper Cek ID
function isIdExists($id, $list) {
    foreach ($list as $item) {
        if ($item->getId() === $id) {
            return true;
        }
    }
    return false;
}

// Tambah Film
if (isset($_POST['tambah'])) {
    $id = trim($_POST['id']);
    $judul = trim($_POST['judul']);
    $genre = trim($_POST['genre']);
    $harga = $_POST['harga'];

    if (empty($id) || empty($judul) || empty($genre) || !is_numeric($harga) || $harga <= 0) {
        $message = "Input tidak valid! Pastikan semua data terisi dan harga berangka positif.";
        $message_type = 'error';
    } elseif (isIdExists($id, $_SESSION['daftarFilm'])) {
        $message = "Kode ID Film sudah terdaftar di sistem.";
        $message_type = 'error';
    } else {
        $poster = '';
        if (!empty($_FILES['poster']['name']) && $_FILES['poster']['error'] == 0) {
            $target_dir = "./posters/";
            if (!is_dir($target_dir)) mkdir($target_dir);
            $target_file = $target_dir . time() . "_" . basename($_FILES["poster"]["name"]);
            if (move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file)) {
                $poster = $target_file;
            }
        }

        $_SESSION['daftarFilm'][] = new Film($id, $judul, $genre, (int)$harga, $poster);
        $message = "Film baru berhasil ditambahkan ke katalog!";
        $message_type = 'success';
    }
}

// Hapus Film
if (isset($_GET['action']) && $_GET['action'] === 'hapus' && isset($_GET['id'])) {
    $id_hapus = $_GET['id'];
    $_SESSION['daftarFilm'] = array_values(array_filter($_SESSION['daftarFilm'], fn($f) => $f->getId() !== $id_hapus));
    header("Location: Main.php");
    exit();
}

// Update Film
if (isset($_POST['update'])) {
    $id_target = $_POST['id_target'];
    foreach ($_SESSION['daftarFilm'] as $film) {
        if ($film->getId() === $id_target) {
            $id_baru = trim($_POST['id_baru']);
            $judul_baru = trim($_POST['judul']);
            $genre_baru = trim($_POST['genre']);
            $harga_baru = $_POST['harga'];

            if (empty($judul_baru) || empty($genre_baru) || !is_numeric($harga_baru) || $harga_baru <= 0) {
                $message = "Input tidak valid untuk pembaruan data.";
                $message_type = 'error';
                break;
            }

            if (!empty($id_baru) && $id_baru !== $film->getId()) {
                if (isIdExists($id_baru, $_SESSION['daftarFilm'])) {
                    $message = "ID baru sudah digunakan. ID dibatalkan untuk diubah.";
                    $message_type = 'warning';
                } else {
                    $film->setId($id_baru);
                }
            }

            $film->setJudul($judul_baru);
            $film->setGenre($genre_baru);
            $film->setHarga((int)$harga_baru);

            if (!empty($_FILES['poster']['name']) && $_FILES['poster']['error'] == 0) {
                $target_dir = "./posters/";
                if (!is_dir($target_dir)) mkdir($target_dir);
                $target_file = $target_dir . time() . "_" . basename($_FILES["poster"]["name"]);
                if (move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file)) {
                    $film->setPoster($target_file);
                }
            }

            if ($message_type !== 'warning') {
                $message = "Data film berhasil diperbarui!";
                $message_type = 'success';
            }
            break;
        }
    }
}

// Search Filter
$hasil_katalog = $_SESSION['daftarFilm'];
if (isset($_GET['cari'])) {
    $id_cari = trim($_GET['cari_id']);
    $hasil_katalog = array_values(array_filter($_SESSION['daftarFilm'], fn($f) => $f->getId() === $id_cari));
    if (empty($hasil_katalog)) {
        $message = "Film dengan ID '$id_cari' tidak ditemukan.";
        $message_type = 'warning';
    }
}

// Fetch ID untuk Form Edit
$edit_id = $edit_judul = $edit_genre = $edit_harga = $edit_poster = '';
if (isset($_GET['edit_id'])) {
    foreach ($_SESSION['daftarFilm'] as $film) {
        if ($film->getId() === $_GET['edit_id']) {
            $edit_id = $film->getId();
            $edit_judul = $film->getJudul();
            $edit_genre = $film->getGenre();
            $edit_harga = $film->getHarga();
            $edit_poster = $film->getPoster();
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cinema XXI Management System</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #121212;
            color: #e0e0e0;
            margin: 0;
            padding: 30px;
            display: flex;
            justify-content: center;
        }
        .main-card {
            width: 100%;
            max-width: 1050px;
            background: #1e1e1e;
            padding: 30px;
            border-radius: 12px;
            border: 1px solid #333;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }
        h1 { text-align: center; color: #f39c12; letter-spacing: 1.5px; margin-top: 0; }
        
        .alert {
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-weight: 600;
            text-align: center;
        }
        .alert-success { background: #1b4332; color: #75b798; border: 1px solid #2d6a4f; }
        .alert-error { background: #4a1318; color: #ea868f; border: 1px solid #842029; }
        .alert-warning { background: #4d3800; color: #ffda6a; border: 1px solid #664d03; }

        form {
            background: #282828;
            padding: 20px;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        input, button {
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #444;
            background: #181818;
            color: #fff;
        }
        input:focus { border-color: #f39c12; outline: none; }
        
        .btn-submit { background: #f39c12; color: #000; font-weight: bold; cursor: pointer; border: none; }
        .btn-submit:hover { background: #d35400; color: #fff; }
        .btn-danger { background: #c0392b; color: #fff; cursor: pointer; border: none; }

        .search-box { margin: 25px 0; background: transparent; padding: 0; }
        .search-box form { flex-direction: row; background: transparent; padding: 0; }
        .search-box input { flex: 1; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            background: #252525;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #333; }
        th { background: #333; color: #f39c12; }
        tr:hover { background: #2d2d2d; }
        
        .poster-img { width: 60px; height: 85px; object-fit: cover; border-radius: 4px; }
        .badge-null { color: #777; font-style: italic; }
        
        .act-btn {
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            margin-right: 4px;
        }
        .act-edit { background: #2980b9; color: #fff; }
        .act-delete { background: #c0392b; color: #fff; }
        .btn-all { display: inline-block; margin-top: 15px; color: #f39c12; text-decoration: none; }
    </style>
</head>
<body>

<div class="main-card">
    <h1>CINEMA XXI MANAGEMENT</h1>

    <?php if ($message): ?>
        <div class="alert alert-<?= $message_type; ?>"><?= $message; ?></div>
    <?php endif; ?>

    <!-- Form Input / Update -->
    <form action="Main.php" method="POST" enctype="multipart/form-data">
        <h3 style="margin:0 0 5px 0; color:#f39c12;"><?= $edit_id ? 'Perbarui Data Film' : 'Tambah Film Baru'; ?></h3>
        
        <?php if ($edit_id): ?>
            <input type="hidden" name="id_target" value="<?= htmlspecialchars($edit_id); ?>">
            <input type="text" name="id_baru" value="<?= htmlspecialchars($edit_id); ?>" placeholder="ID/Kode Film" required>
        <?php else: ?>
            <input type="text" name="id" placeholder="ID/Kode Film (Unik)" required>
        <?php endif; ?>

        <input type="text" name="judul" value="<?= htmlspecialchars($edit_judul); ?>" placeholder="Judul Film" required>
        <input type="text" name="genre" value="<?= htmlspecialchars($edit_genre); ?>" placeholder="Kategori / Genre" required>
        <input type="number" name="harga" value="<?= htmlspecialchars($edit_harga); ?>" placeholder="Harga Tiket (Rp)" required>
        <input type="file" name="poster" accept="image/*">
        
        <button type="submit" name="<?= $edit_id ? 'update' : 'tambah'; ?>" class="btn-submit">
            <?= $edit_id ? 'Simpan Perubahan' : 'Tambahkan Ke Katalog'; ?>
        </button>
    </form>

    <!-- Form Cari -->
    <div class="search-box">
        <form action="Main.php" method="GET">
            <input type="text" name="cari_id" placeholder="Cari Spesifik Berdasarkan ID Film..." required>
            <button type="submit" name="cari" class="btn-submit" style="width: 100px;">Cari</button>
        </form>
    </div>

    <!-- Tabel Data -->
    <table>
        <thead>
            <tr>
                <th>Poster</th>
                <th>Kode ID</th>
                <th>Judul Film</th>
                <th>Genre</th>
                <th>HTM</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($hasil_katalog)): ?>
                <tr><td colspan="6" style="text-align:center; color:#888;">Katalog film kosong / tidak ditemukan.</td></tr>
            <?php else: ?>
                <?php foreach ($hasil_katalog as $film): ?>
                    <tr>
                        <td>
                            <?php if ($film->getPoster()): ?>
                                <img src="<?= htmlspecialchars($film->getPoster()); ?>" class="poster-img">
                            <?php else: ?>
                                <span class="badge-null">No Cover</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($film->getId()); ?></td>
                        <td><strong><?= htmlspecialchars($film->getJudul()); ?></strong></td>
                        <td><?= htmlspecialchars($film->getGenre()); ?></td>
                        <td>Rp <?= number_format($film->getHarga(), 0, ',', '.'); ?></td>
                        <td>
                            <a href="Main.php?edit_id=<?= urlencode($film->getId()); ?>" class="act-btn act-edit">Edit</a>
                            <a href="Main.php?action=hapus&id=<?= urlencode($film->getId()); ?>" class="act-btn act-delete" onclick="return confirm('Hapus film ini dari sistem?');">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if (isset($_GET['cari'])): ?>
        <div style="text-align:center;">
            <a href="Main.php" class="btn-all">← Tampilkan Seluruh Katalog</a>
        </div>
    <?php endif; ?>

    <!-- Reset Data -->
    <div style="margin-top: 30px; text-align: right;">
        <form action="Main.php" method="POST" style="background:transparent; padding:0;">
            <button type="submit" name="reset_data" class="btn-danger" onclick="return confirm('Kosongkan seluruh session data film?');">Reset Seluruh Sistem</button>
        </form>
    </div>
</div>

</body>
</html>