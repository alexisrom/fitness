<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Blog <small>Nuevo Artículo</small></h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?php echo form_open('admin/blog/agregar', 'enctype="multipart/form-data" rol="form"'); ?>
            <div class="form-group">
                <label>Título</label>
                <input class="form-control" placeholder="Enter text" name="titulo" value="<?php echo set_value('titulo'); ?>">
            </div>

            <div class="form-group">
                <label>Contenido</label>
                <textarea class="form-control" rows="3" name="contenido"><?php echo set_value('contenido'); ?></textarea>
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
            <a href="<?php echo base_url();?>admin/blog" class="btn btn-default">Volver</a>
            <button type="reset" class="btn btn-default">Limpiar</button>
        </form>
        <?php echo validation_errors(); ?>
    </div>
</div>