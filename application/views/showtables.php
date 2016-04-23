<!DOCTYPE html>
<html lang="en">
<head>
  <title>Table</title>
<?php include 'head.php' ?>
</head>

<body>

<?php include 'nav.php' ?>
<div class="ccontainer-fluid">
<div class="row">
<div class="col-sm-1"> </div>
<div class="col-sm-9">


<?php

foreach ($tables as $key => $value) {
     echo "<table class='table table-bordered'>";
     foreach ($value as $k => $v) 
     {  
            
    $this->load->helper('form');
echo form_open_multipart('home/edit');
      if($k=='table_id')
 {
  
   ?>
    <input type="hidden" name="table_id" value=" <?php echo $v?>"> </input>
      <?php
  
}
       # code...
      if($k=='table_name')
      echo "<h3 class='text-center'>".$v."</h3>";


     if($k=='columns'){
     	$col=(explode(",,",$v));
     	echo "<tr>";
       echo "<th> </th>";
     for($i=0;$i<count($col);$i++)
        	echo "<th>".$col[$i]."</th>";
    }
     echo " </tr>";

if($k=='rows')
{
     	$rows=(explode(",,",$v));
     	
}

   if($k=='fields' ){
     $fi=(explode(",,",$v));
       $j=0;
       $i=0;

      foreach ($fi as $key) {
     
   if($i% count($col) ==0)
          {
          	 echo " </tr>";
          	echo "<tr> <th>". $rows[$j]."</th>";
          	 $j++;
          }
          	 
          	 
          	 echo "<td>".$key."</td>";
       $i++;

      }

}
}

 echo "</table>";

if($k=='updated')
{

    echo "Updated on: ".$v." "; 	
     	
}
?>
<button type="submit" name="action" value="Edit" class="btn btn-info btn-sm">
      <span class="glyphicon glyphicon-edit"></span> Edit
    </button>

 <button type="submit" name="action"  class="btn btn-info btn-sm" value='Print'>
      <span class="glyphicon glyphicon-print"></span> Print 
    </button>


  <button type="submit" name="action" class="btn btn-danger btn-sm"  value="Delete" >
      <span class="glyphicon glyphicon-remove-circle"></span> Delete 
    </button>
   
</form>
<?php

}
  ?>
  </div>
  </div>
  </div>
  </body>
  </html>