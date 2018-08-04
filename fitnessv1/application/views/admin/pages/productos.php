<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Productos</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <a href="<?php echo base_url();?>admin/productos/nuevo" class="btn btn-outline btn-primary">Añadir Producto</a>
        <a href="<?php echo base_url();?>admin/productos/categorias" class="btn btn-outline btn-primary">Categorías</a>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <table width="100%" class="table table-striped table-bordered table-hover" id="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($productos as $p): ?>
                    <tr>
                        <td><?php echo $p->id ?></td>
                        <td><?php echo $p->nombre ?></td>
                        <td><?php echo $p->descripcion ?></td>
                        <td><?php echo $p->imagen ?></td>
                        <td><?php echo '$'.$p->precio ?></td>
                        <td class="center">
                            <a href="<?php echo base_url().'admin/productos/ver/'.$p->id ?>" type="button" class="btn btn-success btn-circle"><i class="fa fa-eye"></i></a>
                            <a href="<?php echo base_url().'admin/productos/editar/'.$p->id ?>" type="button" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
                            <a href="<?php echo base_url().'admin/productos/eliminar/'.$p->id ?>" type="button" class="btn btn-danger btn-circle btn-remove"><i class="fa fa-trash"></i></button>
                            <a type="button" class="btn btn-warning btn-circle"><i class="fa fa-heart"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.col-lg-12 -->
</div>