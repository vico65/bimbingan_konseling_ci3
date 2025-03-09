<!-- Modal insert-->
<div class="modal fade bd-example-modal-lg" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Tambah Data Guru</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <label class="bmd-label-floating">NIP / NUPTK</label>
            <input type="text" class="form-control" id="nip_insert">
          </div>
        </div>
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <label class="bmd-label-floating">Nama</label>
            <input type="text" class="form-control" id="nama_insert">
          </div>
        </div>
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <select class="form-control" id="jk_insert">
              <option value="">--Jenis kelamin--</option>
              <?php
              foreach ($this->model_global->data_value('JENIS_KELAMIN')->result_array() as $row) {
              ?>
                <option value="<?= $row['jenis_value'] ?>" ><?= $row['deskripsi'] ?> </option>
              <?php
              }
              ?>
            </select>
          </div>
        </div>
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <label class="bmd-label-floating">Alamat</label>
            <input type="text" class="form-control" id="alamat_insert">
          </div>
        </div>
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <select class="form-control" id="jabatan_insert">
              <option value="">-- Pilih Jabatan --</option>
              <option value="Guru BK">Guru BK</option>
              <option value="Guru" selected>Guru</option>
              <option value="Wakil Kepala Sekolah">Wakil Kepala Sekolah</option>
              <option value="Kepala Sekolah">Kepala Sekolah</option>
            </select>
          </div>
        </div>
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <label class="bmd-label-floating">No. Handphone</label>
            <input type="text" class="form-control" id="nohp_insert">
          </div>
        </div>
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <label class="bmd-label-floating">Username</label>
            <input type="text" class="form-control" id="username_insert">
          </div>
        </div>
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <label class="bmd-label-floating">Password</label>
            <input type="Password" class="form-control" id="password_insert">
          </div>
        </div>
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <select class="form-control" id="level_insert">
              <option value="">-- Pilih Level Akses --</option>
              <option value="adminbk">Guru BK</option>
              <option value="guru" selected>Guru</option>
              <option value="kepsek">Wakil Kepala Sekolah</option>
              <option value="Kepsek">Kepala Sekolah</option>
            </select>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="insertDataGuru()">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- modal update -->
<div class="modal fade bd-example-modal-lg" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Ubah data guru</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" value="" readonly="" id="nip_update" name="">
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group">
            <label style="font-weight: bold;">Nama</label>
            <input type="text" class="w3-input" id="nama_update">
          </div>
        </div>
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group">
            <label style="font-weight: bold;">Jenis kelamin</label>
            <select class="w3-input" id="jk_update">
              <option value="">--Jenis kelamin--</option>
              <?php
              foreach ($this->model_global->data_value('JENIS_KELAMIN')->result_array() as $row2) {
              ?>
                <option value="<?= $row2['jenis_value'] ?>"><?= $row2['deskripsi'] ?></option>
              <?php
              }
              ?>
            </select>
          </div>
        </div>
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group">
            <label style="font-weight: bold;">Alamat</label>
            <input type="text" class="w3-input" id="alamat_update">
          </div>
        </div>

        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group">
            <label style="font-weight: bold;">Jabatan</label>
            <select class="w3-input" id="jabatan_update">
              <option value="">--Jabatan--</option>
              <?php
              foreach ($this->model_global->data_value('JABATAN')->result_array() as $row3) {
              ?>
                <option value="<?= $row3['deskripsi'] ?>"><?= $row3['deskripsi'] ?></option>
              <?php
              }
              ?>
            </select>
          </div>
        </div>
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group">
            <label style="font-weight: bold;">No hp</label>
            <input type="text" class="w3-input" id="nohp_update">
          </div>
        </div>
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group">
            <label style="font-weight: bold;">Username</label>
            <input type="text" class="w3-input" id="username_update">
          </div>
        </div>
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group">
            <label style="font-weight: bold;">Password</label>
            <input type="Password" class="w3-input" id="password_update">
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

