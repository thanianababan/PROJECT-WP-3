<!DOCTYPE html>
<html><head>
    <title>Laporan Pembayaran SPP</title>
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
        LAPORAN PEMBAYARAN SPP SISWA <br>
        TAHUN 2022</br>
    </p>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="20">
        <tr align="center">
            <th>NO.</th>
            <th>Nama Siswa</th>
            <th>NIK</th>
            <th>Bulan Bayar</th>
            <th>Jumlah Bayar (Rp)</th>
            <th>Status</th>
        </tr>

        <?php
        $no = 1;
        foreach ($transaksi as $t) : ?>

            <tr align="center">
                <td><?php echo $no++ ?></td>
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
                </tr>

            <?php endforeach; ?>
    </table>

    <script type="text/javascript">
        window.print()
    </script>

</html></body>