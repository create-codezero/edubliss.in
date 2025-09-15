<?php
session_start();
require_once '../../connect/connectDb/config.php';
$_SESSION['adminDPage'] = "Questions";

if(!isset($_GET['quesId'])){
    header("location: ./");
}

$questionId = $_GET['quesId'];

$qquestion = "SELECT * FROM `78000_questions` WHERE `questionId` = '$questionId'";
$fireqquestion = mysqli_query($link, $qquestion);


?>
<div class="flex e-c">

     <div class="form-box">
          <div class="main-box">
               <h1 class="fs-40 tx-center">Question Details</h1>

               <form action="./actions/addAnswer.php" class="e-center" method="POST" enctype="multipart/form-data">

                    <div onclick="triggerClick('answerss')">
                        <img src="../data/questions/ans/answerss.png" class="img-fluid" alt="question ss" id="displayAnswerSS">
                    </div>

                    <div class="input" style="border:none;">
                              <input type="file" name="answerss" style="display:none;" id="answerss" onchange="displayImage(this)">
                         </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Answer</p>
                    <div class="input">
                         <textarea name="answer" id="answer" cols="30" rows="10"></textarea>
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Answer have SS</p>
                    <select name="haveAnsSS">
                         <option value="yes">yes</option>
                         <option value="no">no</option>
                    </select>

                    <input type="text" name="questionId" value="<?php echo $_GET['quesId']; ?>" style="display:none;">

                    <p style="font-size: 12px; font-weight: 500;" class="m-y-20 tx-center">This Answer will Available for All User.</p>

                    <button class="btn btn-gra-purple m-auto" type="submit" name="Upload_Question">Upload</button>
               </form>


          </div>
     </div>

</div><script>
     function displayImage(e) {
          if (e.files[0]) {
               var reader = new FileReader();
               reader.onload = function(e) {
                    document.querySelector('#displayAnswerSS').setAttribute('src', e.target.result);
                    // document.querySelector('#upload-channelLogo-icon').setAttribute('class', "fa fa-camera fs-30 p-y-40 videoInputThumbnailFile none");
                    document.querySelector('#displayAnswerSS').setAttribute('class', "img-fluid");

               }
               reader.readAsDataURL(e.files[0]);
          }
     }
</script>