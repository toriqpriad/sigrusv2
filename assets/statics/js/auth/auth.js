function ServerPost(next_url,input,reload_action) {
  $.notify({
    message: '<i id="notif" class="fa fa-cog fa-spin"></i> Sedang memproses ... .',
  }, {type: 'warning', delay: 50});
  $.ajax({
    url: next_url,
    method: 'POST',
    data: input,
    dataType: 'json',
    contentType: 'application/json',
    cache: false,
    contentType: false,
    processData: false,
    success: function (response) {
      setTimeout(function ()
      {
        if (response.response == 'OK') {
          $.notify({
            message: '<i class="fa fa-check"></i> ' + response.message,
          }, {type: 'success'})
          localStorage.setItem('backend_url', response.data.backend_url);
        } else {
          $.notify({
            message: '<i class="fa fa-genderless"></i> ' + response.message,
          }, {type: 'danger'})
          $.each(response.data['error'], function(index, item) {
            $.notify({
              message: '<i class="fa fa-genderless"></i> ' + item,
            }, {type: 'danger'})
          })
        }
        if(reload_action){
        setTimeout(function ()
        {
          window.location.href = response.data.link;
        }, 1000);
      }
      }, 1000);
    }
  });
}

function login() {
  var username =  $("#username").val();
  var password =  $.md5($("#password").val());
  var input = new FormData();
  var post_url = $("#url").val();
  input.append('username', username);
  input.append('password', password);
  ServerPost(post_url,input,true);
}
