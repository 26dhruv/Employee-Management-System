
<?php
// salry details--------------------------------------------------------
require "Config.php";
require('fpdf185/fpdf.php');
$uid = $_POST["u_id"];

if (isset($_POST["salary"])) {
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    // echo $uid;
    $q3 = "SELECT * FROM `user_salary` WHERE u_id='$uid';";
    $result3 = mysqli_query($conn, $q3);

    if (mysqli_num_rows($result3) == 0) {
        echo "<script>alert('User has not been assigned salary'); window.location.href = './ReportGeneration.php';</script>";
    } else {
        while ($row3 = mysqli_fetch_array($result3)) {

            $sal = $row3[1];
            // echo $row3[1];
        }

        $q1 = "SELECT * FROM `user_master` WHERE `u_id`=$uid;";
        $result = mysqli_query($conn, $q1);
        while ($row = mysqli_fetch_array($result)) {
            $id = $row["u_id"];
            $name = $row["u_name"];
            $depid = $row["dept_id"];
            $desi_id = $row['desg_id'];
        }
        $q2 = "SELECT * FROM `dept_master` WHERE `dept_id`=$depid;";
        $result2 = mysqli_query($conn, $q2);
        while ($row2 = mysqli_fetch_array($result2)) {
            $dep = $row2["dept_name"];
        }

        $q = "SELECT * FROM `designation_master` WHERE `desi_id`=$desi_id;";
        $result1 = mysqli_query($conn, $q);
        while ($row1 = mysqli_fetch_array($result1)) {
            $designation = $row1[0];
        }



        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 15);
        $pdf->Cell(190, 15, "Salary slip", 1, 0, 'C', 0);
        $pdf->Ln();
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(50, 10, 'Employee ID', 1, 0, 'L', 0);   // empty cell with left,top, and right borders
        $pdf->Cell(140, 10, $id, 1, 0, 'L', 0);
        $pdf->Ln();
        $pdf->Cell(50, 10, 'Employee Name', 1, 0, 'L', 0);
        $pdf->Cell(140, 10, $name, 1, 0, 'L', 0);
        $pdf->Ln();
        $pdf->Cell(50, 10, 'Designation', 1, 0, 'L', 0);
        $pdf->Cell(140, 10, $designation, 1, 0, 'L', 0);
        $pdf->Ln();
        $pdf->Cell(50, 10, 'Department', 1, 0, 'L', 0);
        $pdf->Cell(140, 10, $dep, 1, 0, 'L', 0);
        $pdf->Ln();
        $pdf->Cell(50, 10, 'Total Salary', 1, 0, 'L', 0);
        $pdf->Cell(140, 10, $sal, 1, 0, 'L', 0);
        $pdf->Output();
    }
}
