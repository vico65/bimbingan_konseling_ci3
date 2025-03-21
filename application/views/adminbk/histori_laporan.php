<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-tabs card-header-primary">
                <b><i class="fa fa-warning"></i> LAPORAN PELANGGARAN SISWA</b>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active relative" id="profile">

                    <div class="d-flex align-items-center gap-3 w-100 justify-content-between">
                        <!-- Form untuk filter Tahun Ajaran -->
                        <form class=" w-100" method="GET" action="<?= site_url('adminbk/LaporanController/histori_laporan') ?>">
                            <label for="tahun_ajaran"><b>Pilih Tahun Akademik:</b></label>
                            <select name="tahun_ajaran" id="tahun_ajaran" class="form-control <?= $this->session->userdata('level_akses') == 'kepsek'? 'w-75' : '' ?>" onchange="this.form.submit()">
                                <option value="">-- Semua Tahun Akademik:--</option>
                                <?php foreach ($tahun_ajaran_list as $tahun) : ?>
                                    <option value="<?= $tahun['tahun_akademik'] ?>" <?= ($tahun['tahun_akademik'] == $tahun_ajaran_terpilih) ? 'selected' : '' ?>>
                                        <?= $tahun['tahun_akademik'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </form>

                        <?php if ($this->session->userdata('level_akses') == 'kepsek' && $laporan->num_rows() > 0) :  ?>
                            <button type="button" class="btn btn-warning m-3 ms-auto" onclick="lihatLaporan()">
                                <b>Buat Laporan Pdf</b>
                                <!-- <b><?= $tahun_ajaran_terpilih ?></b> -->
                                <input type="hidden" name="" id="tahun_ajaran_terpilih" value="<?= $tahun_ajaran_terpilih ?>">
                            </button>


                        <?php endif; ?>
                    </div>
                        

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
                                        <td class="text-capitalize"><?= strtolower($row['nama_siswa']) ?></td>
                                        <td><?= $row['nama_kelas'] ?></td>
                                        <td><?= $row['create_date'] ?></td>
                                        <td><?= $row['nama_guru'] ?></td>
                                        <td><?= $row['kode_pelanggaran'] ?></td>
                                        <td><?= $row['deskripsi_pelanggaran'] ?></td>
                                        <td><?= $row['tanggal_konfirmasi_pelanggaran'] ?></td>
                                        <td class="text-center"><?= $row['poin_pelanggaran'] ?></td>
                                        <td class="td-actions text-right" style="color: #4caf50">
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

<script type="text/javascript">
    function lihatLaporan() {
        // console.log(tahun_ajaran);
        let tahun_ajaran_terpilih = document.getElementById('tahun_ajaran_terpilih');

        if(tahun_ajaran_terpilih.value) {
            window.location.href = "<?= site_url('suratpdf/laporanPelanggaran') ?>?tahun_ajaran_terpilih=" + encodeURIComponent(tahun_ajaran_terpilih.value);
        } else {
            window.location.href = "<?= site_url('suratpdf/laporanPelanggaran') ?>/";
            
        }
        
    }
</script>