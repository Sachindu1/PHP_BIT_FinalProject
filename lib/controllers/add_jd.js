/**
 * @author Sachindu
 */

// jd add process via the modal
$('#btn_addJd').click(function() {

    // location.reload();

    $("#frm_addJd").validate({
        debug : true,
        submitHandler : function(form) {
            console.log("submitting"),
                // code for AJAX starts
                formData = new FormData($("#frm_addJd")[0]);

            var ajax_url = "../job_descriptions/jd-controller.php?ftype=add_jd";

            $.ajax({
                url : ajax_url,
                type : "POST",
                data : formData,
                contentType : false,
                cache : false,
                processData : false,
                dataType : "json",
                success : function(data) {

                    if (data.status == true) {

                        $("#mdl_close").click();
                        swal({
                            title : data.title,
                            text : data.body,
                            type : "success"
                        }, function() {
                            location.reload();
                        });

                    }
                    if (data.status == false) {

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

});