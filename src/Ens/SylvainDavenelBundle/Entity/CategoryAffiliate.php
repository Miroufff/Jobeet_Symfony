<?php
/**
 * Created by PhpStorm.
 * User: mirouf
 * Date: 19/05/16
 * Time: 16:32
 */

namespace Ens\SylvainDavenelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class CategoryAffiliate
 *
 * @ORM\Entity
 * @ORM\Table(name="tr_category_affiliate")
 * @package Ens\SylvainDavenelBundle\Entity
 */
class CategoryAffiliate
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var mixed
     *
     * @ORM\ManyToOne(targetEntity="Ens\SylvainDavenelBundle\Entity\Category", inversedBy="category_affiliates")
     * @ORM\JoinColumn(name="id_category", referencedColumnName="id")
     */
    private $category;

    /**
     * @var mixed
     *
     * @ORM\ManyToOne(targetEntity="Ens\SylvainDavenelBundle\Entity\Affiliate", inversedBy="category_affiliates")
     * @ORM\JoinColumn(name="id_affiliate", referencedColumnName="id")
     */
    private $affiliate;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getAffiliate()
    {
        return $this->affiliate;
    }

    /**
     * @param mixed $affiliate
     */
    public function setAffiliate($affiliate)
    {
        $this->affiliate = $affiliate;
    }
}