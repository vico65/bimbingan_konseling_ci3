<!-- menu beranda -->
<div class="row">
    <?php
    $total_siswa = $this->db->count_all('siswa');
    $total_kelas = $this->db->query('select * from data_value where type_value="KELAS"')->num_rows();
    $total_guru = $this->db->count_all('guru');
    $total_bimbingan = $this->db->count_all('bimbingan');
    ?>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">group</i>
                </div>
                <p class="card-category">Total siswa</p>
                <h3 class="card-title"><?= $total_siswa ?> Siswa / <?= $total_kelas ?> Kelas</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">sync</i> up to date
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">supervised_user_circle</i>
                </div>
                <p class="card-category">Total guru</p>
                <h3 class="card-title"><?= $total_guru ?></h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">sync</i> up to date
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
                <p class="card-category">Total bimbingan</p>
                <h3 class="card-title"><?= $total_bimbingan ?></h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">sync</i> up to date
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end beranda -->
