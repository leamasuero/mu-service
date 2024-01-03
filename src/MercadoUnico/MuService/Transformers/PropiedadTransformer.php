<?php

namespace MercadoUnico\MuService\Transformers;

use MercadoUnico\MuService\Interfaces\TransformerInterface;
use MercadoUnico\MuService\Models\Propiedad;

class PropiedadTransformer implements TransformerInterface
{
    /**
     * @var string
     */
    private $baseUrl;

    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function transform(array $data): Propiedad
    {

        $propiedad = new Propiedad($data['ubicacion']['direccion'] ?? null);

        $propiedad
            ->setBaseUrl($this->baseUrl)
            ->setCiudad(
                (new CiudadTransformer())->transform($data['ubicacion']['ciudad'] ?? [])
                    ->setProvincia($data['ubicacion']['provincia'] ?? null)
            )
            ->setLongitud($data['ubicacion']['coordenadas'][0] ?? null)
            ->setLatitud($data['ubicacion']['coordenadas'][1] ?? null)
            ->setTerreno($data['terreno'] ?? [])
            ->setPrecio($data['precio'] ?? [])
            ->setScopes($data['scopes'] ?? [])
            ->setDescripcion($data['descripcion'] ?? null)
            ->setObservaciones($data['observaciones'] ?? null)
            ->setDocumentacion($data['documentacion'] ?? null)
            ->setNroPartidaInmobiliaria($data['nroPartidaInmobiliaria'] ?? null)
            ->setOfertaColectiva($data['ofertaColectiva'] ?? null)
            ->setImagenes($data['imagenes'] ?? null)
            ->setPanoramicas($data['panoramicas'] ?? null)
            ->setVideos($data['videos'] ?? null)
            ->setDestacada($data['destacada'] ?? null)
            ->setEstado($data['estado'] ?? null)
            ->setOcultadaAt(
                isset($data['ocultadaAt']) ? \DateTime::createFromFormat(self::DATE_TIME_FORMAT, $data['ocultadaAt']) : null
            )
            ->setReportes($data['reportes'] ?? null)
            ->setOcultaComment($data['ocultaComment'] ?? null)
            ->setDormitorios($data['dormitorios'] ?? null)
            ->setBanos($data['banos'] ?? null)
            ->setCochera($data['cochera'] ?? false)
            ->setCartel($data['cartel'] ?? false)
            ->setAptaCredito($data['aptaCredito'] ?? false)
            ->setCondicionada($data['condicionada'] ?? false)
            ->setTipoPropiedad(
                (new TipoPropiedadTransformer())->transform($data['tipoPropiedad'] ?? [])
            )
            ->setUpdatedAt(
                \DateTime::createFromFormat(self::DATE_TIME_FORMAT, $data['updatedAt'] ?? null)
            )
            ->setInmobiliaria(
                (new InmobiliariaTransformer())->transform($data['inmobiliaria'] ?? [])
            )->setCorredor(
                (new CorredorTransformer())->transform($data['corredor'] ?? [])
            )
            ->setDocumentos($data['documentos'] ?? null)
            ->setDocumentacionDisponible($data['documentacionDisponible'] ?? null)
            ->setServicios($data['servicios'] ?? null)
            ->setAdicionales($data['adicionales'] ?? null)
            ->setCreatedAt(
                \DateTime::createFromFormat(self::DATE_TIME_FORMAT, $data['createdAt'] ?? null)
            )
            ->setCodigo($data['codigo'] ?? null)
            ->setSlug($data['slug'] ?? null)
            ->setSuperficieCubierta($data['superficieCubierta'] ?? null)
            ->setAntiguedad($data['antiguedad'] ?? null)
            ->setId($data['id'] ?? null);

        foreach ((new OperacionTransformer())->transformCollection($data['operacion'] ?? []) as $operacion) {
            // ver esto - operaciones == array de operaciones?
            $propiedad->addOperacion($operacion);
        }

        return $propiedad;
    }

    public function transformCollection(iterable $rows): iterable
    {
        $propiedades = [];
        foreach ($rows as $row) {
            $propiedades[] = self::transform($row);
        }

        return $propiedades;
    }

}
