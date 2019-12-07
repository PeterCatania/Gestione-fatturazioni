<script>
  /* Global var ------------------------------------------------------------------------- */

  // the url of the site
  let URL = "<?= URL ?>";

  /* AJAX Functions --------------------------------------------------------------------- */

  /**
   * Update all users.
   * 
   * @return void
   */
  function updateUsers() {
    let users = createUsersJson();
    // JSON string send to the php method
    let jsonUsers = JSON.stringify(users);

    $.ajax({
      type: "POST",
      url: URL + "users/updateUsers",
      data: {
        users: jsonUsers
      },
      // action after request successeded
      success: function(response) {
        if (response) {
          // disable the table fields
          $(".input-table").prop("disabled", true);
          // set the default values af the table fields
          setTableFieldsDefaultValue(createUsersJson(), "user");
        }
      }
    });
  }

  /**
   * Update the user with the given ID.
   * 
   * @param id The ID of the user to update
   * @return void
   */
  function updateUser(id) {
    let user = createUserJsonFromId(id);
    // JSON string send to the php method
    let jsonUser = JSON.stringify(user);

    $.ajax({
      type: "POST",
      url: URL + "users/updateUser",
      data: {
        user: jsonUser
      },
      // action after request successeded
      success: function(response) {
        if (response) {
          // disable row fields
          $("#tr-user-" + id + " .input-table").prop("disabled", true);
          // set the default values of row field  
          setTableRowDefaultValue(user, "user");
        }
      }
    });
  }

  /**
   * Delete the user with the given ID.
   * 
   * @param id The ID of the user to delete
   * @return void
   */
  function deleteUser(id) {
    $.ajax({
      type: "POST",
      url: URL + "users/deleteUser",
      data: {
        id: id
      },
      // action after request successeded
      success: function(response) {}
    });
  }

  /* General Functions --------------------------------------------------------------------- */

  /**
   * Create a user object with the data of the user with the given id
   * The object is mapped: fieldName => value.
   * 
   * @param id The id of the user
   * @return The user object with the data of the user with the given id
   */
  function createUserJsonFromId(id) {
    var user = {
      id: $("#id-user-" + id).val(),
      username: $("#username-user-" + id).val(),
      email: $("#email-user-" + id).val(),
      enabled: $("#enabled-user-" + id).is(":checked")
    };
    return user;
  }

  /**
   * Create a user object with the data of the user with the given id
   * The objects are mapped: index => object.
   * Inside the objects are mapped: fieldName => value.
   * 
   * @param id The id of the user
   * @return The user object with the data of the user with the given id
   */
  function createUsersJson() {
    var users = {};

    $('input[id^="id-user-"]').each(function(i) {
      users[i] = createUserJsonFromId(this.value);
    });

    return users;
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
  /* On clink Events of the icon buttons --------------------------------------------------*/

  // save all the users
  $("#btn-save-all").click(function() {
    updateUsers();
  });

  // save the user in the same row
  $(".icon-save").click(function() {
    updateUser(this.value);
  });

  // save the user in the same row
  $(".icon-delete").click(function() {
    var userId = this.value;
    var b = this;
    $.confirm({
      columnClass: "col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2",
      title: "Vuoi davvero cancellare l'utente?",
      content: "Non sarà piu possibile ritornare indetro.",
      icon: "fas fa-exclamation-triangle",
      type: "orange",
      buttons: {
        confirm: {
          text: "Ok",
          keys: ["enter"],
          action: function() {
            $(b)
              .closest("tr")
              .hide();
            deleteUser(userId);
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
</script>