$(document).on("input", "form.needs-validation :input", function () {
    $(this).removeClass("is-invalid");

    $(this).closest(".col-lg-12, .form-group, .mb-3")
        .find(".invalid-feedback")
        .text("");
});

 function validation(form, err) {

  let inputs = $('#' + form + ' .form-control');

  inputs.each(function () {
    let id = $(this).attr('id');
    let normalizedErrors = {};
    Object.keys(err).forEach(key => {
      let newKey = key.replaceAll('.', '_');
      normalizedErrors[newKey] = err[key];
    });

    // reset state
    $("#" + id).removeClass('is-invalid');
    $("#err_" + id).remove();

    if (Object.hasOwn(normalizedErrors, id)) {

      let message = normalizedErrors[id][0];

      $("#" + id).addClass('is-invalid');

      $("#" + id).parent().append(
        '<div class="invalid-feedback" id="err_' + id + '">' + message + '</div>'
      );
    }
  });

  validateInput();
}

$(document).ready(function(){
  $("form.needs-validation :input").on('input', function(){
      var _this = $(this);
      var checkClass = _this.hasClass('is-invalid');
      if (checkClass) {
        _this.removeClass('is-invalid');
      }
  });
});

function validateInput(){
    $(".form-control").each(function(e){
      $(this).on('input', function(){
        var _this = $(this);
          var checkClass = _this.hasClass('is-invalid');
          if (checkClass) {
            _this.removeClass('is-invalid');
          }
      });
    });
}
