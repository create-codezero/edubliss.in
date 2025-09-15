<?php
session_start();
?>
<div class="flex e-c flex-d-column">

    <div class="flex w-100per e-c m-t-20">
        <img src="../data/calculator/banner/cov-colle_banner.png" alt="cov-colle_banner" class="img-fluid" style="width: 90%;">
    </div>

     <div class="form-box">
          <div class="main-box">
               <h1 class="fs-40 tx-center">Input Details</h1>

               <form class="e-center">

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">X(Comma Seperated) : </p>
                    <div class="input">
                         <input type="text" id="xValues" placeholder="X Vaules Comma Seperated" name="xValues" required>
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Y(Comma Seperated) : </p>
                    <div class="input">
                         <input type="text" id="yValues" name="yValues" placeholder="Y Vaules Comma Seperated" required>
                    </div>

                    <p style="font-size: 12px; font-weight: 500;" class="m-y-20 tx-center">Click Calculate Button to get Solution.</p>

                    <div class="btn btn-gra-purple m-auto" onclick="calculateThis()">Calculate</div>
               </form>


          </div>
     </div>

     <div class="show-post flex flex-d-column w-100per questionBox">
            <div class="post pos-relative flex e-c flex-d-column">
                <div class="answer flex flex-d-column" style="margin:20px auto !Important;">
                    <div class="answerText w-100per">
                        <pre style="text-align: left; margin:0; white-space: pre-wrap; white-space: -moz-pre-wrap; white-space: -pre-wrap; white-space: -o-pre-wrap; word-wrap: break-word;" class="flex m-20"><p class="fc-dark-blue font-poppins flex m-20" style="font-size: 15px;" id="calculatedAnswer"></p></pre>
                    </div>
                </div>
            </div>
    </div>

</div>

<script>

    function calculateThis(){
        let xValues = $("#xValues").val();
        let yValues = $("#yValues").val();

        $.post('./calculations/Covarience-Colleration.php', {
                btnCalculate: "set",
                xValues: xValues,
                yValues: yValues
            },
            function(data, status) {
                document.getElementById("calculatedAnswer").innerHTML = data;
        });
        
    }

</script>