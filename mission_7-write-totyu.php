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
            $dsn = 'mysql:dbname=*****;host=*******';
	        $user = '*****';
	        $password = '*********';
	        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

            //値の受け渡しがないのでとりあえず名無し太郎という投稿者名にする
                $name="名無し太郎";
                $userid=1;
        ?>
        
    <!--検索機能-->

    <!--カテゴリー一覧表示機能-->

    <!--投稿機能-->
    <?php
        //テーブル作成(recipe)
            $sql="CREATE TABLE IF NOT EXISTS recipe"
                    ."("
                    ."id INT AUTO_INCREMENT PRIMARY KEY,"
                    ."user_id INT,"
                    ."user_name char(32),"
                    ."food TEXT,"
                    ."recipe TEXT,"
                    ."category ENUM('イタリアン','トルコ料理','日本食','中華料理','フランス料理','韓国料理','インド料理','その他'),"
                    ."time DATE"
                    .")";
            $stmt=$pdo->query($sql);
    
        //ボタンが押されたとき
        if($_POST["write"]){
            //formから投稿する内容を取得
                $userid=$_POST["userid"];
                $name=$_POST["name"];   //投稿者
                $food=$_POST["food"];   //料理名
                $recipe=$_POST["recipe"];   //レシピ(本文)
                $foodcategory=$_POST["foodcategory"];   //カテゴリー
        
            //データの入力
            $sql=$pdo->prepare("INSERT INTO recipe (user_id,user_name,food,recipe,category,time)
                                VALUES (:user_id,:user_name,:food,:recipe,:category,now())");
            $sql->bindParam(':user_id',$userid,PDO::PARAM_INT);
            $sql->bindParam(':user_name',$name,PDO::PARAM_STR);
            $sql->bindParam(':food',$food,PDO::PARAM_STR);
            $sql->bindParam(':recipe',$recipe,PDO::PARAM_STR);
            $sql->bindParam(':category',$foodcategory,PDO::PARAM_STR);
            $sql->execute();
        
        
        }
	       
         $sql = 'SELECT * FROM recipe';
	            $stmt = $pdo->query($sql);
	            $results = $stmt->fetchAll();
	            foreach ($results as $row){
		          //$rowの中にはテーブルのカラム名が入る
		            echo $row['id'].',';
		            echo $row['user_id'].',';
		            echo $row['user_name'].',';
		            echo $row['category'];
		            echo $row['recipe'];
		            echo $row['time'];
		            echo "<br>";
	                echo "<hr>";
	                }	
	                
	  
            /*
             $sql='drop table recipe';
            $stmt=$pdo->query($sql);
	    */
        
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
        <section class="write">
            <div class="container">
                <form action="" method="post" enctype="multipart/form-data" class="write-form">
                    <!--foodnameは名前、foodは料理名、foodimgは画像、
                        recipeはレシピ(本文)、foodcategoryはカテゴリー-->
                    <input type="text" name="name" value="<?php echo $name;?>">
                     <input type="text" name="userid" value="<?php echo $userid;?>">
                    <input type="text" name="food" class="food-input">
                    <input type="file" name="foodimg" class="food-img" accept="image/*">
                    <textarea name="recipe" class="recipe"></textarea>
                    <select class="food-category" name="foodcategory">
                        <option value='イタリアン'>イタリアン</option>
                        <option value='トルコ料理'>トルコ料理</option>
                        <option value='日本食'>日本食</option>
                        <option value='中華料理'>中華料理</option>
                        <option value='フランス料理'>フランス料理</option>
                        <option value='韓国料理'>韓国料理</option>
                        <option value='インド料理'>インド料理</option>
                        <option value='その他'>その他</option>
                    </select>
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
