var magicDoor = {

    // Initialize function
    init: function() {
        //this.cashDom();
        //this.bindEventsByClick();

        // var bindEvents = this.bindEventsByClick;
        //
        // console.log($(this));
        //
        // $(this.$el).each( function(){
        //     $(this).bindEvents();
        // });
        //console.log(this);
        var self = this;

            self.currentItemIsOpen = false;

        $('[data-portfolio-item]').on('click', function(){
            console.log('click');
            console.log(self.currentItemIsOpen);

            this.currentItem = $(this);

            if(!self.currentItemIsOpen) {
                self.cashDom($(this));
                self.handleEvent($(this));
            }

            self.currentItemIsOpen = true;

        });

        // $('[data-magic-door-frame]').on('click', function(){
        //     var $parent = $(this).parent('[data-portfolio-item]');
        //
        //     //console.log(self.currentItemIsOpen);
        //
        //     if(self.currentItemIsOpen) {
        //         self.closeDoor($parent);
        //     }
        //
        //     self.currentItemIsOpen = false;
        //
        // });

    },

    // Cash the DOM
    cashDom: function(el) {

        //console.log(el);

        this.dontGet = false;
        //el.$el = $('[data-portfolio-item]');
        //el.$portfolioItem = el.$el;
        this.$spinLoader = el.find('[data-spin-loader]');
        this.$magicDoorFrame = el.find('[data-magic-door-frame]');
        this.$magicDoor = el.find('[data-magic-door]');
        this.url = el.find(this.$magicDoor).attr('data-url');
        this.postId = el.attr('id').split('portfolio-')[1];

    },

    // Bind events
    // bindEventsByClick: function() {
    //     // Handle click on this protfolio item
    //
    //     //this.$portfolioItem.on('click', this.handleEvent.bind(this));
    //
    //     //console.log(this.$portfolioItem);
    //
    //     //this.$magicDoor.on('click', this.closeDoor.bind(this));
    // },

    // CLICK EVENT: When a portfolio item is clicked
    handleEvent: function(el) {

        //console.log(el);

        //console.log(this.$portfolioItem);

                                    if(!el.hasClass('js-active')) {

            // Add 'js-active' to this portfolio item
            el.addClass('js-active');

            this.getPortfolio(this.postId, el);

        }

        event.preventDefault();

    },

    // Get portfolio
    getPortfolio: function(postId, el) {

        //console.log(el);

        this.$magicDoor = el.find('[data-magic-door]');

        if(!this.dontGet) {
            this.dontGet = false;
        }

        if(this.dontGet === false) {

            // Fade in spin loader
            this.$spinLoader.fadeIn(200);

            // Hide cursor
            $(document.body).css(
                {'cursor' : 'none'}
            );

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

        // var $closeButton = $('.close');
        // $closeButton.on('click', this.closeDoor.bind(this));

    },

    // CLOSE DOOR: Close the magic door
    closeDoor: function(el) {

        console.log(el);
        var $magicDoorFrame = el.find('[data-magic-door-frame]');

        if($magicDoorFrame.height() !== 0 ) {

            $magicDoorFrame.stop(true).animate({
                height: 0
            }, 700, 'easeInOutQuart');

        }

        el.removeClass('js-active');

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
