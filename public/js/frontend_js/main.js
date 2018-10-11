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

$(document).ready(function(){
	//alert('test')
	$('#registerForm').validate({
		rules:{
			name:{
				required:true,
				minlength:2,
				accept:"[a-zA-Z]+"
			},
			password:{
				required:true,
				minlength:6
			},
			email:{
				required:true,
				email:true,
				remote:'check_email'

			}
		},
		messages:{
			name:{
				required:"please enter your name",
				minlength:"Name at least 2 character",
				accept:"Must be contain only letter"
			},
			password:{
				required:"Please Enter your password",
				minlength:"Password at lest 6 characters",
			},
			email:{
				required:"please Enter your Email",
				email:"Must be a Email",
				remote:"Email already Exists!"
			}
		},

	})
})


$(document).ready(function(){
	$('#loginForm').validate({
		rules:{
			password:{
				required:true,
			},
			email:{
				required:true,
				email:true
			}
		},
		messages:{
			password:{
				required:"please Enter your Password"
			},
			email:{
				required:"please Enter your email",
				email:"Must be a email"
			},
		}
	});
});


$(document).ready(function(){
    $('#accountForm').validate({
        rules:{
            address:{
                required:true,
            },
            city:{
                required:true,
            },
            state:{
                required:true,
            },
            country:{
                required:true,

            },
            pincode:{
                required:true,
            },
            mobile:{
                required:true,

            }
        },
        messages:{
            address:{
                required:"Please enter the address"
            },
            city:{
                required:"Please enter the city",
            },
            state:{
                required:"Please enter the state",
            },
            country:{
                required:"Please enter the country",

            },
            pincode:{
                required:"Please enter the pincode",
            },
            mobile:{
                required:"Please enter the mobile",

            }
        }
    });
});


$(document).ready(function(){
    $('#updatepasswordForm').validate({
        rules:{
            currentpassword:{
                required:true,
                minlength:6,
                maxlength:15
            },
            newpassword:{
                required:true,
                minlength:6,
				maxlength:15
            },
            confirmpassword:{
                required:true,
                minlength:6,
                maxlength:15,
                equalTo:"#newpassword"
            },

        },
        messages:{
            currentpassword:{
                required:"Please enter the current password",
                minlength:"Password at least 6 characters",
				maxlength:"Password maximum length at most 15"
            },
            newpassword:{
                required:"Please enter the new password",
                minlength:"Password at least 6 characters",
                maxlength:"Password maximum length at most 15"
            },
            confirmpassword:{
                required:"Please enter the confirm password",
                minlength:"Password at least 6 characters",
                maxlength:"Password maximum length at most 15",
                equalTo:"confirm password is not same "
            },

        }
    });
});


$(document).ready(function(){
	$('#currentpassword').keyup(function(){
		var currentpassword=$(this).val();
		my_url="http://localhost/Authentication/public/"
		$.ajax({
			type:'get',
			datatype:'json',
			url:my_url+'check-password',
			data:{cpass:currentpassword},
			success:function(resp){
                if(resp=="false")
                    $('#chkpwd').html("<font color:red>Current Password is incorrect</font>")
                else if(resp=="true")
                    $('#chkpwd').html("<font color:green>Current Password is correct</font>")
			}
		})

	});
});

