<?php
class EventosMapper extends Mapper
{
    public function getEventos() {
        $sql = "SELECT e.id, e.descricao, e.valor, e.tipo_pagamento, e.pagante, e.data
            from eventos e ";
        $stmt = $this->db->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = new Evento($row);
        }
        return $results;
    }
    /**
     * Get one ticket by its ID
     *
     * @param int $ticket_id The ID of the ticket
     * @return TicketEntity  The ticket
     */
    public function getEventoById($evento_id) {
        $sql = "SELECT e.id, e.descricao, e.valor, e.tipo_pagamento, e.pagante, e.data
            from eventos e
            where e.id = :evento_id";
        $stmt = $this->db->prepare($sql);
		$result = $stmt->execute(["evento_id" => $evento_id]);
        if($stmt->rowCount()>0) {
            return new Evento($stmt->fetch());
        }else{
			return null;
		}
    }
    public function save(Evento $evento) {
		//try{
			$sql = "insert into eventos
				(descricao, valor, tipo_pagamento, pagante, data) values
				(:descricao, :valor, :tipo_pagamento, :pagante, :data)";
			$stmt = $this->db->prepare($sql);
			$result = $stmt->execute([
				"descricao"      => $evento->getDescricao(),
				"valor"          => $evento->getValor(),
				"tipo_pagamento" => $evento->getTipoPagamento(),
				"pagante"        => $evento->getPagante(),
				"data"           => $evento->getData()
			]);
			
			return "o";
			
			return $result;
		/*}catch(Exception $e){
		}*/
    }
}