<?php
session_start();
include("connection.php");

if (isset($_POST['bill'])) {
    $user_id = $_SESSION['user_id'];
    
    // Fetch the PDF content from the service_table's 'reciept' field based on the user's ID
    $billQuery = "SELECT s.reciept 
                  FROM service_table s 
                  JOIN vehicle_table v ON s.vehicle_id = v.vehicle_id
                  WHERE v.user_id = ?";
    
    $billStatement = $conn->prepare($billQuery);
    $billStatement->bind_param('s', $user_id);
    $billStatement->execute();
    $billStatement->bind_result($pdfContent);
    
    if ($billStatement->fetch()) {
        // Set the appropriate headers for PDF download
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="bill.pdf"');
        
        // Output the PDF content
        echo $pdfContent;
    } else {
        echo "Bill not found.";
    }
    
    $billStatement->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
