<!-- Begin Page Content -->
<div class="container-fluid">

    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow mb-4">
        <div class="card shadow mb-6 py-6 px-6">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Bayar SPP</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="text-center thead-light">
                            <tr>
                                <th scope="col">Bulan Bayar</th>
                                <th scope="col">Jumlah Bayar</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($transaksi as $key => $value) { ?>
                                <tr>
                                    
                                    <td> <?= $value->bulan_bayar ?></td>
                                    <td>Rp <?= number_format($value->jmlh_bayar, 2, ',', '.'); ?>
                                    </td>
                                    <td> <?= $value->status ?></td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-primary shadow-sm" href="<?= base_url('bayar/bukti/' . $value->id_trans); ?>" onclick="return confirm('Cetak Bukti Pembayaran');">
                                            <i class="fas fa-download fa-sm"></i> Cetak Bukti</a>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /.container-fluid -->
</div>