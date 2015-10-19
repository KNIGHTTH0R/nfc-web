var uploading = false;
$(function(){

  //Login form
  $(".login-form").submit(function(e) {
    console.log("login");
      var url = "controllers/login.php";
      $.ajax({
           type: "GET",
           url: url,
           data: $(".login-form").serialize(),
           dataType:"json",
           success: function(data){
             console.log(data);
               if(data.status != "ok"){
                 toastr.error("", data.message);
               }else{
                 location.href = "edit";
               }
           }
      });
      e.preventDefault();
  });

  // Edit item properties
  $(".loading").hide(0);
  $(".form-item-submit").click(function(event) {
      event.preventDefault();
      $(".form-item").addClass("slide");
      setTimeout( function () {
          if(!uploading){
            var url = "./api/items/"+$(this).parent().parent().find("#id").val();
            $.ajax({
                type: "PUT",
                url: url,
                data: $(".form-item").serialize(),
                success: function(data){
                    window.location.replace("/edit");
                }
            });
          }else{
            toastr.error("", "Vyčkejte, než se obrázek nahraje");
          }
      }, 1000);
      return false;
  });

  /// Replace url instead href on anchor
  $('a').click(function(event){
    event.preventDefault();
    window.location.replace($(this).attr("href"));
  });

  /// register form
  $(".form-register-submit").click(function() {
      $.ajax({
           type: "POST",
           url: "./api/register",
           data: $(".form").serialize(),
           dataType: "json",
           success: function(data){
               window.location.replace("./")
           },
           error: function(data){
              toastr.error(JSON.parse(data.responseText).message);
           }
      });
      return false;
  });


  /// Ajax image upload
  $('#imgupload').change( function(e) {
      uploading = true;
      $(".loading").show(100);
      var file = this.files[0];
      var name = this.getAttribute("data-name");
      var xhr = new XMLHttpRequest();
      xhr.addEventListener('load', function(e) {
          console.log("wtf");
          uploading = false;
          $(".loading").hide(100);
      });
      var fd = new FormData;
      fd.append('file', file);
      fd.append('name', name);
      xhr.open('post', '/libs/imgupload.php', true);
      xhr.send(fd);

      var reader = new FileReader();
      reader.onloadend = function(){
        $("body").css("background-image", "url(" + reader.result + ")");        
      }
      if(file){
        reader.readAsDataURL(file);
      }

  });

});
