<?php
session_start();
require_once "../../connect/connectDb/config.php";
$_SESSION['path'] = "Contact-Us";
?>

<!-- contact us  -->

<div class="flex w-100per e-c" id="signIn">
     <div class="flex m-t-20 mainBarConatiner" style="max-width:1600px; width:95%;">
          <div class="side-bar" style="width: 40%;">
               <img src="../media/Images/newFormSideGraphic.png" alt="" class="img-fluid" style="border-radius:15px 0 0 15px; height: 100%;">
          </div>
          <div class="flex e-c main-bar">
               <div class="form-box">
                    <div class="main-box">
                         <form action="../contact-us/contact.php" method="POST">
                              <p class="fs-40 tx-center">Contact Us</p>

                              <!-- Inputs -->
                              <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Full Name</p>
                              <div class="input">
                                   <input type="text" name="Name" id="Name" placeholder="Full Name" required>
                              </div>

                              <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">E-mail</p>
                              <div class="input">
                                   <input type="Email" name="Email" id="email" placeholder="E-mail" required>
                              </div>

                              <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Phone</p>
                              <div class="input">
                                   <input type="number" name="PhoneNum" id="phoneNum" placeholder="Phone" required>
                              </div>

                              <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Message</p>
                              <div class="input">
                                   <textarea style="line-height:20px; margin-top:5px; border-radius: 0px;" name="Message" id="message" rows="5"></textarea>
                              </div>




                              <p class="fs-10 tx-center m-t-10"> Reply will be sended to your mail. </p>


                              <button type="submit" class="btn btn-gra-purple cursor-pointer" style="margin: 25px auto 5px;" name="contact_submit">Send</button>
                         </form>
                    </div>
               </div>
          </div>
     </div>
</div>