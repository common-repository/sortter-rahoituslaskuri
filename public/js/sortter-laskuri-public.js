(function ($) {
  "use strict";
  /**
   * All of the code for your public-facing JavaScript source
   * should reside in this file.
   * 
   * $(function() {
   *
   * });
   *
   * When the window is loaded:
   *
   * $( window ).load(function() {
   *
   * });
   *
  /**
   * Sortter popup
   */
  $(window).load(function () {
    var sortter_toggle = document.getElementById(
      "sortter-laskuri-popup-toggle"
    );

    if (sortter_toggle) {
      sortter_toggle.addEventListener("click", function () {
        window.sortter.openDialog({
          partnerName: encodeURI(sortter_toggle.dataset.partner),
        });
      });
    }

    if (document.getElementById("landing-calculator-unsecured")) {
      var sortter_max_time = 15;
      var sortter_max_sum = 60000;

      var sortter_lclas = document.getElementById(
        "landing-calculator-loan-amount-slider"
      );
      var sortter_lclas_progress = document.getElementById(
        "landing-calculator-loan-amount-progress"
      );
      var sortter_lclas_edit = document.getElementById(
        "landing-calculator-loan-amount-slider-input-edit"
      );
      var sortter_lclps = document.getElementById(
        "landing-calculator-loan-period-slider"
      );
      var sortter_lclps_progress = document.getElementById(
        "landing-calculator-loan-period-progress"
      );
      var sortter_lclps_edit = document.getElementById(
        "landing-calculator-loan-period-slider-input-edit"
      );

      function sortter_translate3DString(value, maxval) {
        var sortter_3dval_1 = Math.floor((value / maxval) * 100 - 101.4);
        var sortter_3dval_string =
          "translate3d(" + sortter_3dval_1 + "%, 0px, 0px)";
        return sortter_3dval_string;
      }
      /**
       * Form new url on input change
       * @param {*} initialSubmitUrl = The URL of the service with search params
       * @param {obj} newVal = Object with keys 'param' & 'value'. eg {param:'utm_source', value:'1231-2'}
       */
      function sortter_submit_href(initialSubmitUrl, newVal) {
        var sortter_url = new URL(initialSubmitUrl);
        var sortter_search_params = sortter_url.searchParams;
        sortter_search_params.set(newVal.param, newVal.value);
        return sortter_url.toString();
      }

      var sortter_submit = document.getElementById(
        "landing-calculator-button-onboarding"
      );
      sortter_submit_href(sortter_submit.dataset.sortterSubmitUrl, {
        param: "amount",
        value: "4",
      });

      var sortter_calculation = document.getElementById(
        "landing-calculator-calculation"
      );

      function sortter_update_monthly() {
        if (window.sortter) {
          var exampleValues = window.sortter.calculateExampleLoan(
            sortter_submit.dataset.paramAmount,
            sortter_submit.dataset.paramPeriod
          );
          sortter_calculation.querySelector("span").innerText = Math.round(
            exampleValues.monthlyPaymentInEur
          );
        } else {
          sortter_calculation.style.visibility = "hidden";
        }
      }

      // Calculate initial monthly
      sortter_update_monthly();

      if (sortter_lclas && sortter_lclas_progress && sortter_lclas_edit) {
        sortter_lclas.addEventListener("input", function () {
          var sortter_lclas_val = sortter_lclas.value;
          sortter_submit.dataset.paramAmount = sortter_lclas_val;
          sortter_lclas_progress.style.transform = sortter_translate3DString(
            sortter_lclas_val,
            sortter_max_sum
          );
          sortter_lclas_edit.querySelector("span").innerText =
            sortter_lclas_val;
          sortter_update_monthly();
        });
        sortter_lclas.addEventListener("change", function () {
          var sortter_lclas_val = sortter_lclas.value;
          var sortter_lclas_param = sortter_lclas.dataset.param;
          sortter_submit.href = sortter_submit_href(
            sortter_submit.dataset.sortterSubmitUrl,
            { param: sortter_lclas_param, value: sortter_lclas_val }
          );
        });
      }

      if (sortter_lclps && sortter_lclps_progress && sortter_lclps_edit) {
        sortter_lclps.addEventListener("input", function () {
          var sortter_lclps_val = sortter_lclps.value;
          sortter_submit.dataset.paramPeriod = sortter_lclps_val;
          sortter_lclps_progress.style.transform = sortter_translate3DString(
            sortter_lclps_val,
            sortter_max_time
          );
          sortter_lclps_edit.querySelector("span").innerText =
            sortter_lclps_val;
          sortter_update_monthly();
        });
        sortter_lclps.addEventListener("change", function () {
          var sortter_lclps_val = sortter_lclps.value;
          var sortter_lclps_param = sortter_lclps.dataset.param;
          sortter_submit.href = sortter_submit_href(
            sortter_submit.dataset.sortterSubmitUrl,
            { param: sortter_lclps_param, value: sortter_lclps_val }
          );
        });
      }
    }
  });
})(jQuery);
