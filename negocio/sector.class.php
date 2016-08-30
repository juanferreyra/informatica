<?php

class Sector {
    var $id;
    var $detalle;
    var $hospital;

    public function Sector() {

    }

    public function setId($id){
        $this->id = $id;
    }

    public function setDetalle($detalle){
        $this->detalle = $detalle;
    }

    public function setHospital($detalle)
    {
        $this->hospital = $detalle;
    }

    public function getId(){
        return $this->id;
    }

    public function getDetalle(){
        return $this->detalle;
    }

    public function getHospital()
    {
        return $this->hospital;
    }
}