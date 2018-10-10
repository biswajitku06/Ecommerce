
$(document).ready(function(){

    $('#current_pwd').keyup(function () {

        var current=$('#current_pwd').val();

        var my_url="http://localhost/Authentication/public";
        $.ajax({
            type:'get',
            url:my_url+'/admin/check_password',
            data:{current_pwd:current},
            datatype:'json',
            success:function (resp) {
                if(resp=="false")
                    $('#checkpwd').html("<font color:red>Current Password is incorrect</font>")
                else if(resp=="true")
                    $('#checkpwd').html("<font color:green>Current Password is correct</font>")
            },
            // error:function (resp) {
            //    alert('error');
            // }
        });

    });

    // $('#clickdelete').click(function () {
    //     return confirm("Do you want to delete this ?");
    // })


	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	
	$('select').select2();
	
	// category Form Validation
    $("#add_category").validate({
		rules:{
			cat_name:{
				required:true
			},
            description:{
				required:true,
			},
			url:{
				required:true,
				//url: true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});


    //product validation

    $("#add_product").validate({
        rules:{
            cat_id:{
                required:true,
            },
            product_name:{
                required:true,
            },
            product_code:{
                required:true,
            },
            product_color:{
                required:true,
                //url: true
            },
            price:{
                required:true,
                number:true
            },
            // image:{
            //     required:true,
            //     '.png': true
            // }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

//add coupon

    $("#add_coupon").validate({
        rules:{
            coupon_code:{
                required:true,
                alpha_num:true
            },
            amount:{
                required:true,
                number:true,
            },
            amount_type:{
                required:true,
            },
            expiry_date:{
                required:true,
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    //edit coupon
    $("#edit_coupon").validate({
        rules:{
            coupon_code:{
                required:true,
                alphanumeric:true
            },
            amount:{
                required:true,
                number:true,
            },
            amount_type:{
                required:true,
            },
            expiry_date:{
                required:true,
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

//edit product

    $("#edit_product").validate({
        rules:{
            cat_id:{
                required:true,
            },
            product_name:{
                required:true,
            },
            product_code:{
                required:true,
            },
            product_color:{
                required:true,
                //url: true
            },
            price:{
                required:true,
                number:true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

//add-banner
    $("#add_banner").validate({
        rules:{
            title:{
                required:true,

            },
            link:{
                required:true,
            },

        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });
//Edit banner
    $("#edit_banner").validate({
        rules:{
            title:{
                required:true,

            },
            link:{
                required:true,
            },

        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });


//sweet alert for delete the image
    $('.deleteRecord').click(function(){
        var id=$(this).attr('rel')
        var deletefunction=$(this).attr('rel1');
        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-success",
                cancelButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function() {
                window.location.href=deletefunction+'/'+id;
            });
    });

    $("#number_validate").validate({
		rules:{
			min:{
				required: true,
				min:10
			},
			max:{
				required:true,
				max:24
			},
			number:{
				required:true,
				number:true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	//change password validation
	$("#password_validate").validate({
		rules:{
            current_pwd:{
                required: true,
                minlength:6,
                maxlength:20
            },
            new_pwd:{
                required: true,
                minlength:6,
                maxlength:20
            },
            confirm_pwd:{
                required:true,
                minlength:6,
                maxlength:20,
                equalTo:"#new_pwd"
            }
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});


	//multiple item add or delete

    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div class="field_wrapper" style="margin-left:180px"><div><input type="text" name="sku[]" id="sku" placeholder="SKU" style="width:120px;margin-left:2px;margin-top:5px"/><input type="text" name="size[]" id="size" placeholder="SIZE" style="width:120px;margin-left:2px;margin-top:5px"/><input type="text" name="price[]" id="price" placeholder="PRICE" style="width:120px;margin-left:2px;margin-top:5px"/><input type="text" name="stock[]" id="stock" placeholder="STOCK" style="width:120px;margin-left:2px;margin-top:5px"/><a href="javascript:void(0);" class="remove_button">Remove</div></div>'; //New input field html
        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    })

});
