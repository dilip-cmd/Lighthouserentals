jQuery(document).ready(function(){

var current_fs, next_fs, previous_fs; //fieldsets
var opacity;

jQuery(".next").click(function(){

current_fs = jQuery(this).parent();
next_fs = jQuery(this).parent().next();

//Add Class Active
jQuery("#progressbar li").eq(jQuery("fieldset").index(next_fs)).addClass("active");

//show the next fieldset
next_fs.show();
//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
next_fs.css({'opacity': opacity});
},
duration: 600
});
});

jQuery(".previous").click(function(){

current_fs = jQuery(this).parent();
previous_fs = jQuery(this).parent().prev();

//Remove class active
jQuery("#progressbar li").eq(jQuery("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
previous_fs.show();

//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
previous_fs.css({'opacity': opacity});
},
duration: 600
});
});

jQuery('.radio-group .radio').click(function(){
jQuery(this).parent().find('.radio').removeClass('selected');
jQuery(this).addClass('selected');
});

jQuery(".submit").click(function(){
return false;
})

jQuery("#book_rental").on("click",function(){
	alert("yest");
	return false;
});

});



jQuery(document).ready(function(){


jQuery('.review-owl').owlCarousel({
    loop:true,
     items: 3,
    margin: 30,
    nav:true,
        // Responsive
    responsive: true,
    items : 3,
    itemsDesktop : [1199,3],
    itemsDesktopSmall : [980,3],
    itemsTablet: [768,2],
    itemsMobile : [567,1]
    
});

});	





var rect = jQuery('#container')[0].getBoundingClientRect();
var mouse = {x: 0, y: 0, moved: false};

jQuery("#container").mousemove(function(e) {
  mouse.moved = true;
  mouse.x = e.clientX - rect.left;
  mouse.y = e.clientY - rect.top;
});
 
// Ticker event will be called on every frame
TweenLite.ticker.addEventListener('tick', function(){
  if (mouse.moved){    
    parallaxIt(".slide", -100);
     parallaxIt(".slide.one", -80);
    parallaxIt(".slide.one img", -30);
    parallaxIt(".slide.two", -60);
    parallaxIt(".slide.two img", -20);
     parallaxIt(".slide.three", -50);
    parallaxIt(".slide.three img", -40);
    parallaxIt(".slide.four img", -30);
     parallaxIt(".slide.four", -40);
    parallaxIt(".slide.five img", -25);
     parallaxIt(".slide.five", -25);
    parallaxIt(".slide.six img", -20);
    parallaxIt(".slide.six", -18);
    parallaxIt(".slide.seven img", -18);
     parallaxIt(".slide.seven", -12);
  }
  mouse.moved = false;
});

function parallaxIt(target, movement) {
  TweenMax.to(target, 0.5, {
    x: (mouse.x - rect.width / 2) / rect.width * movement,
    y: (mouse.y - rect.height / 2) / rect.height * movement
  });
}

jQuery(window).on('resize scroll', function(){
  rect = jQuery('#container')[0].getBoundingClientRect();
})