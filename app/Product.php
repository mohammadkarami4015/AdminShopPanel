<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Product extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function subgroup()
    {
        return $this->belongsTo(Subgroup::class);
    }

    public function shopCategory()
    {
        return $this->belongsTo(ShopCategory::class);
    }

    public function productComments()
    {
        return $this->hasMany(ProductComment::class);
    }

    public static function createNew(Request $request, $shop)
    {
        return $shop->products()->create([
            'group_id' => $shop->group->id,
            'subgroup_id' => $shop->subgroup_id,
            'city_id' => $shop->cityـid,
            'shop_category_id' => $request->get('shop_category_id'),
            'title' => $request->get('title'),
            'desc' => $request->get('desc'),
            'inventory' => $request->get('inventory'),
            'price' => $request->get('price'),
            'features' => $request->get('features'),
            'price_with_discount' => $request->get('price_with_discount'),
            'installment_flag' => $request->get('installment_flag'),
            'installment' => $request->get('installment'),
            'status' => "on",
            'admin_verification' => 'on',
        ]);
    }

    public function addPhoto(UploadedFile $file)
    {
        if (in_array($file->getClientOriginalExtension(), ["jpg", "jpeg", "png"])) {
            File::delete('photos/shop/' . $this->shop_id . "/products/" . $this->logo);
            $file_name = "product" . $this->id . random_int(100, 1000) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $path = 'photos/shop/' . $this->shop_id . "/products/";
            $file->move($path, $file_name);
            return 'http://admin.alefbakala.ir/' . $path . $file_name;
        } else {
            return "";
        }
    }

    public function createPhoto($request)
    {
        $photos = explode(";", $this->photos);

        foreach ($request as $photo) {

            $created_photo = $this->addPhoto($photo);
            array_push($photos, $created_photo);
        }
        $this->photos = implode(";", array_values(array_filter($photos)));

        $this->save();
    }

    public static function scopeSearch(Builder $query, $shopId, $data)
    {
        $query->where('shop_id', $shopId)->where(function (Builder $query) use ($data) {
            $query->Where('title', 'like', '%' . $data . '%')
                ->orWhere('desc', 'like', '%' . $data . '%');
            $query->orWhere('price', 'like', '%' . $data . '%');

            return $query;
        });
    }

    public function scopeSearchAll(Builder $query, $data)
    {
       return $query->where('title', 'like', '%' . $data . '%')
            ->orWhere('desc', 'like', '%' . $data . '%')
            ->orWhere('price', 'like', '%' . $data . '%');

    }

    public function addFeatures($request)
    {
        $feature = implode(',', [$request->get('title'), $request->get('amount')]);

        $features = explode(";", $this->features);

        array_push($features, $feature);

        $this->features = implode(';', array_values(array_filter($features)));

        $this->save();
    }

    public function deleteFeatures($request)
    {
        $features = explode(";", $this->features);

        foreach ($features as $key => $feature) {
            if ($request->feature == $feature) {
                unset($features[$request->key]);
            }
        }
        $this->features = implode(";", array_values(array_filter($features)));
        $this->save();;
    }

}
