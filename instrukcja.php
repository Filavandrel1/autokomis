<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    body{
      background-color: black;
    }
    div{
      width: 80%;
      height: 80vh;
      margin: 0 auto;
      background-color: #999;
      border: 1px solid black;
      padding: 50px;
      font-size: 20px;
      border-radius: 50px;
      color: white;
    }
  </style>
</head>
<body>
  <div>
    <?php
    $plik = fopen("README.txt", "r");
    if ($plik) {
        while (($line = fgets($plik)) !== false) {
    ?>
    <p><?= $line?></p>
    <?php
        }
    
        fclose($plik);
    }
    ?>
  </div>
</body>
</html>