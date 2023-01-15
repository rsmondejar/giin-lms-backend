<?php

namespace App\Http\Controllers;

use Exception;
use App\DataTables\PublicHolidaysDataTable;
use App\Http\Requests\CreatePublicHolidayRequest;
use App\Http\Requests\UpdatePublicHolidayRequest;
use App\Repositories\PublicHolidayRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;

class PublicHolidaysController extends AppBaseController
{
    /** @var PublicHolidayRepository $publicHolidaysRepository */
    private PublicHolidayRepository $publicHolidayRepository;

    private const MODEL_NOT_FOUND = 'No se ha encontrado el festivo';

    private const MODEL_NAME = 'Festivo';

    private const ROUTE_INDEX = 'public-holidays.index';

    public function __construct(PublicHolidayRepository $publicHolidaysRepo)
    {
        $this->publicHolidayRepository = $publicHolidaysRepo;
    }

    /**
     * Display a listing of the PublicHolidays.
     * @param PublicHolidaysDataTable $publicHolidaysDataTable
     * @return mixed
     */
    public function index(PublicHolidaysDataTable $publicHolidaysDataTable): mixed
    {
        if (!auth()->user()->can('list public holidays')) {
            abort(403);
        }
        return $publicHolidaysDataTable->render('public_holidays.index');
    }


    /**
     * Show the form for creating a new PublicHolidays.
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        if (!auth()->user()->can('create public holidays')) {
            abort(403);
        }

        return view('public_holidays.create');
    }

    /**
     * Store a newly created PublicHolidays in storage.
     * @param CreatePublicHolidayRequest $request
     * @return Redirector|Application|RedirectResponse
     */
    public function store(CreatePublicHolidayRequest $request): Redirector|Application|RedirectResponse
    {
        if (!auth()->user()->can('store public holidays')) {
            abort(403);
        }

        $input = $request->all();

        $this->publicHolidayRepository->create($input);

        Flash::success(sprintf("%s guardado correctamente.", self::MODEL_NAME));

        return redirect(route(self::ROUTE_INDEX));
    }

    /**
     * Display the specified PublicHolidays.
     * @param int $id
     * @return View|Factory|Redirector|Application|RedirectResponse
     */
    public function show(int $id): View|Factory|Redirector|Application|RedirectResponse
    {
        if (!auth()->user()->can('show public holidays')) {
            abort(403);
        }

        $publicHoliday = $this->publicHolidayRepository->find($id);

        if (empty($publicHoliday)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route(self::ROUTE_INDEX));
        }

        return view('public_holidays.show')->with('publicHoliday', $publicHoliday);
    }

    /**
     * Show the form for editing the specified PublicHolidays.
     * @param int $id
     * @return View|Factory|Redirector|Application|RedirectResponse
     */
    public function edit(int $id): View|Factory|Redirector|Application|RedirectResponse
    {
        if (!auth()->user()->can('edit public holidays')) {
            abort(403);
        }

        $publicHoliday = $this->publicHolidayRepository->find($id);

        if (empty($publicHoliday)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route(self::ROUTE_INDEX));
        }

        return view('public_holidays.edit')->with('publicHoliday', $publicHoliday);
    }

    /**
     * Update the specified PublicHolidays in storage.
     * @param int $id
     * @param UpdatePublicHolidayRequest $request
     * @return Redirector|Application|RedirectResponse
     */
    public function update(int $id, UpdatePublicHolidayRequest $request): Redirector|Application|RedirectResponse
    {
        if (!auth()->user()->can('update public holidays')) {
            abort(403);
        }

        $publicHoliday = $this->publicHolidayRepository->find($id);

        if (empty($publicHoliday)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route(self::ROUTE_INDEX));
        }

        $this->publicHolidayRepository->update($request->all(), $id);

        Flash::success(sprintf("%s actualizado correctamente.", self::MODEL_NAME));

        return redirect(route(self::ROUTE_INDEX));
    }

    /**
     * Remove the specified PublicHolidays from storage.
     *
     * @param int $id
     * @return Redirector|Application|RedirectResponse
     * @throws Exception
     */
    public function destroy(int $id): Redirector|Application|RedirectResponse
    {
        if (!auth()->user()->can('destroy public holidays')) {
            abort(403);
        }

        $publicHoliday = $this->publicHolidayRepository->find($id);

        if (empty($publicHoliday)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route(self::ROUTE_INDEX));
        }

        $this->publicHolidayRepository->delete($id);

        Flash::success(sprintf("%s eliminado correctamente.", self::MODEL_NAME));

        return redirect(route(self::ROUTE_INDEX));
    }
}
