<?php
$var = $db->get_var("SELECT tanda_terima FROM tb_pilih WHERE id_pemilih='$_SESSION[id_pemilih]'");
?>
<div class="page-header">
  <h1>Tanda Terima Pemilihan Ketua RT 2018</h1>
</div>
<p>Hasil suara yang telah Anda masukkan telah tercatat pada sistem E-Voting</p>
<p>Tanda terima pilketrt anda adalah <strong><?=$var?></strong>
  <input id="printpagebutton" type="button" value="Cetak" onclick="printpage()"/>
</p>
<p>
  <script>
function printpage()
  {
  window.print()
  }
</script><script type="text/javascript">
    function printpage() {
        //Get the print button and put it into a variable
        var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        //Print the page content
        window.print()
        //Set the print button to 'visible' again 
        //[Delete this line if you want it to stay hidden after printing]
        printButton.style.visibility = 'visible';
    }
</script>
Catatan: mohon simpan bukti tanda terima Pemilihan Ketua RT untuk melakukan pengecekan hasil perhitungan suara.</p>
