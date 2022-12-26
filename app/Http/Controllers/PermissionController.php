<?php

namespace App\Http\Controllers;

use App\DataTables\PermissionDataTable;
use Exception;
use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Repositories\PermissionRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;


class PermissionController extends AppBaseController
{
    /** @var PermissionRepository $permissionRepository */
    private PermissionRepository $permissionRepository;

    private const MODEL_NOT_FOUND = 'No se ha encontrado el permiso';

    private const MODEL_NAME = 'Permiso';

    public function __construct(PermissionRepository $permissionRepo)
    {
        $this->permissionRepository = $permissionRepo;
    }

    /**
     * Display a listing of the Permission.
     * @param PermissionDataTable $permissionDataTable
     * @return mixed
     */
    public function index(PermissionDataTable $permissionDataTable): mixed
    {
        return $permissionDataTable->render('permissions.index');
    }

    /**
     * Show the form for creating a new Permission.
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created Permission in storage.
     * @param CreatePermissionRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreatePermissionRequest $request): Redirector|RedirectResponse|Application
    {
        $input = $request->all();

        $this->permissionRepository->create($input);

        Flash::success(sprintf("%s guardado correctamente.", self::MODEL_NAME));

        return redirect(route('permissions.index'));
    }

    /**
     * Display the specified Permission.
     * @param int $id
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function show(int $id): View|Factory|Redirector|RedirectResponse|Application
    {
        $permission = $this->permissionRepository->find($id);

        if (empty($permission)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route('permissions.index'));
        }

        return view('permissions.show')->with('permission', $permission);
    }

    /**
     * Show the form for editing the specified Permission.
     * @param int $id
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function edit(int $id): View|Factory|Redirector|RedirectResponse|Application
    {
        $permission = $this->permissionRepository->find($id);

        if (empty($permission)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route('permissions.index'));
        }

        return view('permissions.edit')->with('permission', $permission);
    }

    /**
     * Update the specified Permission in storage.
     * @param int $id
     * @param UpdatePermissionRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(int $id, UpdatePermissionRequest $request): Redirector|RedirectResponse|Application
    {
        $permission = $this->permissionRepository->find($id);

        if (empty($permission)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route('permissions.index'));
        }

        $this->permissionRepository->update($request->all(), $id);

        Flash::success(sprintf("%s actualizado correctamente.", self::MODEL_NAME));

        return redirect(route('permissions.index'));
    }

    /**
     * Remove the specified Permission from storage.
     *
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(int $id): Redirector|RedirectResponse|Application
    {
        $permission = $this->permissionRepository->find($id);

        if (empty($permission)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route('permissions.index'));
        }

        $this->permissionRepository->delete($id);

        Flash::success(sprintf("%s eliminadao correctamente.", self::MODEL_NAME));

        return redirect(route('permissions.index'));
    }
}
