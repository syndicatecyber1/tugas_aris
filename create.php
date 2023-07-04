<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $no_buku = isset($_POST['no_buku']) ? $_POST['no_buku'] : '';
    $nama_buku = isset($_POST['nama_buku']) ? $_POST['nama_buku'] : '';
    $jumlah_halaman = isset($_POST['jumlah_halaman']) ? $_POST['jumlah_halaman'] : '';
    $tahun_terbit = isset($_POST['tahun_terbit']) ? $_POST['tahun_terbit'] : '';
    $nama_pengarang = isset($_POST['nama_pengarang']) ? $_POST['nama_pengarang'] : '';
    $genre = isset($_POST['genre']) ? $_POST['genre'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO kontak VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $no_buku, $nama_buku, $jumlah_halaman, $tahun_terbit, $nama_pengarang, $genre]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Tambah Buku</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="nama">No Buku</label>
        <input type="text" name="id" value="auto" id="id">
        <input type="text" name="no_buku" id="no_buku">
        <label for="email">Nama Buku</label>
        <label for="notelp">Jumlah Halaman</label>
        <input type="text" name="nama_buku" id="nama_buku">
        <input type="text" name="jumlah_halaman" id="jumlah_halaman">
        <label for="pekerjaan">Tahun Terbit</label>
        <label for="notelp">Nama Pengarang</label>
        <input type="text" name="tahun_terbit" id="tahun_terbit">
        <input type="text" name="nama_pengarang" id="nama_pengarang">
        <label for="notelp">Genre</label>
        <input type="text" name="genre" id="genre">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>