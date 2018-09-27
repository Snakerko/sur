<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Report;
use App\Organization;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $user;
    protected $uri;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function showLoginForm(Request $request)
    {
        if($request->isMethod('get') && $request->has('referal'))
        {
            $this->create($request);
            
        }

        return view('auth.login', ['uri'=>$this->uri]);
    }
    
    public function create(Request $request)
    {
        $this->uri = $_GET['referal'];
        $this->uri = base64_decode($this->uri);
        $this->uri = unserialize($this->uri);
        $this->user = User::where('email', $this->uri['email'])->first();
        $org = Organization::where('org_name', $this->uri['org_name'])->first();
        if($org == null)
        {
            Organization::create(['org_name'=>$this->uri['org_name']]);
        }
        if($this->user == null)
        {
            $report = Report::create();
            $this->user = User::create([
                'email'=>$this->uri['email'],
                'org_name'=>$this->uri['org_name'],
                'password'=>Hash::make($this->uri['password']),
                'organization_id'=>$org->id,
                'report_id'=>$report->id
            ]);
        }

        return $this->user;
    }
}
