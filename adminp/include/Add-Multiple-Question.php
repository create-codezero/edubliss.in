<?php
session_start();
require_once '../../connect/connectDb/config.php';
$_SESSION['adminDPage'] = "Add-Question";

if(!isset($_GET['assignment']) or !isset($_GET['subject'])){
    header("location: ./");
}

$subjectId = $_GET['subject'];
$assignmentId = $_GET['assignment'];
$noOfQuestions = $_GET['noOfQuestions'];

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

               <form action="./actions/addMultipleQuestions.php" class="e-center" method="POST" enctype="multipart/form-data">

                <input type="text" name="noOfQuestions" value="<?php echo $noOfQuestions; ?>" style="display:none;">

                    <?php
                    $n = 1;
                    
                    while($n <= $noOfQuestions){

                        ?>
                        

                    <!-- Main Question Part -->

                    <div onclick="triggerClick('questionss<?php echo $n; ?>')">
                        <img src="../data/questions/ques/questionss.png" class="img-fluid" alt="question ss" id="displayQuestionSS<?php echo $n; ?>">
                    </div>

                    <div class="input" style="border:none;">
                              <input type="file" name="questionss<?php echo $n; ?>" style="display:none;" id="questionss<?php echo $n; ?>" onchange="displayImage(this,'displayQuestionSS<?php echo $n; ?>')">
                         </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Question</p>
                    <div class="input">
                         <textarea name="question<?php echo $n; ?>" id="question<?php echo $n; ?>" cols="30" rows="10"></textarea>
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Question Tag</p>
                    <div class="input">
                         <textarea name="questionTag<?php echo $n; ?>" id="questionTag<?php echo $n; ?>" cols="30" rows="10"></textarea>
                    </div>

                    <div class="w-100per m-y-20" style="background-color:var(--dark-blue); height:5px;"></div>

                    <?php
                        $n = $n+1;
                    }
                    
                    ?>

                    <!-- Main Question Part End -->

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Topics</p>
                    <div class="input">
                         <input type="text" id="Topics" name="topics" required>
                    </div>

                    <input type="text" name="assignment" value="<?php echo $_GET['assignment']; ?>" style="display:none;">
                    <input type="text" name="subject" value="<?php echo $_GET['subject']; ?>" style="display:none;">

                    <input type="text" name="assignmentName" value="<?php echo $assignmentName; ?>" style="display:none;">
                    <input type="text" name="subjectName" value="<?php echo $subjectName; ?>" style="display:none;">

                    <p style="font-size: 12px; font-weight: 500;" class="m-y-20 tx-center">This Assignment will Available for All User.</p>

                    <button class="btn btn-gra-purple m-auto" type="submit" name="Upload_Multiple_Questions">Upload</button>
               </form>


          </div>
     </div>

</div><script>
     function displayImage(e,f) {
          if (e.files[0]) {
               var reader = new FileReader();
               reader.onload = function(e) {
                    document.querySelector(`#${f}`).setAttribute('src', e.target.result);
                    document.querySelector(`#${f}`).setAttribute('class', "img-fluid");

               }
               reader.readAsDataURL(e.files[0]);
          }
     }
</script>