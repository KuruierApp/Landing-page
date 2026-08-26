<?php
/**
 * Partner enquiry form — https://kuruier.com/partner.php?type=fleet&source=ig-ad-01
 *
 * The destination for every automated reply that goes out on WhatsApp, Instagram and
 * Facebook. The ad number runs the free WhatsApp Business App, which has no API, so
 * enquiries previously existed only as coloured labels inside that app — they could
 * not be exported, assigned, or reported on. This form is what turns an enquiry into
 * a durable row in the Kuruier admin panel.
 *
 * ?type= preselects the tab so a link from the "truck owner" reply lands on the truck
 * owner form. ?source= is carried through untouched and is the whole basis of
 * cost-per-lead reporting — set it on every link that reaches this page.
 */

$typeParam = isset($_GET['type']) ? strtolower(preg_replace('/[^a-z_]/i', '', $_GET['type'])) : 'shipper';
$typeMap = [
    'shipper' => 'SHIPPER',
    'send'    => 'SHIPPER',
    'fleet'   => 'FLEET_OWNER',
    'truck'   => 'FLEET_OWNER',
    'owner'   => 'FLEET_OWNER',
    'rider'   => 'RIDER',
];
$activeCategory = isset($typeMap[$typeParam]) ? $typeMap[$typeParam] : 'SHIPPER';

// Free text, so it must never reach the page unescaped.
$source = isset($_GET['source'])
    ? htmlspecialchars(substr(trim($_GET['source']), 0, 120), ENT_QUOTES, 'UTF-8')
    : '';

$pageTitle = 'Partner with Kuruier';
include 'includes/header.php';
?>

  <div class="page_wrapper">

    <section class="contact_form white_text row_am" id="partner-form" data-aos="fade-in" data-aos-duration="1500">
      <div class="contact_inner">
        <div class="container">
          <div class="dotes_blue"><img src="images/blue_dotes.png" alt="image"></div>

          <div class="section_title" data-aos="fade-up" data-aos-duration="1500">
            <span class="title_badge">Partner with us</span>
            <h2>Tell us <span>who you are</span></h2>
            <p>One minute, and the right person from our team gets back to you.</p>
          </div>

          <!-- Category picker. Also sets the hidden `category` field. -->
          <div class="partner_tabs" data-aos="fade-up" data-aos-duration="1500">
            <button type="button" class="partner_tab" data-category="SHIPPER">
              <span class="partner_tab_icon">📦</span>
              <span class="partner_tab_label">I want to send something</span>
            </button>
            <button type="button" class="partner_tab" data-category="FLEET_OWNER">
              <span class="partner_tab_icon">🚛</span>
              <span class="partner_tab_label">I own trucks / vehicles</span>
            </button>
            <button type="button" class="partner_tab" data-category="RIDER">
              <span class="partner_tab_icon">🏍️</span>
              <span class="partner_tab_label">I want to work as a rider</span>
            </button>
          </div>

          <form id="partnerForm" novalidate data-aos="fade-up" data-aos-duration="1500">
            <input type="hidden" name="category" id="partnerCategory" value="<?php echo htmlspecialchars($activeCategory, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="source" value="<?php echo $source; ?>">

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" name="name" class="form-control" placeholder="Your name *" required maxlength="120">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="tel" name="mobileNumber" class="form-control" placeholder="Mobile number *" required inputmode="numeric" maxlength="20">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" name="city" class="form-control" placeholder="Your city" maxlength="80">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="email" name="email" class="form-control" placeholder="Email (optional)" maxlength="160">
                </div>
              </div>

              <!-- Shipper only -->
              <div class="col-md-6 field_group" data-for="SHIPPER">
                <div class="form-group">
                  <input type="text" name="fromCity" class="form-control" placeholder="Pickup city" maxlength="80">
                </div>
              </div>
              <div class="col-md-6 field_group" data-for="SHIPPER">
                <div class="form-group">
                  <input type="text" name="toCity" class="form-control" placeholder="Delivery city" maxlength="80">
                </div>
              </div>

              <!-- Fleet owner only. vehicleCount is free text on purpose: owners
                   answer "8 to 10" and "2 lorry 1 tempo", and a number input loses
                   more than it gains. -->
              <div class="col-md-6 field_group" data-for="FLEET_OWNER">
                <div class="form-group">
                  <input type="text" name="vehicleCount" class="form-control" placeholder="How many vehicles?" maxlength="40">
                </div>
              </div>
              <div class="col-md-6 field_group" data-for="FLEET_OWNER">
                <div class="form-group">
                  <input type="text" name="vehicleTypes" class="form-control" placeholder="Vehicle types (lorry, tempo, container…)" maxlength="120">
                </div>
              </div>

              <!-- Rider only -->
              <div class="col-md-6 field_group" data-for="RIDER">
                <div class="form-group">
                  <select name="vehicleTypes" class="form-control">
                    <option value="">Your vehicle</option>
                    <option value="2-wheeler">2-wheeler</option>
                    <option value="3-wheeler">3-wheeler</option>
                    <option value="4-wheeler">4-wheeler</option>
                  </select>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <textarea name="message" class="form-control" placeholder="Anything else we should know?" maxlength="1000"></textarea>
                </div>
              </div>

              <div class="col-md-12">
                <div class="btn_block">
                  <button type="submit" class="btn puprple_btn ml-0" id="partnerSubmit">
                    <span class="btn-text">Submit enquiry</span>
                  </button>
                  <div class="btn_bottom"></div>
                </div>
              </div>
            </div>
          </form>

          <p id="partnerStatus" class="partner_status" role="status" aria-live="polite"></p>
        </div>
      </div>
    </section>

  </div>

