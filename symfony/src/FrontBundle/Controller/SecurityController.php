<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FrontBundle\Controller;

/**
 * Description of SecurityController
 *
 * @author claramunoz
 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller 
{
	
	public function loginAction(Request $request)
	{
		$authUtils = $this->get('security.authentication_utils');  
		
		// get the login error if there is one
		$error = $authUtils->getLastAuthenticationError();

		// last username entered by the user
		$lastUsername = $authUtils->getLastUsername();
		
		return $this->render('AdminBundle\Security\login.html.twig', array(
			'last_username' => $lastUsername,
			'error'         => $error,
		));
	}
}
