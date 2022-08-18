<?php
declare(strict_types=1);

namespace Be\SmLaufliste\Domain\Repository;

/***
 *
 * This file is part of the "Laufliste" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 Stefan Matthes <stefan.matthes@branding-energy.de>, Branding Energy
 *
 ***/

/**
 * The repository for Moduls
 */
class ModulRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * @var array in ('..)
     */
    protected $defaultOrderings = [
        'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
    ];

    public function initializeObject()
    {
     //   $querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
    //    $querySettings->setRespectStoragePage(FALSE);
     //   $this->setDefaultQuerySettings($querySettings);
    }

    /**
     * Render the generated SQL of a query in TYPO3 8
     *
     * @param \TYPO3\CMS\Extbase\Persistence\QueryInterface $query
     * @param bool $format
     * @param bool $exit
     */
    private function debugQuery($query, $format = true, $exit = true)
    {
        function getFormattedSQL($sql_raw)
        {    if (empty($sql_raw) || !is_string($sql_raw)) {
                return false;
            }
            $sql_reserved_all = ['ACCESSIBLE', 'ACTION', 'ADD', 'AFTER', 'AGAINST', 'AGGREGATE', 'ALGORITHM', 'ALL', 'ALTER', 'ANALYSE', 'ANALYZE', 'AND', 'AS', 'ASC', 'AUTOCOMMIT', 'AUTO_INCREMENT', 'AVG_ROW_LENGTH', 'BACKUP', 'BEGIN', 'BETWEEN', 'BINLOG', 'BOTH', 'BY', 'CASCADE', 'CASE', 'CHANGE', 'CHANGED', 'CHARSET', 'CHECK', 'CHECKSUM', 'COLLATE', 'COLLATION', 'COLUMN', 'COLUMNS', 'COMMENT', 'COMMIT', 'COMMITTED', 'COMPRESSED', 'CONCURRENT', 'CONSTRAINT', 'CONTAINS', 'CONVERT', 'CREATE', 'CROSS', 'CURRENT_TIMESTAMP', 'DATABASE', 'DATABASES', 'DAY', 'DAY_HOUR', 'DAY_MINUTE', 'DAY_SECOND', 'DEFINER', 'DELAYED', 'DELAY_KEY_WRITE', 'DELETE', 'DESC', 'DESCRIBE', 'DETERMINISTIC', 'DISTINCT', 'DISTINCTROW', 'DIV', 'DO', 'DROP', 'DUMPFILE', 'DUPLICATE', 'DYNAMIC', 'ELSE', 'ENCLOSED', 'END', 'ENGINE', 'ENGINES', 'ESCAPE', 'ESCAPED', 'EVENTS', 'EXECUTE', 'EXISTS', 'EXPLAIN', 'EXTENDED', 'FAST', 'FIELDS', 'FILE', 'FIRST', 'FIXED', 'FLUSH', 'FOR', 'FORCE', 'FOREIGN', 'FROM', 'FULL', 'FULLTEXT', 'FUNCTION', 'GEMINI', 'GEMINI_SPIN_RETRIES', 'GLOBAL', 'GRANT', 'GRANTS', 'GROUP', 'HAVING', 'HEAP', 'HIGH_PRIORITY', 'HOSTS', 'HOUR', 'HOUR_MINUTE', 'HOUR_SECOND', 'IDENTIFIED', 'IF', 'IGNORE', 'IN', 'INDEX', 'INDEXES', 'INFILE', 'INNER', 'INSERT', 'INSERT_ID', 'INSERT_METHOD', 'INTERVAL', 'INTO', 'INVOKER', 'IS', 'ISOLATION', 'JOIN', 'KEY', 'KEYS', 'KILL', 'LAST_INSERT_ID', 'LEADING', 'LEFT', 'LEVEL', 'LIKE', 'LIMIT', 'LINEAR', 'LINES', 'LOAD', 'LOCAL', 'LOCK', 'LOCKS', 'LOGS', 'LOW_PRIORITY', 'MARIA', 'MASTER', 'MASTER_CONNECT_RETRY', 'MASTER_HOST', 'MASTER_LOG_FILE', 'MASTER_LOG_POS', 'MASTER_PASSWORD', 'MASTER_PORT', 'MASTER_USER', 'MATCH', 'MAX_CONNECTIONS_PER_HOUR', 'MAX_QUERIES_PER_HOUR', 'MAX_ROWS', 'MAX_UPDATES_PER_HOUR', 'MAX_USER_CONNECTIONS', 'MEDIUM', 'MERGE', 'MINUTE', 'MINUTE_SECOND', 'MIN_ROWS', 'MODE', 'MODIFY', 'MONTH', 'MRG_MYISAM', 'MYISAM', 'NAMES', 'NATURAL', 'NOT', 'NULL', 'OFFSET', 'ON', 'OPEN', 'OPTIMIZE', 'OPTION', 'OPTIONALLY', 'OR', 'ORDER', 'OUTER', 'OUTFILE', 'PACK_KEYS', 'PAGE', 'PARTIAL', 'PARTITION', 'PARTITIONS', 'PASSWORD', 'PRIMARY', 'PRIVILEGES', 'PROCEDURE', 'PROCESS', 'PROCESSLIST', 'PURGE', 'QUICK', 'RAID0', 'RAID_CHUNKS', 'RAID_CHUNKSIZE', 'RAID_TYPE', 'RANGE', 'READ', 'READ_ONLY', 'READ_WRITE', 'REFERENCES', 'REGEXP', 'RELOAD', 'RENAME', 'REPAIR', 'REPEATABLE', 'REPLACE', 'REPLICATION', 'RESET', 'RESTORE', 'RESTRICT', 'RETURN', 'RETURNS', 'REVOKE', 'RIGHT', 'RLIKE', 'ROLLBACK', 'ROW', 'ROWS', 'ROW_FORMAT', 'SECOND', 'SECURITY', 'SELECT', 'SEPARATOR', 'SERIALIZABLE', 'SESSION', 'SET', 'SHARE', 'SHOW', 'SHUTDOWN', 'SLAVE', 'SONAME', 'SOUNDS', 'SQL', 'SQL_AUTO_IS_NULL', 'SQL_BIG_RESULT', 'SQL_BIG_SELECTS', 'SQL_BIG_TABLES', 'SQL_BUFFER_RESULT', 'SQL_CACHE', 'SQL_CALC_FOUND_ROWS', 'SQL_LOG_BIN', 'SQL_LOG_OFF', 'SQL_LOG_UPDATE', 'SQL_LOW_PRIORITY_UPDATES', 'SQL_MAX_JOIN_SIZE', 'SQL_NO_CACHE', 'SQL_QUOTE_SHOW_CREATE', 'SQL_SAFE_UPDATES', 'SQL_SELECT_LIMIT', 'SQL_SLAVE_SKIP_COUNTER', 'SQL_SMALL_RESULT', 'SQL_WARNINGS', 'START', 'STARTING', 'STATUS', 'STOP', 'STORAGE', 'STRAIGHT_JOIN', 'STRING', 'STRIPED', 'SUPER', 'TABLE', 'TABLES', 'TEMPORARY', 'TERMINATED', 'THEN', 'TO', 'TRAILING', 'TRANSACTIONAL', 'TRUNCATE', 'TYPE', 'TYPES', 'UNCOMMITTED', 'UNION', 'UNIQUE', 'UNLOCK', 'UPDATE', 'USAGE', 'USE', 'USING', 'VALUES', 'VARIABLES', 'VIEW', 'WHEN', 'WHERE', 'WITH', 'WORK', 'WRITE', 'XOR', 'YEAR_MONTH'];
            $sql_skip_reserved_words = ['AS', 'ON', 'USING'];
            $sql_special_reserved_words = ['(', ')'];
            $sql_raw = str_replace('
',
                ' ', $sql_raw
            );
            $sql_formatted = '';
            $prev_word = '';
            $word = '';
            for ($i = 0, $j = strlen($sql_raw); $i < $j; $i++) {
                $word .= $sql_raw[$i];
                $word_trimmed = trim($word);
                if ($sql_raw[$i] == ' ' || in_array($sql_raw[$i], $sql_special_reserved_words)) {
                    $word_trimmed = trim($word);
                    $trimmed_special = false;
                    if (in_array($sql_raw[$i], $sql_special_reserved_words)) {
                        $word_trimmed = substr($word_trimmed, 0, -1);
                        $trimmed_special = true;
                    }
                    $word_trimmed = strtoupper($word_trimmed);
                    if (in_array($word_trimmed, $sql_reserved_all) && !in_array($word_trimmed, $sql_skip_reserved_words)) {
                        if (in_array($prev_word, $sql_reserved_all)) {
                            $sql_formatted .= '<b>' . strtoupper(trim($word)) . '</b>' . '&nbsp;';
                        } else {
                            $sql_formatted .= '<br/>&nbsp;';
                            $sql_formatted .= '<b>' . strtoupper(trim($word)) . '</b>' . '&nbsp;';
                        }
                        $prev_word = $word_trimmed;
                        $word = '';
                    } else {
                        $sql_formatted .= trim($word) . '&nbsp;';
                        $prev_word = $word_trimmed;
                        $word = '';
                    }
                }
            }
            $sql_formatted .= trim($word);
            return $sql_formatted;
        }
        $queryParser = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\Storage\Typo3DbQueryParser::class);
        $preparedStatement = $queryParser->convertQueryToDoctrineQueryBuilder($query)->getSQL();
        $parameters = $queryParser->convertQueryToDoctrineQueryBuilder($query)->getParameters();
        $stringParams = [];
        foreach ($parameters as $key => $parameter) {
            $stringParams[':' . $key] = $parameter;
        }
        $statement = strtr($preparedStatement, $stringParams);
        if ($format) {
            echo '<code>' . getFormattedSQL($statement) . '</code>';
        } else {
            echo $statement;
        }
        if ($exit) {
            die;
        }
    }

    /**
     * Find by TokeID
     *
     * @param $tokenid
     */
    public function findByTokenId($tokenid)
    {
        //     echo "Modul auslesen mit TokenID: ".$tokenid;
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(FALSE);
        $query->matching($query->logicalAnd($query->equals('tokenid', $tokenid), $query->equals('hidden', 0), $query->equals('deleted', 0)));
        //   $query->setOrderings($this->orderByField('uid', $uidArray));
        // $query->setLimit(1);
        //    $this->debugQuery($query);
        $result = $query->execute()->current();
        return $result;
    }

    /**
     * Find ALL
     */
    public function findAllModules()
    {
       echo "Modul auslesen mit TokenID: ".$tokenid;
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(TRUE);
        $query->matching($query->equals('hidden', 0), $query->equals('deleted', 0));
        //   $query->setOrderings($this->orderByField('uid', $uidArray));
        // $query->setLimit(1);
        //   $this->debugQuery($query);
        $result = $query->execute();
        return $result;
    }
   
   /**
     * Find ALL FII
     */
    public function findAllModulesDiff()
    {
        //     echo "Modul auslesen mit TokenID: ".$tokenid;
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(TRUE);
        $query->matching(
		 $query->logicalAnd(
		 $query->equals('hidden', 0), 
		 $query->equals('deleted', 0), 
		 $query->greaterThan('diff', 1)
		 )
		 );
        //   $query->setOrderings($this->orderByField('uid', $uidArray));
        // $query->setLimit(1);
 //    $this->debugQuery($query);
        $result = $query->execute();
        return $result;
    }

    /**
     * Find by findByModulesAndDates
     *
     * @param $modules,$startdate,$enddate
     * @param $startdate
     * @param $enddate
     */
    public function findByModulesAndDates($modules, $startdate, $enddate)
    {
        //    echo "Modul auslesen mit TokenID: ".$tokenid;
        $module_list = implode(',', $modules);
        $startdate_ts = strtotime($startdate);
        $enddate_ts = strtotime($enddate);
        $query = $this->createQuery();
        //$statement = 'SELECT * FROM tx_smlaufliste_domain_model_messung where crdate BETWEEN '.  $startdate_ts.' AND '.  $enddate_ts.'  AND module in ('.  $module_list.') AND deleted=0';
        $statement = 'SELECT module,value, tx_smlaufliste_domain_model_messung.tstamp, tx_smlaufliste_domain_model_modul.kks
FROM tx_smlaufliste_domain_model_messung left join tx_smlaufliste_domain_model_modul
on tx_smlaufliste_domain_model_messung.module = tx_smlaufliste_domain_model_modul.uid
where tx_smlaufliste_domain_model_messung.tstamp BETWEEN ' . $startdate_ts . ' AND ' . $enddate_ts . '  AND module in (' . $module_list . ') AND module in (' . $module_list . ') AND tx_smlaufliste_domain_model_messung.deleted=0';
  //  echo $statement;
        $query->statement($statement);
        //     $query->matching( $query->logicalAnd($query->equals('tokenid', $tokenid),$query->equals('hidden', 0), $query->equals('deleted', 0)));
        //   $query->setOrderings($this->orderByField('uid', $uidArray;
        return $query->execute(true);
    }

    /**
     * Find by findAllWithLastMeasurement
     */
    public function findAllWithLastMeasurement()
    {
        $query = $this->createQuery();
        //$statement = 'SELECT * FROM tx_smlaufliste_domain_model_messung where crdate BETWEEN '.  $startdate_ts.' AND '.  $enddate_ts.'  AND module in ('.  $module_list.') AND deleted=0';
        $statement = 'SELECT mo.*,m.crdate as date_letztemessung ,m.value as wert_letztemessung 
FROM tx_smlaufliste_domain_model_modul  mo  LEFT JOIN tx_smlaufliste_domain_model_messung m on mo.uid = m.module AND m.deleted=0
WHERE m.crdate IS NULL
    OR m.crdate = (
        SELECT MAX(crdate)
        FROM tx_smlaufliste_domain_model_messung m
        WHERE mo.uid = m.module
    )
    ORDER BY mo.uid';
        $statement1 = 'SELECT
mo.*,

(
    SELECT me1.value 
    FROM  `tx_smlaufliste_domain_model_messung` me1 
    WHERE mo.uid = me1.module 
    AND me1.tstamp = (
        SELECT max(met1.tstamp) 
        FROM `tx_smlaufliste_domain_model_messung` met1 
        WHERE mo.uid = met1.module
        AND DATE_FORMAT(FROM_UNIXTIME(met1.tstamp ), \'%H\')BETWEEN 1 AND 7
        AND DATE_FORMAT(FROM_UNIXTIME(met1.tstamp ), \'%Y-%m-%d\') = CURDATE()

    )
) as value_messung_frueh,

(
    SELECT me1.value 
    FROM  `tx_smlaufliste_domain_model_messung` me1 
    WHERE mo.uid = me1.module 
    AND me1.tstamp = (
        SELECT max(met1.tstamp) 
        FROM `tx_smlaufliste_domain_model_messung` met1 
        WHERE mo.uid = met1.module
        AND DATE_FORMAT(FROM_UNIXTIME(met1.tstamp ), \'%H\') BETWEEN 8 AND  18
        AND DATE_FORMAT(FROM_UNIXTIME(met1.tstamp ), \'%Y-%m-%d\') = CURDATE()
    )
) as value_messung_spaet,

(
    SELECT me1.value 
    FROM  `tx_smlaufliste_domain_model_messung` me1 
    WHERE mo.uid = me1.module 
    AND me1.tstamp = (
        SELECT max(met1.tstamp) 
        FROM `tx_smlaufliste_domain_model_messung` met1 
        WHERE mo.uid = met1.module
        AND DATE_FORMAT(FROM_UNIXTIME(met1.tstamp ), \'%H\')BETWEEN 18 AND 24
        AND DATE_FORMAT(FROM_UNIXTIME(met1.tstamp ), \'%Y-%m-%d\') = CURDATE()
    )
) as value_messung_abends

FROM  tx_smlaufliste_domain_model_modul mo where mo.hidden=0 AND mo.deleted=0 AND mo.kks!=""';
        //echo $statement;
        $query->statement($statement);
        //     $query->matching( $query->logicalAnd($query->equals('tokenid', $tokenid),$query->equals('hidden', 0), $query->equals('deleted', 0)));
        //   $query->setOrderings($this->orderByField('uid', $uidArray;
        return $query->execute(true);
    }
}
