<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DeliveryControllerTest extends WebTestCase
{
    public function testShowdeliveries()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/showDeliveries');
    }

}
