<?php
session_start();
$_SESSION['adminDPage'] = "EmailProcessing";

if (isset($_SESSION['emailList']) && isset($_SESSION['subject']) && isset($_SESSION['mailContent'])) {

?>

     <div class="flex flex-d-column e-c">

          <div class="progress flex flex-d-column pos-relative m-t-50" style="width: 70%; height:15px; overflow:hidden; background-color:#ffffff; border:2px solid #0080ff;">
               <div id="progressShower" class="progressDone pos-absolute" style="top: 0; left:0; height:15px; background-color:#0080ff;">
               </div>
          </div>
          <div class="flex flex-d-column e-c fs-20 fw-600 m-t-20 m-auto" style="width: 60%;">
               <div class="flex fc-secondary tx-center" id="progressText">Please wait until the process complete ...</div>
          </div>

          <div class="flex flex-d-column e-c fs-30 fw-600 m-auto" style="width: 60%;">
               <div class="flex">Total Targeted Emails : <span class="m-l-10 fw-800" id="totalTargeted"> NaN</span> </div>
               <div class="flex m-t-10">Total Email Sended : <span class="m-l-10 fw-800" id="totalTargeted"> NaN</span> </div>
               <div class="flex m-t-10" title="Email dropped due to invalid email.">Total Email Dropped : <span class="m-l-10 fw-800" id="totalTargeted"> NaN</span> </div>
          </div>

     </div>
 
     <script>
          // let emailList = Array();
          let emailList = Array();
          let emailListJSON = <?php echo $_SESSION['emailList']; ?>;
          emailList =JSON.parse(emailListJSON);
          let emailListCount = <?php echo count(json_decode($_SESSION['emailList'])); ?>;

          let chunk = Math.floor(emailListCount/4);

          // Requiring the lodash module
          // in the script
          let _ = require("lodash");

          console.log("Before: ", emailList);

          let chunkList = _.chunk(emailList, chunk);
          let chunkListLength = chunkList.length;

          // Making chunks of size 3
          console.log("After: ", );


          let screen70Width = (screen.width * 70) / 100;

          let perMailWidthIncrease = screen70Width / chunkListLength;
          let currProgress = 0;


          $(document).ready(function() {
               startSending();
          });

          function startSending() {
               let i = 0;
               while (i < chunkListLength) {
                    $.post('./actions/singleEmailSender.php', {
                         mailto: JSON.stringify(chunkList[i])
                    }, function(data) {
                         if (data == 1) {
                              let nowProgress = currProgress + perMailWidthIncrease;
                              document.getElementById("progressShower").style.width = `${nowProgress}px`;
                              currProgress = nowProgress;
                         } else {
                              alert("Some Error Occured!");
                         }
                    });

                    i++;
               }
          }
     </script>

<?php
} else {
     echo '<p class="fs-30 tx-center m-t-30"> p Please go back and select a Mail before sending it to anyone.</p>';
}
?>