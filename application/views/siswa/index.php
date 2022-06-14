<!-- Begin Page Content -->

<div class="container-fluid">

    <?= $this->session->flashdata('message'); ?>

    <!-- data table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Siswa
                <a class="btn btn-sm btn-primary shadow-sm" href="<?= base_url('siswa/tambahSiswa'); ?>">
                    <i class="fas fa-user-plus fa-sm"></i> Tambah Siswa</a>
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

                                    <?php if ($s['status_akun'] == 2) { ?>
                                        <a href="#" class="badge badge-primary mr-1" data-toggle="modal">
                                            <i class="fas fa-user-check fa-sm"></i> transaksi lunas
                                        </a>
                                    <?php } elseif ($s['status_akun'] == 3) { ?>
                                        <a href="#transaksiModal<?= $s['nik']; ?>" class="badge badge-success mr-1" data-toggle="modal">
                                            <i class="fas fa-user fa-sm"></i> input <br>transaksi siswa
                                        </a>
                                    <?php } else { ?>
                                        <a href="#transaksiModal<?= $s['nik']; ?>" class="badge badge-success mr-1" data-toggle="modal">
                                            <i class="fas fa-user fa-sm"></i> input <br>transaksi siswa
                                        </a>
                                    <?php } ?>
                                    <a href="#detailModal<?= $s['nik']; ?>" data-toggle="modal" class="badge badge-info mr-1">
                                        <i class="fas fa-book-reader fa-sm"></i> detail
                                    </a>
                                    <?php
                                    if ($s['status_akun'] == 0) { ?>
                                        <a href="#akunModal<?= $s['id']; ?>" data-toggle="modal" class="badge badge-primary mr-1">
                                            <i class="fas fa-fw fa-user fa-sm"></i> buat akun
                                        </a>
                                    <?php } elseif ($s['status_akun'] == 3) { ?>
                                    <?php } elseif ($s['status_akun'] == 2) { ?>
                                    <?php } else { ?>
                                        <a href="#lihatakunModal<?= $s['id']; ?>" data-toggle="modal" class="badge badge-danger mr-1">
                                            <i class="fas fa-fw fa-user fa-sm"></i> lihat akun
                                        </a>
                                    <?php } ?>
                                    <a href="#editModal<?= $s['nik']; ?>" class="badge badge-warning mr-1" data-toggle="modal">
                                        <i class="fas fa-edit fa-sm"></i> edit
                                    </a>
                                    <a href="<?= base_url('siswa/hapussiswa/' . $s['nik']); ?>" class="badge badge-danger" onclick="return confirm('Yakin ingin menghapus data ini?');">
                                        <i class="far fa-trash-alt fa-sm"></i> delete
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
                    <h5 class="modal-title" id="exampleModalLabel">Detail Data Siswa</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="col-lg">
                        <div class="form-group">
                            <label for="nik">Nomor Induk Kependudukan (NIK)</label>
                            <input type="text" class="form-control" id="nik" value="<?= $s['nik']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nok">Nomor KK (NKK)</label>
                            <input type="text" class="form-control" id="nok" value="<?= $s['nok']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama_siswa">Nama Siswa</label>
                            <input type="text" class="form-control" id="nama_siswa" value="<?= $s['nama_siswa']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama_siswa">Email Siswa</label>
                            <input type="text" class="form-control" id="nama_siswa" value="<?= $s['email_siswa']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama_siswa">Jenis Kelamin</label>
                            <input type="text" class="form-control" id="nama_siswa" value="<?= $s['jenis_kelamin']; ?>">
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


