<?php
session_start();
$_SESSION['adminDPage'] = "Assignment";
require_once '../../connect/connectDb/config.php';

?>

<div class="flex e-c w-100per flex-d-column" style="min-height: 75vh;">
     <div class="m-y-20">
          <h1 class="fs-40 tx-center font-poppins">Assignments</h1>
     </div>
     <div class="flex flex-d-column e-c" style="max-width: 600px; width:95%;">
          <div class="control-bar flex tx-left w-100per">
               <div class="flex e-c bg-clr-4 m-10 border-radius-100per pos-relative" style="width: 45px; height:45px;">
                    <a href="javascript:void(0)" onclick="loadContent('Add-Assignment')" class="pos-absolute">
                         <p class="fs-20 p-10"><i class="fa fa-plus" aria-hidden="true"></i></p>
                    </a>
               </div>
          </div>
          <?php
          

          $gettingAllAssignments = "SELECT * FROM `78000_a_week` ORDER BY `aWeekId` DESC";
          $firegettingAllAssignments = mysqli_query($link, $gettingAllAssignments);

          if (mysqli_num_rows($firegettingAllAssignments) > 0) {
               while ($assignmentDetails = mysqli_fetch_assoc($firegettingAllAssignments)) {
          ?>
                    <div class="testimonial-control-card font-poppins e-c bg-clr-4 flex tx-left p-y-30 w-100per m-y-10" style="border-radius: 10px;" id="<?php echo $assignmentDetails['aWeekId']; ?>">
                         <div class="flex flex-d-coloumn" style="justify-content:space-between; align-items:center; width:90%;">
                              <div class="flex flex-d-column">
                                   <p class="fs-20 fw-600"><?php echo $assignmentDetails['aWeek']; ?></p>
                                   <div>
                                        <?php echo $assignmentDetails['aWeekTopics']; ?>
                                   </div>

                                   <br>

                                   <div>
                                        <?php echo 'Total Subjects: ' . $assignmentDetails['totalSubject']; ?>
                                   </div>
                                   <div>
                                        <?php echo 'Total Questions: ' . $assignmentDetails['totalQuestions']; ?>
                                   </div>

                                   <p class="m-t-10" style="border:1px solid black; width:max-content; padding:5px; margin:5px 0;" onClick="changeStatus('Assignment','<?php echo $assignmentDetails['aWeekId']; ?>','<?php echo $assignmentDetails['aWeekStatus']; ?>')" id="Assignment<?php echo $assignmentDetails['aWeekId']; ?>"><?php echo $assignmentDetails['aWeekStatus']; ?></p>
                              </div>

                              <div class="flex flex-d-column cursor-pointer m-10">
                                   <a href="javascript:void()" onclick="loadContentWithParameter('Assignment-Subject','<?php echo $assignmentDetails['aWeekId']; ?>')">
                                        <p class="fs-30"><i class="fa fa-plus" aria-hidden="true"></i></p>
                                   </a>

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