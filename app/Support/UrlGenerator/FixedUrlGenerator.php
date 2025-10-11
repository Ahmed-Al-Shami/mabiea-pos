<?php

namespace App\Support\UrlGenerator;

use Spatie\MediaLibrary\Support\UrlGenerator\DefaultUrlGenerator;

class FixedUrlGenerator extends DefaultUrlGenerator
{
    public function getUrl(): string
    {

            $url = $this->getDisk()->url($this->getPathRelativeToRoot());

            // استخدم APP_URL من .env لإجبار الرابط على دومين السيرفر
            $appUrl = rtrim(config('app.url'), '/');
    
            $url = preg_replace('#^https?://[^/]+#', $appUrl, $url);
            return $url;
        
    }
}
