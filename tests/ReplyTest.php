<?php

use App\Entity\Reply as Reply;
use PHPUnit\Framework\TestCase;

class ReplyTest extends TestCase
{
    public function testgetValue()
    {
        $id = 1;
        $message = 1;
        $this->reply = new Reply();
        $this->reply->putData($id, $message);

        $this->assertEquals(1, $this->reply->getId());
        $this->assertEquals(1, $this->reply->getMessage());
    }
}