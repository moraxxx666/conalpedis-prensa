<main>
    <div class="row">
        <div class="col m4 s12 izquierda">
            <form action="/Administrador/AgregarLibro" method="POST" enctype="multipart/form-data">
                <div class="input-field col s12">
                    <input id="id_coleccion" name="id_coleccion" type="hidden" class="" value="<?php echo $id ?>">

                </div>
                <div class="input-field col s12">
                    <input id="titulo" name="titulo" type="text" class="">
                    <label for="titulo">Título del Libro</label>
                </div>
                <div class="input-field col s12">
                    <input id="autor" name="autor" type="text" class="">
                    <label for="autor">Autor del Libro</label>
                </div>
                <div class="input-field col s12">
                    <input id="descripcion" name="descripcion" type="text" class="">
                    <label for="descripcion">Descripción del Libro</label>
                </div>
                <div class="input-field col s12">
                    <input id="palabras" name="palabras" type="text" class="">
                    <label for="palabras">Palabras Clave</label>
                </div>
                <div class="input-field col s12">
                    <input id="archivo" name="archivo" type="file" class="">

                </div>
                <div class="input-field col s12">
                    <select name="tipo_recurso">
                        <option value="" disabled selected>Elija el tipo del Libro</option>
                        <option value="texto">Documento de texto</option>
                        <option value="audio">Audio</option>
                        <option value="video">Video</option>

                    </select>
                    <label>Tipo de Libro</label>
                </div>
                <div class="input-field col s12">
                    <button type="submit" class="btn blue" style="width:100%">Agregar Libro</button>
                </div>
            </form>
        </div>
        <div class=" col m8 s12 derecha">
            <div class="row">
                <div class="col s12">
                    <h4 class="center-align"><?php echo strtoupper($coleccion['nombre']) ?></h4>
                </div>
                <div class="col s12">
                    <p><?php echo $coleccion['descripcion'] ?></p>
                </div>
                <div class="col s12">
                    <?php if (isset($libros)) {
                        foreach ($libros as $libro) {   ?>
                            <div class="card ">
                                <div class="card-content ">
                                    <span class="card-title"><?php echo $libro['titulo'] ?></span>
                                    <p>Autor: <?php echo $libro['autor'] ?></p>
                                    <p>Descripción: <?php echo $libro['descripcion'] ?></p>
                                    <p>Palabras de Búsqueda: <?php echo $libro['palabras'] ?></p>
                                    <?php if ($libro['tipo_recurso'] === 'texto') { ?>
                                        <p>Nombre del Archivo: <a target="_blank" href="<?php echo base_url() ?>uploads/biblioteca/<?php echo $libro['nombre_recurso'] ?>" class="truncate"> <?php echo $libro['nombre_recurso'] ?></a></p>
                                    <?php } ?>
                                    <?php if ($libro['tipo_recurso'] == 'audio') { ?>
                                        <audio src="<?php echo base_url() ?>uploads/biblioteca/<?php echo $libro['nombre_recurso']?>" controls></audio>
                                    <?php } ?>
                                    <?php if ($libro['tipo_recurso'] == 'video') { ?>
                                        <video class="responsive-video" src="<?php echo base_url() ?>uploads/biblioteca/<?php echo $libro['nombre_recurso']?>" controls ></video>
                                    <?php } ?>
                                    <p>Tipo de Libro: <?php echo $libro['tipo_recurso'] ?></p>

                                </div>


                                <div class="card-action">
                                    <div class="row">


                                        <div class="col s12">
                                            <form action="/Administrador/EliminarLibro" method="POST">
                                                <input type="hidden" value="<?php echo $id ?>" name="id_coleccion">
                                                <button type="submit" class="btn red" value="<?php echo $libro['id_libro'] ?>" name="id_libro">Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } ?>

                </div>
            </div>

        </div>
    </div>
</main>