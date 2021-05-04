/**
 * @author Sachindu
 */


var url;

function setUrl (page_url) {
   url = page_url;
}

function getUrl(){
	return  url;
}

function formSubmission (frm_id) {
  
  $(frm_id).validate({
		debug : true,
		rules : {
			'txt_user_pw' : {
				password : true
			}
		},

		submitHandler : function(form) {
			// code for AJAX starts

			formData = new FormData($(frm_id)[0]);
			// var ajax_url = "user-controller.php?ftype=add_user";
			var ajax_url = getUrl();

			$.ajax({
				url : ajax_url,
				type : "POST",
				data : formData,
				contentType : false,
				cache : false,
				processData : false,
				dataType : "json",
				success : function(data) {
					console.log(data);
                    swal({
                        title: data.title,
                        text: data.body,
                        type: "success"
                    }, function () {
                        console.log("in reload function");
                        location.reload();
                    });
					if (data.status == false) {
						console.log("in false");
						swal(data.msg, "You clicked the button!", "error");
					}
				},
				error : function() {
					alert('Unable To Save Style');
				}
			});
			// #END! AJAX
		}
	}); 
}


//custom validation
$( document ).ready(function() {
   
   	// Password: 8 lenth > 1 number > 1 capitol
   	$.validator.addMethod('password', function (value, element) {
        return value.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/);
    },
        'valid password: more than 8 characters with at least 1 number, 1 lowercase and 1 uppercase letter.'
    );
});
