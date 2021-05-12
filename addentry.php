<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php

global $wpdb;

// Add record
if(isset($_POST['but_submit']) && $_POST['g-recaptcha-response']!=""){
 $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
  $secret = 'You Site Key';
    $responseData = json_decode($verifyResponse);
    if($responseData->success)
    {
 
  $uname = $_POST['txt_uname'];
   $password = $_POST['password'];
  $user_proof = $_POST['user_proof'];
   $user_proof_ans = $_POST['user_proof_ans'];
  $tablename = $wpdb->prefix."customplugin ";
  

  if($uname != '' && $password != '' && $user_proof != '' && $user_proof_ans != ''){
     $check_data = $wpdb->get_results("SELECT * FROM ".$tablename." WHERE username='".$uname."' ");
     if(count($check_data) == 0){
       $insert_sql = "INSERT INTO ".$tablename."(username,password,user_proof,user_proof_ans) values('".$uname."','".$password."','".$user_proof."','".$user_proof_ans."') ";
       $wpdb->query($insert_sql);
       echo "Save sucessfully.";
     }
   }
}
}

?>
<h1>Add New Entry</h1>
<form method='post' action=''>
  <table>
   <tr>
     <td>Username</td>
     <td><input type='text' name='txt_uname'></td>
    </tr>
    <tr>
      <td>Passwrd</td>
      <td><input type='text' name='password'></td>
    </tr>
   
    <tr>
    <td><?php _e('What is the name of Father ?') ?></td>
		<td><input type="text" name="user_proof" id="user_proof" class="input" size="25" tabindex="20" /></td>
    </tr>
     <tr>
    <td><?php _e('You Security Answer ') ?></td>
		<td><input type="text" name="user_proof_ans" id="user_proof_ans" class="input" size="25" tabindex="20" /></td>
    </tr>
    <tr>
    <td></td>
     <td class="g-recaptcha" data-sitekey="Your Site Key"></td>
     
    <tr>
    
     <td>&nbsp;</td>
     <td><input type='submit' name='but_submit' value='Submit'></td>
    </tr>
 </table>
</form>