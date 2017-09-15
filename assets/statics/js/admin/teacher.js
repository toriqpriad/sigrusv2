
function table_render() {
  $.notify({
    message: '<i id="notif" class="fa fa-refresh fa-spin"></i> Proses ... ',
  }, { type: 'info', delay: 30 });
  setTimeout(function () {
    var detail = url + "teacher";
    var table = $('.table1').DataTable({
      ajax: url + "teacher/json",
      columns: [
      { data: null },
      { data: 'name' },
      { data: 'gender' },
      { data: 'tpq_name'},
      { data: 'tpq_alias'},
      { data: 'email' },
      { data: 'contact' },
      { data: 'active' },
      { data: 'update_at' },
      { data: 'id' },
      ],
      dom: 'Bfrtip',
      buttons: [

      ],
      columnDefs: [
      {
        "render": function (data, type, row) {
          if (data == 'L') {
            return 'Laki-Laki';
          } else {
            return 'Perempuan';
          }
        },
        "targets": 2
      },
      {
        "render": function (data, type, row) {
          if (data == 'A') {
            return '<span class="text-success">Aktif</span>';
          } else {
            return '<span class="text-warning">Non Aktif</span>';
          }
        },
        "targets": 7
      },
      {
        "render": function (data, type, row) {
          return '<a href="' + detail + '/' + data + '"  class="btn btn-fill btn-sm btn-success">Detail</a>&nbsp<button   class="btn btn-fill btn-sm btn-warning" onclick="DeleteModal(\'' + data + '\',this)">Hapus</button>';
        },
        "targets": 9
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

function search(){
  $.notify({
    message: '<i id="notif" class="fa fa-cog fa-spin"></i> Sedang memproses ... .',
  }, {type: 'warning', delay: 50});
  $("#table_body").empty();
  $("#download_btn").remove();
  var name = $('#name').val();
  var tpq = $('#tpq').val();
  var teacher_category = $('#teacher_category').val();
  var contact = $('#contact').val();
  var email = $('#email').val();
  var education = $('#education').val();
  var education_detail = $('#education_detail').val();
  var addr = $('#address').val();
  var gender = $('#gender').val();
  var active = $('#active').val();
  var status = $('#status').val();
  var place = $('#place_birth').val();
  var date = $('#date_birth').val();

  var input = new FormData();
  input.append('name', name);
  input.append('gender', gender);
  input.append('tpq', tpq);
  input.append('place', place);
  input.append('date', date);
  input.append('teacher_category', teacher_category);
  input.append('education', education);
  input.append('education_detail', education_detail);
  input.append('contact', contact);
  input.append('status', status);
  input.append('email', email);
  input.append('active', active);
  console.log(url + '/teacher/search_submit');
  $.ajax({
    url: url + '/teacher/search_submit',
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
          var no = '1';
          $.each(response.data, function(i, item) {
            $('#table_body').append(
              "<tr>"+
              "<td>"+no+"</td>"+
              "<td>"+item.name+"</td>"+
              "<td>"+item.gender+"</td>"+
              "<td>"+item.teacher_category+"</td>"+
              "<td>"+item.tpq_name+" ( "+item.tpq_alias+" )"+"</td>"+
              "<td>"+item.place_birth+','+item.date_birth+" ("+item.age+")"+"</td>"+
              "<td>"+item.status+"</td>"+
              "<td>"+item.education+' - '+item.education_detail+"</td>"+
              "<td>"+item.address+"</td>"+
              "<td>"+item.email+"</td>"+
              "<td>"+item.contact+"</td>"+
              "<td>"+item.active+"</td>"+
              "<td>"+item.update_at+"</td>"+
              "</tr>");
            no++ }) ;
        } else {

        }
      }, 1000);
    }
  });
$('#btn_opt').append('<button class="pull-right btn btn-md btn-flat btn-success" id="download_btn" onclick="table2excel()"><i class="fa fa-download"></i>&nbsp; Download</button>');
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
  var name = $('#name').val();
  empty_validate(name, 'Nama');
  var tpq = $('#tpq').val();
  empty_validate(tpq, 'TPQ');
  var teacher_category = $('#teacher_category').val();
  var contact = $('#contact').val();
  var email = $('#email').val();
  var addr = $('#address').val();
  var foto = $('#logo').prop('files')[0];
  var gender = $('#gender').val();
  var place = $('#place_birth').val();
  var date = $('#date_birth').val();
  var input = new FormData();
  input.append('name', name);
  input.append('gender', gender);
  input.append('address', addr);
  input.append('tpq', tpq);
  input.append('place', place);
  input.append('date', date);
  input.append('teacher_category', teacher_category);
  input.append('contact', contact);
  input.append('email', email);
  input.append('foto', foto);
  var post_url = 'teacher/post';
  ServerPost(post_url, input, true);
}

function update() {
  var id = $('#edit_id').val();
  var name = $('#name').val();
  empty_validate(name, 'Nama');
  var tpq = $('#tpq').val();
  var tpq_last = $('#tpq_last_id').val();
  empty_validate(tpq, 'TPQ');
  var teacher_category = $('#teacher_category').val();
  var contact = $('#contact').val();
  var email = $('#email').val();
  var addr = $('#address').val();
  var gender = $('#gender').val();
  var active = $('#active').val();
  var place = $('#place_birth').val();
  var status = $('#status').val();
  var education = $('#education').val();
  var education_detail = $('#education_detail').val();
  var date = $('#date_birth').val();
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
  input.append('tpq', tpq);
  input.append('tpq_last_id', tpq_last);
  input.append('place', place);
  input.append('date', date);
  input.append('teacher_category', teacher_category);
  input.append('contact', contact);
  input.append('email', email);
  input.append('education', education);
  input.append('education_detail', education_detail);
  input.append('foto', foto);
  input.append('active', active);
  input.append('status', status);
  input.append('old_foto', old_foto);
  var post_url = 'teacher/update';
  ServerPost(post_url, input,true);
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
  var delete_url = 'teacher/delete';
  ServerPost(delete_url, input);  
  $(row).closest('tr').remove();
}