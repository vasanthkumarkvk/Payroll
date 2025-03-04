<?php
include "header.php";
include "db.php"; 

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];

  $original_id = $user_id ;
  $user_id = str_replace('-', '', $user_id);
  $table_name = $user_id . "_salary";

  
}
?>



<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-sm-12">
     
      






      </div>
    </div>
  </div>

  <?php include "footer.php"; ?>
