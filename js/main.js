
function delayForm(selector, animate, todo){
  $(selector).submit(function(e){
        e.preventDefault()
        $(selector).addClass(animate);
        setTimeout(todo, 1000);
  });
}
