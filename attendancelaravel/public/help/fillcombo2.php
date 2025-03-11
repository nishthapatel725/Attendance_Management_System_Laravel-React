<?php
 include('connect.php');
 


        $course_id=$_GET['course_id'];
		$sem_id=$_GET['sem_id'];
        $selquery="select s_id,first_name,middle_name,last_name from tm_student where course_id=$course_id and sem_id=$sem_id order by last_name,first_name,middle_name" ;
        $rsstud=mysqli_query($con,$selquery);
       
		$cnt=1;
        while($row=mysqli_fetch_row($rsstud))
        {
           echo "<tr>";
           echo "<td><input type='text' name=$row[0] value=$cnt></td>";
           echo "<td>$row[3]</td>";
           echo "<td>$row[1] </td>";
           echo "<td>$row[2] </td>";
           echo "</tr>";
           $cnt=$cnt+1;
        }
                                                                                
                                                                                
	

?>