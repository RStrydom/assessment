<?php

namespace App;

class TaskFighter
{
    public $name;

    public $priority;

    public $dueIn;

    public function __construct($name, $priority, $due_in)
    {
        $this->name = $name;
        $this->priority = $priority;
        $this->dueIn = $due_in;
    }

    public static function of($name, $priority, $dueIn) {
        return new static($name, $priority, $dueIn);
    }

    public function tick()
    {
        if ($this->name != 'Get Older') {
            if ($this->priority < 100) {
                if ($this->name != 'Spin the World') {
                    $this->priority = $this->priority + 1;
                }
            }
            if ($this->name == 'Complete Assessment') {
                if ($this->dueIn < 11) {
                    if ($this->priority < 100) {
                        $this->priority = $this->priority + 1;
                    }
                }
                if ($this->dueIn < 6) {
                    if ($this->priority < 100) {
                        $this->priority = $this->priority + 1;
                    }
                }
            }
        } else {
            if ($this->priority > 0) {
                $this->priority = $this->priority - 1;
            }
        }
        if ($this->name != 'Spin the World') {
            $this->dueIn = $this->dueIn - 1;
        }
        if ($this->dueIn < 0) {
            if ($this->name != 'Get Older') {
                if ($this->name != 'Complete Assessment') {
                    if ($this->priority < 100) {
                        if ($this->name != 'Spin the World') {
                            $this->priority = $this->priority + 1;
                        }
                    }
                } else {
                    $this->priority = $this->priority - $this->priority;
                }
            } else {
                if ($this->priority > 0) {
                    $this->priority = $this->priority - 1;
                }
            }
        }
    }
}
