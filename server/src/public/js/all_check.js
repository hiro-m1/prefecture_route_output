function AllStationChecked(){
  var all = document.form.all.checked;
  for (var i=0; i<document.form.elements["station[]"].length; i++){
    document.form.elements["station[]"][i].checked = all;
  }
}

// 一つでもチェックを外すと「全て選択」のチェック外れる
function DisStationChecked(){
  var checks = document.form.elements["station[]"];
  var checksCount = 0;
  for (var i=0; i<checks.length; i++){
    if(checks[i].checked == false){
      document.form.all.checked = false;
    }else{
      checksCount += 1;
      if(checksCount == checks.length){
        document.form.all.checked = true;
      }
    }
  }
}

function AllMunicipalityChecked(){
  var all = document.form.all.checked;
  for (var i=0; i<document.form.elements["municipality[]"].length; i++){
    document.form.elements["municipality[]"][i].checked = all;
  }
}

// 一つでもチェックを外すと「全て選択」のチェック外れる
function DisMunicipalityChecked(){
  var checks = document.form.elements["municipality[]"];
  var checksCount = 0;
  for (var i=0; i<checks.length; i++){
    if(checks[i].checked == false){
      document.form.all.checked = false;
    }else{
      checksCount += 1;
      if(checksCount == checks.length){
        document.form.all.checked = true;
      }
    }
  }
}
