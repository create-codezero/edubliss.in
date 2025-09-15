<?php
session_start();
require_once '../../connect/connectDb/config.php';

?>

<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Team</title>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.appear/0.3.3/jquery.appear.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
     <link rel="stylesheet" href="../../css/Sass/<?php echo $cssfile; ?>" />

     <!-- Global site tag (gtag.js) - Google Analytics -->

     <link rel="icon" href="../../media/Images/LOGO_CIRCLE.png">
</head>
<body>
<div class="header-box " style="border-bottom:2px solid var(--clr-4);">
          <div class="header">
               <div class="branding">
                    <a href="#"><img src="../../media/Icons/logo.png" style="height:45px;" alt="Logo" class="logo"></a>
                    <a href="#" class="m-l-10 img-fluid">
                         <img src="../../media/Icons/edubliss.png" style="height:35px;" alt="EduBliss">
                    </a>
               </div>
               <div class="header-menu">
                    <a class="btn btn-gra-blue" href="/user/auth/signin/">
                         Sign In
                    </a>
               </div>
          </div>
     </div>
<div id="Content">

<div class="sector w-100per tx-center m-t-30">
    <p class="font-poppins fs-50 fw-600">Our Team</p>
</div>

    <div class="sector w-100per m-t-20">
        <div class="grid grid-column-5 tab-grid-column-2 mob-grid-column-1 grid-gap-15 m-20 mob-m-10">

            <div class="w-100per asset-card">
                        <div class="thumbnail p-20">
                            <img src="../../data/team/profilePhoto/Atharva.png" alt="Atharva Patil" class="img-fluid">
                        </div>
                         <div class="content tx-center">
                         </div>
                         <div class="call-to-action m-t-5 block tx-center">
                              <div class="bg-clr-4 w-100per flex e-c cursor-pointer" onclick="details(this)" id="1">
                                    <a class="download-btn fc-primary hover-fc-primary bg-clr-4">
                                        <div class="w-100per tx-left fs-20">
                                            Atharva Patil
                                        </div>
                                        <div class="w-100per tx-left fs-10">
                                            Content Manager
                                        </div>
                                    </a>

                                   <i class="fa fa-arrow-down cursor-pointer fs-20 hover-bg-dark-blue hover-fc-primary fc-dark-white  icon38" id="38" style="width: max-content; max-height: 100px; height: 100%; padding: 12px 20px; border-right:1px solid var(--clr-11);"></i>
                                </div>

                                <div class="bg-clr-4 w-100per flex e-c none" id="about1">
                                <pre style="text-align: left; margin:0; white-space: pre-wrap; white-space: -moz-pre-wrap; white-space: -pre-wrap; white-space: -o-pre-wrap; word-wrap: break-word;" class="flex m-20"><p class="fc-dark-blue font-poppins flex m-20" style="font-size: 15px;">Age: 17
Current Status: Student at IITM

Eager to learn new things.
I love the concept of building new web application and sites although having near to minimal knowledge about it.

My Quote:
Life is awesome, live it to your fullest. Take pressure, hold pride in yourself and about what you. Improve yourself day by day, even if little by little, surely but slowly life will start taking amazing turns for you. Now, it's your turn ignite your life by joining us.


