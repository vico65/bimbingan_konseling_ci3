<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pemanggilan</title>
    <style>
        body {
            font-family: "Arial", sans-serif;
            font-size: 11pt;
            margin: 10px;
            text-align: justify;
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

        .nomor-surat,
        .content,
        .footer {
            margin-top: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            vertical-align: top;
            padding: 1px;
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
    </style>
</head>

<body>

    <div style="text-align: center; text-decoration: underline; font-size: 20px;"><strong><?= $hal_surat ?></strong></div>

    <div style="margin-bottom: 75px;"></div>

    <p>Saya yang bertanda tangan di bawah ini : </p>

    <div class="content">
        <table style="padding-left: 40px;">
            <tr>
                <td>1. Nama</td>
                <td>: <?= $siswa['nama_wali_siswa']; ?></td>
            </tr>
            <tr>
                <td>2. Pekerjaan</td>
                <td>: <?= $siswa['pekerjaan_wali_siswa']; ?></td>
            </tr>
            <tr>
                <td>3. Alamat</td>
                <td>: <?= $siswa['alamat_wali_siswa']; ?></td>
            </tr>
        </table>

        <br>

        <p>Orang tua dari Siswa : </p>

        <table style="padding-left: 40px;">
            <tr>
                <td>1. Nama</td>
                <td>: <?= $siswa['nama_siswa']; ?></td>
            </tr>
            <tr>
                <td>2. Kelas / Nis</td>
                <td>: <?= $siswa['nama_kelas']; ?> / <?= $siswa['nis_siswa']; ?></td>
            </tr>
        </table>

        <p>Dengan ini menyatakan bahwa anak saya yang namanya disebut di atas telah mengundurkan diri dengan alasan telah melakukan pelanggaran sebagai berikut: </p>

        <?php
        $nomor = 1;
        foreach ($laporan as $l) :
        ?>
            <div><strong><?= $nomor; ?>. <?= $l['deskripsi_pelanggaran'] ?></strong></div>

        <?php $nomor++;
        endforeach; ?>

        <p>Demikianlah surat pengunduran diri anak saya tersebut saya sampaikan. Atas perhatiannya saya ucapkan terima kasih. </p>

    </div>

    <div style="padding-right: 20px; width: 100%; display: table; margin-top: 100px;">
        <!-- div pertama -->
        <div class="" style="font-size: 12px; vertical-align: middle; display: table-cell; width: 30%;">
            
        </div>

        <!-- div kedua -->
        <div class="" style="text-align: left; width: 60%;
            display: table-cell;
            vertical-align: middle;  padding-left: 200px;">

            <div>Palembang, _______________ </div>
            <div class="">Yang membuat pernyataan,</div>
            <div style="padding: 45px;"></div>
            <div style="padding-left: 80px;"><strong><?= $siswa['nama_wali_siswa'] ?></strong></div>


        </div>

</body>

</html>