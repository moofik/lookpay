<?php

namespace App\Service;

use App\Models\AnonymousPayment;

class AnonymousPaymentMessage implements MessageInterface
{
    public function __construct(protected AnonymousPayment $payment)
    {
    }

    public function getMessage(): string
    {
        $paymentMessage = "E-mail: " . ($this->payment->email) . "\n";
        $paymentMessage .= "внутресистемный ID платежа: " .  $this->payment->id . "\n";
        $paymentMessage .= "UUID платежа: " .  $this->payment->payment_uuid . "\n";
        $paymentMessage .= "Способ оплаты: " . $this->payment->payment_method . "\n";
        $paymentMessage .= "Валюта: " . $this->payment->currency . "\n";
        $paymentMessage .= "TRC20 адрес: " . $this->payment->trc20 . "\n";
        $amt = $this->payment->payment_amount;
        if ($this->payment->payment_amount < 1) {
            $amt = rtrim(number_format($amt, 10), '0');
        }
        $converter = new MoneyConverter();
        $rubAmt = round($converter->convert($amt));
        $paymentMessage .= "Количество в USDT: " . $amt . "\n";
        $paymentMessage .= 'Количество в РУБ: ' . $rubAmt . "\n";
        //$link = "storage/uploads/" . $this->payment->attachment;
        //$paymentMessage .= "Ссылка на подтверждение оплаты: " . \URL::to($link) . "\n";

        return $paymentMessage;
    }
}