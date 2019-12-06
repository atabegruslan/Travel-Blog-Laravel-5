(function ($) {

    $.slider = function(length, curr, duration) {

        this.duration = duration;
        this.length = length;
        this.curr = curr;
        var width = $(".slides-holder").width();
        var currPos, initPos, endPos, initCutOffPos, endCutOffPos;

    };

    $.slider.prototype.set = function(target){
        this.width = $(".slides-holder").width();
        target.width( this.width );
        target.find( ".slideshow" ).width( this.width * (this.length+2) );
        target.find( ".slideshow > li > img" ).width( this.width );
        this.currPos = this.width * this.curr;
        this.initPos = this.width * 1;
        this.endPos = this.width * this.length;
        this.initCutOffPos = this.width * 0;
        this.endCutOffPos = this.width * (this.length+1);
        target.find( ".slideshow" ).css('marginLeft', '-'+ this.currPos +'px' );       
    };

    $.slider.prototype.populate = function(target, data){

        var title = $("<h2 class=\'title\'>"+ data.title +"</h2>");
        target.append(title);

        // add ul to root slider div
        var slides = $("<ul class=\'slideshow\'></ul>");
        target.append(slides);

        // add li img's to ul
        $.each(data.pictures, function( index, value ) {
            if( index === 0 ){
                slides.append( "<li><img src=\'"+ data.pictures[data.pictures.length-1] +"\' /></li>" );
            }
            slides.append( "<li><img src=\'"+ value +"\' /></li>" );
            if( index === data.pictures.length-1 ){
                slides.append( "<li><img src=\'"+ data.pictures[0] +"\' /></li>" );
            }
        });

        var arrows = $("<div class=\'arrows\'></div>");
        var prev = $("<a class=\'prev\' href=\'#\'>Previous</a>");
        var next = $("<a class=\'next\' href=\'#\'>Next</a>");
        arrows.append(prev).append(next);
        target.append(arrows);

        var _this = this;
        $(prev).click(function(e) {
            e.preventDefault();
            _this.next(target.find(".slideshow"), _this);
        });
        $(next).click(function(e) {
            e.preventDefault();
            _this.prev(target.find(".slideshow"), _this);
        });

        var dots = $("<div class=\'dots\'></div>");
        for(let i = 1; i <= data.pictures.length; i++){
            var dot = $("<span></span>");
            $(dot).click(function(e) {
                e.preventDefault();
                _this.jumpTo(target.find(".slideshow"), _this, i);
            });
            dots.append(dot);
        }
        target.append(dots);
    };

    $.slider.prototype.jumpTo = function(target, slider, index){
        var to = -1*index*slider.width;
        var jumps = Math.abs(slider.curr-index);
        var dur = slider.duration * jumps;
        target.animate({'margin-left': to}, dur, function(){
            slider.curr = index;
        });
    };
        
    $.slider.prototype.onSwipe = function(target){
        var _this = this;
        Hammer( target[0] ).on("swipeleft", function (e) {
            _this.next(target.find(".slideshow"), _this);
        });
        Hammer( target[0] ).on("swiperight", function (e) {
            _this.prev(target.find(".slideshow"), _this);
        });
    };

    $.slider.prototype.prev = function(target, slider){
        target.animate({'margin-left': '+='+slider.width}, slider.duration, function(){
            slider.curr += 1;
            if(slider.curr > slider.length){
                slider.curr = 1;
            }
            if(slider.curr < 1){
                slider.curr = slider.length;
            }
            if( target.css("marginLeft") === slider.initCutOffPos+'px'){
                target.css("marginLeft", '-'+slider.endPos+'px');
            }
        });   
    };

    $.slider.prototype.next = function(target, slider){
        target.animate({'margin-left': '-='+slider.width}, slider.duration, function(){
            slider.curr -= 1;
            if(slider.curr > slider.length){
                slider.curr = 1;
            }
            if(slider.curr < 1){
                slider.curr = slider.length;
            }
            if( target.css("marginLeft") === '-'+slider.endCutOffPos+'px'){
                target.css("marginLeft", '-'+slider.initPos+'px');
            }
        });
    };

    $.fn.slider = function(data) {

        // target slideshow
        var $target = $(this);

        // rid annoying dragging effect on all browsers
        $target.on('dragstart', function(event) { 
            event.preventDefault(); 
        });

        // slider setting object
        var slider = new $.slider(data.pictures.length, 1, data.fade);

        // set window size upon load and resize
        $(window).load(function() {
            slider.populate($target, data); 
            slider.set($target);  
            slider.onSwipe($target);
        }).resize(function() {
            slider.set($target);
        });
    };

})(jQuery);