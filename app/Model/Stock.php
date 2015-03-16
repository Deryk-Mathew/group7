<?php
App::uses('AppModel', 'Model');
App::import('Helper','Html');
//App::import('Controller', 'TransactionRecords');
/**
 * Stock Model
 *
 * @property StockExchange $StockExchange
 */
class Stock extends AppModel {

//public $actsAs = array('Linkable','Containable');

public function GetData($con) {
		$view = new View($con);
		$html = $view->loadHelper('Html');
		
        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * Easy set variables
        */
         
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
        */
        $aColumns = array('id', 'symbol', 'name', 'exchange_id', 'change','lastTradePriceOnly','gbp_price');
        $firstsearchindex = 1;
		$lastsearchindex = 4;
		$localprice = 5;
		$gbpprice = 6;
        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";
         
        /* DB table to use */
        $sTable = "stocks";
         
        App::uses('ConnectionManager', 'Model');
        $dataSource = ConnectionManager::getDataSource('default');
         
        /* Database connection information */
        $gaSql['user']       = $dataSource->config['login'];
        $gaSql['password']   = $dataSource->config['password'];
        $gaSql['db']         = $dataSource->config['database'];
        $gaSql['server']     = $dataSource->config['host'];
         
         
        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * If you just want to use the basic configuration for DataTables with PHP server-side, there is
        * no need to edit below this line
        */
         
        /*
         * Local functions
        */
        function fatal_error ( $sErrorMessage = '' )
        {
            header( $_SERVER['SERVER_PROTOCOL'] .' 500 Internal Server Error' );
            die( $sErrorMessage );
        }
         
         
        /*
         * MySQL connection
        */
        if ( ! $gaSql['link'] = mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) )
        {
            fatal_error( 'Could not open connection to server' );
        }
         
