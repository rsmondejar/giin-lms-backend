<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Requests\CreateDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Repositories\DepartmentRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;


class DepartmentController extends AppBaseController
{
    /** @var DepartmentRepository $departmentRepository */
    private DepartmentRepository $departmentRepository;

    private const MODEL_NOT_FOUND = 'Department not found';

    public function __construct(DepartmentRepository $departmentRepo)
    {
        $this->departmentRepository = $departmentRepo;
    }

    /**
     * Display a listing of the Department.
     */
    public function index(Request $request)
    {
        return view('departments.index');
    }

    /**
     * Show the form for creating a new Department.
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created Department in storage.
     */
    public function store(CreateDepartmentRequest $request)
    {
        $input = $request->all();

        $this->departmentRepository->create($input);

        Flash::success('Department saved successfully.');

        return redirect(route('departments.index'));
    }

    /**
     * Display the specified Department.
     * @param int $id
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function show(int $id)
    {
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
    public function edit(int $id)
    {
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
    public function update(int $id, UpdateDepartmentRequest $request)
    {
        $department = $this->departmentRepository->find($id);

        if (empty($department)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route('departments.index'));
        }

        $this->departmentRepository->update($request->all(), $id);

        Flash::success('Department updated successfully.');

        return redirect(route('departments.index'));
    }

    /**
     * Remove the specified Department from storage.
     *
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(int $id)
    {
        $department = $this->departmentRepository->find($id);

        if (empty($department)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route('departments.index'));
        }

        $this->departmentRepository->delete($id);

        Flash::success('Department deleted successfully.');

        return redirect(route('departments.index'));
    }
}
