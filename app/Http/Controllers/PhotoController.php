<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Transformers\PhotoTransformer;

use App\Models\User;
use App\Models\Photo;

class PhotoController extends Controller
{
    /**
     * List of relationships to load.
     *
     * @var array
     */
    private static $relationships = [];

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $users = Photo::with(self::$relationships)->paginate($request->input('items', 30));

        return $users;
    }

    /**
     * Display the specified resource.
     *
     * @param Photo $photo
     * @return Response
     */
    public function show(Photo $photo)
    {
        return $photo->load(self::$relationships);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Photo $photo
     * @return Response
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Photo $photo
     * @return Response
     */
    public function destroy(Photo $photo)
    {
        $photo->delete();

        return $this->response->accepted('Resource was deleted.');
    }
}
