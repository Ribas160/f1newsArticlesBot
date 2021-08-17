<?php 
namespace App\Core;

use App\Web\Router;

class App 
{

    /**
     * @return void
     */
    public function run(): void
    {
        set_exception_handler([$this, 'exceptionHandler']);
        set_error_handler([$this, 'errorHandler']);
        
        Router::routing();
    }


    /**
     * @return array
     */
    public static function getConfig(): array
    {
        return [
            'main' => require __DIR__ . '/../../config/main.php',
            'databases' => require __DIR__ . '/../../config/databases.php',
        ];
    }


        /**
     * @param string $message
     * @param mixed $data
     * @param string $path
     * @return bool
     */
    public static function log(string $message, $data = NULL, string $path = 'app'): bool
    {
        date_default_timezone_set('Europe/Moscow');

        $logPath = dirname(__FILE__, 3) . '/logs/' . $path;
        if (!file_exists($logPath)) mkdir($logPath, 0755, true);
        $filename = dirname(__FILE__, 3) . '/logs/' . $path . '/' . date('Y-m-d') . '.log';

        file_put_contents($filename, date('Y-m-d H:i:s ') . $message . PHP_EOL, FILE_APPEND);
        if (!empty($data)) file_put_contents($filename, print_r($data, true) . PHP_EOL, FILE_APPEND);

        return true;
    }



    /**
     * @param object $e
     * @return void
     */
    public static function exceptionHandler($e): void
    {
        self::log($e->getMessage());
    }


    /**
     * @param object $e
     * @return void
     */
    public static function errorHandler($errno, $errmsg, $filename, $linenum): void
    {
        self::log("$errmsg = $filename = $linenum\r\n");
    }

}