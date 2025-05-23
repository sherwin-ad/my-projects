<?php
header("Content-Type: application/json");

// Load data
$jsonFile = 'branches.json';

if (!file_exists($jsonFile)) {
    echo json_encode(["error" => "Data file not found"]);
    exit;
}

$data = json_decode(file_get_contents($jsonFile), true);

// Get all branches
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET['branch'])) {
        $branchName = strtolower($_GET['branch']);
        $filteredData = array_filter($data, function ($branch) use ($branchName) {
            return strtolower($branch["Branch"]) === $branchName;
        });

        echo json_encode(array_values($filteredData));
    } else {
        echo json_encode($data);
    }
} else {
    echo json_encode(["error" => "Invalid request method"]);
}
?>
