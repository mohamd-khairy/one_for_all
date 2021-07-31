<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'image' => 'images/default.png',
                'parent_id' => null,
                'en' => ['name' => 'my lost', 'details' => "I am missing something, I can't find important papers, personal cards, visa and credit cards, wallets, bags, clothes, shoes, and other valuable items, electronics, mobiles, laptops, jewelry, gold, people's money, lost or lost children, and lost vehicles and bikes"],
                'ar' => ['name' => 'مفقوداتى', 'details' => 'فاقد شىء ولا واجد اوراق مهمه وبطاقات شخصيه وبطاقات فيزا وائتمان ومحافظ وسعات وملابس واحذيه واغراض ثمينه اخرى والكترونات وموبايلات ولابتوب ومجوهرات وذهب واموال اشخاص واطفال تائهه او مفقوده ومركبات ودرجات مفقوده']
            ],
            [
                'image' => 'images/default.png',
                'parent_id' => null,
                'en' => ['name' => 'my purchases', 'details' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. "],
                'ar' => ['name' => 'مشترواتى', 'details' => 'لوريم إيبسوم هو ببساطة نص شكلي يستخدم في صناعة الطباعة والتنضيد. كان هو النص الوهمي القياسي في الصناعة منذ القرن الخامس عشر الميلادي ، عندما أخذت طابعة غير معروفة لوحًا من النوع وتدافعت عليه لعمل كتاب عينة. ']
            ],
            [
                'image' => 'images/default.png',
                'parent_id' => null,
                'en' => ['name' => 'my auctions', 'details' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. "],
                'ar' => ['name' => 'مزاداتى', 'details' => 'لوريم إيبسوم هو ببساطة نص شكلي يستخدم في صناعة الطباعة والتنضيد. كان هو النص الوهمي القياسي في الصناعة منذ القرن الخامس عشر الميلادي ، عندما أخذت طابعة غير معروفة لوحًا من النوع وتدافعت عليه لعمل كتاب عينة. ']
            ],
            [
                'image' => 'images/default.png',
                'parent_id' => null,
                'en' => ['name' => 'Reservation and rent', 'details' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. "],
                'ar' => ['name' => 'الحجز والايجار', 'details' => 'لوريم إيبسوم هو ببساطة نص شكلي يستخدم في صناعة الطباعة والتنضيد. كان هو النص الوهمي القياسي في الصناعة منذ القرن الخامس عشر الميلادي ، عندما أخذت طابعة غير معروفة لوحًا من النوع وتدافعت عليه لعمل كتاب عينة. ']
            ],
            [
                'image' => 'images/default.png',
                'parent_id' => null,
                'en' => ['name' => 'Jobs and Services', 'details' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. "],
                'ar' => ['name' => 'الوظائف والخدمات', 'details' => 'لوريم إيبسوم هو ببساطة نص شكلي يستخدم في صناعة الطباعة والتنضيد. كان هو النص الوهمي القياسي في الصناعة منذ القرن الخامس عشر الميلادي ، عندما أخذت طابعة غير معروفة لوحًا من النوع وتدافعت عليه لعمل كتاب عينة. ']
            ],
            [
                'image' => 'images/default.png',
                'parent_id' => null,
                'en' => ['name' => 'Industry and commerce', 'details' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. "],
                'ar' => ['name' => 'الصناعه والتجاره', 'details' => 'لوريم إيبسوم هو ببساطة نص شكلي يستخدم في صناعة الطباعة والتنضيد. كان هو النص الوهمي القياسي في الصناعة منذ القرن الخامس عشر الميلادي ، عندما أخذت طابعة غير معروفة لوحًا من النوع وتدافعت عليه لعمل كتاب عينة. ']
            ],
            [
                'image' => 'images/default.png',
                'parent_id' => null,
                'en' => ['name' => 'Graphics and software', 'details' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. "],
                'ar' => ['name' => 'الجرافيك والسوفتوير', 'details' => 'لوريم إيبسوم هو ببساطة نص شكلي يستخدم في صناعة الطباعة والتنضيد. كان هو النص الوهمي القياسي في الصناعة منذ القرن الخامس عشر الميلادي ، عندما أخذت طابعة غير معروفة لوحًا من النوع وتدافعت عليه لعمل كتاب عينة. ']
            ],
            [
                'image' => 'images/default.png',
                'parent_id' => null,
                'en' => ['name' => 'wholesale market', 'details' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. "],
                'ar' => ['name' => 'سوق الجمله', 'details' => 'لوريم إيبسوم هو ببساطة نص شكلي يستخدم في صناعة الطباعة والتنضيد. كان هو النص الوهمي القياسي في الصناعة منذ القرن الخامس عشر الميلادي ، عندما أخذت طابعة غير معروفة لوحًا من النوع وتدافعت عليه لعمل كتاب عينة. ']
            ],
            [
                'image' => 'images/default.png',
                'parent_id' => null,
                'en' => ['name' => 'Egypt problems', 'details' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. "],
                'ar' => ['name' => 'مشاكل مصر', 'details' => 'لوريم إيبسوم هو ببساطة نص شكلي يستخدم في صناعة الطباعة والتنضيد. كان هو النص الوهمي القياسي في الصناعة منذ القرن الخامس عشر الميلادي ، عندما أخذت طابعة غير معروفة لوحًا من النوع وتدافعت عليه لعمل كتاب عينة. ']
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        User::create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'name' => 'admin',
            'email_verified_at' => now(),
            'role_id ' => 1,
            'avatar' => 'users/default.png'
        ]);
    }
}
