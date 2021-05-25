
const popupWindow    = document.querySelector('#popUpWindow');
const addDepartment  = document.querySelector('#addDep');

const closeButton    = document.getElementsByClassName('closeButton')[0];

addDepartment.addEventListener('click', ()=>{
  popupWindow.style.display = "block";
});

closeButton.addEventListener('click', ()=>{
  popupWindow.style.display = "none";
});
