<?php
session_start();
require_once "../../connect/connectDb/config.php";
$_SESSION['path'] = "Get-Started";
?>

<div class="flex w-100per e-c" id="signIn">
     <div class="flex e-c main-bar p-y-30">
          <div class="form-box">
               <div class="main-box">
                    <form>
                         <p class="fs-40 tx-center fc-secondary">Get Started</p>
                         <p class="fs-10 m-t-10 tx-center fc-secondary">Ask yourself these questions and answer below, this will clarify your youtube niche and also give you suggestions how you can make better content in your niche.</p>

                         <!-- Inputs -->
                         <p class="fs-15 fw-500" style="margin-top: 40px; margin-left: 2px;">Select Niche</p>
                         <div class="input">
                              <select name="Niche" id="Niche">
                                   <option value="Gaming">Gaming</option>
                                   <option value="Cooking">Cooking</option>
                                   <option value="Makeup and beauty">Makeup and beauty</option>
                                   <option value="Fitness">Fitness</option>
                                   <option value="Pets and animals">Pets and animals</option>
                                   <option value="Health">Health</option>
                                   <option value="Finance">Finance</option>
                                   <option value="Business">Business</option>
                                   <option value="Comedy">Comedy</option>
                                   <option value="Music">Music</option>
                                   <option value="Sports">Sports</option>
                                   <option value="Education">Education</option>
                                   <option value="Software Development">Software Development</option>
                                   <option value="Software Tutorials">Software Tutorials</option>
                                   <option value="Facts">Facts</option>
                                   <option value="News">News</option>
                                   <option value="Gadgets & Unboxings">Gadgets & Unboxings</option>
                                   <option value="Product Reviews">Product Reviews</option>
                                   <option value="Storytime Videos">Storytime Videos</option>
                                   <option value="Vlogs">Vlogs</option>
                                   <option value="Travel">Travel</option>
                                   <option value="Roast">Roast</option>
                                   <option value="Life Hacks">Life Hacks</option>
                                   <option value="Food & Restaurant Reviews">Food & Restaurant Reviews</option>
                                   <option value="How To Videos">How To Videos</option>
                                   <option value="Pranks & Spoof">Pranks & Spoof</option>
                                   <option value="Comic and Superhero">Comic and Superhero</option>
                                   <option value="Horror Videos">Horror Videos</option>
                                   <option value="Trailer and Movie Reactions">Trailer and Movie Reactions</option>
                                   <option value="DIY Crafts">DIY Crafts</option>
                                   <option value="Drawing & Sketching Tutorials">Drawing & Sketching Tutorials</option>
                                   <option value="Music Instrument Tutorials">Music Instrument Tutorials</option>
                                   <option value="Music Videos">Music Videos</option>
                                   <option value="Dance Tutorials">Dance Tutorials</option>
                                   <option value="Baby Videos">Baby Videos</option>
                                   <option value="Gaming Montage">Gaming Montage</option>
                                   <option value="Car and Bike News + Reviews">Car and Bike News + Reviews</option>
                                   <option value="Viral Challenges">Viral Challenges</option>
                                   <option value="Interview and Ask Me Anything Videos">Interview and Ask Me Anything Videos</option>
                                   <option value="Digital Marketing & Blogging">Digital Marketing & Blogging</option>
                                   <option value="Yoga & Excercise">Yoga & Excercise</option>
                                   <option value="Helpful Software and Apps">Helpful Software and Apps</option>
                                   <option value="Animated Storie">Animated Stories</option>
                                   <option value="Motivational & Inspirational Videos">Motivational & Inspirational Videos</option>
                                   <option value="Gardening Tips & Tricks">Gardening Tips & Tricks</option>
                                   <option value="Lifestyle Advice">Lifestyle Advice</option>
                                   <option value="Magic Tricks">Magic Tricks</option>
                                   <option value="Book Reviews">Book Reviews</option>
                                   <option value="Top X Lists">Top X Lists</option>
                                   <option value="Public Reactions">Public Reactions</option>
                                   <option value="Online Earning">Online Earning</option>
                                   <option value="Tips & Tricks">Tips & Tricks</option>
                              </select>
                         </div>
                         <!-- 
                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">You're good at</p>
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
                              </select>
                         </div> -->

                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Your Main Skill</p>
                         <div class="input">
                              <select name="MainSkill" id="MainSkill">
                                   <option value="Video Editing">Video Editing</option>
                                   <option value="Audio Editing">Audio Editing</option>
                                   <option value="Video Recording">Video Recording</option>
                                   <option value="Designin">Designing</option>
                                   <option value="Metadata">Metadata</option>
                              </select>
                         </div>

                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Time for Content</p>
                         <div class="input">
                              <select name="ContentTime" id="ContentTime">
                                   <option value="15 - 30 min/daily">15 - 30 min/daily</option>
                                   <option value="30 - 60 min/daily">30 - 60 min/daily</option>
                                   <option value="1 - 1:30 hr/daily">1 - 1:30 hr/daily</option>
                                   <option value="1:30 - 2 hr/daily">1:30 - 2 hr/daily</option>
                                   <option value="2 - 2:30 hr/daily">2 - 2:30 hr/daily</option>
                                   <option value="2:30 - 3 hr/daily">2:30 - 3 hr/daily</option>
                                   <option value="3 - 3:30 hr/daily">3 - 3:30 hr/daily</option>
                                   <option value="3:30 - 4 hr/daily">3:30 - 4 hr/daily</option>
                                   <option value="4 - 4:30 hr/daily">4 - 4:30 hr/daily</option>
                                   <option value="4:30 - 5 hr/daily">4:30 - 5 hr/daily</option>
                                   <option value="5 - 5:30 hr/daily">5 - 5:30 hr/daily</option>
                                   <option value="5:30 - 6 hr/daily">5:30 - 6 hr/daily</option>
                                   <option value="6 - 6:30 hr/daily">6 - 6:30 hr/daily</option>
                                   <option value="6:30 - 7 hr/daily">6:30 - 7 hr/daily</option>
                                   <option value="More than 7hr">More than 7hr</option>
                              </select>
                         </div>

                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">You Consume Most</p>
                         <div class="input">
                              <select name="ConsumeMost" id="ConsumeMost">
                                   <option value="Songs">Songs</option>
                                   <option value="Movies & Web series">Movies & Web series</option>
                                   <option value="Educational Videos">Educational Videos</option>
                                   <option value="Roast & Pranks">Roast & Pranks</option>
                                   <option value="Motivational & Inspirational Videos">Motivational & Inspirational Videos</option>
                                   <option value="Technical Videos">Technical Videos</option>
                                   <option value="Programming">Programming</option>
                                   <option value="Gadgets & Unboxings">Gadgets & Unboxings</option>
                                   <option value="DIY & Lifehacks">DIY & Lifehacks</option>
                                   <option value="Cartoons & Animated Videos">Cartoons & Animated Videos</option>
                                   <option value="Gaming Videos">Gaming Videos</option>
                                   <option value="Business & Entrepreneurship">Business & Entrepreneurship</option>
                                   <option value="Finance">Finance</option>
                                   <option value="Comedy and Shows">Comedy and Shows</option>
                                   <option value="Tips and Tricks">Tips and Tricks</option>
                                   <option value="How to Videos">How to Videos</option>
                                   <option value="Digital Marketing & Social Media">Digital Marketing & Social Media</option>
                              </select>
                         </div>


                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Your Fav. Channel</p>
                         <div class="input">
                              <input type="text" name="FavChannel" id="FavChannel" placeholder="Fav Channel">
                         </div>

                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Second Niche</p>
                         <div class="input">
                              <select name="SecNiche" id="SecNiche">
                                   <option value="Gaming">Gaming</option>
                                   <option value="Cooking">Cooking</option>
                                   <option value="Makeup and beauty">Makeup and beauty</option>
                                   <option value="Fitness">Fitness</option>
                                   <option value="Pets and animals">Pets and animals</option>
                                   <option value="Health">Health</option>
                                   <option value="Finance">Finance</option>
                                   <option value="Business">Business</option>
                                   <option value="Comedy">Comedy</option>
                                   <option value="Music">Music</option>
                                   <option value="Sports">Sports</option>
                                   <option value="Education">Education</option>
                                   <option value="Software Development">Software Development</option>
                                   <option value="Software Tutorials">Software Tutorials</option>
                                   <option value="Facts">Facts</option>
                                   <option value="News">News</option>
                                   <option value="Gadgets & Unboxings">Gadgets & Unboxings</option>
                                   <option value="Product Reviews">Product Reviews</option>
                                   <option value="Storytime Videos">Storytime Videos</option>
                                   <option value="Vlogs">Vlogs</option>
                                   <option value="Travel">Travel</option>
                                   <option value="Roast">Roast</option>
                                   <option value="Life Hacks">Life Hacks</option>
                                   <option value="Food & Restaurant Reviews">Food & Restaurant Reviews</option>
                                   <option value="How To Videos">How To Videos</option>
                                   <option value="Pranks & Spoof">Pranks & Spoof</option>
                                   <option value="Comic and Superhero">Comic and Superhero</option>
                                   <option value="Horror Videos">Horror Videos</option>
                                   <option value="Trailer and Movie Reactions">Trailer and Movie Reactions</option>
                                   <option value="DIY Crafts">DIY Crafts</option>
                                   <option value="Drawing & Sketching Tutorials">Drawing & Sketching Tutorials</option>
                                   <option value="Music Instrument Tutorials">Music Instrument Tutorials</option>
                                   <option value="Music Videos">Music Videos</option>
                                   <option value="Dance Tutorials">Dance Tutorials</option>
                                   <option value="Baby Videos">Baby Videos</option>
                                   <option value="Gaming Montage">Gaming Montage</option>
                                   <option value="Car and Bike News + Reviews">Car and Bike News + Reviews</option>
                                   <option value="Viral Challenges">Viral Challenges</option>
                                   <option value="Interview and Ask Me Anything Videos">Interview and Ask Me Anything Videos</option>
                                   <option value="Digital Marketing & Blogging">Digital Marketing & Blogging</option>
                                   <option value="Yoga & Excercise">Yoga & Excercise</option>
                                   <option value="Helpful Software and Apps">Helpful Software and Apps</option>
                                   <option value="Animated Storie">Animated Stories</option>
                                   <option value="Motivational & Inspirational Videos">Motivational & Inspirational Videos</option>
                                   <option value="Gardening Tips & Tricks">Gardening Tips & Tricks</option>
                                   <option value="Lifestyle Advice">Lifestyle Advice</option>
                                   <option value="Magic Tricks">Magic Tricks</option>
                                   <option value="Book Reviews">Book Reviews</option>
                                   <option value="Top X Lists">Top X Lists</option>
                                   <option value="Public Reactions">Public Reactions</option>
                                   <option value="Online Earning">Online Earning</option>
                                   <option value="Tips & Tricks">Tips & Tricks</option>
                              </select>
                         </div>


                         <p class="fs-10 tx-center m-t-10"> Click “Submit” to submit your detials and get your result.</p>


                         <a class="btn btn-gra-purple cursor-pointer" style="margin: 25px auto 5px;" name="SignUp" onclick="nicheDecider()">Submit</a>

                    </form>
               </div>
          </div>
     </div>
