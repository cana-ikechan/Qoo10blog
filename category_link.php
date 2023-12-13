<!DOCTYPE html>
<html lang="ja">
<link rel="stylesheet" type="text/css" href="./stylesheet.css">
    <head>
        <meta charset="UTF-8">
        <title>Qoo10レビュ</title>
    </head> 

  <h3><a class="top_return" href="index.php">TOPページに戻る</a></h3>

<body>
    <div id="home">
    <h1 class="top_title">Qoo10レビューブログ</h1>
        <?php include ( dirname(__FILE__) . '/sidemenu.php' ); ?>
    </div>

    <h2 class="header-image_title_sub">商品のレビュ一覧</h2>

    <?php $pdo = (new PDO('mysql:host=localhost;dbname=cf176972_qoo10blog', 'cf176972_qoo10', 'password'));
    $id = $_GET['id'];

    $counts = $pdo-> query('SELECT COUNT(*) as cnt FROM article WHERE category_ID='.$id);
    $count = $counts -> fetch(PDO::FETCH_ASSOC);
    $max_page = ceil($count['cnt'] / 9);
    $per_page = 9; //最大表示画像数
    
    if (!isset($_GET['page'])){
              $page = 1;
             } else {
             $page = (int)$_GET['page'];
            }
            
            $start_no = 9 * ($page - 1) ; //配列は0から始まるから-1
            $entry = $pdo->query('SELECT * FROM article WHERE category_ID='.$id.' LIMIT 9 OFFSET '.$start_no.';')->fetchall();
            ?>
            
            <?php
              echo '<div class="pager">';
              echo '<ul class="pagination" style="list-style: none;">';
              if ($page >= 2) {  //最初以外のページにいる場合は最初のページをリンク表示
                  echo '<li><a href="./catergory_link.php?id='.$id.'"><span> << </span></a></li>';
                } else if($page == 1 ) {  //最初のページにいる場合は表示しない
                  echo '  '; 
              }

            for ($i = 1; $i <= $max_page; $i++) {
              if ($i == $page) {  //閲覧中のページはリンクなし
                echo '<li><a href="./category_link.php?id='.$id.'&page='.$i.'" class="active"><span>'. $i .'</span></a></li>';
               } else {   //それ以外のページはそのページへのリンクを貼る
                echo '<li><a href="./category_link.php?id='.$id.'&page='.$i.'"><span>'.$i.'</span></a></li>';
              }
            }

            if ($page < $max_page) {   //最後以外のページにいる場合は最後のページをリンク表示
              echo '<li><a href="./category_link.php?id='.$id.'&page='.$max_page.'"><span> >></span></a></li>';
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