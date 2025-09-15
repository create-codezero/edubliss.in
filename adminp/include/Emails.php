<?php
session_start();
$_SESSION['adminDPage'] = "Emails";
?>

<div class="flex e-c w-100per flex-d-column" style="min-height: 75vh;">
     <div class="m-y-20">
          <h1 class="fs-40 tx-center font-poppins">Emails</h1>
     </div>
     <div class="flex flex-d-column e-c" style="max-width: 600px; width:95%;">
          <div class="control-bar flex tx-left w-100per">
               <div class="flex e-c bg-clr-4 m-10 border-radius-100per pos-relative" style="width: 45px; height:45px;">
                    <a href="javascript:void(0)" onclick="loadContent('NewEmail')" class="pos-absolute">
                         <p class="fs-20 p-10"><i class="fa fa-plus" aria-hidden="true"></i></p>
                    </a>
               </div>
          </div>
          <?php
          require_once '../../connect/connectDb/config.php';

          $gettingAllEmails = "SELECT * FROM `78000_emails` ORDER BY `emailId` DESC";
          $firegettingAllEmails = mysqli_query($link, $gettingAllEmails);

          if (mysqli_num_rows($firegettingAllEmails) > 0) {
               while ($emailDetails = mysqli_fetch_assoc($firegettingAllEmails)) {
          ?>
                    <div class="testimonial-control-card font-poppins e-c bg-clr-4 flex tx-left p-y-30 w-100per m-y-10" style="border-radius: 10px;" id="<?php echo $emailDetails['emailId']; ?>">
                         <div class="flex flex-d-coloumn" style="justify-content:space-between; align-items:center; width:90%;">
                              <div class="flex flex-d-column">
                                   <p class="fs-20 fw-600"><?php echo $emailDetails['emailName']; ?></p>
                                   <div>
                                        <?php echo $emailDetails['emailContent']; ?>
                                   </div>

                                   <p class="m-t-10"><?php echo $emailDetails['addedOn']; ?></p>
                              </div>

                              <div class="flex flex-d-column cursor-pointer m-10">
                                   <a href="javascript:void()" onclick="loadMail('<?php echo $emailDetails['emailId']; ?>')">
                                        <p class="fs-30"> <i class="fas fa-share"></i> </p>
                                   </a>

                                   <a href="javascript:void()" onclick="editLoad('Edit-Email','<?php echo $emailDetails['emailId']; ?>')">
                                        <p class="fs-30"> <i class="fas fa-edit m-t-10"></i> </p>
                                   </a>
                              </div>
                         </div>
                    </div>
          <?php
               }
          } else {
               echo "No Emails Available to show.";
          }
          ?>



     </div>
</div>