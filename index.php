<?php
$pageTitle = 'Kuruier — Truck Booking, Fleet Management & Local Delivery';
$pageDescription = 'Book trucks, manage your fleet and send local parcels with Kuruier riders. Plus traveler parcel matching by road and air. Available on Android and iOS.';
$pageStylesheet = 'css/business-home.css';
include 'includes/header.php';
?>
<div class="page_wrapper business-home">
<main>
<section class="business-hero-backdrop" id="banner">
<div class="business-hero container">
  <div class="hero-copy">
    <p class="eyebrow">FOR BUSINESSES. FOR THE PEOPLE WHO MOVE THEM.</p>
    <h1>From a city parcel<br>to a <span>full truckload.</span></h1>
    <p class="hero-intro">Book a truck. Send with a Kuruier Rider. Run your fleet.<br>One app to keep your goods — and your business — moving.</p>
    <div class="hero-actions hero-store-links"><a href="https://play.google.com/store/apps/details?id=com.marseltechlabs.kuruier" aria-label="Get Kuruier on Google Play"><img src="images/googleplay.png" alt="Get Kuruier on Google Play"></a><a href="https://apps.apple.com/in/app/kuruier/id6754525467" aria-label="Download Kuruier on the App Store"><img src="images/appstorebtn.png" alt="Download Kuruier on the App Store"></a></div>
    <div class="hero-tags"><span>Owner-set truck prices</span><span>Fixed local fares</span><span>OTP handovers</span></div>
  </div>
  <div class="hero-visual hero-three-screens" aria-label="Local delivery home, sender home and fleet home app screens">
    <div class="visual-orbit"></div>
    <figure class="phone hero-phone-left"><img width="720" height="1600" src="images/business/rider-home-20261024.webp" alt="Local delivery partner home with rider mode and delivery requests"><figcaption>LOCAL DELIVERY</figcaption></figure>
    <figure class="phone hero-phone-primary"><img width="720" height="1600" fetchpriority="high" src="images/business/sender-home-updated-20261024.webp" alt="Sender home with local delivery and transport booking options"><figcaption>SENDER HOME</figcaption></figure>
    <figure class="phone hero-phone-right"><img width="720" height="1600" src="images/business/fleet-home-requests-20261024.webp" alt="Fleet home showing a Chennai to Bangalore incoming request and a Chennai to Delhi active job with pickup and drop addresses"><figcaption>FLEET HOME</figcaption></figure>
    <div class="visual-note"><span aria-hidden="true">✓</span> Your route. Your right vehicle.</div>
  </div>
</div>
</section>
<section class="business-proof container" aria-label="Kuruier registration and package totals">
  <!-- Production admin snapshot: 6 Oct 2026. Accounts 2,378; transport owners 281 (128 verified); packages 385. Rounded down. These are not completed-delivery or active-supply counts. -->
  <div><strong>2,300+</strong><span>registered accounts</span></div><div><strong>280+</strong><span>transport owners registered</span></div><div><strong>380+</strong><span>packages created</span></div>
  <p>Admin snapshot · 6 Oct 2026<br>Registrations and requests, not completed deliveries.</p>
