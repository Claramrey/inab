<?php

namespace CoreBundle\Entity;

use \Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * TblUsers
 */
class TblUsers implements AdvancedUserInterface, \Serializable
{
	/* Status */
	const ACTIVE = 1;
	const INACTIVE = 0;
	const LOCKED = 2;
	const DELETED = 3;
	
    /**
     * @var integer
     */
    private $id;
	
    /**
     * @var \CoreBundle\Entity\TblRoles
     */
    private $role;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var integer
     */
    private $status;

    /**
     * @var \DateTime
     */
    private $createdOn;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $categoryGroup;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categoryGroup = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set role
     *
     * @param \CoreBundle\Entity\TblRoles $role
     *
     * @return TblUsers
     */
    public function setRole(\CoreBundle\Entity\TblRoles $role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \CoreBundle\Entity\TblRoles
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return TblUsers
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
     * Set lastName
     *
     * @param string $lastName
     *
     * @return TblUsers
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return TblUsers
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return TblUsers
     */
    public function setPassword($password)
    {
        $this->password = md5(trim($password));

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return TblUsers
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     *
     * @return TblUsers
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
     * Add categoryGroup
     *
     * @param \CoreBundle\Entity\TblCategoryGroup $categoryGroup
     *
     * @return TblUsers
     */
    public function addCategoryGroup(\CoreBundle\Entity\TblCategoryGroup $categoryGroup)
    {
        $this->categoryGroup[] = $categoryGroup;

        return $this;
    }

    /**
     * Remove categoryGroup
     *
     * @param \CoreBundle\Entity\TblCategoryGroup $categoryGroup
     */
    public function removeCategoryGroup(\CoreBundle\Entity\TblCategoryGroup $categoryGroup)
    {
        $this->categoryGroup->removeElement($categoryGroup);
    }

    /**
     * Get categoryGroup
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategoryGroup()
    {
        return $this->categoryGroup;
    }
	
	// Métodos que debe implementar el Entity para implementar el UserInterface

	public function eraseCredentials() {}

	public function getRoles() {
		return [new UserDependentRole($this)];
	}

	public function getSalt() {
		return null;
	}

	public function getUsername() {
		return $this->email;
	}

	/**
     * Checks whether the user's account has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw an AccountExpiredException and prevent login.
     *
     * @return Boolean true if the user's account is non expired, false otherwise
     *
     * @see AccountExpiredException
     */
	public function isAccountNonExpired() {
		return true;
	}

	/**
     * Checks whether the user is locked.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a LockedException and prevent login.
     *
     * @return Boolean true if the user is not locked, false otherwise
     *
     * @see LockedException
     */
	public function isAccountNonLocked() {
		return $this->status != self::LOCKED; 
	}

	/**
     * Checks whether the user's credentials (password) has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a CredentialsExpiredException and prevent login.
     *
     * @return Boolean true if the user's credentials are non expired, false otherwise
     *
     * @see CredentialsExpiredException
     */
	public function isCredentialsNonExpired() {
		return true;
	}

	/**
     * Checks whether the user is enabled.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a DisabledException and prevent login.
     *
     * @return Boolean true if the user is enabled, false otherwise
     *
     * @see DisabledException
     */
	public function isEnabled() {
		return $this->status == self::ACTIVE;
	}

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->password,
        ) = unserialize($serialized);
    }

    /**
     * Get all status
     *
     * @return array
     */
    static function getAllStatus()
    {
		$active = ['id' => self::ACTIVE, 'type' => 'activo'];
		$inactive = ['id' => self::INACTIVE, 'type' => 'inactivo'];
		$locked = ['id' => self::LOCKED, 'type' => 'bloqueado'];
		$deleted = ['id' => self::DELETED, 'type' => 'borrado'];
        return [$active, $inactive, $locked, $deleted];
    }
	
	public function validateData(TblUsers $obj_user){
		$validator = Validation::createValidator();
		$violations = $validator->validate($obj_user->getName(), array(
			new Length(array('min' => 2, 'max' => 45, 'minMessage' => '020125', 'maxMessage' => '020125')),
			new NotBlank(array("message" => "020104")),
			new Regex(array('pattern' => "/\d/", "match" => false, "message" => "020119")),
		));
		if((0 == count($violations))){
			$violations = $validator->validate($obj_user->getLastName(), array(
				new Regex(array('pattern' => "/\d/", "match" => false, "message" => "020120")),
			));
			if((0 == count($violations))){
				$violations = $validator->validate($obj_user->getEmail(), array(
					new NotBlank(array("message" => "020105")),
//					new UniqueEntity(array('fields' => 'email', "message" => "020115")),
					new Email(array("message" => "000108")),
				));
			}
		}
		
		// Si detecta un error de validación, lo devuelve
		return (0 !== count($violations))?['res_code'=>$violations['0']->getMessage()]:['res_code'=>'200'];
	}

}
