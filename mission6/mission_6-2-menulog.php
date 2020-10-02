<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>メニュー</title>
    </head>
    <body>
        <?php
            //初期化
            
            //ログインし終わっているかどうか
            $flag=false;
            $success="ログインに成功しました。";
            $errmsg=null;
            //ログイン
                //値の取得
                    $logname=$_POST["logname"];
                    $logpass=$_POST["logpass"];
                //状態判定
                if($_POST["login"]){
                    $dsn='mysql:dbname=tb220531db;host=localhost';
                    $user='tb-220531';
                    $password='mTRmcFfg8Y';
                    $pdo=new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));
                
                    //passとusernameがあっているか確認
                    $sql='SELECT * FROM user';
                    $stmt=$pdo->query($sql);
                    $results=$stmt->fetchAll();
                    foreach($results as $row){
                        if($row['username']==$logname&&$row['pass']==$logpass){
                            $flag=true;
                            $success="ログインに成功しました。";
                            $username=$row['username'];
                            $name=$row['name'];
                            $pass=$row['pass'];
                            break;
                        }else{
                            $errmsg="ログインに失敗しました。IDとPasswordを再入力してください。";
                        }
                    }
                }
        ?>
        
        <!--ログイン-->
        <?php if($flag==false):?>
        <form action="" method="post">
            <h1>ログイン</h1>
            <p>アカウントIDとパスワードを入力してください。</p>
            <div>ID：
                <input type="text" name="logname" value="<?php echo $logname;?>">
            </div>
            <div>Password：
                <input type="text" name="logpass" value="<?php echo $logpass;?>">
                <input type="submit" name="login" value="ログイン">
            </div>
            <div style="color:red;background:yellow"><strong>
                <p><?php echo $errmsg;?></p></strong>
            </div>
            <br>
            <a href="https://portal.tech-base.net/storage/userfile/u44610/mission_6-2-regist.php">
            登録が済んでいない方はこちら
            </a>
        </form>
        <!--menu-->
        <?php else:?>
            <!--冒頭-->
            <div style="color:blue"><strong><?php echo $success;?></strong></div>
            <p><?php echo $name;?>さんこんにちは</p>
             
            <!--考察フォーム-->
            <form action="mission_6-2-thinking.php" method="post">
                <h2>考察部屋</h2>
                    <p>このページでは世界観やストーリー、キャラクターなどのゲームの考察を話しあう部屋です。ゲームの内容であればどのような考察でも大丈夫です。</p>
                    <input type="hidden" name="username" value="<?php echo $username;?>">
                    <input type="hidden" name="name" value="<?php echo $name;?>">
                    <input type="hidden" name="pass" value="<?php echo $pass;?>">
                    <input type="submit" value="考察部屋に飛ぶ">
            </form>
            <form action="mission_6-2-talking.php" method="post">
                    <h2>雑談部屋</h2>
                    <p>このページではキャラクターやストーリー、ガチャなど様々な話をする部屋です。
                    考察部屋で話す内容ではないなと思ったらこちらで話してください。</p>
                    <input type="hidden" name="username" value="<?php echo $username;?>">
                    <input type="hidden" name="name" value="<?php echo $name;?>">
                    <input type="hidden" name="pass" value="<?php echo $pass;?>">
                    <input type="submit" value="雑談部屋へ飛ぶ">
                </form>
        <?php endif;?>
    </body>
</html>