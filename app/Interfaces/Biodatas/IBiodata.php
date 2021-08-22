<?php


namespace App\Interfaces\Biodatas;


interface IBiodata
{
    public function detail($id);
    public function image($id, $profile);
    public function update($id, array $data);
}
