<?php
// app directory
define("DIR_APP", str_replace('/config', '', dirname(__FILE__)));
// controllers directory
define("DIR_CONTROLLERS", DIR_APP.'/controllers/modules/');
// controllers config
define("DIR_CONFIG", DIR_APP.'/config/');
// models directory
define("DIR_MODELS", DIR_APP.'/models/');
// migrations directory
define("DIR_MIGRATIONS", DIR_APP.'/migrations/');
// views directory
define("DIR_VIEWS", DIR_APP.'/views/modules/');
// plugins directory
define("DIR_PLUGINS", DIR_APP.'/plugins/');
// libraries directory
define("DIR_LIBRARY", DIR_APP.'/libraries/');
// cache directory
define("DIR_CACHE", DIR_APP.'/cache/');