<?php
define("BUENO",0);
define("MALO",1);
define("NEUTRO",2);
define("MUYBUENO",3);
define("MUYMALO",4);

class Utils {

	//Convierte un bool SQL en bool PHP
	static function sqlBoolToPHP($sqlBool) {
		$phpBool = null;
		if ($sqlBool === '1') {
			$phpBool = true;
		} elseif ($sqlBool === '0') {
			$phpBool = false;
		}
		
		return $phpBool;
	}

	//Convierte un bool PHP en bool SQL
	static function phpBoolToSQL($phpBool) {
		$sqlBool = 'null';  //TODO: O deberia ser "null" ???
		if ($phpBool === true) {
			$sqlBool = 'true';
		} elseif ($phpBool === false) {
			$sqlBool = 'false';
		}
		
		return $sqlBool;
	}

	
	/**
	 * 
	 * Retorna un array con los elementos no vacios
	 * @param array $array
	 */
	static function elementosNoVacios($array)
	{
		$ret = array();
		
		foreach ($array as $key=>$value) {
			if(!empty($value) || $value==='0')
			{
				$ret[$key] = $value;
			}
		}
		return $ret;
	}
	
	/**
	 * 
	 * Creo que esta funcion resuelve unos cuantos problemas de datos
	 * @param string $sqlString
	 */
	static function sqlStringToPHP($sqlString)
	{
		return htmlentities($sqlString);
	}
	
	static function phpStringToHTML($phpString) {
		$sqlString = '';  //TODO: O deberia ser "null" ???
		//TODO: escapara caracteres no correspondientes
		//$phpString = htmlentities($phpString);
		$phpString = str_replace("á", "&aacute;", $phpString);
		$phpString = str_replace("é", "&eacute;", $phpString);
		$phpString = str_replace("í", "&iacute;", $phpString);
		$phpString = str_replace("ó", "&oacute;", $phpString);
		$phpString = str_replace("ú", "&uacute;", $phpString);
		$phpString = str_replace("Á", "&Aacute;", $phpString);
		$phpString = str_replace("É", "&Eacute;", $phpString);
		$phpString = str_replace("Í", "&Iacute;", $phpString);
		$phpString = str_replace("Ó", "&Oacute;", $phpString);
		$phpString = str_replace("Ú", "&Uacute;", $phpString);
		
		$phpString = str_replace("ñ", "&ntilde", $phpString);
		$phpString = str_replace("Ñ", "&Ntilde", $phpString);

		//Con el false del final le decimos que no escape los ya escapados (los reemplazos que hicimos arriba)
//		$phpString = htmlentities($phpString,ENT_COMPAT|ENT_HTML401,'UTF-8',false);

//$phpString = htmlentities($phpString,ENT_COMPAT,'ISO-8859-1',false);
		
		
		//Cambiamos los saltos de linea (\n) por <br>
		$phpString = nl2br($phpString);
		//$phpString = htmlentities($phpString);
		$phpString = utf8_encode($phpString);
		$htmlString = $phpString;
		
		return $htmlString;
	}
	
	static function phpStringToSQL($phpString) {
		//Agregue addslashes
		//TODO: PORQUE LO SACAMOS?
		$sqlString = 'null';

		str_replace("'", "`", $phpString);
		if(!empty($phpString))
		{
			$sqlString = "'" . $phpString . "'";
		}
		
		return $sqlString;
	}
	//Convierte un int SQL en int PHP
	/*TODO: OJO!! PHP hace lo siguiente:
	 * "10" -> 10
     * "10.5" -> 10
     * "10,5" -> 10
     * "10  " -> 10
     * "  10  " -> 10
     * "10test" -> 10
     * "test10" -> 0
     * -1 -> -1
	*/ 
	static function sqlIntToPHP($sqlInt) {
		$phpInt;
        if(!is_null($sqlInt))
		{
        	if(is_numeric($sqlInt))
            {
            	if(((float)$sqlInt) == ((int)$sqlInt))//TODO:esto indica que es entero no float?
                {
                	$phpInt = (int)$sqlInt;
                }
                else
                {
                	throw new Exception("el parametro" . $sqlInt . " es flotante y debe ser entero", 2010006);
                }
            }
            else
            {
            	throw new Exception("El parametro:" . $sqlInt . " no es numerico", 2010007);
			}
            return $phpInt;
        }
	}
	
	static function sqlFloatToPHP($sqlFloat) {
		$phpFloat;
        if(!is_null($sqlFloat))
       	{
        	if (is_numeric($sqlFloat)) {
        		$phpFloat = (float) $sqlFloat;
        	}
        	return $phpFloat;
    	}		
	}
	
