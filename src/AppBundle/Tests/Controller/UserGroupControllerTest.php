<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserGroupControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
    }

    public function testNew()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/new');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/{id}/edit');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/{id}/delete');
    }

}
