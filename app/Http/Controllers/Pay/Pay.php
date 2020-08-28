<?php


namespace App\Http\Controllers\Pay;


interface Pay {

    public function __construct($config);

    public function pay($payInfo);

}
