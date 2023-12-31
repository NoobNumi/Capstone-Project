<?php
session_start();
require('lib/fpdf.php');
// Database Connection 
$conn = new mysqli('localhost', 'root', '', 'trinitas');
//Check for connection error
if($conn->connect_error){
  die("Error in DB connection: ".$conn->connect_errno." : ".$conn->connect_error);    
}
//$datefrom = $_GET['datefrom'];
//$dateto = $_GET['dateto'];
/*$select = "SELECT * FROM indigency WHERE id = '$id'";
$result = $conn->query($select);
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
while($row = $result->fetch_object()){
  $fname = $row->fullname;
  $age = $row->age;
  $nat = $row->nationality;
  $date = $row->dateprint;
   $date = date('l, jS \of F Y');
  $fname = ucwords($fname);
  
}*/

class PDF_MySQL_Table extends FPDF
{
protected $ProcessingTable=false;
protected $aCols=array();
protected $TableX;
protected $HeaderColor;
protected $RowColors;
protected $ColorIndex;

function Header()
{
    // Print the table header if necessary
    if($this->ProcessingTable)
        $this->TableHeader();
}

function TableHeader()
{
    $this->SetFont('Arial','B',12);
    $this->SetX($this->TableX);
    $fill=!empty($this->HeaderColor);
    if($fill)
        $this->SetFillColor($this->HeaderColor[0],$this->HeaderColor[1],$this->HeaderColor[2]);
    foreach($this->aCols as $col)
        $this->Cell($col['w'],6,$col['c'],1,0,'C',$fill);
    $this->Ln();
}

function Row($data)
{
    $this->SetX($this->TableX);
    $ci=$this->ColorIndex;
    $fill=!empty($this->RowColors[$ci]);
    if($fill)
        $this->SetFillColor($this->RowColors[$ci][0],$this->RowColors[$ci][1],$this->RowColors[$ci][2]);
    foreach($this->aCols as $col)
        $this->Cell($col['w'],5,$data[$col['f']],1,0,$col['a'],$fill);
    $this->Ln();
    $this->ColorIndex=1-$ci;
}

function CalcWidths($width, $align)
{
    // Compute the widths of the columns
    $TableWidth=0;
    foreach($this->aCols as $i=>$col)
    {
        $w=$col['w'];
        if($w==-1)
            $w=$width/count($this->aCols);
        elseif(substr($w,-1)=='%')
            $w=$w/100*$width;
        $this->aCols[$i]['w']=$w;
        $TableWidth+=$w;
    }
    // Compute the abscissa of the table
    if($align=='C')
        $this->TableX=max(($this->w-$TableWidth)/2,0);
    elseif($align=='R')
        $this->TableX=max($this->w-$this->rMargin-$TableWidth,0);
    else
        $this->TableX=$this->lMargin;
}

function AddCol($field=-1, $width=-1, $caption='', $align='L')
{
    // Add a column to the table
    if($field==-1)
        $field=count($this->aCols);
    $this->aCols[]=array('f'=>$field,'c'=>$caption,'w'=>$width,'a'=>$align);
}

function Table($link, $query, $prop=array())
{
    // Execute query
    $res=mysqli_query($link,$query) or die('Error: '.mysqli_error($link)."<br>Query: $query");
    // Add all columns if none was specified
    if(count($this->aCols)==0)
    {
        $nb=mysqli_num_fields($res);
        for($i=0;$i<$nb;$i++)
            $this->AddCol();
    }
    // Retrieve column names when not specified
    foreach($this->aCols as $i=>$col)
    {
        if($col['c']=='')
        {
            if(is_string($col['f']))
                $this->aCols[$i]['c']=ucfirst($col['f']);
            else
                $this->aCols[$i]['c']=ucfirst(mysqli_fetch_field_direct($res,$col['f'])->name);
        }
    }
    // Handle properties
    if(!isset($prop['width']))
        $prop['width']=0;
    if($prop['width']==0)
        $prop['width']=$this->w-$this->lMargin-$this->rMargin;
    if(!isset($prop['align']))
        $prop['align']='C';
    if(!isset($prop['padding']))
        $prop['padding']=$this->cMargin;
    $cMargin=$this->cMargin;
    $this->cMargin=$prop['padding'];
    if(!isset($prop['HeaderColor']))
        $prop['HeaderColor']=array();
    $this->HeaderColor=$prop['HeaderColor'];
    if(!isset($prop['color1']))
        $prop['color1']=array();
    if(!isset($prop['color2']))
        $prop['color2']=array();
    $this->RowColors=array($prop['color1'],$prop['color2']);
    // Compute column widths
    $this->CalcWidths($prop['width'],$prop['align']);
    // Print header
    $this->TableHeader();
    // Print rows
    $this->SetFont('Arial','',11);
    $this->ColorIndex=0;
    $this->ProcessingTable=true;
    while($row=mysqli_fetch_array($res))
        $this->Row($row);
    $this->ProcessingTable=false;
    $this->cMargin=$cMargin;
    $this->aCols=array();
}
}


