<?php

namespace Fansboard;

use Eloquent;

class SyncFrame extends Eloquent {

    protected $table = 'syncdataframe';

    protected $appends = ['stat', 'ability8', 'abilities'];

    public function player()
    {
        return $this->hasOne('Fansboard\Syncplayer', 'fbido', 'fbido')->where('datarange', $this->datarange);
    }

    public function getStatAttribute()
    {
        $pwpts = isset($this->attributes['pwpts']) ? $this->attributes['pwpts'] : '---';
        $pwtreb = isset($this->attributes['pwtreb']) ? $this->attributes['pwtreb'] : '---';
        $pwast = isset($this->attributes['pwast']) ? $this->attributes['pwast'] : '---';
        return sprintf("%.1f", round($pwpts, 1)).' pts, '.sprintf("%.1f", round($pwtreb, 1)).' reb, '.sprintf("%.1f", round($pwast, 1)).' ast';
    }

    public function getAbility8Attribute()
    {
        $ability[] = round($this->attributes['swftp'], 2);
        $ability[] = round($this->attributes['sw3ptm'], 2);
        $ability[] = round($this->attributes['swast'], 2);
        $ability[] = round($this->attributes['swst'], 2);
        $ability[] = round($this->attributes['swfgp'], 2);
        $ability[] = round($this->attributes['swblk'], 2);
        $ability[] = round($this->attributes['swtreb'], 2);
        $ability[] = round($this->attributes['swpts'], 2);

        return $ability;
    }

    public function getAbilitiesAttribute()
    {
        $ability[] = round($this->attributes['wgp'], 0);
        $ability[] = sprintf("%.2f", round($this->attributes['pwmin'], 2));
        $ability[] = sprintf("%.1f", round($this->attributes['pwfgm'], 1));
        $ability[] = sprintf("%.1f", round($this->attributes['pwfga'], 1));
        $ability[] = sprintf("%.1f", round($this->attributes['wfgp']*100, 1));
        $ability[] = sprintf("%.1f", round($this->attributes['pw3ptm'], 1));
        $ability[] = sprintf("%.1f", round($this->attributes['pw3pta'], 1));
        $ability[] = sprintf("%.1f", round($this->attributes['w3ptp']*100, 1));
        $ability[] = sprintf("%.1f", round($this->attributes['pwftm'], 1));
        $ability[] = sprintf("%.1f", round($this->attributes['pwfta'], 1));
        $ability[] = sprintf("%.1f", round($this->attributes['wftp']*100, 1));
        $ability[] = sprintf("%.1f", round($this->attributes['pworeb'], 1));
        $ability[] = sprintf("%.1f", round($this->attributes['pwdreb'], 1));
        $ability[] = sprintf("%.1f", round($this->attributes['pwtreb'], 1));
        $ability[] = sprintf("%.1f", round($this->attributes['pwast'], 1));
        $ability[] = sprintf("%.1f", round($this->attributes['pwto'], 1));
        $ability[] = sprintf("%.2f", round($this->attributes['watr'], 2));
        $ability[] = sprintf("%.2f", round($this->attributes['pwst'], 2));
        $ability[] = sprintf("%.2f", round($this->attributes['pwblk'], 2));
        $ability[] = sprintf("%.1f", round($this->attributes['pwpf'], 1));
        $ability[] = sprintf("%.1f", round($this->attributes['pwpts'], 1));
        $ability[] = sprintf("%.1f", round($this->attributes['pweff'], 1));
        $ability[] = sprintf("%.1f", round($this->attributes['pweff36'], 1));

        return $ability;
    }

}