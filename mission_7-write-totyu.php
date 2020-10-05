<!doctype html>
<html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>タイトル</title>
  </head>
  <body>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
 
    <!--ログインしているかどうか判定、-->
 
    <!--データベース接続およびお試しのための名前の宣言-->
        <?php
            $dsn = 'mysql:dbname=tb220531db;host=localhost';
	        $user = 'tb-220531';
	        $password = 'mTRmcFfg8Y';
	        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

            //値の受け渡しがないのでとりあえず名無し太郎という投稿者名にする
                $name="名無し太郎";
        ?>
        
    <!--検索機能-->

    <!--カテゴリー一覧表示機能-->

    <!--投稿機能-->
    <?php
        //テーブル作成
            $sql="CREATE TABLE IF NOT EXISTS recipe"
                    ."("
                    ."id INT AUTO_INCREMENT PRIMARY KEY,"
                    ."name char(32),"
                    ."food TEXT,"
                    ."img BLOB,"
                    ."recipe TEXT,"
                    ."category char(32),"
                    ."time DATETIME,"
                    ."ext varchar(5)"
                    .")";
    
        //ボタンが押されたとき
        if($_POST["write"]){
            //formから投稿する内容を取得
                $name=$_POST["name"];   //投稿者
                $food=$_POST["food"];   //料理名
                $recipe=$_POST["recipe"];   //レシピ(本文)
                $foodcategory=$_POST["foodcategory"];   //カテゴリー
                //画像の取得
                    $upfile=$_FILES["img"]["tmp_name"];
                    $img=file_get_contents($upfile);
                    $ext=pathinfo($upfile,PATHINFO_EXTENSION);
            /*
            //テーブルへ入力
                $sql="INSERT INTO recipe (name,food,img,recipe,category,time,ext)
                        VALUE (:name,:food,:img,:recipe,:category,now(),:ext)";    
                $sql->bindParam(':name',$name,PDO::PARAM_STR);
                $sql->bindParam(':food',$food,PDO::PARAM_STR);
                $sql->bindParam(':recipe',$recipe,PDO::PARAM_STR);
                $sql->bindParam(':category',$foodcategory,PDO::PARAM_STR);
                $sql->bindParam(':ext',$ext);
                $sql->bindParam(':img',$img);
            
            *//*
          //動作確認    
            //表示
            $contents_type=array(
                'jpg' => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'png' => 'image/png',
                'gif' => 'image/gif',
                'bmp' => 'image/bmp',
                );
            $sql='SELECT * FROM recipe';
            $stmt=$pdo->query($sql);
            $results=$stmt->fetchObject();
            foreach($results as $row){
                echo $row->id;
                echo $row->name;
                echo $row->food;
                echo $row->recipe;
                echo $row->category;
                echo $row->time;
                header('Content-type:'.$contents_type[$row->ext]);
                echo $row->contents;
            }
            */
            /* 
             //テーブル削除
             $sql='DROP TABLE recipe';
             $stmt=$ppdo->query($sql);
             */
         }
    ?>


    <!--メニューバー-->
    <header class="top">
        <div class="container">
            <h1 class="header-title">
                <a href="">タイトル</a>
            </h1>
            <label for="menu" class="menu-button">
                <i class="fas fa-bars"></i> Menu
            </label>
        </div>
    </header>
    

    <!-- ナビゲーションバー -->
    <nav class="nav-bar">
      <label for="menu" class="close">
        <i class="fas fa-times-circle"></i>閉じる
      </label>
      <ul class="login">
        <li>
          <a href="#">ユーザー登録</a>
        </li>
        <li>
          <a href="#">ログイン</a>
        </li>
        <li>
          <a href="#">レシピ投稿</a>
        </li>
        <li>
          <a href="#">管理者専用</a>
        </li>
      </ul>
    </nav>

    <!--カテゴリー一覧-->
    <section class="category">
        <div class="container">
            <p class="category-title">カテゴリー一覧</p>
            <ul class="category-all">
                <!--PHPにて表示-->
                <li>カテゴリー</li>
            </ul>
        </div>
    </section>
    
    <div class="main">
        <section class="serch">
            <!--検索フォーム-->
            <form action="" class="serch">
                <input type="text" name="serch" class="serch-text">
                <input type="submit" class="serch-btn">
            </form>
            <!--検索結果表示-->
                <div class="serch-result">
                    <p class="serch-title">検索結果</p>
                    <a href="#" class="serch-food">料理名</a>
                    <p class="serch-writer">投稿者</p>
                    <img class="serch-img" src="#" alt="#" title="#"/>
                </div>
            <form>
                <!--PHPにて表示-->
            </form>
        </section>
        <section class="write-form">
            <div class="container">
                <form action="" method="post" enctype="multipart/form-data" class="write-form">
                    <!--foodnameは名前、foodは料理名、foodimgは画像、
                        recipeはレシピ(本文)、foodcategoryはカテゴリー-->
                    <input type="text" name="name" value="<?php echo $name;?>">
                    <input type="text" name="food" class="food-input">
                    <input type="file" name="foodimg" class="food-img" accept="image/*">
                    <textarea name="recipe" class="recipe"></textarea>
                    <input type="text" name="foodcategory" class="food-category">
                    <input type="submit" name="write" class="recipebtn">
                </form>
            </div>
        </section>
    </div>
    
    <footer>
        <div class="container">
            <small>&copy; ○○○</small>
        </div>
    </footer>

  </body>
</html>