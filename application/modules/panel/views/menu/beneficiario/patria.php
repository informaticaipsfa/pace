<!DOCTYPE html>
<html>

<style>
.form-group {
    position: relative;
    overflow: hidden;
}

.form-group input {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}

.form-group label {
    display: flex;
    align-items: center;
    justify-content: center;
    background: #008D4C;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    height: 3.6rem;
    width: 14rem;
    font-size: 13px;
    padding: 5px;
    font-weight: 500;
}

.form-group label:hover {
    background: #006d3a;
}

.centrar {
    display: flex;
    justify-content: center;
}
</style>

<?php $this->load->view('inc/cabecera.php');?>
<!-- Site wrapper -->
<div class="wrapper">

    <?php $this->load->view('inc/top.php');?>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Beneficiarios
                <small>Cargar Proceso Patria</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Beneficiarios</a></li>
                <li><a href="#">Cargar Proceso Patria</a></li>
                <!--<li class="active">Blank page</li>-->
            </ol>
        </section>

        <!-- Main content -->

        <section class="content">
            <!-- Default box -->

            <div class="box box-solid box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Cargar Proceso Patria</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" onclick="principal()" class="btn btn-box-tool" data-widget="remove"
                            data-toggle="tooltip" title="Salir"><i class="fa fa-times"></i></button>
                    </div>
                </div>

                <div class="box-body" style="padding: 1rem;">



                    <div class="col-md-12">
                        <a href="#!" onclick="cargar()" class="btn btn-primary" target="_top" id='btnActualizar'><i
                                class="fa fa-refresh"></i>&nbsp;&nbsp;Cargar Archivos</a>
                        <button type="button" class="btn btn-danger pull-right"><i
                                class="fa fa-file-text"></i>&nbsp;&nbsp;Ver Registro </button>
                    </div>

                    </form>
                </div>

            </div>

    </div>
</div>
<!-- /.box -->

</section>
<!-- /.content -->

<!-- Main content -->


</div><!-- /.content-wrapper -->

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.6.7
    </div>
    <strong>Copyright &copy; 2015-2016 Instituto de Previsión Social.</strong> Todos los derechos.
</footer>


</div><!-- ./wrapper -->

<?php $this->load->view('inc/pie.php');?>
<script src="<?php echo base_url()?>application/modules/panel/views/js/carga_fideicomitente.js"></script>
<script>
function displaySelectedFile() {
    const input = document.getElementById("exampleInputFile");
    const fileName = input.files[0].name; // Obtiene el nombre del archivo seleccionado

    const vPrevia = document.getElementById("vPrevia");
    vPrevia.textContent = fileName; // Actualiza la etiqueta con el nombre del archivo
}
</script>

</body>

</html>