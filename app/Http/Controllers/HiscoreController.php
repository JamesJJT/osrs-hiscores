<?php

namespace App\Http\Controllers;

use App\DataFormatter\HiscoreFormat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

/**
 * Class HiscoreController
 * @package App\Http\Controllers
 */
class HiscoreController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function username(Request $request)
    {
        $request->validate([
            'username' => 'required'
        ]);

        $response = $this->getHiscoreData($request->get('username'));

        if (strpos($response->body(), '404 - Page not found')){
            return back()->withErrors([
                'notfound' => 'Username not found'
            ]);
        }

        $HiscoreFormat = new HiscoreFormat;
        $formatted_response = $HiscoreFormat->formatHiscore($response->body());

        return view('welcome')->with([
            'hiscore' => $formatted_response,
            'username' => $request->get('username')
        ]);
    }

    /**
     * @param $get
     * @return \Illuminate\Http\Client\Response|\Illuminate\Http\RedirectResponse
     */
    private function getHiscoreData($get)
    {
        try {
            $response =  Http::get('https://secure.runescape.com/m=hiscore_oldschool/a=12/index_lite.ws?player='.$get);
        }catch (\Exception $exception){
            return back()->withErrors([
                'connection' => 'Connection Error!'
            ]);
        }

        return $response;
    }
}
