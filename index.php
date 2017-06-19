<!DOCTYPE html>
<html lang="en">
  <?php
             include_once('login.php'); 
  include_once('css_js.php');
  ?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Course File</title>
    <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
    <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">
    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Candal|Alegreya+Sans">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/imagehover.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        #imgnitc{
            box-shadow: 0px 0px 15px;
            border-radius: 27px;
            transition:0.5 linear;
        }
        #imgnitc:hover{
            box-shadow: 10px 10px 15px;
            border-radius: 27px;
            transition: 0.5  linear;
        }
        #organisations{
            box-shadow: 0px 0px 15px;
        }
        #courses{
            box-shadow: 0px 0px 15px inset;
        }
        .nav li{
          border-bottom:2px solid red;
          transition:0.5s linear;
        }

        .nav li:hover{
          border-top:2px solid red;
          border-left:2px solid red;
          border-right:2px solid red;
          border-bottom:none;
		  box-shadow:inset 0px -100px 0px green;

        }

      </style>
  </head>
  
  <body>
    <!--Navigation bar-->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html"><img src="images/nitc.jpg" class="img img-responsive"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right" style="padding-top:40px;">
          <li><a href="#banner">Home</a></li>
          <li><a href="#organisations">About Us</a></li>
          <li><a href="#courses">Photo Gallery</a></li>
          <li><a href="http://www.nitc.ac.in">CSED Site</a></li>
          <li><a href="#login" data-toggle="modal">Login</a></li>
          
        </ul>
        </div>
      </div>
    </nav>
    <!--/ Navigation bar-->
    <!--Modal box-->
    <div class="modal fade" id="login" role="dialog">
      <div class="modal-dialog modal-sm">
      
        <!-- Modal content no 1-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title text-center form-title">Login</h4>
          </div>
          <div class="modal-body padtrbl">

            <div class="login-box-body">
              <p class="login-box-msg">Sign in to start your session</p>
              <div class="form-group">
                <form name="" id="loginForm">
                 <div class="form-group has-feedback"> <!----- username -------------->
                      <input class="form-control" placeholder="Username"  id="loginid" type="text" autocomplete="off" /> 
            <span style="display:none;font-weight:bold; position:absolute;color: red;position: absolute;padding:4px;font-size: 11px;background-color:rgba(128, 128, 128, 0.26);z-index: 17;  right: 27px; top: 5px;" id="span_loginid"></span><!---Alredy exists  ! -->
                      <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  </div>
                  <div class="form-group has-feedback"><!----- password -------------->
                      <input class="form-control" placeholder="Password" id="loginpsw" type="password" autocomplete="off" />
            <span style="display:none;font-weight:bold; position:absolute;color: grey;position: absolute;padding:4px;font-size: 11px;background-color:rgba(128, 128, 128, 0.26);z-index: 17;  right: 27px; top: 5px;" id="span_loginpsw"></span><!---Alredy exists  ! -->
                      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                  </div>
                  <div class="row">
                      <div class="col-xs-12">
                          <div class="checkbox icheck">
                              <label>
                                <input type="checkbox" id="loginrem" > Remember Me
                              </label>
                          </div>
                      </div>
                      <div class="col-xs-12">
                          <button type="button" class="btn btn-green btn-block btn-flat" onclick="userlogin()">Sign In</button>
                      </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <!--/ Modal box-->
    <!--Banner-->
    <div class="banner" id="banner">
      <div class="bg-color">
        <div class="container">
          <div class="row">
            <div class="banner-text text-center">
              <br/>
              <br/>
              <br/>
              <br/>
              <br/>
              <br/>
              <div class="text-border">

                <h2 class="text-dec">Course file generator </h2>
              </div>
              <div class="intro-para text-center quote">
                <p class="big-text"></p>
                <p class="small-text"></p>
              </div>
              <a href="#feature" class="mouse-hover"><div class="mouse"></div></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/ Banner-->
    <!--Feature-->
    <section id ="feature" class="section-padding">
      <div class="container">
        <div class="row">
          
          <div class="feature-info">
            <div class="fea">
              <div class="col-md-4">
                <div class="heading pull-right">
                  <h4>Latest Technologies</h4>
                  <p>Donec et lectus bibendum dolor dictum auctor in ac erat. Vestibulum egestas sollicitudin metus non urna in eros tincidunt convallis id id nisi in interdum.</p>
                </div>
                <div class="fea-img pull-left">
                  <i class="fa fa-css3"></i>
                </div>
              </div>
            </div>
            <div class="fea">
              <div class="col-md-4">
                <div class="heading pull-right">
                  <h4>Latest Reasearch Papers </h4>
                  <p>Donec et lectus bibendum dolor dictum auctor in ac erat. Vestibulum egestas sollicitudin metus non urna in eros tincidunt convallis id id nisi in interdum.</p>
                </div>
                <div class="fea-img pull-left">
                  <i class="fa fa-drupal"></i>
                </div>
              </div>
            </div>
            <div class="fea">
              <div class="col-md-4">
                <div class="heading pull-right">
                  <h4>Award and Achivments</h4>
                  <p>Donec et lectus bibendum dolor dictum auctor in ac erat. Vestibulum egestas sollicitudin metus non urna in eros tincidunt convallis id id nisi in interdum.</p>
                </div>
                <div class="fea-img pull-left">
                  <i class="fa fa-trophy"></i>
                </div>
              </div>
            </div>
        </div>
        </div>
      </div>
    </section>
    <!--/ feature-->
    <!--Organisations-->
    <section id ="organisations" class="section-padding">
      <div class="container">
        <div class="row">
            <h1 align="center">ABOUT</h1>
            <hr size="5">
          <div class="col-md-6" style="padding-top: 70px;">
                   
               <!--<h1 align="center">This is all about nitc </h1>-->
                <img src="img/course01.jpg" class="img img-responsive img-thuimbnail" id="imgnitc">
          </div>
          <div class="col-md-6">
            <div class="detail-info">
              
             <!-- <p class="det-p">Set in align=lefta picturesque landscape at the foothills of the Western Ghats, National Institute of Technology Calicut (NITC) is located about 22 kilometers north-east of Calicut City. National Institute of Technology Calicut is a Technical Institution of national importance set up by an Act of parliament(Act 29 of 2007) namely, the National Institute of technology Act 2007, which received the assent of the President of India on 5th June,2007. The provision of the Act have come into force with effect from 15th August,2007 as per Notification S.O.1384(E) dated 9th August, 2007 of the MHRD(Dept. of Higher Education),New Delhi. As per the provision of the said Act, this Institution runs on non profitable basis.</p>-->
             <h4 style="font:Lucida Sans Unicode;line-height:150%"><center><p><h1>Welcome To National Institute Of Technology Calicut.</h1></p></center>
