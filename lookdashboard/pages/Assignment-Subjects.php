<?php
session_start();
require_once '../../connect/connectDb/config.php';

if(!isset($_GET['aWeekId'])){
    header("location: ./");
}

?>

<div class="flex e-c w-100per flex-d-column" style="min-height: 75vh;">
     <div class="m-y-20">
          <h1 class="fs-40 tx-center font-poppins">Subjects</h1>
     </div>
     <div class="flex flex-d-column e-c" style="max-width: 600px; width:95%;">
          <?php
          
          $aSubjectWeek = $_GET['aWeekId'];

          $gettingAllSubject = "SELECT * FROM `78000_a_subjects` WHERE `aSubjectWeek` = '$aSubjectWeek' ORDER BY `aSubjectId` DESC";
          $firegettingAllSubject = mysqli_query($link, $gettingAllSubject);

          if (mysqli_num_rows($firegettingAllSubject) > 0) {
               while ($subjectDetails = mysqli_fetch_assoc($firegettingAllSubject)) {
          ?>
                    <div onclick="loadQuestions(this)" class="testimonial-control-card font-poppins e-c bg-clr-4 flex tx-left p-y-30 w-100per m-y-10" style="border-radius: 10px;" aWeekId="<?php echo $subjectDetails['aSubjectWeek']; ?>" id="<?php echo $subjectDetails['aSubjectId']; ?>">
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

                              </div>

                              <div class="flex flex-d-column cursor-pointer m-10">
                                   <a href="javascript:void()">
                                        <p class="fs-30"><i class="fa fa-angle-right" aria-hidden="true"></i></p>
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


<script>
    function loadQuestions(element) {
               var aWeekId = element.getAttribute('aweekid');
               var aSubjectId = element.id;
               $(`#loading`).toggleClass("none");

               $(`#Content`).load(`./pages/A-Question.php?aWeekId=${aWeekId}&aSubjectId=${aSubjectId}`, function() {
                    $(`#loading`).toggleClass("none");

                    const state = {
                         'page_id': 1,
                         'user_id': 5
                    };
                    const title = '';
                    const url = `A-Question_${aWeekId}_${aSubjectId}`;

                    history.pushState(state, title, url);
               });
          }
</script>