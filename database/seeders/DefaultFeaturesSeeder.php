<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\SadminSetting;
use App\Models\Step;
use Illuminate\Database\Seeder;

class DefaultFeaturesSeeder extends Seeder
{
    /**
     * تنفيذ بيانات افتراضية للميزات والخطوات.
     */
    public function run(): void
    {
        // الميزات
        $features = [
            [
                'image' => 'images/default/feature-1.png',
                'title' => 'تبسيط عملياتك',
                'description' => 'قم بتحسين عمليات البيع بالتجزئة بكفاءة باستخدام حلولنا السحابية المبسطة.',
                'points' => [
                    'حل نقاط بيع سحابي',
                    'إلغاء العمليات اليدوية',
                    'تقليل الأخطاء',
                    'التركيز على خدمة العملاء وتنمية الأعمال',
                ],
            ],
            [
                'image' => 'images/default/feature-2.png',
                'title' => 'إدارة المخزون بكفاءة',
                'description' => 'تابع مستويات المخزون لديك وتأكد من سلاسة عمليات المخزون عبر مواقع متعددة.',
                'points' => [
                    'تتبع المخزون في الوقت الحقيقي',
                    'تنبيهات ونقص المخزون',
                    'تصنيف المنتجات بسهولة',
                    'تعديلات المخزون يدويًا',
                ],
            ],
            [
                'image' => 'images/default/feature-3.png',
                'title' => 'دعم ومساعدة 24/7',
                'description' => 'احصل على دعم متواصل لضمان عدم توقف عملك في أي وقت.',
                'points' => [
                    'فريق دعم عملاء مخصص',
                    'دعم عبر البريد الإلكتروني والهاتف',
                    'قاعدة معرفية شاملة وأسئلة متكررة',
                    'تحديثات منتظمة للنظام وتصحيحات الأمان',
                ],
            ],
            [
                'image' => 'images/default/feature-4.png',
                'title' => 'إدارة متعددة للمخازن',
                'description' => 'قم بإدارة المخزون بكفاءة عبر عدة مخازن مع تتبع متقدم وأتمتة ذكية.',
                'points' => [
                    'رؤية مركزية للمخزون',
                    'تخصيص وتحويل المخزون',
                    'تقارير وتحليلات لكل مخزن',
                    'تنفيذ الطلبات عبر مواقع متعددة',
                ],
            ],
        ];

        foreach ($features as $featureData) {
            $feature = Feature::create([
                'title' => $featureData['title'],
                'description' => $featureData['description'],
                'points' => json_encode($featureData['points']),
            ]);
            if (!empty($featureData['image']) && file_exists(public_path($featureData['image']))) {
                $feature->addMedia(public_path($featureData['image']))
                    ->preservingOriginal()
                    ->toMediaCollection(Feature::IMAGE, config('app.media_disc'));
            }
        }

        // خطوات الاستخدام
        $steps = [
            [
                'image' => 'images/default/step-1.png',
                'sub_title' => 'الخطوة 1',
                'title' => 'سجل نشاطك التجاري',
                'description' => 'قم بالتسجيل في POS عن طريق تقديم تفاصيل عملك. اضبط حسابك بمعلومات الشركة، العملة المفضلة، وإعدادات الضرائب.',
            ],
            [
                'image' => 'images/default/step-2.png',
                'sub_title' => 'الخطوة 2',
                'title' => 'إعداد متجرك',
                'description' => 'أضف عدة مخازن في POS. أضف المخزون والحدود لكل مخزن لضمان تتبع فعال للمخزون.',
            ],
            [
                'image' => 'images/default/step-3.png',
                'sub_title' => 'الخطوة 3',
                'title' => 'استيراد البيانات',
                'description' => 'قم بسهولة باستيراد بيانات الموردين والعملاء إلى POS. مزامنة السجلات الحالية أو إضافة جديدة لتسهيل إدارة الطلبات والمشتريات.',
            ],
            [
                'image' => 'images/default/step-4.png',
                'sub_title' => 'الخطوة 4',
                'title' => 'أتمتة المخزون',
                'description' => 'فعل تحديثات المخزون التلقائية، المخزون حسب المخزن، وميزات إدارة المخزون الذكية.',
            ],
        ];

        foreach ($steps as $stepData) {
            $step = Step::create([
                'sub_title' => $stepData['sub_title'],
                'title' => $stepData['title'],
                'description' => $stepData['description'],
            ]);
            if (!empty($stepData['image']) && file_exists(public_path($stepData['image']))) {
                $step->addMedia(public_path($stepData['image']))
                    ->preservingOriginal()
                    ->toMediaCollection(Step::IMAGE, config('app.media_disc'));
            }
        }
    }
}