<?php

namespace Awni\Controllers;

use Awni\Controller;
use Awni\Subject;
use Awni\Topic;
use Awni\Quran;
use Awni\User;
use DS\View;
use Illuminate\Database\Connection;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class Main extends Controller
{
    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return ResponseInterface
     */
    public function home(Request $request, Response $response)
    {
        return $this->container['theme']
            ->with([
                'content' => View::make('page/home'),
                'page' => 'Home'
            ])
            ->renderInto($response);
    }

    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return ResponseInterface
     */
    public function about(Request $request, Response $response)
    {
        return $this->container['theme']
            ->with([
                'content' => View::make('page/about'),
                'page' => 'About'
            ])
            ->renderInto($response);
    }

    public function searchProccess(Request $request, Response $response)
    {
        $postVar = $request->getParsedbody();
        $text = $postVar['search'];

        $apikey = "cc12540abedfa669021307d4ba111d87";
        $bdb = new \Pintlabs_Service_Brewerydb($apikey);
        $bdb->setFormat('php'); // if you want to get php back.  'xml' and 'json' are also valid options.
        $params = array("tes" => $text, "type" => "beer");

        try {
            $results = $bdb->request('beers', $params, 'GET'); // where $params is a keyed array of parameters to send with the API call.
        } catch (Exception $e) {
            $results = array('error' => $e->getMessage());
        }

        //$newResults = $results['data'];
        $size = sizeof($results['data']);
        $arr = array();
        $params = array();

        for($i = 0; $i < 5; $i++) {

            try {
                $arr[$i] = $bdb->request('beer/' . $results['data'][$i]['id'], $params, 'GET'); // where $params is a keyed array of parameters to send with the API call.
            } catch (Exception $e) {
                $arr[$i] = array('error' => $e->getMessage());
            }
        }


        return $this->container['theme']
            ->with([
                'content' => View::make('page/home')->with(['results' => $arr]),
                'page' => 'Home',
            ])
            ->renderInto($response);


        //return $this->container['theme']->with(['content' => View::make('page/login') ->with(['displayError' => $displayError]), 'page' => 'Login'])->renderInto($response);
    }

}
