<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Panel</title>
    <!-- css link -->
    <link rel="stylesheet" href="./Template.css">
    <link rel="stylesheet" href="./EscolateIssue.css">
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
    session_start();
    $id = $_SESSION['u_id'];
    include "./Config.php";
    if (!$_SESSION['Logged_in'] || $_SESSION['u_role_id'] != 2) {

        header("Location: ../LoginPage.php");
        exit;
    }

    ?>

    <div class="main">
        <h1>Escolate Issue</h1>
        <div class="navbar">
            <h2>Employee</h2>
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
                    <li><a href="./RequestLeave.php">Request Leave</a></li>
                    <li><a href="./TrainingSessions.php">Training Sessions</a></li>
                    <li><a href="./EscolateIssue.php">Escolate Issue</a></li>
                    <li><a href="./ReportGeneration.php">Report Generation</a></li>
                    <li><a href="./DocUpload.php">Document Upload</a></li>
                </ul>
            </aside>
        </div>
    </div>
    <div class="Main_Content">
        <form action="./EscolateIssue.php" method="POST" id="Register_Form">
            <div class="title">
                <input type="text" name="title" id="title" required maxlength="50" pattern="[A-Za-z\s]{2,32}" title="Must contain only character">
                <span>Title</span>
                <i></i>
            </div>
            <div class="issue_date">
                <input type="text" name="issue_date" id="issue_date" min="<?php echo date('Y-d-m') ?>" required onfocus="(this.type='date')" onblur="(this.type='text')">
                <span>Issue date</span>
                <i></i>
            </div>
            <div class="issueDesc">
                <textarea name="issue_description" id="issueDesc" required cols="20" rows="10"></textarea>
                <span>Issue Description</span>
                <i></i>
            </div>
            <button id="Submit-btn" type="submit" name="submit">Submit</button>
        </form>
        <?php
        if (isset($_POST['title'])) {
            $u_id = $_SESSION['u_id'];
            $title = $_POST['title'];
            $issue_date = $_POST['issue_date'];
            $issue_desc = $_POST['issue_description'];
            $insert_query = "INSERT INTO `issue` ( `issue_desc`, `title`, `issue_date`, `issue_status`, `u_id`) VALUES ( '$title', '$issue_desc', '$issue_date', '3', $u_id)";
            if (mysqli_query($conn, $insert_query))
                echo  "<script>alert('Details Inserted');</script>";
            else
                echo  "<script>alert('Insertion Error');</script>";
        }

        ?>
    </div>

    <div class="table_view">
        <table>
            <tr>
                <th width=5%>Id</th>
                <th width=20%>Title</th>
                <th width=30%>Description</th>
                <th width=15%>Issue Date</th>
                <th width=15%>Status</th>

            </tr>
            <tbody id="table-body">

                <?php

                $query = "SELECT * FROM `issue` where u_id=$id ;";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    echo "error";
                }
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <tr>

                        <td><?php echo $row[0]; ?></td>
                        <td><?php echo $row[2]; ?></td>
                        <td><?php echo $row[1]; ?></td>
                        <td><?php echo $row[3]; ?></td>
                        <td><?php
                            if ($row[4] == 3)
                                echo "Pending";
                            elseif ($row[4] == 2)
                                echo "Solved";
                            elseif ($row[4] == 1)
                                echo "Rejected";
                            ?></td>

                    </tr>
                <?php
                } ?>
            </tbody>
            </tbody>
        </table>
    </div>
    <!-- script link -->
    <script src="./script.js"></script>
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

            xhr.open("GET", "search.php?escolate_id=" + encodeURIComponent(query), true);
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