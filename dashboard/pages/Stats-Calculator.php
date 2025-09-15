<?php
session_start();
require_once "../../connect/connectDb/config.php";
$_SESSION['path'] = "Stats-Calculator";
$searchBoxValue = "";
$lastAsset = 10;
$sql = "SELECT * FROM `78000_calculators` WHERE `calculatorStatus` = 'Public'";
if (isset($_POST['query']) && !empty($_POST['query'])) {
     $query = mysqli_escape_string($link, htmlentities($_POST['query']));
     $searchBoxValue = mysqli_escape_string($link, htmlentities($_POST['query']));
     $sql .= " AND `calculatorName` LIKE '%" . $query . "%' OR `calculatorDescriptioin` LIKE '%" . $query . "%' OR `calculatorLink` LIKE '%" . $query . "%'";
}
$sql .= " ORDER BY calculatorId DESC"; 
$sql .= " LIMIT 0,$lastAsset";
$result = mysqli_query($link, $sql);
?>
<div class="m-t-20 sector w-100per flex e-c" id="searchBoxConainer">
     <div class="search-box m-y-20">
          <div class="flex">
               <input type="text" name="query" placeholder="Search Yas ..." id="searchBox" value="<?php echo $searchBoxValue; ?>" required>
               <button class="search-btn flex flex-y-center" onclick="search(this)" data-page="Assets">
                    <i class="fa fa-search fs-20 cursor-pointer" aria-hidden="true" style="padding: 15px 30px;"></i>
               </button>
          </div>
     </div>
</div>

<div class="sector w-100per">

     <div class="grid grid-column-4 tab-grid-column-2 mob-grid-column-1  grid-gap-15 m-20 mob-m-10" id="assetContainerMaiNCards">
          <?php
          if (mysqli_num_rows($result) > 0) {
               while ($row = mysqli_fetch_assoc($result)) {
          ?>

                    <!-- Asset Card -->
                    <div class="w-100per asset-card">
                         <div class="thumbnail">
                              <?php

                                   if(empty($row['calculatorThumbnail'])){
                                   ?>
                                        <div class="flex e-c" style="min-height: 200px; background-color:white; border:3.5px solid var(--clr-2); border-radius:12px;">
                                             <p class="font-libre-caslon-text fw-700 tx-center fs-30" style="max-width:80%; color:var(--clr-2);"><?php echo $row['assetName']; ?></p>
                                        </div>
                                   <?php
                                   }else{
                                   ?>
                                        <img src="../data/calculator/thumbnail/<?php echo $row['calculatorThumbnail']; ?>" alt="" class="img-fluid">
                                   <?php
                                   }

                              ?>
                         </div>
                         <div class="content tx-center m-10">
                              <p class="fc-dark-blue font-poppins fw-500"><?php echo $row['calculatorName']; ?></p>
                              <p class="fc-light-dark-blue font-poppins fw-400 fs-10 m-t-5"><?php echo $row['calculatorDescription']; ?></p>
                         </div>
                         <div class="call-to-action m-t-5 block tx-center">
                              <p class="fc-light-dark-blue font-poppins fw-600 fs-10 m-b-10">Made By : <?php echo $row['addedByName']; ?></p>

                              <div class="bg-clr-4 w-100per flex e-c">
                                   <a class="download-btn fc-primary hover-fc-primary bg-clr-4" id="<?php echo $row['calculatorId']; ?>" onclick="loadCalculator('<?php echo $row['calculatorLink']; ?>')" href="javascript:void(0)">Use Calculator</a>
                              </div>

                         </div>
                    </div>


                    <!-- Asset Card -->

          <?php
               }
          } else {
               echo '<p class="tx-center font-poppins fw-500">🙄 No Calculator Found 🙄 </p>';
          }
          ?>
                    <div id="EndLoad"></div>

     </div>
     <div id="End" class="p-y-10" style="display: block; width:100% !Important;"></div>
</div>