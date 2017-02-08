(function(){

    var $hero_button = $('[data-chevron-button]'),
        speed = 1000,
        $doc = $('html, body'),
        $portfolio = $('[data-portfolio-items]');
        $taxFilter = $('[data-tax-filter-items]');

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
            scrollTop: $taxFilter.offset().top -30
        }, speed, 'easeInOutQuart');
    }


}());



function fadeOutElement(el) {
  el.fadeOut(fadeTime);
}
