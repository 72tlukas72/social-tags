<?php

namespace SunlightExtend\SocialTags;

use Sunlight\Plugin\Action\ConfigAction as BaseConfigAction;

class ConfigAction extends BaseConfigAction
{
    public function getConfigLabel(string $key): string
    {
        return _lang('social-tags.config.' . $key);
    }
}
