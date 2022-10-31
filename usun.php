  <?php
    session_start();
    include 'logowanie.php';
    $con = mysqli_connect($serwer, $user, $pass, $baza);
    if(!$con){
        echo "Nie połączone z bazą!";
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
  <form action="usun.php" method="post">
    Marka:
    <select name="marka" id="" style="width: 100px;">
      <?php
        echo "<option value='0'></option>";
        $query = "SELECT DISTINCT(marka) from auto";
        $result = mysqli_query($con, $query);
        while($option = mysqli_fetch_assoc($result)){
          echo "<option>".$option['marka']."</option>";
        }
      ?>
    </select>
    <input type="submit" value="wyślij">
  </form>
  <form action="usun.php" method="post">
    model:
    <select name="model" id="" style="width: 100px;">
      <option value=""></option>
      <?php
        $query = "SELECT DISTINCT(model) from auto where marka = '".$_POST['marka']."'";
        $result = mysqli_query($con, $query);
        while($option = mysqli_fetch_assoc($result)){
          echo "<option>".$option['model']."</option>";
        }
      ?>
    </select>
    <br>
    VIN:<input type="text" name="VIN" id="">
    <br>
    <input type="submit" value="wyślij">
    <input type="reset" value="reset">
    <?php
        if(isset($_POST['model'])){
            $model = $_POST['model'];
        }
        if(isset($_POST['VIN'])){
            $VIN = $_POST['VIN'];
        }
        if(!empty($VIN)){
          @$query = "DELETE from auto where model like '$model' and VIN like '$VIN'";
        }
        else{
          @$query = "DELETE from auto where model like '$model'";
        }
        if(!empty($model)){
          $result = mysqli_query($con, $query);
        }
    ?>
    <?php
      }
      else{
        echo "Nie jesteś zalogowany";
      }
    ?>
</body>
</html>
