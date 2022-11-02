<?php
  include("includes/basic_php.php");
  $query = "DELETE FROM auto WHERE VIN = ".$_GET['usun'];
  if(isset($_SESSION['zalogowano'])){
    $result = mysqli_query($con, $query);
    header("Location: wyszukaj.php?comunicat=usunieto");
  }
  else{
    header("Location: index.php?comunicat=niezalogowany");
  }
?>