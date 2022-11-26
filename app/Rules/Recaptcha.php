<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class Recaptcha implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public int $RecaptchaScore;

    public function __construct($score = 0.5)
    {
        $this->RecaptchaScore = $score;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //lấy response từ google recaptcha v3
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('GOOGLE_RECAPTCHA_SECRET'),
            'response' => $value,
            'ip' => request()->ip(),
        ]);

        //Kiểm tra xem response có thành công không và có message là success không
        //Nếu có thì kiểm tra xem score có lớn hơn hoặc bằng score mà mình đã đặt không
        //Nếu có thì trả về true, không thì trả về false
        if ($response->successful() && $response->json()['success']) {
            return $response->json()['score'] >= $this->RecaptchaScore;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Lỗi khi xác thực bằng recaptcha.';
    }
}
