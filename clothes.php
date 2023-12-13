<!DOCTYPE html>
<html lang="ja">
  <link rel="stylesheet" href="stylesheet.css">
  <head>
  <?php $pdo = (new PDO('mysql:host=mysql206.phy.lolipop.lan;dbname=LAA1447136-kojinblog', 'LAA1447136', 'password'));
?>

<!--「GET」「POST」がある。「GET」はその名の通り「Webサーバからデータを取得する」というアクションを指す。-->
<!-- $_GETの中身は連想配列になっている-->

<h3><a class="top_return" href="index.php">TOPページに戻る</a></h3>

<meta charset="UTF-8">
  <div id="home">
      <?php
      $sql = 'SELECT * FROM article Where ID = '.$_GET['id'].';';
      $article = $pdo->query($sql)->fetchall(); ?>

      <h1 class="report_name"><?php echo $article[0]['name']; ?></h1>
        <?php include ( dirname(__FILE__) . '/sidemenu.php' ); ?>
  </div>

    <body>
      <img class="cardimg" src="img/<?php echo $article[0]['ID']; ?>.jpg" alt="">
      <h2 class="report_title"><?php echo $article[0]['title']; ?></h2>
      <p class="report_order"><?php echo $article[0]['order_dt']; ?></p>
      <h3 class="report_entry"><?php echo $article[0]['entry']; ?></h3>
    </body>
</html>

