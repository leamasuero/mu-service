<?php

namespace MercadoUnico\MuService\Models;

use DateTime;

class Propiedad
{
    // SCOPE
    // []: solo la ve la inmobiliaria
    // ['mu:corredores:main']: la ven todos los corredores
    // ['mu:publico', 'mu:corredores:main']: visible por todos
    const SCOPE_PUBLICO = 'mu:publico';
    const SCOPE_CORREDORES = 'mu:corredores:main';

    /**
     * @var string
     */
    protected ?string $id;

    /**
     * @var string
     */
    protected ?string $codigo;

    /**
     * @var string
     */
    protected ?string $direccion;

    /**
     * @var string
     */
    protected ?string $descripcion;

    protected ?Ciudad $ciudad;
    /**
     * @var ?Importe
     */
    protected ?Importe $precioVenta;

    /**
     * @var ?Importe
     */
    protected ?Importe $precioAlquiler;

    /**
     * @var TipoPropiedad
     */
    protected ?TipoPropiedad $tipoPropiedad;

    /**
     * @var int
     */
    protected ?int $banos = null;

    /**
     * @var int
     */
    protected ?int $dormitorios = null;


    protected int $porcentajeCompartido;

    protected int $estado;

    /**
     * @var array
     */
    protected array $scopes;

    /**
     * @var string
     */
    protected ?string $observaciones;

    protected ?string $observacionesPrivadas;

    /**
     * @var string
     */
    protected ?string $documentacion = null;

    /**
     * @var string
     */
    protected ?string $nroPartidaInmobiliaria = null;

    /**
     * @var bool
     */
    protected $ofertaColectiva;

    /**
     * @var array<Operacion>
     */
    protected array $operaciones;

    /**
     * @var array
     */
    protected array $imagenes;

    /**
     * @var array
     */
    protected array $panoramicas;

    /**
     * @var array
     */
    protected array $videos;


    /**
     * @var array
     */
    protected array $reportes;

    /**
     * @var string
     */
    protected ?string $ocultaComment;

    /**
     * @var bool
     */
    protected bool $aptaCredito;

    /**
     * @var bool $condicionada : Venta supeditada a la compra simultanea de otra propiedad.
     *
     */
    protected bool $condicionada;

    /**
     * @var bool
     */
    protected bool $destacada;

    /**
     * @var bool
     */
    protected bool $cochera;

    /**
     * @var bool
     */
    protected bool $cartel;

    /**
     * @var Inmobiliaria
     */
    protected ?Inmobiliaria $inmobiliaria;

    /**
     * @var Corredor
     */
    protected ?Corredor $corredor;

    /**
     * @var array
     */
    protected array $documentos;

    /**
     * @var array<Caracteristica> $documentacionDisponible : plano de mensura, plano de edificacion, escritura traslativa de dominio
     */
    protected array $documentacionDisponible;

    /**
     * @var array<Caracteristica> $servicios : gas natural, electricidad, cloacas, etc
     */
    protected array $servicios;

    /**
     * @var array<Caracteristica> $adicionales : patio, pileta, terraza, balcon, etc
     */
    protected array $adicionales;

    /**
     * @var string
     */
    protected string $slug;

    protected ?int $ancho = null;

    protected ?int $largo = null;

    protected ?int $superficie = null;

    protected ?int $superficieCubierta = null;

    protected ?int $superficieSemicubierta = null;

    protected ?int $antiguedad = null;

    protected ?string $latitud;

    protected ?string $longitud;

    protected ?\DateTimeInterface $ocultadaAt;

    protected ?\DateTimeInterface $createdAt;

    protected ?\DateTimeInterface $updatedAt;

    /**
     * @var string
     */
    private $baseUrl;

