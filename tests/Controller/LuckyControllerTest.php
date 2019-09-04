<?php

namespace App\tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LuckyControllerTest extends WebTestCase
{
    public function testShowMsg()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/panel');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testSetMsg()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/panel');
        $form = $crawler->selectButton('send')->form();

        //set values
        $form['form[name]'] = 'Lucas';
        $form['form[content]'] = 'Hey there!';

        //submit the form
        $crawler = $client->submit($form);

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->isRedirect('/panel'));
    }

    public function testReplyMsg()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/panel/reply/3');
        $form = $crawler->selectButton('send')->form();

        //set values
        $form['form[name]'] = 'Lucas';
        $form['form[content]'] = 'Hey there!';

        //submit the form
        $crawler = $client->submit($form);

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->isRedirect('/panel'));
    }

    public function testDelMsg()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', "/panel/del/3");

        $this->assertTrue($client->getResponse()->isRedirect('/panel'));
    }

    public function testUpdateMsg()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/panel/put/1');
        $form = $crawler->selectButton('update')->form();

        //set values
        $form['form[name]'] = 'Lucas';
        $form['form[content]'] = 'Hey there!';

        //submit the form
        $crawler = $client->submit($form);

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->isRedirect('/panel'));
    }
}
