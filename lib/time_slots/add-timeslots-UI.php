<?php
/**
 * Created by PhpStorm.
 * User: Sachindu
 * Date: 6/26/2018
 * Time: 10:47 AM
 */
session_start();
if (isset($_SESSION["user"])) {

    $sesion_mail_name = $_SESSION["user"]["umail"];
    $session_user_name = $_SESSION["user"]["uname"];
    include_once '../header.php';
    include_once '../../classes/jd_class.php';
    include_once '../../classes/vecancy_class.php';


    ?>
    <link rel='stylesheet' href='../../plugins/fullcalendar/lib/fullcalendar.min.css' />
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>TIME SLOTS</h2>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           Non-Working Days <small>Add holidays... All the other days will be working days</small>
                        </h2>
                    </div>
                    <div class="body">
                         <div class="row">
                             <div class="col-lg-6">
                                 <div id='calendar'></div>
                             </div>
                             <div class="col-lg-6">
                                    <h2 id="date" class="select_date"> Select a date to continue...</h2>
                                 <form action="" method="post" id="frm_tslot">
                                     <input type="hidden" class="select_date" name="hdn_date">
                                     <br>
                                     <div class="row">
                                         <div class="form-group form-float">
                                             <div class="form-line">
                                                 <input type="text" class="form-control">
                                                 <label class="form-label">Holiday name</label>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <p>
                                             <b>Holiday type</b>
                                         </p>
                                         <select class="form-control show-tick">
                                             <option>Public</option>
                                             <option>Commercial</option>
                                             <option>Special</option>
                                         </select>
                                     </div>
                                     <div class="row">
                                         <div class="form-group form-float">
                                             <div class="form-line">
                                                 <input type="text" class="form-control" value="red" disabled>
                                                 <label class="form-label">Colour</label>
                                             </div>
                                         </div>
                                     </div>
                                     <button type="button" class="btn btn-primary m-t-15 waves-effect" name="btn_insert" id="btn_submit">
                                         Add
                                     </button>
                                     <button type="reset" class="btn btn-danger m-t-15 waves-effect" data-type="confirm">
                                         Clear
                                     </button>
                                 </form>
                             </div>
                         </div>
                    </div>


                </div>
            </div>

        </div>
    </section>

    <?php

    include '../foter.php';
}else{
    echo "Access denied";
}

?>
<script src="../../plugins/fullcalendar/lib/fullcalendar.min.js"></script>
<script>
    // $(document).ready(function () {
    //     alert('asdad');
    //     $('#a').bootstrapMaterialDatePicker();
    // })
    $(function() {

        // page is now ready, initialize the calendar...

        $('#calendar').fullCalendar({
            // put your options and callbacks here
            firstDay:1,
            editable: true,
            selectable: true,
            selectHelper: true,

            select: function(start) {

                $('.select_date').html(moment(start).format('YYYY-MM-DD'));
                $('.select_date').val(moment(start).format('YYYY-MM-DD'));
            },
        })

        $("#btn_submit").click(function () {

            formData = new FormData($("#frm_tslot")[0]);
            // var username = formData.get('txt_desc');
            // console.log(username);
            $.ajax({
                type:"POST",
                url:"time_slot_controller.php?ftype=update",
                data:formData,
                processData:false,
                contentType:false,
                success: function(data,status){
                    console.log(status);
                    console.log(data);
                }
                // error: function(XMLHttpRequest, textStatus, errorThrown) {
                //     if (textStatus == 'timeout') {
                //         //doe iets
                //     } else if (textStatus == 'error') {
                //         //doe iets
                //     }
                //     //her-activeer de zend knop
                //     goknop.attr({
                //         disabled: false
                //     });
                //     console.log(XMLHttpRequest . textStatus . errorThrown);
                // } //EINDE error

            });

        });

    });
</script>