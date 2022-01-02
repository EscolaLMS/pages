<?php

namespace EscolaLms\Pages\Enums;

use EscolaLms\Core\Enums\BasicEnum;

class PagesPermissionsEnum extends BasicEnum
{
    const PAGE_LIST = 'pages_list';
    const PAGE_READ = 'pages_read';
    const PAGE_CREATE = 'pages_create';
    const PAGE_DELETE = 'pages_delete';
    const PAGE_UPDATE = 'pages_update';
}
