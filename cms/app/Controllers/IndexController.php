<?php

namespace app\Controllers;

use Bootstrap\App;
use App\Queue\QueueManager;
use App\View\View;
use App\Validators\CSRF;
use App\Workers\Worker;

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
     * Show All results
     * view     returns the show view
     */
    public function show()
    {
            $servername = $this->app->getAppVariable('servername');
            $dbname = $this->app->getAppVariable('dbname');
            $username = $this->app->getAppVariable('username');
            $password = $this->app->getAppVariable('password');
            $tableName = $this->app->getAppVariable('dbtable');

            $dbconn = new \PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $dbconn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $sth = $dbconn->prepare("SELECT * FROM $tableName WHERE done = 1 ORDER BY created_at");
            try {
                $sth->execute();
                $fetchAllWorkers = $sth->fetchAll();
            } catch (\Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }

        $data["results"] = $fetchAllWorkers;

       return View::render($this->app->getAppVariable('VIEW_PATH') . 'show.php', $data);
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

            $servername = $this->app->getAppVariable('servername');
            $dbname = $this->app->getAppVariable('dbname');
            $username = $this->app->getAppVariable('username');
            $password = $this->app->getAppVariable('password');

            $dbconn = new \PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $dbconn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            unset($_POST['csrf']);
            $request = $_POST;

            if ($request):
                $queueManager = new QueueManager();
                $queueManager->addToQueue($request, $dbconn);
            endif;

            $dbconn = null;
            echo json_encode(['success' => 'success', 'data'=> ['msg' => 'Request added to queue!']]);
            header('Location: '.'/');
            return;
        else :
            echo json_encode(['success' => 'failed', 'data'=> ['ERROR' => 'CSRF failed!']]);
            return;
        endif;
    }

    /**
     * Resolves all waiting queues
     * @return string Done
     */
    public function resolveAllQueues()
    {
        $servername = $this->app->getAppVariable('servername');
        $dbname = $this->app->getAppVariable('dbname');
        $username = $this->app->getAppVariable('username');
        $password = $this->app->getAppVariable('password');
        $tableName = $this->app->getAppVariable('dbtable');

        $dbconn = new \PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $dbconn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $worker = new Worker;
        $workLoad = $worker->getFromQueue($dbconn, $tableName);
        $worker->work($workLoad, $dbconn, $tableName);

        $dbconn = null;

        print_r('Done!');
        header('Location: '.'/show');
    }
}
