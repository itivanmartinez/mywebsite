<?php
include('obtenercita.php');
?>
<section id="bienvenida" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="display-4 text-center">
                    Bienvenido
                </p>
            </div>
        </div>
    </div>
</section>
<section id="dashboard " class="text-center">
    <div class="container">
        <div class="row">
            <div class="col-12 col-10 col-md-10 col-lg-10 ml-auto mr-auto">
                <div class="accordion" id="accordion">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3>
                                <a class="text-white" href="#citas" data-toggle="collapse" data-parent='#accordion'>
                                    Cambiar Cita</a>
                            </h3>
                        </div>
                        <div id="citas" class="collapse">
                            <div class="card-body">
                                <form name="frmCita">
                                    <legend>
                                        Actualizar Cita
                                    </legend>
                                    <hr>
                                    <label for="">Cita</label>
                                    <div class="form-group">
                                        <textarea name="cita" id="#cita" rows="4" class="form-control"
                                            maxlength="100"><?php echo "$cita"; ?></textarea>
                                    </div>
                                    <label>
                                        Capitulo
                                    </label>
                                    <div class="form-group">
                                        <textarea name="capitulo" id="#cita" rows="1" class="form-control"
                                            maxlength="100"><?php echo "$capitulo"; ?></textarea>
                                    </div>

                                    <submit class="btn btn-primary btn-block" onclick="actualizarCita();">Actualizar
                                    </submit>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--card-->

                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3>
                                <a class="text-white" href="#imagenes" data-toggle="collapse" data-parent='#accordion'>
                                    Cambiar Imagenes de Carrusel</a>
                            </h3>
                        </div>
                        <div id="imagenes" class="collapse">
                            <div class="card-body">
                                <div class="row">
                                    <?php include('obtenerimagencarrousel.php');?>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--card-->

                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3>
                                <a class="text-white" href="#noticias" data-toggle="collapse" data-parent='#accordion'>
                                    Cambiar noticias</a>
                            </h3>
                        </div>
                        <div id="noticias" class="collapse">
                            <div class="card-body">
                                <div class="row">
                                    <?php
                                    include('obtenernoticias.php') ;
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--card-->
                    <div class="card">
                            <div class="card-header bg-primary">
                                <h3>
                                    <a class="text-white" href="#subirimagen" data-toggle="collapse" data-parent='#accordion'>
                                        Subir Imagen</a>
                                </h3>
                            </div>
                            <div id="subirimagen" class="collapse">
                                <div class="card-body">
                                    <form id="frmImagen">
                                        <legend>
                                            Subir Imagen
                                        </legend>
                                        <hr>
                                        <label for="">Selecciona una imagen:</label>
                                        <div class="form-group">
                                            <input type="file" class="form-control" name="imagenSubir" id="imagenSubir">
                                        </div>    
                                        <submit class="btn btn-primary btn-block" onclick="subirImagen();">Subir Imagen
                                        </submit>
                                    </form>
                                </div>
                            </div>
                        </div><!--Card-->

                </div>
            </div>
        </div>
    </div>

</section>