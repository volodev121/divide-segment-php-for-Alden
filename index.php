<?php

function assemble_segments($fragments)
{
    $segments = array();
    $segment = '';
    foreach ($fragments as $fragment) {
        $size = strlen($fragment);
        if ($size < 8) {
            continue;
        }
        if ($size >= 256) {
            $chunks = str_split($fragment, 128);
            foreach ($chunks as $chunk) {
                if (strlen($segment) + strlen($chunk) >= 256) {
                    $segments[] = $segment;
                    $segment = $chunk;
                } else {
                    $segment .= $chunk;
                }
            }
        } else {
            if (strlen($segment) + $size >= 256) {
                $segments[] = $segment;
                $segment = $fragment;
            } else {
                $segment .= $fragment;
            }
        }
    }
    if (strlen($segment) > 0) {
        $segments[] = $segment;
    }
    return $segments;
}

$fragments = array('Lorem ipsum',
    'dolor sit amet,',
    'consectetur adipiscing elit.',
    'asd asasd asdas da',
    'as asd',
    'Proin pharetra massa',
    'at semper ullamcorp',
    'when an unknown printer took a galley of type and scrambled it to make a type specimen book',
    'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
    'The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose injected humour and the like. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose injected humour and the like.',
);
$segments = assemble_segments($fragments);
print_r($segments);

foreach ($segments as $segment) {
    print_r(strlen($segment) . '\n');
}