	static function postBoolToPHP($postBool) {
		$phpBool = null;
		
		if(strtolower( $postBool) == "true" || strtolower( $postBool) == "on")
		{
			return true;
		}
		
		if(strtolower( $postBool) == "false")
		{
			return false;
		}
		
		if(is_bool($postBool))
		{
			$phpBool = (bool)$postBool;
			
		}
		else  
		{
			if(is_numeric($postBool))
			{
				if(Utils::postIntToPHP($postBool)==0)
				{
					$phpBool = false;
				}
				else 
				{
					$phpBool = true;
				}
				
			}
			else 
			{
				throw new Exception("El parametro :" . $postBool . " no puede ser casteado a bool", 2010008);
			}
			
			
			
		}
		
		return $phpBool;
	}
	
	
	static function postIntToPHP($postInt) {
		$phpInt = null;
		$postInt = trim($postInt);
		if(is_numeric($postInt))
		{
			if(((float)$postInt) == ((int)$postInt))//TODO:esto indica que es entero no float?
			{
				$phpInt = (int)$postInt;
			}
			else 
			{
				throw new Exception("el parametro" . $postInt . " es flotante y debe ser entero", 2010006);
			}
		}
		else 
		{
			throw new Exception("El parametro:" . $postInt . " no es numerico");
		}
		return $phpInt;
	}
	
	static function postFloatToPHP($postFloat) {
		$phpFloat = null;
		
		if(is_numeric($postFloat))
		{
			$phpFloat = (float)($postFloat);
		}
		else 
		{
			throw new Exception("El parametro:" . $postFloat . " no es numerico", 2010007);
			
		}
		return $phpFloat;
	}
	
	
	//Convierte un int PHP en int SQL
	static function phpIntToSQL($phpInt) {
		$sqlInt = 'null';  //TODO: O deberia ser "null" ???
		if(isset($phpInt))
		{
			$sqlInt = "0";
		}
		if (!empty($phpInt)) {
			$sqlInt = (string) $phpInt;
		}
		
		
		return $sqlInt;
	}
	
	/**
	 * 
	 * Convierte un int php en un int HTML
	 * @param int $phpInt
	 */
	static function phpIntToHTML($phpInt) {
		$htmlInt ="";
		if($phpInt==0)
			$htmlInt="0";
		else 
			$htmlInt = $phpInt;
			
		if(!isset($phpInt))
			$htmlInt = "";
		
		return $htmlInt;
	}
	
	/**
	 * 
	 * Convierte un float php en un float HTML
	 * @param float $phpFloat
	 */
	static function phpFloatToHTML($phpFloat) {
		$html ="";
		if($phpFloat==0)
			$html="0.0";
		else 
			$html = $phpFloat;
			
		if(!isset($phpFloat))
			$html = "";
		
		return $html;
	}
	
	
	static function phpIntToHTMLCeroBase($phpInt) {
		$htmlInt ="0";
		if($phpInt==0)
			$htmlInt="0";
		else 
			$htmlInt = $phpInt;
			
		if(!isset($phpInt))
			$htmlInt = "0";
		
		return $htmlInt;
	}
	
	//Convierte un float PHP en int SQL
	static function phpFloatToSQL($phpfloat) {
		$sqlfloat = 'null';  //TODO: O deberia ser "null" ???
		if (!is_null($phpfloat)) {
			$sqlfloat = (string) $phpfloat;
		}
		
		return $sqlfloat;
	}
	
	
	//Convierte un date SQL en timestamp PHP (hora 00:00:00)
	static function sqlDateToPHPTimestamp($sqlDate) {
		$phpTimestamp = null;
		if (!empty($sqlDate)) {
	        $anio = (int) substr($sqlDate, 0, 4);
	        $mes = (int) substr($sqlDate, 5, 2);
	        $dia = (int) substr($sqlDate, 8, 2);

        	if (checkdate($mes, $dia, $anio)) {
                $phpTimestamp = mktime(0, 0, 0, $mes, $dia, $anio);
	        }
		}

		return $phpTimestamp;
	}

	/**
	 * Convierte un date SQL en DateTime PHP (hora 00:00:00)
	 * @param string $sqlDate
	 * @return DateTime
	 */
	static function sqlDateToPHPDateTime($sqlDate) {
		$phpDateTime = null;
		if (!empty($sqlDate)) {
	        $anio = (int) substr($sqlDate, 0, 4);
	        $mes = (int) substr($sqlDate, 5, 2);
	        $dia = (int) substr($sqlDate, 8, 2);

        	if (checkdate($mes, $dia, $anio)) {
                $phpDateTime = new DateTime($anio.'/'.str_pad($mes, 2, '0', STR_PAD_LEFT).'/'.str_pad($dia, 2, '0', STR_PAD_LEFT).' 00:00:00'); 
	        }
		}

		return $phpDateTime;
	}
	
