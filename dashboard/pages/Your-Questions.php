<?php
session_start();
require_once '../../connect/connectDb/config.php';
$_SESSION['path'] = "Your-Questions";
$userId = $_SESSION['userDetails'][0];

$searchBoxValue = "";
$gettingAllQuestions = "SELECT * FROM `78000_questions` WHERE `askedBy` = 'User' AND `askerId` = '$userId'";
if (isset($_POST['query']) && !empty($_POST['query'])) {
     $query = mysqli_escape_string($link, htmlentities($_POST['query']));
     $searchBoxValue = mysqli_escape_string($link, htmlentities($_POST['query']));
     $gettingAllQuestions .= " AND `questionText` LIKE '%" . $query . "%' OR `questionAnsText` LIKE '%" . $query . "%' OR `questionTags` LIKE '%" . $query . "%' OR `questionOf` LIKE '%" . $query . "%'";
}
$gettingAllQuestions .= " ORDER BY `questionId` DESC";

?>

<!-- SEARCH BOX -->
<div class="m-t-20 sector w-100per flex e-c">
     <div class="search-box m-t-20">
          <div class="flex">
               <input type="text" name="query" placeholder="Search Question ..." id="searchBox" value="<?php echo $searchBoxValue; ?>" required>
               <button class="search-btn flex flex-y-center" onclick="search(this)" data-page="Your-Questions">
                    <i class="fa fa-search fs-20 cursor-pointer" aria-hidden="true" style="padding: 15px 30px;"></i>
               </button>
          </div>
     </div>
</div>

<!-- QUESTIONS -->
<div class="flex e-c m-auto m-t-20" style="width: 95%;">
    <div class="flex flex-d-column e-c pos-relative" style="max-width: 700px; width:100%;">

            <div class="flex w-100per m-y-20 askQuestionMenuContainer">
                <div class="askQestionBtn" onClick="loadContent('Ask-Question')"><a href="javascript:void(0)">Ask a Question</a></div>
            </div>

            <?php
            $firegettingAllQuestions = mysqli_query($link, $gettingAllQuestions);

            if (mysqli_num_rows($firegettingAllQuestions) > 0) {
                while ($questionDetails = mysqli_fetch_assoc($firegettingAllQuestions)) {
            ?>
                    <div class="show-post flex flex-d-column w-100per questionBox">
                        <div class="post <?php if($questionDetails['questionAnsSS'] == "" OR empty($questionDetails['questionAnsSS']) OR $questionDetails['questionAnsText'] == "" OR empty($questionDetails['questionAnsText'])){
                            echo "notAnswered";
                        } ?> pos-relative flex e-c flex-d-column" id="Question<?php echo $questionDetails['questionId']; ?>">
                            <?php if($questionDetails['questionAnsSS'] == "" OR empty($questionDetails['questionAnsSS']) OR $questionDetails['questionAnsText'] == "" OR empty($questionDetails['questionAnsText'])){
                            echo '<p  style="color:red; text-align:left; max-width:95%; width: 100%;" class="fs-20 m-10 fw-600">'."• Not Answered Yet</p>";
                            } ?>
                            <div class="questionImage w-100per">
                                    <img src="../data/questions/ques/<?php echo $questionDetails['questionSS'];?>" class="img-fluid" alt="Ques<?php echo $questionDetails['questionId'];?>"">
                            </div>
                            <div class="question w-100per flex e-c justify-content-sbw" <?php if($questionDetails['questionAnsSS'] == "" OR empty($questionDetails['questionAnsSS']) OR $questionDetails['questionAnsText'] == "" OR empty($questionDetails['questionAnsText'])){
                             echo "";
                            }else{
                                echo 'onClick="showAnswer('."'".$questionDetails['questionId'] . "')" . '"';
                            } ?>>
                                <div class="questionText">
                                    <pre style="text-align: left; margin:0; white-space: pre-wrap; white-space: -moz-pre-wrap; white-space: -pre-wrap; white-space: -o-pre-wrap; word-wrap: break-word;" class="flex e-c m-20"><p class="fc-dark-blue font-poppins flex e-c m-20" style="font-size: 15px;">Q) <?php echo $questionDetails['questionText']; ?></p></pre>
                                </div>
                                <div class="getAnswerIcon flex e-c h-100per m-20 cursor-pointer">
                                    <i class="fa-solid fa-angle-down fs-25"></i>
                                </div>
                            </div>
                            <div class="answer flex flex-d-column none" style="margin-bottom:20px !Important;" id="answer<?php echo $questionDetails['questionId'];?>">
                                 <?php
                                    if($questionDetails['haveAnsSS'] == 'yes'){

                                ?>
                                <div class="answerImage">
                                        <img src="../data/questions/ans/<?php echo $questionDetails['questionAnsSS'];?>" class="img-fluid" alt="Ques<?php echo $questionDetails['questionId'];?>">
                                </div>
                                <?php
                                    }

                                ?>

                                <div class="answerText w-100per">
                                    <pre style="text-align: left; margin:0; white-space: pre-wrap; white-space: -moz-pre-wrap; white-space: -pre-wrap; white-space: -o-pre-wrap; word-wrap: break-word;" class="flex m-20"><p class="fc-dark-blue font-poppins flex m-20" style="font-size: 15px;"><?php echo $questionDetails['questionAnsText'];?>"</p></pre>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<p class="tx-center">'."No Questions Available to show. You haven't asked any Question. Click on Ask a Question button to ask a Question.</p>";
            }
            ?>

        
    </div>
</div>
