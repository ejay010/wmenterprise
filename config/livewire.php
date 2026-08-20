<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Temporary File Uploads
    |--------------------------------------------------------------------------
    |
    | Livewire handles file uploads by storing uploaded files in a temporary
    | directory before the form is submitted. By forcing the temporary disk
    | to 'local', Livewire handles temporary file previews locally, allowing
    | multiple file selection (`multiple` attribute) to work cleanly even when
    | the production default filesystem disk is set to S3.
    |
    */
    'temporary_file_upload' => [
        'disk' => 'local',
        'rules' => null,
        'directory' => null,
        'middleware' => null,
        'preview_mimes' => [
            'png', 'gif', 'bmp', 'svg', 'wav', 'mp4',
            'mov', 'avi', 'wmv', 'mp3', 'm4a', 'jpg',
            'jpeg', 'mpga', 'webp', 'wma',
        ],
        'max_upload_time' => 5,
        'cleanup' => true,
    ],

];
