<?php
session_start();
$_SESSION['adminDPage'] = "Assignment";
require_once '../../connect/connectDb/config.php';

if(!isset($_GET['course'])){
    header("location: ./");
}

?>

<div class="flex e-c w-100per flex-d-column" style="min-height: 75vh;">
     <div class="m-y-20">
          <h1 class="fs-40 tx-center font-poppins">Course Levels</h1>
     </div>
     <div class="flex flex-d-column e-c" style="max-width: 600px; width:95%;">
          <div class="control-bar flex tx-left w-100per">
               <div class="flex e-c bg-clr-4 m-10 border-radius-100per pos-relative" style="width: 45px; height:45px;">
                    <a href="javascript:void(0)" onclick="loadContentWithParameter('Add-Material-Level','<?php echo $_GET['course']; ?>')" class="pos-absolute">
                         <p class="fs-20 p-10"><i class="fa fa-plus" aria-hidden="true"></i></p>
                    </a>
               </div>
          </div>
          <?php
          
          $materialCourseId = $_GET['course'];

          $gettingAllLevels = "SELECT * FROM `78000_levels` WHERE `levelCourse` = '$materialCourseId' ORDER BY `levelId` DESC";
          $firegettingAllLevels = mysqli_query($link, $gettingAllLevels);

          if (mysqli_num_rows($firegettingAllLevels) > 0) {
               while ($levelDetails = mysqli_fetch_assoc($firegettingAllLevels)) {
          ?>
                    <div class="testimonial-control-card font-poppins e-c bg-clr-4 flex tx-left p-y-30 w-100per m-y-10" style="border-radius: 10px;" id="<?php echo $levelDetails['aSubjectId']; ?>">
                         <div class="flex flex-d-coloumn" style="justify-content:space-between; align-items:center; width:90%;">
                              <div class="flex flex-d-column">
                                   <p class="fs-20 fw-600"><?php echo $levelDetails['aSubject']; ?></p>
                                   <div>
                                        <?php echo $levelDetails['aSubjectTopics']; ?>
                                   </div>

                                   <br>

                                   <div>
                                        <?php echo 'Total Questions: ' . $levelDetails['totalQuestions']; ?>
                                   </div>

                                   <p class="m-t-10" style="border:1px solid black; width:max-content; padding:5px; margin:5px 0;" onClick="changeStatus('Subject','<?php echo $levelDetails['aSubjectId']; ?>','<?php echo $levelDetails['aSubjectStatus']; ?>')" id="Subject<?php echo $levelDetails['aSubjectId']; ?>"><?php echo $levelDetails['aSubjectStatus']; ?></p>

                                   <div class="flex flex-row e-c w-100per m-t-20 p-10" style="background-color:var(--clr-2); border-radius:10px;">
                                        <div>
                                        <p class="fs-15 fw-500" style="margin-left: 2px;">Add Multiple Question</p>
                                        <select name="noOfQuestions" id="noOfQuestions">
                                             <option value="2">2</option>
                                             <option value="3">3</option>
                                             <option value="4">4</option>
                                             <option value="5">5</option>
                                             <option value="6">6</option>
                                             <option value="7">7</option>
                                             <option value="8">8</option>
                                             <option value="9">9</option>
                                             <option value="10">10</option>
                                             <option value="11">11</option>
                                             <option value="12">12</option>
                                             <option value="13">13</option>
                                             <option value="14">14</option>
                                             <option value="15">15</option>
                                        </select>
                                        </div>
                                        <div class="flex flex-d-column cursor-pointer m-l-30 border-radius-100per">
                                             <a href="javascript:void()" onclick="loadContentWithParameter4('Add-Multiple-Question','<?php echo $levelDetails['materialCourseId']; ?>', '<?php echo $levelDetails['aSubjectId']; ?>')">
                                                  <p class="fs-30"><i class="fa fa-plus" aria-hidden="true"></i></p>
                                             </a>

                                        </div>
                                   </div>

                                   
                              </div>

                              <div class="flex flex-d-column cursor-pointer m-10">
                                   <!-- <a href="javascript:void()" onclick="loadContentWithParameter2('Add-Question','<?php echo $levelDetails['materialCourseId']; ?>', '<?php echo $levelDetails['aSubjectId']; ?>')">
                                        <p class="fs-30"><i class="fa fa-plus" aria-hidden="true"></i></p>
                                   </a> -->

                              </div>
                         </div>
                    </div>
          <?php
               }
          } else {
               echo "No Assignments Available to show.";
          }
          ?>



     </div>
</div>