	static function postDateToSqlDate($postDate) {

        $anio = (int) substr($postDate, 6, 4);
        $mes = (int) substr($postDate, 3, 6);
        $dia = (int) substr($postDate, 0, 2);

        return $anio."-".str_pad($mes, 2, '0', STR_PAD_LEFT)."-".str_pad($dia, 2, '0', STR_PAD_LEFT);
	}
	
	static function postDateToPHPTimestamp($postDate)
	{
		$phpTimestamp = null;
		if (!empty($postDate)) {
        	$anio = Utils::postIntToPHP(substr($postDate, 6, 4));
	        $mes = Utils::postIntToPHP(substr($postDate, 3, 2));
	        $dia = Utils::postIntToPHP(substr($postDate, 0, 2));
	        
        	if (checkdate($mes, $dia, $anio)) {
                $phpTimestamp = mktime(0, 0, 0, $mes, $dia, $anio);
	        }
	        else 
	        {
	        	throw new Exception("El parametro:" . $postDate . " no cumple con el formato de fecha especificado", 2010007);
	        }
		}

		return $phpTimestamp;
		
	}
	
	/**
	 * 
	 * Convierte una hora HH:MM:SS en un timestamp
	 * @param string $postTime
 	 * @param string $postDate (OPCIONAL): Sino usa 01-01-1970
	 * @throws Exception
	 * @return int
	 */
	static function postTimeToPHPTimestamp($postTime, $postDate = '')
	{
		$phpTimestamp = null;
		if (empty($postDate)) {
			$anio = 1970;
			$mes = 1;
			$dia = 1;
		} 
		else 
		{
        	$anio = Utils::postIntToPHP(substr($postDate, 6, 4));
	        $mes = Utils::postIntToPHP(substr($postDate, 3, 2));
	        $dia = Utils::postIntToPHP(substr($postDate, 0, 2));
			
        	if (!checkdate($mes, $dia, $anio)) {
	        	throw new Exception("El parametro:" . $postDate . " no cumple con el formato de fecha especificado", 2010007);
	        }
		}
		
		if (!empty($postTime)) {
	        $hora = (int) substr($postTime, 0, 2);
	        $minutos = (int) substr($postTime, 3, 2);
	        $segundos = (int) substr($postTime, 6, 2);
			
            $phpTimestamp = mktime($hora, $minutos, $segundos, $mes, $dia, $anio);
            if ($phpTimestamp==-1)
	        {
	        	throw new Exception("El parametro:" . $postTime . " no cumple con el formato de hora especificado", 2010007);
	        }
		}

		return $phpTimestamp;
	}
	
	
	//Convierte un dateTime SQL en timestamp PHP
	static function sqlDateTimeToPHPTimestamp($sqlDateTime) {
		
		$phpTimestamp = null;
		if (!empty($sqlDateTime)) {
	        $anio = (int) substr($sqlDateTime, 0, 4);
	        $mes = (int) substr($sqlDateTime, 5, 2);
	        $dia = (int) substr($sqlDateTime, 8, 2);

	        $hora = (int) substr($sqlDateTime, 11, 2);
	        $minutos = (int) substr($sqlDateTime, 14, 2);
	        $segundos = (int) substr($sqlDateTime, 17, 2);
	        
                 
	        if ( (checkdate($mes, $dia, $anio)) && 
                 (0 <= $hora && 23 >= $hora) &&
                 (0 <= $minutos && 59 >= $minutos) &&
                 (0 <= $segundos && 59 >= $segundos) ) {
                $phpTimestamp = mktime($hora, $minutos, $segundos, $mes, $dia, $anio);
	        }
		}

		return $phpTimestamp;
	}
	
	
//Convierte un time SQL en timestamp PHP
	static function sqlTimeToPHPTimestamp($sqlDateTime) {
		$phpTimestamp = null;
		if (!empty($sqlDateTime)) {
	        

	        $hora = (int) substr($sqlDateTime, 0, 2);
	        $minutos = (int) substr($sqlDateTime, 3, 2);
	        $segundos = (int) substr($sqlDateTime, 6, 2);
	        
	        if ( 
                 (0 <= $hora && 23 >= $hora) &&
                 (0 <= $minutos && 59 >= $minutos) &&
                 (0 <= $segundos && 59 >= $segundos) ) {
                $phpTimestamp = mktime($hora, $minutos, $segundos, 0, 0, 0);
	        }
		}

		return $phpTimestamp;
	}

