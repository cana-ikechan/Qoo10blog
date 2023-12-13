<!DOCTYPE html>
<html lang="ja">
<link rel="stylesheet" type="text/css" href="./stylesheet.css">
  <head>
    <meta charset="UTF-8">
    <title>Qoo10レビュ</title>
  </head> 

<!--$pdo=PHPからデータベースへアクセスするための拡張モジュール-->
<!--host＝DBに存在するホスト名を指定。dbname＝DB名を指定。root＝管理者権限（Googleのadminのところ）-->
<!--fetchallで結果をすべて$○○○○○○に入れてる。一度にまとめて取り出すメソッド-->
<!--「$key => 値」元の配列にキーが指定されていない場合にはデフォルトでインデックス番号が当てられるのでそれを参照する形で実現できる-->
<!--$○○○○○は変数、$valueは$○○○○○に入っている要素、$keyは配列の番号を意味する-->

  <body>
    <div id="home">
      <h1 class="top_title">Qoo10レビューブログ</h1>
          <?php include ( dirname(__FILE__) . '/sidemenu.php' ); ?>
    </div>
    
        <h2 class="header-image_title_sub">商品のレビュ一覧</h2>
          <!--ゲットパラメータでページの数字 × 表示件数 - 表示件数がオフセットに入る数字 -->
          <!-- OFFSETの範囲を指定して、ページングのリンクを作る-->
          <!-- カテゴリリンクページを作るのはまた別でやらないとページャーにならない -->
          <!-- HTMLとCSSでページャー枠組みを作って動的にしていく --> 
   
          <!-- ページャーの基本設定 -->

          <?php $pdo = (new PDO('mysql:host=localhost;dbname=cf176972_qoo10blog', 'cf176972_qoo10', 'password'));
            $counts = $pdo-> query('SELECT COUNT(*) as cnt FROM article');
            $count = $counts -> fetch(PDO::FETCH_ASSOC);
            $max_page = ceil($count['cnt'] / 9); //1ページに何個表示するか（最大記事数）
            $per_page = 9; //最大表示画像数
            
            if (!isset($_GET['page'])){
              $page = 1;
             } else {
             $page = (int)$_GET['page'];
            }
            
            $start_no = 9 * ($page - 1) ; //配列は0から始まるから-1
            $entry = $pdo->query('SELECT * FROM article LIMIT 9 OFFSET '.$start_no.';')->fetchall();
            ?>

            <?php
              echo '<div class="pager">';
              echo '<ul class="pagination" style="list-style: none;">';
              if ($page >= 2) {  //最初以外のページにいる場合は最初のページをリンク表示
                  echo '<li><a href="./index.php"><span> << </span></a></li>';
                } else if($page == 1 ) {  //最初のページにいる場合は表示しない
                  echo '  ';     
              }

            for ($i = 1; $i <= $max_page; $i++) {
              if ($i == $page) {  //閲覧中のページはリンクなし
                echo '<li><a href="./index.php?page='.$i.'" class="active"><span>'. $i .'</span></a></li>';
               } else {   //それ以外のページはそのページへのリンクを貼る
                echo '<li><a href="./index.php?page='.$i.'"><span>'.$i.'</span></a></li>';
              }
            }

            if ($page < $max_page) {   //最後以外のページにいる場合は最後のページをリンク表示
              echo '<li><a href="./index.php?page='.$max_page.'"><span> >></span></a></li>';
              } else if($page == $max_page) {   //最後のページにいる場合は表示しない
              echo '';
            }
            echo '</ul>';
            echo '</div>';
            ?>
          
          <?php foreach ($entry as $key => $value) { ?>
            <div class="card">
              <img class="card-img" src="img/<?php echo $value['ID']; ?>.jpg" alt="">
              <div class="card-content">
                <h1 class="card-title"><?php echo $value['name']; ?></h1>
                <p class="card-text"><?php echo $value['title']; ?></p>
              </div>
              <div class="card-link">
                <a href="clothes.php?id=<?php echo $value['ID']; ?>">記事を読む</a>
             </div>
            </div>
          <?php } ?>
    </body>
</html>
