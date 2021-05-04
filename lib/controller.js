/**
 * @author Sachindu
 */


var url;

function setUrl(page_url) {
    url = page_url;
}

function getUrl() {
    return url;
}


function formSubmission(frm_id) {

    $(frm_id).validate({

        debug: true,
        rules: {
            'txt_user_pw': {password: true},
            'date_start': {date_min: '.date-end'},
            'date_end': {date_max: '.date-start'},
            'txt_nic': {nic_val: '.nic'}
        },

        submitHandler: function (form) {
            // code for AJAX starts

            formData = new FormData($(frm_id)[0]);
            var ajax_url = getUrl();

            $.ajax({
                url: ajax_url,
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    if (data.status == true) {
                        console.log("in true");
                        // swal(data.title, data.body, "success");
                        $('#clr').click();
                        swal({
                            title: data.title,
                            text: data.body,
                            type: "success"
                        }, function () {
                            console.log("in reload function");
                             location.reload();
                        });
                        // window.location.reload();
                    }
                    if (data.status == false) {
                        console.log("in false");
                        swal(data.title, data.body, "error");
                    }
                },
                error: function (data) {
                    console.log(data);
                    alert('Unable To Save Style');
                }
            });

            // #END! AJAX
        }
    });

}


//custom validation
$(document).ready(function () {

    // Password: 8 lenth > 1 number > 1 capitol
    $.validator.addMethod('password', function (value, element) {
            return value.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&]{0,})[A-Za-z\d$@$!%*?&]{8,}/);
        },
        'valid password: more than 8 characters with at least 1 number, 1 lowercase and 1 uppercase letter.'
    );

    // date range
    $.validator.addMethod('date_min', function (value, element, param) {
            return this.optional(element) || value <= $(param).val();
        }, 'Should be an earlier date than the end date.'
    );

    $.validator.addMethod('date_max', function (value, element, param) {
        return this.optional(element) || value >= $(param).val();
    }, 'Should be a later date than the start date.');

    //NIC validation old and new
    $.validator.addMethod('nic_val', function (value, element) {
            return value.match(/([0-9]{9}[V|X])|([0-9]{12})/);
        },
        'Invalid NIC format'
    );

});
