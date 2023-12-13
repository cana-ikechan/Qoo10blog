<!-- サイドメニューのinclude -->

<ul class="main-nav">
    <?php 
    $pdo = (new PDO('mysql:host=localhost;dbname=cf176972_qoo10blog', 'cf176972_qoo10', 'password'));
    $category = $pdo->query('SELECT * FROM category;')->fetchall();

    foreach ($category as $key => $value){
        echo '<li>'.'<a href="./category_link.php?id='.$value['category_ID'].'">'.$value['category_name'].'</a></li>';
        }
    ?>
</ul>