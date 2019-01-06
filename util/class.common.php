<?php
class Common
{
	public function __construct()
	{
		
	}

	public function cleanText($str)
	{
		$str=str_replace("\t","",$str);
	    $str=str_replace("\r","",$str);
	    $str=str_replace("\n","",$str);
	    $str=str_replace("\r\n","",$str);
	    $str=str_replace('\t',"",$str);
	    $str=str_replace('\r',"",$str);
	    $str=str_replace('\n',"",$str);
	    $str=str_replace('\r\n',"",$str);
	    $str=str_replace('  ',"",$str);
	    $str=htmlspecialchars($str);
	    $str=htmlentities($str);
	    $str=preg_replace('/[^\x20-\x7E]/',' ', $str);
	    $str=strip_tags($str);
	    $str=trim($str);

	    return $str;
	}

	public function getClientip()
	{
		$ip = "";

		if (!empty($_SERVER['HTTP_CLIENT_IP']))
		{
		  $ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
		  $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		elseif (!empty($_SERVER['REMOTE_HOST']))
		{
		  $ip = $_SERVER['REMOTE_HOST'];
		}
		else
		{
		  $ip = $_SERVER['REMOTE_ADDR'];
		}

		return $ip;
	}

	public function timezone_set($timezone)
	{
		date_default_timezone_set($timezone);
	}

	public function timezone_get()
	{
		date_default_timezone_get();
	}

	public function createFolder($folder)
	{
		if(!file_exists($folder))
		{
			mkdir($folder);
		}
	}

	public function getTotalDaysInBetween($start,$end)
	{
		$day 		= 86400; // Day in seconds
		$format 	= 'm/d/Y'; // Output format (see PHP date funciton)
		$sTime 		= strtotime($start); // Start as time
		$eTime 		= strtotime($end); // End as time
		$numDays 	= round(($eTime - $sTime) / $day) + 1;

		$days 		= array();

		// Get days
		for ($d = 0; $d < $numDays; $d++)
		{
			$days[] = date($format, ($sTime + ($d * $day)));
		}

		// Return days
		return $days;
	}

	public function replace_string($str)
	{
		$str = str_replace('"',"&quot",$str);
		$str = str_replace("'","&#39;",$str);
		//$str = str_replace(" ","&nbsp;",$str);
		$str = str_replace( '&#192;','À',  $str ); 
		$str = str_replace( '&#193;','Á',  $str ); 
		$str = str_replace( '&#194;','Â',  $str ); 
		$str = str_replace( '&#195;','Ã',  $str ); 
		$str = str_replace( '&#196;','Ä',  $str ); 
		$str = str_replace( '&#197;','Å',  $str ); 
		$str = str_replace( '&#198;','Æ',  $str ); 
		$str = str_replace( '&#199;','Ç',  $str ); 
		$str = str_replace( '&#200;','È',  $str ); 
		$str = str_replace( '&#201;','É',  $str ); 
		$str = str_replace( '&#202;','Ê', $str ); 
		$str = str_replace( '&#203;','Ë', $str ); 
		$str = str_replace( '&#204;','Ì',  $str ); 
		$str = str_replace( '&#205;','Í',  $str ); 
		$str = str_replace( '&#206;','Î',  $str ); 
		$str = str_replace( 'Ï', '&#207;', $str ); 
		$str = str_replace( 'Ð', '&#208;', $str ); 
		$str = str_replace( 'Ñ', '&#209;', $str ); 
		$str = str_replace( 'Ò', '&#210;', $str ); 
		$str = str_replace( 'Ó', '&#211;', $str ); 
		$str = str_replace( 'Ô', '&#212;', $str ); 
		$str = str_replace( 'Õ', '&#213;', $str ); 
		$str = str_replace( 'Ö', '&#214;', $str ); 
		$str = str_replace( '×', '&#215;', $str );  
		$str = str_replace( 'Ø', '&#216;', $str ); 
		$str = str_replace( 'Ù', '&#217;', $str ); 
		$str = str_replace( 'Ú', '&#218;', $str ); 
		$str = str_replace( 'Û', '&#219;', $str ); 
		$str = str_replace( 'Ü', '&#220;', $str ); 
		$str = str_replace( 'Ý', '&#221;', $str ); 
		$str = str_replace( 'Þ', '&#222;', $str ); 
		$str = str_replace( 'ß', '&#223;', $str ); 
		$str = str_replace( 'à', '&#224;', $str ); 
		$str = str_replace( 'á', '&#225;', $str ); 
		$str = str_replace( 'â', '&#226;', $str ); 
		$str = str_replace( 'ã', '&#227;', $str ); 
		$str = str_replace( 'ä', '&#228;', $str ); 
		$str = str_replace( 'å', '&#229;', $str ); 
		$str = str_replace( 'æ', '&#230;', $str ); 
		$str = str_replace( 'ç', '&#231;', $str ); 
		$str = str_replace( 'è', '&#232;', $str ); 
		$str = str_replace( 'é', '&#233;', $str ); 
		$str = str_replace( 'ê', '&#234;', $str ); 
		$str = str_replace( 'ë', '&#235;', $str ); 
		$str = str_replace( 'ì', '&#236;', $str ); 
		$str = str_replace( 'í', '&#237;', $str ); 
		$str = str_replace( 'î', '&#238;', $str ); 
		$str = str_replace( 'ï', '&#239;', $str ); 
		$str = str_replace( 'ð', '&#240;', $str ); 
		$str = str_replace( 'ñ', '&#241;', $str ); 
		$str = str_replace( 'ò', '&#242;', $str ); 
		$str = str_replace( 'ó', '&#243;', $str ); 
		$str = str_replace( 'ô', '&#244;', $str ); 
		$str = str_replace( 'õ', '&#245;', $str ); 
		$str = str_replace( 'ö', '&#246;', $str ); 
		$str = str_replace( '÷', '&#247;', $str );  // Yeah, I know.  But otherwise the gap is confusing.  --Kris 
		$str = str_replace( 'ø', '&#248;', $str ); 
		$str = str_replace( 'ù', '&#249;', $str ); 
		$str = str_replace( 'ú', '&#250;', $str ); 
		$str = str_replace( 'û', '&#251;', $str ); 
		$str = str_replace( 'ü', '&#252;', $str ); 
		$str = str_replace( 'ý', '&#253;', $str ); 
		$str = str_replace( 'þ', '&#254;', $str ); 
		$str = str_replace( 'ÿ', '&#255;', $str ); 
		$str = str_replace( '[', '&#91;', $str ); 
		$str = str_replace( ']', '&#93;', $str ); 
		$str = str_replace(',',"",  $str);    // baseline single quote
		//$str = str_replace("&","&amp;", $str);  // ellipsis
		$str = str_replace('–', '&ndash;', $str);

		return $str;
	}

	public function mysql_date_change($date)
	{
		$date1 		= substr($date,0,2);
		$month 		= substr($date,3,2);
		$year 		= substr($date,6,4);
		$new_date 	= $year."-".$month."-".$date1;

		return $new_date;
	}

	function str_to_date_format($date)
	{
		$year 		= substr($date,0,4);
		$month 		= substr($date,5,2);
		$date1 		= substr($date,8,2);
		$new_date 	= $date1."-".$month."-".$year;

		return $new_date;
	}

	function getBrowser()
	{
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);

	    // you can add different browsers with the same way ..
	    if(preg_match('/(chromium)[ \/]([\w.]+)/', $ua))
	    {	    	
	        $browser = 'chromium';
	    }
	    elseif(preg_match('/(chrome)[ \/]([\w.]+)/', $ua))
	    {
	    	$browser = 'chrome';
	    }	            
	    elseif(preg_match('/(safari)[ \/]([\w.]+)/', $ua))
	    {
	    	$browser = 'safari';
	    }
	    elseif(preg_match('/(opera)[ \/]([\w.]+)/', $ua))
	    {
	    	$browser = 'opera';
	    }
	    elseif(preg_match('/(msie)[ \/]([\w.]+)/', $ua))
	    {
	    	$browser = 'msie';
	    }
	    elseif(preg_match('/(mozilla)[ \/]([\w.]+)/', $ua))
	    {
	    	$browser = 'mozilla';
	    }

	    preg_match('/('.$browser.')[ \/]([\w]+)/', $ua, $version);

	    return array($browser,$version[2], 'name'=>$browser,'version'=>$version[2]);
	}

