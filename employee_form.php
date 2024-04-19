<?php

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employeename = $_POST["employeename"];
    $teamempleader = $_POST["teamempleader"];
    $teamNameDropdown = $_POST["teamNameDropdown"];
    $fromstart = $_POST["fromstart"];
    $starttime = $_POST["starttime"];
    $endtime = $_POST["endtime"];

    $xmlFilePath = 'employee_details.xml';
    if (file_exists($xmlFilePath)) {
        $xml = simplexml_load_file($xmlFilePath);
    } else {
        $xml = new SimpleXMLElement('<employeedetails></employeedetails>');
    }
    
    // Check if date schedule already booked
    foreach ($xml->children() as $employeedetail) {
        if ((string)$employeedetail->fromstart == $fromstart && (string)$employeedetail->starttime == $starttime && (string)$employeedetail->endtime == $endtime) {
            $response['success'] = false;
            $response['message'] = "Team already scheduled for the day";
            echo json_encode($response);
            exit(); 
        }
    }

    // Add new team name to XML
    $employeedetail = $xml->addChild('employeedetail');
    $employeedetail->addChild('employeename', $employeename);
    $employeedetail->addChild('teamempleader', $teamempleader);
    $employeedetail->addChild('teamNameDropdown', $teamNameDropdown);
    $employeedetail->addChild('fromstart', $fromstart);
    $employeedetail->addChild('starttime', $starttime);
    $employeedetail->addChild('endtime', $endtime);

    // Save XML to file
    $xml->asXML($xmlFilePath);
    
    // Set success message
    $response['success'] = true;
    $response['message'] = "Employee '$employeename' added successfully";
} else {
    // Set error message if request method is not POST
    $response['success'] = false;
    $response['message'] = "Invalid request method";
}

// Return response as JSON
echo json_encode($response);
?>
