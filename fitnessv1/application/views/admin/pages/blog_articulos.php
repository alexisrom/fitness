<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Blog</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <a href="<?php echo base_url();?>admin/blog/nuevo" class="btn btn-outline btn-primary">Crear Artículo</a>
        <a href="<?php echo base_url();?>admin/blog/categorias" class="btn btn-outline btn-primary">Categorías</a>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <table width="100%" class="table table-striped table-bordered table-hover" id="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Título</th>
                    <th>Contenido</th>
                    <th>Fecha</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articulos as $a): ?>
                    <tr>
                        <td><?php echo $a->id ?></td>
                        <td><?php echo $a->titulo ?></td>
                        <td><?php echo substr($a->contenido, 0, 450) ?></td>
                        <td><?php echo date("d/m/Y", strtotime($a->fecha)); ?></td>
                        <td class="center">
                            <a href="<?php echo base_url().'admin/blog/ver/'.$a->id ?>" type="button" class="btn btn-success btn-circle"><i class="fa fa-eye"></i></a>
                            <a href="<?php echo base_url().'admin/blog/editar/'.$a->id ?>" type="button" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
                            <a href="<?php echo base_url().'admin/blog/eliminar/'.$a->id ?>" type="button" class="btn btn-danger btn-circle btn-remove"><i class="fa fa-trash"></i></button>
                            <a type="button" class="btn btn-warning btn-circle"><i class="fa fa-heart"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.col-lg-12 -->
</div>