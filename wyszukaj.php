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
    <br>
    <br>
    <br>
    <br>
    <br>
    <form method="post">
        Marka:
        <select name="marka" id="" style="width: 100px;">
        <?php
            echo "<option value='0'></option>";
            $query = "SELECT DISTINCT(marka) from auto";
            $result = mysqli_query($con, $query);
            while($option = mysqli_fetch_assoc($result)){
                echo '<button type="submit" formaction="#"><option>'.$option['marka'].'</option></button>';
            }
        ?>
        </select>
        <input type="submit" value="wyślij">
    </form>
    <form action="wyszukaj.php" method="post">
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
        Kolor: <br>
        <?php
            if(isset($_POST['marka'])){
                $query = "SELECT DISTINCT(kolor) from auto where marka = '".$_POST['marka']."'";
                $result = mysqli_query($con, $query);
                while($option = mysqli_fetch_assoc($result)){
                    echo "<input type='radio' name='kolor'  value='".$option['kolor']."'>".$option['kolor'];
                }
            }
        ?>
        <br>
        <input type="number" name="od" id="">
        <input type="number" name="do" id="">
        <br>    
        <input type="submit" value="wyślij">
        <input type="reset" value="reset">
    </form>
    <?php
        if(isset($_POST['model'])){
            $model = $_POST['model'];
        }
        if(isset($_POST["kolor"])){
            $kolor = $_POST["kolor"];
        }
        if(!empty($_POST["od"])){
            $od = (int)$_POST["od"];
        }
        else{
            $od = 0;
        }
        if(!empty($_POST["do"])){
            $do = (int)$_POST["do"];
        }
        else{
            $do = 1000000;
        }
        if(!empty($_POST["kolor"])){
            $query = "SELECT * from auto where model like '$model' and kolor like '$kolor' and rok between $od and $do";
        }
        else{
            @$query = "SELECT * from auto where model like '$model' and rok BETWEEN $od AND $do";
        }
        if(!empty($model)){

            $result = mysqli_query($con, $query);
            while($row = mysqli_fetch_assoc($result)){
                echo "<br>";
                echo $row['marka']." ".$row['model']." ".$row['kolor']." ".$row['VIN']." ".$row['rok'];
            }
        }
    ?>

    <!-- login form  -->
    <?php include('includes/login.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>
</html>