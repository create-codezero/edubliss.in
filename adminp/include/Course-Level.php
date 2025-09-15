<?php
session_start();
$_SESSION['adminDPage'] = "Material-Categories";
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
                    <a href="javascript:void(0)" onclick="loadContentWithParameter('Add-Course-Level','<?php echo $_GET['course']; ?>')" class="pos-absolute">
                         <p class="fs-20 p-10"><i class="fa fa-plus" aria-hidden="true"></i></p>
                    </a>
               </div>
          </div>
          <?php
          
          $levelCourse = $_GET['course'];

          $gettingAllLevels = "SELECT * FROM `78000_levels` WHERE `levelCourse` = '$levelCourse' ORDER BY `levelId` DESC";
          $firegettingAllLevels = mysqli_query($link, $gettingAllLevels);

          if (mysqli_num_rows($firegettingAllLevels) > 0) {
               while ($levelDetails = mysqli_fetch_assoc($firegettingAllLevels)) {
          ?>
                    <div class="testimonial-control-card font-poppins e-c bg-clr-4 flex tx-left p-y-30 w-100per m-y-10" style="border-radius: 10px;" id="<?php echo $levelDetails['levelId']; ?>">
                         <div class="flex flex-d-coloumn" style="justify-content:space-between; align-items:center; width:90%;">
                              <div class="flex flex-d-column">
                                   <p class="fs-20 fw-600"><?php echo $levelDetails['levelName']; ?></p>

                                   <br>

                                   <div>
                                        <?php echo 'Total Subjects: ' . $levelDetails['totalSubjects']; ?>
                                   </div>

                                   <div>
                                        <?php echo 'Total Materials: ' . $levelDetails['totalMaterials']; ?>
                                   </div>

                                   <p class="m-t-10" style="border:1px solid black; width:max-content; padding:5px; margin:5px 0;" onClick="changeStatus('Course-Level','<?php echo $levelDetails['levelId']; ?>','<?php echo $levelDetails['levelStatus']; ?>')" id="Course-Level<?php echo $levelDetails['levelId']; ?>"><?php echo $levelDetails['levelStatus']; ?></p>
                                   
                              </div>

                              <div class="flex flex-d-column cursor-pointer m-10">
                                   <a href="javascript:void()" onclick="loadContentWithParameter2('Level-Subject','<?php echo $levelDetails['levelCourse']; ?>', '<?php echo $levelDetails['levelId']; ?>')">
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