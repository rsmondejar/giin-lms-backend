<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Repositories\RoleRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;

class RoleController extends AppBaseController
{
    /** @var RoleRepository $roleRepository */
    private RoleRepository $roleRepository;

    private const MODEL_NOT_FOUND = 'Role not found';

    public function __construct(RoleRepository $roleRepo)
    {
        $this->roleRepository = $roleRepo;
    }

    /**
     * Display a listing of the Role.
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        return view('roles.index');
    }

    /**
     * Show the form for creating a new Role.
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created Role in storage.
     * @param CreateRoleRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateRoleRequest $request)
    {
        $input = $request->all();

        $this->roleRepository->create($input);

        Flash::success('Role saved successfully.');

        return redirect(route('roles.index'));
    }

    /**
     * Display the specified Role.
     * @param int $id
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function show(int $id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route('roles.index'));
        }

        return view('roles.show')->with('role', $role);
    }

    /**
     * Show the form for editing the specified Role.
     * @param int $id
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function edit(int $id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route('roles.index'));
        }

        return view('roles.edit')->with('role', $role);
    }

    /**
     * Update the specified Role in storage.
     * @param int $id
     * @param UpdateRoleRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(int $id, UpdateRoleRequest $request)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route('roles.index'));
        }

        $this->roleRepository->update($request->all(), $id);

        Flash::success('Role updated successfully.');

        return redirect(route('roles.index'));
    }

    /**
     * Remove the specified Role from storage.
     *
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(int $id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route('roles.index'));
        }

        $this->roleRepository->delete($id);

        Flash::success('Role deleted successfully.');

        return redirect(route('roles.index'));
    }
}
