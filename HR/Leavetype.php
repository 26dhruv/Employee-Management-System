<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>HR Panel</title>
   <!-- css link -->
   <link rel="stylesheet" href="./Template.css">
   <link rel="stylesheet" href="./Leavetype.css">
   <!-- font link -->
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500&display=swap" rel="stylesheet">
   <!-- icon link -->
   <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
   <link rel="icon" href="../Pictures/favicon.ico" type="image/x-icon">
</head>

<body>
   <?php
   include "Config.php";
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $leave_type = $_POST['Leave_type'];
      $short_form = $_POST['shortform'];
      $get_dep = "SELECT * FROM `leave_type_master` WHERE `leave_type`='$leave_type' ";
      $resultdep = mysqli_query($conn, $get_dep);

      $get_dep1 = "SELECT * FROM `leave_type_master` WHERE `leave_short_form`='$short_form' ";
      $resultdep1 = mysqli_query($conn, $get_dep1);


      if (mysqli_num_rows($resultdep) > 0) {
         echo "<script>alert('Leave type already exists'); window.location.href = './Leavetype.php';</script>";
      } else if (mysqli_num_rows($resultdep1) > 0) {
         echo "<script>alert('Shortform already exists'); window.location.href = './Leavetype.php';</script>";
      } else {
         $query = "INSERT INTO `leave_type_master` ( `leave_type`,`leave_short_form`) VALUES ( '$leave_type','$short_form');";
         mysqli_query($conn, $query);
      }
   }/* else {
      echo "Error";
   }*/
   // echo "Fuck u";
   ?>
   <?php
   session_start();
   echo $_SESSION["Logged_in"];
   if (!$_SESSION['Logged_in'] || $_SESSION['u_role_id'] != 0) {

      header("Location: ../LoginPage.php");
      exit;
   }
   ?>
   <div class="main">
      <h1>Manage Leave Type</h1>

      <div class="navbar">
         <h2>HR</h2>
         <div class="card">
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="card-inner"></div>
            <input type="search" name="Emp-search" id="Emp-search" placeholder="Search"><i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-search" viewBox="0 0 16 16">
                  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
               </svg></i>
         </div>
      </div>
      <div class="sidebar">
         <div class="profile"></div>
         <aside>
            <ul>
               <li><a href="./Dashboard.php">Dashboard</a></li>
               <li>
                  <a href="#" class="emp-btn">Manage Employee <span class="fas fa-caret-down first"></span></a>
                  <ul class="emp-show">
                     <li><a href="./Add_Employee.php">Add Employee</a></li>
                     <li><a href="./View_Employee.php">View Employee</a></li>
                     <li><a href="./UserProfessionalDetail.php">User Professional <br> Detail</a></li>
                  </ul>
               </li>
               <li><a href="./Leavetype.php">Manage Leave Type</a></li>
               <li><a href="./RequestLeave.php">Request Leave</a></li>
               <li><a href="./ApproveLeave.php">Approve Leave</a></li>
               <li><a href="./ScheduleTraining.php">Schedule Training</a></li>
               <li><a href="./AssignLeave.php">Assign Leave</a></li>
               <li><a href="./IssueResolution.php">Issue Resolution</a></li>
               <li><a href="./ReportGeneration.php">Report Generation</a></li>
               <li><a href="./DocType.php">Document Type</a></li>
            </ul>
         </aside>
      </div>
   </div>

   <form action="./Leavetype.php" method="POST" id="Register_Form">
      <div class="LType">
         <input type="text" name="Leave_type" id="LTYPE" required maxlength="30" pattern="[A-Za-z\s]{2,32}" title="Must contain only character">
         <span>Leave Type</span>
         <i></i>
      </div>
      <div class="lShortForm">
         <input type="text" name="shortform" id="LShortForm" required maxlength="10" pattern="[A-Za-z]{2,32}" title="Must contain only character">
         <span>Short Form</span>
         <i></i>
      </div>
      <button id="Submit-btn" type="submit" name="submit">Submit</button>
   </form>
   <div class="Main_Content">
      <table>
         <thead>
            <tr>
               <th>Leave Id</th>
               <th>Leave Type</th>
               <th>Short Form</th>
               <th>Operation</th>
            </tr>
         </thead>
         <tbody id="table-body">
            <?php
            include "Config.php";
            $query = "SELECT * FROM `leave_type_master`;";
            $result = mysqli_query($conn, $query);
            if (!$result) {
               echo "error";
            }
            while ($row = mysqli_fetch_array($result)) {
            ?>
               <tr>
                  <td><?php echo $row[0]; ?></td>
                  <td><?php echo $row[1]; ?></td>
                  <td><?php echo $row[2]; ?></td>
                  <form method="post" action="Delleave_type.php">
                     <input type="hidden" name="rowid" value="<?php echo $row[0]; ?>">
                     <td><input type="submit" value="delete" name="Deletebtn" id="Delbtn" onClick="javascript: return confirm('Please confirm deletion');"></td>
                  </form>
               </tr>
            <?php
            } ?>
         </tbody>
      </table>
      </form>

   </div>
   <!-- script link -->
   <script src="/Project/HR/script.js"></script>
   <script>
      var searchInput = document.getElementById("Emp-search");
      var table = document.getElementById('table-body');
      var defaultt = table.innerHTML;
      // Add an event listener to the search input
      searchInput.addEventListener("input", function() {
         // Get the search query from the input value
         var query = searchInput.value.trim();

         // Make an AJAX call to the PHP search script
         var xhr = new XMLHttpRequest();

         xhr.open("GET", "search.php?leave_type=" + encodeURIComponent(query), true);
         xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
               // Update the search results with the response data
               // var results = xhr.responses;
               console.log(xhr.responseText);
               if (xhr.responseText == "") {
                  table.innerHTML = defaultt
               } else
                  table.innerHTML = xhr.responseText;
               // ...
            }
         };
         xhr.send();
      });
   </script>
</body>

</html>