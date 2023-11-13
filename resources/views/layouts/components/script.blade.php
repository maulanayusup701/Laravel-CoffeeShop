<script src="{{ asset('back-end/assets/compiled/js/app.js') }}"></script>
<script src="{{ asset('back-end/assets/static/js/components/dark.js') }}"></script>
<script src="{{ asset('back-end/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('back-end/assets/static/js/initTheme.js') }}"></script>
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
