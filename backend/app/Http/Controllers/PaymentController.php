<?php

namespace App\Http\Controllers;

use App\Dto\RegistrationDto;
use App\Http\Requests\AnonymousPayRequest;
use App\Http\Requests\PayAndRegisterRequest;
use App\Http\Requests\PayRequest;
use App\Models\AnonymousPayment;
use App\Models\Payment;
use App\Models\User;
use App\Service\AnonymousPaymentMessage;
use App\Service\MoneyConverter;
use App\Service\PaymentMessage;
use App\Service\TelegramService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class PaymentController extends Controller
{
    use Registration;

    public function list(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        return $user->payments;
    }

    public function payAndRegister(PayAndRegisterRequest $request)
    {
        return DB::transaction(function () use ($request) {
            try {
                $registrationDto = $this->registerUser($request, random_int(100, 1000000));
                $payment = $registrationDto->user->payments()->create($this->getData($request));
                /** @var RegistrationDto $registrationDto */
                $transactionDto = ['dto' => $registrationDto, 'payment' => $payment];
            } catch (\Throwable $exception) {
                abort(422, $exception->getMessage());
            }

            $registrationDto = $transactionDto['dto'];
            /** @var Payment $payment */
            $payment = $transactionDto['payment'];
            //$paymentMessage = new PaymentMessage($registrationDto->user, $payment);
            //$tgService = new TelegramService([131231613, 463609933, 6138432791, 1730393847, 985617299]);
            //$tgService->send($paymentMessage);

            return response()->json([
                'access_token'   => $registrationDto->token->plainTextToken,
                'token_type'     => 'Bearer',
                'payment_status' => 'success',
                'payment_id' => $payment->id,
            ]);
        });
    }

    public function pay(PayRequest $request)
    {
        return DB::transaction(function () use ($request) {
            try {
                /** @var RegistrationDto $registrationDto */
                /** @var Payment $payment */
                $payment = auth()->user()->payments()->create($this->getData($request));
            } catch (\Throwable $exception) {
                abort(422, $exception->getMessage());
            }

           // $paymentMessage = new PaymentMessage($payment->user, $payment);
           // $tgService = new TelegramService([131231613, 463609933, 6138432791, 1730393847, 985617299]);
            //$tgService->send($paymentMessage);

            return response()->json([
                'payment_status' => 'success',
                'payment_id' => $payment->id,
            ]);
        });
    }

    public function payWithoutRegistration(AnonymousPayRequest $request)
    {
        return DB::transaction(function () use ($request) {
            try {
                $payment = AnonymousPayment::create($this->getData($request));
            } catch (\Throwable $exception) {
                abort(422, $exception->getMessage());
            }

            //$paymentMessage = new AnonymousPaymentMessage($payment);
            //$tgService = new TelegramService([131231613, 463609933, 6138432791, 1730393847, 985617299]);
            //$tgService->send($paymentMessage);

            return response()->json([
                'payment_status' => 'success',
                'payment_id' => $payment->id,
            ]);
        });
    }

    /**
     * @param  Request  $request
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @return array
     */
    private function getData(Request $request): array
    {
        $data = $request->safe()->only([
            'currency_from',
            'currency_to',
            'payment_amount',
         //   'payment_method',
         //   'email',
        ]);

        $data['payment_uuid'] = Uuid::uuid4()->toString();

        if ($request->file()) {
            $fileName = time() . '_' . $request->file('file')?->getClientOriginalName();
            $filePath = $request->file('file')?->storeAs('uploads', $fileName, 'public');
            $data['attachment'] = $fileName;
        }

        return $data;
    }
}