	//Convierte un timestamp PHP en date SQL
	static function phpTimestampToSQLDate($phpTimestamp) {
		$sqlDate = '';  //TODO: O deberia ser "null" ???
		if (!is_null($phpTimestamp)) {
			$sqlDate = strftime("%Y-%m-%d", $phpTimestamp);
		}
		if(empty($sqlDate))
		{		
			$sqlDate = 'NULL';
		}
		else 
		{
			$sqlDate = "'" . $sqlDate . "'";
		}
		
		return $sqlDate;
	}
	
	//Convierte un timestamp PHP en datetime SQL
	static function phpTimestampToSQLDatetime($phpTimestamp) {
		$sqlDateTime = 'null';  //TODO: O deberia ser "null" ???
		if (!is_null($phpTimestamp)) {
			$sqlDateTime = strftime("%Y-%m-%d %H:%M:%S", $phpTimestamp);
		}

		$sqlDateTime = "'" . $sqlDateTime . "'";
		
		return $sqlDateTime;
	}

	static function phpTimestampToSQLTime($phpTimestamp) {
		$sqlDateTime = 'null';  //TODO: O deberia ser "null" ???
		if (!is_null($phpTimestamp)) {
			$sqlDateTime = strftime("%H:%M:%S", $phpTimestamp);
		}

		$sqlDateTime = "'" . $sqlDateTime . "'";
		
		return $sqlDateTime;
	}

	static function sqlDateToHtmlDate($sqlDate)
	{
		return Utils::phpTimestampToHTMLDate(Utils::sqlDateTimeToPHPTimestamp($sqlDate));
	}
	
	static function sqlDateTimeToHtmlDateTime($sqlDateTime)
	{
		return Utils::phpTimestampToHTMLDateTime(Utils::sqlDateTimeToPHPTimestamp($sqlDateTime));
	}

	static function mostrarError($message)
	{
		$ret = '<script language="JavaScript">
        alert("'.$message.'");
        </script>';
		return $ret;
	}
	
	static function clavesConPrefijo($post, $sufijo)//TODO: donde lo pongo a este
	{
		$ret = array();
		foreach ($post as $key => $value)
		{
			if(stripos($key, $sufijo)!==false && !empty($post[$key]))
			{
				array_push($ret, $key);
			}
		}
		return $ret;
		
	}
	
	static function clavesConPrefijoConEmpty($post, $sufijo)//TODO: donde lo pongo a este
	{
		$ret = array();
		foreach ($post as $key => $value)
		{
			if(stripos($key, $sufijo)!==false)
			{
				array_push($ret, $key);
			}
		}
		return $ret;
		
	}
	
	static function phpTimestampToHTMLDate($phpTimestamp) {
		$sqlDate = '';  //TODO: O deberia ser "null" ???
		if (!is_null($phpTimestamp)) {
			$sqlDate = strftime("%d/%m/%Y", $phpTimestamp);
		}
		if(empty($sqlDate))
		{		
			$sqlDate = 'NULL';
		}
		else 
		{
			$sqlDate = $sqlDate;
		}
		
		return $sqlDate;
	}
	
	static function phpTimestampToHTMLDateTime($phpTimestamp) {
		$sqlDate = '';  //TODO: O deberia ser "null" ???
		if (!is_null($phpTimestamp)) {
			$sqlDate = strftime("%d/%m/%Y %H:%M:%S", $phpTimestamp);
		}
		if(empty($sqlDate))
		{		
			$sqlDate = '';
		}
		else 
		{
			$sqlDate = $sqlDate;
		}
		
		return $sqlDate;
	}
	
	static function phpTimestampToHTMLTime($phpTimestamp) {
		$sqlDate = '';  //TODO: O deberia ser "null" ???
		if (!is_null($phpTimestamp)) {
			$sqlDate = strftime("%H:%M:%S", $phpTimestamp);
		}
		if(empty($sqlDate))
		{		
			$sqlDate = 'NULL';
		}
		else 
		{
			$sqlDate = $sqlDate;
		}
		
		return $sqlDate;
	}
	
	static function arrayToSimpleHTML($arreglo)
	{
		$ret = "";
		for ($i = 0; $i < count($arreglo); $i++) {
			$ret .= $arreglo[$i] . "<BR/>"; 
		}
		return $ret;
		
	}
	
	static function arrayToSimpleHTMLList($arreglo)
	{
		$ret = "<ul>";
		for ($i = 0; $i < count($arreglo); $i++) {
			$ret .= "<li>";
			$ret .= $arreglo[$i];
			$ret .= "</li>"; 
		}
		$ret .="</ul>";
		return $ret;
		
	}
	
	
	
	static function borrarDoblesEspaciosBlancos($texto)
	{
		$texto = preg_replace('/\s+/', ' ', $texto);
		return $texto;
	}
	
