<?php

/**
 * Description of SubmodulesVoter
 *
 * @author claramunoz
 */
namespace AdminBundle\Security;

use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;

class SubmodulesVoter extends Voter
{
	
    private $decisionManager;
	public $manager;
	public $permissions_types;

    public function __construct(AccessDecisionManagerInterface $decisionManager, $manager)
    {
        $this->decisionManager = $decisionManager;
		$this->manager = $manager;
		
//		$obj_permissions = new TblPermissions();		
//		$this->permissions_types = $obj_permissions->getPermissionsTypes();
		$this->permissions_types = ["view","create","edit","delete"];
    }

	/**
     * Comprueba si el permiso está soportado y que la acción sea una instancia de submódulos
     *
     * @return bool 
     */
	protected function supports($permission, $module_action = null) {
		
		// si el permiso no es uno de los que soportamos, devolver false
        if (!in_array($permission, $this->permissions_types)) {
            return false;
        }
		
		// si la acción del módulo no es una instancia de submódulos, devolver false
//		if (!($module_action instanceof TblSubmodules)) {
//            return false;
//        }
		
		return true;
	}

	/**
     * Comprueba si el usuario tiene permisos para el submódulo $module_action  con el tipo de acción recibida por parámetro $permission
     *
     * @return bool or Exception
     */
	protected function voteOnAttribute($permission, $module_action, TokenInterface $token) {
		
		// Si el usuario tiene rol de superadministrador puede realizar cualquier acción
		if ($this->decisionManager->decide($token, array('ROLE_SUPER_ADMIN'))) {
			return true;
		}
		$user = $token->getUser(); 
		return ($user instanceof \CoreBundle\Entity\TblUsers)&&$user->getRole()->getIsAdmin();
		
//		$manager = $this->manager;
//		
//		// Obtiene los permisos del usuario para dicho submódulo
//		$permission_result = $manager->getRepository('CoreBundle:TblPermissions')->checkPermissions($permission, $user->getRole());
//		// Si obtiene algún error, lanza una excepción
//		if($permission_result['res_code']!='200'){
//			throw new CustomException($permission_result['res_code']); 
//		}
//		return $permission_result['response'];
	}

}
