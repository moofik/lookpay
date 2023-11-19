<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Payment
 *
 * @property int $id
 * @property int $user_id
 * @property string $donation_type donation type
 * @property string $currency payment currency
 * @property string $payment_amount payment amount
 * @property string $payment_method recipient issuer bank
 * @property string|null $tokens_amount recipient issuer bank
 * @property string|null $recipient_address recipient bank address
 * @property string|null $attachment payment confirmation attachment
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property mixed $password
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereDonationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereRecipientAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereTokensAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUserId($value)
 * @property string|null $trc20 trc20 wallet
 * @property string|null $email trc20 wallet
 * @property string $payment_uuid uuid
 * @method static \Illuminate\Database\Eloquent\Builder|AnonymousPayment whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnonymousPayment wherePaymentUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnonymousPayment whereTrc20($value)
 * @mixin \Eloquent
 */
class AnonymousPayment extends Model
{
    use HasFactory;

    protected $table = 'anonymous_payments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'currency',
        'payment_amount',
        'payment_method',
        'tokens_amount',
        'recipient_address',
        'attachment',
        'payment_uuid',
        'email',
        'trc20',
        'payment_uuid',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];
}
