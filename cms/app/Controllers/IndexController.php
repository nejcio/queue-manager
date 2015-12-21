<?php

namespace app\Controllers;

use Bootstrap\App;
use App\Models\HLR;
use App\View\View;
use App\Validators\CSRF;
use App\Validators\MSISDN;

class IndexController
{
    /*
    |--------------------------------------------------------------------------
    | Index Controller
    |--------------------------------------------------------------------------
    |
    | Controller that handles main app requests
    |
    */

    protected $app;

    /**
     * Controller constructor
     *  @param object $app       app spacific object
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    /**
     * Landing page of the app
     * @return view     returns the index view
     */
    public function index()
    {
        $data = ['csrf_token'=> CSRF::createToken()];
        return View::render($this->app->getAppVariable('VIEW_PATH') . 'index.php', $data);
    }

    /**
     * This method handles the post request
     * @return json    returns the json response
     */
    public function handle()
    {
        session_start();

        (array_key_exists('csrf', $_POST)) ? $postscrf = htmlspecialchars($_POST["csrf"]) : $postscrf = '';
        $csrfCheck = CSRF::csrfCheck($postscrf, $_SESSION['csrf']);

        if ($csrfCheck):

            else :

            echo json_encode(['success' => 'failed', 'data'=> ['ERROR' => 'CSRF failed!']]);

            return;

        endif;
    }
}