	function getBrowser2()
	{
		$u_agent = $_SERVER['HTTP_USER_AGENT'];
        $ub = '';
        if(preg_match('/MSIE/i',$u_agent))
        {
            $ub = "Internet Explorer";
        }
        elseif(preg_match('/Firefox/i',$u_agent))
        {
            $ub = "Mozilla Firefox";
        }
        elseif(preg_match('/Safari/i',$u_agent))
        {
            $ub = "Apple Safari";
        }
        elseif(preg_match('/Chrome/i',$u_agent))
        {
            $ub = "Google Chrome";
        }
        elseif(preg_match('/Flock/i',$u_agent))
         {
            $ub = "Flock";
        }
        elseif(preg_match('/Opera/i',$u_agent))
        {
            $ub = "Opera";
        }
        elseif(preg_match('/Netscape/i',$u_agent))
        {
            $ub = "Netscape";
        } 
        return $ub;
	}

	public function arrayPush(array $src_array,array $dest_array)
	{
		if(isset($src_array) && isset($dest_array))
		{
			for($k = 0; $k < sizeof($src_array); $k++)
			{
				if(array_key_exists('COLUMN_NAME', $src_array[$k]))
				{
					array_push($dest_array, $src_array[$k]['COLUMN_NAME']);
				}
			}

			return $dest_array;
		}
		else
		{
			return false;
		}
	}

	public function removeWhiteSpace($str)
	{
		$str 	= trim($str);
		$result = str_replace(" ","",$str);

		return $result;
	}

	public function removeWhiteSpaceWithDiv($str,int $action = 1)
	{
		$str 		= trim($str);
		
		if($action == 1)
		{
			$result = str_replace(" ","-rwswd-",$str);

			return $result;
		}
		else
		{
			$result = str_replace("-rwswd-"," ",$str);

			return $result;
		}		
	}
}
?>