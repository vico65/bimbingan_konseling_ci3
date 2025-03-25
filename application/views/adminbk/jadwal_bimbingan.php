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
        asas
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="GettotalPointDipilih('<?= $banyakData ?>')">Simpan</button>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="card">
      <div class="card-header card-header-tabs card-header-primary">
        <b><i class="fa fa-warning"></i> JADWAL SISWA BIMBINGAN</b>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane active" id="profile">
            <table class="table">
              <tbody>
                <tr>
                  <th>NIS</th>
                  <th>Nama siswa</th>
                  <th>Kelas</th>
                  <th>Status Bimbingan</th>
                  <th>Jenis Bimbingan</th>
                  <th>Jumlah Poin Diterima</th>
                </tr>
                <!-- query untuk menampilkan semua laporan pelanggaran siswa -->
                <?php
                $id_bimbingan = $this->uri->segment(2);
                foreach ($this->m_bimbingan->getDataBimbinganByParam($id_bimbingan)->result_array() as $row) {
                ?>
                  <tr>
                    <td><?= $row['nis_siswa'] ?></td>
                    <td><?= $row['nama_siswa'] ?></td>
                    <td><?= $row['nama_kelas'] ?></td>
                    <td><?= $row['status_bimbingan'] ?></td>
                    <td><?= $row['deskripsi'] ?></td>
                    <td><?= $row['poin_siswa'] ?></td>
                  </tr>
                <?php
                }
                ?>
                <!-- end query untuk menampilkan semua laporan pelanggaran siswa -->
                <tr style="background-color: #9e37b4; color: #fff">
                  <td colspan="6" style="text-align: center; font-weight: bold;">Jadwal Siswa bimbingan</td>
                </tr>
                <tr>
                  <td style="font-weight: bold;">NO</td>
                  <td colspan="4" style="font-weight: bold;">Tanggal Bimbingan</td>
                  <td style="font-weight: bold;">Status Bimbingan</td>
                </tr>
                <?php
                $nomor = 1;
                foreach ($this->m_bimbingan->getJadwalBimbingan($id_bimbingan)->result_array() as $row2) {
                ?>
                  <tr>
                    <td><?= $nomor++ ?></td> <!-- Kolom nomor -->
                    <td colspan="4">
                      <?= date("d-m-Y", strtotime($row2['tanggal_bimbingan'])); ?>
                    </td>
                    <td>
                      <?php
                      if ($row2['status_bimbingan'] == 'Aktif') {
                        echo '<i class="fa fa-check" style="color: green"></i>&nbsp; Tervalidasi';
                      } else {
                      ?>
                        <button class="btn btn-primary" onclick="validasiKehadiran('<?= $row2['id_jadwal_bimbingan'] ?>')" data-id="<?= $row2['id_jadwal_bimbingan'] ?>">Hadir</button>
                      <?php
                      }
                      ?>

                    </td>
                  </tr>
                <?php
                }
                ?>
                <!-- <tr>
                  <?php

                  ?>
                  <td colspan="8"><center><button class="btn btn-success" onclick="" style="">SELESAI</button></center></td>
                </tr>                               -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function validasiKehadiran(id) {
    $("#pageloader").fadeIn();
    var datasend = new FormData();
    datasend.append('id_jadwal', id);
    $.ajax({
      url: '<?= base_url() ?>Adminbk/BimbinganController/validasiBimbingan',
      method: 'POST',
      contentType: false,
      processData: false,
      data: datasend,
      success: function(data) {
        console.log(data);
        if (data == 'sukses') {
          $("#pageloader").hide();
          swal("Informasi", "Validasi Berhasil ", "success")
            .then((value) => {
              location.reload();
            });
        } else {
          $("#pageloader").hide();
          swal("Informasi", "gagal memvallidasi ", "error");
        }
      },
      error: function(data) {
        console.log(data);
        $("#pageloader").hide();
        swal("Informasi", "Gagal Terhubung Ke Server", "error");
      }
    });
  }
</script>