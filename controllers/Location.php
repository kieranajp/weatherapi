<?php

namespace Kieranajp\Weather\Controller;
use Kieranajp\Weather\Struct\BasicLocation;

class Location extends \SlimController\SlimController
{
    public function searchAction($search)
    {
        $client = new \GuzzleHttp\Client();

        $this->app->response->headers->set("Content-Type", "application/json");
        $res = $client->get(
            "https://maps.googleapis.com/maps/api/geocode/json?address="
            . urlencode(str_replace(" ", "+", $search))
        );

        $body = json_decode($res->getBody());
        $out  = [];

        foreach ($body->results as $r) {
            $l = new BasicLocation();
            $l->name = $r->formatted_address;
            $l->lat  = $r->geometry->location->lat;
            $l->lon  = $r->geometry->location->lng;

            $out[] = $l;
        }

        echo json_encode($out, JSON_PRETTY_PRINT);
    }
}
