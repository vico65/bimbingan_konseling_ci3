<style type="text/css">
  .appdesc {
    display: block;
  }

  .imgApp {
    display: none;
  }

  @media only screen and (max-width: 624px) {
    .appdesc {
      display: none;
    }

    .imgApp {
      display: block;
    }
  }
</style>


<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <a class="navbar-brand appdesc" href="#pablo"><img src="<?= base_url() ?>assets/img/logotj.png" width='50px'> <span>Bimbingan Konseling SMKN 5 Palembang</span></a>
      <span class="imgApp"><img src="<?= base_url() ?>assets/img/logotj.png" width='50px'> Bimbingan konseling V 1.0</span>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <!-- Query untuk membedakan isi navbar sesuai type akses -->
        <?php
        $navbar_hak_akses = $this->session->userdata('level_akses');
        $id = $this->session->userdata('id');
        if ($navbar_hak_akses == 'adminbk' || $navbar_hak_akses == 'murid' || $navbar_hak_akses == 'wali_murid') {
          $jumlah_notifikasi = $this->model_global->getNotifikasi($navbar_hak_akses, $id)->num_rows();
        }

        if ($navbar_hak_akses == 'adminbk' || $navbar_hak_akses == 'murid' || $navbar_hak_akses == 'wali_murid') {
        ?>
          <li class="nav-item dropdown">
            <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="material-icons">notifications</i>

              <?php if ($jumlah_notifikasi > 0): ?>
              <span class="notification">
                <!-- Query untuk menghitung banyak notifikasi -->
                <?= $jumlah_notifikasi ?>
                <!-- end Query untuk menghitung banyak notifikasi -->
              </span>
              <?php endif; ?>
              <p class="d-lg-none d-md-block">
                Some Actions
              </p>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <!-- query untuk menampilkan pesan notifikasi sesuai type akses -->
              <?php
              if ($navbar_hak_akses == 'adminbk') {
                if ($jumlah_notifikasi > 0) {
                  foreach ($this->model_global->getNotifikasi($navbar_hak_akses, $id)->result_array() as $rowNotif1) {
                    echo '<a class="dropdown-item" href="#"> <i class="fa fa-flag" style="color:red"></i>&nbsp;Laporan pelanggaran siswa dari &nbsp;<b>' . $rowNotif1["nama_guru"] . ' </b>&nbsp;menunggu validasi admin</a>';
                  }
                } else {
                  echo '<a class="dropdown-item" href="#">Tidak ada notifikasi terbaru</a>';
                }
              } elseif ($navbar_hak_akses == 'murid') {
                if ($jumlah_notifikasi > 0) {
                  foreach ($this->model_global->getNotifikasi($navbar_hak_akses, $id)->result_array() as $rowNotif2) {
                    echo '<a class="dropdown-item" href="#"><b><i class="fa fa-flag"></i> ' . $rowNotif2["nama_guru"] . '</b> &nbsp; Melaporkan anda</a>';
                  }
                } else {
                  echo '<a class="dropdown-item" href="#">Tidak ada notifikasi terbaru</a>';
                }
              } elseif ($navbar_hak_akses == 'wali_murid') {
                if ($jumlah_notifikasi > 0) {
                  foreach ($this->model_global->getNotifikasi($navbar_hak_akses, $id)->result_array() as $rowNotif3) {
                    echo ' <a class="dropdown-item" href="#">You have 5 new tasks</a>';
                  }
                } else {
                  echo '<a class="dropdown-item" href="#">Tidak ada notifikasi terbaru</a>';
                }
              }
              ?>
              <!-- end query untuk menampilkan pesan notifikasi sesuai type akses -->
            </div>
          </li>
        <?php
        }
        ?>
        <!-- end Query untuk membedakan isi navbar sesuai type akses -->
        <li class="nav-item dropdown">
          <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons">person</i> <?= $this->session->userdata('nama') ?>
            <p class="d-lg-none d-md-block">
              Account
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
            <!-- <a class="dropdown-item" href="#">Profile</a> -->
            <!-- <a class="dropdown-item" href="#">Settings</a> -->
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= base_url() ?>logout">Log out</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>