	/**
	 * 
	 * Retorna las palabras separadas en un arreglo
	 * @return array()
	 */
	static function stringToArray($texto)
	{
		str_replace('\n',' ',$texto);//primero reemplazo enters por espacios en blanco
		$parts = explode(" ",Utils::borrarDoblesEspaciosBlancos($texto)); //borro los dobles espacios en blanco y busco la palabra num
		return $parts;
	}
	
	
	static function palabra($texto,$num)
	{
		str_replace('\n',' ',$texto);//primero reemplazo enters por espacios en blanco
		$parts = explode(" ",Utils::borrarDoblesEspaciosBlancos($texto)); //borro los dobles espacios en blanco y busco la palabra num
		
		return $parts[$num -1];
	}
	
	/**
	 * 
	 * Devuelve el texto que se encuentra entre $textoAnterior y $textoPosterior
	 * @param string $texto
	 * @param string $textoAnterior
	 * @param string $textoPosterior
	 */
    static function textoEntre($texto, $textoAnterior, $textoPosterior)
        {
                $textoObtenido = '';
               
                if (empty($textoAnterior)) {
                        $posIni = 0;
                } else {
                $posIni = stripos($texto, $textoAnterior);
                }
               
            if ($posIni !== false) {
                    $posIni+= strlen($textoAnterior);
           
                        if (empty($textoPosterior)) {
                                $posFin = strlen($texto);
                        } else {
                        $posFin = stripos($texto, $textoPosterior, $posIni);
                        }
                   
                if ($posFin !== false) {
                        $textoObtenido = substr($texto, $posIni, $posFin-$posIni);
                }  
            }//ENDIf
           
            return $textoObtenido;
     }
       
     /**
      * 
      * Devuelve un arreglo con el texto que se encuentra antes de $textoAnterior, el que se encuentra entre $textoAnterior y $textoPosterior, y el que se encuentra despues de $textoPosterior
      * @param string $texto
      * @param string $textoAnterior
      * @param string $textoPosterior
      * @return array('anterior' => string, 'dato'=> string, 'posterior' => string)
      */
     static function partirTexto($texto, $textoAnterior, $textoPosterior, $inclusive = false)
     {
            $partes = array();
               
            if (empty($textoAnterior)) {
                    $posIni = 0;
            } else {
                	$posIni = stripos($texto, $textoAnterior);
            }
               
            if ($posIni !== false) {
            	if(!$inclusive)
            	{//Si no se incluye el texto anterior
                    $posIni+= strlen($textoAnterior);
            	}
                   
                        if (empty($textoPosterior)) {
                                $posFin = strlen($texto);
                        } else {
                        $posFin = stripos($texto, $textoPosterior, $posIni);
                        }
                if ($posFin !== false) {
                	if($inclusive)
                	{//Si se incluye el texto posterior
                		$posFin += strlen($textoPosterior);
                	}
                	
                        $partes['anterior'] = substr($texto, 0, $posIni);  
                            $partes['dato'] = substr($texto, $posIni, $posFin-$posIni);  
                        $partes['posterior'] = substr($texto, $posFin);
                }  
            }//ENDIf
           
            return $partes;
    }
	
    /**
     * 
     * retorna un arreglo asociativo anos, meses, dias, horas, minutos y segundos entre las dos 
     * fechas pasadas 
     * @param timestamp $fechaInicial
     * @param timestamp $fechaFinal
     */
    static function intervaloEntreFechas($fechaInicial, $fechaFinal) {
    	
    
    	$ret = array();
		$fechaFinalDateTime = new DateTime();
		$fechaFinalDateTime->setTimestamp($fechaFinal);
		
		$fechaInicialDateTime = new DateTime();
		$fechaInicialDateTime->setTimestamp($fechaInicial);
		
		$intervalo = $fechaFinalDateTime->diff($fechaInicial);
		
		
		$ret["anos"] = $intervalo->y;
		$ret["meses"]  = $intervalo->m;
		$ret["dias"]  = $intervalo->d;
		$ret["horas"]  = $intervalo->h;
		$ret["minutos"]  = $intervalo->i;
		$ret["segundos"]  = $intervalo->s;
		
		return $ret;
    }
    
