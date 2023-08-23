<?php

namespace VietNH\LaraEasyDev\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     properties={
 *          @OA\Property(property="code", type="integer"),
 *          @OA\Property(property="message", type="string"),
 *          @OA\Property(property="errors", type="object")
 *     }
 * )
 */
class MetaResource extends JsonResource
{
    /**
     * @var int
     */
    public $code;

    /**
     * @var string
     */
    public $message;

    /**
     * @var array|null
     */
    public $errors;

    /**
     * MetaResource constructor.
     * @param int $code
     * @param string $message
     * @param null $errors
     */
    public function __construct(int $code, string $message, $errors = null)
    {
        $this->code = $code;
        $this->message = $message;
        $this->errors = $errors;
        parent::__construct($errors);
    }

    /**
     * @param $request
     * @param int $code
     * @param string $message
     * @param null $errors
     * @param null $pagination
     * @return array
     */
    public static function makeResponse($request, int $code, string $message, $errors = null, $pagination = null): array
    {
        $meta = new MetaPaginationResource($code, $message, $errors, $pagination);
        return $meta->toArray($request);
    }

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $arr = [
            "code" => $this->code,
            "message" => $this->message,
        ];

        if ($this->errors !== null) {
            $arr['errors'] = $this->errors;
        }

        return $arr;
    }
}
