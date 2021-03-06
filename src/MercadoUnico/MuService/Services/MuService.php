<?php

namespace MercadoUnico\MuService\Services;

use MercadoUnico\MuClient\MuClient;
use MercadoUnico\MuService\Models\Ciudad;
use MercadoUnico\MuService\Models\Propiedad;
use MercadoUnico\MuService\Models\TipoPropiedad;
use MercadoUnico\MuService\Transformers\CiudadTransformer;
use MercadoUnico\MuService\Transformers\OperacionTransformer;
use MercadoUnico\MuService\Transformers\PropiedadTransformer;
use MercadoUnico\MuService\Transformers\TipoPropiedadTransformer;
use MercadoUnico\MuService\Util\Query;

class MuService
{

    const BASE_URL = "https://mercado-unico.com";
    const SANDBOX_BASE_URL = "https://prop44.info";

    /**
     * @var MuClient
     */
    private $muClient;

    /**
     * @var string
     */
    private $compraVentaId;

    /**
     * @var string
     */
    private $alquilerId;

    public function __construct(MuClient $muClient, string $alquilerId, string $compraVentaId)
    {
        $this->muClient = $muClient;
        $this->muClient->connect();

        $this->alquilerId = $alquilerId;
        $this->compraVentaId = $compraVentaId;
    }

    /**
     * @return string
     */
    private function getBaseUrl(): string
    {
        return $this->muClient->isSandboxMode() ? self::SANDBOX_BASE_URL : self::BASE_URL;
    }

    /**
     * @param string $id
     * @return Propiedad
     * @throws \MercadoUnico\MuClient\Exceptions\MuException
     */
    public function findPropiedad(string $id): Propiedad
    {
        $response = $this->muClient->findPropiedad($id);

        return (new PropiedadTransformer($this->getBaseUrl()))->transform($response->getBody());
    }

    /**
     * @param string $id
     * @return Ciudad
     * @throws \MercadoUnico\MuClient\Exceptions\MuException
     */
    public function findCiudad(string $id): Ciudad
    {
        $data = $this->muClient->findCiudad($id)->getBody();

        return (new CiudadTransformer())->transform($data);
    }

    /**
     * @param string $id
     * @return TipoPropiedad
     * @throws \MercadoUnico\MuClient\Exceptions\MuException
     */
    public function findTipoPropiedad(string $id): TipoPropiedad
    {
        $response = $this->muClient->findTipoPropiedad($id);

        return (new TipoPropiedadTransformer())->transform($response->getBody());
    }

    /**
     * @param Propiedad $propiedad
     * @return Propiedad
     * @throws \MercadoUnico\MuClient\Exceptions\JsonErrorException
     * @throws \MercadoUnico\MuClient\Exceptions\MuException
     */
    public function storePropiedad(Propiedad $propiedad): Propiedad
    {
//        SCOPE
//        []: solo la ve la inmobiliaria
//        ['mu:corredores:main']: la ven todos los corredores
//        ['mu:publico', 'mu:corredores:main']: visible por todos
        $data = [
            "scopes" => [],
            "operaciones" => $this->alquilerId,
            "tipoPropiedad" => $propiedad->getTipoPropiedad()->getId(),
            "descripcion" => $propiedad->getDescripcion(),
            "ubicacion" => [
                "direccion" => $propiedad->getDireccion(),
                "ciudad" => "{$propiedad->getCiudad()}",
            ]
        ];

        $response = $this->muClient->storePropiedad($data);

        return (new PropiedadTransformer($this->getBaseUrl()))->transform($response->getBody());
    }

    /**
     * @param Propiedad $propiedad
     * @return Propiedad
     * @throws \MercadoUnico\MuClient\Exceptions\JsonErrorException
     * @throws \MercadoUnico\MuClient\Exceptions\MuException
     */
    public function updatePropiedad(Propiedad $propiedad): Propiedad
    {
//        SCOPE
//        []: solo la ve la inmobiliaria
//        ['mu:corredores:main']: la ven todos los corredores
//        ['mu:publico', 'mu:corredores:main']: visible por todos
        $data = [
            "scopes" => [],
            "operaciones" => $this->alquilerId,
            "tipoPropiedad" => $propiedad->getTipoPropiedad()->getId(),
            "descripcion" => $propiedad->getDescripcion(),
            "ubicacion" => [
                "direccion" => $propiedad->getDireccion(),
                "ciudad" => "{$propiedad->getCiudad()}",
            ]
        ];

        $response = $this->muClient->storePropiedad($data);

        return (new PropiedadTransformer($this->getBaseUrl()))->transform($response->getBody());
    }

    /**
     * @param Query $query
     * @return iterable
     * @throws \MercadoUnico\MuClient\Exceptions\MuErrorResponseException
     * @throws \MercadoUnico\MuClient\Exceptions\MuException
     */
    public function search(Query $query): iterable
    {
        $response = $this->muClient->getPropiedades($query->toArray($this->alquilerId, $this->compraVentaId));

        return (new PropiedadTransformer($this->getBaseUrl()))->transformCollection($response->getBody());
    }

    /**
     * @return iterable
     * @throws \MercadoUnico\MuClient\Exceptions\MuErrorResponseException
     * @throws \MercadoUnico\MuClient\Exceptions\MuException
     */
    public function getTiposDePropiedad(): iterable
    {
        $response = $this->muClient->getTiposPropiedad();

        return (new TipoPropiedadTransformer())->transformCollection($response->getBody());
    }

    /**
     * @return iterable
     * @throws \MercadoUnico\MuClient\Exceptions\MuErrorResponseException
     * @throws \MercadoUnico\MuClient\Exceptions\MuException
     */
    public function getCiudades(): iterable
    {
        $response = $this->muClient->getCiudades();

        return (new CiudadTransformer())->transformCollection($response->getBody());
    }

    /**
     * @return iterable
     * @throws \MercadoUnico\MuClient\Exceptions\MuErrorResponseException
     * @throws \MercadoUnico\MuClient\Exceptions\MuException
     */
    public function getOperaciones(): iterable
    {
        $response = $this->muClient->getOperaciones();

        return (new OperacionTransformer())->transformCollection($response->getBody());
    }


}