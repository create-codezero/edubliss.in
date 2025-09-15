<?php
session_start();
require_once '../connect/connectDb/config.php';
if (!isset($_SESSION['admin-panel'])) {
     header('location: ./admin-login.php');
}

if (isset($_GET)) {
     foreach ($_GET as $data => $val) {
          $title = mysqli_real_escape_string($link, $data);
          $title = str_replace('/', '', $title);
 
          if (strpos($title, 'edit-Email-') !== false) {
               $vidId = str_replace('edit-Email-', '', $title);
               $title = str_replace('edit-Email-', 'Edit-Email.php?id=', $title);
          } else if (strpos($title, 'Edit-Email-') !== false) {
               $vidId = str_replace('Edit-Email-', '', $title);
               $title = str_replace('Edit-Email-', 'Edit-Email.php?id=', $title);
          } else if (strpos($title, 'new-Email-Sender-') !== false) {
               $vidId = str_replace('new-Email-Sender-', '', $title);
               $title = str_replace('new-Email-Sender-', 'New-Email-Sender.php?id=', $title);
          } else if (strpos($title, 'New-Email-Sender-') !== false) {
               $vidId = str_replace('New-Email-Sender-', '', $title);
               $title = str_replace('New-Email-Sender-', 'New-Email-Sender.php?id=', $title);
          }else if(strpos($title, 'Assignment-Subject_') !== false){
               $aWeekId = str_replace('Assignment-Subject_', '', $title);
               $title = str_replace('Assignment-Subject_', 'Assignment-Subject.php?assignment=', $title);
               
          }else if(strpos($title, 'Add-Assignment-Subject_') !== false){
               $aWeekId = str_replace('Add-Assignment-Subject_', '', $title);
               $title = str_replace('Add-Assignment-Subject_', 'Add-Assignment-Subject.php?assignment=', $title);

          }else if(strpos($title, 'Course-Level_') !== false){
               $aWeekId = str_replace('Course-Level_', '', $title);
               $title = str_replace('Course-Level_', 'Course-Level.php?course=', $title);
               
          }else if(strpos($title, 'Add-Course-Level_') !== false){
               $aWeekId = str_replace('Add-Course-Level_', '', $title);
               $title = str_replace('Add-Course-Level_', 'Add-Course-Level.php?course=', $title);

          }else if(strpos($title, 'Channel-Videos_') !== false){
               $aWeekId = str_replace('Channel-Videos_', '', $title);
               $title = str_replace('Channel-Videos_', 'Channel-Videos.php?channel=', $title);
               
          }else if(strpos($title, 'Add-Channel-Video_') !== false){
               $aWeekId = str_replace('Add-Channel-Video_', '', $title);
               $title = str_replace('Add-Channel-Video_', 'Add-Channel-Video.php?channel=', $title);
               
          }else if(strpos($title, 'Update-Asset_') !== false){
               $aWeekId = str_replace('Update-Asset_', '', $title);
               $title = str_replace('Update-Asset_', 'Update-Asset.php?assetId=', $title);
               
          }else if(strpos($title, 'Add-Question_') !== false){
               $getData = str_replace('Add-Question_', '', $title);
               $getDataArray = explode("_",$getData);
               $aWeekId = $getDataArray[0];
               $aSubjectId = $getDataArray[1];

               $furl = 'Add-Question.php?assignment='.$aWeekId.'&subject='. $aSubjectId;

               $title = $furl;
          }else if(strpos($title, 'Level-Subject_') !== false){
               $getData = str_replace('Level-Subject_', '', $title);
               $getDataArray = explode("_",$getData);
               $aWeekId = $getDataArray[0];
               $aSubjectId = $getDataArray[1];

               $furl = 'Level-Subject.php?course='.$aWeekId.'&level='. $aSubjectId;

               $title = $furl;
          }else if(strpos($title, 'Add-Level-Subject_') !== false){
               $getData = str_replace('Add-Level-Subject_', '', $title);
               $getDataArray = explode("_",$getData);
               $aWeekId = $getDataArray[0];
               $aSubjectId = $getDataArray[1];

               $furl = 'Add-Level-Subject.php?course='.$aWeekId.'&level='. $aSubjectId;

               $title = $furl;
          }else if(strpos($title, 'Add-Multiple-Question_') !== false){
               $getData = str_replace('Add-Multiple-Question_', '', $title);
               $getDataArray = explode("_",$getData);
               $aWeekId = $getDataArray[0];
               $aSubjectId = $getDataArray[1];
               $noOfQuestions = $getDataArray[2];

               $furl = 'Add-Multiple-Question.php?assignment='.$aWeekId.'&subject='.$aSubjectId.'&noOfQuestions='.$noOfQuestions;

               $title = $furl;
          }else if(strpos($title, 'Add-Multiple-Materials') !== false){
               $getData = str_replace('Add-Multiple-Materials_', '', $title);
               $getDataArray = explode("_",$getData);
               $course = $getDataArray[0];
               $level = $getDataArray[1];
               $subject = $getDataArray[2];
               $noOfMaterials = $getDataArray[3];

               $furl = 'Add-Multiple-Materials.php?course='.$course.'&level='.$level.'&subject='.$subject.'&noOfMaterials='.$noOfMaterials;

               $title = $furl;
          }


          $firstLetter = substr($title, 0, 1);
          $firstLetter = strtoupper($firstLetter);
          $length = strlen($title) - 1;
          $otherLetter = substr($title, 1, $length);
          $content = $firstLetter . $otherLetter;
     }
}

