<?php
session_start();
require_once '../../connect/connectDb/config.php';
$_SESSION['adminDPage'] = "Add-Question";

if(!isset($_GET['assignment']) or !isset($_GET['subject'])){
    header("location: ./");
}

$subjectId = $_GET['subject'];
$assignmentId = $_GET['assignment'];

$subjectName = "";
$assignmentName = "";

$qAssignmentName = "SELECT * FROM `78000_a_week` WHERE `aWeekId` = '$assignmentId'";
$fireQAssignmentName = mysqli_query($link, $qAssignmentName);

if(mysqli_num_rows($fireQAssignmentName) > 0){
    while($v1 = mysqli_fetch_assoc($fireQAssignmentName)){
        $assignmentName = $v1['aWeek'];
    }
 }

$qSubjectName = "SELECT * FROM `78000_a_subjects` WHERE `aSubjectId` = '$subjectId'";
$fireQSubjectName = mysqli_query($link, $qSubjectName);

if(mysqli_num_rows($fireQSubjectName) > 0){
    while($v2 = mysqli_fetch_assoc($fireQSubjectName)){
        $subjectName = $v2['aSubject'];
    }
 }



?>
<div class="flex e-c">

     <div class="form-box">
          <div class="main-box">
               <h1 class="fs-40 tx-center">Question Details</h1>

               <form action="./actions/addQuestion.php" class="e-center" method="POST" enctype="multipart/form-data">

                    <div onclick="triggerClick('questionss')">
                        <img src="../data/questions/ques/questionss.png" class="img-fluid" alt="question ss" id="displayQuestionSS">
                    </div>

                    <div class="input" style="border:none;">
                              <input type="file" name="questionss" style="display:none;" id="questionss" onchange="displayImage(this)">
                         </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Question</p>
                    <div class="input">
                         <textarea name="question" id="question" cols="30" rows="10"></textarea>
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Question Tag</p>
                    <div class="input">
                         <textarea name="questionTag" id="questionTag" cols="30" rows="10"></textarea>
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Topics</p>
                    <div class="input">
                         <input type="text" id="Topics" name="topics" required>
                    </div>

                    <input type="text" name="assignment" value="<?php echo $_GET['assignment']; ?>" style="display:none;">
                    <input type="text" name="subject" value="<?php echo $_GET['subject']; ?>" style="display:none;">

                    <input type="text" name="assignmentName" value="<?php echo $assignmentName; ?>" style="display:none;">
                    <input type="text" name="subjectName" value="<?php echo $subjectName; ?>" style="display:none;">

                    <p style="font-size: 12px; font-weight: 500;" class="m-y-20 tx-center">This Assignment will Available for All User.</p>

                    <button class="btn btn-gra-purple m-auto" type="submit" name="Upload_Question">Upload</button>
               </form>


          </div>
     </div>

</div><script>
     function displayImage(e) {
          if (e.files[0]) {
               var reader = new FileReader();
               reader.onload = function(e) {
                    document.querySelector('#displayQuestionSS').setAttribute('src', e.target.result);
                    // document.querySelector('#upload-channelLogo-icon').setAttribute('class', "fa fa-camera fs-30 p-y-40 videoInputThumbnailFile none");
                    document.querySelector('#displayQuestionSS').setAttribute('class', "img-fluid");

               }
               reader.readAsDataURL(e.files[0]);
          }
     }
</script>