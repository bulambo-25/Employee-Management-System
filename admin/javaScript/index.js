
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
