<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserDependentRole
 *
 * @author claramunoz
 */
namespace CoreBundle\Entity;

use Symfony\Component\Security\Core\Role\RoleInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

class UserDependentRole implements RoleInterface
{
    private $user;

    public function __construct(AdvancedUserInterface $user)
    {
        $this->user = $user;
    }

    public function getRole()
    {		
		return (strtoupper($this->user->getRole()->getName())=='SUPER_ADMIN')?'ROLE_SUPER_ADMIN':(($this->user->getRole()->getIsAdmin())?'ROLE_ADMIN':'ROLE_USER');
    }
}