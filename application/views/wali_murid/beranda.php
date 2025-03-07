 <!-- menu beranda -->
  <div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-header card-header-primary card-header-icon">
          <div class="card-icon">
            <i class="material-icons">P</i>
          </div>
          <p class="card-category">Total Point Pelanggaran Anak</p>
          <h3 class="card-title">
            <?php
              // Mengambil NIS anak dari wali_siswa
              $nis_siswa = $this->db->query("SELECT nis_siswa FROM wali_siswa WHERE id_wali = " . $this->session->userdata('id'))->row()->nis_siswa;

              // Ambil poin pelanggaran berdasarkan NIS anak
              $poinAnak = $this->db->query("SELECT poin_siswa FROM siswa WHERE nis_siswa = '$nis_siswa'")->row()->poin_siswa;
              echo $poinAnak ? $poinAnak : "0";
            ?>
          </h3>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="material-icons">date_range</i> Last 24 Hours
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
          <p class="card-category">Status Bimbingan Anak</p>
          <h3 class="card-title">
            <?php
              // Mengambil NIS anak dari wali_siswa
              $nis_siswa = $this->db->query("SELECT nis_siswa FROM wali_siswa WHERE id_wali = " . $this->session->userdata('id'))->row()->nis_siswa;

              // Cek status bimbingan berdasarkan NIS anak
              $dataBimbingan = $this->db->query("SELECT * FROM bimbingan WHERE nis_siswa = '$nis_siswa'");
              
              if ($dataBimbingan->num_rows() > 0) {
                echo $dataBimbingan->row()->kode_bimbingan;
              } else {
                echo "Tidak Ada";
              }
            ?>
          </h3>
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="material-icons">date_range</i> Last 24 Hours
          </div>
        </div>
      </div>
    </div>


    <div class="col-lg-12 col-md-12">
      <div class="card">
        <div class="card-header card-header-tabs card-header-primary">
          <b><i class="fa fa-warning"></i> LAPORAN PELANGGARAN SISWA</b>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="tab-pane active" id="profile">
              <table class="table">
                <tbody>
                  <tr>
                    <th>No.</th>
                    <th>NIS</th>
                    <th>Nama siswa</th>
                    <th>Kelas</th>
                    <th>Tanggal Pelaporan</th>
                    <th>Pelapor</th>
                    <th>Kode Pelanggran</th>
                    <th>Deskripsi Pelanggaran</th>
                    <th>Tanggal Konfirmasi</th>
                    <th>Poin Diterima</th>
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
                    <td>
                      <div class="form-check">
                        <?=$row['nis_siswa']?>
                      </div>
                    </td>
                    <td><?=$row['nama_siswa']?></td>
                    <td><?=$row['nama_kelas']?></td>
                    <td><?=$row['create_date']?></td>
                    <td><?=$row['nama_guru']?></td>
                    <td><?=$row['kode_pelanggaran']?></td>
                    <td><?=$row['deskripsi_pelanggaran']?></td>
                    <td><?=$row['tanggal_konfirmasi_pelanggaran']?></td>
                    <td><?=$row['poin_pelanggaran']?></td>
                    <td class="td-actions text-right">
                      
                      <?php
                        if ($row['status_validasi']=='Y') {
                          echo '<b> <i class="fa fa-check" style="color: #4caf50"></i> Disetujui</b>';
                        } else if ($row['status_validasi']=='N') {
                          echo '<b> <i class="fa fa-close" style="color: red"></i> Dibatalkan</b>';
                        } else if ($row['status_validasi']=='B') {
                          echo '<b> <i class="fa fa-clock-o" style="color: #2196f3"></i> Belum di validasi</b>';
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

          