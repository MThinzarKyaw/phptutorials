<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
<div class="container py-4">
    <div class="mb-4"><a href="index.php" class="btn btn-dark btn-sm"><i class="bi bi-arrow-left"></i> Back</a></div>
    <?php
    ini_set('display_errors', 1); // Enable error display for debugging
    error_reporting(E_ALL & ~E_DEPRECATED); // Hide deprecated warnings from newer PHP versions 
    
    $file_name = $_GET['file'] ?? '';
    $path = __DIR__ . "/uploads/" . $file_name;

    if (empty($file_name) || !file_exists($path)) { // Verify if file name is provided and file exists
        echo "File not found at: " . htmlspecialchars($path); // Show error path if file is missing 
        exit;
    }

    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION)); // Get file extension to determine file type
    if ($ext == 'csv') {
        require_once __DIR__ . '/csv_reader.php';
        echo readCsvFile($path);
    }
    elseif ($ext == 'xlsx' || $ext == 'xls') {
        require_once __DIR__ . '/excel_reader.php';
        echo readExcelFile($path);
    }
    elseif ($ext == 'docx') {
        require_once __DIR__ . '/doc_reader.php';
        echo readDocxFile($path);
    }
    elseif ($ext == 'txt') {
        require_once __DIR__ . '/text_reader.php';
        echo readTextFile($path);
    }
    ?>
</div>
</body>
</html>