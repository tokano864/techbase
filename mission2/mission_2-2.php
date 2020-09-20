<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <form action=""method="post">
            <input type="text" name="comment"
            value="コメント">
            <input type="submit">
        </form>
        <?php
        $str=$_POST["comment"];
        if($str!=null){
        $fp=fopen("mission_2-4.txt","w");
        $str=$str.PHP_EOL;
        fwrite($fp,$str);
        fclose($fp);
        }
   
        ?>
    </body>
</html>