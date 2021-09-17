<?php

namespace App\Infrastructure\Traits;

use Closure;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait ModelTrait
 *
 * @package App\Traits
 *
 * @property int $id
 *
 * @method static refresh()
 * @method static select(...$columns)
 * @method static fresh($with = [])
 * @method static all($columns = ['*'])
 * @method static find(string $identifier)
 * @method static fill(array $attributes)
 * @method static create(array $attributes)
 * @method static forceFill(array $attributes)
 * @method static where(string $column, $operator, $value = null)
 * @method static whereIn(string $column, array $options = [])
 * @method static whereNotIn(string $column, array $options = [])
 * @method static update(array $attributes = [], array $options = [])
 * @method static upsert(array $attributes = [], array $columns = [])
 * @method static save(array $options = [])
 * @method static saveOrFail(array $options = [])
 * @method static finishSave(array $options)
 * @method static performUpdate(Builder $query)
 * @method static firstOrNew(array $attributes)
 * @method static destroy($ids)
 * @method static delete()
 * @method static forceDelete()
 * @method static performDeleteOnModel()
 * @method static query()
 * @method static with($relations)
 * @method static withCount($relations)
 * @method static load($relations)
 * @method static loadMorph($relation, $relations)
 * @method static loadMissing($relations)
 * @method static loadCount($relations)
 * @method static loadMorphCount($relation, $relations)
 * @method static increment($column, $amount = 1, array $extra = [])
 * @method static decrement($column, $amount = 1, array $extra = [])
 * @method static incrementOrDecrement($column, $amount, $extra, $method)
 * @method static incrementOrDecrementAttributeValue($column, $amount, $extra, $method)
 *
 * @method static make(array $attributes = [])
 * @method static withGlobalScope($identifier, $scope)
 * @method static withoutGlobalScope($scope)
 * @method static withoutGlobalScopes(array $scopes = null)
 * @method static removedScopes()
 * @method static whereKey($id)
 * @method static whereBetween($column, array $values)
 * @method static whereKeyNot($id)
 * @method static whereNotNull($column)
 * @method static whereHas($relation, Closure $callback)
 * @method static whereExists(Closure $callback)
 * @method static firstWhere($column, $operator = null, $value = null, $boolean = 'and')
 * @method static orWhere($column, $operator = null, $value = null)
 * @method static latest($column = null)
 * @method static oldest($column = null)
 * @method static hydrate(array $items)
 * @method static fromQuery($query, $bindings = [])
 * @method static findMany($ids, $columns = ['*'])
 * @method static findOrFail($id, $columns = ['*'])
 * @method static findOrNew($id, $columns = ['*'])
 * @method static firstOrCreate(array $attributes, array $values = [])
 * @method static updateOrCreate(array $attributes, array $values = [])
 * @method static firstOrFail($columns = ['*'])
 * @method static firstOr($columns = ['*'], Closure $callback = null)
 * @method static get($columns = ['*'])
 * @method static orderBy($column, $type = 'asc')
 * @method static orderByDesc($column)
 * @method static filter($queries)
 */
trait ModelTrait
{
    //
}
