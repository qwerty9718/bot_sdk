<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;

class BotController extends Controller
{
    protected $telegram;
    private $chat;
    private $message;
    private $callback_data;


    public function __construct(Api $telegram)
    {
        $this->telegram = $telegram;

    }


    public function setWebhook(Request $request)
    {

        $webHookUrl = env('TELEGRAM_WEBHOOK_URL');
        $token = env('TELEGRAM_BOT_TOKEN');
        $api_path = '/';
        $url = $webHookUrl . $api_path . $token . '/webhook';

        $response = Telegram::setWebhook(['url' => $url]);
        $update = Telegram::commandsHandler(true);

        return $response;
    }

    public function getMe(Request $request)
    {
        $response = $this->telegram->getMe();
        return $response;
    }



    public function webHookHandler()
    {

        Telegram::commandsHandler(true);
        $update = $this->telegram->getWebhookUpdate();

        $this->message = $update->getMessage();
        $this->chat = $this->message->chat;

        Log::info($update);

//        if ($update->getCallbackQuery()) {
//            $callbackData = $update->getCallbackQuery()->getData();
//
//            // Check Inline buttons Callback
//            CommandActions::CallFunctionsFromCallBackData($callbackData,$this->telegram);
//
//        }
//
//
//        // Check KeyBoard Message
//        SimpleKeyboardActions::checkMessageFromKeyboard($this->message,$this->chat,$this->telegram);
    }
}
