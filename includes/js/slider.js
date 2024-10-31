
jQuery(document).ready(function(){
  jQuery('.insta_slide').owlCarousel({
      loop:true,
      nav:true,
      dots: true,
      margin:10,
      autoplay: true,
      autoplayTimeout: 1000,
      responsive:{
          0:{
              items:3,
          },
          600:{
              items:3,
          },
          1000:{
              items:3,
          }
      }
  });

  
  
}); 
