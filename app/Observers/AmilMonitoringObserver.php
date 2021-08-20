<?php

namespace App\Observers;

use App\Models\Amil;
use App\Models\Monitoring;

class AmilMonitoringObserver
{
    /**
     * Handle the Amil "created" event.
     *
     * @param  \App\Models\Amil  $amil
     * @return void
     */
    public function created(Amil $amil)
    {
        Monitoring::create([
            'id_amil' => $amil->id,
            'nama_amil' => $amil->nama
        ]);
    }

    /**
     * Handle the Amil "updated" event.
     *
     * @param  \App\Models\Amil  $amil
     * @return void
     */
    public function updated(Amil $amil)
    {
        Monitoring::firstOrCreate([
                    'id_amil' => $amil->id
                ])->update(['nama_amil' => $amil->nama]);
    }

    /**
     * Handle the Amil "deleted" event.
     *
     * @param  \App\Models\Amil  $amil
     * @return void
     */
    public function deleted(Amil $amil)
    {
        Monitoring::firstOrCreate([
                    'id_amil' => $amil->id
                ])->delete();
    }

    /**
     * Handle the Amil "restored" event.
     *
     * @param  \App\Models\Amil  $amil
     * @return void
     */
    public function restored(Amil $amil)
    {
        //
    }

    /**
     * Handle the Amil "force deleted" event.
     *
     * @param  \App\Models\Amil  $amil
     * @return void
     */
    public function forceDeleted(Amil $amil)
    {
        //
    }
}
