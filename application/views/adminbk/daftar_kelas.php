<!-- Modal untuk Menampilkan Siswa -->
<div class="modal fade" id="modal_students" tabindex="-1" role="dialog" aria-labelledby="modalStudentsLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="max-width: 90%; width: auto;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalStudentsLabel">Siswa di Kelas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
          <thead>
            <tr>
              <th>NIS</th>
              <th>Nama Siswa</th>
              <!-- <th>Kelas</th> -->
              <th>Alamat</th>
              <th>Jenis Kelamin</th>
              <th>Tgl Lahir</th>
              <th>No Hp</th>
              <th>POIN</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="students_list">
            <!-- Daftar siswa akan ditambahkan di sini -->
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- tambah poin -->
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
                <td colspan="3"><input type="text" readonly="" id="nis_siswa" name=""></td>
                <td colspan="3"><input type="text" readonly="" id="id_laporan" name=""></td>
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="GettotalPointDipilih('<?=$banyakData?>')">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- update siswa -->
<div class="modal fade bd-example-modal-lg" id="modal_updatesiswa" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Ubah Data Siswa</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="nis" readonly="">

        <div class="form-group">
          <label for="nama_update" style="font-weight: bold;">Nama</label>
          <input type="text" class="form-control" id="nama_update" required>
        </div>

        <div class="form-group">
          <label for="alamat_update" style="font-weight: bold;">Alamat</label>
          <input type="text" class="form-control" id="alamat_update" required>
        </div>

        <div class="form-group">
          <label for="jk_update" style="font-weight: bold;">Jenis Kelamin</label>
          <select class="form-control" id="jk_update" required>
            <option value="">--Jenis Kelamin--</option>
            <?php foreach ($this->model_global->data_value('JENIS_KELAMIN')->result_array() as $rowUpdate2): ?>
              <option value="<?= $rowUpdate2['jenis_value'] ?>"><?= $rowUpdate2['deskripsi'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <label for="tgl_lahir_update" style="font-weight: bold;">Tanggal Lahir</label>
          <input type="date" id="tgl_lahir_update" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="tlp_update" style="font-weight: bold;">No Telepon</label>
          <input type="text" class="form-control" id="tlp_update" required>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="AksiUpdate()">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modal_insert" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Tambah Kelas</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">       
          <div class="col-lg-12 col-md-12">
            <div class="form-group bmd-form-group is-filled">
              <label class="bmd-label-floating">Nama Kelas</label>
              <input type="text" class="form-control" id="nama_kelas">
            </div>
          </div>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="tambahKelas()">Simpan</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal update -->
<div class="modal fade bd-example-modal-lg" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Edit Kelas</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <input type="hidden" readonly="" id="id_kelas" name="">         
          <div class="col-lg-12 col-md-12">
            <div class="form-group bmd-form-group">
              <label style="font-weight: bold;">Nama Kelas</label>
              <input type="text" class="w3-input" id="kelas_update">
            </div>
          </div>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="AksiUpdateKelas()">Simpan</button>
      </div>
    </div>
  </div>
</div>

<div class="row">

  <div class="col-lg-12 col-md-12">
    <div class="card">
      <div class="card-header card-header-tabs card-header-primary">
        <b><i class="material-icons">supervised_user_circle</i> DAFTAR KELAS</b>
        <?php if ($this->session->userdata('level_akses') == 'adminbk') : ?>
        <button class="btn btn-warning" style="float: right;"  data-toggle="modal" data-target="#modal_insert"><b>+ Tambah Kelas</b></button>
        <?php endif; ?>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane active" id="profile">
            <table class="table">
              <tbody>
                <tr>
                  <th>Nama Kelas</th>
                  <?php if ($this->session->userdata('level_akses') == 'adminbk') : ?>
                  <th style="width: 350px"><center>Aksi</center></th>
                  <?php endif; ?>
                </tr>
                <?php
                ?>
                <!-- query untuk menampilkan semua Kelas siswa -->
                <?php
                  $getDaftarKelas=$this->m_kelas->getDaftarkelas();
                  foreach ($getDaftarKelas->result_array() as $row) {                     
                ?>
                <tr>
                  <td><?=$row['nama_kelas']?></td>
                  <?php if ($this->session->userdata('level_akses') == 'adminbk') : ?>
                  <td>
                    <button type="button" rel="tooltip" title="Edit data" class="btn btn-primary" onclick="getdataUpdate('<?=$row['id_kelas']?>')">
                      <i class="fa fa-pencil"></i>            
                    </button>                    
                    <button type="button" rel="tooltip" title="Hapus data" onclick="alertdel('<?=$row['id_kelas']?>')" class="btn btn-danger">
                      <i class="fa fa-trash"></i>            
                    </button>
                    <button type="button" class="btn btn-info" onclick="showStudents('<?=$row['id_kelas']?>')">
                        Lihat Siswa
                    </button>
                  </td>
                  <?php endif; ?>
                </tr>
                <?php
                }
                ?>
                  <!-- end query untuk menampilkan semua kelas siswa -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">



function showStudents(id_kelas) {
    $.ajax({
        url: '<?=base_url()?>Adminbk/KelasController/getStudentsByKelas',
        method: 'POST',
        data: { id_kelas: id_kelas }, // Menggunakan id_kelas untuk mendapatkan data siswa
        dataType: 'json',
        success: function(data) {
            let studentsHtml = '';
            data.forEach(function(student) {
                studentsHtml += `<tr>
                    <td>${student.nis_siswa}</td>
                    <td>${student.nama_siswa}</td>
                    <td>${student.alamat_siswa}</td>
                    <td>${student.jenis_kelamin}</td>
                    <td>${student.tanggal_lahir}</td>
                    <td>${student.no_telephone_siswa}</td>
                    <td>${student.poin_siswa}</td>
                    <td>
                       <button type="button" rel="tooltip" title="Edit data" class="btn btn-primary" onclick="getdataUpdateSiswa('${student.nis_siswa}')">
                            <i class="fa fa-pencil"></i>
                        </button>                    
                        <button type="button" rel="tooltip" title="Hapus data" class="btn btn-danger" onclick="alertdelsiswa('${student.nis_siswa}')">
                            <i class="fa fa-trash"></i>
                        </button>                    
                        <button type="button" rel="tooltip" title="Tambah poin" class="btn btn-warning" onclick="parsingId('${student.nis_siswa}')" data-toggle="modal" data-target="#modal_poin">
                            <b>P+</b>
                        </button>
                    </td>
                </tr>`;
            });
            $('#students_list').html(studentsHtml);
            $('#modal_students').modal('show'); // Menampilkan modal
        },
        error: function() {
            alert('Gagal mengambil data siswa.');
        }
    });
}

function tambahKelas(){
  $("#pageloader").fadeIn();
   setTimeout(function() {
  var datasend = new FormData();
  datasend.append('kelas',$('#nama_kelas').val());
    $.ajax({
        url: '<?=base_url()?>Adminbk/KelasController/aksiTambahKelas',
        method: 'POST',
        contentType: false,
        processData: false,
        data: datasend,
        success: function(data) {
          console.log(data);
          $("#pageloader").hide();
          if (data=='sukses') {
            swal("Informasi","Data kelas berhasil ditambahkan" ,"success")
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

function alertdel(id){
  var r = confirm("Yakin ingin menghapus data yang dipilih?");
  if (r == true) {
    HapusAlert(id);
  } else {
    return true;
  }
}

function HapusAlert(id) {
    var hps = new FormData();
    hps.append('id_kelas',id);
    $.ajax({
        url   :'<?=base_url()?>Adminbk/KelasController/HapusKelas',
        method:'POST',
        contentType: false,      
        processData:false, 
        data  :hps,
        success: function(data) {
          console.log(data);
            location.reload();
        },error: function(data){
           console.log(data);
        }
    });
}

function getdataUpdate(id) {
    var hps = new FormData();
    hps.append('id_kelas',id);
    $.ajax({
        url   :'<?=base_url()?>Adminbk/KelasController/GetDataKelas',
        method:'POST',
        contentType: false,      
        processData:false, 
        data  :hps,
        dataType:'json',
        cache:true,
        success: function(data) {
          console.log(data);
          $('#modal_update').modal('show');

          console.log(data);
          $('#kelas_update').val(data.nama_kelas);
          $('#id_kelas').val(data.id_kelas);
        },error: function(data){
           console.log(data);
        }
    });
}

function AksiUpdateKelas(){
    $('#pageloader').fadeIn();
    setTimeout(function() {
    var datasend = new FormData();
    datasend.append('id_kelas',$('#id_kelas').val());
    datasend.append('nama_kelas',$('#kelas_update').val());
      $.ajax({
          url: '<?=base_url()?>Adminbk/KelasController/aksiUpdateKelas',
          method: 'POST',
          contentType: false,
          processData: false,
          data: datasend,
          success: function(data) {
            console.log(data);
            $("#pageloader").hide();
            if (data=='sukses') {
              swal("Informasi","Data kelas berhasil diubah" ,"success")
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

function parsingId(nis) {
    $("#nis_siswa").val(nis);
}

function getdataUpdateSiswa(nis) {
    var hps = new FormData();
    hps.append('nis', nis);

    $.ajax({
        url: '<?=base_url()?>Adminbk/SiswaController/GetDatasiswa',
        method: 'POST',
        contentType: false,
        processData: false,
        data: hps,
        dataType: 'json',
        cache: true,
        success: function(data) {
            if (data) {
                // Tampilkan modal dan isi data
                $('#modal_updatesiswa').modal('show');
                $('#nis').val(data.nis);
                $('#nama_update').val(data.nama);
                $('#alamat_update').val(data.alamat);
                $('#jk_update').val(data.jk);
                $('#kelas_update').val(data.id_kelas);
                $('#tgl_lahir_update').val(data.tgl_lahir);
                $('#tlp_update').val(data.hp);
            } else {
                swal("Informasi", "Data kelas tidak ditemukan", "warning");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Error fetching data: ", textStatus, errorThrown);
            swal("Informasi", "Gagal Terhubung Ke Server", "error");
        }
    });
}

function AksiUpdate() {
    $('#pageloader').fadeIn();

    // Siapkan data untuk dikirim
    var datasend = new FormData();
    datasend.append('nis', $("#nis").val());
    datasend.append('nama', $('#nama_update').val());
    datasend.append('alamat', $('#alamat_update').val());
    datasend.append('jk', $('#jk_update').val());
    datasend.append('kelas', $('#kelas_update').val());
    datasend.append('tgl_lahir', $('#tgl_lahir_update').val());
    datasend.append('tlp', $('#tlp_update').val());

    $.ajax({
        url: '<?=base_url()?>Adminbk/SiswaController/aksiUpdateSiswa',
        method: 'POST',
        contentType: false,
        processData: false,
        data: datasend,
        success: function(data) {
            $("#pageloader").hide();
            if (data === 'sukses') {
                swal("Informasi", "Data kelas berhasil diubah", "success")
                    .then((value) => {
                        location.reload();
                    });
            } else {
                swal("Informasi", "Terjadi kesalahan, mohon coba beberapa saat lagi", "error");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $("#pageloader").hide();
            console.error("Error updating data: ", textStatus, errorThrown);
            swal("Informasi", "Gagal Terhubung Ke Server", "error");
        }
    });
}


function alertdelsiswa(nis) {
    var r = confirm("Yakin ingin menghapus data yang dipilih?");
    if (r == true) {
        HapusAlertSiswa(nis);
    } else {
        return false;
    }
}


function HapusAlertSiswa(nis) {
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
            },error: function(data){
               console.log(data);
            }
        });
    }
   



</script>


