<?php
/**
 * This file is part of josecarlosphp/writer - PHP classes for write to different destinations.
 *
 * josecarlosphp/writer is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 *
 * @see         https://github.com/josecarlosphp/writer
 * @copyright   2015-2019 José Carlos Cruz Parra
 * @license     https://www.gnu.org/licenses/gpl.txt GPL version 3
 * @desc        Abstract class base writer.
 */

namespace josecarlosphp\writer;

abstract class MyWriter
{
	protected $_target = null;
    protected $_errores = array();
    protected $_fp = null;
    /**
	 * Constructor
	 *
	 * @param string $target
	 */
    public function __construct($target=null)
    {
        $this->Target($target);
    }
	/**
	 * Destructor
	 *
	 */
    public function __destruct()
    {
        $this->Close();
    }
	/**
	 * Establece/Obtiene objetivo de escritura
	 *
	 * @param string $val
	 */
	public function Target($val=null)
    {
        if(!is_null($val))
        {
            $this->_target = $val;
        }

        return $this->_target;
    }
	/**
	 * Obtiene el texto del último error
	 *
	 * @return string
	 */
    public function Error()
    {
        return empty($this->_errores) ? '' : $this->_errores[count($this->_errores) - 1];
    }
    /**
     * Comprueba si el archivo indicado por $target es válido.
     * Si no se indica (por defecto null) entonces se comprueba $this->_target.
     *
     * @param string $target
     * @return boolean
     */
    abstract public function Check($target=null);
	/**
	 * Abre el archivo
	 *
     * @return boolean
	 */
    final public function Open($empty=false)
    {
        if($this->Check())
        {
            if($this->IsOpen())
            {
                $this->Close();
            }

            $this->_open($empty);

            return $this->IsOpen();
        }

        return false;
    }
    abstract protected function _open($empty=false);
    /**
     * Comprueba si el archivo está abierto
     *
     * @return boolean
     */
    abstract public function IsOpen();
    /**
	 * Cierra el archivo
	 *
	 */
    final public function Close()
    {
        if($this->IsOpen())
        {
            return $this->_close();
        }

        return true;
    }
    abstract protected function _close();

    final public function Write($str)
    {
        if($this->IsOpen())
        {
            return $this->_write($str);
        }
        else
        {
            $this->_errores[] = 'Target is not open: '.$this->_target;
        }

        return false;
    }
    abstract protected function _write($str);
}
