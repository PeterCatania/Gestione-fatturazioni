<script>
  // the url of the site
  let URL = "<?= URL ?>";

  /**
   * Update a user from its ID
   * 
   * @param id The id of the user
   */
  function updateUser(id) {
    var user = createUserArrayFromId(id);
    var jsonUser = JSON.stringify(user);

    $.ajax({
      type: "POST",
      url: URL + "users/updateUser",
      data: {
        user: jsonUser
      },

      success: function(response) {
        if (response) {
          console.log(response);
          $(".user-" + id + "-field").prop("disabled", true);
        }
      }
    });
  }

  function deleteUser(id) {
    $.ajax({
      type: "POST",
      url: URL + "users/deleteUser",
      data: {
        id: id
      },

      success: function(response) {
        console.log(response);
      }
    });
  }

  /**
   * Get the user representation  with an JSON,
   * the JSON is mapped name => value.
   * 
   * @param id The id of the user
   */
  function createUserArrayFromId(id) {
    var user = {};

    $(".user-" + id + "-field").each(function(i, obj) {
      user[this.name] = this.value;
    });

    user["enabled"] = $("#enabled" + id).is(":checked");

    return user;
  }

  /* On clink Event of the icon buttons */

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