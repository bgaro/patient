<?php
session_start();

$dashboard = 'Doctor';

$content = '<div class="row">
<!-- left column -->
<div class="col-md-12">
  <!-- general form elements -->
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Doctor Login</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form">
      <div class="box-body">
        <div class="form-group">
          <label for="exampleInputName1">Email</label>
          <input type="text" class="form-control" id="name" placeholder="Enter Email">
        </div>
        
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" id="password" placeholder="Password">
        </div>
        
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <input type="button" class="btn btn-primary" onClick="LoginDoctor()" value="Submit"></input>
      </div>
    </form>
  </div>
  <!-- /.box -->
</div>
</div>';
include('../master.php');
?>
<!-- page script -->
<script>
  function LoginDoctor() {

    $.ajax({
      type: "POST",
      url: '../api/doctor/login.php',
      dataType: 'json',
      data: {
        id: $("#id").val(),
        mail: $("#name").val(),
        password: $("#password").val()
      },
      error: function(result) {
        alert(result.responseText);
      },
      success: function(result) {
        if (result['status'] == true) {
          alert(result['message']);
          window.location.href = '/patient';
        } else {
          alert(result['message']);
        }
      }
    });

  }
</script>