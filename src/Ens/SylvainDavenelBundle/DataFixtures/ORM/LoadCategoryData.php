<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 20/05/16
 * Time: 09:45
 */

namespace Ens\SylvainDavenelBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ens\SylvainDavenelBundle\Entity\Category;

/**
 * Class LoadCategoryData
 * 
 * @package Ens\SylvainDavenelBundle\DataFixtures\ORM
 */
class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $design = new Category();
        $design->setName('Design');

        $programming = new Category();
        $programming->setName('Programming');

        $manager = new Category();
        $manager->setName('Manager');

        $administrator = new Category();
        $administrator->setName('Administrator');

        $em->persist($design);
        $em->persist($programming);
        $em->persist($manager);
        $em->persist($administrator);

        $em->flush();

        $this->addReference('category-design', $design);
        $this->addReference('category-programming', $programming);
        $this->addReference('category-manager', $manager);
        $this->addReference('category-administrator', $administrator);
    }

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}