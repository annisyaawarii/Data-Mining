    <!-- panggil file header -->
    <?php include "header.php"; ?>

    <?php
    
    // uji jika tombol simpan di klik
    if  (isset($_POST['bsimpan'])){
        $tgl=date('Y-m-d');

        $nama = htmlspecialchars ($_POST['nama'], ENT_QUOTES) ;
        $nomor_induk = htmlspecialchars ($_POST['nomor_induk'], ENT_QUOTES) ;
        $tujuan = htmlspecialchars ($_POST['tujuan'], ENT_QUOTES) ;
        $nope = htmlspecialchars ($_POST['nope'], ENT_QUOTES) ;

        //persiapan query simpan data
        $simpan = mysqli_query($koneksi, "INSERT INTO ttamu VALUES ('' , '$tgl', '$nama', '$nomor_induk', '$tujuan',
        '$nope' )");

        //uji jika simpan data sukses
        if ($simpan){
            echo "<script>alert ('Simpan data Sukses, Terima Kasih..!'); document.location='?' </script>";
        }else{
            echo "<script>alert ('Simpan data GAGAL!! '); document.location='?' </script>";
        }
    }


    ?>


    <!-- Head -->
    <div class="head text-center">
        <img src="assets/img/logo.png" width="165">
        <h2 class= "text-white">Sistem Informasi Ruang Baca <br> FTTK UMRAH </h2>
    </div>
    <!-- End Head -->

    <!-- Awal Row -->
    <div class="row mt-2"> 
        <div class="col-lg-7 mb-3">
            <div class="card shadow bg gradient-light">
                <div class="card-body">
                
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Identitas Pengunjung</h1>
                            </div>
                            <form class="user" method="POST" action="">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="nama" placeholder="Nama Pengunjung" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="nomor_induk" placeholder="Nomor Induk " required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="tujuan" placeholder="Tujuan " required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="nope" placeholder="No.HP " required>
                                </div>
                            
                                <button type="submit" name="bsimpan" class="btn btn-primary btn-user btn-block"> Simpan Data </button>
                               
                               
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="#">Ruang Baca FTTK Umrah | 2024- <?=date('Y')?></a>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                <!-- end col-lg-7 -->
            </div>
            <div class="col-lg-5 mb-3">
            <div class="card shadow ">
                <div class="card-body">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Statistik Pengunjung</h1>
                </div>
                <?php
                    //deklarasi tanggal
                    // menampilkan tanggal sekarang
                    $tgl_sekarang =date('Y-m-d');

                    // menampilkan tanggal kemarin
                    $kemarin =date('Y-m-d', strtotime('-1 day', strtotime (date('Y-m-d'))));

                    //mendapatkan 6 hari sebelum tanggal sekarang
                    $seminggu= date('Y-m-d h:i:s' ,strtotime('-1 week + 1 day', strtotime($tgl_sekarang)));

                    $sekarang = date('Y-m-d h:i:s');

                    //persiapan query tampilkan jumlah data

                    $tgl_sekarang = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM ttamu where tanggal
                    like '%$tgl_sekarang%'"));

                    $kemarin = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM ttamu where tanggal
                    like '%$kemarin%'"));

                    $seminggu = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM ttamu where tanggal
                    BETWEEN '$seminggu' and '$sekarang'"));

                    $bulan_ini = date('m');

                    $sebulan = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM ttamu where month
                    (tanggal) = '$bulan_ini'"
                    ));

                    $keseluruhan = mysqli_fetch_array(mysqli_query($koneksi, "SELECT count(*) FROM ttamu "
                    ));
                
                ?>
                <table class="table table-bordered">
                    <tr> 
                        <td>Hari Ini </td>
                        <td>: <?= $tgl_sekarang[0] ?> </td>
                    </tr>
                    <tr> 
                        <td>Kemarin </td>
                        <td>: <?= $kemarin[0] ?> </td>
                    </tr>
                    <tr> 
                        <td>Minggu Ini </td>
                        <td>: <?= $seminggu[0] ?> </td>
                    </tr>
                    <tr> 
                        <td>Bulan Ini </td>
                        <td>: <?= $sebulan[0] ?> </td>
                    </tr>
                    <tr> 
                        <td>Keseluruhan </td>
                        <td>: <?= $keseluruhan[0] ?> </td>
                    </tr>
            </table>
            </div>
            </div>
            <!--card body-->
        </div>
        <!--end card-->
    </div>
            <!-- End Row -->
    

        <!--card -->
             <!-- DataTalbes Example -->
             <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Pengunjung Hari ini [<?=date('d-m-Y') ?>]</h6>
                        </div>
                        <div class="card-body">
                            <a href = "rekapitulasi.php" class="btn btn-success mb-3"><i class="fa fa-table">
                            </i> Rekapitulasi Pengunjung</a>
                             <a href = "logout.php" class="btn btn-danger mb-3"><i class="fa fa-sign-out-alt">
                            </i> Logout </a>



                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal</th>
                                            <th>Nama Pengunjung</th>
                                            <th>Nomor Induk</th>
                                            <th>Tujuan</th>
                                            <th>No.Hp </th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal</th>
                                            <th>Nama Pengunjung</th>
                                            <th>Nomor Induk</th>
                                            <th>Tujuan</th>
                                            <th>No.Hp </th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                        $tgl = date('Y-m-d'); //2024-11-28
                                        $tampil = mysqli_query($koneksi, "SELECT * FROM ttamu where tanggal like '%$tgl%'
                                        order by id desc");
                                        $no = 1;
                                        while($data = mysqli_fetch_array($tampil)){
                                        ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td> <?=$data['tanggal']?></td>
                                            <td> <?=$data['nama']?></td>
                                            <td><?=$data['nomor_induk']?></td>
                                            <td><?=$data['tujuan']?></td>
                                            <td><?=$data['nope']?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
        </div>
    </div>

    

    <!-- panggil file footer -->
    <?php include "footer.php"; ?>

   