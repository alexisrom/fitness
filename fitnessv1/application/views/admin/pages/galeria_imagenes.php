<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
</div>

<div class="row text-center text-lg-left">
    <?php foreach ($imagenes as $img ): ?>
        <div class="col-lg-3 col-md-4 col-xs-6">
            <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="<?php echo base_url()?>uploads/galeria/<?php echo $img->imagen?>" alt="<?php echo $img->imagen?>">
            </a>
        </div>
    <?php endforeach;?>  
</div>