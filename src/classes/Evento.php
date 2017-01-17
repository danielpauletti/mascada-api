<?php
class Evento
{
    public $id;
    public $descricao;
	public $valor;
	public $tipo_pagamento;
	public $pagante;
	public $data;
    
	public function __construct(array $data) {
        // no id if we're creating
        if(isset($data['id'])) {
            $this->id = $data['id'];
        }
        $this->descricao = $data['descricao'];
		$this->valor = $data['valor'];
		$this->tipo_pagamento = $data['tipo_pagamento'];
		$this->pagante = $data['pagante'];
		$this->data = $data['data'];
    }
	
    public function getId() {
        return $this->id;
    }
	
    public function getDescricao() {
        return $this->descricao;
    }
	
	public function getValor() {
        return $this->valor;
    }
	
	public function getTipoPagamento() {
        return $this->tipo_pagamento;
    }
	
	public function getPagante() {
        return $this->pagante;
    }
	
	public function getData() {
        return $this->data;
    }
}