if (empty($data)) {
     if (isset($_SESSION['adminDPage']) && !empty($_SESSION['adminDPage'])) {
          $content = $_SESSION['adminDPage'];
     } else {
          $content = "Home";
     }
}

?>
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Admin Panel</title>
     <link rel="stylesheet" href="../css/Sass/<?php echo $cssfile; ?>">
     <link rel="icon" href="../media/images/l_c.png">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

     <div class="header-box pos-fixed z-1 w-100per">
          <div class="header">
               <div class="branding">
                    <a href="javascript:void(0)" onclick="clickOn('side-menu')"><img src="../media/Icons/menu.png" alt="Logo" class="menu" style="max-width:45px; min-width:45px;"></a>
                    <a href="./Home"><img src="../media/Icons/logo.png" style="height:45px;" alt="Logo" class="logo"></a>
                    <a href="./Home" class="m-l-10 img-fluid">
                         <img src="../media/Icons/edubliss.png" style="height:35px;" alt="EduBliss"  class="edubliss">
                    </a>
               </div>
               <div class="header-menu flex flex-y-center">
                    <a class="btn btn-gra-blue" href="./actions/Signout.php" title="Sign In">
                         Sign Out
                    </a>
               </div>
          </div>
     </div>
     <div class="block" style="height: 70px;"></div>

     <!-- CONTENT WILL LOAD IN THIS DIV -->
     <div class="container d-flex-center" style="flex-direction:column;" id="Content">
          <!-- CONTENT WILL LOAD UPPER DIV -->
     </div>

     <div class="side-menu bg-white h-100vh pos-fixed none" id="side-menu">

          <div class="menu m-t-80">
               <ul>
                    <p class="normal-tx fw-500 fc-dark-blue">Your Menu.</p>
                    <div class="bg-primary block m-10" style="height: 2px;"></div>

                    <li><a href="javascript:void(0)" onclick="clickedBtn('Home')" class="nnmenu fc-dark-blue font-poppins fs-20" id="Home"><i class="fas fa-home"></i> Home </a></li>

                    <li><a href="javascript:void(0)" onclick="clickedBtn('Material-Categories')" class="nnmenu fc-dark-blue font-poppins fs-20" id="Upload-Assets"><i class="fas fa-cube"></i> Material Categories </a></li>

                    <li><a href="javascript:void(0)" onclick="clickedBtn('Edit-Assets')" class="nnmenu fc-dark-blue font-poppins fs-20" id="Edits-Assets"><i class="fas fa-cube"></i> Edit Materials </a></li>

                    <li><a href="javascript:void(0)" onclick="clickedBtn('Assignment')" class="nnmenu fc-dark-blue font-poppins fs-20" id="Assignment"><i class="fas fa-book"></i> Assignment </a></li>

                    <li><a href="javascript:void(0)" onclick="clickedBtn('WA-Groups')" class="nnmenu fc-dark-blue font-poppins fs-20" id="WA-Groups"><i class="fab fa-whatsapp"></i> WA-Groups </a></li>

                    <li><a href="javascript:void(0)" onclick="clickedBtn('Channels')" class="nnmenu fc-dark-blue font-poppins fs-20" id="Channels"><i class="fas fa-book"></i> Channels </a></li>

                    <li><a href="javascript:void(0)" onclick="clickedBtn('Playlists')" class="nnmenu fc-dark-blue font-poppins fs-20" id="Playlists"><i class="fas fa-book"></i> Playlists </a></li>

                    <li><a href="javascript:void(0)" onclick="clickedBtn('Questions')" class="nnmenu fc-dark-blue font-poppins fs-20" id="Questions"><i class="fas fa-question"></i> Questions </a></li>

                    <li><a href="javascript:void(0)" onclick="clickedBtn('Contacts')" class="nnmenu fc-dark-blue font-poppins fs-20" id="Upload-Assets"> <i class="fa fa-handshake" aria-hidden="true"></i> Contacts </a></li>

                    <li><a href="javascript:void(0)" onclick="clickedBtn('User-Assets')" class="nnmenu fc-dark-blue font-poppins fs-20" id="Upload-Assets"><i class="fa fa-cube" aria-hidden="true"></i> User Material </a></li>

                    <li><a href="javascript:void(0)" onclick="clickedBtn('Calculators')" class="nnmenu fc-dark-blue font-poppins fs-20" id="Calculators"><i class="fa fa-calculator" aria-hidden="true"></i> Calculators </a></li>

                    <li><a href="javascript:void(0)" onclick="clickedBtn('Users')" class="nnmenu fc-dark-blue font-poppins fs-20" id="Upload-Assets"><i class="fa fa-user" aria-hidden="true"></i> Users </a></li>

                    <li><a href="javascript:void(0)" onclick="clickedBtn('Emails')" class="nnmenu fc-dark-blue font-poppins fs-20" id="Email-Sender"><i class="fas fa-mail-bulk"></i> Emails </a></li>

                    <div class="bg-primary block m-10" style="height: 2px;"></div>
                    <p class="normal-tx fw-500 fc-dark-blue">I have done my Work.</p>
                    <li><a href="../user/auth/signout/" class="fc-dark-blue font-poppins fs-20"><i class="fas fa-sign-out-alt    "></i> Sign Out</a></li>
          </div>

     </div>
     <script src="../js/actions.js"></script>
     <script>
          $(document).ready(function() {

               <?php
               if (strpos($content, '.php') !== false) {
                    echo '$("#Content").load("./include/' . $content . '");';
               } else {
                    echo '$("#Content").load("./include/' . $content . '.php");';
               }
               ?>
          });

          window.addEventListener('popstate', function() {
               document.location.reload();
          });

          function clickOn(elementId) {
               $(`#${elementId}`).toggleClass("none");
          }

          function clickedBtn(btnClicked) {
               $(`#Content`).load(`./include/${btnClicked}.php`);
               clickOn('side-menu');

               const state = {
                    'page_id': 1,
                    'user_id': 5
               };
               const title = '';
               const url = `${btnClicked}`;

               history.pushState(state, title, url);
          }

          function loadContent(e) {
               $(`#Content`).load(`./include/${e}.php`);

               const state = {
                    'page_id': 1,
                    'user_id': 5
               };
               const title = '';
               const url = `${e}`;

               history.pushState(state, title, url);
          }

          function loadContentWithParameter(e,f) {

               if(e == "Assignment-Subject" || e == "Add-Assignment-Subject"){
                    $(`#Content`).load(`./include/${e}.php?assignment=${f}`);
               }else if(e == "Course-Level" || e == "Add-Course-Level"){
                    $(`#Content`).load(`./include/${e}.php?course=${f}`);
               }else if(e == "Channel-Videos" || e == "Add-Channel-Video"){
                    $(`#Content`).load(`./include/${e}.php?channel=${f}`);
               }else if(e == "Update-Asset"){
                    $(`#Content`).load(`./include/${e}.php?assetId=${f}`);
               }
               

               const state = {
                    'page_id': 1,
                    'user_id': 5
               };
               const title = '';
               const url = `${e}_${f}`;

               history.pushState(state, title, url);
          }

          function loadContentWithParameter2(e,f,g) {

               if(e == "Add-Question"){
                    $(`#Content`).load(`./include/${e}.php?assignment=${f}&subject=${g}`);
               }else if(e == "Level-Subject" || e == "Add-Level-Subject"){
                    $(`#Content`).load(`./include/${e}.php?course=${f}&level=${g}`);
               }else if(e == "Ans-A-Questions"){
                    $(`#Content`).load(`./include/${e}.php?assignment=${f}&subject=${g}`);
               }

               const state = {
                    'page_id': 1,
                    'user_id': 5
               };
               const title = '';
               const url = `${e}_${f}_${g}`;

               history.pushState(state, title, url);
          }

          function loadContentWithParameter3(e,f) {
               $(`#Content`).load(`./include/${e}.php?quesId=${f}`);

               const state = {
                    'page_id': 1,
                    'user_id': 5
               };
               const title = '';
               const url = `${e}`;

               history.pushState(state, title, url);
          }

          function loadContentWithParameter4(e,f,g) {
               
               let noOfQuestions = $("#noOfQuestions").val();
               $(`#Content`).load(`./include/${e}.php?assignment=${f}&subject=${g}&noOfQuestions=${noOfQuestions}`);

               const state = {
                    'page_id': 1,
                    'user_id': 5
               };
               const title = '';
               const url = `${e}_${f}_${g}_${noOfQuestions}`;

               history.pushState(state, title, url);
          }

          function loadContentWithParameter5(e,f,g,h,j) {
               
               let i;

               if(e == "Add-Multiple-Materials"){
                    i = $(`#noOfMaterials${j}`).val();
                    $(`#Content`).load(`./include/${e}.php?course=${f}&level=${g}&subject=${h}&noOfMaterials=${i}`);
               }
               

               const state = {
                    'page_id': 1,
                    'user_id': 5
               };
               const title = '';
               const url = `${e}_${f}_${g}_${h}_${i}`;

               history.pushState(state, title, url);
          }


          

          function loadMail(e) {
               $(`#Content`).load(`./include/New-Email-Sender.php?id=${e}`);

               const state = {
                    'page_id': 1,
                    'user_id': 5
               };
               const title = '';
               const url = `New-Email-Sender-${e}`;

               history.pushState(state, title, url);
          }

          function editLoad(e, f) {
               $(`#Content`).load(`./include/${e}.php?id=${f}`);

               const state = {
                    'page_id': 1,
                    'user_id': 5
               };
               const title = '';
               const url = `${e}-${e}`;

               history.pushState(state, title, url);
          }

          function approveAsset(e) {

               $.post('./actions/changeStatus.php', {
                         changeStatus: "set",
                         i: e,
                         w: "Asset"
                         },
                         function(data, status) {

                              if (data == "done") {
                                   $(`#Content`).load('./include/User-Assets.php');

                                   const state = {
                                        'page_id': 1,
                                        'user_id': 5
                                   };
                                   const title = '';
                                   const url = `User-Assets`;

                                   history.pushState(state, title, url);
                              }

                         });

               
          }

          function triggerClick(e) {
               let id = e;
               
               document.querySelector(`#${id}`).click();

               if(e == "newChannelLogo"){
                    $("#upload-channelLogo-icon").toggleClass("none");
               }
               
          }

          

          function changeStatus(w,i,c){
               
               let n;

               let status = ['Admin','Public','Deleted'];

               status.forEach(e => {
                    if(e == c){
                         n = status.indexOf(e);
                         
                    }
               });

               let newn;
               if(n == 2){
                     newn = 0;
               }else{
                    newn = n+1;
               }

               newn = status[newn];

               if(newn != ''){

                    $.post('./actions/changeStatus.php', {
                         changeStatus: "set",
                         i: i,
                         w: w,
                         newn: newn
                         },
                         function(data, status) {
                              if (data == "done") {
                                   let ele = document.getElementById(`${w}${i}`);
                                   ele.innerHTML = newn;
                                   ele.setAttribute("onClick",`changeStatus('${w}','${i}','${newn}')`);
                              }
                         });


                    
               }
          }
     </script>
</body>

</html>