class PDF extends PDF_MySQL_Table
{
function Header()
{
    // Title
    $this->SetFont('Arial','',18);
    //$this->Cell(0,6,'',0,1,'C');
   // $this->Ln(10);
    // Ensure table header is printed
    parent::Header();
}
}

// Connect to database
//$link = mysqli_connect('server','login','password','db');
$date = date("y-m-d");
$date = date('F j, Y');
$pdf = new PDF();
$pdf->AddPage();

$pdf->Cell(10, 10, '', 0,);
$image1 = "lib/logo.jpg";
$pdf->Cell( 40, 40, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false );
$pdf->SetFont('Arial','',15);
$pdf->Cell(1 ,5,'',0,1);
$pdf->Cell(1 ,5,'',0,1);
$pdf->Cell(60 ,50,'',0,0);
$pdf->Cell(100 ,5,'Trinitas Home for Contemplation',0,1);//end of line
$pdf->Cell(47 ,5,'',0,0);
$pdf->Cell(100 ,5,'Society of Our Lady of Most Holy Trinity (SOLT)',0,1);//end of line
$pdf->Cell(70 ,5,'',0,0);
$pdf->Cell(100 ,5,'Bonga, Bacacay, Albay',0,1);//end of line
$pdf->Cell(1 ,5,'',0,1);
$pdf->Cell(1 ,5,'',0,1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(1 ,5,'________________________________________________________________________________________________',0,1);//end of line
$pdf->SetFont('Arial','B',15);
$pdf->Cell(1 ,5,'',0,1);
$pdf->Cell(78 ,5,'',0,0);
$pdf->Cell(100 ,5,'Appointment Report',0,1);//end of line
$pdf->SetFont('Arial','',12);
$pdf->Cell(1 ,5,'',0,1);
$pdf->Cell(1 ,5,'',0,0);
$pdf->Cell(100 ,5,'Date: '.$date.'',0,1);//end of line
$pdf->Cell(1 ,5,'',0,1);
$pdf->Cell(1 ,5,'',0,1);

// First table: output all columns
$pdf->Table($conn,'select * from appoinment_report');
//$pdf->AddPage();
// Second table: specify 3 columns
//$pdf->AddCol('sales_report_id',50,'Sales Report','C');
//$pdf->AddCol('report_id',40,'Report ID','C');
//$pdf->AddCol('total_sales',80,'Total Sales','C'); 
//$pdf->AddCol('sales_report_date',30,'Date','C');
//$prop = array('HeaderColor'=>array(255,150,100),
  //          'color1'=>array(210,245,255),
   //         'color2'=>array(255,255,210),
   //         'padding'=>2);
//$pdf->Table($conn,'select sales_report_id, report_id, total_sales, sales_report_date from sales_report');

$pdf->Output();

?>