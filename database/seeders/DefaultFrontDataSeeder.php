<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Partner;
use App\Models\SadminSetting;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\WhyChooseUs;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DefaultFrontDataSeeder extends Seeder
{
    /**
     * تنفيذ الـ seeds لقاعدة البيانات.
     */
    public function run(): void
    {
        // قسم البطل (Hero Section)
        $keyName = [
            'hero_image' => ('images/default/hero-img.png'),
            'hero_title' => 'إدارة المخازن والمخزون السحابية بسلاسة',
            'hero_description' => 'قم بإدارة عدة مخازن بسهولة باستخدام نظام نقاط بيع سحابي قوي. تتبع المخزون، تبسيط العمليات، وتحسين المبيعات في جميع المواقع بشكل لحظي.',
            'partner_main_title' => 'موثوق به من أفضل الشركات',
            'partner_description' => 'POS يبسط إدارة المخازن المتعددة مع تتبع متقدم، تحديثات المخزون في الوقت الحقيقي، وعمليات سلسة. انضم إلى الشركات التي تعتمد على تقنيتنا للتحكم الذكي بالمخزون.',
            'contact_us_main_title' => 'تواصل معنا',
            'contact_us_description' => 'هل ترغب في معرفة المزيد عن نظام POS، طلب عرض أسعار، أو التحدث مع خبير؟ أبلغنا باحتياجاتك وسنرد عليك قريبًا.',
            'facebook' => "https://facebook.com/",
            'twitter' => "https://x.com/",
            'linkedin' => "https://linkedin.com/",
        ];
        foreach ($keyName as $key => $value) {
            SadminSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // الخدمات
        $services = [
            [
                'image' => 'images/default/services-1.png',
                'title' => 'مخزون لحظي',
                'description' => 'تتبع مستويات المخزون عبر عدة مخازن في الوقت الحقيقي باستخدام نظامنا السحابي. احصل على تحديثات تلقائية لتجنب الفائض أو النفاد وضمان سلاسة العمليات في كل موقع.',
            ],
            [
                'image' => 'images/default/services-2.png',
                'title' => 'تحويلات سهلة',
                'description' => 'قم بنقل المخزون بين المخازن بسهولة بنقرات قليلة. حدّث المخزون فورًا للحفاظ على الدقة وتجنب التناقضات بين المواقع المختلفة.',
            ],
            [
                'image' => 'images/default/services-3.png',
                'title' => 'المبيعات والمشتريات',
                'description' => 'تابع مشترياتك ومبيعاتك عبر المخازن المختلفة. راقب المعاملات، حلل بيانات المبيعات، وحسّن مستويات المخزون لتلبية طلب العملاء بكفاءة.',
            ],
            [
                'image' => 'images/default/services-4.png',
                'title' => 'التحكم في صلاحيات المستخدم',
                'description' => 'عزز الأمان والكفاءة من خلال تخصيص الأدوار والصلاحيات لفريقك. تأكد من أن الموظفين المخولين فقط يمكنهم تعديل المخزون أو معالجة المعاملات أو الوصول للبيانات الحيوية.',
            ],
            [
                'image' => 'images/default/services-5.png',
                'title' => 'مدفوعات مرنة',
                'description' => 'قدّم معاملات سلسة بدعم من Stripe، Razorpay، PayPal، والمدفوعات اليدوية. وفر حلول دفع مرنة وآمنة للعملاء والبائعين والموردين.',
            ]
        ];

        foreach ($services as $data) {
            $service =  Service::create([
                'title' => $data['title'],
                'description' => $data['description'],
            ]);
            if (!empty($data['image']) && file_exists(public_path($data['image']))) {
                $service->addMedia(public_path($data['image']))
                    ->preservingOriginal()
                    ->toMediaCollection(Service::ICON, config('app.media_disc'));
            }
        }

        // لماذا تختارنا (WhyChooseUs)
        $whyChooseUsData = [
            [
                'image' => 'images/default/choose-1.png',
                'title' => 'إدارة المخازن المركزية',
                'description' => '<pعزز مبيعاتك باستخدام نظام POS السحابي السهل الاستخدام. قم بإتمام عمليات العملاء بسهولة مع برنامج نقاط البيع المتطور. احصل على المدفوعات بسرعة، وزد من مبيعات بطاقات الائتمان، وتمتع بميزة تنافسية.</p>',
            ],
            [
                'image' => 'images/default/choose-2.png',
                'title' => 'تحديثات المخزون لحظية',
                'description' => '<pحقق نموًا سريعًا مع برنامج ولاء العملاء المتكامل في POS. تتبع، وكافئ، وألهم عملاءك بعروض مخصصة. وسّع أعمالك بسهولة بإضافة مواقع جديدة. اجعل أحلامك الكبيرة حقيقة مع حلول POS السحابية المبتكرة.</p>',
            ],
            [
                'image' => 'images/default/choose-3.png',
                'title' => 'آمن وقابل للتوسع',
                'description' => '<pقم بإدارة مخزونك بسهولة بدقة سحابية. يسهّل نظامنا المتقدم إدارة المخزون السحابي، مع تنبيهات تلقائية وطباعة ملصقات وبطاقات باركود. عزز أرباحك وقلل المخاطر مع تقنية POS السحابية.</p>',
            ],
            [
                'image' => 'images/default/choose-4.png',
                'title' => 'خيارات دفع مرنة',
                'description' => '<pمع POS، احصل على دعم فوري وإرشادات الخبراء على مدار الساعة. نحن دائمًا هنا لضمان سير أعمالك بسلاسة.</p><ul><li>متاح 24/7</li><li>فريق دعم مخصص</li><li>حل المشكلات بسرعة</li></ul>',
            ],
        ];

        foreach ($whyChooseUsData as $value) {
            $whyChooseUs = WhyChooseUs::create([
                'title' => $value['title'],
                'description' => $value['description'],
            ]);
            if (!empty($value['image']) && file_exists(public_path($value['image']))) {
                $whyChooseUs->addMedia(public_path($value['image']))
                    ->preservingOriginal()
                    ->toMediaCollection(WhyChooseUs::IMAGE, config('app.media_disc'));
            }
        }

        // الشركاء
        $partners = [
            [
                'image' => 'images/default/partner-1.png',
                'name' => 'VONDE',
            ],
            [
                'image' => 'images/default/partner-2.png',
                'name' => 'HIPSTER',
            ],
            [
                'image' => 'images/default/partner-3.png',
                'name' => 'AVANTER',
            ],
            [
                'image' => 'images/default/partner-4.png',
                'name' => 'NORWAY',
            ],
        ];

        foreach ($partners as $value) {
            $partner = Partner::create([
                'name' => $value['name'],
            ]);
            if (!empty($value['image']) && file_exists(public_path($value['image']))) {
                $partner->addMedia(public_path($value['image']))
                    ->preservingOriginal()
                    ->toMediaCollection(Partner::IMAGE, config('app.media_disc'));
            }
        }

        // شهادات العملاء (Testimonials)
        $testimonials = [
            [
                'image' => 'images/default/testimonial-1.png',
                'name' => 'ديفيد ر.',
                'description' => 'نظام POS غيّر تمامًا طريقة إدارة مخازننا! التحديثات اللحظية للمخزون تساعدنا على تجنب النقص، ولوحة التحكم المركزية تجعل كل شيء سهل المتابعة.',
            ],
            [
                'image' => 'images/default/testimonial-2.png',
                'name' => 'سارة م.',
                'description' => 'كنا نعاني من فروقات المخزون بين المواقع. بفضل POS، أصبح لدينا نقل سلس للمخزون وتقارير دقيقة.',
            ],
            [
                'image' => 'images/default/testimonial-3.png',
                'name' => 'مايكل ت.',
                'description' => 'أفضل شيء في POS هو خيارات الدفع المرنة. عملاؤنا يمكنهم الدفع عبر Stripe أو Razorpay أو PayPal بسهولة!',
            ],
            [
                'image' => 'images/default/testimonial-4.png',
                'name' => 'إميلي ج.',
                'description' => 'الأمان والتحكم في الصلاحيات ميزة كبيرة! يمكننا تخصيص صلاحيات الموظفين لضمان التعامل مع المخزون فقط من قبل المخولين.',
            ],
            [
                'image' => 'images/default/testimonial-5.png',
                'name' => 'جيمس ل.',
                'description' => 'منذ التحول إلى POS، شهدنا تحسنًا بنسبة 30% في سرعة تنفيذ الطلبات. الميزات التلقائية توفر الوقت وتقلل الأخطاء.',
            ],
        ];

        foreach ($testimonials as $value) {
            $testimonial = Testimonial::create([
                'name' => $value['name'],
                'description' => $value['description'],
            ]);
            if (!empty($value['image']) && file_exists(public_path($value['image']))) {
                $testimonial->addMedia(public_path($value['image']))
                    ->preservingOriginal()
                    ->toMediaCollection(Testimonial::IMAGE, config('app.media_disc'));
            }
        }

        // الأسئلة الشائعة (FAQs)
        $faqs = [
            [
                'title' => 'كيف أبدأ؟',
                'description' => 'ببساطة اتصل بنا عبر موقعنا الإلكتروني، وسيرشدك فريقنا خلال عملية البدء.',
            ],
            [
                'title' => 'هل تقدمون تغليفًا وتوسيمًا مخصصًا؟',
                'description' => 'نعم، نقدم خدمات التغليف والتوسيم والعلامات التجارية المخصصة لمنتجاتك.',
            ],
            [
                'title' => 'هل توجد رسوم خفية؟',
                'description' => 'لا، نحن نؤمن بالشفافية. جميع التكاليف يتم مناقشتها مسبقًا قبل الالتزام.',
            ],
            [
                'title' => 'ما طرق الدفع المقبولة؟',
                'description' => 'نقبل بطاقات الائتمان الرئيسية، التحويلات البنكية، وبوابات الدفع الإلكترونية.',
            ],
            [
                'title' => 'هل توجد متطلبات تخزين دنيا؟',
                'description' => 'نقدم حلول تخزين مرنة بدون التزامات طويلة الأجل. اتصل بنا لمزيد من التفاصيل.',
            ],
            [
                'title' => 'كم تكلفة التخزين؟',
                'description' => 'تختلف التكلفة حسب مساحة التخزين المطلوبة، المدة، والخدمات الإضافية. اتصل بنا للحصول على عرض مخصص.',
            ],
            [
                'title' => 'هل تديرون تنفيذ الطلبات؟',
                'description' => 'نعم، نقدم خدمات التجميع، التغليف، والشحن لضمان تسليم طلباتك بكفاءة.',
            ],
            [
                'title' => 'هل تقدمون تخزينًا بدرجة حرارة محكومة؟',
                'description' => 'نعم، نوفر حلول تخزين بدرجة حرارة محكومة للمنتجات الحساسة والقابلة للتلف.',
            ],
            [
                'title' => 'هل مخزوني آمن في مستودعاتكم؟',
                'description' => 'نعم! مستودعاتنا مجهزة بمراقبة 24/7، وصول محدود، وأنظمة أمان متقدمة لضمان سلامة البضائع.',
            ],
            [
                'title' => 'ما أنواع المنتجات التي يمكن تخزينها؟',
                'description' => 'نستوعب مجموعة واسعة من المنتجات، بما في ذلك السلع التجزئة، الإلكترونيات، المواد القابلة للتلف، والمزيد. يرجى التواصل للحصول على متطلبات محددة.',
            ],
            [
                'title' => 'كيف أتواصل مع دعم العملاء؟',
                'description' => 'يمكنك التواصل معنا عبر البريد الإلكتروني [labs@infyom.in] أو من خلال نموذج الاتصال عبر الإنترنت.',
            ],
            [
                'title' => 'ما هي ساعات العمل؟',
                'description' => 'نوفر دعمًا طارئًا 24/7 لجميع احتياجات اللوجستيات العاجلة.',
            ],
            [
                'title' => 'ما الخدمات التي تقدمونها؟',
                'description' => 'نقدم حلول التخزين، إدارة المخزون، تنفيذ الطلبات، والخدمات اللوجستية المصممة وفق احتياجات عملك.',
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
