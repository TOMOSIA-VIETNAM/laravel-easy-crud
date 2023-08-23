<?php

namespace VietNH\LaraEasyDev\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class Resource extends JsonResource
{
    /**
     * @var $meta
     */
    protected $meta;

    /**
     * Resource constructor.
     * @param $resource
     * @param MetaResource|MetaPaginationResource $meta
     */
    public function __construct($resource, $meta)
    {
        $this->meta = $meta;
        parent::__construct($resource);
    }

    public function getMeta() {
        return $this->meta;
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param Request $request
     * @return array
     */
    public function with($request): array
    {
        return [
            'meta' => $this->meta->toArray($request),
        ];
    }

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
