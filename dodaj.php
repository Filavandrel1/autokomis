<!-- All needed php code -->
<?php 
  include('includes/basic_php.php'); 
?>
<?php
  if (isset($_POST['submit'])){
    $vinok = 1;
    if(strlen((string)$_POST['vin']) != 17){
      $vinok = 0;
    }
    $query = "SELECT COUNT(*) from auto where vin like '".$_POST['vin']."'";
    $result = mysqli_query($con, $query);
    if(mysqli_fetch_row($result)[0] >= 1){
      $vinok = 0;
    }
  }
  $uploadOk = 1;
  if (isset($_POST["submit"]) && $vinok == 1) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      $uploadOk = 1;
    } else {
      $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 5242880) {
      $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      $uploadOk = 0;
    }
    
  }
  if(isset($_POST['submit']) && $vinok == 1 && $uploadOk == 1){
    $url = "?img=".$target_file."&marka=".$_POST['marka']."&model=".$_POST['model']."&vin=".$_POST['vin']."&rok=".$_POST['rok']."&kolor=".$_POST['kolor']."&metalic=".$_POST['metalic']."&opis=".$_POST['opis']."#addingform";
    header("Location: $url");
  }
?>


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
    include('includes/addingform.php');
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
  <form action="dodaj.php" method="POST" enctype="multipart/form-data">
    <div class="add_container">
      <div class="content_dodaj">
        <div class="inputs_wrapper_dodaj">
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Marka</span>
            <input name="marka" autocomplete="off" required type="text" class="form-control" placeholder="Marka" aria-label="Username" aria-describedby="basic-addon1">
          </div>
          <div class="input-group mb-3"> 
            <span class="input-group-text" id="basic-addon1">Model</span>
            <input name="model" autocomplete="off" required type="text" class="form-control" placeholder="Model" aria-label="Username" aria-describedby="basic-addon1">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">VIN</span>
            <input name="vin" autocomplete="off" required type="number" class="form-control" placeholder="VIN" aria-label="Username" aria-describedby="basic-addon1">
          </div>
          <?php
              if (isset($_POST['submit'])){
                if(strlen((string)$_POST['vin']) != 17){
                  echo '<p class="error1">VIN musi składać się z 17 znaków!</p>';
                }
                $query = "SELECT COUNT(*) from auto where vin like '".$_POST['vin']."'";
                $result = mysqli_query($con, $query);
                if(mysqli_fetch_row($result)[0] >= 1){
                  echo '<p style="margin-left:5px;" class="error1">Auto o podanym VIN już istnieje!</p>';
                }
              }
                
            ?>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Rok</span>
            <input name="rok" autocomplete="off" required type="number" class="form-control" placeholder="Rok" aria-label="Username" aria-describedby="basic-addon1">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Kolor</span>
            <input name="kolor" autocomplete="off" required type="text" class="form-control" placeholder="Kolor" aria-label="Username" aria-describedby="basic-addon1">
          </div>
          <div class="input-group mb-3">
            <span style="width: 15%;" class="input-group-text" id="basic-addon1">Metalic</span>
            <div style="width: 85%;" class="btn-group" role="group" aria-label="Basic radio toggle button group">
              <input type="radio" class="btn-check" name="metalic" value="nie" id="btnradio1" autocomplete="off" checked>
              <label class="btn metalic_choose_btn" for="btnradio1">Nie</label>

              <input type="radio" class="btn-check" name="metalic" value="tak" id="btnradio2" autocomplete="off">
              <label class="btn metalic_choose_btn" for="btnradio2">Tak</label>
            </div>
          </div>
          <div class="input-group">
            <span class="input-group-text">Opis</span>
            <textarea name="opis" autocomplete="off" required style="resize: none;" class="form-control" aria-label="With textarea"></textarea>
          </div>
        </div>
        <div class="img_container_dodaj">
          <div class="mb-3">
            <input name="fileToUpload" required style="margin-top: 10px;" class="form-control" type="file" id="fileToUpload">
            <p>Format 100 x 100, wymagane rozszerzenie: .jpg / .jpeg / .png / .gif</p>
            <?php
                $uploadOk = 1;
              if (isset($_POST["submit"]) && $vinok == 1) {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                  $uploadOk = 1;
                } else {
                  echo "Plik nie jest obrazem!!!";
                  $uploadOk = 0;
                }
                // Check if file already exists
                $i=1;
                while(file_exists($target_file)) {
                  $i++;
                  if (file_exists($target_file)) {
                    $target_file = $target_dir . "(".$i.")". basename($_FILES["fileToUpload"]["name"]);
                  }
                }
                
                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 5242880) {
                  echo " Plik jest za duży!!!";
                  $uploadOk = 0;
                }
                
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                  echo " Złe rozszerzenie!!!";
                  $uploadOk = 0;
                }
                
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                  echo " Niestety twój plik nie został dodany.";
                  // if everything is ok, try to upload file
                } else {
                  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "Plik ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " został dodany.";
                  } else {
                    echo " Wystąpił błąd przy próbie dodania twojego zdjęcia.";
                  }
                }
              }
            ?>
          </div>
        </div>
      </div>
      <div class="submits_wrapper_dodaj">
        <button type="submit" name="submit" class="btn check_adding_btn">Dodaj</button>
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


