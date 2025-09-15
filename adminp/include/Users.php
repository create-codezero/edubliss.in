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
          ?>
                    <div class="testimonial-control-card font-poppins e-c bg-clr-4 flex tx-left p-y-30 w-100per m-y-10" style="border-radius: 10px;" id="<?php echo $userDetails['userId']; ?>">
                         <div class="flex flex-d-coloumn" style="justify-content:space-between; align-items:center; width:90%;">
                              <div class="flex flex-d-column">
                                   <p class="fs-20 fw-600"><?php echo $userDetails['userFullName']; ?></p>
                                   <p class="fw-400" style="font-size: 13px;">Email: <?php echo $userDetails['userEmail']; ?></p>
                                   <p class="m-t-10">Username: <?php echo $userDetails['username']; ?></p>
                                   <p class="m-t-10">User Unique Code: <?php echo $userDetails['userUniqueCode']; ?></p>
                              </div>

                              <div class="flex flex-d-column cursor-pointer m-10">
                                   <a href="./actions/delete.php?db=user&id=<?php echo $userDetails['userId']; ?>">
                                        <p class="fs-30"><i class="fa fa-trash" aria-hidden="true"></i></p>
                                   </a>

                                   <a href="mailto:<?php echo $userDetails['userId']; ?>" class="m-t-10">
                                        <p class="fs-30"><i class="fa fa-envelope" aria-hidden="true"></i></p>
                                   </a>

                                   <a href="mailto:<?php echo $userDetails['userId']; ?>" class="m-t-10">
                                        <p class="fs-30"><i class="fa fa-check" aria-hidden="true"></i></p>
                                   </a>
                              </div>
                         </div>
                    </div>
          <?php
               }
          } else {
               echo "No Projects Available to show.";
          }
          ?>



     </div>
</div>