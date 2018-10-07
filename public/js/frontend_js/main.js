/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
	//alert("test");
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});

$(document).ready(function(){

	//change price with size
	$('#selsize').change(function(){
		var id=$(this).val();
		if(id=="")
			return false;
		var my_url="http://localhost/Authentication/public"
		$.ajax({
			type:'get',
			url:my_url+'/get-product-price',
			datatype:'json',
			data:{idvalue:id},
			success:function(resp){
                //console.log(resp);
				$('#getprice').html("TAKA " +resp['price']);
				$('#quantity').val(resp['stock']);

				if(resp['stock']==0){
					$('#cart').hide();
					$('#availability').text('Out of Stock');
				}else{

                    $('#cart').show();
                    $('#availability').text('In Stock');
				}
			},
            error:function(){
                alert("Error")
            }

		});
	});

});

//change image


$(document).ready(function(){
    $('.changeimage').click(function(){
    	var image=$(this).attr('src');
    	$('.mainimage').attr('src',image);
    });
});

//update price with item




// Instantiate EasyZoom instances
// var $easyzoom = $('.easyzoom').easyZoom();
//
// // Setup thumbnails example
// var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');
//
// $('.thumbnails').on('click', 'a', function(e) {
//     var $this = $(this);
//
//     e.preventDefault();
//
//     // Use EasyZoom's `swap` method
//     api1.swap($this.data('standard'), $this.attr('href'));
// });
//
// // Setup toggles example
// var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');
//
// $('.toggle').on('click', function() {
//     var $this = $(this);
//
//     if ($this.data("active") === true) {
//         $this.text("Switch on").data("active", false);
//         api2.teardown();
//     } else {
//         $this.text("Switch off").data("active", true);
//         api2._init();
//     }
// });
