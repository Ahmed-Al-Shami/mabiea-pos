<?php

namespace Database\Seeders;

use App\Models\BaseUnit;
use App\Models\Customer;
use App\Models\MailTemplate;
use App\Models\Role;
use App\Models\SadminSetting;
use App\Models\Setting;
use App\Models\SmsSetting;
use App\Models\SmsTemplate;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class DefaultSettingSeeder extends Seeder
{
    /**
     * تنفيذ بيانات افتراضية للإعدادات.
     */
    public function run(): void
    {
        $tenantId = User::whereHas('roles', function ($query) {
            $query->where('name', Role::ADMIN);
        })->first()->tenant_id;

        // الوحدات الأساسية
        $baseUnits = ['قطعة', 'متر', 'كيلوجرام'];
        foreach ($baseUnits as $baseUnit) {
            BaseUnit::create([
                'tenant_id' => $tenantId,
                'name' => $baseUnit,
                'is_default' => true,
            ]);
        }

        // قوالب البريد الإلكتروني
        $mailTemplates = [
            [
                'tenant_id' => $tenantId,
                'template_name' => 'تحية للعميل عند البيع',
                'content' => '<p>مرحبًا، {customer_name}</p><p>رقم البيع الخاص بك: {sales_id}</p><p>تاريخ البيع: {sales_date}</p><p>المبلغ الإجمالي: {sales_amount}</p><p>المبلغ المدفوع: {paid_amount}</p><p>المبلغ المستحق: {due_amount}</p><p>مع تحيات، {app_name}</p>',
                'type' => MailTemplate::MAIL_TYPE_SALE
            ],
            [
                'tenant_id' => $tenantId,
                'template_name' => 'تحية للعميل عند إرجاع البيع',
                'content' => '<p>مرحبًا، {customer_name}</p><p>رقم إرجاع البيع الخاص بك: {sales_return_id}</p><p>تاريخ الإرجاع: {sales_return_date}</p><p>المبلغ الإجمالي: {sales_return_amount}</p><p>مع تحيات، {app_name}</p>',
                'type' => MailTemplate::MAIL_TYPE_SALE_RETURN,
            ]
        ];
        foreach ($mailTemplates as $mailTemplate) {
            MailTemplate::create($mailTemplate);
        }

        // إعدادات الرسائل القصيرة (SMS)
        $smsSettings = [
            'url' => 'http://test.com/api/test.php',
            'mobile_key' => '',
            'message_key' => '',
            'payload' => '',
        ];
        foreach ($smsSettings as $key => $value) {
            SmsSetting::create([
                'tenant_id' => $tenantId,
                'key' => $key,
                'value' => $value
            ]);
        }

        // قوالب الرسائل القصيرة (SMS)
        $smsTemplates = [
            [
                'tenant_id' => $tenantId,
                'template_name' => 'تحية للعميل عند البيع',
                'content' => 'مرحبًا {customer_name}, رقم البيع الخاص بك: {sales_id}, تاريخ البيع: {sales_date}, المبلغ الإجمالي: {sales_amount}, المدفوع: {paid_amount}, المبلغ المستحق: {due_amount}. شكرًا لزيارتك.',
                'type' => SmsTemplate::SMS_TYPE_SALE,
            ],
            [
                'tenant_id' => $tenantId,
                'template_name' => 'تحية للعميل عند إرجاع البيع',
                'content' => 'مرحبًا {customer_name}, رقم إرجاع البيع: {sales_return_id}, تاريخ الإرجاع: {sales_return_date}, المبلغ الإجمالي: {sales_return_amount}. شكرًا لزيارتك.',
                'type' => SmsTemplate::SMS_TYPE_SALE_RETURN,
            ]
        ];
        foreach ($smsTemplates as $smsTemplate) {
            SmsTemplate::create($smsTemplate);
        }

        // العميل الافتراضي
        Customer::create([
            'tenant_id' => $tenantId,
            'name' => 'عميل مباشر',
            'email' => 'customer@infypos.com',
            'phone' => '123456789',
            'country' => 'الهند',
            'city' => 'مومباي',
            'address' => 'Dr Deshmukh Marg , مومباي',
        ]);

        // المخزن الافتراضي
        Warehouse::create([
            'tenant_id' => $tenantId,
            'name' => 'المخزن الرئيسي',
            'phone' => '123456789',
            'country' => 'الهند',
            'city' => 'مومباي',
            'email' => 'warehouse1@infypos.com',
            'zip_code' => '12345',
        ]);

        // الإعدادات العامة
        $settings = [
            'currency' => 1,
            'is_currency_right' => 0,
            'default_customer' => 1,
            'default_warehouse' => 1,
            'date_format' => 'y-m-d',
            'country' => 'الهند',
            'state' => 'Gujarat',
            'city' => 'Surat',
            // بادئات الكود
            'purchase_code' => 'PU',
            'purchase_return_code' => 'PR',
            'sale_code' => 'SA',
            'sale_return_code' => 'SR',
            'expense_code' => 'EX',
            // إعدادات الإيصالات
            'show_note' => '1',
            'show_phone' => '1',
            'show_customer' => '1',
            'show_address' => '1',
            'show_email' => '1',
            'show_tax_discount_shipping' => '1',
            'show_barcode_in_receipt' => '1',
            'show_logo_in_receipt' => '1',
            'show_product_code' => '1',
            'notes' => 'شكرًا لطلبك',
            'show_warehouse' => '1',
            'stripe_key' => 'pu_test_yBzA1qI1PcfRBAVn1vJG2VuS00HcyhQX9LASERTFDDS',
            'stripe_secret' => 'pu_test_yBzA1qI1PcfRBAVn1vJG2VuS00HcyhQX9LASERTFDDS',
            'sms_gateway' => '1',
            'twillo_sid' => 'asd',
            'twillo_token' => 'asd',
            'twillo_from' => 'asd',
            'smtp_host' => 'mailtrap.io',
            'smtp_port' => '2525',
            'smtp_username' => 'test',
            'smtp_password' => 'test',
            'smtp_Encryption' => 'tls',
        ];
        foreach ($settings as $key => $value) {
            Setting::create([
                'tenant_id' => $tenantId,
                'key' => $key,
                'value' => $value
            ]);
        }

        // إعدادات المسؤول (Sadmin)
        $sadminSetting = [
            'email' => 'contact@infyom.com',
            'logo' => 'images/logo.png',
            'company_name' => 'infy-pos',
            'app_name' => 'InfyPOS SaaS',
            'phone' => '+91 70963 36561',
            'footer' => 'جميع الحقوق محفوظة لشركة InfyOm Technologies',
            'country' => 'الهند',
            'state' => 'Gujarat',
            'city' => 'Surat',
            'postcode' => '395007',
            'address' => 'C-303, Atlanta Shopping Mall, Nr. Sudama Chowk, Mota Varachha, Surat, Gujarat, India.',
            'show_version_on_footer' => '1',
            'show_app_name_in_sidebar' => '1',
            'mail_mailer' => 'smtp',
            'mail_host' => 'mailtrap.io',
            'mail_port' => '2525',
            'sender_name' => 'support@infypos.com',
            'mail_username' => 'test',
            'mail_password' => 'test',
            'mail_from_address' => 'support@infypos.com',
            'mail_encryption' => 'tls',
            'manual_payment_enabled' => '1',
            'manual_payment_guide' => 'سوف نوافق على طلبك خلال 24 ساعة.',
            'term_and_condition' => 'الأحكام والشروط',
            'privacy_policy' => 'سياسة الخصوصية',
            'refund_policy' => 'سياسة الاسترجاع',
            'admin_default_currency_symbol' => '₹',
            'admin_default_currency' => 1,
            'testimonial_main_title' => 'العملاء الذين يختارون POS-SaaS',
            'hero_button_title' => 'ابدأ متجرك اليوم',
        ];
        foreach ($sadminSetting as $key => $value) {
            SadminSetting::create([
                'key' => $key,
                'value' => $value
            ]);
        }
    }
}