<?php
if(!class_exists('SamUpdater')) {
  class SamUpdater {
    private $dbVersion;
    private $versionsData;
    private $options;

    public function __construct($dbVersion, $versionsData, $options = null) {
      $this->dbVersion = $dbVersion;
      $this->versionsData = $versionsData;
      $this->options = $options;
    }

    private function  versionCompare($ver1, $ver2, $arg = '=') {
      $version1 = explode('.', $ver1);
      $version2 = explode('.', $ver2);
      $v1 = (intval($version1[0]) * 1000) + intval($version1[1]) + ((!empty($version1[2])) ? intval($version1[2]) / 100 : 0 );
      $v2 = (intval($version2[0]) * 1000) + intval($version2[1]) + ((!empty($version2[2])) ? intval($version2[2]) / 100 : 0 );
      switch($arg) {
        case '=':
          $out = $v1 == $v2;
          break;
        case '<=':
          $out = $v1 <= $v2;
          break;
        case '<':
          $out = $v1 < $v2;
          break;
        case '>':
          $out = $v1 > $v2;
          break;
        case '>=':
          $out = $v1 >= $v2;
          break;
        default:
          $out = $v1 == $v2;
          break;
      }
      return $out;
    }

    private function errorWrite($eTable, $rTable, $eSql = null, $eResult = null, $lastError = null) {
      global $wpdb;

      if(!is_null($eResult)) {
        if($eResult === false) {
          $wpdb->insert(
            $eTable,
            array(
              'error_date' => current_time('mysql'),
              'table_name' => $rTable,
              'error_type' => 1,
              'error_msg' => (empty($lastError)) ? __('An error occurred during updating process...', SAM_DOMAIN) : $lastError,
              'error_sql' => $eSql,
              'resolved' => 0
            ),
            array('%s', '%s', '%d', '%s', '%s', '%d')
          );
        }
        else {
          $wpdb->insert(
            $eTable,
            array(
              'error_date' => current_time('mysql'),
              'table_name' => $rTable,
              'error_type' => 0,
              'error_msg' => (empty($lastError)) ? __('Updated...', SAM_DOMAIN) : $lastError,
              'error_sql' => $eSql,
              'resolved' => 1
            ),
            array('%s', '%s', '%d', '%s', '%s', '%d')
          );
        }
      }
    }

    private function getCreateSql( $table, $defTable ) {
      global $charset_collate;

      $add = '';
      $primaryKey = '';

      // Table
	    foreach($defTable as $key => $val) {
        $add .= ((empty($add)) ? '' : ', ')
          . $key . ' ' . $val['Type']
          . (($val['Null'] == 'NO') ? ' NOT NULL' : '')
          . ((empty($val['Default'])) ? '' : ' DEFAULT ' . (($val['Extra'] == 'str') ? "'{$val['Default']}'" : $val['Default']))
          . (($val['Extra'] == 'auto_increment') ? ' AUTO_INCREMENT' : '' );
        if($val['Key'] == 'PRI') $primaryKey .= ((empty($primaryKey)) ? '' : ', ') . $key;
      }

      if(!empty($add)) {
        $add .= ((!empty($primaryKey)) ? ", PRIMARY KEY ({$primaryKey})" : '');
        $out = "CREATE TABLE {$table} ({$add}) {$charset_collate};";
      }
      else $out = '';

      return $out;
    }

    public function getUpdateSql($table, $defTable) {
      global $wpdb, $charset_collate;
      $dbv = $this->dbVersion;
      $curTable = array();
      $add = '';
      $modify = '';
      $out = '';
      $change = '';

      if(self::versionCompare($dbv, '2.0', '<')) {
        $charset = str_replace('DEFAULT ', '', $charset_collate);
        $change = "CONVERT TO $charset";
      }

      $ct = $wpdb->get_results("DESCRIBE $table;", ARRAY_A);
      foreach($ct as $val) {
        $curTable[$val['Field']] = array(
          'Type' => $val['Type'],
          'Null' => $val['Null'],
          'Key' => $val['Key'],
          'Default' => $val['Default'],
          'Extra' => $val['Extra']
        );
      }

      foreach($defTable as $key => $val) {
        if(empty($curTable[$key]))
          $add .= ((empty($add)) ? '' : ', ')
            . $key . ' ' . $val['Type']
            . (($val['Null'] == 'NO') ? ' NOT NULL' : '')
            . ((empty($val['Default'])) ? '' : ' DEFAULT ' . (($val['Extra'] == 'str') ? "'{$val['Default']}'" : $val['Default']));
        elseif($curTable[$key]['Type'] != $val['Type'])
          $modify .= ((empty($modify)) ? '' : ', ')
            . 'MODIFY ' . $key . ' ' . $val['Type']
            . (($val['Null'] == 'NO') ? ' NOT NULL' : '');
      }
      $add = (!empty($add)) ? "ADD ($add)" : '';

      if(!empty($change) && !empty($add)) $add = ', ' . $add;
      if((!empty($add) || !empty($change)) && !empty($modify)) $modify = ', ' . $modify;

      if(!empty($add) || !empty($modify) || !empty($change))
        $out = "ALTER TABLE $table $change $add $modify;";

      return $out;
    }

    private function adsUpdateData($aTable) {
      global $wpdb;
      $dbVersion = $this->dbVersion;

      if(self::versionCompare($dbVersion, '0.1', '=')) {
        $aSqlU = "UPDATE LOW_PRIORITY $aTable sa SET sa.ad_cats = 1, sa.view_type = 0, sa.view_pages = 4 WHERE sa.view_type = 3;";
        $wpdb->query($aSqlU);
      }

      if( self::versionCompare($dbVersion, '2.0', '<=') ) {
        $aTerms = array();
        $tTable = $wpdb->prefix . "terms";
        $termSql = "SELECT name, slug FROM $tTable;";
        $terms = $wpdb->get_results($termSql, OBJECT_K);
        if($terms) {
          foreach($terms as $term) {
            $aTerms[$term->slug] = $term->name;
          }
        }
        // Categories
        $aSql = "SELECT  sa.view_cats FROM $aTable sa WHERE sa.view_cats != '' AND sa.view_cats IS NOT NULL GROUP BY sa.view_cats;";
        $rows = $wpdb->get_results($aSql, OBJECT_K);
        $numRows = $wpdb->num_rows;
        if($rows) {
          foreach($rows as $row) {
            $slugs = array();
            $cats = explode(',', $row->view_cats);
            foreach($cats as $cat) {
              $slug = array_search($cat, $aTerms);
              if($slug) array_push($slugs, $slug);
            }
            $aSlugs = implode(',', $slugs);
            $wpdb->update($aTable, array('view_cats' => $aSlugs), array('view_cats' => $row->view_cats), '%s', '%s');
          }
        }
        // XCategories
        $aSql = "SELECT sa.x_view_cats FROM $aTable sa WHERE sa.x_view_cats != '' AND sa.x_view_cats IS NOT NULL GROUP BY sa.x_view_cats;";
        $rows = $wpdb->get_results($aSql, OBJECT_K);
        $numRows = $wpdb->num_rows;
        if($rows) {
          foreach($rows as $row) {
            $slugs = array();
            $cats = explode(',', $row->x_view_cats);
            foreach($cats as $cat) {
              $slug = array_search($cat, $aTerms);
              if($slug) array_push($slugs, $slug);
            }
            $aSlugs = implode(',', $slugs);
            $wpdb->update($aTable, array('x_view_cats' => $aSlugs), array('x_view_cats' => $row->x_view_cats), '%s', '%s');
          }
        }
        // Tags
        $aSql = "SELECT sa.view_tags FROM $aTable sa WHERE sa.view_tags != '' AND sa.view_tags IS NOT NULL GROUP BY sa.view_tags;";
        $rows = $wpdb->get_results($aSql, OBJECT_K);
        $numRows = $wpdb->num_rows;
        if($rows) {
          foreach($rows as $row) {
            $slugs = array();
            $tags = explode(',', $row->view_tags);
            foreach($tags as $tag) {
              $slug = array_search($tag, $aTerms);
              if($slug) array_push($slugs, $slug);
            }
            $aSlugs = implode(',', $slugs);
            $wpdb->update($aTable, array('view_tags' => $aSlugs), array('view_tags' => $row->view_tags), '%s', '%s');
          }
        }
        // XTags
        $aSql = "SELECT  sa.x_view_tags FROM $aTable sa WHERE sa.x_view_tags != '' AND sa.x_view_tags IS NOT NULL GROUP BY sa.x_view_tags;";
        $rows = $wpdb->get_results($aSql, OBJECT_K);
        $numRows = $wpdb->num_rows;
        if($rows) {
          foreach($rows as $row) {
            $slugs = array();
            $tags = explode(',', $row->x_view_tags);
            foreach($tags as $tag) {
              $slug = array_search($tag, $aTerms);
              if($slug) array_push($slugs, $slug);
            }
            $aSlugs = implode(',', $slugs);
            $wpdb->update($aTable, array('x_view_tags' => $aSlugs), array('x_view_tags' => $row->x_view_tags), '%s', '%s');
          }
        }
      }
    }

    private function removeIndexes() {
      global $wpdb;

      $prefix = $wpdb->prefix;
      $pTable = $wpdb->prefix . "sam_places";
      $aTable = $wpdb->prefix . "sam_ads";
      $zTable = $wpdb->prefix . "sam_zones";
      $bTable = $wpdb->prefix . "sam_blocks";
      $sTable = $wpdb->prefix . "sam_stats";
      $eTable = $wpdb->prefix . "sam_errors";

      $el = (integer)$this->options['errorlog'];

      $sql = "SHOW INDEX FROM {$pTable} WHERE Key_name != %s;";
      $data = $wpdb->get_results($wpdb->prepare($sql, "PRIMARY"), ARRAY_A);
      if(!empty($data)) {
        $sql = "DROP INDEX UK_{$prefix}places ON {$pTable};";
        $dbResult = $wpdb->query( $sql );

        if($el) {
          self::errorWrite($eTable, $pTable, $sql, $dbResult, $wpdb->last_error);
          $dbResult = null;
        }
      }

      $sql = "SHOW INDEX FROM {$aTable} WHERE Key_name != %s;";
      $data = $wpdb->get_results($wpdb->prepare($sql, "PRIMARY"), ARRAY_A);
      if(!empty($data)) {
        $sql = "DROP INDEX UK_{$prefix}ads ON {$aTable};";
        $dbResult = $wpdb->query( $sql );

        if($el) {
          self::errorWrite($eTable, $aTable, $sql, $dbResult, $wpdb->last_error);
          $dbResult = null;
        }
      }

      $sql = "SHOW INDEX FROM {$zTable} WHERE Key_name != %s;";
      $data = $wpdb->get_results($wpdb->prepare($sql, "PRIMARY"), ARRAY_A);
      if(!empty($data)) {
        $sql = "DROP INDEX UK_{$prefix}zones ON {$zTable};";
        $dbResult = $wpdb->query( $sql );

        if($el) {
          self::errorWrite($eTable, $zTable, $sql, $dbResult, $wpdb->last_error);
          $dbResult = null;
        }
      }

      $sql = "SHOW INDEX FROM {$bTable} WHERE Key_name != %s;";
      $data = $wpdb->get_results($wpdb->prepare($sql, "PRIMARY"), ARRAY_A);
      if(!empty($data)) {
        $sql = "DROP INDEX UK_{$prefix}blocks ON {$bTable};";
        $dbResult = $wpdb->query( $sql );

        if($el) {
          self::errorWrite($eTable, $bTable, $sql, $dbResult, $wpdb->last_error);
          $dbResult = null;
        }
      }

      $sql = "SHOW INDEX FROM {$sTable} WHERE Key_name != %s;";
      $data = $wpdb->get_results($wpdb->prepare($sql, "PRIMARY"), ARRAY_A);
      if(!empty($data)) {
        $sql = "DROP INDEX IDX_{$prefix}stats ON {$sTable};";
        $dbResult = $wpdb->query( $sql );

        if($el) {
          self::errorWrite($eTable, $sTable, $sql, $dbResult, $wpdb->last_error);
          $dbResult = null;
        }
      }
    }

    public function update() {
      global $wpdb, $charset_collate, $sam_tables_defs;
      $pTable = $wpdb->prefix . "sam_places";
      $aTable = $wpdb->prefix . "sam_ads";
      $zTable = $wpdb->prefix . "sam_zones";
      $bTable = $wpdb->prefix . "sam_blocks";
      $eTable = $wpdb->prefix . "sam_errors";
      $sTable = $wpdb->prefix . "sam_stats";

      $options = $this->options;
      $el = (integer)$options['errorlog'];

      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

      $dbVersion = $this->dbVersion;

      $dbResult = null;

      if( $dbVersion != SAM_DB_VERSION ) {
        /*if($dbVersion == '2.7')*/ self::removeIndexes();

        if($wpdb->get_var("SHOW TABLES LIKE '$eTable'") != $eTable) {
          $eSql = "CREATE TABLE $eTable (
                    id int(11) NOT NULL AUTO_INCREMENT,
                    error_date datetime DEFAULT NULL,
                    table_name varchar(30) DEFAULT NULL,
                    error_type int(11) NOT NULL DEFAULT 0,
                    error_msg varchar(255) DEFAULT NULL,
                    error_sql text,
                    resolved tinyint(1) NOT NULL DEFAULT 0,
                    PRIMARY KEY (id)
                    ) $charset_collate;";
          dbDelta($eSql);
        }

        // Place Table
        if($wpdb->get_var("SHOW TABLES LIKE '$pTable'") != $pTable) {
          $pSql = self::getCreateSql($pTable, $sam_tables_defs['places']);
          dbDelta($pSql);
        }
        else {
          $pSql = self::getUpdateSql($pTable, $sam_tables_defs['places']);
          if(!empty($pSql)) $dbResult = $wpdb->query($pSql);
        }

        if($el) {
          self::errorWrite($eTable, $pTable, $pSql, $dbResult, $wpdb->last_error);
          $dbResult = null;
        }

        // Ads Table
        if($wpdb->get_var("SHOW TABLES LIKE '$aTable'") != $aTable) {
          $aSql = self::getCreateSql($aTable, $sam_tables_defs['ads']);
          dbDelta($aSql);
        }
        else {
          $aSql = self::getUpdateSql($aTable, $sam_tables_defs['ads']);
          if(!empty($aSql)) $dbResult = $wpdb->query($aSql);
        }

        if($el) {
          self::errorWrite($eTable, $aTable, $aSql, $dbResult, $wpdb->last_error);
          $dbResult = null;
        }

        if(is_null($dbResult) || $dbResult !== false) self::adsUpdateData($aTable);

        // Zones Table
        if($wpdb->get_var("SHOW TABLES LIKE '$zTable'") != $zTable) {
          $zSql = self::getCreateSql($zTable, $sam_tables_defs['zones']);
          dbDelta($zSql);
        }
        else {
          $zSql = self::getUpdateSql($zTable, $sam_tables_defs['zones']);
          if(!empty($zSql)) $dbResult = $wpdb->query($zSql);
        }

        if($el) {
          self::errorWrite($eTable, $zTable, $zSql, $dbResult, $wpdb->last_error);
          $dbResult = null;
        }

        // Blocks Table
        if($wpdb->get_var("SHOW TABLES LIKE '$bTable'") != $bTable) {
          $bSql = self::getCreateSql($bTable, $sam_tables_defs['blocks']);
          dbDelta($bSql);
        }
        else {
          $bSql = self::getUpdateSql($bTable, $sam_tables_defs['blocks']);
          if(!empty($bSql)) $dbResult = $wpdb->query($bSql);
        }

        if($el) {
          self::errorWrite($eTable, $bTable, $bSql, $dbResult, $wpdb->last_error);
          $dbResult = null;
        }

        // Statistics Table
        if($wpdb->get_var("SHOW TABLES LIKE '$sTable'") != $sTable) {
          $sSql = self::getCreateSql($sTable, $sam_tables_defs['stats']);
          dbDelta($sSql);
        }
        else {
          $sSql = self::getUpdateSql($sTable, $sam_tables_defs['stats']);
          if(!empty($sSql)) $dbResult = $wpdb->query($sSql);
        }

        if($el) {
          self::errorWrite($eTable, $sTable, $sSql, $dbResult, $wpdb->last_error);
          $dbResult = null;
        }

        update_option('sam_db_version', SAM_DB_VERSION);
      }
      update_option('sam_version', SAM_VERSION);
    }
  }
}
?>