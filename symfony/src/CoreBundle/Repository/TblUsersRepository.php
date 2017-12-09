<?php

namespace CoreBundle\Repository;

use CoreBundle\Entity;

/**
 * Description of TblUsersRepository
 *
 * @author claramunoz
 */
class TblUsersRepository extends \Doctrine\ORM\EntityRepository{
		
//	protected $controller;
//	
//	public function __construct($controller)
//    {
//        $this->controller = $controller;
//	}
	
	/**
     * Devuelve el usuario cuyo identificador se corresponde con el recibido por parámetro o un error si el usuario no existe
     *
     * @return ['res_code' => string, 'response' => ['error_code' => string] || TblUsers]
     */	
	public function getUser($id){
		
		if($id == null){ // No se pueden recibir ids nulos
			return $this->getError('000104'); 
		}
		$user = $this->find($id);
		if(count($user)!=1){ // El usuario no existe
			return $this->getError('020101');
		}
		
		// Se devuelve el usuario
		return $this->getResponse($user);
	}
	
	/**
     * Setea los datos para crear un nuevo usuario a partir de los datos recibidos
     *
     * @return ['res_code' => string, 'response' => ['error_code' => string] || TblUsers]
     */	
	public function setDataNewUser($name, $email, $password, $lastName = null){
				
		// Setea los datos dl usuario en el objeto "obj_user"
		$obj_user = new Entity\TblUsers();	
		
		// Comprueba que no exista ya un usuario con la dirección de correo 
		$checkEmail = $this->checkEmail($email);
		if($checkEmail['res_code'] != '200'){ return $checkEmail;}
		
		// Se obtiene el rol por defecto
		$manager = $this->getEntityManager();
		$role = $manager->getRepository('CoreBundle:TblRoles')->getAdminRole();		
		if($role['res_code'] != '200'){ return $role;}
		
		$obj_user->setRole($role['response']);
		$obj_user->setName($name);
		$obj_user->setLastName($lastName);
		$obj_user->setEmail($email);
		$obj_user->setPassword($password);
		$obj_user->setStatus($obj_user::ACTIVE);
		$obj_user->setCreatedOn(new \DateTime("now"));
		
		$validation = $obj_user->validateData($obj_user);
		if($validation['res_code'] != '200'){ return $validation;}
		
		// Se crea el usuario en BD y se devuelve
		return $this->newUser($obj_user);
	}
	
	/**
     * Se crea una nueva dirección en base de datos
     *
     * @return ['res_code' => string, 'response' => ['error_code' => string] || TblUsers]
     */	
	private function newUser(Entity\TblUsers $user){

		$manager = $this->getEntityManager();
							
		// Se persiste el objeto y se inserta en BD
		$manager->persist($user);
		$manager->flush();
		
		// Se guarda en el log la inserción del nuevo descuento
		$manager->getRepository('CoreBundle:TblLogs')->newRecord($user, "tbl_users", "new", "id", $user->getId(), null);
		
		// Se devuelve el usuario
		return $this->getResponse($user);
	}
	
	/**
     * Comprueba que no exista ningún usuario activo o bloqueado con la misma dirección de correo. Si se le pasa un usuario por parámetro lo excluye de la comprobación.
	 * Si existe un usuario activo con dicho correo devuelve un error.
     *
     * @return ['res_code' => string, 'response' => ['error_code' => string] || bool]
	 * 
     */	
	private function checkEmail($email){
		
		$manager = $this->getEntityManager();

		$user = new Entity\TblUsers();
		
		$dql = "SELECT u FROM CoreBundle:TblUsers u "
				. "WHERE u.email = :email "
//				. "AND u.status IN (:status_loqued, :status_active) "
				;
		$query = $manager->createQuery($dql)
				->setParameter("email", $email)
//				->setParameter("status_loqued", $user::LOCKED)
//				->setParameter("status_active", $user::ACTIVE)
				;
		
		$isset_user = $query->getResult(); 
		// Se comprueba si existe algún usuario con dicha dirección de email. De ser así, devuelve un error
		if(count($isset_user) != 0){
			return $this->getError('020115');
		}
		return $this->getResponse(true);
	}
	
	/**
     * Devuelve el array de estados en que puede encontrarse un usuario
	 * 
     * @return array
     */	
	public function getAllStatus(){
				
		$obj_user = new Entity\TblUsers();      
		return $obj_user::getAllStatus();
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
