<?php


namespace MercadoUnico\MuService\Models;


class Corredor
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
    protected $email;

    /**
     * @var string
     */
    protected $matricula;

    /**
     * @var string
     */
    protected $descripcion;

    /**
     * @var string
     */
    protected $fotografia;

    /**
     * @var string
     */
    protected $telefono;

    /**
     * @var string
     */
    protected $celular;

    /**
     * @var string
     */
    protected $domicilio;

    /**
     * @var string
     */
    protected $ciudadId;

    /**
     * @var string
     */
    protected $inmobiliariaId;

    /**
     * @var bool
     */
    protected $telefonosPublicos;

    /**
     * Corredor constructor.
     * @param string $id
     * @param string $nombre
     * @param string $email
     * @param string $matricula
     * @param string $descripcion
     * @param string $fotografia
     * @param string $telefono
     * @param string $celular
     * @param string $domicilio
     * @param string $ciudadId
     * @param string $inmobiliariaId
     * @param bool $telefonosPublicos
     */
    public function __construct(?string $id, ?string $nombre, ?string $email, ?string $matricula, ?string $descripcion, ?string $fotografia, ?string $telefono, ?string $celular, ?string $domicilio, ?string $ciudadId, ?string $inmobiliariaId, ?bool $telefonosPublicos)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->matricula = $matricula;
        $this->descripcion = $descripcion;
        $this->fotografia = $fotografia;
        $this->telefono = $telefono;
        $this->celular = $celular;
        $this->domicilio = $domicilio;
        $this->ciudadId = $ciudadId;
        $this->inmobiliariaId = $inmobiliariaId;
        $this->telefonosPublicos = $telefonosPublicos;
    }


    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Corredor
     */
    public function setId(string $id): Corredor
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     * @return Corredor
     */
    public function setNombre(string $nombre): Corredor
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Corredor
     */
    public function setEmail(string $email): Corredor
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getMatricula(): ?string
    {
        return $this->matricula;
    }

    /**
     * @param string $matricula
     * @return Corredor
     */
    public function setMatricula(string $matricula): Corredor
    {
        $this->matricula = $matricula;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    /**
     * @param string $descripcion
     * @return Corredor
     */
    public function setDescripcion(string $descripcion): Corredor
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    /**
     * @return string
     */
    public function getFotografia(): ?string
    {
        return $this->fotografia;
    }

    /**
     * @param string $fotografia
     * @return Corredor
     */
    public function setFotografia(string $fotografia): Corredor
    {
        $this->fotografia = $fotografia;
        return $this;
    }

    /**
     * @return string
     */
    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    /**
     * @param string $telefono
     * @return Corredor
     */
    public function setTelefono(string $telefono): Corredor
    {
        $this->telefono = $telefono;
        return $this;
    }

    /**
     * @return string
     */
    public function getCelular(): ?string
    {
        return $this->celular;
    }

    /**
     * @param string $celular
     * @return Corredor
     */
    public function setCelular(string $celular): Corredor
    {
        $this->celular = $celular;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomicilio(): ?string
    {
        return $this->domicilio;
    }

    /**
     * @param string $domicilio
     * @return Corredor
     */
    public function setDomicilio(string $domicilio): Corredor
    {
        $this->domicilio = $domicilio;
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
     * @return Corredor
     */
    public function setCiudadId(string $ciudadId): Corredor
    {
        $this->ciudadId = $ciudadId;
        return $this;
    }

    /**
     * @return string
     */
    public function getInmobiliariaId(): ?string
    {
        return $this->inmobiliariaId;
    }

    /**
     * @param string $inmobiliariaId
     * @return Corredor
     */
    public function setInmobiliariaId(string $inmobiliariaId): Corredor
    {
        $this->inmobiliariaId = $inmobiliariaId;
        return $this;
    }

    /**
     * @return bool
     */
    public function isTelefonosPublicos(): bool
    {
        return $this->telefonosPublicos;
    }

    /**
     * @param bool $telefonosPublicos
     * @return Corredor
     */
    public function setTelefonosPublicos(bool $telefonosPublicos): Corredor
    {
        $this->telefonosPublicos = $telefonosPublicos;
        return $this;
    }

    public function __toString()
    {
        return $this->nombre;
    }

}

