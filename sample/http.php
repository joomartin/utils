<?php

use Joomartin\Utils\Http\Http;

require __DIR__ . '/../vendor/autoload.php';

// GET JSON
var_dump((new Http('http://httpbin.org/ip'))->get(true));

// GET HTML
var_dump((new Http('http://google.com'))->get());

// POST
var_dump((new Http('http://httpbin.org/post'))->post());
