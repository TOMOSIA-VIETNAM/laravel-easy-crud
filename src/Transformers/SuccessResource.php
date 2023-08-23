<?php

namespace VietNH\LaraEasyDev\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     properties={
 *          @OA\Property(
 *              property="meta",
 *              ref="#/components/schemas/MetaResource"
 *          )
 *     }
 * )
 */
class SuccessResource extends Resource
{
    /**
     * SuccessResource constructor.
     * @param null $resource
     * @param int $code
     * @param string $message
     */
    public function __construct($resource = null, $code = 200, $message = "Successful")
    {
        parent::__construct($resource, new MetaResource($code, $message, null));
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