    /**
     * 
     * retorna la cantidad de dias entre las dos fechas pasadas
     * FechaFinal debe ser mayor que FechaInicial
     * @param timestamp $fechaInicial
     * @param timestamp $fechaFinal
     */
    static function diasEntreFechas($fechaInicial, $fechaFinal) {
    	$intervalo =  $fechaFinal-$fechaInicial;
    	$intervalo = $intervalo/(60*60*24);
    	return ceil($intervalo);
    }
    /**
     * 
     * Recibe el nombre corto del mes y devuelve el numero
     * @param string $nombreMes
     * @return int
     */
	static function numeroMes($nombreMes) {
    	switch ($nombreMes) {
    		
    		case "ENE":	
    			return 1;
    		break;
    		
    		case "FEB":	
    			return 2 ;
    		break;
    		
    		case "MAR":	
    			return 3;
    		break;
    		
    		case "ABR":	
    			return 4;
    		break;
    		
    		case "MAY":	
    			return 5;
    		break;
    		
    		case "JUN":	
    			return 6;
    		break;
    		
    		case "JUL":	
    			return 7;
    		break;
    		
    		case "AGO":	
    			return 8;
    		break;
    		
    		case "SEPT":	
    			return 9;
    		break;
    		
    		case "OCT":	
    			return 10;
    		break;
    		
    		case "NOV":	
    			return 11;
    		break;
    		
    		case "DIC":	
    			return 12;
    		break;
    		
    		
    		default:
    			return 0;
    		break;
    	}
    }
    
    static function nombreMes($numeroMes) {
    	switch ($numeroMes) {
    		
    		case 1:	
    			return "ENERO";
    		break;
    		
    		case 2:	
    			return "FEBRERO";
    		break;
    		
    		case 3:	
    			return "MARZO";
    		break;
    		
    		case 4:	
    			return "ABRIL";
    		break;
    		
    		case 5:	
    			return "MAYO";
    		break;
    		
    		case 6:	
    			return "JUNIO";
    		break;
    		
    		case 7:	
    			return "JULIO";
    		break;
    		
    		case 8:	
    			return "AGOSTO";
    		break;
    		
    		case 9:	
    			return "SEPTIEMBRE";
    		break;
    		
    		case 10:	
    			return "OCTUBRE";
    		break;
    		
    		case 11:	
    			return "NOVIEMBRE";
    		break;
    		
    		case 12:	
    			return "DICIEMBRE";
    		break;
    		
    		
    		default:
    			throw new OutOfRangeException("los meses son entre 1 y 12", 201030);
    		break;
    	}
    }
    
    static function cantidadDiasEnElMes($mes, $anio)    
    {
    	$mes = mktime( 0, 0, 0, $mes, 1, $anio ); 
      	return date("t",$mes);
    }
    
	static function get_timespan_string($older, $newer) {
		$dateOlder = getdate($older);
		$dateNewer = getdate($newer);
		//var_dump($newer);
	  
		$Y1 = $dateOlder['year'];
	  $Y2 = $dateNewer['year'];
	  $Y = $Y2 - $Y1;
	  //var_dump($dateOlder);
	  //var_dump($dateNewer);
	
	  $m1 = $dateOlder['mon'];
	  $m2 = $dateNewer['mon'];
	  $m = $m2 - $m1;
	
	  $d1 = $dateOlder['mday'];
	  $d2 = $dateNewer['mday'];
	  $d = $d2 - $d1;
	
	  $H1 = $dateOlder['hours'];
	  $H2 = $dateNewer['hours'];
	  $H = $H2 - $H1;
	
	  $i1 = $dateOlder['minutes'];
	  $i2 = $dateNewer['minutes'];
	  $i = $i2 - $i1;
	
	  $s1 = $dateOlder['seconds'];
	  $s2 = $dateNewer['seconds'];
	  $s = $s2 - $s1;
	/*	
		
		
		$Y1 = $older->format('Y');
	  $Y2 = $newer->format('Y');
	  $Y = $Y2 - $Y1;
	  var_dump($older);
	  var_dump($newer);
	
	  $m1 = $older->format('m');
	  $m2 = $newer->format('m');
	  $m = $m2 - $m1;
	
	  $d1 = $older->format('d');
	  $d2 = $newer->format('d');
	  $d = $d2 - $d1;
	
	  $H1 = $older->format('H');
	  $H2 = $newer->format('H');
	  $H = $H2 - $H1;
	
	  $i1 = $older->format('i');
	  $i2 = $newer->format('i');
	  $i = $i2 - $i1;
	
	  $s1 = $older->format('s');
	  $s2 = $newer->format('s');
	  $s = $s2 - $s1;
	*/
	  if($s < 0) {
	    $i = $i -1;
	    $s = $s + 60;
	  }
	  if($i < 0) {
	    $H = $H - 1;
	    $i = $i + 60;
	  }
	  if($H < 0) {
	    $d = $d - 1;
	    $H = $H + 24;
	  }
	  if($d < 0) {
	    $m = $m - 1;
	    $d = $d + Utils::get_days_for_previous_month($m2, $Y2);
	  }
	  if($m < 0) {
	    $Y = $Y - 1;
	    $m = $m + 12;
	  }
	  $timespan_string = Utils::create_timespan_string($Y, $m, $d, $H, $i, $s);
	  //var_dump($timespan_string);
	  return $timespan_string;
	}
	
