<?php
/**
 * @var array $rows
 */
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Католог</title>
  <link rel="stylesheet" href="css/catalog.css" />
</head>
<body class="page">
  <header class="header">
    <img src="image/LogoX.svg" alt="Shokudoo" class="header_logo" />
  </header>
  <main class="catalog">
    <p class="catalog_title">Пицца</p>
    <?php foreach ($rows as $row): ?>
    <article class="catalog_product product">
        <main class="product_content">
            <img src=<?= 'image/' . $row['image_url'] ?> class="product_image" />
            <p class="product_title"><?= $row['title'] ?></p>
            <p class="product_description">
                <?= $row['subtitle'] ?>
            </p>
        </main>
        <footer class="product_submenu">
            <span class="product_price"><?= $row['price'] ?> ₽</span>
            <button class="product_select">Заказать</button>
        </footer>
    </article>
    <?php endforeach; ?>
  </main>
  <footer class="footer">
    <img src="image/LogoFooter.svg" alt="Shokudoo" class="footer_logo" />
    <span class="footer_copyright">© 2023</span>
  </footer>
</body>
</html>