<?php

namespace App;

use Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
 	protected $table =  'flyer_photos';

 	protected $fillable = ['path', 'name', 'tumbnail_path'];

 	protected $baseDir = '1_flyers/photos';

    public function flyer()
    {
    	return $this->belongsTo('App\Flyer');
    }

    public static function named($name)
    {
        return (new static)->saveAS($name);
    }

    protected function saveAs($name)
    {
        $this->name = sprintf("%s-%s", time(), $name);
        $this->path = sprintf("%s/%s", $this->baseDir, $this->name);
        $this->tumbnail_path = sprintf("%s/tn-%s", $this->baseDir, $this->name);
        
        return $this;
    }

    public function move(UploadedFile $file)
    {
        $file->move($this->baseDir, $this->name);

        $this->makeThumbnail();

        return $this;
    }

    public function makeThumbnail()
    {
        Image::make($this->path)
            ->fit(100)
            ->save($this->tumbnail_path);


    }

}
