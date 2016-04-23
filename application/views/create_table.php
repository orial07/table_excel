<!DOCTYPE html>
<html lang="en">
<head>
  <title>Table</title>
<?php include 'head.php' ?>

</style>
</head>

<body>
<?php include 'nav.php' ?>
<div class="ccontainer-fluid">
<div class="row">
<div class="col-sm-5" >
  <h3 > New Table </h3>
</div>
</div>
<div class="col-sm-4" >

 
 
</div>
<?php 

  $this->load->helper('form');
echo form_open_multipart('home/save');
?>
 <div class="form-group">
    <label for="exampleInputName2">Table Name</label>
    <input type="text"  name="name" class="form-control" id="exampleInputName2" placeholder="Table Name" required="required">
 <hr>
 <div   class="input_fields_wrap">
 <div class="form-inline">
    <button class="add_field_button"> <span  class="glyphicon glyphicon-plus"> </span></button>
   
  </div>
</div>
<div class="col-sm-7" ></div>
<div id="addcol" class="col-sm-3" >
</br>
<a href="#"> <span class="glyphicon glyphicon-plus"></span> </a>
Add new column
</div>
<hr>
</div>
</div>
<div div class="col-sm-16">

<div  id="printTable" >
 <div class="table-responsive">
<table class="table table-bordered"  id="defaultTable">
  <thead>
 
    <tr>
      <th></th>
      <th >
       <textarea  name="column[]" class="form-control" rows="2" placeholder="Column Name" required="required"></textarea> 
       <div style="display: inline-block;" class="left"> <span  class="glyphicon glyphicon-menu-left" ></span> </div>
     <div style="display: inline-block;" class="right"> <span  class="glyphicon glyphicon-menu-right" ></span> </div>
  <div style="display: inline-block;" class="del"> <span  class="glyphicon glyphicon-remove-sign" ></span> </div>
      </th>
      <th > <textarea  name="column[]" class="form-control" rows="2" placeholder="Column Name" required="required"></textarea> 
     <div style="display: inline-block;" class="left"> <span  class="glyphicon glyphicon-menu-left" ></span> </div>
     <div style="display: inline-block;" class="right"> <span  class="glyphicon glyphicon-menu-right" ></span> </div>
     <div style="display: inline-block;" class="del"> <span  class="glyphicon glyphicon-remove-sign" ></span> </div>
     </th>
     <th > <textarea  name="column[]" class="form-control" rows="2" placeholder="Column Name" required="required"></textarea> 
     <div style="display: inline-block;" class="left"> <span  class="glyphicon glyphicon-menu-left" ></span> </div>
     <div style="display: inline-block;" class="right"> <span  class="glyphicon glyphicon-menu-right" ></span> </div>
     <div style="display: inline-block;" class="del"> <span  class="glyphicon glyphicon-remove-sign" ></span> </div>
     </th>
    </tr>

  </thead>
  <tbody >
  <?php 
  for($t=0;$t<3;$t++) 
    {?>
    <tr >
      <th scope="row">
                 
            <textarea  name="row[]"class="form-control" rows="2" placeholder="Row Name" required="required"></textarea> 
            <a href="#" class="up"><span class="glyphicon glyphicon-chevron-up"></a>
            <a href="#" class="down"><span class="glyphicon glyphicon-chevron-down"></a> 
            <a href="#" class="deleterow"><span class="glyphicon glyphicon-remove-sign"></a> 


            </th>

      <td><textarea name="field[]" class="form-control" rows="2" placeholder="Multiline textarea" ></textarea></td>
      <td><textarea name="field[]" class="form-control" rows="2" placeholder="Multiline textarea" ></textarea></td>
      <td><textarea name="field[]"class="form-control" rows="2" placeholder="Multiline textarea"></textarea></td>
    </tr>
   <?php }  ?>
  </tbody>
</table>
</div>


<div id="addrow" class="col-sm-9" class="text-center">
<a href="#"> <span class="glyphicon glyphicon-plus"></span> </a>
Add new row
</div>
<div class="col-sm-9" >
</br>
<button type="submit" name="action" value="save" class="btn btn-info btn-lg">
      <span class="glyphicon glyphicon-floppy-saved"></span> Save 
    </button>

    <button type="submit" name='action' class="btn btn-info btn-lg" value="print" >
      <span class="glyphicon glyphicon-print"></span> Print 
    </button>

    <button type="submit"  name="action" value="send"  class="btn btn-info btn-lg" >
      <span class="glyphicon glyphicon-send"></span> Download
    </button>

 <button type="reset" class="btn btn-danger btn-lg" onclick="return confirm('Are you sure you want to delete this table?')">
      <span class="glyphicon glyphicon-remove-circle"></span> Delete 
    </button>

<script type="text/javascript">

/*Print the table
$('#printMe').click(function(){

  $("body").css("visibility", "hidden");
  $("a").css("visibility", "hidden");
  $("span").css("visibility", "hidden");
  $("#printTable").css("visibility", "visible");
      window.print();
   $("body").css("visibility", "visible");
   $("a").css("visibility", "visible");
   $("span").css("visibility", "hidden");
});

*/

//Move row up and down (bottom top avaible too just need to add them if necesary)
$(document).ready(function(){
    $(".up,.down").click(function(){
        var row = $(this).parents("tr:first");
        if ($(this).is(".up")) {
            row.insertBefore(row.prev());
        } else {
            row.insertAfter(row.next());
        }
    });
});

//Add Column to the table
 $("#addcol").click(function(){
  $("#printTable tr:gt(0)").append("<td> <textarea name='field[] 'class='form-control'rows='2' placeholder='Multiline textarea' ></textarea> </td>")
$("#printTable tr:first").append("<th> <textarea  name='column[]' class='form-control' rows='2' placeholder='Column Name' required='required'></textarea> <div style='display: inline-block;'' class='left'> <span  class='glyphicon glyphicon-menu-left' ></span> </div> <div style='display: inline-block;' class='right'> <span  class='glyphicon glyphicon-menu-right' ></span> </div>  <div style='display: inline-block;' class='del'> <span  class='glyphicon glyphicon-remove-sign' ></span> </div></th>");
function h(e) {
    $(e).css({'height':'auto','overflow-y':'hidden'}).height(e.scrollHeight);
}
$('textarea').each(function () {
  h(this);
}).on('input', function () {
  h(this);
});
});


//Add Row to the table
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