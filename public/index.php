<?php 

require_once __DIR__ . '/../vendor/autoload.php';


/**
 * @param array $article
 * @return void
 */
function sendLink(array $article): void
{
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();

    $telegram = new Telegram\Bot\Api($_ENV['BOT_TOKEN']);
    $telegram->sendMessage([
        'chat_id' => $_ENV['CHANNEL_ID'],
        'text' => $article['pubDate'] . "\n" . $article['link'],
    ]);
}


/**
 * @return array
 */
function F1news(): array
{
    $pageUrl = 'https://www.f1news.ru/export/news.xml';
    $jsonFile = __DIR__  . '/../storage.json';
    $article = [];

    $content = file_get_contents($pageUrl);
    preg_match('/<item>.*?<link>(?<link>.*?)<\/link>.*?<pubDate>(?<pubDate>.*?)\s\+0300/s', $content, $matches);
    $article['link'] = (!empty($matches['link'])) ? $matches['link'] : NULL;
    $article['pubDate'] = (!empty($matches['pubDate'])) ? $matches['pubDate'] : NULL;

    if (!$article['link']) return [];

    if (!file_exists($jsonFile)) return newLink($jsonFile, $article);
    
    $json = json_decode(file_get_contents($jsonFile), true);

    if ($matches['link'] !== NULL && $json['link'] !== $matches['link']) return newLink($jsonFile, $article);
    else return [];
}


/**
 * @param string $jsonFile
 * @param array $article
 * @return string
 */
function newLink(string $jsonFile, array $article): array
{
    file_put_contents($jsonFile, json_encode($article));
    return $article;
}



function run(): void
{
    $article = F1news();
    if ($article) sendLink($article);
}


run();