if (typeof String.prototype.startsWith != 'function') {
    String.prototype.startsWith = function (str) {
        //return this.slice(0, str.length) == str;
        return this.match(new RegExp("^" + str));
    };
}

//  Checks that string ends with the specific string...
if (typeof String.prototype.endsWith != 'function') {
    String.prototype.endsWith = function (str) {
        //return this.slice(-str.length) == str;
        return this.match(new RegExp(str + "$"));
    };
}

IOEMain = {
    rootPath: "",
    htmlTags: {
        myModal: "#myModal",
    },

    Init: function () {
        //SessionUpdater.Setup($("#KeepSessionAliveUrl").val());
       // var s = document.createElement("script");
       // s.type = "text/javascript";
       // s.src = "https://advzone.ioe.vn/vtc_123/www/delivery/spcjs.php";
       // document.head.appendChild(s);
        //$("head").append(s);
    },
    isMobile: function () {
        var a = navigator.userAgent || navigator.vendor || window.opera;
        var regMobile = /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i;
        if (regMobile.test(a.substr(0, 4))) { return true };
        var strMobile = window.matchMedia("only screen and (max-width: 760px)");
        return strMobile.matches ? true : false;
    },
    Verify: {
        StringIsNullOrEmplty: function (str) {
            if (str == null || str == undefined || str.length == 0)
                return true;
            return false;
        },
        CheckUserName: function (username) {
            //var usernameRegex = /^([a-z0-9_]+){4,30}$/;
            var usernameRegex = /^([a-z0-9_.]+){4,30}$/;
            if (usernameRegex.test(username) == false) {
                return 'Tên tài khoản từ 4 đến 30 kí tự và không được chứa ký tự đặc biệt hoặc viết hoa';
            }
            return '';
        },
        CheckPassWord: function (pass, repass) {
            var passRegex = /^(^){6,}$/;
            //if (passRegex.test(data.password) == false)
            if (pass.length < 6) {
                return 'Mật khẩu từ 6 đến 16 ký tự';
            }
            if (repass != null && repass != undefined && repass.length > 0 && repass != pass) {
                return 'Mật khẩu nhập không giống nhau';
            }
            return '';
        },
        CheckFullName: function (fullname) {
            var tenIoe = $.trim(fullname);
            if (tenIoe.length == 0) {
                return "* Bạn cần nhập họ và tên đầy đủ (tiếng việt có dấu)!";
            }
            var reg = /^[a-zA-Z'-'\sáàảãạăâắằấầẩặẵẫậéèẻ ẽẹêếềểễệóòỏõọôốồổỗộ ơớờởỡợíìỉĩịđùúủũụưứừ�� �ửữựÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠ ƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼ� ��ỀỂỄỆỈỊỌỎỐỒỔỖỘỚỜỞ ỠỢỤỨỪỬỮỰỲỴÝỶỸửữựỵ ỳỷỹý]*$/i;
           // if (reg.test(tenIoe) == false || tenIoe.indexOf(" ") == -1) {
            if (tenIoe.indexOf(" ") == -1) {
                return "Họ tên không hợp lệ! \n " +
                    "Họ, Tên lót, Tên phải cách nhau (một dấu cách).\n " +
                    "Họ, Tên lót (có thể không có), Tên theo đúng cấu trúc tên người Việt Nam và phải viết hoa chữ cái đầu tiên.\n" +
                    "<b>Bạn cần nhập họ và tên đầy đủ</b> <font color='red'><b>(tiếng việt có dấu)!</b></font>" +
                    "<br/>Lưu ý:\n" +
                    "Thiết lập như sau trong Tool Unikey \n" +
                    "- Unicode dựng sẵn \n" +
                    "- Kiểu gõ: Telex";
            }
            return "";
        },
    },

    getVerificationToken: function () {
        return $("input[name='RequestVerificationToken']").val();
    },

    getreCaptchaToken: function () {
        if ($("#captchaToken").length > 0) {
            return $("#captchaToken").val();
        }
        return '';
    },
    getUserToken: function () {
        if ($("#hd_token").length > 0) {
            return $("#hd_token").val();
        }
        return '';
    },
    validId: function (itemId) {
        if (!itemId.startsWith("#")) {
            itemId = "#" + itemId;
        }
        return itemId;
    },
    getIntValue: function (itemId, defaultValue = 0) {
        itemId = this.validId(itemId);
        if ($(itemId).length > 0) {
            try {
                return parseInt($(itemId).val());
            }
            catch (e) { }
        }
        return defaultValue;
    },
    postJson: function (url, dataInput, success, error) {

        dataInput.captchaToken = IOEMain.getreCaptchaToken();
        //if (captchaToken.length > 0) {
        //    dataInput.captchaToken = captchaToken;
        //}
        dataInput.usertoken = IOEMain.getUserToken();
        //if (usertoken.length > 0) {
        //    dataInput.usertoken = IOEMain.getUserToken();
        //}
        Loading.show();
        $.ajax({
            url: url,
            type: "post",
            dataType: "json",
            contentType: 'application/json',
            headers: {
                RequestVerificationToken: IOEMain.getVerificationToken(),
            },
            data: JSON.stringify(dataInput),
            //data: dataInput,
            success: function (dataResponse) {
                success(dataResponse);
            },
            error: function (jqXhr, textStatus, errorThrown) {
                console.error(errorThrown);
                if (error != null && error != undefined)
                    error();
            },
            complete: function () {
                Loading.close();
            },
        });
    },
    postHtml: function (url, dataInput, success, error) {

        dataInput.captchaToken = IOEMain.getreCaptchaToken();
        dataInput.usertoken = IOEMain.getUserToken();
        Loading.show();
        $.ajax({
            url: url,
            type: "post",
            dataType: "html",
            contentType: 'application/json',
            headers: {
                RequestVerificationToken: IOEMain.getVerificationToken(),
            },
            data: JSON.stringify(dataInput),
            //data: dataInput,
            success: function (dataResponse) {
                success(dataResponse);
            },
            error: function (jqXhr, textStatus, errorThrown) {
                console.error(errorThrown);
                if (error != null && error != undefined)
                    error();
            },
            complete: function () {
                Loading.close();
            },
        });
    },
    scrollTo: function (itemId, delay = 500) {
        itemId = this.validId(itemId);
        $('html, body').animate({
            scrollTop: parseInt($(itemId).offset().top)
        }, delay);
    },

    Redirect: function (url)
    {
        if (url != null && url != undefined && url.length > 0) {
            window.location.href = url;
        }
    },
    OpenNewTab: function (url) {
        if (url != null && url != undefined && url.length > 0) {
            window.open(url, '_blank');
        }
    },

    LoadModal: function () {
        if ($(IOEMain.htmlTags.myModal).length == 0) {
            var strModal = "\
                <div class= 'ioe-modal modal fade' id = 'myModal' > \
                    <div class='modal-dialog modal-dialog-centered'> \
                        <div class='modal-content'> \
                            <div class='modal-header' id='myModal_header'> \
                                <span id='myModal_title'>Thông báo</span> \
                                <button type='button' class='close pop-btn-close' data-dismiss='modal'>&times;</button> \
                            </div> \
                			<div class='modal-body' id='myModal_content'></div> \
                            <div class='modal-footer' id='myModal_footer'> \
                                <div class='ioe-btn-pop'> \
                                    <a href='javascript:;' class='btn-solid-blue-40' id='myModal_Ok' style='display:none;'>Đồng ý</a> \
                                </div> \
                                <div class='ioe-btn-pop'> \
                                    <a href='javascript:;' class='btn-flat-cancel-40' id='myModal_cancel' data-dismiss='modal'>Đóng</a> \
                                </div> \
                            </div> \
                        </div> \
                    </div> \
                </div>\
                ";

            $('body').append(strModal);
        }
    },

    showModel: function (content, title, type = 0, callBack, callbackData) {
        //type 0: alert, 1: confirm, 2: toast
        IOEMain.LoadModal();
        if (content !== null && content != undefined && content.length>0) {
            $(IOEMain.htmlTags.myModal + "_content", IOEMain.htmlTags.myModal).html(content);
        }
        

        if (title !== null && title != undefined && title.length > 0) {
            $(IOEMain.htmlTags.myModal + "_title", IOEMain.htmlTags.myModal).html(title);
        }

        $(IOEMain.htmlTags.myModal).off('hidden.bs.modal');
        

        //$(IOEMain.htmlTags.myModal + "_cancel", IOEMain.htmlTags.myModal).attr("style", "display:block");
        //$(IOEMain.htmlTags.myModal + "_cancel", IOEMain.htmlTags.myModal).off('click');
        //$(IOEMain.htmlTags.myModal + "_cancel", IOEMain.htmlTags.myModal).click(function () {
        //    $(IOEMain.htmlTags.myModal).modal('hide');
        //});
        $(IOEMain.htmlTags.myModal + "_footer", IOEMain.htmlTags.myModal).attr("style", "display:block");
        if (type == 0) {
            $(IOEMain.htmlTags.myModal + "_Ok", IOEMain.htmlTags.myModal).attr("style", "display:none");
            if (typeof callBack == "function") {
                $(IOEMain.htmlTags.myModal).on('hidden.bs.modal', function () {
                    if (callbackData != null && callbackData != undefined) {
                        callBack(callbackData);
                    }
                    else {
                        callBack();
                    }
                });
            }
        }
        else if (type == 1) {
            $(IOEMain.htmlTags.myModal + "_Ok", IOEMain.htmlTags.myModal).attr("style", "display:block");
            
            $(IOEMain.htmlTags.myModal + "_Ok", IOEMain.htmlTags.myModal).off('click');
            $(IOEMain.htmlTags.myModal + "_Ok", IOEMain.htmlTags.myModal).click(function () {
                $(IOEMain.htmlTags.myModal).modal('hide');
                if (typeof callBack == "function") {
                    if (callbackData != null && callbackData != undefined) {
                        callBack(callbackData);
                    }
                    else {
                        callBack();
                    }
                }
            });
        }
        else if (type == 2) {
            //Show Toast;
            $(IOEMain.htmlTags.myModal + "_header", IOEMain.htmlTags.myModal).attr("style", "display:none");
            $(IOEMain.htmlTags.myModal + "_footer", IOEMain.htmlTags.myModal).attr("style", "display:none");
            setTimeout(function () {
                $(IOEMain.htmlTags.myModal).modal('hide');
                if (typeof callBack == "function") {
                    if (callbackData != null && callbackData != undefined) {
                        callBack(callbackData);
                    }
                    else {
                        callBack();
                    }
                }
            }, 1500);
        }
       
        //jQuery.noConflict();
        //regiser
        $(IOEMain.htmlTags.myModal).modal('show');


    },
    hideModel: function () {
        $(IOEMain.htmlTags.myModal).modal('hide');
    },
    Alert: function (content, title, callback) {
        IOEMain.showModel(content, title, 0, callback);
    },
    
    Confirm: function (content, title, callback, callbackData) {
        IOEMain.showModel(content, title, 1, callback, callbackData);
    },
    ShowLoading: function () {
        //IOEMain.showModel(content, null, 2);
        Loading.show();
    },
    HideLoading: function () {
        //IOEMain.hideModel();
        Loading.close();
    },
    Toast: function(content, callback) {
        IOEMain.showModel(content, '', 2, callback);
    },
    ShowMessage: function (msg, redirectUrl, toast = false)
    {
        if (toast) {
            this.Toast(msg, function () {
                if (redirectUrl != null && redirectUrl != undefined && redirectUrl.length > 0) {
                    IOEMain.Redirect(redirectUrl);
                }
            });
            return;
        }
        if ($("#errormsg").length > 0) {
            $("#errormsg").html(msg);
            if (redirectUrl != null && redirectUrl!= undefined && redirectUrl.length > 0) {
                setTimeout(function () { IOEMain.Redirect(redirectUrl); }, 2000);
            }
        }
        else {
            IOEMain.Alert(msg, null, function () {
                if (redirectUrl != null && redirectUrl != undefined && redirectUrl.length > 0)
                {
                    IOEMain.Redirect(redirectUrl);
                }
            });
        }
    },

    getUrlText: function (plainText) {
        var _URL_CHARS_UNICODE = "AÁÀẠẢÃÂẤẦẬẨẪĂẮẰẶẲẴBCDĐEÉÈẸẺẼÊẾỀỆỂỄFGHIÍÌỊỈĨJKLMNOÓÒỌỎÕÔỐỒỘỔỖƠỚỜỢỞỠPQRSTUÚÙỤỦŨƯỨỪỰỬỮVWXYÝỲỴỶỸZaáàạảãâấầậẩẫăắằặẳẵbcdđeéèẹẻẽêếềệểễfghiíìịỉĩjklmnoóòọỏõôốồộổỗơớờợởỡpqrstuúùụủũưứừựửữvwxyýỳỵỷỹz0123456789_";
        var _URL_CHARS_ANSI = "AAAAAAAAAAAAAAAAAABCDDEEEEEEEEEEEEFGHIIIIIIJKLMNOOOOOOOOOOOOOOOOOOPQRSTUUUUUUUUUUUUVWXYYYYYYZaaaaaaaaaaaaaaaaaabcddeeeeeeeeeeeefghiiiiiijklmnoooooooooooooooooopqrstuuuuuuuuuuuuvwxyyyyyyz0123456789_";
        var _URL_CHARS_BASE = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_";

        var _strTemp = "";
        var _iLength = plainText.length;

        var _iIndex = 0;

        // Loại bỏ các ký tự có dấu
        for (var i = 0; i < _iLength; i++) {
            iIndex = _URL_CHARS_UNICODE.indexOf(plainText.charAt(i));
            if (iIndex == -1)
                _strTemp += plainText.charAt(i);
            else
                _strTemp += _URL_CHARS_ANSI.charAt(iIndex);
        }
        var _strReturn = "";

        // Loại bỏ các ký tự lạ
        for (var i = 0; i < _iLength; i++) {
            if (_URL_CHARS_BASE.indexOf(_strTemp.charAt(i)) == -1) {
                _strReturn += '-';
            }
            else {
                _strReturn += _strTemp.charAt(i);
            }
        }

        while (_strReturn.indexOf("--") != -1) {
            _strReturn = _strReturn.replace('--', '-');
        }

        if ((_strReturn.length > 0) && (_strReturn.charAt(0) == '-')) {
            _strReturn = _strReturn.substr(1);
        }

        if ((_strReturn.length > 0) && (_strReturn.charAt(_strReturn.length - 1) == '-')) {
            _strReturn = _strReturn.substr(0, _strReturn.length - 1);
        }
        if (_strReturn.length > 60) {
            _iIndex = _strReturn.indexOf('-', 59);
            if (_iIndex != -1) {
                _strReturn = _strReturn.substring(0, _iIndex);
            }
        }
        return _strReturn.toLowerCase();
    },
    CopyText: function (itemId) {
        var text = '';
        if ($(itemId).length > 0) {
            text = $(itemId).text();
            if (text.length > 0) {
                this.copyTextToClipboard(text);
            }
        }
    },
    CopyValue: function (itemId) {
        var text = '';
        if ($(itemId).length > 0) {
            text = $(itemId).val();
            if (text.length > 0) {
                this.copyTextToClipboard(text);
            }
        }
    },
    copyTextToClipboard: function (text) {
        var textArea = document.createElement("textarea");
        textArea.style.position = 'fixed';
        textArea.style.top = 0;
        textArea.style.left = 0;
        textArea.style.width = '2em';
        textArea.style.height = '2em';
        textArea.style.padding = 0;
        textArea.style.border = 'none';
        textArea.style.outline = 'none';
        textArea.style.boxShadow = 'none';
        textArea.style.background = 'transparent';
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        try {
            var successful = document.execCommand('copy');
            var msg = successful ? 'thành công' : 'không thành công';
            this.Toast('Bạn đã copy : ' + text + ', ' + msg+'!');
        } catch (e) { }
        document.body.removeChild(textArea);
    },
    IsNullOrEmpty: function (str) { return (str == null || str == undefined || str.length == 0); },
};