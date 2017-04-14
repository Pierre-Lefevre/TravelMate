<?php
namespace TM\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use TM\UserBundle\Entity\User;

/**
 * Class LoadUser
 * @package TM\UserBundle\DataFixtures\ORM
 */
class LoadUser implements FixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $listNames = array('Alexandre', 'Marine', 'Anna');

        foreach ($listNames as $name) {
            $user = new User;
            $user->setUsername($name);
            $user->setPassword($name);
            $user->setSalt('');
            $user->setRoles(array('ROLE_USER'));
            $manager->persist($user);
        }

        $manager->flush();
    }
}