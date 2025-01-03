<?php

namespace Database\Seeders;

use App\Models\UserManual;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserManualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'question' => 'متطلبات التشغيل لأول مرة',
                'answer' => '- الدخول على لوحة التحكم الإدارة > الإعدادات
                ادخال جميع البيانات ورفع شعار العيادة  مع ضبط وقت العمل',
            ],
            [
                'question' => 'اهم مميزات البرنامج',
                'answer' => '-	برنامج خفيف وسريع جدا وقابل للتطوير .
                -	يمكن إضافة شعار العيادة والرقم الضريبي والتفعيل او الإيقاف مع اضافه هاتف العيادة والعنوان الوطني .
                -	يمكن تحديد تشغيل فترة دوام المركز او العيادة من لوحة الإدارة > الإعدادات < اخر الصفحة يتم تحديد فترات العمل لكي يتم تطبيقها على المواعيد وحضور المرضى .
                -	إمكانية التحكم بصلاحيات الموظفين عبر لوحة التحكم المجموعات وهي خاصه بالموظفين ويمكن اضافه او الغاء الصلاحية للمجموع حيث الموظف يتبع المجموعة .
                -	التحكم بالطابعة الحرارية او العادية عبر الإعدادات لوحة الإدارة وتفعيل الطابعة الحرارية .
                -	جميع الصفحات فيها فلاتر بحث او اظهار بيانات او تصدير اكسل .',
            ],
            [
                'question' => 'إضافة موظف',
                'answer' => '-	يمكن إضافة موظف من لوحة التحكم مع اختيار القسم والمجموعة واضافة الراتب والنسبة او جعل القيمة صفر مع تحديد الخيارات في حال كان طبيب اسنان او جلدية لكي يظهر نموذج القسم صورة .
                -	يمكن معرفة الرواتب والنسب بالدخول على التقارير وإظهار الر واتب للكل او لموظف .
                -	يمكن للموظفين عبر الصفحة الخاصة به معرفه التقارير والرواتب والنسب .
                -	يوجد خصم في الرواتب للموظف او اضافه اوفر تايم عبر تقرير الرواتب .',
            ],
            [
                'question' => 'احصائيات موظف الاستقبال',
                'answer' => '-	يمكن الدخول من قبل الإدارة على المحاسبة > تقرير موظف الاستقبال ومعرفه نشاطه اليومي او لفترة محددة ومعرفه إحصائية لإضافة المرضى والفواتير والحركات المالية',
            ],
            [
                'question' => 'الربط مع تمارا',
                'answer' => '-	في حال الربط مع تمارا يمكن الخصم بنسبه محددة حسب الاتفاق ويمكن التفعيل مباشرة .',
            ],
            [
                'question' => 'المواعيد',
                'answer' => '-	يمكن إضافة موعد للمرضى واختيار الفترة ويمكن للموظف او الطبيب عمل حضور للمريض او الغاء او لم يحضر .
                -	في حال حضور مريض مباشرة يمكن عمل تحويل مباشرة وسيتم النظام تسجيله بشكل تلقائي حضور .
                -	كل مريض يكون له نص ساعه في العلاج وحساب الموعد يكون أيضا نص ساعه لكل موعد .',
            ],
            [
                'question' => 'سداد الفواتير',
                'answer' => '-	مسدد يعتبر سدد الفاتورة بالكامل مع طريقه السداد .
                -	مسدد جزئي مثال مبلغ الفاتورة 1000 ريال وكل مرة يحضر للعيادة يسدد أي مبلغ لذلك يتم الدخول على الفاتورة وعمل سند سداد وسيخصم من المتبقي  حتى يتم السداد .
                -	غير مسدد لم يقم بالدفع .',
            ],
            [
                'question' => 'الملف الإلكتروني للمريض',
                'answer' => '-	يمكن الدخول على حساب المريض و معرفة كل التفاصيل او عرض الملف الإلكتروني بالكامل وطباعته .
                -	يمكن رفع الملفات والأشعة عبر ملف المريض والرجوع اليها .
                -	مشاهدة كل مواعيد والفواتير المريض .',
            ],
        ];
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('user_manuals')->truncate();
        foreach ($data as $item) {
            UserManual::create($item);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
