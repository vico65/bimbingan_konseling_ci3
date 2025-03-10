<div class="row">
    <!-- Modal untuk membuat surat -->
    <div class="modal fade" id="modal_surat" tabindex="-1" role="dialog" aria-labelledby="modal_suratLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_suratLabel">Lihat Surat Panggilan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin melihat surat panggilan untuk siswa ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="buatSurat('')" id="confirmCreateLetter">Lihat Surat</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-tabs card-header-primary">
                <b><i class="material-icons">supervised_user_circle</i> DAFTAR SISWA</b>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="profile">
                        <div style="overflow-y: scroll;">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th>No.</th>
                                        <th>NIS</th>
                                        <th>Nama siswa</th>
                                        <th>Kelas</th>
                                        <th>Alamat siswa</th>
                                        <th>Jenis kelamin</th>
                                        <th>Tanggal Lahir lahir</th>
                                        <th>No Telephone</th>
                                        <th>Jumlah Poin</th>
                                        <th style="width: 100px;"><center>Aksi</center></th>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <?php
                                     $nomor = 1;
                                    // Mengambil data siswa dengan poin lebih dari 25
                                    $getdaftarSiswa = $this->m_siswa->getSiswaDenganPoinDiAtas25();

                                    if ($getdaftarSiswa !== false) {
                                        foreach ($getdaftarSiswa as $row) {                     
                                    ?>
                                            <tr>
                                                <td><?= $nomor++ ?></td> <!-- Kolom nomor -->
                                                <td><?= htmlspecialchars($row['nis_siswa']) ?></td>
                                                <td><?= htmlspecialchars($row['nama_siswa']) ?></td>
                                                <td><?= htmlspecialchars($row['nama_kelas']) ?></td>
                                                <td><?= htmlspecialchars($row['alamat_siswa']) ?></td>
                                                <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
                                                <td><?= htmlspecialchars($row['tanggal_lahir']) ?></td>
                                                <td><?= htmlspecialchars($row['no_telephone_siswa']) ?></td>
                                                <td><?= htmlspecialchars($row['poin_siswa']) ?></td>
                                                <td>               
                                                    <button type="button" class="btn btn-warning" data-id="<?= $row['nis_siswa'] ?>" onclick="setIdAndOpenModal(this)" data-toggle="modal" data-target="#modal_surat">
                                                        <b>Lihat Surat</b>
                                                    </button>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='9'>Tidak ada data siswa ditemukan.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function setIdAndOpenModal(button) {
    const idSiswa = button.getAttribute('data-id');
    document.querySelector('#confirmCreateLetter').setAttribute('onclick', `buatSurat('${idSiswa}')`);
}

function buatSurat(id_siswa) {
    window.location.href = "<?= site_url('suratpdf/suratPemanggilan') ?>/" + id_siswa;
}
</script>
