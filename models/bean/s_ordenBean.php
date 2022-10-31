<?php

class s_ordenBean
{
    // 7 atributes

    private $idOrden;
    private $numero;
    private $fec_emision;
    private $monto;
    private $numero_siaf;
    private $link;
    private $idServicio;


    /**
     * Get the value of idOrden
     */
    public function getIdOrden()
    {
        return $this->idOrden;
    }

    /**
     * Set the value of idOrden
     *
     * @return  self
     */
    public function setIdOrden($idOrden)
    {
        $this->idOrden = $idOrden;

        return $this;
    }

    /**
     * Get the value of numero
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     *
     * @return  self
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get the value of fec_emision
     */
    public function getFec_emision()
    {
        return $this->fec_emision;
    }

    /**
     * Set the value of fec_emision
     *
     * @return  self
     */
    public function setFec_emision($fec_emision)
    {
        $this->fec_emision = $fec_emision;

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
     * Get the value of numero_siaf
     */
    public function getNumero_siaf()
    {
        return $this->numero_siaf;
    }

    /**
     * Set the value of numero_siaf
     *
     * @return  self
     */
    public function setNumero_siaf($numero_siaf)
    {
        $this->numero_siaf = $numero_siaf;

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
}
