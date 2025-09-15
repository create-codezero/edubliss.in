<?php
session_start();
require_once "../../connect/connectDb/config.php";
require_once "../../connect/function/timeago.php";
$_SESSION['path'] = "Assets";



if (isset($_POST['fromVal']) && isset($_POST['loadCount']) && isset($_POST['sign'])) {
    $lastPost = $_POST['fromVal'];
    $loadCount = $_POST['loadCount'];
    $sign = $_POST['sign'];
    $sql = "SELECT * FROM `78000_assets` WHERE `assetStatus` = 'Public'";

    if(isset($_POST['course']) && !isset($_POST['level']) && !isset($_POST['subject'])){
        $course = $_POST['course'];
        $sql .= " AND `course` = '$course'"; 



    }else if(isset($_POST['course']) && isset($_POST['level']) && !isset($_POST['subject'])){
        $course = $_POST['course'];
        $level = $_POST['level'];
        
        $sql .= " AND `course` = '$course' AND `level` = '$level'";



    }else if(isset($_POST['course']) && isset($_POST['level']) && isset($_POST['subject'])){
        $course = $_POST['course'];
        $level = $_POST['level'];
        $subject = $_POST['subject'];


        
        $sql .= " AND `course` = '$course' AND `level` = '$level' AND `subject` = '$subject'";


    }else if($_POST['searchedQuery']){
        $searchedQuery = $_POST['$searchedQuery'];

        $sql .= " AND `assetName` LIKE '%" . $searchedQuery . "%' OR `assetDescription` LIKE '%" . $searchedQuery . "%' OR `assetTags` LIKE '%" . $searchedQuery . "%'";

    }

    $sql .= "ORDER BY assetId DESC LIMIT $lastPost, $loadCount";

    $result = mysqli_query($link, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            
                    $yes = "";

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
                         <div class="call-to-action m-t-5 block tx-center">
                              <p class="fc-light-dark-blue font-poppins fw-600 fs-10 m-b-10">Uploaded By : <?php echo $row['uploaderName']; ?></p>
                              <p class="fc-light-dark-blue font-poppins fw-600 fs-10 m-5" id="download_count_<?php echo $row['assetId']; ?>">Total Downloads : <?php echo $row['assetDownloadCount']; ?></p>

                              <div class="bg-clr-4 w-100per flex e-c">
                                   <i class="fa fa-heart cursor-pointer fs-20 hover-bg-dark-blue hover-fc-primary fc-dark-white icon<?php echo $row['assetId']; ?>" onclick="like(this)" id="<?php echo $row['assetId']; ?>" style="width: max-content; max-height: 100px; height: 100%; padding: 12px 20px; border-right:1px solid var(--clr-11);" id="hearted"></i>
                                   <input type="hidden" id="like<?php echo $row['assetId']; ?>" >
                                   <a class="download-btn fc-primary hover-fc-primary bg-clr-4" target="_blank" onclick="download_count(this)" id="<?php echo $row['assetId']; ?>">Download</a>
                              </div>

                         </div>
                    </div>

                    <!-- Asset Card -->

                    <?php
        }
    } else {
         echo 0;
    }



}else{
    echo 0;
}