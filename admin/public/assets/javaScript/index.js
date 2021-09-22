
$(document).ready(function(){

$("#addDep").click(()=>{
  $("#popUpWindow").css("display", "block")
  $("#employee-popup").css("display", "none")
})

$(".closeButton").click(()=>{
  $("#popUpWindow").css("display", "none")
})

$("#add-Employees").click(()=>{
  $("#employee-popup").css("display", "block")
  $("#popUpWindow").css("display", "none")
})

$(".closePopup").click(()=>{
  $("#employee-popup").css("display", "none")
})

$(".subButton").click(()=>{

  let form = document.querySelector("#dep_form");
  let action = form.getAttribute("action");
  let form_data = new FormData(form);

  let xhr = new XMLHttpRequest();
  xhr.open('POST', action, true);
  xhr.setRequestHeader('X-Requested-With', 'ajaxRequest');
  xhr.onreadystatechange = function () {
    if(xhr.readyState == 4 && xhr.status == 200) {
      var result = xhr.responseText;
      if(result){
        alert("Department add successfully");
      }
    }
  };
  xhr.send(form_data);

})

$(".employee-submit").click(()=>{
  let form = document.querySelector("#form-emp");
  let action = form.getAttribute("action");
  let form_data = new FormData(form);

  let xhr = new XMLHttpRequest();
  xhr.open('POST', action, true);
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  xhr.onreadystatechange = function () {
    if(xhr.readyState == 4 && xhr.status == 200) {
      var result = xhr.responseText;
      if(result){
        alert("Employee added successfully");
      }
    }
  };
  xhr.send(form_data);
})

})
