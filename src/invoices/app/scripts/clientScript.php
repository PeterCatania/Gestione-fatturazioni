<script>
    /* Checkbox  ------------------------------------------------------------------------- */

    $('#cbCompany').click(function () {
        if ($(this).is(':checked',true)){
            $('#companyName-input').prop('disabled',false);
        } else {
            $('#companyName-input').prop('disabled',true);
            $('#companyName-input').val();
        }
    });

</script>