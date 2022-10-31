<?php

class servicioBean
{
    // 9 atributes
    private $idServicio;
    private $codigo;
    private $descripcion;
    private $bases;
    private $monto;
    private $moneda;
    private $fecha;
    private $link;
    private $idCliente;

    /**
     * Get the value of idServicio
     */
    public function getIdServicio()
    {
        return $this->idServicio;
    }

    /**
     * Set the value of idServicio
     *
     * @return  self
     */
    public function setIdServicio($idServicio)
    {
        $this->idServicio = $idServicio;

        return $this;
    }

    /**
     * Get the value of codigo
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set the value of codigo
     *
     * @return  self
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get the value of descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of bases
     */
    public function getBases()
    {
        return $this->bases;
    }

    /**
     * Set the value of bases
     *
     * @return  self
     */
    public function setBases($bases)
    {
        $this->bases = $bases;

        return $this;
    }

    /**
     * Get the value of monto
     */
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * Set the value of monto
     *
     * @return  self
     */
    public function setMonto($monto)
    {
        $this->monto = $monto;

        return $this;
    }

    /**
     * Get the value of moneda
     */
    public function getMoneda()
    {
        return $this->moneda;
    }

    /**
     * Set the value of moneda
     *
     * @return  self
     */
    public function setMoneda($moneda)
    {
        $this->moneda = $moneda;

        return $this;
    }

    /**
     * Get the value of fecha
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of link
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set the value of link
     *
     * @return  self
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get the value of idCliente
     */
    public function getIdCliente()
    {
        return $this->idCliente;
    }

    /**
     * Set the value of idCliente
     *
     * @return  self
     */
    public function setIdCliente($idCliente)
    {
        $this->idCliente = $idCliente;

        return $this;
    }
}
