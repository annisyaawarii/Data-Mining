<?php
include "header.php"; // Panggil header
include "koneksi.php"; // Panggil koneksi database
?>


<?php
if (isset($_POST['bsimpan'])) {
    $judul = htmlspecialchars($_POST['nama_buku'], ENT_QUOTES);
    $pengarang = htmlspecialchars($_POST['pengarang'], ENT_QUOTES);
    $tahun = htmlspecialchars($_POST['tahun_terbit'], ENT_QUOTES);
    $status = htmlspecialchars($_POST['status'], ENT_QUOTES);

    $simpan = mysqli_query($koneksi, "INSERT INTO tbuku (nama_buku, pengarang, tahun_terbit, status) VALUES 
    ('$nama_buku', '$pengarang', '$tahun', '$status')");

    if ($simpan) {
        echo "<script>alert('Data Buku Berhasil Disimpan!'); document.location='peminjaman.php';</script>";
    } else {
        echo "<script>alert('Data Buku Gagal Disimpan!');</script>";
    }
}


?>
<div class="container mt-4">

    <h3 class="h4 text-gray-900 mb-4">Tambah Buku atau Dokumen</h3>
    <form method="POST">
        <div class="form-group">
            <label>Nama Buku</label>
            <input type="text" class="form-control" name="nama_buku" required>
        </div>
        <div class="form-group">
            <label>Pengarang</label>
            <input type="text" class="form-control" name="pengarang">
        </div>
        <div class="form-group">
            <label>Tahun Terbit</label>
            <input type="number" class="form-control" name="tahun_terbit" min="1900" max="<?= date('Y'); ?>" required>
        </div>
        <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="status">
                <option value="Tersedia">Tersedia</option>
                <option value="Dipinjam">Dipinjam</option>
            </select>
        </div>
        <button type="submit" name="bsimpan" class="btn btn-primary">Simpan</button>
    </form>
</div>

<div class="container mt-4">
    <h2 class="text-center">Daftar Buku dan Dokumen di Ruang Baca</h2>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Buku</th>
                    <th>Pengarang</th>
                    <th>Tahun Terbit</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM tbuku ORDER BY nama_buku ASC");
                $no = 1;
                while ($data = mysqli_fetch_array($query)) {
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($data['nama_buku']); ?></td>
                        <td><?= htmlspecialchars($data['pengarang']); ?></td>
                        <td><?= htmlspecialchars($data['tahun_terbit']); ?></td>
                        <td><?= htmlspecialchars($data['status']); ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include "footer.php"; // Panggil footer
?>
