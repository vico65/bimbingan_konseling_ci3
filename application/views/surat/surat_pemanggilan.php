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


    <div class="header-container">
        <div class="header-left">
            <img src="<?= base_url() ?>assets/img/sumsel-logo.png" alt="" width="80" style="">
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
            <img src="<?= base_url() ?>assets/img/smkn5.png" alt="" width="80" style="">
        </div>

    </div>

    <div class="line"></div>
    <div class="line"></div>
    <div class="mb-5"></div>

    <div class="nomor-surat" style="margin-bottom: 25px;">
        <table>
            <tr>
                <td>Nomor</td>
                <td>:</td>
                <td>421.5/422-_______/ SMKN5/Disdik.SS/ 2025</td>
            </tr>
            <tr>
                <td>Lamp</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td>Hal</td>
                <td>:</td>
                <td style="text-decoration: underline;"><strong><?= $hal_surat ?></strong></td>
            </tr>
        </table>
    </div>

    <div class="content">
        <table>
            <tr>
                <td>Kepada Yth,</td>
            </tr>
            <tr>
                <td>Orang Tua/Wali <?= $siswa['nama_siswa'] ?>
            </tr>
            <tr>
                <td>Kelas <?= $siswa['nama_kelas'] ?>
            </tr>
            <tr>
                <td>di</td>
            </tr>
            <tr>
                <td style="padding-left: 20px;">Palembang</td>
            </tr>
        </table>

        <p>Assalamu’alaikum Wr. Wb, dengan ini kami informasikan bahwa Anak Bapak/Ibu/Saudara telah melanggar tata tertib sekolah berupa : </p>
        

        <?php 
        $nomor = 1;
        foreach($laporan as $l) : 
        ?>
        <div><strong><?= $nomor; ?>. <?= $l['deskripsi_pelanggaran'] ?></strong></div>
        
        <?php $nomor++;
        endforeach; ?>

        <p>Untuk itu kami harapkan Bapak/Ibu/Saudara datang ke sekolah menghadap : </p>
        <table>
            <tr>
                <td width="50%">a. Kepala Sekolah</td>
                <td width="50%">: -</td>
            </tr>
            <tr>
                <td>b. Wakil Kepala Sekolah</td>
                <td>: -</td>
            </tr>
            <tr>
                <td>c. Kaprog</td>
                <td>: -</td>
            </tr>
            <tr>
                <td>d. Wali Kelas Bersangkutan</td>
                <td>: -</td>
            </tr>
            <tr>
                <td>e. Guru BP</td>
                <td>: Rapli Iskanda, S. Pd.</td>
            </tr>
            <tr>
                <td>f. Guru Mata Pelajaran</td>
                <td>: -</td>
            </tr>
            <tr>
                <td>g. Kaprog BDP</td>
                <td>: -</td>
            </tr>
            <tr>
                <td>e. Guru Piket</td>
                <td>: -</td>
            </tr>
        </table>

        <p>di SMK Negeri 5 Palembang pada:</p>

        <table style="padding-left: 40px;">
            <tr>
                <td width="40%"><strong>Hari</strong></td>
                <td width="5%">:</td>
                <td><?= $hari_bimbingan ?></td>
            </tr>
            <tr>
                <td><strong>Tanggal</strong></td>
                <td>:</td>
                <!-- buat bahasa indonesia bulannya -->
                <td><?= $tanggal_bimbingan ?></td>
            </tr>
            <tr>
                <td><strong>Waktu</strong></td>
                <td>:</td>
                <td>09.00 WIB</td>
            </tr>
        </table>

        <p>Demikian demi kepentingan anak kita tersebut, diminta saudara hadir tepat pada waktunya. Atas kerjasamanya diucapkan terima kasih.</p>
    </div>

    <div style="padding-right: 20px; width: 100%; display: table;">
        <!-- div pertama -->
        <div class="" style="font-size: 12px; vertical-align: middle; display: table-cell; width: 30%;">
            <?php if($status_sp3): ?>
            <p>NB : Apabila tidak memenuhi panggilan ini dianggap mengundurkan diri</p>
            <?php endif; ?>
        </div>

        <!-- div kedua -->
        <div class="" style="text-align: left; width: 60%;
            display: table-cell;
            vertical-align: middle;  padding-left: 200px;">

                <div>Palembang, <?= $tanggal_bimbingan ?> <br> Kepala Sekolah</div>
                <div style="padding: 35px;"></div>
                <div><strong>Bambang Riadi, S.Pd.M.Pd</strong> <br> Pembina Tk I, IV/b <br> NIP. 196712101991031008</div>


        </div>

    </div>

    <div style="margin-top: 10px; text-align: right;">
        <p style="font-size: 10px; color: gray;">*Data Meri : F. surat-surat"</p>
    </div>

</body>

</html>