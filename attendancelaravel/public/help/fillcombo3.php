<?php
 include('connect.php');
 


        $course_id=$_GET['course_id'];
		$sem_id=$_GET['sem_id'];
        $selquery="select s_id,first_name,middle_name,last_name,rollno from tm_student where course_id=$course_id and sem_id=$sem_id order by last_name,first_name,middle_name" ;
        $rsstud=mysqli_query($con,$selquery);
       
		$cnt=1;
        $str=",";
        while($row=mysqli_fetch_row($rsstud))
        {
           echo "<tr>";
           echo "<td><div class='btn btn-primary'id='".$row[0]."' onclick=getstud(this,'".$row[0]."')>Promote</div></td>";  
           echo "<td>$row[4]</td>";
           echo "<td>$row[3]</td>";
           echo "<td>$row[1] </td>";
           echo "<td>$row[2] </td>";
           echo "</tr>";
           $cnt=$cnt+1;
           $str=$str.$row[0].",";
        }
        echo "<input type='hidden' id='studids' name='studids' value=$str> ";                                                                       
                                                                                   
	

?>