<center><p>"FROM DARKNESS LEAD US TO LIGHT"</p>
</center>
<p>A place where "Unity in diversity" gets true. 
Regional Engineering College, Calicut was established in 1961 and converted into an National Institute of Technology on June 26, 2002.  According to the National Institutional Ranking Framework (NIRF), the institute is ranked 35 in the 2016 engineering university rankings. The college started with an annual intake of 125 students for the undergraduate courses, on a campus of 120 hectares (1.2 km2). With an academic staff of 205,and student intake of undergraduate 4200 and postgraduates 1100 our prestigious college stands among the top colleges in the country.</p>
.<a href="https://en.wikipedia.org/wiki/National_Institute_of_Technology_Calicut" target ="_blank">continue reading ...</a>
      </h4>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--/ Organisations-->
   
   
   
    <!--Courses-->
    <section id ="courses" class="section-padding">
      <div class="container">
        <div class="row">
          <div class="header-section text-center">
            <h2>NITC PHOTO GALARY</h2>
            
            <hr class="bottom-line">
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-6 padleft-right">
            <figure class="imghvr-fold-up">
              <img src="img/course01.jpg" class="img-responsive">
              <figcaption>
                  <h3>NITC MAIN GATE</h3>
                  <p></p>
              </figcaption>
              <a href="#"></a>
            </figure>
          </div>
          <div class="col-md-4 col-sm-6 padleft-right">
            <figure class="imghvr-fold-up">
              <img src="img/course02.jpg" class="img-responsive">
              <figcaption>
                  <h3>NITC CENTRAL CIRCLE</h3>
                  <p></p>
              </figcaption>
              <a href="#"></a>
            </figure>
          </div>
          <div class="col-md-4 col-sm-6 padleft-right">
            <figure class="imghvr-fold-up">
              <img src="img/course03.jpg" class="img-responsive">
              <figcaption>
                  <h3>NITC ADMINISTRATION BLOCK</h3>
                  <p></p>
              </figcaption>
              <a href="#"></a>
            </figure>
          </div>
          <div class="col-md-4 col-sm-6 padleft-right">
            <figure class="imghvr-fold-up">
              <img src="img/course04.jpg" class="img-responsive">
              <figcaption>
                  <h3>NITC MAIN BUILDING</h3>
                  <p></p>
              </figcaption>
              <a href="#"></a>
            </figure>
          </div>
          <div class="col-md-4 col-sm-6 padleft-right">
            <figure class="imghvr-fold-up">
              <img src="img/course05.jpg" class="img-responsive">
              <figcaption>
                  <h3>NITC MBA HOSTEL</h3>
                  <p></p>
              </figcaption>
              <a href="#"></a>
            </figure>
          </div>
          <div class="col-md-4 col-sm-6 padleft-right">
            <figure class="imghvr-fold-up">
              <img src="img/course06.jpg" class="img-responsive">
              <figcaption>
                  <h3>NITC NLHC BUILDING</h3>
                  <p></p>
              </figcaption>
              <a href="#"></a>
            </figure>
          </div>
        </div>
      </div>
    </section>
    <!--/ Courses-->
  
    <!--Footer-->
    <footer id="footer" class="footer">
      <div class="container text-center">
    
     
   
      <ul class="social-links">
        <li><a href="#link"><i class="fa fa-twitter fa-fw"></i></a></li>
        <li><a href="#link"><i class="fa fa-facebook fa-fw"></i></a></li>
        <li><a href="#link"><i class="fa fa-google-plus fa-fw"></i></a></li>
        <li><a href="#link"><i class="fa fa-dribbble fa-fw"></i></a></li>
        <li><a href="#link"><i class="fa fa-linkedin fa-fw"></i></a></li>
      </ul>
        ©2017 Course File Generator. All rights reserved
        <div class="credits">
           
            Designed by <a href="/">Sandeep Kumar </a>
        </div>
      </div>
    </footer>
    <!--/ Footer-->
    
    
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="contactform/contactform.js"></script>
    
  </body>
</html>