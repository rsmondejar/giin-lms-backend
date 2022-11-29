<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Requests\CreateBusinessRequest;
use App\Http\Requests\UpdateBusinessRequest;
use App\Repositories\BusinessRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;


class BusinessController extends AppBaseController
{
    /** @var BusinessRepository $businessRepository */
    private BusinessRepository $businessRepository;

    private const MODEL_NOT_FOUND = 'Business not found';

    public function __construct(BusinessRepository $businessRepo)
    {
        $this->businessRepository = $businessRepo;
    }

    /**
     * Display a listing of the Business.
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        return view('businesses.index');
    }

    /**
     * Show the form for creating a new Business.
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('businesses.create');
    }

    /**
     * Store a newly created Business in storage.
     * @param CreateBusinessRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateBusinessRequest $request)
    {
        $input = $request->all();

        $this->businessRepository->create($input);

        Flash::success('Business saved successfully.');

        return redirect(route('businesses.index'));
    }

    /**
     * Display the specified Business.
     * @param int $id
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function show(int $id)
    {
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
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function edit(int $id)
    {
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
     * @return Application|RedirectResponse|Redirector
     */
    public function update(int $id, UpdateBusinessRequest $request)
    {
        $business = $this->businessRepository->find($id);

        if (empty($business)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route('businesses.index'));
        }

        $this->businessRepository->update($request->all(), $id);

        Flash::success('Business updated successfully.');

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
        $business = $this->businessRepository->find($id);

        if (empty($business)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route('businesses.index'));
        }

        $this->businessRepository->delete($id);

        Flash::success('Business deleted successfully.');

        return redirect(route('businesses.index'));
    }
}
