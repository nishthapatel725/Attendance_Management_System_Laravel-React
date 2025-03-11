<?php
 include('connect.php');

      //$selquery="select s_id,first_name,middle_name,last_name from tm_student where course_id="$course_id",sem_id="$sem_id" order by last_name,first_name,middle_name" ;
      //$rsuser=mysqli_query($con,$selquery);
      
      $selquerycourse="select course_id,course_name from tm_course";
      $rscourse=mysqli_query($con,$selquerycourse);

      $selquerysem="select sem_id,sem_name from tm_sem";
      $rssem=mysqli_query($con,$selquerysem);
      
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD-->
<head>
   
     <meta charset="UTF-8" />
    <title>Student Roll No</title>
     <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
     <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <!-- GLOBAL STYLES -->
    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/theme.css" />
    <link rel="stylesheet" href="assets/css/MoneAdmin.css" />
    <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />
    <!--END GLOBAL STYLES -->

    <!-- PAGE LEVEL STYLES -->
    <link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/plugins/validationengine/css/validationEngine.jquery.css" />
    <!-- END PAGE LEVEL  STYLES -->
       <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
    <!-- END  HEAD-->
    <!-- BEGIN BODY-->
<body class="padTop53 ">

     <!-- MAIN WRAPPER -->
    <div id="wrap">


         <!-- HEADER SECTION -->
        <div id="top">

            <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 10px;">
                <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
                    <i class="icon-align-justify"></i>
                </a>
                <!-- LOGO SECTION -->
                <header class="navbar-header">

                 <a href="index.html" class="navbar-brand">
                 <font color="purple" > 𝓐𝓽𝓽𝓮𝓷𝓭𝓮𝓷𝓬𝓮 𝓜𝓪𝓷𝓪𝓰𝓶𝓮𝓷𝓽 𝓢𝔂𝓼𝓽𝓮𝓶 </font></a>
                
                </header>
                <!-- END LOGO SECTION -->
                <ul class="nav navbar-top-links navbar-right">

                     
                    
                    

                    <!--ADMIN SETTINGS SECTIONS -->

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-user "></i>&nbsp; <i class="icon-chevron-down "></i>
                        </a>

                        <ul class="dropdown-menu dropdown-user">
                        <li><a href="homeams.php"><i class="icon-user"></i>Login Page </a>
                            </li>
                            <li><a href="admindashboard.php"><i class="icon-user"></i>Admin Dashboard </a>
                            </li>   
                        </ul>

                    </li>
                    <!--END ADMIN SETTINGS -->
                </ul>

            </nav>
            <div class="panel-body">
                            <ul class="nav nav-pills">
                                <li ><a href="course.php">Course
                                <span class="label label-danger"></span></a>
                                </li>
                                <li ><a href="sems.php">Semester
                                <span class="label label-danger"></span></a>
                                </li>
                                <li ><a href="subj.php">Subject
                                <span class="label label-danger"></span></a>
                                </li>
                                <li ><a href="lec.php">Lecturer
                                <span class="label label-danger"></span></a>
                                </li>
                                <li ><a href="stud.php">Students
                                <span class="label label-danger"></span></a>
                                </li>
                                <li ><a href="suballot.php">Suballotement
                                <span class="label label-danger"></span></a>
                                </li>
                                <li><a href="getstud.php">Promote
                                <span class="label label-danger"></span></a>
                                </li>
                                <li ><a href="generaterollno.php">Get Roll No
                                <span class="label label-danger"></span></a>
                                </li>
                                
                                
                            </ul>
    </div>  
        </div>
        <!-- END HEADER SECTION -->



         

        <!--PAGE CONTENT -->
        
                <hr />
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           
                        </div>
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
                        
                                <li class="active"><a href="#tab2" data-toggle="tab">Generate Student Roll No</a>
                                </li>
                                
                            </ul>

                            <div class="tab-content">
                               
                                   
                                   

                               
                                <div class="tab-pane fade in active" id="tab2">
                                
                                   
                                   
                                    <form class="form-horizontal"  action="grndb.php" method= "POST" id="popup-validation">
                                    <div class="form-group">
                                            <label class="control-label col-lg-4">Course</label>
                                            <div class="col-lg-4">
                                            <select class="form-control" name="course_id" id="course_id">
                                                <?php
                                                  while($row=mysqli_fetch_row($rscourse))
                                                  {
                                                      echo "<option value=$row[0]>$row[1]";
                                                      echo "</option>";
                                                  }
                                                ?>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-4">Semester</label>
                                            <div class="col-lg-4">
                                            <select class="form-control" name="sem_id" id="sem_id">
                                                <?php 
                                                  while($row=mysqli_fetch_row($rssem))
                                                  {
                                                      echo "<option value=$row[0]>$row[1]";
                                                      echo "</option>";
                                                  }
                                                ?>
                                            </select>
                                            </div>
                                        </div>

                                        <script type="text/javascript">
                                            function fillstudents()
                                            {
                                                var course_id=document.getElementById("course_id").value;
                                                var sem_id=document.getElementById("sem_id").value;
                                                //alert(course_id +" "+sem_id);
                                                var xmlhttp;
                                                if (window.XMLHttpRequest)
                                                {// code for IE7+, Firefox, Chrome, Opera, Safari
                                                    xmlhttp=new XMLHttpRequest();
                                                }	
                                                else
                                                {// code for IE6, IE5
                                                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                                                }	
                                                    xmlhttp.onreadystatechange = function(){
                                                if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
                                                {
                                                    //alert(str);
                                                    document.getElementById("tbodystudents").innerHTML = xmlhttp.responseText;
                                                }
                                                    }
                                                xmlhttp.open("GET","fillcombo2.php?course_id="+course_id+"&sem_id="+sem_id, true);
                                                xmlhttp.send();
                                                //alert(str);
                                            }					
						                </script>

                                                    
                                         <div align="center">
                                        <a  class="btn btn-info" name="btng" onclick="fillstudents()">Generate Roll No</a>
                                        </div>
                                        <br/>
                                        <br/>
                                        
                                            <div class="row"  >
                                           
                                                <div class="col-lg-12">
                                               
                                                    <div class="panel panel-default">
                                                        
                                                        <div class="panel-body">
                                                            
                                                            <div class="table-responsive">
                                                                                                                                                                                              
                                                                <table class="table table-striped table-bordered table-hover">
                                                                     
                                                                        <thead>
                                                                                <tr>
                                                                                    <th>Roll No</th>
                                                                                    <th>Last Name</th>
                                                                                    <th>First Name</th>
                                                                                    <th>Middle Name</th>
                                                                                    
                                                                                    
                                                                                </tr>
                                                                        </thead>
                                                                        <tbody id="tbodystudents">
                                                                                
                                                                        </tbody>
                                                                        
                                                                        </table>
                                                                       
                                                            </div>
                                                                           
                                                        </div>
                                                    
                                                     </div>
                                                </div>
                                                
                                             
                                             
                                                                
                                        <div style="text-align:center" class="form-actions no-margin-bottom">
                                        
                                            <input type="hidden" name="s_id" value="<?php if(isset($esid)){echo $esid;}?>">
                                        </div><br/>
                                        <div class="col-lg-8" name="tbodystudents" id="tbodystudents" >
       
       </div>
         
       </div>
   </div>

                                    </form>
                                    <div align="center">
                                    <button type="submit" name="btn1">Save</button>
                                        </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                

                

        </div>
       <!--END PAGE CONTENT -->


    </div>

     <!--END MAIN WRAPPER -->

   
     <!-- GLOBAL SCRIPTS -->
    <script src="assets/plugins/jquery-2.0.3.min.js"></script>
     <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>

    <script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>
     <script>
         $(document).ready(function () {
             $('#dataTables-admin').dataTable();
         });
    </script>
    <script src="assets/plugins/validationengine/js/jquery.validationEngine.js"></script>
    <script src="assets/plugins/validationengine/js/languages/jquery.validationEngine-en.js"></script>
    <script src="assets/plugins/jquery-validation-1.11.1/dist/jquery.validate.min.js"></script>
    <script src="assets/js/validationInit.js"></script>
    <script>
        $(function () { formValidation(); });
        </script>
    <!-- END GLOBAL SCRIPTS -->
</body>
    <!-- END BODY-->
    
</html>
