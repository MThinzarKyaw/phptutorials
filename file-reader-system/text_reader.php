<?php
function readTextFile($path) {
    if (file_exists($path)) {
        $content = file_get_contents($path);
        return '<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-warning bg-opacity-10 border-0 py-3">
        <h5 class="mb-0 text-dark"><i class="bi bi-file-earmark-text me-2"></i>Plain Text Content</h5>
        </div>
        <div class="card-body p-4 bg-white">
        <div style="white-space: pre-wrap; font-family: \'Courier New\', Courier, monospace; line-height: 1.6; color: #333;">' . 
                    htmlspecialchars($content) . 
                '</div>
            </div>
        </div>';
    }
    return "<div class='alert alert-danger'>Text file not found.</div>";
}
?>