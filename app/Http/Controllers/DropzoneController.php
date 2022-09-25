<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DropzoneController extends Controller
{
    function index()
    {
     return view('dropzone');
    }

    function upload(Request $request)
    {
    $userid = Auth::id();
    $image = $request->file('file');
    $type = $request->type;
    $num = 0;
    // $ext = $image->extension();
    $ext = pathinfo($request->filename, PATHINFO_EXTENSION);
    $imageName = time() . '-' . $num . '.' . $ext;

    if ($type == 'implementation_matter_file'){
        
        $letter_num = $request->letter_num;
        while(file_exists(public_path($type . '\\' . $letter_num . '\\' . $imageName))){
            $num+=1;
            $imageName = time() . '-' . $num . '.' . $ext;
        }
        DB::table('implementation_matter_file')->insert([
            'implementation_matter_id' => $request->implementation_matter_id,
            'letter_num' => $letter_num,
            'filename' => $imageName,
            'founder' => $userid,
            'original_filename' => $request->filename,
        ]);
        $image->move(public_path($type . '\\' . $letter_num), $imageName);
        return response()->json(['success',$imageName]);
    }
    else if ($type == 'sub_plan_fund_detail_file'){
        
        $requisition_num = $request->requisition_num;
        while(file_exists(public_path($type . '\\' . $requisition_num . '\\' . $imageName))){
            $num+=1;
            $imageName = time() . '-' . $num . '.' . $ext;
        }
        DB::table('sub_plan_fund_detail_file')->insert([
            'sub_plan_fund_detail_id' => $request->sub_plan_fund_detail_id,
            'requisition_num' => $requisition_num,
            'filename' => $imageName,
            'founder' => $userid,
            'original_filename' => $request->filename,
        ]);
        $image->move(public_path($type . '\\' . $requisition_num), $imageName);
        return response()->json(['success',$imageName]);
    }
    return response()->json(['error'=>$type]);

    }

    function fetch()
    {
     $images = \File::allFiles(public_path('images'));
     $output = '<div class="row">';
     foreach($images as $image)
     {
      $output .= '
      <div class="col-md-2" style="margin-bottom:16px;" align="center">
                <img src="'.asset('images/' . $image->getFilename()).'" class="img-thumbnail" width="175" height="175" style="height:175px;" />
                <button type="button" class="btn btn-link remove_image" id="'.$image->getFilename().'">Remove</button>
            </div>
      ';
     }
     $output .= '</div>';
     echo $output;
    }

    function delete(Request $request)
    {
     if($request->get('name'))
     {
      File::delete(public_path('images/' . $request->get('name')));
     }
    }
}