</section>
<section class="business-section container" id="service">
  <div class="section-intro"><p class="eyebrow">TWO EVERYDAY WAYS TO MOVE GOODS</p><h2>Big loads. Local deliveries.<br><span>Built around your business.</span></h2><p>From shop stock and business freight to documents and everyday parcels, choose the service that fits your load.</p></div>
  <div class="model-grid">
    <article class="model-card fleet-card"><div class="card-copy"><p class="eyebrow">01 / FLEET & FREIGHT</p><h3>A truck for your next load.</h3><p>Move heavy goods within the city or between cities. Compare available vehicles with the owner's price shown before you book.</p><ul><li>Book a full truck for goods over 50 kg</li><li>Get driver details after assignment</li><li>Track the trip and confirm handovers with OTP</li></ul><a class="business-link" href="#download">Book your truck <span aria-hidden="true">↗</span></a></div><figure class="phone card-phone"><img width="719" height="1600" loading="lazy" src="images/business/fleet-booking-20261024.webp" alt="Truck booking progress, driver details and fare summary"><figcaption>YOUR BOOKING</figcaption></figure></article>
    <article class="model-card rider-card"><div class="card-copy"><p class="eyebrow">02 / KURUIER RIDER</p><h3>Across town. Off your to-do list.</h3><p>Send documents, shop orders and parcels up to 50 kg with a nearby delivery partner. See a fixed fare before requesting a rider.</p><ul><li>Local delivery within supported service areas</li><li>Live location tracking during the delivery</li><li>OTP confirmation at pickup and drop</li></ul><a class="business-link" href="#download">Find a Kuruier Rider <span aria-hidden="true">↗</span></a></div><figure class="phone card-phone"><img width="718" height="1600" loading="lazy" src="images/business/package-details-20261024.webp" alt="Package details with delivery options, pickup and destination"><figcaption>BOOK A LOCAL DELIVERY</figcaption></figure></article>
  </div>
  <p class="availability-note">Vehicles, routes and rider availability depend on your location. Screens show example bookings; fares vary by route, vehicle and load.</p>
</section>
<section class="local-partner-section" id="local-deliveries" aria-labelledby="local-deliveries-title">
  <div class="container local-partner-layout">
    <div class="local-partner-copy">
      <p class="eyebrow">KURUIER RIDER · LOCAL DELIVERIES</p>
      <h2 id="local-deliveries-title">Your city.<br>Your deliveries.<br><span>Your earnings.</span></h2>
      <p>Help nearby shops and senders move everyday parcels. Keep your delivery requests, current jobs and earnings together in one app.</p>
      <div class="local-partner-benefits">
        <div><h3>Go on duty. Find nearby deliveries.</h3><p>Switch on Rider mode when you're ready. Review the route and fare before accepting a request.</p></div>
        <div><h3>From pickup to doorstep.</h3><p>Follow your current delivery and confirm pickup and drop with OTP handovers.</p></div>
        <div><h3>See what you've earned.</h3><p>View recent deliveries, app payments, direct cash or UPI payments and your available balance in Earnings.</p></div>
      </div>
      <a class="business-button" href="partner.php">Become a delivery partner <span aria-hidden="true">↗</span></a>
      <p class="availability-note">Screens show example activity and earnings. Requests depend on local demand; duty-pay availability and eligibility vary by area.</p>
    </div>
    <div class="local-partner-screens" aria-label="Rider home and earnings screenshots">
      <figure class="phone"><img width="720" height="1600" loading="lazy" decoding="async" src="images/business/rider-deliveries-20261024.webp" alt="Rider home showing duty status, current delivery and incoming requests"><figcaption>YOUR DELIVERIES</figcaption></figure>
      <figure class="phone"><img width="718" height="1600" loading="lazy" decoding="async" src="images/business/rider-earnings-20261024.webp" alt="Rider earnings showing app and direct payments, available balance and recent deliveries"><figcaption>YOUR EARNINGS</figcaption></figure>
    </div>
  </div>
