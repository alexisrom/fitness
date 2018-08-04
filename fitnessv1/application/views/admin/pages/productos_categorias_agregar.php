<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Productos <small>Nueva categoría</small></h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?php echo form_open('admin/productos/agregar_categoria', 'enctype="multipart/form-data" rol="form"'); ?>
            <div class="form-group">
                <label>Nombre</label>
                <input class="form-control" placeholder="Ingrese el nombre" name="nombre" value="<?php echo set_value('nombre'); ?>">
            </div>

            <div class="form-group">
                <label>Descripción</label>
                <textarea class="form-control" placeholder="(Opcional)" rows="3" name="descripcion"><?php echo set_value('descripcion'); ?></textarea>
            </div>
            <button type="submit" class="btn btn-default">Agregar</button>
            <a href="<?php echo base_url(); ?>admin/productos/categorias" class="btn btn-default">Volver</a>
            <button type="reset" class="btn btn-default">Limpiar</button>
        </form>
        <?php echo validation_errors(); ?>
    </div>
</div>