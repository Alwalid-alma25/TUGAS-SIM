<?php include 'header.php'; ?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>
            LAPORAN
            <small>Data Laporan</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <section class="col-lg-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Filter Laporan</h3>
                    </div>
                    <div class="box-body">
                        <form method="get" action="">
                            <div class="row">
                                <div class="col-md-3">

                                    <div class="form-group">
                                        <label>Bulan</label>
                                        <input autocomplete="off" type="text" value="<?php if (isset($_GET['bulan'])) {
                                                                                            echo $_GET['bulan'];
                                                                                        } else {
                                                                                            echo "";
                                                                                        } ?>" name="bulan" class="form-control datepicker3" placeholder="BULAN" required="required">
                                    </div>

                                </div>




                                <div class="col-md-3">

                                    <div class="form-group">
                                        <br />
                                        <input type="submit" value="TAMPILKAN" class="btn btn-sm btn-primary btn-block">
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Laporan Pemasukan & Pegeluaran</h3>
                    </div>
                    <div class="box-body">

                        <?php
                        if (isset($_GET['bulan'])) {

                            $bln = $_GET['bulan'];
                            
                        ?>

                            <div class="row">
                                <div class="col-lg-6">
                                    <table class="table table-bordered">

                                        <tr>
                                            <th width="30%">BULAN</th>
                                            <th width="1%">:</th>
                                            <td><?php echo $bln; ?></td>
                                        </tr>
                                        
                                    </table>

                                </div>
                            </div>

                            <a href="laporan_pdf.php?bulan=<?php echo $bln ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a>
                            <a href="laporan_print.php?bulan=<?php echo $bln ?>" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> &nbsp PRINT</a>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="1%" rowspan="2">NO</th>
                                            <th width="10%" rowspan="2" class="text-center">TANGGAL</th>
                                            <th rowspan="2" class="text-center">KATEGORI</th>
                                            <th rowspan="2" class="text-center">KETERANGAN</th>
                                            <th colspan="2" class="text-center">JENIS</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">PEMASUKAN</th>
                                            <th class="text-center">PENGELUARAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include '../koneksi.php';
                                        $no = 1;
                                        $total_pemasukan = 0;
                                        $total_pengeluaran = 0;

                                        
                                        while ($d = mysqli_fetch_array($data)) {

                                            if ($d['transaksi_jenis'] == "Pemasukan") {
                                                $total_pemasukan += $d['transaksi_nominal'];
                                            } elseif ($d['transaksi_jenis'] == "Pengeluaran") {
                                                $total_pengeluaran += $d['transaksi_nominal'];
                                            }
                                        ?>
                                            <tr>
                                                <td class="text-center"><?php echo $no++; ?></td>
                                                <td class="text-center"><?php echo date('d-m-Y', strtotime($d['transaksi_tanggal'])); ?></td>
                                                <td><?php echo $d['kategori']; ?></td>
                                                <td><?php echo $d['transaksi_keterangan']; ?></td>
                                                <td class="text-center">
                                                    <?php
                                                    if ($d['transaksi_jenis'] == "Pemasukan") {
                                                        echo "Rp. " . number_format($d['transaksi_nominal']) . " ,-";
                                                    } else {
                                                        echo "-";
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    if ($d['transaksi_jenis'] == "Pengeluaran") {
                                                        echo "Rp. " . number_format($d['transaksi_nominal']) . " ,-";
                                                    } else {
                                                        echo "-";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        <tr>
                                            <th colspan="4" class="text-right">TOTAL</th>
                                            <td class="text-center text-bold text-success"><?php echo "Rp. " . number_format($total_pemasukan) . " ,-"; ?></td>
                                            <td class="text-center text-bold text-danger"><?php echo "Rp. " . number_format($total_pengeluaran) . " ,-"; ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="4" class="text-right">SALDO</th>
                                            <td colspan="2" class="text-center text-bold text-white bg-primary"><?php echo "Rp. " . number_format($total_pemasukan - $total_pengeluaran) . " ,-"; ?></td>
                                        </tr>
                                    </tbody>
                                </table>



                            </div>

                        <?php
                        } else {
                        ?>

                            <div class="alert alert-info text-center">
                                Silahkan Filter Laporan Terlebih Dulu.
                            </div>

                        <?php
                        }
                        ?>

                    </div>
                </div>
            </section>
        </div>
    </section>

</div>
<?php include 'footer.php'; ?>