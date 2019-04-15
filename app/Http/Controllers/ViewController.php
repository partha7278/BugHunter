<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\project;
use App\url;
use App\b_cat;
use App\bug;
use App\t_bug;
use App\testing;
use App\item;
use Cookie;


class ViewController extends Controller
{
    public function dtesting(){
        $cookie = 0;
        if(isset( $_COOKIE['testing'] )){
            $cookie = $_COOKIE['testing'];
        }

        $data = b_cat::all();
        $item = item::all();
        $bcount = bug::count();
        $tcount = testing::where('complete','true')->where('url_id',$cookie)->count();
        $url = url::find($cookie);

        if( count($url) > 0 ){
            return view('deshboard/testing',['category'=>$data,'url'=>$url,'bcount'=>$bcount,'tcount'=>$tcount,'item'=>$item]);
        }else{
            return view('error',['item'=>$item]);
        }
    }

    public function pupdate(){
        $data = project::orderBy('id', 'DESC')->get();
        $item = item::all();
        return view('project/update',['project'=>$data,'item'=>$item]);
    }

    public function bnew($err=''){
        if(empty($err)){ $error= 2; }
        else{ $error= $err; }

        $data = b_cat::all();
        $item = item::all();
        return view('bug/new',['category'=>$data,'error'=>$error,'item'=>$item]);
    }

    public function bupdate($err=''){
        if(empty($err)){ $error= 2; }
        else{ $error= $err; }

        $data = b_cat::all();
        $item = item::all();
        return view('bug/update',['category'=>$data,'error'=>$error,'item'=>$item]);
    }

    public function binfo(){
         $id = $_GET['id'];
         $bug = bug::find($id);
         $item = item::all();
         return view('bug/info',['data'=>$bug,'item'=>$item]);
    }

    public function pview(){
        $data = project::orderBy('id', 'DESC')->get();
        $item = item::all();
        return view('project/view',['project'=>$data,'item'=>$item]);
    }

    public function breport(){
        $id = $_GET['id'];
        $t_bug = t_bug::find($id);
        $b_cat = b_cat::all();
        $item = item::all();
        return view('bug/report',['t_bug'=>$t_bug,'b_cat'=>$b_cat,'item'=>$item]);
    }

}
