<?php
require "Config.php";
require('fpdf185/fpdf.php');
session_start();

$uid = $_SESSION['u_id'];

if (isset($_POST["cons"])) {
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    $q1 = "SELECT * FROM `user_master` WHERE u_id=$uid;";
    $result1 = mysqli_query($conn, $q1);
    while ($row1 = mysqli_fetch_array($result1)) {
        $uname = $row1["u_name"];
    }



    $q = "SELECT * FROM `user_salary` WHERE u_id=$uid;";
    $result = mysqli_query($conn, $q);
    if (mysqli_num_rows($result) == 0) {
        echo "<script>alert('User has not been assigned salary yet'); window.location.href = './ReportGeneration.php';</script>";
    } else {
        while ($row = mysqli_fetch_array($result)) {

            //$row["net_payable_salary"]
           // $lwp = $row["lwp"];
            $tds = $row["tds"];
            $pf = $row["pf"];
            $pt = $row["pt"];
            $ys = $row["y_salary"];

            $id = $row["u_id"];
        }
        $t =  $pf + $tds + $pt;
        //echo $t;
        $subsal = ($t / 100) * $ys;
        //echo  $subsal;
        $finalsal = $ys - $subsal;
        // echo  $finalsal;


        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 15);
        $pdf->Cell(190, 15, "Consolidated salary report", 1, 0, 'C', 0);
        $pdf->Ln();
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(50, 10, 'Employee ID', 1, 0, 'L', 0);   // empty cell with left,top, and right borders
        $pdf->Cell(140, 10, $id, 1, 0, 'L', 0);
        $pdf->Ln();
        $pdf->Cell(50, 10, 'Employee Name', 1, 0, 'L', 0);
        $pdf->Cell(140, 10, $uname, 1, 0, 'L', 0);
        $pdf->Ln();
       
        $pdf->Cell(50, 10, 'Yearly salary', 1, 0, 'L', 0);
        $pdf->Cell(140, 10, $ys, 1, 0, 'L', 0);
        $pdf->Ln();
        $pdf->Cell(50, 10, 'Tax Deducted at Source', 1, 0, 'L', 0);
        $pdf->Cell(140, 10, $tds . "%", 1, 0, 'L', 0);
        $pdf->Ln();
        $pdf->Cell(50, 10, 'Employee Provident Fund', 1, 0, 'L', 0);
        $pdf->Cell(140, 10, $pf . "%", 1, 0, 'L', 0);
        $pdf->Ln();
        $pdf->Cell(50, 10, 'Professional tax', 1, 0, 'L', 0);
        $pdf->Cell(140, 10, $pt . "%", 1, 0, 'L', 0);
        $pdf->Ln();
        $pdf->Cell(50, 10, 'Net payable salary', 1, 0, 'L', 0);
        $pdf->Cell(140, 10, $finalsal, 1, 0, 'L', 0);
        $pdf->Output();
    }
}
