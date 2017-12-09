<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use CoreBundle\Exception\CustomException;

/**
 * Description of UserController
 *
 * @author klary
 */
class UserController extends Controller {
		
	/**
     * Función que devuelve los siguientes valores:
	 *		- los detalles del usuario cuyo identificador se corresponde con el recibido por parámetro
	 *		- los tipos de estados en que puede encontrarse un usuario
     *
     * @return TblUsers user, array(object(id, type)) account_types, array(object(id, type)) status_types
     */	
	public function detailAction($id) {
		$helpers = $this->get("core.helpers");
		$response = $this->forward('AdminBundle:User:get', array(
			'id'  => $id
		));
		if($response->getStatusCode()==200){
			$data = json_decode($response->getContent(), true);var_dump($data['user']);die();
			return $helpers->json(["user" => $data['user'], "status_types" => $data['status_types']]);	
		}
				
		var_dump($response);die();	

	}
	
}
