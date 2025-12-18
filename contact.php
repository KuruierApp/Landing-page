<?php $pageTitle = 'Contact Us - Kuruier'; ?>
<?php include 'includes/header.php'; ?>

  <!-- Page-wrapper-Start -->
  <div class="page_wrapper">

    <!-- Contact Us Section Start -->
    <section class="contact_section">
      <div class="container">
        <div class="section_title" data-aos="fade-up" data-aos-duration="1500">
          <span class="title_badge">Contact us</span>
          <h2>Have a question? <span>Get in touch</span></h2>
          <p>We're here to help! Whether you need assistance with your shipment, have questions about our services, <br> or want to discuss a partnership opportunity, our team is ready to assist you.</p>
        </div>
        <ul class="contact_listing">
          <li data-aos="fade-up" data-aos-duration="1500">
            <span class="icon">
              <img src="images/mail_icon.png" alt="image">
            </span>
            <span class="lable">Email us</span>
            <a href="mailto:support@kuruier.com">support@kuruier.com</a>
          </li>
          <li data-aos="fade-up" data-aos-duration="1500" data-aos-delay="150">
            <span class="icon">
              <img src="images/phone_icon.png" alt="image">
            </span>
            <span class="lable">Whatsapp on</span>
            <a href="tel:+918122753458">+91 8122 753 458</a>
          </li>
          <li data-aos="fade-up" data-aos-duration="1500" data-aos-delay="300">
            <span class="icon">
              <img src="images/location_icon.png" alt="image">
            </span>
            <span class="lable">Our location</span>
            <a target="_blank" href="https://maps.app.goo.gl/U2UbcTYXGj5w1eeN7">Open Google Maps</a>
          </li>
        </ul>
      </div>
    </section>
    <!-- Contact Us Section End -->

    <!-- Contact Form Section Start -->
    <section class="contact_form white_text row_am" id="contact-form" data-aos="fade-in" data-aos-duration="1500">
      <div class="contact_inner">
        <div class="container">
          <div class="dotes_blue"><img src="images/blue_dotes.png" alt="image"></div>
          <div class="section_title" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
            <span class="title_badge">Message us</span>
            <h2>Send us a message</h2>
            <p>Fill out the form below and our dedicated support team will respond to your inquiry within 24 hours</p>
          </div>
          <form action="send_email.php" method="POST" data-aos="fade-up" data-aos-duration="1500" onsubmit="this.querySelector('.contact-submit-btn').classList.add('loading')">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" name="name" class="form-control" placeholder="Name *" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="email" name="email" class="form-control" placeholder="Email *" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" name="phone" class="form-control" placeholder="Phone">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <textarea name="comments" class="form-control" placeholder="Comments"></textarea>
                </div>
              </div>
              <div class="col-md-8">
                <div class="coustome_checkbox">
                  <label for="term_checkbox">
                    <input type="checkbox" id="term_checkbox" name="agree_terms">
                    <span class="checkmark"></span>
                    I agree to receive emails, newsletters and promotional messages
                  </label>
                </div>
              </div>
              <div class="col-md-4 text-right">
                <div class="btn_block">
                  <button type="submit" class="btn puprple_btn ml-0 contact-submit-btn">
                    <span class="btn-text">Submit</span>
                    <span class="spinner"></span>
                  </button>
                  <div class="btn_bottom"></div>
                </div>
              </div>
            </div>
          </form>
          <?php if (isset($_GET['success']) && $_GET['success'] == '1'): ?>
          <p class="success-message" style="color: #4CAF50; font-size: 16px; margin-top: 20px;">✅ Message sent successfully! We'll get back to you within 24 hours.</p>
          <?php endif; ?>
        </div>
      </div>
    </section>
    <!-- Contact Form Section End -->

    <!-- Google Map Start -->
    <div class="map_block row_am" data-aos="fade-in" data-aos-duration="1500">
      <div class="container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15552.689469331423!2d80.1270042!3d12.9608198!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a525f0dab35ad3b%3A0x737f0a1bf86b9eeb!2sKuruier!5e0!3m2!1sen!2sae!4v1760626979410!5m2!1sen!2sae" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
    <!-- Google Map End -->

<?php include 'includes/footer.php'; ?>

  <!-- Contact Form Handler -->
  <script src="js/contact-form.js"></script>
