<h1>Tanda Terima</h1>
<p>Tanda terima pilketrt anda adalah <strong><?=$var?></strong></p>
<table>
<thead>
    <tr>
        <th>Kode</th>
        <th class="nw">Nama Pemilih</th>
        <th>Tanda Terima</th>
    </tr>
</thead>
<?php
$q = esc_field($_GET['q']);
$rows = $db->get_results("SELECT * FROM tb_pilih 
    WHERE id_pemilih LIKE '%$q%' 
        OR nama_pemilih LIKE '%$q%'
    ORDER BY id_pemilih");
foreach($rows as $row):?>
<tr>
    <td><?=$row->id_pemilih?></td>
    <td><?=$row->nama_pemilih?></td>
    <td><?=$var?></td>
</tr>
<?php endforeach;
?>
</table>