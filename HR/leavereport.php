<?php

require "Config.php";
require('fpdf185/fpdf.php');
$uid = $_POST["u_id"];
$nol = 0;
if (isset($_POST["leave"])) {
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $width_cell = array(20, 50, 40, 40, 40);

    $q1 = "SELECT * FROM `user_leave` WHERE u_id=$uid AND status=2;";
    $result = mysqli_query($conn, $q1);
    if (mysqli_num_rows($result) == 0) {
        echo "<script>alert('User has no leave requests'); window.location.href = './ReportGeneration.php';</script>";
    } else {
        while ($row = mysqli_fetch_array($result)) {
            $nol = $row["no_leave"] + $nol;
            $lvid = $row["leave_id"];
            $uid = $row["u_id"];
            $status = $row["status"];
            $ledate =  $row["le_date"];
            $lvtypeid = $row["leave_type_id"];
        }

        $q2 = "SELECT * FROM `leave_type_master` WHERE leave_type_id=$lvtypeid;";
        $result2 = mysqli_query($conn, $q2);

        while ($row2 = mysqli_fetch_array($result2)) {
            $lvtype = $row2["leave_type"];
        }
        $gleave = 0;
        $q3 = "SELECT * FROM `leave_balance` WHERE u_id=$uid;";
        $result3 = mysqli_query($conn, $q3);
        while ($r3 = mysqli_fetch_array($result3)) {
            $gleave = $gleave + $r3[1];
        }
        $left = $gleave - $nol;
        $pdf = new FPDF();
        $pdf->AddPage();

        $pdf->SetFont('helvetica', '', 15);
        $pdf->Cell(190, 15, "Leave Report", 1, 0, 'C', 0);
        $pdf->Ln();
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(50, 10, 'Employee id', 1, 0, 'L', 0);
        $pdf->Cell(140, 10, $uid, 1, 0, 'L', 0);
        $pdf->Ln();
        $pdf->Cell(50, 10, 'No of leaves taken', 1, 0, 'L', 0);
        $pdf->Cell(140, 10, $nol, 1, 0, 'L', 0);
        $pdf->Ln();
        $pdf->Cell(50, 10, 'No of leaves left', 1, 0, 'L', 0);
        $pdf->Cell(140, 10, $left, 1, 0, 'L', 0);
        $pdf->Ln();


        $pdf->Cell(50, 10, 'Last date', 1, 0, 'L', 0);
        $pdf->Cell(140, 10, $ledate, 1, 0, 'L', 0);
        $pdf->Ln();
        $pdf->Cell(50, 10, 'Granted leave', 1, 0, 'L', 0);
        $pdf->Cell(140, 10, $gleave, 1, 0, 'L', 0);
        $pdf->Output();
    }
}
