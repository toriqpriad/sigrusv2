
function update() {
  var position_data = [];
  $(".position_data").each(function() {
    var position_value = {"position_id":  $(this).attr('id'), "position_person" : $(this).val()};
    position_data.push(position_value);
  });  
  var input = new FormData();
  input.append('position_data', JSON.stringify(position_data));
  var post_url = 'position/update';
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
  var delete_url = 'tpq_position/delete';
  ServerPost(delete_url, input,false, $('#del_id').val() );
}
