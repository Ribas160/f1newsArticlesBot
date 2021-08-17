<?php 

namespace App\Models;

use App\Core\Db;
use App\Core\Bot;
use App\Core\App;

class Chat
{

    /**
     * @param string $message
     * @return void
     */
    public static function sendMessageToAllChats(string $message): void
    {
        $bot = new Bot();
        $telegram = $bot->getTelegram();

        $config = App::getConfig();

        $telegram->sendMessage([
                'chat_id' => $config['main']['telegramChannelId'],
                'text' => $message,
            ]);
    }
}