<script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    let navBar = document.querySelectorAll('.sidenav');
    let InstanciaNavBar = M.Sidenav.init(navBar, {})
    let LoginModal = document.querySelectorAll('.modal');
    M.Modal.init(LoginModal, {})
</script>



<?php if ($this->session->flashdata('mensaje')) { ?>
    <script>
        M.toast({
            html: '<?php echo $this->session->flashdata('mensaje'); ?>'
        });
    </script>
<?php } ?>
<script>
    var select = document.querySelectorAll('select');
    M.FormSelect.init(select, {});
</script>
<script>
    var elems = document.querySelectorAll('.materialboxed');
    var instances = M.Materialbox.init(elems, {});
</script>
<script type="application/x-javascript">
    tinymce.init({
        selector: '#noticia'
    });
</script>

</body>

</html>