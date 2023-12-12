<?php
session_start();
require('lib/fpdf.php');
// Database Connection 
$conn = new mysqli('localhost', 'root', '', 'trinitas');
//Check for connection error
if ($conn->connect_error) {
    die("Error in DB connection: " . $conn->connect_errno . " : " . $conn->connect_error);
}
$datefrom = $_GET['datefrom'];
$dateto = $_GET['dateto'];
$sqlCount = "SELECT COUNT(*) AS total_retreat FROM (
                SELECT * FROM reception_reservation_record
                UNION ALL
                SELECT * FROM recollection_reservation_record
                UNION ALL
                SELECT * FROM retreat_reservation_record
                UNION ALL
                SELECT * FROM seminar_reservation_record
                UNION ALL
                SELECT * FROM training_reservation_record
            ) AS all_reservations WHERE type = 'retreat' AND timestamp between '$datefrom' AND '$dateto'";
$result = $conn->query($sqlCount);
$row = $result->fetch_object();
$retreat = $row->total_retreat;
$sqlCount2 = "SELECT COUNT(*) AS total_reception FROM (
                SELECT * FROM reception_reservation_record
                UNION ALL
                SELECT * FROM recollection_reservation_record
                UNION ALL
                SELECT * FROM retreat_reservation_record
                UNION ALL
                SELECT * FROM seminar_reservation_record
                UNION ALL
                SELECT * FROM training_reservation_record
            ) AS all_reservations WHERE type = 'reception' AND timestamp between '$datefrom' AND '$dateto'";
$result2 = $conn->query($sqlCount2);
$row = $result2->fetch_object();
$reception = $row->total_reception;

$sqlCount3 = "SELECT COUNT(*) AS total_recoll FROM (
                SELECT * FROM reception_reservation_record
                UNION ALL
                SELECT * FROM recollection_reservation_record
                UNION ALL
                SELECT * FROM retreat_reservation_record
                UNION ALL
                SELECT * FROM seminar_reservation_record
                UNION ALL
                SELECT * FROM training_reservation_record
            ) AS all_reservations WHERE type = 'recollection' AND timestamp between '$datefrom' AND '$dateto'";
$result3 = $conn->query($sqlCount3);
$row = $result3->fetch_object();
$recoll = $row->total_recoll;

$sqlCount4 = "SELECT COUNT(*) AS total_training FROM (
                SELECT * FROM reception_reservation_record
                UNION ALL
                SELECT * FROM recollection_reservation_record
                UNION ALL
                SELECT * FROM retreat_reservation_record
                UNION ALL
                SELECT * FROM seminar_reservation_record
                UNION ALL
                SELECT * FROM training_reservation_record
            ) AS all_reservations WHERE type = 'training' AND timestamp between '$datefrom' AND '$dateto'";
$result4 = $conn->query($sqlCount4);
$row = $result4->fetch_object();
$training = $row->total_training;

$sqlCount5 = "SELECT COUNT(*) AS total_seminar FROM (
                SELECT * FROM reception_reservation_record
                UNION ALL
                SELECT * FROM recollection_reservation_record
                UNION ALL
                SELECT * FROM retreat_reservation_record
                UNION ALL
                SELECT * FROM seminar_reservation_record
                UNION ALL
                SELECT * FROM training_reservation_record
            ) AS all_reservations WHERE type = 'seminar' AND timestamp between '$datefrom' AND '$dateto'";
$result5 = $conn->query($sqlCount5);
$row = $result5->fetch_object();
$seminar = $row->total_seminar;

$sqlCount6 = "SELECT COUNT(*) AS total FROM (
                SELECT * FROM reception_reservation_record
                UNION ALL
                SELECT * FROM recollection_reservation_record
                UNION ALL
                SELECT * FROM retreat_reservation_record
                UNION ALL
                SELECT * FROM seminar_reservation_record
                UNION ALL
                SELECT * FROM training_reservation_record
            ) AS all_reservations WHERE timestamp between '$datefrom' AND '$dateto'";
