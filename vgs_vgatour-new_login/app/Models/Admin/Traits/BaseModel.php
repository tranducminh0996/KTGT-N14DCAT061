<?php

namespace App\Models\Admin\Traits;

use App\Exceptions\NotFoundRecord;
use Illuminate\Support\Facades\Storage;

trait BaseModel
{
    /**
     * Get list all query in any model
     * @param array $params
     * @param array $with
     * @returns mixed
     */
    public static function getList(array $params = [], array $with = [])
    {
        $query = self::query()->with($with);

        if (method_exists(self::class, 'filterConditional')) {
            $query = self::filterConditional($query, $params);
        }
        if (method_exists(self::class, 'orderByData')) {
            $query = self::orderByData($query, $params);
        }
        $query = $query->orderBy('id', 'desc');

        return $query;
    }

    /**
     *  Get model by Id
     * @param $id
     * @param $with
     * @returns mixed
     */
    public static function getById($id, $with = [])
    {
        return self::query()->where('id', $id)->with($with)->first();
    }

    /**
     *  Get model by Slug
     * @param $slug
     * @param $with
     * @returns mixed
     */
    public static function getBySlug($slug, $with = [])
    {
        return self::query()->where('slug', $slug)->first();
    }

    /**
     *  Save or Update data
     * @param $params
     * @param $dataOrId
     * @param $request
     * @returns BaseModel|mixed|static
     * @throw NotFoundRecord
     */
    public static function storeUpdate($params, $dataOrId, $request = [])
    {
        if ($dataOrId instanceof self) {
            $data = $dataOrId;
        } elseif (!is_null($dataOrId)) {
            $data = self::getById($dataOrId);
            if (!$data) {
                throw new NotFoundRecord();
            }
        } else {
            $data = new self();
        }
        if (!empty($params['slug']) && !empty($data->id)) {
            $allExceptSelf = self::getList()->where('id', '!=', $data->id)->pluck('slug')->toArray;
            if (in_array($params['slug'], $allExceptSelf)) {
                $params['slug'] = $params['slug'] . '-' . rand(1, 10);
            }
        }
        $data->fill($params);
        $data->save();

        return $data;
    }


}
