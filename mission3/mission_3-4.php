<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        
    </head>
    <body>
       <?php
            //宣言
            $filename="mission_3-4.txt";
            $num;
            $name=$_POST["name"];
            $comment=$_POST["comment"];
            $remove=$_POST["remove"];
            $edit=$_POST["edit"];
            $editnumber=$_POST["editnumber"];
            $editname;
            $editcomment;
            
            //現時点での文字列の設定
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
            if($name!=null && $comment!=null && $editnumber==null){
                $fp=fopen($filename,"a");
                fwrite($fp,$str);
                fclose($fp);
            }
            
            //コメントの編集
            if($name!=null && $comment!=null && $editnumber!=null){
                $fp=fopen($filename,"w+a");
                    foreach($fstr as $fstr){
                       $s=explode("<>",$fstr);
                       if($s[0]==$editnumber){
                           $edittime=date("Y/m/d H:i:s").PHP_EOL;
                           $fstr=str_replace($s[1],$name,$fstr);
                           $fstr=str_replace($s[2],$comment,$fstr);
                           $fstr=str_replace($s[3],$edittime,$fstr);
                       }
                       fwrite($fp,$fstr);
                    }fclose($fp);
                    $editnumber=null;
            }
            
            if(file_exists($filename)){
                //ファイル読み込み
                $fstr=file($filename);
                
                if($remove==null){      //編集
                    foreach($fstr as $fstr){
                        //区切り
                        $s=explode("<>",$fstr);
                        
                        //編集番号はテキストフィールドに...
                        if($s[0]==$edit){
                            $editname=$s[1];
                            $editcomment=$s[2];
                        }
                    }
                }else{      //削除
                    $fp=fopen($filename,"w+a");
                    foreach($fstr as $fstr){
                        
                        //区切り
                        $s=explode("<>",$fstr);
                        
                        //削除しない文の場合追記
                        if($s[0]!=$remove){
                            fwrite($fp,$fstr);
                        }
                    }fclose($fp);
                }
           }   

     ?>
        <form action="" method="post">
            <div>名前：　　
            <input type="text"  name="name" value="<?php echo $editname; ?>"></div>
            <div>コメント：
            <input type="text"   name="comment" value="<?php echo $editcomment; ?>">
            <input type="submit"></div>
            <input type="hidden" name="editnumber" value="<?php echo $edit; ?>">
        </form>
        
        <form action="" method="post">
            <br>削除対象番号：
            <input type="text" name="remove">
            <input type="submit" value="削除">
        </form>
        <form action="" method="post">
            <br>編集対象番号：
            <input type="text"  name="edit">
            <input type="submit" value="編集">
        </form>
      
     <?php
     $fstr=file($filename, FILE_IGNORE_NEW_LINES);
     foreach($fstr as $fstr){
         $s=explode("<>",$fstr);
         foreach($s as $s){
             echo $s."  ";
         }echo "<br>";
     }
     
           
     ?>
     
    </body>
</html>