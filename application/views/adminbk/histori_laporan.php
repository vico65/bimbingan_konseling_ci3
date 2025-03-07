<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-tabs card-header-primary">
                <b><i class="fa fa-warning"></i> LAPORAN PELANGGARAN SISWA</b>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="profile">

                        <!-- Form untuk filter Tahun Ajaran -->
                        <form method="GET" action="<?= site_url('adminbk/LaporanController/histori_laporan') ?>">
                            <label for="tahun_ajaran"><b>Pilih Tahun Akademik:</b></label>
                            <select name="tahun_ajaran" id="tahun_ajaran" class="form-control" onchange="this.form.submit()">
                                <option value="">-- Semua Tahun Akademik:--</option>
                                <?php foreach ($tahun_ajaran_list as $tahun) : ?>
                                    <option value="<?= $tahun['tahun_akademik'] ?>" <?= ($tahun['tahun_akademik'] == $tahun_ajaran_terpilih) ? 'selected' : '' ?>>
                                        <?= $tahun['tahun_akademik'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </form>

                        <br>

                        <!-- Tabel Data Pelanggaran -->
                        <table class="table">
                            <tbody>
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
                            </tbody>
                            <tbody>
                                <?php $nomor = 1; ?>

                                <?php foreach ($laporan->result_array() as $row) :    ?>
                                    <tr>
                                        <td><?= $nomor++ ?></td>
                                        <td><?= $row['nis_siswa'] ?></td>
                                        <td><?= $row['nama_siswa'] ?></td>
                                        <td><?= $row['nama_kelas'] ?></td>
                                        <td><?= $row['create_date'] ?></td>
                                        <td><?= $row['nama_guru'] ?></td>
                                        <td><?= $row['kode_pelanggaran'] ?></td>
                                        <td><?= $row['deskripsi_pelanggaran'] ?></td>
                                        <td><?= $row['tanggal_konfirmasi_pelanggaran'] ?></td>
                                        <td class="text-center"><?= $row['poin_pelanggaran'] ?></td>
                                        <td class="td-actions text-right">
                                            <?php if ($row['status_validasi'] == 'Y') : ?>
                                                <b><i class="fa fa-check" style="color: #4caf50"></i> Disetujui</b>
                                            <?php elseif ($row['status_validasi'] == 'N') : ?>
                                                <b><i class="fa fa-close" style="color: red"></i> Dibatalkan</b>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <!-- End Tabel Data Pelanggaran -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
