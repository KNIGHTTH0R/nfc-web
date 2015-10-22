var uploading = false;
$(function(){

  $(".eq").remove();

  //Login form
  $(".login-form").submit(function(e) {
      $.ajax({
           type: "GET",
           url: "controllers/login.php",
           data: $(".login-form").serialize(),
           dataType:"json",
           success: function(data){
              console.log(data);

               if(data.status != "ok"){
                 toastr.error("", data.message);
               }else{
                 location.href = "edit";
               }
           }, error: function(data){
                console.error(data);
                toastr.error("", "Nastala neznámá chyba");
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
            var url = "/api/items/"+$(".form-item").find("#id").val();
            console.log(url);
            $.ajax({
                type: "PUT",
                url: url,
                data: $(".form-item").serialize(),
                success: function(data){
                    console.log(data);
                    window.location.replace("/edit");
                },error: function(data){
                    console.log(data);
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

  /// add-item

  $(".add-item").click(function(){
    var name = prompt("Název");
    if(name != ""){
      $.ajax({
           type: "POST",
           url: "/scripts/postRest.php",
           data: {name:name, url: "items"},
           dataType: "json",
           success: function(data){
             window.location.replace("");
           },
           error: function(data){
             console.log(data)
              toastr.error("Nastala neznámá chyba");
           }
      });
    }
  });


  /// Ajax image upload
  $('#imgupload').change( function(e) {
      uploading = true;
      $(".loading").show(100);
      var file = this.files[0];
      var name = this.getAttribute("data-name");
      var xhr = new XMLHttpRequest();
      xhr.addEventListener('load', function(e) {
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
