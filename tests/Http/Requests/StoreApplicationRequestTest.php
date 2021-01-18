<?php

namespace Tests\Http\Requests;

use App\Http\Requests\StoreApplicationRequest;
use App\Models\Application;
use App\Models\Whence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\Feature\Api\Validation\ValidationTestCase;
use Illuminate\Support\Facades\Validator;

class StoreApplicationRequestTest extends ValidationTestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @param array $arr
     * @param array $without
     * @return array
     */
    public function getData(array $arr = [], array $without = []): array
    {
        $whence = Whence::factory()->create();

        $data = [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'birthday' => now()->subYears(18)->format('d-m-Y'),
            'email' => $this->faker->word . '@gmail.com',
            'phone' => $this->faker->numerify('+48#########'),
            'shop' => $this->faker->text($this->faker->numberBetween(5, 128)),
            'whence' => $whence->id,
            'product_code' => $this->faker->numerify('########'),
            'img_receipt' => $this->createTestFile('receipt.jpg', 1024),
            'legal_1' => true,
            'legal_2' => true,
            'legal_3' => true,
            'legal_4' => true
        ];

        foreach ($without as $item) {
            if (array_key_exists($item, $data)) {
                unset($data[$item]);
            }
        }

        return array_merge($data, $arr);
    }

    /** @test */
    public function validation_pass_for_valid_data()
    {
        $data = $this->getData();

        $validator = Validator::make($data, (new StoreApplicationRequest())->rules());

        $this->assertFalse($validator->fails());
    }

    /** @test */
    public function validation_pass_for_valid_data_with_main_prize()
    {
        $data = $this->getData([
            'main_prize' => 'on',
            'competition_title' => $this->faker->text(128),
            'competition_audio' => $this->createTestFile('test.mp3', 1024)
        ], []);

        $class = new StoreApplicationRequest();
        $class->initialize(['main_prize' => 'on'], []);

        $validator = Validator::make($data, $class->rules());

        $this->assertFalse($validator->fails());
    }

    /** @test */
    public function validation_pass_for_valid_data_with_week_prize()
    {
        $data = $this->getData([
            'week_prize' => 'on',
            'timer' => $this->faker->randomNumber(),
            'response' => $this->faker->text(128),
            'correct' => $this->faker->numberBetween(0, 17),
        ], []);

        $class = new StoreApplicationRequest();
        $class->initialize(['week_prize' => 'on'], []);

        $validator = Validator::make($data, $class->rules());

        $this->assertFalse($validator->fails());
    }

    /** @test */
    public function validation_fails_if_firstname_is_not_exists()
    {
        $data = $this->getData([], ['firstname']);

        $this->expectValidationException($data, StoreApplicationRequest::class);
    }

    /** @test */
    public function validation_fails_if_firstname_is_not_a_string()
    {
        $data = $this->getData([
            'firstname' => $this->faker->numberBetween(1, 100)
        ]);

        $this->expectValidationException($data, StoreApplicationRequest::class);
    }

    /** @test */
    public function validation_fails_if_firstname_is_less_that_min_length()
    {
        $data = $this->getData([
            'firstname' => Str::random(2)
        ]);

        $this->expectValidationException($data, StoreApplicationRequest::class);
    }

    /** @test */
    public function validation_fails_if_firstname_is_exceeds_max_length()
    {
        $data = $this->getData([
            'firstname' => Str::random(129),
        ]);

        $this->expectValidationException($data, StoreApplicationRequest::class);
    }

    /** @test */
    public function validation_fails_if_lastname_is_not_exists()
    {
        $data = $this->getData([], ['lastname']);

        $this->expectValidationException($data, StoreApplicationRequest::class);
    }

    /** @test */
    public function validation_fails_if_lastname_is_not_a_string()
    {
        $data = $this->getData([
            'lastname' => $this->faker->numberBetween(1, 100)
        ]);

        $this->expectValidationException($data, StoreApplicationRequest::class);
    }

    /** @test */
    public function validation_fails_if_lastname_is_less_that_min_length()
    {
        $data = $this->getData([
            'lastname' => Str::random(2)
        ]);

        $this->expectValidationException($data, StoreApplicationRequest::class);
    }

    /** @test */
    public function validation_fails_if_lastname_is_exceeds_max_length()
    {
        $data = $this->getData([
            'lastname' => Str::random(129),
        ]);

        $this->expectValidationException($data, StoreApplicationRequest::class);
    }

    /** @test */
    public function validation_fails_if_email_is_not_exists()
    {
        $data = $this->getData([], ['email']);

        $this->expectValidationException($data, StoreApplicationRequest::class);
    }

    /** @test */
    public function validation_fails_if_email_is_not_rfc()
    {
        $data = $this->getData([
            'email' => Str::random(16),
        ]);

        $this->expectValidationException($data, StoreApplicationRequest::class);
    }

    /** @test */
    public function validation_fails_if_email_is_not_unique()
    {
        $application = Application::factory()->create();

        $data = $this->getData([
            'email' => $application->email,
        ]);

        $this->expectValidationException($data, StoreApplicationRequest::class);
    }

    /** @test */
    public function validation_fails_if_phone_is_not_exists()
    {
        $data = $this->getData([], ['phone']);

        $this->expectValidationException($data, StoreApplicationRequest::class);
    }

    /** @test */
    public function validation_fails_if_phone_is_not_regexp()
    {
        $data = $this->getData([
            'phone' => $this->faker->numerify('+48########'),
        ]);

        $this->expectValidationException($data, StoreApplicationRequest::class);
    }

    /** @test */
    public function validation_fails_if_img_receipt_is_not_exists()
    {
        $data = $this->getData([], ['img_receipt']);

        $this->expectValidationException($data, StoreApplicationRequest::class);
    }

    /** @test */
    public function validation_fails_if_img_receipt_is_not_file()
    {
        $data = $this->getData([
            'img_receipt' => $this->faker->word,
        ]);

        $this->expectValidationException($data, StoreApplicationRequest::class);
    }

    /** @test */
    public function validation_fails_if_img_receipt_is_not_file_image()
    {
        $data = $this->getData([
            'img_receipt' => $this->createTestFile('test.pdf', 1024),
        ]);

        $this->expectValidationException($data, StoreApplicationRequest::class);
    }

    /** @test */
    public function validation_fails_if_img_receipt_is_too_large()
    {
        $data = $this->getData([
            'img_receipt' => $this->createTestFile('test.jpg', 5000),
        ]);

        $this->expectValidationException($data, StoreApplicationRequest::class);
    }

