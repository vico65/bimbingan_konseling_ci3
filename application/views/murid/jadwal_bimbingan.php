
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
        <button type="button" class="btn btn-primary" onclick="GettotalPointDipilih('<?=$banyakData?>')">Simpan</button>
      </div>
    </div>
  </div>
</div>






<div class="row">
 <div class="col-lg-12 col-md-12">
  <div class="card">
    <div class="card-header card-header-tabs card-header-primary">
        <b><i class="fa fa-warning"></i> DATA JADWAL BIMBINGAN</b>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane active" id="profile">
            <table class="table">
              <tbody>
                <tr>
                  <th>Jenis Bimbingan</th>
                  <th>Status bimbingan</th>
                </tr>
                <!-- query untuk menampilkan semua laporan pelanggaran siswa -->
                <?php
                  $id=$this->session->userdata('id');
                  foreach ($this->m_bimbingan->getDataBimbinganByIdSiswa($id,'HEADER')->result_array() as $row) {                    
                ?>
                <tr>                  
                  <td><?=$row['kode_bimbingan']?></td>
                  <td><?=$row['status_bimbingan']?></td>
                </tr>
                <?php
                }
                ?>
                  <!-- end query untuk menampilkan semua laporan pelanggaran siswa -->    
                <tr style="background-color: #9e37b4; color: #fff">
                  <td colspan="7" style="text-align: center; font-weight: bold;">Jadwal bimbingan</td>
                </tr>
                <tr>
                  <td style="font-weight: bold;">No.</td>
                  <td colspan="5" style="font-weight: bold;">Tanggal Bimbingan</td>
                  <td style="font-weight: bold;">Validasi bimbingan</td>
                </tr>
                <?php
                  $nomor = 1;
                  foreach ($this->m_bimbingan->getDataBimbinganByIdSiswa($id,'JADWAL')->result_array() as $row2) {
                ?>
                <tr>
                  <td><?= $nomor++ ?></td> <!-- Kolom nomor -->
                  <td colspan="5"><?=$row2['tanggal_bimbingan']?></td>
                  <td>
                    <?php
                      if ($row2['status_bimbingan']=='Aktif') {
                          echo '<i class="fa fa-check" style="color: green"></i>&nbsp; Hadir';
                      } else {
                      ?>
                        <i class="fa fa-clock-o" style="color: #ccc"></i>&nbsp; Belum divalidasi
                      <?php
                      }
                    ?>
                    
                  </td>
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


