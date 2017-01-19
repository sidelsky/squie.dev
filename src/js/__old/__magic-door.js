var $magicDoor = $('[data-portfolio-item]'),
    magicDoorInstance;

$magicDoor.each(function(i, elem) {
    
});


var MagicDoor = function($domElem) {
    console.log('Example initialising...');
    this.$elem = $domElem;

    // Variables

    // Initialise
    this._init();

};


MagicDoor.prototype._init = function($elem) {
  //Initialise the component.

};


//module.exports = MagicDoor; //Returns a constructor

module.exports = new MagicDoor();


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
