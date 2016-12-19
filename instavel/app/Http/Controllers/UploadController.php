<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use Auth;
use File;
use Storage;
use Illuminate\Support\Facades\Input;


class UploadController extends Controller
{
      /**

     * Generate Image upload View

     *

     * @return void

     */
  
      public function __construct()
    {
        $this->middleware('auth');
    }

    public function dropzone()

    {
  

        return view('web.dropzone')->with('error','0');

    }
     public function dropzone_single()

    {
  

        return view('web.dropzonesingle')->with('error','0');

    }
       public function getUploader()

    {
  

        return view('web.uploader')->with('error','0');

    }


    /**

     * Image Upload Code

     *

     * @return void

     */

    public function dropzoneStore(Request $request)

    {

        $image = $request->file('file');
        
        $imageName = time().'|'.$image->getClientOriginalName();
        //Guardamos foto en carpeta de usuario
      
        $image->move(public_path('/images/' . Auth::user()->nickname),$imageName);
      
             
        //Guardamos en DB
        $photo=new Photo;
        $photo->id_user=Auth::user()->id;
        $photo->path=/*public_path() .*/'/images/' . Auth::user()->nickname.'/'.$imageName;
        $photo->photoname=$image->getClientOriginalName();
        $photo->likes=0;
        $photo->description='';
        $photo->mode='public';
        $photo->author=Auth::user()->nickname;
      
        $res=$photo->save();

       
        //return $photo->save();
        return response()->json(['success'=>$imageName]);

    }
    public function dropzoneStoreSingle(Request $request)

    {
        // return view('web.mensaje')->with('msj','<div>'.$request->mode.'</div>');
    $image = $request->file('file');
    $description=$request->description;
    $tags=$request->tags;
    $mode=$request->mode;
    $tittle=$request->tittle;
          $imageName = time().'|'.Input::file('file')->getClientOriginalName();//es lo mismo que lo de abajo
        //$imageName = time().'|'.$image->getClientOriginalName();
      
      
        //Guardamos foto en carpeta de usuario
      
        $image->move(public_path('/images/' . Auth::user()->nickname),$imageName);
      
             
        //Guardamos en DB
        $photo=new Photo;
        $photo->id_user=Auth::user()->id;
        $photo->path=/*public_path() .*/'/images/' . Auth::user()->nickname.'/'.$imageName;
        $photo->photoname=$image->getClientOriginalName();
        $photo->likes=0;
        $photo->description=$description;
        $photo->mode=$mode;
        $photo->tags=$tags;
        $photo->tittle=$tittle;
        $photo->author=Auth::user()->nickname;
      
        $res=$photo->save();

       
        //return $photo->save();
        return response()->json(['success'=>$imageName]);
    }
    public function dropzoneStoreCam(Request $request)

    {
    $image = $request->file;
    //$image = str_replace('data:image/png;base64,', '', $image);
    //$image = str_replace(' ', '+', $image);  
      
    $binary_data = base64_decode($image);
     $imageName = time().'|cam.jpg';
    // save to server (beware of permissions)
    $result = file_put_contents( 'images/'.Auth::user()->nickname.'/'.$imageName, $binary_data );
    if (!$result) die("Could not save image!  Check file permissions.");
      else{
      
        //Guardamos en DB
        $photo=new Photo;
        $photo->id_user=Auth::user()->id;
        $photo->path=/*public_path() .*/'/images/' . Auth::user()->nickname.'/'.$imageName;
        $photo->photoname=$imageName;
        $photo->likes=0;
        $photo->description='';
        $photo->mode='public';
        $photo->author=Auth::user()->nickname;
      
        $res=$photo->save();

      }
        //return $photo->save();
        $photocam=Photo::where('path',$photo->path)->first();
        $out='<h5><a href="/view/'.$photocam->id.'">Ver Publicación</a></h5>';
        return Response($out);
        //return response()->json(['success'=>$imageName]);

    }

}
