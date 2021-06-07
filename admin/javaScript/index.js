
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