        if ( ! mysql_select_db( $gaSql['db'], $gaSql['link'] ) )
        {
            fatal_error( 'Could not select database ' );
        }
         
         
        /*
         * Paging
        */
        $sLimit = "";
        if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
        {
            $sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
                    intval( $_GET['iDisplayLength'] );
        }
         
         
        /*
         * Ordering
        */
        $sOrder = "";
        if ( isset( $_GET['iSortCol_0'] ) )
        {
            $sOrder = "ORDER BY  ";
            for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
            {
                if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
                {
					if(intval( $_GET['iSortCol_'.$i]) == $localprice){
						$sOrder .= "`".$aColumns[ $gbpprice ]."` ".
                        ($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
					}
					else{
                    $sOrder .= "`".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."` ".
                        ($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
					}
                }
            }
         
            $sOrder = substr_replace( $sOrder, "", -2 );
            if ( $sOrder == "ORDER BY" )
            {
                $sOrder = "";
            }
        }
         
         
        /*
         * Filtering
        * NOTE this does not match the built-in DataTables filtering which does it
        * word by word on any field. It's possible to do here, but concerned about efficiency
        * on very large tables, and MySQL's regex functionality is very limited
        */
        $sWhere = "";
        if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
        {
            $sWhere = "WHERE (";
            for ( $i=$firstsearchindex ; $i<$lastsearchindex-1 ; $i++ )
            {
				if( $aColumns[$i] == "exchange_id" ){
					$sWhere .= "`".$aColumns[$i]."` LIKE '".mysql_real_escape_string( $_GET['sSearch'] )."' OR ";
				}
				else{
					$sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
				}
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }
         
        /* Individual column filtering */
        for ( $i=$firstsearchindex ; $i<$lastsearchindex ; $i++ )
        {
			if( $aColumns[$i] == "exchange_id" ){
				if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
					{
                if ( $sWhere == "" )
                {
                    $sWhere = "WHERE ";
                }
                else
                {
                    $sWhere .= " AND ";
                }
                $sWhere .= "`".$aColumns[$i]."` LIKE '".mysql_real_escape_string($_GET['sSearch_'.$i])."' ";
					}
			}
			else{
				if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
					{
                if ( $sWhere == "" )
                {
                    $sWhere = "WHERE ";
                }
                else
                {
                    $sWhere .= " AND ";
                }
                $sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
					}
			}
            
        }
         
         
        /*
         * SQL queries
        * Get data to display
        */
        $sQuery = "
    SELECT SQL_CALC_FOUND_ROWS `".str_replace(" , ", " ", implode("`, `", $aColumns))."`
            FROM   $sTable
            $sWhere
            $sOrder
            $sLimit
            ";
        $rResult = mysql_query( $sQuery, $gaSql['link'] ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
         
        /* Data set length after filtering */
        $sQuery = "
    SELECT FOUND_ROWS()
";
        $rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
        $aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
        $iFilteredTotal = $aResultFilterTotal[0];
         
        /* Total data set length */
        $sQuery = "
    SELECT COUNT(`".$sIndexColumn."`)
            FROM   $sTable
            ";
        $rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
        $aResultTotal = mysql_fetch_array($rResultTotal);
        $iTotal = $aResultTotal[0];
         
         
        /*
         * Output
        */
		if(isset($_GET['sEcho'])){
			$secho = intval($_GET['sEcho']);
		}
		else{
			$secho = 1;
		}
        $output = array(
                "sEcho" => $secho,
                "iTotalRecords" => $iTotal,
                "iTotalDisplayRecords" => $iFilteredTotal,
                "aaData" => array()
        );
        $exchangequery = "SELECT `stock_exchanges`.`id`,`full_name`,`exchange_rates`.`currency` FROM `stock_exchanges`,`exchange_rates` WHERE `stock_exchanges`.`currency` = `exchange_rates`.`id`";
		$exchangeResult = mysql_query($exchangequery,$gaSql['link']) or fatal_error( 'MySQL Error: ' . mysql_errno());
		$exchangedata = array();
		while($exchangerow = mysql_fetch_array($exchangeResult) ){
			$exchangedata[$exchangerow['id']] = $exchangerow;
		}
        while ( $aRow = mysql_fetch_array( $rResult ) )
        {
            $row = array();
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                if ( $aColumns[$i] == "version" )
                {
                    /* Special output formatting for 'version' column */
                    $row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
                }
				else if ( $aColumns[$i] == "change" )
                {
                    /* Special output formatting for 'change' column */
					$current = $aRow[$aColumns[$i]];
					if($current>0){
						$row["change"] = "<font color = 'green'>".$current."%</font>";
					}
                    else if($current<0){
						$row["change"] = "<font color = 'red'>".$current."%</font>";
					}
					else{
						$row["change"] = $current."%";
					}
                }
                else if ( $aColumns[$i] != ' ' )
                {
                    /* General output */
                    $row[$aColumns[$i]] = $aRow[ $aColumns[$i] ];
                }
            }
			
			$row['lastTradePriceOnly'] .= " ".$exchangedata[$aRow['exchange_id']]['currency'] ;
			$row['exchange_name'] .= " ".$exchangedata[$aRow['exchange_id']]['full_name'] ;
			
			if($con->Session->read('current_client') == null){
				$row["action"] = 
				$html->link(__('View'), array('controller' => 'stocks', 'action' => 'view', $aRow['id']));
			}
			else{
				$row["action"] = $html->link(__('View'), array('controller' => 'stocks', 'action' => 'view', $aRow['id'])).$html->link(__('Buy'),
				array('controller' => 'clientStocks', 'action' => 'buyStock', $aRow['id'],$con->Session->read('current_client')));
			}
			
			//$row["exchange"] = $exchanges[$aRow['exchange_id']];
            $output['aaData'][] = $row;
        }
         
        return $output;
    }


/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'averageDailyVolume' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'change' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'daysLow' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'daysHigh' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'yearLow' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'marketCapitalization' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'lastTradePriceOnly' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'daysRange' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'symbol' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'volume' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'exchange_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'StockExchange' => array(
			'className' => 'StockExchange',
			'foreignKey' => 'exchange_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	public $hasMany = array(
		'ClientStock' => array(
			'className' => 'ClientStock',
			'foreignKey' => 'stock_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	
	
}
