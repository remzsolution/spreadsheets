<?php
spl_autoload_register(function($className){
    $root = dirname(__FILE__);


    //class directories
    $directorys = array(
        "controllers",
        "dao",
        "models",
        "components"
    );

    //for each directory
    foreach($directorys as $directory)
    {
        $fileAbsPath = $root ."\\". $directory . "\\".$className . '.php';
        //see if the file exsists
        if(file_exists($fileAbsPath))
        {
            require_once($fileAbsPath);
            //only require the class once, so quit after to save effort (if you got more, then name them something else
            return;
        }
    }
});
