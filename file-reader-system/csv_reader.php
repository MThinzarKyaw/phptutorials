<?php
function readCsvFile($path) {
    if (($handle = fopen($path, "r")) !== FALSE) {
        $html = '<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-info bg-opacity-10 border-0 py-3">
                        <h5 class="mb-0 text-info"><i class="bi bi-filetype-csv me-2"></i>CSV Document Details</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover mb-0">';
        
        while (($data = fgetcsv($handle, 1000, ",", "\"", "")) !== FALSE) {
            $html .= "<tr>";
            foreach ($data as $cell) {
                $html .= "<td class='p-3 border-bottom'>" . htmlspecialchars($cell) . "</td>";
            }
            $html .= "</tr>";
        }
        $html .= '</table></div></div></div>';
        fclose($handle);
        return $html;
    }
    return "<div class='alert alert-danger'>Could not open CSV file.</div>";
}