<?php include 'includes/footer.php'; ?>

<style>
  .partner_tabs { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 30px; justify-content: center; }
  .partner_tab {
    display: flex; align-items: center; gap: 10px;
    padding: 14px 20px; border-radius: 12px; cursor: pointer;
    background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.25);
    color: #fff; font-size: 15px; transition: all .2s ease;
  }
  .partner_tab:hover { background: rgba(255,255,255,.16); }
  .partner_tab.active { background: #fff; color: #1a1a2e; border-color: #fff; font-weight: 600; }
  .partner_tab_icon { font-size: 20px; line-height: 1; }
  .field_group { display: none; }
  .field_group.show { display: block; }
  .partner_status { margin-top: 20px; font-size: 16px; min-height: 24px; }
  .partner_status.ok { color: #4CAF50; }
  .partner_status.err { color: #ff8a80; }
  @media (max-width: 600px) {
    .partner_tabs { flex-direction: column; }
    .partner_tab { width: 100%; }
  }
</style>

<script>
(function () {
  var form = document.getElementById('partnerForm');
  var categoryField = document.getElementById('partnerCategory');
  var status = document.getElementById('partnerStatus');
  var submit = document.getElementById('partnerSubmit');
  var tabs = document.querySelectorAll('.partner_tab');

  // Same-origin proxy rather than calling the API host directly: keeps the browser
  // off a cross-origin request and keeps the API base in one server-side place.
  var ENDPOINT = 'lead_submit.php';

  function applyCategory(category) {
    categoryField.value = category;
    tabs.forEach(function (tab) {
      tab.classList.toggle('active', tab.dataset.category === category);
    });
    document.querySelectorAll('.field_group').forEach(function (group) {
      var show = group.dataset.for === category;
      group.classList.toggle('show', show);
      // Hidden inputs must not submit stale values from a tab the user left.
      group.querySelectorAll('input, select, textarea').forEach(function (input) {
        input.disabled = !show;
        if (!show) input.value = '';
      });
    });
  }

  tabs.forEach(function (tab) {
    tab.addEventListener('click', function () {
      applyCategory(tab.dataset.category);
    });
  });

  applyCategory(categoryField.value);

  form.addEventListener('submit', function (event) {
    event.preventDefault();
    status.textContent = '';
    status.className = 'partner_status';

    var data = Object.fromEntries(new FormData(form).entries());

    if (!data.name || !data.name.trim()) {
      status.textContent = 'Please tell us your name.';
      status.className = 'partner_status err';
      return;
    }
    if (!data.mobileNumber || data.mobileNumber.replace(/\D/g, '').length < 10) {
      status.textContent = 'Please enter a valid 10-digit mobile number.';
      status.className = 'partner_status err';
      return;
    }

    submit.disabled = true;
    submit.querySelector('.btn-text').textContent = 'Sending…';

    fetch(ENDPOINT, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
    })
      .then(function (response) { return response.json().catch(function () { return {}; }); })
      .then(function (result) {
        if (result && result.success) {
          form.style.display = 'none';
          document.querySelector('.partner_tabs').style.display = 'none';
          status.textContent = '✅ Thank you! Our team will contact you shortly.';
          status.className = 'partner_status ok';
        } else {
          throw new Error((result && result.message) || 'Something went wrong');
        }
      })
      .catch(function (error) {
        status.textContent = error.message + ' — or WhatsApp us on +91 8122 753 458.';
        status.className = 'partner_status err';
        submit.disabled = false;
        submit.querySelector('.btn-text').textContent = 'Submit enquiry';
      });
  });
})();
</script>
