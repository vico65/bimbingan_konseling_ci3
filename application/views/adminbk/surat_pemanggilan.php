<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pemanggilan</title>
    <style>
        body { font-family: "Times New Roman", serif; font-size: 11pt; margin: 10px; text-align: justify; }
        .header, .sub-header { text-align: center; font-size: 12pt; line-height: 1.2; }
        .sub-header { font-size: 10pt; }
        .line { border-bottom: 2px solid black; margin-bottom: 5px; }
        .nomor-surat, .content, .footer { margin-top: 5px; }
        table { width: 100%; border-collapse: collapse; }
        td { vertical-align: top; padding: 1px; }
        .footer { margin-top: 30px; text-align: right; }
    </style>
</head>
<body>

    <div class="header">
        PEMERINTAH PROVINSI SUMATERA SELATAN <br>
        SMK NEGERI 5 PALEMBANG
    </div>
    <div class="sub-header">
        Jalan Demang Lebar Daun No. 4811, Kel. Lorok Pakjo, Kec. Ilir Barat 1 <br>
        Telp. 345820 Palembang 30137, Sumatera Selatan<br>
        Laman : <a href="http://www.smkn5palembang.sch.id">www.smkn5palembang.sch.id</a> | Email: smkn5_plg@yahoo.co.id
    </div> <br>
    <div class="line"></div>

    <div class="nomor-surat">
        <p>Nomor: ..............</p>
        <p>Lampiran: -</p>
        <p>Hal: <strong><?= $hal_surat ?></strong></p>
    </div>

    <div class="content">
        <table>
            <tr><td>Kepada Yth,</td> </tr>
            <tr><td>Orang Tua/Wali <strong><?= $siswa['nama_siswa'] ?></strong></tr>
            <tr><td>Kelas <strong><?= $siswa['nama_kelas'] ?></strong></tr>
            <tr><td>di</td></tr>
            <tr><td>Palembang</td></tr>
        </table>

        <p>Assalamu’alaikum Wr. Wb,</p>
        <p>Dengan ini kami informasikan bahwa anak Bapak/Ibu telah melanggar tata tertib sekolah dan dikenai <strong><?= $kode_bimbingan ?></strong> dengan poin pelanggaran sebesar <strong><?= $poin_pelanggaran ?></strong>.</p>
        

        <p>Dimohon kehadiran Bapak/Ibu untuk menghadap:</p>
        <table>
            <tr><td width="50%">a. Kepala Sekolah</td> <td width="50%">: -</td></tr>
            <tr><td>b. Wakil Kepala Sekolah</td> <td>: -</td></tr>
            <tr><td>c. Kaprog</td> <td>: -</td></tr>
            <tr><td>d. Wali Kelas</td> <td>: </td></tr>
            <tr><td>e. Guru BP</td> <td>: -</td></tr>
        </table>

        <p>Jadwal pertemuan:</p>
        <table>
            <tr><td width="40%"><strong>Hari</strong></td> <td width="5%">:</td> <td><?= $hari_bimbingan ?></td></tr>
            <tr><td><strong>Tanggal</strong></td> <td>:</td> <td><?= date('d F Y', strtotime($tanggal_bimbingan)) ?></td></tr>
            <tr><td><strong>Waktu</strong></td> <td>:</td> <td>09.00 WIB</td></tr>
        </table>

        <p>Mohon hadir tepat waktu demi kepentingan anak kita bersama. Terima kasih atas perhatian dan kerjasamanya.</p>
    </div>

    <div class="footer">
        <p>Palembang, <?= date('d F Y') ?></p>
        <p>Kepala Sekolah,</p>
        <br><br>
        <p><strong>Bambang Riadi, S.Pd.M.Pd</strong></p>
        <p>Pembina Tk I, IV/b</p>
        <p>NIP. 196712101991031008</p>
    </div>

</body>
</html>
