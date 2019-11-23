<main class="container">

    <form action="/Administrador/GuardarNoticia" method="POST" class="rowd" enctype="multipart/form-data">
        <div class="input-field col s12">
            <input id="last_name" type="text" name="titulo">
            <label for="last_name">Título de la Noticia</label>
        </div>
        <div class="input-field col s12">
            <p>Noticia</p>

            <textarea  id="noticia" name="noticia"></textarea>
        </div>
        <div class="input-field col s12">
            <p>Imágenes</p>
            <input type="file" name="file[]"  multiple>
        </div>
        <div class="input-field col s12">
            <button type="submit" class="btn blue">Guardar Noticia</button>
        </div>



    </form>
</main>