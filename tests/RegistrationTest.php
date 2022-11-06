<?php

namespace App\Tests;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationTest extends WebTestCase
{
    private $client;
    private $userRepo;

    public function setUp(): void
    {
        $this->client = static::createClient();
        $this->userRepo = self::getContainer()->get(UserRepository::class);
    }

    public function testPageLoading(): void
    {
        $this->client->request('GET', '/register');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Register');
    }

    public function testInvalidRegistrations(): void
    {
        $this->client->request('GET', '/register');

        $countUsers = $this->userRepo->count([]);

        $this->client->submitForm(
            'Register',
            [
                'registration_form[pseudo]' => 'abc',
                'registration_form[email]' => 'test@test.com',
                'registration_form[password][first]' => 'azertyuiop',
                'registration_form[password][second]' => 'azertyuiop',
            ]
        );

        // No user should have been created
        $this->assertEquals($countUsers, $this->userRepo->count([]));
    }

    public function testValidRegistration(): void
    {
        $this->client->request('GET', '/register');

        $countUsers = $this->userRepo->count([]);

        $this->client->submitForm('Register', [
            'registration_form[pseudo]' => 'Pseud00',
            'registration_form[email]' => 'test@test.com',
            'registration_form[password][first]' => 'azertyuiop123',
            'registration_form[password][second]' => 'azertyuiop123',
        ]);

        // An user should have been created
        $this->assertEquals($countUsers, $countUsers + 1);
    }
}
