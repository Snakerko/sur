<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Auth;
use Gate;
use App\User;
use App\Report;
use App\Organization;
use App\Mail\MailClass;

class AdminController extends Controller
{
    protected $url;

    public function create_link(Request $request)
    {
        $email = $request->input('email');
        $org_name = $request->input('org_name');
        $password = str_random(8);
        $encode_url = ['email' => $email, 'org_name' => $org_name, 'password' => $password];
        $encode_url = serialize($encode_url);
        $encode_url = base64_encode($encode_url);
        $this->url .= route('home').'/login/?referal='.$encode_url;
        $org = Organization::where('org_name', $request->input('org_name'))->first();
        if($org == null)
        {
            Organization::create(['org_name'=>$request->input('org_name')]);
        }

        Mail::to($email)->send(new MailClass($this->url));

        return redirect()->back()->with('message','Ссылка отправлена.');
    }
    

    public function execute(Request $request)
    {
        if(Gate::denies('admin'))
        {
            return redirect('/')->with(['message'=>'вы не администратор']);
        }
        if($request->isMethod('post') && $request->has('org_name'))
        {
            $this->create_link($request);
        }
        
        $user = Auth::user();
        $persons = User::paginate(10);

        return view('www.content', ['url'=>$this->url, 'user'=>$user, 'persons'=>$persons]);
    }

    function rrmdir($src) {
        if(is_dir($src))
        {
            $dir = opendir($src);
            while(false !== ( $file = readdir($dir)) ) {
                if (( $file != '.' ) && ( $file != '..' )) {
                    $full = $src . '/' . $file;
                    if ( is_dir($full) ) {
                        rrmdir($full);
                    }
                    else {
                        unlink($full);
                    }
                }
            }
            closedir($dir);
            rmdir($src);
        }
    }

    public function erase($id)
    {
        $this->rrmdir(public_path()."/pdf/".$id);
        $user = User::where('id', $id)->first();
        $report = $user->report;
        $report->fill([
            'report_1'=>''
            ])->save();
        $user->fill(['complete_survey'=>'нет'])->save();

        return redirect('/')->with(['message'=>'результаты опроса пользователя'.$user->username.'обнулены']);
    }

}
