<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Report;
use App\User;

class ReportController extends Controller
{
    public function execute()
    {
        if(!empty($_POST['data']))
        {
            $data = base64_decode($_POST['data']);
            $dir ="/pdf/".Auth::user()->id;
            if(!is_dir($dir))
            {
                mkdir(public_path()."/pdf/".Auth::user()->id);
            }
            file_put_contents( public_path()."/pdf/".str_slug(Auth::user()->id)."/report_1.pdf", $data );
            $user = Auth::user();
            $report = $user->report;
            $report->fill([
                'report_1'=>'/pdf/'.Auth::user()->id.'/report_1.pdf'
                ])->save();
        } else {
            echo "No Data Sent";
        }
    }
}
