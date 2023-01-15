<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\Business;
use App\Models\Department;
use App\Models\Role;
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

    private const MODEL_NOT_FOUND = 'No se ha encontrado el usuario';

    private const MODEL_NAME = 'Usuario';

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     * @param UserDataTable $userDataTable
     * @return mixed
     */
    public function index(UserDataTable $userDataTable): mixed
    {
        if (!auth()->user()->can('list users')) {
            abort(403);
        }

        return $userDataTable->render('users.index');
    }

    /**
     * Show the form for creating a new User.
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        if (!auth()->user()->can('create users')) {
            abort(403);
        }

        self::viewsShare();

        return view('users.create')->with([
            'userRoles' => [],
        ]);
    }

    /**
     * Store a newly created User in storage.
     * @param CreateUserRequest $request
     * @return Redirector|Application|RedirectResponse
     */
    public function store(CreateUserRequest $request): Redirector|Application|RedirectResponse
    {
        if (!auth()->user()->can('store users')) {
            abort(403);
        }

        $dataRequest = self::parseRequest($request->all());

        $this->userRepository->create($dataRequest);

        Flash::success(sprintf("%s guardado correctamente.", self::MODEL_NAME));

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     * @param int $id
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function show(int $id): View|Factory|Redirector|RedirectResponse|Application
    {
        if (!auth()->user()->can('show users')) {
            abort(403);
        }

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
    public function edit(int $id): View|Factory|Redirector|RedirectResponse|Application
    {
        if (!auth()->user()->can('edit users')) {
            abort(403);
        }

        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route('users.index'));
        }

        self::viewsShare();

        $userRoles = $user->roles->pluck('id')->toArray();

        return view('users.edit')->with([
            'user' => $user,
            'userRoles' => $userRoles,
        ]);
    }

    /**
     * Update the specified User in storage.
     * @param int $id
     * @param UpdateUserRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(int $id, UpdateUserRequest $request): Redirector|RedirectResponse|Application
    {
        if (!auth()->user()->can('update users')) {
            abort(403);
        }

        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route('users.index'));
        }

        $dataRequest = self::parseRequest($request->all());

        $this->userRepository->update($dataRequest, $id);

        Flash::success(sprintf("%s actualizado correctamente.", self::MODEL_NAME));

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(int $id): Redirector|RedirectResponse|Application
    {
        if (!auth()->user()->can('destroy users')) {
            abort(403);
        }

        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error(self::MODEL_NOT_FOUND);

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success(sprintf("%s eliminado correctamente.", self::MODEL_NAME));

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
        $roles = Role::orderBy('name')->pluck('name', 'id');

        \Illuminate\Support\Facades\View::share([
            'businesses' => $businesses,
            'departments' => $departments,
            'roles' => $roles,
        ]);
    }
}
