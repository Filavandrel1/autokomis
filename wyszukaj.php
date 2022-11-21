<!-- All needed php code -->
<?php 
    include('includes/basic_php.php');
    if(isset($_GET['comunicat']) && $_GET['comunicat'] == "usunieto"){
        header("Location: wyszukaj.php");
        echo "<script>alert('Usunięto pomyślnie');</script>";
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
<body id="finding">
    <ul class="nav justify-content-center navbar_autokomis">
        <li class="nav-item">
            <a href="index.php"><button type="button" class="btn btn-outline-primary navbar_btn">STRONA GŁÓWNA</button></a>
        </li>
        <?php if(isset($_SESSION['zalogowano'])){ ?>
            <li class="nav-item">
                <a href="dodaj.php">
                    <button
                        type="button" class="btn btn-outline-primary navbar_btn">DODAJ
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
        <?php }else { ?>
            <li class="nav-item">
                <a href="#loginform">
                    <button
                        type="button" class="btn btn-outline-primary navbar_btn locked_btn"><span class="material-symbols-outlined">lock</span>
                    </button>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="#loginform">  
                    <button
                        type="button" class="btn btn-outline-primary navbar_btn">ZALOGUJ
                    </button>
                </a>
            </li>
        <?php } ?>
    </ul>
    <div class="finding_container">
        <nav class="finding_nav">
            <form action="#" name="finding" id="form1" method="POST">
                <p style="font-size: 8px; width: 100%; text-align: center;">Możliwość wybrania poszczególnych pól</p>
                <span class="finding_text">Marka:</span>
                <select class="form-select" name="marka" onchange="finding.submit()" aria-label="Default select example">
                    <option value="empty"></option>
                    <?php
                        $query = "SELECT DISTINCT(marka) from auto";
                        $result = mysqli_query($con, $query);
                        while($row = mysqli_fetch_array($result)){
                    ?>
                    <option <?=(isset($_POST['marka']) && $_POST['marka'] == $row['marka']) ? 'selected' : '' ;?>><?=$row['marka']?></option>';
                    <?php
                        }
                    ?>
                    
                </select>
                <span class="finding_text">Model:</span>
                <select class="form-select" name="model" <?= (isset($_POST['marka']) && $_POST['marka'] != "empty") ? '' : 'disabled'?> onchange="this.form.submit()" aria-label="Default select example">
                <option value="empty"></option>
                    <?php
                        $query = "SELECT DISTINCT(model) from auto WHERE marka = '{$_POST['marka']}'";
                        $result = mysqli_query($con, $query);
                        while($row = mysqli_fetch_array($result)){
                    ?>
                    <option <?=(isset($_POST['model']) && $_POST['model'] == $row['model']) ? 'selected' : '' ;?>><?=$row['model']?></option>';
                    <?php
                        }
                    ?>
                </select>
                <span class="finding_text">Kolor:</span>
                <select class="form-select" name="kolor"  aria-label="Default select example">
                <option></option>
                    <?php
                        if(isset($_POST['marka']) && $_POST['marka'] != 'empty'){
                            $query = "SELECT DISTINCT(kolor) from auto WHERE marka = '{$_POST['marka']}'".((isset($_POST['model']) && $_POST['model'] != "") ? "AND model = '{$_POST['model']}'" : "");
                        }
                        else{
                            $query = "SELECT DISTINCT(kolor) from auto";
                        }
                        $result = mysqli_query($con, $query);
                        while($row = mysqli_fetch_array($result)){
                    ?>
                    <option <?=(isset($_POST['kolor']) && $_POST['kolor'] == $row['kolor']) ? 'selected' : '' ;?>><?=$row['kolor']?></option>';
                    <?php
                        }
                    ?>
                </select>
                <span class="finding_text">Rok produkcji:</span>
                <div class="from_to_finding">
                    <input type="number" name="production_from" value="<?=(isset($_POST['production_from'])) ? $_POST["production_from"] : null;?>" placeholder="Od:" id="" class="finding_production_range">
                    <span style="font-size:1.5rem; padding:5px;">-</span>
                    <input type="number" name="production_to" value="<?=(isset($_POST['production_to'])) ? $_POST["production_to"] : null;?>" placeholder="Do:" id="" class="finding_production_range">
                </div>
                <span class="finding_text">Metalic:</span>
                <div style="width: 100%; height:50px; margin-bottom:20px;" class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="metalic" value="-" id="btnradio1" autocomplete="off" checked>
                    <label class="btn btn-sm metalic_choose_btn_finding" for="btnradio1">-</label>
                    <input type="radio" class="btn-check" name="metalic" <?=((isset($_POST['metalic']) && $_POST['metalic'] == "nie") ? 'checked' : '')?> value="nie" id="btnradio2" autocomplete="off">
                    <label class="btn btn-sm metalic_choose_btn_finding" for="btnradio2">Nie</label>
                    <input type="radio" class="btn-check" name="metalic" <?=((isset($_POST['metalic']) && $_POST['metalic'] == "tak") ? 'checked' : '')?> value="tak" id="btnradio3" autocomplete="off">
                    <label class="btn btn-sm metalic_choose_btn_finding" for="btnradio3">Tak</label>
                </div>
                <input type="text" hidden name="submits" value="submit" id="">
            </form>
            <div class="button_container_finding">
                <button style="margin-right:20px;" type="button" onclick="finding.submit()" class="btn check_login_btn">Zatwierdź</button>
            </div>
        </nav>
        <div class="finding_content">
            <?php
                $query = "SELECT * FROM auto ";
                $query_help = "WHERE "; 
                if (isset($_POST['submits'])) {
                    if(isset($_POST['marka']) && $_POST['marka'] != "empty"){
                        $query_help .= "marka = '{$_POST['marka']}'";
                        if(isset($_POST['model']) && $_POST['model'] != "empty"){
                            $query_help .= " ".(($query_help == "WHERE ") ? '' : 'AND ')." model = '{$_POST['model']}'";
                        }
                    }

                    if(isset($_POST['kolor']) && $_POST['kolor'] != ""){
                        $query_help .= " ".(($query_help == "WHERE ") ? '' : 'AND ')."kolor = '{$_POST['kolor']}'";
                    }

                    if(isset($_POST['production_from']) && $_POST['production_from'] != ""){
                        if(isset($_POST['production_to']) && $_POST['production_to'] != ""){
                            $query_help .= " ".(($query_help == "WHERE ") ? '' : 'AND ')."rok BETWEEN {$_POST['production_from']} AND {$_POST['production_to']}";
                        }
                        else{
                            $query_help .= " ".(($query_help == "WHERE ") ? '' : 'AND ')."rok >= {$_POST['production_from']}";   
                        }
                    }
                    elseif (isset($_POST['production_to']) && $_POST['production_to'] != "") {
                        $query_help .= " ".(($query_help == "WHERE ") ? '' : 'AND ')."rok <= {$_POST['production_to']}";
                    }
                    
                    if($_POST['metalic'] != "-"){
                        $query_help .= " ".(($query_help == "WHERE ") ? '' : 'AND ')."metalic = '{$_POST['metalic']}'";
                    }

                    if($query_help == "WHERE "){
                        $query_help = "";
                    }
                    $query .= $query_help;
                }
                $result = mysqli_query($con, $query);
                while($row = mysqli_fetch_assoc($result)){
            ?>
                    <div class="ad">
                        <div class="img_content">
                            <img src="<?=$row['zdjecie']?>" alt="Błąd" height="100px" width="100px">
                        </div>
                        <div class="ad_content">
                            <div class="ad_content_all">
                            <p class="addingform_attribute">Marka: <?=$row['marka']?></p> 
                            <p class="addingform_attribute">Model: <?=$row['model']?></p>
                            <p class="addingform_attribute">Rok produkcji: <?=$row['rok']?></p>
                            <p class="addingform_attribute">vin: <?=$row['VIN']?></p>
                            <p class="addingform_attribute">Kolor: <?=$row['kolor']?></p>
                            <p class="addingform_attribute">metalic: <?=$row['metalic']?></p>
                            </div>
                            <div style="height: 200px;" class="ad_content_describe">
                            <h3>Opis:</h3>
                            <?=$row['opis']?>
                            </div>
                            <?php
                                if(isset($_SESSION['zalogowano'])){
                            ?>
                            <div class="buttton_container">
                                <a href="usun.php?usun=<?=$row['VIN']?>"><button type="button" class="btn check_login_btn">Usuń</button></a>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
            <?php
                }
            ?>

        </div>
    </div>
    
    <!-- login form  -->
    <?php include('includes/login.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>
</html>