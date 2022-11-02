<?php
    session_start();

    include 'includes/logowanie.php';
    $con = mysqli_connect($serwer, $user, $pass, $baza);
    if(!$con){
        echo "Nie połączone z bazą";
    }
    
    if (isset($_GET['wyloguj']) && $_GET['wyloguj'] == true) {
        session_destroy();
        $wylogowano = false;
        header("Location: index.php");
    }
    else{
        if(!isset($_SESSION['zalogowano'])){
            if(!empty($_POST['login']) && !empty($_POST['password'])){
                $query = "SELECT count(*) FROM users WHERE login = '".$_POST['login']."' AND haslo = '".$_POST['password']."'";
                $result = mysqli_query($con, $query);
                if(mysqli_fetch_row($result)[0] == 1){
                    $_SESSION['zalogowano'] = true;
                    echo '
                        <script type="text/javascript">
                            alert("Zalogowano pomyślnie");
                        </script>'; 
                    // header("Location: index.php");
                }else{
                    header("Location: ?error=1#loginform");
                }
            }
        }
    }
?>