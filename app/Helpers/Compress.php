<?php
namespace App\Helpers;

class Compress{

	protected $zip;
	protected $source;
	protected $destination;

	public function __construct($source,$destination) {
	   $this->zip = new \ZipArchive();
	   $this->source = $source;
	   $this->destination = $destination;
    }

    public function run(){
    	$this->open();
    	if(is_array($this->destination)){
    		foreach ($this->source as $value) {
    			$this->create($value);
    		}
    	}else{
    		$this->create($this->source);
    	}
    	return $this->close();
    }

    public function extract(){
    	$this->open();
    	$res = $this->zip->extractTo($this->source);
    	$this->close();
    	return $res;
    }

    public function create($source){
	    $source = realpath($source);
		if (is_dir($source)) {
			$files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($source), \RecursiveIteratorIterator::SELF_FIRST);
			foreach ($files as $file) {
				$fileTmp = str_replace('\\', '/', $file);
				if( in_array(substr($fileTmp, strrpos($fileTmp, '/')+1), array('.', '..')) )
	                continue;
				$file = realpath($file);
				if (is_dir($file)) {
					$path = str_replace(array($source . '/',$source . '\\'), '', $file . '/');
					$this->zip->addEmptyDir($path);
				} else if (is_file($file)) {
					$path = str_replace(array($source . '/',$source . '\\'), '', $file);
					$this->zip->addFromString($path, file_get_contents($file));
				}
			}
		} else if (is_file($source)) {
			$this->zip->addFromString(basename($source), file_get_contents($source));
		}
    }

    public function open(){
    	if (!$this->zip->open($this->destination, \ZIPARCHIVE::CREATE)) {
        	return false;
    	}
    }

    public function close(){
    	return $this->zip->close();
    }

}