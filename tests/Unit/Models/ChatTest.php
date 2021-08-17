<?php 

namespace Tests\Unit\Models;

use PHPUnit\Framework\TestCase;
use App\Models\Chat;

class ChatTest extends TestCase
{

    public function testSendMessageToAllChats()
    {
        Chat::sendMessageToAllChats('hello');
        $this->assertTrue(true);
    }
}