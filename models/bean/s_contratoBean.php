<?php

class s_contratoBean
{
    // 5 atributes

    private $idContrato;
    private $numero;
    private $fec_ejecucion;
    private $link;
    private $idServicio;

    /**
     * Get the value of idContrato
     */
    public function getIdContrato()
    {
        return $this->idContrato;
    }

    /**
     * Set the value of idContrato
     *
     * @return  self
     */
    public function setIdContrato($idContrato)
    {
        $this->idContrato = $idContrato;

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
     * Get the value of fec_ejecucion
     */
    public function getFec_ejecucion()
    {
        return $this->fec_ejecucion;
    }

    /**
     * Set the value of fec_ejecucion
     *
     * @return  self
     */
    public function setFec_ejecucion($fec_ejecucion)
    {
        $this->fec_ejecucion = $fec_ejecucion;

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
