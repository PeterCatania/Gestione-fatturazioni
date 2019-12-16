<?php if (
    isset($data['tableName']) &&
    isset($data['fieldsName']) &&
    isset($data['successRowUpdateMessage']) &&
    isset($data['successTableUpdateMessage']) &&
    isset($data['successRowEliminationMessage']) &&
    isset($data['rowUpdateMethod']) &&
    isset($data['tableUpdateMethod']) &&
    isset($data['rowDeleteMethod']) &&
    isset($data['rowDeleteConfirmMessage'])
): ?>
    <script>
        /* Global Constants ------------------------------------------------------------------------- */

        /**
         * The name of the database table where the users data is memorized
         */
        const TABLE_NAME = "<?= $data['tableName'] ?>";

        /**
         * The fields name where are inserted the corresponding database fields values.
         *
         * If the field name is expressed with an object, the field is a checkbox mapped: Name => StatusToVerify
         * If the field is a checkbox, the field value is TRUE if is checked and FALSE if not.
         */
        const FIELDS_NAME = JSON.parse(`<?= $data['fieldsName'] ?>`);

        /**
         * The message to print after actions on row or table data.`
         */
        const SUCCESS_ROW_UPDATE_MESSAGE = "<?= $data['successRowUpdateMessage'] ?>";
        const SUCCESS_TABLE_UPDATE_MESSAGE = "<?= $data['successTableUpdateMessage'] ?>";
        const SUCCESS_ROW_ELIMINATION_MESSAGE = "<?= $data['successRowEliminationMessage'] ?>";

        /**
         * URL of the controllers methods.
         */
        const ROW_UPDATE_METHOD = "<?= $data['rowUpdateMethod'] ?>";
        const TABLE_UPDATE_METHOD = "<?= $data['tableUpdateMethod'] ?>";
        const ROW_DELETE_METHOD = "<?= $data['rowDeleteMethod'] ?>";

        /**
         * The confirm message showed when deleting a table row.
         */
        const ROW_DELETE_CONFIRM_MESSAGE = "<?= $data['rowDeleteConfirmMessage'] ?>";

        /**
         * The last button af the buttons on the top of the list.
         */
        const lastTopButtonId = "btn-modify-all";

        /* Manage the modal save --------------------------------------------------*/

        let isModalSaveOpen ="<?= $data['isSaveModalInProcess'] ?>";

        if(isModalSaveOpen){
            $("#b-save-modal-" + TABLE_NAME).trigger('click');
        }

        $('#b-cancel-save-' + TABLE_NAME + '-icon').click(function () {
            $('#b-cancel-save-' + TABLE_NAME).trigger('click');
        });

        /* On clink Events of the icon buttons --------------------------------------------------*/

        // save all the users
        $("#btn-save-all").click(function() {
            updateTableFields(
                createTableObject(FIELDS_NAME, TABLE_NAME),
                TABLE_UPDATE_METHOD,
                TABLE_NAME,
                SUCCESS_TABLE_UPDATE_MESSAGE
            );
            //Hide the table inputs and show the corrispettive span
            hideTableInputsAndShowSpan();
        });

        // save the user in the same row
        $(".icon-save").click(function() {
            updateRowFields(
                createTableRowObjectFromId(this.value, FIELDS_NAME, TABLE_NAME),
                ROW_UPDATE_METHOD,
                TABLE_NAME,
                SUCCESS_ROW_UPDATE_MESSAGE
            );
            hideTableInputsAndShowSpanOfRow($("#tr-" + TABLE_NAME + "-" + this.value));
        });

        // save the user in the same row
        $(".icon-delete").click(function() {
            let b = this;
            $.confirm({
                columnClass: "col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2",
                title: ROW_DELETE_CONFIRM_MESSAGE,
                content: "Le informazioni non saranno più reperibili!",
                icon: "fas fa-exclamation-triangle",
                type: "orange",
                buttons: {
                    confirm: {
                        text: "Ok",
                        keys: ["enter"],
                        action: function() {
                            // delete the table row data from the database
                            deleteTableRow(
                                b.value,
                                ROW_DELETE_METHOD,
                                SUCCESS_ROW_ELIMINATION_MESSAGE
                            );
                        }
                    },
                    cancel: {
                        text: "Annulla",
                        btnClass: "btn-primary",
                        action: function() {}
                    }
                }
            });
        });

        // animation when move is over the icon, the icon will be zoomed
        $('.btn-icon')
            .mouseenter(function() {
                $(this)
                    .children()
                    .css('transform', 'scale(' + 1.1 + ')');
            })
            .mouseleave(function() {
                $(this)
                    .children()
                    .css('transform', 'scale(' + 1.0 + ')');
            });

        // when click on icon, enable to modify the fields of the table row
        $('.icon-modify').click(function() {
            $('#tr-' + TABLE_NAME + '-' + this.value + ' .input-table').each(function() {
                $(this).prop('disabled', function(i, v) {
                    return !v;
                });
                // set default value
                $(this).val($(this)[0].defaultValue);

                toggleTableInputsAndSpan(this);
            });
        });

        // enable to modify all the fields of the table
        $('#btn-modify-all').click(function() {
            if($('.input-table:enabled').length){
                $('.input-table').each(function() {
                    $(this).prop('disabled',true);
                    $(this).val($(this)[0].defaultValue);
                });
                //Hide the table inputs and show the corrispettive span
                hideTableInputsAndShowSpan()
            }else{
                $('.input-table').each(function() {
                    $(this).prop('disabled', function(i, v) {
                        return !v;
                    });
                    $(this).val($(this)[0].defaultValue);
                    toggleTableInputsAndSpan(this);
                });
            }
        });

        /* General Functions --------------------------------------------------------------------- */

        /**
         * Toggle the function, hide table inputs and show table spans.
         */
        function toggleTableInputsAndSpan(input){
            // get the input span
            let span = $('#' + input.id + '-span');

            // toggle input if the span exists
            if(span.length === 1){
                if ($(input).css('display') === 'none') {
                    // show the input
                    $(input).removeClass('d-none');
                    // hide the input
                    $(span).hide();
                } else {
                    // hide the input
                    $(input).addClass('d-none');
                    // show the input
                    $(span).show();
                }
            }
        }


        /**
         * Hide the table inputs and show the corrispettive span.
         */
        function hideTableInputsAndShowSpan(){
            $('.input-table').each(function () {
                // get the input span
                let span = $('#' + this.id + '-span');

                // do if the span exists
                if(span.length === 1){
                    // hide this input
                    $(this).addClass('d-none');
                    //insert text in the span
                    $(span).html($(this).val());
                    // show this span
                    $(span).show();
                }
            });
        }

        /**
         * Hide the table inputs and show the corrispettive span,
         * of the same give row.
         */
        function hideTableInputsAndShowSpanOfRow(row){
            $('#' + row[0].id + ' .input-table').each(function () {
                // get the input span
                let span = $('#' + this.id + '-span');

                // do if the span exists
                if(span.length === 1){
                    // hide this input
                    $(this).addClass('d-none');
                    //insert text in the span
                    $(span).html($(this).val());
                    // show this span
                    $(span).show();
                }
            });
        }

        /**
         * Set the default values of the table row fields.
         *
         * @param fields The object that contains the row fields default values to set
         * @param tableName The table name of the database where is saved the data
         */
        function setTableRowDefaultValue(fields, tableName) {
            if (fields.hasOwnProperty("id")) {
                const id = fields["id"];

                for (const fieldName in fields) {
                    if (fields.hasOwnProperty(fieldName)) {
                        const value = fields[fieldName];
                        const input = $("#" + fieldName + "-" + tableName + "-" + id);

                        // check if the input is visible and disabled
                        if ($(input).is(':disabled') && $(input).is(':visible')) {
                            // set the default value to the field
                            input[0].defaultValue = value;
                        }
                    }
                }
            }
        }

        /**
         * Set the default values of the table fields.
         *
         * @param fields The object that contains the fields default values to set
         * @param tableName The table name of the database where is saved the data
         */
        function setTableFieldsDefaultValue(fields, tableName) {
            for (const key in fields) {
                if (fields.hasOwnProperty(key)) {
                    const field = fields[key];
                    const id = field["id"];

                    for (const fieldName in field) {
                        if (field.hasOwnProperty(fieldName)) {
                            const value = field[fieldName];
                            const input = $("#" + fieldName + "-" + tableName + "-" + id);

                            // check if the input is visible and disabled
                            if ($(input).is(':disabled') && $(input).is(':visible')) {
                                // set the default value to the field
                                input[0].defaultValue = value;
                            }
                        }
                    }
                }
            }
        }

        /**
         * Create a table row object with the data of the fields with the given id.
         * The object is mapped: fieldName => value.
         *
         * @param id The id of the table row
         * @param fieldsName The fields name where are inserted the corresponding database fields values
         * @param tableName The table name of the database where is saved the data
         * @return object The table row object with the data of the fields with the given id
         */
        function createTableRowObjectFromId(id, fieldsName, tableName) {
            let obj = {};
            let rowIsInvalid = false;

            for (const key in fieldsName) {
                if (fieldsName.hasOwnProperty(key)) {

                    const fieldName = fieldsName[key];

                    if (typeof fieldName === 'object' && fieldName !== null) {
                        for (const checkboxName in fieldName) {
                            if (fieldName.hasOwnProperty(checkboxName)) {
                                const checkboxStatusToVerify = fieldName[checkboxName];

                                obj[checkboxName] =
                                    $("#" + checkboxName + "-" + tableName + "-" + id).is(
                                        checkboxStatusToVerify
                                    );
                            }
                        }
                    } else {
                        const inputFieldValue = $("#" + fieldName + "-" + tableName + "-" + id).val();
                        obj[fieldName] = escapeHtml(inputFieldValue);
                    }
                }
            }

            return obj;
        }

        /**
         * Create a object containing the table row objects with the data of the fields.
         * The objects are mapped: index => object.
         * Inside the objects are mapped: fieldName => value.
         *
         * @param fieldsName The fields name where are inserted the corresponding database fields values
         * @param tableName The table name of the database where is saved the data
         * @return The object containing the table row objects with the data of the fields
         */
        function createTableObject(fieldsName, tableName) {
            let objects = {};

            $('input[id^="id-' + tableName + '-"]').each(function(i) {
                objects[i] = createTableRowObjectFromId(
                    this.value,
                    fieldsName,
                    tableName
                );
            });

            return objects;
        }

        /* AJAX Functions --------------------------------------------------------------------- */

        /**
         * Update all table fields,
         * that are saved in the database table with the given name.
         *
         * @param tableFields The object containing the new table fields values
         * @param urlMethod The URL of the php method, where the data is sent
         * @param tableName The database table name that contains the fields data
         * @param succeedMessage The message to display when the update is succeeded
         * @return void
         */
        function updateTableFields(tableFields, urlMethod, tableName, succeedMessage) {
            // JSON string send to the php method
            let json = JSON.stringify(tableFields);

            $.ajax({
                type: "POST",
                url: URL + urlMethod,
                data: {
                    data: json
                },
                // action after request succeeded
                success: function(response) {
                    if (response) {
                        // disable the table fields
                        $(".input-table").each(function () {
                            $(this).prop("disabled", true);
                        });

                        // set the default values af the table fields
                        setTableFieldsDefaultValue(tableFields, tableName);

                        // notify the succeeded save
                        $("#" + lastTopButtonId).notify(succeedMessage, {
                            style: 'success',
                            autoHideDelay: 3000,
                            arrowShow: false,
                            position: "right",
                            showAnimation: 'fadeIn',
                            hideAnimation: 'fadeOut',
                        });
                    }
                }
            });
        }

        /**
         * Update the row fields,
         * that are saved in the database table with the given name.
         *
         * @param rowFields The object containing the new table row fields values
         * @param urlMethod The URL of the php method, where the data is sent
         * @param tableName The database table name that contains the fields data
         * @param succeedMessage The message to display when the update is succeeded
         * @return void
         */
        function updateRowFields(rowFields, urlMethod, tableName, succeedMessage) {
            // JSON string send to the php method
            let json = JSON.stringify(rowFields);

            $.ajax({
                type: "POST",
                url: URL + urlMethod,
                data: {
                    data: json
                },
                // action after request succeeded
                success: function(response) {
                    if (response) {
                        // disable row fields
                        $("#tr-" + tableName + "-" + rowFields.id + " .input-table").prop("disabled", true);
                        // set the default values of row field
                        setTableRowDefaultValue(rowFields, tableName);

                        $("#" + lastTopButtonId).notify(succeedMessage, {
                            style: 'success',
                            autoHideDelay: 3000,
                            arrowShow: false,
                            position: "right",
                            showAnimation: 'fadeIn',
                            hideAnimation: 'fadeOut',
                        });
                    }
                }
            });
        }

        /**
         * Delete the database table row with the given ID.
         *
         * @param id The ID of the table row fields to delete
         * @param urlMethod The URL of the php method, where the data is sent
         * @param succeedMessage The message to display when the update is succeeded
         * @return void
         */
        function deleteTableRow(id, urlMethod, succeedMessage) {
            $.ajax({
                type: "POST",
                url: URL + urlMethod,
                data: {
                    id: id
                },
                // action after request succeeded
                success: function(response) {
                    if (response) {
                        console.log(response);
                        $("#" + lastTopButtonId).notify(succeedMessage, {
                            style: 'success',
                            autoHideDelay: 3000,
                            arrowShow: false,
                            position: "right",
                            showAnimation: 'fadeIn',
                            hideAnimation: 'fadeOut',
                        });

                        // remove the table row from view
                        $('#tr-' + TABLE_NAME + '-' + id).remove();

                        // show a message if there is no data
                        if(!$('tr[id^="tr-' + TABLE_NAME + '-"]').length){
                            $("#no-data").show();
                        }
                    }
                }
            });
        }

    </script>
<?php endif; ?>