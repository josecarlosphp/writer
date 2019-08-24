<?php
/**
 * Clase para grabar archivos
 *
 * @version 1.0.0
 * @author Jose Carlos Cruz Parra https://programadorphpfreelance.com
 *
 */
class MyWriterFile extends MyWriter
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
	/**
     * Comprueba si el archivo indicado por $target es válido.
     * Si no se indica (por defecto null) entonces se comprueba $this->_target.
     *
     * @param string $target
     * @return boolean
     */
    public function Check($target=null)
    {
        if(is_null($target))
        {
            $target = $this->_target;
        }

        if(file_exists($target))
        {
            if(is_file($target))
            {
                if(is_writable($target))
                {
                    return true;
                }
                else
                {
                    $this->_errores[] = 'File is not writable: '.$target;
                }
            }
            else
            {
                $this->_errores[] = 'File is not a file: '.$target;
            }
        }
        else
        {
            $dir = dirname($target);
            if(file_exists($dir))
            {
                if(is_dir($dir))
                {
                    if(is_writable($dir))
                    {
                        return true;
                    }
                    else
                    {
                        $this->_errores[] = 'Dir is not writable: '.$dir;
                    }
                }
                else
                {
                    $this->_errores[] = 'Dir is not a dir: '.$dir;
                }
            }
            else
            {
                $this->_errores[] = 'Dir does not exist: '.$dir;
            }
        }

        return false;
    }

    protected function _open($empty=false)
    {
        return $this->_fp = fopen($this->_target, $empty ? 'w' : 'a');
    }

    public function IsOpen()
    {
        return $this->_fp !== false && is_resource($this->_fp);
    }

    protected function _close()
    {
        return fclose($this->_fp);
    }

    protected function _write($str)
    {
        return fwrite($this->_fp, $str);
    }
}
