<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\StoreRolRequest;
use App\Http\Requests\UpdateRolRequest;

class RoleController extends Controller
{
    /**
     * Listar roles
     *
     * Recupera una colección de todos los roles disponibles.
     *
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function index()
    {
        //
    }

    /**
     * Crear rol
     *
     * Registra un nuevo rol en la base de datos.
     *
     * @param  \App\Http\Requests\StoreRolRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRolRequest $request)
    {
        //
    }

    /**
     * Ver rol
     *
     * Muestra detalles de un rol específico.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Actualizar rol
     *
     * Modifica los detalles de un rol existente.
     *
     * @param  \App\Http\Requests\UpdateRolRequest  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRolRequest $request, Role $role)
    {
        //
    }

    /**
     * Eliminar rol
     *
     * Elimina un rol de la base de datos.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
