<!-- Modal poin-->
<div class="modal fade bd-example-modal-lg" tabindex="-1" id="modal_poin" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Daftar Pelanggaran</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table ">
            <tbody>
              <tr>
                <td colspan="3"><input type="text" readonly="" id="nis_siswa" name="nis_siswa"></td>
                <td colspan="3"><input type="hidden" readonly="" id="id_laporan" name="id_laporan" value="0"></td>
              </tr>
              <tr>
                <th>Pilih</th>
                <th>Kode</th>
                <th>Jenis Pelanggaran</th>
                <th>Sanksi</th>
                <th><center>Poin</center></th>
              </tr> 
                <!-- query untuk menampilkan daftar pelanggaran -->                       
                <?php
                  $no=0;
                  $query=$this->m_pelanggaran->getDataPelanggaran();
                  $banyakData=$query->num_rows();
                  foreach ($query->result_array() as $rowPelanggaran) {
                  $no++;
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
                <td><?=$rowPelanggaran['kode_pelanggaran']?></td>
                <td><?=$rowPelanggaran['jenis_pelanggaran']?></td>
                <td><?=$rowPelanggaran['sanksi_pelanggaran']?></td>
                <td><center><?=$rowPelanggaran['poin_pelanggaran']?></center></td>
              </tr>
              <?php
                  }
                ?>
                <!-- end query untuk menampilkan daftar pelanggaran -->
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="GettotalPointDipilih('<?=$banyakData?>')">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal insert-->
<!-- Modal untuk tambah siswa -->
<div class="modal fade bd-example-modal-lg" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Tambah Data Siswa dan Wali Siswa</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('Adminbk/SiswaController/aksiTambahSiswa') ?>" method="POST">
        <div class="modal-body overflow-y-auto">
          <!-- Input data siswa -->
          <div class="form-group">
            <label for="nis">NIS</label>
            <input type="text" name="nis" id="nis" class="form-control"  required>
          </div>
          <div class="form-group">
            <label for="nama_siswa">Nama Siswa</label>
            <input type="text" name="nama_siswa" id="nama_siswa" class="form-control"  required>
          </div>
          <div >
            <div class="form-group bmd-form-group is-filled">
            <label for="jenis_kelamin">Kelas</label>
              <select class="form-control" id="kelas_insert" name="kelas" required>
                <option value="">--Kelas--</option>
                <?php
                // Memuat model m_kelas untuk mengambil data kelas
                $this->load->model('m_kelas');
                $kelas_data = $this->m_kelas->get_all_kelas();
                if (!empty($kelas_data)) {
                    foreach ($kelas_data as $row) {
                ?>
                      <option value="<?= $row['id_kelas'] ?>"><?= $row['nama_kelas'] ?></option>
                <?php
                    }
                } else {
                ?>
                    <option value="">Tidak ada kelas tersedia</option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
              <option value="">-- Jenis Kelamin --</option>
              <option value="laki-laki">Laki-laki</option>
              <option value="perempuan">Perempuan</option>
            </select>
          </div>
          <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="alamat_siswa">Alamat Siswa</label>
            <input type="text" name="alamat_siswa" id="alamat_siswa" class="form-control" required>
          </div>
          
          
          
          <div class="form-group">
            <label for="no_telephone_siswa">No. Telepon Siswa</label>
            <input type="text" name="no_telephone_siswa" id="no_telephone_siswa" class="form-control"  required>
          </div>

          <!-- Data tambahan -->
          <div class="form-group">
            <label for="status_pengasuh">Status Pengasuh</label>
            <select name="status_pengasuh" id="status_pengasuh" class="form-control" required>
              <option value="">-- Pilih Status Pengasuh --</option>
              <option value="Yatim">Yatim</option>
              <option value="Piatu">Piatu</option>
              <option value="Yatim Piatu">Yatim Piatu</option>
              <option value="Orang Tua Lengkap">Orang Tua Lengkap</option>
            </select>
          </div>

          <!-- Input data wali siswa -->
          <div class="form-group">
            <label for="nama_wali_siswa">Nama Wali Siswa</label>
            <input type="text" name="nama_wali_siswa" id="nama_wali_siswa" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="alamat_wali_siswa">Alamat Wali Siswa</label>
            <input type="text" name="alamat_wali_siswa" id="alamat_wali_siswa" class="form-control"  required>
          </div>
          <div class="form-group">
            <label for="pekerjaan_wali">Pekerjaan Wali Siswa</label>
            <input type="text" name="pekerjaan_wali" id="pekerjaan_wali" class="form-control"  required>
          </div>
          <div class="form-group">
            <label for="no_telp_wali">No Telepon Wali Siswa</label>
            <input type="text" name="no_telp_wali" id="no_telp_wali" class="form-control"  required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>



  
 <!-- modal update --> 
<div class="modal fade bd-example-modal-lg" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Ubah data siswa</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">        
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <input type="hidden" class="w3-input" id="nis_update">
            <label style="font-weight: bold;">Nama</label>
            <input type="text" class="w3-input" id="nama_update">
          </div>
        </div>       
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <label style="font-weight: bold;">Alamat</label>
            <input type="text" class="w3-input" id="alamat_update">
          </div>
        </div>          
        <div class="col-lg-12 col-md-12">
            <div class="form-group bmd-form-group is-filled">
                <label style="font-weight: bold;">Kelas</label>
                <select class="form-control" id="kelas_update" name="kelas" required>
                    <?php
                    // Memuat model m_kelas untuk mengambil data kelas
                    $this->load->model('m_kelas');
                    $kelas_data = $this->m_kelas->get_all_kelas();
                    if (!empty($kelas_data)) {
                        foreach ($kelas_data as $row) {
                    ?>
                            <option value="<?= $row['id_kelas'] ?>"><?= $row['nama_kelas'] ?></option>
                    <?php
                        }
                    } else {
                    ?>
                        <option value="">Tidak ada kelas tersedia</option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
      
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <label style="font-weight: bold;">Jenis kelamin</label>
            <select class="w3-input" id="jk_update">
               <option value="">--Jenis kelamin--</option>
              <?php
                foreach ($this->model_global->data_value('JENIS_KELAMIN')->result_array() as $rowUpdate2) {
              ?>
                <option value="<?=$rowUpdate2['jenis_value']?>"><?=$rowUpdate2['deskripsi']?></option>
              <?php
              }                
              ?>
            </select>
          </div>
        </div>
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <label style="font-weight: bold;">Tempat Lahir </label>
            <input type="text" name="" id="tempat_lahir_update" class="w3-input">
          </div>
        </div> 
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <label style="font-weight: bold;">Tgl lahir</label>
            <input type="date" name="" id="tgl_lahir_update" class="w3-input">
          </div>
        </div> 
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <label style="font-weight: bold;">no telepon</label>
            <input type="text" class="w3-input" id="tlp_update">
          </div>
        </div>   
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <label style="font-weight: bold;">Status Pengasuh</label>
            <input type="text" name="" id="status_pengasuh_update" class="w3-input">
          </div>
        </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="AksiUpdate()">Simpan</button>
      </div>
    </div>
  </div>
</div>


<div class="row" >

  <div class="col-lg-12 col-md-12">
    <div class="card">
      <div class="card-header card-header-tabs card-header-primary">
        <b><i class="material-icons">supervised_user_circle</i> DAFTAR SISWA</b>
        <?php if ($this->session->userdata('level_akses') == 'adminbk') : ?>
        <button class="btn btn-warning" style="float: right;" data-toggle="modal" data-target="#modal_tambah"><b>+ Tambah Data Siswa</b></button>
        <?php endif; ?>
          
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
                      <th>Nama Siswa</th>
                      <th>Kelas</th>
                      <th>Jenis Kelamin</th>
                      <th>Tempat Lahir</th>
                      <th>Tanggal Lahir</th>
                      <th>Alamat Siswa</th>
                      <th>No Telephone</th>
                      <th>Status Pengasuh</th>
                      <th>Jumlah Poin</th>
                      <?php if ($this->session->userdata('level_akses') == 'adminbk') : ?>
                      <th style="width: 300px;"><center>Aksi</center></th>
                      <?php endif; ?>

                  </tr>
                  <?php
                  // Query untuk menampilkan semua laporan pelanggaran siswa
                  $getdaftarSiswa = $this->m_siswa->getdaftarSiswa();
                  $nomor = 1; // Inisialisasi nomor urut
                  if ($getdaftarSiswa !== false) {
                      foreach ($getdaftarSiswa as $row) {                     
                  ?>
                      <tr>
                          <td><?= $nomor++ ?></td> <!-- Kolom nomor -->
                          <td><?= $row['nis_siswa'] ?></td>
                          <td><?= $row['nama_siswa'] ?></td>
                          <td><?= $row['nama_kelas'] ?></td>
                          <td><?= $row['jenis_kelamin'] ?></td>
                          <td><?= $row['tempat_lahir'] ?></td>
                          <td><?= $row['tanggal_lahir'] ?></td>
                          <td><?= $row['alamat_siswa'] ?></td>
                          <td><?= $row['no_telephone_siswa'] ?></td>
                          <td><?= $row['status_pengasuh'] ?></td>
                          <td><?= $row['poin_siswa'] ?></td>
                          <?php if ($this->session->userdata('level_akses') == 'adminbk') : ?>
                              <td>
                                <!-- ubah_ini -->
                                  <button type="button" rel="tooltip" title="Edit data" class="btn btn-primary" onclick="getdataUpdate('<?= $row['nis_siswa'] ?>')">
                                      <i class="fa fa-pencil"></i>
                                  </button>                    
                                  <button type="button" rel="tooltip" title="Hapus data" class="btn btn-danger" onclick="alertdel('<?= $row['nis_siswa'] ?>')">
                                      <i class="fa fa-trash"></i>
                                  </button>                    
                                  <button type="button" rel="tooltip" title="Tambah poin" class="btn btn-warning" onclick="parsingId('<?= $row['nis_siswa'] ?>')" data-toggle="modal" data-target="#modal_poin">
                                      <b>P+</b>
                                  </button>
                              </td>
                          <?php endif; ?>


                      </tr>
                  <?php
                      }
                  } else {
                      echo "<tr><td colspan='9'>Tidak ada data siswa ditemukan.</td></tr>";
                  }
                  ?>
                  <!-- End query untuk menampilkan semua laporan pelanggaran siswa -->                              
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
      $(document).ready(function(){
        // Tangani form submit
        $('form').submit(function(e){
          e.preventDefault(); // Mencegah form submit normal

          // Kirim data menggunakan AJAX
          $.ajax({
            url: '<?= base_url('Adminbk/SiswaController/aksiTambahSiswa') ?>', // Sesuaikan URL dengan path yang sesuai
            type: 'POST',
            data: $(this).serialize(), // Serialize form data
            dataType: 'json',
            success: function(response){
              try {
                    let result = typeof response === 'string' ? JSON.parse(response) : response;

                    if (result.status === 'success') {
                        // Tutup modal
                        $('#modal_tambah').modal('hide');

                        swal("Informasi", result.message, "success").then(() => location.reload());
                    } else {
                        swal("Informasi", result.message, "error");
                    }
              } catch (e) {
                  console.log("Parsing error:", e, "Response:", response);
                  swal("Informasi", "Respon tidak valid dari server", "error");
              }
            },
            error: function(){
              alert('Gagal mengirim data. Silakan coba lagi.');
            }
          });
        });
      });

      function GettotalPointDipilih(banyakData) {
        var jumlah = 0;
        var idPelanggaran = [];

        $('.pilihpelanggaran:checked').each(function() {
            jumlah += parseInt($(this).data('poin')); // Ambil poin dari checkbox
            idPelanggaran.push($(this).data('id_pelanggaran')); // Ambil id_pelanggaran dari checkbox
        });

        // Mengirim data melalui AJAX
        var datasend = new FormData();
        datasend.append('nis', $('#nis_siswa').val());
        datasend.append('total_point', jumlah);
        datasend.append('id_pelanggaran', idPelanggaran.join(',')); // Gabungkan id pelanggaran dengan koma
        datasend.append('id_laporan', $('#id_laporan').val());

        $.ajax({
            url: '<?=base_url()?>Adminbk/LaporanController/PemberianPointSiswa',
            method: 'POST',
            contentType: false,
            processData: false,
            data: datasend,
            success: function(response) {
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
                console.log("Error Details:", xhr, status, error);
                swal("Informasi", "Gagal Terhubung Ke Server", "error");
            }
        });
      }



    function parsingId(nis){
      $("#nis_siswa").val(nis);
    }


    function alertdel(nis){
        var r = confirm("Yakin ingin menghapus data yang dipilih?");
        if (r == true) {
          HapusAlert(nis);
        } else {
          return true;
        }
    }

    function HapusAlert(nis) {
        var hps = new FormData();
        hps.append('nis_siswa',nis);
        $.ajax({
            url   :'<?=base_url()?>Adminbk/SiswaController/HapusSiswa',
            method:'POST',
            contentType: false,      
                processData:false, 
            data  :hps,
            success: function(response) {
              try {
                    let result = typeof response === 'string' ? JSON.parse(response) : response;

                    if (result.status === 'success') {
                        swal("Informasi", result.message, "success").then(() => location.reload());
                    } else {
                        swal("Informasi", result.message, "error");
                    }
                } catch (e) {
                    console.log("Parsing error:", e, "Response:", response);
                    swal("Informasi", "Respon tidak valid dari server", "error");
                }
            },
            error: function(xhr, status, error) {
                console.log("Error Details:", xhr, status, error);
                swal("Informasi", "Gagal Terhubung Ke Server", "error");
            }
        });
    }

    function getdataUpdate(nis) {
        var hps = new FormData();
        hps.append('nis',nis);
        $.ajax({
            url   :'<?=base_url()?>Adminbk/SiswaController/GetDatasiswa',
            method:'POST',
            contentType: false,      
            processData:false, 
            data  :hps,
            dataType:'json',
            cache:true,
            success: function(data) {
              console.log(data.jk);
              $('#modal_update').modal('show');

              $('#nis_update').val(data.nis);
              $('#nama_update').val(data.nama);
              $('#alamat_update').val(data.alamat);
              $('#jk_update').val(data.jk);
              $('#kelas_update').val(data.id_kelas);
              $('#tempat_lahir_update').val(data.tempat_lahir);
              $('#tgl_lahir_update').val(data.tgl_lahir);
              $('#tlp_update').val(data.hp);
              $('#status_pengasuh_update').val(data.status_pengasuh);
            },error: function(data){
               console.log(data);
            }
        });
    }

    function AksiUpdate(){
        $('#pageloader').fadeIn();
        setTimeout(function() {
        var datasend = new FormData();
        datasend.append('nis', $("#nis_update").val()); // This is the hidden nis_siswa
        datasend.append('nama', $('#nama_update').val());
        datasend.append('alamat', $('#alamat_update').val());
        datasend.append('jk', $('#jk_update').val());
        datasend.append('kelas', $('#kelas_update').val());
        datasend.append('tempat_lahir', $('#tempat_lahir_update').val());
        datasend.append('tgl_lahir', $('#tgl_lahir_update').val());
        datasend.append('tlp', $('#tlp_update').val());
        datasend.append('status_pengasuh', $('#status_pengasuh_update').val());

          $.ajax({
              url: '<?=base_url()?>Adminbk/SiswaController/aksiUpdateSiswa',
              method: 'POST',
              contentType: false,
              processData: false,
              data: datasend,
              success: function(data) {
                console.log(data);
                $("#pageloader").hide();
                if (data=='sukses') {
                  swal("Informasi","Data berhasil diubah" ,"success")
                  .then((value) => {
                    location.reload();
                  }); 
                } else {
                  swal("Informasi","Terjadi kesalahan mohon coba beberapa saat lagi" ,"error");
                }       
              },
              error: function(data) {
                console.log(data);
                $("#pageloader").hide();               
                  swal("Informasi","Gagal Terhubung Ke Server" ,"error");
              }
          });
        }, 1000);
    }

</script>


