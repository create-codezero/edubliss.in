<?php
session_start();
$_SESSION['adminDPage'] = "Material-Categories";
require_once '../../connect/connectDb/config.php';

?>

<div class="flex e-c w-100per flex-d-column" style="min-height: 75vh;">
     <div class="m-y-20">
          <h1 class="fs-40 tx-center font-poppins">Material Courses</h1>
     </div>
     <div class="flex flex-d-column e-c" style="max-width: 600px; width:95%;">
          <div class="control-bar flex tx-left w-100per">
               <div class="flex e-c bg-clr-4 m-10 border-radius-100per pos-relative" style="width: 45px; height:45px;">
                    <a href="javascript:void(0)" onclick="loadContent('Add-Material-Course')" class="pos-absolute">
                         <p class="fs-20 p-10"><i class="fa fa-plus" aria-hidden="true"></i></p>
                    </a>
               </div>
          </div>
          <?php
          

          $gettingAllCourses = "SELECT * FROM `78000_courses` ORDER BY `courseId` DESC";
          $firegettingAllCourses = mysqli_query($link, $gettingAllCourses);

          if (mysqli_num_rows($firegettingAllCourses) > 0) {
               while ($coursesDetails = mysqli_fetch_assoc($firegettingAllCourses)) {
          ?>
                    <div class="testimonial-control-card font-poppins e-c bg-clr-4 flex tx-left p-y-30 w-100per m-y-10" style="border-radius: 10px;" id="<?php echo $coursesDetails['courseId']; ?>">
                         <div class="flex flex-d-coloumn" style="justify-content:space-between; align-items:center; width:90%;">
                              <div class="flex flex-d-column">
                                   <p class="fs-20 fw-600"><?php echo $coursesDetails['courseName']; ?></p>

                                   <br>

                                   <div>
                                        <?php echo 'Total Levels: ' . $coursesDetails['totalLevels']; ?>
                                   </div>
                                   <div>
                                        <?php echo 'Total Subjects: ' . $coursesDetails['totalSubjects']; ?>
                                   </div>
                                   <div>
                                        <?php echo 'Total Materials: ' . $coursesDetails['totalMaterials']; ?>
                                   </div>

                                   <p class="m-t-10" style="border:1px solid black; width:max-content; padding:5px; margin:5px 0;" onClick="changeStatus('Material-Course','<?php echo $coursesDetails['courseId']; ?>','<?php echo $coursesDetails['courseStatus']; ?>')" id="Material-Course<?php echo $coursesDetails['courseId']; ?>"><?php echo $coursesDetails['courseStatus']; ?></p>
                              </div>

                              <div class="flex flex-d-column cursor-pointer m-10">
                                   <a href="javascript:void()" onclick="loadContentWithParameter('Course-Level','<?php echo $coursesDetails['courseId']; ?>')">
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