SafeMageQuoteWidget = Class.create();
SafeMageQuoteWidget.prototype = {
    initialize: function(config){
        var me = this;
        this.quotesSelector = config.quotesSelector;
        this.animationTime = config.animationTime * 1000;
        this.quotes = $$(config.quotesSelector);
        this.indexToShow = 0;

        this.showNext(this);
        this.start();
    },

    start: function() {
        var me = this;
        setInterval(function(){
            me.showNext(me);
        }, this.animationTime);
    },

    showNext: function(me) {
        me.hideAll();

        if (typeof(me.quotes[me.indexToShow + 1]) == 'undefined') {
            me.indexToShow = 0;
        }

        if (typeof(me.quotes[me.indexToShow]) != 'undefined') {
            me.quotes[me.indexToShow].show();
        }

        me.indexToShow++;
    },

    hideAll: function() {
        $$(this.quotesSelector).each(function(item){
            item.hide();
        });
    }
};
