<table class="table ">
  <tbody>
    <tr>
      <th>NIS</th>
      <th>Nama siswa</th>
      <th>Kelas</th>
      <th>Jenis kelamin</th>
      <th>Aksi</th>
    </tr>                        
      <?php
        foreach ($query->result_array() as $rowsiswa ) {
      ?>
    <tr>
      <td><?=$rowsiswa['nis_siswa']?></td>
      <td><?=$rowsiswa['nama_siswa']?></td>
      <td><?=$rowsiswa['nama_kelas']?></td>
      <td><?=$rowsiswa['jenis_kelamin']?></td>
      <td>   
        <button class="btn btn-primary" onclick="ParsingDataSiswa('<?=$rowsiswa['nis_siswa']?>','<?=$rowsiswa['nama_siswa']?>','<?=$rowsiswa['nama_kelas']?>')">Pilih</button>
      </td>
    </tr>
    <?php
        }
      ?>
  </tbody>
</table>