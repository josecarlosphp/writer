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
 * @desc        Class for write to a CSV file.
 */

namespace josecarlosphp\writer;

class MyWriterCsv extends MyWriterFile
{
	private $_delimiter = ',';
	private $_enclosure = '"';
	private $_escape = '\\';
	
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
