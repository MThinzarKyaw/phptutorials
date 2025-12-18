<?php
require 'vendor/autoload.php';

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\SvgWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;

$folder = 'qr-images/';

if (!file_exists($folder)) {
    mkdir($folder, 0777, true);
}

$qrImage = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['qrtext'])) {

    $data = $_POST['qrtext'];
    $filename = $folder . 'qr' . time() . '.svg';

    try {
        $qrCode = new QrCode(
            data:$data,
            encoding:new Encoding('UTF-8'),
            errorCorrectionLevel:ErrorCorrectionLevel::Low,
            size:300,
            margin:10
        );
        $writer = new SvgWriter();
        $result = $writer->write($qrCode);
        $result->saveToFile($filename);

        $qrImage = $filename;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>QR Generator</title>
</head>
<body>

<h2>QR Code Generator</h2>

<form method="post">
    <input type="text" name="qrtext" required>
    <button type="submit">Generate QR</button>
</form>

<?php if ($qrImage): ?>
    <div class="result">
    <h3>Generated QR</h3>
    <img src="<?= $qrImage ?>" width="250">
    </div>
<?php endif; ?>

</body>
</html>