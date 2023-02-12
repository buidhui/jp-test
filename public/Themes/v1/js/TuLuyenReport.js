TuLuyenReport = {
    GetDetail: function (url) {
        $("#personalachievements").html("");
        Loading.show()
        $.get(url, function (resData) {
            $("#staticDetail").html(resData);
            Loading.close();
            IOEMain.scrollTo("#staticDetail", 1000);
        }).fail(function () { Loading.close(); });
        
    },
    Init: function () {
        this.NationStatistic();
    },
    NationStatistic: function () {
        var url = "/tuluyen/nationstatistic";
        TuLuyenReport.GetDetail(url);
    },
    ProvincialStatistics: function (pid, gid) {
        var url = "/tuluyen/provincestatistics/" + pid + '/' + gid;
        TuLuyenReport.GetDetail(url);
    },
    VillageStatistics: function (pid,vid,gid) {
        var url = "/tuluyen/villagestatistics/" + pid + '/' + vid + '/' + gid;
        TuLuyenReport.GetDetail(url);
    },
    SchoolStatistics: function (sid, gid, block) {
        if (block == null || block == undefined || block == 0) {
            if (gid == 1) block = 3;
            if (gid == 2) block = 6;
            if (gid == 3) block = 10;
        }
        var url = "/tuluyen/schoolstatistics/" + sid + '/' + block;
        TuLuyenReport.GetDetail(url);
    },
    PersonalAchievements: function (uid) {
        var url = "/tuluyen/personalachievements/" + uid;
        Loading.show()
        $.get(url, function (resData) {
            $("#personalachievements").html(resData);
            Loading.close();
            IOEMain.scrollTo("#personalachievements", 1000);
        }).fail(function () { Loading.close(); });;
    },
    //SelectClass: function (block) {

    //}
}