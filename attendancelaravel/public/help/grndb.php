<?php
    include("connect.php");
    //insert code

    if(isset($_POST["btn1"]))
    {
        $course_id=$_POST['course_id'];
		$sem_id=$_POST['sem_id'];
        $selquery="select s_id,first_name,middle_name,last_name from tm_student where course_id=$course_id and sem_id=$sem_id order by last_name,first_name,middle_name" ;
        $rsstud=mysqli_query($con,$selquery);
       
		$cnt=1;
        while($row=mysqli_fetch_row($rsstud))
        {
           $uqry="update tm_student set rollno=$cnt where s_id=$row[0]";
           $ures=mysqli_query($con,$uqry);
           $cnt=$cnt+1;
        }
        header('location:generaterollno.php');
    }
    
?>