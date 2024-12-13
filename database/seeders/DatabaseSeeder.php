<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CancelOrder;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Country;
use App\Models\Discount;
use App\Models\Message;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\ProductKeyAttribute;
use App\Models\ProductKeyword;
use App\Models\ProductVariant;
use App\Models\Supplier;
use App\Models\User;
use App\Models\VariantOption;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Type\Decimal;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        for ($i = 0; $i < 30; $i++) {
            Discount::factory()->create([
                'type' => 'direct',
                'value' => number_format(rand(1, 1000) / rand(1, 100), 2),
            ]);
            Discount::factory()->create([
                'type' => 'percent',
                'value' => number_format(rand(1, 99) / rand(1, 10), 2),
            ]);
        }
        $countries = [
            [
                'name' => "Canada",
                'code' => "CA",
                'image' => "storage/image/country/Canada.png",
                'currency' => "CAD",
            ],
            [
                'name' => "Germany",
                'code' => "DE",
                'image' => "storage/image/country/Germany.png",
                'currency' => "EUR",
            ],
            [
                'name' => "Japan",
                'code' => "JP",
                'image' => "storage/image/country/Japan.png",
                'currency' => "JPY",
            ],
            [
                'name' => "Singapore",
                'code' => "SG",
                'image' => "storage/image/country/Singapore.png",
                'currency' => "SGD",
            ],
            [
                'name' => "South Korea",
                'code' => "KR",
                'image' => "storage/image/country/South_Korea.png",
                'currency' => "KRW",
            ],
            [
                'name' => "Spain",
                'code' => "ES",
                'image' => "storage/image/country/Spain.png",
                'currency' => "EUR",
            ],
            [
                'name' => "Thailand",
                'code' => "TH",
                'image' => "storage/image/country/Thailand.png",
                'currency' => "THB",
            ],
            [
                'name' => "United Kingdom",
                'code' => "GB",
                'image' => "storage/image/country/United_Kingdom.png",
                'currency' => "GBP",
            ],
            [
                'name' => "United States",
                'code' => "US",
                'image' => "storage/image/country/United_States.png",
                'currency' => "USD",
            ],
            [
                'name' => "Vietnam",
                'code' => "VN",
                'image' => "storage/image/country/Vietnam.png",
                'currency' => "VND",
            ],
        ];
        foreach ($countries as $country) {
            Country::create($country);
        }

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => Hash::make('123123123'),
            'avatar' => 'storage\image\avatar\admin.jpg', // Set avatar to null if not applicable
            'address' => null, // Set address to null if not applicable
            'phone_number' => null, // Set phone number to null if not applicable
            'role' => 'admin',
            'country_id' => 1,
        ]);
        User::create([
            'name' => 'Supplier User',
            'email' => 'supplier@test.com',
            'password' => Hash::make('123123123'),
            'avatar' => 'storage\image\avatar\supplier.png', // Set avatar to null if not applicable
            'address' => null, // Set address to null if not applicable
            'phone_number' => null, // Set phone number to null if not applicable
            'role' => 'supplier',
            'country_id' => 1,
        ]);
        User::create([
            'name' => 'Writer User',
            'email' => 'writer@test.com',
            'password' => Hash::make('123123123'),
            'avatar' => 'storage\image\avatar\avatar.png', // Set avatar to null if not applicable
            'address' => null, // Set address to null if not applicable
            'phone_number' => null, // Set phone number to null if not applicable
            'role' => 'writer',
            'country_id' => 1,
        ]);
        User::create([
            'name' => 'Customer User',
            'email' => 'customer@test.com',
            'password' => Hash::make('123123123'),
            'avatar' => 'storage/image/avatar/avatar.png', // Set avatar to null if not applicable
            'address' => null, // Set address to null if not applicable
            'phone_number' => null, // Set phone number to null if not applicable
            'role' => 'customer',
            'country_id' => 1,
        ]);

        User::factory()->count(30)->create();

        $categoryTypes = [
            'My categories',
            'Home Decor',
            'Industrial',
            'Health & Personal Care',
            'Fashion & Beauty',
            'Sports & Entertainment',
            'Tools & Home Improvement',
            'Raw Materials',
            'Maintenance, Repair & Operations',
        ];

        foreach ($categoryTypes as $categoryName) {
            CategoryType::create(['name' => $categoryName]);
        }
        $categoryTypes = [
            [
                1,
                'My categories',
                ['Consumer Electronics', 'Pet Supplies', 'Apparel & Accessories', 'Mother, Kids & Toys', 'Health Care', 'Sports & Entertainment', 'Chemicals', 'Jewelry, Eyewear, Watches & Accessories', 'Vehicle Accessories, Electronics & Tools', 'Renewable Energy']
            ],
            [
                2,
                'Home Decor',
                ['Gifts & Crafts', 'Home & Garden', 'Construction & Real Estate', 'Lights & Lighting', 'Furniture', 'Pet Supplies']
            ],
            [
                3,
                'Industrial',
                ['Industrial Machinery', 'Vehicles & Transportation', 'Commercial Equipment & Machinery', 'Fabrication Services', 'Renewable Energy', 'Tools & Hardware', 'Material Handling', 'Power Transmission', 'Electrical Equipment & Supplies', 'Vehicle Parts & Accessories', 'Construction & Building Machinery', 'Electronic Components, Accessories & Telecommunications', 'Vehicle Accessories, Electronics & Tools']
            ],
            [
                4,
                'Health & Personal Care',
                ['Food & Beverage', 'Medical devices & Supplies', 'Sports & Entertainment', 'Packaging & Printing', 'Personal Care & Household Cleaning', 'Mother, Kids & Toys', 'Health Care']
            ],
            [
                5,
                'Fashion & Beauty',
                ['Shoes & Accessories', 'Apparel & Accessories', 'Luggage, Bags & Cases', 'Jewelry, Eyewear, Watches & Accessories', 'Packaging & Printing', 'Beauty']
            ],
            [
                6,
                'Sports & Entertainment',
                ['Consumer Electronics', 'Home Appliances', 'Sports & Entertainment']
            ],
            [
                7,
                'Tools & Home Improvement',
                ['Construction & Real Estate', 'Tools & Hardware', 'Lights & Lighting', 'Furniture', 'Renewable Energy', 'Electrical Equipment & Supplies', 'Safety', 'Security', 'Consumer Electronics']
            ],
            [
                8,
                'Raw Materials',
                ['Chemicals', 'Metals & Alloys', 'Rubber & Plastics', 'Fabric & Textile Raw Material', 'Agriculture', 'Business Services']
            ],
            [
                9,
                'Maintenance, Repair & Operations',
                ['Tools & Hardware', 'Testing Instrument & Equipment', 'Power Transmission', 'Material Handling', 'Safety', 'Security', 'School & Office Supplies', 'Electrical Equipment & Supplies', 'Packaging & Printing', 'Renewable Energy', 'Environment']
            ],
        ];
        foreach ($categoryTypes as $categoryType) {
            foreach ($categoryType[2] as $category) {
                Category::create([
                    'category_type_id' => $categoryType[0],
                    'name' => $category
                ]);
            }
        }



        $supplierCount = User::where('role', 'supplier')->count();
        Supplier::factory()->count($supplierCount)->create();


        //product
        for ($i = 30; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $datef = $date->format("Y-m-d");
            Product::factory()
                ->count(random_int(5, 15))
                ->create(['created_at' => $datef]);
        }
        $products = Product::where('is_variant', true)->get();

        $option1  = ['size', ['S', 'M', 'L']];
        $option2 = ['color', ['red', 'blue']];

        foreach ($products as $product) {
            foreach ($option1[1] as $size) {
                foreach ($option2[1] as $color) {
                    $productVariant = ProductVariant::factory()
                        ->create([
                            'product_id' => $product->id,
                            'created_at' => $datef
                        ]);

                    VariantOption::create([
                        'product_variant_id' => $productVariant->id,
                        'name' => $option2[0],
                        'value' => $color,
                        'created_at' => $datef
                    ]);
                    VariantOption::create([
                        'product_variant_id' => $productVariant->id,
                        'name' => $option1[0],
                        'value' => $size,
                        'created_at' => $datef
                    ]);
                }
            }
        }

        $products = Product::where('is_variant', false)->get();

        foreach ($products as $product) {
            ProductVariant::factory()
                ->create([
                    'product_id' => $product->id,
                    'created_at' => $datef
                ]);
        }

        $products = Product::all();
        foreach ($products as $product) {
            ProductAttribute::factory()->create(['product_id' => $product->id]);
            ProductKeyAttribute::create([
                'product_id' => $product->id,
                'name' => 'Age Range',
                'value' => ['2 to 4 Years', '5 to 7 years', '8 to 13 Years', '14 Years & up'][random_int(0, 3)],
            ]);
            ProductKeyAttribute::create([
                'product_id' => $product->id,
                'name' => 'Theme',
                'value' => ['red', 'blue', 'black', 'white'][random_int(0, 3)],
            ]);
            $keywords = explode(' ', $product->category->name);
            $keyword = $keywords[random_int(0, count($keywords) - 1)];
            $product->keywords()->create(['keyword' => $keyword]);
        }

        // ProductVariant::all()->each(function ($productVariant) {
        //     $productVariant->update(['stock' => $productVariant->total_stock]);
        // });

        //Order
        for ($i = 30; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $datef = $date->format("Y-m-d");
            Order::factory()
                ->count(random_int(1, 100))
                ->create(['created_at' => $datef]);
        }
        $orders = Order::all();
        foreach ($orders as $order) {
            $productVariant = ProductVariant::where('stock', ">", 0)->inRandomOrder()->first();

            $quantity = random_int(1, $productVariant->stock);
            $items_subtotal = $quantity * $productVariant->price;
            $total = $items_subtotal;
            OrderDetail::create([
                'order_id' => $order->id,
                'product_variant_id' => $productVariant->id,
                'variant' => $productVariant->options->pluck('value')->join(', '),
                'name' => $productVariant->product->name,
                'quantity' => $quantity,
                'price' => $productVariant->price,
                'weight' => $productVariant->weight,
            ]);
            $discount = [Discount::where('quantity', '>', 0)->inRandomOrder()->first(), null][random_int(0, 1)];
            $discount_code = null;
            $discount_type = null;
            $discount_value = null;
            if ($discount) {
                $discount_code = $discount->code;
                $discount_type = $discount->type;
                $discount_value = $discount->value;
                $discountValue =
                    $discount->type == 'direct'
                    ? $discount->value
                    : ($discount->value / 100) * $items_subtotal;
                $total = ($items_subtotal - $discountValue) < 0 ? 0 : $items_subtotal - $discountValue;
                $discount->update(['quantity' => $discount->quantity - 1]);
            }
            $order->update([
                'supplier_id' => $productVariant->product->supplier_id,
                'discount_code' => $discount_code,
                'discount_type' => $discount_type,
                'discount_value' => $discount_value,
                'total' => $total,
                'items_subtotal' => $items_subtotal,
                'shipping_cost' => 0,
            ]);
            $productVariant->update(['stock' => $productVariant->stock - $quantity]);
        }

        $orders = Order::where('status', 'canceled')->get();
        foreach ($orders as $order) {
            CancelOrder::factory()->create(['order_id' => $order->id]);
        }


        // $arrayProduct = [
        //     [
        //         'Gifts & Crafts' =>
        //         [
        //             1 => [
        //                 'code' => 'band',
        //                 'name' => 'Custom Logo Reusable Wrist Bands Smart Rfid Nfc 213 Chip Access Control Bracelet Stretchy Elastic Woven NFC Wristband',
        //                 'description' => '',
        //                 'image' => 'storage/image/product/Hff6b55831eda49199646e1c2e58432f22.jpg',
        //                 'is_variant' => false,
        //                 'category_id' => 11,
        //                 'supplier_id' => 1,
        //                 'product_variants' => [
        //                     [
        //                         'weight' => 0.15,
        //                         'price' => 1,
        //                         'stock' => 100,
        //                         'total_stock' => 100,
        //                         'varOptions' => [
        //                             [
        //                                 'name' => '',
        //                                 'value' => '',
        //                             ]
        //                         ]
        //                     ],
        //                 ],
        //                 'product_keywords' => ['band'],
        //             ],

        //         ]
        //     ],
        //     [
        //         'Home & Garden' =>
        //         [
        //             [
        //                 'code' => '',
        //                 'name' => '',
        //                 'description' => '',
        //                 'image' => '',
        //                 'is_variant' => '',
        //                 'category_id' => '',
        //                 'supplier_id' => '',
        //                 'product_variants' => []
        //             ],
        //         ]
        //     ],
        //     [
        //         'Construction & Real Estate' =>
        //         [
        //             [
        //                 'code' => '',
        //                 'name' => '',
        //                 'description' => '',
        //                 'image' => '',
        //                 'is_variant' => '',
        //                 'category_id' => '',
        //                 'supplier_id' => '',
        //                 'product_variants' => []
        //             ],
        //         ]
        //     ],

        // ];
        // foreach ($arrayProduct as $arrCategory) {
        //     foreach ($arrCategory as $category => $arrProducts) {
        //         foreach ($arrProducts as $arrProduct) {
        //             $product = Product::create($arrProduct);

        //             $product->attribute()->create();

        //             foreach ($arrProduct['product_variants'] as $product_variant) {
        //                 $variant = $product->variants()->create($product_variant);
        //                 foreach ($product_variant['varOptions'] as $opt) {
        //                     $variant->options()->create([
        //                         'name' => $opt['name'],
        //                         'value' => $opt['value'],
        //                     ]);
        //                 }
        //             }
        //             foreach ($arrProduct['product_keywords'] as $product_keyword) {
        //                 $product->keywords()->create($arrayProduct['product_keyword']);
        //             }
        //         }
        //     }
        // }

        // $message = Message::create([
        //     'sender' => 2,
        //     'receiver' => 4,
        //     'message' => "test 1",
        // ]);
        // $message = Message::create([
        //     'sender' => 4,
        //     'receiver' => 2,
        //     'message' => "test 2",
        // ]);
        // $message = Message::create([
        //     'sender' => 2,
        //     'receiver' => 4,
        //     'message' => "test 3",
        // ]);
        // $message = Message::create([
        //     'sender' => 2,
        //     'receiver' => 5,
        //     'message' => "test 4",
        // ]);
    }
}
