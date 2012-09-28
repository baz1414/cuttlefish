<?php

class Model {

	static function load_data($filename) {
		if (is_null($filename)) return null;
		if (!file_exists ($filename )) {
			Log::info("'$filename' cannot be found.");
			header('Location: ' . Theming::root() . '/error/404');
		} else {
			$contents =  file_get_contents ( $filename);
			if ($contents) {
				if (Ext::class_loaded( 'MarkdownExtra_Parser')){
					$c = new MarkdownExtra_Parser;
					$contents =  $c->transform($contents);
				}
				return $contents;
			}
		}
	}
}