<?php  
class MY_Controller extends MY_helper{
	public function __get($name) {
        if ($name === 'load') {
            return $this;
        }
    }

    public function view($viewName, $data = []) {
        $viewPath = APP_FOLDER.'/views/'. $viewName . '.php';
		//echo $viewPath;exit;
		if(file_exists($viewPath)) { extract($data); include $viewPath; }else echo "file View $viewName.php Not Found!";
		//exit;
    }
	
	public function model($modelName) {
        // Mendefinisikan path ke direktori model
        $modelPath = APP_FOLDER."/models/". $modelName . '.php';
		//echo $modelPath;exit;
        // Memuat model dengan menggunakan include atau require
		if(file_exists($modelPath)) {
			include "MY_models.php";
			include $modelPath; 
			$model = new $modelName();
			return $model;
		}else echo "file Models $modelName.php Not Found!";
		exit;
    }
}


?>