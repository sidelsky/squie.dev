/*------------------------------------*\
	Portfolio
\*------------------------------------*/

var cssClasses = require('./config').cssClasses;

var Portfolio = function Portfolio($elem) {

    // Set variables
    var postId,
        activeClass,
        _this,
        dontGet,
        $spinloader,
        $closeButton,
        $item;

    this.$elem = $elem;

    //console.log(this.$elem);
    this.$portfolioItem = $('[data-portfolio-item]', this.$elem);
    this.$doorFrame = $('[data-door-frame]', this.$elem);
    this.$magicDoor = $('[data-magic-door]', this.$elem);
    this.$aboutSection = $('[data-about-section]');
    this.$logo = $('[data-logo]');
    this.$infoButton = $('[data-info-button]');
    this.url = $(this.$magicDoor).attr('data-url');
    this.$doc = $('html, body');
    this.speed = 700;
    this.dontGet = false;

    this._attachHandlers();
    this._handleLogoClick();
    this._infoButtonClick();
};


/*  Info button click action
 -----------------------------------*/
Portfolio.prototype._infoButtonClick = function() {

  _this = this;

  _this.$infoButton.on('click', function() {
    _this._scrollToTop();

    activeClass = cssClasses.isActive;

    _this.$aboutSection.toggleClass(activeClass);

    if(_this.$aboutSection.hasClass(activeClass)) {
      _this._randomColor();
    }

  });

};

//Random bg color;
Portfolio.prototype._randomColor = function() {
  var color = '#', // hexadecimal starting symbol
      //randomColor = ['A70267','F10C49','FB6B41','F6D86B','339194']; //Set your colors here
      // Grey
      //randomColor = ['2a2a2a','545454','d3d3d3','dbdbdb','f1f1f1', '202020']; //Set your colors here
      // Color
      //randomColor = ['DED4B9','46433A','CE534D','64B6B1']; //Set your colors here
      randomColor = ['030C22','20293F','404749','A9B0B3', '202020']; //Set your colors here
      color += randomColor[Math.floor(Math.random() * randomColor.length)];

      _this = this;

      _this.$aboutSection.css({
         backgroundColor: color
      });

      //$("#colorcode").text("#" + randomColor);
};


/*  Home logo click
 -----------------------------------*/
Portfolio.prototype._handleLogoClick = function() {
  _this = this;

  _this.$logo.on('click', function(e){

       if( !$('body').hasClass('single-portfolio') ) {
           e.preventDefault();
       }

    _this._scrollToTop();
  });



};

//Scroll to top of document
Portfolio.prototype._scrollToTop = function() {
  _this = this;
  // Scroll to the top of this elem
  _this.$doc.animate({
      scrollTop: $('#top').offset().top
  }, _this.speed, function(){
    _this._closeDoor();
    _this.$portfolioItem.removeClass(activeClass);
  });

};

/*  Attach handler event
 -----------------------------------*/
Portfolio.prototype._attachHandlers = function($elem) {

	_this = this;

    activeClass = cssClasses.isActive;

     _this.$portfolioItem.on('click', function(e) {
          e.preventDefault();

        if(!$(this).hasClass(activeClass)) {

            $item = $(this);

            // Scroll to the top of this elem
            _this.$doc.animate({
                scrollTop: $item.offset().top
            }, 200);

            _this.$portfolioItem.removeClass(activeClass);
            $(this).addClass(activeClass);


            // $('body').removeClass(activeClass);
            // $('body').addClass(activeClass);

            _this.postId = $(this).attr('id').split('portfolio-')[1];
            _this._getPortfolio(_this.postId, $item);

        }

     });

};


/*  Change Next Prev
-----------------------------------*/
Portfolio.prototype._changeNextPrev = function(postId) {

_this = this;

_this.next = _this._getNext(_this.postId);
_this.prev = _this._getPrev(_this.postId);

    $('#next-post').attr('data-id', _this.next);
    $('#prev-post').attr('data-id', _this.prev);

};


/*  Get portfolio
 -----------------------------------*/
Portfolio.prototype._getPortfolio = function(postId, dontGet) {

    //_this = this;

    if(!_this.dontGet)
        _this.dontGet = false;

        _this.next = _this._getNext(_this.postId);
        _this.prev = _this._getPrev(_this.postId);

    if(_this.dontGet === false) {

        // Spinloader
        $spinloader = $('[data-spin-loader]', $item);
        //$spinloader.fadeIn(200);
        $spinloader.addClass(cssClasses.isVisible);

        setTimeout(function(){

            _this._closeDoor();

            // Ajax this
            _this.$magicDoor.load(_this.url, {
                id: postId,
                next: _this.next,
				prev: _this.prev
            }, _this._loadCallBack);
        }, 1500);

    }

};

