<?php
session_start();
require_once "../../connect/connectDb/config.php";
$_SESSION['path'] = "WA-Groups";
?>

<div class="sector flex flex-column e-c m-y-30">

        <div class="flex flex-d-column e-c" style="max-width: 600px; width:95%;">
            <div class="control-bar flex tx-left w-100per">
                <div class="flex e-c bg-clr-4 m-10 border-radius-100per pos-relative" style="width: 45px; height:45px;">
                        <a href="javascript:void(0)" onclick="loadContent('Add-WAGP')" class="pos-absolute">
                            <p class="fs-20 p-10"><i class="fa fa-plus" aria-hidden="true"></i></p>
                        </a>
                </div>
            </div>
        </div>

     <p class="fs-30 tx-center m-10 fw-500 font-poppins">Whatsapp Groups</p>

     <?php

     $check_channel_query = " SELECT * FROM `78000_wagroups` ";
          $check_channel_fire = mysqli_query($link, $check_channel_query);
          $check_channel_count = mysqli_num_rows($check_channel_fire);
          if ($check_channel_count >= 1) {
               while ($channel = mysqli_fetch_assoc($check_channel_fire)) {
          ?>
                    <div class="box flex p-y-20 flex-y-center m-10 mob-flex-column overflow-hidden pos-relative" style="justify-content: space-between; background-color: #abff9e;" id="ad-preview">
                         <!-- <span class="pos-absolute fc-primary fw-700 fs-10" style="background-color: #ffff00; padding: 2px 5px; border-radius: 0 0 3px 0; top: 0; left: 0;">Ad</span> -->
                         <div class="flex flex-y-center">
                              <div class="ad-logo m-x-20 flex e-c" style="max-width: 50px;">
                                   <img src="../data/wagp/logo/<?php echo $channel['wagpLogo'] ?>" alt="Channel-logo" class="img-fluid border-radius-100per">
                              </div>
                              <div class="ad-content m-r-10">
                                   <p class="fc-dark-blue fs-20 fw-600"><?php echo $channel["wagpName"] ?></p>
                                   <p class="fc-dark-blue fs-10"><?php echo $channel["wagpDescription"] ?></p>
                                   
                              </div>

                              
                         </div>

                         <div class="ad-call-to-action mob-m-t-10 mob-w-100per mob-m-x-10 m-r-20">
                              <a href="https://chat.whatsapp.com/<?php echo $channel["wagpLink"] ?>" target="_blank" class="ad-btn bg-light-green fc-dark-blue m-auto" style="border: 2px solid var(--clr-6); font-weight:500;">Join</a>
                         </div>
                    </div>
     <?php
               }
            }else{
                echo "There is no Groups.";
            }

               ?>

</div>
