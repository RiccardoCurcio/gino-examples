<?php
namespace Src\Infrastructure\Repositories\v1\HealtCheckRepositories;

interface HealtCheckRepositoryInterface
{
    public function checkGet() : array;

    public function checkPost(mixed $body) : array;
}
