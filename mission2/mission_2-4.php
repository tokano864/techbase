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
        $fp=fopen("mission_2-4.txt","a");
        $str=$str.PHP_EOL;
        fwrite($fp,$str);
        fclose($fp);
        }
        if(file_exists("mission_2-4.txt")){
            $s=file("mission_2-4.txt"
            ,FILE_IGNORE_NEW_LINES);
            foreach($s as $st){
            echo $st."<br>";}
        }
        ?>
    </body>
</html>