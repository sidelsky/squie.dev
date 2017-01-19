Wordpress Gulp Starter
======================

Basic starter setup for Wordpress. Integrates *Gulp*, *Bower*, *SASS*, *Susy* etc.

##Getting Started

* In the command line, cd to the root of your project
* Run ./init.sh and fill out all of the required fields
* Visit the site in your browser and you should now see a page stripped of most style
* Ensure node, bower, gulp and browser sync are installed globally
* Run (maybe with a little sudo)
```
npm install
bower install
```
* After these two processes are compltete, run *gulp*
* Check for any errors, and that everything is compiling into your theme
* Make a new screenshot.png for your theme using the included as a template
* By default, the Wordpress login is 'btmadmin' and 'saynotoisis' - please change this
* Check that your permalinks are working

##Gulp Tasks

###SVG Spritesheet
* Place your SVGs in src/img/svgs
* Run *gulp svgSprite*
* By default, the svgSprite is included in the header
* To use the sprite (e.g. for facebook.svg):
```
<svg>
  <use xlink:href='#shape-facebook'></use>
</svg>
```

###PNG Spritesheet
* Place your PNGs in src/img/pngs
* Run *gulp sprite* - this will create:
  * A spritesheet of images in your theme's build folder (even automatically takes care of quanting)
  * A SCSS file with variables with the sprite details
* Finally, uncomment the following line in src/style.scss:
```
@import "sprites";
```
* You'll need to compile your style for this to take effect

* If you wish to create a retina spritesheet. Keep your original PNGs as per the instructions above but also create a double sized PNG for each. Add these to the directory with the same name as the orignal except appended with @2x before the file extension. So you should have two files in your root PNG folder:
```
bill.png
bill@2x.png
```
* Run *gulp sprite* - this will automatically create a retina spritesheet
* When referencing either use the generated mixin:
```
@include retina-sprite($bill-group);
```
* Or use the following which will always use retina (even on a non-retina device):
```
@include retina-sprite-custom($bill-group);
```
