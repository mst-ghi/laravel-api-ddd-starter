<?php

namespace App\Infrastructure\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait Uuid
 *
 * @package App\Traits
 *
 * @method static all($columns = ['*'])
 * @method static find(string $identifier)
 * @method static fill(array $attributes)
 * @method static forceFill(array $attributes)
 * @method static where(string $column, $value)
 * @method static update(array $attributes = [], array $options = [])
 * @method static save(array $options = [])
 * @method static saveOrFail(array $options = [])
 * @method static finishSave(array $options)
 * @method static performUpdate(Builder $query)
 * @method static destroy($ids)
 * @method static delete()
 * @method static forceDelete()
 * @method static performDeleteOnModel()
 * @method static query()
 * @method static with($relations)
 * @method static load($relations)
 * @method static loadMorph($relation, $relations)
 * @method static loadMissing($relations)
 * @method static loadCount($relations)
 * @method static loadMorphCount($relation, $relations)
 * @method static increment($column, $amount = 1, array $extra = [])
 * @method static decrement($column, $amount = 1, array $extra = [])
 * @method static incrementOrDecrement($column, $amount, $extra, $method)
 * @method static incrementOrDecrementAttributeValue($column, $amount, $extra, $method)
 */
trait Uuid
{
    public static function bootUuid(): void
    {
        static::creating(function (self $model): void {
            if ($model->keyIsUuid() && empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = $model->generateUuidV4();
            }
        });
    }

    protected function keyIsUuid(): bool
    {
        return true;
    }

    protected function generateUuidV4(): string
    {
        return \Illuminate\Support\Str::uuid();
    }

    public function getKeyName()
    {
        return 'id';
    }

    public function getKeyType()
    {
        return $this->keyIsUuid() ? 'string' : 'int';
    }

    public function getIncrementing()
    {
        return !$this->keyIsUuid();
    }
}
