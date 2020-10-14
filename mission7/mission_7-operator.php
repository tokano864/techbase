<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>管理者ページ</title>
    </head>
    <body>
        <?php
            //初期化
            
            //ログインし終わっているかどうか
            $flag=false;
            $errmsg=null;
            //ログイン
                //値の取得
                
                    
                    $logname=$_POST["logname"];
                    $logpass=$_POST["logpass"];
                    if($logname==null&&$logpass==null){
                        $logname=$_POST["username"];
                        $logpass=$_POST["pass"];
                    }
                    
                //状態判定
                
                    $dsn='mysql:dbname=*******;host=******';
                    $user='******';
                    $password='******';
                    $pdo=new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));
                
                    //passとusernameがあっているか確認
                    $sql='SELECT * FROM user';
                    $stmt=$pdo->query($sql);
                    $results=$stmt->fetchAll();
                    foreach($results as $row){
                        if($row['username']==$logname&&$row['pass']==$logpass){
                            $flag=true;
                            $username=$row['username'];
                            $name=$row['name'];
                            $pass=$row['pass'];
                            break;
                        }else if($_POST["login"]||$_POST["delete"]){
                            $errmsg="ログインに失敗しました。IDとPasswordを再入力してください。";
                        }
                    }
                
             //削除機能
                    if($_POST["delete"]){
                        $sql = 'delete from post_table where post_id=:post_id';
                    	$stmt = $pdo->prepare($sql);
                    	$stmt->bindParam(':post_id', $_POST["deletenum"], PDO::PARAM_INT);
                    	$stmt->execute();
                    }
                
        ?>
        
        <!--ログイン-->
        <?php if($flag==false):?>
        <form action="" method="post">
            <h1 class="top-title">管理者ページへログイン</h1>
            <!--ログインフォーム-->
            <div>
                <input type="text"  class="name" name="logname">
            </div>
            <div>
                <input type="text" class="pass" name="logpass">
                <input type="submit" class="login-btn"name="login" value="ログイン">
            </div>
            <!--エラー表示-->
            <div class="login-error">
                <p><?php echo $errmsg;?></p>
            </div>
            <br>
  
        </form>
        <!--ログイン後-->
        <?php else:?>
        <!--見出し-->
        <h1>管理者専用ページ</h1>
        
        <!--データベースの取得-->
            <?php
                $sql='SELECT*FROM post_table';
                $stmt=$pdo->query($sql);
                $results=$stmt->fetchAll();
            ?>
            <?php foreach($results as $row):
                $num=$row['post_id'];?>
                <form class="delete" action="" method="post">
                    <label class="delete-id"><?php echo $num;?></label>
                    <label class="delete-name"><?php echo $row['recipe_name'];?></label>
                    <input type="submit" class="delete-btn" value="削除" name="delete">
                    <!--隠すもの-->
                    <input type="hidden" name="deletenum" value="<?php echo $num;?>">
                    <input type="hidden"  class="name" name="logname" value="<?php echo $logname;?>">
                    <input type="hidden" class="pass" name="logpass" value="<?php echo $logpass;?>">
                </form>
            <?php endforeach;?>
        <?php endif;?>
    </body>
</html>
