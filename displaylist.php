<?php

global $wpdb;
$tablename = $wpdb->prefix."customplugin";

// Delete record
if(isset($_GET['delid'])){
  $delid = $_GET['delid'];
  $wpdb->query("DELETE FROM ".$tablename." WHERE id=".$delid);
}
?>
<h1>All Entries</h1>

<table width='100%' border='1' style='border-collapse: collapse;'>
  <tr>
   <th>S.no</th>
   
   <th>Username</th>
   <th>Password</th>
   <th>Security Question</th>
   <th>Security Answer</th>
   <th>&nbsp;</th>
  </tr>
  <?php
  // Select records
  $entriesList = $wpdb->get_results("SELECT * FROM ".$tablename." order by id desc");
  if(count($entriesList) > 0){
    $count = 1;
    foreach($entriesList as $entry){
      $id = $entry->id;
      $uname = $entry->username;
      $password = $entry->password;
      $user_proof = $entry->user_proof;
        $user_proof_ans = $entry->user_proof_ans;

      echo "<tr>
      <td>".$count."</td>
      <td>".$uname."</td>
      <td>".$password."</td>
      <td>".$user_proof."</td>
      <td>".$user_proof_ans."</td>
      <td><a href='?page=allentries&delid=".$id."'>Delete</a></td>
      </tr>
      ";
      $count++;
   }
 }else{
   echo "<tr><td colspan='5'>No record found</td></tr>";
 }
?>
</table>