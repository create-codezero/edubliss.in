<?php
session_start();
require_once "../../connect/connectDb/config.php";
$_SESSION['path'] = "Assets";
$searchBoxValue = "";
$lastAsset = 10;
$sql = "SELECT * FROM `78000_assets` WHERE `assetStatus` = 'Public'";
if (isset($_POST['query']) && !empty($_POST['query'])) {
     $query = mysqli_escape_string($link, htmlentities($_POST['query']));
     $searchBoxValue = mysqli_escape_string($link, htmlentities($_POST['query']));
     $sql .= " AND `assetName` LIKE '%" . $query . "%' OR `assetDescription` LIKE '%" . $query . "%' OR `assetTags` LIKE '%" . $query . "%'";
}
$sql .= " ORDER BY assetId DESC"; 
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

     <div class="flex w-100per m-y-20 askQuestionMenuContainer">

          <div class="flex m-l-20 assetFilter" style="overflow-x: auto;">
               <select name="course" class="assetCatSelect" id="course" onchange="optionChanged(this)">
                    <option value disabled selected>Course</option>

                    <?php

                    $courses = "SELECT * FROM `78000_courses` WHERE `courseStatus` = 'Public'";
                    $fireCourses = mysqli_query($link, $courses);

                    if(mysqli_num_rows($fireCourses) > 0){
                              while($courseDetails = mysqli_fetch_assoc($fireCourses)){
                              ?>
                              <option value="<?php echo $courseDetails['courseId'] ?>"><?php echo $courseDetails['courseName'] ?></option>
                              <?php
                              }
                         }

                         ?>
               </select>

               <select name="level" class="assetCatSelect" id="level" onchange="optionChanged(this)" disabled>
                    <option value disabled selected>Level</option>
               </select>

               <select name="subject" class="assetCatSelect" id="subject" onchange="optionChanged(this)" disabled>
                    <option value disabled selected>Subject</option>
               </select>
          </div>

          <div class="askQestionBtn m-r-20" onClick="loadContent('Upload-Asset')"><a href="javascript:void(0)">Upload Material</a></div>
     </div>

     <div class="grid grid-column-4 tab-grid-column-2 mob-grid-column-1 grid-gap-15 m-20 mob-m-10" id="assetContainerMaiNCards">
          <?php
          if (mysqli_num_rows($result) > 0) {
               while ($row = mysqli_fetch_assoc($result)) {
                    $like = "SELECT * FROM `78000_assetheart` WHERE `assetId` = '" . $row['assetId'] . "' AND `userId` = '" . $_SESSION['userDetails'][0] . "'";
                    $resultlike = mysqli_query($link, $like);
                    if (mysqli_num_rows($resultlike) > 0) {
                         $yes = "liked";
                    } else {
                         $yes = "";
                    }

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
                                   <div class="flex e-c">
                                   <p class="fs-20 font-poppins fw-500 m-r-10"><?php echo $row['assetDownloadCount']; ?></p>
                                   <i class="fa fa-heart cursor-pointer fs-20 hover-bg-dark-blue hover-fc-primary fc-dark-white <?php if (!empty($yes)) {
                                                                                                                                       echo "hearted";
                                                                                                                                  } ?> icon<?php echo $row['assetId']; ?>" onclick="<?php if (isset($_SESSION['userDetails'])) {
                                                                                                                                                                                         echo 'like(this)';
                                                                                                                                                                                    } ?>" id="<?php echo $row['assetId']; ?>" style="width: max-content; max-height: 100px; height: 100%; padding: 12px 20px; border-right:1px solid var(--clr-11);" id="hearted"></i>
                                                                                                                                                                                                                 </div>
                                   <input type="hidden" id="like<?php echo $row['assetId']; ?>" value="<?php
                                                                                                         echo mysqli_num_rows($resultlike);
                                                                                                         ?>">
                                   <a class="download-btn fc-primary hover-fc-primary bg-clr-4" target="_blank" onclick="download_count(this)" id="<?php echo $row['assetId']; ?>" href="<?php echo $row['assetFile']; ?>" download>Download</a>
                              </div>

                         </div>
                    </div>


                    <!-- Asset Card -->

          <?php
               }
          } else {
               echo '<p class="tx-center font-poppins fw-500">🙄 No Materials Found 🙄 </p>';
          }
          ?>
                    <div id="EndLoad"></div>

     </div>
     <div id="End" class="p-y-10" style="display: block; width:100% !Important;"></div>
</div>

