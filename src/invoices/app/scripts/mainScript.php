<script>
    /* Global Constants ------------------------------------------------------------------------- */

    // the url of the site
    const URL = "<?= URL ?>";

    /* General Functions --------------------------------------------------------------------- */

    function escapeHtml(text) {
        let map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };

        return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    }

</script>