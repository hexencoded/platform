<?php

namespace Thor\Backend;

use URL,
    Config,
    Entrust,
    Request,
    Response,
    Lang;

class Backend
{
    const ACCESS_PERMISSION_NAME = 'access_backend';
    
    /**
     * Laravel application
     * 
     * @var \Illuminate\Foundation\Application
     */
    protected $app;
    protected $installed = null;
    protected $modules = null;

    /**
     * Creates a new Backend instance.
     * 
     * @param  \Illuminate\Foundation\Application  $app
     */
    public function __construct($app)
    {
        $this->app = $app;

        if ($this->canBeAccessed()) {
            $this->app['thor.document']->addClass('is-backend');
        }
    }

    /**
     * 
     * @return \Thor\Models\Module[]|\Illuminate\Database\Eloquent\Collection
     */
    public function modules()
    {
        if ($this->modules === null) {
            if ($this->isInstalled()) {
                $this->modules = \Thor\Models\Module::active()->sorted()->get();
            } else {
                return array();
            }
        }
        return $this->modules;
    }

    /**
     * Generate a multilingual URL to the given backend path
     *
     * @param string  $path
     * @param mixed  $extra
     * @param bool  $secure
     * @param string  $langCode If null, the current Lang::code() will be used
     * @return string
     * @static 
     */
    public function url($path = '/', $extra = array(), $secure = null, $langCode = null)
    {
        return URL::langTo($this->config('base_route') . '/' . ltrim($path, '/'), $extra, $secure, $langCode);
    }

    public function asset($path, $secure = null)
    {
        return asset('packages/thor/platform/' . ltrim($path, '/'), $secure);
    }

    public function config($key, $default = null)
    {
        return Config::get('thor::backend.' . $key, $default);
    }

    public function canBeAccessed()
    {
        return Entrust::can(self::ACCESS_PERMISSION_NAME);
    }

    public function isBackendRequest()
    {
        $base = $this->config('base_route');
        return (Request::is(Lang::code() . '/' . $base . '/*') or Request::is($base . '/*'));
    }

    public function isInstalled()
    {
        if ($this->installed === null) {
            $this->installed = (\Schema::hasTable('users') === true);
        }
        return $this->installed;
    }

    public function default404View()
    {
        return Response::view('thor::backend.error', array('page' => 'error'), 404);
    }

}
