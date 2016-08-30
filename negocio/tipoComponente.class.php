<?php

class TipoComponente {
    var $id;
    var $detalle;

    public function TipoComponente() {

    }

    public function setId($id){
        $this->id = $id;
    }

    public function setDetalle($detalle){
        $this->detalle = $detalle;
    }

    public function getId(){
        return $this->id;
    }

    public function getDetalle(){
        return $this->detalle;
    }
}