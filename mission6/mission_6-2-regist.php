<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ようこそ</title>
    </head>
    
    <body>
        <?php
            //DB接続
            $dsn='mysql:dbname=tb220531db;host=localhost';
            $user='tb-220531';
            $password='mTRmcFfg8Y';
            $pdo=new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));
            
            //user(DBテーブル)を作成
            $sql="CREATE TABLE IF NOT EXISTS user"
            ."("
            ."id INT AUTO_INCREMENT PRIMARY KEY,"
            ."username char(32),"
            ."name char(32),"
            ."pass char(32)"
            .");";
            $stmt=$pdo->query($sql);
            
            //フォーム初期化
            $username=$_POST["username"];
            $name=$_POST["name"];
            $pass=$_POST["pass"];
            $errmsg=null;
            $success=null;
            $flag=true;
            if($_POST["regist"]){
                //パスワードが規定の文字列か
                if($pass==null){
                    $errmsg="Passwprdを入力してください。";
                    $flag=false;
                }else if(!preg_match("/^[a-zA-Z0-9]+$/", $pass)){
                    $errmsg="Passwordは半角英数字で入力してください。";
                    $flag=false;
                }
                
                //IDが規定の文字列か
                if($username==null){
                    $errmsg="IDを入力してください。";
                    $flag=false;
                }else if(!preg_match("/^[a-zA-Z0-9]+$/", $username)){
                    $errmsg="IDは半角英数字で入力してください。";
                    $flag=false;
                }
                
                //nameがなにも記載されていない場合名無し太郎と代入
                if($name==null){
                    $name="名無し太郎";
                }
                
                //IDがすでに使用されていないか
                    $sql='SELECT * FROM user';
                    $stmt=$pdo->query($sql);
                    $results=$stmt->fetchAll();
                    foreach($results as $row){
                        if($row['username']==$username){
                            $flag=false;
                            $errmsg="入力されたIDはすでに使われています。";
                            break;
                        }
                    }
                
                //
                //DBにユーザー情報を登録
                    if($flag==true){
                        $sql=$pdo->prepare("INSERT INTO user (username,name,pass)
                                VALUES (:username,:name,:pass)");
                        $sql->bindParam(':username',$username,PDO::PARAM_STR);
                        $sql->bindParam(':name',$name,PDO::PARAM_STR);
                        $sql->bindParam(':pass',$pass,PDO::PARAM_STR);
                        $sql->execute();
                        $success="ID：".$username
                            ."      Name：".$name
                            ."      Password：".$pass
                            ."      で登録しました。";
            }
            }
        ?>
        <!--冒頭-->
        <h1>ユーザー情報登録</h1>
        <!--ユーザー登録フォーム-->
        <form action="" method="post">
            <p>アカウントIDと掲示板で使用する名前、パスワードを登録してください。</p>
            <p>アカウントIDとパスワードは半角英数字で入力してください。</p>
            <div>ID：
                <input type="text" name="username">
            </div>
            <div>Name：
                <input type="text" name="name" placeholder="名無し太郎">
            </div>
            <div>Password：
                <input type="text" name="pass">
                <input type="submit" name="regist" value="登録">
            </div>
            <!--処理-->
            <strong>
            <div style="color:red;background:yellow">
                <?php echo $errmsg;?>
            </div>
            <div style="color:blue">
                <?php echo $success;?>
            </div>
            </strong>
        </form>
        
        <!--メニュー画面へ遷移-->
        <br>
        <a href="https://portal.tech-base.net/storage/mission0/JnfAM3xqKh1j0ItoXst1UGQvGV4QRJ9Ck4gGisJm/mission_6-2-menulog.php">
            登録が済んでいる方はこちら
        </a>
        
    </body>
</html>