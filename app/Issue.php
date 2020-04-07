<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Issue extends Model
{
    protected $guarded = [];


    /**
     * check if the issue is closed
     *
     * @return bool
     */
    public function isClosed()
    {
        return $this->status == 'close';
    }


    /**
     * toggle the status of the issue
     *
     * @return bool
     */
    public function toggleStatus()
    {
        $this->isClosed() ? $this->status = 'open' : $this->status = 'close';

        return $this->save();
    }
}
