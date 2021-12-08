jQuery(document).ready(function(){


  

var current_fs, next_fs, previous_fs; //fieldsets
var opacity;


/*jQuery("#wpmc-next").click(function(){

   var billing_project_name =  jQuery("#billing_project_name").val();
   var billing_project_type =  jQuery("#billing_project_type").val();


  if (billing_project_name.length == 0 || billing_project_type.length == 0 ) {
    alert("null");
  }

});*/


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





// var rect = jQuery('#container')[0].getBoundingClientRect();
// var mouse = {x: 0, y: 0, moved: false};

// jQuery("#container").mousemove(function(e) {
//   mouse.moved = true;
//   mouse.x = e.clientX - rect.left;
//   mouse.y = e.clientY - rect.top;
// });
 

// TweenLite.ticker.addEventListener('tick', function(){
//   if (mouse.moved){    
//     parallaxIt(".slide", -100);
//      parallaxIt(".slide.one", -80);
//     parallaxIt(".slide.one img", -30);
//     parallaxIt(".slide.two", -60);
//     parallaxIt(".slide.two img", -20);
//      parallaxIt(".slide.three", -50);
//     parallaxIt(".slide.three img", -40);
//     parallaxIt(".slide.four img", -30);
//      parallaxIt(".slide.four", -40);
//     parallaxIt(".slide.five img", -25);
//      parallaxIt(".slide.five", -25);
//     parallaxIt(".slide.six img", -20);
//     parallaxIt(".slide.six", -18);
//     parallaxIt(".slide.seven img", -18);
//      parallaxIt(".slide.seven", -12);
//   }
//   mouse.moved = false;
// });

// function parallaxIt(target, movement) {
//   TweenMax.to(target, 0.5, {
//     x: (mouse.x - rect.width / 2) / rect.width * movement,
//     y: (mouse.y - rect.height / 2) / rect.height * movement
//   });
// }

// jQuery(window).on('resize scroll', function(){
//   rect = jQuery('#container')[0].getBoundingClientRect();
// })


// jQuery(document).ready(function() {

//   jQuery(window).on("load scroll", function() {
//     var parallaxElement = jQuery(".slide"),
//       parallaxQuantity = parallaxElement.length;
//     window.requestAnimationFrame(function() {
//       for (var i = 0; i < parallaxQuantity; i++) {
//         var currentElement = parallaxElement.eq(i),
//           windowTop = jQuery(window).scrollTop(),
//           elementTop = currentElement.offset().top,
//           elementHeight = currentElement.height(),
//           viewPortHeight = window.innerHeight * 0.5 - elementHeight * 0.5,
//           scrolled = windowTop - elementTop + viewPortHeight;
//         currentElement.css({
//           transform: "translate3d(0," + scrolled * -0.25 + "px, 0)"
//         });
//       }
//     });
//   });
// });



jQuery(document).ready(function() {
  
  jQuery(window).on("load scroll", function() {
    var parallaxElement = jQuery(".slide.three,  .slide.five"),
      parallaxQuantity = parallaxElement.length;
    window.requestAnimationFrame(function() {
      for (var i = 0; i < parallaxQuantity; i++) {
        var currentElement = parallaxElement.eq(i),
          windowTop = jQuery(window).scrollTop(),
          elementTop = currentElement.offset().top,
          elementHeight = currentElement.height(),
          viewPortHeight = window.innerHeight * 0.5 - elementHeight * 0.5,
          scrolled = windowTop - elementTop + viewPortHeight;
        currentElement.css({
          transform: "translate3d(0," + scrolled * -0.25 + "px, 0)"
        });
      }
    });
  });
});

jQuery(document).ready(function() {
  
  jQuery(window).on("load scroll", function() {
    var parallaxElement = jQuery(".slide.one, .slide.two,.slide.six, .slide.seven"),
      parallaxQuantity = parallaxElement.length;
    window.requestAnimationFrame(function() {
      for (var i = 0; i < parallaxQuantity; i++) {
        var currentElement = parallaxElement.eq(i),
          windowTop = jQuery(window).scrollTop(),
          elementTop = currentElement.offset().top,
          elementHeight = currentElement.height(),
          viewPortHeight = window.innerHeight * 0.5 - elementHeight * 0.5,
          scrolled = windowTop - elementTop + viewPortHeight;
        currentElement.css({
          transform: "translate3d(0," + scrolled * -0.10 + "px, 0)"
        });
      }
    });
  });
});

jQuery(document).ready(function() {
  
  jQuery(window).on("load scroll", function() {
    var parallaxElement = jQuery(".slide.four"),
      parallaxQuantity = parallaxElement.length;
    window.requestAnimationFrame(function() {
      for (var i = 0; i < parallaxQuantity; i++) {
        var currentElement = parallaxElement.eq(i),
          windowTop = jQuery(window).scrollTop(),
          elementTop = currentElement.offset().top,
          elementHeight = currentElement.height(),
          viewPortHeight = window.innerHeight * 0.5 - elementHeight * 0.5,
          scrolled = windowTop - elementTop + viewPortHeight;
        currentElement.css({
          transform: "translate3d(0," + scrolled * -0.30 + "px, 0)"
        });
      }
    });
  });
});



jQuery(document).ready(function(){


jQuery('.wo-pro-cat .products').owlCarousel({
     loop:true,
     items: 5,
    margin: 18,
    
    navigation: true,
  navigationText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        // Responsive
    responsive: true,
    items : 5,
    itemsDesktop : [1199,4],
    itemsDesktopSmall : [992,4],
    itemsTablet: [768,3],
    itemsMobile : [567,2]
})

}); 


jQuery(document).ready(function(){
  jQuery('.site-btn').click(function(){
      jQuery('#popup-343').css('display',"none");
      jQuery( ".b-modal .__b-popup1__" ).remove();
  });
}); 

jQuery(document).ajaxStop(function() {
  jQuery('.code').hide();
  jQuery('td.cancel').hide();
  jQuery('td.enter').show();
  jQuery('input[type="submit"][name="apply_coupon"]').prop('value', 'Apply');
  jQuery('td.enter a').click(function() {
    jQuery('.code').show();
    jQuery('td.enter').hide();
    jQuery('td.cancel').show();
  });
  jQuery('td.cancel a').click(function() {
    jQuery('.code').hide();
    jQuery('td.enter').show();
    jQuery('td.cancel').hide();
  });
  if( parseInt(jQuery('tr.fee th span.insurance(<a class="display_popup popup_style" data-toggle="modal" data-target=".popup_box"><img src="https://lighthouserentals.mobilegiz.com/wp-content/themes/suprema-child/images/edit-icn.svg"></a>)').size()) > 0 ){
    jQuery('tr.fee th span.insurance').append('<a class="display_popup popup_style" data-toggle="modal" data-target=".popup_box"><img src="https://lighthouserentals.mobilegiz.com/wp-content/themes/suprema-child/images/edit-icn.svg"></a>');
  }
  if( parseInt(jQuery('tr.fee th span.collection__return_total(<a class="display_popup_dropoff popup_style" data-toggle="modal" data-target=".collection_popup_box"><img src="https://lighthouserentals.mobilegiz.com/wp-content/themes/suprema-child/images/edit-icn.svg"></a>"></a>)').size()) > 0 ){
    jQuery('tr.fee th span.collection__return_total').append('<a class="display_popup_dropoff popup_style" data-toggle="modal" data-target=".collection_popup_box"><img src="https://lighthouserentals.mobilegiz.com/wp-content/themes/suprema-child/images/edit-icn.svg"></a>"></a>');
  }
});

jQuery(document).ready(function(){
jQuery('.code').hide();
jQuery('td.cancel').hide();
jQuery('td.enter').show();
    jQuery('td.enter a').click(function() {
      
      jQuery('.code').show();
      jQuery('td.enter').hide();
      jQuery('td.cancel').show();
    });
    jQuery('td.cancel a').click(function() {
      
      jQuery('.code').hide();
      jQuery('td.enter').show();
      jQuery('td.cancel').hide();
    });
});


jQuery(document).ready(function(){
  jQuery('#from').change(function(){
    jQuery('#loadr_img').show();
    jQuery.ajax({
      type: "post",
      url: "/wp-admin/admin-ajax.php",
      data: {
        action:'from_date',
        from_date: jQuery(this).val()
      },
      success: function(msg){
        console.log(msg);
      },
        complete: function(){
          jQuery('#loadr_img').hide();
        }
    });
  });
  jQuery('#to').change(function(){
    jQuery('#loadr_img').show();
    jQuery.ajax({
      type: "post",
      url: "/wp-admin/admin-ajax.php",
      data: {
        action:'to_date',
        to_date: jQuery(this).val()
      },
      success: function(msg){
        console.log(msg);
      },
        complete: function(){
          jQuery('#loadr_img').hide();
        }
    });
  });




  jQuery('#insurence_submit').click(function(e){
    e.preventDefault();
    if (jQuery('input[name=radio_butoon]:checked').length == 0) {
      jQuery('span.req_error').html('Required').css('color','red');
      return false; 
    } else {
      jQuery.ajax({
        type: "post",
        url: "/wp-admin/admin-ajax.php",
        data: {
          action:'insurence',
          insurance_amount: jQuery("input[name=radio_butoon]:checked").val(),
          insurance_per: jQuery("input[name=radio_butoon]:checked").attr("data-per")
        },
        success: function(msg){
          location.reload(true);
        }
      });
    }
  });

function calcscore(){
    var sym = '$';
    var score = 0;
    jQuery(".cal:checked").each(function(){
        score+=parseInt(jQuery(this).val(),10);
    });
    jQuery(".total_collection_price").html(sym + score);
}
jQuery('.cal:checked').each(function() {
    calcscore();
});
jQuery('.cal').change(function() {
    calcscore();
});

  jQuery('#collection_return_submit').click(function(e){
    e.preventDefault();
    

     

      jQuery.ajax({
        type: "post",
        url: "/wp-admin/admin-ajax.php",
        data: {
          action:'submit_collection_return',
          button_collection: jQuery('input[type=radio][name=button_collection]:checked').val(),
          button_return:jQuery('input[type=radio][name=button_return]:checked').val()
        },
        success: function(msg){
          location.reload(true);
        }
      });
    
  });

  jQuery('#insurence_submit_popup').click(function(e){
    e.preventDefault();

    alert(jQuery("input[name=radio_butoon]:checked").val());

    if (jQuery('input[name=radio_butoon]:checked').length == 0) {
      jQuery('span.req_error').html('Required').css('color','red');
      return false; 
    } else {
      jQuery.ajax({
        type: "post",
        url: "/wp-admin/admin-ajax.php",
        data: {
          action:'insurence',
          insurance_amount: jQuery("input[name=radio_butoon]:checked").val()
        },
        success: function(msg){
          window.location.href = "https://lighthouserentals.mobilegiz.com/checkout/";
        }
      });
    }
  });
});

  var sym = '$';
  var val = '0.00';
  var ttl = parseFloat(jQuery('input[type=hidden][name=cart_ttl]').val());
  jQuery('div#total-price').html(sym + val);
  jQuery('span.insurance_total').html(sym + ttl.toFixed(2));
jQuery(document).ready(function(){
  jQuery('input[type="radio"]:checked').each(function() {
    var sym = '$';
    var val = jQuery(this).val();
    jQuery('span.insurance_total').html(sym + jQuery('input[type=hidden][name=cart_ttl]').val());
    if (jQuery(this).val() == '0.00') {
      jQuery('span.insurance_name').html(jQuery('input[type=hidden][name=insurence1]').val());
      jQuery('div#total-price').html(sym + val);
    }
    else if (jQuery(this).val() == '8.10') {
      jQuery('span.insurance_name').html(jQuery('input[type=hidden][name=insurence2]').val());
      jQuery('div#total-price').html(sym + val);
    }
    else if (jQuery(this).val() == '24.30') {
      jQuery('span.insurance_name').html(jQuery('input[type=hidden][name=insurence3]').val());
      jQuery('div#total-price').html(sym + val);
    }
    else if (jQuery(this).val() == '40.50') {
      jQuery('span.insurance_name').html(jQuery('input[type=hidden][name=insurence4]').val());
      jQuery('div#total-price').html(sym + val);
    }
  });

  jQuery(document).ready(function($){
    var sym = '$';
    $('span.insurance_name').html($("input[type=radio][class=button3]").attr("data-name"));
    var val = $(".button3").val();
    //alert(val);
    $('div#total-price').html("$"+val);
  });


  jQuery('input[type=radio][name=radio_butoon]').change(function() {
    var sym = '$';
    var val = parseFloat(this.value);
    var ttl = parseFloat(jQuery('input[type=hidden][name=cart_ttl]').val());
    if(jQuery('input[type=hidden][name=current_selected_ins]').val() != '' && jQuery('input[type=hidden][name=current_selected_ins]').val() != null){
      var crn_sec_in = parseFloat(jQuery('input[type=hidden][name=current_selected_ins]').val());
      var f_ttl = val+ttl-crn_sec_in;
    }else{
      var f_ttl = val+ttl;
    }
   

    jQuery('span.insurance_total').html(sym + f_ttl.toFixed(2));

    jQuery('span.insurance_name').html(jQuery(this).attr("data-name"));
    jQuery('div#total-price').html(sym + val.toFixed(2));

    /*if (this.value == val) {

      //alert(jQuery('input[type=hidden][name=insurence1]').val());
      //alert(jQuery('#insurence1').val());
      jQuery('span.insurance_name').html(jQuery('input[type=hidden][name=insurence1]').val());
      jQuery('div#total-price').html(sym + val.toFixed(2));
    }
    else if (this.value == val) {
      jQuery('span.insurance_name').html(jQuery('input[type=hidden][name=insurence2]').val());
      jQuery('div#total-price').html(sym + val.toFixed(2));
    }
    else if (this.value == val) {
      jQuery('span.insurance_name').html(jQuery('input[type=hidden][name=insurence3]').val());
      jQuery('div#total-price').html(sym + val.toFixed(2));
    }
    else if (this.value == val) {
      jQuery('span.insurance_name').html(jQuery('input[type=hidden][name=insurence4]').val());
      jQuery('div#total-price').html(sym + val.toFixed(2));
    }*/
  });
});

jQuery(".cart-ins-modal input[type=radio]").on("click", function(){
  jQuery(this).closest("table").removeAttr("class");
  jQuery(this).closest("table").attr("class",jQuery(this).attr('class'));
});

if(jQuery(".cart-ins-modal input[type=radio]").is(':checked')){
  jQuery(".cart-ins-modal input[type=radio]:checked").closest("table").removeAttr("class");
  jQuery(".cart-ins-modal input[type=radio]:checked").closest("table").attr("class",jQuery("input[type=radio]:checked").attr('class'));
}

jQuery(document).ready(function($){
  $('.cancel_button').click(function(){
    $('.popup_box').removeClass('show');
    $('body').removeClass('modal-open');
    $('.popup_box').css('display','none');
  });

   $('#sponsermodal .close').click(function(){
    $('#sponsermodalx').removeClass('show');
    $('body').removeClass('modal-open');
    $('#sponsermodal').css('display','none');
  });

   $('.sponsor-btn').click(function(){
    $('#sponsermodal').addClass('show');
    $('body').addClass('modal-open');
    $('#sponsermodal').css('display','block');
  });


  $('#display_popup').click(function(){
    $('.popup_box').addClass('show');
    $('body').addClass('modal-open');
    $('.popup_box').css('display','block');
  });
  $('#display_popup_dropoff').click(function(){
    $('.collection_popup_box').addClass('show');
    $('body').addClass('modal-open');
    $('.collection_popup_box').css('display','block');
  });

  $('.cancel_button_dropoff').click(function(){
    $('.collection_popup_box').removeClass('show');
    $('body').removeClass('modal-open');
    $('.collection_popup_box').css('display','none');
  });

  $('.book_cancel').click(function(){
    $('#book_now').removeClass('show');
    $('body').removeClass('modal-open');
    $('#book_now').css('display','none');
  });
  $('.display_book').click(function(){
    if($('input[type="checkbox"][name="agree"]').is(":checked")) {
      $('span.required_error').html('');
      $('#book_now').addClass('show');
      $('body').addClass('modal-open');
      $('#book_now').css('display','block');
    }
    else{
      $('span.required_error').html('Required').css('color','red');
      return false; 
    }
  });
  $('input[type="checkbox"][name="agree"]').click(function(){
      if($(this).prop("checked") == true){
          $('.cart-acc-term .required_error ~ .checkmark').css('border-color','unset');
      }
      else if($(this).prop("checked") == false){
          $('.cart-acc-term .required_error ~ .checkmark').css('border-color','red');
      }
  });
});

jQuery(document).ready(function($){
  $('tr.fee th span.insurance').append('<a class="display_popup popup_style" data-toggle="modal" data-target=".popup_box"><img src="https://lighthouserentals.mobilegiz.com/wp-content/themes/suprema-child/images/edit-icn.svg"></a>');
  $('tr.fee th span.collection__return_total').append('<a class="display_popup_dropoff popup_style" data-toggle="modal" data-target=".collection_popup_box"><img src="https://lighthouserentals.mobilegiz.com/wp-content/themes/suprema-child/images/edit-icn.svg"></a>');
  $('a.display_popup_dropoff').click(function(){
    $('.collection_popup_box').addClass('show');
    $('body').addClass('modal-open');
    $('.collection_popup_box').css('display','block');
  });
  $('a.display_popup').click(function(){
    $('.popup_box').addClass('show');
    $('body').addClass('modal-open');
    $('.popup_box').css('display','block');
  });
});


jQuery(document).ready(function ($) {
    $(".qodef-shopping-cart-outer .qodef-shopping-cart-header").hover(
      function () {
        $('body').addClass("minicart-open");
      },
      function () {
        $('body').removeClass("minicart-open");
      }
    );
  });


 jQuery(document).ready(function($) {
  
$('.nicescroll-rails.nicescroll-rails-vr').remove();
 });  

  
jQuery('.the_champ_social_login_title').html('Or sign up using');
jQuery('.woocommerce-form-login .form-row-first label').html('Email Address <span class="required">*</span>');
jQuery('input[type="submit"][name="apply_coupon"]').prop('value', 'Apply');
jQuery(function ($) {
  $('[data-toggle="tooltip"]').tooltip()
});


jQuery(document).ready(function() {
  jQuery('div.woocommerce').on('change', '.qty', function(){
    jQuery("[name='update_cart']").prop("disabled", false);
    jQuery("[name='update_cart']").trigger("click"); 
  });
} );

jQuery(document).ready(function() {
  jQuery('.checkout-step-select-col input:radio').click(function () {
      jQuery('.checkout-step-select-col input:radio').parents(".checkout-step-select-col").removeClass('active-inputradio');
      jQuery(this).parents(".checkout-step-select-col").addClass('active-inputradio');
  });


  if(jQuery(".checkout-step-select-col input:radio").is(':checked')){
  jQuery(".cart-ins-modal input[type=radio]:checked").parents(".checkout-step-select-col").removeClass('active-inputradio');
  jQuery(this).parents(".checkout-step-select-col").addClass('active-inputradio');
}

});  

jQuery(document).ready(function() {
  jQuery('#save_draft').click(function(e){

    //alert("ajkghakjsd");

    var from_date = jQuery('#from_date').val();
    var end_date = jQuery('#end_date').val();


    if (from_date === "" || end_date === "") {
      jQuery(".date_not_selected").css({"display":"block","color":"red"});
      return false;
    }

    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
          return false;
        }else{
          return true;
        }
      }


    var billing_emailid = jQuery('#billing_emailid').val();

    if (billing_emailid === "") {
      jQuery('span.billing_emailid_error').html('E-mail id is required!!').css('color','red');
      return false;
    }

    if(IsEmail(billing_emailid)==false){
      jQuery('span.billing_emailid_error').html('Please Correct your E-mail format!!').css('color','red');
      
      return false;
    }

    
    

    var check = jQuery('input[type="checkbox"][name="agree"]').is(":checked");

    if (check == false) {
    jQuery('span.required_error').html('Required').css('color','red');
    return false;
    }


    //alert("test");
    e.preventDefault();
    if(jQuery('input[type="checkbox"][name="agree"]').is(":checked")) {
      jQuery('span.required_error').html('');
      jQuery('#loadr_img').show();
      jQuery.ajax({
        type: "post",
        url: "/wp-admin/admin-ajax.php",
        data: {
          action:'opp_save_draft',
          billing_emailid: jQuery('#billing_emailid').val()
        },
        success: function(data){
          var result = jQuery.parseJSON(data);       
          if(result.status == 'success'){
            alert("Thank you for Draft Order!");
            window.location.href = "https://lighthouserentals.mobilegiz.com";
          }else{
             alert("Error on query!");
          }
        },
        complete: function(){
          jQuery('#loadr_img').hide();
        }
      });
    }
    else{
      jQuery('span.required_error').html('Required').css('color','red');
      return false; 
    }
  });
});


