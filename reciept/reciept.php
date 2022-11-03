<?php
include "../connect.php";
require('./fpdf/fpdf.php');
session_start();
echo $_POST['api_url'];
// $date=strtotime("today");
// $todaydate=date("d/m/Y", $date);
// $total=0;

// $stmt = $pdo->prepare("SELECT branch.branch_id,branch.branch_address,branch.branch_tel
// FROM branch INNER JOIN employee
// ON branch.branch_id = employee.branch_id
// WHERE employee.employee_id LIKE ?
// ");
// $stmt->bindParam(1,$_SESSION["employee_id"]);
// $stmt->execute();
// $row=$stmt->fetch();
// if(!$_GET){
// 	// queryกดจ่ายตังแบบปกติ ใช้ cus_name หา
// $stmt3 = $pdo->prepare("SELECT customer.cus_name,customer.cus_tel FROM customer
// WHERE customer.cus_name LIKE ?");
// $stmt3->bindParam(1,$_SESSION["cus_reciept"]);
// $stmt3->execute();
// $cus=$stmt3->fetch();
// $stmt2 = $pdo->prepare("SELECT telephone.tel_id,telephone.tel_model
// ,repair_detail.finish_date,request.abnormality,invoice.cost
// FROM invoice JOIN repair_detail JOIN request JOIN telephone JOIN customer
// WHERE invoice.repair_id = repair_detail.repair_id
// AND repair_detail.request_id = request.request_id
// AND request.tel_id = telephone.tel_id
// AND telephone.cus_name = customer.cus_name
// AND invoice.payment_status='pending'
// AND customer.cus_name LIKE ?
// ");
// $stmt2->bindParam(1,$_SESSION["cus_reciept"]);
// $stmt2->execute();
// }else{
// 	// query หาพวก check box ทั้งหลายที่จะปริ้น ใช้ request_id หา (มั้ง แหละ)
// 	// $stmt3 customer.cus_name customer.cus_tel
// 	// $stmt2 ในตารางใบเสร็จ
// }

// //A4 width : 219mm
// //default margin : 10mm each side
// //writable horizontal : 219-(10*2)=189mm

// $pdf = new FPDF('P','mm','A4');

// $pdf->AddPage();

// $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
// $pdf->AddFont('THSarabunNew','B','THSarabunNew_b.php');

// $pdf->SetFont('THSarabunNew','B',25);
// $pdf->Cell(75	,5,'',0,0);
// $pdf->Cell(130	,5,iconv('UTF-8', 'cp874','ใบเสร็จรับเงิน'),0,1);
// $pdf->Cell(130	,5,'',0,1);

// $pdf->SetFont('Arial','B',14);
// $pdf->Cell(140	,5,'Technic Telephone',0,0);
// $pdf->SetFont('THSarabunNew','B',18);
// $pdf->Cell(59	,5,iconv('UTF-8', 'cp874', 'รายละเอียดลูกค้า'),0,1);

// $pdf->SetFont('THSarabunNew','',16);

// $pdf->Cell(140	,5,iconv('UTF-8', 'cp874','สาขา '.$row["branch_id"]),0,0);
// $pdf->Cell(59	,5,'',0,1);

// $pdf->Cell(140	,5,iconv('UTF-8', 'cp874',$row["branch_address"]),0,0);
// $pdf->Cell(25	,5,iconv('UTF-8','cp874','คุณ'.$cus["cus_name"]),0,0);
// $pdf->Cell(34	,5,'',0,1);

// $pdf->Cell(140	,5,iconv('UTF-8','cp874','โทร '.$row["branch_tel"]),0,0);
// $pdf->Cell(25	,5,iconv('UTF-8','cp874','โทร '.$cus["cus_tel"]),0,0);
// $pdf->Cell(34	,5,'',0,1);

// $pdf->Cell(130	,5,'',0,0);
// $pdf->Cell(25	,5,'',0,0);
// $pdf->Cell(34	,5,'',0,1);

// $pdf->SetFont('THSarabunNew','B',16);
// $pdf->Cell(140	,5,iconv('UTF-8','cp874','วันที่ออกใบเสร็จ'),0,0);
// $pdf->SetFont('THSarabunNew','',16);
// $pdf->Cell(25	,5,'',0,0);
// $pdf->Cell(34	,5,'',0,1);

// $pdf->Cell(140	,5,iconv('UTF-8','cp874',iconv('UTF-8','cp874',$todaydate)),0,0);

// $pdf->Cell(189	,10,'',0,1);

// $pdf->SetFont('THSarabunNew','B',16);

// $pdf->Cell(11	,5,iconv('UTF-8','cp874','ลำดับ'),1,0,'C');
// $pdf->Cell(20	,5,iconv('UTF-8','cp874','รหัสเครื่อง'),1,0);
// $pdf->Cell(50	,5,iconv('UTF-8','cp874','รุ่นโทรศัพท์บ้าน'),1,0);
// $pdf->Cell(54	,5,iconv('UTF-8','cp874','อาการผิดปกติของเครื่อง'),1,0);
// $pdf->Cell(25	,5,iconv('UTF-8','cp874','วันหมดประกัน'),1,0);
// $pdf->Cell(30	,5,iconv('UTF-8','cp874','จำนวนเงิน'),1,1,'R');

// $pdf->SetFont('THSarabunNew','',16);
// $i=1;
// while($row2 = $stmt2->fetch()){
// 	$warranty_date=date('d/m/Y', strtotime('+1 Years',strtotime($row2["finish_date"])));
// 	$pdf->Cell(11	,5,iconv('UTF-8','cp874',$i),1,0,'C');
// 	$pdf->Cell(20	,5,iconv('UTF-8','cp874',$row2["tel_id"]),1,0);
// 	$pdf->Cell(50	,5,iconv('UTF-8','cp874',$row2["tel_model"]),1,0);
// 	$pdf->Cell(54	,5,iconv('UTF-8','cp874',$row2["abnormality"]),1,0);
// 	$pdf->Cell(25	,5,iconv('UTF-8','cp874',$warranty_date),1,0);
// 	$pdf->Cell(30	,5,iconv('UTF-8','cp874',$row2["cost"].'.00'),1,1,'R');
// 	$i++;
// 	$total+=$row2["cost"];
// }

// $pdf->Cell(130	,5,'',0,0);
// $pdf->SetFont('THSarabunNew','B',16);
// $pdf->Cell(26	,5,iconv('UTF-8','cp874','รวม'),0,0);
// $pdf->Cell(4	,5,iconv('UTF-8','cp874','฿'),1,0);
// $pdf->Cell(30	,5,iconv('UTF-8','cp874',$total.'.00'),1,1,'R');

// $pdf->Output();
