<?php declare(strict_types=1);

namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'git@github.com:supermind-co/ids-backend.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('ids1')
    ->set('remote_user', 'deployer')
    ->set('deploy_path', '~/ids-l9');

// Hooks

after('deploy:failed', 'deploy:unlock');
