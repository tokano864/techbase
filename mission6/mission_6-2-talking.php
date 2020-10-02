<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>雑談部屋</title>
    </head>
    <body>
        <?php
            //DB接続
            $dsn='mysql:dbname=*******;host=*******';
            $user='*******';
            $password='*******';
            $pdo=new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));
            
            //table(talk)作成
            $sql="CREATE TABLE IF NOT EXISTS talk"
            ."("
            ."id INT AUTO_INCREMENT PRIMARY KEY,"
            ."username char(32),"
            ."name char(32),"
            ."comment TEXT,"
            ."time DATETIME"
            .")";
            $stmt=$pdo->query($sql);
            
            //値の初期化
            $username=null;
            $name=null;
            $pass=null;
            $comment=null;
            $errmsg=null;
            $flag=false;
            
            //前のページからユーザー情報を取得
            $username=$_POST["username"];
            $name=$_POST["name"];
            $pass=$_POST["pass"];
            if($username==null&&$name==null&&$pass==null){
                $username=$_POST["kpusername"];
                $name=$_POST["kpname"];
                $pass=$_POST["kppass"];
            }
            
            $comment=$_POST["comment"];
            
            //もしユーザー情報がない場合はメニュー画面に戻るそのほかはflagをつける
            if($username==null&&$name==null&&$pass==null){
                header("Location:mission_6-2-menulog.php");
            }else{
                if($comment!=null){
                    $flag="regist";
                }
            }
           
            //投稿
            if($_POST["regist"]){
                
                if($flag=="regist"){
                    $sql=$pdo->prepare("INSERT INTO talk (username,name,comment,time)
                                    VALUES (:username,:name,:comment,now())");
                    $sql->bindParam(':username',$username,PDO::PARAM_STR);
                    $sql->bindParam(':name',$name,PDO::PARAM_STR);
                    $sql->bindParam(':comment',$comment,PDO::PARAM_STR);
                    $sql->execute();
                }else{
                    $errmsg="コメントを入力して下さい。";
                }
            }
            
            /*
            //削除
            $sql='DROP TABLE talk';
            $stmt=$pdo->query($sql);
            */
        ?>
        
        <!--冒頭-->
        <h1>雑談部屋へようこそ</h1>
        <p>このページではキャラクターやストーリー、ガチャなど様々な話をする部屋です。
                    考察部屋で話す内容ではないなと思ったらこちらで話してください。</p>
        <p><?php echo $name;?>さん、こんにちは</p>
        
    
        <!--投稿フォーム-->
        <form action="" method="post">
            <div>投稿される際の名前：
                <input type="text" value="<?php echo $name;?>" readonly>
            </div>
            <div>コメント：
                <textarea name="comment" value="<?php echo $comment;?>" row=5></textarea>
            </div>
            
            <!--ユーザー情報格納-->
            <input type="hidden" name="kpusername" value="<?php echo $username;?>">
            <input type="hidden" name="kpname" value="<?php echo $name;?>">
            <input type="hidden" name="kppass" value="<?php echo $pass;?>">
            <input type="submit" name="regist">
        </form>  
        
        <!--削除フォーム-->
        <form action="" method="post"><br>
            <div>削除したい投稿番号：
                <input type="number" name="rmnum">
                <input type="submit" name="remove">
            </div>
        </form>
        
        <!--編集フォーム-->
        <form><br>
            <div>編集したい投稿番号：
                <input type="number" name="ednum">
                <input type="submit" name="edit">
            </div>
        </form>
        
        <div style="color:red;background:yerrow">
            <?php echo $errmsg;?>
        </div>
        <?php
            echo "<hr>";
            $sql='SELECT*FROM talk';
            $stmt=$pdo->query($sql);
            $results=$stmt->fetchAll();
            foreach($results as $row){
                echo $row['id'].'   ';
                echo $row['username'].'    ';
                echo $row['name'].'    ';
                echo $row['comment'].'    ';
                echo $row['time'].'<br>';
                echo "<hr>";
            }
        ?>
    </body>
</html>
