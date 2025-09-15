<?php
session_start();
require_once "../../connect/connectDb/config.php";
$_SESSION['path'] = "My-Services";
?>

<!-- My services -->

<div class="flex e-c">
     <div class="p-y-30">
          <h1 class="tx-center">Your Services</h1>

          <?php

          $userUniqueCode = $_SESSION['userUniqueCode'];
          $servicesCheckQuery = "SELECT * from `78000_my_service` WHERE userUniqueCode = '$userUniqueCode'";



          $fireServicesCheckQuery = mysqli_query($link, $servicesCheckQuery);

          if (mysqli_num_rows($fireServicesCheckQuery) > 0) {
               while ($serviceDetails = mysqli_fetch_assoc($fireServicesCheckQuery)) {
          ?>
                    <div class="box flex e-c m-auto">
                         <div class="w-100per m-40 mob-m-30" style="word-wrap: break-word;">
                              <h1 class="fc-dark-blue heading"><?php echo $serviceDetails['serviceName']; ?></h1>
                              <br>
                              <p class="sub-heading fc-secondary font-poppins m-t-20"> <?php echo $serviceDetails['serviceShortDesc']; ?></p>

                              <?php
                              $orderId = $serviceDetails['orderId'];
                              $servicesProgressCheckQuery = "SELECT * from `78000_service_progress` WHERE orderId = '$orderId' ORDER BY srNo DESC";

                              $fireServicesProgressCheckQuery = mysqli_query($link, $servicesProgressCheckQuery);

                              if (mysqli_num_rows($fireServicesProgressCheckQuery) > 0) {
                                   while ($serviceProgressDetails = mysqli_fetch_assoc($fireServicesProgressCheckQuery)) {
                              ?>

                                        <p class="fc-dark-blue font-poppins fs-20 m-y-10 fw-500"><samp style="font-size: 18px;"><i class="fa-solid fa-square-check" style="color: #00c056;"></i></samp> <?php echo $serviceProgressDetails['doneMessage']; ?> </p>

                              <?php
                                   }
                              }
                              ?>

                              <div class="flex flex-y-center m-t-20">
                                   <a href="mailto:services.yastiwari@gmail.com" class="btn btn-gra-blue">Mail us</a>
                                   <a href="https://www.instagram.com/itsyastiwari" class="btn btn-gra-red m-x-10">More Info</a>
                              </div>

                              <div class=" m-t-20" style="width:<?php echo $serviceDetails['progressPercent']; ?>%; height: 10px; background: linear-gradient(135deg, #00a2ff, #00ffae);"></div>

                         </div>
                    </div>
                    <div class="m-y-20"></div>
          <?php
               }
          } else {
               echo '<h3 class="tx-center fc-dark-blue heading">You don' . "'" . 't have any Services.</h3>';
          }


          ?>


     </div>
</div>