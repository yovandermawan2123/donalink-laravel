<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;
use App\User;

class CreateSnapTokenService extends Midtrans
{
	protected $order;

	public function __construct($order)
	{
		parent::__construct();

		$this->order = $order;
	}

	public function getSnapToken()
	{
		// dd($this->order);
		
		// $user = User::where('email', $this->order->email)->first();
		$params = [
			/**
			 * 'order_id' => id order unik yang akan digunakan sebagai "primary key" oleh Midtrans untuk
			 * 				 membedakan order satu dengan order lain. Key ini harus unik (tidak boleh ada duplikat).
			 * 'gross_amount' => merupakan total harga yang harus dibayar customer.
			 */
			'transaction_details' => [
				'order_id' => $this->order->invoice_number,
				'gross_amount' => $this->order->amount,
			],
			/**
			 * 'item_details' bisa diisi dengan detail item dalam order.
			 * Umumnya, data ini diambil dari tabel `order_items`.
			 */
			'item_details' => [
				[
					'id' => 1, // primary key produk
					'price' => $this->order->amount, // harga satuan produk
					'quantity' => 1, // kuantitas pembelian
					'name' => $this->order->invoice_number.' - '.$this->order->user->name, // nama produk
				],
			],
			'customer_details' => [
				// Key `customer_details` dapat diisi dengan data customer yang melakukan order.
				// 'first_name' => $user->name,
				'email' => $this->order->user->email,
				// 'phone' => '62'.$user->whatsapp,
			]
		];

		$snapToken = Snap::getSnapToken($params);

		return $snapToken;
	}
}