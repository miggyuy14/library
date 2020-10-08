<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $guarded =[];

    protected $dates = ['dob'];

    public function setAuthorAttribute($author)
    {
        $this->attribute['author_id'] = Author::firstOrCreate([
            'name' => $author,
        ]);
    }
}
