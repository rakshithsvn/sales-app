<div class="contact-card">
  <div class="contact-body">
    <h5 class="card-heading">Savings Calculator</h5>
    <p class="card-desc">
      We take great pride in everything that we do, control over products allows
      us to ensure our customers receive the best quality service.
    </p>
    <form id="msform" class="contactForms"  method="post" action="{{ route('calculator') }}">
      @csrf
      <fieldset>
        <div class="form-card">
          <h2 class="fs-title"></h2>
          <div class="row">
            <div class="col-12 col-md-6">
              <label class="form-label" for="select-1">Number of Vehicles</label>
              <input
                class="form-control"
                type="number"
                id="contact-usage"
                name="no_vehicle"
                placeholder=""
                required=""
              />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="select-2"
                >Fuel Cost / month / vehicle (AED)</label
              >
              <input
                class="form-control"
                type="number"
                id="contact-usage"
                name="fuel_cost_month"
                placeholder=""
                required=""
              />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="contact-usage"
                >Average driving hours / day (HOURS)</label
              >
              <input
                class="form-control"
                type="number"
                id="contact-usage"
                name="avg_hours"
                placeholder=""
                required=""
              />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="select-3"
                >Distance driven / day / vehicle (KMS)</label
              >
              <input
                class="form-control"
                type="number"
                id="contact-usage"
                name="distance"
                placeholder=""
                required=""
              />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="select-4"
                >Average monthly salary / driver (AED)</label
              >
              <input
                class="form-control"
                type="number"
                id="contact-usage"
                name="avg_salary"
                placeholder=""
                required=""
              />
            </div>

            <div class="col-12">
              {{--
              <button class="btn btn--secondary w-100">
                submit request <i class="energia-arrow-right"></i>
              </button>
              --}}
            </div>
            <div class="col-12">
              <div class="contact-result"></div>
            </div>
          </div>
        </div>
        <button class="btn btn--secondary w-100 next">
          Next <i class="energia-arrow-right"></i>
        </button>
      </fieldset>
      <fieldset>
        <div class="form-card">
          <h2 class="fs-title"></h2>
          <div class="row">
            <div class="col-12 col-md-6">
              <label class="form-label" for="select-1">Full Name</label>
              <input
                class="form-control"
                type="text"
                id="contact-usage"
                name="name"
                placeholder=""
                required=""
              />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="select-2">Company Website</label>
              <input
                class="form-control"
                type="text"
                id="contact-usage"
                name="website"
                placeholder=""
                required=""
              />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="contact-usage"
                >Professional Email</label
              >
              <input
                class="form-control"
                type="email"
                id="contact-usage"
                name="mail_id"
                placeholder=""
                required=""
              />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="select-3">Contact Number</label>
              <input
                class="form-control"
                type="number"
                id="contact-usage"
                name="contact_no"
                placeholder=""
                required=""
              />
            </div>
            <div class="col-12 mb-3">
              <div
                class="g-recaptcha"
                data-sitekey="{{ config('app.site_key') }}"
              ></div>
            </div>
            <div class="col-12">
              <button class="btn btn--secondary w-100">submit request</button>
            </div>
            <div class="col-12">
              <div class="contact-result"></div>
            </div>
          </div>
        </div>
        <button class="btn btn--secondary w-100 previous">
          Previous <i class="energia-arrow-left"></i>
        </button>
      </fieldset>
    </form>
  </div>
  <!-- End .contact-body -->
</div>
