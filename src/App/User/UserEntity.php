<?php
declare(strict_types = 1);
namespace App\User;

class UserEntity
{

    public $id;

    public $nombre;

    public $apellidos;

    public $cedula;

    public $correo;

    public $telefono;

    public function getArrayCopy()
    {
        return [

            'id' => $this->nombre,

            'nombre' => $this->nombre,

            'apellidos' => $this->apellidos,

            'cedula' => $this->cedula,

            'correo' => $this->correo,

            'telefono' => $this->telefono
        ];
    }

    public function exchangeArray(array $array)
    {
        $this->id = $array['id'];

        $this->nombre = $array['nombre'];

        $this->apellidos = $array['apellidos'];

        $this->cedula = $array['cedula'];

        $this->correo = $array['correo'];

        $this->telefono = $array['telefono'];
    }
}
