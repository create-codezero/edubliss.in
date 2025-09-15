<?php
session_start();
require_once "../../connect/connectDb/config.php";
$_SESSION['adminDPage'] = "Edit-Assets";
$searchBoxValue = "";
$sql = "SELECT * FROM `78000_assets` ORDER BY assetId DESC LIMIT 100";
$result = mysqli_query($link, $sql);
?>

<div class="sector w-100per">

     <div class="grid grid-column-4 tab-grid-column-2 mob-grid-column-1  grid-gap-15 m-20 mob-m-10">
          <?php
          if (mysqli_num_rows($result) > 0) {
               while ($row = mysqli_fetch_assoc($result)) {
                    

          ?>

                    <!-- Asset Card -->
                    <div class="w-100per asset-card">
                         <div class="thumbnail">
                            <?php

                            if(empty($row['assetThumbnail'])){
                            ?>
                                <div class="flex e-c" style="min-height: 200px; background-color:white; border:3.5px solid var(--clr-2); border-radius:12px;">
                                    <p class="font-libre-caslon-text fw-700 tx-center fs-30" style="max-width:80%; color:var(--clr-2);"><?php echo $row['assetName']; ?></p>
                                </div>
                            <?php
                            }else{
                            ?>
                                <img src="<?php echo $row['assetThumbnail']; ?>" alt="" class="img-fluid">
                            <?php
                            }

                            ?>
                              
                         </div>
                         <div class="content tx-center m-10">
                              <p class="fc-dark-blue font-poppins fw-500"><?php echo $row['assetName']; ?></p>
                              <p class="fc-light-dark-blue font-poppins fw-400 fs-10 m-t-5"><?php echo $row['assetDescription']; ?></p>
                         </div>
                         <div class="call-to-action flex flex-column e-c m-t-5 block tx-center">
                              <p class="fc-light-dark-blue font-poppins fw-600 fs-10 m-b-10">Uploaded By : <?php echo $row['uploaderName']; ?></p>

                              <p class="m-t-10 cursor-pointer" style="border:1px solid black; width:max-content; padding:5px; margin:5px 0;" onClick="changeStatus('AssetUpdate','<?php echo $row['assetId']; ?>','<?php echo $row['assetStatus']; ?>')" id="AssetUpdate<?php echo $row['assetId']; ?>"><?php echo $row['assetStatus']; ?></p>

                              <p class="fc-light-dark-blue font-poppins fw-600 fs-10 m-5" id="download_count_<?php echo $row['assetId']; ?>">Total Downloads : <?php echo $row['assetDownloadCount']; ?></p>

                              <div class="updateThumbnail flex m-y-20" style="width:90%; background-color:var(--clr-4); border-radius:7px;">
                                <form action="./actions/updateAssetThumbnail.php" class="flex m-10" method="POST" enctype="multipart/form-data">
                                    <input name="assetId" value="<?php echo $row['assetId']; ?>" style="display:none;" required>
                                    <input type="file" name="newThumbnail<?php echo $row['assetId']; ?>" style="width: 100%;" required>

                                    <button type="submit" name="Update-Thumbnail" style="width:30px; height:30px; border-radius:7px; background-color:var(--clr-2);"><i class="fas fa-check"></i></button>
                                </form>
                              </div>

                              <div class="bg-clr-4 w-100per flex e-c">
                                   <i class="fa fa-pen cursor-pointer fs-20 hover-bg-dark-blue hover-fc-primary fc-dark-white icon<?php echo $row['assetId']; ?>" onclick="loadContentWithParameter('Update-Asset','<?php echo $row['assetId']; ?>')" style="width: max-content; max-height: 100px; height: 100%; padding: 12px 20px; border-right:1px solid var(--clr-11);"></i>
                                   <a class="download-btn fc-primary hover-fc-primary bg-clr-4" target="_blank" onclick="download_count(this)" id="<?php echo $row['assetId']; ?>" href="<?php echo $row['assetFile']; ?>" download>Download</a>
                              </div>

                         </div>
                    </div>

                    <!-- Asset Card -->

          <?php
               }
          } else {
               echo '<p class="tx-center font-poppins fw-500">🙄 No Assets Found 🙄 </p>';
          }
          ?>
     </div>
</div>