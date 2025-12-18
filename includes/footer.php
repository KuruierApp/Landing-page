    <!-- Footer-Section start -->
    <footer class="white_text" data-aos="fade-in" data-aos-duration="1500">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="logo_side">
              <div class="logo">
                <a href="index.php">
                  <img src="images/logo.svg" alt="Logo">
                </a>
              </div>
              <div class="news_letter" id="newsletter-form">
                <h3>Subscribe newsletter</h3>
                <p>Be the first to recieve all latest post in your inbox</p>
                <form action="send_email.php" method="POST" class="newsletter-form" onsubmit="this.querySelector('.submit-btn').classList.add('loading')">
                  <input type="hidden" name="form_type" value="newsletter">
                  <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Enter your email"
                      required>
                    <button class="btn submit-btn" type="submit">
                      <i class="icofont-paper-plane btn-icon"></i>
                      <span class="spinner"></span>
                    </button>
                  </div>
                  <p class="note">By clicking send link you agree to receive marketing emails.</p>
                </form>
                <?php if (isset($_GET['subscribed']) && $_GET['subscribed'] == '1'): ?>
                <p class="success-message" style="color: #4CAF50; font-size: 14px; margin-top: 10px;">✅ Thank you for subscribing!</p>
                <?php endif; ?>
              </div>
              <ul class="contact_info">
                <li><a href="mailto:support@kuruier.com">support@kuruier.com</a></li>
                <li><a href="tel:+918122753458">+91-812 275 3458</a></li>
              </ul>
              <ul class="social_media">
                <li><a href="https://www.facebook.com/profile.php?id=61567260038867" target="_blank"
                    rel="noopener noreferrer"><i class="icofont-facebook"></i></a></li>
                <li><a href="https://www.instagram.com/kuruier05/" target="_blank" rel="noopener noreferrer"><i
                      class="icofont-instagram"></i></a></li>
                <li><a href="https://www.linkedin.com/company/kuruier/" target="_blank" rel="noopener noreferrer"><i
                      class="icofont-linkedin"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-6">
            <div class="download_side">
              <h3>Download app</h3>
              <ul class="app_btn">
                <li>
                  <a href="https://play.google.com/store/apps/details?id=com.marseltechlabs.kuruier" target="_blank"
                    rel="noopener noreferrer">
                    <img class="blue_img" src="images/googleplay.png" alt="image">
                  </a>
                </li>
                <li>
                  <a href="https://apps.apple.com/in/app/kuruier/id6754525467" target="_blank"
                    rel="noopener noreferrer">
                    <img class="blue_img" src="images/appstorebtn.png" alt="image">
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="footer_bottom">
        <div class="container">
          <div class="ft_inner">
            <div class="copy_text">
              <p>© Copyrights 2025. All rights reserved.</p>
            </div>
            <ul class="links">
              <li><a href="index.php">Home</a></li>
              <li><a href="privacyPolicy.php">Privacy Policy</a></li>
              <li><a href="termsAndConditions.php">Terms & Conditions</a></li>
              <li><a href="refundPolicy.php">Refund Policy</a></li>
              <li><a href="contact.php">Contact us</a></li>
            </ul>
            <div class="design_by">
              <p>Crafted by <a href="https://marseltechlabs.com/" target="blank">Marsel Tech Labs</a></p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- Footer-Section end -->

    <!-- go top button -->
    <div class="go_top" id="Gotop">
      <span><i class="icofont-arrow-up"></i></span>
    </div>

    <!-- Video Model Start -->
    <div class="modal fade youtube-video" id="myModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <button id="close-video" type="button" class="button btn btn-default text-right" data-dismiss="modal">
            <i class="icofont-close-line-circled"></i>
          </button>
          <div class="modal-body">
            <div id="video-container" class="video-container">
              <iframe id="youtubevideo" width="640" height="360" allowfullscreen></iframe>
            </div>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
    <!-- Video Model End -->
  </div>
  <!-- Page-wrapper-End -->

  <!-- Jquery-js-Link -->
  <script src="js/jquery.js"></script>
  <!-- owl-js-Link -->
  <script src="js/owl.carousel.min.js"></script>
  <!-- bootstrap-js-Link -->
  <script src="js/bootstrap.min.js"></script>
  <!-- aos-js-Link -->
  <script src="js/aos.js"></script>
  <!-- Typed Js Cdn -->
  <script src='js/typed.min.js'></script>
  <!-- main-js-Link -->
  <script src="js/main.js"></script>

  <!-- Form Loading Spinner Styles -->
  <style>
    .submit-btn {
      position: relative;
    }
    .submit-btn .spinner {
      display: none;
      width: 16px;
      height: 16px;
      border: 2px solid #ffffff;
      border-top-color: transparent;
      border-radius: 50%;
      animation: spin 0.8s linear infinite;
    }
    .submit-btn.loading .btn-icon {
      display: none;
    }
    .submit-btn.loading .spinner {
      display: inline-block;
    }
    @keyframes spin {
      to { transform: rotate(360deg); }
    }
    .contact-submit-btn {
      position: relative;
      min-width: 120px;
    }
    .contact-submit-btn .btn-text {
      display: inline;
    }
    .contact-submit-btn .spinner {
      display: none;
      width: 18px;
      height: 18px;
      border: 2px solid #ffffff;
      border-top-color: transparent;
      border-radius: 50%;
      animation: spin 0.8s linear infinite;
      vertical-align: middle;
    }
    .contact-submit-btn.loading .btn-text {
      display: none;
    }
    .contact-submit-btn.loading .spinner {
      display: inline-block;
    }
    .success-message {
      animation: fadeIn 0.5s ease;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>

</body>

</html>
