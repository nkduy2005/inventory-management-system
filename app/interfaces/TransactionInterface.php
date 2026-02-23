<?php

namespace App\Interfaces;

interface TransactionInterface
{
    public function transactions();
    public function import($request);
    public function export($request);
}
