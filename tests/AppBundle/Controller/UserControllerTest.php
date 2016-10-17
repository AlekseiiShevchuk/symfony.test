<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testGetUsers()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/web/api/users');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('user1', $crawler->html());
        $this->assertContains('user2', $crawler->html());
    }

    public function testGetUser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/web/api/users/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('user1', $crawler->html());
    }
}