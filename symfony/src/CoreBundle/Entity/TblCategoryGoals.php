<?php

namespace CoreBundle\Entity;

/**
 * TblCategoryGoals
 */
class TblCategoryGoals
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $goalType;

    /**
     * @var float
     */
    private $totalGoal;

    /**
     * @var float
     */
    private $budgeted;

    /**
     * @var \CoreBundle\Entity\TblCategory
     */
    private $category;


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
     * Set goalType
     *
     * @param integer $goalType
     *
     * @return TblCategoryGoals
     */
    public function setGoalType($goalType)
    {
        $this->goalType = $goalType;

        return $this;
    }

    /**
     * Get goalType
     *
     * @return integer
     */
    public function getGoalType()
    {
        return $this->goalType;
    }

    /**
     * Set totalGoal
     *
     * @param float $totalGoal
     *
     * @return TblCategoryGoals
     */
    public function setTotalGoal($totalGoal)
    {
        $this->totalGoal = $totalGoal;

        return $this;
    }

    /**
     * Get totalGoal
     *
     * @return float
     */
    public function getTotalGoal()
    {
        return $this->totalGoal;
    }

    /**
     * Set budgeted
     *
     * @param float $budgeted
     *
     * @return TblCategoryGoals
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
     * Set category
     *
     * @param \CoreBundle\Entity\TblCategory $category
     *
     * @return TblCategoryGoals
     */
    public function setCategory(\CoreBundle\Entity\TblCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \CoreBundle\Entity\TblCategory
     */
    public function getCategory()
    {
        return $this->category;
    }
}
