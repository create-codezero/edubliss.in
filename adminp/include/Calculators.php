<?php
session_start();
$_SESSION['adminDPage'] = "Calculators";
require_once '../../connect/connectDb/config.php';

?>

<div class="flex e-c w-100per flex-d-column" style="min-height: 75vh;">
     <div class="m-y-20">
          <h1 class="fs-40 tx-center font-poppins">CALCULATORS</h1>
     </div>
     <div class="flex flex-d-column e-c" style="max-width: 600px; width:95%;">
          <div class="control-bar flex tx-left w-100per">
               <div class="flex e-c bg-clr-4 m-10 border-radius-100per pos-relative" style="width: 45px; height:45px;">
                    <a href="javascript:void(0)" onclick="loadContent('Add-Calculator')" class="pos-absolute">
                         <p class="fs-20 p-10"><i class="fa fa-plus" aria-hidden="true"></i></p>
                    </a>
               </div>
          </div>
          <?php
          

          $gettingAllCalculators = "SELECT * FROM `78000_calculators` ORDER BY `calculatorId` DESC";
          $firegettingAllCalculators = mysqli_query($link, $gettingAllCalculators);

          if (mysqli_num_rows($firegettingAllCalculators) > 0) {
               while ($calculatorDetails = mysqli_fetch_assoc($firegettingAllCalculators)) {
          ?>
                    <div class="testimonial-control-card font-poppins e-c bg-clr-4 flex tx-left p-y-30 w-100per m-y-10" style="border-radius: 10px;" id="<?php echo $calculatorDetails['calculatorId']; ?>">
                         <div class="flex flex-d-coloumn" style="justify-content:space-between; align-items:center; width:90%;">
                              <div class="flex flex-d-column">
                                   <p class="fs-20 fw-600"><?php echo $calculatorDetails['calculatorName']; ?></p>
                                   <div>
                                        <?php echo $calculatorDetails['calculatorDescription']; ?>
                                   </div>

                                   <br>

                                   <div>
                                        <?php echo 'Added By: ' . $calculatorDetails['addedByName']; ?>
                                   </div>

                                   <p class="m-t-10" style="border:1px solid black; width:max-content; padding:5px; margin:5px 0;" onClick="changeStatus('Calculator','<?php echo $calculatorDetails['calculatorId']; ?>','<?php echo $calculatorDetails['calculatorStatus']; ?>')" id="Calculator<?php echo $calculatorDetails['calculatorId']; ?>"><?php echo $calculatorDetails['calculatorStatus']; ?></p>
                              </div>
                         </div>
                    </div>
          <?php
               }
          } else {
               echo "No Calculators Available to show.";
          }
          ?>



     </div>
</div>