<?php
require_once 'vendor/autoload.php';
use PhpOffice\PhpWord\IOFactory as WordIOFactory;

function readDocxFile($path) {
    try {
        $phpWord = WordIOFactory::load($path);
        $fullText = "";

        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                if (method_exists($element, 'getText')) {
                    /** @var \PhpOffice\PhpWord\Element\Text $element */
                    $fullText .= '<p class="mb-2">' . htmlspecialchars($element->getText()) . '</p>';
                } 
                elseif ($element instanceof \PhpOffice\PhpWord\Element\Table) {
                    $fullText .= '<div class="table-responsive"><table class="table table-bordered">';
                    foreach ($element->getRows() as $row) {
                        $fullText .= '<tr>';
                        foreach ($row->getCells() as $cell) {
                            $fullText .= '<td>';
                            foreach ($cell->getElements() as $cellElement) {
                                if (method_exists($cellElement, 'getText')) {
                                    /** @var \PhpOffice\PhpWord\Element\Text $cellElement */
                                    $fullText .= htmlspecialchars($cellElement->getText());
                                }
                            }
                            $fullText .= '</td>';
                        }
                        $fullText .= '</tr>';
                    }
                    $fullText .= '</table></div>';
                }
            }
        }

        return '
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-primary bg-opacity-10 border-0 py-3 text-center">
                        <h5 class="mb-0 text-primary"><i class="bi bi-file-earmark-word me-2"></i>Word Document Viewer</h5>
                    </div>
                    <div class="card-body p-5 bg-white mx-auto shadow-sm" style="max-width: 800px; min-height: 600px; border: 1px solid #eee;">
                        <div class="document-content text-dark" style="font-size: 1.1rem; line-height: 1.8;">' . 
                            (empty($fullText) ? "No readable text found." : $fullText) . 
                        '</div>
                    </div>
                </div>';
    } catch (Exception $e) {
        return "<div class='alert alert-danger'>Error reading Word file: " . $e->getMessage() . "</div>";
    }
}