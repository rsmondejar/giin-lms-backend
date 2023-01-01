<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /** @var User $authUser */
        $authUser = auth()->user();

        $managers = User::ofManagersByUser($authUser)
            ->orderBy('name')
            ->pluck('name', 'id');

        $leaveTypes = LeaveType::orderBy('name')->pluck('name', 'id');

        $leaves = Leave::byUser($authUser->id)->with(['dates'])->get();

        return view('home')->with([
            'managers' => $managers,
            'leaveTypes' => $leaveTypes,
            'leaves' => $leaves,
        ]);
    }
}
