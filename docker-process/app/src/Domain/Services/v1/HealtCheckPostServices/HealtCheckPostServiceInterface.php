<?php
namespace Src\Domain\Services\v1\HealtCheckPostServices;

interface HealtCheckPostServiceInterface
{
    public function execute(mixed $body) : array;
}
