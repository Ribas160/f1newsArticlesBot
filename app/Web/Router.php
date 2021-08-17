<?php 

namespace App\Web;

use Phroute\Phroute\RouteCollector;
use App\Controllers\AppController;
use App\Core\App;

class Router {


    /**
     * @return void
     */
    public static function routing(): void
    {
        $router = new RouteCollector();
        $appController = new AppController();
        $config = App::getConfig();

        $router->get($config['main']['homeDir'], $appController->publicArticle());
    }

}