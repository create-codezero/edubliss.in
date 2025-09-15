<?php
session_start();
$_SESSION['path'] = "Assignment";
require_once '../../connect/connectDb/config.php';

$searchBoxValue = "";
$gettingAllAssignments = "SELECT * FROM `78000_a_week` WHERE `aWeekStatus` = 'Public'";
if (isset($_POST['query']) && !empty($_POST['query'])) {
     $query = mysqli_escape_string($link, htmlentities($_POST['query']));
     $searchBoxValue = mysqli_escape_string($link, htmlentities($_POST['query']));
     $gettingAllAssignments .= " AND `aWeek` LIKE '%" . $query . "%' OR `aWeekTopics` LIKE '%" . $query . "%'";
}
$gettingAllAssignments .= " ORDER BY `aWeekId` DESC";

?>
<!-- SEARCH BOX -->
<div class="m-t-20 sector w-100per flex e-c">
     <div class="search-box m-y-20">
          <div class="flex">
               <input type="text" name="query" placeholder="Search Question ..." id="searchBox" value="<?php echo $searchBoxValue; ?>" required>
               <button class="search-btn flex flex-y-center" onclick="search(this)" data-page="Assignments">
                    <i class="fa fa-search fs-20 cursor-pointer" aria-hidden="true" style="padding: 15px 30px;"></i>
               </button>
          </div>
     </div>
</div>

<!-- ASSIGNMENT SECTION -->
<div class="flex e-c w-100per flex-d-column" style="min-height: 75vh;">
     <div class="">
          <h1 class="fs-40 tx-center font-poppins">Assignments</h1>
     </div>
     <div class="flex flex-d-column e-c" style="max-width: 600px; width:95%;">
          <?php
          

          $gettingAllAssignments =
          $firegettingAllAssignments = mysqli_query($link, $gettingAllAssignments);

          if (mysqli_num_rows($firegettingAllAssignments) > 0) {
               while ($assignmentDetails = mysqli_fetch_assoc($firegettingAllAssignments)) {
          ?>
                    <div onclick="loadSubject(this)" class="testimonial-control-card font-poppins e-c bg-clr-4 flex tx-left p-y-30 w-100per m-y-10" style="border-radius: 10px;" id="<?php echo $assignmentDetails['aWeekId']; ?>">
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

                              </div>

                              <div class="flex flex-d-column cursor-pointer m-10">
                                   <a href="javascript:void()" onclick="loadContentWithParameter('Assignment-Subject','<?php echo $assignmentDetails['aWeekId']; ?>')">
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
    function loadSubject(element) {
               var aWeekId = element.id;
               $(`#loading`).toggleClass("none");

               $(`#Content`).load(`./pages/Assignment-Subjects.php?aWeekId=${aWeekId}`, function() {
                    $(`#loading`).toggleClass("none");

                    const state = {
                         'page_id': 1,
                         'user_id': 5
                    };
                    const title = '';
                    const url = `Assignment-Subjects_${aWeekId}`;

                    history.pushState(state, title, url);
               });
          }
</script>