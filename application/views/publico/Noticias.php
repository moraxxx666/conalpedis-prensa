<main>
    <div class="row">

        <div class="col s12">

            <div class="row">
                <?php foreach ($colecciones as $coleccion) { ?>
                    <div class="col s12 m6 ">
                        <a href="/Noticia/<?php echo $coleccion['id_noticia']?>">
                            <div class="card " style="background:url(<?php echo base_url() ?>uploads/noticias/<?php echo $coleccion['nombre_imagen'] ?>);background-position:center">
                                <div class="card-content ">
                                    <span class="card-title center-align"><?php echo $coleccion['titulo'] ?></span>
                                    <p class="center-align"><?php echo $coleccion['fecha'] ?></p>

                                </div>

                            </div>
                        </a>
                    </div>
                <?php } ?>


            </div>
        </div>
    </div>
</main>