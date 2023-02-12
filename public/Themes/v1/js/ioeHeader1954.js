ioeHeader = {
    rootPath: "",
    htmlTags: {
        login: ".ieo-header-btn-login",
        register: "",
        myinfo:"",
    },
    Init: function () {
        $("#tudienonline").keypress(function (e) {
            if (e.which == 13) {
                ioeHeader.tratu();
            }
        });
        $("#idseachtudien").click(function () {
            ioeHeader.tratu();
        });
    },
    login: function () { },
    register: function () { },
    tratu: function (ct) {
        if (ct == null || ct == undefined || ct.length == 0)
            ct = $("#tudienonline").val();
        if (ct.length <= 1) {
            return;
        }
        if ($("#tudienContent").length == 0) {
            var url = '/tudien/setcookie/' + ct;
            $.get(url, function (dataResponse) {
                IOEMain.Redirect('/tu-dien');
            });
            return;
        }
        Loading.show();
        var url = '/tudien/tratu/' + ct;
        $.get(url, function (dataResponse) {
            $("#tudienContent").html(dataResponse);
            Loading.close();
            $("#tudienonline").focus();
        });
    },
}