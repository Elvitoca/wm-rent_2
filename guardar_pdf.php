<?php
// Directorio donde se guardará el PDF
$rutaDirectorio = 'C:/MAMP/htdocs/wm-rent_2/pedidos en pdf/';
$nombreArchivo = 'Reserva_Rent_a_Car_WM_' . date("Ymd_His") . '.pdf';
$rutaArchivo = $rutaDirectorio . $nombreArchivo;

// Obtener los datos enviados en JSON y decodificarlos
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['pdfData'])) {
    // Decodificar el PDF en base64 y guardarlo como binario
    $pdfData = base64_decode($data['pdfData']);
    if ($pdfData === false) {
        echo json_encode(['success' => false, 'error' => 'Error al decodificar el PDF en base64.']);
        exit;
    }

    // Intentar guardar el archivo
    if (file_put_contents($rutaArchivo, $pdfData)) {
        echo json_encode(['success' => true, 'message' => 'El archivo PDF se guardó exitosamente como ' . $nombreArchivo]);
    } else {
        echo json_encode(['success' => false, 'error' => 'No se pudo guardar el archivo en el servidor. Verifique los permisos del directorio.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'No se recibió ningún archivo PDF. Verifique los datos enviados.']);
}
?>
