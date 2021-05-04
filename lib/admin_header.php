<?php ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Welcome To | Esoft Metro Capus - Kandy: Virtual HR</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    

    <!-- Google Fonts 
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    -->
    
    <link rel="stylesheet" href="../../plugins/font-awesome/css/font-awesome.css">
    
	<!-- Google Fonts -->
    <link href="../../css/web_ref.css" rel="stylesheet" type="text/css">
    <link href="../../css/web_ref2.css" rel="stylesheet" type="text/css">
    
    <!-- Bootstrap Core Css -->
    <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../../plugins/node-waves/waves.css" rel="stylesheet" />
       
    <!-- Dropzone Css -->
    <link href="../../plugins/dropzone/dropzone.css" rel="stylesheet">

    <!-- Multi Select Css -->
    <link href="../../plugins/multi-select/css/multi-select.css" rel="stylesheet">
    
    <!-- Bootstrap Spinner Css -->
    <link href="../../plugins/jquery-spinner/css/bootstrap-spinner.css" rel="stylesheet">

    <!-- Bootstrap Tagsinput Css -->
    <link href="../../plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

	 <!-- Bootstrap Material Datetime Picker Css -->
    <link href="../../plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
     	
    <!-- Animation Css -->
    <link href="../../plugins/animate-css/animate.css" rel="stylesheet" />
    
    <!-- Wait Me Css -->
    <link href="../../plugins/waitme/waitMe.css" rel="stylesheet" />

	<!-- noUISlider Css -->
    <link href="../../plugins/nouislider/nouislider.min.css" rel="stylesheet" />

   <!-- Sweetalert Css -->
    <link href="../../plugins/sweetalert/sweetalert.css" rel="stylesheet" />

	<!-- calender     -->
    <link href="../../plugins/bootstrap-calendar-master/css/calendar.css" rel="stylesheet" />
    	
    <!-- JQuery DataTable Css -->
    <!-- <link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet"> -->
    <link href="../../plugins/DataTables_new/datatables.css" rel="stylesheet">


    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">
	<!-- <link href="../../css/error.css" rel="stylesheet"> -->
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />
    
</head>

<body class="theme-indigo">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <span class="navbar-brand" href="index.html">Esoft - Vertual HR</span>
            </div>          
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="../../images/user.png" width="48" height="48" alt="User" />
                </div>
                