/*jQuery(document).ready(function() {
  jQuery('#display_popup_dropoff').click(function(e){
    e.preventDefault();
    jQuery('#dropoff_collection_modal').modal('show');
  });
});*/




jQuery(document).ready(function() {
  jQuery('#book_now_button').click(function(e){

      var from_date = jQuery('#from_date').val();
      var end_date = jQuery('#end_date').val();

      if (from_date === "" || end_date === "") {
        jQuery(".date_not_selected").css({"display":"block","color":"red"});
        return false;
      }

      function IsEmail(email) {
          var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          if(!regex.test(email)) {
            return false;
          }else{
            return true;
          }
        }


      var billing_emailid = jQuery('#billing_emailid').val();

      if (billing_emailid === "") {
        jQuery('span.billing_emailid_error').html('E-mail id is required!!').css('color','red');
        return false;
      }

      if(IsEmail(billing_emailid)==false){
        jQuery('span.billing_emailid_error').html('Please Correct your E-mail format!!').css('color','red');
        
        return false;
      }

      
      

      })
  });




jQuery(document).ready(function() {
  jQuery('#global_submit').click(function(e){

  //  alert("asjkd");

    e.preventDefault();
    jQuery('#loadr_img').show();
    jQuery.ajax({
      type: "post",
      url: "/wp-admin/admin-ajax.php",
      data: {
        action:'opp_incomplete',
        billing_emailid: jQuery('#billing_emailid').val()
      },
      success: function(msg){
        console.log(msg);
        var booknow_class = jQuery('#book_now').attr('class');
        jQuery('#book_now').attr('class','modal fade xxl-modal-cust forgot-pro-mod-main hide');

        var fee = jQuery('table.shop_table tbody tr.fee').html();
        //console.log(fee.length);
        if (fee == null) {
          jQuery('#loadr_img').hide();
          jQuery('#insurance_modal_data').modal('show');
        }else{          
         window.location.href = "https://lighthouserentals.mobilegiz.com/checkout/";
        }
        
      }
    });
  });
});





