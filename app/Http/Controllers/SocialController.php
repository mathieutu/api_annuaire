<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Transformers\SocialTransformer;

use App\Social;

class SocialController extends Controller
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
     * @return Response
     */
    public function index()
    {
        $socials = Social::with(self::$relationships)->paginate(30);

        return $this->response->paginator($socials, new SocialTransformer);
    }

    /**
     * Display the specified resource.
     *
     * @param    int    $id
     * @return Response
     */
    public function show($id)
    {
        $social = Social::with(self::$relationships)->findOrFail($id);

        return $this->response->item($social, new SocialTransformer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    int    $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int    $id
     * @return Response
     */
    public function destroy($id)
    {
        Social::findOrFail($id)->delete();
    }
}