<?php

namespace Fansboard;

use Eloquent;

class GameLog extends Eloquent {

    protected $table = 'allgamelog';

    protected $appends = ['info', 'gd', 'current'];

    public function scopeSeason($query, $type)
    {
        return $query->whereSeason($type);
    }

    public function getInfoAttribute()
    {
        $info['min1'] = $this->attributes['bxgs'] == 1 ? round($this->attributes['bxmin'], 2) : 0;
        $info['min2'] = $this->attributes['bxgs'] == 0 ? round($this->attributes['bxmin'], 2) : 0;
        $info['date'] = $this->attributes['gdate'];
        $info['oppo'][$this->attributes['gdate']] = strtoupper($this->attributes['goppo']);

        return $info;
    }

    public function getGdAttribute()
    {
        //if ($game_length-$key<82) {
            $gd = [
                'gdate' => $this->attributes['gdate'],
                'goppo' => strtoupper($this->attributes['goppo']),
                'score' => $this->attributes['score'],
                'startfive' => $this->attributes['startfive'],
                'bxmin' => isset($this->attributes['bxmin']) ? sprintf("%.1f",round($this->attributes['bxmin'], 1)) : '-',
                'bxfgm' => isset($this->attributes['bxfgm']) ? $this->attributes['bxfgm'] : '-',
                'bxfga' => isset($this->attributes['bxfga']) ? $this->attributes['bxfga'] : '-',
                'bxfgp' => isset($this->attributes['bxfgp']) ? sprintf("%.1f",round($this->attributes['bxfgp'], 1)) : '-',
                'bx3ptm' => isset($this->attributes['bx3ptm']) ? $this->attributes['bx3ptm'] : '-',
                'bx3pta' => isset($this->attributes['bx3pta']) ? $this->attributes['bx3pta'] : '-',
                'bx3ptp' => isset($this->attributes['bx3ptp']) ? sprintf("%.1f",round($this->attributes['bx3ptp'], 1)) : '-',
                'bxftm' => isset($this->attributes['bxftm']) ? $this->attributes['bxftm'] : '-',
                'bxfta' => isset($this->attributes['bxfta']) ? $this->attributes['bxfta'] : '-',
                'bxftp' => isset($this->attributes['bxftp']) ? sprintf("%.1f",round($this->attributes['bxftp'], 1)) : '-',
                'bxoreb' => isset($this->attributes['bxoreb']) ? $this->attributes['bxoreb'] : '-',
                'bxdreb' => isset($this->attributes['bxdreb']) ? $this->attributes['bxdreb'] : '-',
                'bxtreb' => isset($this->attributes['bxtreb']) ? $this->attributes['bxtreb'] : '-',
                'bxast' => isset($this->attributes['bxast']) ? $this->attributes['bxast'] : '-',
                'bxto' => isset($this->attributes['bxto']) ? $this->attributes['bxto'] : '-',
                'bxst' => isset($this->attributes['bxst']) ? $this->attributes['bxst'] : '-',
                'bxblk' => isset($this->attributes['bxblk']) ? $this->attributes['bxblk'] : '-',
                'bxpf' => isset($this->attributes['bxpf']) ? $this->attributes['bxpf'] : '-',
                'bxpts' => isset($this->attributes['bxpts']) ? $this->attributes['bxpts'] : '-',
                'bxeff' => isset($this->attributes['bxeff']) ? $this->attributes['bxeff'] : '-',
                'bxeff36' => isset($this->attributes['bxeff36']) ? sprintf("%.1f",round($this->attributes['bxeff36'], 1)) : '-',
            ];
        //}
        return $gd;
    }

    public function getCurrentAttribute()
    {
        return $this->attributes['bxeff'];
    }

}