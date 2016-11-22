<?php

namespace Fansboard;

use Eloquent;

class Syncplayer extends Eloquent {

    protected $table = 'syncplayerlist';

    public function biodata()
    {
        return $this->hasOne('Fansboard\Biodata', 'fbido', 'fbido');
    }
    
}