$result6 = $conn->query($sqlCount6);
$row = $result6->fetch_object();
$total = $row->total;

$sqlCount7 = "SELECT service_name, COUNT(*) AS reservation_count FROM (
    SELECT 'Reception' AS service_name FROM reception_reservation_record WHERE timestamp BETWEEN '$datefrom' AND '$dateto'
    UNION ALL
    SELECT 'Recollection' AS service_name FROM recollection_reservation_record WHERE timestamp BETWEEN '$datefrom' AND '$dateto'
    UNION ALL
    SELECT 'Retreat' AS service_name FROM retreat_reservation_record WHERE timestamp BETWEEN '$datefrom' AND '$dateto'
    UNION ALL
    SELECT 'Seminar' AS service_name FROM seminar_reservation_record WHERE timestamp BETWEEN '$datefrom' AND '$dateto'
    UNION ALL
    SELECT 'Training' AS service_name FROM training_reservation_record WHERE timestamp BETWEEN '$datefrom' AND '$dateto'
) AS all_reservations
GROUP BY service_name
ORDER BY reservation_count DESC
LIMIT 1";
$result7 = $conn->query($sqlCount7);
$row7 = $result7->fetch_object();
$mostReservedService = $row7->service_name;

$sqlCount8 = "SELECT services.service_name, COALESCE(COUNT(all_reservations.service_name), 0) AS reservation_count FROM (
    SELECT 'Reception' AS service_name
    UNION ALL
    SELECT 'Recollection' AS service_name
    UNION ALL
    SELECT 'Retreat' AS service_name
    UNION ALL
    SELECT 'Seminar' AS service_name
    UNION ALL
    SELECT 'Training' AS service_name
) AS services
LEFT JOIN (
    SELECT 'Reception' AS service_name FROM reception_reservation_record WHERE timestamp BETWEEN '$datefrom' AND '$dateto'
    UNION ALL
    SELECT 'Recollection' AS service_name FROM recollection_reservation_record WHERE timestamp BETWEEN '$datefrom' AND '$dateto'
    UNION ALL
    SELECT 'Retreat' AS service_name FROM retreat_reservation_record WHERE timestamp BETWEEN '$datefrom' AND '$dateto'
    UNION ALL
    SELECT 'Seminar' AS service_name FROM seminar_reservation_record WHERE timestamp BETWEEN '$datefrom' AND '$dateto'
    UNION ALL
    SELECT 'Training' AS service_name FROM training_reservation_record WHERE timestamp BETWEEN '$datefrom' AND '$dateto'
) AS all_reservations
ON services.service_name = all_reservations.service_name
GROUP BY services.service_name
ORDER BY reservation_count ASC, services.service_name DESC
LIMIT 1";
$result8 = $conn->query($sqlCount8);
$row8 = $result8->fetch_object();
$leastReservedService = $row8->service_name;


class PDF_MySQL_Table extends FPDF
{
    protected $ProcessingTable = false;
    protected $aCols = array();
    protected $TableX;
    protected $HeaderColor;
    protected $RowColors;
    protected $ColorIndex;

    function Header()
    {
        // Print the table header if necessary
        if ($this->ProcessingTable)
            $this->TableHeader();
    }

