<?php

namespace App\Service;

use GuzzleHttp\Client;

class TelegramService
{
    public const API_KEY = '6379226128:AAFdsoNwol7uvuDN7SV9-BMIcc7x6NgqUt4';

    protected $url;
    protected $chatIds;

    public function __construct(array $chatIds)
    {
        $this->url = 'https://api.telegram.org/bot' . self::API_KEY . '/';
        $this->chatIds = $chatIds;
    }

    public function send(MessageInterface $message)
    {
        $api = new Client();
        $method = 'sendMessage';

        foreach ($this->chatIds as $chatId) {
            $params = [
                'chat_id'                  => $chatId,
                'text'                     => $message->getMessage(),
                'disable_web_page_preview' => null,
                'reply_to_message_id'      => null,
                'reply_markup'             => null,
            ];

            try {
                $api->post($this->url . $method, ['query' => $params]);
            } catch (\Throwable $exception) {
                continue;
            }
        }
    }
}