<script src="{{ asset('back-end/assets/js/bootstrap.js') }}"></script>
<script src="{{ asset('back-end/assets/js/app.js') }}"></script>

<script src="{{ asset('back-end/assets/js/pages/dashboard.js') }}"></script>
<script>
    const title = document.querySelector("#title");
    const slug = document.querySelector("#slug");

    title.addEventListener("keyup", function() {
        let preslug = title.value;
        preslug = preslug.replace(/ /g, "-");
        slug.value = preslug.toLowerCase();
    });
    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    })

    function preview() {
        frame.src = URL.createObjectURL(event.target.files[0]);
    }
</script>

</html>
