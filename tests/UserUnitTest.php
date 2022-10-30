<?php

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserUnitTest extends TestCase
{
    public function testSettersTrue(): void
    {
        $values = [
            'aboutMe' => 'I\' a test user.',
            'email' => 'mail@mail.com',
            'name' => 'John',
            'password' => '123456dqsidjaiujdsqds78978',
            'surname' => 'Doe',
            'telephone' => '+33601234567',
        ];
        $user = new User();
        $user->setAboutMe($values['aboutMe'])
            ->setEmail($values['email'])
            ->setName($values['name'])
            ->setSurname($values['surname'])
            ->setPassword($values['password'])
            ->setTelephone($values['telephone']);

        $this->assertTrue($user->getAboutMe() === $values['aboutMe']);
        $this->assertTrue($user->getEmail() === $values['email']);
        $this->assertTrue($user->getName() === $values['name']);
        $this->assertTrue($user->getSurname() === $values['surname']);
        $this->assertTrue($user->getPassword() === $values['password']);
        $this->assertTrue($user->getTelephone() === $values['telephone']);
    }

    public function testSettersFalse(): void
    {
        $values = [
            'aboutMe' => 'I\' a test user.',
            'email' => 'mail@mail.com',
            'name' => 'John',
            'password' => '123456dqsidjaiujdsqds78978',
            'surname' => 'Doe',
            'telephone' => '+33601234567',
        ];
        $user = new User();
        $user->setAboutMe($values['aboutMe'])
            ->setEmail($values['email'])
            ->setName($values['name'])
            ->setSurname($values['surname'])
            ->setPassword($values['password'])
            ->setTelephone($values['telephone']);

        $this->assertFalse('invalid value' === $user->getAboutMe());
        $this->assertFalse('invalid value' === $user->getEmail());
        $this->assertFalse('invalid value' === $user->getName());
        $this->assertFalse('invalid value' === $user->getSurname());
        $this->assertFalse('invalid value' === $user->getPassword());
        $this->assertFalse('invalid value' === $user->getTelephone());
    }

    public function testIsEmpty(): void
    {
        $user = new User();

        $this->assertEmpty($user->getAboutMe());
        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getName());
        $this->assertEmpty($user->getSurname());
        $this->assertNull($user->getPassword());
        $this->assertEmpty($user->getTelephone());
    }
}
