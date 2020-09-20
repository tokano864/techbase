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
            name="comment">
            <input type="submit"></div>
        </form>
        <form action=""method="post">
            <div><br>削除対象番号：<input type="text"
            name="remove">
            <input type="submit" value="削除"></div>
        </form>
       <?php
            //宣言
            $filename="mission_3-3.txt";
            $name=$_POST["name"];
            $comment=$_POST["comment"];
            $remove=$_POST["remove"];
            $edit=$_POST["edit"];
            
            //文字列の設定
            $time=date("Y/m/d H:i:s");
            $fstr=file($filename);
            //投稿番号の設定
            $num=1;
            foreach($fstr as $st){
                $s=explode("<>",$st);
                $num=(int)$s[0];
                $num++;
            }
            //文字列の連結
            $str=$num."<>".$name."<>".$comment."<>".$time.PHP_EOL;

            //コメントの追加
            if($name!=null){
                $fp=fopen($filename,"a");
                fwrite($fp,$str);
                fclose($fp);
            }
            
            if(file_exists($filename)){
                //ファイル読み込み
                $fstr=file($filename);
                $fp=fopen($filename,"w+a");
                //文字列の表示
                foreach($fstr as $str){
                    $s=explode("<>",$str);
                    if($s[0]!=$remove){
                        fwrite($fp,$str);
                        foreach($s as $s){
                            echo $s."  ";
                        }
                        echo "<br>";
                    }
                }   
                $fclose($fp);
            }
    
        ?>
    </body>
</html>