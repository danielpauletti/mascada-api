<?php
	class EventosController extends BaseController{
		
		public function getEventos(){
			try {
				$eventos = $this->getMapper()->getEventos();
				return $this->sendResponse($eventos, 200, "OK");
			} catch (Exception $e) {
				return $this->sendResponse([], 500, "Ocorreu um erro: ".$e->getMessage());
			}
		}
		
		public function getEventoById($id){
			try {
				$evento = $this->getMapper()->getEventoById($id);
				return $this->sendResponse($evento, 200, "OK");
			} catch (Exception $e) {
				return $this->sendResponse([], 500, "Ocorreu um erro: ".$e->getMessage());
			}
		}
		
		public function saveEvento($data){
			try {
				$evento = new Evento($data);
				$retorno = $this->getMapper()->save($evento);
				return $this->sendResponse($retorno, 203, "OK");
			} catch (Exception $e) {
				return $this->sendResponse([], 500, "Ocorreu um erro: ".$e->getMessage());
			}
		}
	}
?>