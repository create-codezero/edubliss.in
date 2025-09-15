<?php
session_start();
require_once '../../connect/connectDb/config.php';
$_SESSION['path'] = "Your-Questions";


?>
<div class="flex e-c">

     <div class="form-box">
          <div class="main-box">
               <h1 class="fs-40 tx-center">Question Details</h1>

               <form method="POST" enctype="multipart/form-data">
                    
                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-bottom:5px; margin-left: 2px;">Question Screenshot</p>
                    <div onclick="triggerClick('questionss')">
                        <img src="../data/questions/ques/questionss.png" class="img-fluid" alt="question ss" id="displayQuestionSS">
                    </div>

                    <div class="input" style="border:none;">
                              <input type="file" name="questionss" style="display:none;" id="questionss" onchange="displayImage(this)" required>
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Question</p>
                    <div class="input">
                         <textarea name="question" id="question" cols="30" rows="10"></textarea>
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Question Tag(Question About)</p>
                    <div class="input">
                         <textarea name="questionTag" id="questionTag" cols="30" rows="10"></textarea>
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Topic</p>
                    <div class="input">
                         <input type="text" id="Topics" name="topics" placeholder="Topic of the Question" required>
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Assignment Name</p>
                    <div class="input">
                        <input type="text" name="assignmentName" placeholder="Assignment Name" required>
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Subject</p>
                    <div class="input">
                        <input type="text" name="subjectName" placeholder="Subject" required>
                    </div>

                    
                    

                    <p style="font-size: 12px; font-weight: 500;" class="m-y-20 tx-center">This Assignment will Available for All User after you will get Solution.</p>

                    <button class="btn btn-gra-purple m-auto" onclick="alertThis('Sign up to use this Feature.')">Submit</button>
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