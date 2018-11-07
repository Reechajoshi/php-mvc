<?php

/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['dsn']      The full DSN string describe a connection to the database.
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database driver. e.g.: mysqli.
|			Currently supported:
|				 cubrid, ibase, mssql, mysql, mysqli, oci8,
|				 odbc, pdo, postgre, sqlite, sqlite3, sqlsrv
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Query Builder class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['encrypt']  Whether or not to use an encrypted connection.
|
|			'mysql' (deprecated), 'sqlsrv' and 'pdo/sqlsrv' drivers accept TRUE/FALSE
|			'mysqli' and 'pdo/mysql' drivers accept an array with the following options:
|
|				'ssl_key'    - Path to the private key file
|				'ssl_cert'   - Path to the public key certificate file
|				'ssl_ca'     - Path to the certificate authority file
|				'ssl_capath' - Path to a directory containing trusted CA certificats in PEM format
|				'ssl_cipher' - List of *allowed* ciphers to be used for the encryption, separated by colons (':')
|				'ssl_verify' - TRUE/FALSE; Whether verify the server certificate or not ('mysqli' only)
|
|	['compress'] Whether or not to use client compression (MySQL only)
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|	['ssl_options']	Used to set various SSL options that can be used when making SSL connections.
|	['failover'] array - A array with 0 or more data for connections if the main should fail.
|	['save_queries'] TRUE/FALSE - Whether to "save" all executed queries.
| 				NOTE: Disabling this will also effectively disable both
| 				$this->db->last_query() and profiling of DB queries.
| 				When you run a query, with this setting set to TRUE (default),
| 				CodeIgniter will store the SQL statement for debugging purposes.
| 				However, this may cause high memory usage, especially if you run
| 				a lot of SQL queries ... disable this to avoid that problem.
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $query_builder variables lets you determine whether or not to load
| the query builder class.
*/

class DB {

	var $conn = null;
	
	var $servername = "localhost";
	var $username = "alllavis_1video";
	var $password = "abcd1234!";
	var $dbname = "alllavis_1video";

	function DB() {
		// Create connection
		$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
	
		// Check connection
		if ($this->conn->connect_error) {
		    die("Connection failed: " . $this->conn->connect_error);
		}
	}


	public function getCapiatlData()
	{
		$result = array();
		$resultRow = array();
		$start = date('Y-m-d 00:00:00');
        	$end = date('Y-m-d 23:59:00');
		$query = $this->conn->query("SELECT * FROM video WHERE `type` = 0 AND is_delete=0  AND datetime >= '$start' and datetime <= '$end'  ORDER BY datetime LIMIT 5");

		if ($query->num_rows > 0) {
			while($row = $query->fetch_assoc()) {
				$resultRow["id"] = $row["id"];
				$resultRow["number"] = $row["number"];
				$resultRow["datetime"] = $row["datetime"];
				$resultRow["active"] = $row["active"];
				$resultRow["remarks"] = $row["remarks"];
				$resultRow["type"] = $row["type"];
				$resultRow["is_played"] = $row["is_played"];
				$resultRow["is_delete"] = $row["is_delete"];
				$result[] = $resultRow;
			}	
		}
		
		return $result;
	}
	public function getCPlay($now)
	{
		$result = array();
		$resultRow = array();
		$query = $this->conn->query("SELECT * FROM video WHERE `type`=0 AND is_delete=0 AND datetime >= '$now'  ORDER BY datetime LIMIT 1");
		if ($query->num_rows > 0) {
			while($row = $query->fetch_assoc()) {
				$resultRow["id"] = $row["id"];
				$resultRow["number"] = $row["number"];
				$resultRow["datetime"] = $row["datetime"];
				$resultRow["active"] = $row["active"];
				$resultRow["remarks"] = $row["remarks"];
				$resultRow["type"] = $row["type"];
				$resultRow["is_played"] = $row["is_played"];
				$resultRow["is_delete"] = $row["is_delete"];
				$result[] = $resultRow;
			}
		}

		return $result;
	}
	public function getCPlayNext($now)
	{
		
		$result = array();
		$resultRow = array();
		$query = $this->conn->query("SELECT * FROM video WHERE datetime > '$now' AND `type`=0 AND is_delete=0  AND datetime < CAST(DATE('$now') + INTERVAL 1 DAY AS DATETIME)   LIMIT 1");
		// $result = $query->result_array();
		if ($query->num_rows > 0) {
			while($row = $query->fetch_assoc()) {
				$resultRow["id"] = $row["id"];
				$resultRow["number"] = $row["number"];
				$resultRow["datetime"] = $row["datetime"];
				$resultRow["active"] = $row["active"];
				$resultRow["remarks"] = $row["remarks"];
				$resultRow["type"] = $row["type"];
				$resultRow["is_played"] = $row["is_played"];
				$resultRow["is_delete"] = $row["is_delete"];
				$result[] = $resultRow;
			}
		}
		
		return $result;
		
	}
	
	public function getAjaxCapital($date)
	{
		$result = array();
		$resultRow = array();
		$start = date($date .' 00:00:00');
		$end = date($date.' 23:59:00');
		
		$query = $this->conn->query("SELECT * FROM video WHERE `type` = 0 AND is_delete=0  AND datetime >= '$start' and datetime <= '$end'  ORDER BY datetime LIMIT 5");
		if ($query->num_rows > 0) {
			while($row = $query->fetch_assoc()) {
				$resultRow["id"] = $row["id"];
				$resultRow["number"] = $row["number"];
				$resultRow["datetime"] = $row["datetime"];
				$resultRow["active"] = $row["active"];
				$resultRow["remarks"] = $row["remarks"];
				$resultRow["type"] = $row["type"];
				$resultRow["is_played"] = $row["is_played"];
				$resultRow["is_delete"] = $row["is_delete"];
				$result[] = $resultRow;
			}
		}
		return $result;
	}
	
	public function getAjaxRoyal($date)
	{
		error_log("GET AJAX ROYAL CALLED>...");
		$result = array();
		$resultRow = array();
		$start = date($date .' 00:00:00');
		$end = date($date.' 23:59:00');
		
		$query = $this->conn->query("SELECT * FROM video WHERE `type` = 1 AND is_delete=0  AND datetime >= '$start' and datetime <= '$end'  ORDER BY datetime LIMIT 5");
		if ($query->num_rows > 0) {
			while($row = $query->fetch_assoc()) {
				$resultRow["id"] = $row["id"];
				$resultRow["number"] = $row["number"];
				$resultRow["datetime"] = $row["datetime"];
				$resultRow["active"] = $row["active"];
				$resultRow["remarks"] = $row["remarks"];
				$resultRow["type"] = $row["type"];
				$resultRow["is_played"] = $row["is_played"];
				$resultRow["is_delete"] = $row["is_delete"];
				$result[] = $resultRow;
			}
		}
		return $result;
	}
	
	public function closeDb() {
		$this->conn->close();
	}

}