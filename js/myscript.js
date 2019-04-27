$(function() {

  "use strict";



 

  $('.carousel').carousel({
    interval: false
  });
 var wheight = $(window).height(); //get the height of the window
  
  $('.fullheight').css('height', wheight); //set to window tallness 
});


$(document).ready(function(){
    $('[data-tooltip="left"]').tooltip({
        placement : 'left'
    });
});

$(document).ready(function(){
    $('[data-tooltip="top"]').tooltip({
        placement : 'top'
    });
});
