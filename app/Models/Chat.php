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
        $db = new Db();
        $chats = $db->request('SELECT chatId FROM chats');
        App::log(print_r($chats, true));

        foreach ($chats as $chat) {
            App::log($chat['chatId']);
            $bot = new Bot();
            $telegram = $bot->getTelegram();
            $telegram->sendMessage([
                'chat_id' => $chat['chatId'],
                'text' => $message,
            ]);
        }
    }
}