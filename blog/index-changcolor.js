function Skin(options) {

this.config = {
    targetElem: '.targetElem',
    link: '#link',
    type: 'cookie' // 或者storage，( PHP为后端设置
};
this.cache = {
    defaultList: ['default','green','red','orange']
};

this.init(options);
}

Skin.prototype = {
    constructor: Skin,
    init: function(options) {
        this.config = $.extend(this.config,options || {});
        var self = this,
            _config = self.config;
        
        $(_config.targetElem).each(function(index,item) {
            
            $(item).unbind('click');
            $(item).bind('click',function(){
                var attr = $(this).attr('data-value');
                self.setTheme(attr);
            });
        });
        if(self.config.type === 'storage') { //1
            var tempCookeie = self._loadStorage("skinName"),
                t;
            if(tempCookeie != "null") {
                t = tempCookeie;
            } else {
                t = 'default';
            }
            self._setSkin(t);

        } else {
            var tempCookeie = self._getCookie("skinName");
            self._setSkin(tempCookeie);
        }
    },
    /*
     *  来设置css样式
     */
    setTheme: function(attr) {
        var self = this,
            _config = self.config,
            _cache = self.cache;
        
        if(self.config.type === 'storage') { //2
            self._doStorage(attr);
            var istrue = localStorage.getItem(attr);
            self._setSkin(attr);
        }else {
            var istrue = self._getCookie(attr);
            if(istrue) {
                for(var i = 0; i < _cache.defaultList.length; i++) {
                    if(istrue == _cache.defaultList[i]) {
                        self._setSkin(_cache.defaultList[i]);
                    }
                }
            }
        }
    },
    /*
     * 改变样式
     */
    _setSkin: function(skinValue){
        
        var self = this,
            _config = self.config;
        
        if(!skinValue) {
            if(self.config.type === 'storage') {
                skinValue = self._loadStorage('skinName');
            }else {
                skinValue = self._getCookie("skinName");
            }
        }
        $(_config.link).attr('href',"style/"+skinValue+".css");

        localStorage.setItem("mySkin", skinValue);
        if(self.config.type === 'storage') { //3
            self._saveStorage(skinValue);
        }else {
            self._setCookie("skinName",skinValue,7);
        }
        
    },

    _doStorage: function(attr) {
        var self = this;
        self._saveStorage(attr);
    },
    /*
     * html5获取本地存储
     */
    _loadStorage: function(attr) {
        var str = localStorage.getItem(attr);
        return str;
    },
    /*
     * HTML5本地存储 
     */
    _saveStorage:function(skinValue) {
        var self = this;
        localStorage.setItem("skinName",skinValue);
    },
    /*
     * getCookie
     */
    _getCookie: function(name) {
        var self = this,
            _config = self.config;
        var arr = document.cookie.split("; ");
        for(var i = 0; i < arr.length; i+=1) {
            var prefix = arr[i].split('=');
            if(prefix[0] == name) {
                return prefix[1];
            }
        }
        return name;
    },
    /*
     * _setCookie
     */
    _setCookie: function(name,value,days) {
        var self = this;

        if (days){
            var date = new Date();
            date.setTime(date.getTime()+(days*24*60*60*1000));
            var expires = "; expires="+date.toGMTString();
        }else {
            var expires = "";
        }
        document.cookie = name+"="+value+expires+"; path=/";
    },
    /*
     * removeCookie
     */
    _removeCookie: function(name) {
        var self = this;

        //调用_setCookie()函数,设置为1天过期,计算机自动删除过期cookie
        self._setCookie(name,1,1);
    }
 };

// 初始化
$(function(){
    var skin = new Skin({});
    $('.theme').on('click', function(e) {
        var value = $(this).data('value');
        skin.config.type = value;
        skin._setSkin();
        localStorage.setItem('type', value);
    });
});
 