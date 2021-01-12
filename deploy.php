<?php
namespace Deployer;

require 'recipe/common.php';

// Project name
set('application', 'my_project');

set('ssh_multiplexing', true);

// Project repository
//set('repository', 'ssh://alekseev:123456@www.aapsoftware.ru');
set('repository', 'git@github.com:alekseev23/sample.git');

// [Optional] Allocate tty for git clone. Default value is false.
#set('git_tty', true); 

// Shared files/dirs between deploys 
set('shared_files', ['shared_file1.php','shared_file2.php']);
set('shared_dirs', ['shared_dirs']);

// Writable dirs by web server 
set('writable_dirs', []);
set('allow_anonymous_stats', false);

// Hosts

host('test.aapsoftware.ru')
    ->user('alekseev')
    ->port(22)
    ->configFile('~/.ssh/config')
    ->identityFile('~/.ssh/id_rsa')
    ->forwardAgent(true)
    ->multiplexing(true)
    ->addSshOption('UserKnownHostsFile', '/dev/null')
    ->addSshOption('StrictHostKeyChecking', 'no')
//    ->set('/var/www/nginx/deploy', '~/{{application}}')
    ->set('deploy_path', '/var/www/nginx/deploy');
//    ->stage('prod');


// Tasks

task('test', function () {
    writeln('Hello world');
});


task('pwd', function () {
    $result = run('pwd');
    writeln("Current dir: $result");
});


task('copy', function () {
    $result = run('scp /var/www/html/test/sample3/index.php alekseev@test.aapsoftware.ru/var/www/test.aapsoftware.ru/deploy/index.php');
    writeln("Current dir: $result");
});


desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
