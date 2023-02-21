function switchLanguage(lang_code) {

    var LOG_USER_TYPE = $('#LOG_USER_TYPE').val();
    LOG_USER_TYPE = (LOG_USER_TYPE == 'employee') ? 'admin' : LOG_USER_TYPE;
    var path_root = $("#path_root").val();

    $.ajax({
        type: 'POST',
        url: path_root + 'api/general/changeLanguageSettings',
        data: {'lang_code': lang_code},

        beforeSend: function () {
        },
        success: function (data) {

            location.reload();

        },
        error: function (xhr) {
            //alert("Error occured.please try again");
        },
        complete: function () {
        },
        dataType: 'json'
    });

}