<?php
session_start();
$_SESSION['adminDPage'] = "Material-Categories";
require_once '../../connect/connectDb/config.php';

if(!isset($_GET['course']) && !isset($_GET['level'])){
    header("location: ./");
}

?>

<div class="flex e-c w-100per flex-d-column" style="min-height: 75vh;">
     <div class="m-y-20">
          <h1 class="fs-40 tx-center font-poppins">Level Subjects</h1>
     </div>
     <div class="flex flex-d-column e-c" style="max-width: 600px; width:95%;">
          <div class="control-bar flex tx-left w-100per">
               <div class="flex e-c bg-clr-4 m-10 border-radius-100per pos-relative" style="width: 45px; height:45px;">
                    <a href="javascript:void(0)" onclick="loadContentWithParameter2('Add-Level-Subject','<?php echo $_GET['course']; ?>','<?php echo $_GET['level']; ?>')" class="pos-absolute">
                         <p class="fs-20 p-10"><i class="fa fa-plus" aria-hidden="true"></i></p>
                    </a>
               </div>
          </div>
          <?php
          
          $materialCourseId = $_GET['course'];
          $materialLevelId = $_GET['level'];

          $gettingAllSubjects = "SELECT * FROM `78000_subjects` WHERE `subjectCourse` = '$materialCourseId' AND `subjectLevel` = '$materialLevelId' ORDER BY `subjectId` DESC";
          $firegettingAllSubjects = mysqli_query($link, $gettingAllSubjects);

          if (mysqli_num_rows($firegettingAllSubjects) > 0) {
               while ($subjectsDetails = mysqli_fetch_assoc($firegettingAllSubjects)) {
          ?>
                    <div class="testimonial-control-card font-poppins e-c bg-clr-4 flex tx-left p-y-30 w-100per m-y-10" style="border-radius: 10px;" id="<?php echo $subjectsDetails['subjectId']; ?>">
                         <div class="flex flex-d-coloumn" style="justify-content:space-between; align-items:center; width:90%;">
                              <div class="flex flex-d-column">
                                   <p class="fs-20 fw-600"><?php echo $subjectsDetails['subjectName']; ?></p>

                                   <br>

                                   <div>
                                        <?php echo 'Total Materials: ' . $subjectsDetails['totalMaterials']; ?>
                                   </div>

                                   <p class="m-t-10" style="border:1px solid black; width:max-content; padding:5px; margin:5px 0;" onClick="changeStatus('Level-Subject','<?php echo $subjectsDetails['subjectId']; ?>','<?php echo $subjectsDetails['subjectStatus']; ?>')" id="Level-Subject<?php echo $subjectsDetails['subjectId']; ?>"><?php echo $subjectsDetails['subjectStatus']; ?></p>

                                   <div class="flex flex-row e-c w-100per m-t-20 p-10" style="background-color:var(--clr-2); border-radius:10px;">
                                        <div>
                                        <p class="fs-15 fw-500" style="margin-left: 2px;">Add Multiple Assets</p>
                                        <select name="noOfMaterials<?php echo $subjectsDetails['subjectId']; ?>" id="noOfMaterials<?php echo $subjectsDetails['subjectId']; ?>">

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
                                             <a href="javascript:void()" onclick="loadContentWithParameter5('Add-Multiple-Materials','<?php echo $subjectsDetails['subjectCourse']; ?>','<?php echo $subjectsDetails['subjectLevel']; ?>', '<?php echo $subjectsDetails['subjectId']; ?>','<?php echo $subjectsDetails['subjectId']; ?>')">
                                                  <p class="fs-30"><i class="fa fa-plus" aria-hidden="true"></i></p>
                                             </a>

                                        </div>
                                   </div>

                                   
                              </div>

                              
                         </div>
                    </div>
          <?php
               }
          } else {
               echo "No Subjects Available to show.";
          }
          ?>



     </div>
</div>