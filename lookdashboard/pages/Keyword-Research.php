<?php
session_start();
require_once "../../connect/connectDb/config.php";
$_SESSION['path'] = "Keyword-Research";
?>

<div class="flex w-100per e-c" id="signIn">
     <div class="flex e-c main-bar p-y-30">
          <div class="form-box">
               <div class="main-box">
                    <form>
                         <p class="fs-40 tx-center fc-secondary">Keyword Research</p>
                         <p class="fs-15 m-t-20 tx-center fc-primary">Select the option given below and get the list of popular Searches.</p>

                         <!-- Inputs -->
                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Country</p>
                         <div class="input">
                              <select name="Niche" id="input1">
                                   <option value="option1"></option>
                                   <option value="option2"></option>
                                   <option value="option3"></option>
                                   <option value="option4"></option>
                                   <option value="option5"></option>
                                   <option value="option6"></option>
                                   <option value="option7"></option>
                                   <option value="option8"></option>
                                   <option value="option9"></option>
                                   <option value="option10"></option>
                                   <option value="option11"></option>
                                   <option value="option12"></option>
                                   <option value="option13"></option>
                                   <option value="option14"></option>
                                   <option value="option15"></option>
                                   <option value="option16"></option>
                                   <option value="option17"></option>
                                   <option value="option18"></option>
                                   <option value="option19"></option>
                                   <option value="option20"></option>
                                   <option value="option21"></option>
                                   <option value="option22"></option>
                                   <option value="option23"></option>
                              </select>
                         </div>

                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Category</p>
                         <div class="input">
                              <select name="GoodAt" id="GoodAt">
                                   <option value="option1"></option>
                                   <option value="option2"></option>
                                   <option value="option3"></option>
                                   <option value="option4"></option>
                                   <option value="option5"></option>
                                   <option value="option6"></option>
                                   <option value="option7"></option>
                                   <option value="option8"></option>
                                   <option value="option9"></option>
                                   <option value="option10"></option>
                                   <option value="option11"></option>
                                   <option value="option12"></option>
                                   <option value="option13"></option>
                                   <option value="option14"></option>
                                   <option value="option15"></option>
                                   <option value="option16"></option>
                                   <option value="option17"></option>
                                   <option value="option18"></option>
                                   <option value="option19"></option>
                                   <option value="option20"></option>
                                   <option value="option21"></option>
                                   <option value="option22"></option>
                                   <option value="option23"></option>
                                   <option value="option24"></option>
                                   <option value="option25"></option>
                                   <option value="option26"></option>
                                   <option value="option27"></option>
                                   <option value="option28"></option>
                                   <option value="option29"></option>
                                   <option value="option30"></option>
                                   <option value="option31"></option>
                                   <option value="option32"></option>
                                   <option value="option33"></option>
                                   <option value="option34"></option>
                              </select>
                         </div>

                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Time Period</p>
                         <div class="input">
                              <select name="ConsumeMost" id="ConsumeMost">
                                   <option value="option1"></option>
                                   <option value="option2"></option>
                                   <option value="option3"></option>
                                   <option value="option4"></option>
                                   <option value="option5"></option>
                                   <option value="option6"></option>
                                   <option value="option7"></option>
                                   <option value="option8"></option>
                                   <option value="option9"></option>
                                   <option value="option10"></option>
                              </select>
                         </div>

                         <p class="fs-10 tx-center m-t-10"> Please Select Abobe Options to get better Results.</p>


                         <a class="btn btn-gra-purple cursor-pointer" style="margin: 25px auto 5px;" name="SignUp" onclick="nicheDecider()">Update List</a>

                    </form>
               </div>
          </div>
     </div>
</div>

<div class="flex w-100per e-c">
     <div>
          <script type="text/javascript" src="https://ssl.gstatic.com/trends_nrtr/2884_RC01/embed_loader.js"></script>
          <script type="text/javascript">
               trends.embed.renderExploreWidget("RELATED_QUERIES", {
                    "comparisonItem": [{
                         "geo": "IN",
                         "time": "today 12-m"
                    }],
                    "category": 0,
                    "property": "youtube"
               }, {
                    "exploreQuery": "geo=IN&gprop=youtube&date=today 12-m",
                    "guestPath": "https://trends.google.com:443/trends/embed/"
               });
          </script>
     </div>
</div>