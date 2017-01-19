console.log('bob');
/*------------------------------------*\
	Accordion
\*------------------------------------*/
var Accordion = function Accordion($elem) {
  this.$elem = $elem;
  this.$button = $('.accordion__button', this.$elem);
  this.$panel = $('.accordion__inner-panel', this.$elem);
  this._attachHandlers();

  console.log('sussz');
};

/*  Private Methods
 -----------------------------------*/
Accordion.prototype._attachHandlers = function($elem) {

	var _this = this;

	_this.$button.on('click', function(){
		var $this = $(this);
		_this._handleToggleClass($this);
		_this._handleToggleClass($this.next().find(_this.$panel));
	});

};

Accordion.prototype._handleToggleClass = function toggleClass($elem) {
	$elem.toggleClass(cssClasses.isActive);
};

module.exports = Accordion; //Returns a constructor