	static function get_days_for_previous_month($current_month, $current_year) {
	  $previous_month = $current_month - 1;
	  if($current_month == 1) {
	    $current_year = $current_year - 1; //going from January to previous December
	    $previous_month = 12;
	  }
	  if($previous_month == 11 || $previous_month == 9 || $previous_month == 6 || $previous_month == 4) {
	    return 30;
	  }
	  else if($previous_month == 2) {
	    if(($current_year % 4) == 0) { //remainder 0 for leap years
	      return 29;
	    }
	    else {
	      return 28;
	    }
	  }
	  else {
	    return 31;
	  }
	}
	
	
	
	static function create_timespan_string($Y, $m, $d, $H, $i, $s)
	{
	  $timespan_string = array('y'=>null,'m'=>null,'d'=>null,'h'=>null,'i'=>null,'s'=>null);
	  //$found_first_diff = false;
	  //if($Y >= 1) {
	    $found_first_diff = true;
	    $timespan_string['y'] = $Y;
	  //}
	  if($m >= 1 || $found_first_diff) {
	    $found_first_diff = true;
	    $timespan_string['m']=$m;
	  }
	  if($d >= 1 || $found_first_diff) {
	    $found_first_diff = true;
	    $timespan_string['d']=$d;
	  }
	  if($H >= 1 || $found_first_diff) {
	    $found_first_diff = true;
	    $timespan_string['h']=$H;
	  }
	  if($i >= 1 || $found_first_diff) {
	    $found_first_diff = true;
	    $timespan_string['i'] = $i;
	  }
	  if($found_first_diff) {
	    $timespan_string ['s']=$s;
	  }
	  else 
	  {
	  	$timespan_string ['s']=0;
	  }
	  return $timespan_string;
	}
	/**
	 * 
	 * Retorna si la cadena pasada corresponde a un direccion ip
	 * @param text $ip_addr direccion ip
	 * @return bool si la ip es valida o no
	 */
	static function validateIpAddress($ip_addr)
	{
	  //first of all the format of the ip address is matched
	  if(preg_match("/^(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})$/",$ip_addr))
	  {
	    //now all the intger values are separated
	    $parts=explode(".",$ip_addr);
	    //now we need to check each part can range from 0-255
	    foreach($parts as $ip_parts)
	    {
	      if(intval($ip_parts)>255 || intval($ip_parts)<0)
	      return false; //if number is not within range of 0-255
	    }
	    return true;
	  }
	  else
	    return false; //if format of ip address doesn't matches
	}
	
	static function validateEmailAddress($email) {
		//TODO: chequear esto y ver de agregar validacion de dominio
			if (ereg("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([_a-zA-Z0-9-]+\.)*[a-zA-Z0-9-]{2,200}\.[a-zA-Z]{2,6}$", $email ) ) {
     		  return true;
    		} 
    		else {
      		 return false;
    		} 
    		
	}
	
	static function validarTelefono($telefono) {
		//TODO: chequear esto y ver de agregar validacion de dominio
		$telefono = trim($telefono);
			if (ereg("^(\(\+?[0-9]{1,4}\))?[0-9-]+$", $telefono) ) {
     		  return true;
    		} 
    		else {
      		 return false;
    		} 
    		
	}
	
	/**
	 * 
	 * Dada una IP la devuelve separada en octetos 
	 * @param string $ip
	 */
	static function explodeIPAddress($ip)
	{
		$octetosIP = explode(".",$ip);
		foreach ($octetosIP as $octeto) {
			$ret[] = (int) $octeto;
		}
		return $ret;
	}
	
	/**
	 * 
	 * Dada una IP en octetos la devuelve en string 
	 * @param array $ip
	 */
	static function implodeIPAddress($octetosIP)
	{
		return implode('.', $octetosIP);
	}
	
