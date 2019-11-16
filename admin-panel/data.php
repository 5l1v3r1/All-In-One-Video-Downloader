<?php

session_start();

 $variables = [
    'expose_php' => [
        'recommended' => 'Off',
        'info' => 'Prevents the webserver from sending back the X-Powered-By header.',
        'check' => true
    ],
    'register_globals' => [
        'recommended' => 'Off',
        'info' => 'This feature has been DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0.',
        'check' => true
    ],
    'safe_mode' => [
        'recommended' => 'Off',
        'info' => 'The PHP safe mode is an attempt to solve the shared-server security problem.',
        'check' => true
    ],
    'display_errors' => [
        'recommended' => 'Off',
        'info' => 'Preventing displaying errors, warning and notices.',
        'check' => true
    ],
    'display_startup_errors' => [
        'recommended' => 'Off',
        'info' => 'Preventing displaying errors, warning and notices.',
        'check' => true
    ],
    'log_errors' => [
        'recommended' => 'On',
        'info' => 'Logging errors into the prescribed files.',
        'check' => true
    ],
    'error_reporting' => [
        'recommended' => 'E_ALL',
        'info' => 'Log and display all the errors, warning and notices.',
        'check' => true
    ],
    'error_log' => [
        'recommended' => '/var/log/httpd/php_scripts_error.log',
        'info' => 'Path where the log file will be stored.'
    ],
    'allow_url_fopen' => [
        'recommended' => 'Off',
        'info' => 'fopen() function can only use same servers file.',
        'check' => true
    ],
    'allow_url_include' => [
        'recommended' => 'Off',
        'info' => 'include() function can only use same servers file.',
        'check' => true
    ],
    'max_execution_time' => [
        'recommended' => '30',
        'info' => 'Maximum time for a script to parse the input data.<br> Or based on your need <br> If your current value is 0, the condition is critical.',
        'check' => true
    ],
    'max_input_time' => [
        'recommended' => '60',
        'info' => 'Maximum time for a script to parse the input data.',
        'check' => true
    ],
    'memory_limit' => [
        'recommended' => '16M',
        'info' => "Maximum amount of RAM that a script can utilised from the server.",
        'check' => true
    ],
    'upload_max_filesize' => [
        'recommended' => '2M',
        'info' => "Maximum size allowed for an uploading file.",
        'check' => true
    ],
    'max_input_nesting_levels' => [
        'recommended' => '64',
        'info' => " Maximum Nesting level of \$_GET and \$_POST parameters. Ex: foo[bar][one]",
        'check' => true
    ],
    'fastcgi.logging' => [
        'recommended' => '0',
        'info' => 'Internet Information Services (IIS) FastCGI module will fail the request when PHP sends any data on stderr by using FastCGI protocol. Disabling FastCGI logging will prevent PHP from sending error information over stderr, and generating 500 response codes for the client.',
        'check' => true
    ],
    'disable_functions' => [
        'recommended' => 'exec,passthru,shell_exec,system,proc_open,popen,curl_exec,curl_multi_exec,parse_ini_file,show_source',
        'info'=> 'PHP functions which present in your installation but you want to disable them to be used in your scripts',
        'check' => true
    ],
    'post_max_size' => [
        'recommended' => '8M',
        'info' => 'Sets max size of post data allowed. This setting also affects file upload. To upload large files, this value must be larger than upload_max_filesize.',
        'check' => true
    ],
    'open_basedir' => [
        'recommended' => '',
        'info' => 'The open_basedir directive set the directories from which PHP is allowed to access files using functions like fopen(), and others. If a file is outside of the paths defined by open_basdir, PHP will refuse to open it.',
        'check' => true
    ],
    'session.save_path' => [
        'recommended' => '/var/lib/php/session',
        'info' => 'This enables you to build more customized applications and increase the appeal of your web site. This path is defined in /etc/php.ini file and all data related to a particular session will be stored in a file in the directory specified by the session.save_path option.',
        'check' => false
    ],
    'session.use_cookies' => [
        'recommended' => '1',
        'info' => 'in most cases you will want to enable cookies for storing session. ; disabled changing session id through PHPSESSID parameter (e.g foo.php?PHPSESSID=<session id>)',
        'check' => true
    ],
    'session.use_only_cookies' => [
        'recommended' => '1',
        'info' => '',
        'check' => true
    ],
    'session.use_trans_sid' => [
        'recommended' => '0',
        'info' => '',
        'check' => true
    ],
    'session.cookie_httponly' => [
        'recommended' => '1',
        'info' => 'Session cookie will only be avaliable for http transactions. XSS PROTECTION.',
        'check' => true
    ],
    'session.cookie_domain' => [
        'recommended' => 'yourdomain.com',
        'info' => 'Session cookie will only be avaliable for this domain, if domain changes the new session will created. Helpful when you are messing with subdomains. XSS PROTECTION.',
        'check' => false

    ],
    'session.cookie_secure' => [
        'recommended' => '1',
        'info' => 'For HTTPS sites, this accepts only cookies sent over HTTPS. If you are still not using HTTPS, you should consider it. Make it 0, if you forcing site to work with not https',
        'check' => true
    ],
    'session.cookie_lifetime' => [
        'recommended' => '0',
        'info' => '0 implies the session cookie will retain until the browser is closed. You make set cookie validity according to your needs too.',
        'check' => true

    ],
    'session.name' => [
        'recommended' => 'Anything other the PHPSESSID',
        'info' => 'Setting can change the default session naming scheme of PHP. Hence, may protect session hijacking.',
        'check' => true
    ]
 ];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Configuration Check</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <h1 style="text-align: center;">PHP Configuration Vulnerability Test</h1>
    <hr>
    <table class="table table-hover table-bordered ">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Variable</th>
          <th scope="col">Current Value</th>
          <th style="width: 25%;" scope="col">Recommended</th>
          <th style="width: 25%;" scope="col">Information</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($variables as $key => $value): ?>
            <tr>
              <td class="bg-warning"><?php echo $key; ?></td>
              <td style="color: white;" 
                <?php 
                    if ((ini_get($key) != $value['recommended'])) {
                        if ((($value['recommended']) == "Off" ) and (ini_get($key) == 0))
                        {
                          echo 'class="bg-success"';
                        } elseif ((($value['recommended']) == "On" ) and (ini_get($key) == 1)) {
                          echo 'class="bg-success"';
                        } else {
                            if ($value['check']) {

                                if (($key == 'session.name') ) {
                                    if (ini_get($key) != "PHPSESSID") {
                                        echo 'class="bg-success"';
                                    }
                                    else
                                    {
                                         echo 'class="bg-danger"';  
                                    }
                                    
                                } else {
                                    echo 'class="bg-danger"';  
                                }
                                
                            } else {
                                if (($key == 'session.cookie_domain') ) {
                                    if (ini_get($key)) {
                                        echo 'class="bg-success"';
                                    }
                                    else
                                    {
                                         echo 'class="bg-danger"';  
                                    }
                                    
                                }else
                                {
                                     echo 'class="bg-success"';      
                                }
                                

                            }
                          
                        }
                    }
                    else {
                          echo 'class="bg-success"';
                    }
                    ?>
                    ><?php echo ini_get($key); ?></td>
              <td style="color: white;" class="bg-info"><?php echo $value['recommended']; ?></td>
              <td style="color: white;" class="bg-success"><?php echo $value['info']; ?></td>
            </tr>
        <?php endforeach ?>
       </tbody>
    </table>

    
</body>
</html>