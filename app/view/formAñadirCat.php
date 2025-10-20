<?php include 'view/includes/header.phtml'; ?>

<form action="<?php echo BASE_URL; ?>añadirCategoria" method="POST" enctype="multipart/form-data" class="my-4 form-rf-importados form">
  <div class="row">
    <h3 class="title-form">Agregar Categoria</h3>

        <div class="col3">
            <div class="form-group">
                <label>Nombre</label>
                <input name="nombre" type="text" class="form-control" required>
            </div>
        </div>
  </div>
  <button type="submit" class="btn btn-primary mt-4">Guardar Categoria</button>
</form>

<?php include 'view/includes/footer.phtml'; ?>