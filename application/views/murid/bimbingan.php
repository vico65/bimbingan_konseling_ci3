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
        <b><i class="fa fa-warning"></i> DATA BIMBINGAN</b>
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
                  <th>Kode bimbingan</th>
                  <th>Tanggal bimbingan</th>
                  <th>poin siswa</th>
                </tr>
                <?php

                ?>
                <!-- query untuk menampilkan semua laporan pelanggaran siswa -->
                <?php
                $getDataBimbingan = $this->m_bimbingan->getDataBimbingan();
                foreach ($getDataBimbingan->result_array() as $row) {
                ?>
                  <tr>
                    <td><?= $row['nis_siswa'] ?></td>
                    <td><?= $row['nama_siswa'] ?></td>
                    <td><?= $row['kelas'] ?></td>
                    <td><?= $row['deskripsi_pelanggaran'] ?></td>
                    <td><?= $row['tanggal_bimbingan'] ?></td>
                    <td><?= $row['poin_pelanggaran'] ?></td>
                  </tr>
                <?php
                }
                ?>
                <!-- end query untuk menampilkan semua laporan pelanggaran siswa -->
                <tr>
                  <td colspan="6" style="text-align: center; font-weight: bold;">Keterangan bimbingan</td>
                </tr>
                <tr>
                  <td colspan="5" style="font-weight: bold;">jadwal</td>
                  <td style="font-weight: bold;">Status</td>
                </tr>
                <?php
                for ($i = 1; $i <= $row['remark']; $i++) {
                ?>
                  <tr>
                    <td colspan="5">Bimibingan hari ke <?= $i ?></td>
                    <td><i class="fa fa-check" style="color: green"></i></td>
                  </tr>
                <?php
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