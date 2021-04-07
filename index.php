<?php

require './vendor/autoload.php';

if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"])) {
  return false;    // serve the requested resource as-is.
}

// ------------------------------------------------------------------------
// REQUEST HANDLER
// ------------------------------------------------------------------------
$query = [];
if (isset($_SERVER['REQUEST_URI']['query'])) {
  parse_str(parse_url($_SERVER['REQUEST_URI'])['query'], $query);
}

$path = $_SERVER['PATH_INFO'] ?? '';
$method = strtolower($_SERVER['REQUEST_METHOD'] ?? '');
$body = file_get_contents('php://input');

$contentType = $_SERVER['CONTENT_TYPE'] ?? 'text/html';
header('content-type: ' . $contentType);

// default http response code
http_response_code(404);
// ------------------------------------------------------------------------

// default http response body
$response = [
  'success' => false,
  'message' => 'No matched routes.',
  'data' => null
];


// ------------------------------------------------------------------------
// APPLICATION CODE
// ------------------------------------------------------------------------
$cart = new \Freddymu\UseCase\Cart();

if ($method === 'post' && !empty($body) && $path === '/cart') {

  $jsonPayload = json_decode($body);
  $productEntity = new \Freddymu\Entities\ProductEntity();

  objectMapper($jsonPayload, $productEntity);

  $response['success'] = true;
  $response['message'] = 'Add item to cart.';
  $response['data'] = $cart->addItem($productEntity);
}

if ($method === 'get' && $path === '/cart') {
  $response['success'] = true;
  $response['message'] = 'Get list of items.';
  $response['data'] = $cart->getItems();
}

if ($method === 'put' && !empty($body) && $path === '/cart') {

  $jsonPayload = json_decode($body);
  $productEntity = new \Freddymu\Entities\ProductEntity();

  objectMapper($jsonPayload, $productEntity);

  $result = $cart->updateItem($productEntity);

  $response['success'] = $result !== null;
  $response['message'] = 'Updating item on cart.';
  $response['data'] = $result;
}

if ($method === 'delete' && !empty($body) && $path === '/cart') {

  $jsonPayload = json_decode($body);
  $productEntity = new \Freddymu\Entities\ProductEntity();

  objectMapper($jsonPayload, $productEntity);

  $result = $cart->removeItem($productEntity);

  $response['success'] = $result !== null;
  $response['message'] = 'Removing item from cart.';
  $response['data'] = $result;
}

if ($method === 'get' && !empty($body) && $path === '/cart/calculate') {

  $productEntity = new \Freddymu\Entities\ProductEntity();

  $result = $cart->calculateItemsOnCart();

  $response['success'] = $result !== null;
  $response['message'] = 'Calculating cart amount.';
  $response['data'] = $result;
}

if ($response['success']) {
  http_response_code(200);
}
// ------------------------------------------------------------------------

// http response body
echo json_encode($response);

// ------------------------------------------------------------------------
// FUNCTION HELPER
// ------------------------------------------------------------------------
function objectMapper($source, $target)
{
  foreach ($target as $key => $val) {
    $target->$key = $source->$key ?? null;
  }
}
// ------------------------------------------------------------------------

