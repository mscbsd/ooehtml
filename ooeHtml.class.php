<?php
/**
* Classe que retorna html a partir de um template
* @author Marcelo Soares da Costa
* @email mscbsd at gmail dot com
* @copyright Marcelo Soares da Costa 2015.
* @license FreeBSD http://www.freebsd.org/copyright/freebsd-license.html
* @version 1.0
* @access public
* @package OOE
* @data 2015-03-01
*/

// ###############################################################################
class ooeHtml {
	private $blocKeys = array ();
	private $blockValues = array ();
	private $data = array ();
	private $result = null;
	private $content = null;
	private $etc = null;
	
	/**
	 * Set file template and get content
	 * 
	 * @param string $fileTemplate        	
	 */
	final public function setHtmlContent($fileTemplate) {
		$this->content = file_get_contents ( $fileTemplate );
	}
	
	/**
	 * Replace multiple new lines with a single newline
	 * 
	 * @return mixed
	 */
	private function getHtmlContent() {
		return preg_replace ( array (
				'/\s+$/Sm',
				'/\n+/S' 
		), "\n", $this->content );
	}
	
	/**
	 * Set var name values
	 * 
	 * @param string $name        	
	 * @param string $value        	
	 */
	final public function setHtmlVar($name, $value) {
		$this->etc ['{{' . $name . '}}'] = $value;
	}
	
	/**
	 * Get html values
	 * 
	 * @return string
	 */
	private function getHtmlValues() {
		return $this->etc;
	}
	
	/**
	 * Get replaced html values
	 * 
	 * @param string $name        	
	 * @throws Exception
	 * @return multitype:
	 */
	function getHtmlVar($name) {
		if (array_key_exists ( $name, $this->data )) {
			return $this->data ['{{' . $name . '}}'];
		} elseif (method_exists ( $this, $name )) {
			return $this->$name ();
		} else {
			throw new Exception ( "Property $name does not exist" );
		}
	}
	
	/**
	 * Set blocks name
	 * 
	 * @param string $block        	
	 */
	public function setHtmlBlock($block) {
		$this->BLOCKS [] = strtoupper ( $block );
	}
	
	/**
	 * Get blocks
	 * 
	 * @return string
	 */
	private function getHtmlBlocks() {
		return $this->BLOCKS;
	}
	
	/**
	 * Replace blocks values
	 * 
	 * @param string $block        	
	 * @param string $name        	
	 * @param string $value        	
	 */
	public function setHtmlBlockVar($block, $name, $value) {
		$this->blocKeys [strtoupper ( $block )] [] = '{{' . $name . '}}';
		$this->blockValues [strtoupper ( $block )] [] = $value;
	}
	
	/**
	 * Identify blcoks
	 * 
	 * @param string $BLOCK        	
	 * @param array $arrayData        	
	 */
	private function parseHtmlContent($BLOCK, $arrayData) {
		$reg = "/<!--\s*#START\sBLOCK\s:\s+$BLOCK\s+-->\s*(\s*.*?\s*)<!--\s+#END\sBLOCK\s:\s+$BLOCK\s*-->\s*/sm";
		$code = preg_replace ( "#(.*)<!--\s\#START BLOCK\s:\s" . $BLOCK . "\s-->(.*?)<!--\s\#END BLOCK\s:\s" . $BLOCK . "\s-->(.*)#is", '$2', $this->content );
		foreach ( $arrayData as $key => $line ) {
			$this->result .= preg_replace ( array_keys ( $line ), array_values ( $line ), $code );
		}
		$this->content = preg_replace ( $reg, $this->result, self::getHtmlContent () );
		unset ( $arrayData );
		$this->result = null;
	}
	
