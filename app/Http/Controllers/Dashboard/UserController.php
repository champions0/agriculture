<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UserUpdateRequest;
use App\Models\User;
use App\Services\FilterServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var FilterServices
     */
    private $filterServices;

    /**
     * @param FilterServices $filterServices
     */
    public function __construct(FilterServices $filterServices)
    {
        $this->filterServices = $filterServices;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $users = User::query()
            ->where('role', '!=', 'admin');

//        filter service
        $users = $this->filterServices->user($users, $data);

        $users = $users
            ->orderByDesc('id')
            ->paginate(config('constants.per_page'));
        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('dashboard.users.edit', compact('user'));
    }

    /**
     * @param UserUpdateRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $data = $request->validated();
        $user = User::find($id);
        $user->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'age' => $data['age'],
            'role' => $data['role'],
        ]);

        flash()->success('User created successful!');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
    }
}
