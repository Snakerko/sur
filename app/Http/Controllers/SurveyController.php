<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\Question;
use App\Report;
use App\User;
use App\Organization;
use Auth;
use App;

class SurveyController extends Controller
{
    public function execute(Request $request)
    {
        if($request->isMethod('post')) 
        {
            Auth::user()->fill(['complete_survey'=>"да"])->save();
            $data1 = [
                'красный'=>0,
                'синий'=>0,
                'желтый'=>0,
                'белый'=>0
            ];
                $posdata = [];
                $negdata = [];          
                $r = [];
                $b = [];
                $w = [];
                $y = [];
                $nr = [];
                $nb = [];
                $nw = [];
                $ny = [];
            
            foreach($_POST['poll'] as $k=>$v)
            {
                $answers = Answer::where('question_id', $k)->get()->all();
                if($k < 31){
                    if($answers[$v]->positive == 1)
                    {
                        switch($answers[$v]->color) 
                        {
                            case 'красный':
                                array_push($r, $answers[$v]->option);
                            break;
                            case 'синий':
                                array_push($b, $answers[$v]->option);
                            break;
                            case 'белый':
                                array_push($w, $answers[$v]->option);
                            break;
                            case 'желтый':
                                array_push($y, $answers[$v]->option);
                            break;
                        }
                        $posdata=array_map(null,$r,$b,$w,$y);
                        
                    } else {
                        switch($answers[$v]->color) 
                        {
                            case 'красный':
                                array_push($nr, $answers[$v]->option);
                            break;
                            case 'синий':
                                array_push($nb, $answers[$v]->option);
                            break;
                            case 'белый':
                                array_push($nw, $answers[$v]->option);
                            break;
                            case 'желтый':
                                array_push($ny, $answers[$v]->option);
                            break;
                        }
                        $negdata=array_map(null,$nr,$nb,$nw,$ny);
                    }
                } else {
                    $data[] = $answers[$v]->color;
                }
            }
            $data = array_count_values($data);
            $data += $data1;
            $piedata = collect([
                ["value"=>round($data["красный"] / 15 * 100, 1) .'%',
                "color"=>"#d86858",
                "label"=>"красный"],
                ["value"=>round($data["желтый"] / 15 * 100, 1) .'%',
                'color'=>"#f9ed7d",
                "label"=>"желтый"],
                ['value'=>round($data["синий"] / 15 * 100, 1) .'%',
                "color"=>"#4b7395",
                "label"=>"синий"],
                ["value"=>round($data["белый"] / 15 * 100, 1) .'%',
                "color"=>"#dddedd",
                "label"=>"белый"]
                ]);
            $piedata->toJson();
            $user = Auth::user();
            $report = $user->report;

            // $pdf = \App::make('dompdf.wrapper');
            // $pdf = $pdf->loadView('reports.report_1', ['user'=>$user,'piedata'=>$piedata, 'posdata'=>$posdata, 'negdata'=>$negdata]);
            // $filename = public_path().'/pdf/'.str_slug(Auth::user()->id).'.pdf';
            // $pdf->save($filename);
            // $report->fill([
                //     'report_1'=>'/pdf/'.Auth::user()->id.'.pdf'
                // ])->save();
                return view('reports.report_1', ['user'=>$user,'piedata'=>$piedata, 'posdata'=>$posdata, 'negdata'=>$negdata]);
                
                
            }
            
        if(!empty($_POST['data']))
        {
            $data = base64_decode($_POST['data']);
            dd($data);
            file_put_contents( public_path()."/pdf/".str_slug(Auth::user()->id)."/report_1.pdf", $data );
        }
        if(is_readable("/poll.json"))
        {
            $questions = Question::get()->all();
            foreach($questions as $question)
            {
                $answers = Answer::where('question_id', $question->id)->get()->all();
                $ques_ans[] = [
                    'id'=>$question->id,
                    'question'=>$question->question,
                    'answers'=>[$answers[0]->option,
                                $answers[1]->option,
                                $answers[2]->option,
                                $answers[3]->option]
                ];
                $data = collect($ques_ans);
                $data->toJson();
            }
            $file = fopen("/poll.json", "w");
            fwrite($file,$data);
            fclose($file);
        }
        $user = Auth::user();
        if(Auth::user() && Auth::user()->complete_survey == "да")
        {
            return redirect(Auth::user()->report->report_1);
        } else {
            return view('www.survey', ['user'=>$user]);
        }
    }
}
