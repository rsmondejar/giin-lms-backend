<?php

namespace App\Http\Controllers;

use App\DataTables\DepartmentDataTable;
use Exception;
use App\Http\Requests\CreateDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Repositories\DepartmentRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;


class DepartmentController extends AppBaseController
{
    /** @var DepartmentRepository $departmentRepository */
    private DepartmentRepository $departmentRepository;

    private const MODEL_NOT_FOUND = 'No se ha encontrado el departamento';

    private const MODEL_NAME = 'Departamento';

    public function __construct(DepartmentRepository $departmentRepo)
    {
        $this->departmentRepository = $departmentRepo;
    }

    /**
     * Display a listing of the Department.
     * @param DepartmentDataTable $departmentDataTable
     * @return mixed
     */
    public function index(DepartmentDataTable $departmentDataTable): mixed
    {
        if (!auth()->user()->can('list departments')) {
            abort(403);
        }
        return $departmentDataTable->render('departments.index');
    }

    /**
     * Show the form for creating a new Department.
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        if (!auth()->user()->can('create departments')) {
            abort(403);
        }

        return view('departments.create');
    }

    /**
     * Store a newly created Department in storage.
     * @param CreateDepartmentRequest $request
     * @return Redirector|Application|RedirectResponse
     */
    public function store(CreateDepartmentRequest $request): Redirector|Application|RedirectResponse
    {
        if (!auth()->user()->can('store departments')) {
            abort(403);
        }

        $input = $request->all();

        $this->departmentRepository->create($input);

        Flash::success(sprintf("%s guardado correctamente.", self::MODEL_NAME));

        return redirect(route('departments.index'));
    }

    /**
     * Display the specified Department.
     * @param int $id
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function show(int $id): View|Factory|Redirector|RedirectResponse|Application
    {
        if (!auth()->user()->can('show departments')) {
            abort(403);
        }

        $department = $this->departmentRepository->find($id);

        if (empty($department)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route('departments.index'));
        }

        return view('departments.show')->with('department', $department);
    }

    /**
     * Show the form for editing the specified Department.
     * @param int $id
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function edit(int $id): View|Factory|Redirector|RedirectResponse|Application
    {
        if (!auth()->user()->can('edit departments')) {
            abort(403);
        }

        $department = $this->departmentRepository->find($id);

        if (empty($department)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route('departments.index'));
        }

        return view('departments.edit')->with('department', $department);
    }

    /**
     * Update the specified Department in storage.
     * @param int $id
     * @param UpdateDepartmentRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(int $id, UpdateDepartmentRequest $request): Redirector|RedirectResponse|Application
    {
        if (!auth()->user()->can('update departments')) {
            abort(403);
        }

        $department = $this->departmentRepository->find($id);

        if (empty($department)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route('departments.index'));
        }

        $this->departmentRepository->update($request->all(), $id);

        Flash::success(sprintf("%s actualizado correctamente.", self::MODEL_NAME));

        return redirect(route('departments.index'));
    }

    /**
     * Remove the specified Department from storage.
     *
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(int $id): Redirector|RedirectResponse|Application
    {
        if (!auth()->user()->can('destroy departments')) {
            abort(403);
        }

        $department = $this->departmentRepository->find($id);

        if (empty($department)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route('departments.index'));
        }

        $this->departmentRepository->delete($id);

        Flash::success(sprintf("%s eliminado correctamente.", self::MODEL_NAME));

        return redirect(route('departments.index'));
    }
}
