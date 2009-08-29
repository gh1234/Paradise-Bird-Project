<?php
/**
 * Paketmanager des Paradise Bird Project
 * @author: Jonas Schwabe
 * @copyright: 2009
 * @license: GPL
 * @version: 0.1.0
 */
if(!defined('ROOTPATH'))
define('ROOTPATH', './');
/**
 * Paketmanager Klasse
 * @author Jonas Schwabe
 */
class pm{
	/**
	 * Geladene Pakete
	 * @var array
	 */
	private $_loaded = array();
	/**
	 * Installierte Pakete werden aus der Konfigurationsdatei geladen
	 * @var array
	 */
	private $_installed = array();
	/**
	 * Fehlercodes cachen
	 * @var array
	 */
	private $_errcodes = array();
	/**
	 * Fehlercodes oder Aehnliches
	 * @var string
	 */
	private $_debugcodes = '';
	//Funktionen
	/**
	 * Konstruktor laed KOnfigurationen
	 * @return bool
	 */
	public function pm(){
		if(!$this->_errcodes = $this->_load_lang_file(ROOTPATH."pm/lang/de/error.ini.php"))
		die('Errorfile cannot be loaded.');
		if(!$this->_installed = $this->_load_pack_list(ROOTPATH."pm/config/installed.ini.php")){
			$this->show_error('PACKLIST_WRONG');
			return false;
		}
		if(!$this->_load_packages($this->_installed)){
			$this->show_error('PACKLIST_WRONG');
			return false;
		}
	}
	/**
	 * Laed eine Paketliste wie beispielsweise eine Liste der Installierten Pakete
	 * @param $cfgfile Listendatei
	 * @return bool/array
	 */
	private function _load_pack_list($cfgfile){
		if(!file_exists($cfgfile))
		return false;
		if(!$installed = parse_ini_file($cfgfile, true))
		return false;
		$installed = array_change_key_case($installed, CASE_LOWER); //Nur Kleinbuchstaben
		foreach($installed as $id => $cfg){
			if(!preg_match("![a-z_0-9]!", $id))
			echo $id;
		}
		return $installed;
	}
	/**
	 * Paketliste laden (nur init pakete)
	 * @param $packlist array
	 * @return bool
	 */
	private function _load_packages($packlist){
		if(!is_array($packlist))
		return false;
		foreach($packlist as $id => $cfg){ //Liste durcharbeiten...
			if($cfg['active'] != true)
			continue;
			if($cfg['type'] != 'init')
			continue;
			if(!$this->_load_pack($id, $packlist))
			return false;
		}
		return true;
	}
	/**
	 * Paket einbinden
	 * @param $packname string Paketname
	 * @param $packlist array Paketliste
	 * @return bool
	 */
	private function _load_pack($packname, $packlist){
		if($this->_is_loaded($packname))
		return true;
		if(!is_array($packlist))
		return false;
		if(!isset($packlist[$packname]))
		return false;
		if($packlist[$packname]['active'] != true)
		return false;
		//Abhaengigkeiten laden...
		if(isset($packlist[$packname]['depend_runtime']) && is_array($packlist[$packname]['depend_runtime'])){
			foreach($packlist[$packname]['depend_runtime'] as $depend){
				if(!$this->_load_pack($depend, $packlist))
				return false;
			}
		}
		if(isset($packlist[$packname]['depend_recommend']) && is_array($packlist[$packname]['depend_recommend'])){
			foreach($packlist[$packname]['depend_recommend'] as $depend){
				$this->_load_pack($depend, $packlist);
			}
		}
		if(!is_dir(ROOTPATH.'pack/' . $packname) || !file_exists('pack/' . $packname . '/_init.php'))
		return false;
		$modpath = 'pack/' . $packname . '/';
		require(ROOTPATH.'pack/' . $packname . '/_init.php');
		$this->_loaded[] = $packname;
		return true;
	}
	/**
	 * Ueberprueft ob ein Paket geladen ist
	 * @param $packname string
	 * @return bool
	 */
	private function _is_loaded($packname){
		if(in_array($packname, $this->_loaded))
		return true;
		return false;
	}
	/**
	 * Kombiniert 2 Listen
	 * @param $list1 erste Liste
	 * @param $list2 zweite Liste
	 * @return bool/array
	 */
	private function _sync_list($list1, $list2){
		if(!is_array($list1) || !is_array($list2))
		return false;
		$listed = array();
		foreach($list1 as $id => $cfg){
			$listed[] = $id;
		}
		foreach($list2 as $id => $cfg){
			if(!in_array($id, $listed, true))
			continue;
			if(($compare = $this->_compare_version($cfg['version'], $list1[$id]['version'])) == 2)
			$list1[$id] = $cfg;
		}
		return $list1;
	}
	/**
	 * 1 => Version1 < Version2, 2 => Version2 < Version1, 0 => gleich
	 * @param $version1 versionsnummer mit "."
	 * @param $version2 versionsnummer mit "."
	 * @return int
	 */
	private function _compare_version($version1, $version2){
		$version1 = explode('.', $version1);
		$version2 = explode('.', $version2);
		if($version1[0] < $version2[0])
		return 1;
		else if($version1[0] > $version2[0])
		return 2;
		if($version1[1] < $version2[1])
		return 1;
		else if($version1[1] > $version2[1])
		return 2;
		if($version1[2] < $version2[2])
		return 1;
		else if($version1[2] > $version2[2])
		return 2;
		return 0;
	}
	/**
	 * Lead eine Sprachdatei (errorcodes)
	 * @param $langfile string Dateiname
	 * @return bool/array
	 */
	private function _load_lang_file($langfile){
		if(!file_exists($langfile))
		return false;
		$return = parse_ini_file($langfile);
		if(!$return)
		return false;
		return $return;
	}
	/**
	 * Laed ein Index-Paket
	 * @param $index string Paketname
	 * @return bool
	 */
	public function open_index($index){
		if(!isset($this->_installed[$index]['type']) || !$this->_installed[$index]['type'] == 'index'){
			$this->show_error('404', 404);
			return false;
		}
		if($this->_load_pack($index, $this->_installed))
		return true;
		$this->show_error('404', 404);
		return false;
	}
	/**
	 * Gibt einen Fehlercode aus und setzt ggf den HTTP Status
	 * @param $errorcode string Fehlercode
	 * @param $http int HTTP Status (e.g. 200)
	 * @return void
	 */
	public function show_error($errorcode, $http = 200){
		header('HTTP/ '.$http);
		$errorcode = $this->_parse_lang_const($errorcode);
		include(ROOTPATH.'pm/include/tpl/error.tpl.php');
		exit();
	}
	private function _parse_lang_const($errorcode){
		if(!isset($this->_errcodes[$errorcode]))
		$errorcode = "n/a";
		else
		$errorcode = $this->_errcodes[$errorcode];
		return $errorcode;
	}
	public function install_pack($packname, $packfile = '', $remote = false, $force = false){
		//Paket entpacken und pruefen
		if($packfile){
			require_once(ROOTPATH.'pm/include/pclzip.lib.php');
			if(!file_exists($packfile)){
				$this->_debugcodes .= "\n<p>" . $this->_parse_lang_const('PACK_NOT_EXISTS') . $packname . '</p>';
				return false;
			}
			$zip = new PclZip($packfile);
			if ($zip->extract(PCLZIP_OPT_PATH, ROOTPATH.'pm/tmp') == 0) {
				$this->_debugcodes("\n<p>" . $this->_parse_lang_const('EXTRACT_ERROR') .$zip->errorInfo(true) . '</p>');
			}
		}
		if(!is_dir(ROOTPATH.'pm/tmp/' . $packname)){
			$this->_debugcodes .= "\n<p>" . $this->_parse_lang_const('UNPACK_NOT_FOUND') . '</p>';
			return false;
		}
		$packdir = ROOTPATH.'pm/tmp/' . $packname . '/';
		$srcdir = $packdir . 'src/';
		if(!file_exists($packdir . 'pack.ini.php') || !($install_ini = parse_ini_file($packdir . 'pack.ini.php', true))){
			$this->_debugcodes .= "\n<p>" . $this->_parse_lang_const('CORRUPT_SETUP_FILE') . '</p>';
			return false;
		}
		if(!is_dir($srcdir) || !file_exists($srcdir . '_init.php')){
			$this->_debugcodes .= "\n<p>" . $this->_parse_lang_const('CORRUPT_PACK') . '</p>';
			return false;
		}
		if(!isset($install_ini[$packname])){
			$this->_debugcodes .= "\n<p>" . $this->_parse_lang_const('CORRUPT_PACK') . '</p>';
			return false;
		}
		//Paket sollte OK sein.
		$this->_debugcodes .= "\n<p>" . $this->_parse_lang_const('INSTALL') . $packname . '</p>';
		$directini = $install_ini[$packname];
		//Abhaengigkeiten laden...
		if(isset($directini['depend_install'])){
			foreach($directini['depend_install'] as $depend){
				if($this->_is_loaded($depend)){
					continue;
				}else if($this->_is_installed($depend)){
					$this->_load_pack($depend, $this->_installed);
					continue;
				}
				$this->_debugcodes .= "\n<p>" . $this->_parse_lang_const('INSTALL_DEP') . $depend . '</p>';
				$this->_debugcodes .= '<blockquote>';
				if(!$this->install_pack($depend, false, false))
				{
					$this->_debugcodes .= '</blockquote>';
					$this->_debugcodes .= "\n<p>" . $this->_parse_lang_const('DEPEND_LOAD_ERROR') . '</p>';
					if(!$force)
					return false;
				}
				$this->_load_pack($depend, $this->_installed);
				$this->_debugcodes .= '</blockquote>';
			}
		}
		if(isset($directini['depend_runtime'])){
			foreach($directini['depend_runtime'] as $depend){
				if(!$this->_is_installed($depend))
				continue;
				$this->_debugcodes .= "\n<p>" . $this->_parse_lang_const('INSTALL_DEP') . $depend . '</p>';
				$this->_debugcodes .= '<blockquote>';
				if(!$this->install_pack($depend, false, false))
				{
					$this->_debugcodes .= '</blockquote>';
					$this->_debugcodes .= "\n<p>" . $this->_parse_lang_const('DEPEND_LOAD_ERROR') . '</p>';
					if(!$force)
					return false;
				}
				$this->_debugcodes .= '</blockquote>';
			}
		}
		//Ueberpruefen ob Paket installiert ist
		if($this->_is_installed($packname) && is_dir(ROOTPATH.'pack/' . $packname)){
			$this->_debugcodes .= "\n<p>" . $this->_parse_lang_const('ALREADY_INSTALLED') . '</p>';
			//Versionsnummern vergleichen
			$compared = $this->_compare_version($directini['version'], $this->_installed[$packname]['version']);
			if($compared == 2 || $compared == 0){
				//Neuer oder gleich
				//Vergleichen per funktion damit auch fuer UI nutzbar
				if($install_ini['SETUP']){
					if(!$this->check_intregrit($packname, $install_ini['SETUP'])){
						$this->_debugcodes .= "\n<p>" . $this->_parse_lang_const('INSTALLED_FILES_CHANGED') . '</p>';
						if(!$force)
						return false;
					}
				}
			} else {
				//Aelter
				$this->_debugcodes .= "\n<p>" . $this->_parse_lang_const('ALREADY_INSTALLED_NEWER') . '</p>';
				if(!$force)
				return false;
			}
		} else if(is_dir(ROOTPATH.'pack/' . $packname)){
			$this->_debugcodes .= "\n<p><a href=\"?p=clean_pm\">" . $this->_parse_lang_const('ALREADY_EXISTING') . '</a></p>';
			if(!$force)
			return false;
		} else if($this->_is_installed($packname)){
			$this->_debugcodes .= "\n<p><a href=\"?p=clean_pm\">" . $this->_parse_lang_const('ALREADY_INSTALLED_NO_FILES') . '</a></p>';
			if(!$force)
			return false;
		}
		if(!$this->_copy_req($srcdir, ROOTPATH.'pack/' . $packname)){
			$this->_debugcodes .= "\n<p>" . $this->_parse_lang_const('COPY_FAILED') . '</p>';
			return false;
		}
		$this->_debugcodes .= "\n<p>" . $this->_parse_lang_const('COPY_COMPLETED') . '</p>';
		if(!$this->_add_pack($packname, $directini)){
			$this->_debugcodes .= "\n<p>" . $this->_parse_lang_const('INI_ERROR') . '</p>';
			return false;
		}
		//In die INI eintragen
		if(!$this->_write_ini_file($this->_installed, ROOTPATH . 'pm/config/installed.ini.php', true)){
			$this->_debugcodes .= "\n<p>" . $this->_parse_lang_const('INI_ERROR') . '</p>';
			return false;
		}
		$this->_debugcodes .= "\n<p>" . $this->_parse_lang_const('INSTALL_COMPLETE') . '</p>';
		return true;
	}
	private function _write_ini_file($assoc_arr, $path, $has_sections=FALSE) {
        $content = "";

        if ($has_sections) {
            foreach ($assoc_arr as $key=>$elem) {
                $content .= "[".$key."]\n";
                foreach ($elem as $key2=>$elem2)
                {
                    if(is_array($elem2))
                    {
                        for($i=0;$i<count($elem2);$i++)
                        {
                            $content .= $key2."[] = \"".$elem2[$i]."\"\n";
                        }
                    }
                    else if($elem2=="") $content .= $key2." = \n";
                    else $content .= $key2." = \"".$elem2."\"\n";
                }
            }
        }
        else {
            foreach ($assoc_arr as $key=>$elem) {
                if(is_array($elem))
                {
                    for($i=0;$i<count($elem);$i++)
                    {
                        $content .= $key2."[] = \"".$elem[$i]."\"\n";
                    }
                }
                else if($elem=="") $content .= $key2." = \n";
                else $content .= $key2." = \"".$elem."\"\n";
            }
        }

        if (!$handle = fopen($path, 'w')) {
            return false;
        }
        if (!fwrite($handle, $content)) {
            return false;
        }
        fclose($handle);
        return true;
    }
    private function _add_pack($packname, $settings){
    	if(!isset($settings) || !is_array($settings))
    		return false;
    	$packname = strtolower($packname);
    	if(!preg_match('![a-z_0-9]!', $packname))
    		return false;
    	else if(!$this->_is_installed($packname)){
    		$this->_installed[$packname] = $settings;
    	}else if($this->_is_installed($packname)){
    		//Mehr beim Update?!
    		$this->_installed[$packname] = $settings;
    	} else
    		return false;
    	return true;
    }
	public function get_debug_code(){
		return $this->_debugcodes;
	}
	public function remove_pack(){

	}
	public function add_repo(){

	}
	public function remove_repo(){

	}
	public function refresh_repo(){

	}
	public function check_update(){

	}
	public function install_repo(){

	}
	public function search(){

	}
	public function active_pack(){

	}
	public function deactive_pack(){

	}
	private function _is_installed($packname){
		if(isset($this->_installed[$packname]))
		return true;
		return false;
	}
	private function _copy_req($src, $dest, $silence = false){
		//Komplettes verzeichniss rekursiv kopieren
		if(!$silence){
			$this->_debugcodes .= "\n<p>" . $this->_parse_lang_const('SOURCE') ." " . $src . "</p>";
			$this->_debugcodes .= "\n<p>" . $this->_parse_lang_const('DESTINATION') . " " . $dest . "</p>";
		}
		//Endenden Slash entfernen
		$src = preg_replace('!\/$!', '', $src);
		$dest = preg_replace('!\/$!', '', $dest);
		//Ordner erzeugen falls nicht existent
		if(!is_dir(dirname($dest)) && file_exists(dirname($dest)))
			return false; //Das ist kein Ordner...
		if(is_dir($src) && !is_dir($dest)){
			if(file_exists($dest))
				return false; //Ist eine Datei und kein Ordner...
			if(!@mkdir($dest))
				return false;
		}
		if(is_dir($src)){
			//Es handelt sich um ein Verzeichniss... kopieren :)
			if(!$dir = opendir($src))
				return false;
			$this->_debugcodes .= '<blockquote>';
			while($item = readdir($dir)){
				if($item == '.' || $item == '..')
					continue;
				if(!$this->_copy_req($src . '/' . $item, $dest . '/' . $item))
					return false;
			}
			$this->_debugcodes .= '</blockquote>';
			closedir($dir);
		} else if(file_exists($src)) {
			if(!@copy($src, $dest))
				return false;
		} else
			return false;
		return true;
	}
	public function check_intregrit($packname, $cfg){
		if(!$this->_is_installed($packname))
			return true;
		if(!is_array($cfg))
			return false;
		if(isset($cfg['md5']) && is_array($cfg['md5'])){
			foreach($cfg['md5'] as $hash){
				$hash = explode(";", $hash);
				if($this->_compare_version($hash[0], $this->_installed[$packname]['version']) != 0)
					continue;
				if(!file_exists(ROOTPATH . 'pack/' . $packname . '/' . $hash[1]))
					continue;
				if(md5(file_get_contents(ROOTPATH . 'pack/' . $packname . '/' . $hash[1])) != $hash[2])
					return false;
			}
		}
		return true;
	}
}