<!-- edit Modal-->
<?php foreach ($siswa as $s) : ?>
    <div class="modal fade" id="editModal<?= $s['nik']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Siswa</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <form method="post" action="<?= base_url('siswa/editsiswa'); ?>">
                        <div class="row">
                            <div class="col-lg">
                                <div class="form-group">
                                    <label for="nik">Nomor Induk Kependudukan (NIK)</label>
                                    <input type="text" class="form-control" id="nik" name="nik" value="<?= $s['nik']; ?>" maxlength="16" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nok">Nomor KK (NKK)</label>
                                    <input type="text" class="form-control" id="nok" name="nok" maxlength="16" value="<?= $s['nok']; ?>">
                                    <?= form_error('nok', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="nama_siswa">Nama Siswa</label>
                                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?= $s['nama_siswa']; ?>">
                                    <?= form_error('nama_siswa', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="kelas_id">Email Siswa</label>
                                    <input type="text" class="form-control" id="nama_siswa" name="email_siswa" value="<?= $s['email_siswa']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" type="text">
                                        <option value="<?= $s['jenis_kelamin']; ?>" selected><?= $s['jenis_kelamin']; ?></option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-group">
                                    <label for="kelas_id">Kelas</label>
                                    <select class="form-control" id="kelas_id" name="kelas_id" type="text">
                                        <option value="<?= $s['kelas_id']; ?>"><?= $s['nama_kelas']; ?></option>
                                        <?php foreach ($kelas as $k) : ?>
                                            <option value="<?= $k['id_kelas']; ?>"><?= $k['nama_kelas']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nama_ayah">Nama Ayah</label>
                                    <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="<?= $s['nama_ayah']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="nama_ibu">Nama Ibu</label>
                                    <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="<?= $s['nama_ibu']; ?>">
                                    <?= form_error('nama_ibu', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="alamat_ortu">Alamat Lengkap Orang Tua</label>
                                    <textarea class="form-control" id="alamat_ortu" name="alamat_ortu" rows="3"><?= $s['alamat_ortu']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a class="btn btn-outline-secondary ml-2" role="button" href="<?= base_url('siswa'); ?>">Batal</a>
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
<!-- akhir edit Modal -->


<!-- transaksi Modal-->
<?php foreach ($siswa as $s) : ?>
    <div class="modal fade" id="transaksiModal<?= $s['nik']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Input Data Transaksi Siswa</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <form method="post" action="<?= base_url('siswa/tambahtransaksi'); ?>">
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
                                    <a class="btn btn-outline-secondary ml-2" role="button" href="<?= base_url('siswa'); ?>">Batal</a>
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


<!-- akun Modal-->
<?php foreach ($siswa as $s) : ?>
    <div class="modal fade" id="akunModal<?= $s['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Input Akun Siswa</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <form method="post" action="<?= base_url('siswa/register_akun'); ?>">
                        <input type="number" name="id_user" value="<?= $s['id']; ?>" hidden>
                        <input type="number" name="id" value="<?= $s['id']; ?>" hidden>
                        <input type="text" name="nama_petugas" value="<?= $user['name']; ?>" hidden>
                        <div class="row">
                            <div class="col-lg">
                                <div class="form-group">
                                    <label for="nama_siswa">Nama Akun Siswa</label>
                                    <input type="hidden" class="form-control" name="id_siswa" id="id_siswa" value="<?= $s['id']; ?>">
                                    <input type="text" class="form-control" name="name" id="name" value="<?= $s['nama_siswa']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Alamat Email" value="<?= set_value('email'); ?>">
                                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class=" form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                                        <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Ulangi Password">
                                    </div>
                                </div>
                                <div class="form-group float-right">
                                    <button type="submit" class="btn btn-primary">Buat Akun</button>
                                    <a class="btn btn-outline-secondary ml-2" role="button" href="<?= base_url('siswa'); ?>">Batal</a>
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


<!-- akun Modal-->
<?php foreach ($siswa as $s) : ?>
    <div class="modal fade" id="lihatakunModal<?= $s['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Akun Siswa</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="col-md-16">
                        <div class="card shadow-lg mb-8">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="<?= base_url('assets/img/profile/default.jpg'); ?>" class="card-img" alt="profile">
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <h5 class="card-title">Profile Akun Siswa</h5>
                                        <p class="card-text"><?= $s['nama_siswa'] ?></p>
                                        <p class="card-text"><?= $s['email_siswa'] ?></p>
                                        <p class="card-text"><small class="text-muted">Dibuat Pada Tanggal, <?= date('d F Y', $s['date_created']); ?></small></p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- akhir form input -->
                </div>

                <div class="modal-footer">
                    <div class="form-group float-right">
                        <a class="btn btn-primary" role="button" href="<?= base_url('siswa'); ?>">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- /.akhir transaksi Modal -->