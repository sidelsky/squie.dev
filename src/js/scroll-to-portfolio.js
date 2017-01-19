(function(){

    var $hero_button = $('[data-chevron-button]'),
        speed = 1000,
        $doc = $('html, body'),
        $portfolio = $('[data-portfolio-items]');

        $.extend($.easing, {
            def: 'easeInOutQuart',
            easeInOutQuart: function(x, t, b, c, d) {
                if ((t /= d / 2) < 1) return c / 2 * t * t * t * t + b;
                return -c / 2 * ((t -= 2) * t * t * t - 2) + b;
            }
        });

    // On buton click
    $hero_button.on('click', scrollToElem);

    // Scroll function
    function scrollToElem(el) {
        $doc.animate({
            scrollTop: $portfolio.offset().top
        }, speed, 'easeInOutQuart');
    }


}());



function fadeOutElement(el) {
  el.fadeOut(fadeTime);
}
