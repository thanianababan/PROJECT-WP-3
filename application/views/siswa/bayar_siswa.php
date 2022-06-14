<!-- Begin Page Content -->
<div class="container-fluid">

    <?= $this->session->flashdata('message'); ?>
    <!-- Bayar SPP -->
    <!-- data table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Siswa
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center thead-light">
                        <tr>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">NIK</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($siswa as $s) : ?>
                            <tr>
                                <th scope="row"><?= $s['nama_siswa']; ?></th>
                                <th scope="row"><?= $s['jenis_kelamin']; ?></th>
                                <th scope="row"><?= $s['nik']; ?></th>
                                <th scope="row"><?= $s['nama_kelas']; ?></th>
                                <td class="text-center">
                                    <?php
                                    if ($s['status_akun'] == 3) { ?>
                                        <a href="#transaksiModal<?= $s['id']; ?>" class="badge badge-success mr-1" data-toggle="modal">
                                            <i class="fas fa-user fa-sm"></i> bayar SPP
                                        </a>
                                    <?php } elseif ($s['status_akun'] == 1) { ?>
                                        
                                    <?php } else { ?>

                                    <?php } ?>
                                    <a href="#detailModal<?= $s['nik']; ?>" data-toggle="modal" class="badge badge-info mr-1">
                                        <i class="fas fa-book-reader fa-sm"></i> detail
                                    </a>
                                    <a href="<?= base_url('bayar_siswa/transaksi') ?>" class="badge badge-danger mr-1">
                                        <i class="fas fa-fw fa-user fa-sm"></i> lihat transaksi
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Detail Modal-->
<?php foreach ($siswa as $s) : ?>
    <div class="modal fade" id="detailModal<?= $s['nik'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Biodata Diri</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="col-lg">
                        <div class="form-group">
                            <label for="nik">Nomor Induk Kependudakan (NIK)</label>
                            <input type="text" class="form-control" id="nik" value="<?= $s['nama_siswa']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nok">Nomor KK (NKK)</label>
                            <input type="text" class="form-control" id="nok" value="<?= $s['jenis_kelamin']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama_siswa">Nama Siswa</label>
                            <input type="text" class="form-control" id="nama_siswa" value="<?= $s['nik']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama_siswa">Email Siswa</label>
                            <input type="text" class="form-control" id="nama_siswa" value="<?= $s['email_siswa']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama_siswa">Jenis Kelamin</label>
                            <input type="text" class="form-control" id="nama_siswa" value="<?= $s['nok']; ?>">
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <input type="text" class="form-control" id="kelas" value="<?= $s['nama_kelas']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama_ayah">Nama Ayah</label>
                            <input type="text" class="form-control" id="nama_ayah" value="<?= $s['nama_ayah']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama_ibu">Nama Ibu</label>
                            <input type="text" class="form-control" id="nama_ibu" value="<?= $s['nama_ibu']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="alamat_ortu">Alamat Lengkap Orang Tua</label>
                            <textarea class="form-control" id="alamat_ortu" rows="3"><?= $s['alamat_ortu']; ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-success" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- /. akhir detil Modal -->

<!-- Bayar Sisa -->
<?php foreach ($transaksi as $key => $s) { ?>
    <div class="modal fade" id="bayarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bayar Sisa SPP</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form method="post" action="<?= base_url('bayar_siswa/bayar_sisa'); ?>">
                        <?php
                        foreach ($siswa as $key => $value) { ?>
                            <input type="number" name="id" value="<?= $value['id']; ?>" hidden>
                        <?php } ?>
                        <input type="number" name="id_trans" value="<?= $s['id_trans']; ?>" hidden>
                        <div class="row">
                            <div class="col-lg">
                                <div class="form-group">
                                    <label for="nama_siswa">Nama Siswa</label>
                                    <input type="text" class="form-control" name="nama_siswa" id="nama_siswa" value="<?= $s['nama_petugas']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="jmlh_bayar">Jumlah Yang Telah dibayar</label>
                                    <input type="text" class="form-control" name="" id="jmlh_bayar" value="Rp<?= number_format($s['jmlh_bayar'], 0); ?>" readonly>
                                    <input type="hidden" class="form-control" name="jmlh_bayar" id="jmlh_bayar" value="<?= $s['jmlh_bayar']; ?>" readonly>
                                    <?= form_error('jmlh_bayar', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="jmlh_bayar">Sisa Yang Harus Dibayar</label>
                                    <input type="text" class="form-control" name="" id="jmlh_bayar" value="Rp<?= number_format($s['sisa'], 0); ?>" readonly>
                                    <?= form_error('jmlh_bayar', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="jmlh_bayar">Masukkan Jumlah Bayar</label>
                                    <input type="text" class="form-control" name="sisa" id="jmlh_bayar" value="<?= set_value('sisa') ?>">
                                    <?= form_error('jmlh_bayar', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group float-right">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a class="btn btn-outline-secondary ml-2" role="button" href="<?= base_url('bayar_siswa'); ?>">Batal</a>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
<?php } ?>




<!-- transaksi Modal-->
<?php foreach ($siswa as $s) : ?>
    <div class="modal fade" id="transaksiModal<?= $s['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bayar SPP</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <form method="post" action="<?= base_url('bayar_siswa/tambahtransaksi'); ?>">
                        <input type="number" name="id" value="<?= $s['id']; ?>" hidden>
                        <input type="text" name="nama_petugas" value="<?= $user['name']; ?>" hidden>
                        <div class="row">
                            <div class="col-lg">
                                <div class="form-group">
                                    <label for="nama_siswa">Nama Siswa</label>
                                    <input type="text" class="form-control" name="nama_siswa" id="nama_siswa" value="<?= $s['nama_siswa']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="bulan_bayar">Untuk Pembayaran Bulan</label>
                                    <select class="form-control" name="bulan_bayar" id="bulan_bayar" type="text">
                                        <option value="">-- Pilih Bulan --</option>
                                        <?php
                                        $bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                                        $jlh_bln = count($bulan);
                                        for ($c = 0; $c < $jlh_bln; $c += 1) {
                                            echo "<option value=$bulan[$c]> $bulan[$c] </option>";
                                        }
                                        ?>
                                    </select>
                                    <?= form_error('bulan_bayar', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="tahun_bayar">Untuk Pembayaran Tahun</label>
                                    <input type="number" class="form-control" name="tahun_bayar" id="tahun_bayar" value="<?= set_value('tahun_bayar'); ?>">
                                    <?= form_error('tahun_bayar', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="jmlh_bayar">Jumlah Bayar</label>
                                    <input type="number" class="form-control" name="jmlh_bayar" id="jmlh_bayar" value="<?= set_value('jmlh_bayar'); ?>">
                                    <?= form_error('jmlh_bayar', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group float-right">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a class="btn btn-outline-secondary ml-2" role="button" href="<?= base_url('bayar_siswa'); ?>">Batal</a>
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