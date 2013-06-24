<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mszadm
 * Date: 15/06/2013
 * Time: 08:23
 * To change this template use File | Settings | File Templates.
 */
class Photofinder {
    private $_volume ;
    public function __construct($volume){

        $this->_volume = $volume;
    }
    public function sortByNumber($a,$b){
        if ($a>$b){
            return true;
        }else{
            return false;
        }
    }
    public  function createDirArray($dir){
        $movies = array();
        $images = array();
        $others = array();
        // Open a known directory, and proceed to read its contents
        if (is_dir($dir))
        {

            if ($dh = opendir($dir))
            {
                $count=0;

                while (($file = readdir($dh)) !== false)
                {

                    if ($file != "." && $file != "..") {
                        $count++;
                        $path = $dir.'/'.$file;
                        $matches=array();
                        preg_match('/[A-Z\_]*([\d]+)\.(.*)/',$file,$matches);
                        $filetype = $matches[2];
                        $num = $matches[1];


                        echo "filename: $file " . '  '.$count. ' ' .$matches[1]. ' ' .$matches[2]."\n";
                        //echo "filename: $file " .filemtime($file). '  '.$count. "\n";
                        //$files[filemtime($file)] = $file;
                        //$mtime = exec ('stat -f %Y '. escapeshellarg ($path));
                        //print_r ($mtime);
                        if ($filetype == 'JPG'){
                          $images[$num] = $path;
                        }elseif ($filetype == 'MOV'){
                            $movies[$num] = $path;
                        }else{
                            $others[$num] = $path;
                            print $file.' look '."\n";
                        }
                    }

                }
                print 'others:-'.count($others) . "\n";
                print 'movies:-'.count($movies) . "\n";
                print 'images:-'.count($images) . "\n";

                //print_r($movies);
                ksort($movies);
                //print_r($movies);
                //print_r($images);
                ksort($images);
                //print_r($images);
                closedir($dh);

                foreach ($movies as $num => $filename){
                    print "Last modified: " . date ("F d Y H:i:s.", filemtime($filename)) . '  '. $filename."\n";
                }
                foreach ($images as $num => $filename){
                    print "Last modified: " . date ("F d Y H:i:s.", filemtime($filename)) . '  '. $filename."\n";
                }
            }

        }
    }
    public function processFile($file){
        $file_handle = fopen($file, "r");
        while (!feof($file_handle)) {
            $line = chop(fgets($file_handle));
            $myCommand = "cp /Volumes/Hitachi/CanonPictures/\"Cannon 600D\"/DCIM/100CANON/IMG_".$line.".JPG /Users/mszadm/stick/.";
            exec($myCommand);

        }
        fclose($file_handle);
    }
}