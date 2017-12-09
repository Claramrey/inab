<?php

/**
 * Description of Helpers
 *
 * @author claramunoz
 */

namespace CoreBundle\Services;

use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use CoreBundle\Exception\CustomException;

class Helpers {
	

	public function json($data){
		$normalizers = array(new GetSetMethodNormalizer());
		$encoders = array("json" => new JsonEncoder());
		
		$serializer = new Serializer($normalizers, $encoders);
		$json = $serializer->serialize($data, 'json');
		
		$response = new Response();
		$response->setContent($json);
		$response->headers->set("Content-Type", "application/json");
		
		return $response;
	}
	
	public function paginateData($query, $page, $paginator, $name, $items_per_page = 10) {
		
		// Se incluye el parámetro de configuración "wrap-queries" para poder utilizar la cláusula "HAVING"
		$pagination = $paginator->paginate($query, $page, $items_per_page, array('wrap-queries'=>true));
		$total_items_count = $pagination->getTotalItemCount();
		
		$data = [
			"total_items_count" => $total_items_count,
			"page_actual" => $page,
			"items_per_page" => $items_per_page,
			"total_pages" => ceil($total_items_count / $items_per_page),
			$name => $pagination
		];
		return $data;
	}
        
	public function equalThan($value) {
		return ['operator' => '=', 'value' => $value];
	}
	
	public function differentThan($value) {
		return ['operator' => '!=', 'value' => $value];
	}
	
	public function betweenValues($value_start, $value_end) {
		return ['operator' => 'between', 'value' => "'.$value_start.' and '".$value_end."'"];
	}
	
	public function greaterEqualThan($value) {
		return ['operator' => '>=', 'value' => $value];
	}
	
	public function smallerEqualThan($value) {
		return ['operator' => '<=', 'value' => $value];
	}
	
	public function greaterThan($value) {
		return ['operator' => '>', 'value' => $value];
	}
	
	public function smallerThan($value) {
		return ['operator' => '<', 'value' => $value];
	}
	
	public function likeThan($value) {
		return ['operator' => 'like', 'value' => "'%".$value."%'"];
	}
	
	public function isNotNull() {
		return ['operator' => ' ', 'value' => "is not null"];
	}
	
	public function inValues($values) {
		$data_values = "";
		foreach ($values as $key => $value) {
			$data_values .= $value.',';
		}
		$data = substr ($data_values, 0, strlen($data_values) - 1);
		return ['operator' => 'in', 'value' => "(".$data.")"];
	}
        
        public function notInValues($values) {
		$data_values = "";
		foreach ($values as $key => $value) {
			$data_values .= $value.',';
		}
		$data = substr ($data_values, 0, strlen($data_values) - 1);
		return ['operator' => 'not in', 'value' => "(".$data.")"];
	}
		
	/**
     * Devuelve el error recibido
	 * 
     * @return ['res_code' => string, 'response' => ['error_code' => string, 'error_msg' => string, 'error_desc' => string]]
     */
	public function getError($code){ 
		$customException = new \CoreBundle\EventListener\CustomExceptionListener();
		$exception = $customException->getError($code); 
		if($exception == null){
			$response = $customException->getError('000401');
		}else{
			$response['error_code'] = $exception['code'];
			$response['error_msg'] = $exception['message'];
			$response['error_desc'] = $exception['description'];
		}
		return ['res_code'=>$code, 'response'=>$response];
	} 
		
	/**
     * Devuelve una respuesta satisfactoria
	 * 
     * @return ['res_code' => string, 'response' => object]
     */
	public function getResponse($response){ 
		return ['res_code'=>'200', 'response'=>$response];
	} 
	
	/**
     * Devuelve los parámetros de entrada obtenidos en la petición
     *
     * @return array
     */
	private function getInputParams(Request $request){
		// Se obtienen los parámetros de entrada
		$data = array_merge($request->query->all(),$request->request->all()); 
		// Si no existen parámetros, devuelve un array vacío
		if($data == null){
			$data = [];
		}
		// Se devuelven los parámetros de entrada recibidos
		return $data;
	}
	
