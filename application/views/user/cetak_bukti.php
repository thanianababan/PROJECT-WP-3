<!DOCTYPE html>
<html><head>
    <title>Bukti Pembayaran SPP</title>
</head><body>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <tr>
            <td align="center">
                <span style="Line-height: 1.7; font-weight: bold;">
                    PEMBAYARAN SPP BERBASIS ONLINE
                </span>
            </td>
        </tr>
    </table>

    <hr class="line-title">
    <p align="center">
        BUKTI PEMBAYARAN SPP<br>
        TAHUN 2022</br>
    </p>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="20">
        <tr align="center">
            <th>NO.</th>
            <th>Bulan Bayar</th>
            <th>Jumlah Bayar (Rp)</th>
            <th>Status</th>

        </tr>

        <?php
        $no = 1;
        ?>

        <tr align="center">
            <td><?php echo $no++ ?></td>
            <td><?= $transaksi->bulan_bayar ?></td>
            <td>Rp
                <?= number_format($transaksi->jmlh_bayar, 2, ',', '.');
                ?>
            </td>
            <td><?= $transaksi->status; ?></td>

            </td>
        </tr>
    </table>

</html></body>