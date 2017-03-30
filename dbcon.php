<?php
    $con=  mysqli_connect('localhost', 'id341146_saiprasad', 'Saiprasad1996', 'id341146_student');
	
    if(mysqli_connect_errno($con))
    {
        die($con ." Database could not be connected");
    }
    
    
    /*while($row= mysqli_fetch_array($query))
    {
        echo $row['slno'];
        echo '<h2>'.$row['heading'].'</h2>';
        echo '<br/>'.$row['owner'] . '&nbsp;&nbsp;&nbsp;&nbsp;'.$row['date'];
        echo '<br/>'.$row['content'];
        echo '<br/><br/><br/>';
    }
      */
     
?>
