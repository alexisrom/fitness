<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Blog <small>Modificar</small></h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?php echo form_open('admin/blog/modificar', 'enctype="multipart/form-data" rol="form"'); ?>
            <input name="id" type="hidden" class="form-control" value="<?php echo $articulo['id']; ?>" hidden>    
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Título</label>
                        <input class="form-control" placeholder="Enter text" name="titulo" value="<?php echo $articulo['titulo']; ?>">
                    </div>
                    <div class="form-group">
                    <label>Contenido</label>
                    <textarea class="form-control" rows="10" name="contenido"><?php echo $articulo['contenido']; ?></textarea>
                </div>
                </div>
                <div class="col-lg-6">
                <div class="form-group">
                    <label>Categoría</label>
                    <select class="form-control" name="categoria">
                        <?php foreach ($categorias as $c): ?>
                            <option value="<?=$c->id;?>" <?php echo $c->id == $articulo['categoria'] ? 'selected' : '' ?>><?=$c->nombre;?></option>
                        <?php endforeach;?>
                    </select>
            </div>
            <div class="form-group">
                <img src="<?= base_url() ?>uploads/blog/<?php echo $articulo['imagen'] ?>" alt="<?php echo $articulo['imagen']; ?>" class="img-thumbnail" style="width:200px;height:200px">
                <input type="file" name="imagen">
                <p class="help-block">Tamaño máximo (800KB)</p>
            </div>

                </div>
            </div>



            <button type="submit" class="btn btn-default">Modificar</button>
            <button type="reset" class="btn btn-default">Limpiar</button>
            <a href="<?php echo base_url(); ?>/admin/blog" class="btn btn-default">Volver</a>
        </form>
        <?php echo validation_errors(); ?>
    </div>
</div>