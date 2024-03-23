<?php

namespace MercadoUnico\MuService\Requests;

use MercadoUnico\MuService\Models\Caracteristica;
use MercadoUnico\MuService\Models\Documento;
use MercadoUnico\MuService\Models\Imagen;
use MercadoUnico\MuService\Models\Operacion;
use MercadoUnico\MuService\Models\Propiedad;

class PropiedadRequest
{

    protected array $data = [];

    public function __construct(Propiedad $propiedad)
    {
        //        SCOPE
//        []: solo la ve la inmobiliaria
//        ['mu:corredores:main']: la ven todos los corredores
//        ['mu:publico', 'mu:corredores:main']: visible por todos

        $this->data = [
            "scopes" => $propiedad->getScopes(),
//            "inmobiliaria" => '58bac1d3c2138539ce7f82d0', # la esta deduciendo mu
//            "corredor" => 'noenviamos', # vendedor id?
            "ubicacion" => [
                "ciudad" => $propiedad->getCiudad()->getId(),
                "provincia" => "{$propiedad->getCiudad()->getProvincia()}",
                "direccion" => $propiedad->getDireccion(),
            ],
            "descripcion" => $propiedad->getDescripcion(),
            "observaciones" => $propiedad->getObservaciones(),
            "documentacion" => $propiedad->getDocumentacion(),
            "terreno" => $propiedad->getTerreno(),
            "superficieCubierta" => $propiedad->getSuperficieCubierta(),
            "superficieSemicubierta" => $propiedad->getSuperficieCubierta(),
            "antiguedad" => $propiedad->getAntiguedad(),
            "operacion" => array_map(function (Operacion $operacion) {
                return $operacion->getId();
            }, $propiedad->getOperaciones()),
            "tipoPropiedad" => $propiedad->getTipoPropiedad()->getId(),
            "precio" => $propiedad->getPrecio(),
            "cochera" => $propiedad->getCochera(),
            "aptaCredito" => $propiedad->isAptaCredito(),
            "dormitorios" => $propiedad->getDormitorios(),
            "banos" => $propiedad->getBanos(),
            "imagenes" => array_map(function (Imagen $imagen) {
                return $imagen->getUrl();
            }, $propiedad->getImagenes()),
            "panoramicas" => [], # todo
            "documentos" => array_map(function (Documento $documento) {
                return $documento->toArray();
            }, $propiedad->getDocumentos()),
            "videos" => [], # todo
            "cartel" => $propiedad->getCartel(),
            "esCondicionada" => $propiedad->isCondicionada(),
            "observacionesPrivadas" => $propiedad->getObservacionesPrivadas(),
            "servicios" => array_map(function (Caracteristica $servicio) {
                return $servicio->toArray();
            }, $propiedad->getServicios()),
            "adicionales" => array_map(function (Caracteristica $adicional) {
                return $adicional->toArray();
            }, $propiedad->getAdicionales()),
            "documentacionDisponible" => array_map(function (Caracteristica $documentacion) {
                return $documentacion->toArray();
            }, $propiedad->getDocumentacionDisponible()),
            "nroPartidaInmobiliaria" => $propiedad->getNroPartidaInmobiliaria(),
            "estado" => $propiedad->getEstado(),
        ];

        if ($propiedad->getLatitud() && $propiedad->getLongitud()) {
            $this->data['ubicacion']['coordenadas'] = [
                $propiedad->getLatitud(),
                $propiedad->getLongitud(),
            ];
        }
    }

    public static function create(Propiedad $propiedad): static
    {
        return new static($propiedad);
    }

    public function getData(): array
    {
        return $this->data;
    }

}
