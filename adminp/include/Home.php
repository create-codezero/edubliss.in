<?php
session_start();
require_once "../../connect/connectDb/config.php";
$_SESSION['path'] = "Home";
?>
<div class="flex w-100per">
     <div class="side-bar" style="width: 40%;">
          <img src="../media/Images/img_sign_1.png" alt="" class="img-fluid" style="height: 100%;">
     </div>
     <div class="flex e-c main-bar">
          <div class="form-box">
               <div class="main-box tx-left">
                    <p class="fs-40 tx-left">All set. You're A Admin. Explore Now!</p>
                    <div class="tab-m-y-10"></div>
                    <a class="btn btn-gra-blue tab-m-auto m-y-20" href="javascript:void(0)" onclick="clickOn('side-menu')" style="display:inline-block;">Explore <i class="fas fa-arrow-right"></i></a>
               </div>
          </div>
     </div>
</div>