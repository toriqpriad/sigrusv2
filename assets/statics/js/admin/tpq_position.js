
function table_render() {
  $.notify({
    message: '<i id="notif" class="fa fa-refresh fa-spin"></i> Proses ... ',
  }, { type: 'info', delay: 30 });
  setTimeout(function () {
    var detail = url + "tpq_position";
    var table = $('.table1').DataTable({
      ajax: url + "tpq_position/json",
      columns: [
        { data: null },
        { data: 'name' },
        { data: 'update_at' },
        { data: 'id' },
      ],
      dom: 'Bfrtip',
      buttons: [
      ],
      columnDefs: [
        {
          "render": function (data, type, row) {
            return '<a href="' + detail + '/' + data + '"  class="btn btn-fill btn-sm btn-success">Detail</a>&nbsp<button   class="btn btn-fill btn-sm btn-warning" onclick="DeleteModal(\'' + data + '\',this)">Hapus</button>';
          },
          "targets": 3
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

function post() {
  var name = $('#name').val();
  var desc = $('#desc').val();
  empty_validate(name, 'Nama');
  var input = new FormData();
  input.append('name', name);
  input.append('desc', desc);
  var post_url = 'tpq_position/post';
  ServerPost(post_url, input, true);
}

function update() {
  var id = $('#edit_id').val();
  var name = $('#name').val();
  var desc = $('#desc').val();
  empty_validate(name, 'Nama');
  var input = new FormData();
  input.append('name', name);
  input.append('desc', desc);
  input.append('id', id);
  var post_url = 'tpq_position/update';
  ServerPost(post_url, input, true);
}


function DeleteModal(link,row) {  
  $('#deleteModal').modal(
    { backdrop: false }
    );
  $('#del_id').val(link);
  $('#yes').click(function(){
    Delete(row);
  })

}

function Delete(row) {
  var input = new FormData();
  input.append('id', $('#del_id').val());
  var delete_url = 'tpq_position/delete';
  ServerPost(delete_url, input);  
  $(row).closest('tr').remove();
}
