var site = localStorage.getItem('tpq_url');
var url = localStorage.getItem('tpq_url');

function logoutProcess() {
  var post_url = 'logout';
  $('#logoutModal').modal('hide');
  ServerPost(post_url,'',true);
  localStorage.removeItem('tpq_url');
}
