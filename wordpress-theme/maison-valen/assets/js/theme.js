(function () {
  'use strict';

  // Mobile menu drawer toggle
  var toggle = document.querySelector('.mv-mobile-toggle');
  var drawer = document.getElementById('mv-mobile-drawer');
  if (toggle && drawer) {
    toggle.addEventListener('click', function () {
      var expanded = toggle.getAttribute('aria-expanded') === 'true';
      toggle.setAttribute('aria-expanded', String(!expanded));
      drawer.hidden = expanded;
    });
  }

  // Portfolio sector filtering
  var filterButtons = document.querySelectorAll('.mv-filter-btn');
  var projectCards = document.querySelectorAll('#mv-portfolio-grid .mv-project-card');
  if (filterButtons.length && projectCards.length) {
    filterButtons.forEach(function (btn) {
      btn.addEventListener('click', function () {
        var sector = btn.getAttribute('data-sector');
        filterButtons.forEach(function (b) { b.classList.remove('is-active'); });
        btn.classList.add('is-active');

        projectCards.forEach(function (card) {
          var cardSectors = (card.getAttribute('data-sectors') || '').split(' ');
          card.style.display = sector === 'all' || cardSectors.indexOf(sector) !== -1 ? '' : 'none';
        });
      });
    });
  }

  // AJAX Contact Form
  var contactForm = document.getElementById('mv-contact-form');
  if (contactForm && window.mvAjaxConfig) {
    contactForm.addEventListener('submit', function (e) {
      e.preventDefault();
      var feedback = contactForm.querySelector('.mv-form-feedback');
      var data = new FormData(contactForm);
      data.append('action', 'mv_submit_contact');
      data.append('nonce', window.mvAjaxConfig.contactNonce);

      feedback.textContent = 'Submitting inquiry...';
      fetch(window.mvAjaxConfig.ajaxUrl, { method: 'POST', body: data })
        .then(function (r) { return r.json(); })
        .then(function (res) {
          feedback.textContent = res.data && res.data.message ? res.data.message : 'Submission complete.';
          if (res.success) { contactForm.reset(); }
        })
        .catch(function () {
          feedback.textContent = 'Network error. Please email concierge@maisonvalen.com.';
        });
    });
  }

  // AJAX Newsletter Form
  var newsletterForm = document.getElementById('mv-newsletter-form');
  if (newsletterForm && window.mvAjaxConfig) {
    newsletterForm.addEventListener('submit', function (e) {
      e.preventDefault();
      var feedback = newsletterForm.querySelector('.mv-form-feedback');
      var data = new FormData(newsletterForm);
      data.append('action', 'mv_subscribe_newsletter');
      data.append('nonce', window.mvAjaxConfig.newsletterNonce);

      feedback.textContent = 'Subscribing...';
      fetch(window.mvAjaxConfig.ajaxUrl, { method: 'POST', body: data })
        .then(function (r) { return r.json(); })
        .then(function (res) {
          feedback.textContent = res.data && res.data.message ? res.data.message : 'Subscribed.';
          if (res.success) { newsletterForm.reset(); }
        })
        .catch(function () {
          feedback.textContent = 'Unable to subscribe right now.';
        });
    });
  }
})();
