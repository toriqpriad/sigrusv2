
function table_render() {
  $.notify({
    message: '<i id="notif" class="fa fa-refresh fa-spin"></i> Proses ... ',
  }, { type: 'info', delay: 30 });
  setTimeout(function () {
    var detail = url + "division";
    var table = $('.table1').DataTable({
      ajax: url + "division/json",
      columns: [
      { data: null },
      { data: 'name' },
      { data: 'persons_count' },
      { data: 'update_at' },
      { data: 'id' },
      ],
      dom: 'Bfrtip',
      buttons: [
      ],
      columnDefs: [
      {
        "render": function (data, type, row) {
          return data + ' orang';
        },
        "targets": 2
      },
      {
        "render": function (data, type, row) {
          return '<a href="' + detail + '/' + data + '"  class="btn btn-fill btn-sm btn-success">Detail</a>&nbsp<button   class="btn btn-fill btn-sm btn-warning" onclick="DeleteModal(\'' + data + '\',this)">Hapus</button>';
        },
        "targets": 4
      },
      ]
    });

    $(".alert").remove();

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
  var post_url = 'division/post';
  ServerPost(post_url, input, true);
}

function update() {
  var id = $('#edit_id').val();
  var name = $('#name').val();
  var desc = $('#desc').val();
  empty_validate(name, 'Nama');
  var division_data = [];
  $(".division_data").each(function() {    
    var name = $(this).find('.name_person').val();
    var contact = $(this).find('.contact_person').val();
    var data = {'name' : name , 'contact' : contact};
    division_data.push(data)
  });  
  var input = new FormData();
  input.append('name', name);
  input.append('desc', desc);
  input.append('id', id);
  input.append('person', JSON.stringify(division_data));
  var post_url = 'division/update';
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
  var delete_url = 'division/delete';
  ServerPost(delete_url, input);  
  $(row).closest('tr').remove();
}

function add_person_table(){
  $('#person_table tr:last').after('<tr class="division_data"><td><input type="text" class="name_person form-control"></td>'+
    '<td><input type="text" class="contact_person form-control"></td>'+
    '<td><button class="btn btn-danger" onclick="delete_row(this)">Hapus</button></td></tr>');
};

function delete_row(e){
  console.log($(e).closest('tr').remove());  

}