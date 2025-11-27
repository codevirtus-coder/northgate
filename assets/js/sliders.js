document.addEventListener("DOMContentLoaded", function () {
  const swiperHomeElement = document.querySelector(".swiperHome");
  if (swiperHomeElement) {
    const swiperHome = new Swiper(".swiperHome", {
    
      direction: "horizontal",
      loop: true,

 
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },

      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
    });
  }

  const zifaPartnersElement = document.querySelector(".zifaPartners");
  if (zifaPartnersElement) {
    const zifaPartners = new Swiper(".zifaPartners", {
      direction: "horizontal",
      loop: true,

      slidesPerView: 2, 
      spaceBetween: 20,

      breakpoints: {
        768: {
          slidesPerView: 3,
        },
        1200: {
          slidesPerView: 4, 
        },
      },

      freeMode: true,
      autoplay: {
        delay: 0,
        disableOnInteraction: false,
      },
      speed: 3000,
      freeModeMomentum: false,
    });

  }
});
