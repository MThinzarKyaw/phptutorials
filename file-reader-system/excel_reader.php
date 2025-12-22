<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

function readExcelFile($path) {
    try {
        $spreadsheet = IOFactory::load($path);
        $data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        $html = '<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-success bg-opacity-10 border-0 py-3">
        <h5 class="mb-0 text-success"><i class="bi bi-file-earmark-excel me-2"></i>Excel Spreadsheet Data</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped mb-0">';
        
        foreach ($data as $rowIndex => $row) {
            $html .= "<tr>";
            foreach ($row as $cell) {
                $bg = ($rowIndex == 1) ? 'bg-light fw-bold' : '';
                $html .= "<td class='p-3 $bg border-end'>" . htmlspecialchars($cell ?? '') . "</td>";
            }
            $html .= "</tr>";
        }
        $html .= '</table></div></div></div>';
        return $html;
    } catch (Exception $e) {
        return "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    }
}