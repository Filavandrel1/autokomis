<!-- All needed php code -->
<?php include('includes/basic_php.php');?>

<?php
    if(isset($_GET['added'])){
        if($_GET['added'] == 'true'){
            echo '
                <script type="text/javascript">
                    alert("Dodano pomyślnie");
                </script>
                ';
            $result = mysqli_query($con, $_GET['query']);
        }
    }
    if(isset($_GET['comunicat']) && $_GET['comunicat'] == "niezalogowany"){
        echo "<script>alert('BŁĄD! Jesteś niezalogowany!');</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autokomis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
</head>
<body id="index" onload="zmiana()">
    <div id="container_bi"></div>
    <div style="z-index: 1;" id="logo">
        <p class="logo">AUTOKOMIS</p>
        <p class="logo">MAX</p>
    </div>
    <?php if(isset($_SESSION['zalogowano'])){ ?>
        <ul class="nav justify-content-center navbar_autokomis">
            <li class="nav-item">
                <a href="wyszukaj.php"><button type="button" class="btn btn-outline-primary navbar_btn">WYSZUKAJ</button></a>
            </li>
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
        </ul>
    <?php }else { ?>
        <ul class="nav justify-content-center navbar_autokomis">
            <li class="nav-item">
                <a href="wyszukaj.php"><button type="button" class="btn btn-outline-primary navbar_btn">WYSZUKAJ</button></a>
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
        </ul>
    <?php } ?>

    <?php include('includes/login.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>
</html>