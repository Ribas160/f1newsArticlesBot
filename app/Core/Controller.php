<?php 

namespace App\Core;

use App\Core\Bot;

class Controller {


    /**
     * Controller constructor
     */
    public function __construct()
    {
        $bot = new Bot();
        $telegram = $bot->getTelegram();
        $info = $telegram->getWebhookUpdates();
        if (isset($info['message'])) {
            $bot->saveUser($info);
            $bot->saveChat($info);
        }
    }
}