<script>
     $(document).ready(function() {
          let fromVal = <?php echo $lastAsset; ?>;
          let postEnd = "False";
          const endContainer = document.getElementById('End');
          const endLoadContainer = document.getElementById('EndLoad');

          window.addEventListener('scroll', () => {
               const {
                    scrollHeight,
                    scrollTop,
                    clientHeight
               } = document.documentElement;

               if (scrollTop + clientHeight >= scrollHeight) {
                    if (postEnd == "False") {

                         let course = $("#course").val();
                         let level = $("#level").val();
                         let subject = $("#subject").val();
                         let search_text = $(`#searchBox`).val();


                         if(course != null && level == null && subject == null){
                              $.post('./pages/More-Assets.php', {
                                   fromVal: fromVal,
                                   loadCount: 49,
                                   sign: "!=",
                                   course:course
                              },
                              function(data, status) {
                                   if (data == 0) {
                                        postEnd = "True";
                                        return;
                                   } else {
                                        endLoadContainer.insertAdjacentHTML('beforebegin', data);
                                   }
                              });

                         }else if(course != null && level != null && subject == null){
                              $.post('./pages/More-Assets.php', {
                                   fromVal: fromVal,
                                   loadCount: 49,
                                   sign: "!=",
                                   course:course,
                                   level:level
                              },
                              function(data, status) {
                                   if (data == 0) {
                                        postEnd = "True";
                                        return;
                                   } else {
                                        endLoadContainer.insertAdjacentHTML('beforebegin', data);
                                   }
                              });

                         }else if(course != null && level != null && subject != null){
                              $.post('./pages/More-Assets.php', {
                                   fromVal: fromVal,
                                   loadCount: 49,
                                   sign: "!=",
                                   course:course,
                                   level:level,
                                   subject:subject
                              },
                              function(data, status) {
                                   if (data == 0) {
                                        postEnd = "True";
                                        return;
                                   } else {
                                        endLoadContainer.insertAdjacentHTML('beforebegin', data);
                                   }
                              });

                         }else if(search_text != null){
                              $.post('./pages/More-Assets.php', {
                                   fromVal: fromVal,
                                   loadCount: 49,
                                   sign: "!=",
                                   searchedQuery:search_text
                              },
                              function(data, status) {
                                   if (data == 0) {
                                        postEnd = "True";
                                        return;
                                   } else {
                                        endLoadContainer.insertAdjacentHTML('beforebegin', data);
                                   }
                              });

                              
                         }else{
                              $.post('./pages/More-Assets.php', {
                                   fromVal: fromVal,
                                   loadCount: 49,
                                   sign: "!="
                              },
                              function(data, status) {
                                   if (data == 0) {
                                        postEnd = "True";
                                        return;
                                   } else {
                                        endLoadContainer.insertAdjacentHTML('beforebegin', data);
                                   }
                              });
                         }

                         
                         fromVal = fromVal + 50;
                    }

               }
          });
     });
     function optionChanged(e){
          if(e.id == "course"){
               $(`#loading`).toggleClass("none");
               $("#searchBoxConainer").prop("class","none");
               let course = $("#course").val();
               $.post('./actions/assetsFilter.php', {
                         course: course
                    },
                    function(data, status) {
                         if (data.length != "") {
                              $("#level").prop("disabled", false);
                              document.getElementById("level").innerHTML = data;
                         }
                    });

               $.post('./actions/assetFilteredContent.php', {
                         course: course
                    },
                    function(data, status) {
                         if (data.length != "") {
                              document.getElementById("assetContainerMaiNCards").innerHTML = data;
                              $(`#loading`).toggleClass("none");
                         }
                    });

          }else if(e.id == "level"){
               $(`#loading`).toggleClass("none");
               $("#searchBoxConainer").prop("class","none");
               let course = $("#course").val();
               let level = $("#level").val();

               $.post('./actions/assetsFilter.php', {
                         course: course,
                         level:level
                    },
                    function(data, status) {
                         if (data.length != "") {
                              $("#subject").prop("disabled", false);
                              document.getElementById("subject").innerHTML = data;
                         }
                    });

               $.post('./actions/assetFilteredContent.php', {
                         course: course,
                         level:level
                    },
                    function(data, status) {
                         if (data.length != "") {
                              document.getElementById("assetContainerMaiNCards").innerHTML = data;
                              $(`#loading`).toggleClass("none");
                         }
                    });

          }else if(e.id == "subject"){
               $(`#loading`).toggleClass("none");
               $("#searchBoxConainer").prop("class","none");
               let course = $("#course").val();
               let level = $("#level").val();
               let subject = $("#subject").val();

               $.post('./actions/assetsFilter.php', {
                         course: course,
                         level:level,
                         subject:subject
                    },
                    function(data, status) {
                         if (data.length != "") {
                              // what to do after all three selections
                         }
                    });

               $.post('./actions/assetFilteredContent.php', {
                         course: course,
                         level:level,
                         subject:subject
                    },
                    function(data, status) {
                         if (data.length != "") {
                              document.getElementById("assetContainerMaiNCards").innerHTML = data;
                              $(`#loading`).toggleClass("none");
                         }
                    });

          }
     }
</script>