// jQuery(document).ready(function(){
// function postsCarousel() {
//   var checkWidth = jQuery(window).width();
//   var owlPost = jQuery(".sab-cat-owl-mob");
//   if (checkWidth > 767) {
//     if (typeof owlPost.data('owl.carousel') != 'undefined') {
//       owlPost.data('owl.carousel').destroy();
//     }
//     owlPost.removeClass('owl-carousel');
//   } else if (checkWidth < 768) {
//     owlPost.addClass('owl-carousel');
//     owlPost.owlCarousel({
//       slideSpeed : 300,
//       paginationSpeed : 400,
//        responsive: true,
   
    
//     itemsTablet: [768,3],
//     itemsMobile : [567,2]
//     });
//   }
// }

// postsCarousel();
// jQuery(window).resize(postsCarousel);  


//  });



function owlInitialize() {
   if (jQuery(window).width() < 767) {
      jQuery('.sub_cat_banner_item').owlCarousel({
      	 autoWidth:true,
      autoWidth:true,
          margin: 13,
    items : 3,
    itemsDesktop : [1199,3],
    itemsDesktopSmall : [980,3],
    itemsTablet: [768,2],
    itemsMobile : [667,1.5],
                onInitialized : function(){
                    if(jQuery('.owl-item').first().hasClass('active'))
                        jQuery('.owl-prev').hide();
                    else
                        jQuery('.owl-prev').show();
                } 

      });
   }else{
       jQuery('.sub_cat_banner_item').data('owlCarousel').destroy();
   }
}

