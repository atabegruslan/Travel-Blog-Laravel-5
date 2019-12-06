<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entry;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;

class EntryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entries = Entry::orderBy('time', 'DESC')->paginate(PAG);
        
        return view('entry/index', ['param' => $entries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('entry/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'place' => 'required|unique:entries|max:15',
            'comments' => 'required|max:50',
        ]); 

        $initial_image_name = $request->file('image');
        $final_image_name = rand(10000,99999).time().'.'.$initial_image_name->getClientOriginalExtension();
        $final_image_path = IMG_DIR;
        $initial_image_name->move($final_image_path, $final_image_name);
        $this->editImage(IMG_RAD, PUB_URL.'images/'.$final_image_name, 'images/'.$final_image_name);

        $entry = new Entry;
        $entry->place = $request->input('place');
        $entry->comments = $request->input('comments');
        $entry->user_id = $request->input('user_id');
        $entry->img_url = PUB_URL.'images/'.$final_image_name;
        $entry->save();

        $gcmResult = app('App\Http\Controllers\GcmController')->sendGcm($entry->place);

        \Session::flash('success', 'New Entry Created');

        return Redirect::to('/entry');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entry = Entry::where('id', $id)->first();
        return view('entry/show', ['param' => $entry]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entry = Entry::where('id', $id)->first();
        return view('entry/edit', ['param' => $entry]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {    
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'place' => 'max:15',
            'comments' => 'max:50',
        ]); 

        $entry = Entry::where('id', $id)->first();
        $entry->update([
            'place' => $request->input('place'),
            'user_id' => $request->input('user_id'),
            'comments' => $request->input('comments')
        ]);

        if($request->file('image')){

            // make new image
            $initial_image_name = $request->file('image');
            $final_image_name = rand(10000,99999).time().'.'.$initial_image_name->getClientOriginalExtension();
            $final_image_path = IMG_DIR;
            $initial_image_name->move($final_image_path, $final_image_name);
            $this->editImage(IMG_RAD, PUB_URL.'images/'.$final_image_name, 'images/'.$final_image_name);

            // delete old image
            $imageNameParts = explode("/", $entry->img_url);
            $imageName = $imageNameParts[ count($imageNameParts) - 1 ];
            \File::delete("images/".$imageName);
            
            // update database
            $entry->update([
                'img_url' => PUB_URL.'images/'.$final_image_name
            ]);
        }

        \Session::flash('success', 'Entry Updated');

        //return back()->withInput();
        return Redirect::to('/entry');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entry = Entry::where('id', $id)->first();

        $imageNameParts = explode("/", $entry->img_url);
        $imageName = $imageNameParts[ count($imageNameParts) - 1 ];
        \File::delete("images/".$imageName);

        $entry->delete();

        \Session::flash('success', 'Entry Deleted');

        return Redirect::to('/entry');
    }

    function editImage($size, $src, $dest, $quality = 80){
        $imgsize = getimagesize($src);
        $width = $imgsize[0];
        $height = $imgsize[1];
        $mime = $imgsize['mime'];
     
        switch($mime){
            case 'image/gif':
                $image_create = "imagecreatefromgif";
                $image = "imagegif";
                break;
     
            case 'image/png':
                $image_create = "imagecreatefrompng";
                $image = "imagepng";
                $quality = 7;
                break;
     
            case 'image/jpeg':
                $image_create = "imagecreatefromjpeg";
                $image = "imagejpeg";
                $quality = 80;
                break;
     
            default:
                return false;
                break;
        }

        $this->makeSquare($size, $src, $dest, $image, $image_create, $width, $height, $quality);
        $this->makeCircle($size, $src, $dest, $image, $image_create, $quality);
    }

    function makeSquare($size, $src, $dest, $image, $image_create, $width, $height, $quality){
         
        $dst_img = imagecreatetruecolor($size, $size);
        $src_img = $image_create($src);
         
        $width_new = $height;
        $height_new = $width;
        //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
        if($width_new > $width){
            //cut point by height
            $h_point = (($height - $height_new) / 2);
            //copy image
            imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $size, $size, $width, $height_new);
        }else{
            //cut point by width
            $w_point = (($width - $width_new) / 2);
            imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $size, $size, $width_new, $height);
        }
        
        $image($dst_img, $dest, $quality);

        if($src_img)imagedestroy($src_img);
        if($dst_img)imagedestroy($dst_img);
    }

    function makeCircle($size, $src, $dest, $image, $image_create, $quality){
        
        $mask = imagecreatetruecolor($size, $size);        
        $dst_img = $image_create($src);

        $maskTransparent = imagecolorallocate($mask, 255, 0, 255);
        imagecolortransparent($mask, $maskTransparent);
        imagefilledellipse($mask, $size / 2, $size / 2, $size, $size, $maskTransparent);
        
        imagecopymerge($dst_img, $mask, 0, 0, 0, 0, $size, $size, 100);
        $dstTransparent = imagecolorallocate($dst_img, 255, 0, 255);
        imagefill($dst_img, 0, 0, $dstTransparent);
        imagefill($dst_img, $size - 1, 0, $dstTransparent);
        imagefill($dst_img, 0, $size - 1, $dstTransparent);
        imagefill($dst_img, $size - 1, $size - 1, $dstTransparent);
        imagecolortransparent($dst_img, $dstTransparent);
        
        $image($dst_img, $dest, $quality); 

        if($mask)imagedestroy($mask);
        if($dst_img)imagedestroy($dst_img);       
    }
}
