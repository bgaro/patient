<?php
$dashboard = "Patient";
$content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Add Patient</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="exampleInputName1">Name</label>
                          <input type="text" class="form-control" id="name" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Phone</label>
                          <input type="text" class="form-control" id="phone" placeholder="Enter phone">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Doctor id</label>
                          <input type="text" class="form-control" id="doctor_id" placeholder="Doctor Id">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Nurse id</label>
                          <input type="text" class="form-control" id="nurse_id" placeholder="Nurse Id">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Gender</label>
                            <div class="radio">
                                <label>
                                <input type="radio" name="gender" id="optionsRadios1" value="0" >
                                Male
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                <input type="radio" name="gender" id="optionsRadios2" value="1" checked="">
                                Female
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Health Condition</label>
                          <input type="text" class="form-control" id="health_condition" placeholder="Health Condition">
                        </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="AddPatient()" value="Submit"></input>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->
                </div>
              </div>';
include('../master.php');
?>
<script>
  function AddPatient() {

    $.ajax({
      type: "POST",
      url: '../api/patient/create.php',
      dataType: 'json',
      data: {
        name: $("#name").val(),
        phone: $("#phone").val(),
        doctor_id: $("#doctor_id").val(),
        nurse_id: $("#nurse_id").val(),
        gender: $("input[name='gender']:checked").val(),
        health_condition: $("#health_condition").val()
      },
      error: function(result) {
        alert(result.responseText);
      },
      success: function(result) {
        if (result['status'] == true) {
          alert("Successfully Added New Patient!");
          window.location.href = '/doctor';
        } else {
          alert(result['message']);
        }
      }
    });
  }
</script>