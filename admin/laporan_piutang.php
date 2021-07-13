    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Laporan Piutang</title>
        <link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">

    </head>

    <body>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <h1 class="text-center">LAPORAN CATATAN PIUTANG</h1>
                    <h3 class="text-center">SISTEM INFORMASI KEUANGAN</h3>
                    <hr>
                    <thead>
                        <tr>
                            <td align="left">Pekanbaru, <?= date('d-M-Y') ?></td>
                        </tr>
                    </thead>
                    <hr>


                    <table class="table table-bordered table-striped" id="table-datatable">
                        <thead>
                            <tr>
                                <th width="1%">NO</th>
                                <th width="1%">KODE</th>
                                <th width="10%" class="text-center">TANGGAL</th>
                                <th class="text-center">KETERANGAN</th>
                                <th class="text-center">NOMINAL</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../koneksi.php';
                            $no = 1;
                            $piutang_nominal = 0;
                            $data = mysqli_query($koneksi, "SELECT * FROM piutang");
                            while ($d = mysqli_fetch_array($data)) {
                                $piutang_nominal += $d['piutang_nominal'];
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++; ?></td>
                                    <td>PTG-000<?php echo $d['piutang_id']; ?></td>
                                    <td class="text-center"><?php echo date('d-m-Y', strtotime($d['piutang_tanggal'])); ?></td>
                                    <td><?php echo $d['piutang_keterangan']; ?></td>
                                    <td class="text-center"><?php echo "Rp. " . number_format($d['piutang_nominal']) . " ,-"; ?></td>
                                </tr>


                        </tbody>

                    <?php
                            }
                    ?>
                    <tfoot>
                        <tr>
                            <th colspan="4"><b> Total</b></th>
                            <th style="text-align: center;"><?= "Rp. " . number_format($piutang_nominal) . ",-" ?></th>
                        </tr>
                    </tfoot>
                    </table>



                    <script>
                        window.print();
                    </script>

    </body>

    </html>