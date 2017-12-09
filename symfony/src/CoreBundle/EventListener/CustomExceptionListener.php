<?php

/**
 * Description of CustomExceptionListener
 *
 * @author claramunoz
 */
namespace CoreBundle\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class CustomExceptionListener
{
	/*
	 * Estructura de exceptiones:
	 * 
	 *		- 00: Genéricas
	 *				- 01: Parámetros de entrada
	 *				- 02: Imágenes
	 *				- 03: Fechas
	 *				- 04: Excepciones
	 *				- 05: Envío de emails
	 *		- 01: Autorización
	 *				- 01: autorización
	 *				- 02: login
	 *				- 03: permisos
	 *				- 04: roles
	 *		- 02: Usuarios
	 *				- 01: general
	 *				- 02: modificaciones
	 *				- 03: borrado
	 *				- 04: direcciones
	 *		- 03: Categorías
	 *				- 01: general
	 * 
	*/
	public static $customExceptions = [
		'000101' => ['code' => '400', 'message' => 'NO_INPUT_PARAMETERS', 'description' => 'No input parameters'],
		'000102' => ['code' => '400', 'message' => 'MISSING_MANDATORY_INPUT_PARAMETER', 'description' => 'Missing mandatory parameter'],
		'000103' => ['code' => '400', 'message' => 'IMAGE_FORMAT_NOT_VALID', 'description' => 'Image format not valid'],
		'000104' => ['code' => '400', 'message' => 'INVALID_ID', 'description' => 'Invalid id'],
		'000105' => ['code' => '400', 'message' => 'INVALID_STATUS', 'description' => 'Status is invalid'],
		'000106' => ['code' => '400', 'message' => 'INCORRECT_FORMAT_DATA', 'description' => 'Incorrect format data'],
		'000107' => ['code' => '400', 'message' => 'INCORRECT_PLATFORM', 'description' => 'Platform is invalid'],
		'000108' => ['code' => '400', 'message' => 'INCORRECT_EMAIL_FORMAT', 'description' => "Incorrect email format"],
		'000201' => ['code' => '400', 'message' => 'UNKNOWN_UPLOAD_DIRECTORY', 'description' => 'The directory where the image is uploaded is unknown'],
		'000202' => ['code' => '400', 'message' => 'ERROR_UPLOADING_IMAGE', 'description' => 'Error uploading image'],
		'000301' => ['code' => '400', 'message' => 'INCORRECT_DATE_FORMAT', 'description' => "Incorrect date format. Must be 'YYYY-MM-DD'"],
		'000401' => ['code' => '400', 'message' => 'INCORRECT_ERROR', 'description' => "Incorrect error code"],
		'000501' => ['code' => '400', 'message' => 'UNAUTHORIZED_ERROR', 'description' => "You do not have authorization to make the request to send mail."],
		'000502' => ['code' => '400', 'message' => 'BAD_REQUEST_ERROR', 'description' => "There was a problem with your request to send mail."],
		'000503' => ['code' => '400', 'message' => 'SENDGRID_ERROR', 'description' => "An error occurred when SendGrid attempted to processes it."],
		'010101' => ['code' => '401', 'message' => 'INCORRECT_FORMAT_TOKEN', 'description' => 'Incorrect format token'],
		'010102' => ['code' => '401', 'message' => 'DONT_HAVE_PERMISSIONS', 'description' => "You don't have permissions"],
		'010103' => ['code' => '401', 'message' => 'INACTIVE_USER', 'description' => 'The user is inactive'],
		'010104' => ['code' => '401', 'message' => 'LOCKED_USER', 'description' => "The user is locked"],
		'010105' => ['code' => '401', 'message' => 'DELETED_USER', 'description' => "The user is deleted"],
		'010201' => ['code' => '401', 'message' => 'BASIC_AUTHORIZATION_HEADERS_NO_DETECTED', 'description' => 'Basic authorization headers no detected'],
		'010202' => ['code' => '401', 'message' => 'WRONG_NUMBER_BASIC_AUTHORIZATION_HEADERS', 'description' => 'Wrong number basic authorization headers'],
		'010203' => ['code' => '401', 'message' => 'INCORRECT_FORMAT_BASIC_TOKEN', 'description' => 'Incorrect format basic token'],
		'010204' => ['code' => '401', 'message' => 'LOGIN_NOT_VALID', 'description' => 'Login not valid'],
		'010205' => ['code' => '401', 'message' => 'USER_NOT_EXISTS', 'description' => "User doesn't exists"],
		'010301' => ['code' => '401', 'message' => 'INVALID_MODULE', 'description' => "Invalid module"],
		'010302' => ['code' => '401', 'message' => 'INVALID_SUBMODULE', 'description' => "Invalid submodule"],
		'010303' => ['code' => '401', 'message' => 'INVALID_ADVANCED_ACTION', 'description' => "Invalid advanced action"],
		'010304' => ['code' => '401', 'message' => 'DONT_HAVE_READ_PERMISSIONS', 'description' => "Don't have read permissions"],
		'010305' => ['code' => '401', 'message' => 'DONT_HAVE_WRITE_PERMISSIONS', 'description' => "Don't have write permissions"],
		'010306' => ['code' => '401', 'message' => 'DONT_HAVE_EDIT_PERMISSIONS', 'description' => "Don't have edit permissions"],
		'010307' => ['code' => '401', 'message' => 'DONT_HAVE_DELETE_PERMISSIONS', 'description' => "Don't have delete permissions"],
		'010308' => ['code' => '401', 'message' => 'DONT_HAVE_PERMISSIONS', 'description' => "Don't have permissions"],
		'010401' => ['code' => '401', 'message' => 'ROLE_NOT_EXISTS', 'description' => "Role not exists"],
		'010402' => ['code' => '401', 'message' => 'ROLE_DELETED', 'description' => "Role is deleted"],
		'020101' => ['code' => '400', 'message' => 'USER_NOT_EXISTS', 'description' => "User not exists"],
		'020102' => ['code' => '400', 'message' => 'USER_DELETED', 'description' => "User is deleted"],
		'020103' => ['code' => '400', 'message' => 'CODE_CAN_NOT_BE_EMPTY', 'description' => "Code can not be empty"],
		'020104' => ['code' => '400', 'message' => 'NAME_CAN_NOT_BE_EMPTY', 'description' => "Name can not be empty"],
		'020105' => ['code' => '400', 'message' => 'EMAIL_CAN_NOT_BE_EMPTY', 'description' => "Email can not be empty"],
		'020106' => ['code' => '400', 'message' => 'PHONE_NUMBER_CAN_NOT_BE_EMPTY', 'description' => "Phone number can not be empty"],
		'020107' => ['code' => '400', 'message' => 'OTA_CAN_NOT_BE_EMPTY', 'description' => "Ota can not be empty"],
		'020108' => ['code' => '400', 'message' => 'WANT_NEWS_CAN_NOT_BE_EMPTY', 'description' => "Want news can not be empty"],
		'020109' => ['code' => '400', 'message' => 'ROLE_CAN_NOT_BE_EMPTY', 'description' => "Role can not be empty"],
		'020110' => ['code' => '400', 'message' => 'ACCOUNT_TYPE_CAN_NOT_BE_EMPTY', 'description' => "Account type can not be empty"],
		'020111' => ['code' => '400', 'message' => 'STATUS_CAN_NOT_BE_EMPTY', 'description' => "Status can not be empty"],
		'020112' => ['code' => '400', 'message' => 'DEVICE_TYPE_CAN_NOT_BE_EMPTY', 'description' => "Device type can not be empty"],
		'020113' => ['code' => '400', 'message' => 'POSTAL_CODE_CAN_NOT_BE_EMPTY', 'description' => "Postal code can not be empty"],
		'020114' => ['code' => '400', 'message' => 'REGISTRATION_TYPE_CAN_NOT_BE_EMPTY', 'description' => "Registration type can not be empty"],
		'020115' => ['code' => '400', 'message' => 'ACCOUNT_EXISTS_WITH_EMAIL', 'description' => "An account already exists with that email address"],
		'020116' => ['code' => '400', 'message' => 'ACCOUNT_EXISTS_WITH_PHONE_NUMBER', 'description' => "An account already exists with that phone number"],
		'020117' => ['code' => '400', 'message' => 'ORDER_NOT_BELONG_USER', 'description' => "Order does not belong to the user"],
		'020118' => ['code' => '400', 'message' => 'INCORRECT_PHONE_FORMAT', 'description' => "Incorrect phone format"],
		'020119' => ['code' => '400', 'message' => 'INCORRECT_NAME_FORMAT', 'description' => "The name cannot contain a number"],
		'020120' => ['code' => '400', 'message' => 'INCORRECT_LASTNAME_FORMAT', 'description' => "The lastname cannot contain a number"],
		'020121' => ['code' => '400', 'message' => 'INCORRECT_WANT_NEWS_FORMAT', 'description' => "Want news must be 0 or 1"],
		'020122' => ['code' => '400', 'message' => 'INCORRECT_WANT_NEWS_VALUE', 'description' => "Want news must be 0 or 1"],
		'020123' => ['code' => '400', 'message' => 'INVALID_ACCOUNT_TYPE', 'description' => 'Account type is invalid'],
		'020124' => ['code' => '400', 'message' => 'PAYMENT_METHOD_NOT_BELONG_USER', 'description' => "Payment method does not belong to the user"],
		'020125' => ['code' => '400', 'message' => 'INVALID_LENGHT_NAME', 'description' => 'The name should have min 2 characteres and max 45'],
		'020301' => ['code' => '400', 'message' => 'USER_CAN_NOT_BE_DELETED', 'description' => "User can not be deleted"],
		'020401' => ['code' => '400', 'message' => 'STREET_FIELD_CAN_NOT_BE_EMPTY', 'description' => "Street field can not be empty"],
		'020402' => ['code' => '400', 'message' => 'STREET_NUMBER_FIELD_CAN_NOT_BE_EMPTY', 'description' => "Street number field can not be empty"],
		'020403' => ['code' => '400', 'message' => 'INCORRECT_LONG_STREET', 'description' => "The number of characters in the street exceeds the permitted number (maximum 500 characters)"],
		'020404' => ['code' => '400', 'message' => 'INCORRECT_LONG_STREET_NUMBER', 'description' => "The number of characters in the street number exceeds the permitted number (maximum 45 characters)"],
		'020405' => ['code' => '400', 'message' => 'INCORRECT_LONG_STREET_COMPLEMENT', 'description' => "The number of characters in the complement exceeds the permitted number (maximum 255 characters)"],
		'020406' => ['code' => '400', 'message' => 'INCORRECT_LONG_SPECIAL_INSTRUCTIONS', 'description' => "The number of characters in the special instructions exceeds the permitted number (maximum 45 characters)"],
		'020407' => ['code' => '400', 'message' => 'ADDRESS_ALREADY_EXISTS', 'description' => "Address already exists"],
		'030101' => ['code' => '400', 'message' => 'CATEGORY_NOT_EXISTS', 'description' => "Category not exists"],
		'030102' => ['code' => '400', 'message' => 'CATEGORY_DELETED', 'description' => "Category is deleted"],
		'030103' => ['code' => '400', 'message' => 'NAME_CAN_NOT_BE_EMPTY', 'description' => "Name can not be empty"],
		'030104' => ['code' => '400', 'message' => 'DESCRIPTION_CAN_NOT_BE_EMPTY', 'description' => "Name can not be empty"],
		'030105' => ['code' => '400', 'message' => 'IMAGE_CAN_NOT_BE_EMPTY', 'description' => "Name can not be empty"],
		'030106' => ['code' => '400', 'message' => 'STATUS_CAN_NOT_BE_EMPTY', 'description' => "Status can not be empty"],
		'030107' => ['code' => '400', 'message' => 'SLUG_CAN_NOT_BE_EMPTY', 'description' => "Slug can not be empty"],
		'030108' => ['code' => '400', 'message' => 'TITLE_TIME_CAN_NOT_BE_EMPTY', 'description' => "Title can not be empty"],
		'030109' => ['code' => '400', 'message' => 'KEYWORDS_CAN_NOT_BE_EMPTY', 'description' => "Keywords can not be empty"],
		'030110' => ['code' => '400', 'message' => 'DESCRIPTION_META_CAN_NOT_BE_EMPTY', 'description' => "Description meta can not be empty"],
	];

	public function onKernelException(GetResponseForExceptionEvent $event)
    {		
        $exception = $event->getException();
		$custom_code = $exception->getMessage();
		
		// Se comprueba si la excepción es personalizada y la tenemos definida
		if(isset(self::$customExceptions[$custom_code])){
			$exception_static = self::$customExceptions[$custom_code]; 
			$responseData = [
				'error_code' => $custom_code,
				'error_msg' => $exception_static['message'],
				'error_desc' => $exception_static['description']
			];

			$event->setResponse(new JsonResponse($responseData, $exception_static['code']));
		}
	}
	
	public function getError($code){
		if(isset(self::$customExceptions[$code])){
			return self::$customExceptions[$code];
		}else{
			return null;
		}
	}
}
