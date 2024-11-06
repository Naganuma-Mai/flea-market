<?php

namespace App\Contracts;

interface CreatesNewAdmins
{
    /**
     * Validate and create a newly registered admin.
     *
     * @param  array  $input
     * @return \App\Models\Admin
     */
    public function create(array $input);
}
