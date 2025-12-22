<?php
echo "1. Zip Extension: " . (class_exists('ZipArchive') ? "ON" : "OFF") . "<br>";
echo "2. CSV Reader File: " . (file_exists('csv_reader.php') ? "Found" : "Missing") . "<br>";
echo "3. Excel Reader File: " . (file_exists('excel_reader.php') ? "Found" : "Missing") . "<br>";
echo "4. Doc Reader File: " . (file_exists('doc_reader.php') ? "Found" : "Missing") . "<br>";
?>