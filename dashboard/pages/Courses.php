<?php
session_start();
require_once "../../connect/connectDb/config.php";
$_SESSION['path'] = "Courses";
?>

<!-- ads -->
<?php
$substracted = "false";
$visitCounted = 0;
$rawCount = count($_SESSION['visited']);
$thisPage = $rawCount + 1;

if (!isset($_SESSION['noAds'])) {

     if ($thisPage  > $_SESSION['numberofAds']) {
          while ($thisPage  > $_SESSION['numberofAds']) {
               $thisPage  = $thisPage  - 1;
               $substracted = "true";
          }
     }

     if ($substracted == "true") {
          $lastPage = $_SESSION['visited'][$rawCount - 1];
          while ($thisPage == $lastPage) {
               $thisPage = rand(1, $_SESSION['numberofAds']);
          }
     }

     if ($thisPage  <= $_SESSION['numberofAds']) {
          // COUNTING VISIT
          if ($visitCounted == 0) {
               array_push($_SESSION['visited'], $thisPage);
          }
          $currentAds = $thisPage;
          $exactAds = 'Ads' . $currentAds;
?>

          <div class="flex e-c m-t-20">

               <div class="box flex p-y-20 flex-y-center m-20 mob-flex-column overflow-hidden pos-relative" style="justify-content: space-between;" id="ad-preview">
                    <span class="pos-absolute fc-primary fw-700 fs-10" style="background-color: #ffff00; padding: 2px 5px; border-radius: 0 0 3px 0; top: 0; left: 0;">Ad</span>
                    <div class="flex flex-y-center">
                         <div class="ad-logo m-x-20 flex e-c" style="max-width: 50px;">
                              <img src="../data/user/channellogo/<?php echo $_SESSION[$exactAds][3]; ?>" alt="<?php echo $_SESSION[$exactAds][1]; ?> logo" class="img-fluid border-radius-100per">
                         </div>
                         <div class="ad-content m-r-10">
                              <p class="fc-dark-blue fs-20 fw-600"><?php echo $_SESSION[$exactAds][1]; ?></p>
                              <p class="fc-primary fw-500">Categories : <?php echo $_SESSION[$exactAds][5]; ?></p>
                              <p class="fc-dark-blue fs-10"><?php echo $_SESSION[$exactAds][4]; ?></p>
                         </div>
                    </div>

                    <div class="ad-call-to-action mob-m-t-10 mob-w-100per mob-m-x-10 m-r-20">
                         <a href="<?php echo $_SESSION[$exactAds][2]; ?>" target="_blank" class="ad-btn bg-clr-1 fc-dark-blue m-auto" style="border: 1px solid var(--clr-5);" onclick="adClicked('<?php echo $_SESSION[$exactAds][0]; ?>','<?php echo $currentAds; ?>','<?php echo $_SESSION['userUniqueCode']; ?>')">Visit</a>
                    </div>
               </div>

          </div>

<?php
     }
}

// ADS QUERIES DONE

?>


<div class="sector h-100vh flex-d-column flex e-c bg-clr-1">

     <img src="../media/Illustrations/under_construction.svg" alt="404 Error" style="max-width: 600px; width: 90%;">

     <p class="fc-light-dark-blue fw-800 fs-20 tx-center ls-10 m-y-20 mob-fs-40">Under Construction</p>

     <a href="javascript:void(0)" class="ad-btn bg-primary fc-white" onclick="clickOn('side-menu')">Explore Other!</a>

</div>

<!-- ads -->
<?php

if (!isset($_SESSION['noAds'])) {

     while ($thisPage  > $_SESSION['numberofAds']) {
          $thisPage  = $thisPage  - 1;
     }

     if ($thisPage  <= $_SESSION['numberofAds']) {
          if ($thisPage == $_SESSION['numberofAds']) {
               $currentAds = $thisPage  - 1;
          } else {
               $currentAds = $thisPage  + 1;
          }
          $exactAds = 'Ads' . $currentAds;
?>

          <div class="flex e-c m-t-20">

               <div class="box flex p-y-20 flex-y-center m-20 mob-flex-column overflow-hidden pos-relative" style="justify-content: space-between;" id="ad-preview">
                    <span class="pos-absolute fc-primary fw-700 fs-10" style="background-color: #ffff00; padding: 2px 5px; border-radius: 0 0 3px 0; top: 0; left: 0;">Ad</span>
                    <div class="flex flex-y-center">
                         <div class="ad-logo m-x-20 flex e-c" style="max-width: 50px;">
                              <img src="../data/user/channellogo/<?php echo $_SESSION[$exactAds][3]; ?>" alt="<?php echo $_SESSION[$exactAds][1]; ?> logo" class="img-fluid border-radius-100per">
                         </div>
                         <div class="ad-content m-r-10">
                              <p class="fc-dark-blue fs-20 fw-600"><?php echo $_SESSION[$exactAds][1]; ?></p>
                              <p class="fc-primary fw-500">Categories : <?php echo $_SESSION[$exactAds][5]; ?></p>
                              <p class="fc-dark-blue fs-10"><?php echo $_SESSION[$exactAds][4]; ?></p>
                         </div>
                    </div>

                    <div class="ad-call-to-action mob-m-t-10 mob-w-100per mob-m-x-10 m-r-20">
                         <a href="<?php echo $_SESSION[$exactAds][2]; ?>" target="_blank" class="ad-btn bg-clr-1 fc-dark-blue m-auto" style="border: 1px solid var(--clr-5);" onclick="adClicked('<?php echo $_SESSION[$exactAds][0]; ?>','<?php echo $currentAds; ?>','<?php echo $_SESSION['userUniqueCode']; ?>')">Visit</a>
                    </div>
               </div>

          </div>

<?php
     }
}


// ADS QUERIES DONE

?>