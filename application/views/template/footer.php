<!--==========================
  Footer
============================--> 

  <footer>
        <div class="row">
            <div class="col-md-4 col-sm-6 footer-navigation">
                <img src="<?php echo base_url('assets/img/Iasses.png') ?>" id="logo">
                <!-- <p class="links"><a href="#">Home</a><strong> · </strong><a href="#">Repots </a><strong> · </strong><a href="#">Users </a><strong> · </strong><a href="#">Logs </a><strong> · </strong><a href="#">Faq</a><strong> · </strong></p> -->
                <p class="company-name"><strong>Assessor's Integrated App © <?php echo date('Y') ?> </strong></p>
            </div>
            <div class="col-md-4 col-sm-6 footer-contacts">
                <div><span class="fa fa-map-marker footer-contacts-icon"> </span>
                    <p><span class="new-line-span">Municipality of <?php echo $detail->municipality ?></span> Province of <?php echo $detail->province ?></p>
                </div>
                <div><i class="fa fa-phone footer-contacts-icon"></i>
                    <p class="footer-center-info email text-left"> <?php echo $detail->contact ?></p>
                </div>
                <div><i class="fa fa-envelope footer-contacts-icon"></i>
                    <p> <a href="#" target="_blank"><?php echo $detail->email ?></a></p>
                </div>
            </div>
            <div class="clearfix visible-sm-block"></div>
            <div class="col-md-4 footer-about">
                <h4>Site Details</h4>
                <p> This system iAssess: Municipal Assessor's Integrated App, is a web application for real property Appraisal, Assessment and Taxation System to help the office run the errands faster and efficient. The system intent to provide both the office and its clienteles to information dissemination as to the interest of both parties.
                </p>
                <!-- <div class="social-links social-icons"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-linkedin"></i></a><a href="#"><i class="fa fa-github"></i></a></div> -->
            </div>
        </div>
    </footer>
     
  
  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    
  <!-- Required JavaScript Libraries -->
  
  
  <script src="<?php echo base_url('assets/lib/superfish/hoverIntent.js') ?>"></script>
  <script src="<?php echo base_url('assets/lib/superfish/superfish.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/lib/morphext/morphext.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/lib/wow/wow.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/lib/stickyjs/sticky.js') ?>"></script>
  <script src="<?php echo base_url('assets/lib/easing/easing.min.js') ?>"></script>
  
  <!-- Template Specisifc Custom Javascript File -->
  <script src="<?php echo base_url('assets/js/custom.js') ?>"></script>
  
  <!-- <script src="http://localhost/iassess/assets/contactform/contactform.js"></script> -->
  <!-- <script src="http://localhost/iassess/assets/js/nav.js"></script> -->
  
  <?php foreach ($js as $key => $file): ?>
     <script src="<?php echo base_url('assets/js/'.$file.'.js') ?>"></script>
  <?php endforeach; ?>  
    
</body>
</html>