<?php

namespace App\Tests;

use App\Entity\Band;
use PHPUnit\Framework\TestCase;

class BandUnitTest extends TestCase
{
    public function testSettersTrue(): void
    {
        $values = [
            'formedIn' => 2010,
            'logoPath' => '/bands/logos/theBand.png',
            'name' => 'The Band',
            'slug' => 'the-band',
            'splitUpIn' => 2015,
        ];
        $band = new Band();
        $band->setFormedIn($values['formedIn'])
            ->setLogoPath($values['logoPath'])
            ->setName($values['name'])
            ->setSlug($values['slug'])
            ->setSplitUpIn($values['splitUpIn']);

        $this->assertTrue($band->getFormedIn() === $values['formedIn']);
        $this->assertTrue($band->getLogoPath() === $values['logoPath']);
        $this->assertTrue($band->getName() === $values['name']);
        $this->assertTrue($band->getSlug() === $values['slug']);
        $this->assertTrue($band->getSplitUpIn() === $values['splitUpIn']);
    }

    public function testSettersFalse(): void
    {
        $values = [
            'formedIn' => 2010,
            'logoPath' => '/bands/logos/theBand.png',
            'name' => 'The Band',
            'slug' => 'the-band',
            'splitUpIn' => 2015,
        ];
        $band = new Band();
        $band->setFormedIn($values['formedIn'])
            ->setLogoPath($values['logoPath'])
            ->setName($values['name'])
            ->setSlug($values['slug'])
            ->setSplitUpIn($values['splitUpIn']);

        $this->assertFalse(1850 === $band->getFormedIn());
        $this->assertFalse('invalid value' === $band->getLogoPath());
        $this->assertFalse('invalid value' === $band->getName());
        $this->assertFalse('invalid value' === $band->getSlug());
        $this->assertFalse(1952 === $band->getSplitUpIn());
    }

    public function testIsEmpty(): void
    {
        $band = new Band();

        $this->assertEmpty($band->getFormedIn());
        $this->assertEmpty($band->getLogoPath());
        $this->assertEmpty($band->getName());
        $this->assertEmpty($band->getSlug());
        $this->assertEmpty($band->getSplitUpIn());
    }
}
