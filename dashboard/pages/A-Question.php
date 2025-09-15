<?php
session_start();
require_once '../../connect/connectDb/config.php';

if(!isset($_GET['aWeekId']) OR !isset($_GET['aSubjectId'])){
    header("location: ./");
}

$furl = " AND `assignment`='" . $_GET['aWeekId'] . "' AND `subject`='" . $_GET['aSubjectId'] . "'";

$gettingAllQuestions = "SELECT * FROM `78000_questions` WHERE `questionStatus` = 'Public'";
$gettingAllQuestions .= $furl;
$gettingAllQuestions .= " ORDER BY `questionId` DESC";

?>

<!-- QUESTIONS -->
<div class="flex e-c m-auto m-t-20" style="width: 95%;">
    <div class="flex flex-d-column e-c pos-relative" style="max-width: 700px; width:100%;">

            <?php
            $firegettingAllQuestions = mysqli_query($link, $gettingAllQuestions);

            if (mysqli_num_rows($firegettingAllQuestions) > 0) {
                while ($questionDetails = mysqli_fetch_assoc($firegettingAllQuestions)) {
            ?>
                    <div class="show-post flex flex-d-column w-100per questionBox">
                        <div class="post pos-relative flex e-c flex-d-column" id="Question<?php echo $questionDetails['questionId']; ?>">
                            <div class="questionImage w-100per">
                                    <img src="../data/questions/ques/<?php echo $questionDetails['questionSS'];?>" class="img-fluid" alt="Ques<?php echo $questionDetails['questionId'];?>"">
                            </div>
                            <div class="question w-100per flex e-c justify-content-sbw" onClick="showAnswer('<?php echo $questionDetails['questionId'];?>')">
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
                echo "No Questions Available to show.";
            }
            ?>

        
    </div>
</div>
