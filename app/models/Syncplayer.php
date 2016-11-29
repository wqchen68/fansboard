<?php

namespace Fansboard;

use Eloquent;

class Syncplayer extends Eloquent {

    protected $table = 'syncplayerlist';

    public function biodata()
    {
        return $this->hasOne('Fansboard\Biodata', 'fbido', 'fbido');
    }

    public function frame()
    {
        return $this->hasOne('Fansboard\SyncFrame', 'fbido', 'fbido')->where('datarange', 'ALL');
    }

    public function gamelogs()
    {
        return $this->hasMany('Fansboard\GameLog', 'fbido', 'fbido')->orderby('gdate');
    }

}