Contact me at:
9766743094
atharvaanilp@gmail.com </p></pre>
                                    
                                </div>

                                <div class="w-100per m-y-10 none" id="connect1">
                                    <div class="flex mob-m-10 tab-m-y-20 w-100per flex-d-column e-c">
                                        <p class="sub-heading fc-primary">Connect</p>
                                        <hr class="m-y-10 w-75per tx-center">
                                        <div class="flex" id="footer-social-media">
                                            <div class="bg-footer-icon">
                                                <a href="javascript:void(0)" target="_blank"><i class="fab fa-facebook m-10 fc-secondary"></i></a>
                                            </div>

                                            <div class="bg-footer-icon m-l-10">
                                                <a href="javascript:void(0)" target="_blank"><i class="fab fa-whatsapp m-10 fc-secondary"></i></a>
                                            </div>

                                            <div class="bg-footer-icon m-l-10">
                                                <a href="javascript:void(0)" target="_blank"><i class="fab fa-twitter m-10 fc-secondary"></i></a>
                                            </div>

                                            <div class="bg-footer-icon m-l-10">
                                                <a href="javascript:void(0)" target="_blank"><i class="fas fa-envelope m-10 fc-secondary"></i></a>
                                            </div>

                                            <div class="bg-footer-icon m-l-10">
                                                <a href="javascript:void(0)" target="_blank"><i class="fab fa-instagram m-10 fc-secondary"></i></a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                          </div>
            </div>

            <div class="w-100per asset-card">
                        <div class="thumbnail p-20">
                            <img src="../../data/team/profilePhoto/Ridhi.png" alt="Ridhi Sehgal" class="img-fluid">
                        </div>
                         <div class="content tx-center">
                         </div>
                         <div class="call-to-action m-t-5 block tx-center">
                              <div class="bg-clr-4 w-100per flex e-c cursor-pointer" onclick="details(this)" id="2">
                                    <a class="download-btn fc-primary hover-fc-primary bg-clr-4">
                                        <div class="w-100per tx-left fs-20">
                                            Ridhi Sehgal
                                        </div>
                                        <div class="w-100per tx-left fs-10">
                                            Content Creator
                                        </div>
                                    </a>

                                   <i class="fa fa-arrow-down cursor-pointer fs-20 hover-bg-dark-blue hover-fc-primary fc-dark-white  icon38" id="38" style="width: max-content; max-height: 100px; height: 100%; padding: 12px 20px; border-right:1px solid var(--clr-11);"></i>
                                </div>
                          </div>

                          <div class="bg-clr-4 w-100per flex e-c none" id="about2">
                                <pre style="text-align: left; margin:0; white-space: pre-wrap; white-space: -moz-pre-wrap; white-space: -pre-wrap; white-space: -o-pre-wrap; word-wrap: break-word;" class="flex m-20"><p class="fc-dark-blue font-poppins flex m-20" style="font-size: 15px;">About - Pursuing BS in Data Science degree from IIT Madras | Lawn Tennis player | Graphic Designer | Web developer (Intermediate) | UI-UX designer | Intermediate Pianist 🎾✅😀🎹 

Location - Gurugram, Haryana, India
Age - 17 years
</p></pre>
                                    
                          </div>
                          <div class="w-100per m-y-10 none" id="connect2">
                                    <div class="flex mob-m-10 tab-m-y-20 w-100per flex-d-column e-c">
                                        <p class="sub-heading fc-primary">Connect</p>
                                        <hr class="m-y-10 w-75per tx-center">
                                        <div class="flex" id="footer-social-media">
                                            <div class="bg-footer-icon">
                                                <a href="javascript:void(0)" target="_blank"><i class="fab fa-facebook m-10 fc-secondary"></i></a>
                                            </div>

                                            <div class="bg-footer-icon m-l-10">
                                                <a href="javascript:void(0)" target="_blank"><i class="fab fa-whatsapp m-10 fc-secondary"></i></a>
                                            </div>

                                            <div class="bg-footer-icon m-l-10">
                                                <a href="javascript:void(0)" target="_blank"><i class="fab fa-twitter m-10 fc-secondary"></i></a>
                                            </div>

                                            <div class="bg-footer-icon m-l-10">
                                                <a href="javascript:void(0)" target="_blank"><i class="fas fa-envelope m-10 fc-secondary"></i></a>
                                            </div>

                                            <div class="bg-footer-icon m-l-10">
                                                <a href="javascript:void(0)" target="_blank"><i class="fab fa-instagram m-10 fc-secondary"></i></a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
            </div>

            <div class="w-100per asset-card">
                        <div class="thumbnail p-20">
                            <img src="../../data/team/profilePhoto/Sameer.png" alt="Sameer Thakur" class="img-fluid">
                        </div>
                         <div class="content tx-center">
                         </div>
                         <div class="call-to-action m-t-5 block tx-center">
                              <div class="bg-clr-4 w-100per flex e-c cursor-pointer" onclick="details(this)" id="3">
                                    <a class="download-btn fc-primary hover-fc-primary bg-clr-4">
                                        <div class="w-100per tx-left fs-20">
                                            Sameer Thakur
                                        </div>
                                        <div class="w-100per tx-left fs-10">
                                            Content Provider
                                        </div>
                                    </a>

                                   <i class="fa fa-arrow-down cursor-pointer fs-20 hover-bg-dark-blue hover-fc-primary fc-dark-white  icon38" id="38" style="width: max-content; max-height: 100px; height: 100%; padding: 12px 20px; border-right:1px solid var(--clr-11);"></i>
                                </div>

                                <div class="bg-clr-4 w-100per flex e-c none" id="about3">
                                <pre style="text-align: left; margin:0; white-space: pre-wrap; white-space: -moz-pre-wrap; white-space: -pre-wrap; white-space: -o-pre-wrap; word-wrap: break-word;" class="flex m-20"><p class="fc-dark-blue font-poppins flex m-20" style="font-size: 15px;">As a sophomore student at IIT Madras pursuing a BS in Data Science and Applications, I've cultivated a strong foundation in Python ,mathematics and statistics. With 2500+ connections on LinkedIn, my journey is fueled by a passion for serving the nation through impactful contributions to product-based companies. Beyond technical expertise, my skill set encompasses leadership, team building, public speaking, decision-making, and problem-solving. Committed to continuous improvement, I am actively developing and refining my skills to make a meaningful impact in the dynamic landscape of data science.
