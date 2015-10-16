$(function(){


  $(".form .button").click(function() {
      $.ajax({
           type: "POST",
           url: "./api/register",
           data: $(".form").serialize(),
           dataType: "json",
           success: function(data){
               window.location.replace("./")
           },
           error: function(data){
             console.log(data);
              toastr.error(JSON.parse(data.responseText).message);
           }
      });
      return false;
  });


});