<!-- debugging -->
<div class="row position-relative">

  <div class="col-lg-12 col-md-12">
    <div class="card">
      <div class="card-header card-header-tabs card-header-primary">
        <b><i class="material-icons">supervised_user_circle</i> DAFTAR GURU</b>
        <?php if ($this->session->userdata('level_akses') == 'adminbk') : ?>
          <button class="btn btn-warning" data-toggle="modal" data-target="#modal_tambah" style="float: right;"><b>+ Tambah Data Guru</b></button>
        <?php endif; ?>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane active" id="profile">
            <table class="table">
              <tbody>
                <tr>
                  <th>No.</th>
                  <th>NIP / NUPTK</th>
                  <th>Nama Guru</th>
                  <th>Jenis Kelamin</th>
                  <th>Alamat </th>
                  <th>Jabatan</th>
                  <th>No Telephone</th>
                  <?php if ($this->session->userdata('level_akses') == 'adminbk') : ?>
                    <th style="width: 180px">
                      <center>Aksi</center>
                    </th>
                  <?php endif; ?>
                </tr>
                <?php

                ?>
                <!-- query untuk menampilkan semua laporan pelanggaran siswa -->
                <?php
                $gedDataGuru = $this->m_guru->gedDataGuru();
                $nomor = 1;
                foreach ($gedDataGuru->result_array() as $row) {
                ?>
                  <td><?= $nomor++ ?></td> <!-- Kolom nomor -->
                  <td><?= $row['nip_nuptk'] ?></td>
                  <td><?= $row['nama_guru'] ?></td>
                  <td><?= $row['jenis_kelamin'] ?></td>
                  <td><?= $row['alamat_guru'] ?></td>
                  <td><?= $row['jabatan'] ?></td>
                  <td><?= $row['no_telephone_guru'] ?></td>
                  <?php if ($this->session->userdata('level_akses') == 'adminbk') : ?>
                    <td>
                      <button type="button" rel="tooltip" title="Edit data" class="btn btn-primary" onclick="getdataUpdate('<?= $row['nip_nuptk'] ?>')">
                        <i class="fa fa-pencil"></i>
                      </button>
                      <button type="button" rel="tooltip" title="Hapus data" onclick="alertdel('<?= $row['nip_nuptk'] ?>')" class="btn btn-danger">
                        <i class="fa fa-trash"></i>
                      </button>
                    </td>
                  <?php endif; ?>
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

  <!-- <div class="fixed-bottom bg-warning border-3 p-3 border-dark z-3">
    <button id="tambahGuruNipSama" type="button" class="btn btn-success">Tambah Guru Nip Sama</button>
    <button id="tambahGuruNipBeda" type="button" class="btn btn-danger">Tambah Guru Nip Beda</button>
  </div>
</div> -->

<!-- <script type="module">
  import {
    fakerID_ID
  } from 'https://esm.sh/@faker-js/faker';

  $('#tambahGuruNipSama').click(async function() {
    const randomNip = 2025100;
    const randomNama = fakerID_ID.person.fullName();
    const randomAlamat = fakerID_ID.location.streetAddress();
    const randomNomorTelpon = Math.floor(Math.random() * 1000000000000);

    $('#nip_insert').val(randomNip)
    $('#nama_insert').val(randomNama)
    $('#alamat_insert').val(randomAlamat)
    $('#nohp_insert').val(randomNomorTelpon)
    $('#username_insert').val(randomNip)
    $('#password_insert').val(randomNip)
  })

  $('#tambahGuruNipBeda').click(function() {
    const randomNip = Math.floor(Math.random() * 1000000);
    const randomNama = fakerID_ID.person.fullName();
    const randomAlamat = fakerID_ID.location.streetAddress();
    const randomNomorTelpon = Math.floor(Math.random() * 1000000000000);

    $('#nip_insert').val(randomNip)
    $('#nama_insert').val(randomNama)
    $('#alamat_insert').val(randomAlamat)
    $('#nohp_insert').val(randomNomorTelpon)
    $('#username_insert').val(randomNip)
    $('#password_insert').val(randomNip)
  })
</script> -->

<script type="text/javascript">
  function insertDataGuru() {

    if ($('#nama_insert').val() == '') {
      swal("Informasi", "Masukkan nama guru", "error");
    } else if ($('#alamat_insert').val() == '') {
      swal("Informasi", "Masukkan alamat guru", "error");
    } else if ($('#jk_insert').val() == '') {
      swal("Informasi", "Pilih salah satu jenis kelamin", "error");
    } else if ($('#nohp_insert').val() == '') {
      swal("Informasi", "Masukkan nomor handphone", "error");
    } else if ($('#username_insert').val() == '') {
      swal("Informasi", "Masukkan username", "error");
    } else if ($('#password_insert').val() == '') {
      swal("Informasi", "Masukkan password", "error");
    } else {
      $('#pageloader').fadeIn();
      setTimeout(function() {
        var datasend = new FormData();
        datasend.append('nip_nuptk', $('#nip_insert').val());
        datasend.append('nama', $('#nama_insert').val());
        datasend.append('alamat', $('#alamat_insert').val());
        datasend.append('jk', $('#jk_insert').val());
        datasend.append('jabatan', $('#jabatan_insert').val());
        datasend.append('notlp', $('#nohp_insert').val());
        datasend.append('username', $('#username_insert').val());
        datasend.append('pass', $('#password_insert').val());
        datasend.append('level', $('#level_insert').val());
        $.ajax({
          url: '<?= base_url() ?>Adminbk/GuruController/aksiTambahGuru',
          method: 'POST',
          contentType: false,
          processData: false,
          data: datasend,
          success: function(response) {
            $("#pageloader").hide();
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
          error: function(data) {
            console.log(data);
            $("#pageloader").hide();
            swal("Informasi", "Gagal Terhubung Ke Server", "error");
          }
        });
      }, 200);
    }
  }

  function alertdel(id) {
    var r = confirm("Yakin ingin menghapus data yang dipilih?");
    if (r == true) {
      HapusAlert(id);
    } else {
      return true;
    }
  }

  function HapusAlert(nip_nuptk) {
    var hps = new FormData();
    hps.append('nip_nuptk', nip_nuptk);
    $.ajax({
      url: '<?= base_url() ?>Adminbk/GuruController/hapusGuru',
      method: 'POST',
      contentType: false,
      processData: false,
      data: hps,
      success: function(data) {
        console.log(data)
        location.reload();
      },
      error: function(data) {
        console.log(data);
      }
    });
  }

  function getdataUpdate(nip_nuptk) {
    var hps = new FormData();
    hps.append('nip_nuptk', nip_nuptk);
    $.ajax({
      url: '<?= base_url() ?>Adminbk/GuruController/getDataUpdate',
      method: 'POST',
      contentType: false,
      processData: false,
      data: hps,
      dataType: 'json',
      cache: true,
      success: function(data) {
        console.log(data);
        $('#modal_update').modal('show');
        $('#nip_update').val(data.nip);
        $('#nama_update').val(data.nama);
        $('#alamat_update').val(data.alamat_guru);
        $('#jk_update').val(data.jk);
        $('#jabatan_update').val(data.jabatan);
        $('#nohp_update').val(data.hp);
        $('#username_update').val(data.username);
        $('#password_update').val(data.password);
      },
      error: function(data) {
        console.log("error");
      }
    });
  }

  function AksiUpdate() {
    $('#pageloader').fadeIn();
    setTimeout(function() {
      var datasend = new FormData();
      datasend.append('nip_nuptk', $('#nip_update').val());
      datasend.append('jabatan', $('#jabatan_update').val());
      datasend.append('nama', $('#nama_update').val());
      datasend.append('alamat', $('#alamat_update').val());
      datasend.append('jk', $('#jk_update').val());
      datasend.append('notlp', $('#nohp_update').val());
      datasend.append('username', $('#username_update').val());
      datasend.append('pass', $('#password_update').val());
      $.ajax({
        url: '<?= base_url() ?>Adminbk/GuruController/aksiUpdateGuru',
        method: 'POST',
        contentType: false,
        processData: false,
        data: datasend,
        success: function(data) {
          console.log(data);
          $("#pageloader").hide();
          if (data == 'sukses') {
            swal("Informasi", "Data berhasil diubah", "success")
              .then((value) => {
                location.reload();
              });
          } else {
            swal("Informasi", "Terjadi kesalahan mohon coba beberapa saat lagi", "error");
          }
        },
        error: function(data) {
          console.log(data);
          $("#pageloader").hide();
          swal("Informasi", "Gagal Terhubung Ke Server", "error");
        }
      });
    }, 1000);
  }
</script>