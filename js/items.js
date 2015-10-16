$(function(){
  $('a').click(function(event){
    event.preventDefault();
    console.log($(this).attr("href"));
    window.location.replace($(this).attr("href"));
  });

});
