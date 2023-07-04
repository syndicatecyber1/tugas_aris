<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $no_buku = isset($_POST['no_buku']) ? $_POST['no_buku'] : '';
        $nama_buku = isset($_POST['nama_buku']) ? $_POST['nama_buku'] : '';
        $jumlah_halaman = isset($_POST['jumlah_halaman']) ? $_POST['jumlah_halaman'] : '';
        $tahun_terbit = isset($_POST['tahun_terbit']) ? $_POST['tahun_terbit'] : '';
        $nama_pengarang = isset($_POST['nama_pengarang']) ? $_POST['nama_pengarang'] : '';
        $genre = isset($_POST['genre']) ? $_POST['genre'] : '';
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE kontak SET id = ?, no_buku = ?, nama_buku = ?, jumlah_halaman = ?, tahun_terbit = ?, nama_pengarang = ?, genre = ? WHERE id = ?');
        $stmt->execute([$id, $no_buku, $nama_buku, $jumlah_halaman, $tahun_terbit, $nama_pengarang, $genre, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM kontak WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Buku doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Update Contact #<?=$contact['id']?></h2>
    <form action="update.php?id=<?=$contact['id']?>" method="post">
        <label for="id">ID</label>
        <label for="no_buku">No Buku</label>
        <input type="text" name="id" value="<?=$contact['id']?>" id="id">
        <input type="text" name="nama" value="<?=$contact['no_buku']?>" id="no_buku">
        <label for="nama_buku">Nama Buku</label>
        <label for="jumlah_halaman">Jumlah Halaman</label>
        <input type="text" name="nama_buku" value="<?=$contact['nama_buku']?>" id="nama_buku">
        <input type="text" name="jumlah_halaman" value="<?=$contact['jumlah_halaman']?>" id="jumlah_halaman">
        <label for="tahun_terbit">Tahun Terbit</label>
        <label for="nama_pengarang">Nama Pengarang</label>
        <input type="text" name="tahun_terbit" value="<?=$contact['tahun_terbit']?>" id="tahun_terbit">
        <input type="text" name="nama_pengarang" value="<?=$contact['nama_pengarang']?>" id="nama_pengarang">
        <label for="genre">Genre</label>
        <input type="text" name="genre" value="<?=$contact['genre']?>" id="genre">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>