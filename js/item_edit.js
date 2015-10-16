
var uploading = false;

$(function(){
  $(".loading").hide(0);
    $(".form .button").click(function(event) {
        event.preventDefault();
        $(".form").addClass("slide");
        setTimeout( function () {
            if(!uploading){
              var url = "./api/items/"+$(this).parent().parent().find("#id").val();
              $.ajax({
                   type: "PUT",
                   url: url,
                   data: $(".form").serialize(),
                   success: function(data){
                       window.location.replace("edit");
                   }
              });
            }else{
              toastr.error("", "Vyčkejte, než se obrázek nahraje");
            }
        }, 1000);
        return false;
    });



  $('#imgupload').change( function(e) {
      uploading = true;
      $(".loading").show(100);
      var file = this.files[0];
      var name = this.getAttribute("data-name");
      var xhr = new XMLHttpRequest();
      xhr.addEventListener('progress', function(e) {
        console.log(e);
      });
      xhr.addEventListener('load', function(e) {
          console.log("wtf");
          uploading = false;
          $(".loading").hide(100);
      });
      var fd = new FormData;
      fd.append('file', file);
      fd.append('name', name);
      xhr.open('post', './libs/imgupload.php', true);
      xhr.send(fd);
  });


});