</div>

<!-- This is the dark and light mode query part -->


<div class="sector z-2 pos-fixed flex e-c flex-d-column h-100vh none " id="Niche-Popup" style="top: 0; left:0; background-color: var(--shadow-clr);">


     <div class="form-box bg-clr-1">
          <div class="main-box">
               <div class="block tx-right w-100per" onclick="displaythis('#','Niche-Popup')">
                    <i class="fa fa-times fc-dark-blue fs-20 cursor-pointer hover-fc-primary" aria-hidden="true" style="padding: 15px 20px;"></i>
                    <hr class="bg-dark-blue">
               </div>
               <form class="m-t-20">
                    <p class="fs-30 tx-center fc-secondary" id="mailsentmsg">Your Result</p>
                    <!-- <p class="fs-15 fw-500 mailsenthideit" style="margin-top: 20px; margin-left: 2px;">Select Mode </p> -->
                    <div class="m-t-30" style="max-height: 60vh; height:100%; overflow:scroll;">
                         <p class="fw-400 fs-20">
                              Your main niche is <span class="print-main-niche"></span> and your second niche is <span class="print-second-niche"></span>. As we know many people are already making content on the <span class="print-main-niche"></span> niche thats why i asked you second niche you can try to mix your first and second niche to make a interesting content. You can also try two niches on a time with a formula, the formula is upload 2-3 videos related to your first niche and then upload 1 video related to your second niche. This will also tell you which niche is performing best for you and then you can make more content on that niche which performance best for you.<br>Your main skill is <span class="print-main-skill"></span> try to master it and your content must contains best of main skill like your main skill is <span class="print-main-skill"></span> then <span class="print-main-skill"></span> of your content must be top notch and keep learning other skills because those are also important for your content.<br>You mostly consume <span class="print-most-consumed"></span> and its proved that what you consume most, you like that most. Try to know why you consume it most and if it can be implemented in your video then do it. You have <span class="print-time-for-content"></span> for your content so, use it carefully to make your content better.<br>Your Favorite Channel is <span class="print-fav-youtuber"></span>. So, try to know why it's your favorite channel and also try to do that things on your channel because if you like that channel by some reason, many other people can like your channel by those reasons.
                         </p>
                    </div>

                    <p class="fs-10 tx-center m-t-20 mailsenthideit"> Take a screenshot of this if you want it to keep with you. </p>

                    <!-- 
                         <a class="btn btn-gra-purple cursor-pointer mailsenthideit" style="margin: 20px auto 10px;" onclick="Mode_Query()" href="javascript:void(0)" id="Set">Select</a> -->
               </form>
          </div>
     </div>

</div>