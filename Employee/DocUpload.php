<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Panel</title>
    <!-- css link -->
    <link rel="stylesheet" href="./Template.css">
    <link rel="stylesheet" href="./DocUpload.css">
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
    include "./Config.php";
    if (!$_SESSION['Logged_in'] || $_SESSION['u_role_id'] != 2) {

        header("Location: ../LoginPage.php");
        exit;
    }
    $u_id = $_SESSION["u_id"];

    ?>

    <div class="main">
        <h1>Upload Doc</h1>
        <div class="navbar">
            <h2>Employee</h2>
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
        <form action="./DocUpload.php" id="Register_Form" enctype="multipart/form-data" method="post">
            <div class="DocType">
                <select name="DocType" id="DocType" required>
                    <option value="" disabled selected></option>
                    <?php
                    include "Config.php";
                    $query_desg = "SELECT * FROM `doc_type_master`;";
                    $result4 = mysqli_query($conn, $query_desg);
                    while ($row = mysqli_fetch_array($result4)) {
                        echo "<option value=$row[0]>" . $row[1] . "</option>";
                    }
                    ?>
                </select>
                <span>Document Type</span>

                <i></i>
            </div>
            <div class="Docno">
                <input type="text" name="doc_no" id="DocNo" required maxlength="15" title="Enter your Document Number">
                <span>Document Number</span>

                <i></i>
            </div>
            <div class="File">
                <label for="File-upload">Add Document in pdf Formate :</label>
                <input accept=".pdf" class="inpdddut" name="File-upload" id="File-upload" type="file" required>
            </div>
            <button id="Submit-btn" type="submit" name="submit">Submit</button>
        </form>
        <?php
        if (isset($_POST['DocType'])) {
            $doc_type = $_POST['DocType'];
            if ($query_valid = "SELECT doc_type_id FROM `user_doc_master` where u_id=$u_id AND doc_type_id=$doc_type") {
                $result = mysqli_query($conn, $query_valid);
                $rowcount = mysqli_num_rows($result);
                if ($rowcount > 0) {
                    echo "<script>alert('Document type already Uploaded');</script>";
                } else {
                    $doc_number = $_POST['doc_no'];

                    $folder = "../pdf/";
                    $file_name = $_FILES['File-upload']['name'];
                    $file_tmp = $_FILES['File-upload']['tmp_name'];


                    move_uploaded_file($file_tmp, $folder . $file_name);
                    $query = "INSERT INTO `user_doc_master` (`doc_no`, `doc`, `u_id`, `doc_type_id`) VALUES ('$doc_number', '$file_name', '$u_id', '$doc_type');";
                    if (mysqli_query($conn, $query))
                        echo "<script>alert('Document  Uploaded');</script>";
                    else
                        echo "<script>alert('Document upload error');</script>";
                }
            }
        }

        ?>
        <?php

        ?>
        <div class="Main_Content">
            <table>
                <thead>

                    <tr>
                        <th width="20%">ID</th>
                        <th width="40%">Document Type</th>
                        <th width="40%">Document Number</th>
                    </tr>
                </thead>
                <tbody id="table-body">

                    <?php
                    include "Config.php";
                    $query = "SELECT * FROM `user_doc_master` WHERE u_id=$u_id;";
                    $result = mysqli_query($conn, $query);
                    if (!$result) {
                        echo "error";
                    }
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row[0]; ?></td>
                            <td><?php
                                $se = "SELECT doc_type from doc_type_master WHERE doc_type_id=$row[4]";
                                $ex = mysqli_query($conn, $se);
                                while ($rs = mysqli_fetch_array($ex)) {
                                    echo $rs[0];
                                }
                                ?></td>
                            <td><?php echo $row[1]; ?></td>
                        </tr>
                    <?php
                    } ?>


                </tbody>
            </table>
        </div>

        <!-- script link -->
        <script src="./script.js"></script>
</body>

</html>