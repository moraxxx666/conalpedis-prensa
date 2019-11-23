<main>
    <h1 class="center-align">NOTICIAS DEL PORTAL</h1>
    <div class="row">
        <?php foreach ($noticias as $noticia) { ?>
            <div class="col s12 m6 ">
                <div class="card ">
                    <div class="card-content ">
                        <span class="card-title center-align truncate"><?php echo $noticia['titulo'] ?></span>
                        <p class="center-align"><?php echo $noticia['fecha'] ?></p>
                    </div>
                    <div class="card-action">
                        <div class="row">
                            <div class="col s12">
                                <a href="/Administrador/Noticia/<?php echo $noticia['id_noticia'] ?>" class="btn blue darken-1 link-button">Ver Noticia</a>
                            </div>
                            <div class="col s12" style="margin-top:5px">

                                <form action="/Administrador/EliminarNoticia/" method="post">
                                    <input type="hidden" name="id_noticia" value="<?php echo $noticia['id_noticia']?>">
                                    <button type="submit" class="btn red">Borrar Noticia</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</main>