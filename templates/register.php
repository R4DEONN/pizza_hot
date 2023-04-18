<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Регистрация</title>
  <link rel="stylesheet" href="/css/registration.css" />
</head>
<body class="page">
  <header class="header">
    <img src="image/LogoX.svg" alt="Shokudoo" class="header_logo" />
  </header>
  <main class="content">
    <p class="content_title">Регистрация на сайте</p>
    <form class="content_form form" action="/register" enctype="multipart/form-data" method="post">
      <div class="form_form-row form-row">
        <p class="form-row_title">Имя*</p>
        <input class="form-row_input" type="text" name="firstName" required />
        <?php if (!empty($errors['firstName'])): ?>
          <p><?= $errors['firstName']?></p>
        <?php endif; ?>
      </div>
      <div class="form_form-row form-row">
        <p class="form-row_title">Фамилия*</p>
        <input class="form-row_input" type="text" name="lastName" required />
        <?php if (!empty($errors['firstName'])): ?>
          <p class="form-row_error"><?= $errors['firstName']?></p>
        <?php endif; ?>
      </div>  
      <div class="form_form-row form-row">
        <p class="form-row_title">Email*</p>
        <input class="form-row_input" type="email" name="email" required />
        <?php if (!empty($errors['firstName'])): ?>
          <p><?= $errors['firstName']?></p>
        <?php endif; ?>
      </div>  
      <div class="form_form-row form-row">
        <p class="form-row_title">Номер телефона*</p>
        <input class="form-row_input" type="tel" name="phone" required />
        <?php if (!empty($errors['firstName'])): ?>
          <p><?= $errors['firstName']?></p>
        <?php endif; ?>
      </div>  
      <div class="form_form-row form-row">
        <p class="form-row_title">Аватар</p>
        <label class="input-file">
            <span class="input-file-btn">Выберите файл</span>
            <input type="file" name="avatar">        
            <span class="input-file-text" type="text">Файл не выбран</span>
        </label>
        <?php if (!empty($errors['firstName'])): ?>
          <p><?= $errors['firstName']?></p>
        <?php endif; ?>
      </div>
      <div class="form_form-row form-row">
        <button class="form-row_submit" type="submit">Зарегестрироваться</button>
      </div>     
    </form>
  </main>
  <footer class="footer">
      <img src="image/LogoFooter.svg" alt="Shokudoo" class="footer_logo" />
      <span class="footer_copyright">© 2023</span>
  </footer>

  <script src="https://snipp.ru/cdn/jquery/2.1.1/jquery.min.js"></script>
  <script>
  $('.input-file input[type=file]').on('change', function(){
      let file = this.files[0];
      $(this).closest('.input-file').find('.input-file-text').html(file.name);
  });
  </script>
</body>
</html>