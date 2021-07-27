<?php

namespace MercadoUnico\MuService\Util;


class Query
{
    /**
     * @var string
     */
    private $alquilerId;

    /**
     * @var string
     */
    private $compraVentaId;

    /**
     * @var string
     */
    protected $inmobiliaria;

    /**
     * @var string
     */
    protected $q;

    /**
     * @var array
     */
    protected $operaciones;

    /**
     * @var string
     */
    protected $ciudad;

    /**
     * @var array
     */
    protected $tiposPropiedad;

    /**
     * @var int
     */
    protected $limit;

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
     * @var string
     */
    protected $moneda;

    /**
     * @var string
     */
    protected $slug;

    /**
     * Query constructor.
     */
    public function __construct(?string $inmobiliaria = null)
    {
        $this->inmobiliaria = $inmobiliaria;

        $this->operaciones = [];
        $this->tiposPropiedad = [];
        $this->limit = 20;
        $this->moneda = '$';

        $this->q = null;
        $this->slug = null;
        $this->ciudad = null;
        $this->dormitorios = null;
        $this->antiguedad = null;
        $this->cochera = null;
        $this->aptaCredito = null;
        $this->min = null;
        $this->max = null;
    }

    /**
     * @param string $inmobiliaria
     * @return Query
     */
    public function inmobiliaria(string $inmobiliaria): self
    {
        $this->inmobiliaria = $inmobiliaria;
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
     * @param string $operacion
     * @return Query
     */
    public function operacion(string $operacion): self
    {
        $this->operaciones[] = $operacion;
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
     * @param string $ciudad
     * @return Query
     */
    public function ciudad(string $ciudad): self
    {
        $this->ciudad = $ciudad;
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
     * @param int $antiguedad
     * @return Query
     */
    public function antiguedad(?int $antiguedad): self
    {
        $this->antiguedad = $antiguedad;
        return $this;
    }

    /**
     * @return null|string
     */
    private function getAntiguedad(): ?string
    {
        if ($this->antiguedad) {
            return "<={$this->antiguedad}";
        };

        return null;
    }

    /**
     * @return null|string
     */
    private function getCochera(): ?string
    {
        return $this->cochera ? 'true' : null;
    }

    /**
     * @return null|string
     */
    private function getAptaCredito(): ?string
    {
        return $this->aptaCredito ? 'true' : null;
    }

    /**
     * @return bool
     */
    private function hasOperacionCompraVenta(): bool
    {
        return in_array($this->compraVentaId, $this->operaciones);
    }

    /**
     * @return null|string
     */
    private function getCiudad(): ?string
    {
        return $this->ciudad;
    }

    /**
     * @return int|null
     */
    private function getDormitorios(): ?int
    {
        return $this->dormitorios;
    }

    /**
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
        //&source=buscador-web

        //Request URL: https://api.mercado-unico.com/propiedades?precio.alquiler.valor[]=%3E%3D22000&precio.alquiler.valor[]=%3C%3D83000&precio.alquiler.moneda=$&ubicacion.ciudad=58bac0b35a9f803452303225&dormitorios=%3E%3D2&antiguedad=%3C%3D10&tipoPropiedad[]=58f5563e2a90f5cb1104b49c&tipoPropiedad[]=58f5563d988e744fda7edae3&operaciones[]=58f554bf615347788ff291d2&cochera=true&aptaCredito=true&limit=25&source=buscador-web

        $precio = [];
        if ($this->min || $this->max) {
            $cotasKey = 'precio.alquiler.valor';
            $monedaKey = 'precio.alquiler.moneda';

            if ($this->hasOperacionCompraVenta()) {
                $cotasKey = 'precio.venta.valor';
                $monedaKey = 'precio.venta.moneda';
            }

            $precio[$cotasKey] = [
                ">={$this->min}",
                "<={$this->max}",
            ];

            $precio[$monedaKey] = $this->moneda;
        }

        return array_filter(
            array_merge(
                $precio,
                [
                    'inmobiliaria' => $this->inmobiliaria,
                    'q' => $this->q,
                    'slug' => $this->slug,
                    'tipoPropiedad' => $this->tiposPropiedad,
                    'operacion' => $this->operaciones,
                    'ubicacion.ciudad' => $this->getCiudad(),
                    'cochera' => $this->getCochera(),
                    'dormitorios' => $this->getDormitorios(),
                    'aptaCredito' => $this->getAptaCredito(),
                    'antiguedad' => $this->getAntiguedad(),
                    'limit' => $this->limit,
                ]
            )
        );
    }


}
