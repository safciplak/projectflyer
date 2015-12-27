<?php

namespace App\Http\Controllers;


use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Requests\FlyerRequest;
use App\Http\Controllers\Controller;
use App\Flyer;
use App\Photo;

class FlyersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

	public function index()
    {
    	return view('flyers.create');
    }


    public function show($zip, $street)
    {
       $flyer = Flyer::locatedAt($zip, $street);
       return view('flyers.show', compact('flyer'));
    }

     public function create()
    {
        flash()->overlay('Hello World!', 'This is the message');

        return view('flyers.create');
    }


    public function store(FlyerRequest $request)
    {

        Flyer::create($request->all());

        flash('Success !', 'Your Flyer has been created!');

    	return redirect()->back();
    }

    public function addPhoto($zip, $street, Request $request)
    {

        $this->validate($request,[
                'photo' => 'required|mimes:jpg,jpeg,png,bmp'
        ]);

        $photo = $this->makePhoto($request->file('photo'));

        Flyer::locatedAt($zip, $street)->addPhoto($photo);

    }

    protected function makePhoto(UploadedFile $file)
    {
        return Photo::named($file->getClientOriginalName())
            ->move($file);
    }
}
