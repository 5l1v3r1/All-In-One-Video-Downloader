<?php

function PHP_normalize_path( $path ) {
	$path = str_replace( '\\', '/', $path );
	$path = preg_replace( '|(?<=.)/+|', '/', $path );
	if ( ':' === substr( $path, 1, 1 ) ) {
		$path = ucfirst( $path );
	}
	return $path;
}

function PHP_call_all_hook($args) {
	global $wp_filter;

	$wp_filter['all']->do_all_hook( $args );
}

function apply_filters( $tag, $value ) {
	global $wp_filter, $wp_current_filter;

	$args = array();

	// Do 'all' actions first.
	if ( isset($wp_filter['all']) ) {
		$wp_current_filter[] = $tag;
		$args = func_get_args();
		PHP_call_all_hook($args);
	}

	if ( !isset($wp_filter[$tag]) ) {
		if ( isset($wp_filter['all']) )
			array_pop($wp_current_filter);
		return $value;
	}

	if ( !isset($wp_filter['all']) )
		$wp_current_filter[] = $tag;

	if ( empty($args) )
		$args = func_get_args();

	// don't pass the tag name to WP_Hook
	array_shift( $args );

	$filtered = $wp_filter[ $tag ]->apply_filters( $value, $args );

	array_pop( $wp_current_filter );

	return $filtered;
}


function _cleanup_header_comment( $str ) {
	return trim(preg_replace("/\s*(?:\*\/|\?>).*/", '', $str));
}

function PHP_get_file_data( $file, $default_headers, $context = '' ) {
	// We don't need to write to the file, so just open for reading.
	$fp = fopen( $file, 'r' );

	// Pull only the first 8kiB of the file in.
	$file_data = fread( $fp, 8192 );

	// PHP will close file handle, but we are good citizens.
	fclose( $fp );

	// Make sure we catch CR-only line endings.
	$file_data = str_replace( "\r", "\n", $file_data );

	/**
	 * Filters extra file headers by context.
	 *
	 * The dynamic portion of the hook name, `$context`, refers to
	 * the context where extra headers might be loaded.
	 *
	 * @since 2.9.0
	 *
	 * @param array $extra_context_headers Empty array by default.
	 */
	if ( $context && $extra_headers = apply_filters( "extra_{$context}_headers", array() ) ) {
		$extra_headers = array_combine( $extra_headers, $extra_headers ); // keys equal values
		$all_headers = array_merge( $extra_headers, (array) $default_headers );
	} else {
		$all_headers = $default_headers;
	}

	foreach ( $all_headers as $field => $regex ) {
		if ( preg_match( '/^[ \t\/*#@]*' . preg_quote( $regex, '/' ) . ':(.*)$/mi', $file_data, $match ) && $match[1] )
			$all_headers[ $field ] = _cleanup_header_comment( $match[1] );
		else
			$all_headers[ $field ] = '';
	}

	return $all_headers;
}

function PHP_Data_Key_Plugin($data_key){
	global $con;
	$check = mysqli_query($con,"SELECT key_plugin from platform_media WHERE key_plugin = '$data_key'");
	if (mysqli_num_rows($check) > 0) {
		$data = false; // false
	}else{
		$data = true;
	}
	return $data;
}

function PHP_Data_Version_Plugin($data_key,$data_version,$comprobar = ''){
	global $con;
	$check = mysqli_query($con,"SELECT * from platform_media WHERE key_plugin = '$data_key'");
	$sql_query = mysqli_fetch_array($check);
	if ($sql_query['version'] > $data_version) {
		// the version of this plugin is inferior to the current one
		$data = false;
	}else if($sql_query['version'] == $data_version){
		// the version of this plugin is similar v1 == v1
		$data = false;
	}else{
		// updated plugin version
		$data = true;
	}
	
	return $data;
}

function PHP_recurse_copy($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                PHP_recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
            } 
        } 
    } 
    closedir($dir); 
} 

 
?>