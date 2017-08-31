var site = localStorage.getItem('admin_url');
var url = localStorage.getItem('admin_url');

function logoutProcess() {
  var post_url = 'logout';
  $('#logoutModal').modal('hide');
  ServerPost(post_url,'',true);
  localStorage.removeItem('admin_url');
}
