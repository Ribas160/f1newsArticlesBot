<?php 

namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Controllers\AppController;

class PublicArticle extends Command
{


    /**
     * @var string
     */
    protected static $defaultName = 'app:publicArticle';


    /**
     * @return void
     */
    protected function configure(): void
    {
        $this
            ->setDescription('Public new article')
            ->setHelp('This command sends new article to telegram chats if it has been publiched on F1news.ru');
    }


    /**
     * @param object $input
     * @param object $output
     * @return integer
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $appController = new AppController();
        $appController->publicArticle();

        return Command::SUCCESS;
    }

}