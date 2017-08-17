
function table_render(){
  $.notify({
    message: '<i id="notif" class="fa fa-refresh fa-spin"></i> Proses ... ',
  }, {type: 'info', delay: 30});
  setTimeout(function ()
  {
  var detail = url + "pc";
  var table = $('.table1').DataTable({
    ajax : url+"pc/json",
    columns: [
      {data : null},
      { data: 'name' },
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
        "targets": 4
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
  var contact = $('#contact').val();
  var addr = $('#address').val();
  empty_validate(name,'Nama');
  var input = new FormData();
  input.append('name', name);
  input.append('address', addr);
  input.append('contact', contact);
  var post_url = 'pc/post';
  ServerPost(post_url,input,true);
}

function update() {
  var id = $('#edit_id').val();
  var name = $('#name').val();
  var contact = $('#contact').val();
  var addr = $('#address').val();
  empty_validate(name,'Nama');
  var input = new FormData();
  input.append('id', id);
  input.append('name', name);
  input.append('address', addr);
  input.append('contact', contact);
  var post_url = 'pc/update';

  ServerPost(post_url,input,true);
}


function DeleteModal(link){
  $('#deleteModal').modal(
    { backdrop: false}
  );
  $('#del_id').val(link);
}

function Delete(){
  var input = new FormData();
  input.append('id', $('#del_id').val());
  var delete_url = 'gallery/delete';
  ServerPost(delete_url,input);
  table.ajax.reload();
}
