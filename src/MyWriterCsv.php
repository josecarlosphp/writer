<?php
/**
 * Clase para grabar archivos CSV
 *
 * @version 1.0.0
 * @author Jose Carlos Cruz Parra https://programadorphpfreelance.com
 *
 */
class MyWriterCsv extends MyWriterFile
{
	private $_delimiter = ',';
	private $_enclosure = '"';
	private $_escape = "\\";
	
    public function WriteCSV($arr)
    {
        return fputcsv($this->_fp, $arr, $this->_delimiter, $this->_enclosure, $this->_escape);
    }
	/**
	 * Establece el parametro delimiter
	 *
	 * @param string $val
	 */
	public function SetDelimiter($val)
    {
        $this->_delimiter = $val;
    }
    /**
	 * Establece el parametro enclosure
	 *
	 * @param string $val
	 */
	public function SetEnclosure($val)
    {
        $this->_enclosure = $val;
    }
    /**
	 * Establece el parametro escape
	 *
	 * @param string $val
	 */
	public function SetEscape($val)
    {
        $this->_escape = $val;
    }
    /**
	 * Obtiene el parametro delimiter
	 *
	 * @return string
	 */
	public function GetDelimiter()
    {
        return $this->_delimiter;
    }
    /**
	 * Obtiene el parametro enclosure
	 *
	 * @return string
	 */
	public function GetEnclosure()
    {
        return $this->_enclosure;
    }
    /**
	 * Obtiene el parametro escape
	 *
	 * @return string
	 */
	public function GetEscape()
    {
        return $this->_escape;
    }
}