</section>
<section class="owner-section" id="about"><div class="container owner-layout">
  <div class="owner-copy"><p class="eyebrow">FOR TRUCK OWNERS & FLEET OPERATORS</p><h2>Your fleet.<br>Your prices.<br><span>Your business.</span></h2><p>Manage vehicles, drivers and bookings in one place. Set your own rates, accept a job and assign the right driver — including yourself if you're an owner-driver.</p><div class="owner-benefits"><div><strong>Free fleet management</strong><p>Keep vehicles, documents, driver assignments and trip payment records together.</p></div><div><strong>A flat booking fee. No percentage cut.</strong><p>The applicable fee is shown before acceptance. Full-truck freight is paid directly to the owner.</p></div><div><strong>Dedicated driver access</strong><p>Drivers see their assigned jobs, routes and handover steps.</p></div></div><a class="business-button" href="partner.php">Join as a fleet partner <span aria-hidden="true">↗</span></a></div>
  <div class="owner-screens fleet-overview-screens" aria-label="Fleet dashboard and vehicle management screens">
    <figure class="phone"><img width="720" height="1600" loading="lazy" decoding="async" src="images/business/fleet-home-requests-20261024.webp" alt="Fleet dashboard with incoming requests and active jobs, pickup and drop addresses"><figcaption>YOUR FLEET AT A GLANCE</figcaption></figure>
    <figure class="phone"><img width="720" height="1600" loading="lazy" decoding="async" src="images/business/fleet-vehicles-20261024.webp" alt="My Vehicles showing vehicle capacity, assigned drivers and route prices"><figcaption>YOUR VEHICLES & ROUTES</figcaption></figure>
  </div>
</div>
<div class="container fleet-booking-showcase">
  <div class="fleet-showcase-intro"><p class="eyebrow">FROM VEHICLE CHOICE TO DELIVERY</p><h3>A clearer view of every booking.</h3><p>See how senders choose a vehicle and follow their booking, while you keep your fleet organized.</p></div>
  <div class="fleet-showcase-grid">
    <article class="fleet-showcase-card">
      <div class="fleet-showcase-copy"><span class="fleet-step">01 / CHOOSE</span><h3>The right vehicle for the load.</h3><p>Compare truck types, capacities and prices. Available Part Load trips appear alongside full-truck options.</p></div>
      <figure class="phone"><img width="720" height="1600" loading="lazy" decoding="async" src="images/business/fleet-vehicle-selection-20261024.webp" alt="Vehicle selection showing Part Load and full-truck options with capacities and prices"><figcaption>COMPARE VEHICLES & PRICES</figcaption></figure>
    </article>
    <article class="fleet-showcase-card">
      <div class="fleet-showcase-copy"><span class="fleet-step">02 / FOLLOW</span><h3>Every detail, in one booking.</h3><p>View the delivery stages, pickup and drop locations, assigned vehicle, driver details and fare summary.</p></div>
      <figure class="phone"><img width="718" height="1600" loading="lazy" decoding="async" src="images/business/fleet-booking-review-20261024.webp" alt="Fleet booking showing delivery progress, assigned vehicle, driver and fare summary"><figcaption>BOOKING DETAILS & PROGRESS</figcaption></figure>
    </article>
  </div>
  <p class="availability-note">Screens show illustrative bookings and example prices. Actual fares and vehicle availability depend on your route and load.</p>
