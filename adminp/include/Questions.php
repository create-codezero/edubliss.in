<?php
session_start();
$_SESSION['adminDPage'] = "Questions";
require_once '../../connect/connectDb/config.php';

?>

<div class="flex e-c w-100per flex-d-column" style="min-height: 75vh;">
     <div class="m-y-20">
          <h1 class="fs-40 tx-center font-poppins">Questions</h1>
     </div>
     <div class="flex flex-d-column e-c" style="max-width: 600px; width:95%;">
          <div class="control-bar flex tx-left w-100per">
               <div class="flex e-c bg-clr-4 m-10 border-radius-100per pos-relative" style="width: 45px; height:45px;">
                    <a href="javascript:void(0)" onclick="loadContent('Assignment')" class="pos-absolute">
                         <p class="fs-20 p-10"><i class="fa fa-plus" aria-hidden="true"></i></p>
                    </a>
               </div>
          </div>
          <?php

          $gettingAllQuestions = "SELECT * FROM `78000_questions` ORDER BY `questionId` DESC";
          $firegettingAllQuestions = mysqli_query($link, $gettingAllQuestions);

          if (mysqli_num_rows($firegettingAllQuestions) > 0) {
               while ($questionDetails = mysqli_fetch_assoc($firegettingAllQuestions)) {
          ?>
                    <div class="testimonial-control-card font-poppins e-c bg-clr-4 flex tx-left p-y-30 w-100per m-y-10" style="border-radius: 10px;" id="<?php echo $questionDetails['questionId']; ?>">
                         <div class="flex flex-d-coloumn" style="justify-content:space-between; align-items:center; width:90%;">
                              <div class="flex flex-d-column">

                              <?php

                                        if(!empty($questionDetails['questionAnsSS']) && !empty($questionDetails['questionAnsText'])){

                                    ?>
                                   <p style="color:green; margin:5px 0; font-size:18px;"><b>• Answered</b></p>

                                   <?php 
                                        }else{
                                            ?>
                                            <p style="color:red; margin:5px 0; font-size:18px;"><b>• Not Answered</b></p>
                                            <?php
                                        }
                                    ?>

                                    

                                    <div>
                                        <img src="../data/questions/ques/<?php echo $questionDetails['questionSS'];?>" class="img-fluid" alt="questionSS<?php echo $questionDetails['questionId']; ?>" style="border-radius:7px;">
                                    </div>
                                   <p class="fs-20 fw-600"><b>QUESTION: </b><pre style="text-align: left; margin:0; white-space: pre-wrap; white-space: -moz-pre-wrap; white-space: -pre-wrap white-space: -o-pre-wrap; word-wrap: break-word;"><p class="fc-dark-blue font-poppins" style="font-size: 15px;"><?php echo $questionDetails['questionText']; ?></p></pre></p>

                                   <br>

                                   <div>
                                        <b>TOPIC: </b><?php echo $questionDetails['questionOf']; ?>
                                   </div>

                                   <br>

                                   <div>
                                        <b>TOTAL VARIATIONS: </b><?php echo $questionDetails['totalVariation']; ?>
                                   </div>

                                   <br>

                                   <div>
                                        Handwritten Answer Photo <br>
                                        <?php

                                        if(!empty($questionDetails['questionAnsSS'])){

                                    ?>
                                   <img src="../data/questions/ans/<?php echo $questionDetails['questionAnsSS'];?>" class="img-fluid" alt="answerSS<?php echo $questionDetails['questionId']; ?>" style="border-radius:7px;">

                                   <?php 
                                        }
                                    ?>
                                        
                                        <p style="color:red; margin-top:5px; border-radius:7px;"><?php
                                            if(empty($questionDetails['questionAnsSS'])){
                                                echo "Answer Photo not uploaded yet!";
                                            }
                                        ?></p>
                                    </div>

                                    <div>
                                        <b>TEXT ANSWER: </b><pre style="text-align: left; margin:0; white-space: pre-wrap; white-space: -moz-pre-wrap; white-space: -pre-wrap white-space: -o-pre-wrap; word-wrap: break-word;"><p class="fc-dark-blue font-poppins" style="font-size: 15px;"><?php echo $questionDetails['questionAnsText']; ?></p></pre>
                                   </div>

                                   <p class="m-t-10" style="border:1px solid black; width:max-content; padding:5px; margin:5px 0;" onClick="changeStatus('Question','<?php echo $questionDetails['questionId']; ?>','<?php echo $questionDetails['questionStatus']; ?>')" id="Question<?php echo $questionDetails['questionId']; ?>"><?php echo $questionDetails['questionStatus']; ?></p>

                                   <?php

                                        if($questionDetails['questionAnsSS'] == "" && $questionDetails['questionAnsText'] == ""){

                                    ?>
                                   <p class="m-t-10" onclick="loadContentWithParameter3('Upload-Answer', '<?php echo $questionDetails['questionId']; ?>')" style="border:1px solid green; color:green; width:max-content; padding:5px; margin:5px 0; cursor: pointer;">Upload Answer</p>

                                   <?php 
                                        }
                                    ?>
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