<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Routing\ClassResourceInterface;
use CoreBundle\Exception\CustomException;

/**
 * Description of UserController
 *
 * @author klary
 */
class UserController extends Controller implements ClassResourceInterface{

	/**
     * Función que devuelve los siguientes valores:
	 *		- los detalles del usuario cuyo identificador se corresponde con el recibido por parámetro
	 *		- los tipos de estados en que puede encontrarse un usuario
     *
     * @return TblUsers user, array(object(id, type)) account_types, array(object(id, type)) status_types
     */	
	public function getAction($id) {
		$helpers = $this->get("core.helpers");
        $em = $this->getDoctrine()->getManager();
		$user_repository = $em->getRepository('CoreBundle:TblUsers');

		// Se obtienen los permisos de lectura para el submódulo de usuarios. Si no tiene, se devuelve una excepción
//		$this->__checkPermissions('view', $this->__getUsersSubmodule());
		
		// Se obtiene el usuario cuyo identificador se corresponde con el recibido por parámetro
		$user = $helpers->getResult($user_repository->getUser($id));
		
		// Se obtienen todos los tipos de estados en que puede encontrarse un usuario
		$status_types = $user_repository->getAllStatus();
				
		return $helpers->json(["user" => $user, "status_types" => $status_types]);		

	}

	/**
     * Registro de usuarios
     *
     * @return TblUsers
     */	
	public function postAction(Request $request) { 
		$helpers = $this->get("core.helpers");
		$em = $this->getDoctrine()->getManager();	
		$user_repository = $em->getRepository('CoreBundle:TblUsers');
		
		// Se comprueba si el usuario tiene permisos de creación para el submódulo de usuarios. Si no tiene, se devuelve una excepción
//		$this->__checkPermissions('create', $this->__getUsersSubmodule());
		
		// Se checkea si existen todos los parámetros de entrada obligatorios. Si alguno de ellos no existe, se genera una excepción
		$mandatory_params = ['name','email','password'];
		// Se obtiene la localidad dado que existen códigos postales repetidos asociados a distintas localidades. En caso de tener que evaluar uno de ellos, se chequeará la localidad
		$optional_params = ['last_name']; 
		$params = $helpers->getJsonParamsCheckMandatory($request, $mandatory_params, $optional_params);	
		
		// Se crea el nuevo usuario de tipo invitado
		$user_obj = $helpers->getResult($user_repository->setDataNewUser($params['name'],$params['email'],$params['password'],$params['last_name']));
				
		return $this->getAction($user_obj->getId());		
	}
	
}
