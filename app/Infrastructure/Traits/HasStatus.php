<?php

namespace App\Infrastructure\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait HasStatus
 *
 * @package App\Traits
 *
 * @property string $table
 * @property boolean $status
 *
 * @method static Builder Active()
 * @method static Builder InActive()
 */
trait HasStatus
{
    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeActive(Builder $query)
    {
        return $query->where("{$this->table}.{$this->table}_status", true);
    }

    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeInActive(Builder $query)
    {
        return $query->where("{$this->table}.{$this->table}_status", false);
    }

}
