<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Source;
use App\Enum\SourceTypeEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class SourceFixtures
 *
 * @package App\DataFixtures
 * @author Boris MALEZYK <freelance@borismalezyk.com>
 */
class SourceFixtures extends Fixture
{
    public const SOURCE_REFERENCES = [
        'local_1',
        'local_2',
        'le_monde',
    ];

    public function load(ObjectManager $manager): void
    {
        $sources = [
            ["name" => 'Local 1', "type" => SourceTypeEnum::LOCAL_DATA_BASE],
            ["name" => 'Local 2', "type" => SourceTypeEnum::LOCAL_DATA_BASE],
            ["name" => 'Le Monde', "type" => SourceTypeEnum::RSS],
        ];

        foreach ($sources as $index => $source) {
            ['name' => $name, 'type' => $type] = $source;
            $newSource = new Source($name, $type);
            $manager->persist($newSource);
            $this->addReference(self::SOURCE_REFERENCES[$index], $newSource);
        }

        $manager->flush();
    }
}
