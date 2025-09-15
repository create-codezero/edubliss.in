<?php
session_start();
?>
<div class="flex e-c flex-d-column">

    <div class="flex w-100per e-c m-t-20">
        <img src="../data/calculator/banner/permutation-combination_banner.png" alt="cov-colle_banner" class="img-fluid" style="width: 90%;">
    </div>

     <div class="form-box">
          <div class="main-box">
               <h1 class="fs-40 tx-center">Input Details</h1>

               <form class="e-center">

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">"n" Value : </p>
                    <div class="input">
                         <input type="text" id="nValue" name="nValue" placeholder="n Vaules" required>
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">"r" Value : </p>
                    <div class="input">
                         <input type="text" id="rValue" name="rValue" placeholder="r Vaules" required>
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Select Process</p>
                    <div class="input" title="Select what you want to do with Values">
                        <select name="whatToDo" id="whatToDo">
                                <option value="Combination" selected>Combination</option>
                                <option value="Permutation">Permutation</option>
                <       </select>
                    </div>

                    <p style="font-size: 12px; font-weight: 500;" class="m-y-20 tx-center">Click Calculate Button to get Solution.</p>

                    <div class="btn btn-gra-purple m-auto" onclick="calcPandC()">Calculate</div>
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
        function calcPandC(){
        let n = $("#nValue").val();
        let r = $("#rValue").val();

        let ans = "";

        ans += `n = ${n} <br>r = ${r}<br><br>`;

        let whatToDo = $("#whatToDo").val();

        if(whatToDo == "Permutation"){
            let nfac = 1;
            let nsubr = n-r;
            let nsubrfac = 1;

            ans += `formula = n!/(n-r)! <br><br>`

            ans += `(n-r) = ${nsubr} <br><br>`;

            let multValue = "";

            let i = n;

            
            while(i > nsubr){
                nfac = nfac * i;

                if(nsubr == i-1){
                    multValue += `${i} `;
                }else{
                    multValue += `${i} x `;
                }


                i--;
            }

            let p = Math.round(nfac/(nsubrfac));

            ans += `permutation = n!/(n-r)! = (${multValue} x ${nsubr}!)/(${nsubr}!) = ${multValue} = ${p}`;

            document.getElementById("calculatedAnswer").innerHTML = ans;

        }else if(whatToDo == "Combination"){
            let nfac = 1;
            let reducednfac = 1;
            let nsubr = n-r;
            let nsubrfac = 1;
            let smallNumFac = 1;

            ans += `formula = n!/(r! (n-r)!) <br><br>`

            ans += `(n-r) = ${nsubr} <br><br>`;

            let multValue = "";

            let i = n;

            let removeFromN;
            if(nsubr > r){
                removeFromN =nsubr;
            }else{
                removeFromN =r;
            }
            
            while(i > removeFromN){
                reducednfac = reducednfac * i;

                if(removeFromN == i-1){
                    multValue += `${i} `;
                }else{
                    multValue += `${i} x `;
                }

                i--;
            }

            
            let k;

            if(nsubr > r){
                k = r;
            }else{
                k = nsubr;
            }

            while(k >= 1){
                smallNumFac = smallNumFac * k;

                k--;
            }

            let c = Math.round(reducednfac/smallNumFac);

            if(nsubr > r){
                ans += `combination = n!/(r!(n-r)!) = (${multValue}x ${nsubr}!)/(${r}!${nsubr}!) = ${multValue}/${smallNumFac} = ${c}`;
            }else{
                ans += `combination = n!/(r!(n-r)!) = (${multValue}x ${r}!)/(${r}!${nsubr}!) = ${multValue}/${smallNumFac} = ${c}`;
            }

            

            document.getElementById("calculatedAnswer").innerHTML = ans;

        }else{
            alert("Please Select Permutation or Combination");
        }

        }
    </script>