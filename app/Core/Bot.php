<?php 

namespace App\Core;

use Telegram\Bot\Api;

class Bot 
{
    
    public $telegram;


    /**
     * Telegram constructor
     */
    public function __construct()
    {
        $config = App::getConfig();
        $this->telegram = new Api($config['main']['botToken']);
    }


    /**
     * @return void
     */
    public function saveUser(object $info): void
    {
        $db = new Db();
        $user = $info['message']['from'];

        $exists = $db->request('SELECT * FROM users WHERE userId = :userId', ['userId' => $user['id']]);
        if (empty($exists)) {
            $db->request("INSERT INTO users (userId, is_bot, firstName, lastName, username, language_code) VALUES (:userId, :is_bot, :firstName, :lastName, :username, :language_code)", [
                'userId' => $user['id'],
                'is_bot' => ($user['is_bot']) ? $user['is_bot'] : 0,
                'firstName' => $user['first_name'],
                'lastName' => (isset($user['last_name'])) ? $user['last_name'] : NULL,
                'username' => (isset($user['username'])) ? $user['username'] : NULL,
                'language_code' => (isset($user['language_code'])) ? $user['language_code'] : NULL,
            ]);
        }
    }


    /**
     * @return void
     */
    public function saveChat(object $info): void
    {
        $db = new Db();
        $chat = $info['message']['chat'];

        $exists = $db->request('SELECT * FROM chats WHERE chatId = :chatId', ['chatId' => $chat['id']]);
        if (empty($exists)) {
            $db->request('INSERT INTO chats (chatId, type, title, username) VALUES (:chatId, :type, :title, :username)', [
                'chatId' => $chat['id'],
                'type' => $chat['type'],
                'title' => (isset($chat['title'])) ? $chat['title'] : 'NULL',
                'username' => (isset($chat['username'])) ? $chat['username'] : 'NULL',
            ]);
        }
    }


    /**
     * @return object
     */
    public function getTelegram()
    {
        return $this->telegram;
    }
}