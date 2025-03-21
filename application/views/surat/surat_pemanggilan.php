<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pemanggilan</title>
    <style>
        body {
            font-family: "Arial", sans-serif;
            font-size: 12pt;
            margin: 10px;
            text-align: justify;
            padding-left: 17px;
            padding-right: 17px;
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

    <div class="nomor-surat" style="margin-bottom: 25px;">
        <table>
            <tr>
                <td>Nomor</td>
                <td>:</td>
                <td>421.5/422-241/ SMKN5/Disdik.SS/ 2025</td>
            </tr>
            <tr>
                <td>Lamp</td>
                <td>:</td>
                <td>-</td>
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
                <td>Bapak/Ibu <?= $siswa['nama_wali_siswa'] ?>
            </tr>
            <tr>
                <td>Orang Tua/Wali dari <?= $siswa['nama_siswa'] ?>
            </tr>
            <tr>
                <td>Kelas <?= $siswa['nama_kelas'] ?>
            </tr>
            <tr>
                <td>Di tempat</td>
            </tr>
        </table>

        <p style="font-style: italic;"><strong>Assalamu’alaikum Wr. Wb.</strong></p>
        <p style="text-indent: 10px;">Dengan ini kami informasikan bahwa Anak Bapak/Ibu/Saudara telah melakukan pelanggaran tata tertib sekolah dengan rincian berupa : </p>

        <div class="" style="padding-left: 50px;">
            <table>
                <tr>
                    <td>Hari</td>
                    <td>:</td>
                    <td><?= $hari_laporan ?></td>
                </tr>
                <tr>
                    <td>Tanggal dan Waktu</td>
                    <td>:</td>
                    <td><?= $tanggal_laporan ?> <?= $waktu_laporan ?></td>
                </tr>
                <tr>
                    <td>Deskripsi Pelanggaran</td>
                    <td>:</td>
                    <td><?= $laporan['deskripsi_pelanggaran'] ?></td>
                </tr>
            </table>
        </div>

        <p style="text-indent: 10px;">Untuk itu kami harapkan Bapak/Ibu/Saudara dapat menyempatkan diri untuk datang ke sekolah. Menghadap Guru Bimbingan Konseling SMK NEGERI 5 Palembang pada: </p>

        <div class="" style="padding-left: 50px;">
            <table>
                <tr>
                    <td>Hari</td>
                    <td>:</td>
                    <td><?= $hari_bimbingan ?></td>
                </tr>
                <tr>
                    <td>Tanggal dan Waktu</td>
                    <td>:</td>
                    <td><?= $tanggal_bimbingan ?> 10.00</td>
                </tr>
            </table>
        </div>



        <p style="text-indent: 10px;">Demikian surat panggilan ini disampaikan, atas perhatian serta kerjasamanya diucapkan terima kasih.</p>
        <p style="font-style: italic;"><strong>Wassalamu’alaikum Wr. Wb.</strong></p>

    </div>

    <div style=" width: 100%; display: table; margin-top: 50px;">

        <div class="" style="width: 40%;"></div>

        <div class="" style="text-align: left; width: 60%;
            display: table-cell;
            vertical-align: middle;  padding-left: 120px;">

            <div>Palembang, <?= $tanggal_bimbingan ?> <br> Kepala Sekolah,</div>
            <div style="padding: 50px;"></div>
            <div><strong>Bambang Riadi, S.Pd.M.Pd</strong> <br> Pembina Tk I, IV/b <br> NIP. 196712101991031008</div>


        </div>

    </div>

</body>

</html>