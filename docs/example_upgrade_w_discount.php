<?php

header('Content-Type: text/plain');

require '../ChargeOverAPI.php';
require 'config.php';

$API = new ChargeOverAPI($url, $authmode, $username, $password);

// The discount ID # goes here
$discount_item_id = 2;

// This is the subscription # that we want to add the recurring discount to
$subscription_id = 620;

$data = array(
	'line_items' => array(
		0 => array(

			'item_id' => $discount_item_id,
			'descrip' => 'Discount',

			// If you DON'T specify "tierset", then the default amount for the
			// 	discount in ChargeOver will be used.
			//
			// 	If you want to customize/specify the pricing for this particular
			// 	subscription, you can do that like this:
			'tierset' => array(
				'pricemodel' => 'fla',
				'percent' => 50,
				),
			),
		),
	);

$resp = $API->action('package', $subscription_id, 'upgrade', $data);

if (!$API->isError($resp))
{
	print('SUCCESS!');
}
else
{
	print('Error message was: ' . $resp->code . ': ' . $resp->message . "\n");

	print("\n\n\n\n");
	print($API->lastRequest());
	print("\n\n\n\n");
	print($API->lastResponse());
	print("\n\n\n\n");
}

