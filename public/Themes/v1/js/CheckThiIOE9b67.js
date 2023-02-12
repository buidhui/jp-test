CheckThiIOE = {
    todate: new Date(2019, 11, 30, 0, 0, 0).getTime(),
    Init: function () {
        if ($("#examType").length == 0) return;
        if ($("#examdate").length == 0) return;
        var parrent = this;
        var setDate = $("#examdate").val();
        //alert(setDate);
        //getfro
        //parrent.todate = new Date(2019, 11, 30, 0, 0, 0).getTime();
        //parrent.todate = new Date('Nov 30, 2019 00:00:00').getTime();
        parrent.todate= new Date(setDate).getTime();
        this.countdown();
        setInterval(parrent.countdown, 60 * 1000);

        $("#ioe-exam-check").click(parrent.onCheck);
    },
    countdown: function () {
        const second = 1000, minute = second * 60, hour = minute * 60, day = hour * 24;
        var now = new Date().getTime();
        var distance = CheckThiIOE.todate - now;

        var days = Math.floor(distance / (day));
        if (days < 0) days = 0;
        var hours = Math.floor((distance % (day)) / (hour));
        if (hours < 0) hours = 0;
        var minutes = Math.floor((distance % (hour)) / (minute));
        if (minutes < 0) minutes = 0;
        //var seconds = Math.floor((distance % (minute)) / second);
        //var getTimeUpdate = "Thời gian update 3.0 còn " + days + "  Ngày " + hours + " Giờ " + minutes + " Phút.";

        if (isNaN(days)) {
            days = 0;
        }
            
        if (isNaN(hours)) {
            hours = 0;
        }
        if (isNaN(minutes)) {
            minutes = 0;
        }
        $("#days_countdown").text(days);
        $("#hours_countdown").text(hours);
        $("#minutes_countdown").text(minutes);
    },
    onCheck: function () {
        //IOEMain.showModel('Bạn chưa đăng nhập', 'Kiểm tra điều kiện dự thi');
        //checkcondition
        var url = '/thiioe/checkcondition';
        var inputData = {}
        IOEMain.postJson(url, inputData, function (dataRes) {
            IOEMain.showModel(dataRes.message, 'Kiểm tra điều kiện dự thi');
        });
    },
}
CheckThiIOE.Init();