    public function __construct($direccion = null)
    {
        $this->direccion = $direccion;
        $this->estado = 1;
        $this->scopes = [];

        $this->cochera = false;
        $this->cartel = false;
        $this->aptaCredito = false;
        $this->condicionada = false;
        $this->destacada = false;

        $this->operaciones = [];
        $this->servicios = [];
        $this->adicionales = [];
        $this->documentacionDisponible = [];

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

    public function getCartel(): bool
    {
        return $this->cartel;
    }

    public function setCartel(bool $cartel): Propiedad
    {
        $this->cartel = $cartel;
        return $this;
    }

    public function isAptaCredito(): bool
    {
        return $this->aptaCredito;
    }

    public function setAptaCredito(bool $aptaCredito): Propiedad
    {
        $this->aptaCredito = $aptaCredito;
        return $this;
    }

    public function isCondicionada(): bool
    {
        return $this->condicionada;
    }

    public function setCondicionada(bool $condicionada): Propiedad
    {
        $this->condicionada = $condicionada;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getObservaciones(): ?string
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

    public function getObservacionesPrivadas(): ?string
    {
        return $this->observacionesPrivadas;
    }

    public function setObservacionesPrivadas(?string $observacionesPrivadas): Propiedad
    {
        $this->observacionesPrivadas = $observacionesPrivadas;
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
     * @return array<Operacion>
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
     * @return DateTime|null
     */
    public function getOcultadaAt(): ?DateTime
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
     * @return string|null
     */
    public function getOcultaComment(): ?string
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
     * @param array<Caracteristica> $documentacionDisponible
     * @return Propiedad
     */
    public function setDocumentacionDisponible(array $documentacionDisponible): Propiedad
    {
        $this->documentacionDisponible = $documentacionDisponible;
        return $this;
    }

    public function addDocumentacionDisponible(Caracteristica $documentacion): Propiedad
    {
        $this->documentacionDisponible[] = $documentacion;
        return $this;
    }


    /**
     * @return array<Servicio>
     */
    public function getServicios(): array
    {
        return $this->servicios;
    }

    /**
     * @param array<Caracteristica> $servicios
     * @return Propiedad
     */
    public function setServicios(array $servicios): Propiedad
    {
        $this->servicios = $servicios;
        return $this;
    }

    public function addServicio(Caracteristica $servicio): Propiedad
    {
        $this->servicios[] = $servicio;
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
     * @param array<Caracteristica> $adicionales
     * @return Propiedad
     */
    public function setAdicionales(array $adicionales): Propiedad
    {
        $this->adicionales = $adicionales;
        return $this;
    }

    public function addAdicional(Caracteristica $adicional): Propiedad
    {
        $this->adicionales[] = $adicional;
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
     * @return array
     */
    public function getTerreno(): array
    {
        return [
            'ancho' => $this->getAncho(),
            'largo' => $this->getLargo(),
            'superficie' => $this->getSuperficie(),
        ];
    }

    public function getAncho(): ?int
    {
        return $this->ancho;
    }

    public function setAncho(?int $ancho): Propiedad
    {
        $this->ancho = $ancho;
        return $this;
    }

    public function getLargo(): ?int
    {
        return $this->largo;
    }

    public function setLargo(?int $largo): Propiedad
    {
        $this->largo = $largo;
        return $this;
    }

    public function getSuperficie(): ?int
    {
        return $this->superficie;
    }

    public function setSuperficie(?int $superficie): Propiedad
    {
        $this->superficie = $superficie;
        return $this;
    }

    /**
     * @return int
     */
    public function getSuperficieCubierta(): ?int
    {
        return $this->superficieCubierta;
    }

    /**
     * @param int $superficieCubierta
     * @return Propiedad
     */
    public function setSuperficieCubierta(?int $superficieCubierta): Propiedad
    {
        $this->superficieCubierta = $superficieCubierta;
        return $this;
    }

    public function getSuperficieSemicubierta(): ?int
    {
        return $this->superficieSemicubierta;
    }

    public function setSuperficieSemicubierta(?int $superficieSemicubierta): Propiedad
    {
        $this->superficieSemicubierta = $superficieSemicubierta;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getAntiguedad(): ?int
    {
        return $this->antiguedad;
    }

    /**
     * @param int|null $antiguedad
     * @return Propiedad
     */
    public function setAntiguedad(?int $antiguedad): Propiedad
    {
        $this->antiguedad = $antiguedad;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDocumentacion(): ?string
    {
        return $this->documentacion;
    }

    /**
     * @param string $documentacion
     * @return Propiedad
     */
    public function setDocumentacion(?string $documentacion): Propiedad
    {
        $this->documentacion = $documentacion;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNroPartidaInmobiliaria(): ?string
    {
        return $this->nroPartidaInmobiliaria;
    }

    /**
     * @param string|null $nroPartidaInmobiliaria
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
        $precios = [];
        if ($this->getPrecioVenta()) {
            $precios['venta'] = $this->getPrecioVenta()->toArray();
        }

        if ($this->getPrecioAlquiler()) {
            $precios['alquiler'] = $this->getPrecioAlquiler()->toArray();
            $precios['alquiler']['porcentajeCompartido'] = $this->getPorcentajeCompartido();
        }

        return $precios;
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
        $this->scopes = self::filtrarScopes($scopes);
        return $this;
    }

    public static function filtrarScopes(array $scopes): array
    {
        return array_filter($scopes, function ($s) {
            return in_array($s, [self::SCOPE_PUBLICO, self::SCOPE_CORREDORES], true);
        });
    }

    public function addScope(string $scope): Propiedad
    {
        $scopes = self::filtrarScopes([$scope]);
        if (count($scopes)) {
            $this->scopes[] = $scopes[0];
        }

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
     * @return string|null
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
     * @return string|null
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

    public function setPrecioVenta(Importe $importe): Propiedad
    {
        $this->precioVenta = $importe;
        return $this;
    }

    public function setPrecioAlquiler(Importe $importe, ?int $porcentajeCompartido = null): Propiedad
    {
        $this->precioAlquiler = $importe;
        $this->porcentajeCompartido = $porcentajeCompartido ?? 0;
        return $this;
    }

    public function getPrecioVenta(): ?Importe
    {
        return $this->precioVenta;
    }

    public function getPrecioAlquiler(): ?Importe
    {
        return $this->precioAlquiler;
    }

    public function getPorcentajeCompartido(): int
    {
        return $this->porcentajeCompartido;
    }


    public function __toString()
    {
        return sprintf('%s, %s', $this->getDireccion(), $this->getCiudad()->getNombre());
    }
}
