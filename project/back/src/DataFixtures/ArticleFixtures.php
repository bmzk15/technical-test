<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Source;
use App\Enum\SourceTypeEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class ArticleFixtures
 *
 * @package App\DataFixtures
 * @author Boris MALEZYK <freelance@borismalezyk.com>
 */
class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $articles = [
            ["title" => 'LOGODEN BINIOU', "content" => 'Logoden biniou degemer mat an penn ar, bed froud yaou koant kenderv hanternoz holen, poazh Melwenn kavout serret seul evitañ, a greiz bank a c’hwezhañ. Fourchetez diaoul ifern karout ni diskenn an wech Doue, nadoz taol c’hontrol c’henderv dastum koumanant c’hof eno lann, jiletenn diouzh buoc’h pounner itron gouiziek o. Ganto skalier c’hoarvezout gwinizh nec’hin Sarzhav ivin reizh gouez, galv prest koar arnev pomper ha kelien tann egisti', "author" => 'Boris MALEZYK', "sourceRef" => 'local_1'],
            ["title" => 'LOGODEN BINIOU', "content" => 'Logoden biniou degemer mat an penn ar, bed froud yaou koant kenderv hanternoz holen, poazh Melwenn kavout serret seul evitañ, a greiz bank a c’hwezhañ. Fourchetez diaoul ifern karout ni diskenn an wech Doue, nadoz taol c’hontrol c’henderv dastum koumanant c’hof eno lann, jiletenn diouzh buoc’h pounner itron gouiziek o. Ganto skalier c’hoarvezout gwinizh nec’hin Sarzhav ivin reizh gouez, galv prest koar arnev pomper ha kelien tann egisti', "author" => 'Boris MALEZYK', "sourceRef" => 'local_1'],
            ["title" => 'Lorem Ipsum', "content" => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', "author" => 'Bory MZK', "sourceRef" => 'local_2'],
            ["title" => 'Lorem Ipsum', "content" => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', "author" => 'Bory MZK', "sourceRef" => 'local_2'],
        ];

        foreach ($articles as $article) {
            ['title' => $title, 'content' => $content, 'author' => $author, 'sourceRef' => $sourceRef] = $article;
            $newArticle = new Article($this->getReference($sourceRef), $title, $author, $content);
            $manager->persist($newArticle);
        }

        $manager->flush();
    }

    /**
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [
            SourceFixtures::class,
        ];
    }
}
