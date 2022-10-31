<!-- All needed php code -->
<?php include('includes/basic_php.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AUTOKOMIS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet" href="css/styles.css">
</head>
<body id="dodaj">
  <?php
    if (isset($_SESSION['zalogowano'])) { 
  ?>
  <ul class="nav justify-content-center navbar_autokomis">
    <li class="nav-item">
      <a href="wyszukaj.php"><button type="button" class="btn btn-outline-primary navbar_btn">WYSZUKAJ</button></a>
    </li>
    <li class="nav-item">
      <a href="index.php">
        <button
          type="button" class="btn btn-outline-primary navbar_btn">STRONA GŁÓWNA
        </button>
      </a>
    </li>
    <li class="nav-item">
      <a href="usun.php">
        <button
          type="button" class="btn btn-outline-primary navbar_btn">USUŃ
        </button>
      </a>
    </li>
    <li class="nav-item">
      <a href="?wyloguj= true">
        <button
          type="button" class="btn btn-logout navbar_btn">WYLOGUJ
        </button>
      </a>
    </li>
  </ul>
  <form action="">
    <div class="add_container">
      <div class="content_dodaj">
        <div class="inputs_wrapper_dodaj">
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Marka</span>
            <input type="text" class="form-control" placeholder="Marka" aria-label="Username" aria-describedby="basic-addon1">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Model</span>
            <input type="text" class="form-control" placeholder="Model" aria-label="Username" aria-describedby="basic-addon1">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">VIN</span>
            <input type="number" class="form-control" placeholder="VIN" aria-label="Username" aria-describedby="basic-addon1">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Rok</span>
            <input type="number" class="form-control" placeholder="Rok" aria-label="Username" aria-describedby="basic-addon1">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Kolor</span>
            <input type="text" class="form-control" placeholder="Kolor" aria-label="Username" aria-describedby="basic-addon1">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Metalic</span>
            <input type="text" class="form-control" placeholder="Metalic" aria-label="Username" aria-describedby="basic-addon1">
          </div>
          <div class="input-group">
            <span class="input-group-text">Opis</span>
            <textarea class="form-control" aria-label="With textarea"></textarea>
          </div>
        </div>
        <div class="img_container_dodaj">
        
        </div>
      </div>
      <div class="submits_wrapper_dodaj">
        <button type="submit" class="btn check_adding_btn">Dodaj</button>
        <button type="reset" class="btn check_adding_btn">Reset</button>
      </div>
    </div>
  </form>
  <?php
  }
  else{
    echo "Nie jesteś zalogowany";
  }
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
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