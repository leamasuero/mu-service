<?php

namespace MercadoUnico\MuService\Models;

use DateTime;

class Propiedad
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $codigo;

    /**
     * @var string
     */
    protected $direccion;

    /**
     * @var string
     */
    protected $descripcion;

    /**
     * @var Ciudad
     */
    protected $ciudad;

    /**
     * @var TipoPropiedad
     */
    protected $tipoPropiedad;

    /**
     * @var int
     */
    protected $banos;

    /**
     * @var int
     */
    protected $dormitorios;

    /**
     * @var bool
     */
    protected $cochera;

    /**
     * @var array
     */
    protected $precio;

    /**
     * @var array
     */
    protected $terreno;

    /**
     * @var array
     */
    protected $scopes;

    /**
     * @var string
     */
    protected $observaciones;

    /**
     * @var string
     */
    protected $documentacion;

    /**
     * @var string
     */
    protected $nroPartidaInmobiliaria;

    /**
     * @var bool
     */
    protected $ofertaColectiva;

    /**
     * @var array
     */
    protected $operaciones;

    /**
     * @var array
     */
    protected $imagenes;

    /**
     * @var array
     */
    protected $panoramicas;

    /**
     * @var array
     */
    protected $videos;

    /**
     * @var bool
     */
    protected $destacada;

    /**
     * @var int
     */
    protected $estado;

    /**
     * @var \DateTime
     */
    protected $ocultadaAt;
    /**
     * @var array
     */
    protected $reportes;

    /**
     * @var string
     */
    protected $ocultaComment;

    /**
     * @var Inmobiliaria
     */
    protected $inmobiliaria;

    /**
     * @var Corredor
     */
    protected $corredor;

    /**
     * @var array
     */
    protected $documentos;

    /**
     * @var array
     */
    protected $documentacionDisponible;

    /**
     * @var array
     */
    protected $servicios;

    /**
     * @var array
     */
    protected $adicionales;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var float
     */
    protected $superficieCubierta;

    /**
     * @var int
     */
    protected $antiguedad;

    /**
     * @var string
     */
    protected $latitud;

    /**
     * @var string
     */
    protected $longitud;

    /**
     * @var DateTime
     * */
    protected $createdAt;

    /**
     * @var DateTime
     * */
    protected $updatedAt;

    /**
     * @var string
     */
    private $baseUrl;

    public function __construct($direccion = null)
    {
        $this->banos = null;
        $this->cochera = null;
        $this->dormitorios = null;
        $this->operaciones = [];
        $this->direccion = $direccion;
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
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
     * @return Propiedad
     */
    public function setId(string $id): Propiedad
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    /**
     * @param string $direccion
     * @return Propiedad
     */
    public function setDireccion(string $direccion): Propiedad
    {
        $this->direccion = $direccion;
        return $this;
    }

    /**
     * @return Ciudad
     */
    public function getCiudad(): ?Ciudad
    {
        return $this->ciudad;
    }

    /**
     * @param Ciudad $ciudad
     * @return Propiedad
     */
    public function setCiudad(Ciudad $ciudad): Propiedad
    {
        $this->ciudad = $ciudad;
        return $this;
    }


    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }


    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     * @return Propiedad
     */
    public function setUpdatedAt(DateTime $updatedAt): Propiedad
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    /**
     * @param string $descripcion
     * @return Propiedad
     */
    public function setDescripcion(string $descripcion): Propiedad
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    /**
     * @return TipoPropiedad
     */
    public function getTipoPropiedad(): ?TipoPropiedad
    {
        return $this->tipoPropiedad;
    }

    /**
     * @param TipoPropiedad $tipoPropiedad
     * @return Propiedad
     */
    public function setTipoPropiedad(TipoPropiedad $tipoPropiedad): Propiedad
    {
        $this->tipoPropiedad = $tipoPropiedad;
        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->getId() ? sprintf('%s/propiedades/%s', $this->baseUrl, $this->getId()) : null;
    }

    /**
     * @return string
     */
    public function getCodigo(): string
    {
        return $this->codigo;
    }

    /**
     * @param string $codigo
     * @return Propiedad
     */
    public function setCodigo(string $codigo): Propiedad
    {
        $this->codigo = $codigo;
        return $this;
    }

    /**
     * @param DateTime $createdAt
     * @return Propiedad
     */
    public function setCreatedAt(DateTime $createdAt): Propiedad
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return int
     */
    public function getBanos(): ?int
    {
        return $this->banos;
    }

    /**
     * @param int $banos
     * @return Propiedad
     */
    public function setBanos(?int $banos): Propiedad
    {
        $this->banos = $banos;
        return $this;
    }

    /**
     * @return int
     */
    public function getDormitorios(): ?int
    {
        return $this->dormitorios;
    }

    /**
     * @param int $dormitorios
     * @return Propiedad
     */
    public function setDormitorios(?int $dormitorios): Propiedad
    {
        $this->dormitorios = $dormitorios;
        return $this;
    }

    /**
     * @return bool
     */
    public function getCochera(): ?bool
    {
        return $this->cochera;
    }

    /**
     * @param bool $cochera
     * @return Propiedad
     */
    public function setCochera(?bool $cochera): Propiedad
    {
        $this->cochera = $cochera;
        return $this;
    }

    /**
     * @return string
     */
    public function getObservaciones(): string
    {
        return $this->observaciones;
    }

    /**
     * @param string $observaciones
     * @return Propiedad
     */
    public function setObservaciones(string $observaciones): Propiedad
    {
        $this->observaciones = $observaciones;
        return $this;
    }

    /**
     * @return bool
     */
    public function isOfertaColectiva(): bool
    {
        return $this->ofertaColectiva;
    }

    /**
     * @param bool $ofertaColectiva
     * @return Propiedad
     */
    public function setOfertaColectiva(bool $ofertaColectiva): Propiedad
    {
        $this->ofertaColectiva = $ofertaColectiva;
        return $this;
    }

    /**
     * @return array
     */
    public function getOperaciones(): array
    {
        return $this->operaciones;
    }

    /**
     * @param Operacion $operacion
     * @return Propiedad
     */
    public function addOperacion(Operacion $operacion): Propiedad
    {
        $this->operaciones[] = $operacion;
        return $this;
    }

    /**
     * @return array
     */
    public function getImagenes(): array
    {
        return $this->imagenes;
    }

    /**
     * @param array $imagenes
     * @return Propiedad
     */
    public function setImagenes(array $imagenes): Propiedad
    {
        $this->imagenes = $imagenes;
        return $this;
    }

    /**
     * @return array
     */
    public function getPanoramicas(): array
    {
        return $this->panoramicas;
    }

    /**
     * @param array $panoramicas
     * @return Propiedad
     */
    public function setPanoramicas(array $panoramicas): Propiedad
    {
        $this->panoramicas = $panoramicas;
        return $this;
    }

    /**
     * @return array
     */
    public function getVideos(): array
    {
        return $this->videos;
    }

    /**
     * @param array $videos
     * @return Propiedad
     */
    public function setVideos(array $videos): Propiedad
    {
        $this->videos = $videos;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDestacada(): bool
    {
        return $this->destacada;
    }

    /**
     * @param bool $destacada
     * @return Propiedad
     */
    public function setDestacada(bool $destacada): Propiedad
    {
        $this->destacada = $destacada;
        return $this;
    }

    /**
     * @return int
     */
    public function getEstado(): int
    {
        return $this->estado;
    }

    /**
     * @param int $estado
     * @return Propiedad
     */
    public function setEstado(int $estado): Propiedad
    {
        $this->estado = $estado;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getOcultadaAt(): DateTime
    {
        return $this->ocultadaAt;
    }

    /**
     * @param DateTime $ocultadaAt
     * @return Propiedad
     */
    public function setOcultadaAt(?DateTime $ocultadaAt): Propiedad
    {
        $this->ocultadaAt = $ocultadaAt;
        return $this;
    }

    /**
     * @return array
     */
    public function getReportes(): array
    {
        return $this->reportes;
    }

    /**
     * @param array $reportes
     * @return Propiedad
     */
    public function setReportes(array $reportes): Propiedad
    {
        $this->reportes = $reportes;
        return $this;
    }

    /**
     * @return string
     */
    public function getOcultaComment(): string
    {
        return $this->ocultaComment;
    }

    /**
     * @param string $ocultaComment
     * @return Propiedad
     */
    public function setOcultaComment(string $ocultaComment): Propiedad
    {
        $this->ocultaComment = $ocultaComment;
        return $this;
    }

    /**
     * @return Inmobiliaria
     */
    public function getInmobiliaria(): Inmobiliaria
    {
        return $this->inmobiliaria;
    }

    /**
     * @param Inmobiliaria $inmobiliaria
     * @return Propiedad
     */
    public function setInmobiliaria(Inmobiliaria $inmobiliaria): Propiedad
    {
        $this->inmobiliaria = $inmobiliaria;
        return $this;
    }

    /**
     * @return Corredor
     */
    public function getCorredor(): Corredor
    {
        return $this->corredor;
    }

    /**
     * @param Corredor $corredor
     * @return Propiedad
     */
    public function setCorredor(Corredor $corredor): Propiedad
    {
        $this->corredor = $corredor;
        return $this;
    }

    /**
     * @return array
     */
    public function getDocumentos(): array
    {
        return $this->documentos;
    }

    /**
     * @param array $documentos
     * @return Propiedad
     */
    public function setDocumentos(array $documentos): Propiedad
    {
        $this->documentos = $documentos;
        return $this;
    }

    /**
     * @return array
     */
    public function getDocumentacionDisponible(): array
    {
        return $this->documentacionDisponible;
    }

    /**
     * @param array $documentacionDisponible
     * @return Propiedad
     */
    public function setDocumentacionDisponible(array $documentacionDisponible): Propiedad
    {
        $this->documentacionDisponible = $documentacionDisponible;
        return $this;
    }

    /**
     * @return array
     */
    public function getServicios(): array
    {
        return $this->servicios;
    }

    /**
     * @param array $servicios
     * @return Propiedad
     */
    public function setServicios(array $servicios): Propiedad
    {
        $this->servicios = $servicios;
        return $this;
    }

    /**
     * @return array
     */
    public function getAdicionales(): array
    {
        return $this->adicionales;
    }

    /**
     * @param array $adicionales
     * @return Propiedad
     */
    public function setAdicionales(array $adicionales): Propiedad
    {
        $this->adicionales = $adicionales;
        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return Propiedad
     */
    public function setSlug(string $slug): Propiedad
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return float
     */
    public function getSuperficieCubierta(): ?float
    {
        return $this->superficieCubierta;
    }

    /**
     * @param float $superficieCubierta
     * @return Propiedad
     */
    public function setSuperficieCubierta(?float $superficieCubierta): Propiedad
    {
        $this->superficieCubierta = $superficieCubierta;
        return $this;
    }

    /**
     * @return int
     */
    public function getAntiguedad(): ?int
    {
        return $this->antiguedad;
    }

    /**
     * @param int $antiguedad
     * @return Propiedad
     */
    public function setAntiguedad(?int $antiguedad): Propiedad
    {
        $this->antiguedad = $antiguedad;
        return $this;
    }

    /**
     * @return string
     */
    public function getDocumentacion(): string
    {
        return $this->documentacion;
    }

    /**
     * @param string $documentacion
     * @return Propiedad
     */
    public function setDocumentacion(string $documentacion): Propiedad
    {
        $this->documentacion = $documentacion;
        return $this;
    }

    /**
     * @return string
     */
    public function getNroPartidaInmobiliaria(): string
    {
        return $this->nroPartidaInmobiliaria;
    }

    /**
     * @param string $nroPartidaInmobiliaria
     * @return Propiedad
     */
    public function setNroPartidaInmobiliaria(?string $nroPartidaInmobiliaria): Propiedad
    {
        $this->nroPartidaInmobiliaria = $nroPartidaInmobiliaria;
        return $this;
    }


    public function getDenominacion(): string
    {
        return sprintf('%s en %s', $this->getTipoPropiedad(), implode(',', $this->getOperaciones()));
    }

    /**
     * @return array
     */
    public function getPrecio(): array
    {
        return $this->precio;
    }

    /**
     * @param array $precio
     * @return Propiedad
     */
    public function setPrecio(array $precio): Propiedad
    {
        $this->precio = $precio;
        return $this;
    }

    /**
     * @return array
     */
    public function getTerreno(): array
    {
        return $this->terreno;
    }

    /**
     * @param array $terreno
     * @return Propiedad
     */
    public function setTerreno(array $terreno): Propiedad
    {
        $this->terreno = $terreno;
        return $this;
    }

    /**
     * @return array
     */
    public function getScopes(): array
    {
        return $this->scopes;
    }

    /**
     * @param array $scopes
     * @return Propiedad
     */
    public function setScopes(array $scopes): Propiedad
    {
        $this->scopes = $scopes;
        return $this;
    }

    /**
     * @param string $baseUrl
     * @return Propiedad
     */
    public function setBaseUrl(string $baseUrl): Propiedad
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }

    /**
     * @return string
     */
    private function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * @return string
     */
    public function getLatitud(): ?string
    {
        return $this->latitud;
    }

    /**
     * @param string $latitud
     * @return Propiedad
     */
    public function setLatitud(string $latitud): Propiedad
    {
        $this->latitud = $latitud;
        return $this;
    }

    /**
     * @return string
     */
    public function getLongitud(): ?string
    {
        return $this->longitud;
    }

    /**
     * @param string $longitud
     * @return Propiedad
     */
    public function setLongitud(string $longitud): Propiedad
    {
        $this->longitud = $longitud;
        return $this;
    }

    public function __toString()
    {
        return sprintf('%s, %s', $this->getDireccion(), $this->getCiudad()->getNombre());
    }

}
