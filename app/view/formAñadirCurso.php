<?php include 'view/includes/header.phtml'; ?>

<form action="<?php echo BASE_URL; ?>añadirCurso" method="POST" enctype="multipart/form-data" class="my-4 form">
  <div class="row">
    <h3 class="title-form">Agregar Curso</h3>

    <div class="col3">
      <div class="form-group">
        <label>Titulo</label>
        <input name="titulo" type="text" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Categoría</label>
        <select name="id_categoria" id="id_categoria" class="form-control" required>
          <?php foreach ($categorias as $cat): ?>
            <option value="<?= ($cat->id) ?>">
              <?= ($cat->nombre) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label>Imagen</label>
        <input type="file" name="imagen" class="form-control" accept="image/*" required>
      </div>
      <div class="form-group">
        <label>Instructor</label>
        <textarea name="instructor" class="form-control" rows="4" required></textarea>
      </div>    
      <div class="form-group">
        <label>Descripción</label>
        <textarea name="descripcion" class="form-control" rows="4" required></textarea>
      </div>
    </div>
  </div>

  <button type="submit" class="btn btn-primary mt-4">Guardar Curso</button>
</form>

<?php include 'view/includes/footer.phtml'; ?>