<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-tabs card-header-primary">
                <b><i class="fa fa-warning"></i> DAFTAR BIMBINGAN</b>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="profile">
                        
                        <!-- Form untuk filter Tahun Ajaran -->
                        <form method="GET" action="<?= site_url('adminbk/BimbinganController/') ?>">
                            <label for="tahun_ajaran"><b>Pilih Tahun Ajaran:</b></label>
                            <select name="tahun_ajaran" id="tahun_ajaran" class="form-control" onchange="this.form.submit()">
                                <option value="">-- Semua Tahun Ajaran --</option>
                                <?php foreach ($tahun_ajaran_list as $tahun) : ?>
                                    <option value="<?= $tahun['tahun_akademik'] ?>" <?= ($tahun['tahun_akademik'] == $tahun_ajaran_terpilih) ? 'selected' : '' ?>>
                                        <?= $tahun['tahun_akademik'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </form>

                        <br>

                        <!-- Tabel Data Bimbingan -->
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal Bimbingan</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Status Bimbingan</th>
                                    <th>Jenis Bimbingan</th>
                                    <th>Poin</th>
                                    <?php if ($this->session->userdata('level_akses') == 'adminbk') : ?>
                                    <th>Aksi</th>
                                    <?php endif; ?>
                                </tr>
                            </tbody>
                            <tbody>
                                <?php $nomor = 1; ?>
                                <?php foreach ($bimbingan->result_array() as $row) : ?>
                                    <tr>
                                        <td><?= $nomor++ ?></td>
                                        <td><?= $row['tanggal_bimbingan'] ?></td>
                                        <td><?= $row['nis_siswa'] ?></td>
                                        <td><?= $row['nama_siswa'] ?></td>
                                        <td><?= $row['kelas'] ?></td>
                                        <td>
                                            <b style="color: <?= ($row['status_bimbingan'] == 'AKTIF') ? 'green' : 'red' ?>;">
                                                <?= $row['status_bimbingan'] ?>
                                            </b>
                                        </td>
                                        <td><?= $row['kode_bimbingan'] ?></td>
                                        <td><?= $row['poin_pelanggaran'] ?></td>
                                        <?php if ($this->session->userdata('level_akses') == 'adminbk') : ?>
                                        <td>
                                            <?php if ($row['status_bimbingan'] == 'AKTIF') : ?>
                                                <a href="<?= base_url('jadwal_bimbingan/' . $row['id_bimbingan']) ?>">
                                                    <button class="btn btn-primary">Detail</button>
                                                </a>
                                                <button class="btn btn-danger" onclick="alertdel('<?= $row['id_bimbingan'] ?>')">Expired</button>
                                            <?php endif; ?>
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <!-- End Tabel Data Bimbingan -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function alertdel(id) {
    var r = confirm("Yakin ingin menonaktifkan data bimbingan yang dipilih?");
    if (r == true) {
        ExpiredBimbingan(id);
    } else {
        return true;
    }
}

function ExpiredBimbingan(id) {
    var hps = new FormData();
    hps.append('id', id);
    $.ajax({
        url: '<?= base_url() ?>Adminbk/BimbinganController/NonAktifkanBimbingan',
        method: 'POST',
        contentType: false,
        processData: false,
        data: hps,
        success: function(data) {
            console.log(data);
            location.reload();
        },
        error: function(data) {
            console.log(data);
        }
    });
}
</script>
