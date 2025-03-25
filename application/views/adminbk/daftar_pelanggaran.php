<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modal_insert" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Tambah Pelanggaran</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <label class="bmd-label-floating">Kode pelanggaran</label>
            <input type="text" class="form-control" id="kode_insert">
          </div>
        </div>
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <label class="bmd-label-floating">Jenis pelanggaran</label>
            <input type="text" class="form-control" id="jenis_insert">
          </div>
        </div>
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <label class="bmd-label-floating">Poin pelanggaran</label>
            <input type="text" class="form-control" id="poin_insert">
          </div>
        </div>
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <label class="bmd-label-floating">Sanksi pelanggaran</label>
            <input type="text" class="form-control" id="sanksi_insert">
          </div>
        </div>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" onclick="tambahPelanggaran()">Simpan</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal update -->
<div class="modal fade bd-example-modal-lg" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Ubah Data Pelanggaran</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" readonly="" id="id_pelanggaran" name="">
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <label style="font-weight: bold;">kode pelanggaran</label>
            <input type="text" class="w3-input" id="kode_update">
          </div>
        </div>
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <label style="font-weight: bold;">Jenis pelanggaran</label>
            <input type="text" class="w3-input" id="jenis_update">
          </div>
        </div>
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <label style="font-weight: bold;">Poin pelanggaran</label>
            <input type="text" class="w3-input" id="poin_update">
          </div>
        </div>
        <div class="col-lg-12 col-md-12">
          <div class="form-group bmd-form-group is-filled">
            <label style="font-weight: bold;">Sanksi pelanggaran</label>
            <input type="text" class="w3-input" id="sanksi_update">
          </div>
        </div>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="AksiUpdate()">Simpan</button>
      </div>
    </div>
  </div>
</div>






<div class="row">

  <div class="col-lg-12 col-md-12">
    <div class="card">
      <div class="card-header card-header-tabs card-header-primary">
        <b><i class="material-icons">supervised_user_circle</i> DAFTAR PELANGGARAN</b>
        <?php if ($this->session->userdata('level_akses') == 'adminbk') : ?>
          <button class="btn btn-warning" style="float: right;" data-toggle="modal" data-target="#modal_insert"><b>+ Tambah Daftar Pelanggaran</b></button>
        <?php endif; ?>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane active" id="profile">
            <table class="table">
              <tbody>
                <tr>
                  <th>No.</th>
                  <th>Kode Pelanggaran </th>
                  <th>Jenis Pelanggaran </th>
                  <th>Poin Pelanggaran </th>
                  <th>Sanksi Pelanggaran</th>
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
                $nomor = 1;
                $getDaftarPelanggaran = $this->m_pelanggaran->getDaftarPelanggaran();
                foreach ($getDaftarPelanggaran->result_array() as $row) {
                ?>
                  <tr>
                    <td><?= $nomor++ ?></td> <!-- Kolom nomor -->
                    <td><?= $row['kode_pelanggaran'] ?></td>
                    <td><?= $row['jenis_pelanggaran'] ?></td>
                    <td><?= $row['poin_pelanggaran'] ?></td>
                    <td><?= $row['sanksi_pelanggaran'] ?></td>
                    <?php if ($this->session->userdata('level_akses') == 'adminbk') : ?>
                      <td>
                        <button type="button" rel="tooltip" title="Edit data" class="btn btn-primary" onclick="getdataUpdate('<?= $row['id_pelanggaran'] ?>')">
                          <i class="fa fa-pencil"></i>
                        </button>
                        <button type="button" rel="tooltip" title="Hapus data" onclick="alertdel('<?= $row['id_pelanggaran'] ?>')" class="btn btn-danger">
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
</div>

<script type="text/javascript">
  function tambahPelanggaran() {
    $("#pageloader").fadeIn();
    setTimeout(function() {
      var datasend = new FormData();
      datasend.append('kode', $('#kode_insert').val());
      datasend.append('jenis', $('#jenis_insert').val());
      datasend.append('poin', $('#poin_insert').val());
      datasend.append('sanksi', $('#sanksi_insert').val());
      $.ajax({
        url: '<?= base_url() ?>Adminbk/PelanggaranController/aksiTambahPelanggaran',
        method: 'POST',
        contentType: false,
        processData: false,
        data: datasend,
        success: function(data) {
          console.log(data);
          $("#pageloader").hide();
          if (data == 'sukses') {
            swal("Informasi", "Data berhasil ditambahkan", "success")
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

  function alertdel(id) {
    var r = confirm("Yakin ingin menghapus data yang dipilih?");
    if (r == true) {
      HapusAlert(id);
    } else {
      return true;
    }
  }

  function HapusAlert(id) {
    var hps = new FormData();
    hps.append('id', id);
    $.ajax({
      url: '<?= base_url() ?>Adminbk/PelanggaranController/HapusPelanggaran',
      method: 'POST',
      contentType: false,
      processData: false,
      data: hps,
      success: function(data) {
        console.log(data);
        location.reload();
      },
      error: function(data) {
        console.log(data);
      }
    });
  }

  function getdataUpdate(id) {
    var hps = new FormData();
    hps.append('id', id);
    $.ajax({
      url: '<?= base_url() ?>Adminbk/PelanggaranController/GetDataPelanggaran',
      method: 'POST',
      contentType: false,
      processData: false,
      data: hps,
      dataType: 'json',
      cache: true,
      success: function(data) {
        console.log(data);
        $('#modal_update').modal('show');

        $('#kode_update').val(data.kode_pelanggaran);
        $('#jenis_update').val(data.jenis);
        $('#poin_update').val(data.poin);
        $('#sanksi_update').val(data.sanksi);
        $('#id_pelanggaran').val(data.id);
      },
      error: function(data) {
        console.log(data);
      }
    });
  }

  function AksiUpdate() {
    $('#pageloader').fadeIn();
    setTimeout(function() {
      var datasend = new FormData();
      datasend.append('id', $('#id_pelanggaran').val());
      datasend.append('kode_update', $('#kode_update').val());
      datasend.append('jenis_update', $('#jenis_update').val());
      datasend.append('poin_update', $('#poin_update').val());
      datasend.append('sanksi_update', $('#sanksi_update').val());
      $.ajax({
        url: '<?= base_url() ?>Adminbk/PelanggaranController/aksiUpdatePelanggaran',
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