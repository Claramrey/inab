<?php

namespace CoreBundle\Repository;

/**
 * TblRolesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TblRolesRepository extends \Doctrine\ORM\EntityRepository
{
	
	/**
     * Devuelve el rol cuyo identificador se corresponde con el recibido por parámetro o un error si el rol no existe
     *
     * @return ['res_code' => string, 'response' => ['error_code' => string] || TblRoles]
     */	
	public function getRole($id){
		
		$role = $this->find($id);
		
		if(count($role)!=1){ // El rol no existe
			return $this->getError('010401'); 
		}
		
		// Se devuelve el rol
		return $this->getResponse($role);
	}
	
	/**
     * Devuelve el rol de tipo "administrador"
     *
     * @return ['res_code' => string, 'response' => ['error_code' => string] || TblRoles]
     */	
	public function getAdminRole(){
		
		$role_obj = new \CoreBundle\Entity\TblRoles();
		
		// Se devuelve el rol de administrador
		return $this->getRole($role_obj::ROLE_ID_ADMIN);
	}
		
	/**
     * Devuelve el error recibido
	 * 
     * @return ['res_code' => string, 'response' => ['error_code' => string]]
     */
	private function getError($code){ 
		$response['error_code'] = $code;
		return ['res_code'=>$code, 'response'=>$response];
	} 
		
	/**
     * Devuelve una respuesta satisfactoria
	 * 
     * @return ['res_code' => string, 'response' => response]
     */
	private function getResponse($response){ 
		return ['res_code'=>'200', 'response'=>$response];
	}
}
