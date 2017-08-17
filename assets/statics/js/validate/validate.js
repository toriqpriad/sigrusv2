// input = data , name = name to alert
function empty_validate(input,name){
    if(input == ""){
      $.notify({
        message: '<i class="fa fa-genderless"></i> ' + name + " tidak boleh kosong",
      }, {type: 'warning'})
      throw new Error('lengkapi data');
    }
  }
