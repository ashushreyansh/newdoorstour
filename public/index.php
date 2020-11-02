<?php

if(isset($_SESSION["email"])){
		header("location: index.php");
	}
//index.php
//Include Configuration File
include('googlelogin.php');
$login_button = '';
//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if(isset($_GET["code"])){
 //It will Attempt to exchange a code for an valid authentication token.
 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
 //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
 if(!isset($token['error'])){
  //Set the access token used for requests
  $google_client->setAccessToken($token['access_token']);
  //Store "access_token" value in $_SESSION variable for future use.
  $_SESSION['access_token'] = $token['access_token'];
  //Create Object of Google Service OAuth 2 class
  $google_service = new Google_Service_Oauth2($google_client);
  //Get user profile data from google
  $data = $google_service->userinfo->get();
  //Below you can find Get profile data and store into $_SESSION variable
  if(!empty($data['given_name'])){
   $_SESSION['user_first_name'] = $data['given_name'];
  }
  if(!empty($data['family_name'])){
   $_SESSION['user_last_name'] = $data['family_name'];
  }
  if(!empty($data['email'])){
   $_SESSION['user_email_address'] = $data['email'];
  }
  if(!empty($data['gender'])){
   $_SESSION['user_gender'] = $data['gender'];
  }
  if(!empty($data['picture'])){
   $_SESSION['user_image'] = $data['picture'];
  }
 }
}
//This is for check user has login into system by using Google account, if User not login into system then it will execute if block of code and make code for display Login link for Login using Google account.
if(!isset($_SESSION['access_token'])){
 //Create a URL to obtain user authorization
 $login_button = '<a href="'.$google_client->createAuthUrl().'" class="btn btn-outline-dark btn-block" style="margin-top:10px; text-transform:none;"><img width="20px" style="margin-bottom:3px; margin-right:5px"
                                        alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
                                        Login with Google</a>';//<img style="width:inherit; height:40px; border-radius:4px; margin-top:5px;" src="sign-in-with-google.png" />
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-YNNC95NX7R"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-YNNC95NX7R');
</script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon" />
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:400,700,900"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/owl.carousel.min.css" />
    <link rel="stylesheet" href="css/owl.theme.default.min.css" />
    <link rel="stylesheet" href="css/style.css" />

    <title>DoorsTour</title>
  </head>
  <body>
    <div class="pxp-header fixed-top pxp-animate">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-5 col-md-2">
            <a href="index.html" class="pxp-logo text-decoration-none"
              ><img src="images/logo.png" height="35" width="175" alt="logo"
            /></a>
          </div>
          <div class="col-2 col-md-8 text-center">
            <ul class="pxp-nav list-inline">
              <!-- <li class="list-inline-item">
                <a href="#">Home</a>
                <ul class="pxp-nav-sub rounded-lg">
                  <li><a href="index-2.html">Version 1</a></li>
                  <li><a href="index-3.html">Version 2</a></li>
                  <li><a href="index-4.html">Version 3</a></li>
                </ul>
              </li> -->
              <li class="list-inline-item">
                <a href="#">Properties</a>
                <ul class="pxp-nav-sub rounded-lg">
                  <li><a href="properties.html">Buy</a></li>
                  <li><a href="properties.html">Rent</a></li>
                  <li>
                    <a href="properties.html">PG</a>
                  </li>
                </ul>
              </li>
              <li class="list-inline-item">
                <a href="#">Feel 360</a>
                <ul class="pxp-nav-sub rounded-lg">
                  <li><a href="gyms.html">Gyms</a></li>
                  <li><a href="restaurants.html">Restaurants</a></li>
                  <li>
                    <a href="co-working.html">Co-working Spaces</a>
                  </li>
                  <li><a href="hotels.html">Hotels</a></li>
                </ul>
              </li>
              <li class="list-inline-item pxp-is-last">
                <a href="services.html">Services</a>
              </li>
              <li class="list-inline-item">
                <a href="blog.html">Blog</a>

              </li>
              <li class="list-inline-item pxp-is-last">
                <a href="about.html">About Us</a>
              </li>
              <!-- <li class="list-inline-item">
                <a href="#">Themes</a>
                <ul class="pxp-nav-sub rounded-lg">
                  <li><a href="index-2.html">Light</a></li>
                  <li>
                    <a
                      href="http://pixelprime.co/themes/resideo/dark/index.html"
                      >Dark</a
                    >
                  </li>
                </ul>
              </li> -->
              <li class="list-inline-item pxp-is-last">
                <a href="contact.html">Contact Us</a>
              </li>
              <li class="list-inline-item">
                <div class="pxp-user-btns">
                  <a href="submit-property.html"
                    ><button class="pxp-user-btns prop-btn">
                      Post Property
                    </button></a
                  >
                </div>
              </li>
              <li class="list-inline-item pxp-has-btns">
                <div class="pxp-user-btns">
                  <a href="#" class="pxp-user-btns-signup pxp-signup-trigger"
                    >Sign Up</a
                  >
                  <a href="#" class="pxp-user-btns-login pxp-signin-trigger"
                    >Sign In</a
                  >
                </div>
              </li>
            </ul>
          </div>
          <div class="col-5 col-md-2 text-right">
            <a href="javascript:void(0);" class="pxp-header-nav-trigger"
              ><span class="fa fa-bars"></span
            ></a>
            <a
              href="javascript:void(0);"
              class="pxp-header-user pxp-signin-trigger"
              ><span class="fa fa-user-o"></span
            ></a>
          </div>
        </div>
      </div>
    </div>

    <div class="pxp-content">
      <div class="pxp-hero vh-100">
        <div
          class="pxp-hero-bg pxp-cover pxp-cover-bottom"
          style="background-image: url(images/hero-1.jpg)"
        ></div>
        <div class="pxp-hero-opacity"></div>
        <div class="pxp-hero-caption">
          <div class="container">
            <h1 class="text-white">Feel Your Home Through Your Eyes</h1>

            <form
              class="pxp-hero-search mt-4"
              action="#"
            >
              <div class="row">
                <div class="col-sm-12 col-md-4">
                  <div class="form-group">
                    <select class="custom-select">
                      <option selected>Buy</option>
                      <option value="1">Rent</option>
                      <option value="2">PG</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-12 col-md-8">
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control pxp-is-address"
                      placeholder="Enter address..."
                    />
                    <span class="fa fa-search"></span>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="container-fluid pxp-props-carousel-right mt-100">
        <h2 class="pxp-section-h2">Featured Properties</h2>
        <p class="pxp-text-light">Browse our latest hot offers</p>
        <div class="pxp-props-carousel-right-container mt-4 mt-md-5">
          <div class="owl-carousel pxp-props-carousel-right-stage">
            <div>
              <a href="single-property.html" class="pxp-prop-card-1 rounded-lg">
                <div
                  class="pxp-prop-card-1-fig pxp-cover"
                  style="
                    background-image: url(images/properties/prop-1-1-gallery.jpg);
                  "
                ></div>
                <div class="pxp-prop-card-1-gradient pxp-animate"></div>
                <div class="pxp-prop-card-1-details">
                  <div class="pxp-prop-card-1-details-title">
                    Shanti Apartment Flat
                  </div>
                  <div class="pxp-prop-card-1-details-price">₹1.20 Cr</div>
                  <div class="pxp-prop-card-1-details-features text-uppercase">
                    Rohini Sec 23 <span>|</span> 3 BHK <span>|</span> Ground Floor <span>|</span> 90 Sq.Ft.
                  </div>
                </div>
                <div class="pxp-prop-card-1-details-cta text-uppercase">
                  View Details
                </div>
              </a>
            </div>

            <div>
              <a href="single-property.html" class="pxp-prop-card-1 rounded-lg">
                <div
                  class="pxp-prop-card-1-fig pxp-cover"
                  style="
                    background-image: url(images/properties/prop-2-1-gallery.jpg);
                  "
                ></div>
                <div class="pxp-prop-card-1-gradient pxp-animate"></div>
                <div class="pxp-prop-card-1-details">
                  <div class="pxp-prop-card-1-details-title">
                    Pragati Apartment Flat
                  </div>
                  <div class="pxp-prop-card-1-details-price">₹1.4 Cr</div>
                  <div class="pxp-prop-card-1-details-features text-uppercase">
                    West Enclave <span>|</span> Duplex <span>|</span> 1st Floor <span>|</span> 110 Sq.Ft.
                  </div>
                </div>
                <div class="pxp-prop-card-1-details-cta text-uppercase">
                  View Details
                </div>
              </a>
            </div>

            <div>
              <a href="single-property.html" class="pxp-prop-card-1 rounded-lg">
                <div
                  class="pxp-prop-card-1-fig pxp-cover"
                  style="
                    background-image: url(images/properties/prop-3-1-gallery.jpg);
                  "
                ></div>
                <div class="pxp-prop-card-1-gradient pxp-animate"></div>
                <div class="pxp-prop-card-1-details">
                  <div class="pxp-prop-card-1-details-title">
                    Gyan Sudha Apartment Flat
                  </div>
                  <div class="pxp-prop-card-1-details-price">₹1.10 Cr</div>
                  <div class="pxp-prop-card-1-details-features text-uppercase">
                    Rohini Sec 3 <span>|</span> 2 BHK <span>|</span> 1st Floor <span>|</span> 90 Sq.Ft.
                  </div>
                </div>
                <div class="pxp-prop-card-1-details-cta text-uppercase">
                  View Details
                </div>
              </a>
            </div>

            <div>
              <a href="single-property.html" class="pxp-prop-card-1 rounded-lg">
                <div
                  class="pxp-prop-card-1-fig pxp-cover"
                  style="
                    background-image: url(images/properties/prop-7-1-gallery.jpg);
                  "
                ></div>
                <div class="pxp-prop-card-1-gradient pxp-animate"></div>
                <div class="pxp-prop-card-1-details">
                  <div class="pxp-prop-card-1-details-title">
                    Ankur Apartments
                  </div>
                  <div class="pxp-prop-card-1-details-price">₹70 Lac</div>
                  <div class="pxp-prop-card-1-details-features text-uppercase">
                    Paschim Vihar <span>|</span> 2 BHK <span>|</span> Ground Floor <span>|</span> 110 Sq.Ft.
                  </div>
                </div>
                <div class="pxp-prop-card-1-details-cta text-uppercase">
                  View Details
                </div>
              </a>
            </div>

            <div>
              <a href="single-property.html" class="pxp-prop-card-1 rounded-lg">
                <div
                  class="pxp-prop-card-1-fig pxp-cover"
                  style="
                    background-image: url(images/properties/prop-8-1-gallery.jpg);
                  "
                ></div>
                <div class="pxp-prop-card-1-gradient pxp-animate"></div>
                <div class="pxp-prop-card-1-details">
                  <div class="pxp-prop-card-1-details-title">
                    Yamuna Apartments
                  </div>
                  <div class="pxp-prop-card-1-details-price">₹40 Lac</div>
                  <div class="pxp-prop-card-1-details-features text-uppercase">
                    Sainik Farm <span>|</span> 2 BHK <span>|</span> 1st Floor <span>|</span> 90 Sq.Ft.
                  </div>
                </div>
                <div class="pxp-prop-card-1-details-cta text-uppercase">
                  View Details
                </div>
              </a>
            </div>

            <div>
              <a href="single-property.html" class="pxp-prop-card-1 rounded-lg">
                <div
                  class="pxp-prop-card-1-fig pxp-cover"
                  style="
                    background-image: url(images/properties/prop-9-1-gallery.jpg);
                  "
                ></div>
                <div class="pxp-prop-card-1-gradient pxp-animate"></div>
                <div class="pxp-prop-card-1-details">
                  <div class="pxp-prop-card-1-details-title">
                    2 BHK Flat
                  </div>
                  <div class="pxp-prop-card-1-details-price">₹1 Cr</div>
                  <div class="pxp-prop-card-1-details-features text-uppercase">
                    Kalkaji <span>|</span> 2 BHK <span>|</span> 3rd Floor<span>|</span> 89 Sq.Ft.
                  </div>
                </div>
                <div class="pxp-prop-card-1-details-cta text-uppercase">
                  View Details
                </div>
              </a>
            </div>
          </div>

          <a
            href="properties.html"
            class="pxp-primary-cta text-uppercase mt-4 mt-md-5 pxp-animate"
            >Browse All</a
          >
        </div>
      </div>

      <div
        class="pxp-services pxp-cover mt-100 pt-100 mb-200"
        style="
          background-image: url(images/services-h-fige6dd.jpg?v7);
          background-position: 50% 60%;
        "
      >
        <h2 class="text-center pxp-section-h2">Why Choose Us</h2>
        <p class="pxp-text-light text-center">
          We offer perfect real estate services
        </p>

        <div class="container">
          <div class="pxp-services-container rounded-lg mt-4 mt-md-5">
            <a href="properties.html" class="pxp-services-item">
              <div class="pxp-services-item-fig">
                <img src="images/service-icon-1.svg" alt="..." />
              </div>
              <div class="pxp-services-item-text text-center">
                <div class="pxp-services-item-text-title">
                  Explore places in VR
                </div>
                <div class="pxp-services-item-text-sub">
                  A smart real estate experience using virtual reality
                </div>
              </div>
              <div class="pxp-services-item-cta text-uppercase text-center">
                Learn More
              </div>
            </a>
            <a href="agents.html" class="pxp-services-item">
              <div class="pxp-services-item-fig">
                <img src="images/service-icon-2.svg" alt="..." />
              </div>
              <div class="pxp-services-item-text text-center">
                <div class="pxp-services-item-text-title">
                  Experienced agents
                </div>
                <div class="pxp-services-item-text-sub">
                  Find an agent who knows<br />your market best
                </div>
              </div>
              <div class="pxp-services-item-cta text-uppercase text-center">
                Learn More
              </div>
            </a>
            <a href="properties.html" class="pxp-services-item">
              <div class="pxp-services-item-fig">
                <img src="images/service-icon-3.svg" alt="..." />
              </div>
              <div class="pxp-services-item-text text-center">
                <div class="pxp-services-item-text-title">
                  Buy or rent homes
                </div>
                <div class="pxp-services-item-text-sub">
                  Millions of houses and apartments in<br />your favourite
                  cities
                </div>
              </div>
              <div class="pxp-services-item-cta text-uppercase text-center">
                Learn More
              </div>
            </a>
            <a href="submit-property.html" class="pxp-services-item">
              <div class="pxp-services-item-fig">
                <img src="images/service-icon-4.svg" alt="..." />
              </div>
              <div class="pxp-services-item-text text-center">
                <div class="pxp-services-item-text-title">
                  List your own property
                </div>
                <div class="pxp-services-item-text-sub">
                  Sign up now and sell or rent<br />your own properties
                </div>
              </div>
              <div class="pxp-services-item-cta text-uppercase text-center">
                Learn More
              </div>
            </a>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>

      <div class="container mt-100">
        <h2 class="pxp-section-h2">Explore Our Neighborhoods</h2>
        <p class="pxp-text-light">
          Browse our comprehensive neighborhood listings
        </p>

        <div class="row mt-4 mt-md-5">
          <div class="col-sm-12 col-md-6 col-lg-4">
            <a href="properties.html" class="pxp-areas-1-item rounded-lg">
              <div
                class="pxp-areas-1-item-fig pxp-cover"
                style="background-image: url(images/delhi.jpg)"
              ></div>
              <div class="pxp-areas-1-item-details">
                <div class="pxp-areas-1-item-details-area">Delhi - NCR</div>
                <div class="pxp-areas-1-item-details-city">India</div>
              </div>
              <div class="pxp-areas-1-item-counter">
                <span>324 Properties</span>
              </div>
              <div class="pxp-areas-1-item-cta text-uppercase">Explore</div>
            </a>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-4">
            <a href="properties.html" class="pxp-areas-1-item rounded-lg">
              <div
                class="pxp-areas-1-item-fig pxp-cover"
                style="background-image: url(images/mumbai.png)"
              ></div>
              <div class="pxp-areas-1-item-details">
                <div class="pxp-areas-1-item-details-area">Mumbai</div>
                <div class="pxp-areas-1-item-details-city">India</div>
              </div>
              <div class="pxp-areas-1-item-counter">
                <span>158 Properties</span>
              </div>
              <div class="pxp-areas-1-item-cta text-uppercase">Explore</div>
            </a>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-4">
            <a href="properties.html" class="pxp-areas-1-item rounded-lg">
              <div
                class="pxp-areas-1-item-fig pxp-cover"
                style="background-image: url(images/Chennai.jpg)"
              ></div>
              <div class="pxp-areas-1-item-details">
                <div class="pxp-areas-1-item-details-area">Chennai</div>
                <div class="pxp-areas-1-item-details-city">India</div>
              </div>
              <div class="pxp-areas-1-item-counter">
                <span>129 Properties</span>
              </div>
              <div class="pxp-areas-1-item-cta text-uppercase">Explore</div>
            </a>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-4">
            <a href="properties.html" class="pxp-areas-1-item rounded-lg">
              <div
                class="pxp-areas-1-item-fig pxp-cover"
                style="background-image: url(images/pune.jpg)"
              ></div>
              <div class="pxp-areas-1-item-details">
                <div class="pxp-areas-1-item-details-area">Pune</div>
                <div class="pxp-areas-1-item-details-city">India</div>
              </div>
              <div class="pxp-areas-1-item-counter">
                <span>129 Properties</span>
              </div>
              <div class="pxp-areas-1-item-cta text-uppercase">Explore</div>
            </a>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-4">
            <a href="properties.html" class="pxp-areas-1-item rounded-lg">
              <div
                class="pxp-areas-1-item-fig pxp-cover"
                style="background-image: url(images/banglore.jpg)"
              ></div>
              <div class="pxp-areas-1-item-details">
                <div class="pxp-areas-1-item-details-area">Banglore</div>
                <div class="pxp-areas-1-item-details-city">India</div>
              </div>
              <div class="pxp-areas-1-item-counter">
                <span>324 Properties</span>
              </div>
              <div class="pxp-areas-1-item-cta text-uppercase">Explore</div>
            </a>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-4">
            <a href="properties.html" class="pxp-areas-1-item rounded-lg">
              <div
                class="pxp-areas-1-item-fig pxp-cover"
                style="background-image: url(images/Chandigarh.jpg)"
              ></div>
              <div class="pxp-areas-1-item-details">
                <div class="pxp-areas-1-item-details-area">Chandigarh</div>
                <div class="pxp-areas-1-item-details-city">India</div>
              </div>
              <div class="pxp-areas-1-item-counter">
                <span>158 Properties</span>
              </div>
              <div class="pxp-areas-1-item-cta text-uppercase">Explore</div>
            </a>
          </div>
        </div>

        <a
          href="properties.html"
          class="pxp-primary-cta text-uppercase mt-2 mt-md-4 pxp-animate"
          >Explore Neighborhoods</a
        >
      </div>

      <div
        class="pxp-cta-1 pxp-cover mt-100 pt-300"
        style="
          background-image: url(images/cta-fig-1.jpg);
          background-position: 50% 60%;
        "
      >
        <div class="container">
          <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4">
              <div class="pxp-cta-1-caption pxp-animate-in">
                <h2 class="pxp-section-h2">Search Smarter, From Anywhere</h2>
                <p class="pxp-text-light">
                  Experience homes in a smarter way with Virtual reality.
                  Explore your future home with timely listings and a seamless
                  experience.
                </p>
                <a
                  href="properties.html"
                  class="pxp-primary-cta text-uppercase mt-3 mt-md-5 pxp-animate"
                  >Search Now</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="container mt-100">
        <h2 class="pxp-section-h2">Our Featured Agents</h2>
        <p class="pxp-text-light">Meet the best real estate agents</p>

        <div class="row mt-4 mt-md-5">
          <div class="col-sm-12 col-md-6 col-lg-3">
            <a href="single-agent.html" class="pxp-agents-1-item">
              <div class="pxp-agents-1-item-fig-container rounded-lg">
                <div
                  class="pxp-agents-1-item-fig pxp-cover"
                  style="
                    background-image: url(images/agent-1.jpg);
                    background-position: top center;
                  "
                ></div>
              </div>
              <div class="pxp-agents-1-item-details rounded-lg">
                <div class="pxp-agents-1-item-details-name">Mukesh Chauhan</div>
                <div class="pxp-agents-1-item-details-email">
                  <span class="fa fa-phone"></span> +91 99999-99999
                </div>
                <div class="pxp-agents-1-item-details-spacer"></div>
                <div class="pxp-agents-1-item-cta text-uppercase">
                  More Details
                </div>
              </div>
              <div class="pxp-agents-1-item-rating">
                <span
                  ><span class="fa fa-star"></span
                  ><span class="fa fa-star"></span
                  ><span class="fa fa-star"></span
                  ><span class="fa fa-star"></span
                  ><span class="fa fa-star"></span
                ></span>
              </div>
            </a>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-3">
            <a href="single-agent.html" class="pxp-agents-1-item">
              <div class="pxp-agents-1-item-fig-container rounded-lg">
                <div
                  class="pxp-agents-1-item-fig pxp-cover"
                  style="
                    background-image: url(images/agent-2.jpg);
                    background-position: top center;
                  "
                ></div>
              </div>
              <div class="pxp-agents-1-item-details rounded-lg">
                <div class="pxp-agents-1-item-details-name">Sulekha Anand</div>
                <div class="pxp-agents-1-item-details-email">
                  <span class="fa fa-phone"></span> +91 99999-99999
                </div>
                <div class="pxp-agents-1-item-details-spacer"></div>
                <div class="pxp-agents-1-item-cta text-uppercase">
                  More Details
                </div>
              </div>
              <div class="pxp-agents-1-item-rating">
                <span
                  ><span class="fa fa-star"></span
                  ><span class="fa fa-star"></span
                  ><span class="fa fa-star"></span
                  ><span class="fa fa-star"></span
                  ><span class="fa fa-star-o"></span
                ></span>
              </div>
            </a>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-3">
            <a href="single-agent.html" class="pxp-agents-1-item">
              <div class="pxp-agents-1-item-fig-container rounded-lg">
                <div
                  class="pxp-agents-1-item-fig pxp-cover"
                  style="
                    background-image: url(images/agent-3.jpg);
                    background-position: top center;
                  "
                ></div>
              </div>
              <div class="pxp-agents-1-item-details rounded-lg">
                <div class="pxp-agents-1-item-details-name">
                  Piyush Pandey
                </div>
                <div class="pxp-agents-1-item-details-email">
                  <span class="fa fa-phone"></span> +91 99999-99999
                </div>
                <div class="pxp-agents-1-item-details-spacer"></div>
                <div class="pxp-agents-1-item-cta text-uppercase">
                  More Details
                </div>
              </div>
              <div class="pxp-agents-1-item-rating">
                <span
                  ><span class="fa fa-star"></span
                  ><span class="fa fa-star"></span
                  ><span class="fa fa-star"></span
                  ><span class="fa fa-star"></span
                  ><span class="fa fa-star"></span
                ></span>
              </div>
            </a>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-3">
            <a href="single-agent.html" class="pxp-agents-1-item">
              <div class="pxp-agents-1-item-fig-container rounded-lg">
                <div
                  class="pxp-agents-1-item-fig pxp-cover"
                  style="
                    background-image: url(images/agent-4.jpg);
                    background-position: top center;
                  "
                ></div>
              </div>
              <div class="pxp-agents-1-item-details rounded-lg">
                <div class="pxp-agents-1-item-details-name">Sarita Kumari</div>
                <div class="pxp-agents-1-item-details-email">
                  <span class="fa fa-phone"></span> +91 99999-99999
                </div>
                <div class="pxp-agents-1-item-details-spacer"></div>
                <div class="pxp-agents-1-item-cta text-uppercase">
                  More Details
                </div>
              </div>
              <div class="pxp-agents-1-item-rating">
                <span
                  ><span class="fa fa-star"></span
                  ><span class="fa fa-star"></span
                  ><span class="fa fa-star"></span
                  ><span class="fa fa-star"></span
                  ><span class="fa fa-star-o"></span
                ></span>
              </div>
            </a>
          </div>
        </div>

        <a
          href="agents.html"
          class="pxp-primary-cta text-uppercase mt-1 mt-md-4 pxp-animate"
          >See All Agents</a
        >
      </div>

      <!-- Testimonials section start-->
      <div
        class="pxp-testim-1 pt-100 pb-100 mt-100 pxp-cover"
        style="background-image: url(images/testim-1-fig.jpg)"
      >
        <div class="pxp-testim-1-intro">
          <h2 class="pxp-section-h2">Customer Testimonials</h2>
          <p class="pxp-text-light">What our customers say about us</p>
          <a
            href="#"
            class="pxp-primary-cta text-uppercase mt-2 mt-md-3 mt-lg-5 pxp-animate"
            >Read All Stories</a
          >
        </div>
        <div class="pxp-testim-1-container mt-4 mt-md-5 mt-lg-0">
          <div class="owl-carousel pxp-testim-1-stage">
            <div>
              <div class="pxp-testim-1-item">
                <div
                  class="pxp-testim-1-item-avatar pxp-cover"
                  style="background-image: url(images/customer-1.jpg)"
                ></div>
                <div class="pxp-testim-1-item-name">Rupesh Singh</div>
                <div class="pxp-testim-1-item-location">Sarojini Nagar, Delhi</div>
                <div class="pxp-testim-1-item-message">
                  While DoorsTour functions like a traditional broker, the
                  company's promise is using technology to reduce the time and
                  friction of buying and selling house or apartment.
                </div>
              </div>
            </div>
            <div>
              <div class="pxp-testim-1-item">
                <div
                  class="pxp-testim-1-item-avatar pxp-cover"
                  style="background-image: url(images/customer-3.jpg)"
                ></div>
                <div class="pxp-testim-1-item-name">Rohindra Kumar</div>
                <div class="pxp-testim-1-item-location">Rohini, Delhi</div>
                <div class="pxp-testim-1-item-message">
                  DoorsTour made my life easy. It helped me with the search for my first ever investment i.e. 2BHK apartment in Rohini, Delhi. Thanks to the team for providing assistance.
                </div>
              </div>
            </div>
            <div>
              <div class="pxp-testim-1-item">
                <div
                  class="pxp-testim-1-item-avatar pxp-cover"
                  style="background-image: url(images/customer-2.jpg)"
                ></div>
                <div class="pxp-testim-1-item-name">Lakshay Goel</div>
                <div class="pxp-testim-1-item-location">Karol Bagh, New Delhi</div>
                <div class="pxp-testim-1-item-message">

I was looking for a flat in Karol Bagh and DoorsTour website helped me get one smoothly. I could choose not just the property but also check what others had to say about the area.
                </div>
              </div>
            </div>
            <div>
              <div class="pxp-testim-1-item">
                <div
                  class="pxp-testim-1-item-avatar pxp-cover"
                  style="background-image: url(images/customer-4.jpg)"
                ></div>
                <div class="pxp-testim-1-item-name">Aayush Kapoor</div>
                <div class="pxp-testim-1-item-location">Greater Kailash, Delhi</div>
                <div class="pxp-testim-1-item-message">
                  And it’s no wonder DoorsTour has shaken things up: As anyone
                  who’s ever tried to rent or buy property in Greater Kailash knows,
                  the experience is loaded with pain points.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Testimonials Section end -->

      <!-- Blog section start -->
      <div class="container mt-100">
        <h2 class="pxp-section-h2">From Our Blog</h2>
        <p class="pxp-text-light">Read our latest articles on real estate.</p>
        <div class="row mt-4 mt-md-5">
          <div class="col-sm-12 col-md-6 col-lg-4">
            <a href="single-post.html" class="pxp-posts-1-item">
              <div class="pxp-posts-1-item-fig-container">
                <div
                  class="pxp-posts-1-item-fig pxp-cover"
                  style="background-image: url(images/posts-1.jpg)"
                ></div>
              </div>
              <div class="pxp-posts-1-item-details">
                <div class="pxp-posts-1-item-details-category">
                  Interior Design
                </div>
                <div class="pxp-posts-1-item-details-title">
                  What to Expect When Working with an Interior Designer
                </div>
                <div class="pxp-posts-1-item-details-date mt-2">
                  April 9, 2019
                </div>
                <div class="pxp-posts-1-item-cta text-uppercase">
                  Read Article
                </div>
              </div>
            </a>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-4">
            <a href="single-post.html" class="pxp-posts-1-item">
              <div class="pxp-posts-1-item-fig-container">
                <div
                  class="pxp-posts-1-item-fig pxp-cover"
                  style="background-image: url(images/posts-2.jpg)"
                ></div>
              </div>
              <div class="pxp-posts-1-item-details">
                <div class="pxp-posts-1-item-details-category">
                  Architecture
                </div>
                <div class="pxp-posts-1-item-details-title">
                  Private Contemporary Home Balancing Openness
                </div>
                <div class="pxp-posts-1-item-details-date mt-2">
                  April 9, 2019
                </div>
                <div class="pxp-posts-1-item-cta text-uppercase">
                  Read Article
                </div>
              </div>
            </a>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-4">
            <a href="single-post.html" class="pxp-posts-1-item">
              <div class="pxp-posts-1-item-fig-container">
                <div
                  class="pxp-posts-1-item-fig pxp-cover"
                  style="background-image: url(images/posts-3.jpg)"
                ></div>
              </div>
              <div class="pxp-posts-1-item-details">
                <div class="pxp-posts-1-item-details-category">
                  Interior Design
                </div>
                <div class="pxp-posts-1-item-details-title">
                  Stylish Modern Ranch Exuding a Welcoming Feel
                </div>
                <div class="pxp-posts-1-item-details-date mt-2">
                  April 9, 2019
                </div>
                <div class="pxp-posts-1-item-cta text-uppercase">
                  Read Article
                </div>
              </div>
            </a>
          </div>
        </div>
        <a
          href="blog.html"
          class="pxp-primary-cta text-uppercase mt-2 mt-md-4 pxp-animate"
          >Read More</a
        >
      </div>
      <!-- Blog section end -->

      <!-- Newsletter start -->
      <div
        class="pxp-full pxp-cover pt-100 pb-100 mt-100"
        style="background-image: url(images/newsletter-1-fig.jpg)"
      >
        <div class="container">
          <h2 class="pxp-section-h2">Stay Up to Date</h2>
          <p class="pxp-text-light">
            Subscribe to our newsletter to receive our weekly feed
          </p>
          <div class="row mt-4 mt-md-5">
            <div class="col-sm-12 col-md-6">
              <form
                action="http://pixelprime.co/themes/resideo/light/index-2.html"
                class="pxp-newsletter-1-form"
              >
                <input
                  type="text"
                  class="form-control"
                  placeholder="Enter your email..."
                />
                <a
                  href="#"
                  class="pxp-primary-cta text-uppercase pxp-animate mt-3 mt-md-4"
                  >Subscribe</a
                >
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Newsletter End -->

      <!-- <div class="container mt-100">
        <h2 class="pxp-section-h2 text-center">Membership Plans</h2>
        <p class="pxp-text-light text-center">
          Choose the plan that suits you best
        </p>
        <div class="row mt-5">
          <div class="col-sm-12 col-md-6 col-lg-4">
            <a href="#" class="pxp-plans-1-item">
              <div class="pxp-plans-1-item-fig">
                <img src="images/plan-personal.svg" alt="..." />
              </div>
              <div class="pxp-plans-1-item-title">Personal</div>
              <ul class="pxp-plans-1-item-features list-unstyled">
                <li>10 Listings</li>
                <li>2 Featured Listings</li>
              </ul>
              <div class="pxp-plans-1-item-price">
                <span class="pxp-plans-1-item-price-sum">Free</span>
                <span class="pxp-plans-1-item-price-period"> / 1 month</span>
              </div>
              <div class="pxp-plans-1-item-cta text-uppercase">Choose Plan</div>
            </a>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-4">
            <a href="#" class="pxp-plans-1-item pxp-is-popular">
              <div class="pxp-plans-1-item-label">Most Popular</div>
              <div class="pxp-plans-1-item-fig">
                <img src="images/plan-professional.svg" alt="..." />
              </div>
              <div class="pxp-plans-1-item-title">Professional</div>
              <ul class="pxp-plans-1-item-features list-unstyled">
                <li>10 Listings</li>
                <li>2 Featured Listings</li>
              </ul>
              <div class="pxp-plans-1-item-price">
                <span class="pxp-plans-1-item-price-currency">$</span>
                <span class="pxp-plans-1-item-price-sum">49.99</span>
                <span class="pxp-plans-1-item-price-period"> / 6 months</span>
              </div>
              <div class="pxp-plans-1-item-cta text-uppercase">Choose Plan</div>
            </a>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-4">
            <a href="#" class="pxp-plans-1-item">
              <div class="pxp-plans-1-item-fig">
                <img src="images/plan-business.svg" alt="..." />
              </div>
              <div class="pxp-plans-1-item-title">Business</div>
              <ul class="pxp-plans-1-item-features list-unstyled">
                <li>10 Listings</li>
                <li>2 Featured Listings</li>
              </ul>
              <div class="pxp-plans-1-item-price">
                <span class="pxp-plans-1-item-price-currency">$</span>
                <span class="pxp-plans-1-item-price-sum">99.99</span>
                <span class="pxp-plans-1-item-price-period"> / 1 year</span>
              </div>
              <div class="pxp-plans-1-item-cta text-uppercase">Choose Plan</div>
            </a>
          </div>
        </div>
      </div>
    </div> -->

    <div class="pxp-footer pt-100 pb-100 mt-100">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-lg-4">
            <div class="pxp-footer-logo">DoorsTour</div>
            <div class="pxp-footer-address mt-2">
              <p>
                Launched in 2020, DoorsTour is India's fastest growing online
                Property marketplace to buy, sell, and rent residential and
                commercial properties. Experience every property in 360 view,
                DoorsTour is the most preferred real estate portal in India by
                various independent surveys.
              </p>
            </div>
          </div>
          <div class="col-sm-12 col-lg-8">
            <div class="row">
              <div class="col-sm-12 col-md-4">
                <h4 class="pxp-footer-header mt-4 mt-lg-0">Company</h4>
                <ul class="list-unstyled pxp-footer-links mt-2">
                  <li><a href="about.html">About Us</a></li>
                  <li><a href="agents.html">Agents</a></li>
                  <li><a href="blog.html">Blog</a></li>
                  <li><a href="#">Sitemap</a></li>
                  <li><a href="contact.html">Contact Us</a></li>
                </ul>
              </div>
              <div class="col-sm-12 col-md-4">
                <h4 class="pxp-footer-header mt-4 mt-lg-0">Actions</h4>
                <ul class="list-unstyled pxp-footer-links mt-2">
                  <li><a href="properties.html">Buy Properties</a></li>
                  <li><a href="properties.html">Rent Properties</a></li>
                  <li><a href="submit-property.html">Sell Properties</a></li>
                </ul>
              </div>
              <div class="col-sm-12 col-md-4">
                <h4 class="pxp-footer-header mt-4 mt-lg-0">Explore</h4>
                <ul class="list-unstyled pxp-footer-links mt-2">
                  <li><a href="properties.html">Homes for Rent</a></li>
                  <li><a href="properties.html">Apartments for Rent</a></li>
                  <li><a href="properties.html">Homes for Sale</a></li>
                  <li><a href="properties.html">Apartments for Sale</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row pxp-footer-social mt-2">
      <div class="col-md-12" style="text-align: center">
        <a href="https://www.instagram.com/doorstourindia/"><span class="fa fa-instagram"></span></a>
        <a href="https://www.facebook.com/doorstourindia/"><span class="fa fa-facebook-square"></span></a>
        <a href="https://twitter.com/doorstour1?s=08"><span class="fa fa-twitter"></span></a>
        <a href="https://www.linkedin.com/company/doorstour/"><span class="fa fa-linkedin"></span></a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12" style="text-align: center">
        <div class="pxp-footer-bottom mt-2">
          <div>
            <a href="termsncond.html">Terms & Conditions</a> and
            <a href="privacypolicy.html">Privacy Policy</a>
          </div>
          <div class="pxp-footer-copyright">
            &copy; DoorsTour All Rights Reserved. 2020
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="pxp-signin-modal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="pxpSigninModal"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h5 class="modal-title" id="pxpSigninModal">Welcome back!</h5>
            <form action="signin.php" method="post" class="mt-4">
              <div class="form-group">
                <label for="pxp-signin-email">Email</label>
                <input
                  type="text"
                  class="form-control"
                  id="pxp-signin-email"
                  placeholder="Enter your email address" name="email"
                />
              </div>
              <div class="form-group">
                <label for="pxp-signin-pass">Password</label>
                <input
                  type="password"
                  class="form-control"
                  id="pxp-signin-pass"
                  placeholder="Enter your password" name="password"
                />
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-success btn-block">Sign in</button>
              </div>
              <div class="form-group mt-4 text-center pxp-modal-small">
                <a href="#" class="pxp-modal-link">Forgot password</a>
              </div>
              <div class="text-center pxp-modal-small">
                New to DoorsTour?
                <a
                  href="javascript:void(0);"
                  class="pxp-modal-link pxp-signup-trigger"
                  >Create an account
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="pxp-signup-modal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="pxpSignupModal"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h5 class="modal-title" id="pxpSignupModal">Create an account</h5>
            <form action="signup.php" method="post" class="mt-4">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="pxp-signup-firstname">First Name</label>
                    <input
                      type="text"
                      class="form-control"
                      id="pxp-signup-firstname"
                      placeholder="Enter first name" name="firstname"
                    />
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="pxp-signup-lastname">Last Name</label>
                    <input
                      type="text"
                      class="form-control"
                      id="pxp-signup-lastname"
                      placeholder="Enter last name" name="lastname"
                    />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="pxp-signup-email">Email</label>
                <input
                  type="text"
                  class="form-control"
                  id="pxp-signup-email"
                  placeholder="Enter your email address" name="email"
                />
              </div>
              <div class="form-group">
                <label for="pxp-signup-pass">Password</label>
                <input
                  type="password"
                  class="form-control"
                  id="pxp-signup-pass"
                  placeholder="Create a password" name="password"
                />
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-success btn-block">Sign up</button>
                <?php
                   if($login_button == '')
                   {
                    echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
                    echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
                    echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
                    echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
                    echo '<h3><a href="logout.php">Logout</h3></div>';
                   }
                   else
                   {
                    echo '<div align="center">'.$login_button . '</div>';
                   }
                ?>
              </div>
              <div class="text-center mt-4 pxp-modal-small">
                Already have an account?
                <a
                  href="javascript:void(0);"
                  class="pxp-modal-link pxp-signin-trigger"
                  >Sign in</a
                >
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main3813.js?lasjkj"></script>
  </body>

  <!-- Mirrored from pixelprime.co/themes/resideo/light/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 06 Oct 2020 05:14:36 GMT -->
</html>
