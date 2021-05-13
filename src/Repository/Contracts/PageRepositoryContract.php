<?php

namespace EscolaLms\Pages\Repository\Contracts;

interface PageRepositoryContract {
    public function all();
    public function getBySlug(string $slug);
}
