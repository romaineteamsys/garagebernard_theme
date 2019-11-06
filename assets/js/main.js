"use strict";

$(window).scroll(function () {
  if ($(document).scrollTop() > 50) {
    $('.navbar.fixed-top').addClass('shrink');
    $("a[href='#top']").addClass('color-secondary');
    $("a[href='#top']").removeClass('color-grey');
  } else {
    $('.navbar.fixed-top').removeClass('shrink');
    $("a[href='#top']").addClass('color-grey');
    $("a[href='#top']").removeClass('color-secondary');
  }
});
$("a[href='#top']").click(function () {
  $("html, body").animate({
    scrollTop: 0
  }, "slow");
  return false;
});
/* Open */

function openNav() {
  document.getElementById("overlay-menu").style.height = "91%";
  $("#open-nav-btn").hide();
  $("#close-nav-btn").show();
}
/* Close */


function closeNav() {
  document.getElementById("overlay-menu").style.height = "0%";
  $("#close-nav-btn").hide();
  $("#open-nav-btn").show();
}

function closeDropdown() {
  $(".dropdown-menu.show").removeClass("show");
  $('.dropdown-menu').off('hover');
}

$(".terms-checkbox").click(function () {
  $(".container-radio:hover .checkmark").toggleClass('checked');
});
$(".show-more-two-col").click(function () {
  var id = $(this).data('id');
  $("#" + id + "-two-col").toggle("slow", function () {});
  $("#" + id).toggle("slow", function () {});

  if ($("#" + id + "-top-img").length) {
    $("#" + id + "-close-btn").css("top", $("#" + id + "-top-img")[0].height + 15 + "px");
  }
});
$(".show-more-custom-card").click(function () {
  var id = $(this).data('id');
  $("#" + id + "-custom-card").toggle("slow", function () {});
  $("#" + id).toggle("slow", function () {});
  var positionFromLeft = -Math.abs($("#" + id + "-custom-card-img").offset().left);
  $("#" + id).css({
    left: positionFromLeft
  });

  if ($("#" + id + "-top-img").length) {
    $("#" + id + "-close-btn").css("top", $("#" + id + "-top-img")[0].height + 50 + "px");
  }
});
$(".close-btn-show-more").click(function () {
  var id = $(this).data('id');
  $("#" + id + "-two-col").toggle("slow", function () {});
  $("#" + id).toggle("slow", function () {});
});
$(".close-btn-show-more-custom-card").click(function () {
  var id = $(this).data('id');
  $("#" + id + "-custom-card").toggle("slow", function () {});
  $("#" + id).toggle("slow", function () {});
});
$(document).ready(function () {
  initListingGoogleMapBehavior();
  initMasonry();
  init_socials_sticky();
  AOS.init({
    duration: 1200
  });
  $('.list-of-news-slick').slick({
    dots: false,
    arrows: true,
    infinite: true,
    speed: 300,
    autoplay: true,
    autoplaySpeed: 2000,
    slidesToShow: 3,
    slidesToScroll: 1,
    responsive: [{
      breakpoint: 767,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: true
      }
    }, {
      breakpoint: 991,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: false
      }
    }]
  });
});

function my_repeater_show_more(field_post_id, field_offset, field_nonce, ajax_url, more) {
  // make ajax request
  $.post(ajax_url, {
    // this is the AJAX action we set up in PHP
    'action': 'ets_repeater_show_more',
    'post_id': field_post_id,
    'offset': field_offset,
    'nonce': field_nonce
  }, function (json) {
    // add content to container
    // this ID must match the containter 
    // you want to append content to
    console.log(json);
    $('#gallery-' + field_post_id).append(json['content']).masonry('reloadItems');
    $('#gallery-' + field_post_id).masonry('layout');
    $('#gallery-' + field_post_id).imagesLoaded(function () {
      $('#gallery-' + field_post_id).masonry();
      $('.gallery a').simpleLightbox();
    }); // update offset

    field_offset = json['offset']; // see if there is more, if not then hide the more link

    if (!json['more']) {
      // this ID must match the id of the show more link
      $('#my-repeater-show-more-link').css('display', 'none');
    }
  }, 'json');
}

function initListingGoogleMapBehavior() {
  if ($(".googlemap-container").length) {
    $(window).on("resize", function () {
      var parentWidth = $(".googlemap-container").parent().width();
      $(".googlemap-container").css("width", parentWidth + "px");
    });
    $(window).resize();
  }
}

var mapCenterJDR = {
  lat: 50.6096164,
  lng: 5.5548304
};

function initMap() {
  if (document.getElementById('map') !== null) {
    initMainMap();
  }
}

function initMainMap() {
  var map = createMap(document.getElementById('map'), mapCenterJDR);
  createMarker(map, map.getCenter(), google.maps.Animation.DROP);
}

function createMap(HTMLElement, mapCenter) {
  return new google.maps.Map(HTMLElement, {
    zoom: 15,
    center: mapCenter,
    disableDefaultUI: true
  });
}

function createMarker(map, position, animation) {
  return new google.maps.Marker({
    map: map,
    position: position,
    animation: animation
  });
}

function msieversion() {
  var ua = window.navigator.userAgent;
  var msie = ua.indexOf("MSIE ");

  if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
    return true;
  } else {
    return false;
  }

  return false;
}

function initMasonry() {
    
  if($('.grid-masonry').length) {  
    var $container = $('.grid-masonry');
    $container.imagesLoaded(function(){
      $container.masonry({
        // set itemSelector so .grid-sizer is not used in layout
        itemSelector: '.grid-masonry-item',
        // use element for option
        columnWidth: '.grid-masonry-sizer',
        gutter: '.gutter-masonry-sizer',
        percentPosition: true,
        gutter : 10,
      });
    });
  }
}

function init_socials_sticky() {

  jQuery(window).resize(function() {
    var width = jQuery(window).innerWidth();

    if(width >= 768)
    {
      jQuery(window).bind({
        scroll:function()
        {
          jQuery('#socials-sticky').stop();
          jQuery('#socials-sticky').animate({
            top:jQuery(document).scrollTop()+150+"px"
          },'slow');
        }
      });
    }
    else
    {
        jQuery(window).unbind("scroll")
      jQuery('#socials-sticky').css("top", "initial");
    }
  })

  jQuery(window).resize();

  
}