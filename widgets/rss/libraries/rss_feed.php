<?php 


class Rss_feed
{
	
	function get_rss_data($url, $count = 5)
	{
		$return_array = array();
	
         if ($content = file_get_contents($url))  
         {
              $xml = new SimpleXmlElement($content);  
              $i =0;   
              foreach($xml->channel->item as $entry) { 
              	  $i++;	 
                  $return_array[$i]['link'] = (string)$entry->link;
                  $return_array[$i]['title'] = (string)$entry->title;
                  if ($i == $count)
                  {
                  	break;
                  }
              }  
         }
         
         if (empty($return_array))
         {
         	$return_array = 'No results for your search.';
         }
		 return $return_array;
	}
	



}