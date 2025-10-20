<?php require_once 'view/includes/header.phtml'?>

<?php if ($error): ?>
  <div class="alert-register" role="alert">
    <?= $error ?>
  </div>
<?php endif; ?>

<form action="Register" method="POST" class="my-4 form">
    <div class="row">
    <h3 class ='title-form'>Registrarse</h3>

    <div class="form-group">
        <label for="email" class="register-form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="password" class="register-form-label">Contraseña</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="confirm_password" class="register-form-label">Confirmar Contraseña</label>
        <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
    </div>
    </div>
  
  <button type="submit" class="btn btn-primary mt-4">Registrarse</button>
</form>


<?php require_once 'view/includes/footer.phtml'?>