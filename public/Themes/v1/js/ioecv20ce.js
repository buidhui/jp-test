$(document).ready(function () {
        $('#cb_year > option').removeAttr('selected');
        $('#cb_year option[value="2019"]').attr('selected', 'selected');

        if ($('#pageQDCV').length > 0)
            QuyetDinhCV('#QD_CV');
        if ($('#pageDTTQG').length > 0)
            DoiTuyenThiQG('#DS_DoituyenQG');

    });

    function QuyetDinhCV(divdata) {

        var year = 0;
        year = parseInt($("#cb_year").val());
        var url = "/cong-van/" + year + ".1.0.0";
        var data;
        
        $.ajax({
            beforeSend: function () {
                $(divdata).fadeTo("slow", 0.1);
            },
            type: "Get",
            dataType: "text",
            url: url,
            timeout: 1000,
            data: data,
            success: function (text) {
                $(divdata).html(text);
                $(divdata).fadeTo("slow", 1);
            }
        });
}
//function CheckIDQG() {
//    var txtId = $("#txtIDQG").val();
//    var url = "/check-id/" + txtId;
//    var data = url;
//    $.ajax({
//        beforeSend: function () {
//        },
//        type: "Get",
//        dataType: "text",
//        url: url,
//        data: data,
//        success: function (text) {
//            var res = text.match(/true/g);

//            if (res != null) {
//              IOEMain.Alert("ID này đã có trong DANH SÁCH ĐỘI TUYỂN THI CẤP TOÀN QUỐC!");
//            } else {
//                IOEMain.Alert("ID này không tồn tại trong DANH SÁCH!");
//           }
//        }
//    });
//    // alert($('#txtIDQG').val());
//}
function search(source, name) {
    var results = [];
    var index;
    var entry;

    name = name.toUpperCase();
    for (index = 0; index < source.length; ++index) {
        entry = source[index];
        if (entry && entry.name && entry.name.toUpperCase().indexOf(name) !== -1) {
            results.push(entry);
        }
    }

    return results;
}
    function DoiTuyenThiQG(divdata) {

        var year = 0;
        var province = 0;
        year = $("#cb_year").val();
        province = $("#cb_province").val();
        var provinceId = parseInt(province);
        var data;
        if (provinceId == 0) {
            var url = "/ket-qua-thi/" + year + ".3";

        } else {
            var url = "/ket-qua-thi2/" + year + ".3." + province;
        }
        $.ajax({
            beforeSend: function () {
                $(divdata).fadeTo("slow", 0.1);
            },
            type: "Get",
            dataType: "text",
            url: url,
            data: data,
            timeout: 1000,
            success: function (text) {
                $(divdata).html(text);
                $(divdata).fadeTo("slow", 1);
            }
        });
}
function CongVanDiaPhuong(divdata) {
    
    var year = 0;
    var province = 0;
    year = $("#cb_year").val();
    province = $("#cb_province").val();
    var provinceId = parseInt(province);
    var data;
    if (provinceId == 0) {
        var url = "/ket-qua-thi/" + year + ".2";
    } else {
        var url = "/ket-qua-thi2/" + year + ".2." + province;
    }
    $.ajax({
        beforeSend: function () {
            $(divdata).fadeTo("slow", 0.1);
        },
        type: "Get",
        dataType: "text",
        url: url,
        data: data,
        timeout: 1000,
        success: function (text) {
            $(divdata).html(text);
            $(divdata).fadeTo("slow", 1);
        }
    });
}

