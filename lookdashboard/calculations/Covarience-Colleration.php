<?php

if (isset($_POST['btnCalculate'])) {
     $xValues = $_POST['xValues'];
     $yValues = $_POST['yValues'];

     if(!empty($xValues) && !empty($yValues)){
        echo $xValues."<br>";
        echo $yValues."<br><br><br>";

        $xArray = str_getcsv($xValues);
        $yArray = str_getcsv($yValues);

        $lengthX = count($xArray);
        $lengthY = count($yArray);

        if($lengthX == $lengthY){

          $sampleSize = ($lengthX - 1);
          $populationSize = $lengthX;

          echo "Total Numbers in x is: " . $lengthX."<br>";
          echo "Total Numbers in y is: " . $lengthY."<br><br><br>";

          $sumX = array_sum($xArray);
          $sumY = array_sum($yArray);

          echo "sum of x is: " . $sumX."<br>";
          echo "sum of y is: " . $sumY."<br><br><br>";

          $meanX = number_format($sumX/$lengthX,2);
          $meanY = number_format($sumY/$lengthY,2);

          echo "mean of x is: " . $meanX."<br>";
          echo "mean of y is: " . $meanY."<br><br><br>";

          $diffXMean = Array();
          $diffYMean = Array();

          foreach($xArray as $xItems){
               $diff = number_format($xItems - $meanX,2);
               array_push($diffXMean, $diff);
          }

          foreach($yArray as $yItems){
               $diff = number_format($yItems - $meanY,2);
               array_push($diffYMean, $diff);
          }

          echo "difference of x from its mean: " . implode(",  ",$diffXMean);
          echo "<br>";
          echo "difference of y from its mean: " . implode(",  ",$diffYMean);
          echo "<br><br><br>";

          $squaredXDiff = array();
          $squaredYDiff = array();

          foreach($diffXMean as $diffXItems){
               $squaredVal = number_format(($diffXItems*$diffXItems),2);
               array_push($squaredXDiff, $squaredVal);
          }

          foreach($diffYMean as $diffYItems){
               $squaredVal = number_format(($diffYItems*$diffYItems),2);
               array_push($squaredYDiff, $squaredVal);
          }


          echo "Squared difference of x from its mean: " . implode(",  ",$squaredXDiff);
          echo "<br>";
          echo "Squared difference of y from its mean: " . implode(",  ",$squaredYDiff);
          echo "<br><br><br>";

          $noSquaredDiffMulti = array();
          $squaredDiffMulti = array();

          foreach ($diffXMean as $key=>$val) {
               array_push($noSquaredDiffMulti, number_format(($val * $diffYMean[$key]),2));
          }

          foreach ($squaredXDiff as $key=>$val) {
               array_push($squaredDiffMulti, number_format(($val * $squaredYDiff[$key]),2));
          }

          echo "Multiplied Values of Not Squared difference from its mean: " . implode(",  ",$noSquaredDiffMulti);
          // print_r($noSquaredDiffMulti);
          echo "<br>";
          echo "Multiplied Values of Squared difference from its mean: " . implode(",  ",$squaredDiffMulti);
          // print_r($squaredDiffMulti);
          echo "<br><br><br>";

          $sumOfNoSquaredDiff = array_sum($noSquaredDiffMulti);
          $sumOfSquaredDiff = array_sum($squaredDiffMulti);

          echo "Sum of not squared difference from its mean: " . $sumOfNoSquaredDiff . "<br><br>";
          echo "Sum of squared difference from its mean: " . $sumOfSquaredDiff . "<br><br><br>";

          $populationStandardDeviationX = number_format(sqrt((array_sum($squaredXDiff)/$populationSize)),2);
          $sampleStandardDeviationX = number_format(sqrt((array_sum($squaredXDiff)/$sampleSize)),2);


          $populationStandardDeviationY = number_format(sqrt((array_sum($squaredYDiff)/$populationSize)),2);
          $sampleStandardDeviationY = number_format(sqrt((array_sum($squaredYDiff)/$sampleSize)),2);

          echo "Sample Standard Deviation of X: " . $sampleStandardDeviationX . "  (Upto 2 decimal Value)" . "<br><br>";
          echo "Population Standard Deviation of X: " . $populationStandardDeviationX . "  (Upto 2 decimal Value)" . "<br><br><br>";

          echo "Sample Standard Deviation of Y: " . $sampleStandardDeviationY . "  (Upto 2 decimal Value)" . "<br><br>";
          echo "Population Standard Deviation of Y: " . $populationStandardDeviationY . "  (Upto 2 decimal Value)" . "<br><br><br>";



          $sampleCovarience = $sumOfNoSquaredDiff/$sampleSize;
          $populationCovarience = $sumOfNoSquaredDiff/$populationSize;

          echo "Sample Co-variance: " . number_format($sampleCovarience,3) . "  (Upto 3 decimal Value)" . "<br><br>";
          echo "Population Co-variance: " . number_format($populationCovarience,3) . "  (Upto 3 decimal Value)" . "<br><br><br>";

          $sqrtSquaredSumXDiff = number_format(sqrt(array_sum($squaredXDiff)),3);
          $sqrtSquaredSumYDiff = number_format(sqrt(array_sum($squaredYDiff)),3);
          

          $correlation = $sumOfNoSquaredDiff / ($sqrtSquaredSumXDiff*$sqrtSquaredSumYDiff);

          echo "Correlation: " . number_format($correlation,3) . "  (Upto 3 decimal Value)" . "<br>";



        }else{
          echo "Input data is wrong, Please go back refresh the page and re-input data.";
        }

     }
}

?>