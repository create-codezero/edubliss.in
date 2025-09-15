<?php
session_start();
$_SESSION['adminDPage'] = "Email-Sender";

if (isset($_GET['id'])) {
?>
     <div class="flex w-100per p-y-50 e-c">

          <div class="form-box">
               <div class="main-box">
                    <h1 class="fs-40 tx-center">Email Sender</h1>

                    <form action="./actions/newEmailSender.php" class="e-center" method="POST" enctype="multipart/form-data">
                         <input type="text" value="<?php echo $_GET['id']; ?>" name="mailId" class="none" required>

                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Send to</p>
                         <div class="input">
                              <textarea name="sendto" id="sendto" rows="5"></textarea>
                         </div>

                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Default Header</p>
                         <div class="input" title="Select select whether want to show default header or not.">
                              <select name="defaultHeader" id="defaultHeader" required>
                                   <option value="Yes">Yes</option>
                                   <option value="No">No</option>
                              </select>
                         </div>

                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Send to User</p>
                         <div class="input" title="Select you want to send user or not.">
                              <select name="sendToUser" id="SendToUser" required>
                                   <option value="No">No</option>
                                   <option value="Yes">Yes</option>
                              </select>
                         </div>

                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Subject</p>
                         <div class="input">
                              <input type="text" id="Subject" name="subject" placeholder="Subject" required>
                         </div>

                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Image</p>
                         <div class="input">
                              <input type="file" id="Mail_Image" name="Mail_Image">
                         </div>

                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Image Link</p>
                         <div class="input">
                              <input type="text" id="ImageLink" name="imageLink" placeholder="Image Link">
                         </div>

                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">CTA Alignment</p>
                         <div class="input" title="Select you want to send user or not.">
                              <select name="ctaAlignment" id="ctaAlignment" required>
                                   <option value="left">Left</option>
                                   <option value="center">Center</option>
                                   <option value="right">Right</option>
                              </select>
                         </div>

                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Btn 1</p>
                         <div class="input">
                              <input type="text" id="Btn1" name="btn1" placeholder="Btn 1">
                         </div>

                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Link 1</p>
                         <div class="input">
                              <input type="text" id="Link1" name="link1" placeholder="Link 1">
                         </div>


                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Btn 2</p>
                         <div class="input">
                              <input type="text" id="Btn2" name="btn2" placeholder="Btn 2">
                         </div>

                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Link2</p>
                         <div class="input">
                              <input type="text" id="Link2" name="link2" placeholder="Link 2">
                         </div>


                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Default Footer</p>
                         <div class="input" title="Select select whether want to show default footer or not.">
                              <select name="defaultFooter" id="defaultFooter" required>
                                   <option value="Yes">Yes</option>
                                   <option value="No">No</option>
                              </select>
                         </div>

                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Footer Alignment</p>
                         <div class="input" title="Select you want to send user or not.">
                              <select name="footerAlignment" id="footerAlignment" required>
                                   <option value="center">Center</option>
                                   <option value="left">Left</option>
                                   <option value="right">Right</option>
                              </select>
                         </div>



                         <p style="font-size: 12px; font-weight: 500;" class="m-y-20 tx-center">This mail will be sended to everyone you select.</p>

                         <button class="btn btn-gra-purple m-auto" type="submit" name="sendEmails">Send</button>
                    </form>


               </div>
          </div>

     </div>

<?php
} else {
     echo '<p class="fs-30 tx-center m-t-30">Please go back and select a Mail before sending it to anyone.</p>';
}

?>