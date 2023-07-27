<?php
require "Config.php";
require('fpdf185/fpdf.php');
$uid=$_POST["u_id"];

if (isset($_POST["emp"])){
   $pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);



$q3="SELECT * FROM `user_master` WHERE `u_id`=$uid;";
$result3=mysqli_query($conn,$q3);
while($row=mysqli_fetch_array($result3)) {
  $id=$row["u_id"];
  $name=$row["u_name"];
  $depid=$row["dept_id"];
  $desigid=$row["desg_id"];
  $email=$row["u_email"];
  $contact=$row["u_contact"];
  $doj=$row["u_doj"];
  $dob=$row["u_dob"];

}
$q2="SELECT * FROM `dept_master` WHERE `dept_id`=$depid;";
$result2=mysqli_query($conn,$q2);
while($row2=mysqli_fetch_array($result2)){
    $dep=$row2["dept_name"];
}

$q="SELECT * FROM `designation_master` WHERE `desi_id`=$desigid;";
$result1=mysqli_query($conn,$q);
while($row1=mysqli_fetch_array($result1)){
    $designation=$row1["desi_name"];
   
}
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('helvetica','',15);
$pdf->Cell(190,15,"Employee details",1,0,'C',0);
$pdf->Ln();
$pdf->SetFont('helvetica','',10);
$pdf->Cell(50,10,'Employee ID',1,0,'L',0);   // empty cell with left,top, and right borders
$pdf->Cell(140,10,$id,1,0,'L',0);
$pdf->Ln();
$pdf->Cell(50,10,'Employee Name',1,0,'L',0);
$pdf->Cell(140,10,$name,1,0,'L',0);
$pdf->Ln();
$pdf->Cell(50,10,'Designation',1,0,'L',0);
$pdf->Cell(140,10,$designation,1,0,'L',0);
$pdf->Ln();
$pdf->Cell(50,10,'Department',1,0,'L',0);
$pdf->Cell(140,10, $dep,1,0,'L',0);
$pdf->Ln();
$pdf->Cell(50,10,'Email',1,0,'L',0);
$pdf->Cell(140,10,$email,1,0,'L',0);
$pdf->Ln();

$pdf->Cell(50,10,'Contact',1,0,'L',0);
$pdf->Cell(140,10,$contact,1,0,'L',0);
$pdf->Ln();

$pdf->Cell(50,10,'Date of joining',1,0,'L',0);
$pdf->Cell(140,10,$doj,1,0,'L',0);
$pdf->Ln();
$pdf->Cell(50,10,'Date of birth',1,0,'L',0);
$pdf->Cell(140,10,$dob,1,0,'L',0);
$pdf->Output();
}