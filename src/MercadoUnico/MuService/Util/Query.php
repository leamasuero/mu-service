<?php

namespace MercadoUnico\MuService\Util;


class Query
{
    const SCOPE_MU_PUBLICO = 'mu:publico';
    const SCOPE_MU_CORREDORES_MAIN = 'mu:corredores:main';

    const MONEDA_USD = 'USD';
    const MONEDA_ARS = '$';

    /**
     * @var string
     */
    protected $alquilerId;

    /**
     * @var string
     */
    protected $compraVentaId;

    /**
     * @var bool|null
     */
    protected ?bool $destacada;

    /**
     * @var array
     */
    protected $inmobiliarias;

    /**
     * @var string
     */
    protected $q;

    /**
     * @var array
     */
    protected $operaciones;

    /**
     * @var array
     */
    protected $scopes;

    /**
     * @var array
     */
    protected $ciudades;

    /**
     * @var array
     */
    protected $tiposPropiedad;

    /**
     * @var int
     */
    protected $dormitorios;

    /**
     * @var bool
     */
    protected $cochera;

    /**
     * @var bool
     */
    protected $aptaCredito;

    /**
     * @var int
     */
    protected $antiguedad;

    /**
     * @var int
     */
    protected $min;

    /**
     * @var int
     */
    protected $max;

    /**
     * @var string|null
     */
    protected $moneda;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var int
     */
    protected $limit;

    /**
     * @var ?int
     */
    protected $skip;

    /**
     * @var ?string
     */
    protected $sortBy;


    /**
     * Query constructor.
     */
    public function __construct(?string $inmobiliaria = null)
    {
        $this->inmobiliarias = $inmobiliaria ? [$inmobiliaria] : [];
        $this->scopes = null; // null es la ausencia de valor; [] es un scope valido
        $this->operaciones = [];
        $this->ciudades = [];
        $this->scopes = [];
        $this->tiposPropiedad = [];
        $this->moneda = '$';

        $this->q = null;
        $this->slug = null;
        $this->dormitorios = null;
        $this->antiguedad = null;
        $this->cochera = null;
        $this->aptaCredito = null;
        $this->destacada = null;
        $this->min = null;
        $this->max = null;

        $this->limit = 20;
        $this->skip = 0;
        $this->sortBy = null;
    }


    public static function create(): self
    {
        return new self();
    }

    /**
     * @param string $inmobiliaria
     * @return Query
     */
    public function inmobiliaria(string $inmobiliaria): self
    {
        $this->inmobiliarias[] = $inmobiliaria;
        return $this;
    }

    /**
     * @param string $q
     * @return Query
     */
    public function q(string $q): self
    {
        $this->q = $q;
        return $this;
    }

    public function slug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @param bool $destacada
     * @return self
     */
    public function destacada(?bool $destacada = true): self
    {
        $this->destacada = $destacada;
        return $this;
    }


    /**
     * @return bool|null
     */
    public function getDestacada(): ?bool
    {
        return $this->destacada;
    }


    /**
     * @param string $operacion
     * @return Query
     */
    public function operacion(string $operacion): self
    {
        $this->operaciones[] = $operacion;
        return $this;
    }

    /**
     * @param string $scope
     * @return Query
     */
    public function scope(string $scope): self
    {
        $this->scopes[] = $scope;
        return $this;
    }

    /**
     * @param array $operaciones
     * @return Query
     */
    public function operaciones(array $operaciones): self
    {
        $this->operaciones = $operaciones;
        return $this;
    }

    /**
     * @param array $scopes
     * @return Query
     */
    public function scopes(array $scopes): self
    {
        $this->scopes = $scopes;
        return $this;
    }

    /**
     * @param string|null $ciudad
     * @return Query
     */
    public function ciudad(?string $ciudad): self
    {
        if ($ciudad) {
            // la ciudad puede ser nula
            $this->ciudades[] = $ciudad;
        }

        return $this;
    }

    /**
     * @param array $ciudades
     * @return Query
     */
    public function ciudades(array $ciudades): self
    {
        $this->ciudades = $ciudades;
        return $this;
    }

    /**
     * @param string $tipoPropiedad
     * @return Query
     */
    public function tipoPropiedad(string $tipoPropiedad): self
    {
        $this->tiposPropiedad[] = $tipoPropiedad;
        return $this;
    }

    /**
     * @param array $tiposPropiedad
     * @return Query
     */
    public function tiposPropiedad(array $tiposPropiedad): self
    {
        $this->tiposPropiedad = $tiposPropiedad;
        return $this;
    }

    /**
     * @param bool|null $cochera
     * @return Query
     */
    public function cochera(?bool $cochera): self
    {
        $this->cochera = $cochera;
        return $this;
    }

    /**
     * @param bool $aptaCredito
     * @return Query
     */
    public function aptaCredito(?bool $aptaCredito): self
    {
        $this->aptaCredito = $aptaCredito;
        return $this;
    }

    /**
     * @param int $limit
     * @return Query
     */
    public function limit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * @param int $min
     * @return Query
     */
    public function min(?int $min): self
    {
        $this->min = $min;
        return $this;
    }

    /**
     * @param int $max
     * @return Query
     */
    public function max(?int $max): self
    {
        $this->max = $max;
        return $this;
    }

    /**
     * @param string $moneda
     * @return Query
     */
    public function moneda(?string $moneda): self
    {
        $this->moneda = $moneda;
        return $this;
    }

    /**
     * @param int|null $antiguedad
     * @return Query
     */
    public function antiguedad(?int $antiguedad): self
    {
        $this->antiguedad = $antiguedad;
        return $this;
    }


