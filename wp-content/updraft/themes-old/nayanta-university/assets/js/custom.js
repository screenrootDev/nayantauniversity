// Utility functions for cookies
const CookieUtil = {
  set: (name, value, days) => {
    const expires = days ? "; expires=" + new Date(Date.now() + days * 864e5).toUTCString() : "";
    document.cookie = `${name}=${encodeURIComponent(value || "")}${expires}; path=/`;
  },
  get: (name) => {
    return document.cookie.split('; ').reduce((r, v) => {
      const parts = v.split('=');
      return parts[0] === name ? decodeURIComponent(parts[1]) : r;
    }, null);
  }
};

// Handle Cookie Consent
function handleCookieConsent() {
  const banner = document.getElementById('cookieConsent');
  if (!banner) return console.error('Cookie banner not found!');

  const acceptBtn = document.getElementById('acceptCookies');
  const rejectBtn = document.getElementById('rejectCookies');


  // If cookie is already set, keep it hidden; else show the banner
  if (!CookieUtil.get('cookie_consent')) {
    banner.classList.remove('d-none'); // Show banner
  }

  acceptBtn?.addEventListener('click', () => {
    CookieUtil.set('cookie_consent', 'accepted', 365);
    banner.classList.add('d-none'); // Hide banner
  });

  rejectBtn?.addEventListener('click', () => {
    CookieUtil.set('cookie_consent', 'rejected', 365);
    banner.classList.add('d-none'); // Hide banner
  });
}

// Run after DOM is ready
document.addEventListener('DOMContentLoaded', handleCookieConsent);

// UTM Management
const UTM_KEYS = ['utm_source', 'utm_medium', 'utm_campaign'];

function storeUTMParams() {
  //   if (localStorage.getItem('utm_params')) {
  //     // If UTM already exists in localStorage, don't overwrite
  //     return;
  //   }

  const params = new URLSearchParams(window.location.search);
  const utmParams = new URLSearchParams();

  UTM_KEYS.forEach(key => {
    if (params.has(key)) utmParams.set(key, params.get(key));
  });

  if ([...utmParams].length) {
    localStorage.setItem('utm_params', utmParams.toString());
  }
}

function updateApplyNowButton() {
  const storedParams = localStorage.getItem('utm_params');
  if (!storedParams) return;

  const link = document.querySelector('a.btn.btn-secondary[href*="admissions.nayanta.org"]');
  if (link) {
    const url = new URL(link.href);
    const storedUTM = new URLSearchParams(storedParams);

    UTM_KEYS.forEach(key => {
      if (storedUTM.has(key)) url.searchParams.set(key, storedUTM.get(key));
    });

    link.href = url.toString();
    link.target = "_blank";
    link.rel = "noopener noreferrer";
  }
}

// Initialize everything on DOM ready
document.addEventListener('DOMContentLoaded', () => {
  handleCookieConsent();
  storeUTMParams();
  updateApplyNowButton();
});








document.addEventListener('DOMContentLoaded', () => {
  let mm = gsap.matchMedia();

  const FounderItemsElement = document.querySelectorAll('.founder-swiper');

  // For founder swiper
  FounderItemsElement.forEach((item, idx) => {
    const founderSwiper = new Swiper(item, {
      init: false,
      virtual: {
        enabled: true,
        addSlidesAfter: 3,
        addSlidesBefore: 3
      },
      pagination: {
        el: item.querySelector(".swiper-pagination"),
        clickable: true,
        dynamicBullets: true,
      },
      navigation: {
        nextEl: item.querySelector(".swiper-btn-next"),
        prevEl: item.querySelector(".swiper-btn-prev"),
      },
      breakpoints: {
        320: {
          spaceBetween: 8,
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 8,
        },
        992: {

        }
      }
    });

    mm.add("(max-width: 992px)", () => {
      founderSwiper.init();
    })
  })



  // For visionaries swiper
  const visionariesSwiper = new Swiper(".visionaries-swiper", {
    slidesPerView: 2,
    spaceBetween: 24,
    pagination: {
      el: document.querySelector(".visionaries-swiper .swiper-pagination"),
      clickable: true,
      dynamicBullets: true,
    },
    navigation: {
      nextEl: ".visionaries-swiper .swiper-btn-next",
      prevEl: ".visionaries-swiper .swiper-btn-prev",
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
      },
      768: {

      }
    }
  });
})


document.addEventListener('DOMContentLoaded', () => {
  // For partner swiper
  const partnerSwiper = new Swiper(".partner-swiper", {
    speed: 1200,
    slidesPerView: "auto",
    freeMode: true,
    loop: true,
    loopedSlides: 10,
    allowTouchMove: false,
    touchRatio: 0,
    autoplay: {
      delay: 0,
      //disableOnInteraction: false,
      pauseOnMouseEnter: true,
    },
  });

  $(document).on('click', '#showMoreCartText', function () {
    let $button = $(this);
    let $cardText = $('[card-text-hide]');

    if ($cardText.is(':visible')) {
      $cardText.hide();
      $button.text('show more');

      $('html, body').animate({ scrollTop: $('#programmeCourses').offset().top - $(".header-main").outerHeight() }, 700)
    }
    else {
      $cardText.stop().fadeIn();
      $button.text('show less');
    }
  })


});





