let form = $('uploadForm');
$(document).on('submit', '#uploadForm', function(event){
  $.ajax({
    type: form.attr('method'),
    url: form.attr('action'),
    data: form.serialize(),
    success: function (responseText) {
     
      console.log("end");
    }
  }
  );
  //event.preventDefault();
});
