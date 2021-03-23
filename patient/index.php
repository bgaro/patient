<?php
session_start();

if (!isset($_SESSION['name'])) {
  $_SESSION['msg'] = "You must log in first";
  $host = $_SERVER['HTTP_HOST'];
  $host = "http://" . $host . "/doctor/doc_login.php";
  header('location: ' . $host);
}

if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['name']);
  header("location: doc_login.php");
}
$dashboard = "Patient";
$content = '<div class="row">
  <div class="col-xs-12">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Dostors List</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="doctors" class="table table-bordered table-hover">
        <thead>
        <tr>
          <th>Name</th>
          <th>Phone</th>
          <th>Gender</th>
          <th>Health Condition</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>
</div>';
include('../master.php');
?>
<!-- page script -->
<script>
  // JQuery: AJAX : Appel Asynchrone
  $(document).ready(function() {
    $.ajax({
      type: "GET",
      url: "../api/patient/read.php",
      dataType: 'json',
      success: function(data) {
        var response = "";
        for (var user in data) {
          response += "<tr>" +
            "<td>" + data[user].name + "</td>" +
            "<td>" + data[user].phone + "</td>" +
            "<td>" + ((data[user].gender == 0) ? "Male" : "Female") + "</td>" +
            "<td>" + data[user].health_condition + "</td>"
          "</tr>";
        }
        $(response).appendTo($("#doctors")); //JQuery
      }
    });
  });

  function Remove(id) {
    var result = confirm("Are you sure you want to Delete the Doctor Record?");
    if (result == true) {
      $.ajax({
        type: "POST",
        url: '../api/doctor/delete.php',
        dataType: 'json',
        data: {
          id: id
        },
        error: function(result) {
          alert(result.responseText);
        },
        success: function(result) {
          if (result['status'] == true) {
            alert("Successfully Removed Doctor!");
            window.location.href = '/doctor';
          } else {
            alert(result['message']);
          }
        }
      });
    }
  }
</script>