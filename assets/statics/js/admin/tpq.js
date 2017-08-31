
function table_render(){
  $.notify({
    message: '<i id="notif" class="fa fa-refresh fa-spin"></i> Proses ... ',
  }, {type: 'info', delay: 30});
  setTimeout(function ()
  {
  var detail = url + "tpq";
  var table = $('.table1').DataTable({
    ajax : url+"tpq/json",
    columns: [
      {data : null},
      { data: 'name' },
      { data: 'alias' },
      { data: 'pc_name' },
      { data: 'email' },
      { data: 'contact' },
      { data: 'update_at' },
      {data: 'id'},
    ],
    dom: 'Bfrtip',
    buttons: [

    ],
    columnDefs: [
      {
        "render": function ( data, type, row ) {
          return '<a href="'+detail+'/'+data+'"  class="btn btn-fill btn-sm btn-success">Detail</a>&nbsp<button  class="btn btn-fill btn-sm btn-warning" onclick="DeleteModal(\''+data+'\')">Hapus</button>';
        },
        "targets": 7
      },
    ]
  });

  table.on( 'order.dt search.dt', function () {
    table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
      cell.innerHTML = i+1;
    } );
  } ).draw();
},500 )
}

function post() {
  var name = $('#name').val();
  var pc = $('#pc').val();
  var contact = $('#contact').val();
  var alias = $('#alias').val();
  var email = $('#email').val();
  var addr = $('#address').val();
  var logo = $('#logo').prop('files')[0];
  var cover = $('#cover').prop('files')[0];
  empty_validate(name,'Nama');
  var input = new FormData();
  input.append('name', name);
  input.append('address', addr);
  input.append('pc', pc);
  input.append('contact', contact);
  input.append('email', email);
  input.append('alias', alias);
  input.append('logo', logo);
  input.append('cover', cover);
  var post_url = 'tpq/post';
  ServerPost(post_url,input,true);
}

function update() {
  var id = $('#edit_id').val();
  var name = $('#name').val();
  empty_validate(name,'Nama');
  var pc = $('#pc').val();
  var contact = $('#contact').val();
  var alias = $('#alias').val();
  var email = $('#email').val();
  var username = $('#username').val();
  var addr = $('#address').val();
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

  var position_data = [];
  $(".position_data").each(function() {
    var position_value = {"position_id":  $(this).attr('id'), "position_person" : $(this).val()};
    position_data.push(position_value);
  });

  var input = new FormData();
  input.append('id', id);
  input.append('name', name);
  input.append('address', addr);
  input.append('pc', pc);
  input.append('contact', contact);
  input.append('email', email);
  input.append('username', username);
  input.append('alias', alias);
  input.append('logo', logo);
  input.append('cover', cover);
  input.append('old_logo', old_logo);
  input.append('old_cover', old_cover);
  input.append('position_data', JSON.stringify(position_data));
  var post_url = 'tpq/update';

  ServerPost(post_url,input,true);
}


function DeleteModal(link){
  $('#deleteModal').modal(
    { backdrop: false}
  );
  $('#del_id').val(link);
}

function showPassword(link){
  $('#PasswordModal').modal(
    { backdrop: false}
  );
}

function Delete(){
  var input = new FormData();
  input.append('id', $('#del_id').val());
  var delete_url = 'gallery/delete';
  ServerPost(delete_url,input);
  table.ajax.reload();
}

function ChangePass(){
  var input = new FormData();
  var id = $('#edit_id').val();
  var new_pass = $.md5($('#new_pass').val());
  var input = new FormData();
  input.append('id', id);  
  input.append('new_pass', new_pass);
  var post_url = 'tpq/change_password';
  ServerPost(post_url,input);

}