It is because of the support and blessings of my parents, God's grace, my dedication and hard work that I have achieved all these achievements till now.".
</p></pre>
                                    
                          </div>
                          <div class="w-100per m-y-10 none" id="connect3">
                                    <div class="flex mob-m-10 tab-m-y-20 w-100per flex-d-column e-c">
                                        <p class="sub-heading fc-primary">Connect</p>
                                        <hr class="m-y-10 w-75per tx-center">
                                        <div class="flex" id="footer-social-media">
                                            <div class="bg-footer-icon">
                                                <a href="javascript:void(0)" target="_blank"><i class="fab fa-facebook m-10 fc-secondary"></i></a>
                                            </div>

                                            <div class="bg-footer-icon m-l-10">
                                                <a href="javascript:void(0)" target="_blank"><i class="fab fa-whatsapp m-10 fc-secondary"></i></a>
                                            </div>

                                            <div class="bg-footer-icon m-l-10">
                                                <a href="javascript:void(0)" target="_blank"><i class="fab fa-twitter m-10 fc-secondary"></i></a>
                                            </div>

                                            <div class="bg-footer-icon m-l-10">
                                                <a href="javascript:void(0)" target="_blank"><i class="fas fa-envelope m-10 fc-secondary"></i></a>
                                            </div>

                                            <div class="bg-footer-icon m-l-10">
                                                <a href="javascript:void(0)" target="_blank"><i class="fab fa-instagram m-10 fc-secondary"></i></a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                          </div>
            </div>

            <div class="w-100per asset-card">
                        <div class="thumbnail p-20">
                            <img src="../../data/team/profilePhoto/Alok.png" alt="Alok khamora" class="img-fluid">
                        </div>
                         <div class="content tx-center m-10">
                         </div>
                         <div class="call-to-action m-t-5 block tx-center">
                              <div class="bg-clr-4 w-100per flex e-c cursor-pointer" onclick="details(this)" id="4">
                                    <a class="download-btn fc-primary hover-fc-primary bg-clr-4">
                                        <div class="w-100per tx-left fs-20">
                                            Alok khamora
                                        </div>
                                        <div class="w-100per tx-left fs-10">
                                            Content Creator
                                        </div>
                                    </a>

                                   <i class="fa fa-arrow-down cursor-pointer fs-20 hover-bg-dark-blue hover-fc-primary fc-dark-white  icon38" id="38" style="width: max-content; max-height: 100px; height: 100%; padding: 12px 20px; border-right:1px solid var(--clr-11);"></i>
                                </div>

                                <div class="bg-clr-4 w-100per flex e-c none" id="about4">
                                <pre style="text-align: left; margin:0; white-space: pre-wrap; white-space: -moz-pre-wrap; white-space: -pre-wrap; white-space: -o-pre-wrap; word-wrap: break-word;" class="flex m-20"><p class="fc-dark-blue font-poppins flex m-20" style="font-size: 15px;">Hello, everyone! My name is Alok Khamora, and I’m currently pursuing a Data Science degree at IIT Madras. 🎓 My passion lies in the fascinating realms of mathematics and statistics, where I find joy in unraveling complex patterns and solving real-world problems. 📊

Beyond academics, I’ve had the honor of representing our nation twice: once as a National Children Science Congress (NCSC) finalist and also in the Indian Young Innovators and Inventors Challenge (IYIIC). 🏆 These experiences have fueled my curiosity and drive to explore, innovate, and lead. 🚀

