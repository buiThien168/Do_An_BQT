<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use DB;


class TestController extends Controller
{   
    public function test(){
        // for ($i=1; $i <=6599 ; $i++) { 
        //     $getProduct = DB::table('products')->where('id',$i)->first('image_slide');
        //     if($getProduct !=null){
        //         $productReplace = str_replace("'", '"', $getProduct->image_slide);
        //         DB::table('products')->where('id',$i)->update(
        //             [
        //                 "image_slide"=>$productReplace
        //             ]
        //         );
        //     }
            
        // }

        // dd($productReplace);

        // for ($i=406; $i <=763 ; $i++) {
        //     $getProduct = DB::table('products')->where('id',$i)->first('content');
        //     $productReplace = str_replace("']", "", $getProduct->content);
        //     DB::table('products')->where('id',$i)->update(
        //         [
        //             "content"=>$productReplace
        //         ]
        //     );
            // $productReplace2 = str_replace("']", "", $getProduct->content);
            // DB::table('products')->where('id',$i)->update(
            //     [
            //         "content"=>$productReplace2
            //     ]
            // );
        // }
        
    }
}
