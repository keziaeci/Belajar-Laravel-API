<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public $status, $message;

    public function __construct($status,$message,$resource)
    {
        parent::__construct($resource);
        $this->message = $message;
        $this->status = $status;

    }

    public function toArray(Request $request): array
    {
        return [
            'success' =>$this->status,
            'message' =>$this->message,
            'data' =>$this->resource,
        ];
        // return parent::toArray($request);
    }
}
