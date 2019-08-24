<?php
/**
 * Clase para grabar archivos de registro
 *
 * @version 1.0.0
 * @author Jose Carlos Cruz Parra https://programadorphpfreelance.com
 *
 */
class MyWriterFileLog extends MyWriterFile
{
	/**
	 * Constructor
	 *
	 * @param string $target
	 */
    public function __construct($target=null)
    {
        parent::__construct($target);
    }

    public function WriteLog($str, $class='info')
    {
        return $this->Write(sprintf("[%s] - %s%s\n", date('Y-m-d H:i:s'), $class ? mb_strtoupper($class)."\t\t" : '', $str));
    }
}
