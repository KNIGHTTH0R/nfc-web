$(function(){

  $(".login-form").submit(function(e) {
      var url = "login";
      $.ajax({
           type: "GET",
           url: url,
           data: $(".login-form").serialize(),
           dataType:"json",
           success: function(data){
             console.log(data);
               if(data.status != "ok"){
                 toastr.error(data.message, "");
               }else{
                 location.href = "edit";
               }
           }
      });
      e.preventDefault();
  });

});
