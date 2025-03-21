<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"> -->
    <title>Laporan Pelanggaran</title>
    <style>
        body {
            font-family: "Arial", sans-serif;
            font-size: 12pt;
            margin: 10px;
            text-align: justify;
            padding-left: 5px;
            padding-right: 5px;
        }

        .header,
        .sub-header {
            text-align: center;
            font-size: 12pt;
            line-height: 1.2;
        }

        .sub-header {
            font-size: 10pt;
        }

        .line {
            border-bottom: 1px solid black;
            margin-bottom: 1px;
        }

        .mb-5 {
            margin-bottom: 5px;
        }

        .content,
        .footer {
            margin-top: 5px;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        .header-container {
            width: 100%;
            display: table;
        }

        .header-left,
        .header-right {
            width: 20%;
            display: table-cell;
            text-align: center;
            vertical-align: middle;
        }

        .header-center {
            width: 70%;
            display: table-cell;
            text-align: center;
            vertical-align: middle;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: center;
        }

        th {
            background-color: #f4f4f4;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>


    <div class="header-container">
        <div class="header-left">
            <img src="<?= base_url() ?>assets/img/sumsel-logo.png" alt="" width="80" height="120" style="">
        </div>


        <div class="header-center">
            <div class="header">
                PEMERINTAH PROVINSI SUMATERA SELATAN <br>
                <strong>SMK NEGERI 5 PALEMBANG</strong>
            </div>
            <div class="sub-header">
                <div style="font-weight: 500;">Jalan Demang Lebar Daun No. 4811, Kel. Lorok Pakjo, Kec. Ilir Barat 1 <br>
                    Telp. 345820 Palembang 30137, Sumatera Selatan<br></div>

                Laman : <a href="http://www.smkn5palembang.sch.id">www.smkn5palembang.sch.id</a> | Email: smkn5_plg@yahoo.co.id
            </div> <br>
        </div>

        <div class="header-right">
            <img src="<?= base_url() ?>assets/img/smkn5.png" alt="" width="100" height="120" style="">
        </div>

    </div>

    <div class="line"></div>
    <div class="line"></div>
    <div class="mb-5"></div>

    <div class="content">
        <div style="text-align: center; font-size: 18px; margin-top: 10px;"><strong>Laporan Pelanggaran Siswa</strong></div>

        <?php if($tahun_ajaran_terpilih) : ?>
        <div style="text-align: center; font-size: 15px;"><strong>Tahun Akademik <?= $tahun_ajaran_terpilih ?></strong></div>
        <?php else :  ?>
        <div style="text-align: center; font-size: 15px;"><strong>Semua Tahun Akademik</strong></div>
        <?php endif; ?>


        <?php

        $nomor = 1;

        ?>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Tanggal Pelaporan</th>
                    <th>Pelapor</th>
                    <th>Kode Pelanggaran</th>
                    <th>Deskripsi Pelanggaran</th>
                    <th>Tanggal Konfirmasi</th>
                    <th>Poin Diterima</th>
                    <th>Status Pelaporan</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($laporan as $data): ?>
                    <tr>
                        <td><?= $nomor++ ?></td>
                        <td><?= $data['nis_siswa'] ?></td>
                        <td style="text-transform: capitalize;"><?= strtolower($data['nama_siswa']) ?></td>
                        <td><?= $data['nama_kelas'] ?></td>
                        <td><?= $data['create_date'] ?></td>
                        <td><?= $data['nama_guru'] ?></td>
                        <td><?= $data['kode_pelanggaran'] ?></td>
                        <td><?= $data['deskripsi_pelanggaran'] ?></td>
                        <td><?= $data['tanggal_konfirmasi_pelanggaran'] ?></td>
                        <td class="text-center"><?= $data['poin_pelanggaran'] ?></td>
                        <td class="td-actions text-right" style="color: <?= ($data['status_validasi'] == 'Y') ? '#4caf50' : 'red' ?>;">
                            <?php if ($data['status_validasi'] == 'Y') : ?>
                                <b><i class="fa fa-check" style="color: #4caf50"></i> Disetujui</b>
                            <?php elseif ($data['status_validasi'] == 'N') : ?>
                                <b><i class="fa fa-close" style="color: red"></i> Dibatalkan</b>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php $nomor++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>


    </div>

    <div style=" width: 100%; display: table; margin-top: 180px;">

        <div class="" style="width: 40%;"></div>

        <div class="" style="text-align: left; width: 60%;
            display: table-cell;
            vertical-align: middle;  padding-left: 120px;">

            <div>Palembang, <?= $tanggal_hari_ini ?><br> Kepala Sekolah,</div>
            <div style="padding: 50px;"></div>
            <div><strong>Bambang Riadi, S.Pd.M.Pd</strong> <br> Pembina Tk I, IV/b <br> NIP. 196712101991031008</div>


        </div>

    </div>

</body>

</html>