jQuery(document).ready(function(e) {
   owlInitialize();
});

jQuery(window).resize(function() {
   owlInitialize();
});


jQuery(document).ready(function() {
      if (jQuery(window).width() <=767 ) {
    var max = 110;
    jQuery(".tax-product_cat.archive .qodef-title .qodef-subtitle").each(function() {
        var str = jQuery(this).text();
        if (jQuery.trim(str).length > max) {
            var subStr = str.substring(0, max);
            var hiddenStr = str.substring(max, jQuery.trim(str).length);
            jQuery(this).empty().html(subStr);
            jQuery(this).append(' <a href="javascript:void(0);" class="link">Read more</a>');
            jQuery(this).append('<span class="addText">' + hiddenStr + '</span>');
        }
    });
    jQuery(".link").click(function() {
        jQuery(this).siblings(".addText").contents().unwrap();
        jQuery(this).remove();
    });
     }
});   



 jQuery(document).ready(function() {
            jQuery(".qodef-title").find(".sub_cat_banner_item").parents('.qodef-title').addClass("sub_cat_banner-active");
});


 jQuery(document).ready(function() {

jQuery('.mega-packages-li .mega-sub-menu a[href*=#]').click(function(event){
    jQuery('html, body').animate({
        scrollTop: jQuery( jQuery.attr(this, 'href') ).offset().top - 150
    }, 500);
    event.preventDefault();
});

});