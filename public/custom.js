$(function () {
    $('#sidebarToggle').click(function() {
        $.ajax({
            type: "GET",
            url: $(this).data('url')
        });
    });
});


$(function () {
    $("#printText").focus(function(){
        $(this).select();
    });
});


function copy() {
    let textarea = document.getElementById("printText");
    textarea.select();
    document.execCommand("copy");
}
