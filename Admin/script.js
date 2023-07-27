// //Manage Employee Dropdown
// $('.emp-btn').click(function () {
// $('.sidebar ul .emp-show').toggleClass("show");
// });
// //Employee Education Dropdown
// $('.emp-edu').click(function() {
// $('.sidebar ul .emp-edu-show').toggleClass("show1");
// });
// //Manage Branch Dropdown
// $('.emp-branch').click(function() {
// $('.sidebar ul .emp-branch-show').toggleClass("show2");
// });

// Manage Employee Dropdown
document.querySelector(".emp-btn").addEventListener("click", function () {
  document.querySelector(".sidebar ul .emp-show").classList.toggle("show");
});

// Employee Education Dropdown
document.querySelector(".emp-edu").addEventListener("click", function () {
  document.querySelector(".sidebar ul .emp-edu-show").classList.toggle("show1");
});

// Manage Branch Dropdown
document.querySelector(".emp-branch").addEventListener("click", function () {
  document
    .querySelector(".sidebar ul .emp-branch-show")
    .classList.toggle("show2");
});

var buttonsA_R = document.querySelectorAll(".leave_A_R");

buttonsA_R.forEach(function (button) {
  button.addEventListener("click", function () {
    var popupMenu = document.querySelector(".PopupMenu");
    popupMenu.classList.toggle("show3");

    var overlay = document.querySelector(".overlay");
    overlay.style.display = "block";
  });
});

var btn_cancel = document.querySelectorAll("#cancel");

btn_cancel.forEach(function (buttonExit) {
  buttonExit.addEventListener("click", function () {
    var overlay = document.querySelector(".overlay");
    overlay.style.display = "none";
    window.location.href = "./CreateLeave.php";
  });
});
