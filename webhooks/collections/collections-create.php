<?php

use WPS\DB\Collections_Custom;
use WPS\DB\Collections_Smart;
use WPS\Collections;
use WPS\Config;
use WPS\Webhooks;
use WPS\WS;

$jsonData = file_get_contents('php://input');

$collection = json_decode($jsonData);

/*

Here we have a couple things to check. First, we need to know what type of Collection
was updated; either Custom or Smart. We can do this by looking for a "Rules" property.
If that property exists the collection is Smart if not it is Custom.

*/
$DB_Collections_Custom = new Collections_Custom();
$DB_Collections_Smart = new Collections_Smart();
$Collections = new Collections(new Config());

if ($Collections->wps_is_smart_collection($collection) ) {
  $DB_Collections_Smart->insert_smart_collection($collection);

} else {
  error_log('---- webhook firing -----');
  $DB_Collections_Custom->insert_custom_collection($collection);

}


// if (Webhooks::webhook_verified($jsonData, WS::get_header_hmac())) {
//
//   $collection = json_decode($jsonData);
//
//   /*
//
//   Here we have a couple things to check. First, we need to know what type of Collection
//   was updated; either Custom or Smart. We can do this by looking for a "Rules" property.
//   If that property exists the collection is Smart if not it is Custom.
//
//   */
//   $DB_Collections_Custom = new Collections_Custom();
//   $DB_Collections_Smart = new Collections_Smart();
//   $Collections = new Collections(new Config());
//
//   if ($Collections->wps_is_smart_collection($collection) ) {
//     $DB_Collections_Smart->insert_smart_collection($collection);
//
//   } else {
//     $DB_Collections_Custom->insert_custom_collection($collection);
//
//   }
//
// } else {
//   error_log('WP Shopify Error - Unable to verify webhook response from collections-create.php');
// }
