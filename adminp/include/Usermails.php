<?php
session_start();
$_SESSION['adminDPage'] = "Users";
?>

<div class="flex e-c w-100per flex-d-column" style="min-height: 75vh;">
     <div class="m-y-20">
          <h1 class="fs-40 tx-center font-poppins">Users</h1>
     </div>
     <div class="flex flex-d-column e-c" style="max-width: 600px; width:95%;">
          <?php
          require_once '../../connect/connectDb/config.php';

          $gettingAllUsers = "SELECT * FROM `78000_user`";
          $firegettingAllUsers = mysqli_query($link, $gettingAllUsers);

          if (mysqli_num_rows($firegettingAllUsers) > 0) {
               while ($userDetails = mysqli_fetch_assoc($firegettingAllUsers)) {

                echo '<pre style="text-align: left; margin:0; white-space: pre-wrap; white-space: -moz-pre-wrap; white-space: -pre-wrap white-space: -o-pre-wrap; word-wrap: break-word;"><p class="fc-dark-blue font-poppins" style="font-size: 15px;">';

                if($userDetails['userId']%10 != 0){
                    echo $userDetails['userEmail'] . ",";
                }else{
                    echo "<br><br>".$userDetails['userEmail'] . ",";
                }

                echo "</p></pre>";
                
               }
          } else {
               echo "No Projects Available to show.";
          }
          ?>



     </div>
</div>