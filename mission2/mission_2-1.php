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
            echo $str."を受け付けました。";
        }
        ?>
    </body>
</html>