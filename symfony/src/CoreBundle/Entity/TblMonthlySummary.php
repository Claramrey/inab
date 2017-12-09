<?php

namespace CoreBundle\Entity;

/**
 * TblMonthlySummary
 */
class TblMonthlySummary
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $summaryMonth;

    /**
     * @var float
     */
    private $fundsForMonth = '0.00';

    /**
     * @var float
     */
    private $overspentLastMonth = '0.00';

    /**
     * @var float
     */
    private $budgetedMonth = '0.00';

    /**
     * @var \CoreBundle\Entity\TblUsers
     */
    private $user;


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
     * Set summaryMonth
     *
     * @param \DateTime $summaryMonth
     *
     * @return TblMonthlySummary
     */
    public function setSummaryMonth($summaryMonth)
    {
        $this->summaryMonth = $summaryMonth;

        return $this;
    }

    /**
     * Get summaryMonth
     *
     * @return \DateTime
     */
    public function getSummaryMonth()
    {
        return $this->summaryMonth;
    }

    /**
     * Set fundsForMonth
     *
     * @param float $fundsForMonth
     *
     * @return TblMonthlySummary
     */
    public function setFundsForMonth($fundsForMonth)
    {
        $this->fundsForMonth = $fundsForMonth;

        return $this;
    }

    /**
     * Get fundsForMonth
     *
     * @return float
     */
    public function getFundsForMonth()
    {
        return $this->fundsForMonth;
    }

    /**
     * Set overspentLastMonth
     *
     * @param float $overspentLastMonth
     *
     * @return TblMonthlySummary
     */
    public function setOverspentLastMonth($overspentLastMonth)
    {
        $this->overspentLastMonth = $overspentLastMonth;

        return $this;
    }

    /**
     * Get overspentLastMonth
     *
     * @return float
     */
    public function getOverspentLastMonth()
    {
        return $this->overspentLastMonth;
    }

    /**
     * Set budgetedMonth
     *
     * @param float $budgetedMonth
     *
     * @return TblMonthlySummary
     */
    public function setBudgetedMonth($budgetedMonth)
    {
        $this->budgetedMonth = $budgetedMonth;

        return $this;
    }

    /**
     * Get budgetedMonth
     *
     * @return float
     */
    public function getBudgetedMonth()
    {
        return $this->budgetedMonth;
    }

    /**
     * Set user
     *
     * @param \CoreBundle\Entity\TblUsers $user
     *
     * @return TblMonthlySummary
     */
    public function setUser(\CoreBundle\Entity\TblUsers $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \CoreBundle\Entity\TblUsers
     */
    public function getUser()
    {
        return $this->user;
    }
}
