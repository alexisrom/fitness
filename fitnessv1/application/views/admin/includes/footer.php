            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url(); ?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {

        $(".btn-remove").on("click", function(e) {
            var base_url = "<?php echo base_url(); ?>";
            e.preventDefault();
            var ruta = $(this).attr("href");
            var opcion = confirm("¿Está seguro que desea eliminar este registro?");
            if (opcion == true) {
                $.ajax({
                    url: ruta,
                    type: "POST",
                    success:function(resp){
                        window.location.href = base_url + resp;
                    }
                });
            }
        });

        $('#data-table').DataTable({
            'pagining': true,
            'lengthChange' : true,
            'searching': true,
            'ordering' : true,
            'info' : true,
            'autoWidth' : false,
            'language' : {
            "lengthMenu" : "Mostrar _MENU_ registros",
            "zeroRecords" : "No se encontraron resultados en su búsqueda",
            "searchPlaceholder" : "Buscar registros",
            "info" : "Mostrando de _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty" : "No existen registros",
            "infoFiltered" : "(filtrado de un total de _MAX_ registros)",
            "search" : "Buscar:",
            "paginate" : {
                "first" : "Primero",
                "last" : "Último",
                "next" : "Siguiente",
                "previous" : "Anterior"
                }
            }
        });
    });
    </script>
</body>

</html>
