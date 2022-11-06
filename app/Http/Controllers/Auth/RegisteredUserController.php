<?php

namespace App\Http\Controllers\Auth;

use App\Enums\AccountHome;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    private Builder $userModel;
    public function __construct()
    {
        $this->userModel = (new User())->query();
    }
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(StoreRequest $request)
    {
        $account = Account::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $this->userModel->create([
            'account_id' => $account->id,
            'name' => $request->name,
            'gender' => $request->gender,
            'phone'=>null,
            'address' => null,
            'city'=>null,
        ]);
        Auth::login($account);
        return redirect(AccountHome::USER_HOME);
    }
}
