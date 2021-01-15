# Mu Service

```php
$muClient = new \MercadoUnico\MuClient\MuClient($username, $password, $sandBoxMode);
$muService = new \MercadoUnico\MuService\Services\MuService($muClient, $alquilerId, $compraVentaId);
```

## Propiedades

```php
$propiedad = $muService->findPropiedad($propiedadId);

$query = new \MercadoUnico\MuService\Util\Query($inmobiliariaId);
$query
    ->q('Santiago')
    ->limit(10);

$propiedades = $muService->search($query);

$query = new \MercadoUnico\MuService\Util\Query($inmobiliariaId);
$query
    ->min(1000)
    ->max(50000)
    ->operacion($alquilerId)
    ->ciudad($ciudadId)
    ->limit(10);

$propiedades = $muService->search($query);
```

# Ciudades

```php
$ciudad = $muService->findCiudad($ciudadId);

$ciudades = $muService->getCiudades();
```

# Tipo de propiedades

```php
$tipoPropiedad = $muService->findTipoPropiedad($departamentoId);

$tiposPropiedad = $muService->getTiposDePropiedad();
```
 
# Operaciones

```php
$operaciones = $muService->getOperaciones();
```