<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Blog <small>Categorías</small></h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <a href="<?php echo base_url();?>admin/blog/agregar_categoria" class="btn btn-outline btn-primary">Agregar categoría</a>
        <a href="<?php echo base_url();?>admin/blog" class="btn btn-outline btn-primary">Volver</a>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $c): ?>
                    <tr>
                        <td><?php echo $c->id ?></td>
                        <td><?php echo $c->nombre ?></td>
                        <td><?php echo $c->descripcion ?></td>
                        <td class="center">
                            <a href="<?php echo base_url().'admin/blog/modificar_categoria/'.$c->id ?>" type="button" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
                            <button data-toggle="modal" data-target="#modal-eliminar" type="button" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.col-lg-12 -->
</div>


            
