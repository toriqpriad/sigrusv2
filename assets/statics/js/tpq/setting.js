function update()
{
  var name = $('#name').val();
  empty_validate(name,'Nama');
  var pc = $('#pc').val();
  empty_validate(pc,'Pengurus Cabang');
  var username = $('#username').val();
  empty_validate(username,'Username');
  var alias = $('#alias').val();
  var moto = $('#moto').val();
  var desc = $('#desc').val();
  var addr = $('#addr').val();
  var contact = $('#contact').val();
  var email = $('#email').val();
  var old_logo = $('#logo_old').val();
  var new_logo = $('#logo_new').val();
  var new_cover = $('#cover_new').val();
  var old_cover = $('#cover_old').val();
  if (new_logo != undefined) {
    var logo = $('#logo').prop('files')[0];
  } else {
    var logo = 'old';
  }

  if (new_cover != undefined) {
    var cover = $('#cover').prop('files')[0];
  } else {
    var cover = 'old';
  }


  var input = new FormData

  input.append('name', name);
  input.append('username', username);
  input.append('moto', moto);
  input.append('pc', pc);
  input.append('alias', alias);
  input.append('desc', desc);
  input.append('addr', addr);
  input.append('contact', contact);
  input.append('email', email);
  input.append('logo', logo);
  input.append('cover', cover);
  input.append('old_logo', old_logo);
  input.append('old_cover', old_cover);

  var post_url = 'setting/update';
  ServerPost(post_url,input,true);
}

function showPassword(link){
  $('#PasswordModal').modal(
    { backdrop: false}
  );
}

function checkyoutubeapi(){
  var id = $('#id_channel').val();
  var key = $('#youtube_api_key').val();

  $("#results").append("<i id='icon_refresh' class='fa fa-refresh fa-spin'></i>");

  $.ajax({
    url: "https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId="+id+"&maxResults=10&key="+key,
    method: 'GET',
    success: function (response) {
      setTimeout(function ()
      {
        $("#icon_refresh").remove();
        $("#results").append("<h4><span class='label label-info'>"+response.pageInfo.totalResults+" video </span></h4>");
      }, 1000)
    }
  });

}

function ChangePass(){
  var input = new FormData();
  var old_pass = $.md5($('#old_pass').val());
  var new_pass = $.md5($('#new_pass').val());
  var input = new FormData();
  input.append('old_pass', old_pass);
  input.append('new_pass', new_pass);
  var post_url = 'setting/change_password';
  ServerPost(post_url,input);

}
