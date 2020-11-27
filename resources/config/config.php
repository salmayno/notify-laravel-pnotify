<?php

return array(
    'scripts' => array(
        'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.js',
    ),
    'styles' => array(
        'https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.css',
        'https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.brighttheme.css',
    ),
    'options' => array(
        'type'             => 'notice',
        'title'            => false,
        'titleTrusted'     => false,
        'text'             => false,
        'textTrusted'      => false,
        'styling'          => 'brighttheme',
        'icons'            => 'brighttheme',
        'mode'             => 'no-preference',
        'addClass'         => '',
        'addModalClass'    => '',
        'addModelessClass' => '',
        'autoOpen'         => true,
        'width'            => '360px',
        'minHeight'        => '16px',
        'maxTextHeight'    => '200px',
        'icon'             => true,
        'animation'        => 'fade',
        'animateSpeed'     => 'normal',
        'shadow'           => true,
        'hide'             => true,
        'delay'            => 5000,
        'mouseReset'       => true,
        'closer'           => true,
        'closerHover'      => true,
        'sticker'          => true,
        'stickerHover'     => true,
        'labels'           => array(
            'close'   => 'Close',
            'stick'   => 'Pin',
            'unstick' => 'Unpin'
        ),
        'remove'           => true,
        'destroy'          => true,
    ),
);