	/**
	 * Converts tabs to the appropriate amount of spaces while preserving formatting
	 *
	 * @author      Aidan Lister <aidan@php.net>
	 * @version     1.2.0
	 * @link        http://aidanlister.com/repos/v/function.tab2space.php
	 * @param       string    $text     The text to convert
	 * @param       int       $spaces   Number of spaces per tab column
	 * @return      string    The text with tabs replaced
	 */
	static function tab2HTMLSpace($text, $spaces = 4)
	{
	    // Explode the text into an array of single lines
	    $lines = explode("\n", $text);
	    
	    // Loop through each line
	    foreach ($lines as $line)
	    {
	        // Break out of the loop when there are no more tabs to replace
	        while (false !== $tab_pos = strpos($line, "\t"))
	        {
	            // Break the string apart, insert spaces then concatenate
	            $start = substr($line, 0, $tab_pos);
	            $tab = str_repeat('&nbsp;', $spaces - $tab_pos % $spaces);
	            $end = substr($line, $tab_pos + 1);
	            $line = $start . $tab . $end;
	        }
	        
	        $result[] = $line;
	    }
	    
	    return implode("\n", $result);
	}
	
	static function parseTable($html)
	{
	  // Find the table
	  preg_match("/<table.*?>.*?<\/[\s]*table>/s", $html, $table_html);
	 
	  // Get title for each row
	  $head = preg_match_all("/<th.*?>(.*?)<\/[\s]*th>/", $table_html[0], $matches);
	  $row_headers = $matches[1];
	 
	  // Iterate each row
	  preg_match_all("/<tr.*?>(.*?)<\/[\s]*tr>/s", $table_html[0], $matches);
	 
	  $table = array();
	 
	  foreach($matches[1] as $row_html)
	  {
	    preg_match_all("/<td.*?>(.*?)<\/[\s]*td>/", $row_html, $td_matches);
	    $row = array();
	    for($i=0; $i<count($td_matches[1]); $i++)
	    {
	      $td = strip_tags(html_entity_decode($td_matches[1][$i]));
	      if($head)
	      {
	      	$row[$row_headers[$i]] = $td;
	      }
	      else 
	      {
	      	$row[$i] = $td;
	      }
	    }
	 
	    if(count($row) > 0)
	      $table[] = $row;
	  }
	  return $table;
	}
	
	/**
	 * 
	 * Escala una imagen con el ancho/alto pasado por parámetro
	 * la idea es usala para crear miniaturas y no agrandar
	 * @param string $src
	 * @param string $dst
	 * @param int $width_height
	 * @param bool $fixedByWidht
	 */
	static function createThumbnail($src, $dst,$width_height, $fixedByWidht = true)
	{
		$file_info = getimagesize($src);
		$ancho = $file_info[0];
		$alto = $file_info[1];
		if($fixedByWidht)
		{
			$newWidth = $width_height;
			$newHeight = $newWidth * ($alto/$ancho);
		}
		else
		{
			$newHeight = $width_height;
			$newWidth = $newHeight * ($ancho/$alto);
		}
		
		// Sacamos la extensión del archivo
		$ext = explode(".", $src);
		$ext = strtolower($ext[count($ext) - 1]);
		if ($ext == "jpeg") $ext = "jpg";
		
		// Dependiendo de la extensión llamamos a distintas funciones
		switch ($ext) {
		        case "jpg":
		                $img = imagecreatefromjpeg($src);
		        break;
		        case "png":
		                $img = imagecreatefrompng($src);
		        break;
		        case "gif":
		                $img = imagecreatefromgif($src);      
		        break;
		}
		// Creamos la miniatura
		$thumb = imagecreatetruecolor($newWidth, $newHeight);
		// La redimensionamos
		imagecopyresampled($thumb, $img, 0, 0, 0, 0, $newWidth, $newHeight, $file_info[0], $file_info[1]);
		// La mostramos como jpg
		
		imagejpeg($thumb, $dst, 90);
	}
	
	static function sqlTimeToHtmlTime($time)
	{
		return substr($time,0,-3);
	}

	static function calcularEdad($fecha_nac)
    {
        //fecha actual

        $dia=date("j");
        $mes=date("n");
        $ano=date("Y");

        //fecha de nacimiento
        $dianaz=(int) substr($fecha_nac, 8, 2);
        $mesnaz=(int) substr($fecha_nac, 5, 2);
        $anonaz=(int) substr($fecha_nac, 0, 4);

        //si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual

        if(($mesnaz == $mes) && ($dianaz > $dia))
        {
            $ano=($ano-1);
        }

        //si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual

        if($mesnaz > $mes)
        {
            $ano=($ano-1);
        }

        //ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad

        $edad=($ano-$anonaz);

        return $edad;
    }

    static function permute($array)
	{
	  $results = array();

	  if (count($array) == 1)
	  {
	    $results[] = $array;
	  }
	  else
	  {
	    for ($i = 0; $i < count($array); $i++)
	    {
	      $first = array_shift($array);
	      $subresults = Utils::permute($array);
	      array_push($array, $first);
	      foreach ($subresults as $subresult)
	      {
	        $results[] = array_merge(array($first), $subresult);
	      }
	    }
	  }
	  return $results;
	}

}
?>