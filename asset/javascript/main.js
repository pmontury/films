$(document).ready(function(){

  $('.buttonbox').on('click', function(){
    if($(this).hasClass('active')) {
      $(this).removeClass('active');
      $('.critere').css('display', 'none')
    } else {
      $(this).addClass('active');
      $('.critere').css('display', 'block')
    }
  })








});