    function TableHeader()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->SetX($this->TableX);
        $fill = !empty($this->HeaderColor);
        if ($fill)
            $this->SetFillColor($this->HeaderColor[0], $this->HeaderColor[1], $this->HeaderColor[2]);
        foreach ($this->aCols as $col)
            $this->Cell($col['w'], 6, $col['c'], 1, 0, 'C', $fill);
        $this->Ln();
    }

    function Row($data)
    {
        $this->SetX($this->TableX);
        $ci = $this->ColorIndex;
        $fill = !empty($this->RowColors[$ci]);
        if ($fill)
            $this->SetFillColor($this->RowColors[$ci][0], $this->RowColors[$ci][1], $this->RowColors[$ci][2]);
        foreach ($this->aCols as $col)
            $this->Cell($col['w'], 5, $data[$col['f']], 1, 0, $col['a'], $fill);
        $this->Ln();
        $this->ColorIndex = 1 - $ci;
    }

    function CalcWidths($width, $align)
    {
        // Compute the widths of the columns
        $TableWidth = 0;
        foreach ($this->aCols as $i => $col) {
            $w = $col['w'];
            if ($w == -1)
                $w = $width / count($this->aCols);
            elseif (substr($w, -1) == '%')
                $w = $w / 100 * $width;
            $this->aCols[$i]['w'] = $w;
            $TableWidth += $w;
        }
        // Compute the abscissa of the table
        if ($align == 'C')
            $this->TableX = max(($this->w - $TableWidth) / 2, 0);
        elseif ($align == 'R')
            $this->TableX = max($this->w - $this->rMargin - $TableWidth, 0);
        else
            $this->TableX = $this->lMargin;
    }

    function AddCol($field = -1, $width = -1, $caption = '', $align = 'L')
    {
        // Add a column to the table
        if ($field == -1)
            $field = count($this->aCols);
        $this->aCols[] = array('f' => $field, 'c' => $caption, 'w' => $width, 'a' => $align);
    }

    function Table($link, $query, $prop = array())
    {
        // Execute query
        $res = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link) . "<br>Query: $query");
        // Add all columns if none was specified
        if (count($this->aCols) == 0) {
            $nb = mysqli_num_fields($res);
            for ($i = 0; $i < $nb; $i++)
                $this->AddCol();
        }
        // Retrieve column names when not specified
        foreach ($this->aCols as $i => $col) {
            if ($col['c'] == '') {
                if (is_string($col['f']))
                    $this->aCols[$i]['c'] = ucfirst($col['f']);
                else
                    $this->aCols[$i]['c'] = ucfirst(mysqli_fetch_field_direct($res, $col['f'])->name);
            }
        }
        // Handle properties
        if (!isset($prop['width']))
            $prop['width'] = 0;
        if ($prop['width'] == 0)
            $prop['width'] = $this->w - $this->lMargin - $this->rMargin;
        if (!isset($prop['align']))
            $prop['align'] = 'C';
        if (!isset($prop['padding']))
            $prop['padding'] = $this->cMargin;
        $cMargin = $this->cMargin;
        $this->cMargin = $prop['padding'];
        if (!isset($prop['HeaderColor']))
            $prop['HeaderColor'] = array();
        $this->HeaderColor = $prop['HeaderColor'];
        if (!isset($prop['color1']))
            $prop['color1'] = array();
        if (!isset($prop['color2']))
            $prop['color2'] = array();
        $this->RowColors = array($prop['color1'], $prop['color2']);
        // Compute column widths
        $this->CalcWidths($prop['width'], $prop['align']);
        // Print header
        $this->TableHeader();
        // Print rows
        $this->SetFont('Arial', '', 11);
        $this->ColorIndex = 0;
        $this->ProcessingTable = true;
        while ($row = mysqli_fetch_array($res))
            $this->Row($row);
        $this->ProcessingTable = false;
        $this->cMargin = $cMargin;
        $this->aCols = array();
    }
}


class PDF extends PDF_MySQL_Table
{
    function Header()
    {
        // Title
        $this->SetFont('Arial', '', 18);
        //$this->Cell(0,6,'',0,1,'C');
        // $this->Ln(10);
        // Ensure table header is printed
        parent::Header();
    }
}

// Connect to database
//$link = mysqli_connect('server','login','password','db');
$date = date("y-m-d");
//$datefrom = date('F j, Y');
//$dateto = date('F j, Y');
$pdf = new PDF();
$pdf->AddPage('L');

