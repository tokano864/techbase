<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <form action=""method="post">
            <div>名前：　　<input type="text"
            name="name"></div>
            <div>コメント：<input type="text" 
            name="comment"></div>
            </tr>
            <input type="submit">
        </form>
        <?php
            $filename="mission_3-2.txt";
            $name=$_POST["name"];
            $comment=$_POST["comment"];
            $time=date("Y/m/d H:i:s");
            $fstr=file($filename);
            $num=1;
            foreach($fstr as $s){
                $num++;
            }
            if($name!=null){
                
              $fp=fopen($filename,"a");
              $str=$num."<>".$name."<>".$comment."<>".$time.PHP_EOL;
                fwrite($fp,$str);
                fclose($fp);
               
            }
           
            
        ?>
    </body>
</html>