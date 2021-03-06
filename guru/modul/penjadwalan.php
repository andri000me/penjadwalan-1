    <script src="../vendor/jquery.min.js"></script>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Jadwal</h1>
            </div>
                    <!-- /.col-lg-12 -->
        </div>
                <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Jadwal
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#lihat" data-toggle="tab">Jadwal</a>
                                </li>
                                <li><a href="#cetak" data-toggle="tab">Cetak Jadwal</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="lihat">
                                    <div class="panel-body">
                                        <table width="100%" class="table table-striped table-bordered table-hover table-paginate" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center; width: 35px;">No</th>
                                                    <th>Hari</th>
                                                    <th>Jam Ke-</th>
                                                    <th>Pukul</th>
                                                    <th>Kelas</th>
                                                    <th>Mata Pelajran</th>
                                                    <th>Guru</th>
                                                    <!-- <th>Aksi</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                              // $connect = new mysqli("localhost","root","","d_base_espara");
                                              $query = mysqli_query($connect, "SELECT
                                                tb_kelas.nama_kelas,
                                                tb_mapel.mapel,
                                                tb_guru.nama_guru,
                                                tb_guru.kd_guru,
                                                tb_penugasan.jml_jam,
                                                tb_jadwal.tahun_pelajaran,
                                                tb_jadwal.semester,
                                                tb_hari.hari,
                                                tb_jam.jam_ke,
                                                tb_jam.pukul
                                                FROM
                                                tb_penugasan
                                                Inner Join tb_mapel ON tb_mapel.kd_mapel = tb_penugasan.kd_mapel
                                                Inner Join tb_kelas ON tb_kelas.kd_kelas = tb_penugasan.kd_kelas
                                                Inner Join tb_guru ON tb_guru.kd_guru = tb_penugasan.kd_guru
                                                Inner Join tb_jadwal ON tb_penugasan.kd_penugasan = tb_jadwal.kd_penugasan
                                                Inner Join tb_hari ON tb_hari.kd_hari = tb_jadwal.kd_hari
                                                Inner Join tb_jam ON tb_jam.kd_jam = tb_jadwal.kd_jam
                                                WHERE tb_jadwal.kd_guru=$_SESSION[userdata]");
                                              while ($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
                                              {@$no++;
                                            ?>
                                                <tr>
                                                    <td style="text-align: center;"><?php echo $no; ?></td>
                                                    <td><?php echo $row['hari']; ?></td>
                                                    <td><?php echo $row['jam_ke']; ?></td>
                                                    <td><?php echo $row['pukul']; ?></td>
                                                    <td><?php echo $row['nama_kelas']; ?></td>
                                                    <td><?php echo $row['mapel']; ?></td>
                                                    <td><?php echo $row['nama_guru']; ?></td>
                                                    <!-- <td><a href='#edit_modal' class='btn btn-warning btn-xs' data-toggle='modal' data-id="<?php echo $row['kd_jadwal']; ?>"><span class="glyphicon glyphicon-pencil"></span> Edit</a></td> -->
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- =====================CETAK===================-->

                                <div class="tab-pane fade" id="cetak">
                                    <br>
                                    <form action="lap_gur.php" method="post">
                                        <label>Tahun Pelajaran</label>
                                        <div class="form-group">
                                            <select class="form-control" name="tapel">
                                                <option value="">Pilih Tahun Pelajaran</option>
                                                <?php  
                                                    // $connect = new mysqli("localhost", "root", "", "d_base_espara");
                                                    $queri = mysqli_query($connect, "SELECT DISTINCT tahun_pelajaran from tb_jadwal");
                                                    while($row = mysqli_fetch_array($queri)) {
                                                ?>
                                                <option value="<?php echo $row['tahun_pelajaran']; ?>"><?php echo $row['tahun_pelajaran']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <label>Pilih Semester</label>
                                        <div class="form-group">
                                            <select class="form-control" name="semester">
                                                <option value="">Pilih Semester</option>
                                                <option value="GANJIL">Ganjil</option>
                                                <option value="GENAP">Genap</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="simpan" class="btn btn-primary" value="Cetak">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
        </div>
    </div>
</div>