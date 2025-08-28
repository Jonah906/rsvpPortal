<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>DR. HENRY OMOROGIEVA AKPATA</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link rel="shortcut icon" href="{{ asset('welcome/assets/img/free.jpg') }}">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">


  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Dewi
  * Template URL: https://bootstrapmade.com/dewi-free-multi-purpose-html-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        .main {
            flex-grow: 1;
        }

        .footer-container {
            width: 100%;
            text-align: center;
            background-color: #f0f0f0; /* Or your preferred footer background */
            padding: 10px 0;
        }

        .footer-content {
            display: inline-block;
        }
		
		* {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            overflow: hidden;
        }

        /* Video Background */
        .video-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        .video-container video {
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* Content Overlay */
        .containers {
			position: relative;
			z-index: 3;
			--bs-gutter-x: 1.5rem;
			--bs-gutter-y: 0;
			width: 100%;
			padding-right: calc(var(--bs-gutter-x) * .5);
			padding-left: calc(var(--bs-gutter-x) * .5);
			margin-right: auto;
			margin-left: auto;
            justify-content: center;
			height: 100%;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.5);
        }
		
		#hero{
			background: none;
			padding:0px;
			margin:0px;
		}

        #mutebtn {
			position:absolute;
			bottom:5px;
			right:5px;
            padding: 10px 20px;
            font-size: 1rem;
            border: 2px solid white;
            background: transparent;
            color: white;
            cursor: pointer;
            transition: background 0.3s;
        }

        #mutebtn:hover {
            background: white;
            color: black;
        } 
		
		@media screen and (max-width: 768px) {

           .video-container video {
				width: 768px;
				height: auto;
            }
		}
		
		@media screen and (max-width: 640px) {

           .video-container video {
				width: 640px;
				height: auto;
            }
		}
		
		@media screen and (max-width: 575px) {

           .video-container video {
				width: 575px;
				height: auto;
            }
		}
		
		@media screen and (max-width: 480px) {

           .video-container video {
				width: 480px;
				height: auto;
            }
		}
  </style>
</head>

<body class="index-page">

  <i class="mobile-nav-toggle"></i>

  <main class="main">
      <section id="hero" class="hero section">
		<div class="video-container">
			<video id="backgroundVideo" src="assets/video/apatavid.mp4" autoplay loop muted></video>
		</div>
        <!-- <picture> -->
          <!-- Image for larger screens -->
          <!-- <source srcset="assets/img/latesthenry.jpg" media="(min-width: 769px)"> -->
          <!-- Image for mobile screens -->
          <!-- <img src="assets/img/port.png" alt="Dr. Henry Omorogieva Akpata" class="hero-image">https://henryoakpata.com/ersvp/
      </picture> -->
              <div class="containers d-flex flex-column align-items-center"  style="height:90vh">
              <!-- <h2 style="text-align: center; width: 100%;" data-aos="fade-up" data-aos-delay="100">THE FUNERAL OF <br/>DR. HENRY OMOROGIEVA AKPATA</h2> -->
             <!--  <p style="text-align: center; width: 100%;"> 29.05.1940 - 10.01.2025</p> -->
              <!-- <p style="text-align: center; width: 100%;">(15 & 16 May, 2025 - Benin City, Edo State.)            </p> -->
              <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
                  <a href="{{ route('frontend.index') }}" class="btn-get-started d-flex align-items-center">
                      <i class="bi bi-calendar-check me-2"></i> RSVP
                  </a>
                  <a href="#" target="_blank" class="btn-get-started d-flex align-items-center ms-3" style="color: #ff4a17; background: white;">
                      <i class="bi bi-person-circle me-2"></i> VIEW TRIBUTES
                  </a>
              </div>
			  <button id="mutebtn" onclick="toggleMute()">Unmute</button>
          </div>
      </section>
    </main>

  <section id="clients" class="clients section light-background d-flex justify-content-center align-items-center text-center">
      <div class="containers aos-init aos-animate" data-aos="fade-up" style="background:none">
          <div class="footer-container">
              <div class="footer-content">
                  <p>
                      Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                      VonCap Advisory
                  </p>
              </div>
          </div>
      </div>
  </section>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
	<script>
        const video = document.getElementById('backgroundVideo');
        const button = document.querySelector('button');

        function toggleMute() {
            video.muted = !video.muted;
            button.textContent = video.muted ? 'Unmute' : 'Mute';
        }
    </script>
</body>

</html>