<?php require_once 'view/includes/header.phtml'?>

<?php if($error): ?>
  <div class="alert-login" role="alert">
    <?= $error ?>
  </div>
<?php endif; ?>
<body>

<form action="Login" method="post" class="my-4 form">
<div class="row">
  <h3 class="title-form">Iniciar Sesión</h3>
  <div class="col3">
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="ejemplo@email.com" required>
    </div>
     <div class="form-group">
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="********" required>
    </div>
  </div>
</div>
  <button type="submit" class="btn btn-primary mt-4">Iniciar Sesión</button>
</form>


<?php require_once 'view/includes/footer.phtml'?>