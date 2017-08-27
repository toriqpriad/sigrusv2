
function table_render() {
  $.notify({
    message: '<i id="notif" class="fa fa-refresh fa-spin"></i> Proses ... ',
  }, { type: 'info', delay: 30 });
  setTimeout(function () {
    var detail = url + "slider";
    var table = $('.table1').DataTable({
      ajax: url + "slider/json",
      columns: [
        { data: null },
        { data: 'title' },
        { data: 'link' },
        { data: 'update_at' },
        { data: 'id' },
      ],
      dom: 'Bfrtip',
      buttons: [
      ],
      columnDefs: [
        {
          "render": function (data, type, row) {
            return '<a href="' + detail + '/' + data + '"  class="btn btn-fill btn-sm btn-success">Detail</a>&nbsp<button  class="btn btn-fill btn-sm btn-warning" onclick="DeleteModal(\'' + data + '\')"  id="rowid_'+data+'">Hapus</button>';
          },
          "targets": 4
        },
      ]
    });

    table.on('order.dt search.dt', function () {
      table.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
        cell.innerHTML = i + 1;
      });
    }).draw();
  }, 500)
}

function update() {
  var id = $('#edit_id').val();
  var name = $('#name').val();
  var username = $('#username').val();
  var moto = $('#moto').val();
  var desc = $('#desc').val();
  var addr = $('#addr').val();
  var contact = $('#contact').val();
  var email = $('#email').val();
  var logo_old = $('#logo_old').val();
  var logo_new = $('#logo').prop('files')[0];
  var channel = $('#id_channel').val();
  var key = $('#youtube_api_key').val();
  var input = new FormData();
  var socmed_data = [];
  $(".social-media").each(function() {
    var socmed_value = {"sc_id":  $(this).attr('id'), "sc_value" : $(this).val()};
    socmed_data.push(socmed_value);
  });

  input.append('id', id);
  input.append('name', name);
  input.append('username', username);
  input.append('moto', moto);
  input.append('desc', desc);
  input.append('addr', addr);
  input.append('contact', contact);
  input.append('email', email);
  input.append('channel', channel);
  input.append('key', key);
  input.append('socmed_data', JSON.stringify(socmed_data));
  input.append('logo_new', logo_new);
  input.append('logo_old', logo_old);
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
