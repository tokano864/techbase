<!DOCTYPE html>
<html   lang="ja">
    <head>
        <meta   charset="utf8">
        <title>お試し掲示板</title>
    </head>
    
    <body>
        <h1>掲示板</h1>
        <?php
            
            //DB接続
            $dsn='mysql:dbname=******;host=******';
            $user='******';
            $dbpass='******';
            $pdo=new PDO($dsn,$user,$dbpass,
                    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));
                    
            //テーブル作成
            $sql="CREATE TABLE IF NOT EXISTS test"
            ."("
            ."id INT AUTO_INCREMENT PRIMARY KEY,"
            ."name char(32),"
            ."comment TEXT,"
            ."pass char(32),"
            ."time DATETIME"
            .");";
            $stmt=$pdo->query($sql);
            
            
            //フォームからの取得
            $name=$_POST["name"];
            $comment=$_POST["comment"];
            $pass=$_POST["pass"];
            $remove=$_POST["remove"];
            $rmpass=$_POST["rmpass"];
            $edit=$_POST["edit"];
            $edpass=$_POST["edpass"];
            $setedit=$_POST["setedit"];
            
            //編集、削除する番号を判別、判別するパスワードの取得
            $num=null;
            $sspass=null;
            $flag=null;
            if($remove!=null&&$rmpass!=null){
                $num=$remove;
                $sspass=$rmpass;
                $flag="remove";
            }
            if($edit!=null&&$edpass!=null){
                $num=$edit;
                $sspass=$edpass;
                $flag="edit";
            }
            
            
            //投稿の登録(名前、コメントが入力されている場合のみ)
            if($name!=null && $comment!=null && $setedit==null){
            $sql=$pdo->prepare("INSERT INTO test(name,comment,pass,time)
            VALUE(:name,:comment,:pass,now())");
            $sql->bindParam(':name',$name,PDO::PARAM_STR);
            $sql->bindParam(':comment',$comment,PDO::PARAM_STR);
            $sql->bindParam(':pass',$pass,PDO::PARAM_STR);
            $sql->execute();
            }
            
            //削除、編集フォームのパスワードがあっているか判定
            $success=false;
            if($flag!=null){
                $sql='SELECT*FROM test WHERE id=:id';
                $stmt=$pdo->prepare($sql);
                $stmt->bindParam(':id',$num,PDO::PARAM_INT);
                $stmt->execute();
                $result=$stmt->fetchAll();
                foreach($result as $row){
                    if($sspass=$row['pass']){
                        $success=true;
                    }
                }
            }
            
            //削除機能
            if($flag=="remove" &&$success=true){
                $sql = 'delete from test where id=:id';
            	$stmt = $pdo->prepare($sql);
            	$stmt->bindParam(':id', $num, PDO::PARAM_INT);
            	$stmt->execute();
            }
            
     
            //編集のためのフォームセット
            if($flag=="edit" &&$success==true){
               $sql='SELECT*FROM test WHERE id=:id';
                $stmt=$pdo->prepare($sql);
                $stmt->bindParam(':id',$num,PDO::PARAM_INT);
                $stmt->execute();
                $result=$stmt->fetchAll();
                foreach($result as $row){
                    $edname=$row['name'];
                    $edcomment=$row['comment'];
                    $setedit=$num;
                }
            }
            
            //編集機能
            if($name!=null && $comment!=null && $setedit!=null){
                $sql='UPDATE test SET name=:name,comment=:comment,pass=:pass 
                        WHERE id=:id';
                $stmt=$pdo->prepare($sql);
                $stmt->bindParam(':name',$name,PDO::PARAM_STR);
                $stmt->bindParam(':comment',$comment,PDO::PARAM_STR);
                $stmt->bindParam(':pass',$pass,PDO::PARAM_STR);
                $stmt->bindParam(':id',$setedit,PDO::PARAM_INT);
                $stmt->execute();
                $setedit=null;
                $edit=null;
            }
            
            /*
            //テーブル削除
            $sql='DROP TABLE test';
            $stmt=$pdo->query($sql);
            */
        ?>
        
        <!--投稿フォーム-->
        <form action="" method="post">
            <div>名前：&ensp;&ensp;&ensp;&ensp;&ensp;
                <input type="text" name="name" value="<?php echo $edname;?>">
            </div>
            <div>コメント：&ensp;
                <input type="text" name="comment" value="<?php echo $edcomment;?>">
            </div>
            <div>password：
                <input type="text" name="pass" value="<?php echo $edpass;?>">
                <input type="submit">
            </div>
            <input type="hidden" name="setedit" value="<?php echo $setedit;?>">
        </form> 
        
        <!--削除フォーム-->
        <form action="" method="post">
            <div><br>削除対象番号：
                <input type="number" name="remove">
            </div>
            <div>password：&ensp;&ensp;&thinsp;&thinsp;
                <input type="text" name="rmpass">
                <input type="submit">
            </div>
        </form>
        
       <!--編集フォーム-->
        <form action="" method="post">
            <div><br>編集対象番号：
                <input type="number" name="edit">
            </div>
            <div>password：&ensp;&ensp;&thinsp;&thinsp;
                <input type="text" name="edpass">
                <input type="submit">
            </div>
        </form>
        <?php
            echo "<hr>";
            $sql='SELECT*FROM test';
            $stmt=$pdo->query($sql);
            $results=$stmt->fetchAll();
            foreach($results as $row){
                echo $row['id'].'   ';
                echo $row['name'].'    ';
                echo $row['comment'].'    ';
                echo $row['time'].'<br>';
                echo "<hr>";
            }
        ?>
    </body>
    
</html>
