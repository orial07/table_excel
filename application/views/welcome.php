<!DOCTYPE html>
<html lang="en">
<head>
  <title>Log In</title>
<?php include 'head.php' ?>
</head>
<body>

<div class="container-fluid">
<div class="row">
<div class="col-sm-1">  </div>
<div class="col-sm-4" >
<h3 class="text-center" >Log in</h3>
 <?php 

  $this->load->helper('form');
echo form_open_multipart('home/login');
if(isset($login_errors))
echo '<div class="alert alert-danger">'.$login_errors."</div>";

if(isset($credintials))
echo '<div class="alert alert-danger">'.$credintials."</div>";

  ?> 
 
 <div class="form-group">
      <label for="email">Email</label>
      <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required="required">
    </div>

  <div class="form-horizontal" role="form">
      <label for="pass">Password</label>
      <input type="password" name="pass" class="form-control" id="pass" placeholder="Enter password" required="required">
    </div>
    </br>
    <button type="submit" class="btn btn-default">Log in</button>
  </form>

</div>
<div class="col-sm-1">  </div>
<div class="col-sm-5">
<h3 class="text-center">Register </h3>
 <?php 
echo form_open_multipart('home/register');

if(isset($register_errors))
echo '<div class="alert alert-danger">'.$register_errors."</div>";

if(isset($register))
echo '<div class="alert alert-success">'.$register."</div>";

?>

 
 <div class="form-group">
      <label for="email">Email</label>
      <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required="required">
    </div>

  <div class="form-horizontal" role="form">
      <label for="pass">Password</label>
      <input type="password" name="pass" class="form-control" id="pass" placeholder="Enter password" required="required">
    </div>
</br>
      <div class="form-horizontal" role="form">
      <label for="name">Full Name</label>
      <input type="text" name="name" class="form-control" id="name" placeholder="Enter full name" required="required">
    </div>

      </br>
    <button type="submit" class="btn btn-default">Register</button>
  </form>
</div>

  </div>
  </div>
<br>

<div class="container-fluid">
<div class="row">
  <div class="col-sm-3">  </div>

<div style="display:inline-block;"class="col-sm-2" >

  <button style="display:inline-block;"type="button" class="btn btn-danger btn-lg btn-block" id='demo'>
     <b>Try Demo</b>
    </button>
</div>

<div style="display:inline-block;"class="col-sm-2" >

  <button style="display:inline-block;"type="button" class="btn btn-danger btn-lg btn-block" id='upload'>
     <b>Upload Table</b>
    </button>
</div>

<script type="text/javascript">
  $('#demo').click(function(){
window.location.href = "<?php $this->load->helper('url');
      echo site_url('home/demo');?>";
});

    $('#upload').click(function(){
window.location.href = "<?php $this->load->helper('url');
      echo site_url('home/uploadTable ');?>";
});
</script>
</body>
</html>
