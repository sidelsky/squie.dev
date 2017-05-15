(function($) {

    /*
    * Setup of defaul variables and values
    */
    var $elem = $('#submitdiv');
        postboxHeight = $elem.height(),
        $toggleButton = $('button', $elem),
        time = null,
        $elemWrapper = null,
        $window = $(window);

    /*
    * Creates the init function
    */
    function init() {
        windowWidth();
        createPostboxWrapper();
    }

    /*
    * Creates a wrapper around the Postbox named 'postboxWrapper'
    */
    function createPostboxWrapper() {
        $elem.wrap('<div class="postboxWrapper"></div>');
    }

    /*
    * Debounce function
    * Thanks to - https://davidwalsh.name/javascript-debounce-function
    */
    function debounce(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this,
                args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

    /*
    * Sets the postbox
    */
    function setPostbox() {

        setTimeout(function(){

            postboxHeight = $elem.height();
            $elemWrapper = $('.postboxWrapper');
            time = 10;

            $elemWrapper.css({
                'height': postboxHeight,
            });

            $elem.css({
                'position': 'fixed',
                'z-index': 100,
                'width': '280px'
            });

            $elem.addClass('is-active');

        }, time);

    }

    /*
    *  Unsets the postbox
    */
    function unSetPostbox() {

        var $elemWrapper = $('.postboxWrapper');

        $elemWrapper.css({
            'height': ''
        });

        $elem.css({
            'position': 'relative',
            'width': '100%'
        });

        $elem.removeClass('is-active');

    }

    /*
    * Gets the window width
    */
    function windowWidth() {

        width = $window.width();

        if (width > 850) {
            setPostbox();
        } else {
            unSetPostbox();
        }

    }

    /*
    * Toggle show / hide Postbox will set the wrapper height
    */
    $toggleButton.on('click', setHeight);

    function setHeight() {

        time = 10;

        if ($elem.hasClass('closed')) {

            setTimeout(getHeight, time);

        } else {

            setTimeout(getHeight, time);

        }

    }

    /*
    * Gets the height of the Postbox and Postbox wrapper
    */
    function getHeight() {

        var elemHeight = $elem.height(),
            $elemWrapper = $('.postboxWrapper');

        $elemWrapper.css({
            'height': elemHeight
        });
    }



    /*
    * On window resize the windowWidth function is called after a debounce function is run
    */
    $window.on('resize orientationchange', debounce(function() {
        time = 10;

        windowWidth();

    }, time));


    /*
    * Calls the init functions
    */
    init();

}(jQuery));
