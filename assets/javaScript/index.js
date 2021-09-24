
$(document).ready(function(){

$(".department").click(()=>{
  $("#popUpWindow").css("display", "block")
  $(".occupation_popup").css("display", "none")
  $(".leave_popup").css("display", "none")
  $("#employee-popup").css("display", "none")
  $(".delete_department").css("display", "none")
})

$(".closeButton").click(()=>{
  $("#popUpWindow").css("display", "none")
})

$(".remove_department").click(()=>{
  $(".delete_department").css("display", "block")
  $(".occupation_popup").css("display", "none")
  $(".leave_popup").css("display", "none")
  $("#employee-popup").css("display", "none")
  $("#popUpWindow").css("display", "none")
})

$(".remove_department").click(()=>{
  $(".delete_department").css("display", "block")
  $("#employee-popup").css("display", "none")
  $("#popUpWindow").css("display", "none")
})

$(".confirm_before").click(()=>{
  $(".remove_button").css("display", "block")
  $(".confirm_before").css("display", "none")
})

$(".confirm_before").click(()=>{
  $(".remove_button").css("display", "block")
})

$(".close_delete_dep").click(()=>{
  $(".delete_department").css("display", "none")
 $(".remove_button").css("display", "none")
 $(".confirm_before").css("display", "block")
})

//add occupations
$(".add_occupation").click(()=>{
  $(".occupation_popup").css("display", "block")
  $(".delete_department").css("display", "none")
  $(".leave_popup").css("display", "none")
  $("#employee-popup").css("display", "none")
  $("#popUpWindow").css("display", "none")
})

$(".confirm_before_occu").click(()=>{
  $(".create_occupation").css("display", "block")
  $(".confirm_before_occu").css("display", "none")
})

//leave popUpWindow
$(".add_leave_type").click(()=>{
  $(".leave_popup").css("display", "block")
  $(".occupation_popup").css("display", "none")
  $("#employee-popup").css("display", "none")
  $("#popUpWindow").css("display", "none")
  $(".delete_department").css("display", "none")
})

$(".exit_leave").click(()=>{
  $(".leave_popup").css("display", "none")
})

//----------------

$(".confirm_before").click(()=>{
  $(".remove_button").css("display", "block")
})

$(".close_occupation").click(()=>{
  $(".occupation_popup").css("display", "none")
 $(".remove_button").css("display", "none")
 $(".confirm_before").css("display", "block")
})

//------------------------

$(".employee").click(()=>{
  $("#employee-popup").css("display", "block")
  $("#popUpWindow").css("display", "none")
  $(".delete_department").css("display", "none")
})

$(".closePopup").click(()=>{
  $("#employee-popup").css("display", "none")
})


//Create leave

$(".leave_request").click(()=>{
 $(".leave_request_popup").css("display", "block")
 $(".send_leave_info").css("display", "none")
})

$(".send_leave_Request").click(()=>{
 $(".send_leave_Request").css("border-left", "3px solid #4D4DFF")
 $(".leave_requests").css("border-left", "")
 $(".show_leave_request").css("display", "none")
 $(".send_leave_info").css("display", "block")
})

$(".leave_requests").click(()=>{
  $(".send_leave_Request").css("border-left", "")
  $(".leave_requests").css("border-left", "3px solid #4D4DFF")
 $(".show_leave_request").css("display", "block")
 $(".send_leave_info").css("display", "none")
})

$(".close_leave").click(()=>{
  $(".leave_request_popup").css("display", "none")
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

//add leave types
$(".leave_submit").click(()=>{
  let form = document.querySelector("#leave_form");
  let action = form.getAttribute("action");
  let form_data = new FormData(form);

  let xhr = new XMLHttpRequest();
  xhr.open('POST', action, true);
  xhr.setRequestHeader('X-Requested-With', 'addLeave');
  xhr.onreadystatechange = function () {
    if(xhr.readyState == 4 && xhr.status == 200) {
      var result = xhr.responseText;
      if(result){
        alert("Leave added successfully");
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

$(".submit_request").click(()=>{
  let form = document.querySelector("#leave_formSub");
  let action = form.getAttribute("action");
  let form_data = new FormData(form);

  let xhr = new XMLHttpRequest();
  xhr.open('POST', action, true);
  xhr.setRequestHeader('X-Requested-With', 'addLeaveType');
  xhr.onreadystatechange = function () {
    if(xhr.readyState == 4 && xhr.status == 200) {
      var result = xhr.responseText;
      if(result){
        alert("leave request added successfully");
      }
    }
  };
  xhr.send(form_data);
})

})
