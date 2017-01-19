var cssClasses = require('./config').cssClasses;

var animate = cssClasses.animate;

$.extend(jQuery.expr[':'], {

    inview: function(el) {

        if ($(el).offset().top > $(window).scrollTop() - $(el).outerHeight(true) && $(el).offset().top < $(window).scrollTop() + $(el).outerHeight(true) + $(window).height()) {
            //document.getElementsByClassName(".portfolio__item").innerHTML = "YES";
            return true;
        } else {
            //document.getElementsByClassName("iwanttowritemore").innerHTML = "NO";
            return false;
        }
    }

});

setInterval(function() {
    $('.portfolio__item').find(".portfolio__link:inview").addClass(animate);
}, 100);
