function SpotMain() {
    this.scriptName = "mappoint.js";
    this.COMPRESSED = false;
    this.scriptLocation = null;
    this.scriptsToLoad = ["markermanager.js", "spot-widget.js"];
    this.stylesToLoad = ["spotlivewidget.css"]
}

function MarkerManager(e, t) {

    var n = this;
    n.map_ = e;
    n.mapZoom_ = e.getZoom();
    n.projectionHelper_ = new ProjectionHelperOverlay(e);
    google.maps.event.addListener(n.projectionHelper_, "ready", function() {
        n.projection_ = this.getProjection();
        n.initialize(e, t)
    })
}

function GridBounds(e) {
    this.minX = Math.min(e[0].x, e[1].x);
    this.maxX = Math.max(e[0].x, e[1].x);
    this.minY = Math.min(e[0].y, e[1].y);
    this.maxY = Math.max(e[0].y, e[1].y)
}

function ProjectionHelperOverlay(e) {
    this.setMap(e);
    var t = 8;
    var n = 1 << t;
    var r = 7;
    this._map = e;
    this._zoom = -1;
    this._X0 = this._Y0 = this._X1 = this._Y1 = -1
}
SpotMain.prototype.getScriptLocation = function() {
    if (this.scriptLocation == null) {
        var e = document.getElementsByTagName("script");
        for (var t = 0; t < e.length; t++) {
            var n = e[t].getAttribute("src");
            if (n) {
                var r = n.lastIndexOf(this.scriptName);
                var i = n.lastIndexOf("?");
                if (i < 0) {
                    i = n.length
                }
                if (r > -1 && r + this.scriptName.length == i) {
                    this.scriptLocation = n.slice(0, i - this.scriptName.length);
                    break
                }
            }
        }
    }
    return this.scriptLocation
};
SpotMain.prototype.loadStyles = function() {
    for (var e = 0; e < this.stylesToLoad.length; e++) {
        var t = document.getElementsByTagName("head")[0],
            n = document.createElement("link");
        n.rel = "stylesheet";
        n.type = "text/css";
        n.href = this.getScriptLocation() + this.stylesToLoad[e];
        n.media = "all";
        t.appendChild(n)
    }
};
SpotMain.prototype.loadScript = function(e) {
    document.write('<script src="' + this.getScriptLocation() + e + '"></script>')
};
SpotMain.prototype.loadScripts = function(e) {
    for (var t = 0; t < this.scriptsToLoad.length; t++) {
        this.loadScript(this.scriptsToLoad[t])
    }
};
SpotMain.prototype.load = function() {
    if (this.COMPRESSED === false) this.loadScripts();
    this.loadStyles()
};
window.spotMain = new SpotMain;
spotMain.load();
MarkerManager.prototype.initialize = function(e, t) {
    var n = this;
    t = t || {};
    n.tileSize_ = MarkerManager.DEFAULT_TILE_SIZE_;
    var r = e.mapTypes;
    var i = 1;
    for (var s in r) {
        if (typeof e.mapTypes.get(s) === "object" && typeof e.mapTypes.get(s).maxZoom === "number") {
            var o = e.mapTypes.get(s).maxZoom;
            if (o > i) {
                i = o
            }
        }
    }
    n.maxZoom_ = t.maxZoom || 19;
    n.trackMarkers_ = t.trackMarkers;
    n.show_ = t.show || true;
    var u;
    if (typeof t.borderPadding === "number") {
        u = t.borderPadding
    } else {
        u = MarkerManager.DEFAULT_BORDER_PADDING_
    }
    n.swPadding_ = new google.maps.Size(-u, u);
    n.nePadding_ = new google.maps.Size(u, -u);
    n.borderPadding_ = u;
    n.gridWidth_ = {};
    n.grid_ = {};
    n.grid_[n.maxZoom_] = {};
    n.numMarkers_ = {};
    n.numMarkers_[n.maxZoom_] = 0;
    google.maps.event.addListener(e, "dragend", function() {
        n.onMapMoveEnd_()
    });
    google.maps.event.addListener(e, "zoom_changed", function() {
        n.onMapMoveEnd_()
    });
    n.removeOverlay_ = function(e) {
        e.setMap(null);
        n.shownMarkers_--
    };
    n.addOverlay_ = function(e) {
        if (n.show_) {
            e.setMap(n.map_);
            n.shownMarkers_++
        }
    };
    n.resetManager_();
    n.shownMarkers_ = 0;
    n.shownBounds_ = n.getMapGridBounds_();
    google.maps.event.trigger(n, "loaded")
};
MarkerManager.DEFAULT_TILE_SIZE_ = 1024;
MarkerManager.DEFAULT_BORDER_PADDING_ = 100;
MarkerManager.MERCATOR_ZOOM_LEVEL_ZERO_RANGE = 256;
MarkerManager.prototype.resetManager_ = function() {
    var e = MarkerManager.MERCATOR_ZOOM_LEVEL_ZERO_RANGE;
    for (var t = 0; t <= this.maxZoom_; ++t) {
        this.grid_[t] = {};
        this.numMarkers_[t] = 0;
        this.gridWidth_[t] = Math.ceil(e / this.tileSize_);
        e <<= 1
    }
};
MarkerManager.prototype.clearMarkers = function() {
    this.processAll_(this.shownBounds_, this.removeOverlay_);
    this.resetManager_()
};
MarkerManager.prototype.getTilePoint_ = function(e, t, n) {
    var r = this.projectionHelper_.LatLngToPixel(e, t);
    var i = new google.maps.Point(Math.floor((r.x + n.width) / this.tileSize_), Math.floor((r.y + n.height) / this.tileSize_));
    return i
};
MarkerManager.prototype.addMarkerBatch_ = function(e, t, n) {
    var r = this;
    var i = e.getPosition();
    e.MarkerManager_minZoom = t;
    if (this.trackMarkers_) {
        google.maps.event.addListener(e, "changed", function(e, t, n) {
            r.onMarkerMoved_(e, t, n)
        })
    }
    var s = this.getTilePoint_(i, n, new google.maps.Size(0, 0, 0, 0));
    for (var o = n; o >= t; o--) {
        var u = this.getGridCellCreate_(s.x, s.y, o);
        u.push(e);
        s.x = s.x >> 1;
        s.y = s.y >> 1
    }
};
MarkerManager.prototype.isGridPointVisible_ = function(e) {
    var t = this.shownBounds_.minY <= e.y && e.y <= this.shownBounds_.maxY;
    var n = this.shownBounds_.minX;
    var r = n <= e.x && e.x <= this.shownBounds_.maxX;
    if (!r && n < 0) {
        var i = this.gridWidth_[this.shownBounds_.z];
        r = n + i <= e.x && e.x <= i - 1
    }
    return t && r
};
MarkerManager.prototype.onMarkerMoved_ = function(e, t, n) {
    var r = this.maxZoom_;
    var i = false;
    var s = this.getTilePoint_(t, r, new google.maps.Size(0, 0, 0, 0));
    var o = this.getTilePoint_(n, r, new google.maps.Size(0, 0, 0, 0));
    while (r >= 0 && (s.x !== o.x || s.y !== o.y)) {
        var u = this.getGridCellNoCreate_(s.x, s.y, r);
        if (u) {
            if (this.removeFromArray_(u, e)) {
                this.getGridCellCreate_(o.x, o.y, r).push(e)
            }
        }
        if (r === this.mapZoom_) {
            if (this.isGridPointVisible_(s)) {
                if (!this.isGridPointVisible_(o)) {
                    this.removeOverlay_(e);
                    i = true
                }
            } else {
                if (this.isGridPointVisible_(o)) {
                    this.addOverlay_(e);
                    i = true
                }
            }
        }
        s.x = s.x >> 1;
        s.y = s.y >> 1;
        o.x = o.x >> 1;
        o.y = o.y >> 1;
        --r
    }
    if (i) {
        this.notifyListeners_()
    }
};
MarkerManager.prototype.removeMarker = function(e) {
    var t = this.maxZoom_;
    var n = false;
    var r = e.getPosition();
    var i = this.getTilePoint_(r, t, new google.maps.Size(0, 0, 0, 0));
    while (t >= 0) {
        var s = this.getGridCellNoCreate_(i.x, i.y, t);
        if (s) {
            this.removeFromArray_(s, e)
        }
        if (t === this.mapZoom_) {
            if (this.isGridPointVisible_(i)) {
                this.removeOverlay_(e);
                n = true
            }
        }
        i.x = i.x >> 1;
        i.y = i.y >> 1;
        --t
    }
    if (n) {
        this.notifyListeners_()
    }
    this.numMarkers_[e.MarkerManager_minZoom]--
};
MarkerManager.prototype.addMarkers = function(e, t, n) {
    var r = this.getOptMaxZoom_(n);
    for (var i = e.length - 1; i >= 0; i--) {
        this.addMarkerBatch_(e[i], t, r)
    }
    this.numMarkers_[t] += e.length
};
MarkerManager.prototype.getOptMaxZoom_ = function(e) {
    return e || this.maxZoom_
};
MarkerManager.prototype.getMarkerCount = function(e) {
    var t = 0;
    for (var n = 0; n <= e; n++) {
        t += this.numMarkers_[n]
    }
    return t
};
MarkerManager.prototype.getMarker = function(e, t, n) {
    var r = new google.maps.LatLng(e, t);
    var i = this.getTilePoint_(r, n, new google.maps.Size(0, 0, 0, 0));
    var s = new google.maps.Marker({
        position: r
    });
    var o = this.getGridCellNoCreate_(i.x, i.y, n);
    if (o !== undefined) {
        for (var u = 0; u < o.length; u++) {
            if (e === o[u].getLatLng().lat() && t === o[u].getLatLng().lng()) {
                s = o[u]
            }
        }
    }
    return s
};
MarkerManager.prototype.addMarker = function(e, t, n) {
    var r = this.getOptMaxZoom_(n);
    this.addMarkerBatch_(e, t, r);
    var i = this.getTilePoint_(e.getPosition(), this.mapZoom_, new google.maps.Size(0, 0, 0, 0));
    if (this.isGridPointVisible_(i) && t <= this.shownBounds_.z && this.shownBounds_.z <= r) {
        this.addOverlay_(e);
        this.notifyListeners_()
    }
    this.numMarkers_[t]++
};
GridBounds.prototype.equals = function(e) {
    if (this.maxX === e.maxX && this.maxY === e.maxY && this.minX === e.minX && this.minY === e.minY) {
        return true
    } else {
        return false
    }
};
GridBounds.prototype.containsPoint = function(e) {
    var t = this;
    return t.minX <= e.x && t.maxX >= e.x && t.minY <= e.y && t.maxY >= e.y
};
MarkerManager.prototype.getGridCellCreate_ = function(e, t, n) {
    var r = this.grid_[n];
    if (e < 0) {
        e += this.gridWidth_[n]
    }
    var i = r[e];
    if (!i) {
        i = r[e] = [];
        return i[t] = []
    }
    var s = i[t];
    if (!s) {
        return i[t] = []
    }
    return s
};
MarkerManager.prototype.getGridCellNoCreate_ = function(e, t, n) {
    var r = this.grid_[n];
    if (e < 0) {
        e += this.gridWidth_[n]
    }
    var i = r[e];
    return i ? i[t] : undefined
};
MarkerManager.prototype.getGridBounds_ = function(e, t, n, r) {
    t = Math.min(t, this.maxZoom_);
    var i = e.getSouthWest();
    var s = e.getNorthEast();
    var o = this.getTilePoint_(i, t, n);
    var u = this.getTilePoint_(s, t, r);
    var a = this.gridWidth_[t];
    if (s.lng() < i.lng() || u.x < o.x) {
        o.x -= a
    }
    if (u.x - o.x + 1 >= a) {
        o.x = 0;
        u.x = a - 1
    }
    var f = new GridBounds([o, u]);
    f.z = t;
    return f
};
MarkerManager.prototype.getMapGridBounds_ = function() {
    return this.getGridBounds_(this.map_.getBounds(), this.mapZoom_, this.swPadding_, this.nePadding_)
};
MarkerManager.prototype.onMapMoveEnd_ = function() {
    this.objectSetTimeout_(this, this.updateMarkers_, 0)
};
MarkerManager.prototype.objectSetTimeout_ = function(e, t, n) {
    return window.setTimeout(function() {
        t.call(e)
    }, n)
};
MarkerManager.prototype.visible = function() {
    return this.show_ ? true : false
};
MarkerManager.prototype.isHidden = function() {
    return !this.show_
};
MarkerManager.prototype.show = function() {
    this.show_ = true;
    this.refresh()
};
MarkerManager.prototype.hide = function() {
    this.show_ = false;
    this.refresh()
};
MarkerManager.prototype.toggle = function() {
    this.show_ = !this.show_;
    this.refresh()
};
MarkerManager.prototype.refresh = function() {
    if (this.shownMarkers_ > 0) {
        this.processAll_(this.shownBounds_, this.removeOverlay_)
    }
    if (this.show_) {
        this.processAll_(this.shownBounds_, this.addOverlay_)
    }
    this.notifyListeners_()
};
MarkerManager.prototype.updateMarkers_ = function() {
    this.mapZoom_ = this.map_.getZoom();
    var e = this.getMapGridBounds_();
    if (e.equals(this.shownBounds_) && e.z === this.shownBounds_.z) {
        return
    }
    if (e.z !== this.shownBounds_.z) {
        this.processAll_(this.shownBounds_, this.removeOverlay_);
        if (this.show_) {
            this.processAll_(e, this.addOverlay_)
        }
    } else {
        this.rectangleDiff_(this.shownBounds_, e, this.removeCellMarkers_);
        if (this.show_) {
            this.rectangleDiff_(e, this.shownBounds_, this.addCellMarkers_)
        }
    }
    this.shownBounds_ = e;
    this.notifyListeners_()
};
MarkerManager.prototype.notifyListeners_ = function() {
    google.maps.event.trigger(this, "changed", this.shownBounds_, this.shownMarkers_)
};
MarkerManager.prototype.processAll_ = function(e, t) {
    for (var n = e.minX; n <= e.maxX; n++) {
        for (var r = e.minY; r <= e.maxY; r++) {
            this.processCellMarkers_(n, r, e.z, t)
        }
    }
};
MarkerManager.prototype.processCellMarkers_ = function(e, t, n, r) {
    var i = this.getGridCellNoCreate_(e, t, n);
    if (i) {
        for (var s = i.length - 1; s >= 0; s--) {
            r(i[s])
        }
    }
};
MarkerManager.prototype.removeCellMarkers_ = function(e, t, n) {
    this.processCellMarkers_(e, t, n, this.removeOverlay_)
};
MarkerManager.prototype.addCellMarkers_ = function(e, t, n) {
    this.processCellMarkers_(e, t, n, this.addOverlay_)
};
MarkerManager.prototype.rectangleDiff_ = function(e, t, n) {
    var r = this;
    r.rectangleDiffCoords_(e, t, function(t, i) {
        n.apply(r, [t, i, e.z])
    })
};
MarkerManager.prototype.rectangleDiffCoords_ = function(e, t, n) {
    var r = e.minX;
    var i = e.minY;
    var s = e.maxX;
    var o = e.maxY;
    var u = t.minX;
    var a = t.minY;
    var f = t.maxX;
    var l = t.maxY;
    var c, h;
    for (c = r; c <= s; c++) {
        for (h = i; h <= o && h < a; h++) {
            n(c, h)
        }
        for (h = Math.max(l + 1, i); h <= o; h++) {
            n(c, h)
        }
    }
    for (h = Math.max(i, a); h <= Math.min(o, l); h++) {
        for (c = Math.min(s + 1, u) - 1; c >= r; c--) {
            n(c, h)
        }
        for (c = Math.max(r, f + 1); c <= s; c++) {
            n(c, h)
        }
    }
};
MarkerManager.prototype.removeFromArray_ = function(e, t, n) {
    var r = 0;
    for (var i = 0; i < e.length; ++i) {
        if (e[i] === t || n && e[i] === t) {
            e.splice(i--, 1);
            r++
        }
    }
    return r
};
ProjectionHelperOverlay.prototype = new google.maps.OverlayView;
ProjectionHelperOverlay.prototype.LngToX_ = function(e) {
    return 1 + e / 180
};
ProjectionHelperOverlay.prototype.LatToY_ = function(e) {
    var t = Math.sin(e * Math.PI / 180);
    return 1 - .5 / Math.PI * Math.log((1 + t) / (1 - t))
};
ProjectionHelperOverlay.prototype.LatLngToPixel = function(e, t) {
    var n = this._map;
    var r = this.getProjection().fromLatLngToDivPixel(e);
    var i = {
        x: ~~(.5 + this.LngToX_(e.lng()) * (2 << t + 6)),
        y: ~~(.5 + this.LatToY_(e.lat()) * (2 << t + 6))
    };
    return i
};
ProjectionHelperOverlay.prototype.draw = function() {
    if (!this.ready) {
        this.ready = true;
        google.maps.event.trigger(this, "ready")
    }
};
if (!Object.create) {
    Object.create = function() {
        function e() {}
        return function(t) {
            if (arguments.length != 1) {
                throw new Error("Object.create implementation only accepts one parameter.")
            }
            e.prototype = t;
            return new e
        }
    }()
}(function(e, t, n, r) {
    var i = {
        init: function(t, n) {
            var r = this;
            r.elem = n;
            r.$elem = e(n);
            r.polylines = new Array;
            r.markermgr = new Array;
            r.devicePoints = new Array;
            r.topBarHeight = 0;
            r.limit = 50;
            r.colorList = ["#f21223", "#16a0a2", "#f3a128", "#1dc64d", "#fedb0a"];
            r.options = e.extend({}, e.fn.spotLiveWidget.options, t);
            r.apiURL = "https://api.findmespot.com/spot-main-web/consumer/rest-api/2.0/public/feed/";
            r.sharePageURL = "http://share.findmespot.com/shared/faces/viewspots.jsp?glId=" + r.options.feedId;
            r.imageLocation = "http://d3ra5e5xmvzawh.cloudfront.net/live-widget/2.0/Resources/images/";
            r.imageLocetion = "";
            // r.$elem.height(r.options.height);
            // r.$elem.width(r.options.width);
            // r.$elem.css("position", "relative");
            if (!r.options.showLegend) r.options.legendHeight = 0;
            r.$mapTopBar = e("<div />", {
                "class": "slw-top-bar"
            }).height(r.topBarHeight).appendTo(r.elem);
            r.$mapElem = e("<div />", {
                "class": "slw-map"
            }).height(r.options.height - (r.topBarHeight + r.options.legendHeight)).appendTo(r.elem);
            r.$mapMessage = e("<div />", {
                "class": "slw-message"
            }).hide().height(r.options.height).width(r.options.width).appendTo(r.elem);
            if (r.options.showLegend) r.$mapLegendElem = e("<div />", {
                "class": "slw-legend"
            }).height(r.options.legendHeight).appendTo(r.elem);
            r.showTopBar();
            r.map = r.initMap();
            r.showOverlays();
            if (r.options.autoRefresh >= 1) r.refresh(r.options.autoRefresh)
        },
        markerImage: function(e) {
            var t = {
                "EXTREME-TRACK": this.imageLocation + "icon_extreme.png",
                "UNLIMITED-TRACK": this.imageLocation + "icon_trackprogress.png",
                TRACK: this.imageLocation + "icon_track.png",
                OK: this.imageLocation + "icon_help.png",
                NEWMOVEMENT: this.imageLocation + "icon_new.png",
                STATUS: this.imageLocation + "icon_status.png",
                STOP: this.imageLocation + "icon_stop.png",
                HELP: this.imageLocation + "icon_help.png",
                DEFAULT: this.imageLocation + "icon_default.png",
                SPOTTRACE: this.imageLocation + "icon_trace.png",
                SPOTCONNECT: this.imageLocation + "icon_connect.png",
                SPOTDC: this.imageLocation + "icon_spotdc.png",
                SPOT1: this.imageLocation + "icon_spot1.png",
                SPOT2: this.imageLocation + "icon_spot2.png",
                SPOT3: this.imageLocetion + "icon/ico.png",
                HUG: this.imageLocation + "icon_hug.png",
                SPOT: this.imageLocation + "icon_spot1.png",
                INITIALPOINT: this.imageLocation + "icon_start.png"
            };
            return t[e]
        },
        deviceIcons: function(e) {
            var t = {
                SPOTTRACE: this.imageLocation + "devices/sm_trace.png",
                SPOTCONNECT: this.imageLocation + "devices/sm_connect.png",
                SPOTDC: this.imageLocation + "devices/sm_spotdc.png",
                SPOT1: this.imageLocetion + "icon/ico.png",
                SPOT2: this.imageLocetion + "icon/ico.png",
                SPOT3: this.imageLocetion + "icon/ico.png",
                HUG: this.imageLocation + "devices/sm_hug.png",
                SPOT: this.imageLocation + "devices/sm_spot1.png"
            };
            return t[e]
        },
        topBarHTML: function() {
            // var e = '<div class="top-bar-content">' + '<a href="http://nakulaproject.org" target="_blank"><img src="http://216.139.240.35.bc.googleusercontent.com/assets/logos/iibs-small.png" alt="spot-logo" /></a>' + '<div class="right-top"><span class="slw-btn"><span class="refresh-slw"></span></span>' + '<span class="slw-btn"><a class="full-scr-slw" href="' + this.sharePageURL + '" target="_blank"></a></span>' + "</div>" + "</div>";
            // return e
        },
        showTopBar: function() {
            var e = this;
            e.$mapTopBar.html(e.topBarHTML());
            e.$elem.find(".refresh-slw").on("click", function(t) {
                t.stopImmediatePropagation();
                e.updateOverlays()
            })
        },
        fetchPoints: function() {
            var t = this.apiURL + this.options.feedId + "/message?limit=" + this.limit;
            return e.ajax({
                url: t,
                dataType: "jsonp",
                crossDomain: true
            })
        },
        isPointsValid: function(e, t) {
            if (e < -90 || e > 90) return false;
            if (t < -180 || t > 180) return false;
            return true
        },
        filterDevices: function(t) {
            var n = {},
                r = this;
            e.each(t, function(e, t) {
                if (!r.isPointsValid(t.latitude, t.longitude)) return true;
                if (typeof n[t.messengerId] == "undefined") n[t.messengerId] = [];
                n[t.messengerId].push(t)
            });
            return n
        },
        infoWindowHTML: function(e) {
            if(e.messageType == "OK"){ var gf = "SOS"; }
            else{
               var gf = e.messageType; 
            }
var t = '<div class="info-window">' + '<div class="title">' + e.messengerName + "</div>" + '<div class="item-title">ESN:</div>  <div class="item-value">' + e.messengerId + "</div>" + '<div class="item-title">Type:</div>  <div class="item-value">' + gf + "</div>" + '<div class="item-title">Latitude:</div>  <div class="item-value">' + e.latitude + "</div>" + '<div class="item-title">Longitude:</div>  <div class="item-value">' + e.longitude + "</div>" + '<div class="item-title">Date:</div>  <div class="item-value">' + this.formatDate(e.dateTime) + "</div>" + '<div class="item-title">Battery State:</div>  <div class="item-value">' + e.batteryState + "</div>" + "</div>";
            return t
        },
        formatDate: function(e) {
            var t = e.split("T"),
                n = t[0].split("-"),
                r = t[1].split("Z"),
                i = r[0].split(":"),
                s = i[2].split("+"),
                o = Number(i[0]),
                u = new Date;
            u.setUTCFullYear(Number(n[0]));
            u.setUTCMonth(Number(n[1]) - 1);
            u.setUTCDate(Number(n[2]));
            u.setUTCHours(Number(o));
            u.setUTCMinutes(Number(i[1]));
            u.setUTCSeconds(Number(s[0]));
            if (s[1]) u.setUTCMilliseconds(Number(s[1]));
            var a = u.getMonth() + 1,
                f = u.getDate(),
                l = u.getFullYear(),
                c = (u.getHours() < 10 && u.getHours() > 0 ? "0" : "") + u.getHours(),
                h = (u.getMinutes() < 10 ? "0" : "") + u.getMinutes(),
                p = (u.getSeconds() < 10 ? "0" : "") + u.getSeconds();
            return a + "/" + f + "/" + l + " " + c + ":" + h + ":" + p
        },
        setDeviceColors: function() {
            var t = this,
                n = 0;
            if (typeof t.options.polyline.strokeColor == "undefined") t.options.polyline.strokeColor = {};
            e.each(t.devicePoints, function(e, r) {
                t.options.polyline.strokeColor[r[0]["messengerId"]] = t.options.polyline.strokeColor[r[0]["messengerId"]] || t.colorList[n++] || t.getRandomColor()
            })
        },
        getLegendHTML: function(e) {
            var t = this.deviceIcons(e.deviceModel) || this.deviceIcons("SPOT");
            var n = '<div class="device" style="background: ' + e.color + ';">';
            n += '<div class="device-content">';
            n += '<img src="' + t + '" alt="spot_device" />';
            n += "<span>" + e.deviceName + "</span>";
            n += '<input type="checkbox" class="' + e.deviceId + '" checked/>';
            n += "</div>";
            n += "</div>";
            return n
        },
        addLegend: function() {
            var t = this;
            e.each(t.devicePoints, function(e, n) {
                var r = {
                    deviceId: n[0]["messengerId"],
                    deviceName: n[0]["messengerName"],
                    deviceModel: n[0]["modelId"],
                    color: t.options.polyline.strokeColor[n[0]["messengerId"]]
                };
                t.$mapLegendElem.css({
                    overflow: "auto"
                }).append(t.getLegendHTML(r));
                t.$elem.find("." + r.deviceId).on("click", {
                    me: t
                }, t.toggleMarkers)
            })
        },
        toggleMarkers: function(t) {
            var n = t.data.me,
                r = e(this).attr("class"),
                i = false;
            if (e(this).is(":checked")) i = true;
            if (i) n.markermgr[r].show();
            else n.markermgr[r].hide();
            n.polylines[r].setVisible(i)
        },
        initMap: function() {
            var e = {
                center: new google.maps.LatLng(0, 0),
                zoom: 1,
                scaleControl: true,
                mapTypeId: google.maps.MapTypeId[this.options.mapType]
            };
            return new google.maps.Map(this.$mapElem.get(0), e)
        },
        clearAllOverlays: function() {
            var e = this;
            for (var t in e.polylines) {
                e.polylines[t].setMap(null);
                e.markermgr[t].clearMarkers();
                e.markermgr[t].refresh()
            }
            e.polylines = new Array;
            e.markermgr = new Array
        },
        updateOverlays: function() {
            var e = this;
            e.clearAllOverlays();
            if (e.options.showLegend) e.$mapLegendElem.empty();
            e.showOverlays()
        },
        refresh: function(e) {
            var t = this;
            setInterval(function() {
                t.updateOverlays()
            }, e * 1e3 * 60)
        },
        showMessage: function(e) {
            var t = this,
                n = '<div class="slw-text">' + "<span>" + e + "</span>" + "</div>";
            t.$mapMessage.html(n);
            t.$mapMessage.fadeIn(300)
        },
        hideMessage: function() {
            this.$mapMessage.hide()
        },
        showOverlays: function() {
            var t = this;
            t.showMessage("Loading...");
            t.fetchPoints().done(function(n) {
                if (typeof n.response.errors != "undefined") {
                    t.showMessage(n.response.errors.error.text);
                    return
                }
                if (!(n.response.feedMessageResponse.messages.message instanceof Array)) {
                    n.response.feedMessageResponse.messages.message = new Array(n.response.feedMessageResponse.messages.message)
                }
                var r = new google.maps.LatLngBounds;
                t.devicePoints = t.filterDevices(n.response.feedMessageResponse.messages.message);
                t.setDeviceColors();
                if (t.options.showLegend) t.addLegend();
                e.each(t.devicePoints, function(e, n) {
                    t.createMarkers(n, r)
                });
                t.map.fitBounds(r);
                t.hideMessage()
            }).fail(function() {
                t.showMessage("Something went wrong.")
            })
        },
        createMarkers: function(t, n) {
            var r = this,
                i = [],
                s = t[0]["messengerId"];
            r.markermgr[s] = new MarkerManager(r.map);
            e.each(t, function(e, s) {
                var o, u, a = 1;
                if (e === 0) {
                    u = r.markerImage(s.modelId) || r.markerImage("DEFAULT");
                    a = 3
                } else if (e === t.length - 1) {
                    u = r.markerImage("INITIALPOINT");
                    a = 2
                } else {
                    u = r.markerImage(s.messageType) || r.markerImage("DEFAULT")
                }
                o = new google.maps.Marker({
                    position: r.getLatLng(s),
                    title: s.messengerName,
                    icon: u,
                    zIndex: a
                });
                i.push(o);
                r.setMarkerInfowindow(o, s);
                n.extend(r.getLatLng(s))
            });
            google.maps.event.addListener(r.markermgr[s], "loaded", function() {
                r.markermgr[s].addMarkers(i, 1);
                r.markermgr[s].refresh();
                r.addPolyline(t)
            })
        },
        getLatLng: function(e) {
            return new google.maps.LatLng(e.latitude, e.longitude)
        },
        addPolyline: function(t) {
            var n = [],
                r = this,
                i = t[0]["messengerId"];
            e.each(t, function(e, t) {
                n.push(r.getLatLng(t))
            });
            var s = new google.maps.Polyline({
                path: n,
                geodesic: true,
                strokeColor: r.options.polyline.strokeColor[i],
                strokeOpacity: 1,
                strokeWeight: r.options.polyline.strokeWeight
            });
            s.setMap(r.map);
            r.polylines[i] = s
        },
        setMarkerInfowindow: function(e, t) {
            var n = this,
                r;
            r = new google.maps.InfoWindow({
                content: n.infoWindowHTML(t)
            });
            google.maps.event.addListener(e, "click", function() {
                if (typeof n.openInfoWindow != "undefined") n.openInfoWindow.close();
		r.open(n.map, e);
                n.openInfoWindow = r
            })
        },
        getRandomColor: function() {
            var e;
            var t = Math.floor(Math.random() * 255);
            var n = Math.floor(Math.random() * 255);
            var r = Math.floor(Math.random() * 255);
            e = "rgb(" + t + "," + n + "," + r + ")";
            return e
        }
    };
    e.fn.spotLiveWidget = function(e) {
        
        var t = Object.create(i);
        t.init(e, this);
        return this
    };
    e.fn.spotLiveWidget.options = {
        feedId: "",
        mapType: "ROADMAP",
        height: 500,
        width: 500,
        legendHeight: 0,
        showLegend: true,
        autoRefresh: 0,
        polyline: {
            strokeWeight: 3,
            strokeColor: {}
        }
    }
})

(jQuery, window, document)
