$("#cbCompany").change(function() {
  if (this.checked) {
    $("#companyName").prop("disabled", false);
  } else {
    $("#companyName").prop("disabled", true);
  }
});