</div></section>
<section class="business-section container"><div class="section-intro"><p class="eyebrow">MAKE EVERY TRIP WORK HARDER</p><h2>More ways to use your capacity.</h2></div><div class="benefit-grid"><article><span class="feature-number">01</span><h3>Part Load</h3><p>Don't need an entire truck? Book space by weight on an available scheduled fleet trip.</p></article><article><span class="feature-number">02</span><h3>Return Load</h3><p>Fleet owners can publish a return trip and offer space to shippers on that lane.</p></article><article><span class="feature-number">03</span><h3>Flexible rider work</h3><p>Go on duty when it suits you. See the fare before accepting. Kuruier Riders currently keep 100% of the delivery fare.</p><a class="business-link" href="partner.php">Become a delivery partner ↗</a></article></div></section>
<section class="traveler-section container" id="travelers"><div class="traveler-copy"><p class="eyebrow">A DISTINCTIVE EXTRA / TRAVELER PARCEL MATCHING</p><h2>Someone's already<br><span>going your way.</span></h2><p>Alongside trucks and local riders, Kuruier connects small parcels with people already traveling by road or air. A different way to send — built around an existing journey.</p><p>Browse a matching trip, chat with the traveler and agree a price. Confirm handovers with OTP; in-app payment is released after delivery.</p><div class="travel-modes"><span>Bus & train</span><span>Car & bike</span><span>Flight</span></div><p class="availability-note">Matching depends on posted trips, available capacity and permitted items. Travelers are an additional option, alongside our core Fleet and Rider services.</p><a class="business-link" href="#download">Explore traveler trips ↗</a></div><div class="traveler-screens"><figure class="phone"><img width="599" height="1300" loading="lazy" src="images/business/traveler-list.webp" alt="Available traveler trips with routes, prices and chat options"><figcaption>FIND A MATCHING TRIP</figcaption></figure><figure class="phone"><img width="599" height="1300" loading="lazy" src="images/business/traveler-trip.webp" alt="Traveler trip creation for road and flight journeys"><figcaption>POST YOUR JOURNEY</figcaption></figure></div></section>
<section class="business-section container" id="how-it-works"><div class="section-intro"><p class="eyebrow">FROM REQUEST TO HANDOVER</p><h2>Three steps. One app.</h2></div><div class="benefit-grid"><article><span class="feature-number">01</span><h3>Tell us what moves</h3><p>Choose Send anything. Add pickup, destination and load details, then choose Fleet or local Rider.</p></article><article><span class="feature-number">02</span><h3>Review and book</h3><p>For Fleet, choose a vehicle at the owner's price. For local delivery, review the fixed fare and request a rider.</p></article><article><span class="feature-number">03</span><h3>Track and hand over</h3><p>Follow your assigned delivery and use OTP at pickup and drop. Full-truck freight is settled directly with the owner.</p></article></div></section>
<section class="faq-section container"><div class="section-intro"><p class="eyebrow">GOOD TO KNOW</p><h2>A few things before you book.</h2></div><details><summary>Which option should I choose?</summary><p>Use Kuruier Rider for local parcels up to 50 kg within supported areas. Use Fleet for heavier goods or full-truck needs. Part Load and traveler trips depend on published routes and capacity.</p></details><details><summary>Does Kuruier decide truck prices?</summary><p>Fleet owners set their prices. The booking fee is separate and shown to the owner before acceptance. Local Rider fares are calculated by the platform and shown before requesting a rider.</p></details><details><summary>Can I manage my fleet without paying for software?</summary><p>Yes. Fleet management is free. A flat fee applies to confirmed platform bookings; Kuruier does not take a percentage of full-truck freight.</p></details><details><summary>Is the service available on every route?</summary><p>Availability depends on registered vehicles, riders and posted trips on your route. Check the app or contact our team for help.</p></details></section>
<section class="download-section container" id="download"><div><p class="eyebrow">KEEP YOUR BUSINESS MOVING</p><h2>Your next delivery<br>starts here.</h2><p>Download Kuruier for Android or iPhone.<br>English, Tamil and Hindi. One account, multiple ways to move goods.</p><div class="download-badges"><a href="https://play.google.com/store/apps/details?id=com.marseltechlabs.kuruier"><img width="150" height="36" loading="lazy" src="images/googleplay.png" alt="Get Kuruier on Google Play"></a><a href="https://apps.apple.com/in/app/kuruier/id6754525467"><img width="150" height="36" loading="lazy" src="images/appstorebtn.png" alt="Download Kuruier on the App Store"></a></div><a class="business-link" href="https://wa.me/918122753458">Need help? Talk to our team ↗</a></div><figure class="phone download-phone"><img width="583" height="1300" loading="lazy" src="images/business/roles.webp" alt="Kuruier role switcher for senders, transport owners and delivery partners"><figcaption>ONE ACCOUNT. MORE POSSIBILITIES.</figcaption></figure></section>
</main>
<script>
// Close the mobile menu after an in-page navigation on the homepage.
document.addEventListener('click', function (event) {
  var link = event.target.closest('header .nav-link');
  var menu = document.getElementById('navbarSupportedContent');
  if (link && link.hash && menu && menu.classList.contains('show') && window.jQuery) {
    window.jQuery(menu).collapse('hide');
  }
});
</script>
<?php include 'includes/footer.php'; ?>
