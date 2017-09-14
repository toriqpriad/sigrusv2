
function table_render() {
  $.notify({
    message: '<i id="notif" class="fa fa-refresh fa-spin"></i> Proses ... ',
  }, { type: 'info', delay: 30 });
  setTimeout(function () {
    var detail = url + "activity";
    var table = $('.table1').DataTable({
      ajax: url + "activity/json",
      columns: [
        { data: null },
        { data: 'title' },
        { data: 'description' },
        { data: 'date' },
        { data: 'update_at' },
        { data: 'id' },
      ],
      dom: 'Bfrtip',
      buttons: [

      ],
      columnDefs: [
        {
          "render": function (data, type, row) {
            return '<a href="' + detail + '/' + data + '"  class="btn btn-fill btn-sm btn-success">Detail</a>&nbsp<button  class="btn btn-fill btn-sm btn-warning" onclick="DeleteModal(\'' + data + '\')">Hapus</button>';
          },
          "targets": 5
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


function table2excel(){
  $(".table1").table2excel({
    // exclude CSS class
    exclude: ".table1",
    name: "Worksheet Name",
    filename: "Data Pengajar " + new Date() + ".xlsx" //do not include extension
  });
}

function post() {
  var title = $('#title').val();
  empty_validate(title, 'Judul');
  var desc = $('#desc').val();
  var date = $('#date').val();
  var image_1 = $('#image_1').prop('files')[0];
  var image_2 = $('#image_2').prop('files')[0];
  var image_3 = $('#image_3').prop('files')[0];
  var image_4 = $('#image_4').prop('files')[0];
  var image_5 = $('#image_5').prop('files')[0];
  var image_6 = $('#image_6').prop('files')[0];
  var input = new FormData();
  input.append('title', title);
  input.append('desc', desc);
  input.append('date', date);
  input.append('image_1', image_1);
  input.append('image_2', image_2);
  input.append('image_3', image_3);
  input.append('image_4', image_4);
  input.append('image_5', image_5);
  input.append('image_6', image_6);
  var post_url = 'activity/post';
  ServerPost(post_url, input,true);
}

function update() {
  var id = $('#edit_id').val();
  var title = $('#title').val();
  empty_validate(title, 'Judul');
  var desc = $('#desc').val();
  var date = $('#date').val();
  var img_1_old = $('#img_1_old').val();
  var img_2_old = $('#img_2_old').val();
  var img_3_old = $('#img_3_old').val();
  var img_4_old = $('#img_4_old').val();
  var img_5_old = $('#img_5_old').val();
  var img_6_old = $('#img_6_old').val();
  var img_1_new = $('#img_1').prop('files')[0];
  var img_2_new = $('#img_2').prop('files')[0];
  var img_3_new = $('#img_3').prop('files')[0];
  var img_4_new = $('#img_4').prop('files')[0];
  var img_5_new = $('#img_5').prop('files')[0];
  var img_6_new = $('#img_6').prop('files')[0];
  var to_delete = [];
  $(".to_delete").each(function() {
    to_delete.push($(this).val());
  });
  var input = new FormData();
  input.append('id', id);
  input.append('title', title);
  input.append('desc', desc);
  input.append('date', date);
  input.append('img_1_old', img_1_old);
  input.append('img_2_old', img_2_old);
  input.append('img_3_old', img_3_old);
  input.append('img_4_old', img_4_old);
  input.append('img_5_old', img_5_old);
  input.append('img_6_old', img_6_old);
  input.append('img_1_new', img_1_new);
  input.append('img_2_new', img_2_new);
  input.append('img_3_new', img_3_new);
  input.append('img_4_new', img_4_new);
  input.append('img_5_new', img_5_new);
  input.append('img_6_new', img_6_new);
  input.append('to_delete', JSON.stringify(to_delete));
  var post_url = 'activity/update';
  ServerPost(post_url, input);
}


function DeleteModal(link) {
  $('#deleteModal').modal(
    { backdrop: false }
  );
  $('#del_id').val(link);
}

function Delete() {
  var input = new FormData();
  input.append('id', $('#del_id').val());
  var delete_url = 'gallery/delete';
  ServerPost(delete_url, input);
  table.ajax.reload();
}
