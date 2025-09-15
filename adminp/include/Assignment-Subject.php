<?php
session_start();
$_SESSION['adminDPage'] = "Assignment";
require_once '../../connect/connectDb/config.php';

if(!isset($_GET['assignment'])){
    header("location: ./");
}

?>

<div class="flex e-c w-100per flex-d-column" style="min-height: 75vh;">
     <div class="m-y-20">
          <h1 class="fs-40 tx-center font-poppins">Subjects</h1>
     </div>
     <div class="flex flex-d-column e-c" style="max-width: 600px; width:95%;">
          <div class="control-bar flex tx-left w-100per">
               <div class="flex e-c bg-clr-4 m-10 border-radius-100per pos-relative" style="width: 45px; height:45px;">
                    <a href="javascript:void(0)" onclick="loadContentWithParameter('Add-Assignment-Subject','<?php echo $_GET['assignment']; ?>')" class="pos-absolute">
                         <p class="fs-20 p-10"><i class="fa fa-plus" aria-hidden="true"></i></p>
                    </a>
               </div>
          </div>
          <?php
          
          $aSubjectWeek = $_GET['assignment'];

          $gettingAllSubject = "SELECT * FROM `78000_a_subjects` WHERE `aSubjectWeek` = '$aSubjectWeek' ORDER BY `aSubjectId` DESC";
          $firegettingAllSubject = mysqli_query($link, $gettingAllSubject);

          if (mysqli_num_rows($firegettingAllSubject) > 0) {
               while ($subjectDetails = mysqli_fetch_assoc($firegettingAllSubject)) {
          ?>
                    <div class="testimonial-control-card font-poppins e-c bg-clr-4 flex tx-left p-y-30 w-100per m-y-10" style="border-radius: 10px;" id="<?php echo $subjectDetails['aSubjectId']; ?>">
                         <div class="flex flex-d-coloumn" style="justify-content:space-between; align-items:center; width:90%;">
                              <div class="flex flex-d-column">
                                   <p class="fs-20 fw-600"><?php echo $subjectDetails['aSubject']; ?></p>
                                   <div>
                                        <?php echo $subjectDetails['aSubjectTopics']; ?>
                                   </div>

                                   <br>

                                   <div>
                                        <?php echo 'Total Questions: ' . $subjectDetails['totalQuestions']; ?>
                                   </div>

                                   <p class="m-t-10" style="border:1px solid black; width:max-content; padding:5px; margin:5px 0;" onClick="changeStatus('Subject','<?php echo $subjectDetails['aSubjectId']; ?>','<?php echo $subjectDetails['aSubjectStatus']; ?>')" id="Subject<?php echo $subjectDetails['aSubjectId']; ?>"><?php echo $subjectDetails['aSubjectStatus']; ?></p>

                                   <div class="flex flex-row e-c w-100per m-t-20 p-10" style="background-color:var(--clr-2); border-radius:10px;">
                                        <div>
                                        <p class="fs-15 fw-500" style="margin-left: 2px;">Add Multiple Question</p>
                                        <select name="noOfQuestions" id="noOfQuestions">
                                        <?php
                                            $n = 1 ;
                                            $totalOptions = 25;
                                            while($n <= $totalOptions){
                                                ?>
                                                <option value="<?php echo $n; ?>"><?php echo $n; ?></option>
                                            <?php
                                            $n = $n + 1;
                                            }
                                            ?>
                                        </select>
                                        </div>
                                        <div class="flex flex-d-column cursor-pointer m-l-30 border-radius-100per">
                                             <a href="javascript:void()" onclick="loadContentWithParameter4('Add-Multiple-Question','<?php echo $subjectDetails['aSubjectWeek']; ?>', '<?php echo $subjectDetails['aSubjectId']; ?>')">
                                                  <p class="fs-30"><i class="fa fa-plus" aria-hidden="true"></i></p>
                                             </a>

                                             

                                        </div>
                                   </div>

                                   
                              </div>

                              <div class="flex flex-d-column cursor-pointer m-10">
                                   <a href="javascript:void()" onclick="loadContentWithParameter2('Add-Question','<?php echo $subjectDetails['aSubjectWeek']; ?>', '<?php echo $subjectDetails['aSubjectId']; ?>')">
                                        <p class="fs-30"><i class="fa fa-plus" aria-hidden="true"></i></p>
                                   </a>

                                   <a href="javascript:void()" onclick="loadContentWithParameter2('Ans-A-Questions','<?php echo $subjectDetails['aSubjectWeek']; ?>', '<?php echo $subjectDetails['aSubjectId']; ?>')" class="m-t-20">
                                        <p class="fs-30"><i class="fa fa-upload" aria-hidden="true"></i></p>
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