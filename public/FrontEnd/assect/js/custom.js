// Desktop Nav Bar
document.addEventListener("DOMContentLoaded", function () {
  window.addEventListener('scroll', function () {
    if (window.scrollY > 50) {
      document.getElementById('navbar_top').classList.add('fixed-top');
      // add padding top to show content behind navbar
      navbar_height = document.querySelector('.navbar').offsetHeight;
      document.body.style.paddingTop = navbar_height + 'px';
    } else {
      document.getElementById('navbar_top').classList.remove('fixed-top');
      // remove padding top from body
      document.body.style.paddingTop = '0';
    }
  });
});

// Mobile Nav Bar
document.addEventListener("DOMContentLoaded", function () {
  window.addEventListener('scroll', function () {
    if (window.scrollY > 50) {
      document.getElementById('mobile_navbar_top').classList.add('fixed-top');
      // add padding top to show content behind navbar
      navbar_height = document.querySelector('.navbar').offsetHeight;
      document.body.style.paddingTop = navbar_height + 'px';
    } else {
      document.getElementById('mobile_navbar_top').classList.remove('fixed-top');
      // remove padding top from body
      document.body.style.paddingTop = '0';
    }
  });
});

// back-to-top

$(document).ready(function () {
  // hide on top position
  $('.back-to-top').hide ()
  
  // Show or hide the "up" button based on scroll position
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) { // You can adjust the scroll position threshold as needed
      $('.back-to-top').fadeIn();
    } else {
      $('.back-to-top').fadeOut();
    }
  });

  // Scroll to top when the button is clicked
  $('.back-to-top').click(function () {
    $('html, body').animate({ scrollTop: 0 }, 800);
    return false;
  });
});


// services

$('.services').owlCarousel({
  loop: true,
  dots: false,
  autoplay: true,
  nav: false,
  autoplayTimeout: 2000,
  responsiveClass: true,
  responsive: {
    0: {
      items: 3,
    },
    600: {
      items: 3,
    },
    1000: {
      items: 3,
    },
    1400: {
      items: 3,
    }
  }
})

// flash sale
$('.flash-sale').owlCarousel({
  loop: true,
  dots: false,
  autoplay: true,
  nav: false,
  autoplayTimeout: 3000,
  responsiveClass: true,
  responsive: {
    0: {
      items: 2,
    },
    600: {
      items: 3,
    },
    1000: {
      items: 5,
    },
    1400: {
      items: 6,
    }
  }
})

// categories

// $('.categories').owlCarousel({
//   loop: true,
//   dots: false,
//   autoplay: true,
//   nav: false,
//   autoplayTimeout: 2000,
//   responsiveClass: true,
//   responsive: {
//     0: {
//       items: 4
//     },
//     600: {
//       items: 5,
//     },
//     1000: {
//       items: 6,
//       margin:20
//     },
//     1400: {
//       items: 8,
//       margin: 30
//     }
//   }
// })





