 <section id="about">
      <div class="dark-section">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title" class="text-center">About Us</h3>
          <div class="section-title-divider"></div>
            <h4 class="text-center">Get to know about us.</h4>
          <!-- <p class="section-description">Get to know about us.</p> -->
       
      <!-- <div class="row">
          <div class="col-md-6 col-md-push-6 about-content">
          <h2 class="about-title">Vision</h2>
          <p class="about-text">
            <?php echo $detail->vision ?>
          </p>
          <h2 class="about-title">Mission</h2>
          <p class="about-text">
            <?php echo $detail->mission ?>
          </p>
          <h2 class="about-title">About the site</h2>
          <p class="about-text">
            <?php echo $detail->description ?>
          </p>
      </div>
        </div> -->
    <div class="container about-container wow fadeInUp">

<div class="container site-section" id="why">
            <div class="row">
                <div class="col-md-4 item">
                    <h3 class="about-title">Vision</h3>
          <p class="about-text">
            <?php echo $detail->vision ?>
          </p>
              </div>
                <div class="col-md-4 item"> 
                  <h3 class="about-title">Mission</h3>
          <p class="about-text">
            <?php echo $detail->mission ?>
          </p>
                </div>
                    
                <div class="col-md-4 item">
                     <h3 class="about-title">Site Details</h3>
          <p class="about-text">
            <?php echo $detail->description ?>
          </p>
                </div>
            </div>
        </div>
    </div>
      </div>
       </div>
    </div>



    </div>
    </div>
  </section>
  
<!--==========================
  Search Section
============================-->
  <section id="services">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">Search Property</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">In this section, this allows you to search for property of your interest. <br class="hidden-sm hidden-xs" >Just key in the Last Name of the property owner and we'll do our best to display it to you. </p>
        </div>
      </div>
    </div>
    <div class="container about-container wow fadeInUp">
      <div class="row">
        <div class="col-md-4 col-md-push-4">
          <form class="form-signin" action="<?php echo base_url('home/search/') ?>" method="GET">
            <div class="form-group">
              
               <div class="hidden-sm hidden-xs" >
                <label for="" style="line-height:45px;" class="col-md-4 control-label text-right namesearch">Name</label>
             </div>
              <div class="col-md-8">
                <input type="text" class="form-control input-lg" placeholder="Enter the name you like to Search" name="searchQuery"  required>
              </div>
            </div>
            <div class="form-group actions">
              <div class="col-md-4 col-md-push-2">
                <br><input type="submit" class="form-control btn btn-primary active btn-signin" value="SEARCH">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  
<!--==========================
Calculator Section
============================-->
 <div class="dark-section">
  <section id="calculator">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">Appraisal and Assessment Calculator</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">This section will allow you to Calculate te Market Value of Your property. <br> However this is only limited to lands in particular and other improvements such as plants and trees. <br>
          Note: Calculated value is not the actual value of your property. This is just an estimated value of your property to serve as guide that will serve your interest.</p>
          <p ></p>
        </div>
      </div>
        


        <div class="container site-section" id="plants">
            <h4 class="text-center">Select from the following options below to start the calculator widget.</h4>
            <div class="row">
                <div class="col-md-4 item">
                    <h3 class="service-title"><a href="<?php echo base_url('home/calculator/agricultural') ?>"><label>Agricultural Lands</label> <i class="glyphicon glyphicon-grain"></i></a></h3>
          <p class="service-description">
            <b>Category includes:</b><br>
            Rice Land Irrigated <br> Rice Land Unirrigated <br>Corn Land <br>Coconut Land <br> Sugar Land <br> Fis Pond <br> Nipa Land <br> Peanut Land <br> more...
          </p>  
                </div>
                <div class="col-md-4 item">
                     <h3 class="service-title"><a href="<?php echo base_url('home/calculator/land') ?>"><label>Land</label>  <i class="fa fa-align-right"></i></a></h3>
          <p class="service-description"><b>Category includes:</b> <br> Residential Land <br> Commercial Land <br> Industrial Land </p>
                </div>
                <div class="col-md-4 item">
                    <h3 class="service-title"><a href="<?php echo base_url('home/calculator/improvements') ?>"><label>Plants/Trees</label> <i class="glyphicon glyphicon-tree-deciduous"></i></a></h3>
                     <p class="service-description"><b>Category includes:</b> <br> Abaca (per group) <br> Atis <br> Avocado <br>Bamboo (Tangnan, Patong per clump) <br> Banana (per group) <br>Cacao <br> Caimito <br> Cahil <br> more... <br> </p>
                </div>
            </div>
    </div>
        </div>
    

  
        
        
      </div>
    </div>  
  </section>
  
<!--==========================
  Subscrbe Section
============================-->  
 
    
<!--==========================
  Contact Section
============================--> 
  <!-- <section id="contact">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">Contact Us</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-3 col-md-push-2">
          <div class="info">
            <div>
              <i class="fa fa-map-marker"></i>
              <p>A108 Adam Street<br>New York, NY 535022</p>
            </div>
            
            <div>
              <i class="fa fa-envelope"></i>
              <p>info@example.com</p>
            </div>
            
            <div>
              <i class="fa fa-phone"></i>
              <p>+1 5589 55488 55s</p>
            </div>
            
          </div>
        </div>
        
        <div class="col-md-5 col-md-push-2">
          <div class="form">
            <div id="sendmessage">Your message has been sent. Thank you!</div>
            <div id="errormessage"></div>
            <form action="" method="post" role="form" class="contactForm">
                <div class="form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validation"></div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validation"></div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                  <div class="validation"></div>
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                  <div class="validation"></div>
                </div>
                <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>
        </div>
        
      </div>
    </div>
  </section>
  
 -->