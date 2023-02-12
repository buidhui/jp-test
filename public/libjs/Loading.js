Loading = new function (type = 1) {

    this.loadimg = "/images/loading.gif";
    this.loadimg2x = "/images/loading@2x.gif";
    this.m_idLoadingProcess = 'divLoadingProcess';
    this.showtopright = function () {
        if ($("#" + this.m_idLoadingProcess).length == 0) {
            $("body").append('<div id="' + this.m_idLoadingProcess + '" style="display: none;"></div>');
            var html = '<div style="position: fixed; z-index: 100000; top: 0px; left: 0px; width: 100%; height: 1970px; background: none; filter: alpha(opacity=40); opacity: 0.4;"></div>'
                + '<div style="background:#FFF; padding:10px; float:right; position:fixed; z-index:99999; top:0; right:0;  font-size:11px;"><img src="' + this.loadimg + '" style="width:16px; margin-right:5px; float:left;" />Đang xử lý...</div>';
            $("#" + this.m_idLoadingProcess).html(html);
        }
        $("#" + this.m_idLoadingProcess).show();
    };
    this.show = function () {
        if ($("#" + this.m_idLoadingProcess).length == 0) {
            $("body").append('<div id="' + this.m_idLoadingProcess + '" style="display: none; left: 0; overflow: hidden; position: absolute; top: 0; z - index: 8010; bottom: 0; position: fixed; right: 0; display: none; height: auto; width: auto;"></div>');
            var html = '<div style="left:50%;top:50%;position: relative"><img src="' + this.loadimg2x + '" alt="Đang xử lý..." /></div>';
            $("#" + this.m_idLoadingProcess).html(html);
        }
        $("#" + this.m_idLoadingProcess).show();
    };
    this.close = function () {
        if ($("#" + this.m_idLoadingProcess).length != 0) {
            $("#" + this.m_idLoadingProcess).remove();
        }
    };

};


