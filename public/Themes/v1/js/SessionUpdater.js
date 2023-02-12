// http://stackoverflow.com/a/14195869/1366033
SessionUpdater = (function () {
    var clientMovedSinceLastTimeout = false;
    var keepSessionAliveUrl = '';
    var timeout = 1000 * 120 ; // 1 minutes

    function setupSessionUpdater(actionUrl) {
        // store local value
        
        keepSessionAliveUrl = actionUrl;
        // setup handlers
        listenForChanges();
        // start timeout - it'll run after n minutes
        checkToKeepSessionAlive();
        console.log("SessionUpdater.setupSessionUpdater:  " + keepSessionAliveUrl);
    }

    function listenForChanges() {
        $("body").one("mousemove keydown", function () {
            clientMovedSinceLastTimeout = true;
            console.log("SessionUpdater.listenForChanges:  " + clientMovedSinceLastTimeout);
        });
    }


    // fires every n minutes - if there's been movement ping server and restart timer
    function checkToKeepSessionAlive() {
        setTimeout(function () { keepSessionAlive(); }, timeout);
    }

    function keepSessionAlive() {
        // if we've had any movement since last run, ping the server
        if (keepSessionAliveUrl == null || keepSessionAliveUrl == undefined || keepSessionAliveUrl.length == 0) {
            return;
        }
        if (!clientMovedSinceLastTimeout) {
            $.ajax({
                type: "POST",
                url: keepSessionAliveUrl,
                success: function (data) {
                    console.log("SessionUpdater.keepSessionAlive ajax data:  " + JSON.stringify(data));
                    if (data.code == 1) {
                        // reset movement flag
                        clientMovedSinceLastTimeout = false;
                        // start listening for changes again
                        listenForChanges();
                        // restart timeout to check again in n minutes
                        checkToKeepSessionAlive();
                    }
                    else {
                        if (data.redirectUrl.length > 0) {
                            IOEMain.Redirect(data.redirectUrl);
                        }
                        
                    }
                },
                error: function (data) {
                    console.log("SessionUpdater.keepSessionAlive Error posting to " + data);
                }
            });
        }
        else {
            clientMovedSinceLastTimeout = false;
            listenForChanges();
            checkToKeepSessionAlive();
        }
    }

    // export setup method
    return {
        Setup: setupSessionUpdater
    };

})();