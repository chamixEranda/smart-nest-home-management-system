<!-- Footer -->
<footer class="text-center text-lg-start bg-light text-muted">
  <!-- Section: Social media -->
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
    @php
        $footer = App\Models\BusinessSetting::where(['key' => 'footer_text'])->first();
        $address = App\Models\BusinessSetting::where(['key' => 'address'])->first();
        $phone = App\Models\BusinessSetting::where(['key' => 'phone'])->first();
        $email = App\Models\BusinessSetting::where(['key' => 'email_address'])->first();
    @endphp

  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <img src="{{ asset('assets/img/logo.png') }}" alt="SmartNest Logo" width="100">
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            {{ translate('messages.services') }}
          </h6>
          <p>
            <a href="{{ route('finance.index') }}" class="text-reset">{{ translate('messages.finance_management') }}</a>
          </p>
          <p>
            <a href="{{ route('meal-planning.index') }}" class="text-reset">{{ translate('messages.meal_planning') }}</a>
          </p>
          <p>
            <a href="{{ route('relationship-management.index') }}" class="text-reset">{{ translate('messages.relationship_management') }}</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Useful links
          </h6>
          <p>
            <a href="{{ route('pricing') }}" class="text-reset">{{ translate('messages.pricing') }}</a>
          </p>
          <p>
            <a href="{{ route('contact-us') }}" class="text-reset">{{ translate('messages.contact_us') }}</a>
          </p>
          <p>
            <a href="{{ route('about-us') }}" class="text-reset">{{ translate('messages.about_us') }}</a>
          </p>
          <p>
            <a href="{{ url('reviews') }}" class="text-reset">{{ translate('messages.reviews') }}</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
          <p><i class="fas fa-home me-3"></i> {{ $address ? $address->value : '' }}</p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            {{ $email ? $email->email : '' }}
          </p>
          <p><i class="fas fa-phone me-3"></i> {{ $phone ? $phone->value : '' }}</p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    {{ $footer ? $footer->value : '' }}
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->