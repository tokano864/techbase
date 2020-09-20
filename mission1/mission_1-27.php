<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_1-21</title>
</head>
<body>
    <form action="" method="post">
        <input type="number" name="num">
        <input type="submit">
    </form>
    <?php
        $num = $_POST["num"];
       
    $filename="mission_1-25.txt";
     
    if($num!=null){
        $fp = fopen($filename,"a");
        if ($num % 3 == 0 && $num % 5 == 0) {
            echo "FizzBuzz<br>";
        } elseif ($num % 3 == 0) {
            echo "Fizz<br>";
        } elseif ($num % 5 == 0) {
            echo "Buzz<br>";
        } else {
            echo $num . "<br>";
        }
    fwrite($fp, $num );
     echo "書き込み成功";
     fclose($fp);
    }
    ?>
</body>
</html>