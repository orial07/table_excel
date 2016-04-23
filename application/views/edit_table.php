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
<div class="col-sm-5" >
 <h3 > <?php echo $table['table_name'] ;?></h3>
</div>
</div>
<div class="col-sm-4" >

</div>
<?php 

  $this->load->helper('form');
echo form_open_multipart('home/update');
?>
 <div class="form-group">
    <label for="exampleInputName2">Table Name</label>
    <input type="text"  name="name" class="form-control" id="exampleInputName2" value="<?php echo $table['table_name'] ;?>" required="required">
<hr>
</div>

 <?php  
     $fname=(explode(",,",$table['fname']));
      $ftext=(explode(",,",$table['ftext']));
    if($fname[0]=='Field Name'){
        echo '<hr>
 <div   class="input_fields_wrap">
 <div class="form-inline">
    <button class="add_field_button"> <span  class="glyphicon glyphicon-plus"> </span></button>
    
  </div>
</div>
';
}
else{
    for($i=0;$i<count($fname);$i++)
    {

      echo '
     <div   class="input_fields_wrap">
 <div class="form-inline">
  <button type="button" class="add_field_button"> <span  class="glyphicon glyphicon-plus"> </span></button>
   <input type="text" name="fname[]"/ class="form-control"  value="'. $fname[$i].'" required="required" >';
   if($ftext[$i]=='Description')
    echo'
   <input type="text" name="ftext[]"/ class="form-control"  value="Description" >
   <button type="button" class="remove_field"> <span  class="glyphicon glyphicon-remove" ></span></button> 
  </div>

</div>
';

else
 echo'
   <input type="text" name="ftext[]"/ class="form-control"  value="'. $ftext[$i].'" >
   <button type="button" class="remove_field"> <span  class="glyphicon glyphicon-remove" ></span></button> 
  </div>

</div>
';


}}
?>
<hr>
<div class="col-sm-7" ></div>
<div id="addcol" class="col-sm-3" >
</br>
<a href="#"> <span class="glyphicon glyphicon-plus"></span> </a>
Add new column
</div>
<div class="col-sm-16" id="printTable" >
<table class="table table-bordered">
  <thead>
 
    <tr>
      <th></th>
     <?php  
     $col=(explode(",,",$table['columns']));
    
 for($i=0;$i<count($col);$i++)
      {   echo '
      
     <th > <textarea  name="column[]" class="form-control" rows="2" required="required">'. $col[$i].'</textarea> 
       <div style="display: inline-block;" class="left"> <span  class="glyphicon glyphicon-menu-left" ></span> </div>
     <div style="display: inline-block;" class="right"> <span  class="glyphicon glyphicon-menu-right" ></span> </div>
     <div style="display: inline-block;" class="del"> <span  class="glyphicon glyphicon-remove-sign" ></span> </div>
   
     </th>
            '; }?>
    </tr>

  </thead>
  <tbody>
<?php  
     
     $row=(explode(",,",$table['rows']));
     $field=(explode(",,",$table['fields']));
  $t=0;
     for($i=0;$i<count($row);$i++)
       {
    echo '
    <tr >
      <th scope="row">
                 
            <textarea  name="row[]"class="form-control" rows="2" required="required"> '.$row[$i].'</textarea> 
             <a href="javascript:" class="up"><span class="glyphicon glyphicon-chevron-up"></a>
            <a href="javascript:" class="down"><span class="glyphicon glyphicon-chevron-down"></a> 
            <a href="javascript:" class="deleterow"><span class="glyphicon glyphicon-remove-sign"></a> 
            </th>
            ';
     
     for($j=0;$j<count($col);$j++)
         { 
          echo'
      <td><textarea name="field[]" class="form-control" rows="2" >'; 
      if(isset($field[$t])) 
        echo $field[$t]. ' </textarea></td>';
        else
          echo '  </textarea></td>';
        
       $t++;
    }
    echo '</tr>';
   
   }?>

  </tbody>
</table>
</div>
<input type="hidden" name="tb_id" value="<?php echo $table['table_id'];?>"/>

<div id="addrow" class="col-sm-9" class="text-center">
<a href="#"> <span class="glyphicon glyphicon-plus"></span> </a>
Add new row
</div>
<div class="col-sm-9" >
</br>
<button type="submit" name="action" value="save" class="btn btn-info btn-lg">
      <span class="glyphicon glyphicon-floppy-saved"></span> Save 
    </button>

    <button type="submit"  name="action" value="print" class="btn btn-info btn-lg" >
      <span class="glyphicon glyphicon-print"></span> Print 
    </button>

    <button type="submit"  name="action" value="send"  class="btn btn-info btn-lg">
      <span class="glyphicon glyphicon-send"></span> Download 
    </button>


<script type="text/javascript">

/*get html
$('#printMe').click(function(){
$('#printTable  input').each(
        function(){ 
            $(this).attr('value', $(this).val());
        });
 alert ($('#printTable').html());  


});
//Print the table
$('#printMe').click(function(){

  $("body").css("visibility", "hidden");
  $("a").css("visibility", "hidden");
  $("span").css("visibility", "hidden");
  $("#printTable").css("visibility", "visible");
      window.print();
   $("body").css("visibility", "visible");
   $("a").css("visibility", "visible");
   $("span").css("visibility", "visible");
});*/



//Move row up and down (bottom top avaible too just need to add them if necesary)
  $(".up,.down,.top,.bottom").click(function(){
        var row = $(this).parents("tr:first");
        if ($(this).is(".up")) {
            row.insertBefore(row.prev());
        } else if ($(this).is(".down")) {
            row.insertAfter(row.next());
        } else if ($(this).is(".top")) {
            //row.insertAfter($("table tr:first"));
            row.insertBefore($("table tr:first"));
        }else {
            row.insertAfter($("table tr:last"));
        }
    });

//Add Column to the table
 $("#addcol").click(function(){
  $("#printTable tr:gt(0)").append("<td> <textarea name='field[] 'class='form-control'rows='2' placeholder='Multiline textarea' ></textarea> </td>")
$("#printTable tr:first").append("<th> <textarea  name='column[]' class='form-control' rows='2' placeholder='Column Name' required='required'></textarea> <div style='display: inline-block;'' class='left'> <span  class='glyphicon glyphicon-menu-left' ></span> </div> <div style='display: inline-block;' class='right'> <span  class='glyphicon glyphicon-menu-right' ></span> </div>  <div style='display: inline-block;' class='del'> <span  class='glyphicon glyphicon-remove-sign' ></span> </div></th>")



});


//Add Row to the table
var i = 1;
 $("#addrow").click(function () {
     $("table tr:last").clone().find("input").each(function () {
         $(this).val('').attr({
             'id': function (_, id) {
                 return id + i
             },
                 'name': function (_, name) {
                 return name + i
             },
                 'value': ''
         });
     }).end().appendTo("table");
     i++;
 });



//Remove row from the table
 $(document).on('click', '.deleterow', function () {
  var r= confirm("Are you sure you want to delete the entire row?");
    if(r==true){
     $(this).closest('tr').remove();
     return false;}
 });

jQuery.moveColumn = function (table, from, to) {
    var rows = jQuery('tr', table);
    var cols;
    rows.each(function() {
        cols = jQuery(this).children('th, td');
        cols.eq(from).detach().insertBefore(cols.eq(to));
    });
}



$("table").on('click', '.right', function(event) {
    var rowindex = $(this).closest('th').index(); 
   
var tbl = jQuery('table');
jQuery.moveColumn(tbl, rowindex + 1 , rowindex);

});

$("table").on('click', '.left', function(event) {
    var rowindex = $(this).closest('th').index(); 
   
var tbl = jQuery('table');
if(rowindex!=1)
jQuery.moveColumn(tbl, rowindex  , rowindex -1 );

});

$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="form-inline"><input type="text" name="fname[]"/ class="form-control" placeholder="Field Name" required="required"> <input type="text" name="ftext[]"/ class="form-control" placeholder="Description" ><button class="remove_field"> <span  class="glyphicon glyphicon-remove" ></span></button></div>'); 
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});

$("table").on("click", ".del", function ( event ) {
    // Get index of parent TD among its siblings (add one for nth-child)
    if(confirm('Are you sure you want to delete this column?')){
    var ndx = $(this).parent().index() + 1;
    // Find all TD elements with the same index
      $("th", event.delegateTarget).remove(":nth-child(" + ndx + ")");
    $("td", event.delegateTarget).remove(":nth-child(" + ndx + ")");
  }
});
// auto adjust the height of
function h(e) {
    $(e).css({'height':'auto','overflow-y':'hidden'}).height(e.scrollHeight);
}
$('textarea').each(function () {
  h(this);
}).on('input', function () {
  h(this);
});



</script>

</div>
<?php echo form_close(); ?>
</body>
</html>