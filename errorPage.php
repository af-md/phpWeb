require_once 'Model/CampsiteDataSet.php';

require_once 'Model/UserDataSet.php';

session_start();

$view = new stdClass;

$view->pageTitle= "Campsite Page";

$campsiteData = new CampsiteDataSet;

$userData = new UserDataSet;

require_once 'View/errorPage.phtml';