<?php
require('fpdf.php');
require('db_connect.php');
require('../PDFMerger.php');
require_once('../fpdfi/fpdi.php');

error_reporting(E_ALL); 
ini_set('display_errors', 1);

class PDF extends FPDF
		{
		function Header()
		{
			global $title;

			/*// Arial bold 15
			$this->SetFont('Arial','B',15);
			// Calculate width of title and position
			$w = $this->GetStringWidth($title)+6;
			$this->SetX((210-$w)/2);
			// Colors of frame, background and text
			$this->SetDrawColor(0,80,180);
			$this->SetFillColor(230,230,0);
			$this->SetTextColor(220,50,50);
			// Thickness of frame (1 mm)
			$this->SetLineWidth(1);
			// Title
			$this->Cell($w,9,$title,1,1,'C',true);
			// Line break
			$this->Ln(10);*/
		}

		function Footer()
		{
			// Position at 1.5 cm from bottom
			$this->SetY(-15);
			// Arial italic 8
			$this->SetFont('Arial','I',8);
			// Text color in gray
			$this->SetTextColor(128);
			// Page number
			$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
		}

		function ChapterTitle($num, $label)
		{
			// Arial 12
			$this->SetFont('Arial','',12);
			// Background color
			$this->SetFillColor(200,220,255);
			// Title
			$this->Cell(0,6,"Chapter $num : $label",0,1,'L',true);
			// Line break
			$this->Ln(4);
		}

		function ChapterBody($file)
		{
			// Read text file
			$txt = file_get_contents($file);
			// Times 12
			$this->SetFont('Times','',12);
			// Output justified text
			$this->MultiCell(0,5,'ashu');
			// Line break
			$this->Ln();
			// Mention in italics
			$this->SetFont('','I');
			$this->Cell(0,5,'(end of excerpt)');
		}

		function PrintChapter($num, $title, $file)
		{
			$this->AddPage();
			//$this->ChapterTitle($num,$title);
			$this->ChapterBody($file);
		}
}

	$image1 = "nitc.jpg";
	$pdf = new PDF();
	$pdf->SetAuthor('ashutosh');
	$pdf->AddPage();
	$pdf->Image($image1,10,10,200,80);
	$pdf->SetTextColor(0,0,0);
	$pdf->SetFont('Helvetica','',22);


	$pdf->setY(100);
	$pdf->Cell(0,20,'Course File',0,2,'C');
	$pdf->Cell(0,20,'For',0,2,'C');
	
	$id = 0;
	if(isset($_COOKIE['id'])) 
		$id =$_COOKIE['id'] ; 
	else
		$id = 0; 
		
	$result = mysqli_query($db,"select * from assign,course where assign.f_id like '$id' and course.c_id like assign.c_id");
	
	$row = mysqli_fetch_assoc($result);
	$pdf->SetFont('Helvetica','',18);
	$pdf->cell(0,20,$row['name'],0,2,'C');
	$code = '('.$row['c_id'].')';
	$pdf->cell(0,20,$code,0,2,'C');
	//$pdf->SetFont('Helvetica','',25);
	$pdf->cell(0,20,'Faculty',0,2,'C');
	$result = mysqli_query($db,"select name from faculty where f_id like '$id'");
	$row = mysqli_fetch_assoc($result);
	$pdf->SetFont('Helvetica','',15);
	$pdf->cell(0,20,ucwords($row['name']),0,2,'C');
	//$pdf->Output("ashu.pdf");
	
	/*$pdf = new PDFMerger;
	$pdf->addPDF('ashu.pdf','all')
		->addPDF('ashu.pdf', 'all')
		->merge('file', 'merge.pdf');
		
		
	//$pdf->PrintChapter(1,'asdf','ashuf');

	//$pdf->cell*/
	$sql="select * from assign a,faculty f where a.f_id = '$id' and f.f_id = '$id'";
	$result=mysqli_query($db,$sql) or die(mysqli_error($db));
	


	//echo "hiii";


	$row = mysqli_fetch_assoc($result);
	

	$cid = $row['c_id'];
	$fname = preg_replace('/\s+/', '',ucwords($row['name']))."$cid".'.pdf';
	$pdf->Output($fname,"F");

	
	//$id    = $_GET['id'];
	$query = "SELECT name, type, size, content FROM file WHERE f_id = '$id'";
	$result = mysqli_query($db,$query) or die('Error, query failed');

	$num =  $result->num_rows+2; 
       // print_r($result);
	//echo '<br>fname  == '.$fname.'<br>';


	while($num)
	{
		$row = mysqli_fetch_assoc($result);
		$name = $row['name']; 
        $type = $row['type'];
        $size = $row['size'];
        $content = $row['content'];
	//	echo 'name of file tBLE '.$name;
        $file = tmpfile();
		$file = fopen($name,"w");
		fwrite($file,$content);
		fclose($file);
		
		$pdf = new PDFMerger;
		
	//	echo 'file path '.$fname."<br/>";
//echo 'file path '.$name;

		$pdf->addPDF($fname,'all')
			->addPDF($name, 'all')
			->merge('file', $fname);

	//	echo "<br><br>after Merge".$num.'<br>'; 
		$pdf->output($fname);
		unlink($name);
		$num--;
		
	}
	$file = fopen($fname,"w");
	$query = "INSERT INTO generatedfiles(f_id,c_id,size,type,content,name) VALUES ('$id','$cid',filesize($file), filetype($file),file($file),'$fname')";

	mysqli_query($db,$query) or die('Error, query failed'); 

?>