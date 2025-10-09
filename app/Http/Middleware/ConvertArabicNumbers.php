<?php

namespace App\Http\Middleware;

use Closure;

class ConvertArabicNumbers
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        $converted = $this->convertArabicNumbers($request->all());
        $request->merge($converted);

        return $next($request);
    }

    /**
     * Recursively convert Arabic numbers in the data array.
     */
    private function convertArabicNumbers($data)
    {
        $arabic = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
        $english = ['0','1','2','3','4','5','6','7','8','9'];

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = $this->convertArabicNumbers($value);
            } elseif (is_string($value)) {
                $data[$key] = str_replace($arabic, $english, $value);
            }
        }

        return $data;
    }
}
