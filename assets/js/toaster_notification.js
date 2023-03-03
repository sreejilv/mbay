/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function show_notification(status, title, msg) {    
    
    var i = -1;
    var toastCount = 0;
    var $toastlast;
    var toastIndex = toastCount++;
    toastr.options = {
        closeButton: $('#closeButton').prop('checked'),
        debug: $('#debugInfo').prop('checked'),
        positionClass: $('#positionGroup input:radio:checked').val() || 'toast-top-right',
        onclick: null
    };

    $("#toastrOptions").text("Command: toastr["
            + status
            + "](\""
            + msg
            + (title ? "\", \"" + title : '')
            + "\")\n\ntoastr.options = "
            + JSON.stringify(toastr.options, null, 2)
            );
    toastr.clear();
    var $toast = toastr[status](msg, title); // Wire up an event handler to a button in the toast, if it exists
}
