<?php


namespace App\Repositories\Biodatas;


use App\Interfaces\Biodatas\IBiodata;
use App\Models\Biodata;

class BiodataRepository implements IBiodata
{
    public function detail($id)
    {
        return Biodata::query()->where("user_id", $id)->first();
    }

    public function image($id, $profile)
    {
        return Biodata::query()->where("user_id", $id)->update([
            "profile_picture"       => $profile
        ]);
    }

    public function update($id, array $data)
    {
        return Biodata::query()->where("user_id", $id)->update([
            "gender"        => $data["gender"],
            "phone"         => $data["phone"],
            "address"       => $data["address"],
        ]);
    }
}
