<?php
require __DIR__ . '/../src/Entity/Message.php';

use App\Entity\Message as Message;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    private $message = null;

    //fixtures
    public function setUp()
    {
        $this->message = new Message();
    }

    public function tearDown()
    {
        $this->message = null;
    }

    //set
    public function testsetValue()
    {
        $name = 'Test name 2';
        $content = 'Test msg';
        $time = '2019-09-09 03:03:03';

        $this->assertEquals('Test name 2', $this->message->setName($name)->getName());
        $this->assertEquals('Test msg', $this->message->setContent($content)->getContent());
        $this->assertEquals('2019-09-09 03:03:03', $this->message->setUpdateTime($time)->getUpdateTime());
    }

    //get
    public function testgetValue()
    {
        $id = 1;
        $name = 'Test name';
        $content = 'Test message';
        $time = '2019-09-09 09:09:09';

        $this->message->putData($id, $name, $content, $time);

        $this->assertEquals(1, $this->message->getId());
        $this->assertEquals('Test name', $this->message->getName());
        $this->assertEquals('Test message', $this->message->getContent());
        $this->assertEquals('2019-09-09 09:09:09', $this->message->getUpdateTime());
    }
}
