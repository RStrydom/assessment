<?php

declare(strict_types=1);

namespace App;

// Framework
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name',
        'priority',
        'due_in',
    ];

    public function tick(): void
    {
        if ($this->name != 'Get Older') {
            if ($this->priority < 100) {
                if ($this->name != 'Spin the World') {
                    $this->priority = $this->priority + 1;
                }
            }
            if ($this->name == 'Complete Assessment') {
                if ($this->due_in < 11) {
                    if ($this->priority < 100) {
                        $this->priority = $this->priority + 1;
                    }
                }
                if ($this->due_in < 6) {
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
            $this->due_in = $this->due_in - 1;
        }
        if ($this->due_in < 0) {
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
