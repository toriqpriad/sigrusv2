
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
  var name = $('#name').val();
  empty_validate(name, 'Nama');
  var tpq_last = $('#tpq_last_id').val();
  var activity_category = $('#activity_category').val();
  var contact = $('#contact').val();
  var email = $('#email').val();
  var addr = $('#address').val();
  var gender = $('#gender').val();
  var active = $('#active').val();
  var place = $('#place_birth').val();
  var education = $('#education').val();
  var education_detail = $('#education_detail').val();
  var date = $('#date_birth').val();
  var status = $('#status').val();
  var old_foto = $('#foto_old').val();
  var new_foto = $('#foto_new').val();
  if (new_foto != undefined) {
    var foto = $('#foto').prop('files')[0];
  } else {
    var foto = 'old';
  }

  var input = new FormData();
  input.append('id', id);
  input.append('name', name);
  input.append('gender', gender);
  input.append('address', addr);
  input.append('tpq_last_id', tpq_last);
  input.append('place', place);
  input.append('date', date);
  input.append('activity_category', activity_category);
  input.append('contact', contact);
  input.append('status', status);
  input.append('email', email);
  input.append('education', education);
  input.append('education_detail', education_detail);
  input.append('foto', foto);
  input.append('active', active);
  input.append('old_foto', old_foto);
  var post_url = 'activity/update';
  ServerPost(post_url, input,true);
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
