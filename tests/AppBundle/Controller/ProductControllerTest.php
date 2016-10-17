<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductControllerTest extends WebTestCase
{
    public function testGetProducts()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/web/app_dev.php/api/products');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('product1', $crawler->html());
        $this->assertContains('product2', $crawler->html());
    }

    public function testGetProduct()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/web/app_dev.php/api/products/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('product1', $crawler->html());
    }
}