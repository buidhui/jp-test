HomePage = {
    rootPath: "/",
    htmlTags: {
        login: "#id_header_login",
        register: "#id_header_register",
        newtag: "#idnews",
        newbtc: "#news_bantochuc",
        newsukien: "#news_sukien",
    },
    loading: 0,
    Onload: function () {
        HomePage.loading = HomePage.loading - 1;
        if (HomePage.loading == 0) {
            Loading.close();
        }
    },
    Init: function () {
        //var parrent = this;
        

        //Loading data;
        //Loading.show();

        //this.getnew_BTC();
        //this.RoundResult.Init();
        //when lost or fail not close in 10s
        //setTimeout(function () { Loading.close(); }, 10*1000);
    },
    getnew_BTC: function () {
        HomePage.loading += 1;
        var url = "/news/bantochuc";
        var data = {};
        var success = function (result) {
            $(HomePage.htmlTags.newbtc).html(result);
        };
        var dataType = 'text';
        $.get(url, data, success, dataType).done(function () { HomePage.Onload(); });
    },
    game06Test: function () {
        var dataInput = {
            api_key: "gameclient",
            gameId: 6,
            token: "a03fd6e43c16b44429d829dffa31321a",
            sign: ""
        };
        
        IOEMain.postJson('http://localhost:49987/game/getinfo', dataInput, function (data) {
            //alert(data.data.game.examKey);
            data.data.game.question.forEach(function (q) {
                var url = q.ans[0].content.replace('farm04.gox.vn', '103.116.100.79');
                $.get(url, function (dateImage) {
                    alert('successed');
                }).fail(function () {
                    alert('failed');
                });
                //alert(q.ans[0].content);
            });
           
        });
    },
    RoundResult: {
        Vars: {
            province: {
                id: "#s_province",
                value: "#s_province",
                input: "#s_province_input",
                dropdown: "#s_province_dropdown",
                ul: "#s_province_ul",
                list: "#s_province_ul li",
            },
            village: {
                id: "#s_village",
                value: "#s_village",
                input: "#s_village_input",
                dropdown: "#s_village_dropdown",
                ul: "#s_village_ul",
                list: "#s_village_ul li",
            },
            school: {
                id: "#s_school",
                value: "#s_school",
                input: "#s_school_input",
                dropdown: "#s_school_dropdown",
                ul: "#s_school_ul",
                list: "#s_school_ul li",
            },
            grade: {
                id: "#s_grade",
                value: "#s_grade",
            },
            round: {
                id: "#s_round",
                value: "#s_round",
            },
        },
        Init: function () {
          
            //search province;
            this.InitSearch(this.Vars.province);
            this.InitSearch(this.Vars.village);
            this.InitSearch(this.Vars.school);

            this.LoadProvince();
        },

        InitSearch: function (vars) {
            $(vars.dropdown).on("shown.bs.dropdown", function () {
                $(vars.input).val('');
                $(vars.list).toggle(true);
                $(vars.dropdown +' .scrollable-menu').scrollTop(0);
                $(vars.input).focus();
            });

            $(vars.input).on("keyup", function () {
                var value = IOEMain.getUrlText($(this).val());
                $(vars.list).filter(function () {
                    var selectText = IOEMain.getUrlText($(this).text());
                    $(this).toggle(selectText.indexOf(value) > -1);
                });
            });
        },
        getIntValue: function (itemId,defaultValue=0) {
            if ($(itemId).length > 0) {
                try {
                    return parseInt($(itemId).val());
                }
                catch (e) { }
            }
            return defaultValue;
        },

        setHTML: function (itemId, htmlData) { $(itemId).html(htmlData); },
        roundChagne: function(rid,name){
            var vars = this.Vars.round;
            //$(vars.id).html(name + '<i class="material-icons-round">arrow_drop_down</i>');
            $(vars.id).html(name);
            $(vars.value).val(gid);
        },
        gradeChagne: function (gid, name) {
            var vars = this.Vars.grade;
            //$(vars.id).html(name + '<i class="material-icons-round">arrow_drop_down</i>');
            $(vars.id).html(name);
            $(vars.value).val(gid);
            this.LoadSchool();
        },

        LoadProvince: function () {
            var vars = this.Vars.province;
            var url = '/apiInfo/getprovince';
            var parrent = this;
            $.get(url, function (dataResponse) {
                if (dataResponse.code == 1) {
                    var htmlList = '';
                    dataResponse.data.forEach(function (p) {
                        htmlList = htmlList + '<li style="width: 100%"><a class="dropdown-item" href="javascript:HomePage.RoundResult.proviceChagne(' + p.locationID + ',\'' + p.locationName + '\');">' + p.locationName + '</a></li>';
                    });
                    parrent.setHTML(vars.ul, htmlList);
                }
                Loading.close();
            });
        },
        proviceChagne: function (pid, name) {
            var vars = this.Vars.province;
            //$(vars.id).html(name +'<i class="material-icons-round">arrow_drop_down</i>');
            $(vars.id).html(name);
            $(vars.value).val(pid);
            if (pid == -1) {
                this.setHTML(vars.ul, '');
            }
            this.LoadVillage(pid);
        },
        LoadVillage: function (pid) {
            this.villageChange(-1, 'Chọn Quận/Huyện');
            if (pid == -1) return;
            var vars = this.Vars.village;
            var url = '/apiInfo/getvillage/' + pid;
            var parrent = this;
            $.get(url, function (dataResponse) {
                if (dataResponse.code == 1) {
                    var htmlList = '';
                    dataResponse.data.forEach(function (p) {
                        htmlList = htmlList + '<li style="width: 100%"><a class="dropdown-item" href="javascript:HomePage.RoundResult.villageChange(' + p.villageId + ',\'' + p.villageName + '\');">' + p.villageName + '</a></li>';
                    });
                    parrent.setHTML(vars.ul, htmlList);
                }
            });
        },
        villageChange: function (vid, name) {
            var vars = this.Vars.village;
            //$(vars.id).html(name + '<i class="material-icons-round">arrow_drop_down</i>');
            $(vars.id).html(name);
            $(vars.value).val(vid);
            if (vid == -1) {
                this.setHTML(vars.ul, '');
            }
            this.LoadSchool();
        },
        
        LoadSchool: function () {
            var vars = this.Vars;
            this.schoolChange(-1, "Chọn Trường");
            var pid = this.getIntValue(vars.province.value, 0);
            if (pid <= 0) return;
            var vid = this.getIntValue(vars.village.value, 0);
            var gid = this.getIntValue(vars.grade.value, 0);
            if (gid <= 0) return;
            if (gid < 4 && vid <= 0) return;
            if (vid == -1) vid = 0;

            var parrent = this;

            var url = '/apiInfo/getschool/' + pid + '/' + vid + '/' + gid;
            //alert(url);
            $.get(url, function (dataResponse) {
                if (dataResponse.code == 1) {
                    var htmlList = '';
                    dataResponse.data.forEach(function (p) {
                        htmlList = htmlList + '<li style="width: 100%"><a class="dropdown-item" href="javascript:HomePage.RoundResult.schoolChange(' + p.schoolID + ',\'' + p.schoolName + '\');">' + p.schoolName + '</a></li>';
                    });
                    parrent.setHTML(vars.school.ul, htmlList);
                }
            });
        },
        schoolChange: function (sid, name) {
            var vars = this.Vars.school;
            $(vars.value).val(sid);
            //$(vars.id).html(name + '<i class="material-icons-round">arrow_drop_down</i>');
            $(vars.id).html(name);
            if (sid == -1) {
                this.setHTML(vars.ul, '');
            }
        },
        search: function () {
            alert('search');
        },
    },
};