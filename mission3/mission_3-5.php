<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        
    </head>
    <body>
       <?php
            //宣言
            $filename="mission_3-5.txt";
            $num;
            $name=$_POST["name"];
            $comment=$_POST["comment"];
            $remove=$_POST["remove"];
            $edit=$_POST["edit"];
            $editnumber=$_POST["editnumber"];
            $editname;
            $editcomment;
            $pass=$_POST["pass"];
            $pass1=$_POST["pass1"];
            $pass2=$_POST["pass2"];
            
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
            $str=$num."<>".$name."<>".$comment."<>".$time."<>".$pass."<>".PHP_EOL;
            
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
                           $edittime=date("Y/m/d H:i:s");
                           $fstr=str_replace($s[1],$name,$fstr);
                           $fstr=str_replace($s[2],$comment,$fstr);
                           $fstr=str_replace($s[3],$edittime,$fstr);
                           $fstr=str_replace($s[4],$pass,$fstr);
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
                        if($s[0]==$edit&&$pass2==$s[4]){
                            $editname=$s[1];
                            $editcomment=$s[2];
                            $editpass=$s[4];
                        }else{
                            $editnumber=null;
                        }
                    }
                }else{      //削除
                    $fp=fopen($filename,"w+a");
                    foreach($fstr as $fstr){
                        
                        //区切り
                        $s=explode("<>",$fstr);
                        
                        //削除しない文の場合追記
                        if($s[0]!=$remove||$pass1==null||$pass1!=$s[4]){
                            fwrite($fp,$fstr);
                        }
                    }fclose($fp);
                }
           }   

     ?>
        <form action="" method="post">
            <div>名前　　　：
                <input type="text"  name="name" value="<?php echo $editname; ?>">
            </div>
            <div>コメント　：
                <input type="text"   name="comment" value="<?php echo $editcomment; ?>">
            </div>
            <div>password ：
                <input type="text"  name="pass" value="<?php echo $editpass; ?>">
                <input type="submit">
            </div>
            <input type="hidden" name="editnumber" value="<?php echo $edit; ?>">
        </form>
        
        <form action="" method="post">
            <div><br>削除対象番号：
                <input type="text" name="remove">
            </div>
            password　 ：
            <input type="text"  name="pass1">
            <input type="submit" value="削除">
        </form>
        <form action="" method="post">
            <div><br>編集対象番号：
                <input type="text"  name="edit">
            </div>
            password　 ：
            <input type="text"  name="pass2">
            <input type="submit" value="編集">
        </form>
      
     <?php
     $fstr=file($filename, FILE_IGNORE_NEW_LINES);
     foreach($fstr as $fstr){
         $s=explode("<>",$fstr);
         for($i=0;$i<3;$i++){
             echo $s[$i]."  ";
         }echo "<br>";
     }
     
           
     ?>
     
    </body>
</html>