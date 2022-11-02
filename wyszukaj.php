<!-- All needed php code -->
<?php include('includes/basic_php.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
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
            <form action="#" method="POST">
                <select class="form-select" name="marka" onchange="this.form.submit()" style="margin-top: 100px;" aria-label="Default select example">
                    <option value=""></option>
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
                <select class="form-select" name="model" <?= (isset($_POST['marka'])) ? '' : 'disabled'?> onchange="this.form.submit()" style="margin-top: 10px;" aria-label="Default select example">
                <option></option>
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
                <select class="form-select" name="kolor" style="margin-top: 10px;" aria-label="Default select example">
                <option></option>
                    <?php
                        if(isset($_POST['marka'])){
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
            </form>
        </nav>
        <main class="finding_content">

        </main>
    </div>

    <!-- login form  -->
    <?php include('includes/login.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>
</html>