//    /** @test */
//    public function validation_fails_if_iban_is_not_exists()
//    {
//        $data = $this->getData([], ['iban']);
//
//        $this->expectValidationException($data, StoreApplicationRequest::class);
//    }

//    /** @test */
//    public function validation_fails_if_iban_is_not_regexp()
//    {
//        $data = $this->getData([
//            'iban' => $this->faker->numerify('+48########'),
//        ]);
//
//        $this->expectValidationException($data, StoreApplicationRequest::class);
//    }


//    /** @test */
//    public function validation_fails_if_reason_is_not_exists()
//    {
//        $data = $this->getData([], ['reason']);
//
//        $this->expectValidationException($data, StoreApplicationRequest::class);
//    }

//    /** @test */
//    public function validation_fails_if_reason_is_not_a_string()
//    {
//        $data = $this->getData([
//            'reason' => $this->faker->numberBetween(1, 100)
//        ]);
//
//        $this->expectValidationException($data, StoreApplicationRequest::class);
//    }

//    /** @test */
//    public function validation_fails_if_reason_is_less_that_min_length()
//    {
//        $data = $this->getData([
//            'reason' => Str::random(2)
//        ]);
//
//        $this->expectValidationException($data, StoreApplicationRequest::class);
//    }

//    /** @test */
//    public function validation_fails_if_reason_is_exceeds_max_length()
//    {
//        $data = $this->getData([
//            'reason' => Str::random(4097),
//        ]);
//
//        $this->expectValidationException($data, StoreApplicationRequest::class);
//    }

    /** @test */
    public function validation_fails_if_legal_1_is_exist()
    {
        $data = $this->getData([], ['legal_1']);

        $this->expectValidationException($data, StoreApplicationRequest::class);
    }

    /** @test */
    public function validation_fails_if_legal_2_is_exist()
    {
        $data = $this->getData([], ['legal_2']);

        $this->expectValidationException($data, StoreApplicationRequest::class);
    }

    /** @test */
    public function validation_fails_if_legal_3_is_exist()
    {
        $data = $this->getData([], ['legal_3']);

        $this->expectValidationException($data, StoreApplicationRequest::class);
    }

    /** @test */
    public function validation_fails_if_legal_4_is_exist()
    {
        $data = $this->getData([], ['legal_4']);

        $this->expectValidationException($data, StoreApplicationRequest::class);
    }

    /** @test */
    public function validation_fails_if_competition_title_is_not_exists()
    {
        $data = $this->getData([
            'main_prize' => 'on',
            'competition_audio' => $this->createTestFile('example.mp3', 1024),
        ], []);

        $this->expectValidationException($data, StoreApplicationRequest::class, ['main_prize' => 'on']);
    }

    /** @test */
    public function validation_fails_if_competition_title_is_not_a_string()
    {
        $data = $this->getData([
            'main_prize' => 'on',
            'competition_title' => $this->faker->numberBetween(1, 1000),
            'competition_audio' => $this->createTestFile('example.mp3', 1024),
        ], []);

        $this->expectValidationException($data, StoreApplicationRequest::class, ['main_prize' => 'on']);
    }

    /** @test */
    public function validation_fails_if_competition_title_is_less_that_min_length()
    {
        $data = $this->getData([
            'main_prize' => 'on',
            'competition_title' => Str::random(2),
            'competition_audio' => $this->createTestFile('example.mp3', 1024),
        ], []);

        $this->expectValidationException($data, StoreApplicationRequest::class, ['main_prize' => 'on']);
    }

    /** @test */
    public function validation_fails_if_competition_title_is_exceeds_max_length()
    {
        $data = $this->getData([
            'main_prize' => 'on',
            'competition_title' => Str::random(129),
            'competition_audio' => $this->createTestFile('example.mp3', 1024),
        ], []);

        $this->expectValidationException($data, StoreApplicationRequest::class, ['main_prize' => 'on']);
    }

    /** @test */
    public function validation_fails_if_competition_audio_is_not_exists()
    {
        $data = $this->getData([
            'main_prize' => 'on',
            'competition_title' => $this->faker->text(128),
        ], []);

        $this->expectValidationException($data, StoreApplicationRequest::class, ['main_prize' => 'on']);
    }

    /** @test */
    public function validation_fails_if_competition_audio_is_not_file()
    {
        $data = $this->getData([
            'main_prize' => 'on',
            'competition_title' => $this->faker->text(128),
            'competition_audio' => $this->faker->text(128)
        ], []);

        $this->expectValidationException($data, StoreApplicationRequest::class, ['main_prize' => 'on']);
    }

    /** @test */
    public function validation_fails_if_competition_audio_is_not_file_audio()
    {
        $data = $this->getData([
            'main_prize' => 'on',
            'competition_title' => $this->faker->text(128),
            'competition_audio' => $this->createTestFile('test.pdf', 1024)
        ], []);

        $this->expectValidationException($data, StoreApplicationRequest::class, ['main_prize' => 'on']);
    }

    /** @test */
    public function validation_fails_if_competition_audio_is_too_large()
    {
        $data = $this->getData([
            'main_prize' => 'on',
            'competition_title' => $this->faker->text(128),
            'competition_audio' => $this->createTestFile('test.mp3', 5000)
        ], []);

        $this->expectValidationException($data, StoreApplicationRequest::class, ['main_prize' => 'on']);
    }

    /** @test */
    public function validation_fails_if_timer_is_not_exists()
    {
        $data = $this->getData([
            'week_prize' => 'on',
            'response' => $this->faker->text(128),
            'correct' => $this->faker->numberBetween(0, 17),
        ], []);

        $this->expectValidationException($data, StoreApplicationRequest::class, ['week_prize' => 'on']);
    }

    /** @test */
    public function validation_fails_if_response_is_not_exists()
    {
        $data = $this->getData([
            'week_prize' => 'on',
            'timer' => $this->faker->randomNumber(),
            'correct' => $this->faker->numberBetween(0, 17),
        ], []);

        $this->expectValidationException($data, StoreApplicationRequest::class, ['week_prize' => 'on']);
    }

    /** @test */
    public function validation_fails_if_correct_is_not_exists()
    {
        $data = $this->getData([
            'week_prize' => 'on',
            'timer' => $this->faker->randomNumber(),
            'response' => $this->faker->text(128),
        ], []);

        $this->expectValidationException($data, StoreApplicationRequest::class, ['week_prize' => 'on']);
    }

}
