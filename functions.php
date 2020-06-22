
<?php
include 'vendor/autoload.php';
use phpseclib\Math\BigInteger;
error_reporting(~E_NOTICE & ~E_DEPRECATED);
session_start();
date_default_timezone_set('Etc/GMT-7');
//date_default_timezone_set('Etc/GMT-8'); WITA

include'config.php';
include'includes/ez_sql_core.php';
include'includes/ez_sql_mysqli.php';
include'includes/SimpleImage.php';
$db = new ezSQL_mysqli($config[username], $config[password], $config[database_name], $config[server]);
    
$mod = $_GET[m];
$act = $_GET[act];  

/** ============ GENERAL =========== */
function esc_field($str){
    if (!get_magic_quotes_gpc())
        return addslashes($str);
    else
        return $str;
}

function redirect_js($url){
    echo '<script type="text/javascript">window.location.replace("'.$url.'");</script>';
}

function print_msg($msg, $type = 'danger'){
    echo('<div class="alert alert-'.$type.' alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$msg.'</div>');
}

function sudah_memilih($id_pemilih)
{
    global $db;
    return $db->get_row("SELECT id_pemilih FROM tb_pilih WHERE id_pemilih='$id_pemilih'");
}

function hapus_gambar($ID)
{
    global $db;
    $gambar = $db->get_var("SELECT gambar FROM tb_pencalon WHERE id_pencalon='$ID'");
    $file_name = 'gambar/' . $gambar;
    if(is_file($file_name))
        return unlink($file_name);
}
function encrypt($message, $encryption_key){
    $key = hex2bin($encryption_key);
    $nonceSize = openssl_cipher_iv_length('aes-256-ctr');
    $nonce = openssl_random_pseudo_bytes($nonceSize);
    $ciphertext = openssl_encrypt(
      $message, 
      'aes-256-ctr', 
      $key,
      OPENSSL_RAW_DATA,
      $nonce
    );
    return base64_encode($nonce.$ciphertext);
  }
  function decrypt($message,$encryption_key){
    $key = hex2bin($encryption_key);
    $message = base64_decode($message);
    $nonceSize = openssl_cipher_iv_length('aes-256-ctr');
    $nonce = mb_substr($message, 0, $nonceSize, '8bit');
    $ciphertext = mb_substr($message, $nonceSize, null, '8bit');
    $plaintext= openssl_decrypt(
      $ciphertext, 
      'aes-256-ctr', 
      $key,
      OPENSSL_RAW_DATA,
      $nonce
    );
    return $plaintext;
}

function encryptRSA($privateKey, $message){
        $cipherResult = "";
        for($i=0; $i<strlen($message);$i++){
            $character = $message[$i];
            
            $numberASCII = ord($character);
            $plainPangkatE = pow($numberASCII, $privateKey);

            $cipherASCII = $plainPangkatE % 187;
            $cipher = chr($cipherASCII);
            $cipherResult .= $cipher;
        }
        return $cipherResult;
}

function decryptRSA($cipher, $privateKey){
    $plainResult = "";
    for($i=0; $i<strlen($cipher);$i++){
        $character = $cipher[$i];

        $numberAscii = ord($character);

        $n = new BigInteger(187);
        $numberAscii = new BigInteger($numberAscii);
        $privateKey = new BigInteger($privateKey);

        $cipherPangkatD = new BigInteger($n->powMod($numberAscii, $privateKey));
        echo $cipherPangkatD."\n";

        // $rumusDecrypt = $cipherPangkatD % 187;
        // echo $rumusDecrypt;

        $asciiToChar = chr($cipherPangkatD);
        $plainResult .= $asciiToChar;
    }
    // echo $plainResult;
    // exit();
    return $plainResult;
}