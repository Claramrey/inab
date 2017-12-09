<?php

namespace CoreBundle\Entity;

/**
 * TblLogs
 */
class TblLogs
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $tableName;

    /**
     * @var string
     */
    private $actionType;

    /**
     * @var string
     */
    private $columnName;

    /**
     * @var integer
     */
    private $fieldId;

    /**
     * @var string
     */
    private $oldValue;

    /**
     * @var \DateTime
     */
    private $date;

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
     * Set tableName
     *
     * @param string $tableName
     *
     * @return TblLogs
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;

        return $this;
    }

    /**
     * Get tableName
     *
     * @return string
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * Set actionType
     *
     * @param string $actionType
     *
     * @return TblLogs
     */
    public function setActionType($actionType)
    {
        $this->actionType = $actionType;

        return $this;
    }

    /**
     * Get actionType
     *
     * @return string
     */
    public function getActionType()
    {
        return $this->actionType;
    }

    /**
     * Set columnName
     *
     * @param string $columnName
     *
     * @return TblLogs
     */
    public function setColumnName($columnName)
    {
        $this->columnName = $columnName;

        return $this;
    }

    /**
     * Get columnName
     *
     * @return string
     */
    public function getColumnName()
    {
        return $this->columnName;
    }

    /**
     * Set fieldId
     *
     * @param integer $fieldId
     *
     * @return TblLogs
     */
    public function setFieldId($fieldId)
    {
        $this->fieldId = $fieldId;

        return $this;
    }

    /**
     * Get fieldId
     *
     * @return integer
     */
    public function getFieldId()
    {
        return $this->fieldId;
    }

    /**
     * Set oldValue
     *
     * @param string $oldValue
     *
     * @return TblLogs
     */
    public function setOldValue($oldValue)
    {
        $this->oldValue = $oldValue;

        return $this;
    }

    /**
     * Get oldValue
     *
     * @return string
     */
    public function getOldValue()
    {
        return $this->oldValue;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return TblLogs
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set user
     *
     * @param \CoreBundle\Entity\TblUsers $user
     *
     * @return TblLogs
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
