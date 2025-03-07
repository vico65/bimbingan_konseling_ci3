<!-- menu beranda -->
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="card">
        <div class="card-header card-header-tabs card-header-primary">
          <b><i class="fa fa-warning"></i> LAPORAN SISWA</b>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="tab-pane active" id="profile">
              <table class="table">
                <tbody>
                  <tr>
                    <th>No.</th>
                    <th>Tanggal Pelaporan</th>
                    <th>NIS</th>
                    <th>Nama siswa</th>
                    <th>Kelas</th>
                    <th>Deskripsi Pelanggaran</th>
                    <th>Status Pelaporan</th>
                  </tr>
                  <?php

                  ?>
                  <!-- query untuk menampilkan semua laporan pelanggaran siswa -->
                  <?php
                    $nomor = 1;
                    $getdataPelanggaran=$this->m_laporan->getLaporanPelanggaran($this->session->userdata('level_akses'));
                    foreach ($getdataPelanggaran->result_array() as $row) {                    
                  ?>
                  <tr>
                    <td><?= $nomor++ ?></td> <!-- Kolom nomor -->
                    <td><?=$row['create_date']?></td>
                    <td>
                        <?=$row['nis_siswa']?>
                    </td>
                    <td><?=$row['nama_siswa']?></td>
                    <td><?=$row['nama_kelas']?></td>
                    <td><?=$row['deskripsi_pelanggaran']?></td>
                    <td class="td-actions text-right">
                      
                      <?php
                        if ($row['status_validasi']=='Y') {
                          echo '<b> <i class="fa fa-check" style="color: #4caf50"></i> Disetujui</b>';
                        } else if ($row['status_validasi']=='N') {
                          echo '<b> <i class="fa fa-close" style="color: red"></i> Ditolak</b>';
                        } else if ($row['status_validasi']=='B') {
                          echo '<b> <i class="fa fa-clock-o" style="color: #2196f3"></i> Belum Divalidasi</b>';
                        }
                      ?>
                    </td>
                    <td>
                      
                    </td>
                  </tr>
                  <?php
                  }
                  ?>
                    <!-- end query untuk menampilkan semua laporan pelanggaran siswa -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- end beranda -->

          