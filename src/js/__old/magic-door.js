var magicDoor = {

    // Initialize function
    init: function() {
        this.cashDom();
        this.bindEventsByClick();
    },

    // Cash the DOM
    cashDom: function($el) {
        //this.$el = $('[data-portfolio-item]'),
        this.$el = $('[data-portfolio-item]'),
        this.$portfolioItem = this.$el,
        this.$spinLoader = $('[data-spin-loader]', this.$el),
        this.$magicDoorFrame = $('[data-magic-door-frame]', this.$el),
        this.$magicDoor = $('[data-magic-door]', this.$magicDoorFrame),
        this.url = $(this.$magicDoor, this.$magicDoorFrame).attr('data-url'),
        this.postId = this.$el.attr('id').split('portfolio-')[1];

    },

    // Bind events
    bindEventsByClick: function($el) {

        // Handle click on this protfolio item
        this.$portfolioItem.on('click', this.handleEvent.bind(this));
        // Close door
        this.$magicDoor.on('click', this.closeDoor.bind(this));
    },

    // CLICK EVENT: When a portfolio item is clicked
    handleEvent: function(event) {

        if(!this.$portfolioItem.hasClass('js-active')) {

            // Add 'js-active' to this portfolio item
            this.$el.addClass('js-active');

            this.getPortfolio(this.postId);

        }

        event.preventDefault();

    },

    // Get portfolio
    getPortfolio: function(postId, dontGet) {

        if(!dontGet)
			dontGet = false;

        if(dontGet === false) {

            // Fade in spin loader
            this.$spinLoader.fadeIn(200);

            // Hide cursor
            $(document.body).css({'cursor' : 'none'});

            //Close door
            //this.closeDoor();

            this.$magicDoor.load(this.url, {
                id: this.postId
            }, this.magicLoadedCallback.bind(this));

        }

        var $doc = $("html, body");

        $doc.animate({
            scrollTop: 0
        }, 700, 'easeInOutQuart');


    },

    // Magic callback
    magicLoadedCallback: function() {

        //Init portfolio
        this.portfolioInit();
        //Open the door
        this.openDoor();
        //Fade in spin loader
        this.$spinLoader.fadeOut(300);

    },

    // Portfolio init
    portfolioInit: function() {

        var $closeButton = $('.close');
        $closeButton.on('click', this.closeDoor.bind(this));

    },

    // CLOSE DOOR: Close the magic door
    closeDoor: function() {
        if(this.$magicDoorFrame.height() !== 0 ) {

            this.$magicDoorFrame.stop(true).animate({
                height: 0
            }, 700, 'easeInOutQuart');

        }
        this.$el.removeClass('js-active');

        return false;
    },

    // OPEN DOOR
    // Open the magic door
    openDoor: function() {
        this.$magicDoorFrame.stop(true).animate({
            height: this.$magicDoorFrame.find(this.$magicDoor).outerHeight()
        }, 1000, 'easeInOutQuart', this.openDoorCallback.bind(this));
    },
    // Open door callback
    openDoorCallback: function(){
        this.$magicDoorFrame.css({
            height: 'auto'
        });
    }


};

magicDoor.init();


/*-----------------------------------------------------------------------------------*/
/*	Plugins!
/*-----------------------------------------------------------------------------------*/
$.extend($.easing, {
  def: 'easeInOutQuart',
    easeInOutQuart: function (x, t, b, c, d) {
      if ((t /= d / 2) < 1) return c / 2 * t * t * t * t + b;
      return -c / 2 * ((t -= 2) * t * t * t - 2) + b;
    }
  });
