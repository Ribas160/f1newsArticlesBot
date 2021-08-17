<?php 

namespace Tests\Unit\Models;

use PHPUnit\Framework\TestCase;
use App\Models\F1News;

class F1NewsTest extends TestCase
{

    public function testGetLink()
    {
        $f1News = new F1News();
        $link = $f1News->getLink();
        $this->assertIsString($link);
    }
}