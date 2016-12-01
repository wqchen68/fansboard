<?php

namespace Fansboard;

use Eloquent;

class SplitStats extends Eloquent {

    protected $table = 'splitdata';

    protected $appends = ['formated', 'spcateKey'];

    public function getFormatedAttribute()
    {
        $formated = [
            'spmin' => sprintf('%.1f', $this->attributes['spmin']),
            'spfgm' => sprintf('%.1f', $this->attributes['spfgm']),
            'spfga' => sprintf('%.1f', $this->attributes['spfga']),
            'spfgp' => sprintf('%.1f', $this->attributes['spfgp']),
            'sp3ptm' => sprintf('%.1f', $this->attributes['sp3ptm']),
            'sp3pta' => sprintf('%.1f', $this->attributes['sp3pta']),
            'sp3ptp' => sprintf('%.1f', $this->attributes['sp3ptp']),
            'spftm' => sprintf('%.1f', $this->attributes['spftm']),
            'spfta' => sprintf('%.1f', $this->attributes['spfta']),
            'spftp' => sprintf('%.1f', $this->attributes['spftp']),
            'sporeb' => sprintf('%.1f', $this->attributes['sporeb']),
            'spdreb' => sprintf('%.1f', $this->attributes['spdreb']),
            'sptreb' => sprintf('%.1f', $this->attributes['sptreb']),
            'spast' => sprintf('%.1f', $this->attributes['spast']),
            'spto' => sprintf('%.1f', $this->attributes['spto']),
            'spatr' => sprintf('%.1f', $this->attributes['spatr']),
            'spst' => sprintf('%.1f', $this->attributes['spst']),
            'spblk' => sprintf('%.1f', $this->attributes['spblk']),
            'sppf' => sprintf('%.1f', $this->attributes['sppf']),
            'sppts' => sprintf('%.1f', $this->attributes['sppts']),
            'speff' => sprintf('%.1f', $this->attributes['speff']),
            'speff36' => sprintf('%.1f', $this->attributes['speff36']),
        ];

        return $formated;
    }

    public function getSpcateKeyAttribute()
    {
        $spcates = [
            '@Home' => ['HomeAway', 0],
            '@Away' => ['HomeAway', 1],
            'Day' => ['dayNight', 0],
            'Night' => ['dayNight', 1],
            'As Starter' => ['Starter', 0],
            'As Sub' => ['Starter', 1],
            '0 Days Rest' => ['Rest', 0],
            '1 Days Rest' => ['Rest', 1],
            '2 Days Rest' => ['Rest', 2],
            '3+ Days Rest' => ['Rest', 3],
        ];

        return isset($spcates[$this->attributes['spcate']]) ? $spcates[$this->attributes['spcate']] : NULL;
    }

}