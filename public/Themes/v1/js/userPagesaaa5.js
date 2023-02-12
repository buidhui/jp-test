userPages = {
    rootPath: "",
    selectType: 0,
    htmlTags: {
        btnregister: "#btnregister",
        btnlogin: "#btnlogin",
        btnlogingoId: "#btnlogingoid",
        errormessage: "#error-message",
    },
    Init: function () {
        if ($(userPages.htmlTags.btnregister).length > 0) {
            $(userPages.htmlTags.btnregister).click(function () {
                userPages.register();
            });
        }

        if ($(userPages.htmlTags.btnlogin).length > 0) {
            $(userPages.htmlTags.btnlogin).click(function () {
                userPages.login();
            });
            $("input[name='username']").keypress(function (e) {
                if (e.which == 13) {
                    $("input[name='password']").focus();
                }
            });
            $("input[name='password']").keypress(function (e) {
                if (e.which == 13) {
                    userPages.login();
                }
            });
        }
        if ($(userPages.htmlTags.btnlogingoId).length > 0) {
            $(userPages.htmlTags.btnlogingoId).click(function () {
                userPages.loginGoID();
            });
        }
        

        if ($(userPages.htmlTags.btnupdateInfo).length > 0) {
            $(userPages.htmlTags.btnupdateInfo).click(function () {
                userPages.updateInfo();
            });
        }
        if ($("#selectType").length > 0) {
            userPages.selectType = parseInt($("#selectType").val());
            switch (userPages.selectType) {
                case -1: break;
                case 0: break;
                case 1: //giao vien
                    $("#caphoc_dropdown").attr("style", "display:block");
                    $("#school_dropdown").attr("style", "display:block");
                    $("#khoi_dropdown").attr("style", "display:none");
                    $("#tenlop_div").attr("style", "display:none");
                    break;
                case 2:
                    $("#caphoc_dropdown").attr("style", "display:block");
                    $("#school_dropdown").attr("style", "display:block");
                    $("#khoi_dropdown").attr("style", "display:block");
                    $("#tenlop_div").attr("style", "display:block");
                    break;
                default:
                    $("#caphoc_dropdown").attr("style", "display:none");
                    $("#school_dropdown").attr("style", "display:none");
                    $("#khoi_dropdown").attr("style", "display:none");
                    $("#tenlop_div").attr("style", "display:none");
                    break;
            }
        }

        if ($('#datetimepickerbirthday').length > 0) {
            $('#datetimepickerbirthday').datepicker({
                language: 'vi',
                format: "dd/mm/yyyy",
            });
        }

        var url = '/user/getprovince/0';
        $.get(url, function (dataResponse) {
            $("#province_dropdown").html(dataResponse);
        });
    },
    showerror: function (msg) {
        $(userPages.htmlTags.errormessage).html(msg);
    },

    validateLoginInput: function (register = false) {
        var data = {};
        //data.RequestVerificationToken = IOEMain.getVerificationToken();
        data.username = $("input[name='username']").val();
        var msg = IOEMain.Verify.CheckUserName(data.username);
        if (msg.length > 0) {
            userPages.showerror(msg);
            return null;
        }

        data.password = $("input[name='password']").val();
        if (register) {
            data.repassword = $("input[name='repassword']").val();
            msg = IOEMain.Verify.CheckPassWord(data.password, data.repassword);
        }
        else {
            msg = IOEMain.Verify.CheckPassWord(data.password);
        }
        if (msg.length > 0) {
            userPages.showerror(msg);
            return null;
        }
        
        return data;
    },
    login: function () {
        /*
        IOEMain.showModel('Bạn có thực hiện chức năng nay không?',"Khẳng định",1,
            function(data){
                console.log('Mày đi đâu thế: ' + data.username);
            }, {username:'dongnq'});        

        return;
        */

        var dataInput = userPages.validateLoginInput(false);
        if (dataInput != null) {
            var ur = '';
            if ($("#ur").length > 0) {
                ur = $("#ur").val();
            }
            dataInput.ur = ur;
            IOEMain.postJson("/apiinfo/login", dataInput,
                function (dataResponse) {
                  //  IOEMain.Loading.close();
                    if (dataResponse.code != 1) {
                        userPages.showerror(dataResponse.message);
                        RefeshCaptcha();
                    }
                    else {
                        IOEMain.Redirect(dataResponse.redirectUrl);
                    }
                }
            );
        }
    },
    loginGoID: function () {
        var dataInput = {};
        IOEMain.postJson("/apiinfo/fblogin", dataInput,
            function (dataResponse) {
                if (dataResponse.code != 1) {
                    userPages.showerror(dataResponse.message);
                    RefeshCaptcha();
                }
                else {
                    //console.log(dataResponse.redirectUrl);
                    //alert(dataResponse.redirectUrl);
                    IOEMain.Redirect(dataResponse.redirectUrl);
                }
            }
        );
    },
    register: function () {
        var dataInput = userPages.validateLoginInput(true);

        if (dataInput != null) {
            IOEMain.postJson("/apiinfo/register", dataInput,
                function (dataResponse) {
                    if (dataResponse.code != 1) {
                        userPages.showerror(dataResponse.message);
                        RefeshCaptcha();
                    }
                    else {
                        IOEMain.Redirect(dataResponse.redirectUrl);
                    }
                }
            );
        }
    },
    setType: function (type) {
        var dataInput = type;
        IOEMain.postJson("/apiinfo/settype", dataInput,
            function (dataResponse) {
                if (dataResponse.code != 1) {
                    IOEMain.Alert(dataResponse.message, null, function () {
                        IOEMain.Redirect(dataResponse.redirectUrl);
                    });
                }
                else {
                    IOEMain.Redirect(dataResponse.redirectUrl);
                }
            }
        );
    },
    setGender: function (gender, name) {
        $("#gender").text(name);
        $("#gender").val(gender);
    },
    setCapHoc: function (cap, name) {
        $("#caphoc").text(name);
        $("#caphoc").val(cap);
        var min = 3;
        var max = 5;
        var cap = parseInt($("#caphoc").val())
        if (cap == -1) return;
        if (cap == 2) { min = 6; max = 9 }
        else if (cap == 3) { min = 10, max = 12 }
        userPages.LoadSchool();
        if (userPages.selectType != 2)
            return;
        if (cap < 4) {
            $("#khoi_dropdown").attr("style", "display:block;");
            $("#tenlop_div").attr("style", "display:block;");
            var strHtml = '';
            for (var i = min; i <= max; i++) {
                strHtml = strHtml + '<a class="dropdown-item" href="javascript:userPages.khoiChange(' + i + ',\'Lớp ' + i + '\');">Lớp ' + i + '</a>';
            }
            $("#khoiitems").html(strHtml);
            userPages.khoiChange(-1, "Chọn khối");
        }
        else {
            $("#khoi_dropdown").attr("style", "display:none;");
            $("#tenlop_div").attr("style", "display:none;");
        }

    },
    ProvinceChange: function (pid, name) {
        $("#province").text(name);
        $("#province").val(pid);
        $("#Villageitems").html('');
        if (pid == -1) {
            userPages.VillageChange(-1, "Chọn Quận/Huyện");
            userPages.schoolChagne(-1, "Chọn Trường");
            return;
        }
        var url = '/user/getvillage/' + pid + '/0';
        $.get(url, function (dataResponse) {
            $("#village_dropdown").html(dataResponse);
            userPages.LoadSchool();
        });

    },
    VillageChange: function (vid, name) {
        $("#Village").text(name);
        $("#Village").val(vid);
        if (vid == -1) {
            userPages.schoolChagne(-1, "Chọn Trường");
            return;
        }
        userPages.LoadSchool();
    },
    schoolChagne: function (sid, name) {
        $("#school").text(name);
        $("#school").val(sid);
    },
    khoiChange: function (khoi, name) {
        $("#khoi").text(name);
        $("#khoi").val(khoi);
    },

    LoadSchool: function () {
        if (!(userPages.selectType == 1 || userPages.selectType == 2))
            return;
        userPages.schoolChagne(-1, "Chọn trường");
        $("#schoolitems").html('');
        var pid = parseInt($("#province").val())
        var vid = parseInt($("#Village").val())
        var gid = parseInt($("#caphoc").val())
        if (gid == -1) return;
        if (pid == -1) return;
        if (gid < 4 && vid == -1) return;
        if (vid == -1) vid = 0;
        var url = '/user/getschool/' + pid + '/' + vid + '/' + gid + '/0';
        //alert(url);
        $.get(url, function (dataResponse) {
            $("#school_dropdown").html(dataResponse);
        });
    },
    updateInfo: function () {
        inputData = {}
        inputData.selectType = parseInt($("#selectType").val());
        //inputData.ioename = $("#ioename").val();
        inputData.fullname = $("#fullname").val();
        inputData.birthday = $("#birthday").val();
        inputData.gender = parseInt($("#gender").val());
        inputData.province = parseInt($("#province").val());
        inputData.village = parseInt($("#Village").val());
        inputData.grade = parseInt($("#caphoc").val());
        inputData.school = parseInt($("#school").val());
        inputData.block = parseInt($("#khoi").val());
        inputData.classname = $("#tenlop").val();

        //validate data;
        //var mess = IOEMain.Verify.CheckFullName(inputData.ioename);
        //if (inputData.ioename.length < 6) {
        //    userPages.showerror('Tên hiển thị phải lớn hơn 6 ký tự');
        //    return;
        //}
        //if (mess.length > 0) {
        //    userPages.showerror(mess);
        //    return;
        //}
        var mess = IOEMain.Verify.CheckFullName(inputData.fullname);
        if (mess.length > 0) {
            userPages.showerror(mess);
            return;
        }
        //if (inputData.fullname.length < 3) {
        //    userPages.showerror('Nhập họ và tên đầy đủ');
        //    return;
        //}
        if (inputData.gender == -1) {
            userPages.showerror('Chọn giới tính');
            return;
        }
        if (inputData.province == -1) {
            userPages.showerror('Chọn tỉnh/thành');
            return;
        }
        if (inputData.village == -1) {
            userPages.showerror('Chọn quận/huyện');
            return;
        }
        if (inputData.selectType == 2 && inputData.grade == -1) {
            userPages.showerror('Chọn cấp học');
            return;
        }
        if (inputData.selectType == 2 && inputData.school == -1) {
            userPages.showerror('Chọn trường học');
            return;
        }
        if (inputData.selectType == 2 && inputData.block == -1) {
            userPages.showerror('Chọn khối');
            return;
        }
        if (inputData.selectType == 2 && inputData.classname.length < 1) {
            userPages.showerror('Nhập tên lớp học.');
            return;
        }

        //get data;
        //postJson;
        //
        //alert('update info: ' + JSON.stringify(inputData));

        IOEMain.postJson("/apiinfo/userinfo", inputData,
            function (dataResponse) {
                if (dataResponse.code != 1) {
                    if (dataResponse.redirectUrl.length > 0) {
                        IOEMain.Alert(dataResponse.message, null, function () {
                            IOEMain.Redirect(dataResponse.redirectUrl);
                        });
                    }
                    else {
                        userPages.showerror(dataResponse.message);
                        RefeshCaptcha();
                    }
                }
                else {
                    IOEMain.Redirect(dataResponse.redirectUrl);
                }
            }
        );
    },

}