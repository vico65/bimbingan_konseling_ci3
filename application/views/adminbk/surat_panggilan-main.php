
  <!-- Modal -->
  <div class="modal fade bd-example-modal-lg" id="modalSiswa" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Daftar Siswa</b></h5>
          <button type="button" id="close_modal" class="close" data-dismiss="modal" aria-label="Close" onclick="resetTabel()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="input-group">
            <input type="text" class="form-control" id="nis_siswa" placeholder="Masukkan NIK Siswa">
            <span class="input-group-btn">
            <button class="btn btn-default" type="button" id="cari_siswa" onclick="CariSiswa()"><i class="fa fa-search"></i> Cari</button>            
            </span>
         </div>
         <div id="hasil_cari"></div>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
 <!--  end modal -->


 <!-- menu beranda -->
  <div class="row">

    <div class="col-lg-12 col-md-12">
      <div class="card">
        <div class="card-header card-header-tabs card-header-danger">
          <b><i class="fa fa-envelope"></i>Buat surat</b>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="tab-pane active" id="profile">
              <button class="btn btn-primary" type="button" id="cari_siswa" data-toggle="modal" data-target="#modalSiswa"> <i class="material-icons">open_in_browser</i> Pilih siswa</button>
              <div class="table-responsive">
                <table class="table">
                  <tr style="display: none;">
                    <td colspan="3"><input type="text" id="id_siswa" name="" readonly=""></td>
                  </tr>
                  <tr>
                    <td style="width: 160px"><b>NIS</b></td>
                    <td style="width: 10px">:</td>
                    <td><span id="tabel_nis_siswa">-</span></td>
                  </tr>
                  <tr>
                    <td><b>Nama siswa</b></td>
                    <td>:</td>
                    <td><span id="tabel_nama_siswa">-</span></td>
                  </tr>
                  <tr>
                    <td><b>Nama wali</b></td>
                    <td>:</td>
                    <td><span id="tabel_nama_wali">-</span></td>
                  </tr>                
                </table>
              </div>
              <textarea class="form-control" id="isi_pesan" placeholder="Tuliskan Pesan Disini..."></textarea>
              <button class="btn btn-success" style="float: right;" type="button" id="kirim" onclick="()">Buat Surat <i class="fa fa-paper-plane"></i></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- end beranda -->

<script type="text/javascript">

  // ajax untuk pencarian siswa
  function CariSiswa(){
   if ($('#nis_siswa').val()=='') {
      swal("Informasi","Masukkan Nis Siswa!","error");
    } else {
      $("#pageloader").fadeIn();
      setTimeout(function() {
        var datasend = new FormData();
        datasend.append('nis_siswa',$('#nis_siswa').val());
          $.ajax({
              url: '<?=base_url()?>adminbk/SuratController/cariSiswaForSurat',
              method: 'POST',
              contentType: false,
              processData: false,
              data: datasend,
              success: function(data) {
                console.log(data);
                $("#pageloader").hide();
                $("#hasil_cari").html(data);

                $("#cari_siswa").click(function(){
                  $("#hasil_cari").html('');
                });                                    
              },
              error: function(data) {
                console.log(data);
                $("#pageloader").hide();               
                  swal("Informasi","Gagal Terhubung Ke Server" ,"error");
              }
          });
        }, 1000);
      }
    }



    // untuk mereset data siswa di popup setelah keluar
    function resetTabel(){
      $("#hasil_cari").html('');
      $('#nama_siswa').val('');
    }

    //jquery untuk mengisi tabel data siswa yang melanggar
    function ParsingDataSiswa(nis,nama_siswa,nama_wali,no_hp_wali){
      $("#tabel_nis_siswa").html(nis);
      $("#tabel_nama_siswa").html(nama_siswa);
      $("#tabel_nama_wali").html(nama_wali);
      $("#no_hp_wali").val(no_hp_wali);
       $('#modalSiswa').modal('hide');
    }


</script>

          