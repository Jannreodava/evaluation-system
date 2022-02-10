<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');


  ob_start();
  // if(!isset($_SESSION['system'])){

    $system = $conn->query("SELECT * FROM system_settings")->fetch_array();
    foreach($system as $k => $v){
      $_SESSION['system'][$k] = $v;
    }
  // }
  ob_end_flush();
  
?>
<nav class="navbar navbar-expand-sm bg-dager navbar-dark">
<ul class="navbar-nav">
  <li class="nav-item">
    <a class="nav-link" href="new_faculty.php">new faculty</a>
</li>
  <li class="nav-item">
    <a class="nav-link" href="new_student.php">new student</a>
</li>
</ul>
</nav>


<?php 
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>

<?php include 'header.php' ?>

<body class="hold-transition login-page ">
  <h2><b><?php echo $_SESSION['system']['name'] ?></b></h2>

<div class="login-box">
  <div class="login-logo">
    <a href="#" class="text-white"></a>
  </div>
  
  <!-- /.login-logo -->

	   
  
  <div class="card">
    <div class="card-body login-card-body">
      <form action="" id="login-form">
	   <div class="form-group mb-3">
	   
	   
          <label for="">Login As</label>
          <select name="login" id="" class="custom-select custom-select-sm">
            <option value="3">Student</option>
            <option value="2">Faculty</option>
            <option value="1">Admin</option>
          </select>
        </div>
	  
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" required placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" required placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
       
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
		 
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<style>
body{ 
background-image: url('PicsArt_09-27-05.25.56.jpg');
background-repeat: no-repeat;
overflow: hidden;
background-size: cover;
}
.h2{
		background-color: green;
}
.card-body {
	background-color: rgba(0,0,0,0.1);
	box-shadow: 0 0 20px #333;
}

</style>
<script>
  $(document).ready(function(){
    $('#login-form').submit(function(e){
    e.preventDefault()
    start_load()
    if($(this).find('.alert-danger').length > 0 )
      $(this).find('.alert-danger').remove();
    $.ajax({
      url:'ajax.php?action=login',
      method:'POST',
      data:$(this).serialize(),
      error:err=>{
        console.log(err)
        end_load();

      },
      success:function(resp){
        if(resp == 1){
          location.href ='index.php?page=home';
        }else{
          $('#login-form').prepend('<div class="alert alert-danger">Input information is incorrect.</div>')
          end_load();
        }
      }
    })
  })
  })
</script>
<?php include 'footer.php' ?>

</body>
</html>
