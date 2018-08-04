<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Blog <small>Modificar categoría<?php echo var_dump($categoria)?></small></h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?php echo form_open('admin/blog/modificar_categoria', 'enctype="multipart/form-data" rol="form"'); ?>
            <input type="hidden" name="id" value="<?php echo $categoria['id']; ?>">
            <div class="form-group">
                <label>Nombre</label>
                <input class="form-control" placeholder="Ingrese el nombre" name="nombre" value="<?php echo $categoria['nombre']; ?>">
            </div>

            <div class="form-group">
                <label>Descripción</label>
                <textarea class="form-control" placeholder="(Opcional)" rows="3" name="descripcion"><?php echo $categoria['descripcion']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-default">Agregar</button>
            <a href="<?php echo base_url(); ?>admin/blog/categorias" class="btn btn-default">Volver</a>
            <button type="reset" class="btn btn-default">Limpiar</button>
        </form>
        <?php echo validation_errors(); ?>
    </div>
</div>