</div>
</div>

<script>
    ClassicEditor
        .create(document.querySelector('#editor-um'))
        .catch(error => {
            console.error(error);
        });

    ClassicEditor
        .create(document.querySelector('#editor-dois'))
        .catch(error => {
            console.error(error);
        });

    ClassicEditor
        .create(document.querySelector('#editor-tres'))
        .catch(error => {
            console.error(error);
        });
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/10.1.0/classic/ckeditor.js"></script>
<script src="<?= URL ?>assets/js/dashboard.js"></script>
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace()
</script>

</body>
</html>