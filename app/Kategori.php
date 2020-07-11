<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
      protected $table = 'kategori';
      protected $primaryKey = 'id_kategori';

      public $timestamps = false;
      public $incrementing = false;

      protected $guarded = [];

      public $rules = [
            'kategori' => 'required',
      ];

      public function getRouteKeyName()
      {
            return 'id_kategori';
      }
}