	/**
     * Devuelve los parámetros de entrada obtenidos en la petición
     *
     * @return array or exception
     */
	public function getInputParamsOrException(Request $request){
		// Se obtienen los parámetros de entrada
		$data = $this->getInputParams($request);
		// Si no existen parámetros, devuelve una excepción
		if(empty($data)){
			throw new CustomException('000101'); 
		}
		
		// Se devuelven los parámetros de entrada recibidos
		return $data;
	}
	
	/**
     * Devuelve los parámetros de entrada obtenidos en la petición
     *
     * @return array or exception
     */
	public function getArrayParams(Request $request, $params){
		// Se obtienen los parámetros de entrada
		$data = $this->getInputParams($request); 
		$arr_params = [];
		
		// Se comprueba cada parámetro. Si existe, se setea su valor; si no, lo setea a nulo
		foreach ($params as $param) {
			$arr_params[$param] = (isset($data[$param]) ? trim($data[$param]) : null);
		}
		
		// Se devuelven los parámetros de entrada recibidos
		return $arr_params;
	}
	
	/**
     * Obtiene los parámetros de entrada recibidos y chequea que existan todos los parámetros obligatorios
     *
     * @return array or exception
     */
	public function getParamsCheckMandatory(Request $request, $mandatory_params, $optional_params = []){
		
		// Se obtienen los parámetros de entrada
		$params = $this->getInputParamsOrException($request);
		$arr_params = [];
		
		// Se comprueba que existan todos los obligatorios
		foreach ($mandatory_params as $param) {
			if(!isset($params[$param])){ 
				throw new CustomException('000102'); 
			}else{
				$arr_params[$param] = trim($params[$param]);
			}
		}
		
		// Se comprueba cada parámetro opcional. Si existe, se setea su valor; si no, lo setea a nulo
		foreach ($optional_params as $param) {
			$arr_params[$param] = (isset($params[$param]) ? trim($params[$param]) : null);
		}
		
		// Devuelve los parámetros obtenidos
		return $arr_params;
	}
	
	/**
     * Obtiene los parámetros de entrada recibidos y chequea que existan todos los parámetros obligatorios
     *
     * @return array or exception
     */
	public function getJsonParamsCheckMandatory(Request $request, $mandatory_params, $optional_params = []){
		
		// Se obtienen los parámetros de entrada
		$params = json_decode($request->getContent(),true); 
		$arr_params = [];
		
		// Se comprueba que existan todos los obligatorios
		foreach ($mandatory_params as $param) {
			if(!isset($params[$param])){ 
				throw new CustomException('000102'); 
			}else{
				$arr_params[$param] = $params[$param];
			}
		}
		
		// Se comprueba cada parámetro opcional. Si existe, se setea su valor; si no, lo setea a nulo
		foreach ($optional_params as $param) {
			$arr_params[$param] = (isset($params[$param]) ? $params[$param] : null);
		}
		
		// Devuelve los parámetros obtenidos
		return $arr_params;
	}
	
	/**
     * Obtiene los parámetros de entrada recibidos 
     *
     * @return array or exception
     */
	public function getJsonParams(Request $request, $params = []){
		
		// Se obtienen los parámetros de entrada
		$data = json_decode($request->getContent(),true);
		$arr_params = [];
		
		// Se comprueba cada parámetro. Si existe, se setea su valor; si no, lo setea a nulo 
		foreach ($params as $param) {
			$arr_params[$param] = (isset($data[$param]) ? $data[$param] : null);
		}
		
		// Devuelve los parámetros obtenidos
		return $arr_params;
	}
	
	/**
     * Obtiene y valida las imágenes recibidas por parámetro, considerándose todas obligatorias
     *
     * @return array or exception
     */
	public function getMandatoryUploadImages(Request $request, $mandatory_images){
		
		$params = [];
		foreach ($mandatory_images as $image) {
			$img = $request->files->get($image, null);
			
			if($img == null || empty($img)){ // Falta un campo obligatorio
				throw new CustomException('000102'); 
			}else{
				$ext = $img->guessExtension(); 
				if($this->__validImageFormat($ext)){
					$params[$image] = $img;
				}else{ // Formato de imagen inccorrecto
					throw new CustomException('000103'); 
				}
			}
		}
		// Se devuelven las imágenes validadas
		return $params;
	}
	
