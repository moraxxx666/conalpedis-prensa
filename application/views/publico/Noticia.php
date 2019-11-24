<main class="container">
    <h4 class="center-align"><?php echo $noticia['titulo']?></h4>
    <div class="imagenes">
        <div class="row">
            <?php foreach($imagenes as $imagen){?>
                <div class="col m4 s12">
                    <img class="responsive-img materialboxed" src="<?php echo base_url()?>uploads/noticias/<?php echo $imagen['nombre_imagen']?>" alt="">
                </div>
            <?php } ?>
        </div>
    </div>
    <p>Subido el: <?php echo $noticia['fecha']?></p>
    <div class="noticia">
        <?php echo $noticia['noticia']?>
    </div>
</main>