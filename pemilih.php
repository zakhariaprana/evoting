<?php
    include 'vendor/autoload.php';
    use phpseclib\Crypt\RSA;
    
    $pk = "-----BEGIN RSA PRIVATE KEY----- MIICXAIBAAKBgQDjcf/0+uG+/LdKUSNbIL5CPuEnevKOQ9sLRdt5sxwWY2Lcdr2o 4KSRTJnDrej3/M34T+vXKERc7r9QPaUzacylhZi105Am5tV9SXe0Rf7N8Di3jK2y ISNIYdu4rifzQTwtGv2WgiCZBUkut66yhqRRAVvX7s991WylVKMubeW6bwIDAQAB AoGBAM2zAWEHMPkwx3fv78Dv2QJCqhCxsgKWPdlxIXBsW1+oHPX0ccz09gDuvTXq 6AK34XPMnCfnpAREbEPerLTV35yyp0RRDoIN8Vw6jzufRbbHMmpPuox8AbFQalbJ EVoUqX5vQ7oFvn6qYOAHORb6I5SmaSWhBrd8aLduk8DdBeo5AkEA9qcm8bRVJMbX kjbkDG5pq4HFbr1Zvvzbq3gt/uNGIE3tc6OXo7JT+uOP7Ij/AGwmv0cEhqI4iXQV 56DamFGrxQJBAOwQgl5JC7S/hjDUrbIIOv2hGyGEBSsaEg2bWB5grlRM0fly+wgM O2NLqi/gul1lkZ6esVY3Ykgw2RigCx9ZrKMCQAH50tEK3ce+pAly0R7cX5JVJsy9 TZO/GM9l1hB9p5kopqdPfy57hjqzSfreGhTZyPGtUvb1I7jOKkLBwh6IQPUCQDAn ugBz1DB99WjWqcwsg6Qjjj5LCSbevZoK+3HO9SD7PsYtH2pn3GGIGOKFbF8LDiaW ZsSYrbLeTBsK4tn1WBMCQAyEzc9b7Zn1Wlt6ZuHHemPcMnORQuwvUNZht2hd+daA e8DcP6jwi/FRyCgw5OhM69TUA3LrQwCn//pGIW7IxJo= -----END RSA PRIVATE KEY-----";
    $puk = "-----BEGIN PUBLIC KEY----- MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC6t8VzKoMTTFTO6ywJr/iudfis 3V2uvxRRdC2mzHKhQEqzG5NPpi9x+2lau8GBLPsgswog3bM0ugi8iJe4VAEwWDp9 8nim5tPwc5UL5S4+eBQd3SChwv82eA+sj7/rPz44MxDBeXQ+w7Kh3rVPHs5dIumy 9ZNvguS0tqNd2mN31wIDAQAB -----END PUBLIC KEY-----";

    $rsa = new \phpseclib\Crypt\RSA();


    extract($rsa->createKey());
    // $rsa->setPrivateKey($pk);
    // $rsa->setPublicKey($puk);
 
    $plaintext = 'terrafrost';
    $rsa->loadKey($privatekey);

    $ciphertext = $rsa->encrypt($plaintext);
    echo $privatekey;
 
    $rsa->loadKey($publickey);
    echo $rsa->decrypt($ciphertext);
    ?>
<div class="page-header">
    <h1>Pemilih</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">        
        <form class="form-inline">
            <input type="hidden" name="m" value="pemilih" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?=$_GET['q']?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
            </div>
            <div class="form-group  <?=($_SESSION['akses']=='admin') ? '' : 'hidden'?>">
                <a class="btn btn-primary" href="?m=pemilih_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
            <div class="form-group">
                <a class="btn btn-default" href="cetak.php?m=pemilih&a=<?=$_GET[q]?>" target="_blank"><span class="glyphicon glyphicon-print"></span> Cetak</a>
            </div>
        </form>
    </div>
    <table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>KTP</th>
            <th>Nama Pemilih</th>
            <th>Alamat</th>
            <th>Status</th>
            <th class=" <?=($_SESSION['akses']=='admin') ? '' : 'hidden'?>">Aksi</th>
        </tr>
    </thead>
    <?php
    $q = esc_field($_GET['q']);
    $rows = $db->get_results("SELECT m.*, p.ID AS pilih FROM tb_pemilih m LEFT JOIN tb_pilih p ON p.id_pemilih=m.id_pemilih WHERE nama_pemilih LIKE '%$q%' ORDER BY m.id_pemilih");
    $no=0;
    foreach($rows as $row):?>
    <tr>
<?php
        $rsa = new RSA();
        $privatekey = file_get_contents('private.key');
        $publickey = file_get_contents('public.key');
        $rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
        $rsa->loadKey($privatekey);
        $rsa->loadKey($publickey);
        $ktp =  $rsa->decrypt($row->ktp);
    ?>
        <td><?=++$no ?></td>
        <td><?=$ktp?></td>
        <td><?=$row->nama_pemilih?></td>
        <td><?=$row->alamat?></td>
        <td><?=($row->pilih) ? '<span class="glyphicon glyphicon-check"></span>' : ''?></td>
        <td class=" <?=($_SESSION['akses']=='admin') ? '' : 'hidden'?>">
            <a class="btn btn-xs btn-warning" href="?m=pemilih_ubah&ID=<?=$row->id_pemilih?>"><span class="glyphicon glyphicon-edit"></span></a>
            <a class="btn btn-xs btn-danger" href="aksi.php?act=pemilih_hapus&ID=<?=$row->id_pemilih?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
        </td>
    </tr>
    <?php endforeach;
    ?>
    </table>
</div>