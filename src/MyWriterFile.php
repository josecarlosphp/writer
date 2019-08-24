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
 * @desc        Class for write to a text file.
 */

namespace josecarlosphp\writer;

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
