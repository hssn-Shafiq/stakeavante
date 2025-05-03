$(document).ready(function () {
  $("#testimonial-slider").owlCarousel({
    items: 1,

    loop: true,

    margin: 10,

    nav: false,

    dots: true,

    responsive: {
      576: {
        items: 1,

        nav: false,
      },

      768: {
        items: 1,

        nav: false,
      },

      992: {
        items: 1,

        nav: true,
      },
    },
  });
});

// counter

$(".count").each(function () {
  $(this)
    .prop("Counter", 0)

    .animate(
      {
        Counter: $(this).text(),
      },

      {
        duration: 8000,

        easing: "swing",

        step: function (now) {
          now = Number(Math.ceil(now)).toLocaleString("en");

          $(this).text(now);
        },
      }
    );
});

// nav

const navEl = document.querySelector(".navbar");

// const headerEl = document.querySelector(".top-header");

window.addEventListener("scroll", () => {
  if (window.scrollY >= 10) {
    navEl.classList.add("nav-scrolled");
  } else if (window.scrollY < 10) {
    navEl.classList.remove("nav-scrolled");
  }
});

// modal

$("#staticBackdrop").on("hidden.bs.modal", function (e) {
  $("#staticBackdrop iframe").attr(
    "src",

    $("#staticBackdrop iframe").attr("src")
  );
});
