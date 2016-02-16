<?php
/**
 * config.php
 *
 * Author: pixelcave
 *
 * Configuration php file. It containts variables used in the template and the main menu auto creation function
 *
 */

// Template variables
$template = array(
    'name'          => 'Hedspi',
    'version'       => '1.0',
    'author'        => 'BQHL',
    'title'         => 'Easy Management',
    'description'   => 'It is free',
    // 'fixed-top'         for a top fixed header
    // 'fixed-bottom'      for a bottom fixed header
    // ''                  empty for a static header
    'header'        => '',
    // 'sticky'            for a sticky sidebar
    'sidebar'       => '',
    // 'hide-side-content' for hiding sidebar by default
    'side_content'  => '',
    // 'full-width'        for full width page
    // ''                  empty to remove full width from the page in large resolutions
    'page'          => 'full-width',
    // Available themes: 'fire', 'wood', 'ocean', 'leaf', 'tulip', 'amethyst',
    //                   'dawn', 'city', 'oil', 'deepsea', 'stone', 'grass',
    //                   'army', 'autumn', 'night', 'diamond', 'cherry', 'sun'
    //                   'asphalt'
    'theme'         => '',
    'active_page'   => basename($_SERVER['PHP_SELF'])
);

// Primary navigation array (the primary navigation will be created automatically based on this array, up to 3 level deep)
$primary_nav = array(
    array(
        'name'  => 'Bảng điều khiển',
        'url'   => 'index.php',
        'icon'  => 'glyphicon-display'
    ),
    array(
        'name'  => 'Thông tin',
        'icon'  => 'glyphicon-book',
        'sub'   => array(
            array(
                'name'  => 'Phòng ban',
                'url'   => 'index.php?action=show_department'
            ),
            array(
                'name'  => 'Dự án',
                'url'   => 'index.php?action=show_project'
            ),
            array(
                'name'  => 'Lương',
                'url'   => 'index.php?action=show_salary'
            )
        )
    ),
    array(
        'name'  => 'Quản trị',
        'icon'  => 'glyphicon-cogwheel',
        'sub'   => array(
            array(
                'name'  => 'Danh sách nhân viên',
                'url'   => 'index.php?action=show_employee'
            ),
            array(
                'name'  => 'Chấm công',
                'url'   => 'index.php?action=show_chamcong'
            )
        )
    )

);