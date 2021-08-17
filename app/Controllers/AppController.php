<?php 

namespace App\Controllers;

use App\Models\F1news;
use App\Models\Chat;
use App\Core\App;


class AppController
{


    /**
     * @return void
     */
    public function publicArticle(): void
    {
        $f1News = new F1news();
        $link = $f1News->getLink();
        App::log($link);

        if (empty($link)) exit;
        else Chat::sendMessageToAllChats($link);
    }
}