<?php

/****************************************************
 * helper.php
 *
 * CSCI S-75
 * Project 1
 * Chris Gerber
 *
 * Renders a view template with specified parameters
 ****************************************************/

/*
 * render() - Renders the template
 *
 * @param string $template - The name of the template to render.
 * @param array $data - An array of variables and values to pass to the template.
 */
function render($template, $data = array())
{
    $path = __DIR__ . '/../view/' . $template . '.php';
	if (file_exists($path))
    {
        extract($data);
        require($path);
    }
}

?>