    /**
     * @param int|null $dormitorios
     * @return self
     */
    public function dormitorios(?int $dormitorios): self
    {
        $this->dormitorios = $dormitorios;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getAntiguedad(): ?int
    {
        return $this->antiguedad;
    }

    /**
     * @return null|bool
     */
    public function getCochera(): ?bool
    {
        return $this->cochera;
    }

    /**
     * @return null|bool
     */
    public function getAptaCredito(): ?bool
    {
        return $this->aptaCredito;
    }

    /**
     * @return bool
     */
    public function hasOperacionCompraVenta(): bool
    {
        return in_array($this->compraVentaId, $this->operaciones);
    }

    /**
     * @return array
     */
    public function getCiudades(): array
    {
        return $this->ciudades;
    }

    /**
     * @return int|null
     */
    public function getDormitorios(): ?int
    {
        return $this->dormitorios;
    }

    /**
     * @return array|null
     */
    public function getScopes(): ?array
    {
        return $this->scopes;
    }

    public function sortBy(?string $sortBy): self
    {
        $this->sortBy = $sortBy;
        return $this;
    }

    public function skip(int $skip): self
    {
        $this->skip = $skip;
        return $this;
    }

    public function getSkip(): ?int
    {
        return $this->skip;
    }

    public function getAlquilerId(): string
    {
        return $this->alquilerId;
    }

    public function getCompraVentaId(): string
    {
        return $this->compraVentaId;
    }

    public function getInmobiliarias(): array
    {
        return $this->inmobiliarias;
    }

    public function getQ(): ?string
    {
        return $this->q;
    }

    public function getOperaciones(): array
    {
        return $this->operaciones;
    }

    public function getTiposPropiedad(): array
    {
        return $this->tiposPropiedad;
    }

    public function getMin(): ?int
    {
        return $this->min;
    }

    public function getMax(): ?int
    {
        return $this->max;
    }

    public function getMoneda(): ?string
    {
        return $this->moneda;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function getSortBy(): ?string
    {
        return $this->sortBy;
    }

    /**
     * @param string $alquilerId
     * @param string $compraVentaId
     * @return array
     */
    public function toArray(string $alquilerId, string $compraVentaId): array
    {
        $this->alquilerId = $alquilerId;
        $this->compraVentaId = $compraVentaId;

        //Request URL: https://api.mercado-unico.com/propiedades?
        //precio.venta.valor[]=%3E%3D4200000&
        //precio.venta.valor[]=%3C%3D17900000&
        //precio.venta.moneda=$&
        //ubicacion.ciudad=58bac0b35a9f803452303225&
        //dormitorios=%3E%3D2&
        //antiguedad=%3C%3D10&
        //tipoPropiedad[]=58f5563e2a90f5cb1104b49c&
        //tipoPropiedad[]=58f5563d988e744fda7edae3&
        //operaciones[]=58f554cebf61939961ee734c&
        //operaciones[]=58f554bf615347788ff291d2&
        //cochera=true&
        //aptaCredito=true
        //&limit=25
        //&skip=0
        //&source=buscador-web

        //Request URL: https://api.mercado-unico.com/propiedades?precio.alquiler.valor[]=%3E%3D22000&precio.alquiler.valor[]=%3C%3D83000&precio.alquiler.moneda=$&ubicacion.ciudad=58bac0b35a9f803452303225&dormitorios=%3E%3D2&antiguedad=%3C%3D10&tipoPropiedad[]=58f5563e2a90f5cb1104b49c&tipoPropiedad[]=58f5563d988e744fda7edae3&operaciones[]=58f554bf615347788ff291d2&cochera=true&aptaCredito=true&limit=25&skip=0&source=buscador-web

        $precio = [];
        if ($this->min || $this->max) {
            $cotasKey = 'precio.alquiler.valor';
            $monedaKey = 'precio.alquiler.moneda';

            if ($this->hasOperacionCompraVenta()) {
                $cotasKey = 'precio.venta.valor';
                $monedaKey = 'precio.venta.moneda';
            }

            if ($this->min) {
                $precio[$cotasKey] = [
                    ">={$this->min}",
                ];
            }

            if ($this->max) {
                $precio[$cotasKey] = [
                    "<={$this->max}",
                ];
            }

            $precio[$monedaKey] = $this->moneda;
        }


        $query = array_filter(
            array_merge(
                $precio,
                [
                    // todo: cuando busco propiedades ocultas de varias inmobiliarias (utilizando un q), no funciona
                    'inmobiliaria' => count($this->inmobiliarias) == 1 ? $this->inmobiliarias[0] : $this->inmobiliarias,
                    'q' => $this->q,
                    'slug' => $this->slug,
                    'tipoPropiedad' => $this->tiposPropiedad,
                    'operacion' => $this->operaciones,
                    'ubicacion.ciudad' => empty($this->ciudades) ? null : $this->ciudades[0],
                    'cochera' => $this->cochera ? 'true' : null,
                    'destacada' => $this->destacada ? 'true' : null,
                    'dormitorios' => $this->dormitorios,
                    'aptaCredito' => $this->aptaCredito ? 'true' : null,
                    'antiguedad' => $this->antiguedad ? "<={$this->antiguedad}" : null,
                    'orderBy' => $this->sortBy,
                    'limit' => $this->limit,
                    'skip' => $this->skip,
                ]
            )
        );

        if (!is_null($this->scopes)) {
            $query['scopes'] = $this->scopes;
        }

        return $query;
    }


}

