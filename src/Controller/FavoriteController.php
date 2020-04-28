<?php


namespace App\Controller;


use App\Model\FavoriteManager;

class FavoriteController extends AbstractController
{
    public function add()
    {
        $json   = file_get_contents('php://input');
        $object = json_decode($json);
        $favoriteData = [];
        $favoriteData['user'] = $object->user;
        $favoriteData['item'] = $object->item;
        $favoriteManager = new FavoriteManager();
        $favoriteManager->insert($favoriteData);
        return $json;

    }
}
