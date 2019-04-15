<?php

namespace App\Http\Controllers;


use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use App\project;
use App\url;
use App\b_cat;
use App\bug;
use App\t_bug;
use App\testing;
use App\item;
use DB;
use Cookie;

class ActionController extends Controller
{

    public function addproject(Request $request){
        $project = new project;
        $project->project_name = $request->p_name;
        $project->contact = $request->p_contact;
        $project->save();

        $url = new url;
        $url->project_id = $project->id;
        $url->project_url = $request->p_url;
        $url->save();
    }
    public function addurl(Request $request){
        $url = new url;
        $url->project_id = $request->pid;
        $url->project_url = $request->url;
        $url->save();
        return response ()->json ( $url );
    }
    public function addcategory(Request $request){
        $cat = new b_cat;
        $cat->b_cat_name = $request->category;
        $cat->save();
        return response ()->json ( $cat );
    }
    public function addbug(Request $request){
        $bug = new bug;
        $bug->b_cat_id = $request->cat_id;
        $bug->bug_name = $request->bug_name;
        $bug->bug_nor = $request->bug_nor;
        $bug->bug_about = $request->bug_about;
        $bug->bug_impact = $request->bug_impact;
        $bug->bug_produce = $request->bug_produce;
        $bug->report = $request->bug_report;

        if($request->file('bug_poc_ex')){
            $file = $request->file('bug_poc_ex');
            $filename = $file->getClientOriginalName();

            //path to store data
            $path = public_path().'/uploads/';

            $file->move($path, $filename);
            $ex = $file->getClientOriginalExtension();
            $bug->bug_poc_exten = $ex;
            $newname = $request->bug_name.".".$ex;
            $new = $path."".$newname;
            $old = $path."".$filename;
            if(rename($old,$new)){
                $bug->bug_poc = $newname;
                $bug->save();
                return redirect()->route('b_new');
            }else{
                return redirect()->route('b_new', ['err' => 1]);
            }
        }else{
            $bug->save();
            return redirect()->route('b_update');
        }
    }
    public function addnewbug(Request $request){
        $bugid = $request->bugid;
        $urlid = $request->urlid;
        $testing = DB::table('testing')->where('bug_id',$bugid)->where('url_id',$urlid)->get();
        $cnt = $testing->count();
        $tid = 0;
        if($cnt == 0 ){
            $test = new testing;
            $test->bug_id = $bugid;
            $test->url_id = $urlid;
            $test->complete = $request->com;
            $test->save();
            $tid = $test->id;
        }else{
            $tid = $testing[0]->id;
        }
        $t_bug = new t_bug;
        $t_bug->testing_id = $tid;
        $t_bug->vulnerable_url = $request->url;
        $t_bug->send = 0;
        $t_bug->save();
    }



    public function deleteurl(Request $request){
        $url = url::find($request->uid);
        $url->delete();
    }
    public function deleteproject(Request $request){
        $project = project::find($request->pid);
        $project->delete();

    }
    public function deletebug(Request $request){
        $bug = bug::find($request->bug);
        $bug->delete();
    }


    public function updateproject(Request $request){
        $pid = $request->pid;
        $project = project::find($pid);
        $data = $request->data;
        $params = array();
        parse_str($data, $params);
        $project->project_name = $params['p_name'.$pid];
        $project->contact = $params['p_contact'.$pid];
        $project->save();
        foreach($params as $key => $value){
            $exp_key = explode('-', $key);
            if($exp_key[0] == 'p_url'){
                $ur = url::find($exp_key[1]);
                $ur->project_url = $value;
                $ur->save();
            }
        }
    }
    public function updatebug(Request $request){
        $bugid = $request->bug_id;
        $bug = bug::find($bugid);
        $bug->b_cat_id = $request->cat_id;
        $bug->bug_name = $request->bug_name;
        $bug->bug_nor = $request->bug_nor;
        $bug->bug_about = $request->bug_about;
        $bug->bug_impact = $request->bug_impact;
        $bug->bug_produce = $request->bug_produce;
        $bug->report = $request->bug_report;

        if($request->file('bug_poc_ex')){
            $file = $request->file('bug_poc_ex');
            $filename = $file->getClientOriginalName();

            //path to store data
            $path = public_path().'/uploads/';

            $file->move($path, $filename);
            $ex = $file->getClientOriginalExtension();
            $bug->bug_poc_exten = $ex;
            $newname = $request->bug_name.".".$ex;
            $new = $path."".$newname;
            $old = $path."".$filename;
            $rm_path =$path."".$bug->bug_poc;
            unlink($rm_path);
            if(rename($old,$new)){
                $bug->bug_poc = $newname;
                $bug->save();
                return redirect()->route('b_update');
            }else{
                return redirect()->route('b_update', ['err' => 1]);
            }
        }else{
            $bug->save();
            return redirect()->route('b_update');
        }
    }
    public function updatetesting(Request $request){
        $bugid = $request->bugid;
        $urlid = $request->urlid;
        $testing = DB::table('testing')->where('bug_id',$bugid)->where('url_id',$urlid)->get();
        $cnt = $testing->count();
        if($cnt == 0 ){
            $test = new testing;
            $test->bug_id = $bugid;
            $test->url_id = $urlid;
            $test->complete = $request->com;
            $test->save();
        }else{
            $test = testing::find($testing[0]->id);
            $test->complete = $request->com;
            $test->save();
        }
    }



    public function getbug(Request $request){
        $category = $request->category;
        $bug = DB::table('bug')->select('id','bug_name')->where('b_cat_id','=',$category)->get();
        return response()->json ( $bug );
    }
    public function getbugall(Request $request){
        $bugs = $request->bug;
        $bugall = bug::find($bugs);
        return response()->json ( $bugall );
    }



    public function testingcookie(Request $request){
        $urlid =  $request->urlid;
        setcookie('testing', $urlid, time()+60*60*24*365);
    }
    public function reportsubmit(Request $request){
        $t_bug = t_bug::find($request->t_bugid);
        if($request->sendid == 'true'){$send = 1;}else{$send = 0;}
        $t_bug->send = $send;
        $t_bug->save();
    }
    public function additem(Request $request){
        $item = new item;
        $item->name = $request->item_name;
        $item->url = $request->item_url;
        $item->type = $request->itemtype;
        $item->save();
        return $request->itemtype;
    }
    public function catsprogress(Request $request){
        $urlid = $request->urlid;
        $cats = DB::select(DB::raw( "select b_cat.id as catid, derived.completed as comp, cntbug.tbug as tobug from b_cat
                inner join ( select bug.b_cat_id as bug_cat, COUNT(bug.id) as completed from bug, testing where bug.id=testing.bug_id
                and testing.url_id=$urlid and testing.complete='true' GROUP BY bug.b_cat_id
                          ) derived on b_cat.id = derived.bug_cat
                inner join ( select b_cat.id as bcat ,COUNT(bug.id)  as tbug from bug, b_cat where bug.b_cat_id=b_cat.id GROUP BY bug.b_cat_id
                            ) cntbug on cntbug.bcat = b_cat.id" ));

        return $cats;
    }

}
