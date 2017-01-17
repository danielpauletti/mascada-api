<?php
	class BaseController{
		
		private $mapper;
		private $request;
		private $response;
		
		public function __construct($_mapper, $_request, $_response) {
			$this->mapper = $_mapper;
			$this->request = $_request;
			$this->response = $_response;
		}
		
		public function getMapper(){
			return $this->mapper;
		}
		
		public function getRequest(){
			return $this->request;
		}
		
		public function getResponse(){
			return $this->response;
		}
		
		public function sendResponse($data, $status, $message) {
			if(!$data){
				$status = 404;
				$message = "Registro não encontrado";
			}
			$retorno = array("status"=>$status, "message"=>$message, "data"=>$data);		
			$this->response = $this->response->withAddedHeader('Content-type', 'application/json');
			$this->response = $this->response->withStatus($status);
			$this->response->getBody()->write(json_encode($retorno));
			return $this->response;
		}
	}
?>