	/**
     * Obtiene y valida las imágenes recibidas por parámetro
     *
     * @return array or exception
     */
	public function getUploadImages(Request $request, $images){
		
		$params = [];
		foreach ($images as $image) {
			$img = $request->files->get($image, null);
			
			if($img == null || empty($img)){ // La imagen no existe
				$params[$image] = null;
			}else{ // si la imagen existe, valida la extensión
				$ext = $img->guessExtension(); 
				if($this->__validImageFormat($ext)){
					$params[$image] = $img;
				}else{ // Formato de imagen inccorrecto
					throw new CustomException('000103'); 
				}
			}
		}
		// Se devuelven las imágenes validadas
		return $params;
	}
	
	
	/**
     * Devuelve cierto o falso dependiendo de si el formato de la imagen está o no permitido
     *
     * @return boolean
     */
	private function __validImageFormat($ext) {
		return ($ext == "jpeg" || $ext == "jpg" || $ext == "png");
	}
		
	/**
     * Función provisional para devolver una excepción del conjunto de errores producidos por las validaciones
     *
     * @return CustomException
     */
	public function checkErrors($errors) {
		if (count($errors) > 0) {
			// Devuelve el primero de los errores
			$error_code = $errors['0']->getMessage();
			throw new CustomException($error_code); 
		}
	}
		
	/**
     * Validación del formato de una fecha
	 * 
	 * @return date 
     */
	public function checkDate($date){ 	
		
		// Se obtienen los datos parseados
		list($year,$month,$day) = $this->parseDate($date);
		
		// Se comprueba que la fecha es correcta
		$this->checkDateData($year, $month, $day);
		
		// Se devuelve la fecha en formato "date"
		$time = strtotime($year."-".$month."-".$day);
		return date_create(date('Y-m-d',$time));
	}  
		
	/**
     * Se valida una fecha y se convierte a string
	 * 
	 * @return string 
     */
	public function checkDateToString($date){ 
		// Se obtienen los datos parseados
		list($year,$month,$day) = $this->parseDate($date);
		
		$this->checkDateData($year, $month, $day);
		
		return "'".$year."-".$month."-".$day."'";
	}  
		
	/**
     * Se parsea una fecha en año, mes y día
	 * 
	 * @return array 
     */
	public function parseDate($date){ 
		trim(str_replace("'","",$date)); 
		$arr_date = explode ("-", $date); 
		$year = (isset($arr_date[0]) && is_numeric($arr_date[0]))?(int)$arr_date[0]:null; 
		$month = (isset($arr_date[1]) && is_numeric($arr_date[1]))?(int)$arr_date[1]:null; 
		$day = (isset($arr_date[2]) && is_numeric($arr_date[2]))?(int)$arr_date[2]:null;  
		
		return [$year,$month,$day];
	}   
		
	/**
     * Se validan los datos de una fecha y devuelve una excepción en caso de no ser válidos
     */
	public function checkDateData($year,$month,$day){ 
		// Si el formato de fecha es incorrecto devuelve una excepción
		if(($year == null) || ($month == null) || ($day == null) || !(checkdate($month,$day,$year))){
			throw new CustomException('000301'); 
		}
	}  
		
	/**
     * Se crea un array con los valores definidos por el parámetro $field
     */
	public function arrayFormatFromParamObjects($array,$field){ 
		$arr_format = [];
		foreach ($array as $value) {
			if(isset($value[$field])){
				$arr_format[] = $value[$field];
			}else{ // Formato incorrecto
				throw new CustomException('000106'); 
			}
		}
		return $arr_format;
	} 
		
	/**
     * Comprueba que el movimiento se ha realizado correctamente. De no ser así, genera una excepción
     */
	public function checkMovement($movement) {
		if($movement['res_code'] != '200'){
			throw new CustomException($movement['res_code']); 
		}
	}
		
	/**
     * Obtiene el resultado de la petición. Si se ha producido un error, devuelve la excepción correspondiente
     */
	public function getResult($result) {
		if($result['res_code'] != '200'){
			throw new CustomException($result['res_code']); 
		}
		return $result['response'];
	}
}
