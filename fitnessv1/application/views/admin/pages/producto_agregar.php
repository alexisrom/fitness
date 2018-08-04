<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Producto<small> Nuevo</small></h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?php echo form_open('admin/productos/agregar', 'enctype="multipart/form-data" rol="form"'); ?>
            <div class="form-group">
                <label>Nombre</label>
                <input class="form-control" placeholder="Ingrese el nombre" name="nombre" value="<?php echo set_value('nombre'); ?>">
            </div>

            <div class="form-group">
                <label>Descripción</label>
                <textarea class="form-control" rows="3" name="descripcion"><?php echo set_value('descripcion'); ?></textarea>
            </div>
            <div class="form-group">
                <label>Precio</label>
                <input class="form-control" placeholder="Ingrese el precio" name="precio" value="<?php echo set_value('precio'); ?>">
            </div>
            <div class="form-group">
                <label>Categoría</label>
                <select class="form-control" name="categoria">
                    <?php foreach ($categorias as $c): ?>
                        <option value="<?=$c->id;?>" <?php echo $c->id == set_value('categoria') ? 'selected' : '' ?>><?=$c->nombre;?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="form-group">
                <label>Imagen</label>
                <input type="file" name="imagen">
                <p class="help-block">Tamaño máximo (800KB)</p>
            </div>
            <button type="submit" class="btn btn-default">Agregar</button>
            <a href="<?php echo base_url();?>admin/productos" class="btn btn-default">Volver</a>
            <button type="reset" class="btn btn-default">Limpiar</button>
        </form>
        <?php echo validation_errors(); ?>
    </div>
</div>