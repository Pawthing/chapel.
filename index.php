<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/chanrich/bootstrap.min.css">
    <link rel="stylesheet" href="css/chanrich/owl.carousel.min.css">
    <link rel="stylesheet" href="css/chanrich/owl.theme.default.min.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/style.css">

    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
        crossorigin="anonymous"></script>

    <title>FaithCounts: San Lorenzo Diakono Chapel Website</title>

    <style>
        .hs img:hover {
            height: 150px;
            width: 150px;
        }

        .hideout {
            display: none;
        }
        .img-icon{
            width: 75px;
        }

       .slide1 {
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url("img/bg123.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .slide2, .p {
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.8)), url("img/bg123.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-size: 25px;
            font-weight: 450;
        }
        .slide3, .p {
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.8)), url("img/bg123.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-size: 25px;
            font-weight: 450;
        }
        .slide4, .p {
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.8)), url("img/bg123.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-size: 25px;
            font-weight: 450;
        }
        msg-area, .container1{
            background: linear-gradient(rgba(0,0,0,0.4),rgba(0,0,0,0.4)), url("img/8.jpg");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #fff;
            text-align: center;
        }
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="70">

    <!-- TOP NAV -->

    <!-- BOTTOM NAV -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top"
        style="    background-image: linear-gradient(-90deg, #ac351a, #ac351a);">
        <div class="container">
            <a href="index.php" class="navbar-brand1" style="color: white;"><img class="img-icon"src="img/1.png" alt="">FaithCounts</a>
            <!-- <a class="navbar-brand" style="color: white;" href="#">Faith Counts</a> -->

            <!-- <div class="input-group mb-3" id="divSearchBarLaw">
                <input id="htmInpSearchLaw" type="text" class="form-control" placeholder="Search Here"
                    aria-label="Search Law Here" aria-describedby="htmBtnSearchLaw"
                    style="background-color: white; margin-right: 5px;">
                <button class="btn btn-brand" type="button" id="htmBtnSearchLaw"><i class="fas fa-search"></i></button>
            </div> -->
            
           
                <a class="navbar-brand" style="color: white;" href="index.php">San Lorenzo Diakono Chapel</a>

            <div class="dropdown">
                <button class="btn btn-brand dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bars"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="register.php" id="htmLinkLogin">Get Started</a></li>
                    <li><a class="dropdown-item" href="#about">About</a></li>
                    <li><a class="dropdown-item" href="#services">Services</a></li>
                    <li><a class="dropdown-item" href="#portfolio">Chapel Rules</a></li>
                    <!-- <li><a class="dropdown-item" href="#reviews">Team</a></li> -->
                    <li><a class="dropdown-item" href="#blog">FaithCounts</a></li>
                    <!-- <li><a class="dropdown-item" href="#">Contact</a></li> -->
                    <li id="htmLinkLogout" class="hideout"><a class="dropdown-item" href="javascript:void(0)"
                        onclick="logoutProcess();">Logout</a></li>
                </ul>
            </div>

        </div>
    </nav>

    <!-- SLIDER -->
    <div class="owl-carousel owl-theme hero-slider">
        <div class="slide slide1">
        
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center text-white">
                        <h3 class="text-white text-uppercase">We Help to get things Done</h3>
                        <h1 class="display-3 my-4">God is Almighty</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide slide2">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-10 offset-lg-1 text-white">
                        <h2 class="text-white text-uppercase">Chapel Announcements</h2>
                        <p class="text-white">Sunday Worship Service <br>
                                Time: &ensp;&ensp;&ensp;&ensp;&nbsp;&nbsp;&nbsp; 7:00 AM to 8:00 AM <br>
                                Details: &ensp;&ensp;&ensp;&nbsp; Join us for a time of worship, prayer, and reflection on God’s Word. We invite everyone to participate and strengthen their faith through fellowship and spiritual growth.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide slide3">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-10 offset-lg-1 text-white">
                        <h2 class="text-white text-uppercase">Chapel Announcements</h2>
                        <p class="text-white">Choir Practice <br>
                                Day: &ensp;&ensp;&ensp;&ensp;&nbsp;&nbsp; Thursday <br>
                                Time: &ensp;&ensp;&ensp;&nbsp;&nbsp; 9:30 AM <br>
                                Details: &ensp;&ensp; Choir members and those interested in joining the choir are invited to practice this week as we prepare for Sunday’s service. Let’s lift our voices in praise together!</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide slide4">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-10 offset-lg-1 text-white">
                        <h2 class="text-white text-uppercase">Chapel Announcements</h2>
                        <p class="text-white">Youth Fellowship <br>
                            Day: &ensp;&ensp;&ensp;&ensp;&nbsp;&nbsp; Friday <br>
                            Time: &ensp;&ensp;&ensp;&nbsp;&nbsp; 8:00 AM <br>
                            Details: &ensp;&ensp; All youth aged 13-18 are invited to join us for a night of fun, games, and growing in faith. Bring a friend, and let’s build a strong community of young believers!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ABOUT -->
    <section id="about">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-3">
                    <img src="img/90.jpg" alt="">
                </div>
                <div class="col-lg-5 py-5">
                    <div class="row">

                        <div class="col-12">
                            <div class="info-box">
                                <img src="" alt="">
                                <div class="ms-4">
                                    <h1>ABOUT US</h1>
                                    <h2>Our Mission and Vision</h2>
                                    <p>At San Lorenzo Diakono Chapel, we believe that every person deserves to experience the love and presence of God in their life. Our mission is to create a welcoming community where people can come to know and grow in their faith, and our vision is to be a beacon of hope and light in the world.</p>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-12 mt-4">
                            <div class="info-box">
                                <img src="img/bg123.jpg" alt="">
                                <div class="ms-4">
                                    <h5>Usherettes</h5>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-12 mt-4">
                            <div class="info-box">
                                <img src="img/bg123.jpg" alt="">
                                <div class="ms-4">
                                    <h5>Choir</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="info-box">
                                <img src="img/bg123.jpg" alt="">
                                <div class="ms-4">
                                    <h5>COMI</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="info-box">
                                <img src="img/bg123.jpg" alt="">
                                <div class="ms-4">
                                    <h5>Knights</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="info-box">
                                <img src="img/bg123.jpg" alt="">
                                <div class="ms-4">
                                    <h5>LecCom</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="info-box">
                                <img src="img/bg123.jpg" alt="">
                                <div class="ms-4">
                                    <h5>Multimedia</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="info-box">
                                <img src="img/bg123.jpg" alt="">
                                <div class="ms-4">
                                    <h5>Usherettes</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="msg-area" class="text-center">
        <div class="container1">
        <div class="row">
            <br><br><br><br>
            <h2><p>Verse of the day</p></h2>
            <br><br><br><br>
            <p>For God so loved the world, that He gave His only begotten Son, that whosoever believeth in Him should not perish, but have everlasting life. For God sent not His Son into the world to condemn the world; but that the world through Him might be saved. <br>John 3:16-17 (NIV)</p>
        <br><br><br><br>
        </div>
        </div>
    </section>

    <section id="services" class="text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="intro">
                        <h6>Our Services</h6>
                        <h1>What We Do?</h1>
                        <p class="mx-auto"></p>
                    </div>
                </div>
            </div>
        
            <!-- Button trigger modal -->
            <button id="htmModalGMapTrigger" style="display: none" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></button>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6 hs" style="cursor: pointer"
                    onclick="window.location.href='legal-lawyers.html?pao=1';">
                    <div class="service">
                        <img src="img/pray.jpg" alt="">
                        <h5>Prayers</h5>
                        <p>Prayer enlarges the heart until it is capable of Containing God's gift of himself.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 hs" style="cursor: pointer"
                    onclick="showPublicNotaryPlaces();">
                    <div class="service">
                        <img src="img/blessings.jpg" alt="">
                        <h5>Blessings</h5>
                        <p>We all have moments where were overcome by how blessed we are—relationships, opportunities, the beauty around us—and want to take a moment to express it...and not just on Thanksgiving! Whether you log on to social media to declare your #blessed status or pause for a few moments of quiet reflection, these quotes will help put that special feeling of gratitude into words.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 hs" style="cursor: pointer" onclick="document.location='#'">
                    <div class="service">
                        <img src="img/offer.jpg" alt="">
                        <h5>Offerings</h5>
                        <p>You do not need to leave your room. Remain sitting at your table and listen. Do not even listen, simply wait, be quiet still and solitary. The world will freely offer itself to you to be unmasked, it has no choice, it will roll in ecstasy at your feet.</p>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <section class="bg-light" id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="intro">
                        <h6></h6>
                        <h1>Chapel Rules</h1>
                        <p class="mx-auto"> To keep the Sundays and Holy Days of obligation holy, by hearing Mass and resting from servile work;</p>
                        <p class="mx-auto"> To keep the days of fasting and abstinence appointed by the Chapel; </p>
                        <p class="mx-auto">To go to confession at least once a year;</p>
                        <p class="mx-auto">To receive the Blessed Sacrament at least once a year and that at Easter or thereabouts;</p>
                        <p class="mx-auto">To contribute to the support of our priest..</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="projects-slider" class="owl-theme owl-carousel">
            <div class="project">
                <div class="overlay"></div>
                <img src="img/8.jpg" alt="">
                <div class="content">
                    <h2>Bible</h2>
                    <h6 onclick="document.location='#'">📚Read More</h6>
                </div>
            </div>
            <div class="project">
                <div class="overlay"></div>
                <img src="img/praising.jpg" alt="">
                <div class="content">
                    <h2>Praising</h2>
                    <h6 onclick="document.location='#'">📚Read More</h6>
                </div>
            </div>
            <div class="project">
                <div class="overlay"></div>
                <img src="img/1.jpg" alt="">
                <div class="content">
                    <h2>Pray</h2>
                    <h6 onclick="document.location='#'">📚Read More</h6>
                </div>
            </div>
            <div class="project">
                <div class="overlay"></div>
                <img src="img/background.webp" alt="">
                <div class="content">
                    <h2>Beginning</h2>
                    <h6 onclick="document.location='#'">📚Read More</h6>
                </div>
            </div>
            <div class="project">
                <div class="overlay"></div>
                <img src="img/background.webp" alt="">
                <div class="content">
                    <h2>Faith</h2>
                    <h6 onclick="document.location='#'">📚Read More</h6>
                </div>
            </div>
            <div class="project">
                <div class="overlay"></div>
                <img src="img/background.webp" alt="">
                <div class="content">
                    <h2>Hope</h2>
                    <h6 onclick="document.location='#'">📚Read More</h6>
                </div>
            </div>
            <div class="project">
                <div class="overlay"></div>
                <img src="img/background.webp" alt="">
                <div class="content">
                    <h2>New</h2>
                    <h6 onclick="document.location='#'">📚Read More</h6>
                </div>
            </div>
            <div class="project">
                <div class="overlay"></div>
                <img src="img/bg123.jpg" alt="">
                <div class="content">
                    <h2>Chapel</h2>
                    <h6 onclick="document.location='#'">📚Read More</h6>
                </div>
            </div>
        </div>
    </section>

    <!-- Team View -->
    <!-- <section class="bg-light" id="reviews">

        <div class="owl-theme owl-carousel reviews-slider container">
            <div class="review">
                <div class="person">
                    <img src="img/team/team2.png" alt="">
                    <h5>Micaela Gomez</h5>
                    <small>Project Manager</small>
                </div>
                <h3>“A project manager is like a doctor who leads the trauma team and decides the course of action for a
                    patient - both at the same time. Without the right kind of authority to efficiently handle all the
                    project management issues, development teams can easily get into trouble.” - Scott Berkun, the
                    author of “Making Things Happen”</h3>
                <i class='bx bxs-quote-alt-left'></i>
            </div>
            <div class="review">
                <div class="person">
                    <img src="img/team/team1.png" alt="">
                    <h5>Alain Lalu</h5>
                    <small>Quality Tester</small>
                </div>
                <h3>Being a Quality Tester unknowingly becomes a good time manager as the first thing i needs to
                    understand is a
                    priority. Most of the time, we are given a module/functionality to test and timeline (which is
                    always right) and need to give output especially in our system about FaithCounts: Attendance Monitoring System</h3>
                <i class='bx bxs-quote-alt-left'></i>
            </div>
            <div class="review">
                <div class="person">
                    <img src="img/team/team4.png" alt="">
                    <h5>Mark Anthony Pasco</h5>
                    <small> System Developer</small>
                </div>
                <h3>“Being a developer means building things that make people's lives easier and more fun. That's what I
                    like most about my job. From the outside it might seem like I spend my days solving puzzles and
                    writing code, but what I'm really doing is making a difference in the way people live their lives.”
                </h3>
                <i class='bx bxs-quote-alt-left'></i>
            </div>
        </div>
    </section> -->
    <!-- Team View -->

    <!-- <section id="blog">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="intro">
                        <h6></h6>
                        <h1>Law Firm</h1>
                        <p class="mx-auto">We appoint leading attorney whose expertise and skills are best matched to
                            your case. Our Filipino lawyers have the legal understanding you need to help you move
                            forward. </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <article class="blog-post">
                        <img src="img/project5.jpg" alt="">
                        <a href="#" class="tag">Guagua</a>
                        <div class="content">
                            <small>Lawyer: Atty Bienvenido B. Bacani</small>
                            <h5>Atty Bienvenido B. Bacani Law Office</h5>
                            <p>Speciality: General Practitioner with concentration of Criminal law</br>Contact
                                No.09669486691/09083167336</br>Location:Sto Cristo Guagua Pampanga</p>
                        </div>
                    </article>
                </div>
                <div class="col-md-4">
                    <article class="blog-post">
                        <img src="img/project4.jpg" alt="">
                        <a href="#" class="tag">San Fernando</a>
                        <div class="content">
                            <small>Lawyer:Atty. Leila Mae M. Estabillo</small>
                            <h5>Atty. Leila Mae M. Estabillo Notary Public</h5>
                            <p>Speciality: Loss Title, Correction of Entry, Drug cases</br>Contact
                                No.09395920124</br>Location:0528 Capitol Compound Sto Nino san Fernando Pampanga</p>
                        </div>
                    </article>
                </div>
                <div class="col-md-4">
                    <article class="blog-post">
                        <img src="img/project3.jpg" alt="">
                        <a href="#" class="tag">San Fernando</a>
                        <div class="content">
                            <small>Lawyer:Atty. Rendel Bryan Balanay</small>
                            <h5>Atty. Rendel Bryan Balanay Law Office</h5>
                            <p>Speciality: Property law, Family Law and Criminal law</br>Contact
                                No.09395920124</br>Location:0528 Capitol Compound Sto Nino san Fernando Pampanga</p>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section> -->
    
        
    <footer class="bg-light" id="blog">
        <div class="footer-top text-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h4 class="navbar-brand">FaithCounts<span class="dot">.</span></h4>
                        <p>We Help to get things Done <br>
                        God is Almighty.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom text-center">
            <p class="mb-0">Copyright@2024. All rights Reserved</p>
        </div>
    </footer>



    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">???</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="htmGoogleMap" style="width: 100%; height: 500px"></div>
                </div>
                <div class="modal-footer">
                    
                </div>
            </div>
        </div>
    </div>


    <input type="hidden" id="hidfld_uid" name="hidfld_uid" value="?">
    <input type="hidden" id="hidfld_fname" name="hidfld_fname" value="?">
    <input type="hidden" id="hidfld_role" name="hidfld_role" value="?">


    <!-- Vendors JS -->
    <!-- <script>

        function initMap() {

            const guaguaPao = { lat: 14.978817244203968, lng: 120.61524389311533 };     // PAO guagua
            const capitolPao = { lat: 15.023885313670615, lng: 120.6874653630963 };    // PAO capitol
            const sacopPao = { lat: 15.068653985655278, lng: 120.65835571665242 };     // PAO sacop

            const map = new google.maps.Map(document.getElementById("htmGoogleMap"), {
                zoom: 12,
                center: { lat: 14.99584096176738, lng: 120.65022349676022 }
            });

            const guaguaInfo = new google.maps.InfoWindow({
                content: "<div>Guagua Public Attorney's Office</div>"
            });
            const capitolInfo = new google.maps.InfoWindow({
                content: "<div>Capitol Public Attorney's Office</div>"
            });
            const sacopInfo = new google.maps.InfoWindow({
                content: "<div>SACOP Public Attorney's Office</div>"
            });

            guaguaInfo.open(
                map,
                new google.maps.Marker({
                    position: guaguaPao,
                    map: map,
                })
            );
            capitolInfo.open(
                map,
                new google.maps.Marker({
                    position: capitolPao,
                    map: map,
                })
            );
            sacopInfo.open(
                map,
                new google.maps.Marker({
                    position: sacopPao,
                    map: map,
                })
            );


        }
    </script>
    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCNzWk-9j_qMKYO2UvX3hcNM6kBI24nBbo&callback=initMap">
    </script> -->



    <script src="js/chanrich/jquery.min.js"></script>
    <script src="js/chanrich/bootstrap.bundle.min.js"></script>
    <script src="js/chanrich/owl.carousel.min.js"></script>
    <script src="js/chanrich/app.js"></script>

    <script src="services/front/index/elements.js"></script>
    <script src="services/front/index/core.js"></script>
    <script src="services/front/index/controls.js"></script>
    <script>
        if (window.localStorage.getItem("uid") != null && window.localStorage.getItem("uid") != "") {
            lnk_login.innerHTML = "Profile";
            lnk_logout.classList.remove("hideout");
        }
        window.onload = () => {

            if (typeof (Storage) !== "undefined") {
                let fname = window.localStorage.getItem("fname"); console.log("Acquire localstorage value :: name " + fname);
                let role = window.localStorage.getItem("role"); console.log("Acquire localstorage value :: role " + fname);
                uid = window.localStorage.getItem("uid"); console.log("Acquire localstorage value :: uid " + uid);

                hrole.value = role;
                hname.value = fname;
                huid.value = uid;
            }
            else {
                let urlParams = new URLSearchParams(window.location.search);
                let fname = urlParams.get("fname"); console.log("NO localstorage support :: name " + fname);
                let role = urlParams.get('role'); console.log("NO localstorage support :: role " + role);
                uid = urlParams.get("uid"); console.log("NO localstorage support :: uid " + uid);

                hrole.value = role;
                hname.value = fname;
                huid.value = uid;
            }

            getLawCatCtr();
            getLawyersCtr();
        }

        function logoutProcess() {
            let route = "services/back/php/common/logout.php?page=index";
            route += "&uid=" + huid.value;
            window.location.href = route;
        }
    </script>
</body>

</html>