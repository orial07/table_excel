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

<br>
<h3> My Tables </h3>
<hr>
<?php
 $this->load->helper('form');
   echo "<table class='table table-bordered'> ";
   echo '<tr> <th> Table ID </th> <th> Table Name </th> <th> Table Updated On </th> <th> Edit </th> <th> Delete </th> </tr>';
  
foreach ($tables as $key => $value) 
    {
        
            echo form_open_multipart('home/edit');
         
            echo '
                   <tr>
                     <td>
                      <input readonly type="text" name="table_id" value="'.$value->table_id.'" > </input>
                         </td>';
      
echo "<td>".$value->table_name."</td>";
echo "<td> ".$value->updated."</td> ";
   
?>
<td>
<button type="submit" name="action" value="Edit" class="btn btn-info btn-sm">
      <span class="glyphicon glyphicon-edit"></span> Edit
    </button>
</td>
<td>
<button type="submit" name="action" class="btn btn-danger btn-sm"  value="Delete" onclick="return confirm('Are you sure you want to delete this table?')">
      <span class="glyphicon glyphicon-remove-circle"></span> Delete 
    </button>
   </td>
    </tr>
</form>
<?php
}
echo "</table>";
  ?>
  </div>
  </div>

  </body>
  </html>