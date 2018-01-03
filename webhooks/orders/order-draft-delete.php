<?php

use WPS\Webhooks;
use WPS\WS;

$jsonData = file_get_contents('php://input');

if (Webhooks::webhook_verified($jsonData, WS::get_header_hmac())) {

  error_log('---- Webhook verified order-draft-delete -----');
  $order = json_decode($jsonData);

} else {
  error_log('WP Shopify Error - Unable to verify webhook response from order-draft-delete.php');
}
