    <!-- Begin Page Content -->
    <div class="container-fluid">

        <?= $this->session->flashdata('message'); ?>

        <div class="card shadow mb-4">
            <div class="card shadow mb-6 py-6 px-6">
                <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-center thead-light">
                                <tr>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">NIK</th>
                                    <th scope="col">Bulan Bayar</th>
                                    <th scope="col">Jumlah Bayar (Rp)</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>

                            <body>
                                <?php foreach ($transaksi as $t) : ?>
                                    <tr>
                                        <td><?= $t['nama_siswa']; ?></td>
                                        <td class="text-center"><?= $t['nik']; ?></td>
                                        <td><?= $t['bulan_bayar']; ?></td>
                                        <td>
                                            <?php $angka = $t['jmlh_bayar'];
                                            $rupiah = "Rp " . number_format($angka, 2, ',', '.');
                                            echo $rupiah;
                                            ?>
                                        </td>
                                        <td><?= $t['status']; ?></td>
                                        </td>
                                        
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-primary shadow-sm" href="<?= base_url('bayar/bukti/' . $t['id_trans']); ?>" onclick="return confirm('Cetak Bukti Pembayaran');">
                                                <i class="fas fa-download fa-sm"></i> Cetak Bukti</a>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            </body>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

  
    <!-- transaksi Modal-->
    <!--<?php foreach ($transaksi as $t) : ?> 
        <div class="modal fade" id="detailModal<?= $t['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Data Transaksi Siswa</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <form>
                            <div class="row">
                                <div class="col-lg">
                                    <div class="form-group">
                                        <label for="nama_siswa">Nama Siswa</label>
                                        <input class="form-control" id="nama_siswa" value="<?= $t['nama_siswa']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="jmlh_bayar">Jumlah Bayar</label>
                                        <input class="form-control" id="jmlh_bayar" value="<?php $angka = $t['jmlh_bayar'];
                                                                                            $rupiah = "Rp " . number_format($angka, 2, ',', '.');
                                                                                            echo $rupiah;
                                                                                            ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="bulan_bayar">Untuk Pembayaran Bulan</label>
                                        <input class="form-control" id="bulan_bayar" value="<?= $t['bulan_bayar']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="Tahun_bayar">Untuk Pembayaran Tahun</label>
                                        <input class="form-control" id="tahun_bayar" value="<?= $t['tahun_bayar']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status Pembayaran</label>
                                        <input class="form-control" id="status" value="<?= $t['status']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_bayar">Tanggal Pembayaran</label>
                                        <input class="form-control" id="tgl_bayar" value="<?= date('d F Y', $t['tgl_bayar']); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_petugas">Petugas yang melakukan Pembayaran</label>
                                        <input class="form-control" id="tgl_bayar" value="<?= $t['nama_petugas']; ?>">
                                    </div>
                                    <div class="form-group float-right">
                                        <a class="btn btn-outline-secondary ml-2" role="button" href="<?= base_url('siswa/transaksi'); ?>">Tutup</a>
                                    </div>
                                </div>
                            </div>

                        </form>
                        <!-- akhir form input -->

                    </div>

                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <!-- /.akhir transaksi Modal -->