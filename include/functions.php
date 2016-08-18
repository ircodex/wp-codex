<?php

function syntax_highlight($code){
 
    // this matches --> "foobar" <--
    $code = preg_replace(
        '/"(.*?)"/U', 
        '&quot;<span style="color: #007F00">$1</span>&quot;', $code
    );
 
    // hightlight functions and other structures like --> function foobar() <--- 
    $code = preg_replace(
        '/(\s)\b(.*?)((\b|\s)\()/U', 
        '$1<span style="color: #24831d">$2</span>$3', 
        $code
    );
 
    // Match comments (like /* */): 
    $code = preg_replace(
        '/(\/\/)(.+)\s/', 
        '<span style="color: #660066; background-color: #FFFCB1;"><i>$0</i></span>', 
        $code
    );
 
    $code = preg_replace(
        '/(\/\*.*?\*\/)/s', 
        '<span style="color: #660066; background-color: #FFFCB1;"><i>$0</i></span>', 
        $code
    );
 
    // hightlight braces:
    $code = preg_replace('/(\(|\[|\{|\}|\]|\)|\->)/', '<strong>$1</strong>', $code);
 
    // hightlight variables $foobar
    $code = preg_replace(
        '/(\$[a-zA-Z0-9_]+)/', '<span style="color: #0f55c8">$1</span>', $code
    );
 
    /* The \b in the pattern indicates a word boundary, so only the distinct
    ** word "web" is matched, and not a word partial like "webbing" or "cobweb" 
    */
 
    // special words and functions
    $code = preg_replace(
        '/\b(print|echo|new|function)\b/', 
        '<span style="color: #7F007F">$1</span>', $code
    );
    
    // special variable type words and functions
    $code = preg_replace(
        '/\b(array|string|bool|int)\b/', 
        '<span style="color: #cd2f23; font-style: italic">$1</span>', $code
    );
    
    $code = preg_replace(
            '/(\\=\\s[a-zA-Z0-9_]+)/', 
            '= <span style="color: 000000;">$1</span>', $code
    );
 
    return $code;
}

function searchPagination($search){
    echo ($search == '') ? '' : '&s=' . $search;
}

function typePagination($type){
    echo ($type == '') ? '' : '&type=' . $type;
}

function filePagination($file){
    echo ($file == '') ? '' : '&file=' . $file;
}

function _t($text){
    
}

if (!function_exists('base_url')) {
    function base_url($atRoot=FALSE, $atCore=FALSE, $parse=FALSE){
        if (isset($_SERVER['HTTP_HOST'])) {
            $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
            $hostname = $_SERVER['HTTP_HOST'];
            $dir =  str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

            $core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), NULL, PREG_SPLIT_NO_EMPTY);
            $core = $core[0];

            $tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
            $end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
            $base_url = sprintf( $tmplt, $http, $hostname, $end );
        }
        else $base_url = 'http://localhost/';

        if ($parse) {
            $base_url = parse_url($base_url);
            if (isset($base_url['path'])) if ($base_url['path'] == '/') $base_url['path'] = '';
        }

        return $base_url;
    }
}

