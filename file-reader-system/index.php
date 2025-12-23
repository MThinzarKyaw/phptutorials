<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Smart File Explorer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-secondary">My Directory Files</h2>
    </div>
    <div class="row g-4">
        <?php
        $dir = 'uploads/';
        if (!is_dir($dir)) mkdir($dir); // Create uploads folder if it doesn't exist
        $allFiles = array_diff(scandir($dir), array('..', '.', 'vendor')); // Get file list excluding system directories

        $files = array_filter($allFiles, function ($file) {
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION)); // Get the file extension in lower case
            return in_array($ext, ['txt', 'csv', 'docx', 'xlsx', 'xls']);
        });

        foreach ($files as $file):
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            $icon = 'bi-file-earmark';
            $color = 'text-secondary';

            if($ext == 'txt') { 
                $icon = 'bi-file-earmark-text'; 
                $color = 'text-warning'; 
            }
            if($ext == 'xlsx' || $ext == 'xls') { 
                $icon = 'bi-file-earmark-excel'; 
                $color = 'text-success'; 
            }
            if($ext == 'csv') { 
                $icon = 'bi-filetype-csv'; 
                $color = 'text-info'; 
            }
            if($ext == 'docx') { 
                $icon = 'bi-file-earmark-word';  // Set icon for Microsoft Word documents
                $color = 'text-primary'; 
            }
        ?>
            <div class="col-md-3">
                <div class="card file-card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi <?php echo $icon . ' ' . $color; ?> display-4"></i>
                        <h6 class="mt-3 text-truncate"><?php echo $file; ?></h6>
                        <a href="view.php?file=<?php echo urlencode($dir . $file); ?>" class="btn btn-outline-dark btn-sm rounded-pill px-3">Open File</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>