/*  After .load this gets called
 -----------------------------------*/
Portfolio.prototype._loadCallBack = function(postId) {

    // Next / Prev portfolio items
    $('#next-post, #prev-post').on('click', function() {
        _this.postId = $(this).attr('data-id');

        // Remove active class from current elem
        _this.$portfolioItem.removeClass(activeClass);

        // Next / Prev elem add active class
        $('#portfolio-' + _this.postId).addClass(activeClass);

        _this._getPortfolio(_this.postId);

        return false;
    });

    // scrollTop
    _this.$doc.animate({
        scrollTop: 0
    }, this.speed, _this._easeInOutQuart(), function() {

        // Portfolio init
        _this._portfolioInit();
        // Update post slug
        //_this._updatePostSlug();
        //Spinloader.fadeOut(300);
        $spinloader.removeClass(cssClasses.isVisible);

        setTimeout(function() {
            // About panel
            activeClass = cssClasses.isActive;
            _this.$aboutSection.removeClass(activeClass);

            //Open magic door
            _this._openDoor();
        }, 500);

    });

};





// Next
Portfolio.prototype._getNext = function(postId) {

_this = this;

//console.log(postId);

_this.next = $('#portfolio-items .visible').first().attr('id').split('portfolio-')[1];
//console.log(_this.next);

//has next var
_this.hasNext = $('#portfolio-' + _this.postId).next();
//console.log(_this.hasNext);

//if there is a next object
if(_this.hasNext.length !== 0) {

  while(_this.hasNext.hasClass('visible') === false && _this.hasNext.length !== 0) {
    _this.hasNext = _this.hasNext.next();
  }

  if(_this.hasNext.length !== 0) {
    _this.next = _this.hasNext.attr('id').split('portfolio-')[1];
  }
}

return _this.next;
};


//Prev
Portfolio.prototype._getPrev = function(postId) {

_this = this;

//console.log(postId);

_this.prev = $('#portfolio-items .visible').last().attr('id').split('portfolio-')[1];
//console.log(_this.prev);

//has next var
_this.hasPrev = $('#portfolio-' + _this.postId).prev();

//if there is a next object
if(_this.hasPrev.length !== 0) {

  while(_this.hasPrev.hasClass('visible') === false && _this.hasPrev.length !== 0) {
    _this.hasPrev = _this.hasPrev.prev();
  }

  if(_this.hasPrev.length !== 0) {
    _this.prev = _this.hasPrev.attr('id').split('portfolio-')[1];
  }

}

return _this.prev;
};





/*  Easing
 -----------------------------------*/
Portfolio.prototype._easeInOutQuart = function(x, t, b, c, d) {
  if ((t /= d / 2) < 1) return c / 2 * t * t * t * t + b;
  return -c / 2 * ((t -= 2) * t * t * t - 2) + b;
};

// Close door
Portfolio.prototype._closeDoor = function($elem) {

    _this = this;

    if(_this.$doorFrame.height() !== 0 ) {

        _this.$doorFrame.stop(true).animate({
            height: 0
        }, 400, _this._easeInOutQuart(), function() {
            // Add class to parent
            _this.$elem.removeClass(cssClasses.isOpen);
            _this.$doc.removeClass(cssClasses.isOpen);
        });
    }

};

/*  Open door
 -----------------------------------*/
Portfolio.prototype._openDoor = function($elem) {

    _this = this;

    _this.$doorFrame.stop(true).animate({
        height: _this.$magicDoor.outerHeight()
    }, this.speed, _this._easeInOutQuart(), function() {

        // Add class to parent
        _this.$elem.addClass(cssClasses.isOpen);
        _this.$doc.addClass(cssClasses.isOpen);

        _this.$doorFrame.css({
            height: 'auto'
        });

    });

};

/*  Get post slug
 -----------------------------------*/
// Portfolio.prototype._updatePostSlug = function() {
//
//     if(history.replaceState) {
//         //history.replaceState(null, null, '#' + post_slug);
//         history.replaceState(null, null, '' + post_slug);
//     } else {
//         location.hash = '#' + post_slug;
//     }
//
// };

/*  Portfolio Init
 -----------------------------------*/
Portfolio.prototype._portfolioInit = function() {

    _this = this;

    _this.$closeButton = $('[data-close]');
    _this.$closeButton.on('click', function() {

        // Add class to parent
        _this.$elem.removeClass(cssClasses.isOpen);
        // Remove active classs from all items
        _this.$portfolioItem.removeClass(activeClass);

        //console.log(postId);
        _this._closeDoor();

    });




};

/*  Returns a constructor
 -----------------------------------*/
module.exports = Portfolio;
