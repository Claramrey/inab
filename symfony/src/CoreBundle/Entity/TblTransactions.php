<?php

namespace CoreBundle\Entity;

/**
 * TblTransactions
 */
class TblTransactions
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $transactionDate;

    /**
     * @var string
     */
    private $payee;

    /**
     * @var string
     */
    private $memo;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var \DateTime
     */
    private $createdOn;

    /**
     * @var \CoreBundle\Entity\TblCategory
     */
    private $category;

    /**
     * @var \CoreBundle\Entity\TblPayees
     */
    private $payee2;

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
     * Set transactionDate
     *
     * @param \DateTime $transactionDate
     *
     * @return TblTransactions
     */
    public function setTransactionDate($transactionDate)
    {
        $this->transactionDate = $transactionDate;

        return $this;
    }

    /**
     * Get transactionDate
     *
     * @return \DateTime
     */
    public function getTransactionDate()
    {
        return $this->transactionDate;
    }

    /**
     * Set payee
     *
     * @param string $payee
     *
     * @return TblTransactions
     */
    public function setPayee($payee)
    {
        $this->payee = $payee;

        return $this;
    }

    /**
     * Get payee
     *
     * @return string
     */
    public function getPayee()
    {
        return $this->payee;
    }

    /**
     * Set memo
     *
     * @param string $memo
     *
     * @return TblTransactions
     */
    public function setMemo($memo)
    {
        $this->memo = $memo;

        return $this;
    }

    /**
     * Get memo
     *
     * @return string
     */
    public function getMemo()
    {
        return $this->memo;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return TblTransactions
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     *
     * @return TblTransactions
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
     * Set category
     *
     * @param \CoreBundle\Entity\TblCategory $category
     *
     * @return TblTransactions
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

    /**
     * Set payee2
     *
     * @param \CoreBundle\Entity\TblPayees $payee2
     *
     * @return TblTransactions
     */
    public function setPayee2(\CoreBundle\Entity\TblPayees $payee2 = null)
    {
        $this->payee2 = $payee2;

        return $this;
    }

    /**
     * Get payee2
     *
     * @return \CoreBundle\Entity\TblPayees
     */
    public function getPayee2()
    {
        return $this->payee2;
    }

    /**
     * Set user
     *
     * @param \CoreBundle\Entity\TblUsers $user
     *
     * @return TblTransactions
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
