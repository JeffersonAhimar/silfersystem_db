<?php

class s_registroBean
{
    // 7 atributes
    private $idRegistro;
    private $fecha;
    private $fec_buena_pro;
    private $fec_consentimiento;
    private $fec_perfeccionamiento;
    private $link;
    private $idServicio;


    /**
     * Get the value of idRegistro
     */
    public function getIdRegistro()
    {
        return $this->idRegistro;
    }

    /**
     * Set the value of idRegistro
     *
     * @return  self
     */
    public function setIdRegistro($idRegistro)
    {
        $this->idRegistro = $idRegistro;

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
     * Get the value of fec_buena_pro
     */
    public function getFec_buena_pro()
    {
        return $this->fec_buena_pro;
    }

    /**
     * Set the value of fec_buena_pro
     *
     * @return  self
     */
    public function setFec_buena_pro($fec_buena_pro)
    {
        $this->fec_buena_pro = $fec_buena_pro;

        return $this;
    }

    /**
     * Get the value of fec_consentimiento
     */
    public function getFec_consentimiento()
    {
        return $this->fec_consentimiento;
    }

    /**
     * Set the value of fec_consentimiento
     *
     * @return  self
     */
    public function setFec_consentimiento($fec_consentimiento)
    {
        $this->fec_consentimiento = $fec_consentimiento;

        return $this;
    }

    /**
     * Get the value of fec_perfeccionamiento
     */
    public function getFec_perfeccionamiento()
    {
        return $this->fec_perfeccionamiento;
    }

    /**
     * Set the value of fec_perfeccionamiento
     *
     * @return  self
     */
    public function setFec_perfeccionamiento($fec_perfeccionamiento)
    {
        $this->fec_perfeccionamiento = $fec_perfeccionamiento;

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
