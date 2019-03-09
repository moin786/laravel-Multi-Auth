<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function __construct() {
       $this->middleware('auth:customer');
    }
    /*
     * Image upload form
     */
    public function uploadImageForm() {
        $images = Image::where('user_id', auth()->user()->id)->get();
        return view('customer.mediaView.upload-image',compact('images'));
    }
    
    /*
     * pdf upload form
     */
    public function uploadPdfForm() {
        return view('customer.mediaView.upload-pdf');
    }
    
    public function uploadImage(Request $request) {
        if ($request->hasFile('mdimg')) {
            $imgname = str_replace(" ","",auth()->user()->id.time().$request->mdimg->getClientOriginalName());
            $img = $request->mdimg->getPathName();
            $imginfo = getimagesize($img);
            $width = $imginfo[0];
            $height = $imginfo[1];
            $dst = public_path()."/media-image/".$imgname;
            switch($imginfo[2]) {
                case IMAGETYPE_GIF:
                    $src = imagecreatefromgif($img);
                    break;
                case IMAGETYPE_JPEG:
                    $src = imagecreatefromjpeg($img);
                    break;
                case IMAGETYPE_PNG:
                    $src = imagecreatefrompng($img);
                    break;
                default:
                    return response()->json('Unknow file type', 406);
            }

            $old_x = imageSX($src);
            $old_y = imageSY($src);


            $new_width = (int)$request->imgwidth;
            $new_height = (int)$request->imgwidth;


            if($old_x > $old_y) 
            {
                $thumb_w    =   $new_width;
                $thumb_h    =   $old_y*($new_height/$old_x);
            }

            if($old_x < $old_y) 
            {
                $thumb_w    =   $old_x*($new_width/$old_y);
                $thumb_h    =   $new_height;
            }

            if($old_x == $old_y) 
            {
                $thumb_w    =   $new_width;
                $thumb_h    =   $new_height;
            }
            $tmp = imagecreatetruecolor($thumb_w, $thumb_h);
            imagecopyresampled($tmp, $src, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);
            $imgrec = new Image();
            $imgrec->title = $request->title;
            $imgrec->user_id = auth()->user()->id;
            $imgrec->imgfile = $imgname;
            $imgrec->save();
            //$request->mdimg->storeAs('public/media-image', $imgname);
            if($imginfo['mime'] === "image/png") {
                imagepng($tmp,$dst);
            } else if($imginfo['mime'] === "image/jpg") {
                imagejpeg($tmp, $dst);
            } else if($imginfo['mime'] === "image/jpeg") {
                imagejpeg($tmp, $dst);
            } else if($imginfo['mime'] === "image/gif") {
                imagegif($tmp, $dst);
            }
            return redirect()->route('customer.upload-image')->with(['msg'=> 'Image uploaded successfully']);
            //imagejpeg($tmp, $dst . ".jpg");
        } else {
            return response()->json('No file selected', 406);
        }
        
    }
    
    public function imageRandomView(Request $request) {
        if ($request->has('img')) {
            $imgname = $request->get('img');//str_replace(" ","",auth()->user()->id.$request->mdimg->getClientOriginalName());
            $getimage = Image::where('imgfile', $request->get('img'))->first();
            $path = public_path().'/media-image/'.$request->get('img');
            $img = $path;//File::get($path);//$request->mdimg->getPathName();
            $imginfo = getimagesize($img);
            $width = $imginfo[0];
            $height = $imginfo[1];
            $dst = public_path()."/media-image/".$request->get('width')."-".$imgname;
            switch($imginfo[2]) {
                case IMAGETYPE_GIF:
                    $src = imagecreatefromgif($img);
                    break;
                case IMAGETYPE_JPEG:
                    $src = imagecreatefromjpeg($img);
                    break;
                case IMAGETYPE_PNG:
                    $src = imagecreatefrompng($img);
                    break;
                default:
                    return response()->json('Unknow file type', 406);
            }

            $old_x = imageSX($src);
            $old_y = imageSY($src);


            $new_width = (int)$request->get('width');
            $new_height = (int)$request->get('width');


            if($old_x > $old_y) 
            {
                $thumb_w    =   $new_width;
                $thumb_h    =   $old_y*($new_height/$old_x);
            }

            if($old_x < $old_y) 
            {
                $thumb_w    =   $old_x*($new_width/$old_y);
                $thumb_h    =   $new_height;
            }

            if($old_x == $old_y) 
            {
                $thumb_w    =   $new_width;
                $thumb_h    =   $new_height;
            }
            $tmp = imagecreatetruecolor($thumb_w, $thumb_h);
            imagecopyresampled($tmp, $src, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);
            $imgrec = new Image();
            $imgrec->title = $getimage->title;
            $imgrec->user_id = auth()->user()->id;
            $imgrec->imgfile = $request->get('width')."-".$imgname;
            $imgrec->save();
            //$request->mdimg->storeAs('public/media-image', $imgname);
            if($imginfo['mime'] === "image/png") {
                imagepng($tmp,$dst);
            } else if($imginfo['mime'] === "image/jpg") {
                imagejpeg($tmp, $dst);
            } else if($imginfo['mime'] === "image/jpeg") {
                imagejpeg($tmp, $dst);
            } else if($imginfo['mime'] === "image/gif") {
                imagegif($tmp, $dst);
            }
            return '<img src="'.asset('media-image')."/".$request->get('width')."-".$imgname.'" style="max-width: 100%;"/>';
            //return redirect()->route('customer.upload-image')->with(['msg'=> 'Image uploaded successfully']);
            //imagejpeg($tmp, $dst . ".jpg");
        } else {
            return response()->json('No file selected', 406);
        }
    }
}
