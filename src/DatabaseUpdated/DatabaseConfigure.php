<?php

namespace watel\DatabaseUpdated;

/**
 * Namespaced exception.
 */
class DatabaseConfigure extends DatabaseUpdated implements \Anax\Common\ConfigureInterface
{
    use \Anax\Common\ConfigureTrait;



    /**
     * Set options by using configuration.
     *
     * @return void
     */
    public function setDefaultsFromConfiguration()
    {
        parent::setOptions($this->config);
    }
}
