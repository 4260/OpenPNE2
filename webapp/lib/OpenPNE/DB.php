<?php
/**
 * @copyright 2005-2007 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// PEAR::DB依存
require_once 'DB.php';

/**
 * OpenPNE_DB (PEAR::DB依存)
 */
class OpenPNE_DB
{
    /**
     * @var DB_mysql
     */
    var $db;

    var $dsn;
    var $readonly = false;

    function OpenPNE_DB($dsn, $readonly = false)
    {
        $this->dsn = $dsn;
        $this->_connect();
        $this->readonly = $readonly;
    }

    function &getInstance()
    {
        static $singleton;
        if (empty($singleton)) {
            $singleton = new OpenPNE_DB();
        }
        return $singleton;
    }

    /**
     * @access private
     */
    function _connect()
    {
        $this->db =& DB::connect($this->dsn);
        if (DB::isError($this->db)) {
            openpne_display_error($this->db->getMessage());
            exit;
        }

        $this->db->setFetchMode(DB_FETCHMODE_ASSOC);
        $this->db->query('SET NAMES \'utf8\'');
    }

    function get_one($sql, $params = array())
    {
        $sql = $this->db->modifyLimitQuery($sql, 0, 1, $params);
        $res =& $this->db->getOne($sql, $params);
        if (DB::isError($res)) {
            return null;
        }
        return $res;
    }

    function get_row($sql, $params = array())
    {
        $sql = $this->db->modifyLimitQuery($sql, 0, 1, $params);
        $res =& $this->db->getRow($sql, $params);
        if (DB::isError($res)) {
            return array();
        }
        return $res;
    }

    function get_col($sql, $params = array())
    {
        $res =& $this->db->getCol($sql, 0, $params);
        if (DB::isError($res)) {
            return array();
        }
        return $res;
    }

    function get_col_limit($sql, $from, $count, $params = array())
    {
        $sql = $this->db->modifyLimitQuery($sql, intval($from), intval($count), $params);
        return $this->get_col($sql, $params);
    }

    function get_col_page($sql, $page, $count, $params = array())
    {
        $from = (intval($page) - 1) * intval($count);
        return $this->get_col_limit($sql, $from, $count, $params);
    }

    function get_assoc($sql, $params = array())
    {
        $res =& $this->db->getAssoc($sql, false, $params);
        if (DB::isError($res)) {
            return array();
        }
        return $res;
    }

    function get_assoc_limit($sql, $from, $count, $params = array())
    {
        $sql = $this->db->modifyLimitQuery($sql, intval($from), intval($count), $params);
        return $this->get_assoc($sql, $params);
    }

    function get_all($sql, $params = array())
    {
        $res =& $this->db->getAll($sql, $params);
        if (DB::isError($res)) {
            return array();
        }
        return $res;
    }

    function get_all_limit($sql, $from, $count, $params = array())
    {
        $sql = $this->db->modifyLimitQuery($sql, intval($from), intval($count), $params);
        return $this->get_all($sql, $params);
    }

    function get_all_page($sql, $page, $count, $params = array())
    {
        $from = (intval($page) - 1) * intval($count);
        return $this->get_all_limit($sql, $from, $count, $params);
    }

    function quote($in)
    {
        return $this->db->quoteSmart($in);
    }

    /**
     * static method
     */
    function escapeIdentifier($str)
    {
        return preg_replace('/[^a-zA-Z0-9_]/', '', $str);
    }

    function makeWhereClause($where)
    {
        if (!is_array($where)) {
            return $where;
        }

        $_where = '';
        $first = true;
        foreach ($where as $key => $value) {
            if ($first) {
                $first = false;
            } else {
                $_where .= ' AND ';
            }
            $_where .= $key . ' = ' . $this->quote($value);
        }
        return $_where;
    }

    function &query($sql, $params = array())
    {
        return $this->db->query($sql, $params);
    }

    function insert($table, $fields_values, $pkey = '')
    {
        if ($this->readonly) {
            return false;
        }

        $seq_name = sprintf('%s_%s', $table, $pkey);
        if ($pkey && ($id = $this->nextId($seq_name))) {
            if (DB::isError($id)) {
                return false;
            }
            $fields_values = array($pkey => $id) + $fields_values;
        }

        $res = $this->db->autoExecute($table, $fields_values, DB_AUTOQUERY_INSERT);
        if (DB::isError($res)) {
            return false;
        }
        return $this->insertId($id);
    }

    function nextId($seq_name = '', $ondemand = true)
    {
        if ($this->db->phptype == 'mysql') {
            return null;
        } else {
            return $this->db->nextId($seq_name, $ondemand);
        }
    }

    function insertId($id = null)
    {
        if ($this->db->phptype == 'mysql') {
            return $this->db->getOne('SELECT LAST_INSERT_ID()');
        } else {
            return $id;
        }
    }

    function update($table, $fields_values, $where)
    {
        if ($this->readonly) {
            return false;
        }

        $where = $this->makeWhereClause($where);
        $res = $this->db->autoExecute($table, $fields_values, DB_AUTOQUERY_UPDATE, $where);
        if (DB::isError($res)) {
            return false;
        }
        return true;
    }

    function affectedRows()
    {
        return $this->db->affectedRows();
    }
}

?>
