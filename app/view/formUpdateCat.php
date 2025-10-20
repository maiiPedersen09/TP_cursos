<?php include 'view/includes/header.phtml'; ?>

<form action="<?php echo BASE_URL; ?>editarCat/<?php echo $categoria->id; ?>" method="POST" enctype="multipart/form-data" class="my-4 form">
  <div class="row">
    <h3 class="title-form">Editar Categoria</h3>

    <div class="col3">
      <div class="form-group">
        <label>Editar Nombre</label>
        <input name="nombre" type="text" class="form-control" required>
      </div>

    </div>
  </div>

  <button type="submit" class="btn btn-primary mt-4">Guardar Cambios</button>
</form>

<?php include 'view/includes/footer.phtml'; ?>  