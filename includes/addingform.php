<?php
  if(isset($_GET['marka'])){
    $query = "INSERT INTO auto (marka, model, VIN, rok, kolor, metalic, opis, zdjecie) VALUES ('".$_GET['marka']."', '".$_GET['model']."', '".$_GET['vin']."', '".$_GET['rok']."', '".$_GET['kolor']."', '".$_GET['metalic']."', '".$_GET['opis']."', '".$_GET['img']."')";
  }
    ?>

<div class="overlay" id="addingform">
  <div class="confirm_adding_container">
    <h2>Twoje ogłoszenie wygląda następująco:</h2>
    <div style="margin-top: 20px;" class="ad">
      <div class="img_content">
        <img src="<?=$_GET['img']?>" alt="Błąd" height="100px" width="100px">
      </div>
      <div class="ad_content">
        <div class="ad_content_all">
          <p class="addingform_attribute">Marka: <?=$_GET['marka']?></p> 
          <p class="addingform_attribute">Model: <?=$_GET['model']?></p>
          <p class="addingform_attribute">Rok produkcji: <?=$_GET['rok']?></p>
          <p class="addingform_attribute">vin: <?=$_GET['vin']?></p>
          <p class="addingform_attribute">Kolor: <?=$_GET['kolor']?></p>
          <p class="addingform_attribute">metalic: <?=$_GET['metalic']?></p>
        </div>
        <div class="ad_content_describe">
          <h3>Opis:</h3>
          <?=$_GET['opis']?>
        </div>
      </div>
    </div>
    <div class="buttton_container">
          <a href="index.php?added=true&query=<?=$query?>"><button type="button" class="btn check_login_btn">Zatwierdź</button></a>
          <a href="index.php?added='false'"><button type="button" class="btn check_login_btn">Anuluj</button></a>
        </div>
  </div>
</div>