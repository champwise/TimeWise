<?php
	// Set page title in header.php
$pageTitle = "planner";

    // Prepend header.php to page
include_once "common/header.php";

    // redirect user back to login page if not logged in
if(!isset($_SESSION['loggedin']) && !isset($_SESSION['username']) && $_SESSION['loggedin']!=1){

  echo "<script> window.location = \"login.php\"; </script>";
}

?>
<!-- javascript file for planner -->
<script type="text/javascript" src="scripts/javascript/planner.js"></script>

<!-- Popup form for adding quarter tasks -->
<div class="modal fade " id="quarterModal" role="dialog">
 <div class="modal-dialog ">
  <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4>Add quarter task</h4>
   </div>
   <div class="modal-body">
     <form id = "quarterTaskForm" action="scripts/php/createtask.php" method="POST" >
      <div class="form-group">
        <label ><b>Create quarter task</b></label>
        <textarea id="quarterText" class="form-control" rows="4" cols="50" name="task_text" form="quarterTaskForm" 
        placeholder="Enter text here..."></textarea>
        <input name = "list_name" style="display: none" id="quarter_list" >
      </div>
      <input type="submit" class="btn btn-primary" value="Create">
    </form>
  </div>
</div>
</div>
</div>

<!-- Popup form for adding week tasks -->
<div class="modal fade " id="weekModal" role="dialog">
 <div class="modal-dialog ">
  <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4>Add week task</h4>
   </div>
   <div class="modal-body">
     <form id = "weekTaskForm" action="scripts/php/createtask.php" method="POST" >
      <div class="form-group">
        <label ><b>Create week task</b></label>
        <textarea id="weekText" class="form-control" rows="4" cols="50" name="task_text" form="weekTaskForm" 
        placeholder="Enter text here..."></textarea>
        <input  name = "list_name" style="display: none" id="week_list">
      </div>
      <input type="submit" class="btn btn-primary" value="Create">
    </form>
  </div>
</div>
</div>
</div>

<!-- Popup form for adding day tasks -->
<div class="modal fade " id="dayModal" role="dialog">
 <div class="modal-dialog ">
  <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4>	Add day task</h4>
   </div>
   <div class="modal-body">
     <form id = "dayTaskForm" action="scripts/php/createtask.php" method="POST" >
      <div class="form-group">
        <label ><b>Create day task</b></label>
        <textarea id="dayText" class="form-control" rows="4" cols="50" name="task_text" form="dayTaskForm" 
        placeholder="Enter text here..."></textarea>
        <input  name = "list_name" style="display: none" id="day_list">
      </div>
      <input type="submit" class="btn btn-primary" value="Create">
    </form>
  </div>
</div>
</div>
</div>

<!-- Popup form for editing tasks -->
<div class="modal fade " id="editModal" role="dialog">
 <div class="modal-dialog ">
  <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4>Edit task</h4>
   </div>
   <div class="modal-body">
     <form id = "editTaskForm" action="scripts/php/edittask.php" method="GET" >
      <div class="form-group">
        <textarea id="edittext" class="form-control" rows="4" cols="50" name="edited" form="editTaskForm"></textarea>
        <input name = "list_name" style="display: none" id="editlist" >
        <input name = "task_text" style="display: none" id="task_text" >
      </div>
      <input type="submit" class="btn btn-primary" value="Edit">
    </form>
  </div>
</div>
</div>
</div>



  <div class="container">
    <!-- div for datepicker widget -->

    <div id ="datepicker-wrapper"class="col-xs-12 col-md-4 col-md-offset-4">    
      <div id="datepicker-container">
        <div id="datepicker-center">
          <div id="datepicker"></div>
        </div>
      </div>
    </div>
    <!-- <div id ="datepicker" class="col-xs-12 col-md-4 col-md-offset-4"></div> -->
  </div>

 <div class="container">

  <!-- Quarter panel -->
  <div class="col-xs-12 col-md-4 well" style="background-color: #ddd;">
   <div class="panel panel-default">
    <div class="panel-heading" id="quarter-heading"></div>
    <div class="panel-body" id="quarter-content">
    </div>
    <div class="panel-footer">
     <button type="button"  data-toggle="modal" data-target="#quarterModal" style="color: green;">&#43;</button>
   </div>
 </div>
</div>

<!-- week panel -->
<div class="col-xs-12 col-md-4 well" style="background-color: #eee;">
 <div class="panel panel-default">
  <div class="panel-heading" id="week-heading"></div>
  <div class="panel-body" id="week-content">
  </div>
  <div class="panel-footer">
   <button type="button"  data-toggle="modal" data-target="#weekModal" style="color: green;">&#43;</button>
 </div>
</div>
</div>

<!-- day panel -->
<div class="col-xs-12 col-md-4 well " style="background-color: #ddd;">
 <div class="panel panel-default">
  <div class="panel-heading" id="day-heading"></div>
  <div class="panel-body" id="day-content">
  </div>
  <div class="panel-footer">
   <button type="button"  data-toggle="modal" data-target="#dayModal" style="color: green;">&#43;</button>
 </div>
</div>
</div>

</div>

<?php 

    // Append footer to page
include_once "common/footer.php"; 
?>