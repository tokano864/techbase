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
            <ul class="category-all">
                <!--PHPにて表示-->
            </ul>
        </div>
    </section>
    
    <div class="main">
        <section class="serch">
            <!--投稿フォーム-->
            <form action="" class="serch">
                <input type="text" name="serch">
                <input type="submit">
            </form>
            <!--検索結果表示-->
                <div class="serch-result">
                    <a href="#">料理名</a>
                    <p>投稿者</p>
                    <img src="#" alt="#" title="#"/>
                </div>
            <form>
                <!--PHPにて表示-->
            </form>
        </section>
        <section class="latest">
            <div class="container">
                <p class="latest-title">新着レシピ</p>
                <!--1番最新-->
                <form class="latest1">
                    <p class="food1">
                        <a href="#">料理名1</a>
                    </p>
                    <img src="#" alt="#" title="#/">
                    <p class="writer1"></p>
                </form>
                <!--2番最新-->
                <form class="latest2">
                    <p class="food2">
                        <a href="#">料理名2</a>
                    </p>
                    <img src="#" alt="#" title="#">
                    <p class="writer2"></p>
                </form>
                <!--3番最新-->
                <form class="latest3">
                    <p class="food3">
                        <a href="#">料理名3</a>
                    </p>
                    <img src="#" alt="#" title="#">
                    <p class="writer3"></p>
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