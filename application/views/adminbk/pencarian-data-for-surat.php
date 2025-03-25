<table class="table ">
  <tbody>
    <tr>
      <th>NIS</th>
      <th>Nama siswa</th>
      <th>Nama wali</th>
      <th>Aksi</th>
    </tr>
    <?php
    foreach ($query->result_array() as $rowsiswa) {
    ?>
      <tr>
        <td><?= $rowsiswa['NIS'] ?></td>
        <td><?= $rowsiswa['nama_siswa'] ?></td>
        <td><?= $rowsiswa['nama_wali_siswa'] ?></td>
        <td>
          <button class="btn btn-primary" onclick="ParsingDataSiswa('<?= $rowsiswa['NIS'] ?>','<?= $rowsiswa['nama_siswa'] ?>','<?= $rowsiswa['nama_wali_siswa'] ?>','<?= $rowsiswa['no_telp_wali'] ?>')">Pilih</button>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>