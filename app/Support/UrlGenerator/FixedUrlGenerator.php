<?php

namespace App\Support\UrlGenerator;

use Spatie\MediaLibrary\Support\UrlGenerator\DefaultUrlGenerator;

class FixedUrlGenerator extends DefaultUrlGenerator
{
    public function getUrl(): string
    {
        $url = $this->getDisk()->url($this->getPathRelativeToRoot());

        return str_replace('storage/', 'public/storage/', $url);
    }
}
