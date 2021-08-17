<?php 

namespace App\Models;

use App\Core\Db;

class F1news {


    /**
     * @var string
     */
    const FILE_URL = 'https://www.f1news.ru/export/news.xml';



    /**
     * @return string
     */
    public function getLink(): string
    {
        $link = '';
        $content = file_get_contents(self::FILE_URL);
        preg_match('/<item>.*?<link>(?<link>.*?)<\/link>/s', $content, $matches);

        $lastLink = self::getLastLink();

        if ($matches['link'] !== $lastLink) {
            $db = new Db();
            if ($lastLink === '') $db->request('INSERT INTO lastLink (link) VALUES (:link)', ['link' => $matches['link']]);
            else $db->request('UPDATE lastLink SET link = :link WHERE id = :id', ['link' => $matches['link'], 'id' => 1]);
            $link = $matches['link'];
        }

        return $link;
    }



    /**
     * @return string
     */
    private static function getLastLink(): string
    {
        $db = new Db();
        $array = $db->request("SELECT link FROM lastLink");
        return ($array) ? $array[0]['link'] : '';
    }
}