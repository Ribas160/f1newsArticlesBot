<?php 

require_once __DIR__ . '/../vendor/autoload.php';


/**
 * @param string $link
 * @return void
 */
function sendLink(string $link): void
{
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();

    $telegram = new Telegram\Bot\Api($_ENV['BOT_TOKEN']);
    $telegram->sendMessage([
        'chat_id' => $_ENV['CHANNEL_ID'],
        'text' => $link,
    ]);
}


/**
 * @return string
 */
function F1news(): string
{
    $pageUrl = 'https://www.f1news.ru/export/news.xml';
    $jsonFile = __DIR__  . '/../storage.json';

    $content = file_get_contents($pageUrl);
    preg_match('/<item>.*?<link>(?<link>.*?)<\/link>/s', $content, $matches);

    if (!file_exists($jsonFile)) return newLink($jsonFile, $matches['link']);
    
    $json = json_decode(file_get_contents($jsonFile), true);
    if (isset($json['link']) && $json['link'] !== $matches['link']) return newLink($jsonFile, $matches['link']);
    else return '';
}


/**
 * @param string $jsonFile
 * @param string $link
 * @return string
 */
function newLink(string $jsonFile, string $link): string
{
    file_put_contents($jsonFile, json_encode(['link' => $link]));
    return $link;
}



function run(): void
{
    $link = F1news();
    if ($link) sendLink($link);
}


run();