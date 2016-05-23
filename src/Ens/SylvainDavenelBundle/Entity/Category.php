<?php

/**
 * Created by PhpStorm.
 * User: mirouf
 * Date: 19/05/16
 * Time: 15:52
 */

namespace Ens\SylvainDavenelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Ens\SylvainDavenelBundle\Entity\CategoryAffiliate;
use Ens\SylvainDavenelBundle\Entity\Job;
use Ens\SylvainDavenelBundle\Utils\Jobeet as Jobeet;

/**
 * Class Category
 *
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Ens\SylvainDavenelBundle\Repository\CategoryRepository")
 * @ORM\Table(name="t_category")
 * @ORM\HasLifecycleCallbacks()
 * @package Ens\SylvainDavenelBundle\Entity\Category
 */
class Category
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @var mixed
     *
     * @ORM\OneToMany(targetEntity="Job", mappedBy="category")
     */
    private $jobs;

    /**
     * @var mixed
     *
     * @ORM\OneToMany(targetEntity="CategoryAffiliate", mappedBy="category")
     */
    private $categoryAffiliates;

    private $active_jobs;

    private $more_jobs;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getJobs()
    {
        return $this->jobs;
    }

    /**
     * @param mixed $jobs
     */
    public function setJobs($jobs)
    {
        $this->jobs = $jobs;
    }

    /**
     * @return mixed
     */
    public function getCategoryAffiliates()
    {
        return $this->categoryAffiliates;
    }

    /**
     * @param mixed $categoryAffiliates
     */
    public function setCategoryAffiliates($categoryAffiliates)
    {
        $this->categoryAffiliates = $categoryAffiliates;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return Jobeet::slugify($this->getName());
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Category
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function setSlugValue()
    {
        $this->slug = Jobeet::slugify($this->getName());
    }

    public function setMoreJobs($jobs)
    {
        $this->more_jobs = $jobs >=  0 ? $jobs : 0;
    }

    public function getMoreJobs()
    {
        return $this->more_jobs;
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function setActiveJobs($jobs)
    {
        $this->active_jobs = $jobs;
    }

    public function getActiveJobs()
    {
        return $this->active_jobs;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->jobs = new ArrayCollection();
        $this->categoryAffiliates = new ArrayCollection();
    }

    /**
     * Add job
     *
     * @param \Ens\SylvainDavenelBundle\Entity\Job $job
     *
     * @return Category
     */
    public function addJob(Job $job)
    {
        $this->jobs[] = $job;

        return $this;
    }

    /**
     * Remove job
     *
     * @param Job $job
     */
    public function removeJob(Job $job)
    {
        $this->jobs->removeElement($job);
    }

    /**
     * Add categoryAffiliate
     *
     * @param CategoryAffiliate $categoryAffiliate
     *
     * @return Category
     */
    public function addCategoryAffiliate(CategoryAffiliate $categoryAffiliate)
    {
        $this->categoryAffiliates[] = $categoryAffiliate;

        return $this;
    }

    /**
     * Remove categoryAffiliate
     *
     * @param CategoryAffiliate $categoryAffiliate
     */
    public function removeCategoryAffiliate(CategoryAffiliate $categoryAffiliate)
    {
        $this->categoryAffiliates->removeElement($categoryAffiliate);
    }
}
