<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Invoice
 *
 * @property int $id
 * @property string $ref
 * @property int $currency_id
 * @property string $to_email
 * @property string|null $cc_emails
 * @property int|null $customer_id
 * @property string|null $notes
 * @property string $due_date
 * @property string|null $paid_at
 * @property string|null $issued_at
 * @property string $created_at
 * @property string|null $deleted_at
 * @property string $acc_name
 * @property string $bank
 * @property string $acc_num
 * @property float $discount
 * @property float $shipping_fee
 * @property float $tax
 * @property int $user_id
 *
 * @package App\Models\Base
 */
class Invoice extends Model
{
	use SoftDeletes;
	protected $table = 'invoices';
	public $timestamps = false;

	protected $casts = [
		'currency_id' => 'int',
		'customer_id' => 'int',
        'user_id' => 'int'
	];
}
