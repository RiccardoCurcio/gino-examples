<?php
namespace Src\Infrastructure\Repositories\v1\HealtCheckRepositories;

use Src\Infrastructure\Repositories\v1\HealtCheckRepositories\HealtCheckRepositoryInterface;

class HealtCheckRepository implements HealtCheckRepositoryInterface
{
    public function __construct()
    {
        //
    }

    public function checkGet() : array
    {
        return [
            "string" => "check get repository v1"
        ];
    }


    public function checkPost(mixed $body) : array
    {
        return [
            "string" => "check post repository v1",
            "body" => $body
        ];
    }
}
