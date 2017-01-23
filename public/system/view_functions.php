<?php
if (!defined('BASE_FILEPATH')) {
    exit('No direct script access allowed');
}

use VanDragt\Carbon;

global $Security;


/**
 * Shorthand function to link to internal url
 *
 * @param  string $url internal url
 *
 * @return string      index independent internal url
 */
function href($url)
{
    $l = new Carbon\Url();

    return $l->index($url)->url;
}

/**
 * List pages in templated format
 *
 * @return string html of list of pages
 */
function pages()
{
    Carbon\Log::debug(__FUNCTION__ . " called.");

    $output = '';
    $pages_path = sprintf("/%s/%s", \Configuration::CONTENT_FOLDER, 'pages');

    $files = new Carbon\Files(array('url' => $pages_path), \Configuration::CONTENT_EXT);
    foreach ($files->getCollection() as $path) {
        $filename = pathinfo($path, PATHINFO_FILENAME);
        $title = ucwords(str_replace("-", " ", $filename));
        $output .= sprintf("<li><a href='%s'>%s</a></li>", href("/pages/$filename"), $title);
    }

    return $output;
}

/**
 * Returns theme directory
 *
 * @return string link to theme directory
 */
function theme_dir()
{
    $path_to_script = ''; // todo
    $theme_dir_url = BASE_PATH . str_replace("\\", "/", THEME_DIR);

    return $path_to_script . $theme_dir_url;
}

/**
 * Is the user logged in
 *
 * @return boolean logged in status
 */
function is_loggedin()
{
    return $Security->is_loggedin();
}
