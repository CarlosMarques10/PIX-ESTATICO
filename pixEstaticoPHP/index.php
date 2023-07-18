<?php
require __DIR__.'/vendor/autoload.php';

use \App\Pix\Tool;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer;


$tool = new Tool();

$tool->setChavePix('');//chave pix
$tool->setDescricao('');//descricao
$tool->setNomeTitular('');//nome do titular da conta
$tool->setCidadeTitular('');//cidade do titular da conta (sem caracteres especiais)
$tool->setValor(1.0);//valor da transferencia
$tool->setIdTransacao($tool->numeroIdTransacao());



//codigo de pagamento pix
$toolQrCode = $tool->getTool();

$qr_code = QrCode::create($toolQrCode);
$writer = new Writer\PngWriter;
$result = $writer->write($qr_code);

$imageData = base64_encode($result->getString());

echo '<div style="width: 300px; height: 300px;">';
echo '<img src="data:image/png;base64,'.$imageData.'" style="width: 100%; height: 100%;">';
echo '</div>';

