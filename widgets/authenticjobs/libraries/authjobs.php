<?php 


class Authjobs
{

	/**
	 * Location of the authentic jobs api
	 *
	 * @var string
	 */
	private $authjobs_api_url = 'http://www.authenticjobs.com/api/';
	
	/**
	 * Api key
	 *
	 * @var string
	 */
	private $authjobs_api_key = 'xxx';	//your key goes here
	
	/*** Search criteria ***/
	
	/*
	 * 
	 category: The id of a job category to limit to. See aj.categories.getList
     type: The id of a job type to limit to. See aj.types.getList
     sort: Accepted values are: date-posted-desc (the default) and date-posted-asc
     company: Free-text matching against company names. Suggested values are the ids from aj.jobs.getCompanies
     location: Free-text matching against company location names. Suggested values are the ids from aj.jobs.getLocation
     telecommuting: Set to 1 if you only want telecommuting jobs
     keywords: Keywords to look for in the title or description of the job posting. Separate multiple keywords with commas.
     page: The page of listings to return. Defaults to 1.
	 perpage: The number of listings per page. The default value is 10. The maximum value is 100.
	 * 
	 * 
	 */
	
	
	
	function get_jobs_data($search_criteria)
	{
	
		$this->build_request_url($search_criteria);
		
		
		if ($this->make_request())
		{
		
			$xml = new SimpleXMLElement($this->raw_data);

			$return_array = array();
			
			if ($xml->attributes()->stat = 'ok')
			{		
				if ($xml->listings->attributes()->total > 0)
				{	
					//$return_array = $xml->listings->attributes()->total;	
						
          			foreach ($xml->listings->listing as $listing)
          			{
          			
          				$return_array[(int)$listing->attributes()->id]['id'] = (int)$listing->attributes()->id; 
          				$return_array[(int)$listing->attributes()->id]['title'] = (string)$listing->attributes()->title;
          				$return_array[(int)$listing->attributes()->id]['category'] = (string)$listing->category->attributes()->name;
          				$return_array[(int)$listing->attributes()->id]['type'] = (string)$listing->type->attributes()->name;
          				
          				if (((string)$listing->company))
          				{
          					$return_array[(int)$listing->attributes()->id]['company'] = (string)$listing->company->attributes()->name;
          					$return_array[(int)$listing->attributes()->id]['company_url'] = (string)$listing->company->attributes()->url;
          					
               				if (((string)$listing->company->location))
               				{               				
                    				$return_array[(int)$listing->attributes()->id]['location_city'] = (string)$listing->company->location->attributes()->city;
                    				$return_array[(int)$listing->attributes()->id]['location_state'] = (string)$listing->company->location->attributes()->state;
                    				$return_array[(int)$listing->attributes()->id]['location_country'] = (string)$listing->company->location->attributes()->country;
               				}
          				}

          			}
          			
				}
				else
				{
					$return_array = 'No results for your search.';
				}
     		}
     		else
     		{
     			$return_array = 'Error:'.(string)$xml->err->attributes()->desc;
     		}
			return $return_array;
		
		}
	
	
	
	}
	
	private function build_request_url($search_criteria)
	{
	    foreach ($search_criteria as $key=>$value)
        {
            if ($value)
            {
                $params .= '&'.$key.'='.$value;
            }
        }

		$this->authjobs_api_url = $this->authjobs_api_url.'?api_key='.$this->authjobs_api_key.'&method=aj.jobs.search&'.$params;
	}
	
	private function make_request(){

		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_URL, $this->authjobs_api_url);
		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		$this->raw_data = curl_exec ($ch);
		curl_close ($ch);
		if (empty($this->raw_data)){
			return false;
		}else{
			return true;
		}

	}


}