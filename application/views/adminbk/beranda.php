

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><b>Daftar Pelanggaran</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <input type="hidden" readonly="" id="id_siswa">
                            <input type="hidden" readonly="" id="id_laporan">
                        </tr>
                        <tr>
                            <th>Pilih</th>
                            <th>Kode</th>
                            <th>Jenis Pelanggaran</th>
                            <th>Sanksi</th>
                            <th><center>Poin</center></th>
                        </tr>
                        <!-- Query untuk menampilkan daftar pelanggaran -->
                        <?php
                        $query = $this->m_pelanggaran->getDataPelanggaran();
                        foreach ($query->result_array() as $no => $rowPelanggaran) {
                        ?>
                        <tr>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <!-- Tambahkan data-id_pelanggaran di sini -->
                                        <input class="form-check-input pilihpelanggaran" type="checkbox" 
                                            data-id_pelanggaran="<?= $rowPelanggaran['id_pelanggaran'] ?>" 
                                            data-poin="<?= $rowPelanggaran['poin_pelanggaran'] ?>">
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                            </td>
                            <td><?= $rowPelanggaran['kode_pelanggaran'] ?></td>
                            <td><?= $rowPelanggaran['jenis_pelanggaran'] ?></td>
                            <td><?= $rowPelanggaran['sanksi_pelanggaran'] ?></td>
                            <td><center><?= $rowPelanggaran['poin_pelanggaran'] ?></center></td>
                        </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="GettotalPointDipilih()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <?php
    $total_siswa = $this->db->count_all('siswa');
    $total_kelas = $this->db->query('select id_kelas from kelas')->num_rows();
    $total_guru = $this->db->count_all('guru');
    $total_bimbingan = $this->db->count_all('bimbingan');
    ?>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">group</i>
                </div>
                <p class="card-category">Total siswa</p>
                <h3 class="card-title"><?= $total_siswa ?> Siswa / <?= $total_kelas ?> Kelas</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">sync</i> up to date
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">supervised_user_circle</i>
                </div>
                <p class="card-category">Total guru</p>
                <h3 class="card-title"><?= $total_guru ?></h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">sync</i> up to date
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">info_outline</i>
                </div>
                <p class="card-category">Total bimbingan</p>
                <h3 class="card-title"><?= $total_bimbingan ?></h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">sync</i> up to date
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-tabs card-header-primary">
                <b><i class="fa fa-warning"></i> LAPORAN PELANGGARAN SISWA</b>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="profile">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>NIS</th>
                                        <th>Nama siswa</th>
                                        <th>Kelas</th>
                                        <th>Laporan</th>
                                        <th>Pelapor</th>
                                        <th style="width: 40px;">Aksi</th>
                                    </tr>
                                    <?php
                                    $jumlah_laporan = $this->m_laporan->getLaporanPelanggaran($this->session->userdata('level_akses'))->num_rows();
                                  
                                    $nomor = 1; // Inisialisasi nomor urut
                                    if ($jumlah_laporan > 0) {
                                        $getdataPelanggaran = $this->m_laporan->getLaporanPelanggaran($this->session->userdata('level_akses'));
                                        foreach ($getdataPelanggaran->result_array() as $row) {
                                    ?>
                                    <tr>
                                        <td><?= $nomor++ ?></td> <!-- Kolom nomor -->
                                        <td><?= $row['create_date'] ?></td>
                                        <td><?= $row['nis_siswa'] ?></td>
                                        <td><?= $row['nama_siswa'] ?></td>
                                        <td><?= $row['nama_kelas'] ?></td>
                                        <td><?= $row['deskripsi_pelanggaran'] ?></td>
                                        <td><?= $row['nama_guru'] ?></td>
                                        <td class="td-actions text-right">
                                            <button type="button" rel="tooltip" title="Beri Point" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-primary" data-nis="<?= $row['nis_siswa'] ?>" data-laporan="<?= $row['id_laporan'] ?>">
                                                <i class="material-icons">warning</i>
                                                Beri Poin
                                            </button> &nbsp;
                                            <button type="button" rel="tooltip" title="Hapus Pelanggaran" onclick="alertdel('<?= $row['id_laporan'] ?>')" class="btn btn-danger">
                                                <i class="material-icons">close</i>
                                                Batalkan
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='7'><center><i class='fa fa-search'></i> Tidak ada laporan terbaru</center></td></tr>";
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
function GettotalPointDipilih() {
    let jumlah = 0;
    let pelanggaran = []; // Array untuk menyimpan id pelanggaran yang dipilih
    let poinPelanggaran = []; // Array untuk menyimpan poin pelanggaran

    $('.pilihpelanggaran:checked').each(function() {
        jumlah += parseInt($(this).data('poin'));
        pelanggaran.push($(this).data('id_pelanggaran')); // Menyimpan id pelanggaran yang dipilih
        poinPelanggaran.push($(this).data('poin')); // Menyimpan poin pelanggaran
    });

    $("#pageloader").fadeIn();
    setTimeout(function() {
        var datasend = new FormData();
        datasend.append('nis', $('#id_siswa').val());
        datasend.append('total_point', jumlah);
        datasend.append('id_laporan', $("#id_laporan").val());
        datasend.append('id_pelanggaran', JSON.stringify(pelanggaran)); // Kirim array id pelanggaran
        datasend.append('poin_pelanggaran', JSON.stringify(poinPelanggaran)); // Kirim array poin pelanggaran

        $.ajax({
            url: '<?= base_url() ?>Adminbk/LaporanController/PemberianPointLaporan',
            method: 'POST',
            contentType: false,
            processData: false,
            data: datasend,
            success: function(response) {
                $("#pageloader").hide();
                
                try {
                    let result = typeof response === 'string' ? JSON.parse(response) : response;
                    
                    if (result.status === 'success' && !result.apakahBimbingan) {
                        swal("Informasi", result.message, "success").then(() => location.reload());
                    } else if (result.status === 'success' && result.apakahBimbingan) {
                        swal("Informasi", result.message, "success").then(() => {
                            window.open(result.linkWaWali, "_blank");
                            location.reload();
                        });
                    } 
                    else {
                        swal("Informasi", result.message, "error");
                    }
                } catch (e) {
                    console.log("Parsing error:", e, "Response:", response);
                    swal("Informasi", "Respon tidak valid dari server", "error");
                }
            },
            error: function(xhr, status, error) {
                $("#pageloader").hide();
                console.log("Error Details:", xhr, status, error);
                swal("Informasi", "Gagal Terhubung Ke Server", "error");
            }
        });
    }, 1000);
}



$(document).on('click', '[data-toggle="modal"]', function() {
    $("#id_siswa").val($(this).data('nis'));
    $("#id_laporan").val($(this).data('laporan'));
});

function alertdel(id) {
    if (confirm("Yakin ingin membatalkan laporan yang dipilih?")) {
        BatalkanLaporan(id);
    }
}

function BatalkanLaporan(id) {
    $.ajax({
        type: "POST",
        url: '<?= base_url() ?>Adminbk/LaporanController/PembatalanLaporan',
        data: { id_laporan: id },
        success: function(data) {
            if (data == 'sukses') {
                swal("Informasi", "Laporan berhasil ditolak", "success").then(() => location.reload());
            } else {
                swal("Informasi", "Terjadi kesalahan mohon coba beberapa saat lagi", "error");
            }
        }
    });
}
</script>
