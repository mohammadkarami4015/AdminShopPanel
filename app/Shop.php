<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Shop extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;

    protected $guarded = [];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function discount()
    {
        return $this->hasMany(Discount::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function shopCategories()
    {
        return $this->hasMany(ShopCategory::class);
    }

    public function productComments()
    {
        return $this->hasMany(ProductComment::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function subgroup()
    {
        return $this->belongsTo(Subgroup::class);
    }

    public static function createNew(Request $request)
    {
      return  self::query()->create([
            'name' => $request->name,
            'title' => $request->title,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'subgroup_id' => $request->subgroup_id,
            'instagram' => $request->instagram,
            'telegram' => $request->telegram,
            'whatsup' => $request->whatsup,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'contact_phone' => $request->contact_phone,
            'phone_number' => $request->phone_number,
            'admin_verification' => 'on',
            'desc' => $request->desc,
            'address' => $request->address,
            'send_prices' => $request->send_prices,
            'min_order_price' => $request->min_order_price,
        ]);
    }


    public function updateShop($request)
    {
        $this->update([
            'name' => $request->name,
            'title' => $request->title,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'subgroup_id' => $request->subgroup_id,
            'instagram' => $request->instagram,
            'telegram' => $request->telegram,
            'whatsup' => $request->whatsup,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'contact_phone' => $request->contact_phone,
            'admin_verification' => $request->admin_verification,
            'desc' => $request->desc,
            'address' => $request->address,
            'send_prices' => $request->send_prices,
            'min_order_price' => $request->min_order_price,

        ]);
    }

    public function createToken()
    {
        $section1 = generateRandomString(650);
        $section2 = generateRandomString(550);
        $api_token = "eyJ" . $section1 . Crypt::encrypt($this->phone_number) . $section2 . "==";
        $this->updateToken($api_token);
        return $api_token;
    }

    public function updateToken($api_token)
    {
        $this->api_token = $api_token;
        $this->save();
    }

    public function addLogo(UploadedFile $file)
    {
        if (in_array($file->getClientOriginalExtension(), ["jpg", "jpeg", "png"])) {
            File::delete('photos/shop/' . $this->id . "/" . $this->logo);
            $file_name = "logo" . $this->id . random_int(0, 1000) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $path = 'photos/shop/' . $this->id . "/";
            $file->move($path, $file_name);
            return 'http://admin.alefbakala.ir/' . $path . $file_name;
        } else {
            return "";
        }

    }

    public function addPhoto(UploadedFile $file)
    {

        if (in_array($file->getClientOriginalExtension(), ["jpg", "jpeg", "png"])) {
            File::delete('photos/shop/' . $this->id . "/" . $this->logo);
            $file_name = "other" . $this->id . random_int(1, 100) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $path = 'photos/shop/' . $this->id . "/";
            $file->move($path, $file_name);
            return 'http://admin.alefbakala.ir/' . $path . $file_name;
        } else {
            return "";
        }
    }

    public function createPhoto($request)
    {
        $photos = explode(";", $this->photos);

        foreach ($request->file("photos") as $photo) {

            $created_photo = $this->addPhoto($photo);

            array_push($photos, $created_photo);
        }

        $this->photos = implode(";", array_values(array_filter($photos)));

        $this->save();

    }

    public function addSendPrice($request)
    {
        $sendPrice = implode(',', [$request->get('place'), $request->get('price')]);

        $sendPrices = explode(";", $this->send_prices);

        array_push($sendPrices, $sendPrice);

        $this->send_prices = implode(';', array_values(array_filter($sendPrices)));
        $this->save();
    }


    public function updateWorkingTime($request)
    {
        $workingDay = implode(',', [$request->get('from'), $request->get('to')]);
        $workingHour = implode(',', [$request->get('toNumber'), $request->get('fromNumber')]);
        $workingTime = implode(';', [$workingDay, $workingHour]);

        $this->working_hours = $workingTime;
        $this->save();
    }

    public function scopeSearch(Builder $query, $data)
    {
        return $query->where('title', 'like', '%' . $data . '%')
            ->orWhere('name', 'like', '%' . $data . '%')
            ->orWhere('desc', 'like', '%' . $data . '%')
            ->orWhere('address', 'like', '%' . $data . '%');
    }
}