	/**
	 * Replace blocks values
	 * 
	 * @return mixed
	 */
	public function parseHtmlBlocks() {
		foreach ( self::getHtmlBlocks () as $BLOCK ) {
			$keys = array_unique ( array_values ( $this->blocKeys [$BLOCK] ) );
			$values = array_values ( $this->blockValues [$BLOCK] );
			$combinearray = self::array_combine_multidimensional ( $keys, $values );
			
			unset ( $this->blockValues [$BLOCK] );
			unset ( $this->blocKeys [$BLOCK] );
			
			self::parseHtmlContent ( $BLOCK, $combinearray );
			
			unset ( $combinearray );
		}
		return self::getHtmlContent ();
	}
	
	/**
	 * Print buffer objects
	 */
	public function printHtmlScreen() {
		$print = preg_replace ( array_keys ( self::getHtmlValues () ), array_values ( self::getHtmlValues () ), self::parseHtmlBlocks () );
		ob_start ();
		echo $print;
		ob_end_flush ();
	}
	
	/**
	 * from php manual array_combine at bradentkeith at dot dontspam dot gmail dot com
	 * 
	 * @param array $arr1        	
	 * @param array $arr2        	
	 * @return multitype:
	 */
	private function array_combine_multidimensional($arr1, $arr2) {
		$count1 = count ( $arr1 );
		$count2 = count ( $arr2 );
		$numofloops = $count2 / $count1;
		
		$i = 0;
		while ( $i < $numofloops ) {
			$arr3 = array_slice ( $arr2, $count1 * $i, $count1 );
			$arr4 [] = array_combine ( $arr1, $arr3 );
			$i ++;
		}
		
		return $arr4;
	}
	
	/**
	 * from php preg_replace manual ( hvishnu999 at gmail dot com)
	 * 
	 * @param string $str        	
	 * @return string
	 */
	private function seoHtmlFriend($str) {
		$seoname = preg_replace ( '/\%/', ' percentage', $str );
		$seoname = preg_replace ( '/\@/', ' at ', $seoname );
		$seoname = preg_replace ( '/\&/', ' and ', $seoname );
		$seoname = preg_replace ( '/\s[\s]+/', '-', $seoname ); // Strip off multiple spaces
		$seoname = preg_replace ( '/[\s\W]+/', '-', $seoname ); // Strip off spaces and non-alpha-numeric
		$seoname = preg_replace ( '/^[\-]+/', '', $seoname ); // Strip off the starting hyphens
		$seoname = preg_replace ( '/[\-]+$/', '', $seoname ); // // Strip off the ending hyphens
		$seoname = strtolower ( $seoname );
		
		return $seoname;
	}
	
	/**
	 * from php preg_replace manual (anyvie at devlibre dot fr )
	 * $head can have the desired content, or be empty, depends on the length of $data.
	 * For this application, just add :
	 * $data = substr($data, 0, 4096);
	 * before using preg_replace, and it will work fine.
	 * 
	 * @param string $url        	
	 * @return mixed
	 */
	public function htmlHead($url) {
		// We get all the data into $data
		$data = file_get_contents ( $url );
		// We just want to keep the content of <head>
		$head = preg_replace ( "#(.*)<head>(.*?)</head>(.*)#is", '$2', $data );
		return $head;
	}
	
	/**
	 * from php preg_replace manual (erik dot stetina at gmail dot com)
	 *
	 * @param string $string        	
	 * @return mixed
	 */
	private function removeHtmlComments(&$string) {
		$string = preg_replace ( "%(#|;|(//)).*%", "", $string );
		$string = preg_replace ( "%/\*(?:(?!\*/).)*\*/%s", "", $string ); // google for negative lookahead
		return $string;
	}
	
	/**
	 *
	 * @param mixed $a        	
	 * @return multitype:
	 */
	private function array_flatten($a) { // flattens multi-dim arrays (distroys keys)
		$ab = array ();
		if (! is_array ( $a ))
			return $ab;
		foreach ( $a as $value ) {
			if (is_array ( $value )) {
				$ab = array_merge ( $ab, array_flatten ( $value ) );
			} else {
				array_push ( $ab, $value );
			}
		}
		return $ab;
	}
	
	// end
}
?>
