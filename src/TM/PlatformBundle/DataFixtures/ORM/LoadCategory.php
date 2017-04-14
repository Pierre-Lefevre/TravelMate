<?php
namespace OC\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use TM\PlatformBundle\Entity\Category;

/**
 * Class LoadCategory
 * @package OC\PlatformBundle\DataFixtures\ORM
 */
class LoadCategory implements FixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $names = array(
            'Roadtrip',
            'Pélerinage',
            'Tourisme',
            'Humanitaire',
            'Trek'
        );

        foreach ($names as $name) {
            $category = new Category();
            $category->setName($name);
            $manager->persist($category);
        }

        $manager->flush();
    }
}