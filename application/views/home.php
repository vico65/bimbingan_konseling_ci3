<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?= base_url() ?>assets/img/logotj.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Bimbingan konseling SMK Negeri 5 Palembang
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="<?= base_url() ?>assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?= base_url() ?>assets/demo/demo.css" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


</head>
<style type="text/css">
  #pageloader {
    background: rgba(255, 255, 255, 0.8);
    display: none;
    height: 100%;
    position: fixed;
    width: 100%;
    z-index: 9999;
  }

  #pageloader img {
    left: 51%;
    margin-left: -70px;
    margin-top: -100px;
    position: absolute;
    top: 50%;
  }
</style>

<body class="">
  <div id="pageloader">
    <img src="<?= base_url() ?>assets/img/pageloader2.gif" alt="processing..." />
  </div>

  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="<?= base_url() ?>assets/img/sidebar-3.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
    
    <div class="logo">
        <a href="<?= base_url() ?>beranda" class="simple-text logo-normal">
          <i class="fa fa-user"></i>
          <?= $this->session->userdata('nama') ?>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item <?= ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'beranda') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url() ?>beranda">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <?php
          $hakAkses = $this->session->userdata('level_akses');
          if ($hakAkses == 'adminbk') {
          ?>
            <li class="nav-item <?= ($this->uri->segment(1) == 'daftar_siswa') ? 'active' : '' ?>">
              <a class="nav-link" href="<?= base_url() ?>daftar_siswa">
                <i class="material-icons">group</i>
                <p>Daftar Siswa</p>
              </a>
            </li>
            <li class="nav-item <?= ($this->uri->segment(1) == 'daftar_kelas') ? 'active' : '' ?>">
              <a class="nav-link" href="<?= base_url() ?>daftar_kelas">
                <i class="material-icons">supervised_user_circle</i>
                <p>Daftar Kelas</p>
              </a>
            </li>
            <li class="nav-item <?= ($this->uri->segment(1) == 'daftar_guru') ? 'active' : '' ?>">
              <a class="nav-link" href="<?= base_url() ?>daftar_guru">
                <i class="material-icons">school</i>
                <p>Daftar guru</p>
              </a>
            </li>
            <li class="nav-item <?= ($this->uri->segment(1) == 'daftar_pelanggaran') ? 'active' : '' ?>">
              <a class="nav-link" href="<?= base_url() ?>daftar_pelanggaran">
                <i class="material-icons">content_paste</i>
                <p>Daftar pelanggaran</p>
              </a>
            </li>
            <li class="nav-item <?= ($this->uri->segment(1) == 'histori_laporan' || $this->uri->segment(1) == 'adminbk') ? 'active' : '' ?>">
              <a class="nav-link" href="<?= base_url() ?>histori_laporan">
                <i class="material-icons">report</i>
                <p>Histori Laporan </p>
              </a>
            </li>
            <li class="nav-item <?= ($this->uri->segment(1) == 'daftar_bimbingan' || $this->uri->segment(1) == 'jadwal_bimbingan' ) ? 'active' : '' ?>">
              <a class="nav-link" href="<?= base_url() ?>daftar_bimbingan">
                <i class="material-icons">info_outline</i>
                <p>Daftar siswa bimbingan</p>
              </a>
            </li>
            <li class="nav-item <?= ($this->uri->segment(1) == 'tahun_ajaran') ? 'active' : '' ?>">
              <a class="nav-link" href="<?= base_url() ?>tahun_ajaran">
                <i class="material-icons">event</i>
                <p>Tahun Akademik</p>
              </a>
            </li>
            <li class="nav-item <?= ($this->uri->segment(1) == 'surat_panggilan') ? 'active' : '' ?>">
              <a class="nav-link" href="<?= base_url() ?>surat_panggilan">
                <i class="material-icons">print</i>
                <p>Surat</p>
              </a>
            </li>
          <?php
          } else if ($hakAkses == 'guru') {
          ?>
            <li class="nav-item <?= ($this->uri->segment(1) == 'daftar_laporan') ? 'active' : '' ?>">
              <a class="nav-link" href="<?= base_url() ?>daftar_laporan">
                <i class="material-icons">content_paste</i>
                <p>Daftar laporan</p>
              </a>
            </li>
          <?php
          } else if ($hakAkses == 'murid') {
          ?>
            <li class="nav-item <?= ($this->uri->segment(1) == 'jadwal_bimbingan') ? 'active' : '' ?>">
              <a class="nav-link" href="<?= base_url() ?>jadwal_bimbingan">
                <i class="material-icons">content_paste</i>
                <p>Bimbingan</p>
              </a>
            </li>
          <?php
          } else if ($hakAkses == 'wali_murid') {
          ?>
            
            <li class="nav-item <?= ($this->uri->segment(1) == 'surat') ? 'active' : '' ?>">
              <a class="nav-link" href="<?= base_url() ?>surat">
                <i class="material-icons">print</i>
                <p>Surat</p>
              </a>
            </li>
          <?php
          } else if ($hakAkses == 'kepsek') {
          ?>
            <li class="nav-item <?= ($this->uri->segment(1) == 'daftar_siswa') ? 'active' : '' ?>">
              <a class="nav-link" href="<?= base_url() ?>daftar_siswa">
                <i class="material-icons">group</i>
                <p>Daftar siswa</p>
              </a>
            </li>
            <li class="nav-item <?= ($this->uri->segment(1) == 'daftar_kelas') ? 'active' : '' ?>">
              <a class="nav-link" href="<?= base_url() ?>daftar_kelas">
                <i class="material-icons">supervised_user_circle</i>
                <p>Daftar Kelas</p>
              </a>
            </li>
            <li class="nav-item <?= ($this->uri->segment(1) == 'daftar_guru') ? 'active' : '' ?>">
              <a class="nav-link" href="<?= base_url() ?>daftar_guru">
                <i class="material-icons">school</i>
                <p>Daftar guru</p>
              </a>
            </li>
            <li class="nav-item <?= ($this->uri->segment(1) == 'daftar_pelanggaran') ? 'active' : '' ?>">
              <a class="nav-link" href="<?= base_url() ?>daftar_pelanggaran">
                <i class="material-icons">content_paste</i>
                <p>Daftar pelanggaran</p>
              </a>
            </li>
            <li class="nav-item <?= ($this->uri->segment(1) == 'histori_laporan' || $this->uri->segment(1) == 'adminbk') ? 'active' : '' ?>">
              <a class="nav-link" href="<?= base_url() ?>histori_laporan">
                <i class="material-icons">report</i>
                <p>Histori Laporan </p>
              </a>
            </li>
            <li class="nav-item <?= ($this->uri->segment(1) == 'daftar_bimbingan') ? 'active' : '' ?>">
              <a class="nav-link" href="<?= base_url() ?>daftar_bimbingan">
                <i class="material-icons">info_outline</i>
                <p>Daftar siswa bimbingan</p>
              </a>
            </li>
            <li class="nav-item <?= ($this->uri->segment(1) == 'tahun_ajaran') ? 'active' : '' ?>">
              <a class="nav-link" href="<?= base_url() ?>tahun_ajaran">
                <i class="material-icons">event</i>
                <p>Tahun Akademik</p>
              </a>
            </li>
            <li class="nav-item <?= ($this->uri->segment(1) == 'surat') ? 'active' : '' ?>">
              <a class="nav-link" href="<?= base_url() ?>surat">
                <i class="material-icons">print</i>
                <p>Surat</p>
              </a>
            </li>

          <?php
          }
          ?>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <?php $this->load->view('navbar') ?>
      <!-- End Navbar -->

      <div class="content">
        <div class="container-fluid">
          <!-- Main conten -->
          <?php $this->load->view($content) ?>
          <!-- Main conten -->
        </div>
      </div>

      <footer class="footer">
        <div class="container-fluid">
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, bimbingan konseling | SMKN 5 Palembang
          </div>
        </div>
      </footer>
    </div>
  </div>

  <!--   Core JS Files   -->
  <script src="<?= base_url() ?>assets/js/core/jquery.min.js"></script>
  <script src="<?= base_url() ?>assets/js/core/popper.min.js"></script>
  <script src="<?= base_url() ?>assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="<?= base_url() ?>assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Plugin for the momentJs  -->
  <script src="<?= base_url() ?>assets/js/plugins/moment.min.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="<?= base_url() ?>assets/js/plugins/sweetalert2.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="<?= base_url() ?>assets/js/plugins/jquery.validate.min.js"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="<?= base_url() ?>assets/js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="<?= base_url() ?>assets/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="<?= base_url() ?>assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="<?= base_url() ?>assets/js/plugins/jquery.dataTables.min.js"></script>
  <!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="<?= base_url() ?>assets/js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="<?= base_url() ?>assets/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="<?= base_url() ?>assets/js/plugins/fullcalendar.min.js"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="<?= base_url() ?>assets/js/plugins/jquery-jvectormap.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="<?= base_url() ?>assets/js/plugins/nouislider.min.js"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- Library for adding dinamically elements -->
  <script src="<?= base_url() ?>assets/js/plugins/arrive.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chartist JS -->
  <script src="<?= base_url() ?>assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="<?= base_url() ?>assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?= base_url() ?>assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="<?= base_url() ?>assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
          if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
            $('.fixed-plugin .dropdown').addClass('open');
          }

        }

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();

    });
  </script>
</body>

</html>