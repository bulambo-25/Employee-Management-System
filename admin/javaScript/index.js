
//add department
const popupWindow    = document.querySelector('#popUpWindow');
const addDepartment  = document.querySelector('#addDep');

const closeButton    = document.getElementsByClassName('closeButton')[0];

addDepartment.addEventListener('click', ()=>{
  popupWindow.style.display = "block";
});

closeButton.addEventListener('click', ()=>{
  popupWindow.style.display = "none";
});


//Add employee
const employeePopup  = document.querySelector('#employee-popup');
const addEmployee    = document.querySelector('#add-Employees');

const closePopup     = document.getElementsByClassName('closePopup')[0];

addEmployee.addEventListener('click', ()=>{
  employeePopup.style.display = "block";
});

closePopup.addEventListener('click', ()=>{
  employeePopup.style.display = "none";
});

//fetch table names
selectDepartment = document.querySelector("#selectedDepartment");

document.addEventListener('DOMContentLoaded', ()=>{
showEmployees();
var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {

if (this.readyState == 4 && this.status == 200) {
    response = JSON.parse(this.responseText);
    let depart = Object.values(response);

    depart.forEach( (item)=> {
    let options = document.createElement('option');
    options.innerHTML = `
    <option value="${item}">${item}</option>
      `;
    selectDepartment.appendChild(options);
    });

   }
};
xmlhttp.open("GET", "../../admin/json/departments.json", true);
xmlhttp.send();
}
);

submitEmployee = document.querySelector("#submitEmployee");

submitEmployee.addEventListener('click', ()=>{

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

});

function showEmployees(){

let records = document.querySelector('#records');
let array  = [];
let array1  = [];
let objEmp = {};

let xhr = new XMLHttpRequest();
xhr.open('GET','../../admin/app/userRegistration.php', true);
xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
xhr.onreadystatechange = function () {
  if(xhr.readyState == 4 && xhr.status == 200) {
    let response = JSON.parse(xhr.responseText);
    result = Object.values(response);

    for(i = 0; i < result.length; i++){
    array.push(result[i]);
    if(array.length == 4){
      objEmp.name       = array[0];
      objEmp.surname    = array[1];
      objEmp.identity   = array[2];
      objEmp.department = array[3];
      array1.push(objEmp);
      array.length = 0;
      objEmp = {};
    }
    }

    array1.forEach((item) => {
      let row     = document.createElement('tr');
      row.innerHTML = `
      <tr>
      <td>${item.name}</td>
      <td>${item.surname}</td>
      <td>${item.identity}</td>
      <td>${item.department}</td>
      </tr>
      `;
  records.appendChild(row);
    });

    };

    };

xhr.send();
}
