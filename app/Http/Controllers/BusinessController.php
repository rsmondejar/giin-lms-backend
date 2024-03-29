<?php

namespace App\Http\Controllers;

use App\DataTables\BusinessDataTable;
use App\Http\Requests\CreateBusinessRequest;
use App\Http\Requests\UpdateBusinessRequest;
use App\Repositories\BusinessRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;

class BusinessController extends AppBaseController
{
    /** @var BusinessRepository $businessRepository */
    private BusinessRepository $businessRepository;

    private const MODEL_NOT_FOUND = 'No se encontrado la empresa';
    private const MODEL_NAME = 'Empresa';

    public function __construct(BusinessRepository $businessRepo)
    {
        $this->businessRepository = $businessRepo;
    }

    /**
     * Display a listing of the Business.
     * @param BusinessDataTable $businessDataTable
     * @return mixed
     */
    public function index(BusinessDataTable $businessDataTable): mixed
    {
        if (!auth()->user()->can('list businesses')) {
            abort(403);
        }

        return $businessDataTable->render('businesses.index');
    }

    /**
     * Show the form for creating a new Business.
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        if (!auth()->user()->can('create businesses')) {
            abort(403);
        }

        return view('businesses.create');
    }

    /**
     * Store a newly created Business in storage.
     * @param CreateBusinessRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateBusinessRequest $request): Redirector|RedirectResponse|Application
    {
        if (!auth()->user()->can('store businesses')) {
            abort(403);
        }

        $input = $request->all();

        $this->businessRepository->create($input);

        Flash::success(sprintf("%s guardada correctamente.", self::MODEL_NAME));

        return redirect(route('businesses.index'));
    }

    /**
     * Display the specified Business.
     * @param int $id
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function show(int $id): View|Factory|Redirector|RedirectResponse|Application
    {
        if (!auth()->user()->can('show businesses')) {
            abort(403);
        }

        $business = $this->businessRepository->find($id);

        if (empty($business)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route('businesses.index'));
        }

        return view('businesses.show')->with('business', $business);
    }

    /**
     * Show the form for editing the specified Business.
     * @param int $id
     * @return View|Factory|Redirector|Application|RedirectResponse
     */
    public function edit(int $id): View|Factory|Redirector|Application|RedirectResponse
    {
        if (!auth()->user()->can('edit businesses')) {
            abort(403);
        }

        $business = $this->businessRepository->find($id);

        if (empty($business)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route('businesses.index'));
        }

        return view('businesses.edit')->with('business', $business);
    }

    /**
     * Update the specified Business in storage.
     * @param int $id
     * @param UpdateBusinessRequest $request
     * @return Redirector|Application|RedirectResponse
     */
    public function update(int $id, UpdateBusinessRequest $request): Redirector|Application|RedirectResponse
    {
        if (!auth()->user()->can('update businesses')) {
            abort(403);
        }

        $business = $this->businessRepository->find($id);

        if (empty($business)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route('businesses.index'));
        }

        $this->businessRepository->update($request->all(), $id);

        Flash::success(sprintf("%s actualizada correctamente.", self::MODEL_NAME));

        return redirect(route('businesses.index'));
    }

    /**
     * Remove the specified Business from storage.
     *
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(int $id)
    {
        if (!auth()->user()->can('destroy businesses')) {
            abort(403);
        }

        $business = $this->businessRepository->find($id);

        if (empty($business)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route('businesses.index'));
        }

        $this->businessRepository->delete($id);

        Flash::success(sprintf("%s eliminada correctamente.", self::MODEL_NAME));

        return redirect(route('businesses.index'));
    }
}