<!-- about the user  -->
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $session_user_name ?></div>
                    <div class="email"><?php echo $sesion_mail_name; ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            <!--<li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li> -->
                            <li><a href="../login/sign-out.php"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
   <!-- about the user  -->        
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active" >
                        <a href="../dashboards/dashbord_redirect.php">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a class="menu-toggle">
                            <i class="material-icons">people</i>
                            <span>Users</span>
                        </a>
                        <ul class="ml-menu">
                           <li><a href="../user/user-add-UI.php">Add New</a></li>
                           <li><a href="../user/user-search-UI.php">Make a Chnange</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">perm_media</i><span>HR plan</span>
                        </a>
                        <ul class="ml-menu">
                            <li><a href="../hr_plan/plan-add-UI.php">Make New Plan</a></li>
                            <li><a href="../hr_plan/plan-search-UI.php">Make Change</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="menu-toggle">
                            <i class="material-icons">recent_actors</i>
                            <span>Vacancies</span>
                        </a>
                        <ul class="ml-menu">
                          <li><a href="../vecancy/publish-vecancy-UI.php">Publish New</a></li>
                          <li><a href="../vecancy/vacancy_show.php">View and Update</a></li>
                        </ul>
                    </li>                    
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-handshake-o fa-2x" aria-hidden="true"></i>
                            <span>Applicatations</span>
                        </a>
                        <ul class="ml-menu">
                          <li><a href="../screening/view_applicants.php">View</a></li>
                          <li><a href="../screening/seacrh_applicants.php">Search</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                           <i class="material-icons">perm_contact_calendar</i>
                            <span>Employees</span>
                        </a>
                     <ul class="ml-menu">
                     	<li><a href="../employe/employe-add-UI.php">Add new Employee</a></li>
                        <li><a href="../employe/emp-change-UI.php">Search n View</a></li>
                     </ul>
                    </li>
                    <li>
                        <a class="menu-toggle">
                            <i class="material-icons">format_list_numbered</i>
                            <span>Objectives Organizer</span>
                        </a>
                        <ul class="ml-menu">
                          <li><a href="../obj_cration/objective_add_ui.php">Create New</a></li>
                          <li><a href="">Add status</a></li>
                          <li><a href="../obj_complete/obj_complete.php">View n Update</a></li>
                           <li><a href="../mbo_evaluation/view_report_MBO_UI.php">View MBO Evaluations</a></li>
                        </ul>
                    </li>
                   
                    <li>
                        <a class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Questionaires</span>
                        </a>
                        <ul class="ml-menu">
                          <li><a href="../questionire/q_paper_add.php">Create New</a></li>
                          <li><a href="../question_cat/qusetion_cat.php"> Add question categories</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="../Evaluations/360_distribution.php">
                            <i class="material-icons">how_to_vote</i>
                            <span>Distribute qestionaires</span>
                        </a>
                    </li>
                     <li>
                        <a class="menu-toggle">
                            <i class="material-icons">group_work</i>
                            <span>Questionaire Evaluations</span>
                        </a>
                        <ul class="ml-menu">
                         
                          <li><a href="../Evaluations/evaluation_UI.php">Fill Evaluations</a></li>
                          <li><a href="../hr_evaluation/view_report_360_UI.php">View MBO Evaluations</a></li>
                        </ul>                        
                    </li>
                    <li>
                        <a class="menu-toggle">
                            <i class="material-icons">schedule</i>
                            <span>Schedules</span>
                        </a>
                        <ul class="ml-menu">
                          <li>
                          	<a href="../event_handler/event_handler_interviews.php" ><span> Interview </span></a>
                          	<!--<ul class="ml-menu">
                                <li><a href="">Add new</a></li>
                               <li><a href="">View or Reschedule</a></li>
                            </ul> -->
                          </li>
                          <li>
                             <a href="../event_handler/event_handler_evaluations.php" ><span>Evaluations</span></a>
                              <!-- <ul class="ml-menu">
                                 <li><a href="">Add new</a></li>
                                 <li><a href="">View or Reschedule</a></li>
                              </ul> -->
                            </li>
                        </ul>
                    </li>
                    
                     <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">trending_up</i>
                            <span>HR Evaluations</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../hr_evaluation/select_emp_UI.php">360</a>
                            </li>
                            <li>
                                <a href="../mbo_evaluation/select_emp_UI.php">MBO</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">widgets</i>
                            <span>Helper Details</span>
                        </a>
                        <ul class="ml-menu">
                        	<li>
                                <a href="../quals/qual_centre_UI.php">Edu Qualifications</a>
                            </li>
                            <li>
                                <a href="../user_types/user-add-type-UI.php">User Types</a>
                            </li>
                            <li>
                                <a href="../job_descriptions/add-jd-UI.php">Job Descriptions</a>
                            </li>
                            <li>
                                <a href="../time_slots/add-timeslots-UI.php">Time Slots</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Reports</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../reports/turnover_report.php">Trurnover Report</a>
                            </li>
                            <li>
                                <a href="../reports/vacancy_report.php">Vacancy Reports</a>
                            </li>
                            <li>
                                <a href="../reports/seacrh_applicants.php">Applicants Reports</a>
                            </li>
                            <li>
                                <a href="../reports/recruitments_report.php">New Recritments Reports</a>
                            </li>
                            <li>
                                <a href="../reports/objectives_reports.php">Objectives Report</a>
                            </li>
                            <li>
                                <a href="../reports/employee_report.php">Eployees Report</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2016 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.4
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        