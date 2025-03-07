<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Tahun Akademik</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
</head>


<body>

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header card-header-tabs card-header-primary">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <b><i class="material-icons">date_range</i> DAFTAR TAHUN AKADEMIK</b>
                        </div>
                        <?php if ($this->session->userdata('level_akses') == 'adminbk') : ?>
                        <div class="col-md-6 text-right">
                            <button class="btn btn-warning" data-toggle="modal" data-target="#modal_insert">
                                <b>+ Tambah Tahun Akademik</b>
                            </button>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table w-100">
                            <tbody>
                                <tr>
                                    <th class>No</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Status</th>
                                    <?php if ($this->session->userdata('level_akses') == 'adminbk') : ?>
                                    <th><center>Aksi</center></th>
                                    <?php endif; ?>
                                </tr>
                            </tbody>
                            <tbody>
                                <?php $index = 1; ?>
                                <?php foreach ($tahun_akademik as $row) : ?>
                                <tr>
                                    <td><?= $index++ ?></td>
                                    <td><?= $row['tahun_akademik'] ?></td>
                                    <td>
                                        <?php if ($row['status_akademik'] == 'Aktif'): ?>
                                            <span class="badge badge-success">Aktif</span>
                                        <?php else: ?>
                                            <?php if ($this->session->userdata('level_akses') == 'adminbk') : ?>
                                            <a href="<?= site_url('adminbk/TahunAjaranController/setAktif/'.$row['id_tahun_akademik']) ?>" class="btn btn-sm btn-success">
                                                Set Aktif
                                            </a>
                                            <?php else: ?>
                                            <span class="badge badge-success">Tidak Aktif</span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                    <?php if ($this->session->userdata('level_akses') == 'adminbk') : ?>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#modal_update" 
                                                onclick="setEditData('<?= $row['id_tahun_akademik'] ?>', '<?= $row['tahun_akademik'] ?>')">
                                                <i class="fa fa-pencil"></i> Edit
                                            </button>                    
                                            <a href="<?= site_url('adminbk/TahunAjaranController/delete/'.$row['id_tahun_akademik']) ?>" class="btn btn-danger mr-2" 
                                                onclick="return confirm('Yakin ingin menghapus?')">
                                                <i class="fa fa-trash"></i> Hapus
                                            </a>
                                            <?php if ($row['status_akademik'] == 'Aktif'): ?>
                                                <a href="<?= site_url('adminbk/TahunAjaranController/resetPoin') ?>" class="btn btn-warning" 
                                                    onclick="return confirm('Apakah Anda yakin ingin mereset semua poin siswa menjadi 0?')">
                                                    <i class="fa fa-refresh"></i> Reset Poin
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>   
                                    <?php endif; ?>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modal_insert" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Tahun Akademik</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?= site_url('adminbk/TahunAjaranController/store') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tahun Akademik</label>
                        <input type="text" class="form-control" name="tahun" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modal_update" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Tahun Ajaran</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?= site_url('adminbk/TahunAjaranController/update') ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id_tahun">
                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <input type="text" class="form-control" id="edit_tahun" name="tahun" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function setEditData(id, tahun) {
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_tahun').value = tahun;
}
</script>

<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>
