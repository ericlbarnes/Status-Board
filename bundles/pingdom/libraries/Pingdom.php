<?php
/**
 * Wrapper class around the Pingdom API for PHP
 * @author Sean Downey
 * @version 0.1
 */
class Pingdom {
    /**
     * Can be set to JSON (requires PHP 5.2 or the json pecl module) or XML - json|xml
     * @var string
     */
    var $type = 'json';
    
    /**
     * @var string
     */
    var $check_id='';
    
    /**
     * @var string
     */
    var $email='';
    
    /**
     * @var string
     */
    var $password='';
    
    /**
     * @var string
     */
    var $api_key='';
    
    /**
     * @var array
     */
    var $responseInfo=array();
    
    
    
    /**
    * @param string $query optional
    */
    function Pingdom($email, $password, $api_key, $check_id = '') {
        $this->email = $email;
        $this->password = $password;
        $this->api_key = $api_key;
        $this->check_id = $check_id;
    }
    
    
    /**
    * Build and perform the query, return the results.
    * @param $reset_query boolean optional.
    * @return object
    */
    function results($reset_query=true) {
        $request = 'https://api.pingdom.com/api/2.0/checks';
		
		if (is_numeric($this->check_id)) {
			$request .= '/'.$this->check_id;
		}
        
		if (is_numeric($this->check_id)) {
			$results[0] = $this->objectify($this->process($request))->check;
		}
		else {
			$results = $this->objectify($this->process($request))->checks;
		}
		
		// if there are results then generate a pretty elapsed time for the last down time
		if (is_array($results)) {
			$totalresults = count($results);
			for ($x=0; $x < $totalresults; $x++) {
                // default to check creation time if no downtime has occured
                if (!isset($results[$x]->lasterrortime)) {
                   $results[$x]->lasterrortime = $results[$x]->created;
                }
				$lasterrortime = $this->elapsedTime($results[$x]->lasterrortime);
				$results[$x]->lasterrortime_pretty = $this->elapsedTimeString($lasterrortime);

				$lasttesttime = $this->elapsedTime($results[$x]->lasttesttime);
				$results[$x]->lasttesttime_pretty = $this->elapsedTimeString($lasttesttime);
			}
		}
		
		return $results;
    }
    
    /**
     * Internal function where all the juicy curl fun takes place
     * this should not be called by anything external unless you are
     * doing something else completely then knock youself out.
     * @access private
     * @param string $url Required. API URL to request
     * @param string $postargs Optional. Urlencoded query string to append to the $url
     */
    function process($url, $postargs=false) {
        $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
        if($postargs !== false) {
            curl_setopt ($ch, CURLOPT_POST, true);
            curl_setopt ($ch, CURLOPT_POSTFIELDS, $postargs);
        }
        
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		// Set user (email) and password
		curl_setopt($ch, CURLOPT_USERPWD, $this->email.":".$this->password);
		// Add a http header containing the application key (see the Authentication section of this document)
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("App-Key: ".$this->api_key));
		// Ask cURL to return the result as a string
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		// check if we are running on windows
		if (preg_match("/Win32/", $_SERVER['SERVER_SOFTWARE'])) { 
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		}

		$response = curl_exec($ch);
        $this->responseInfo=curl_getinfo($ch);

		$error = curl_error($ch);
        curl_close($ch);
        
        if( intval( $this->responseInfo['http_code'] ) == 200 )
		{
            return $response;    
		}
        else
		{
            return false;
		}
    }
    
    /**
     * Function to prepare data for return to client
     * @access private
     * @param string $data
     */
    function objectify($data) {
        if( $this->type ==  'json' )
            return (object) json_decode($data);

        else if( $this->type == 'xml' ) {
            if( function_exists('simplexml_load_string') ) {
                $obj = simplexml_load_string( $data );

                $statuses = array();
                foreach( $obj->status as $status ) {
                    $statuses[] = $status;
                }
                return (object) $statuses;
            }
            else {
                return $out;
            }
        }
        else
            return false;
    }
	
	function elapsedTime ( $start, $end = false) {
		$returntime = array();
		
		// set defaults
		if ($end == false) {
			$end = time();
		}

		$diff = $end - $start;
		$days = floor($diff/86400); 
		$diff = $diff - ($days*86400); 

		$hours = floor ($diff/3600); 
		$diff = $diff - ($hours*3600); 

		$mins = floor ($diff/60); 
		$diff = $diff - ($mins*60); 

		$secs = $diff;

		if ($secs > 0) {
			$returntime['secs'] = $secs;
		}
		else {
			$returntime['secs'] = 0;
		}

		if ($mins > 0) {
			$returntime['mins'] = $mins;
		}
		else {
			$returntime['mins'] = 0;
		}

		if ($hours > 0) {
			$returntime['hours'] = $hours;
		}
		else {
			$returntime['hours'] = 0;
		}

		if ($days > 0) {
			$returntime['days'] = $days;
		}
		else {
			$returntime['days'] = 0;
		}

		return $returntime;
	}
	
	function elapsedTimeString($elapsedtime) {
		$nice_time  = !empty($elapsedtime['days']) ? $elapsedtime['days'] . "d" .  " " : '';
		$nice_time .= !empty($elapsedtime['hours']) ? $elapsedtime['hours'] . "h" .  " " : '';
		$nice_time .= !empty($elapsedtime['mins']) ? $elapsedtime['mins'] . "m" .  " " : '';
		if (empty($elapsedtime['days'])) {
			$nice_time .= !empty($elapsedtime['secs']) ? $elapsedtime['secs'] . "s" : '';
		}
		
		return $nice_time;
	}

}