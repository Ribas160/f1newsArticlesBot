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
     * @return object
     */
    public function getTelegram()
    {
        return $this->telegram;
    }
}