<?php

namespace LaraIO\Core\Support\Core;

use LaraIO\Core\Traits\WithHookListener;

class ActionHook
{
    use WithHookListener;
    /**
     * Filters a value
     *
     * @param  string  $action Name of action
     * @param  array  $args Arguments passed to the filter
     */
    public function fire(string $action, array $args)
    {
        if (! $this->getListeners()) {
            return;
        }

        foreach ($this->getListeners() as $hook => $listeners) {
            krsort($listeners);
            foreach ($listeners as $arguments) {
                if ($hook !== $action) {
                    continue;
                }

                $parameters = [];
                for ($index = 0; $index < $arguments['arguments']; $index++) {
                    if (isset($args[$index])) {
                        $parameters[] = $args[$index];
                    }
                }
                call_user_func_array($this->getFunction($arguments['callback']), $parameters);
            }
        }
    }
}
