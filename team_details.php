<?php
$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $teamname = $_POST["teamname"];
    $teamleader = $_POST["teamleader"];

    // Load existing XML file or create a new one if it doesn't exist
    $xmlFilePath = 'team_details.xml';
    if (file_exists($xmlFilePath)) {
        $xml = simplexml_load_file($xmlFilePath);
    } else {
        $xml = new SimpleXMLElement('<teamDetails></teamDetails>');
    }
    
    // Check if team name already exists
    foreach ($xml->children() as $teamDetail) {
        if ((string)$teamDetail->teamname === $teamname) {
            $response['success'] = false;
            $response['message'] = "Team '$teamname' already exists.";
            echo json_encode($response);
            exit(); // Exit script
        }
    }

    // Add new team name to XML
    $teamDetail = $xml->addChild('teamDetail');
    $teamDetail->addChild('teamname', $teamname);
    $teamDetail->addChild('teamleader', $teamleader);
    
    // Save XML to file
    $xml->asXML($xmlFilePath);
    
    // Set success message
    $response['success'] = true;
    $response['message'] = "Team '$teamname' added successfully";
} else {
    // Set error message if request method is not POST
    $response['success'] = false;
    $response['message'] = "Invalid request method";
}

// Return response as JSON
echo json_encode($response);
?>
