// sidebar dropdown

                            // $('.emp-btn').click(function () {
                            // $('.sidebar ul .emp-show').toggleClass("show");
                            // });
                            // $('.dept-btn').click(function() {
                            // $('.sidebar ul .dept-show').toggleClass("show1");
                            // });

document.querySelector('.emp-btn').addEventListener('click', function () {
    document.querySelector('.sidebar ul .emp-show').classList.toggle("show");
    });
    

//leave appprove/reject popup

                            // $('.leave_A_R').click(function () {
                            //     $('.PopupMenu').toggleClass("show3");
                            //     $('.overlay').fadeIn();
                            // });
                            // $('#cancel').click(function () {
                            //     window.location.href = "/HR/CreateLeave.php"
                            //     $('.overlay').fadeOut();
                            // });

var buttonsA_R = document.querySelectorAll('.leave_A_R');

buttonsA_R.forEach(function(button) {
  button.addEventListener("click", function(){
    var popupMenu = document.querySelector('.PopupMenu');
    popupMenu.classList.toggle("show3");

    var overlay = document.querySelector('.overlay');
    overlay.style.display="block";
  });
});

var btn_cancel = document.querySelectorAll('#cancel');

btn_cancel.forEach(function(buttonExit) {
    buttonExit.addEventListener("click", function() {
        var overlay = document.querySelector('.overlay');
        overlay.style.display = "none";
        window.location.href = "/HR/CreateLeave.php";
    });
});
var searchInput = document.getElementById("Emp-search");
// var table = document.getElementById('main_table');
// var defaultt = table.innerHTML;
// // Add an event listener to the search input
// searchInput.addEventListener("input", function() {
//     // Get the search query from the input value
//     var query = searchInput.value.trim();

//     // Make an AJAX call to the PHP search script
//     var xhr = new XMLHttpRequest();

//     xhr.open("GET", "search.php?q=" + encodeURIComponent(query), true);
//     xhr.onreadystatechange = function() {
//         if (xhr.readyState == 4 && xhr.status == 200) {
//             // Update the search results with the response data
//             // var results = xhr.responses;
//             console.log(xhr.responseText);
//             if (xhr.responseText == "") {
//                 table.innerHTML = defaultt
//             } else
//                 table.innerHTML = xhr.responseText;
//             // ...
//         }
//     };
//     xhr.send();
// });