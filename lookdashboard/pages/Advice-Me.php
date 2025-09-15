<?php
session_start();
require_once "../../connect/connectDb/config.php";
$_SESSION['path'] = "Advice-Me";
$_SESSION['sendingFrom'] = "dashboard";

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
<div class="sector h-100per flex e-c p-y-30 flex-d-column">



     <div class="box e-c min-h-500">
          <img src="../media/Images/Advice-Me.png" alt="Initial push -- grow on youtube through google ads with yas tiwari" class="img-fluid" style="border-radius: 10px 10px 0 0;">


          <div class="w-100per m-40 mob-m-30" style="word-wrap: break-word; max-width:90% !important;">
               <h1 class="fc-dark-blue heading">Advice Me Services</h1>
               <br>
               <p class="sub-heading fc-secondary font-poppins m-t-20">This Service will give you:</p>
               <p class="fc-dark-blue font-poppins fs-20 m-y-10 fw-500"><samp style="font-size: 18px;"><i class="fas fa-check" style="color: #00c056;"></i></samp> 1 One-to-One Zoom meeting with Yas Tiwari. </p>
               <p class="fc-dark-blue font-poppins fs-20 m-y-10 fw-500"><samp style="font-size: 18px;"><i class="fas fa-check" style="color: #00c056;"></i></samp> Social Media Growth , Digital Marketing & Branding. </p>
               <p class="fc-dark-blue font-poppins fs-20 m-y-10 fw-500"><samp style="font-size: 18px;"><i class="fas fa-check" style="color: #00c056;"></i></samp> Content Strategies. </p>
               <p class="fc-dark-blue font-poppins fs-20 m-y-10 fw-500"><samp style="font-size: 18px;"><i class="fas fa-check" style="color: #00c056;"></i></samp> Solution of your any Problem related to Youtube or Digital Marketing. </p>

               <p class="fc-dark-blue fs-15 fw-500 font-poppins"><samp style="color: red;">NOTE </samp>: PROVIDING SOLUTION DOES NOT MEANS WE WILL SOLVE YOUR PROBLEM. WE'LL TELL YOU HOW TO SOLVE THAT PROBLEM. </p>

               <div class="flex flex-y-center m-t-20">
                    <P class="fc-dark-blue fw-500" style="margin: 0 10px;">₹149.00</P>
               </div>
               <div class="flex flex-y-center m-t-20">
                    <a href="javascript:void(0)" onclick="displaythis('#','payment-details')" class="btn btn-gra-blue">Buy Now!</a>
                    <a href="https://www.instagram.com/itsyastiwari/" onclick="notAvailable()" class="btn btn-gra-red m-x-10" target="_blank">More Info</a>
               </div>
          </div>
     </div>



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

          <div class="flex e-c">

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

<!-- payment details pop up  -->

<div class="sector z-2 pos-fixed flex e-c flex-d-column h-100vh none" id="payment-details" style="top: 0; left:0; background-color: var(--shadow-clr);">


     <div class="form-box  bg-clr-1 pop-up-box">
          <div class="main-box">
               <div class="block tx-right w-100per" onclick="displaythis('#','payment-details')">
                    <i class="fa fa-times fc-dark-blue fs-20 cursor-pointer hover-fc-primary" aria-hidden="true" style="padding: 15px 20px;"></i>
                    <hr class="bg-dark-blue">
               </div>
               <form class="m-t-20" method="POST" action="../Payment/">
                    <p class="fs-20 tx-center" id="mailsentmsg">Enter your details</p>

                    <p class="fs-15 fw-500 mailsenthideit" style="margin-top: 20px; margin-left: 2px;">Name</p>
                    <div class="input">
                         <input type="text" name="Name" id="Name" placeholder="Full Name" class="" required>
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">E-mail</p>
                    <div class="input">
                         <input type="Email" name="Email" id="Email" placeholder="E-mail" class="" required>
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Phone</p>
                    <div class="input">
                         <input type="number" maxlength="10" min="10" name="PhoneNum" id="PhoneNum" placeholder="Phone Number" class="" required>
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Instagram</p>
                    <div class="input">
                         <input type="text" maxlength="10" min="10" name="Instagram" id="Instagram" placeholder="Instagram Username" class="" required>
                    </div>

                    <p class="fs-10 tx-center m-t-10 mailsenthideit"> Enter your details and click submit. </p>


                    <button class="btn btn-gra-purple cursor-pointer mailsenthideit" style="margin: 20px auto 10px;" id="remindMe" type="submit" name="payment">Submit</button>
               </form>
          </div>
     </div>

</div>

<!-- payment details pop up -->