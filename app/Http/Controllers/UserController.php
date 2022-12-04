<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Department;
use Exception;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;


class UserController extends AppBaseController
{
    /** @var UserRepository $userRepository */
    private UserRepository $userRepository;

    private const MODEL_NOT_FOUND = 'User not found';

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     */
    public function index(Request $request)
    {
        return view('users.index');
    }

    /**
     * Show the form for creating a new User.
     */
    public function create()
    {
        self::viewsShare();

        return view('users.create');
    }

    /**
     * Store a newly created User in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $dataRequest = self::parseRequest($request->all());

        $this->userRepository->create($dataRequest);

        Flash::success('User saved successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     * @param int $id
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function show(int $id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     * @param int $id
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function edit(int $id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route('users.index'));
        }

        self::viewsShare();

        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified User in storage.
     * @param int $id
     * @param UpdateUserRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(int $id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route('users.index'));
        }

        $dataRequest = self::parseRequest($request->all());

        $this->userRepository->update($dataRequest, $id);

        Flash::success('User updated successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(int $id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Parse Data Request
     * @param array $dataRequest Data Request
     * @return array Data Request cleaned
     */
    protected static function parseRequest(array $dataRequest): array
    {
        if (!isset($dataRequest['password'])) {
            unset($dataRequest['password']);
        } else {
            $dataRequest['password'] = \Hash::make($dataRequest['password']);
        }

        return $dataRequest;
    }

    private static function viewsShare()
    {
        $businesses = Business::orderBy('business_name')->pluck('business_name', 'id');
        $departments = Department::orderBy('department_name')->pluck('department_name', 'id');

        \Illuminate\Support\Facades\View::share([
            'businesses' => $businesses,
            'departments' => $departments,
        ]);
    }
}
