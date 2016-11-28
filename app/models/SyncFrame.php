<?php

namespace Fansboard;

use Eloquent;

class SyncFrame extends Eloquent {

    protected $table = 'syncdataframe';

    protected $appends = ['stat'];

    public function player()
    {
        return $this->hasOne('Fansboard\Syncplayer', 'fbido', 'fbido');
    }

    public function getStatAttribute()
    {
        $pwpts = isset($this->attributes['pwpts']) ? $this->attributes['pwpts'] : '---';
        $pwtreb = isset($this->attributes['pwtreb']) ? $this->attributes['pwtreb'] : '---';
        $pwast = isset($this->attributes['pwast']) ? $this->attributes['pwast'] : '---';
        return sprintf("%.1f", round($pwpts, 1)).' pts, '.sprintf("%.1f", round($pwtreb, 1)).' reb, '.sprintf("%.1f", round($pwast, 1)).' ast';
    }

}