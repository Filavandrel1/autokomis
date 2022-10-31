<?php
  session_start();
  include 'logowanie.php';
  $con = mysqli_connect($serwer, $user, $pass, $baza);
  if(!$con){
      echo "Nie połączone z bazą";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<?php
  if (isset($_SESSION['zalogowano'])) { 
?>
  <form action="dodaj.php" method="post">
    Marka: <input type="text" name="marka" id="">
    <br>
    Model: <input type="text" name="model" id="">
    <br>
    VIN: <input type="text" name="vin" id="">
    <br>
    Kolor: <input type="text" name="kolor" id="">
    <br>
    Rok produkcji: <input type="number" name="rok" id="">
    <br>
    <input type="submit" value="wyślij">
    <input type="reset" value="reset">
  </form>
  <?php
  }
  else{
    echo "Nie jesteś zalogowany";
  }
  ?>
</body>
</html>
<?php
  if(!empty($_POST['marka']) && !empty($_POST['model']) && !empty($_POST['kolor']) && !empty($_POST['rok']) && !empty($_POST['vin'])){
    $query = "INSERT INTO auto (marka, model, kolor, rok, vin) VALUES ('".$_POST['marka']."', '".$_POST['model']."', '".$_POST['kolor']."', '".$_POST['rok']."' , '".$_POST['vin']."')";
    $result = mysqli_query($con, $query);
    if($result){
      echo "Dodano";
    }else{
      echo "Nie dodano";
    }
  }
?>