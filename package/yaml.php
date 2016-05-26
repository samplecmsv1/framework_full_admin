<?php namespace package;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Dumper;
/*
* author: sun kang 
* email:  sunkang@wstaichi.com
*/
 
class yaml{

	public $yaml;
    public $dumper;
	function __construct(){
		$this->yaml = new Parser();
        $this->dumper = new Dumper();
	}

	function file($file){ 
		try {
            return $this->yaml->parse(file_get_contents($file));
        } catch (ParseException $e) {
            printf("Unable to parse the YAML string: %s", $e->getMessage());
        }
	}

    function txt($txt){ 
        try {
            return $this->yaml->parse($txt);
        } catch (ParseException $e) {
            printf("Unable to parse the YAML string: %s", $e->getMessage());
        }
    }
 	

    function array_to_yaml($array){
        return $this->dumper->dump($array);
    }

    
    





}