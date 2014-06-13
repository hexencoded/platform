<?php

namespace Thor\Backend;

use View,
    Redirect,
    \Thor\Platform\ThorFacade;

/*
  |--------------------------------------------------------------------------
  | \Thor\Models\Permission backend controller
  |--------------------------------------------------------------------------
  |
  | This is a default Thor CMS backend controller template for resource management.
  | Feel free to change it to your needs.
  |
 */

class PermissionsController extends Controller
{

    /**
     * Repository
     *
     * @var \Thor\Models\Permission     */
    protected $permission;

    public function __construct(\Thor\Models\Permission $permission)
    {
        $this->permission = $permission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $permissions = $this->permission->all();

        return View::make('thor::backend.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('thor::backend.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = \Input::all();

        if ($this->permission->create($input)) {
            return Redirect::route('backend.permissions.edit', array($this->permission->id))
                            ->with('success_message', 'Permission created successfully.');
        }

        return Redirect::route('backend.permissions.create')
                        ->withInput()
                        ->withErrors($this->permission->errors())
                        ->with('message', 'There were validation errors.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Thor\Models\Permission  $permission 
     * @return Response
     */
    public function show(\Thor\Models\Permission $permission)
    {

        return View::make('thor::backend.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Thor\Models\Permission  $permission 
     * @return Response
     */
    public function edit(\Thor\Models\Permission $permission)
    {

        if (is_null($permission)) {
            return Redirect::route('backend.permissions.index');
        }

        $roles = ThorFacade::model('role')->all();
        $permission_roles = $permission->roles()->get()->lists('id');

        return View::make('thor::backend.permissions.edit', compact('permission', 'roles', 'permission_roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Thor\Models\Permission  $permission 
     * @return Response
     */
    public function update(\Thor\Models\Permission $permission)
    {
        $input = \Input::all();

        if ($permission->update($input)) {
            if (\Sentinel::can('update_roles')) {
                $permission->roles()->sync(\Input::get('roles', array()));
            }

            return Redirect::route('backend.permissions.edit', $permission->id)
                            ->with('info_message', 'Permission updated successfully.');
        }

        return Redirect::route('backend.permissions.edit', $permission->id)
                        ->withInput()
                        ->withErrors($permission->errors())
                        ->with('message', 'There were validation errors.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Thor\Models\Permission  $permission 
     * @return Response
     */
    public function destroy(\Thor\Models\Permission $permission)
    {
        $permission->delete();

        return Redirect::route('backend.permissions.index');
    }

}
