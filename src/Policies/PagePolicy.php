<?php

namespace EscolaLms\Pages\Policies;

use EscolaLms\Core\Models\User;
use EscolaLms\Pages\Enums\PagesPermissionsEnum;
use EscolaLms\Pages\Models\Page;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->can(PagesPermissionsEnum::PAGE_CREATE);
    }

    /**
     * @param User $user
     * @param Page $page
     * @return bool
     */
    public function delete(User $user, Page $page)
    {
        return $user->can(PagesPermissionsEnum::PAGE_DELETE);
    }

    /**
     * @param User $user
     * @param Page $page
     * @return bool
     */
    public function update(User $user, Page $page)
    {
        return $user->can(PagesPermissionsEnum::PAGE_UPDATE);
    }
}
