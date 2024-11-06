<?php
// backend_iniciar_pago.php

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

// Configura tus credenciales de API y el endpoint de Bancard
$api_key = "TU_API_KEY";
$api_secret = "TU_API_SECRET";
$endpoint = "https://sandbox.bancard.com.py/vpos/api/0.3/single_buy";

$params = [
    "public_key" => $api_key,
    "operation" => [
        "token" => uniqid(),  // Genera un ID único para cada transacción
        "shop_process_id" => $data["transaccion_id"],
        "amount" => $data["monto"],
        "currency" => $data["moneda"],
        "description" => $data["descripcion"],
        "return_url" => $data["retorno_url"],
        "cancel_url" => $data["cancelacion_url"]
    ]
];

$options = [
    "http" => [
        "header" => "Content-Type: application/json\r\n" .
                    "Authorization: Basic " . base64_encode("$api_key:$api_secret"),
        "method" => "POST",
        "content" => json_encode($params)
    ]
];

$context = stream_context_create($options);
$result = file_get_contents($endpoint, false, $context);

if ($result === FALSE) {
    echo json_encode(["error" => "No se pudo conectar a Bancard"]);
} else {
    $response_data = json_decode($result, true);
    echo json_encode(["url_pago" => $response_data["process"]["url"]]);
}
?>