$pdf->Cell(45, 10, '', 0,);
$image1 = "lib/logo.jpg";
$pdf->Cell(40, 40, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false);
$pdf->SetFont('Arial', '', 15);
$pdf->Cell(1, 5, '', 0, 1);
$pdf->Cell(1, 5, '', 0, 1);
$pdf->Cell(100, 50, '', 0, 0);
$pdf->Cell(100, 5, 'Trinitas Home for Contemplation', 0, 1); //end of line
$pdf->Cell(80, 5, '', 0, 0);
$pdf->Cell(100, 5, 'Society of Our Lady of Most Holy Trinity (SOLT)', 0, 1); //end of line
$pdf->Cell(110, 5, '', 0, 0);
$pdf->Cell(100, 5, 'Bonga, Bacacay, Albay', 0, 1); //end of line
$pdf->Cell(1, 5, '', 0, 1);
$pdf->Cell(1, 5, '', 0, 1);
$pdf->SetFont('Arial', '', 10);
//end of line
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(1, 5, '', 0, 1);
$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(100, 5, 'Frequency Report', 0, 1); //end of line
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(1, 5, '', 0, 1);
$pdf->Cell(20, 5, '', 0, 0);
$pdf->Cell(100, 5, 'Date Range: ' . date('F j, Y', strtotime($datefrom)) . ' to ' . date('F j, Y', strtotime($dateto)) . '', 0, 1); //end of line
$pdf->Cell(1, 5, '', 0, 1);
$pdf->Cell(1, 5, '', 0, 1);

// First table: output all columns
//$pdf->Table($conn,'select * from sales_report where sales_report_date = '.$dateto.'');
//$pdf->AddPage();
// Second table: specify 3 columns


//invoice contents
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(85, 5, '', 0, 0);
$pdf->Cell(50, 10, 'Type of Service', 1, 0, 'C');
$pdf->Cell(60, 10, 'Number of Reservation', 1, 1, 'C'); //end of line

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(85, 5, '', 0, 0);
$pdf->Cell(50, 10, 'Retreat', 1, 0, 'C');
$pdf->Cell(60, 10, $retreat, 1, 1, 'C'); //end of line
$pdf->Cell(85, 10, '', 0, 0);
$pdf->Cell(50, 10, 'Reception', 1, 0, 'C');
$pdf->Cell(60, 10, $reception, 1, 1, 'C'); //end of line
$pdf->Cell(85, 10, '', 0, 0);
$pdf->Cell(50, 10, 'Recollection', 1, 0, 'C');
$pdf->Cell(60, 10, $recoll, 1, 1, 'C'); //end of line
$pdf->Cell(85, 10, '', 0, 0);
$pdf->Cell(50, 10, 'Seminar', 1, 0, 'C');
$pdf->Cell(60, 10, $seminar, 1, 1, 'C'); //end of line
$pdf->Cell(85, 10, '', 0, 0);
$pdf->Cell(50, 10, 'Training', 1, 0, 'C');
$pdf->Cell(60, 10, $training, 1, 1, 'C'); //end of line
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(1, 5, '', 0, 1);
$pdf->Cell(20, 5, '', 0, 0);
$pdf->Cell(100, 5, 'Summary:', 0, 1); //end of line
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(1, 5, '', 0, 1);
$pdf->Cell(20, 5, '', 0, 0);
$pdf->Cell(100, 5, 'Most Reserved Service: ' . $mostReservedService, 0, 1); //end of line
$pdf->Cell(1, 5, '', 0, 1);
$pdf->Cell(20, 5, '', 0, 0);
$pdf->Cell(100, 5, 'Least Reserved Service: ' . $leastReservedService, 0, 1); //end of line
$pdf->Cell(1, 5, '', 0, 1);
$pdf->Cell(20, 5, '', 0, 0);
$pdf->Cell(100, 5, 'Total Reservation: ' . $total . '', 0, 1); //end of line
$pdf->Output();
