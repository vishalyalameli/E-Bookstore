<?php
session_start();

require_once('C:\xampp\htdocs\BMS\TCPDF-main\TCPDF-main\tcpdf.php');

// Create new TCPDF instance
$pdf = new TCPDF();

// Set document information
$pdf->SetCreator('BMS');
$pdf->SetAuthor('Vishal');
$pdf->SetTitle('Invoice');
$pdf->SetSubject('Order Details');
$pdf->SetKeywords('invoice, order, bill');

// Add a page
$pdf->AddPage();

// Set some content
$pdf->SetFont('Helvetica', 'B', 16);

// Fetch data from the "order" table
include("includes/connection.php");

$query = "SELECT * FROM `order` ORDER BY `o_id` DESC LIMIT 1;";
$result = mysqli_query($link, $query);

if (mysqli_num_rows($result) > 0) {
    $pdf->Cell(0, 10, 'Order Details', 0, 1,'C');
    $pdf->Ln();

    while ($row = mysqli_fetch_assoc($result)) {
        // Get the data from the row
        $orderId = $row['o_id'];
        $name = $row['o_name'];
        $address = $row['o_address'];
        $pincode = $row['o_pincode'];
        $city = $row['o_city'];
        $state = $row['o_state'];
        $mobile = $row['o_mobile'];

        // Add the data to the PDF
        $pdf->Cell(0, 10, 'Order ID: ' . $orderId, 0, 1);
        $pdf->Cell(0, 10, 'Name: ' . $name, 0, 1);
        $pdf->Cell(0, 10, 'Address: ' . $address, 0, 1);
        $pdf->Cell(0, 10, 'Pincode: ' . $pincode, 0, 1);
        $pdf->Cell(0, 10, 'City: ' . $city, 0, 1);
        $pdf->Cell(0, 10, 'State: ' . $state, 0, 1);
        $pdf->Cell(0, 10, 'Mobile: ' . $mobile, 0, 1);

        $pdf->Ln(); // Add a line break between records
    }

    // Get the cart data
    if (isset($_SESSION['cart'])) {
        $pdf->Ln(); // Add a line break

        $pdf->Cell(0, 10, 'Product Details', 0, 1,'C');
        $pdf->Ln();

        $count = 1;
        $grandTotal = 0;

        foreach ($_SESSION['cart'] as $id => $val) {
            $productName = $val['nm'];
            $productQuantity = $val['qty'];
            $productPrice = $val['price'];
            $productTotal = $productQuantity * $productPrice;
            $grandTotal += $productTotal;

            $pdf->Cell(0, 10, 'Product ' . $count . ':', 0, 1);
            $pdf->Cell(0, 10, 'Name: ' . $productName, 0, 1);
            $pdf->Cell(0, 10, 'Quantity: ' . $productQuantity, 0, 1);
            $pdf->Cell(0, 10, 'Price: ' . $productPrice, 0, 1);
            $pdf->Cell(0, 10, 'Total: ' . $productTotal, 0, 1);

            $pdf->Ln(); // Add a line break

            $count++;
        }

        $pdf->Cell(0, 10, 'Grand Total: ' . $grandTotal, 0, 1,'C');
        $pdf->Ln();
        $pdf->Cell(0, 10, '**************************', 0, 1,'C');
        $pdf->Cell(0, 10, 'Thank You !!! Visit Again !!!', 0, 1,'C');
        $pdf->Cell(0, 10, '**************************', 0, 1,'C');
    }
} else {
    $pdf->Cell(0, 10, 'No order data available.', 0, 1);
}

// Output the PDF
$pdf->Output('bill.pdf', 'D'); // 'D' parameter will force download the PDF
?>
