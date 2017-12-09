<?php

namespace CoreBundle\Entity;

/**
 * TblCategory
 */
class TblCategory
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $budgeted = '0.00';

    /**
     * @var float
     */
    private $activity = '0.00';

    /**
     * @var float
     */
    private $available = '0.00';

    /**
     * @var boolean
     */
    private $hasGoal = '0';

    /**
     * @var float
     */
    private $goal;

    /**
     * @var boolean
     */
    private $active = '1';

    /**
     * @var \DateTime
     */
    private $createdOn;

    /**
     * @var \DateTime
     */
    private $deletedOn;

    /**
     * @var \CoreBundle\Entity\TblCategoryGroup
     */
    private $categoryGroup;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return TblCategory
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set budgeted
     *
     * @param float $budgeted
     *
     * @return TblCategory
     */
    public function setBudgeted($budgeted)
    {
        $this->budgeted = $budgeted;

        return $this;
    }

    /**
     * Get budgeted
     *
     * @return float
     */
    public function getBudgeted()
    {
        return $this->budgeted;
    }

    /**
     * Set activity
     *
     * @param float $activity
     *
     * @return TblCategory
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return float
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Set available
     *
     * @param float $available
     *
     * @return TblCategory
     */
    public function setAvailable($available)
    {
        $this->available = $available;

        return $this;
    }

    /**
     * Get available
     *
     * @return float
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * Set hasGoal
     *
     * @param boolean $hasGoal
     *
     * @return TblCategory
     */
    public function setHasGoal($hasGoal)
    {
        $this->hasGoal = $hasGoal;

        return $this;
    }

    /**
     * Get hasGoal
     *
     * @return boolean
     */
    public function getHasGoal()
    {
        return $this->hasGoal;
    }

    /**
     * Set goal
     *
     * @param float $goal
     *
     * @return TblCategory
     */
    public function setGoal($goal)
    {
        $this->goal = $goal;

        return $this;
    }

    /**
     * Get goal
     *
     * @return float
     */
    public function getGoal()
    {
        return $this->goal;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return TblCategory
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     *
     * @return TblCategory
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * Get createdOn
     *
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set deletedOn
     *
     * @param \DateTime $deletedOn
     *
     * @return TblCategory
     */
    public function setDeletedOn($deletedOn)
    {
        $this->deletedOn = $deletedOn;

        return $this;
    }

    /**
     * Get deletedOn
     *
     * @return \DateTime
     */
    public function getDeletedOn()
    {
        return $this->deletedOn;
    }

    /**
     * Set categoryGroup
     *
     * @param \CoreBundle\Entity\TblCategoryGroup $categoryGroup
     *
     * @return TblCategory
     */
    public function setCategoryGroup(\CoreBundle\Entity\TblCategoryGroup $categoryGroup = null)
    {
        $this->categoryGroup = $categoryGroup;

        return $this;
    }

    /**
     * Get categoryGroup
     *
     * @return \CoreBundle\Entity\TblCategoryGroup
     */
    public function getCategoryGroup()
    {
        return $this->categoryGroup;
    }
}