As an out-of-the-box thinker, I thrive on pushing boundaries and seeking unconventional solutions. 💡 My journey began in Kota, where I prepared rigorously for JEE (Joint Entrance Examination). I’ve successfully cleared JEE Mains and gained valuable experience in JEE Advanced, MHT-CET, ISI, VITEEE, and UGEE. </p></pre>
                                    
                          </div>
                          <div class="w-100per m-y-10 none" id="connect4">
                                    <div class="flex mob-m-10 tab-m-y-20 w-100per flex-d-column e-c">
                                        <p class="sub-heading fc-primary">Connect</p>
                                        <hr class="m-y-10 w-75per tx-center">
                                        <div class="flex" id="footer-social-media">
                                            <div class="bg-footer-icon">
                                                <a href="javascript:void(0)" target="_blank"><i class="fab fa-facebook m-10 fc-secondary"></i></a>
                                            </div>

                                            <div class="bg-footer-icon m-l-10">
                                                <a href="javascript:void(0)" target="_blank"><i class="fab fa-whatsapp m-10 fc-secondary"></i></a>
                                            </div>

                                            <div class="bg-footer-icon m-l-10">
                                                <a href="javascript:void(0)" target="_blank"><i class="fab fa-twitter m-10 fc-secondary"></i></a>
                                            </div>

                                            <div class="bg-footer-icon m-l-10">
                                                <a href="javascript:void(0)" target="_blank"><i class="fas fa-envelope m-10 fc-secondary"></i></a>
                                            </div>

                                            <div class="bg-footer-icon m-l-10">
                                                <a href="javascript:void(0)" target="_blank"><i class="fab fa-instagram m-10 fc-secondary"></i></a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                          </div>
            </div>

            <div class="w-100per asset-card">
                        <div class="thumbnail p-20">
                            <img src="../../data/team/profilePhoto/Amit-kumar-tiwari.jpg" alt="Amit kumar tiwari" style="border-radius:100%;" class="img-fluid">
                        </div>
                         <div class="content tx-center">
                         </div>
                         <div class="call-to-action m-t-5 block tx-center">
                              <div class="bg-clr-4 w-100per flex e-c cursor-pointer" onclick="details(this)" id="5">
                                    <a class="download-btn fc-primary hover-fc-primary bg-clr-4">
                                        <div class="w-100per tx-left fs-20">
                                            Amit kumar tiwari
                                        </div>
                                        <div class="w-100per tx-left fs-10">
                                            Founder
                                        </div>
                                    </a>

                                   <i class="fa fa-arrow-down cursor-pointer fs-20 hover-bg-dark-blue hover-fc-primary fc-dark-white  icon38" id="38" style="width: max-content; max-height: 100px; height: 100%; padding: 12px 20px; border-right:1px solid var(--clr-11);"></i>
                                </div>

                                <div class="bg-clr-4 w-100per flex e-c none" id="about5">
                                <pre style="text-align: left; margin:0; white-space: pre-wrap; white-space: -moz-pre-wrap; white-space: -pre-wrap; white-space: -o-pre-wrap; word-wrap: break-word;" class="flex m-20"><p class="fc-dark-blue font-poppins flex m-20" style="font-size: 15px;">I ❤️ programming.</p></pre>
                                    
                          </div>
                          <div class="w-100per m-y-10 none" id="connect5">
                                    <div class="flex mob-m-10 tab-m-y-20 w-100per flex-d-column e-c">
                                        <p class="sub-heading fc-primary">Connect</p>
                                        <hr class="m-y-10 w-75per tx-center">
                                        <div class="flex" id="footer-social-media">
                                            <div class="bg-footer-icon">
                                                <a href="javascript:void(0)" target="_blank"><i class="fab fa-facebook m-10 fc-secondary"></i></a>
                                            </div>

                                            <div class="bg-footer-icon m-l-10">
                                                <a href="javascript:void(0)" target="_blank"><i class="fab fa-whatsapp m-10 fc-secondary"></i></a>
                                            </div>

                                            <div class="bg-footer-icon m-l-10">
                                                <a href="javascript:void(0)" target="_blank"><i class="fab fa-twitter m-10 fc-secondary"></i></a>
                                            </div>

                                            <div class="bg-footer-icon m-l-10">
                                                <a href="javascript:void(0)" target="_blank"><i class="fas fa-envelope m-10 fc-secondary"></i></a>
                                            </div>

                                            <div class="bg-footer-icon m-l-10">
                                                <a href="javascript:void(0)" target="_blank"><i class="fab fa-instagram m-10 fc-secondary"></i></a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                          </div>
            </div>

        </div>
    </div>
</div>

<script>
    function details(e){
        let i = e.id;

        $(`#about${i}`).toggleClass("none");
        $(`#connect${i}`).toggleClass("none");
    }
</script>


</body>
</html>