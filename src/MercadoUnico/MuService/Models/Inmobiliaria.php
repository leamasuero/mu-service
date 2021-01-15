<?php

namespace MercadoUnico\MuService\Models;

class Inmobiliaria
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $nombre;

    /**
     * @var string
     */
    protected $ciudadId;

    /**
     * @var string
     */
    protected $domicilio;

    /**
     * @var string
     */
    protected $telefono;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $logo;

    /**
     * @var string
     */
    protected $sitioWeb;

    /**
     * @var string
     */
    protected $whatsapp;

    /**
     * Inmobiliaria constructor.
     * @param string $id
     * @param string $nombre
     * @param string $ciudadId
     * @param string $domicilio
     * @param string $telefono
     * @param string $email
     * @param string $logo
     * @param string $sitioWeb
     * @param string $whatsapp
     */
    public function __construct(string $id, string $nombre, ?string $ciudadId, ?string $domicilio, ?string $telefono, ?string $email, ?string $logo, ?string $sitioWeb, ?string $whatsapp)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->ciudadId = $ciudadId;
        $this->domicilio = $domicilio;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->logo = $logo;
        $this->sitioWeb = $sitioWeb;
        $this->whatsapp = $whatsapp;
    }


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Inmobiliaria
     */
    public function setId(string $id): Inmobiliaria
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     * @return Inmobiliaria
     */
    public function setNombre(string $nombre): Inmobiliaria
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return string
     */
    public function getCiudadId(): string
    {
        return $this->ciudadId;
    }

    /**
     * @param string $ciudadId
     * @return Inmobiliaria
     */
    public function setCiudadId(string $ciudadId): Inmobiliaria
    {
        $this->ciudadId = $ciudadId;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomicilio(): string
    {
        return $this->domicilio;
    }

    /**
     * @param string $domicilio
     * @return Inmobiliaria
     */
    public function setDomicilio(string $domicilio): Inmobiliaria
    {
        $this->domicilio = $domicilio;
        return $this;
    }

    /**
     * @return string
     */
    public function getTelefono(): string
    {
        return $this->telefono;
    }

    /**
     * @param string $telefono
     * @return Inmobiliaria
     */
    public function setTelefono(string $telefono): Inmobiliaria
    {
        $this->telefono = $telefono;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Inmobiliaria
     */
    public function setEmail(string $email): Inmobiliaria
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogo(): string
    {
        return $this->logo;
    }

    /**
     * @param string $logo
     * @return Inmobiliaria
     */
    public function setLogo(string $logo): Inmobiliaria
    {
        $this->logo = $logo;
        return $this;
    }

    /**
     * @return string
     */
    public function getSitioWeb(): string
    {
        return $this->sitioWeb;
    }

    /**
     * @param string $sitioWeb
     * @return Inmobiliaria
     */
    public function setSitioWeb(string $sitioWeb): Inmobiliaria
    {
        $this->sitioWeb = $sitioWeb;
        return $this;
    }

    /**
     * @return string
     */
    public function getWhatsapp(): string
    {
        return $this->whatsapp;
    }

    /**
     * @param string $whatsapp
     * @return Inmobiliaria
     */
    public function setWhatsapp(string $whatsapp): Inmobiliaria
    {
        $this->whatsapp = $whatsapp;
        return $this;
    }

}